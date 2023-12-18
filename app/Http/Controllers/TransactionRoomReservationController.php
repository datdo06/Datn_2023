<?php

namespace App\Http\Controllers;

use App\Events\NewReservationEvent;
use App\Events\RefreshDashboardEvent;
use App\Helpers\Helper;
use App\Http\Requests\ChooseRoomRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\Coupon;
use App\Jobs\SendSuccessMail;
use App\Jobs\SendWelcomeEmail;
use App\Mail\CancelHomestayMail;
use App\Mail\SuccessHomestayMail;
use App\Models\Customer;
use App\Models\Facility;
use App\Models\FacilityRoom;
use App\Models\Payment;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\TransactionCoupon;
use App\Models\TransactionFacility;
use App\Models\Type;
use App\Models\User;
use App\Notifications\NewRoomReservationDownPayment;
use App\Repositories\Interface\ReservationRepositoryInterface;
use App\Repositories\Interface\PaymentRepositoryInterface;
use App\Repositories\Interface\TransactionRepositoryInterface;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


use Illuminate\Support\Facades\Mail;

class TransactionRoomReservationController extends Controller
{
    private $reservationRepository;
    private $cus;
    private $ro;
    private $da;

    public function __construct(ReservationRepositoryInterface $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    public function pickFromCustomer(Request $request, UserRepositoryInterface $userRepository)
    {
        $users = $userRepository->get($request);
        $usersCount = $userRepository->count($request);
        return view('transaction.reservation.pickFromCustomer', compact('users', 'usersCount'));
    }

    public function createIdentity()
    {
        return view('transaction.reservation.createIdentity');
    }

    public function storeCustomer(StoreCustomerRequest $request, UserRepositoryInterface $userRepository)
    {
        $user = $userRepository->store($request);
        return redirect()
            ->route('transaction.reservation.viewCountPerson', ['user' => $user->id])
            ->with('success', 'Tài khoản người dùng ' . $user->name . ' đã được tạo!');
    }

    public function viewCountPerson(User $user)
    {
        $room_type = Type::query()->get();
        return view('transaction.reservation.viewCountPerson', compact('user', 'room_type'));
    }

    public function chooseRoom(ChooseRoomRequest $request, User $user)
    {
        $stayFrom = $request->check_in;
        $stayUntil = $request->check_out;
        $type = Type::query()->get();
        $checkin = date_create($request->check_in);
        $checkout = date_create($request->check_out);
        $stayFrom = date_format($checkin, "Y-m-d");
        $stayUntil = date_format($checkout, "Y-m-d");
        $occupiedRoomId = $this->getOccupiedRoomID($stayFrom, $stayUntil);

        $rooms = $this->reservationRepository->getUnocuppiedroom($request, $occupiedRoomId);
        $roomsCount = $this->reservationRepository->countUnocuppiedroom($request, $occupiedRoomId);

        return view('transaction.reservation.chooseRoom', compact(
            'user',
            'rooms',
            'stayFrom',
            'stayUntil',
            'roomsCount',
            'type',
        ));
    }

    public function confirmation(User $user, Room $room, $stayFrom, $stayUntil, $person)
    {

        $price = $room->price;
        $dayDifference = Helper::getDateDifference($stayFrom, $stayUntil);
        $downPayment = ($price * $dayDifference) * 0.15;
        return view('transaction.reservation.confirmation', compact(
            'user',
            'room',
            'stayFrom',
            'stayUntil',
            'person',
            'downPayment',
            'dayDifference'
        ));
    }

    public function payOnlinePayment(
        Room     $room,
        Request  $request,
    )
    {

        $dayDifference = Helper::getDateDifference($request->check_in, $request->check_out);
        $minimumDownPayment = $request->sum_money * 0.15;
        if (empty($request->cus)) {
            $request->validate([
                'downPayment' => 'required|numeric|gte:' . $minimumDownPayment
            ]);
        }
        $occupiedRoomId = $this->getOccupiedRoomID($request->check_in, $request->check_out);
        $occupiedRoomIdInArray = $occupiedRoomId->toArray();

        if (in_array($room->id, $occupiedRoomIdInArray)) {
            return redirect()->back()->with('failed', 'Sorry, room ' . $room->number . ' already occupied');
        }

        session(['room' => $room]);
        session(['request' => $request->all()]);
        $data = $request->all();

        if (!empty($request->cus)) {
            if (!empty($request->facility)) {
                $facility_id = $request->facility;
                $quantity = $request->quantity;
                foreach ($facility_id as $key => $value) {
                    $facilities [] = Facility::where('id', $value)->first();
                }
                return view('payment.confirm', compact('data', 'room', 'minimumDownPayment', 'facilities', 'quantity'));
            } else {
                return view('payment.confirm', compact('data', 'room', 'minimumDownPayment'));
            }

        } else {
            return view('transaction.css', compact('data', 'room'));
        }
    }

    public function pay(Request $request)
    {
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        if (session()->has('request')) {
            $data = session()->get('request');
            if (isset($data['cus'])) {
                $amount = $request->downPayment;
            } else {
                $amount = $data['downPayment'];
            }
        }

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_TmnCode = "LLWJITYZ";//Mã website tại VNPAY
        $vnp_HashSecret = "EZNGMRKORWXAHBPAJWRNZIMHXIVQQOAF"; //Chuỗi bí mật
        $vnp_TxnRef = rand(1, 10000); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_Locale = "vn";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $amount * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => route('transaction.reservation.vnpay'),
            "vnp_TxnRef" => $vnp_TxnRef,

        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }


        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;

        }
        $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);

        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);

            die();

        } else {
            echo json_encode($returnData);

        }
        // vui lòng tham khảo thêm tại code demo
    }

    public function vnpay()
    {
        if (session()->has('request') && session()->has('room') && $_GET['vnp_ResponseCode'] == "00") {
            $request = session()->get('request');
            $downPayment = $_GET['vnp_Amount'] / 100;
            $room = session()->get('room');
            if(!empty($request['user_id'])){
                $user_id = $request['user_id'];
                $user = User::query()->where('id', $user_id)->first();
                $guest_name = $user->name;
                $guest_email = $user->email;
                $guest_phone = $user->phone;
            }else{
                $user_id = 0;
                $guest_name = $request['guest_name'];
                $guest_email = $request['guest_email'];
                $guest_phone = $request['guest_phone'];
            }
            $checkin = date_create($request['check_in']);
            $checkout = date_create($request['check_out']);
            $request['check_in'] = date_format($checkin, "Y-m-d");
            $request['check_out'] = date_format($checkout, "Y-m-d");
            $transaction = Transaction::create([
                'user_id' => $user_id,
                'guest_name'=> $guest_name,
                'guest_email'=>$guest_email,
                'guest_phone'=>$guest_phone,
                'room_id' => $room->id,
                'check_in' => $request['check_in'],
                'check_out' => $request['check_out'],
                'sum_people' => $request['person'],
                'status' => 'Reservation',
                'sum_money' => $request['sum_money'],
            ]);
            if (isset($request['facility'])) {
                $facility = $request['facility'];
                $quantities = $request['quantity'];
                foreach ($facility as $key => $value) {
                    $quantity = $quantities[$key];
                    if(empty($quantity)){
                        $quantity = $quantities[$key + 1];
                    }
                    $facility_room = TransactionFacility::create([
                        'transaction_id' => $transaction->id,
                        'facility_id' => $value,
                        'quantity'=>$quantity,
                    ]);
                }
            }

            $status = 'Down Payment';
            $payment = Payment::create([
                'transaction_id' => $transaction->id,
                'price' => !empty($downPayment) ? $downPayment : 0,
                'status' => $status
            ]);


            $superAdmins = User::where('role', 'Super')->get();

            foreach ($superAdmins as $superAdmin) {
                $message = 'Đặt chỗ được thêm bởi' . $guest_name;
                event(new NewReservationEvent($message, $superAdmin));
                $superAdmin->notify(new NewRoomReservationDownPayment($transaction, $payment));
            }

            event(new RefreshDashboardEvent("Someone reserved a room"));
            $transactionFacility = TransactionFacility::query()->where('transaction_id', $transaction->id)->get();

            if (isset($request['cus'])) {
                if (!empty($request['coupon_id'])){
                    $transactionCoupon = TransactionCoupon::create([
                        'transaction_id'=>$transaction->id,
                        'coupon_id'=>$request['coupon_id'],
                    ]);
                    $mail = new SuccessHomestayMail($transaction, $transactionCoupon, $transactionFacility);
                    SendSuccessMail::dispatch($transaction, $mail);
                    return view('transaction.success', compact( 'transaction', 'transactionCoupon', 'transactionFacility', 'payment'));
                }else{
                    $transactionCoupon = TransactionCoupon::query()->find(0);
                    $mail = new SuccessHomestayMail($transaction, $transactionCoupon, $transactionFacility, $payment);
                    SendSuccessMail::dispatch($transaction,$mail);
                    return view('transaction.success', compact( 'transaction', 'transactionFacility' , 'payment'));
                }


            } else {
                return redirect()->route('transaction.index')
                    ->with('success', 'Room ' . $room->number . ' has been reservated by ' . $transaction->guest_name);
            }
        } else {
            return 'Giao dịch không thành công';
        }
    }

    public function payDownPayment(
        User                       $user,
        Room                           $room,
        Request                        $request,
        TransactionRepositoryInterface $transactionRepository,
        PaymentRepositoryInterface     $paymentRepository
    )
    {
        $dayDifference = Helper::getDateDifference($request->check_in, $request->check_out);
        $minimumDownPayment = ($room->price * $dayDifference) * 0.15;

        $request->validate([
            'downPayment' => 'required|numeric|gte:' . $minimumDownPayment
        ]);

        $occupiedRoomId = $this->getOccupiedRoomID($request->check_in, $request->check_out);
        $occupiedRoomIdInArray = $occupiedRoomId->toArray();

        if (in_array($room->id, $occupiedRoomIdInArray)) {
            return redirect()->back()->with('failed', 'Sorry, room ' . $room->number . ' already occupied');
        }

        $transaction = $transactionRepository->store($request, $user, $room);
        $status = 'Down Payment';
        $payment = $paymentRepository->store($request, $transaction, $status);

        $superAdmins = User::where('role', 'Super')->get();

        foreach ($superAdmins as $superAdmin) {
            $message = 'Reservation added by ' . $user->name;
            event(new NewReservationEvent($message, $superAdmin));
            $superAdmin->notify(new NewRoomReservationDownPayment($transaction, $payment));
        }

        event(new RefreshDashboardEvent("Someone reserved a room"));

        return redirect()->route('transaction.index')
            ->with('success', 'Room ' . $room->number . ' has been reservated by ' . $user->name);
    }

    private function getOccupiedRoomID($stayFrom, $stayUntil)
    {
        return Transaction::where([['check_in', '<=', $stayFrom], ['check_out', '>=', $stayUntil]])
            ->orWhere([['check_in', '>=', $stayFrom], ['check_in', '<=', $stayUntil]])
            ->orWhere([['check_out', '>=', $stayFrom], ['check_out', '<=', $stayUntil]])
            ->pluck('room_id');
    }

    public function confirm($id, Room $room, Request $request)
    {
        $checkin = date_create($request->checkin);
        $checkout = date_create($request->checkout);
        $request->checkin = date_format($checkin, "Y-m-d");
        $request->checkout = date_format($checkout, "Y-m-d");
        if(!empty($id)){
            $user = User::query()->where('id', $id)->first();
        }
        if ($request->total_day == 0) {
            $request->total_day = Helper::getDateDifference($request->checkin, $request->checkout);
        }
        $facilities = Facility::where('status', 'Ngoài Homestay')->get();
        $data = [
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'person' => $request->person,
            'total_day' => $request->total_day,
        ];
        if(empty($user)){
            return view('payment.pay', compact('data', 'room', 'facilities'));
        }else{
            return view('payment.pay', compact('data', 'user', 'room', 'facilities'));
        }

    }

    public function TransactionHometay(User $user)
    {

        $transactions = Transaction::where('user_id', $user->id)->get();
        return view('client.order', compact('transactions'));
    }

    public function CancelHomstay(Request $request, Transaction $transaction)
    {
        $mail = new CancelHomestayMail($transaction);
        $transactionFacility = TransactionFacility::query()->where('transaction_id', $transaction->id)->get();
        $transactionCoupon = TransactionCoupon::query()->where('transaction_id', $transaction->id)->first();
        SendWelcomeEmail::dispatch($transaction, $mail);
        $transaction->update([ 'status' => 'Đã hủy']);
        return view('cancelHomestay', compact('transaction',  'transactionCoupon', 'transactionFacility'));
    }
}
