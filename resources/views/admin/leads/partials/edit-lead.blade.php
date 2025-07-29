{{-- Edit Lead Form --}}

<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-lg"> <!-- Made it larger -->
        <div class="modal-content">
            <div class="modal-header bg-blue-600 text-neutral-50">
                <h1 class="modal-title fs-5 font-bold" id="exampleModalLabel">Lead Information</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter: invert(1);" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Loader -->
                <div id="showLeadLoading" class="text-center py-4">
                    <div class="spinner-border text-primary"></div>
                    <p class="mt-3">Loading lead data...</p>
                </div>

                <!-- Lead Info Table -->
                <div id="showLeadContent" class="table-responsive" style="display: none;">
                    <table class="table table-bordered table-sm table-striped">
                        <tbody>
                        <tr><th>Name</th><td id="showLeadName"></td></tr>
                        <tr><th>Email</th><td id="showLeadEmail"></td></tr>
                        <tr><th>Phone</th><td id="showLeadPhone"></td></tr>
                        <tr><th>Country</th><td id="showLeadCountry"></td></tr>
                        <tr><th>Street</th><td id="showLeadStreet"></td></tr>
                        <tr><th>Suburb</th><td id="showLeadSuburb"></td></tr>
                        <tr><th>State</th><td id="showLeadState"></td></tr>
                        <tr><th>Postcode</th><td id="showLeadPostcode"></td></tr>
                        <tr><th>Vehicle Type</th><td id="showLeadVehicleType"></td></tr>
                        <tr><th>Vehicle Length</th><td id="showLeadVehicleLength"></td></tr>
                        <tr><th>Rego Number</th><td id="showLeadRegoNumber"></td></tr>
                        <tr><th>Status</th><td id="showLeadStatus"></td></tr>
                        <tr><th>Score</th><td id="showLeadScore"></td></tr>
                        <tr>
                            <th>Photo</th>
                            <td>
                                <div id="showLeadPhoto" class="d-flex flex-wrap gap-2"></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Asset Photos</th>
                            <td>
                                <div id="showLeadAssetPhotos" class="d-flex flex-wrap gap-2"></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Driver License</th>
                            <td>
                                <div id="showLeadDriverLicense" class="d-flex flex-wrap gap-2"></div>
                            </td>
                        </tr>
                        <tr><th>Emergency Contact Name</th><td id="showLeadEmergencyContactName"></td></tr>
                        <tr><th>Emergency Contact Phone</th><td id="showLeadEmergencyContactPhone"></td></tr>
                        <tr><th>Emergency Contact Address</th><td id="showLeadEmergencyContactAddress"></td></tr>
                        <tr><th>Remarks</th><td id="showLeadRemarks"></td></tr>
                        <tr><th>Last Contact Datetime</th><td id="showLastContactDateTime"></td></tr>
                        <tr><th>Contact Method</th><td id="showContactMethod"></td></tr>
                        <tr><th>Followup Reminder</th><td id="showFolloupReminder"></td></tr>
                        <tr><th>Contact Remarks</th><td id="showContactRemarks"></td></tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <input type="hidden" id="showLeadId">
            <div class="modal-footer">
                <button id="openEditLeadBtn" class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">
                    <div class="flex items-center gap-2">
                        <iconify-icon icon="akar-icons:edit" class="text-xl text-neutral-50 dark:text-neutral-50"></iconify-icon>
                        Edit
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-blue-600 text-neutral-50">
                <h1 class="modal-title fs-5 font-bold" id="exampleModalLabel">Edit Lead</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter: invert(1);" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- Loading spinner --}}
                <div id="editLeadLoading" class="text-center my-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p>Loading lead data...</p>
                </div>

                <form id="editLeadForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editLeadId">

                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" id="edit_name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" id="edit_email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" id="edit_phone" class="form-control" required>
                            </div>
                            <input type="hidden" name="country" value="Australia">
                            <div class="col-md-6">
                                <label class="form-label">Street</label>
                                <input type="text" name="street" id="edit_street" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Suburb</label>
                                <input type="text" name="suburb" id="edit_suburb" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">State</label>
                                <select name="state" id="edit_state" class="form-select">
                                    <option value="">Select State</option>
                                    <option value="NSW">NSW</option>
                                    <option value="VIC">VIC</option>
                                    <option value="QLD">QLD</option>
                                    <option value="SA">SA</option>
                                    <option value="WA">WA</option>
                                    <option value="TAS">TAS</option>
                                    <option value="NT">NT</option>
                                    <option value="ACT">ACT</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Postcode</label>
                                <input type="text" name="postcode" id="edit_postcode" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Vehicle Type</label>
                                <select name="vehicle_type" id="edit_vehicle_type" class="form-select">
                                    <option value="">Select Vehicle Type</option>
                                    <option value="Caravan">Caravan</option>
                                    <option value="Boat">Boat</option>
                                    <option value="Jetski">Jetski</option>
                                    <option value="Motorhome">Motorhome</option>
                                    <option value="Trailer">Trailer</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Vehicle Length</label>
                                <input type="number" step="0.01" name="vehicle_length" id="edit_vehicle_length" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Rego Number</label>
                                <input type="text" name="rego_number" id="edit_rego_number" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select name="status" id="edit_status" class="form-select">
                                    <option value="">Select Status</option>
                                    <option value="1">New Lead</option>
                                    <option value="2">Contacted</option>
                                    <option value="3">NR1</option>
                                    <option value="4">NR2</option>
                                    <option value="5">NR3</option>
                                    <option value="6">Engaged</option>
                                    <option value="7">Won</option>
                                    <option value="8">Closed</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Score</label>
                                <select name="score" id="edit_score" class="form-select">
                                    <option value="">Select Score</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="formFile" class="form-label">Photo</label>
                                <input class="form-control" name="photo" type="file" id="formFile">
                            </div>

                            <div class="col-md-12">
                                <label for="formFileMultiple" class="form-label">Asset Photos</label>
                                <input class="form-control" name="asset_photo[]" type="file" id="formFileMultiple" multiple>
                            </div>

                            <div class="col-md-12">
                                <label for="formFileMultiple1" class="form-label">Driver License</label>
                                <input class="form-control" name="driver_license[]" type="file" id="formFileMultiple1" multiple>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Emergency Contact Name</label>
                                <input type="text" name="emergency_contact_name" id="edit_emergency_contact_name" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Emergency Contact Phone</label>
                                <input type="text" name="emergency_contact_phone" id="edit_emergency_contact_phone" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Emergency Contact Address</label>
                                <input type="text" name="emergency_contact_address" id="edit_emergency_contact_address" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Remarks</label>
                                <textarea name="remarks" rows="3" id="edit_remarks" class="form-control"></textarea>
                            </div>
                            <div class="col-md-4" id="dateTimePickerLastContact">
                                <label class="form-label">Last Contact Date Time</label>
                                <input type="text" name="last_contact_datetime" id="edit_last_contact_datetime" class="form-control" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Contact Method</label>
                                <select name="contact_method" id="edit_contact_method" class="form-select">
                                    <option value="">Select Score</option>
                                    <option value="Phone">Phone</option>
                                    <option value="SMS">SMS</option>
                                    <option value="Email">Email</option>
                                    <option value="In Person">In Person</option>
                                </select>
                            </div>
                            <div class="col-md-4" id="dateTimePickerFollowupReminder">
                                <label class="form-label">Followup Reminder Date Time</label>
                                <input type="text" name="followup_reminder" id="edit_followup_reminder" class="form-control" readonly>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Contact Remarks</label>
                                <textarea name="contact_remarks" rows="3" id="edit_contact_remarks" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <div class="btn btn-dark" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">
                            <div class="flex items-center gap-2">
                                <iconify-icon icon="ri:arrow-go-back-line" class="text-xl text-neutral-50 dark:text-neutral-50"></iconify-icon>
                                Back
                            </div>
                        </div>
                        <button type="button" id="deleteLeadBtn" class="btn btn-danger">
                            <div class="flex items-center gap-2">
                                <iconify-icon icon="material-symbols:delete-outline" class="text-xl text-neutral-50 dark:text-neutral-50"></iconify-icon>
                                Delete
                            </div>
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <div class="flex items-center gap-2">
                                <iconify-icon icon="lucide:save" class="text-xl text-neutral-50 dark:text-neutral-50"></iconify-icon>
                                Update
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- END - Edit Lead Form --}}
