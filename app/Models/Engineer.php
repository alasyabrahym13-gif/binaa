<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Engineer extends Model
{
    protected $primaryKey = 'id';
     use HasFactory;

    protected $fillable = [
        'user_id',
        'specialization',
        'experience_years',
        'certificates',
        'bio',
    ];

   
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
