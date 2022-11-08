<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use Inertia\Inertia;

class AnalysisController extends Controller
{
    public function index(){

        $start_date = '2022-10-01';
        $end_date = '2022-10-31';

        $period = Order::betweenDate($start_date, $end_date)
            ->groupBy('id')
            ->selectRaw('id, sum(subtotal) as total, customer_name, status, created_at')
            ->orderBy('created_at')
            ->paginate(50);
        // dd($period);
    
        $subQuery = Order::betweenDate($start_date, $end_date)
            ->where('status', true)
            ->GroupBy('id')
            ->selectRaw('id, sum(subtotal) as totalPerPurchase, DATE_FORMAT(created_at, "%Y%m%d") as date');

        $data = DB::table($subQuery)
            ->groupBy('date')
            ->selectRaw('date, sum(totalPerPurchase) as total')
            ->orderBy('date')
            ->get();

        // dd($data);

        return Inertia::render('Analysis');
    }

}
