<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                   <div class="card-header d-flex justify-content-between">
                      <div class="header-title">
                         <h4 class="card-title">Wallet Deposits</h4>
                      </div>
                   </div>
                   <div class="card-body">
                      <div class="table-responsive">
                         <table id="datatable" class="table" data-toggle="data-table">
                            <thead>
                               <tr>
                                  <th>ID</th>
                                  <th>USER NAME</th>
                                  <th>REF ID / UTR</th>
                                  <th>AMOUNT</th>
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
    </div>
</x-app-layout>

<script>
function fetchWalletDetails(){
    if ($.fn.DataTable.isDataTable('#datatable')) {
        $('#datatable').DataTable().destroy();
    }

    $('#datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '{{ route("wallet.data") }}',
        type: 'GET',
    },
    columns: [
        { data: 'id', name: 'id' },
        {
            data: 'user_name',
            name: 'user_name',
            render: function(data, type, row) {
                return `${data} (${row.username})`;
            }
        },
        { data: 'reforutr', name: 'reforutr' },
        {
            data: 'amount',
            name: 'amount',
            render: function(data, type, row) {
                return `Rs. ${data}`;
            }
        },
        {
            data: 'status',
            name: 'status',
            render: function(data, type, row) {
                return data.charAt(0).toUpperCase() + data.slice(1);
            }
        },
        {
            data: null,
            name: 'action',
            render: function(data, type, row) {
                if (row.status === 'pending') {
                    return `
                        <button class="btn btn-sm btn-success btn-confirm" data-id="${row.id}" data-amount="${row.amount}">Confirm</button>
                        <button class="btn btn-sm btn-danger btn-reject" data-id="${row.id}">Reject</button>
                    `;
                } else {
                    return '';
                }
            },
            orderable: false,
            searchable: false
        }
    ]
});
}

$(document).ready(function() {
    fetchWalletDetails();

    // Confirm button click handler
    $(document).on('click', '.btn-confirm', function() {
        const depositId = $(this).data('id');
        const amount = $(this).data('amount');

        Swal.fire({
            title: 'Confirm Deposit?',
            text: "Are you sure you want to confirm this deposit?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, confirm it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("wallet.confirm") }}',  // Add your route here
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        deposit_id: depositId,
                        amount: amount
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Confirmed!', 'Deposit has been confirmed.', 'success');
                            fetchWalletDetails();
                        } else {
                            Swal.fire('Error', 'Something went wrong with confirmation.', 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Failed to process request.', 'error');
                    }
                });
            }
        });
    });

    // Reject button click handler
    $(document).on('click', '.btn-reject', function() {
        const depositId = $(this).data('id');

        Swal.fire({
            title: 'Reject Deposit?',
            text: "Are you sure you want to reject this deposit?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, reject it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("wallet.reject") }}',  // Add your route here
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        deposit_id: depositId
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Rejected!', 'Deposit has been rejected.', 'success');
                            fetchWalletDetails();
                        } else {
                            Swal.fire('Error', 'Something went wrong with rejection.', 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Failed to process request.', 'error');
                    }
                });
            }
        });
    });
});
</script>
