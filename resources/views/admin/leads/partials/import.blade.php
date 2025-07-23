<!-- Import CSV Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="csvImportForm" action="{{ route('leads.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-blue-600 text-neutral-50">
                    <h1 class="modal-title fs-5 font-bold" id="importModalLabel">Import Leads from CSV</h1>
                    <button type="button" class="btn-close" style="filter: invert(1);" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="csv_file" class="form-label">Choose CSV File</label>
                        <input type="file" name="csv_file" id="csv_file" class="form-control" accept=".csv" required>
                    </div>
                    <div class="text-muted small">Ensure the CSV columns match the lead schema (e.g. name, email, phone, etc). Email and phone should be unique.
                        <a href="/sample/leads-import-demo.csv" target="_blank" class="badge bg-success text-decoration-none">
                            Download import CSV template
                        </a>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <div class="flex items-center gap-2">
                            <iconify-icon icon="mdi:database-import-outline"
                                          class="text-xl text-neutral-50 dark:text-neutral-50"></iconify-icon>
                            Import
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
