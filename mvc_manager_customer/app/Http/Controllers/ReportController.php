<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{public function showContract(): View
{
    $currentYear = Carbon::now()->year;

    $monthlyData = DB::table('contracts')
        ->selectRaw('MONTH(signed_date) as month, COUNT(*) as total')
        ->whereYear('signed_date', $currentYear)
        ->groupBy(DB::raw('MONTH(signed_date)'))
        ->pluck('total', 'month')
        ->toArray();

    $months = range(1, 12);
    $monthlyContracts = [];
    foreach ($months as $month) {
        $monthlyContracts[] = $monthlyData[$month] ?? 0;
    }

    $yearlyData = DB::table('contracts')
        ->selectRaw('YEAR(signed_date) as year, COUNT(*) as total')
        ->groupBy(DB::raw('YEAR(signed_date)'))
        ->orderBy('year')
        ->pluck('total', 'year')
        ->toArray();

    return view('page.report.contract', [
        'monthlyContracts' => $monthlyContracts,
        'yearlyContracts' => array_values($yearlyData),
        'years' => array_keys($yearlyData),
        'currentYear' => $currentYear,
    ]);
}


    public function showTransaction(): View
    {
        $currentYear = Carbon::now()->year;

        $monthlyData = DB::table('transactions')
            ->selectRaw('MONTH(transaction_date) as month, SUM(amount) as total')
            ->whereYear('transaction_date', $currentYear)
            ->groupBy(DB::raw('MONTH(transaction_date)'))
            ->pluck('total', 'month')
            ->toArray();

        $months = range(1, 12);
        $monthlyAmounts = [];
        foreach ($months as $month) {
            $monthlyAmounts[] = $monthlyData[$month] ?? 0;
        }

        $yearlyData = DB::table('transactions')
            ->selectRaw('YEAR(transaction_date) as year, SUM(amount) as total')
            ->groupBy(DB::raw('YEAR(transaction_date)'))
            ->orderBy('year')
            ->pluck('total', 'year')
            ->toArray();

        return view('page.report.transaction', [
            'monthlyAmounts' => $monthlyAmounts,
            'yearlyAmounts' => array_values($yearlyData),
            'years' => array_keys($yearlyData),
            'currentYear' => $currentYear,
        ]);
    }
}
