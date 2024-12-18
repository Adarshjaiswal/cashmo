<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Balance Withdrawal</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Form Starts Here -->
                        <form method="POST" action="#">
                            @csrf
                            <!-- Phone & Aadhaar Number -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number">
                                </div>
                                <div class="col-md-6">
                                    <label for="aadhaar" class="form-label">Aadhaar Number</label>
                                    <input type="text" class="form-control" id="aadhaar" name="aadhaar" placeholder="Enter Aadhaar number">
                                </div>
                            </div>

                            <!-- Predefined Withdrawal Amounts -->
                            <div class="form-group mb-3">
                                <label class="form-label">Select Withdrawal Amount</label>
                                <div class="d-flex flex-wrap">
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="amount" id="amount100" value="100">
                                        <label class="form-check-label" for="amount100">₹ 100</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="amount" id="amount200" value="200">
                                        <label class="form-check-label" for="amount200">₹ 200</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="amount" id="amount500" value="500">
                                        <label class="form-check-label" for="amount500">₹ 500</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="amount" id="amount1000" value="1000">
                                        <label class="form-check-label" for="amount1000">₹ 1,000</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="amount" id="amount2000" value="2000">
                                        <label class="form-check-label" for="amount2000">₹ 2,000</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="amount" id="amount5000" value="5000">
                                        <label class="form-check-label" for="amount5000">₹ 5,000</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="amount" id="amount10000" value="10000">
                                        <label class="form-check-label" for="amount10000">₹ 10,000</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Custom Amount -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="custom_amount" class="form-label">Custom Amount</label>
                                    <input type="number" class="form-control" id="custom_amount" name="custom_amount" placeholder="Enter amount">
                                </div>
                            </div>

                            <!-- Bank Selection -->
                            <div class="form-group mb-3">
                                <label class="form-label">Select Your Bank</label>
                                <div class="d-flex flex-wrap">
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="bank" id="sbi" value="State Bank of India">
                                        <label class="form-check-label" for="sbi">State Bank of India</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="bank" id="pnb" value="Punjab National Bank">
                                        <label class="form-check-label" for="pnb">Punjab National Bank</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="bank" id="ubi" value="Union Bank of India">
                                        <label class="form-check-label" for="ubi">Union Bank of India</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="bank" id="bob" value="Bank Of Baroda">
                                        <label class="form-check-label" for="bob">Bank Of Baroda</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="bank" id="cbi" value="Central Bank of India">
                                        <label class="form-check-label" for="cbi">Central Bank of India</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="bank" id="other" value="Other">
                                        <label class="form-check-label" for="other">Other</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Terms and Conditions -->
                            <div class="form-group mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="terms" name="terms">
                                    <label class="form-check-label" for="terms">
                                        I Agree to <a href="#" class="text-primary">Term & Conditions</a>
                                    </label>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="row">
                                <div class="col-md-6 text-center mb-3">
                                    <button type="button" class="btn btn-primary btn-lg w-100">SCAN FINGER</button>
                                </div>
                                <div class="col-md-6 text-center mb-3">
                                    <button type="submit" class="btn btn-success btn-lg w-100">SUBMIT →</button>
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
