<?php

namespace App\Repositories\Implementation;

use App\Models\Room;
use App\Repositories\Interface\RoomRepositoryInterface;

class RoomRepository implements RoomRepositoryInterface
{
    public function getRooms($request)
    {
        $rooms = Room::with('type', 'roomStatus')
            ->orderBy('created_at', 'desc')
            ->when($request->status, function ($query) use ($request) {
                $query->where('room_status_id', $request->status);
            })
            ->when($request->type, function ($query) use ($request) {
                $query->where('type_id', $request->type);
            })->get();
        if (!empty($request->search)) {
            $rooms = $rooms->where('number', 'LIKE', '%' . $request->search . '%');
        }
        $rooms = $rooms->paginate(5);
        $rooms->appends($request->all());

        return DataTables::of($rooms)->make(true);
    }

    public function getRoomsDatatable($request)
    {
        $columns = array(
            0 => 'rooms.number',
            1 => 'types.name',
            2 => 'rooms.capacity',
            3 =>'rooms.acreage',
            4 => 'rooms.price',
            5 => 'room_statuses.name',
            6 => 'types.id',
            7 => 'rooms.location',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $main_query = Room::select(
            'rooms.id',
            'rooms.number',
            'types.name as type',
            'rooms.capacity',
            'rooms.acreage',
            'rooms.price',
            'room_statuses.name as status',
            'rooms.location',
        )
            ->when($request->status !== 'Tất cả', function ($query) use ($request) {
                $query->where('room_status_id', $request->status);
            })
            ->when($request->type !== 'Tất cả', function ($query) use ($request) {
                $query->where('type_id', $request->type);
            })
            ->leftJoin("types", "rooms.type_id", "=", "types.id")
            ->leftJoin("room_statuses", "rooms.room_status_id", "=", "room_statuses.id");

        $totalData = $main_query->get()->count();
        if ($request->has('filter_type')) {
            // Giá trị `filter_type` đã được truyền từ phía client
            $filterType = $request->input('filter_type');
            $main_query->where('types.id', $filterType);
            // Xử lý giá trị `filterType` ở đây
        }

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
                    "id" => $model->id,
                    "number" => $model->number,
                    "type" => $model->type,
                    "price" => $model->price,
                    "capacity" => $model->capacity,
                    "acreage" => $model->acreage,
                    "status" => $model->status,
                    'location' => $model->location,
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
}
