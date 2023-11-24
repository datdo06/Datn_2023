<form id="form-save-facility-room" class="row g-3" method="POST" action="{{ route('facility_room.update', $facilityRoom->id )}}">
    @csrf
    @method('PUT')
    <div class="col-md-12">
        <label for="name" class="form-label">Name</label>
        <select class="form-control @error('room_id') is-invalid @enderror" id="room_id" name="room_id">
            <option value="">Chọn homestay</option>
            @foreach($homestays as $homestay)
                @if($homestay->id == $facilityRoom->room_id)
                    <option selected value="{{$homestay->id}}">{{$homestay->number}}</option>
                @else
                    <option value="{{$homestay->id}}">{{$homestay->number}}</option>
                @endif

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
        <label for="information" class="form-label">Detail</label>
        <select class="form-control @error('facility_id') is-invalid @enderror" id="facility_id" name="facility_id">
            @foreach($facilities as $facility)
                @if($facility->id == $facilityRoom->facility_id )
                    <option selected value="{{$facility->id}}">{{$facility->name}}</option>
                @else
                    <option value="{{$facility->id}}">{{$facility->name}}</option>
                @endif

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
