<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="row">
            <div class="col-sm-12 col-lg-4">
                <div class="card">
                    <div class="card-header">
                  <img src="{{asset('images/qr-code.png')}}" class="img-fluid pb-4"  />
                  <h6 class="card-title pb-3 text-center">9473922977m@pnb</h6>

                    </div></div>
            </div>
            <div class="col-sm-12 col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Wallet</h4>
                            <h6 class="card-title pb-3">After the payment, please submit the below form with all the details.</h6>
                        </div>
                    </div>
                    <div class="card-body">

                        <form id="walletAddForm">


                            <div class="row">

                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label" for="phone_number">Reference No/ UTR No:</label>
                                        <input type="text" class="form-control" id="reforutr">
                                    </div>

                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label" for="amount">Amount:</label>
                                        <input type="number" class="form-control" id="amount">
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
                         <h4 class="card-title">Wallet Deposit Records</h4>
                      </div>
                   </div>
                   <div class="card-body">

                      <div class="table-responsive">
                         <table id="datatable" class="table " data-toggle="data-table">
                            <thead>
                               <tr>
                                  <th> ID</th>
                                  <th>REF ID / UTR</th>
                                  <th>AMOUNT</th>
                                  <th>STATUS</th>
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
function fetchWalletDetails(){
    if ($.fn.DataTable.isDataTable('#datatable')) {
        $('#datatable').DataTable().destroy();
    }

    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("wallet.deposits") }}',
            type: 'GET',
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'reforutr', name: 'reforutr' },
            { data: 'amount', name: 'amount' },
            { data: 'status', name: 'status' }
        ]
    });
}

     $(document).ready(function() {

        fetchWalletDetails();

    $('#submitWallet').click(function(e) {
        e.preventDefault();
        var reforutr =  $('#reforutr').val();
        var amount = $('#amount').val();
        $.ajax({
            url: '{{ route("addFund") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                reforutr: reforutr,
                amount: amount,
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Success',
                        text: 'Request Added Successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                    $('#walletAddForm')[0].reset();
                    fetchWalletDetails();
                } else {
                    Swal.fire('Error', 'Something went wrong with the Add Fund', 'error');
                }
            },
            error: function(xhr) {
                Swal.fire('Error', 'There was an error processing your request', 'error');
            }
        });
    });
});

    </script>
