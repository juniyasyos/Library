<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'department_id',
        'phone_number',
        'address',
        'join_date',
    ];

    /**
     * Mendapatkan departemen anggota ini.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Mendapatkan semua peminjaman yang dilakukan oleh anggota ini.
     */
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    /**
     * Scope lokal untuk mencari anggota berdasarkan nama.
     */
    public function scopeNamed($query, $name)
    {
        return $query->where('full_name', 'LIKE', "%{$name}%");
    }

    /**
     * Scope lokal untuk mencari anggota berdasarkan tipe.
     */
    public function scopeType($query, $type)
    {
        return $query->where('member_type', $type);
    }

    /**
     * Scope lokal untuk mencari anggota dalam departemen tertentu.
     */
    public function scopeInDepartment($query, $departmentId)
    {
        return $query->where('department_id', $departmentId);
    }

    /**
     * Mengecek apakah anggota memiliki peminjaman aktif.
     *
     * @return bool
     */
    public function hasActiveLoans()
    {
        return $this->loans()->whereNull('return_date')->exists();
    }
}
