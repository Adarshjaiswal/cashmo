<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Services</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Image Options in Two Rows with Four Columns -->
                        <div class="row text-center">
                            <!-- Row 1 -->
                            <div class="col-2 mb-4">
                            <a class="circle-logo" href="{{route('BBPS.electricityBill')}}">
                                <img class="image-responsive" src="https://www.eazypan.in/assets/images/icon/bill_payment_icons/electricity_bill.png" alt=" logo">
                            </a>
                            
                           
                            </div>
                            <div class="col-2 mb-4">
                            <a class="circle-logo" href="{{route('BBPS.loanRepayment')}}">
                                <img class="image-responsive" src="https://www.eazypan.in/assets/images/icon/bill_payment_icons/loan_repay.png" alt=" logo">
                            </a>
                            
                           
                            </div>
                            <div class="col-2 mb-4">
                            <a class="circle-logo" href="{{route('BBPS.insurance')}}">
                                <img class="image-responsive" src="https://www.eazypan.in/assets/images/icon/bill_payment_icons/insurance_i.png" alt=" logo">
                            </a>
                            
                          
                            </div>
                            <div class="col-2 mb-4">
                            <a class="circle-logo" href="{{route('BBPS.gasBill')}}">
                                <img class="image-responsive" src="https://www.eazypan.in/assets/images/icon/bill_payment_icons/gas_i.png" alt=" logo">
                            </a>
                           
                            </div>
                            <!-- Row 2 -->
                            <div class="col-2">
                            <a class="circle-logo" href="{{route('BBPS.waterBill')}}">
                                <img class="image-responsive" src="https://www.eazypan.in/assets/images/icon/bill_payment_icons/water_i.png" alt=" logo">
                            </a>
                             
                            </div>
                            <div class="col-2">
                            <a class="circle-logo" href="{{route('BBPS.landlineBill')}}">
                                    <img class="image-responsive" src="https://www.eazypan.in/assets/images/icon/bill_payment_icons/landline_i.png" alt="AEPS Service">
                                </a>
                            </div>
                            <div class="col-2">
                            <a class="circle-logo" href="{{route('BBPS.broadbandBill')}}">
                                <img class="image-responsive" src="https://www.eazypan.in/assets/images/icon/bill_payment_icons/broadbnd.png" alt=" logo">
                            </a>
                            </div>
                            <div class="col-2">
                            <a class="circle-logo" href="{{route('BBPS.taxMuncipal')}}">
                                <img class="image-responsive" src="https://www.eazypan.in/assets/images/icon/bill_payment_icons/municipal_tax.png" alt=" logo">
                            </a>
                            </div>
                            <div class="col-2">
                            <a class="circle-logo" href="{{route('BBPS.digitalVoucher')}}">
                                <img class="image-responsive" src="https://www.eazypan.in/assets/images/icon/recharge_icons/difital_voucher.png" alt=" logo">
                            </a>
                           
                            </div>
                          
                        </div>
                        <style>
                            .circle-logo img {
                                width: 100px;
                                height: 100px;
                                border-radius: 50%;
                                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                                transition: transform 0.3s ease;
                            }
                            .circle-logo img:hover {
                                transform: scale(1.1);
                            }
                            .text-center {
                                text-align: center;
                            }
                        </style>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
