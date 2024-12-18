<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                   <div class="card-header d-flex justify-content-between">
                      <div class="header-title">
                         <h4 class="card-title">Transaction Records</h4>
                      </div>
                   </div>
                   <div class="card-body">
                      <div class="table-responsive">
                         <table id="datatable" class="table " data-toggle="data-table">
                            <thead>
                               <tr>
                                  <th> ID</th>
                                  <th>TYPE</th>
                                  <th>AMOUNT</th>
                                  <th>STATUS</th>
                                  <th>DATE</th>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
function fetchWalletDetails(){
    if ($.fn.DataTable.isDataTable('#datatable')) {
        $('#datatable').DataTable().destroy();
    }

    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("wallet.allUserTransactionData") }}',
            type: 'GET',
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'type', name: 'type' },
            { data: 'amount', name: 'amount' },
            { data: 'status', name: 'status' },
            {
                data: 'created_at',
                name: 'created_at',
                render: function(data, type, row) {
                    return moment(data).format('YYYY-MM-DD');
                }
            }
        ]
    });
}

     $(document).ready(function() {

        fetchWalletDetails();


});

    </script>
