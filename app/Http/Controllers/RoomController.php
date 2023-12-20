<?php

namespace App\Http\Controllers;
use App\Models\Comment;

use App\Http\Requests\StoreRoomRequest;
use App\Models\FacilityRoom;
use App\Models\Room;
use App\Models\RoomStatus;
use App\Models\Transaction;
use App\Models\Type;
use App\Models\Image;
use App\Repositories\Interface\ImageRepositoryInterface;
use App\Repositories\Interface\RoomRepositoryInterface;
use App\Repositories\Interface\RoomStatusRepositoryInterface;
use App\Repositories\Interface\TypeRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function __construct(
        private RoomRepositoryInterface $roomRepository,
        private TypeRepositoryInterface $typeRepository,
        private RoomStatusRepositoryInterface $roomStatusRepositoryInterface
    ) {
        $this->roomRepository = $roomRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->roomRepository->getRoomsDatatable($request);
        }

        $types = $this->typeRepository->getTypeList($request);
        $roomStatuses = $this->roomStatusRepositoryInterface->getRoomStatusList($request);
        return view('room.index', compact('types', 'roomStatuses'));

    }

    public function create()
    {
        $types = Type::all();
        $roomstatuses = RoomStatus::all();
        $view = view('room.create', compact('types', 'roomstatuses'))->render();

        return response()->json([
            'view' => $view
        ]);
    }

    public function store(StoreRoomRequest $request)
    {
        $room = Room::create($request->all());

        return response()->json([
            'message' => 'Homestay ' . $room->number . ' đã được thêm'
        ]);
    }

    public function show(Room $room)
    {
        $customer = [];
        $transaction = Transaction::where([['check_in', '<=', Carbon::now()], ['check_out', '>=', Carbon::now()], ['room_id', $room->id]])->first();
        if (!empty($transaction)) {
            $customer = $transaction->customer;
        }
        return view('room.show', compact('customer', 'room'));
    }

    public function edit(Room $room)
    {
        $types = Type::all();
        $roomstatuses = RoomStatus::all();
        $view = view('room.edit', compact('room', 'types', 'roomstatuses'))->render();

        return response()->json([
            'view' => $view
        ]);
    }

    public function update(Room $room, StoreRoomRequest $request)
    {
        $room->update($request->all());

        return response()->json([
            'message' => 'Homestay ' . $room->number . ' được cập nhật!'
        ]);
    }

    public function destroy(Room $room, ImageRepositoryInterface $imageRepository)
    {
        try {
            $tran  = Transaction::with('user', 'room')
                ->where('check_out', '>=', Carbon::now()->format('Y-m-d'))
                ->whereNot('status', 'Đã hủy')
                ->get();
            $check = true;
            foreach ($tran as $t){
                if($t->room_id == $room->id){
                    $check = false;
                }
            }
            if($check == true){
                $room->delete();
                $path = 'img/room/' . $room->number;
                $path = public_path($path);
                if (is_dir($path)) {
                    $imageRepository->destroy($path);
                }
                return response()->json([
                    'message' => 'Homestay ' . $room->number . ' đã được xóa'
                ]);
            }else{
                return response()->json([
                    'message' => 'Homestay ' . $room->number . ' không thể xóa'
                ], 422);
            }

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Customer ' . $room->number . ' cannot be deleted! Error Code:' . $e->errorInfo[1]
            ], 422);
        }
    }
    public function homestayDetail($id)
    {
        $room_type = Type::query()->get();
        $detailRoom = Room::where('id', $id)->first();
        $facilityHomestay = FacilityRoom::query()->where('room_id', $id)->get();
        $image = Image::where('room_id', $id)->get();
        $transactions = Transaction::pluck('room_id')->toArray();
        $results = Comment::select('com_room_id', DB::raw('COUNT(*) as comment_count'))
        ->groupBy('com_room_id')
        ->where('comments.com_room_id', $id)
        ->get();
        $comment = DB::table('comments')
        ->join('rooms', 'rooms.id', '=', 'comments.com_room_id')
        ->join('users', 'users.id', '=', 'comments.com_user_id')
        ->select('rooms.id','users.id as uid', 'users.name', 'users.avatar', 'comments.com_content','comments.com_subject','comments.star','comments.id as cd', 'comments.created_at')
        ->where('rooms.id', $id)
        ->get();
        $other_locations = Room::skip(4)->take(3)
        ->whereNotIn('id', $transactions)->get();
        return view('room.detail.index', compact('detailRoom', 'image','room_type', 'other_locations','comment','results', 'facilityHomestay'));
    }

    public function thankYou() {
        return view('thank-you');
    }


}
