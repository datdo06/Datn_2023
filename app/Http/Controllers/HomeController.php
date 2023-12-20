<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Repositories\Implementation\ImageRepository;
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
        $count_person = $request->count_person;
        $type = Type::query()->get();
        $checkin = date_create($request->check_in);
        $checkout = date_create($request->check_out);
        $stayFrom = date_format($checkin, "Y-m-d");
        $stayUntil = date_format($checkout, "Y-m-d");
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
        return Transaction::whereNot('status', 'Đã hủy')
            ->where([['check_in', '<=', $stayFrom],['check_out', '>=', $stayUntil]])
            ->orWhere([['check_in', '<', $stayUntil],['check_out', '>', $stayFrom]])
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
        $comment = DB::table('comments')
            ->join('users', 'users.id', '=', 'comments.com_user_id')
            ->select('users.id as uid', 'users.name', 'users.avatar', 'comments.com_content', 'comments.star', 'comments.com_subject', 'comments.star', 'comments.id as cd', 'comments.created_at')
            ->limit(3)
            ->orderBy('cd', 'DESC')
            ->get();
        $users = User::query()
            ->where('role', '=', 'super')
            ->get();

        return view('home', compact('roomImage', 'rooms', 'users', 'room_type', 'comment'));
    }

    public function formComment($id)
    {
        $room = Room::find($id);
        $checkUser = DB::table('comments')
            ->join('rooms', 'rooms.id', '=', 'comments.com_room_id')
            ->select('comments.com_user_id as cui', 'rooms.id')
            ->where('rooms.id', $id)
            ->get();
        $comment = DB::table('comments')
            ->join('rooms', 'rooms.id', '=', 'comments.com_room_id')
            ->join('users', 'users.id', '=', 'comments.com_user_id')
            ->select('rooms.id', 'users.id as uid', 'users.name', 'users.avatar', 'comments.com_content', 'comments.com_subject', 'comments.star', 'comments.id as cd', 'comments.created_at')
            ->where('rooms.id', $id)
            ->get();
        $results = Comment::select('com_room_id', DB::raw('COUNT(*) as comment_count'))
            ->groupBy('com_room_id')
            ->where('comments.com_room_id', $id)
            ->get();
        return view('comment', compact('room', 'results', 'comment', 'checkUser'));
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

    public function userProfile($id)
    {
        $user = User::where('id', $id)->first();
        return view('uprofile', compact('user'));
    }

    public function edit(User $user)
    {
        return view('edit-profile', compact('user'));
    }

    public function update(User $user, UpdateProfileRequest $request)
    {
        $img = $user->avatar;
        $img = public_path('img/user/' . $user->name . '-' . $user->id . $img);
        if ($request->hasFile('avatar')) {
            $path = 'img/user/' . $request->name . '-' . $user->id;
            $path = public_path($path);
            $file = $request->file('avatar');

            $imageRepository = new ImageRepository;

            $imageRepository->uploadImage($path, $file);

            $user->avatar = $file->getClientOriginalName();
            DB::update('update users set name = ?, email = ?, phone = ?, gender =?, avatar = ?, role = ? where id = ? ', [$request->name, $request->email, $request->phone, $request->gender, $user->avatar, 'Customer', $user->id]);
            $imageRepository->destroy($img);
        } elseif ($request->location) {
            DB::update('update users set name = ?, email = ?,phone = ?,gender =?,location = ?, role = ? where id = ? ', [$request->name, $request->email, $request->phone, $request->gender, $request->location, 'Customer', $user->id]);
        } else {
            DB::update('update users set name = ?, email = ?,phone = ?,gender =?, role = ? where id = ? ', [$request->name, $request->email, $request->phone, $request->gender, 'Customer', $user->id]);
        }
        return redirect()->route('userProfile', ['id' => auth()->user()->id])->with('success', 'customer ' . $user->name . ' udpated!');
    }
}
