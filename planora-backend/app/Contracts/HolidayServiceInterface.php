<?php

namespace App\Contracts;

interface HolidayServiceInterface
{
    public function getHolidays(?int $year = null): array;
}
