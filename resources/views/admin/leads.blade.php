<x-layouts.app>

    <div class="mb-6">
        <div class="flex items-center gap-2">
            <iconify-icon icon="mynaui:users" class="w-6 h-6 text-gray-800 dark:text-gray-100 text-2xl"></iconify-icon>
            <h1 class="text-2xl text-gray-800 dark:text-gray-100">{{ __('Leads') }}</h1>
        </div>

        {{--        <p class="text-gray-600 dark:text-gray-400 mt-1">{{ __('Welcome to the dashboard') }}</p>--}}
    </div>

    <div class="py-6">
        <div class="max-w-12xl mx-auto sm:px-0 lg:px-0">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden mb-6">
                <div class="p-6">


                    <div class="row mb-3">
                        <div class="col-12 text-end">
                            <!-- Export to Excel -->
                            <a href="{{ route("leads.export") }}" class="btn btn-secondary">
                                <div class="flex items-center gap-2">
                                    <iconify-icon icon="file-icons:microsoft-excel" class="text-xl text-neutral-50 dark:text-neutral-50"></iconify-icon>
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

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
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
                            <button id="resetFilters" class="btn btn-secondary">Reset</button>
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
                            $(function () {
                                let table = $('#leads-table').DataTable({
                                    processing: true,
                                    serverSide: true,
                                    responsive: true,
                                    dom: '<"d-flex justify-content-between"lBf>rt<"d-flex justify-content-between"ip>',
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
                        </script>
                    @endpush

                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
