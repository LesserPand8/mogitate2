<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Season;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'image', // ← imageに統一
    ];

    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'product_season');
    }
}
