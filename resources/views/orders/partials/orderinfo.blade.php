
<div class="card-body">
    @include('partials.flash') 
    @if ($order->restorant)
        <h6 class="heading-small text-muted mb-4">{{ __('Restaurant information') }}</h6>
        <div class="pl-lg-4">
            <h4>{{ $order->restorant->name }}</h4>
            <h5>{{ $order->restorant->address }}</h5>
            <h5>{{ $order->restorant->phone }}</h5>
            <h5>{{ $order->restorant->user->name.", ".$order->restorant->user->email }}</h5>
        </div>
        <hr class="my-4" />
    @endif
    
    
 
     @if (config('app.isft')&&$order->client)
         <h6 class="heading-small text-muted mb-4">{{ __('Client Information') }}</h6>
         <div class="pl-lg-4">
             <h4>{{ $order->client?$order->client->name:"" }}</h4>
             <h5>{{ $order->client?$order->client->email:"" }}</h5>
             <h5>{{ $order->address?$order->address->address:"" }}</h5>
 
             @if(!empty($order->address->apartment))
                 <h5>{{ __("Apartment number") }}: {{ $order->address->apartment }}</h5>
             @endif
             @if(!empty($order->address->entry))
                 <h5>{{ __("Entry number") }}: {{ $order->address->entry }}</h5>
             @endif
             @if(!empty($order->address->floor))
                 <h5>{{ __("Floor") }}: {{ $order->address->floor }}</h5>
             @endif
             @if(!empty($order->address->intercom))
                 <h5>{{ __("Intercom") }}: {{ $order->address->intercom }}</h5>
             @endif
             @if($order->client&&!empty($order->client->phone))
             <br/>
             <h5>{{ __('Contact')}}: {{ $order->client->phone }}</h5>
             @endif
         </div>
         <hr class="my-4" />
     @else
         @if ($order->table)
             <h6 class="heading-small text-muted mb-4 d-none">{{ __('Table Information') }}</h6>
             <div class="pl-lg-4 d-none">
                 
                     <h4>{{ __('Table:')." ".$order->table->name }}</h4>
                     @if ($order->table->restoarea)
                         <h5>{{ __('Area:')." ".$order->table->restoarea->name }}</h5>
                     @endif
                 
                 
             </div>
             <hr class="my-4" />
         @endif
     @endif
     
 
 
    <?php 
        $currency=config('settings.cashier_currency');
        $convert=config('settings.do_convertion');
    ?>

    @if ($order->driver)
        @hasrole('admin|owner|staff')
            <h6 class="heading-small text-muted mb-4">{{ __('Driver') }}</h6>
            <p><a href="/drivers/{{ $order->driver->id}}/edit">{{ $order->driver->name }}</a></p>
            <hr class="my-4" />
        @endhasanyrole
    @endif
     @if(count($order->items)>0)
     <h6 class="heading-small text-muted mb-4">{{ __('Order') }}</h6>
     
     <ul id="order-items">
         @foreach($order->items as $item)
             <?php 
                 $theItemPrice= ($item->pivot->variant_price?$item->pivot->variant_price:$item->price);
             ?>
            @if ( $item->pivot->qty>0)
            <li><h5><span style='color:#03643b'>{{ $item->pivot->qty }} X</span> {{ $item->name }} -  @money($theItemPrice, $currency,$convert)  =  ( @money( $item->pivot->qty*$theItemPrice, $currency,true) )
                 
                @if($item->pivot->vatvalue>0))
                    <span class="small">-- {{ __('VAT ').$item->pivot->vat."%: "}} ( @money( $item->pivot->vatvalue, $currency,$convert) )</span>
                @endif
                 @hasrole('admin|owner|staff')
                    <?php $lasStatusId=$order->status->pluck('id')->last(); ?>
                    @if ($lasStatusId!=7&&$lasStatusId!=11)
                        <span class="small">
                            <button 
                            data-toggle="modal" 
                            data-target="#modal-order-item-count" 
                            type="button" 
                            onclick="$('#item_qty').val('{{$item->pivot->qty}}'); $('#pivot_id').val('{{$item->pivot->id}}');   $('#order_id').val('{{$order->id}}');"
                            class="btn btn-outline-danger btn-sm">
                                <span class="btn-inner--icon">
                                    <i class="ni ni-ruler-pencil"></i>
                                </span>
                            </button>
                        </span>
                    @endif
                 @endif
             </h5>
                 @if (strlen($item->pivot->variant_name)>2)
                     <br />
                     <table class="table align-items-center">
                         <thead class="thead-light">
                             <tr>
                                 @foreach ($item->options as $option)
                                     <th>{{ $option->name }}</th>
                                 @endforeach
 
 
                             </tr>
                         </thead>
                         <tbody class="list">
                             <tr>
                                 @foreach (explode(",",$item->pivot->variant_name) as $optionValue)
                                     <td>{{ $optionValue }}</td>
                                 @endforeach
                             </tr>
                         </tbody>
                     </table>
                 @endif
 
                 @if (strlen($item->pivot->extras)>2)
                     <br /><span>{{ __('Extras') }}</span><br />
                     <ul>
                         @foreach(json_decode($item->pivot->extras) as $extra)
                             <li> {{  $extra }}</li>
                         @endforeach
                     </ul><br />
                 @endif
                 <br />
             </li>
            @else
                <li>
                    {{ __('Removed') }}
                    <h5 class="text-muted">{{$item->name }} -  @money($theItemPrice, $currency,$convert) 
                 
                        @if($item->pivot->vatvalue>0))
                            <span class="small">-- {{ __('VAT ').$item->pivot->vat."%: "}} ( @money( $item->pivot->vatvalue, $currency,$convert) )</span>
                        @endif
                    </h5>
                    <br />
                </li>
            @endif
             
         @endforeach
     </ul>
     @endif
     @if(!empty($order->whatsapp_address))
        <br/>
        <h5>{{ __('Address') }}: {{ $order->whatsapp_address }}</h5>
     @endif
     @if(!empty($order->comment))
        <br/>
        <h5>{{ __('Comment') }}: {{ $order->comment }}</h5>
     @endif
     @if(strlen($order->phone)>2)
        <h5>{{ __('Phone') }}: {{ $order->phone }}</h5>
     @endif
     <br />
     @if(!empty($order->time_to_prepare))
     <br/>
     <h5>{{ __('Time to prepare') }}: {{ $order->time_to_prepare ." " .__('minutes')}}</h5>
     <br/>
     @endif
     <h5>{{ __("NET") }}: @money( $order->order_price-$order->vatvalue, $currency ,true)</h5>
     <h5>{{ __("VAT") }}: @money( $order->vatvalue, $currency,$convert)</h5>
     <h5>{{ __("Sub Total") }}: @money( $order->order_price, $currency,$convert)</h5>
     @if($order->delivery_method==1)
     <h5>{{ __("Delivery") }}: @money( $order->delivery_price, $currency,$convert)</h5>
     @endif
     @if ($order->discount>0)
        <h5>{{ __("Discount") }}: @money( $order->discount, $currency,$convert)</h5>
        <h5>{{ __("Coupon code") }}: {{$order->coupon}}</h5>
     @endif
     <hr />
     <h4>{{ __("TOTAL") }}: @money( $order->delivery_price+$order->order_price_with_discount, $currency,true)</h4>
     <hr />
     <h5>{{ __("Payment method") }}: {{ __(strtoupper($order->payment_method)) }}</h5>
     <h5>{{ __("Payment status") }}: <span style='color:#03643b'>{{ __(ucfirst($order->payment_status)) }}</span></h5>
     @if ($order->payment_status=="unpaid"&&strlen($order->payment_link)>5)
         <button onclick="location.href='{{$order->payment_link}}'" class="btn btn-success">{{ __('Pay now') }}</button>
     @endif
     <hr />
     @if(config('app.isft') || config('app.iswp'))
         <h5>{{ __("Delivery method") }}: {{ $order->getExpeditionType() }}</h5>
         <h4>{{ __("Time slot") }}: @include('orders.partials.time', ['time'=>$order->time_formated])</h4>
     @else
         <h5>{{ __("Dine method") }}: {{ $order->getExpeditionType() }}</h5>
         @if ($order->delivery_method!=3)
             <h4>{{ __("Time slot") }}: @include('orders.partials.time', ['time'=>$order->time_formated])</h4>
         @endif
     @endif

     @if(isset($custom_data)&&count($custom_data)>0)
        <hr />
        <h4>{{ __(config('settings.label_on_custom_fields')) }}</h4>
        @foreach ($custom_data as $keyCutom => $itemValue)
            <h5>{{ __("custom.".$keyCutom) }}: {{ $itemValue }}</h5>
        @endforeach
     @endif

     
 
 
 </div>