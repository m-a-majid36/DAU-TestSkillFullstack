<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['keyword'] ?? false, fn($query, $keyword) =>
            $query  ->where('name', 'LIKE', '%'. $keyword .'%')
                    ->orwhere('price', 'LIKE', '%'. $keyword .'%')
                    ->orwhere('stock', 'LIKE', '%'. $keyword .'%')
                    ->orwhere('description', 'LIKE', '%'. $keyword .'%')
        );
    }
}
