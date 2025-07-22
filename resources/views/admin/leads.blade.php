<x-layouts.app>
    <!-- Breadcrumbs -->
    <div class="mb-3 flex items-center text-sm">
        <a href="{{ route('dashboard') }}"
           class="text-blue-600 dark:text-blue-400 hover:underline">{{ __('Dashboard') }}</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2 text-gray-400" fill="none" viewBox="0 0 24 24"
             stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-gray-500 dark:text-gray-400">{{ __('Leads') }}</span>
    </div>

    <!-- Page Title -->
    <div class="mb-6">
        <div class="flex items-center gap-2">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ __('Leads') }}</h1>
        </div>
        <p class="text-gray-600 dark:text-gray-400 mt-1">{{ __('Manage your leads here.') }}</p>
    </div>

    <!-- Page Content -->
    <div class="py-6">
        <div class="max-w-12xl mx-auto sm:px-0 lg:px-0">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden mb-6">
                <div class="p-6">


                    <div class="row mb-3">
                        <div class="col-12 text-end">
                            <!-- Import Excel -->
                            <a href="#" class="btn btn-dark">
                                <div class="flex items-center gap-2">
                                    <iconify-icon icon="mdi:database-import-outline" class="text-xl text-neutral-50 dark:text-neutral-50"></iconify-icon>
                                    Import
                                </div>
                            </a>
                            <!-- Export Excel -->
                            <a href="{{ route("leads.export") }}" class="btn btn-dark">
                                <div class="flex items-center gap-2">
                                    <iconify-icon icon="mdi:microsoft-excel" class="text-xl text-neutral-50 dark:text-neutral-50"></iconify-icon>
                                    Export
                                </div>
                            </a>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <div class="flex items-center gap-2">
                                    <iconify-icon icon="mingcute:user-add-line" class="text-xl text-neutral-50 dark:text-neutral-50"></iconify-icon>
                                    Add New Lead
                                </div>
                            </button>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 font-bold" id="exampleModalLabel">Add New Lead</h1>
                                        <button type="button" class="btn-close red" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        {{-- Add Lead Form --}}
                                        <form action="{{ route('leads.store') }}" method="POST" class="container mt-1" enctype="multipart/form-data">
                                            @csrf

                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Name <span class="required">*</span></label>
                                                    <input type="text" name="name" class="form-control" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Email <span class="required">*</span></label>
                                                    <input type="email" name="email" class="form-control" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Phone <span class="required">*</span></label>
                                                    <input type="text" name="phone" class="form-control" required>
                                                </div>

                                                <input type="text" name="country" value="Australia" class="form-control" required hidden="">

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
                                                    <label class="form-label">Storage Type</label>
                                                    <select name="storage_type" class="form-select">
                                                        <option value="">Select Storage Type</option>
                                                        <option value="Outdoor">Outdoor</option>
                                                        <option value="Covered">Covered</option>
                                                        <option value="Indoor">Indoor</option>
                                                    </select>
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
                                                    <label class="form-label">Vehicle Model</label>
                                                    <input type="text" name="vehicle_model" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Vehicle Length</label>
                                                    <input type="number" name="vehicle_length" class="form-control" step="0.01">
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
                                                    <label for="formFileMultiple" class="form-label">Asset Photos</label>
                                                    <input class="form-control" name="asset_photo[]" type="file" id="formFileMultiple" multiple>
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="formFileMultiple1" class="form-label">Driver License</label>
                                                    <input class="form-control" name="driver_license[]" type="file" id="formFileMultiple1" multiple>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Emergency Contact Name</label>
                                                    <input type="text" name="emergency_contact_name" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Emergency Contact Phone</label>
                                                    <input type="text" name="emergency_contact_phone" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Emergency Contact Address</label>
                                                    <input type="text" name="emergency_contact_address" class="form-control">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Remarks</label>
                                                    <textarea name="remarks" rows="3" class="form-control"></textarea>
                                                </div>

                                                <div class="col-12 text-end">
                                                    <button type="submit" class="btn btn-primary mt-3">
                                                        <div class="flex items-center gap-2">
                                                            <iconify-icon icon="lucide:save" class="text-xl text-neutral-50 dark:text-neutral-50"></iconify-icon>
                                                            Save
                                                        </div>
                                                    </button>
                                                </div>

                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <select id="statusFilter" class="form-select">
                                <option value="">Status</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <select id="scoreFilter" class="form-select">
                                <option value="">Score</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <select id="stateFilter" class="form-select">
                                <option value="">State</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <select id="suburbFilter" class="form-select">
                                <option value="">Suburb</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <button id="resetFilters" class="btn btn-dark">
                                <div class="flex items-center gap-2">
                                    <iconify-icon icon="ri:reset-right-fill" class="text-xl text-neutral-50 dark:text-neutral-50"></iconify-icon>
                                    Reset
                                </div>
                            </button>
                        </div>

                    </div>

                    <div class="table-responsive">
                        <div class="dataTables_wrapper">
                            <table id="leads-table" class="table table-striped table-bordered mt-3 mb-3" style="width:100%">
                                <thead class="table-dark">
                                <tr>
                                    {{--                                    <th>SL</th>--}}
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    {{--                                    <th>Country</th>--}}
                                    <th>Street</th>
                                    <th>Suburb</th>
                                    <th>State</th>
                                    <th>Postcode</th>
                                    {{--                                    <th>Type</th>--}}
                                    <th>Storage Type</th>
                                    <th>Vehicle Type</th>
                                    {{--                                    <th>Vehicle Model</th>--}}
                                    {{--                                    <th>Estimated Value</th>--}}
                                    <th>Rego Number</th>
                                    <th>Status</th>
                                    <th>Score</th>
                                    {{--                                    <th>Priority</th>--}}
                                    {{--                                    <th>Emergency Name</th>--}}
                                    {{--                                    <th>Emergency Phone</th>--}}
                                    {{--                                    <th>Emergency Address</th>--}}
                                    {{--                                    <th>Remarks</th>--}}
                                    {{--                                    <th>Added to Waitlist</th>--}}
                                    {{--                                    <th>Last Contact</th>--}}
                                    {{--                                    <th>Contact Method</th>--}}
                                    {{--                                    <th>Follow-up</th>--}}
                                    {{--                                    <th>Contact Remarks</th>--}}
                                    {{--                                    <th>Created</th>--}}
                                    {{--                                    <th>Updated</th>--}}

                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    {{-- Toast message --}}
                    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
                        <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    Form submitted successfully!
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>


                    @push('scripts')

                        <style>
                            .dataTables_filter {
                                float: right !important;
                            }

                            .dataTables_paginate .pagination {
                                justify-content: flex-end;
                            }

                            .dataTables_length, .dataTables_info {
                                margin-top: 10px;
                            }
                        </style>


                        <script>
                            let table;
                            $(function () {
                                table = $('#leads-table').DataTable({
                                    processing: true,
                                    serverSide: true,
                                    responsive: true,
                                    // dom: '<"d-flex justify-content-between"lBf>rt<"d-flex justify-content-between"ip>', // show export button - only filtered data
                                    lengthMenu: [10, 25, 50, 100, 500, 1000, 5000, 10000],
                                    ajax: {
                                        url: '{{ route("leads.data") }}',
                                        data: function (d) {
                                            d.status = $('#statusFilter').val();
                                            d.score = $('#scoreFilter').val();
                                            d.state = $('#stateFilter').val();
                                            d.suburb = $('#suburbFilter').val();
                                        }
                                    },
                                    columns: [
                                        // { data: 'id' },
                                        { data: 'name' },
                                        { data: 'email' },
                                        { data: 'phone' },
                                        // { data: 'country' },
                                        { data: 'street' },
                                        { data: 'suburb' },
                                        { data: 'state' },
                                        { data: 'postcode' },
                                        { data: 'storage_type' },
                                        { data: 'vehicle_type' },
                                        // { data: 'vehicle_model' },
                                        // { data: 'vehicle_estimated_value' },
                                        { data: 'rego_number' },
                                        // { data: 'type' },
                                        {
                                            data: 'status',
                                            render: function (data) {
                                                const statusMap = {
                                                    1: { label: 'New Lead', class: 'bg-zinc-600' },
                                                    2: { label: 'Contacted', class: 'bg-blue-700' },
                                                    3: { label: 'NR1', class: 'bg-orange-500' },
                                                    4: { label: 'NR2', class: 'bg-yellow-600' },
                                                    5: { label: 'NR3', class: 'bg-rose-500' },
                                                    6: { label: 'Engaged', class: 'bg-violet-500' },
                                                    7: { label: 'Won', class: 'bg-green-600' },
                                                    8: { label: 'Closed', class: 'bg-red-600' }
                                                };

                                                const status = statusMap[data] || { label: 'Unknown', class: 'bg-gray-800' };
                                                return `<span class="text-white text-xs font-small px-2 py-1 rounded-full ${status.class}">${status.label}</span>`;
                                            }
                                        },
                                        {
                                            data: 'score',
                                            render: function (data, type, row) {
                                                let stars = '';
                                                const score = parseInt(data) || 0;
                                                for (let i = 1; i <= 5; i++) {
                                                    if (i <= score) {
                                                        stars += '<iconify-icon icon="emojione-monotone:star" class="text-amber-500 inline-block"></iconify-icon>';
                                                    } else {
                                                        stars += '<iconify-icon icon="emojione-monotone:star" class="text-gray-400 inline-block"></iconify-icon>';
                                                    }
                                                }
                                                return `<span class="whitespace-nowrap">${stars}</span>`;
                                            },
                                            orderable: false,
                                            searchable: false,
                                        }

                                        // { data: 'priority' },
                                        // { data: 'emergency_contact_name' },
                                        // { data: 'emergency_contact_phone' },
                                        // { data: 'emergency_contact_address' },
                                        // { data: 'remarks' },
                                        // { data: 'added_to_waitlist' },
                                        // { data: 'last_contact_datetime' },
                                        // { data: 'contact_method' },
                                        // { data: 'followup_reminder' },
                                        // { data: 'contact_remarks' },
                                        // { data: 'created_at' },
                                        // { data: 'updated_at' }
                                    ],

                                    initComplete: function () {
                                        populateFilters(table);
                                    }
                                });

                                // Reload on filter change
                                $('#statusFilter, #scoreFilter, #stateFilter, #suburbFilter').on('change', function () {
                                    table.ajax.reload();
                                });

                                // Reset Filters
                                $('#resetFilters').click(function () {
                                    $('#statusFilter, #scoreFilter, #stateFilter, #suburbFilter').val('');
                                    table.ajax.reload();
                                });


                                function populateFilters() {
                                    $.ajax({
                                        url: '{{ route("leads.filters") }}',
                                        method: 'GET',
                                        success: function (data) {
                                            // Clear old options
                                            $('#statusFilter, #scoreFilter, #stateFilter, #suburbFilter').find('option:not(:first)').remove();

                                            const statusLabels = {
                                                1: 'New Lead',
                                                2: 'Contacted',
                                                3: 'NR1',
                                                4: 'NR2',
                                                5: 'NR3',
                                                6: 'Engaged',
                                                7: 'Won',
                                                8: 'Closed'
                                            };

                                            data.status.forEach(val => {
                                                const label = statusLabels[val] || val;
                                                $('#statusFilter').append(`<option value="${val}">${label}</option>`);
                                            });

                                            data.score.forEach(val => {
                                                $('#scoreFilter').append(`<option value="${val}">${val}</option>`);
                                            });

                                            data.state.forEach(val => {
                                                $('#stateFilter').append(`<option value="${val}">${val}</option>`);
                                            });

                                            data.suburb.forEach(val => {
                                                $('#suburbFilter').append(`<option value="${val}">${val}</option>`);
                                            });
                                        },
                                        error: function () {
                                            console.error('Failed to fetch filter options.');
                                        }
                                    });
                                }


                            });
















                            document.addEventListener("DOMContentLoaded", function () {
                                const form = document.querySelector('form[action="{{ route('leads.store') }}"]');

                                form.addEventListener("submit", function (e) {
                                    e.preventDefault();

                                    const formData = new FormData(form);

                                    fetch(form.action, {
                                        method: "POST",
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                                        },
                                        body: formData
                                    })
                                        .then(response => {
                                            if (!response.ok) throw new Error('Form submission failed');
                                            return response.json();
                                        })
                                        .then(data => {
                                            // Set toast message from response
                                            const toastBody = document.querySelector('#successToast .toast-body');
                                            toastBody.textContent = data.message || 'Form submitted successfully.';

                                            // Show toast
                                            const toastEl = document.getElementById('successToast');
                                            const toast = new bootstrap.Toast(toastEl);
                                            toast.show();

                                            // Hide modal (assuming modal ID is #leadModal)
                                            const modalEl = document.getElementById('exampleModal');
                                            const modal = bootstrap.Modal.getInstance(modalEl); // get existing modal instance
                                            if (modal) modal.hide();

                                            table.ajax.reload();

                                            form.reset(); // Clear form
                                        })
                                        .catch(error => {
                                            console.error(error);
                                            alert("There was an error submitting the form.");
                                        });
                                });
                            });
                        </script>
                    @endpush

                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
