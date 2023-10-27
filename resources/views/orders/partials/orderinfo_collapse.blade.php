
<div class="card-body">
    @include('partials.flash')
    
    <?php 
        $currency=config('settings.cashier_currency');
        $convert=config('settings.do_convertion');
    ?>


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
     <table class="table align-items-center">
        <thead class="thead-light">
            <tr>
                @if(!empty($order->whatsapp_address))
                    <th>{{ __('Address') }}</th>
                @endif
                @if(!empty($order->comment) && strlen($order->comment) > 2)
                    <th>{{ __('Comment') }}</th>
                @endif
                @if(strlen($order->phone)>2)
                    <th>{{ __('Phone') }}</th>
                @endif
                @if(!empty($order->time_to_prepare))
                    <th>{{ __('Time to prepare') }}</th>
                @endif
                <th>{{ __("NET") }}</th>
                <th>{{ __("VAT") }}</th>
                <th>{{ __("Sub Total") }}</th>
                <th>{{ __("TOTAL") }}</th>
            </tr>
        </thead>
        <tbody class="list">
            <tr>
                @if(!empty($order->whatsapp_address))
                    <td>{{ $order->whatsapp_address }}</td>
                @endif
                @if(!empty($order->comment) && strlen($order->comment) > 2)
                    <td>{{ $order->comment }}</td>
                @endif
                @if(strlen($order->phone)>2)
                    <td>{{ $order->phone }}</td>
                @endif
                @if(!empty($order->time_to_prepare))
                    <td>{{ $order->time_to_prepare ." " .__('minutes')}}</td>
                @endif
                
                <td>@money( ($order->order_price-$order->vatvalue)-($order->order_price*0.100), $currency ,true)</td>
                <td>@money( $order->order_price*0.100, $currency,$convert)</td>
                <td>@money( $order->order_price, $currency,$convert)</td>
                <td><b>@money( $order->delivery_price+$order->order_price_with_discount, $currency,true)</b></td>
            </tr>
        </tbody>
    </table>

    <table class="table align-items-center">
        <thead class="thead-light">
            <tr>
                <th>{{ __("Payment method") }}</th>
                <th>{{ __("Payment status") }}</th>
            </tr>
            </thead>
            <tbody class="list">
                <tr>
                    <td>{{ __(strtoupper($order->payment_method)) }}</td>
                    <td><span style='color:#03643b'>{{ __(ucfirst($order->payment_status)) }}</span></td>
                </tr>
            </tbody>
    </table>    

    <table class="table align-items-center">
        <thead class="thead-light">
            <tr>
                @if(config('app.isft') || config('app.iswp'))
                    <th>{{ __("Delivery method") }}</th>
                    <th>{{ __("Time slot") }}</th>
                @else
                    <th>{{ __("Dine method") }}</th>
                    @if ($order->delivery_method!=3)
                        <th>{{ __("Time slot") }}</th>
                    @endif
                @endif
            </tr>
            </thead>
            <tbody class="list">
                <tr>
                    @if(config('app.isft') || config('app.iswp'))
                        <td>{{ $order->getExpeditionType() }}</td>
                        <td>@include('orders.partials.time', ['time'=>$order->time_formated])</td>
                    @else
                        <td>{{ $order->getExpeditionType() }}</td>
                        @if ($order->delivery_method!=3)
                            <td> @include('orders.partials.time', ['time'=>$order->time_formated])</td>
                        @endif
                    @endif
                </tr>
            </tbody>
    </table>         
 
 </div>