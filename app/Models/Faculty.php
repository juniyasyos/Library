<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'faculty_name',
    ];

    /**
     * Get all the departments that belong to the faculty.
     */
    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    /**
     * Scope a query to only include faculties with a given name.
     */
    public function scopeNamed($query, $name)
    {
        return $query->where('faculty_name', $name);
    }
}
