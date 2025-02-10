<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">QR Withdrawal</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Form Starts Here -->
                        <form method="POST" action="#">
                            @csrf
                            <!-- Phone & Aadhaar Number -->
                            <div class="row mb-3">
                            <div class="col-md-4">
                                    <label for="phone" class="form-label">Customer Name</label>
                                    <input type="text" class="form-control" id="customername" name="customername" placeholder="Enter customer name">
                                </div>
                                <div class="col-md-4">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number">
                                </div>
                                <div class="col-md-4">
                                    <label for="aadhaar" class="form-label">Fill Amount</label>
                                    <input type="number" class="form-control" id="aadhaar" name="amount" placeholder="Enter Amount">
                                </div>
                            </div>
                            <div class="row mb-3">
                            <div class="col-md-9">
                                    <label for="phone" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="customername" name="customername" placeholder="Enter customer Address">
                                </div>
                                <div class="col-md-3">
                                    <label for="phone" class="form-label">Pincode</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Pincode">
                                </div>
                               
                            </div>
                            <div class="row mb-3">
                            <div class="col-md-12">
                                    <label for="phone" class="form-label">Purpose of Withdrawal</label>
                                    <input type="text" class="form-control" id="customername" name="customername" placeholder="Enter Purpose of withdrawal">
                                </div>
                              
                               
                            </div>




                            <!-- Terms and Conditions -->
                            <div class="form-group mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="terms" name="terms">
                                    <label class="form-check-label" for="terms">
                                    I hereby confirm and authorize the selected amount from my bank account to Paytech solutions for the purpose that I mentioned above. I understand that this payment is non-refundable and agree to the terms and conditions associated with the transaction.
                                    </label>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="row">
                             
                                <div class="col-md-6 text-center mb-3">
                                    <button type="submit" class="btn btn-success btn-lg w-100">SEND OTP →</button>
                                </div>
                            </div>
                        </form>
                        <!-- Form Ends Here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
