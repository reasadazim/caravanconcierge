<?php

namespace App\Exports;

use App\Models\Leads;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LeadsExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Leads::query();

        if ($this->request->lead_status !== null) {
            $query->where('lead_status', $this->request->lead_status);
        }

        if ($this->request->lead_score !== null) {
            $query->where('lead_score', $this->request->lead_score);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return (new Leads)->getFillable();
    }
}
