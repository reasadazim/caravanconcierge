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

        if ($this->request->status !== null) {
            $query->where('status', $this->request->status);
        }

        if ($this->request->score !== null) {
            $query->where('score', $this->request->score);
        }

        if ($this->request->state !== null) {
            $query->where('state', $this->request->state);
        }

        if ($this->request->suburb !== null) {
            $query->where('suburb', $this->request->suburb);
        }

        return $query->get();
    }


    public function headings(): array
    {
        return (new Leads)->getFillable();
    }
}
