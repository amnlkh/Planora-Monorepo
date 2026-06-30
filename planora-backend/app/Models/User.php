<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Relasi user memiliki banyak tugas.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Relasi user memiliki banyak jadwal belajar.
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Relasi user memiliki banyak access token.
     */
    public function accessTokens()
    {
        return $this->hasMany(AccessToken::class);
    }
}