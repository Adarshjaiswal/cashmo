<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Recharge and Bills for Package Commission: {{ $package->package_name }}</h4>
                        </div>
                        <a href="{{route('AllPackage.index')}}"><button class="btn btn-primary">Back</button></a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table" data-toggle="data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Provider</th>
                                        <th>Commsion Type</th>
                                        <th>Commission Rate</th>
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
    </div>
</x-app-layout>

<script>
    function fetchPackagesCommissions() {
        if ($.fn.DataTable.isDataTable('#datatable')) {
            $('#datatable').DataTable().destroy();
        }
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("admin.package.recharge-bills.data", $package->id) }}',
                type: 'GET',
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'provider', name: 'provider' },
                { data: 'commission_type_select', name: 'commission_type' },
                { data: 'commission_rate_input', name: 'commission_rate' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    }
    function updateCommission(id) {
        const type = $(`.commission-type[data-id="${id}"]`).val();
        const rate = $(`.commission-rate[data-id="${id}"]`).val();
        $.ajax({
            url: '{{ route("admin.package.commission.update") }}',
            type: 'POST',
            data: {
                commission_id: id,
                commission_type: type,
                commission_rate: rate,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                    icon: 'success',
                    title: 'Commission Updated',
                    text: response.message,
                    timer: 2000,
                    showConfirmButton: false
                });
                } else {
                    Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to update commission',
                timer: 2000,
                showConfirmButton: false
            });
                }
            },
            error: function(xhr) {
                Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to update commission',
                timer: 2000,
                showConfirmButton: false
            });
            }
        });
    }

    $(document).ready(function() {
        fetchPackagesCommissions();
    });
    </script>
