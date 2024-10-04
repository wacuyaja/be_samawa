<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\WeddingTestimonialResource;
use App\Models\WeddingTestimonialModel;
use Illuminate\Http\Request;

class WeddingTestimonialController extends Controller
{
    public function index(Request $request) {
        $limit = $request->query('limit', 10);

        $testimonials = WeddingTestimonialModel::with('weddingPackage')->limit($limit)->get();

        return WeddingTestimonialResource::collection($testimonials);
    } 
}
