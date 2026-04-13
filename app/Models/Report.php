<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'reporter_id',
        'reported_user_id',
        'category',
        'reason',
        'details',
        'status',
    ];
    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }
    public function reportedUser()
    {
        return $this->belongsTo(User::class, 'reported_user_id');
    }
}