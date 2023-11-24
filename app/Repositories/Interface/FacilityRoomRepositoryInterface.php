<?php
namespace App\Repositories\Interface;
interface FacilityRoomRepositoryInterface{
    public function showAll($request);
    public function getFacilityRoomDatatable($request);
    public function store($facilityRoomData);
}
