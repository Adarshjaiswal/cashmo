<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Recharges</h4>
                        </div>
                    </div>
<div class="card-body">
            <!-- Tabs Navigation -->
    <ul class="nav nav-tabs" id="rechargeTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="mobile-recharge-tab" data-bs-toggle="tab" data-bs-target="#mobile-recharge" type="button" role="tab" aria-controls="mobile-recharge" aria-selected="true">Mobile</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="dth-tab" data-bs-toggle="tab" data-bs-target="#dth" type="button" role="tab" aria-controls="dth" aria-selected="false">DTH</button>
        </li>
    </ul>
    <!-- Tabs Content -->
    <div class="tab-content" id="rechargeTabsContent">
        <!-- Mobile Recharge Tab -->
        <div class="tab-pane fade show active" id="mobile-recharge" role="tabpanel" aria-labelledby="mobile-recharge-tab">
            <form id="mobileRechargeForm">
                <!-- Common Form Fields -->
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Select Provider</label>
                            <select class="form-select mb-3 shadow-none" name="provider">
                                <option selected="">Open this select menu</option>
                                <option value="1">Airtel</option>
                                <option value="6">BSNL</option>
                                <option value="9">Jio</option>
                                <option value="82">MTNL Delhi</option>
                                <option value="233">MTNL Mumbai</option>
                                <option value="2">VI</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="mobile_number">Mobile Number:</label>
                            <input type="number" class="form-control" id="mobile_number" name="phone_number">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="amount">Amount:</label>
                            <input type="number" class="form-control" id="amount" name="amount">
                        </div>
                    </div>
                </div>
                <button type="submit" id="submitRecharge" class="btn btn-primary">
                    <span id="buttonText">Submit</span>
                    <span id="buttonLoader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                </button>
                <button type="button" class="btn btn-danger">Cancel</button>
            </form>
        </div>
        <!-- DTH Tab -->
        <div class="tab-pane fade" id="dth" role="tabpanel" aria-labelledby="dth-tab">
            <form id="dthForm">
                <!-- Common Form Fields -->
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Select Provider</label>
                            <select class="form-select mb-3 shadow-none" name="provider">
                                <option selected="">Open this select menu</option>
                                <option value="1">Tata Sky</option>
                                <option value="2">Dish TV</option>
                                <option value="3">Airtel Digital TV</option>
                                <option value="4">Sun Direct</option>
                                <option value="5">Videocon D2H</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="customer_id">Customer ID:</label>
                            <input type="number" class="form-control" id="customer_id" name="customer_id">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="amount">Amount:</label>
                            <input type="number" class="form-control" id="amount" name="amount">
                        </div>
                    </div>
                </div>
                <button type="submit" id="submitDTH" class="btn btn-primary">
                    <span id="buttonText">Submit</span>
                    <span id="buttonLoader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                </button>
                <button type="button" class="btn btn-danger">Cancel</button>
            </form>
        </div>
    </div>
</div>

                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                   <div class="card-header d-flex justify-content-between">
                      <div class="header-title">
                         <h4 class="card-title">Recharge Data</h4>
                      </div>
                   </div>
                   <div class="card-body">
                      <div class="table-responsive">
                         <table id="recharge-datatable" class="table " data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>CUST. INFO</th>
                                    <th>PROVIDER</th>
                                    <th>AMOUNT</th>
                                    <th>TYPE</th>
                                    <th>STATUS</th>
                                      <th>Trans Id</th>
                                      <th>TIME</th>
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
</x-app-layout>
<script>
    function loadProviders(url, selectElement) {
    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            if (response.status === 'success' && response.providers) {
                const providers = response.providers;
                $(selectElement).empty(); 
                $(selectElement).append('<option selected disabled>Select a provider</option>');
                providers.forEach(provider => {
                    $(selectElement).append(
                        `<option value="${provider.id}">${provider.provider_name}</option>`
                    );
                });
            } else {
                Swal.fire('Error', 'Failed to load providers', 'error');
            }
        },
        error: function() {
            Swal.fire('Error', 'Unable to fetch provider data', 'error');
        }
    });
}



    function fetchRechargeDetails() {
    if ($.fn.DataTable.isDataTable('#recharge-datatable')) {
        $('#recharge-datatable').DataTable().destroy();
    }

    $('#recharge-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("mobile.recharges") }}',
            type: 'GET',
        },
        columns: [
            { data: 'customer_info', name: 'customer_info' },
            { data: 'provider', name: 'provider' },
            { data: 'amount', name: 'amount' },
            { data: 'type', name: 'type' },
            { data: 'status', name: 'status' },
            { data: 'trans_id', name: 'trans_id' },
            { data: 'time', name: 'time' }
        ],
        //order: [[6, 'asc']]
    });
}
$(document).ready(function() {
    // Load Mobile Recharge Providers
    loadProviders('/api/mobile-recharge-providers', 'select[name="provider"]:first');
    // Load DTH providers
    loadProviders('/api/dth-recharge-providers', 'select[name="provider"]:last');

    fetchRechargeDetails();
    $('#submitRecharge').click(function(e) {
        e.preventDefault();
        var formData = $('#rechargeForm').serialize();
        $('#submitRecharge').attr('disabled', true);
        $('#buttonText').text('Processing...');
        $('#buttonLoader').removeClass('d-none');
        $.ajax({
            url: '/mobile-recharge',
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
            $('#submitRecharge').attr('disabled', false);
            $('#buttonText').text('Submit');
            $('#buttonLoader').addClass('d-none');
                if (response.status === 'success') {
                    Swal.fire({
                        title: 'Success',
                        text: "Recharge successfully completed.",
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                    fetchRechargeDetails();
                    $('#rechargeForm')[0].reset();
                } else if (response.status === 'error') {
                    Swal.fire('Error', response.message, 'error');
                } else {
                    Swal.fire('Info', response.message, 'info');
                }
            },
            error: function(xhr) {
            $('#submitRecharge').attr('disabled', false);
            $('#buttonText').text('Submit');
            $('#buttonLoader').addClass('d-none');
                var errorMessage = xhr.responseJSON && xhr.responseJSON.message
                    ? xhr.responseJSON.message
                    : 'There was an error processing your request';
                Swal.fire('Error', errorMessage, 'error');
            }
        });
    });
});
</script>
