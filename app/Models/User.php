<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasUuids, Notifiable, SoftDeletes;

    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';

    const ADMIN_USER = 'true';
    const REGULAR_USER = 'false';

    protected $table = 'users';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'verified',
        'verification_token',
        'admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'verified',
        'api_token',
        'verification_token',
        'admin',
        'deleted_at',
    ];

    // Accessors and mutators
    public function setNameAttribute($name)
    {
        return $this->attributes['name'] = strtolower($name);
    }
    public function getNameAttribute($name)
    {
        return ucwords($name);
    }
    public function setEmailAttribute($email)
    {
        return $this->attributes['email'] = strtolower($email);
    }

    /**
     * Disable auto incrementing
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'string',
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->admin == self::ADMIN_USER;
    }

    public function isVerified()
    {
        return $this->verified == self::VERIFIED_USER;
    }

    public static function generateVerificationToken()
    {
        return Str::random(80);
    }
}
