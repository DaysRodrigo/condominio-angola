<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'document',
        'birth_date',
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

    public function resident()
    {
        return $this->hasOne('App\Models\Resident');
    }

    public static function create_user(Request $request)
    {
        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'document' => $request['document'],
            'birth_date' => $request['birth_date'],
            'password' => Hash::make('123mudar'),
        ]);
    }

    public static function createOwner(Request $request)
    {
        return User::create_user($request);
    }

    public static function haveResident(Request $request)
    {
        if(count($request) > 1){
            return false;
        } 
        return true;
    }

}
