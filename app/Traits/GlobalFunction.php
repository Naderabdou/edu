<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait GlobalFunction
{

    public function deleteFileIfNotURL($data, $field, $model)
    {
        if (filter_var($data[$field], FILTER_VALIDATE_URL) === false) {

            // Field is not a URL, so it's a file path
            //new image uploaded
            if ($model->$field) {
                Storage::disk('public')->delete($model->$field);
            }
        }
    }

    public function convertURLsToPaths($data)
    {

        $base_url = "http://127.0.0.1:8000/storage/";

        if (isset($data)) {


            $newData = str_replace($base_url, "", $data);


        }


        return $newData;
    }
}
