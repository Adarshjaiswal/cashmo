<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Submit Any Query</h4>
                            {{-- <h6 class="card-title pb-3">After the payment, please submit the below form with all the details.</h6> --}}
                        </div>
                    </div>
                    <div class="card-body">

                        <form id="walletAddForm">


                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label" for="query">Query:</label>
                                        <textarea class="form-control" id="query"></textarea>
                                    </div>
                                </div>
                                </div>
                            <button type="submit" id="submitWallet" class="btn btn-primary">Submit</button>
                            <button type="submit" class="btn btn-danger">cancel</button>
                        </form>
                    </div>
                </div>


            </div>
            {{-- <div class="col-sm-12 col-lg-3">
            </div> --}}
            <div class="col-sm-12">
                <div class="card">
                   <div class="card-header d-flex justify-content-between">
                      <div class="header-title">
                         <h4 class="card-title">Queries Records</h4>
                      </div>
                   </div>
                   <div class="card-body">

                      <div class="table-responsive">
                         <table id="datatable" class="table " data-toggle="data-table">
                            <thead>
                               <tr>
                                  <th>ID</th>
                                  <th>QUERY</th>
                                  <th>ADMIN RESPONSE</th>
                                  <th>STATUS</th>
                                  <th>CREATED AT</th>
                               </tr>
                            </thead>
                            <tbody>
                            </tbody>

                         </table>
                      </div>
                   </div>
                </div>
             </div>
        </div>
    </div>
    </x-app-layout>
    <script>
function fetchWalletDetails() {
    if ($.fn.DataTable.isDataTable('#datatable')) {
        $('#datatable').DataTable().destroy();
    }

    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("queries.added") }}',
            type: 'GET',
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'query', name: 'query' },
            { data: 'admin_response', name: 'admin_response' },
            { data: 'status', name: 'status' },
            {
                data: 'created_at',
                name: 'created_at',
                render: function(data) {
                    // Convert the ISO date string to JavaScript Date object
                    let date = new Date(data);

                    // Format date as 'YYYY-MM-DD HH:mm:ss' in the 'Asia/Kolkata' timezone
                    return date.toLocaleString('en-IN', {
                        timeZone: 'Asia/Kolkata',
                        year: 'numeric',
                        month: '2-digit',
                        day: '2-digit'
                    });
                }
            }
        ],
        columnDefs: [
            {
                targets: 1, // Query column
                width: '30%', // Adjust to your needs
                className: 'text-wrap' // Enable text wrapping
            },
            {
                targets: 2, // Admin response column
                width: '30%', // Adjust to your needs
                className: 'text-wrap' // Enable text wrapping
            },
            {
                targets: 4, // Created At column (format on front-end if necessary)
                width: '20%' // Adjust to your needs
            }
        ]
    });
}

$(document).ready(function() {
    fetchWalletDetails();

    $('#submitWallet').click(function(e) {
        e.preventDefault();
        var query = $('#query').val();
        $.ajax({
            url: '{{ route("addQuery") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                query: query,
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Success',
                        text: 'Query Added successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                    $('#walletAddForm')[0].reset();
                    fetchWalletDetails();
                } else {
                    Swal.fire('Error', 'Something went wrong with the Add Query', 'error');
                }
            },
            error: function(xhr) {
                Swal.fire('Error', 'There was an error processing your request', 'error');
            }
        });
    });
});


    </script>
