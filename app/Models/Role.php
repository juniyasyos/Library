<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_name',
    ];

    /**
     * Mendapatkan semua user yang memiliki role ini.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Scope lokal untuk mencari role berdasarkan nama.
     */
    public function scopeNamed($query, $name)
    {
        return $query->where('role_name', $name);
    }
}
