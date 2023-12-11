<form id="form-save-roomstatus" class="row g-3" method="POST" action="{{ route('roomstatus.store') }}">
    @csrf
    <div class="col-md-12">
        <label for="name" class="form-label">Tên</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            value="{{ old('name') }}">
        @error('name')
            <div class="text-danger mt-1">
                {{ $message }}
            </div>
        @enderror
        <div id="error_name" class="text-danger error"></div>
    </div>
    <div class="col-md-12">
        <label for="code" class="form-label">Mã</label>
        <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code"
            value="{{ old('code') }}">
        @error('code')
            <div class="text-danger mt-1">
                {{ $message }}
            </div>
        @enderror
        <div id="error_code" class="text-danger error"></div>
    </div>
</form>
