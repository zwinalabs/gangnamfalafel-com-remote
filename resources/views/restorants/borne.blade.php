@extends('layouts.front', ['class' => ''])

@section('extrameta')
<title>{{ $restorant->name }}</title>
<meta property="og:image" itemprop="image" content="{{ $restorant->logom }}">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="590">
<meta property="og:image:height" content="400">
<meta name="og:title" property="og:title" content="{{ $restorant->name }}">
<meta name="description" content="{{ $restorant->description }}">
@if (\Akaunting\Module\Facade::has('googleanalytics'))
    @include('googleanalytics::index') 
@endif
@endsection
{{--
@section('addiitional_button_3')
    @include('restorants.partials.itemsearch')
@endsection
--}}

@section('content')
<?php
    function clean($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
     }
?>

{{-- @include('restorants.partials.modals') --}}
<!-- Circles background -->
@include('restorants.partials.landingpage')


    {{-- 
    <section class="section-profile-cover section-shaped grayscale-05 d-none d-md-none d-lg-block d-lx-block d-none">
      <!-- Circles background -->
      <img class="bg-image" loading="lazy" src="{{ $restorant->coverm }}" style="width: 100%;">
      <!-- SVG separator -->
      <div class="separator separator-bottom separator-skew">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </section>
    <section class="section pt-lg-0 mb--5 mt--9 d-md-none d-lg-block d-lx-block d-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title white"  <?php if($restorant->description){echo 'style="border-bottom: 1px solid #f2f2f2;"';} ?> >
                        <h1 class="display-3 text-white notranslate" data-toggle="modal" data-target="#modal-restaurant-info" style="cursor: pointer;">{{ $restorant->name }}</h1>
                        <p class="display-4" style="margin-top: 120px">{{ $restorant->description }}</p>
                        
                        <p><i class="ni ni-watch-time"></i> @if(!empty($openingTime))<span class="closed_time">{{__('Opens')}} {{ $openingTime }}</span>@endif @if(!empty($closingTime))<span class="opened_time">{{__('Opened until')}} {{ $closingTime }}</span> @endif |   @if(!empty($restorant->address))<i class="ni ni-pin-3"></i></i> <a target="_blank" href="https://www.google.com/maps/search/?api=1&query={{ urlencode($restorant->address) }}"><span class="notranslate">{{ $restorant->address }}</span></a>  | @endif @if(!empty($restorant->phone)) <i class="ni ni-mobile-button"></i> <a href="tel:{{$restorant->phone}}">{{ $restorant->phone }} </a> @endif</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    @include('partials.flash')
                </div>
                @if (auth()->user()&&auth()->user()->hasRole('admin'))
                    @include('restorants.admininfo')
                @endif
            </div>
        </div>

    </section>
    --}}
    <section class="section section-lg-none d-md-block d-lg-none d-lx-none " style="padding-bottom: 0px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @include('partials.flash')
                </div>
                @if (auth()->user()&&auth()->user()->hasRole('admin'))
                    @include('restorants.admininfo')
                @endif
            </div>
            <div class="row d-none">
                <div class="col-lg-12">
                    <div class="title">
                        <h1 class="display-3 text notranslate" data-toggle="modal" data-target="#modal-restaurant-info" style="cursor: pointer;">{{ $restorant->name }}</h1>
                        <p class="display-4 text">{{ $restorant->description }}</p>
                        <p><i class="ni ni-watch-time"></i> @if(!empty($openingTime))<span class="closed_time">{{__('Opens')}} {{ $openingTime }}</span>@endif @if(!empty($closingTime))<span class="opened_time">{{__('Opened until')}} {{ $closingTime }}</span> @endif   @if(!empty($restorant->address))<i class="ni ni-pin-3"></i></i> <a target="_blank" href="https://www.google.com/maps/search/?api=1&query={{ urlencode($restorant->address) }}">{{ $restorant->address }}</a>  | @endif @if(!empty($restorant->phone)) <i class="ni ni-mobile-button"></i> <a href="tel:{{$restorant->phone}}">{{ $restorant->phone }} </a> @endif</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section pt-lg-0 " id="restaurant-content" style="padding-top: 0px;display:none;">
        <input type="hidden" id="rid" value="{{ $restorant->id }}"/>
        <div class="container-fluid container-restorant">
            {{-- <div class="row sticky-search">
                <div class="col-12 col-lg-2 h-1p">&nbsp;</div>
                <div class="col-12 col-lg-7 bg-white">
                     @include('restorants.partials.itemsearch') 
                </div>
                <div class="col-12 col-lg-3 h-1p">&nbsp;</div>
            </div>--}}
            <div class="row">
                <div class="col-12 col-lg-2 borne-menu-categories sticky">
                    <div class="sticky-search"> @include('restorants.partials.itemsearch')</div>
                @if(!$restorant->categories->isEmpty())
                    <nav class="tabbable sticky" style="/*top: {{ config('app.isqrsaas') ? 75:88 }}px;*/">
                        <ul id="categories-items" class="nav nav-pills bg-white mb-2">
                            <li class="nav-item nav-item-category ">
                                <a class="nav-link  mb-sm-3 mb-md-0 active" data-toggle="tab" role="tab" href="" onClick="closeCurrentItem()">{{ __('All categories') }}</a>
                            </li>
                            @foreach ( $restorant->categories as $key => $category)
                                @if(!$category->aitems->isEmpty())
                                    <li class="nav-item nav-item-category" id="{{ 'cat_'.clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}">
                                        <a class="nav-link mb-sm-3 mb-md-0" data-toggle="tab" role="tab" onClick="closeCurrentItem()" id="{{ 'nav_'.clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}" href="#{{ clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}">{{ $category->name }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </nav>
                @endif           
                </div>
                <div id="restorant-menu-listing" class="col-12  col-lg-7 borne-menu-listing">
                    @if(!$restorant->categories->isEmpty())
                        <div id="productsListing">
                            @foreach ( $restorant->categories as $key => $category)
                                @if(!$category->aitems->isEmpty())
                                <div id="{{ clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}" class="{{ clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}">
                                    <h1>{{ $category->name }}</h1><br />
                                </div>
                                @endif
                                <div class="row {{ clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}">
                                    @foreach ($category->aitems as $item)
                                        <div id="item-listing-{{ $item->id }}" class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-6 pl-9px pr-9px">
                                            <div class="strip">
                                                @if(!empty($item->image))
                                                <figure>
                                                    <a onClick="setCurrentItem({{ $item->id }});openCurrentItem({{ $item->id }});" href="javascript:void(0)">
                                                        <img src="{{ $item->logom }}" loading="lazy" data-src="{{ config('global.restorant_details_image') }}" class="img-fluid lazy" alt="">
                                                        <small class="food-item__quantity" style="display:none;"></small>
                                                    </a>
                                                </figure>
                                                @endif
                                                <input type="hidden" id="currentItem-{{ $item->id }}" value="{{ $item->id }}"/>
                                                <input type="hidden" id="itemName-{{ $item->id }}" value="{{ $item->name }}"/>
                                                <input type="hidden" id="itemPrice-{{ $item->id }}" value="{{ $item->price }}"/>
                                                <input type="hidden" id="itemUnix-{{ $item->id }}" value=""/>
                                                <input type="hidden" id="itemFriendlyPrice-{{ $item->id }}" value="@money($item->price, config('settings.cashier_currency'),config('settings.do_convertion'))"/>
                                                <div class="res_title"><a onClick="setCurrentItem({{ $item->id }});openCurrentItem({{ $item->id }});" href="javascript:void(0)">{{ $item->name }}</a></div>
                                                <div class="res_description">{{ $item->short_description}}</div>
                                                <div class="row col-12 pl-0 pr-0">
                                                    <div class="col-5 pr-0">
                                                        <div class="res_mimimum">
                                                            @if ($item->discounted_price>0)
                                                                <span class="text-muted" style="text-decoration: line-through;">@money($item->discounted_price, config('settings.cashier_currency'),config('settings.do_convertion'))</span>
                                                            @endif
                                                            @money($item->price, config('settings.cashier_currency'),config('settings.do_convertion'))
                                                        </div>
                                                    </div>
                                                    <div class="col-7 pr-0">
                                                        @if (!(isset($canDoOrdering) && !$canDoOrdering))
                                                            <div class="row p-l-none flex-right-direction">
                                                                <div id="addToCartExpress-{{ $item->id }}"
                                                                    class="add-to-cart-express-{{ $item->id }} order-0 text-center">
                                                                    <button type="button" id="btn-add-tocart-express-{{ $item->id }}" onClick='addToCartActExpress({{ $item->id }})' :value="item.id"
                                                                        class="btn btn-outline-primary btn-icon btn-sm page-link btn-cart-radius">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="currentColor" data-spec="icon-plus" class="w-5 h-5" style="width: 16px; height: 16px;"><path fill="currentColor" d="M376 232H216V72c0-4.42-3.58-8-8-8h-32c-4.42 0-8 3.58-8 8v160H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h160v160c0 4.42 3.58 8 8 8h32c4.42 0 8-3.58 8-8V280h160c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8z"></path></svg>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="row quantity-express-bloc p-l-none flex-right-direction hide-me" id="quantity-express-bloc-{{ $item->id }}" style="display:none">
                                                                <button id="list-express-trash-{{ $item->id }}" type="button" onClick="removeItemFromCartByListing({{ $item->id }})" class="btn btn-outline-primary btn-icon btn-sm page-link btn-cart-radius">
                                                                    <svg width="16px" height="16px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20 8.70007H4C3.90151 8.70007 3.80398 8.68067 3.71299 8.64298C3.62199 8.60529 3.53931 8.55005 3.46967 8.4804C3.40003 8.41076 3.34478 8.32808 3.30709 8.23709C3.2694 8.14609 3.25 8.04856 3.25 7.95007C3.25 7.85158 3.2694 7.75405 3.30709 7.66306C3.34478 7.57207 3.40003 7.48939 3.46967 7.41974C3.53931 7.3501 3.62199 7.29486 3.71299 7.25716C3.80398 7.21947 3.90151 7.20007 4 7.20007H20C20.1989 7.20007 20.3897 7.27909 20.5303 7.41974C20.671 7.5604 20.75 7.75116 20.75 7.95007C20.75 8.14899 20.671 8.33975 20.5303 8.4804C20.3897 8.62106 20.1989 8.70007 20 8.70007Z" fill="#03643b"></path> <path d="M16.44 20.75H7.56C7.24309 20.7717 6.92503 20.7303 6.62427 20.6281C6.3235 20.5259 6.04601 20.3651 5.80788 20.1548C5.56975 19.9446 5.37572 19.6892 5.23704 19.4034C5.09836 19.1177 5.01779 18.8072 5 18.49V8.00005C5 7.80113 5.07902 7.61037 5.21967 7.46972C5.36032 7.32906 5.55109 7.25005 5.75 7.25005C5.94891 7.25005 6.13968 7.32906 6.28033 7.46972C6.42098 7.61037 6.5 7.80113 6.5 8.00005V18.49C6.5 18.9 6.97 19.25 7.5 19.25H16.38C16.94 19.25 17.38 18.9 17.38 18.49V8.00005C17.38 7.78522 17.4653 7.57919 17.6172 7.42729C17.7691 7.27538 17.9752 7.19005 18.19 7.19005C18.4048 7.19005 18.6109 7.27538 18.7628 7.42729C18.9147 7.57919 19 7.78522 19 8.00005V18.49C18.9822 18.8072 18.9016 19.1177 18.763 19.4034C18.6243 19.6892 18.4303 19.9446 18.1921 20.1548C17.954 20.3651 17.6765 20.5259 17.3757 20.6281C17.075 20.7303 16.7569 20.7717 16.44 20.75ZM16.56 7.75005C16.4611 7.75139 16.363 7.73291 16.2714 7.6957C16.1798 7.65848 16.0966 7.60329 16.0267 7.53337C15.9568 7.46346 15.9016 7.38024 15.8644 7.28864C15.8271 7.19704 15.8087 7.09891 15.81 7.00005V5.51005C15.81 5.10005 15.33 4.75005 14.81 4.75005H9.22C8.67 4.75005 8.22 5.10005 8.22 5.51005V7.00005C8.22 7.19896 8.14098 7.38972 8.00033 7.53038C7.85968 7.67103 7.66891 7.75005 7.47 7.75005C7.27109 7.75005 7.08032 7.67103 6.93967 7.53038C6.79902 7.38972 6.72 7.19896 6.72 7.00005V5.51005C6.75872 4.88136 7.04203 4.29281 7.50929 3.87041C7.97655 3.44801 8.5906 3.22533 9.22 3.25005H14.78C15.4145 3.21723 16.0362 3.43627 16.51 3.8595C16.9838 4.28273 17.2713 4.87592 17.31 5.51005V7.00005C17.3113 7.09938 17.2929 7.19798 17.2558 7.29013C17.2187 7.38228 17.1637 7.46615 17.0939 7.53685C17.0241 7.60756 16.941 7.6637 16.8493 7.70201C16.7577 7.74033 16.6593 7.76006 16.56 7.76005V7.75005Z" fill="#03643b"></path> <path d="M10.22 17.0001C10.0219 16.9975 9.83263 16.9177 9.69253 16.7776C9.55244 16.6375 9.47259 16.4482 9.47 16.2501V11.7201C9.47 11.5212 9.54902 11.3304 9.68967 11.1898C9.83032 11.0491 10.0211 10.9701 10.22 10.9701C10.4189 10.9701 10.6097 11.0491 10.7503 11.1898C10.891 11.3304 10.97 11.5212 10.97 11.7201V16.2401C10.9713 16.3394 10.9529 16.438 10.9158 16.5302C10.8787 16.6223 10.8237 16.7062 10.7539 16.7769C10.6841 16.8476 10.601 16.9037 10.5093 16.9421C10.4177 16.9804 10.3193 17.0001 10.22 17.0001Z" fill="#03643b"></path> <path d="M13.78 17.0001C13.5811 17.0001 13.3903 16.9211 13.2497 16.7804C13.109 16.6398 13.03 16.449 13.03 16.2501V11.7201C13.03 11.5212 13.109 11.3304 13.2497 11.1898C13.3903 11.0491 13.5811 10.9701 13.78 10.9701C13.9789 10.9701 14.1697 11.0491 14.3103 11.1898C14.451 11.3304 14.53 11.5212 14.53 11.7201V16.2401C14.53 16.4399 14.4513 16.6317 14.3109 16.774C14.1706 16.9162 13.9798 16.9975 13.78 17.0001Z" fill="#03643b"></path> </g></svg>
                                                                </button>
                                                                <button id="list-express-minus-{{ $item->id }}" type="button" onClick="decQuantityExpress({{ $item->id }})"
                                                                    class="btn btn-outline-primary btn-icon btn-sm page-link btn-cart-radius" style="display: none">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="currentColor" data-spec="icon-minus" class="w-5 h-5" style="width: 16px; height: 16px;"><path fill="currentColor" d="M376 232H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h368c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8z"></path></svg>
                                                                </button>
                                                                <input type="number" min="1" step="1"
                                                                    onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57"
                                                                    name="quantityExpress-{{ $item->id }}" id="quantityExpress-{{ $item->id }}"
                                                                    class="form-control form-control-alternative express-quantity-input" placeholder="1" value="1" required="" autofocus=""
                                                                    onfocus="this.blur()" readonly="readonly">
                                                                <button id="list-express-plus-{{ $item->id }}" type="button" onClick="incQuantityExpress({{ $item->id }})"
                                                                    class="btn btn-outline-primary btn-icon btn-sm page-link btn-cart-radius">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="currentColor" data-spec="icon-plus" class="w-5 h-5" style="width: 16px; height: 16px;"><path fill="currentColor" d="M376 232H216V72c0-4.42-3.58-8-8-8h-32c-4.42 0-8 3.58-8 8v160H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h160v160c0 4.42 3.58 8 8 8h32c4.42 0 8-3.58 8-8V280h160c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8z"></path></svg>
                                                                </button>
                                                            </div>
                                                        @endif
                                                        {{--
                                                        <div class="allergens" style="text-align: right;">
                                                            @foreach ($item->allergens as $allergen)
                                                            <div class='allergen' data-toggle="tooltip" data-placement="bottom" title="{{$allergen->title}}" >
                                                                <img  src="{{$allergen->image_link}}" />
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                        --}}
                                                    </div>                                    
                                                </div>
                                                {{-- express 2 rows --}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                        <div id="productFullDetails" class="row borneFullDetails" style="display:none">
                            <div class="full-modal-body p-0 p-b-0">
                                <div class="card border-0 p-b-0">
                                    <div class="card-body px-lg-5 py-lg-5 pl-0 pr-0 p-b-0">
                                        <div id="fullItemDisplayer" class="p-b-0">
                                            <div class="col-sm col-md col-lg text-center pl-0 pr-0" id="full-modalImgPart">
                                                <button type="button" id="full-closeCurrentItem" onClick="closeCurrentItem()" class="btn btn-outline-primary btn-icon btn-sm page-link btn-cart-radius full-btn-close" >
                                                    <span class="btn-inner--icon btn-cart-icon"><i class="fa fa-close"></i></span>
                                                </button>
                                                <img id="full-modalImg" src="" >
                                            </div>
                                            <div class="col-sm col-md col-lg col-lg py-5-custom" id="full-modalItemDetailsPart">
                                                <h5 id="full-modalTitle" class="modal-title" id="modal-title-new-item"></h5>
                                                <input id="modalID" type="hidden"></input>
                                                <div class="mb-2">
                                                    <span id="modalPrice" class="new-price"></span>
                                                    <input type="hidden" name="inputModalPrice" id="inputModalPrice" value="" />
                                                </div>

                                                <p id="full-modalDescription"></p>
                                                <div id="full-variants-area">
                                                    <label class="form-control-label">{{ __('Select your options') }}</label>
                                                    <div id="full-variants-area-inside">
                                                    </div>
                                                </div>
                                                <div id="full-exrtas-area">
                                                    <br />
                                                    <label class="form-control-label" for="quantity">{{ __('Extras') }}</label>
                                                    <div id="full-exrtas-area-inside">
                                                    </div>
                                                </div>
                                               @if(!(isset($canDoOrdering)&&!$canDoOrdering) )
                                                <div class="quantity-area">
                                                    <div class="form-group d-none">
                                                        <br />
                                                        <label class="form-control-label" for="quantity">{{ __('Quantity') }}</label>
                                                        <!--<input type="number" name="quantity" id="quantity" class="form-control form-control-alternative" placeholder="1" value="1" required autofocus>-->
                                                            <input
                                                                    type="number"
                                                                    min="1"
                                                                    step="1"
                                                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                    name="quantity" 
                                                                    id="quantity" 
                                                                    class="form-control form-control-alternative" 
                                                                    placeholder="1" 
                                                                    value="1" 
                                                                    required 
                                                                    autofocus
                                                            >
                                                    </div>
                                                    <div class="quantity-btn  pkal-5 p-b-0">
                                                        <div id="addToCart1">
                                                            
                
                                                            <div class="row p-l-none flex-center-direction">
                                                                <div id="full-addToCartExpress" class="full-add-to-cart-express order-0 text-center">
                                                                    <button type="button" id="full-btn-add-tocart-express"  v-on:click='addToCartAct'
                                                                        class="btn btn-outline-primary btn-icon btn-sm page-link btn-cart-radius">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="currentColor" data-spec="icon-plus" class="w-5 h-5" style="width: 16px; height: 16px;"><path fill="currentColor" d="M376 232H216V72c0-4.42-3.58-8-8-8h-32c-4.42 0-8 3.58-8 8v160H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h160v160c0 4.42 3.58 8 8 8h32c4.42 0 8-3.58 8-8V280h160c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8z"></path></svg>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div  id="full-quantity-express-bloc" class="row quantity-express-bloc p-l-none" style="display:none">
                                                                <button id="full-cart-item-btn-trash" type="button" onClick="removeCartAct()"  class="btn btn-outline-primary btn-icon btn-sm page-link btn-cart-radius">
                                                                    <svg width="16px" height="16px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20 8.70007H4C3.90151 8.70007 3.80398 8.68067 3.71299 8.64298C3.62199 8.60529 3.53931 8.55005 3.46967 8.4804C3.40003 8.41076 3.34478 8.32808 3.30709 8.23709C3.2694 8.14609 3.25 8.04856 3.25 7.95007C3.25 7.85158 3.2694 7.75405 3.30709 7.66306C3.34478 7.57207 3.40003 7.48939 3.46967 7.41974C3.53931 7.3501 3.62199 7.29486 3.71299 7.25716C3.80398 7.21947 3.90151 7.20007 4 7.20007H20C20.1989 7.20007 20.3897 7.27909 20.5303 7.41974C20.671 7.5604 20.75 7.75116 20.75 7.95007C20.75 8.14899 20.671 8.33975 20.5303 8.4804C20.3897 8.62106 20.1989 8.70007 20 8.70007Z" fill="#03643b"></path> <path d="M16.44 20.75H7.56C7.24309 20.7717 6.92503 20.7303 6.62427 20.6281C6.3235 20.5259 6.04601 20.3651 5.80788 20.1548C5.56975 19.9446 5.37572 19.6892 5.23704 19.4034C5.09836 19.1177 5.01779 18.8072 5 18.49V8.00005C5 7.80113 5.07902 7.61037 5.21967 7.46972C5.36032 7.32906 5.55109 7.25005 5.75 7.25005C5.94891 7.25005 6.13968 7.32906 6.28033 7.46972C6.42098 7.61037 6.5 7.80113 6.5 8.00005V18.49C6.5 18.9 6.97 19.25 7.5 19.25H16.38C16.94 19.25 17.38 18.9 17.38 18.49V8.00005C17.38 7.78522 17.4653 7.57919 17.6172 7.42729C17.7691 7.27538 17.9752 7.19005 18.19 7.19005C18.4048 7.19005 18.6109 7.27538 18.7628 7.42729C18.9147 7.57919 19 7.78522 19 8.00005V18.49C18.9822 18.8072 18.9016 19.1177 18.763 19.4034C18.6243 19.6892 18.4303 19.9446 18.1921 20.1548C17.954 20.3651 17.6765 20.5259 17.3757 20.6281C17.075 20.7303 16.7569 20.7717 16.44 20.75ZM16.56 7.75005C16.4611 7.75139 16.363 7.73291 16.2714 7.6957C16.1798 7.65848 16.0966 7.60329 16.0267 7.53337C15.9568 7.46346 15.9016 7.38024 15.8644 7.28864C15.8271 7.19704 15.8087 7.09891 15.81 7.00005V5.51005C15.81 5.10005 15.33 4.75005 14.81 4.75005H9.22C8.67 4.75005 8.22 5.10005 8.22 5.51005V7.00005C8.22 7.19896 8.14098 7.38972 8.00033 7.53038C7.85968 7.67103 7.66891 7.75005 7.47 7.75005C7.27109 7.75005 7.08032 7.67103 6.93967 7.53038C6.79902 7.38972 6.72 7.19896 6.72 7.00005V5.51005C6.75872 4.88136 7.04203 4.29281 7.50929 3.87041C7.97655 3.44801 8.5906 3.22533 9.22 3.25005H14.78C15.4145 3.21723 16.0362 3.43627 16.51 3.8595C16.9838 4.28273 17.2713 4.87592 17.31 5.51005V7.00005C17.3113 7.09938 17.2929 7.19798 17.2558 7.29013C17.2187 7.38228 17.1637 7.46615 17.0939 7.53685C17.0241 7.60756 16.941 7.6637 16.8493 7.70201C16.7577 7.74033 16.6593 7.76006 16.56 7.76005V7.75005Z" fill="#03643b"></path> <path d="M10.22 17.0001C10.0219 16.9975 9.83263 16.9177 9.69253 16.7776C9.55244 16.6375 9.47259 16.4482 9.47 16.2501V11.7201C9.47 11.5212 9.54902 11.3304 9.68967 11.1898C9.83032 11.0491 10.0211 10.9701 10.22 10.9701C10.4189 10.9701 10.6097 11.0491 10.7503 11.1898C10.891 11.3304 10.97 11.5212 10.97 11.7201V16.2401C10.9713 16.3394 10.9529 16.438 10.9158 16.5302C10.8787 16.6223 10.8237 16.7062 10.7539 16.7769C10.6841 16.8476 10.601 16.9037 10.5093 16.9421C10.4177 16.9804 10.3193 17.0001 10.22 17.0001Z" fill="#03643b"></path> <path d="M13.78 17.0001C13.5811 17.0001 13.3903 16.9211 13.2497 16.7804C13.109 16.6398 13.03 16.449 13.03 16.2501V11.7201C13.03 11.5212 13.109 11.3304 13.2497 11.1898C13.3903 11.0491 13.5811 10.9701 13.78 10.9701C13.9789 10.9701 14.1697 11.0491 14.3103 11.1898C14.451 11.3304 14.53 11.5212 14.53 11.7201V16.2401C14.53 16.4399 14.4513 16.6317 14.3109 16.774C14.1706 16.9162 13.9798 16.9975 13.78 17.0001Z" fill="#03643b"></path> </g></svg>
                                                                </button>
                                                                <button id="full-cart-item-btn-minus" type="button" onClick="decCartAct()"  class="btn btn-outline-primary btn-icon btn-sm page-link btn-cart-radius" style="display: none;">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="currentColor" data-spec="icon-minus" class="w-5 h-5" style="width: 16px; height: 16px;"><path fill="currentColor" d="M376 232H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h368c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8z"></path></svg>
                                                                </button>
                                                                <input type="number" min="1" step="1"
                                                                    onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57"
                                                                    name="full-quantityExpress" id="full-quantityExpress"
                                                                    class="form-control form-control-alternative express-quantity-input" placeholder="1" value="1" required="" autofocus=""
                                                                     onfocus="this.blur()" readonly="readonly">
                                                                <button id="full-cart-item-btn-plus" type="button" onClick="incCartAct()" 
                                                                    class="btn btn-outline-primary btn-icon btn-sm page-link btn-cart-radius">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="currentColor" data-spec="icon-plus" class="w-5 h-5" style="width: 16px; height: 16px;"><path fill="currentColor" d="M376 232H216V72c0-4.42-3.58-8-8-8h-32c-4.42 0-8 3.58-8 8v160H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h160v160c0 4.42 3.58 8 8 8h32c4.42 0 8-3.58 8-8V280h160c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8z"></path></svg>
                                                                </button>
                                                            </div>
                                                            {{-- <button class="btn btn-primary d-none" v-on:click='addToCartAct'>{{ __('Add To Cart') }}</button> --}}
                                                        </div>
                                                    </div>
                                                   
                                                </div>
                                               @endif
                                                <!-- Inform if closed -->
                                                @if (isset($openingTime)&&!empty($openingTime))
                                                        <br />
                                                        <span class="closed_time">{{__('Opens')}} {{ $openingTime }}</span>
                                                        @if(!(isset($canDoOrdering)&&!$canDoOrdering))
                                                        <br />
                                                        <span class="text-muted">{{__('Pre orders are possible')}}</span>
                                                        @endif
                                                    @endif
                                                <!-- End inform -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @else
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <p class="text-muted mb-0">{{ __('Hmmm... Nothing found!')}}</p>
                                <br/><br/><br/>
                                <div class="text-center" style="opacity: 0.2;">
                                    <img src="https://www.jing.fm/clipimg/full/256-2560623_juice-clipart-pizza-box-pizza-box.png" width="200" height="200"></img>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div id="borne-cart" class="col-12 col-lg-3 borne-cart">
                    @include('restorants.partials.carts')
                </div>
            </div>
            <!-- Check if is installed -->
            @if (isset($doWeHaveImpressumApp)&&$doWeHaveImpressumApp)
                
                <!-- Check if there is value -->
                @if (strlen($restorant->getConfig('impressum_value',''))>5)
                    <h3>{{  __($restorant->getConfig('impressum_title','')) }}</h3>
                    <?php echo __($restorant->getConfig('impressum_value','')); ?>
                @endif
            @endif
            
        </div>

        @if(  !(isset($canDoOrdering)&&!$canDoOrdering)   )
            <div onClick="openNav()" class="callOutShoppingButtonBottom icon icon-shape bg-gradient-red text-white rounded-circle shadow mb-1">
                <div class="row col-12">
                    <div class="col-3 text-left pl-0">
                        <svg fill="#ffffff" height="64px" width="64px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 483.1 483.1" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M434.55,418.7l-27.8-313.3c-0.5-6.2-5.7-10.9-12-10.9h-58.6c-0.1-52.1-42.5-94.5-94.6-94.5s-94.5,42.4-94.6,94.5h-58.6 c-6.2,0-11.4,4.7-12,10.9l-27.8,313.3c0,0.4,0,0.7,0,1.1c0,34.9,32.1,63.3,71.5,63.3h243c39.4,0,71.5-28.4,71.5-63.3 C434.55,419.4,434.55,419.1,434.55,418.7z M241.55,24c38.9,0,70.5,31.6,70.6,70.5h-141.2C171.05,55.6,202.65,24,241.55,24z M363.05,459h-243c-26,0-47.2-17.3-47.5-38.8l26.8-301.7h47.6v42.1c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h141.2v42.1 c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h47.6l26.8,301.8C410.25,441.7,389.05,459,363.05,459z"></path> </g> </g></svg>
                        <small id="total-items-in-basket"></small>
                    </div>
                    <div class="col-5 text-right pl-0 pr-0" id="link-footer-basket" >{{ __('View basket') }}</div>
                    <div class="col-4 text-right pr-0" id="total-footer-basket"></div>
                </div>
            </div>
        @endif
        <div class="clear-reset-all">
            <button id="clearAndReset" onclick="clearResetAll();">
                <svg width="60px" height="60px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#fff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9 9L15 15" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M15 9L9 15" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <circle cx="12" cy="12" r="9" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></circle> </g></svg>
            </button>                                                 
        </div>                                     
    </section>
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-header bg-transparent pb-2">
                            <h4 class="text-center mt-2 mb-3">{{ __('Call Waiter') }}</h4>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                            <form role="form" method="post" action="{{ route('call.waiter') }}">
                                @csrf
                                @if (!isset($_GET['tid']))
                                    @include('partials.fields',$fields)
                                @else
                                    <input type="hidden" value="{{$_GET['tid']}}" name="table_id"  id="table_id"/>
                                @endif

                           
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary my-4">{{ __('Call Now') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@if (isset($showGoogleTranslate)&&$showGoogleTranslate&&!$showLanguagesSelector)
    @include('googletranslate::buttons')
@endif
@if ($showLanguagesSelector)
    @section('addiitional_button_1')
        <div class="dropdown web-menu">
            <a href="#" class="btn btn-neutral dropdown-toggle " data-toggle="dropdown" id="navbarDropdownMenuLink2">
                <!--<img src="{{ asset('images') }}/icons/flags/{{ strtoupper(config('app.locale'))}}.png" /> --> {{ $currentLanguage }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="">
                @foreach ($restorant->localmenus()->get() as $language)
                    @if ($language->language!=config('app.locale'))
                        <li>
                            <a class="dropdown-item" href="?lang={{ $language->language }}">
                                <!-- <img src="{{ asset('images') }}/icons/flags/{{ strtoupper($language->language)}}.png" /> --> {{$language->languageName}}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endsection
    @section('addiitional_button_1_mobile')
        <div class="dropdown mobile_menu">
           
            <a type="button" class="nav-link  dropdown-toggle" data-toggle="dropdown"id="navbarDropdownMenuLink2">
                <span class="btn-inner--icon">
                  <i class="fa fa-globe"></i>
                </span>
                <span class="nav-link-inner--text">{{ $currentLanguage }}</span>
              </a>
            <ul class="dropdown-menu" aria-labelledby="">
                @foreach ($restorant->localmenus()->get() as $language)
                    @if ($language->language!=config('app.locale'))
                        <li>
                            <a class="dropdown-item" href="?lang={{ $language->language }}">
                               <!-- <img src="{{ asset('images') }}/icons/flags/{{ strtoupper($language->language)}}.png" /> ---> {{$language->languageName}}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endsection
@endif
@php
    session(['isBorne' => true]);  //elle sera une variable configurable en backend donc administrable !
@endphp
@section('js')
    <script>
        var CASHIER_CURRENCY = "<?php echo  config('settings.cashier_currency') ?>";
        var LOCALE="<?php echo  App::getLocale() ?>";
        var IS_POS=false;
        var TEMPLATE_USED="<?php echo config('settings.front_end_template','defaulttemplate') ?>";
        var DISPLAY_CADDY = "";
    </script>
    <script src="{{ asset('custom') }}/js/metro.min.js"></script>
    <script src="{{ asset('custom') }}/js/order.js"></script>
    @include('restorants.phporderinterface') 
    @if (isset($showGoogleTranslate)&&$showGoogleTranslate&&!$showLanguagesSelector)
        @include('googletranslate::scripts')
    @endif
@endsection

@if (isset($showGoogleTranslate)&&$showGoogleTranslate&&!$showLanguagesSelector)
    @section('head')
        <!-- Style  Google Translate -->
        <link type="text/css" href="{{ asset('custom') }}/css/gt.css" rel="stylesheet">
    @endsection
@endif
