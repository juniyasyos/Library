<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'isbn',
        'title',
        'publisher',
        'publication_year',
        'edition',
        'pages',
        'category_id',
        'shelf_location',
        'available_quantity',
        'total_quantity',
    ];

    /**
     * Mendapatkan kategori buku ini.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Mendapatkan semua author yang menulis buku ini.
     */
    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_author');
    }

    /**
     * Mendapatkan semua peminjaman yang terkait dengan buku ini.
     */
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    /**
     * Scope lokal untuk mencari buku berdasarkan judul.
     */
    public function scopeTitled($query, $title)
    {
        return $query->where('title', 'LIKE', "%{$title}%");
    }

    /**
     * Scope lokal untuk mencari buku berdasarkan ISBN.
     */
    public function scopeIsbn($query, $isbn)
    {
        return $query->where('isbn', $isbn);
    }

    /**
     * Scope lokal untuk mencari buku dalam kategori tertentu.
     */
    public function scopeInCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }
}
