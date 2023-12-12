<?php

namespace App\Repositories\Implementation;

use App\Models\User;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Support\Str;

class UserRepository implements UserRepositoryInterface
{
    public function get($request)
    {
        $users = User::query()->where('role', 'Customer')->orderBy('id', 'DESC');
        if (!empty($request->q)) {
            $users = $users->where('name', 'LIKE', '%' . $request->q . '%')
                ->orWhere('id', 'LIKE', '%' . $request->q . '%');
        }

        $users = $users->paginate(8);
        $users->appends($request->all());
        return $users;
    }
    public function store($userData)
    {
        $user = User::create([
            'name' => $userData->name,
            'email' => $userData->email,
            'phone'=>$userData->phone,
            'gender'=>$userData->gender,
            'location'=>$userData->location,
            'password' => bcrypt($userData->password),
            'role' => $userData->role,
            'random_key' => Str::random(60)
        ]);
        if ($userData->hasFile('avatar')) {
            $path = 'img/user/' . $user->name . '-' . $user->id;
            $path = public_path($path);
            $file = $userData->file('avatar');

            $imageRepository = new ImageRepository;

            $imageRepository->uploadImage($path, $file);

            $user->avatar = $file->getClientOriginalName();
            $user->save();
        } else {
            $path = 'img/user/' . $user->name . '-' . $user->id;
            $path = public_path($path);
        }
        return $user;
    }

    public function showUser($request)
    {
        return User::whereIn('role', ['Super', 'Admin'])->orderBy('id', 'DESC')
            ->when($request->qu, function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->qu . '%');
            })
            ->paginate(5, ['*'], 'users')
            ->appends($request->all());
    }

    public function showCustomer($request)
    {
        return User::where('role', 'Customer')->orderBy('id', 'DESC')
            ->when($request->qc, function ($query) use ($request) {
                $query->where('email', 'LIKE', '%' . $request->qc . '%')->orWhere('name', 'LIKE', '%' . $request->qc . '%');
            })
            ->paginate(5, ['*'], 'customers')
            ->appends($request->all());
    }
    public function count($request)
    {
        $usersCount = User::query()->where('role', 'Customer')->orderBy('id', 'DESC');

        if (!empty($request->q)) {
            $usersCount = $usersCount->where('name', 'Like', '%' . $request->q . '%')
                ->orWhere('id', 'Like', '%' . $request->q . '%');
        }

        $usersCount = $usersCount->count();
        return $usersCount;
    }
}
