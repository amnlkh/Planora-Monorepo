<?php

namespace Tests\Unit; // Harus sesuai folder (tests/Unit)

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardServiceTest extends TestCase // Nama class harus sama dengan nama file
{
    use RefreshDatabase;

    public function test_it_returns_correct_statistics_for_user(): void
    {
        $this->assertTrue(true); // Test dummy untuk verifikasi
    }
}