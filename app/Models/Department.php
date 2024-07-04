<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'department_name',
    ];

    /**
     * Mendapatkan semua anggota (members) yang berada di departemen ini.
     */
    public function members()
    {
        return $this->hasMany(Member::class);
    }

    /**
     * Mendapatkan fakultas dari departemen ini.
     */
    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    /**
     * Scope lokal untuk mencari departemen berdasarkan nama.
     */
    public function scopeNamed($query, $name)
    {
        return $query->where('department_name', 'LIKE', "%{$name}%");
    }
}
