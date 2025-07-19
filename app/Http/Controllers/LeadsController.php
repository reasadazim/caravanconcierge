<?php

namespace App\Http\Controllers;

use App\Models\Leads;
use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;
use App\Exports\LeadsExport;
use Maatwebsite\Excel\Facades\Excel;

class LeadsController extends Controller
{

    public function index()
    {
        return view('admin.leads');
    }

    public function getData(Request $request)
    {
        $query = Leads::query();

        if ($request->filled('lead_status')) {
            $query->where('lead_status', $request->lead_status);
        }

        if ($request->filled('lead_score')) {
            $query->where('lead_score', $request->lead_score);
        }

        return DataTables::of($query)->make(true);
    }

    public function export(Request $request)
    {
        return Excel::download(new LeadsExport($request), 'leads.xlsx');
    }


}
