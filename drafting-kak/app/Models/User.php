<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'nik',
        'kategori_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id'); // Relasi ke model Kategori
    }

    public function drafts()
    {
        return $this->hasMany(Draft::class, 'user_id', 'id'); // Relasi ke model Draft
    }
}
