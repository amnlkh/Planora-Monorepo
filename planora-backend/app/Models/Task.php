<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'deadline',
        'status',
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];

    /**
     * Status yang diperbolehkan.
     */
    public const STATUS_PENDING = 'pending';
    public const STATUS_DONE = 'done';

    /**
     * Relasi tugas dimiliki oleh satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope untuk tugas pending.
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope untuk tugas selesai.
     */
    public function scopeDone($query)
    {
        return $query->where('status', self::STATUS_DONE);
    }

    /**
     * Scope untuk deadline terdekat.
     */
    public function scopeNearestDeadline($query)
    {
        return $query
            ->where('status', self::STATUS_PENDING)
            ->where('deadline', '>=', now())
            ->orderBy('deadline', 'asc');
    }
}