<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'member_id',
        'book_id',
        'loan_date',
        'due_date',
        'return_date',
        'fine',
    ];

    /**
     * Mendapatkan anggota (member) yang melakukan peminjaman ini.
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Mendapatkan buku yang dipinjam.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Menghitung denda secara otomatis.
     *
     * @return float
     */
    public function calculateFine()
    {
        // Konfigurasi denda (bisa dari database atau file config)
        $finePerDay = 1000; // Contoh: Denda Rp1.000 per hari

        // Hitung selisih hari antara tanggal kembali dan tanggal jatuh tempo
        $overdueDays = now()->diffInDays(Carbon::parse($this->due_date));

        // Jika sudah dikembalikan dan terlambat, hitung denda
        if ($this->return_date && $overdueDays > 0) {
            return $overdueDays * $finePerDay;
        }

        return 0; // Tidak ada denda
    }

    /**
     * Menandai peminjaman sudah dikembalikan.
     *
     * @return void
     */
    public function markAsReturned()
    {
        $this->update([
            'return_date' => now(),
            'fine' => $this->calculateFine(),
        ]);
    }

    /**
     * Mendapatkan status peminjaman (Aktif, Terlambat, Selesai).
     *
     * @return string
     */
    public function getStatusAttribute()
    {
        if ($this->return_date) {
            return 'Selesai';
        } elseif (now()->gt($this->due_date)) {
            return 'Terlambat';
        } else {
            return 'Aktif';
        }
    }

    /**
     * Scope lokal untuk mencari peminjaman yang belum dikembalikan.
     */
    public function scopeNotReturned($query)
    {
        return $query->whereNull('return_date');
    }

    /**
     * Scope lokal untuk mencari peminjaman yang sudah lewat jatuh tempo.
     */
    public function scopeOverdue($query)
    {
        return $query->where('due_date', '<', now())->whereNull('return_date');
    }

    /**
     * Scope lokal untuk filter berdasarkan rentang tanggal peminjaman.
     */
    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        return $query->whereBetween('loan_date', [$startDate, $endDate]);
    }

    // Relasi polimorfik (opsional, jika ingin mencatat siapa yang memproses peminjaman dan pengembalian)

    // public function loanProcessor()
    // {
    //     return $this->morphTo();
    // }

    // public function returnProcessor()
    // {
    //     return $this->morphTo();
    // }
}
