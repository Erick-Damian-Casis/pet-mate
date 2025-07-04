<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'species',
        'race',
        'age',
        'image_url',
    ];

    /*** Relationship */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
