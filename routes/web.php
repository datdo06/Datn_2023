<?php

use App\Http\Controllers\FacilityRoomController;
use App\Models\User;
use App\Events\NewReservationEvent;
use App\Events\RefreshDashboardEvent;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\TransactionRoomReservationController;
use App\Http\Controllers\RoomStatusController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['auth', 'checkRole:Super']], function () {
    Route::resource('user', UserController::class);
});

Route::group(['middleware' => ['auth', 'checkRole:Super,Admin']], function () {
    Route::post('/room/{room}/image/upload', [ImageController::class, 'store'])->name('image.store');
    Route::delete('/image/{image}', [ImageController::class, 'destroy'])->name('image.destroy');

    Route::name('transaction.reservation.')->group(function () {
        Route::get('/createIdentity', [TransactionRoomReservationController::class, 'createIdentity'])->name('createIdentity');
        Route::get('/pickFromCustomer', [TransactionRoomReservationController::class, 'pickFromCustomer'])->name('pickFromCustomer');
        Route::post('/storeCustomer', [TransactionRoomReservationController::class, 'storeCustomer'])->name('storeCustomer');
        Route::get('/{user}/viewCountPerson', [TransactionRoomReservationController::class, 'viewCountPerson'])->name('viewCountPerson');
        Route::get('/{user}/chooseRoom', [TransactionRoomReservationController::class, 'chooseRoom'])->name('chooseRoom');
        Route::get('/{user}/{room}/{from}/{to}/{person}/confirmation', [TransactionRoomReservationController::class, 'confirmation'])->name('confirmation');
        Route::post('/{user}/{room}/payDownPayment', [TransactionRoomReservationController::class, 'payDownPayment'])->name('payDownPayment');
    });
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::get('customer/show/{user}',[CustomerController::class, 'show'])->name('customer.show');
    Route::get('/customer/{user}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store');
    Route::put('/customer/{user}/update', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customer/{user}/destroy', [CustomerController::class, 'destroy'])->name('customer.destroy');
    Route::resource('type', TypeController::class);
    Route::resource('room', RoomController::class);
    Route::resource('roomstatus', RoomStatusController::class);
    Route::resource('transaction', TransactionController::class);
    Route::resource('facility', FacilityController::class);
    Route::resource('facility_room', FacilityRoomController::class);
    Route::resource('coupon', CouponController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::get('/transaction/{transaction}/payment/create', [PaymentController::class, 'create'])->name('transaction.payment.create');
    Route::post('/transaction/{transaction}/payment/store', [PaymentController::class, 'store'])->name('transaction.payment.store');
    Route::get('/get-dialy-guest-chart-data', [ChartController::class, 'dialyGuestPerMonth']);
    Route::get('/get-dialy-guest/{year}/{month}/{day}', [ChartController::class, 'dialyGuest'])->name('chart.dialyGuest');
});

Route::group(['middleware' => ['auth', 'checkRole:Super,Admin,Customer']], function () {
    Route::resource('user', UserController::class)->only([
        'show'
    ]);
    Route::get('/{user}/{room}/confirm', [TransactionRoomReservationController::class, 'confirm'])->name('confirm');

    Route::post('/check-coupon', [CouponController::class,'check_coupon'])->name('check-coupon');
    Route::get('/{user}/order', [TransactionRoomReservationController::class, 'TransactionHometay'])->name('order');
    Route::get('/payment/{transaction}/invoice', [PaymentController::class, 'invoice'])->name('payment.invoice');
    Route::post('/{user}/{room}/confirm', [TransactionRoomReservationController::class, 'confirm'])->name('confirm');
    Route::name('transaction.reservation.')->group(function () {
        Route::post('/{user}/{room}/payOnlinePayment', [TransactionRoomReservationController::class, 'payOnlinePayment'])->name('payOnlinePayment');
        Route::get('/payOnlinePayment', [TransactionRoomReservationController::class, 'vnpay'])->name('vnpay');
        Route::post('/pay', [TransactionRoomReservationController::class, 'pay'])->name('pay');
    });
    Route::get('/formComment/{room_id}', [HomeController::class, 'formComment'])->name('formComment');
    Route::post('/comment/{id}', [HomeController::class, 'postComment'])->name('postComment');
    Route::get('/comment/del/{id}', [HomeController::class, 'delComment'])->name('delComment');
    Route::view('/notification', 'notification.index')->name('notification.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/mark-all-as-read', [NotificationsController::class, 'markAllAsRead'])->name('notification.markAllAsRead');
    Route::get('/notification-to/{id}', [NotificationsController::class, 'routeTo'])->name('notification.routeTo');
});


Route::view('/admin/login', 'auth.login')->name('admin.login');
Route::post('/postLogin', [AuthController::class, 'postLogin'])->name('postlogin');
Route::view('/register', 'auth.register')->name('register');
Route::post('/postRegister', [RegisterController::class, 'create'])->name('postRegister');

// About
Route::get('/roomdetail', [\App\Http\Controllers\RoomDetailController::class, 'index'])->name('roomdetail');
Route::get('/gallery', [\App\Http\Controllers\GalleryController::class, 'index'])->name('gallery');
Route::get('/event', [\App\Http\Controllers\EventController::class, 'index'])->name('event');
Route::get('/about', [\App\Http\Controllers\AboutController::class, 'index'])->name('about');
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::get('/', [HomeController::class, 'show'])->name('home');


Route::get('/chooseRoom', [HomeController::class, 'chooseRoomU'])->name('chooseRoomU');
Route::view('/login', 'client.login')->name('login');
Route::view('/register', 'client.register')->name('register');
Route::post('/addCustomer', [UserController::class, 'store'])->name('customer.add');

Route::get('/oke', [TransactionRoomReservationController::class, 'oke']);
Route::get('/sendEvent', function () {
    $superAdmins = User::where('role', 'Super')->get();
    event(new RefreshDashboardEvent("Someone reserved a room"));

    foreach ($superAdmins as $superAdmin) {
        $message = 'Reservation added by';
        // event(new NewReservationEvent($message, $superAdmin));
    }
});
Route::get('/homestay-detail/{id}', [RoomController::class, 'homestayDetail'])->name('homestayDetail');
Route::get('/booking', function () {
    return view('booking');
});

Route::get('/money', [ChartController::class,'dailyMoneysPerMonth']);
Route::post('/{transaction}/mail', [TransactionRoomReservationController::class, 'CancelHomstay'])->name('cancelHomestay');

Route::get('/forget-password',[\App\Http\Controllers\Auth\ResetPasswordController::class, "forgetPassword"])->name('forget.password');
Route::post('/forget-password',[\App\Http\Controllers\Auth\ResetPasswordController::class, "forgetPasswordPost"])->name('forget.password.post');
Route::get('/reset-password/{token}', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'resetPassword'])->name('reset.password');
Route::post('/reset-password', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'resetPasswordPost'])->name('reset.password.post');
Route::get('/thank-you',[RoomController::class, 'thankYou'])->name('thank');
