<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'product_id',
    ];

    public function project()
    {
        return $this->belongsTo(ProjectProduct::class, 'project_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}