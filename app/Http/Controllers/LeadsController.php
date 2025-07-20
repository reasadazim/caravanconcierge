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

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('score')) {
            $query->where('score', $request->score);
        }

        if ($request->filled('state')) {
            $query->where('state', $request->state);
        }

        if ($request->filled('suburb')) {
            $query->where('suburb', $request->suburb);
        }

        return DataTables::of($query)->make(true);
    }

    public function export(Request $request)
    {
        return Excel::download(new LeadsExport($request), 'leads.xlsx');
    }

    public function getFilterOptions()
    {
        return response()->json([
            'status' => Leads::whereNotNull('status')->distinct()->orderBy('status')->pluck('status'),
            'score' => Leads::whereNotNull('score')->distinct()->orderBy('score')->pluck('score'),
            'state' => Leads::whereNotNull('state')->distinct()->orderBy('state')->pluck('state'),
            'suburb' => Leads::whereNotNull('suburb')->distinct()->orderBy('suburb')->pluck('suburb'),
        ]);
    }



}
