<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = ['html', 'image'];

    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return $this->image ? asset('storage/' . $this->attributes['image']) : asset('dashboard/images/avatar.jpg');
    }

}
