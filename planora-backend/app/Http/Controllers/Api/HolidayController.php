<?php

namespace App\Http\Controllers\Api;

use App\Contracts\HolidayServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    protected HolidayServiceInterface $holidayService;

    public function __construct(HolidayServiceInterface $holidayService)
    {
        $this->holidayService = $holidayService;
    }

    public function index(Request $request)
    {
        $year = $request->query('year');

        return response()->json([
            'status' => 'success',
            'data' => $this->holidayService->getHolidays($year ? (int) $year : null),
        ]);
    }
}