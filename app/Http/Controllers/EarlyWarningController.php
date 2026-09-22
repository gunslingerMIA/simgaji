<?php

namespace App\Http\Controllers;

use App\Services\BudgetProjectionService;
use Illuminate\Http\Request;

class EarlyWarningController extends Controller
{
    protected $projectionService;

    public function __construct(BudgetProjectionService $projectionService)
    {
        $this->projectionService = $projectionService;
    }

    public function index(Request $request)
    {
        $tahun = $request->get('tahun', date('Y'));
        
        $projection = $this->projectionService->calculate($tahun);

        return view('early-warning.index', compact('projection', 'tahun'));
    }
}
