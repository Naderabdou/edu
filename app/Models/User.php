<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Rate;
use App\Models\Order;
use App\Models\Course;
use App\Models\FirebaseToken;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'skills' => 'json',
    ];

    protected $appends = ['avatar_path', 'background_image_path'];


    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    public function firebase_tokens()
    {
        return $this->hasMany(FirebaseToken::class, 'user_id', 'id');
    }

    public function updateUserDevice($token_firebase)
    {
        $this->firebase_tokens()->delete();

        // Store the new token
        $this->firebase_tokens()->create([
            'device_id' => $token_firebase,
            'token_firebase' => $token_firebase,
        ]);

    }

    public function getAvatarPathAttribute()
    {
        return $this->avatar ? asset('storage/' . $this->attributes['avatar']) : asset('dashboard/images/avatar.jpg');
    }


    public function getBackgroundImagePathAttribute()
    {
        return $this->background_image ? asset('storage/' . $this->attributes['background_image']) : asset('dashboard/images/avatar.jpg');
    }

    public function sendEmailVerificationCode()
    {
        $this->update([
            'code' => $this->activationCode(),
        ]);

         sendMail($this->code, $this->email, $this->name);

        return true;
    }

    private function activationCode()
    {
        return 1234;
        return mt_rand(1111, 9999);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'instructor_id', 'id');
    }



    public function reviews()
    {
        return $this->hasMany(Rate::class, 'user_id', 'id');
    }



    public function favorite()
    {
        return $this->belongsToMany(Course::class, 'favorites', 'user_id', 'course_id');
    }

    // public function orders()
    // {
    //     return $this->hasMany(Order::class, 'user_id', 'id');
    // }



    public function cart()
    {
        return $this->hasOne(Order::class ,'user_id')->where('type', 'cart');
    }

    public function orders()
    {
        return $this->hasMany(Order::class)->where('type', 'order');
    }




}
