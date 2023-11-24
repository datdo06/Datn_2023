<?php
namespace App\Repositories\Interface;
interface FacilityRepositoryInterface{
    public function showAll($request);
    public function getFacilitiesDatatable($request);
    public function store($facilityData);
}
