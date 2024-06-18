<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Feature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\About\FeatureResource;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Resources\Api\About\InstructorsResource;
use App\Http\Resources\Api\About\PartnerResource;
use App\Models\Partner;

class AboutUsController extends Controller
{
    use ApiResponseTrait;
    public function about()
    {
        $settings = [
            'video_about',
            'image_about',
            'about_title',
            'description_about',


        ];

        $data = [];

        foreach ($settings as $setting) {
            if (in_array($setting, ['image_about', 'video_about'])) {
                $data[$setting] = asset('storage/' . getSetting($setting));

            } else {
                $data[$setting] = getSetting($setting, app()->getLocale());
            }
        }

        return $this->apiResponse($data);
    }

    public function feature(){
        $features = Feature::latest()->get();
        return $this->apiResponse(FeatureResource::collection($features));
     }

     public function instructors(){
        $instructors = User::role('instructor')->latest()->get();
        return $this->apiResponse(InstructorsResource::collection($instructors));
     }
     public function partners(){
        $partners = Partner::latest()->get();
        return $this->apiResponse(PartnerResource::collection($partners));
     }
}
