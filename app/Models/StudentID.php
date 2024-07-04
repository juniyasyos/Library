<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentID extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id_number',
        'student_id_type_id',
    ];

    /**
     * Mendapatkan tipe student ID ini.
     */
    public function type()
    {
        return $this->belongsTo(StudentIDType::class, 'student_id_type_id');
    }

    /**
     * Mendapatkan semua anggota (members) yang memiliki student ID ini.
     */
    public function members()
    {
        return $this->belongsToMany(Member::class, 'member_student_i_d', 'student_id', 'member_id');
    }

    /**
     * Scope lokal untuk mencari student ID berdasarkan nomor.
     */
    public function scopeNumber($query, $number)
    {
        return $query->where('student_id_number', $number);
    }

    /**
     * Scope lokal untuk mencari student ID berdasarkan tipe.
     */
    public function scopeWithType($query, $typeId)
    {
        return $query->where('student_id_type_id', $typeId);
    }
}
