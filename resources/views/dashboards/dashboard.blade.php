<x-app-layout :assets="$assets ?? []">
    <div class="row">
       <div class="col-md-12 col-lg-12">
          <div class="row row-cols-1">
             <div class="d-slider1 overflow-hidden ">
                <ul  class="swiper-wrapper list-inline m-0 p-0 mb-2">
                   @if(auth()->user()->user_type == 'user')
                      <!-- For Regular User -->
                      <!-- Wallet Balance Card -->
                      <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                         <div class="card-body">
                            <div class="progress-widget">
                               <div id="circle-progress-01" class="circle-progress-01 circle-progress circle-progress-primary text-center" data-min-value="0" data-max-value="100" data-value="90" data-type="percent">
                                  <svg class="card-slie-arrow " width="24" height="24px" viewBox="0 0 24 24">
                                     <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                  </svg>
                               </div>
                               <div class="progress-detail">
                                  <p class="mb-2">Wallet Balance</p>
                                  <h4 class="counter" style="visibility: visible;">&#8377;{{ $totalAmount->sum('wallet_amount') }}</h4>
                               </div>
                            </div>
                         </div>
                      </li>

                      <!-- Total Deposits Card -->
                      <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                         <div class="card-body">
                            <div class="progress-widget">
                               <div id="circle-progress-02" class="circle-progress-01 circle-progress circle-progress-info text-center" data-min-value="0" data-max-value="100" data-value="80" data-type="percent">
                                  <svg class="card-slie-arrow " width="24" height="24" viewBox="0 0 24 24">
                                     <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                  </svg>
                               </div>
                               <div class="progress-detail">
                                  <p class="mb-2">Total Deposits</p>
                                  <h4 class="counter">&#8377;{{ $totalDeposits }}</h4>
                               </div>
                            </div>
                         </div>
                      </li>

                      <!-- Recharge Done Card -->
                      <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
                         <div class="card-body">
                            <div class="progress-widget">
                               <div id="circle-progress-03" class="circle-progress-01 circle-progress circle-progress-primary text-center" data-min-value="0" data-max-value="100" data-value="70" data-type="percent">
                                  <svg class="card-slie-arrow " width="24" viewBox="0 0 24 24">
                                     <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                  </svg>
                               </div>
                               <div class="progress-detail">
                                  <p class="mb-2">Recharge Done</p>
                                  <h4 class="counter">{{ $successfulRechargesCount }}</h4>
                               </div>
                            </div>
                         </div>
                      </li>
                      <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
                        <div class="card-body">
                           <div class="progress-widget">
                              <div id="circle-progress-03" class="circle-progress-01 circle-progress circle-progress-primary text-center" data-min-value="0" data-max-value="100" data-value="70" data-type="percent">
                                 <svg class="card-slie-arrow " width="24" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                 </svg>
                              </div>
                              <div class="progress-detail">
                                 <p class="mb-2">Recharge Commission</p>
                                 <h4 class="counter">&#8377;{{ $rechargeCommission->recharge_commission }}</h4>
                              </div>
                           </div>
                        </div>
                     </li>

                   @elseif(auth()->user()->user_type == 'admin')
                      <!-- For Admin -->
                      <!-- Total Retailers Card -->
                      <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                         <div class="card-body">
                            <div class="progress-widget">
                               <div id="circle-progress-01" class="circle-progress-01 circle-progress circle-progress-primary text-center" data-min-value="0" data-max-value="100" data-value="90" data-type="percent">
                                  <svg class="card-slie-arrow " width="24" height="24px" viewBox="0 0 24 24">
                                     <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                  </svg>
                               </div>
                               <div class="progress-detail">
                                  <p class="mb-2">Total Retailers</p>
                                  <h4 class="counter" style="visibility: visible;">{{ $totalRetailers }}</h4>
                               </div>
                            </div>
                         </div>
                      </li>

                      <!-- Total Wallet Amount Card -->
                      <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                         <div class="card-body">
                            <div class="progress-widget">
                               <div id="circle-progress-02" class="circle-progress-01 circle-progress circle-progress-info text-center" data-min-value="0" data-max-value="100" data-value="80" data-type="percent">
                                  <svg class="card-slie-arrow " width="24" height="24" viewBox="0 0 24 24">
                                     <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                  </svg>
                               </div>
                               <div class="progress-detail">
                                  <p class="mb-2">Total Wallet Amount</p>
                                  <h4 class="counter">&#8377;{{ $totalWalletAmount }}</h4>
                               </div>
                            </div>
                         </div>
                      </li>

                      <!-- Total Recharges Done Card -->
                      <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
                         <div class="card-body">
                            <div class="progress-widget">
                               <div id="circle-progress-03" class="circle-progress-01 circle-progress circle-progress-primary text-center" data-min-value="0" data-max-value="100" data-value="70" data-type="percent">
                                  <svg class="card-slie-arrow " width="24" viewBox="0 0 24 24">
                                     <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                  </svg>
                               </div>
                               <div class="progress-detail">
                                  <p class="mb-2">Total Recharges Done</p>
                                  <h4 class="counter">{{ $allRechargesCount }}</h4>
                               </div>
                            </div>
                         </div>
                      </li>
                      <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
                        <div class="card-body">
                           <div class="progress-widget">
                              <div id="circle-progress-03" class="circle-progress-01 circle-progress circle-progress-primary text-center" data-min-value="0" data-max-value="100" data-value="70" data-type="percent">
                                 <svg class="card-slie-arrow " width="24" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                 </svg>
                              </div>
                              <div class="progress-detail">
                                 <p class="mb-2">Recharge Commission</p>
                                 <h4 class="counter">&#8377;{{ $rechargeCommission->recharge_commission }}</h4>
                              </div>
                           </div>
                        </div>
                     </li>
                   @endif
                </ul>
                <div class="swiper-button swiper-button-next"></div>
                <div class="swiper-button swiper-button-prev"></div>
             </div>
          </div>
       </div>
    </div>
 </x-app-layout>
