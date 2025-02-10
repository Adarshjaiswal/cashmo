<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Packages</h4>
                        </div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPackageModal">Add Package</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table" data-toggle="data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>PACKAGE NAME</th>
                                        <th>RECHARGE AND BILLS</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Adding Package -->
        <div class="modal fade" id="addPackageModal" tabindex="-1" aria-labelledby="addPackageModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPackageModalLabel">Add Package</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addPackageForm">
                            @csrf
                            <div class="mb-3">
                                <label for="package_name" class="form-label">Package Name</label>
                                <input type="text" class="form-control" id="package_name" name="package_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Package</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Edit Modal -->
<div class="modal fade" id="editPackageModal" tabindex="-1" aria-labelledby="editPackageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPackageModalLabel">Edit Package</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPackageForm">
                    @csrf
                    <input type="hidden" id="edit_package_id" name="id">
                    <div class="mb-3">
                        <label for="edit_package_name" class="form-label">Package Name</label>
                        <input type="text" class="form-control" id="edit_package_name" name="package_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Status</label>
                        <select class="form-select" id="edit_status" name="status" required>
                            <option value="1">Enable</option>
                            <option value="0">Disable</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Package</button>
                </form>
            </div>
        </div>
    </div>
</div>

    </div>
</x-app-layout>

<script>
function fetchPackages(){
    if ($.fn.DataTable.isDataTable('#datatable')) {
        $('#datatable').DataTable().destroy();
    }

    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("packages.data") }}',
            type: 'GET',
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'package_name', name: 'package_name' },
            { data: 'recharge_and_bills', name: 'recharge_and_bills' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action' },
        ]
    });
}

function toggleStatus(packageId, newStatus) {
    $.ajax({
        url: '/admin/package/toggle-status',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            id: packageId,
            status: newStatus
        },
        success: function(response) {
            if(response.success) {
                $('#datatable').DataTable().ajax.reload();
                Swal.fire({
                    icon: 'success',
                    title: 'Status Updated',
                    text: response.message,
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to update status',
                timer: 2000,
                showConfirmButton: false
            });
        }
    });
}

$('#addPackageForm').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        url: '{{ route("packages.store") }}',
        method: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            if(response.success) {
                $('#addPackageModal').modal('hide');
                $('#datatable').DataTable().ajax.reload();
                Swal.fire({
                    icon: 'success',
                    title: 'Package Added',
                    text: response.message,
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to add package',
                timer: 2000,
                showConfirmButton: false
            });
        }
    });
});

function openEditModal(packageId) {
    // Fetch the package data via AJAX to populate the modal
    $.ajax({
        url: '/admin/package/' + packageId + '/edit',
        method: 'GET',
        success: function(response) {
            if(response.success) {
                $('#edit_package_id').val(response.data.id);
                $('#edit_package_name').val(response.data.package_name);
                $('#edit_status').val(response.data.status);
                $('#editPackageModal').modal('show');
            }
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to fetch package data',
                timer: 2000,
                showConfirmButton: false
            });
        }
    });
}

$('#editPackageForm').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        url: '{{ route("packages.update") }}',
        method: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            if(response.success) {
                $('#editPackageModal').modal('hide');
                $('#datatable').DataTable().ajax.reload();
                Swal.fire({
                    icon: 'success',
                    title: 'Package Updated',
                    text: response.message,
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to update package',
                timer: 2000,
                showConfirmButton: false
            });
        }
    });
});

$(document).ready(function() {
    fetchPackages();
});

</script>

