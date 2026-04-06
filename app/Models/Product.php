<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'supplier_id',
        'name',
        'slug',
        'description',
        'category',
        'price',
        'quantity',
        'min_stock_alert',
        'status',
        'is_featured',
        'image',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'quantity' => 'integer',
        'min_stock_alert' => 'integer',
    ];
    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id');
    }
}