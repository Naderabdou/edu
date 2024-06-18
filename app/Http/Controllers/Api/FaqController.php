<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\QuestionRepate;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Faqs\QuestionsResource;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Requests\Api\ContactUsRequest;
use App\Models\Contact;

class FaqController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        $faqs = QuestionRepate::all();
        $data = [
            'questions' => QuestionsResource::collection($faqs),
            'image_faqs' => asset('storage/' . getSetting('image_faqs'))
        ];

        return $this->apiResponse($data);
    }

    public function contact(ContactUsRequest $request)
    {

        Contact::create($request->validated());

        return $this->apiResponse(null, transWord('تم الارسال بنجاح سوف يتم التواصل معك قريبا'), 200);
    }
}
