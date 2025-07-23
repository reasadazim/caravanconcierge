<?php

namespace App\Http\Controllers;

use App\Models\Leads;
use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;
use App\Exports\LeadsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

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


    // Add a new lead
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:leads,email',
            'phone' => 'required|string|unique:leads,phone',
            'country' => 'nullable|string',
            'street' => 'nullable|string',
            'suburb' => 'nullable|string',
            'state' => 'nullable|string',
            'postcode' => 'nullable|string',
            'storage_type' => 'nullable|string',
            'vehicle_type' => 'nullable|string',
            'vehicle_model' => 'nullable|string',
            'vehicle_length' => 'nullable|numeric',
            'rego_number' => 'nullable|string',
            'status' => 'nullable|integer',
            'score' => 'nullable|integer',
            'emergency_contact_name' => 'nullable|string',
            'emergency_contact_phone' => 'nullable|string',
            'emergency_contact_address' => 'nullable|string',
            'remarks' => 'nullable|string',
            'photo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'asset_photo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'driver_license' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $lead = new Leads();

        // Basic Fields
        $lead->name = $request->name;
        $lead->email = $request->email;
        $lead->phone = $request->phone;
        $lead->country = $request->country ?? 'Australia';
        $lead->street = $request->street;
        $lead->suburb = $request->suburb;
        $lead->state = $request->state;
        $lead->postcode = $request->postcode;
        $lead->storage_type = $request->storage_type;
        $lead->vehicle_type = $request->vehicle_type;
        $lead->vehicle_model = $request->vehicle_model;
        $lead->vehicle_length = $request->vehicle_length;
        $lead->rego_number = $request->rego_number;
        $lead->status = $request->status;
        $lead->score = $request->score;
        $lead->emergency_contact_name = $request->emergency_contact_name;
        $lead->emergency_contact_phone = $request->emergency_contact_phone;
        $lead->emergency_contact_address = $request->emergency_contact_address;
        $lead->remarks = $request->remarks;

        // Single photo upload
        if ($request->hasFile('photo')) {
            $lead->photo = $request->file('photo')->store('uploads/photos', 'public');
        }

        // Multiple Asset Photos
        $assetPhotos = [];
        if ($request->hasFile('asset_photo')) {
            foreach ($request->file('asset_photo') as $file) {
                $assetPhotos[] = $file->store('uploads/assets', 'public');
            }
        }
        $lead->asset_photo = serialize($assetPhotos);

        // Multiple Driver Licenses
        $driverLicenses = [];
        if ($request->hasFile('driver_license')) {
            foreach ($request->file('driver_license') as $file) {
                $driverLicenses[] = $file->store('uploads/licenses', 'public');
            }
        }
        $lead->driver_license = serialize($driverLicenses);

        $lead->save();

        return response()->json([
            'success' => true,
            'message' => 'Lead added successfully.',
        ]);
    }











    public function show($id)
    {
        $lead = Leads::findOrFail($id);

        $assetPhotos = $lead->asset_photo;
        if (!is_array($assetPhotos)) {
            $assetPhotos = @unserialize($assetPhotos) ?: [];
        }

        $driverLicensePhotos = $lead->driver_license;
        if (!is_array($driverLicensePhotos)) {
            $driverLicensePhotos = @unserialize($driverLicensePhotos) ?: [];
        }

        return response()->json([
            'id' => $lead->id,
            'name' => $lead->name,
            'email' => $lead->email,
            'phone' => $lead->phone,
            'country' => $lead->country,
            'street' => $lead->street,
            'suburb' => $lead->suburb,
            'state' => $lead->state,
            'postcode' => $lead->postcode,
            'storage_type' => $lead->storage_type,
            'vehicle_type' => $lead->vehicle_type,
            'vehicle_model' => $lead->vehicle_model,
            'vehicle_length' => $lead->vehicle_length,
            'rego_number' => $lead->rego_number,
            'status' => $lead->status,
            'score' => $lead->score,
            'emergency_contact_name' => $lead->emergency_contact_name,
            'emergency_contact_phone' => $lead->emergency_contact_phone,
            'emergency_contact_address' => $lead->emergency_contact_address,
            'remarks' => $lead->remarks,
            'photo' => $lead->photo,
            'asset_photos' => $assetPhotos,
            'driver_license_photos' => $driverLicensePhotos,
        ]);
    }

    public function update(Request $request, $id)
    {
        $lead = Leads::findOrFail($id);

        // Manually assign fields one by one
        $lead->name = $request->input('name');
        $lead->email = $request->input('email');
        $lead->phone = $request->input('phone');
        $lead->country = $request->input('country', 'Australia');
        $lead->street = $request->input('street');
        $lead->suburb = $request->input('suburb');
        $lead->state = $request->input('state');
        $lead->postcode = $request->input('postcode');
        $lead->storage_type = $request->input('storage_type');
        $lead->vehicle_type = $request->input('vehicle_type');
        $lead->vehicle_model = $request->input('vehicle_model');
        $lead->vehicle_length = $request->input('vehicle_length');
        $lead->rego_number = $request->input('rego_number');
        $lead->status = $request->input('status');
        $lead->score = $request->input('score');
        $lead->emergency_contact_name = $request->input('emergency_contact_name');
        $lead->emergency_contact_phone = $request->input('emergency_contact_phone');
        $lead->emergency_contact_address = $request->input('emergency_contact_address');
        $lead->remarks = $request->input('remarks');

        // Handle photo upload if exists
        if ($request->hasFile('photo')) {
            $lead->photo = $request->file('photo')->store('uploads/photos', 'public');
        }

        // Handle multiple asset photos (serialized)
        if ($request->hasFile('asset_photo')) {
            $assetPhotos = [];
            foreach ($request->file('asset_photo') as $file) {
                $assetPhotos[] = $file->store('uploads/assets', 'public');
            }
            $lead->asset_photo = serialize($assetPhotos);
        }

        // Handle multiple driver licenses (serialized)
        if ($request->hasFile('driver_license')) {
            $driverLicenses = [];
            foreach ($request->file('driver_license') as $file) {
                $driverLicenses[] = $file->store('uploads/licenses', 'public');
            }
            $lead->driver_license = serialize($driverLicenses);
        }

        $lead->save();

        return response()->json(['success' => true]);
    }


    public function destroy($id)
    {
        Leads::destroy($id);
        return response()->json(['success' => true]);
    }








}
