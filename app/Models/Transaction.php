<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['keyword'] ?? false, fn($query, $keyword) =>
            $query  ->where('reference_no', 'LIKE', '%'. $keyword .'%')
                    ->orwhere('price', 'LIKE', '%'. $keyword .'%')
                    ->orwhere('quantity', 'LIKE', '%'. $keyword .'%')
                    ->orwhere('payment_amount', 'LIKE', '%'. $keyword .'%')
                    // ->orwhere('product_id', 'LIKE', '%'. $keyword .'%')
        );
    }
}
