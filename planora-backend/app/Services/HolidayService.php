<?php

namespace App\Services;

use App\Contracts\HolidayServiceInterface;
use App\Models\HolidayCache;
use Illuminate\Support\Facades\Http;

class HolidayService implements HolidayServiceInterface
{
    public function getHolidays(?int $year = null): array
    {
        $year = $year ?? now()->year;
        $countryCode = 'ID';

        $cache = HolidayCache::byCountryAndYear($countryCode, $year)->first();

        if ($cache && $cache->isValid()) {
            return [
                'year' => $year,
                'country' => $countryCode,
                'holidays' => $cache->holidays,
            ];
        }

        $response = Http::get("https://date.nager.at/api/v3/PublicHolidays/{$year}/{$countryCode}");

        if (!$response->successful()) {
            abort(502, 'Gagal mengambil data dari layanan eksternal');
        }

        $holidays = collect($response->json())->map(function ($holiday) {
            return [
                'date' => $holiday['date'],
                'name' => $holiday['localName'] ?? $holiday['name'],
                'type' => $holiday['types'][0] ?? 'National',
            ];
        })->values()->toArray();

        HolidayCache::updateOrCreate(
            [
                'country_code' => $countryCode,
                'year' => $year,
            ],
            [
                'holidays' => $holidays,
                'fetched_at' => now(),
                'expires_at' => now()->addDays(30),
            ]
        );

        return [
            'year' => $year,
            'country' => $countryCode,
            'holidays' => $holidays,
        ];
    }
}