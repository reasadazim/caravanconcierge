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

        return $query->get([
            'name',
            'email',
            'phone',
            'country',
            'street',
            'suburb',
            'state',
            'postcode',
            'vehicle_type',
            'vehicle_length',
            'rego_number',
            'status',
            'score',
            'emergency_contact_name',
            'emergency_contact_phone',
            'emergency_contact_address',
            'remarks',
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
            'Country',
            'Street',
            'Suburb',
            'State',
            'Postcode',
            'Vehicle Type',
            'Vehicle Length',
            'Rego Number',
            'Status',
            'Score',
            'Emergency Contact Name',
            'Emergency Contact Phone',
            'Emergency Contact Address',
            'Remarks',
            'Last Contact Datetime',
            'Contact Method',
            'Follow-up Reminder',
            'Contact Remarks'
        ];
    }
}
