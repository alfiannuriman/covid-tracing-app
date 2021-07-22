<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    const ROLE_USER_ADMIN = 'ADMINISTRATOR';
    const ROLE_USER_PLACE_ADMIN = 'PLACE_ADMIN';
    const ROLE_USER_CUSTOMER = 'CUSTOMER';

    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
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

    public function register(array $data)
    {
        try {
            DB::transaction(function () use ($data) {
                $this->name = $data['name'];
                $this->email = $data['email'];
                $this->password = Hash::make($data['password']);

                if ($this->save()) {
                    $this->assignRole(self::ROLE_USER_CUSTOMER);

                    return true;
                } else {
                    return false;
                }
            });
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
