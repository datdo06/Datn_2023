<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;

    public function forgetPassword() {
        return view('forget-password');
    }
    public function forgetPasswordPost(Request $request) {
        $request->validate([
           "email" => "required|email|exists:users",
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
           'email' => $request->email,
           'token' => $token,
           'created_at' => Carbon::now()
        ]);

        Mail::send('mail.forget-password', ['token' => $token], function ($message) use ($request) {
           $message->to($request->email);
           $message->subject('Đặt lại mật khẩu');
        });
        return redirect()->to(route('forget.password'))->with('success', 'Chúng tôi sẽ gửi mật khẩu làm lại đến email của bạn');
    }

    public function resetPassword($token) {
        return view('new-password', compact('token'));
    }

    public function resetPasswordPost(Request $request) {
        $request->validate([
           "email" => "required|email|exists:users",
           "password" => "required|string|min:6|confirmed",
           "password_confirmation" =>  "required",
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
               "email" => $request->email,
               "token" => $request->token,
            ])->first();

        if (!$updatePassword) {
            return redirect()->to(route("reset.password"))->with('error', 'Không hợp lệ');
        }

        User::where("email", $request->email)
            ->update(["password" => Hash::make($request->password)]);

        DB::table('password_resets')->where(["email" => $request->email])->delete();

        return redirect()->to(route('login'))->with('success', 'Mật khẩu đã được thiết lập');
    }
}
