<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surnames',
        'nick',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function createUser($data){

        DB::transaction(function () use ($data) {
            $user = User::create ([
                'name' => $data['name'],
                'surnames' => $data['surnames'],
                'nick' => $data['nick'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);
        });

    }

    public static function updateUser()
    {

    }

    public static function deleteUser()
    {

    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follower', 'user_id', 'follower_id', 'id', 'id');
    }

    public function followed()
    {
        return $this->belongsToMany(User::class, 'user_follower', 'follower_id', 'user_id', 'id', 'id');
    }
}
