<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use App\Repositories\Implementation\ImageRepository;
use App\Repositories\Interface\ImageRepositoryInterface;
use App\Repositories\Interface\CustomerRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

    public function show(Customer $customer)
    {
        return view('customer.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customer.edit', ['customer' => $customer]);
    }

    public function update(Customer $customer, StoreCustomerRequest $request)
    {
        $user = User::where('id', $customer->user_id)->get();
        $img = $customer->User->avatar;
        $img = public_path('img/user/' . $request->name . '-' . $customer->user_id.$img);
        if ($request->hasFile('avatar')) {
            $path = 'img/user/' . $request->name . '-' . $customer->user_id;
            $path = public_path($path);
            $file = $request->file('avatar');

            $imageRepository = new ImageRepository;

            $imageRepository->uploadImage($path, $file);

            $user->avatar = $file->getClientOriginalName();
            DB::update('update users set name = ?, email = ?, avatar = ?, role = ? where id = ? ',[$request->name, $request->email, $user->avatar, 'Customer', $customer->user_id]);
            $imageRepository->destroy($img);
        }else{
            DB::update('update users set name = ?, email = ?, role = ? where id = ? ',[$request->name, $request->email, 'Customer', $customer->user_id]);
        }

        $customer->update([
            'name' => $request->name,
            'address' => $request->address,
            'job' => $request->job,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'user_id' => $customer->user_id
        ]);
        return redirect()->route('customer.index')->with('success', 'customer ' . $customer->name . ' udpated!');
    }

    public function destroy(Customer $customer, ImageRepositoryInterface $imageRepository)
    {
        try {
            $user = User::find($customer->user->id);

            $avatar_path = public_path('img/user/' . $user->name . '-' . $user->id);

            $customer->delete();
            $user->delete();

            if (is_dir($avatar_path)) {
                $imageRepository->destroy($avatar_path);
            }

            return redirect('customer')->with('success', 'Customer ' . $customer->name . ' deleted!');
        } catch (Exception $e) {
            $errorMessage = "";
            if ($e->errorInfo[0] == "23000") {
                $errorMessage = "Data still connected to other tables";
            }
            return redirect('customer')->with('failed', 'Customer ' . $customer->name . ' cannot be deleted! ' . $errorMessage);
        }
    }
}
