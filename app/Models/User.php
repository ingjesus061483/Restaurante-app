<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public function caja(){
       return $this->belongsTo(Caja::class,'caja_id');
    }
    public function empleados(){
        return $this->hasMany(Empleado::class,'user_id');
    }
    public function clientes(){
        return $this->hasMany(Cliente::class,'user_id');
    }
   
    public function role(){
        return $this->belongsTo(Role::class,'role_id');
    }
    public function empresa()
    {
        return $this->belongsTo(empresa::class,'empresa_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'empresa_id',
        'caja_id'
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
}
