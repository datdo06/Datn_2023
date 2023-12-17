<form id="form-save-coupon" class="row g-3" method="POST" action="{{route('coupon.store') }}">
    @csrf
    <div class="col-md-12">
        <label for="name" class="form-label">Tên</label>
        <input type="text" class="form-control @error('coupon_name') is-invalid @enderror" id="coupon_name"
            name="coupon_name" value="{{ old('coupon_name') }}">
        @error('coupon_name')
            <div class="text-danger mt-1">
                {{ $message }}
            </div>
        @enderror
        <div id="error_coupon_name" class="text-danger error"></div>
    </div>
    <div class="col-md-12">
        <label for="name" class="form-label">Mã</label>
        <input type="text" class="form-control @error('coupon_code') is-invalid @enderror" id="coupon_code"
               name="coupon_code" value="{{ old('coupon_code') }}">
        @error('coupon_code')
        <div class="text-danger mt-1">
            {{ $message }}
        </div>
        @enderror
        <div id="error_coupon_code" class="text-danger error"></div>
    </div>
    <div class="col-md-12">
        <label for="name" class="form-label">Số mã còn lại</label>
        <input type="text" class="form-control @error('coupon_time') is-invalid @enderror" id="coupon_time"
               name="coupon_time" value="{{ old('coupon_time') }}">
        @error('coupon_time')
        <div class="text-danger mt-1">
            {{ $message }}
        </div>
        @enderror
        <div id="error_coupon_time" class="text-danger error"></div>
    </div>
    <div class="col-md-12">
        <label for="name" class="form-label">Số tiền giảm</label>
        <input type="text" class="form-control @error('coupon_number') is-invalid @enderror" id="coupon_number"
               name="coupon_number" value="{{ old('coupon_number') }}">
        @error('coupon_number')
        <div class="text-danger mt-1">
            {{ $message }}
        </div>
        @enderror
        <div id="error_coupon_number" class="text-danger error"></div>
    </div>
    <div class="col-md-12">
        <label for="name" class="form-label">Ngày bắt đầu</label>
        <input type="date" class="form-control @error('start_time') is-invalid @enderror" id="start_time"
               name="start_time" value="{{ old('start_time') }}">
        @error('start_time')
        <div class="text-danger mt-1">
            {{ $message }}
        </div>
        @enderror
        <div id="error_coupon_number" class="text-danger error"></div>
    </div>
    <div class="col-md-12">
        <label for="name" class="form-label">Ngày hết</label>
        <input type="date" class="form-control @error('end_time') is-invalid @enderror" id="end_time"
               name="end_time" value="{{old('end_time') }}">
        @error('end_time')
        <div class="text-danger mt-1">
            {{ $message }}
        </div>
        @enderror
        <div id="error_coupon_number" class="text-danger error"></div>
    </div>
    <div class="col-md-12">
        <label for="information" class="form-label">Phương thức</label>
        <select class="form-select @error('coupon_condition') is-invalid @enderror" id="coupon_condition" name="coupon_condition" aria-label="Chọn giảm theo % hoặc tiền">
            <option selected value="">Chọn: </option>
            <option value="1">Theo phần trăm</option>
            <option value="2">Theo tiền</option>
        </select>
        @error('coupon_condition')
            <div class="text-danger mt-1">
                {{ $message }}
            </div>
        @enderror
        <div id="error_coupon_condition" class="text-danger error"></div>
    </div>
</form>
