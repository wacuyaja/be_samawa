<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\WeddingOrganizerResource;
use App\Models\WeddingOrganizerModel;
use Illuminate\Http\Request;

class WeddingOrganizerController extends Controller
{
    public function index() {
        $organizers = WeddingOrganizerModel::withCount('weddingPackages')->with('weddingPackages')->get();
        return WeddingOrganizerResource::collection($organizers);
    }

    public function show(WeddingOrganizerModel $weddingOrganizer) {
        $weddingOrganizer->load([
            'weddingPackages.photos',
            'weddingPackages.weddingOrganizer' => function($query) {
                $query->withCount('weddingPackages');
            }
        ])->loadCount('weddingPackages');

        return new WeddingOrganizerResource($weddingOrganizer);
    }
}
