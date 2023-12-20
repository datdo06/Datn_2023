<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <ul class="progress-indicator m-4">
                    @if(Route::currentRouteName() == 'transaction.reservation.pickFromCustomer')
                        <li
                            class="{{ Route::currentRouteName() == 'transaction.reservation.createIdentity' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.pickFromCustomer' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.viewCountPerson' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.chooseRoom' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.confirmation' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.payDownPayment' ? 'completed' : '' }}">
                            <span class="bubble"></span> Chọn người đặt
                        </li>
                    @endif
                    <li
                        class="{{ Route::currentRouteName() == 'transaction.reservation.viewCountPerson' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.chooseRoom' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.confirmation' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.payDownPayment' ? 'completed' : '' }}">
                        <span class="bubble"></span> Nhập thông tin
                    </li>
                    <li
                        class="{{ Route::currentRouteName() == 'transaction.reservation.chooseRoom' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.confirmation' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.payDownPayment' ? 'completed' : '' }}">
                        <span class="bubble"></span> Chọn một Homestay
                    </li>
                    <li
                        class="{{ Route::currentRouteName() == 'transaction.reservation.confirmation' ? 'completed' : '' }} {{ Route::currentRouteName() == 'transaction.reservation.payDownPayment' ? 'completed' : '' }}">
                        <span class="bubble"></span> Thanh toán
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
