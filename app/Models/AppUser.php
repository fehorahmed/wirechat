<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Namu\WireChat\Traits\Chatable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AppUser extends Authenticatable
{

    use  HasFactory, Notifiable;
    use Chatable;

    protected $table = 'app_users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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
    ];

    public function refferalUsers()
    {
        return $this->hasMany(AppUser::class, 'referral_id','user_id');
    }
    public function canCreateChats(): bool
    {
        return true;
        return $this->hasVerifiedEmail();
    }
    public function canCreateGroups(): bool
    {
        return true;
        return $this->hasVerifiedEmail() === true;
    }
}
