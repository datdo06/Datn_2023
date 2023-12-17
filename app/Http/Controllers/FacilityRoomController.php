<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\FacilityRoom;
use App\Models\Room;
use App\Repositories\Interface\FacilityRoomRepositoryInterface;
use Illuminate\Http\Request;

class FacilityRoomController extends Controller
{

    private $facilityRoomRespository;

    public function __construct(FacilityRoomRepositoryInterface $facilityRoomRespository)
    {
        $this->facilityRoomRespository = $facilityRoomRespository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->facilityRoomRespository->getFacilityRoomDatatable($request);
        }
        return view('facility_room.index');
    }

    public function create()
    {
        $homestays = Room::query()->get();
        $facilities = Facility::query()->where('status', 'Trong HomeStay')->get();
        $view = view('facility_room.create', compact('homestays', 'facilities'))->render();
        return response()->json([
            'view' => $view,
        ]);
    }


    public function store(Request $request)
    {
        $facility = $this->facilityRoomRespository->store($request);
        return response()->json([
            'message' => 'success', 'FacilityRoom ' . $facility->name . ' created'
        ]);
    }

    public function show(FacilityRoom $facilityRoom)
    {


    }


    public function edit(FacilityRoom $facilityRoom)
    {

        $homestays = Room::query()->get();
        $facilities = Facility::query()->where('status', 'Trong HomeStay')->get();
        $view = view('facility_room.edit', compact('facilityRoom', 'homestays', 'facilities'))->render();
        return response()->json([
            'view' => $view,
        ]);
    }


    public function update(FacilityRoom $facilityRoom ,Request $request )
    {

        $facilityRoom->update($request->all());
        return response()->json([
            'message' => 'success', 'Facility ' . $facilityRoom->id . ' udpated!'
        ]);
    }


    public function destroy(FacilityRoom $facilityRoom)
    {
        try {
            $facilityRoom->delete();
            return response()->json([
                'message' => 'success', 'Facility ' . $facilityRoom->id . ' deleted!'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'message' => 'Facility ' . $facilityRoom->id . ' cannot be deleted! Error Code:' . $e->errorInfo[1]
            ], 500);
        }
    }
}
