<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFacilityRequest;
use App\Models\Facility;
use App\Repositories\Interface\FacilityRepositoryInterface;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    private $facilityRespository;

    public function __construct(FacilityRepositoryInterface $facilityRespository)
    {
        $this->facilityRespository = $facilityRespository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->facilityRespository->getFacilitiesDatatable($request);
        }
        return view('facility.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('facility.create')->render();

        return response()->json([
            'view' => $view,
        ]);
    }


    public function store(StoreFacilityRequest $request)
    {
        $facility = $this->facilityRespository->store($request);
        return response()->json([
            'message' => 'success', 'Facility ' . $facility->name . ' created'
        ]);
    }

    public function edit(Facility $facility)
    {
        $view = view('facility.edit', compact('facility'))->render();
        return response()->json([
            'view' => $view,
        ]);
    }


    public function update(Facility $facility ,StoreFacilityRequest $request )
    {

        $facility->update($request->all());

        return response()->json([
            'message' => 'success', 'Facility ' . $facility->name . ' udpated!'
        ]);
    }


    public function destroy(Facility $facility)
    {
        try {
            $facility->delete();
            return response()->json([
                'message' => 'success', 'Facility ' . $facility->name . ' deleted!'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'message' => 'Facility ' . $facility->name . ' cannot be deleted! Error Code:' . $e->errorInfo[1]
            ], 500);
        }
    }
}
