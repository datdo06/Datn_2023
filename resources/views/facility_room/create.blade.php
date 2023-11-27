<form id="form-save-facility-room" class="row g-3" method="POST" action="{{ route('facility_room.store') }}">
    @csrf
    <div class="col-md-12">
        <label for="name" class="form-label">Tên cơ sở</label>
        <select class="form-control @error('room_id') is-invalid @enderror" id="room_id" name="room_id">
            <option value="">Chọn khu nghỉ dưỡng</option>
            @foreach($homestays as $homestay)
                <option value="{{$homestay->id}}">{{$homestay->number}}</option>
            @endforeach
        </select>
        @error('room_id')
        <div class="text-danger mt-1">
            {{ $message }}
        </div>
        @enderror
        <div id="error_name" class="text-danger error"></div>
    </div>
    <div class="col-md-12">
        <label for="information" class="form-label">Thông tin chi tiết</label>
        <select class="form-control @error('facility_id') is-invalid @enderror" id="facility_id" name="facility_id">
            <option value="">Chọn cơ sở</option>
            @foreach($facilities as $facility)
                <option value="{{$facility->id}}">{{$facility->name}}</option>
            @endforeach
        </select>
        @error('facility_id')
        <div class="text-danger mt-1">
            {{ $message }}
        </div>
        @enderror
        <div id="error_detail" class="text-danger error"></div>
    </div>
</form>
