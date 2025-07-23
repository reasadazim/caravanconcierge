<x-layouts.app>

    {{-- Breadcrumbs --}}

    <div class="mb-3 flex items-center text-sm">
        <a href="{{ route('dashboard') }}"
           class="text-blue-600 dark:text-blue-400 hover:underline">{{ __('Dashboard') }}</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2 text-gray-400" fill="none" viewBox="0 0 24 24"
             stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-gray-500 dark:text-gray-400">{{ __('Leads') }}</span>
    </div>

    {{-- END - Breadcrumbs --}}

    {{-- Page Title --}}

    <div class="mb-6">
        <div class="flex items-center gap-2">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ __('Leads') }}</h1>
        </div>
        <p class="text-gray-600 dark:text-gray-400 mt-1">{{ __('Manage your leads here.') }}</p>
    </div>

    {{-- END - Page Title --}}

    {{-- Page Content --}}

    {{-- Add new lead toast message --}}

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999; margin-top: 70px;">
        <div id="successToast" class="toast align-items-center border-0 text-white" role="alert"
             aria-live="assertive" aria-atomic="true" style="background-color: #009966 !important;">
            <div class="d-flex">
                <div class="toast-body">
                    Form submitted successfully!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
            </div>
        </div>
    </div>

    {{-- END - Add new lead toast message --}}

    {{-- Update lead toast message --}}

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999; margin-top: 70px;">
        <div id="updateToast" class="toast align-items-center border-0 text-white" role="alert"
             aria-live="assertive" aria-atomic="true" style="background-color: #009966 !important;">
            <div class="d-flex">
                <div class="toast-body">
                    Lead updated successfully!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
            </div>
        </div>
    </div>

    {{-- END - Update lead toast message --}}

    {{-- Delete lead toast message --}}

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999; margin-top: 80px;">
        <div id="deleteToast" class="toast align-items-center border-0 text-white" role="alert"
             aria-live="assertive" aria-atomic="true" style="background-color: #009966 !important;">
            <div class="d-flex">
                <div class="toast-body">
                    Lead deleted successfully!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
            </div>
        </div>
    </div>

    {{-- END - Delete lead toast message --}}

    {{-- Import lead toast message --}}

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999; margin-top: 80px;">
        <div id="importToast" class="toast align-items-center border-0 text-white" role="alert"
             aria-live="assertive" aria-atomic="true" style="background-color: #009966 !important;">
            <div class="d-flex">
                <div class="toast-body" id="importToastMessage">
                    Lead imported successfully!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
            </div>
        </div>
    </div>

    {{-- END - Import lead toast message --}}



    {{-- Import lead toast error message --}}

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999; margin-top: 80px;">
        <div id="errorToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <svg aria-hidden="true" class="bd-placeholder-img rounded me-2" height="20" width="20"
                     xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice">
                    <rect width="100%" height="100%" fill="#DC143C"></rect>
                </svg>
                <strong class="me-auto text-danger">Error!</strong>
                <small class="text-body-secondary"></small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="errorToastBody">
                <!-- Error message will be injected here -->
            </div>
        </div>
    </div>
    {{-- END - Import lead toast error message --}}





    <div class="py-6">
        <div class="max-w-12xl mx-auto sm:px-0 lg:px-0">
            <div
                class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden mb-6">
                <div class="p-6">


                    <div class="row mb-3">
                        <div class="col-12 text-end">

                            {{-- Import Excel --}}

                            <a href="#" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#importModal">
                                <div class="flex items-center gap-2">
                                    <iconify-icon icon="mdi:database-import-outline"
                                                  class="text-xl text-neutral-50 dark:text-neutral-50"></iconify-icon>
                                    Import
                                </div>
                            </a>

                            @include('admin.leads.partials.import')

                            {{-- END - Import Excel --}}

                            {{-- Export Excel --}}

                            <a href="{{ route("leads.export") }}" class="btn btn-dark">
                                <div class="flex items-center gap-2">
                                    <iconify-icon icon="mdi:microsoft-excel"
                                                  class="text-xl text-neutral-50 dark:text-neutral-50"></iconify-icon>
                                    Export
                                </div>
                            </a>

                            {{-- END - Export Excel --}}

                            {{-- Modal trigger button --}}

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                <div class="flex items-center gap-2">
                                    <iconify-icon icon="mingcute:user-add-line"
                                                  class="text-xl text-neutral-50 dark:text-neutral-50"></iconify-icon>
                                    Add New Lead
                                </div>
                            </button>

                            {{-- END - Modal trigger button --}}

                        </div>

                        {{-- Modal - Add New Lead --}}

                        @include('admin.leads.partials.add-new-lead')

                        {{-- END -  Modal - Add New Lead --}}

                        {{-- Lead list datatable filters --}}
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
                                    <iconify-icon icon="ri:reset-right-fill"
                                                  class="text-xl text-neutral-50 dark:text-neutral-50"></iconify-icon>
                                    Reset
                                </div>
                            </button>
                        </div>
                        {{-- END - Lead list datatable filters --}}

                    </div>

                    {{-- Lead list datatable --}}

                    <div class="table-responsive">
                        <div class="dataTables_wrapper">
                            <table id="leads-table" class="table table-striped table-bordered mt-3 mb-3"
                                   style="width:100%">
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

                    {{-- END - Lead list datatable --}}


                    {{-- Edit Lead Form --}}

                    @include('admin.leads.partials.edit-lead')

                    {{-- END - Edit Lead Form --}}

                    @push('scripts')

                        {{-- Include jQuery & DataTables --}}

                        <link href="{{ asset('css/dataTables/dataTables.bootstrap5.css') }}" rel="stylesheet"/>

                        <script src="{{ asset('js/jquery/jquery-3.7.1.js') }}"></script>
                        <script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
                        <script src="{{ asset('js/datatables/dataTables.js') }}"></script>
                        <script src="{{ asset('js/datatables/dataTables.bootstrap5.js') }}"></script>
                        {{--                        <script src="{{ asset('js/datatables/dataTables.buttons.min.js') }}"></script>--}}
                        {{--                        <script src="{{ asset('js/datatables/jszip.min.js') }}"></script>--}}
                        {{--                        <script src="{{ asset('js/datatables/buttons.html5.min.js') }}"></script>--}}

                        {{-- Lightbox2 --}}
                        <link href="{{ asset('lightbox/lightbox.min.css') }}" rel="stylesheet"/>
                        <script src="{{ asset('lightbox/lightbox.min.js') }}"></script>

                        {{-- Leads --}}
                        <script src="{{ asset('js/leads/leads.js') }}"></script>

                    @endpush

                </div>
            </div>
        </div>
    </div>

    {{-- END - Page Content --}}

</x-layouts.app>
