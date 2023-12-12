<?php

namespace App\Repositories\Implementation;

use App\Models\Customer;
use App\Models\User;
use App\Repositories\Interface\CustomerRepositoryInterface;
use Illuminate\Support\Str;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function get($request)
    {
        $customers = User::query()->where('role', 'Customer')->orderBy('id', 'DESC');

        if (!empty($request->q)) {
            $customers = $customers->where('name', 'Like', '%' . $request->q . '%')
                ->orWhere('id', 'Like', '%' . $request->q . '%');
        }

        $customers = $customers->paginate(8);
        $customers->appends($request->all());
        return $customers;
    }

    public function count($request)
    {
        $customersCount = Customer::with('user')->orderBy('id', 'DESC');

        if (!empty($request->q)) {
            $customersCount = $customersCount->where('name', 'Like', '%' . $request->q . '%')
                ->orWhere('id', 'Like', '%' . $request->q . '%');
        }

        $customersCount = $customersCount->count();
        return $customersCount;
    }

    public static function store($request)
    {
        $customer = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone'=>$request->phone,
            'location'=>$request->location,
            'gender'=>$request->gender,
            'password' => bcrypt($request->password),
            'role' => 'Customer',
            'random_key' => Str::random(60)
        ]);

        if ($request->hasFile('avatar')) {
            $path = 'img/user/' . $customer->name . '-' . $customer->id;
            $path = public_path($path);
            $file = $request->file('avatar');

            $imageRepository = new ImageRepository;

            $imageRepository->uploadImage($path, $file);

            $customer->avatar = $file->getClientOriginalName();
            $customer->save();
        }



        return $customer;
    }
}
