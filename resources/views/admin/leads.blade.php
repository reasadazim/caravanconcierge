<x-layouts.app>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ __('Leads')}}</h1>
{{--        <p class="text-gray-600 dark:text-gray-400 mt-1">{{ __('Welcome to the dashboard') }}</p>--}}
    </div>

    <div class="py-12">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden mb-6">
                <div class="p-6">


                    <div class="row mb-3">
                        <div class="col-auto">
{{--                            <label for="statusFilter" class="form-label">Lead Status</label>--}}
                            <select id="statusFilter" class="form-select">
                                <option value="">Lead Status</option>
                            </select>
                        </div>
                        <div class="col-auto">
{{--                            <label for="scoreFilter" class="form-label">Lead Score</label>--}}
                            <select id="scoreFilter" class="form-select">
                                <option value="">Lead Score</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <button id="resetFilters" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <div class="dataTables_wrapper">
                            <table id="leads-table" class="table table-striped table-bordered" style="width:100%">
                                <thead class="table-dark">
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Country</th>
                                    <th>Street</th>
                                    <th>Suburb</th>
                                    <th>State</th>
                                    <th>Postcode</th>
                                    <th>Storage Type</th>
                                    <th>Vehicle Type</th>
                                    <th>Rego Number</th>
                                    <th>Status</th>
                                    <th>Score</th>
{{--                                    <th>Emergency Name</th>--}}
{{--                                    <th>Emergency Phone</th>--}}
{{--                                    <th>Emergency Address</th>--}}
{{--                                    <th>Remarks</th>--}}
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


                    @push('scripts')
                        <!-- Bootstrap 5 CSS -->
                        {{--            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">--}}

                        <!-- DataTables Bootstrap 5 CSS -->
                        <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

                        <!-- jQuery -->
                        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

                        <!-- Bootstrap JS -->
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

                        <!-- DataTables JS -->
                        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
                        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

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
                            $(function () {
                                let table = $('#leads-table').DataTable({
                                    processing: true,
                                    serverSide: true,
                                    responsive: true,
                                    dom: '<"d-flex justify-content-between"lBf>rt<"d-flex justify-content-between"ip>',
                                    buttons: [
                                        {
                                            extend: 'excelHtml5',
                                            text: 'Export Excel',
                                            className: 'btn btn-success',
                                            action: function (e, dt, button, config) {
                                                window.location.href = '{{ route("leads.export") }}';
                                            }
                                        }
                                    ],
                                    lengthMenu: [10, 25, 50, 100, 500, 1000, 5000, 10000],
                                    ajax: {
                                        url: '{{ route("leads.data") }}',
                                        data: function (d) {
                                            d.lead_status = $('#statusFilter').val();
                                            d.lead_score = $('#scoreFilter').val();
                                        }
                                    },
                                    columns: [
                                        { data: 'id' },
                                        { data: 'lead_name' },
                                        { data: 'lead_email' },
                                        { data: 'lead_phone' },
                                        { data: 'lead_country' },
                                        { data: 'lead_street' },
                                        { data: 'lead_suburb' },
                                        { data: 'lead_state' },
                                        { data: 'lead_postcode' },
                                        { data: 'lead_storage_type' },
                                        { data: 'lead_vehicle_type' },
                                        { data: 'lead_rego_number' },
                                        { data: 'lead_status' },
                                        { data: 'lead_score' },
                                        // { data: 'lead_emergency_contact_name' },
                                        // { data: 'lead_emergency_contact_phone' },
                                        // { data: 'lead_emergency_contact_address' },
                                        // { data: 'lead_remarks' },
                                        // { data: 'lead_last_contact_datetime' },
                                        // { data: 'lead_contact_method' },
                                        // { data: 'lead_followup_reminder' },
                                        // { data: 'lead_contact_remarks' },
                                        // { data: 'created_at' },
                                        // { data: 'updated_at' }
                                    ],
                                    initComplete: function () {
                                        populateFilters(table);
                                    }
                                });

                                $('#statusFilter, #scoreFilter').on('change', function () {
                                    table.ajax.reload();
                                });

                                  // Reset Filters
                                $('#resetFilters').click(function () {
                                    $('#statusFilter, #scoreFilter').val('');
                                    table.ajax.reload();
                                });

                                function populateFilters(table) {
                                    let statusSet = new Set();
                                    let scoreSet = new Set();

                                    table.data().each(function (row) {
                                        if (row.lead_status !== null) statusSet.add(row.lead_status);
                                        if (row.lead_score !== null) scoreSet.add(row.lead_score);
                                    });

                                    statusSet = Array.from(statusSet).sort((a, b) => a - b);
                                    $('#statusFilter').append(statusSet.map(val => `<option value="${val}">${val}</option>`));

                                    scoreSet = Array.from(scoreSet).sort((a, b) => a - b);
                                    $('#scoreFilter').append(scoreSet.map(val => `<option value="${val}">${val}</option>`));
                                }
                            });
                        </script>
                    @endpush

                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
