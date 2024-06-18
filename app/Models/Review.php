<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
       'name_ar',
        'name_en',
        'desc_ar',
        'desc_en',
        'image',
    ];
    protected $appends = ['image_path'];


    public function getNameAttribute()
    {
        return $this['name_' . app()->getLocale()];
    }


    public function getDescAttribute()
    {
        return $this['desc_' . app()->getLocale()];
    }

    public function getImagePathAttribute()
    {
        return asset('storage/' . $this->image);
    }


}
