<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_name',
    ];

    /**
     * Mendapatkan semua buku dalam kategori ini.
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    /**
     * Scope lokal untuk mencari kategori berdasarkan nama.
     */
    public function scopeNamed($query, $name)
    {
        return $query->where('category_name', 'LIKE', "%{$name}%");
    }
}
