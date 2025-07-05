<?php

namespace App\Http\Controllers;

use App\Models\Leads;
use Illuminate\Http\Request;

class LeadsController extends Controller
{
    // Leads
    public function leads()
    {
        $leads = Leads::All();

        return view('admin.leads')->with('leads', $leads);
    }
}
