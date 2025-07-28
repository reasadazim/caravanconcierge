
{{-- Modal - Add New Lead --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-blue-600 text-neutral-50">
                <h1 class="modal-title fs-5 font-bold" id="exampleModalLabel">Add New Lead</h1>
                <button type="button" class="btn-close" style="filter: invert(1);" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                {{-- Add Lead Form --}}
                <form id="addNewLead" method="POST" class="container mt-1" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Name <span
                                    class="required">*</span></label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email <span
                                    class="required">*</span></label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone <span
                                    class="required">*</span></label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>

                        <input type="text" name="country" value="Australia" class="form-control"
                               required hidden="">

                        <div class="col-md-6">
                            <label class="form-label">Street</label>
                            <input type="text" name="street" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Suburb</label>
                            <input type="text" name="suburb" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">State</label>
                            <select name="state" class="form-select">
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
                            <input type="text" name="postcode" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Vehicle Type</label>
                            <select name="vehicle_type" class="form-select">
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
                            <input type="number" name="vehicle_length" class="form-control"
                                   step="0.01">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Rego Number</label>
                            <input type="text" name="rego_number" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
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
                            <select name="score" class="form-select">
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
                            <label for="formFileMultiple" class="form-label">Asset
                                Photos</label>
                            <input class="form-control" name="asset_photo[]" type="file"
                                   id="formFileMultiple" multiple>
                        </div>

                        <div class="col-md-12">
                            <label for="formFileMultiple1" class="form-label">Driver
                                License</label>
                            <input class="form-control" name="driver_license[]" type="file"
                                   id="formFileMultiple1" multiple>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Emergency Contact Name</label>
                            <input type="text" name="emergency_contact_name"
                                   class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Emergency Contact Phone</label>
                            <input type="text" name="emergency_contact_phone"
                                   class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Emergency Contact Address</label>
                            <input type="text" name="emergency_contact_address"
                                   class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Remarks</label>
                            <textarea name="remarks" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Last Contact Date and Time</label>
                            <input type="datetime-local" name="last_contact_datetime" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Contact Method</label>
                            <select name="contact_method" class="form-select">
                                <option value="">Select Contact Method</option>
                                <option value="Phone">Phone</option>
                                <option value="SMS">SMS</option>
                                <option value="Email">Email</option>
                                <option value="In Person">In Person</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Followup Reminder Date and Time</label>
                            <input type="datetime-local" name="followup_reminder" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Contact Remarks</label>
                            <textarea name="contact_remarks" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="modal-footer text-end">
                            <button type="submit" class="btn btn-primary">
                                <div class="flex items-center gap-2">
                                    <iconify-icon icon="lucide:save"
                                                  class="text-xl text-neutral-50 dark:text-neutral-50"></iconify-icon>
                                    Save
                                </div>
                            </button>
                        </div>

                    </div>
                </form>
                {{-- END - Add Lead Form --}}
            </div>
        </div>
    </div>
</div>
{{-- END -  Modal - Add New Lead --}}
