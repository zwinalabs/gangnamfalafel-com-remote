<div class="col-12">
    <!-- List of items -->

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