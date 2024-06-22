<?php

namespace App\Http\Controllers\Api;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PackagesResource;
use App\Http\Resources\Api\PackagesShowResource;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;

class SubscribeController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        $packages = Package::where('is_active', 1)->get();
        return $this->ApiResponse(PackagesResource::collection($packages));

    }

    public function show($id)
    {
        $package = Package::find($id);
        if (!$package) {
            return $this->notFoundResponse();
        }
        return $this->ApiResponse(new PackagesShowResource($package));
    }
}
