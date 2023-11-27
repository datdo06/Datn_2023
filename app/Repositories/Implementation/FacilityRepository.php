<?php
namespace App\Repositories\Implementation;
use App\Models\Facility;
use App\Repositories\Interface\FacilityRepositoryInterface;
class FacilityRepository implements FacilityRepositoryInterface{
    public function showAll($request){
        $facilities = Facility::orderBy('id', 'DESC');
        if (!empty($request->search)) {
            $facilities = $facilities->where('name', 'LIKE', '%' . $request->search . '%');
        }
        $facilities = $facilities->paginate(5);
        $facilities->appends($request->all());

        return $facilities;
    }
    public function getFacilitiesDatatable($request){
        $columns = array(
            0 => 'facilities.id',
            1 => 'facilities.name',
            2 => 'facilities.detail',
            4 => 'facilities.status',
            3 => 'facilities.price',
            3 => 'facilities.id',
        );

        $limit          = $request->input('length');
        $start          = $request->input('start');
        $order          = $columns[$request->input('order.0.column')];
        $dir            = $request->input('order.0.dir');

        $main_query = Facility::select(
            'facilities.id as number',
            'facilities.name',
            'facilities.detail',
            'facilities.status',
            'facilities.price',
            'facilities.id',
        );

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
                    "name" => $model->name,
                    "detail" => $model->detail,
                    "status" => $model->status,
                    "price" => $model->price,
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
    public function store($facilityData){
        $facilities = new Facility();
        $facilities->name = $facilityData->name;
        $facilities->detail = $facilityData->detail;
        $facilities->status = $facilityData->status;
        $facilities->price = $facilityData->price;
        $facilities->save();

        return $facilities;
    }
}
