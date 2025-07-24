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
            'type',
            'storage_type',
            'vehicle_type',
            'vehicle_length',
            'vehicle_model',
            'vehicle_estimated_value',
            'rego_number',
            'status',
            'score',
            'priority',
            'emergency_contact_name',
            'emergency_contact_phone',
            'emergency_contact_address',
            'remarks',
            'added_to_waitlist',
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
            'Type',
            'Storage Type',
            'Vehicle Type',
            'Vehicle Length',
            'Vehicle Model',
            'Vehicle Estimated Value',
            'Rego Number',
            'Status',
            'Score',
            'Priority',
            'Emergency Contact Name',
            'Emergency Contact Phone',
            'Emergency Contact Address',
            'Remarks',
            'Added to Waitlist',
            'Last Contact Datetime',
            'Contact Method',
            'Follow-up Reminder',
            'Contact Remarks'
        ];
    }
}
