<?php

namespace App\Models;

use App\Models\Package;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackageCourse extends Model
{
    use HasFactory;
    protected $fillable = ['package_id', 'course_id'];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }


}
