<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CityResource;
use App\Models\CityModel;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index() {
        $cities = CityModel::withCount('weddingPackages')->with('weddingPackages')->get();

        return CityResource::collection($cities);
    }

    public function show(CityModel $city) {
        $city->load(['weddingPackages.city', 'weddingPackages.photos']);
        $city->loadCount('weddingPackages');
        return new CityResource($city);
    }
}
