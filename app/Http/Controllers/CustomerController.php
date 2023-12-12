<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use App\Repositories\Implementation\ImageRepository;
use App\Repositories\Interface\ImageRepositoryInterface;
use App\Repositories\Interface\CustomerRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use function Symfony\Component\String\u;

class CustomerController extends Controller
{
    private $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function index(Request $request)
    {
        $customers = $this->customerRepository->get($request);
        return view('customer.index', compact('customers'));
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(StoreCustomerRequest $request)
    {
      
        $customer = $this->customerRepository->store($request);
        
        if(auth()->user()){
            return redirect('customer')->with('success', 'Customer ' . $customer->name . ' created');
        }else{
            return redirect()->route('login');
        }

    }
    public function add(StoreCustomerRequest $request)
    {

        $customer = $this->customerRepository->store($request);
        return redirect()->route('login');
    }

    public function show(User $user)
    {
        return view('customer.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('customer.edit', compact('user'));
    }

    public function update(User $user, UpdateCustomerRequest $request)
    {
        $img = $user->avatar;
        $img = public_path('img/user/' . $request->name . '-' . $user->id . $img);
        if ($request->hasFile('avatar')) {
            $path = 'img/user/' . $request->name . '-' . $user->id;
            $path = public_path($path);
            $file = $request->file('avatar');

            $imageRepository = new ImageRepository;

            $imageRepository->uploadImage($path, $file);

            $user->avatar = $file->getClientOriginalName();
            DB::update('update users set name = ?, email = ?, phone = ?, gender =?, avatar = ?, role = ? where id = ? ', [$request->name, $request->email, $request->phone, $request->gender,$user->avatar, 'Customer', $user->id]);
            $imageRepository->destroy($img);
        } elseif ($request->location) {
            DB::update('update users set name = ?, email = ?,phone = ?,gender =?,location = ?, role = ? where id = ? ', [$request->name, $request->email, $request->phone,$request->gender, $request->location, 'Customer', $user->id]);
        } else {
            DB::update('update users set name = ?, email = ?,phone = ?,gender =?, role = ? where id = ? ', [$request->name, $request->email, $request->phone,$request->gender, 'Customer', $user->id]);
        }
        return redirect()->route('customer.index', ['id' => auth()->user()->id])->with('success', 'customer ' . $user->name . ' udpated!');
    }

    public function destroy(User $user, ImageRepositoryInterface $imageRepository)
    {
        try {
            $avatar_path = public_path('img/user/' . $user->name . '-' . $user->id);
            $user->delete();
            if (is_dir($avatar_path)) {
                $imageRepository->destroy($avatar_path);
            }

            return redirect('customer')->with('success', 'Customer ' . $user->name . ' deleted!');
        } catch (Exception $e) {
            $errorMessage = "";
            if ($e->errorInfo[0] == "23000") {
                $errorMessage = "Data still connected to other tables";
            }
            return redirect('customer')->with('failed', 'Customer ' . $user->name . ' cannot be deleted! ' . $errorMessage);
        }
    }
}
