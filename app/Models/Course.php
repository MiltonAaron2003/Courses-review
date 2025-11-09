<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'instructor',
    ];

    /**
     * Un curso tiene muchas reseñas (reviews).
     */
    public function reviews() {
        return $this->hasMany(Review::class);
    }

    /**
     * Le dice a Laravel que use el 'slug' para encontrar el curso en la URL,
     * en lugar de usar el 'id'.
     */
    public function getRouteKeyName() {
        return 'slug';
    }
}