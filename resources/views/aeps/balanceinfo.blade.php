<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Balance Information</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="#">
                            @csrf
                            <div class="row mb-3">
                                <!-- Phone Field -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your phone number">
                                    </div>
                                </div>
                                <!-- Aadhaar Number Field -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="aadhaar" class="form-label">Aadhaar Number</label>
                                        <input type="text" class="form-control" id="aadhaar" name="aadhaar" placeholder="Enter Aadhaar number">
                                    </div>
                                </div>
                            </div>
                            <!-- Bank Selection -->
                            <div class="form-group mb-3">
                                <label class="form-label">Select Your Bank</label>
                                <div class="d-flex flex-wrap">
                                    <div class="form-check me-3">
                                        <input type="radio" class="form-check-input" name="bank" id="sbi" value="State Bank of India">
                                        <label class="form-check-label" for="sbi">State Bank of India</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input type="radio" class="form-check-input" name="bank" id="pnb" value="Punjab National Bank">
                                        <label class="form-check-label" for="pnb">Punjab National Bank</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input type="radio" class="form-check-input" name="bank" id="ubi" value="Union Bank of India">
                                        <label class="form-check-label" for="ubi">Union Bank of India</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input type="radio" class="form-check-input" name="bank" id="bob" value="Bank of Baroda">
                                        <label class="form-check-label" for="bob">Bank of Baroda</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input type="radio" class="form-check-input" name="bank" id="cbi" value="Central Bank of India">
                                        <label class="form-check-label" for="cbi">Central Bank of India</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="bank" id="other" value="Other">
                                        <label class="form-check-label" for="other">Other</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Terms & Conditions -->
                            <div class="form-group mb-3">
                                <input type="checkbox" id="terms" name="terms" class="form-check-input">
                                <label for="terms" class="form-check-label">
                                    I agree to <a href="#" class="text-primary">Terms & Conditions</a>
                                </label>
                            </div>
                            <!-- Action Buttons -->
                            <div class="row">
                                <div class="col-md-6 text-center mb-3">
                                    <button type="button" class="btn btn-primary btn-lg">SCAN FINGER</button>
                                </div>
                                <div class="col-md-6 text-center mb-3">
                                    <button type="submit" class="btn btn-success btn-lg">SUBMIT →</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
