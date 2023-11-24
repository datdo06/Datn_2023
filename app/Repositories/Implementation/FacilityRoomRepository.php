<?php
namespace App\Repositories\Implementation;
use App\Models\Facility;
use App\Models\FacilityRoom;

use App\Repositories\Interface\FacilityRoomRepositoryInterface;

class FacilityRoomRepository implements FacilityRoomRepositoryInterface{
    public function showAll($request){
        $facilityRoom = FacilityRoom::orderBy('id', 'DESC');
        if (!empty($request->search)) {
            $facilityRoom = $facilityRoom->where('name', 'LIKE', '%' . $request->search . '%');
        }
        $facilityRoom = $facilityRoom->paginate(5);
        $facilityRoom->appends($request->all());

        return $facilityRoom;
    }
    public function getFacilityRoomDatatable($request){
    $columns = array(
        0 => 'facility_rooms.id',
        1 => 'rooms.number',
        2 => 'facilities.name',
        3 => 'facility_rooms.id',
    );

    $limit          = $request->input('length');
    $start          = $request->input('start');
    $order          = $columns[$request->input('order.0.column')];
    $dir            = $request->input('order.0.dir');

    $main_query = FacilityRoom::select(
        'facility_rooms.id as number',
        'rooms.number as homestay',
        'facilities.name as facility',
        'facility_rooms.id',
    )->leftJoin("rooms", "rooms.id", "=", "facility_rooms.room_id")
        ->leftJoin("facilities", "facility_rooms.facility_id", "=", "facilities.id")
    ;

    $totalData = $main_query->get()->count();

    // Filter global column
    if ($request->input('search.value')) {
        $search = $request->input('search.value');
        $main_query->where(function ($query) use ($search, $columns) {
            $i = 0;
            foreach ($columns as $column) {
                if ($i = 0) {
                    $query->where($column, 'LIKE', "%{$search}%");
                } else {
                    $query->orWhere($column, 'LIKE', "%{$search}%");
                }
                $i++;
            }
        });
    }

    $totalFiltered = $main_query->count();

    $main_query->offset($start)
        ->limit($limit)
        ->orderBy($order, $dir);

    $models = $main_query->get();

    $data = [];
    if (!empty($models)) {
        foreach ($models as $model) {
            $data[] = array(
                "number" => $model->id,
                "homestay" => $model->homestay,
                "facility" => $model->facility,
                "id" => $model->id,
            );
        }
    }

    $response = array(
        "draw" => intval($request->input('draw')),
        "iTotalRecords" => $totalData,
        "iTotalDisplayRecords" => $totalFiltered,
        "aaData" => $data
    );

    return json_encode($response);
}
    public function store($facilityRoomData){
        $facilityRoom = new FacilityRoom();
        $facilityRoom->room_id = $facilityRoomData->room_id;
        $facilityRoom->facility_id = $facilityRoomData->facility_id;
        $facilityRoom->save();

        return $facilityRoom;
    }
}
