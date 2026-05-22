<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function monthly(string $year, string $month)
    {
        return response()->json([
            'year' => $year,
            'month' => $month,
            'message' => 'Laporan ERP berhasil dibuat'
        ]);
    }
}