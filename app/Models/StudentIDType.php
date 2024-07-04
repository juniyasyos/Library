<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentIDType extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id_type_name',
    ];

    /**
     * Mendapatkan semua student ID yang menggunakan tipe ini.
     */
    public function studentIDs()
    {
        return $this->hasMany(StudentID::class);
    }

    /**
     * Scope lokal untuk mencari tipe student ID berdasarkan nama.
     */
    public function scopeNamed($query, $name)
    {
        return $query->where('student_id_type_name', $name);
    }
}
