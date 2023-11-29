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
            $users = $users->where('name', 'Like', '%' . $request->q . '%')
                ->orWhere('id', 'Like', '%' . $request->q . '%');
        }

        $users = $users->paginate(8);
        $users->appends($request->all());
        return $users;
    }
    public function store($userData)
    {
        $user = new User();
        $user->name = $userData->name;
        $user->email = $userData->email;
        $user->phone = $userData->phone;
        $user->password = bcrypt($userData->password);
        $user->role = $userData->role;
        $user->random_key = Str::random(60);
        $user->save();

        return $user;
    }

    public function showUser($request)
    {
        return User::whereIn('role', ['Super', 'Admin'])->orderBy('id', 'DESC')
            ->when($request->qu, function ($query) use ($request) {
                $query->where('email', 'LIKE', '%' . $request->qu . '%');
            })
            ->paginate(5, ['*'], 'users')
            ->appends($request->all());
    }

    public function showCustomer($request)
    {
        return User::where('role', 'Customer')->orderBy('id', 'DESC')
            ->when($request->qc, function ($query) use ($request) {
                $query->where('email', 'LIKE', '%' . $request->qc . '%');
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
