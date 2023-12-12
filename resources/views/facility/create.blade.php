<form id="form-save-facility" class="row g-3" method="POST" action="{{ route('facility.store') }}">
    @csrf
    <div class="col-md-12">
        <label for="name" class="form-label">Tên dịch vụ</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
               value="{{old('name')}}">
        @error('name')
        <div class="text-danger mt-1">
            {{ $message }}
        </div>
        @enderror
        <div id="error_name" class="text-danger error"></div>
    </div>
    <div class="col-md-12">
        <label for="name" class="form-label">Trạng thái</label>
        <select name="status" class="form-control" id="">
            <option value="Trong Homestay">Trong khu nghỉ dưỡng</option>
            <option value="Ngoài Homestay">Ngoài khu nghỉ dưỡng</option>
        </select>
        @error('status')
        <div class="text-danger mt-1">
            {{ $message }}
        </div>
        @enderror
        <div id="error_name" class="text-danger error"></div>
    </div>
    <div class="col-md-12">
        <label for="name" class="form-label">Giá tiền</label>
        <input type="text" class="form-control @error('price') is-invalid @enderror" id="name"
               name="price" value="{{ old('price') }}">
        @error('name')
        <div class="text-danger mt-1">
            {{ $message }}
        </div>
        @enderror
        <div id="error_name" class="text-danger error"></div>
    </div>
    <div class="col-md-12">
        <label for="information" class="form-label">Thông tin chi tiết</label>
        <textarea class="form-control" id="detail" name="detail" rows="3">{{ old('detail') }}</textarea>
        @error('detail')
        <div class="text-danger mt-1">
            {{ $message }}
        </div>
        @enderror
        <div id="error_detail" class="text-danger error"></div>
    </div>

</form>
