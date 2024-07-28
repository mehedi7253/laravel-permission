<?php

namespace App\Http\Controllers;

use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(){
        $divisions = Division::all();
        $districts = District::all();
        $upazilas = Upazila::all();

        $division = Division::where('name', 'Dhaka');
        $allDistrictsOfDhaka = $division->districts;

        $division = Division::find(1);
        $districts = $division->districts;

        $district = District::find(1);
        $upazilas = $district->upazilas;
        return $upazilas;
    }
    public function getDivisions()
    {
        $divisions = Division::all();
        return response()->json($divisions);
    }

    public function getDistricts($divisionId)
    {
        $districts = District::where('division_id', $divisionId)->get();
        return response()->json($districts);
    }

    public function getUpazilas($districtId)
    {
        $upazilas = Upazila::where('district_id', $districtId)->get();
        return response()->json($upazilas);
    }
}
