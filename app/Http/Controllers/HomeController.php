<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Models\Customer;
use App\Models\Image;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\Comment;
use App\Models\RoomStatus;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Repositories\Interface\RoomRepositoryInterface;
use Carbon\Carbon;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Requests\ChooseRoomRequest;
use App\Repositories\Interface\ReservationRepositoryInterface;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    private $reservationRepository;

    public function __construct(ReservationRepositoryInterface $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }


    public function chooseRoomU(ChooseRoomRequest $request)
    {
        $stayFrom = $request->check_in;
        $stayUntil = $request->check_out;
        $type = Type::query()->get();
        $checkin = date_create($request->check_in);
        $checkout = date_create($request->check_out);
        $stayFrom = date_format($checkin,"Y-m-d");
        $stayUntil = date_format($checkout,"Y-m-d");
        $occupiedRoomId = $this->getOccupiedRoomID($stayFrom, $stayUntil);
        $roomstatus = RoomStatus::all();
        $rooms = $this->reservationRepository->getUnocuppiedroom($request, $occupiedRoomId);
        $roomsCount = $this->reservationRepository->countUnocuppiedroom($request, $occupiedRoomId);

        return view('chooseRoomU', compact(
            'rooms',
            'stayFrom',
            'stayUntil',
            'roomsCount',
            'type',
            'roomstatus'
        ));
    }
    private function getOccupiedRoomID($stayFrom, $stayUntil)
    {
        return Transaction::where([['check_in', '<=', $stayFrom], ['check_out', '>=', $stayUntil]])
            ->orWhere([['check_in', '>=', $stayFrom], ['check_in', '<=', $stayUntil]])
            ->orWhere([['check_out', '>=', $stayFrom], ['check_out', '<=', $stayUntil]])
            ->pluck('room_id');
    }

    public function show()
    {
        $room_type = Type::query()->get();
        $roomImage = Image::query()
            ->get();

        $room_type = Type::query()->get();

        $rooms = Room::query()
            ->get();
        $transactions = Transaction::pluck('room_id')->toArray();

        $rooms = Room::whereNotIn('id', $transactions)->get();

        $users = Customer::query()
            ->join('users', 'customers.user_id', '=', 'users.id')
            ->where('role', '=', 'super')
            ->get();

        return view('home', compact('roomImage', 'rooms', 'users', 'room_type'));
    }
    public function formComment($id){
        $room = Room::find($id);
        $checkUser = DB::table('comments')
        ->join('rooms', 'rooms.id', '=', 'comments.com_room_id')
        ->select('comments.com_user_id as cui','rooms.id')
        ->where('rooms.id', $id)
        ->get();
        $comment = DB::table('comments')
        ->join('rooms', 'rooms.id', '=', 'comments.com_room_id')
        ->join('users', 'users.id', '=', 'comments.com_user_id')
        ->select('rooms.id','users.id as uid', 'users.name', 'users.avatar', 'comments.com_content','comments.com_subject','comments.star','comments.id as cd', 'comments.created_at')
        ->where('rooms.id', $id)
        ->get();
        $results = Comment::select('com_room_id', DB::raw('COUNT(*) as comment_count'))
        ->groupBy('com_room_id')
        ->where('comments.com_room_id', $id)
        ->get();
        return view('comment', compact('room','results','comment','checkUser'));
    }
    public function postComment($id, Request $request)
    {
        $idCom = $id;
        $comment = new Comment;
        $comment->com_room_id = $idCom;
        $comment->com_user_id = Auth::user()->id;
        $comment->com_content = $request->com_content;
        $comment->star = $request->star;
        $comment->com_subject = $request->com_subject;
        $comment->save();
        return redirect()->back();
    }
    public function delComment($id)
    {
        Comment::where('id', $id)->delete();
        return redirect()->back();
    }
}
