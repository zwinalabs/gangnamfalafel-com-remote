@extends('layouts.front', ['class' => 'kaiskaiskais'])
@section('content')
    <section class="section bg-secondary checkout-summary-page">
      <div class="container">
        <x:notify-messages />
          <div class="row">
            <div class="col-12 text-center mobile-menu mt-3" style="display:block">
              <div class="row col-12 pr-0 pl-0">
                <div class="text-center mobile-menu col-3" style="display:block">
                    <button id="ganfal-btn-back" type="button" onclick="goBackUrl('{{ $restorant->getLinkAttribute() }}')"  class="btn btn-outline-primary btn-icon btn-sm page-link btn-cart-radius">
                        <svg fill="#03643b" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px" viewBox="0 0 100.00 100.00" enable-background="new 0 0 100 100" xml:space="preserve" stroke="#03643b" stroke-width="10"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M33.934,54.458l30.822,27.938c0.383,0.348,0.864,0.519,1.344,0.519c0.545,0,1.087-0.222,1.482-0.657 c0.741-0.818,0.68-2.083-0.139-2.824L37.801,52.564L64.67,22.921c0.742-0.818,0.68-2.083-0.139-2.824 c-0.817-0.742-2.082-0.679-2.824,0.139L33.768,51.059c-0.439,0.485-0.59,1.126-0.475,1.723 C33.234,53.39,33.446,54.017,33.934,54.458z"></path> </g> </g></svg>
                    </button>
                </div>
                <div class=" col-9 minicart-heading text-center">
                    <h5>{{ __('Votre command') }}</h5>
                </div>
            </div>
            </div>
            <!-- Left part -->
            <div class="col-12">

              <!-- List of items -->
              @include('cart.items')

                <form id="order-form" role="form" method="post" action="{{route('order.store')}}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                @if (count($timeSlots)>0)
                <!-- Payment -->
                @include('cart.payment')
                @else
                    <!-- Closed restaurant -->
                    @include('cart.closed')
                @endif
                
                @if(!config('settings.social_mode'))

                    @if (config('app.isft')&&count($timeSlots)>0)
                    <!-- FOOD TIGER -->
                        <!-- Delivery method -->
                        @if($restorant->can_pickup == 1)
                            @if($restorant->can_deliver == 1)
                              @include('cart.delivery')
                            @endif
                        @endif

                        <!-- Delivery time slot -->
                        @include('cart.time')

                        <!-- Delivery address -->
                        <div id='addressBox'>
                            @include('cart.address')
                        </div>

                        <!-- Custom Fields -->
                        @include('cart.customfields')

                        <!-- Comment -->
                        @include('cart.comment')
                    @elseif(config('app.isag'))  
                        @if(count($timeSlots)>0)
                            <!-- Delivery method -->
                            @include('cart.delivery')

                            <!-- Delivery time slot -->
                            @include('cart.time')

                            <!-- Custom Fields  -->
                            @include('cart.customfields')

                            <!-- Delivery adress -->
                            @include('cart.newaddress')

                            <!-- Client informations -->
                            @include('cart.newclient')

                            <!-- Comment -->
                            @include('cart.comment')
                        @endif

                    @elseif(config('app.isqrsaas')&&count($timeSlots)>0)

                      <!-- QRSAAS -->
                      
                      <!-- DINE IN OR TAKEAWAY -->
                      @if (config('settings.enable_pickup'))
                      
                          @if (in_array("poscloud", config('global.modules',[])) || in_array("deliveryqr", config('global.modules',[])) )
                            <!-- We have POS in QR -->
                            @include('cart.localorder.dineiintakeawaydeliver')

                            <!-- Delivery adress -->
                            <div class="qraddressBox" style="display: none">
                              @include('cart.newaddress')
                              <br />
                            </div>
                            
                            
                           
                          @else
                             <!-- Simple QR -->
                            {{--@include('cart.localorder.dineiintakeaway')--}}
                          @endif
                          
                          {{--<!-- Takeaway time slot -->
                          <div class="takeaway_picker" style="display: none">
                              @include('cart.time')
                          </div>--}}
                      @endif

                     {{-- <!-- LOCAL ORDERING -->
                      @include('cart.localorder.table')--}}

                      {{--<!-- Local Order Phone -->
                      @include('cart.localorder.phone')--}}

                      <!-- Custom Fields -->
                      @include('cart.customfields')

                      
                        

                    @endif
                @else
                    <!-- Social MODE -->

                    @if(count($timeSlots)>0)
                        <!-- Delivery method -->
                        @include('cart.delivery')

                        <!-- Delivery time slot -->
                        @include('cart.time')

                        <!-- Custom Fields  -->
                        @include('cart.customfields')

                        <!-- Delivery adress -->
                        @include('cart.newaddress')

                        <!-- Client informations -->
                        @include('cart.newclient')

                        <!-- Comment -->
                        @include('cart.comment')
                    @endif
                @endif

              {{--<!-- Restaurant -->
              @include('cart.restaurant')
              --}}
            </div>




    </div>
    @include('clients.modals')
  </section>
@endsection
@section('js')


  <!-- Stripe -->
  <script src="https://js.stripe.com/v3/"></script>
  <script>
    "use strict";
    var RESTORANT = <?php echo json_encode($restorant) ?>;
    var STRIPE_KEY="{{ config('settings.stripe_key') }}";
    var ENABLE_STRIPE="{{ config('settings.enable_stripe') }}";
    var SYSTEM_IS_QR="{{ config('app.isqrexact') }}";
    var SYSTEM_IS_WP="{{ config('app.iswp') }}";
    var initialOrderType = 'delivery';
    if(RESTORANT.can_deliver == 1 && RESTORANT.can_pickup == 0){
        initialOrderType = 'delivery';
    }else if(RESTORANT.can_deliver == 0 && RESTORANT.can_pickup == 1){
        initialOrderType = 'pickup';
    }
  </script>
  <script src="{{ asset('custom') }}/js/order.js"></script>
  <script src="{{ asset('custom') }}/js/checkout.js"></script>

@endsection

