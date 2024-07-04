<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal (mass-assignment).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'author_name',
    ];

    /**
     * Mendapatkan semua buku yang ditulis oleh author ini.
     */
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_author');
    }

    /**
     * Scope lokal untuk mencari author berdasarkan nama.
     */
    public function scopeNamed($query, $name)
    {
        return $query->where('author_name', 'LIKE', "%{$name}%");
    }

    /**
     * Scope lokal untuk mencari author yang menulis buku tertentu.
     */
    public function scopeWithBook($query, $bookId)
    {
        return $query->whereHas('books', function ($query) use ($bookId) {
            $query->where('books.id', $bookId);
        });
    }
}
