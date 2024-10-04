<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\WeddingPackageResource;
use App\Models\WeddingPackageModel;
use Illuminate\Http\Request;

class WeddingPackageController extends Controller
{
    public function index() {
        $packages = WeddingPackageModel::with(['city', 'weddingOrganizer', 'photos', 'weddingBonusPackages', 'weddingBonusPackages.bonusPackage', 'weddingTestimonials'])->get();

        return WeddingPackageResource::collection($packages);
    }

    public function show(WeddingPackageModel $weddingPackage) {
        $weddingPackage->load(['city', 'weddingOrganizer', 'photos', 'weddingBonusPackages', 'weddingBonusPackages.bonusPackage', 'weddingTestimonials']);
        $weddingPackage->weddingOrganizer->loadCount('weddingPackages');
        $weddingPackage->city->loadCount('weddingPackages');
        return new WeddingPackageResource($weddingPackage);
    }

    public function popular(Request $request) {
        $limit = $request->query('limit', 10);
        $packages = WeddingPackageModel::with(['city', 'weddingOrganizer', 'photos', 'weddingBonusPackages', 'weddingBonusPackages.bonusPackage', 'weddingTestimonials'])
        ->where('is_popular', true)
        ->limit($limit)
        ->get();

        return WeddingPackageResource::collection($packages);
    }
}
