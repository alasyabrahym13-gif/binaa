<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EngineerProfile extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * اسم الجدول (اختياري لأن Laravel يتوقعه تلقائيًا)
     */
    protected $table = 'engineer_profiles';

    /**
     * الحقول القابلة للتعبئة (Mass Assignment)
     */
    protected $fillable = [
        'user_id',
        'specialization',
        'experience_years',
        'certificates',
        'bio',
        'is_available',
        'rating',
    ];

    /**
     * تحويل أنواع البيانات (Casting)
     */
    protected $casts = [
        'certificates'     => 'array',
        'is_available'     => 'boolean',
        'experience_years' => 'integer',
        'rating'           => 'decimal:2',
    ];

    /**
     * القيم الافتراضية
     */
    protected $attributes = [
        'is_available'     => true,
        'experience_years' => 0,
        'rating'           => 0.00,
    ];

    /**
     * العلاقات
     */

    // العلاقة مع المستخدم (كل Profile يخص User واحد)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessors (اختياري)
     */

    // مثال: عرض التقييم كنسبة
    public function getRatingPercentageAttribute()
    {
        return $this->rating * 20; // تحويل من 5 إلى 100%
    }

    /**
     * Scopes (احترافي 👇)
     */

    // المهندسين المتاحين فقط
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    // حسب التخصص
    public function scopeBySpecialization($query, $specialization)
    {
        return $query->where('specialization', $specialization);
    }

    // الأعلى تقييماً
    public function scopeTopRated($query)
    {
        return $query->orderByDesc('rating');
    }
}