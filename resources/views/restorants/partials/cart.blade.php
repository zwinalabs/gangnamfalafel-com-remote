<div id="cartSideNav" class="sidenav-cart sidenav-cart-close notranslate">
    <div class="offcanvas-menu-inner">
        <div class="minicart-content">
            <div class="minicart-heading">
                <h4>{{ __('Shopping Cart') }}</h4>
            </div>
            <div class="searchable-container">
                <div id="cartList">
                    <div v-for="item in items" class="items col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">
                        <div class="info-block block-info clearfix" v-cloak>
                            <div class="square-box pull-left">
                                <img :src="item.attributes.image"  class="productImage" width="100" height="105" alt="">
                            </div>
                            <h6 class="product-item_title">@{{ item.name }}</h6>
                            <p class="product-item_quantity">@{{ item.quantity }} x @{{ item.attributes.friendly_price }}</p>
                            <div class="row">
                                <input :id="'cart-item-product-' + item.attributes.id" type="hidden" :name="'cart-item-product-' + item.attributes.id" :value="item.id">
                                <input :id="'cart-item-product-qty-' + item.attributes.id" type="hidden" :name="'cart-item-product-qty-' + item.attributes.id" :value="item.quantity">
                                <button type="button" v-on:click="decQuantity(item.id)" :value="item.id" class="btn btn-outline-primary btn-icon btn-sm page-link btn-cart-radius">
                                    <span class="btn-inner--icon btn-cart-icon"><i class="fa fa-minus"></i></span>
                                </button>
                                <button type="button" v-on:click="incQuantity(item.id)" :value="item.id" class="btn btn-outline-primary btn-icon btn-sm page-link btn-cart-radius">
                                    <span class="btn-inner--icon btn-cart-icon"><i class="fa fa-plus"></i></span>
                                </button>
                                <button type="button" v-on:click="remove(item.id)"  :value="item.id" class="btn btn-outline-primary btn-icon btn-sm page-link btn-cart-radius">
                                    <span class="btn-inner--icon btn-cart-icon"><i class="fa fa-trash"></i></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="totalPrices" v-cloak>
                    <div  class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <span v-if="itemsCount==0">{{ __('Cart is empty') }}!</span>
                                    <span v-if="itemsCount"><strong>{{ __('Subtotal') }}:</strong></span>
                                    <span v-if="itemsCount" class="ammount"><strong>@{{ totalPriceFormat }}</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div v-if="itemsCount" v-cloak>
                        {{-- href="/cart-checkout" --}}
                        <a href="javascript:void(0)" onClick="$('#checkoutModal').modal('show')"  class="btn btn-primary text-white">{{ __('Checkout') }}</a>
                    </div>
                    <br/>
                    <div v-if="itemsCount" v-cloak class="text-center mobile-menu" style="display:block">
                        <a type="button" class="btn btn-default btn-block text-white btn-sm" style="text-transform:none" onclick="closeNav()">{{ __('Continue Shopping') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
