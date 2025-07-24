<?php

namespace App\Exports;

use App\Models\Leads;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactTrackingExport implements FromCollection, WithHeadings
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

        return $query->get([
            'name',
            'email',
            'phone',
            'status',
            'last_contact_datetime',
            'contact_method',
            'followup_reminder',
            'contact_remarks'
        ]);
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Status',
            'Last Contact Datetime',
            'Contact Method',
            'Follow-up Reminder',
            'Contact Remarks'
        ];
    }
}
