<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HolidayCache extends Model
{
    use HasFactory;

    protected $table = 'holiday_cache';

    protected $fillable = [
        'country_code',
        'year',
        'holidays',
        'fetched_at',
        'expires_at',
    ];

    protected $casts = [
        'holidays' => 'array',
        'fetched_at' => 'datetime',
        'expires_at' => 'datetime',
        'year' => 'integer',
    ];

    /**
     * Scope berdasarkan negara dan tahun.
     */
    public function scopeByCountryAndYear($query, string $countryCode, int $year)
    {
        return $query
            ->where('country_code', $countryCode)
            ->where('year', $year);
    }

    /**
     * Mengecek apakah cache masih valid.
     */
    public function isValid(): bool
    {
        return $this->expires_at === null || $this->expires_at->isFuture();
    }
}