
// ################################ Lead List ################################

let table;
$(function () {
    table = $('#leads-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        // dom: '<"d-flex justify-content-between"lBf>rt<"d-flex justify-content-between"ip>', // show export button - only filtered data
        lengthMenu: [10, 25, 50, 100, 500, 1000, 5000, 10000],
        ajax: {
            url: '/leads/data',
            data: function (d) {
                d.status = $('#statusFilter').val();
                d.score = $('#scoreFilter').val();
                d.state = $('#stateFilter').val();
                d.suburb = $('#suburbFilter').val();
            }
        },
        columns: [
            // { data: 'id' },
            {
                data: 'name',
                render: function (data, type, row) {
                    return `<a href="#" class="show-lead-link text-blue-600" data-id="${row.id}">${data}</a>`;
                }
            },
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
                        1: { label: 'New Lead', class: 'bg-sky-700' },
                        2: { label: 'Contacted', class: 'bg-teal-700' },
                        3: { label: 'NR1', class: 'bg-emerald-500' },
                        4: { label: 'NR2', class: 'bg-slate-600' },
                        5: { label: 'NR3', class: 'bg-indigo-500' },
                        6: { label: 'Engaged', class: 'bg-violet-500' },
                        7: { label: 'Won', class: 'bg-green-600' },
                        8: { label: 'Closed', class: 'bg-rose-600' }
                    };

                    const status = statusMap[data] || { label: 'Unknown', class: 'bg-gray-800' };
                    // return `<span class="text-white text-xs font-small px-2 py-1 rounded-full ${status.class}">${status.label}</span>`;
                    return `${status.label}`;
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
            url: '/leads/filters',
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

// ################################ END - Lead List ################################


// ################################ Add New Lead ################################

document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector('form[action="http://dashboard.caravanconcierge.com.au:9991/leads/store"]');

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

// ################################ END - Add New Lead ################################


// ################################ Edit lead ################################

$('#openEditLeadBtn').click(function () {
    const leadId = $('#showLeadId').val();

    // Open modal 2
    // const modal = new bootstrap.Modal(document.getElementById('exampleModalToggle2'));
    // modal.show();

    // Show loading spinner, hide form
    $('#editLeadLoading').show();
    $('#editLeadForm').hide();

    // Fetch lead data
    $.ajax({
        url: `/leads/${leadId}`,
        method: 'GET',
        success: function (data) {
            $('#editLeadId').val(data.id);
            $('#edit_name').val(data.name);
            $('#edit_email').val(data.email);
            $('#edit_phone').val(data.phone);
            $('#edit_street').val(data.street);
            $('#edit_suburb').val(data.suburb);
            $('#edit_state').val(data.state);
            $('#edit_postcode').val(data.postcode);
            $('#edit_storage_type').val(data.storage_type);
            $('#edit_vehicle_type').val(data.vehicle_type);
            $('#edit_vehicle_model').val(data.vehicle_model);
            $('#edit_vehicle_length').val(data.vehicle_length);
            $('#edit_rego_number').val(data.rego_number);
            $('#edit_status').val(data.status);
            $('#edit_score').val(data.score);
            $('#edit_emergency_contact_name').val(data.emergency_contact_name);
            $('#edit_emergency_contact_phone').val(data.emergency_contact_phone);
            $('#edit_emergency_contact_address').val(data.emergency_contact_address);
            $('#edit_remarks').val(data.remarks);

            $('#editLeadLoading').hide();
            $('#editLeadForm').show();
        },
        error: function () {
            $('#editLeadLoading').html('<p class="text-danger">Failed to load lead data.</p>');
        }
    });
});

// ################################ END - Edit Lead ################################

// Initialize toast instances (Bootstrap 5)
const updateToastEl = document.getElementById('updateToast');
const updateToast = new bootstrap.Toast(updateToastEl);

const deleteToastEl = document.getElementById('deleteToast');
const deleteToast = new bootstrap.Toast(deleteToastEl);

// ################################ Update Lead ################################

$('#editLeadForm').submit(function (e) {
    e.preventDefault();
    const leadId = $('#editLeadId').val();
    const formData = new FormData(this);

    $.ajax({
        url: `/leads/update/${leadId}`,
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        success: function (res) {

            //close the modal
            const modalElement = document.getElementById('exampleModalToggle2');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            modalInstance.hide();
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.parentNode.removeChild(backdrop);
            }

            table.ajax.reload(); // reload the table after update
            updateToast.show();  // Show update success toast
        },
        error: function (xhr) {
            console.error(xhr.responseText);
            alert('Update failed.');
        }
    });
});

// ################################ END - Update Lead ################################


// ################################ Delete Lead ################################

$('#deleteLeadBtn').click(function () {
    if (!confirm('Are you sure you want to delete this lead?')) return;
    const leadId = $('#editLeadId').val();

    $.ajax({
        url: `/leads/${leadId}`,
        type: 'DELETE',
        headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() },
        success: function () {

            //close the modal
            const modalElement = document.getElementById('exampleModalToggle2');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            modalInstance.hide();
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.parentNode.removeChild(backdrop);
            }

            table.ajax.reload(); // reload the table after delete data
            deleteToast.show();  // Show delete success toast
        },
        error: function () {
            alert('Delete failed.');
        }
    });
});

// ################################ END - Delete Lead ################################



// ################################ Show lead info ################################

$(document).on('click', '.show-lead-link', function (e) {
    e.preventDefault();

    const leadId = $(this).data('id');
    $('#editLeadId').val(leadId); // For editing later
    $('#showLeadId').val(leadId); // Store lead ID for use in Edit button


    // Open the show modal immediately
    const modal = new bootstrap.Modal(document.getElementById('exampleModalToggle'));
    modal.show();

    $('#showLeadLoading').show();
    $('#showLeadContent').hide();

    // Fetch the lead data
    $.get(`/leads/${leadId}`, function (data) {
        $('#showLeadName').text(data.name || '');
        $('#showLeadEmail').text(data.email || '');
        $('#showLeadPhone').text(data.phone || '');
        $('#showLeadCountry').text(data.country || '');
        $('#showLeadStreet').text(data.street || '');
        $('#showLeadSuburb').text(data.suburb || '');
        $('#showLeadState').text(data.state || '');
        $('#showLeadPostcode').text(data.postcode || '');
        $('#showLeadStorageType').text(data.storage_type || '');
        $('#showLeadVehicleType').text(data.vehicle_type || '');
        $('#showLeadVehicleModel').text(data.vehicle_model || '');
        $('#showLeadVehicleLength').text(data.vehicle_length || '');
        $('#showLeadRegoNumber').text(data.rego_number || '');


        const statusMap = {
            1: 'New Lead',
            2: 'Contacted',
            3: 'NR1',
            4: 'NR2',
            5: 'NR3',
            6: 'Engaged',
            7: 'Won',
            8: 'Closed'
        };

        const statusText = statusMap[data.status] || 'Unknown';
        $('#showLeadStatus').text(statusText);




        const score = parseInt(data.score) || 0;
        let starsHtml = '';

        for (let i = 1; i <= 5; i++) {
            if (i <= score) {
                starsHtml += '<iconify-icon icon="emojione-monotone:star" class="text-amber-500 inline-block"></iconify-icon>';
            } else {
                starsHtml += '<iconify-icon icon="emojione-monotone:star" class="text-gray-400 inline-block"></iconify-icon>';
            }
        }

        $('#showLeadScore').html(starsHtml);




        // Base path for uploaded files
        const basePath = '/storage/';

        // Single photo
        if (data.photo) {
            $('#showLeadPhoto').html(`
                                            <a href="${basePath}${data.photo}" data-lightbox="single-photo">
                                                <img src="${basePath}${data.photo}" class="img-thumbnail custom-thumbnail" style="object-fit: cover;">
                                            </a>
                                        `);
        } else {
            $('#showLeadPhoto').html('<span class="text-muted">No photo</span>');
        }


        // Asset photos
        if (Array.isArray(data.asset_photos) && data.asset_photos.length > 0) {
            $('#showLeadAssetPhotos').html(
                data.asset_photos.map(p => `
                                                <a href="${basePath}${p}" data-lightbox="asset-photos">
                                                    <img src="${basePath}${p}" class="img-thumbnail custom-thumbnail" style="object-fit: cover;">
                                                </a>
                                            `).join('')
            );
        } else {
            $('#showLeadAssetPhotos').html('<span class="text-muted">No asset photos</span>');
        }


        // Driver license photos
        if (Array.isArray(data.driver_license_photos) && data.driver_license_photos.length > 0) {
            $('#showLeadDriverLicense').html(
                data.driver_license_photos.map(p => `
                                                <a href="${basePath}${p}" data-lightbox="license-photos">
                                                    <img src="${basePath}${p}" class="img-thumbnail custom-thumbnail" style="object-fit: cover;">
                                                </a>
                                            `).join('')
            );
        } else {
            $('#showLeadDriverLicense').html('<span class="text-muted">No license photos</span>');
        }


        $('#showLeadEmergencyContactName').text(data.emergency_contact_name || '');
        $('#showLeadEmergencyContactPhone').text(data.emergency_contact_phone || '');
        $('#showLeadEmergencyContactAddress').text(data.emergency_contact_address || '');
        $('#showLeadRemarks').text(data.remarks || '');

        $('#showLeadLoading').hide();
        $('#showLeadContent').show();
    }).fail(function () {
        $('#showLeadLoading').html('<p class="text-danger">Failed to load lead information.</p>');
    });

});

// ################################ END - Show lead info ################################


// ################################ Close overlay of multiple modal ################################

// const modal2 = document.getElementById('exampleModalToggle2');
//
// modal2.addEventListener('hidden.bs.modal', function () {
//     const modals = document.querySelectorAll('.modal.show');
//     if (modals.length === 0) {
//         document.body.classList.remove('modal-open');
//         document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
//     }
// });

// ################################ Close overlay of multiple modal ################################


// ################################ Import Leads CSV file ################################
$('#csvImportForm').on('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const importBtn = $(this).find('button[type="submit"]');

    importBtn.prop('disabled', true).text('Importing...');

    $.ajax({
        url: $(this).attr('action'),
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            $('#importModal').modal('hide');
            $('#csvImportForm')[0].reset();
            importBtn.prop('disabled', false).text('Import');

            // Set success message and show toast
            $('#importToastMessage').text('Leads imported successfully!');
            const toast = new bootstrap.Toast(document.getElementById('importToast'));
            toast.show();

            table.ajax.reload(); // reload the table after delete data
        },
        error: function(xhr) {
            importBtn.prop('disabled', false).text('Import');

            let message = 'Something went wrong.';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                message = xhr.responseJSON.message;
            }

            // Inject message and show toast
            $('#errorToastBody').text(message);
            // const errorToast = new bootstrap.Toast(document.getElementById('errorToast'));
            const errorToast = new bootstrap.Toast(document.getElementById('errorToast'), {
                delay: 30000
            });
            errorToast.show();
            errorToast.show();
        }
    });
});

// ################################ END - Import Leads CSV file ################################
