<div id="cartSideNav" class="sidenav-cart sidenav-cart-close notranslate">
    <div class="offcanvas-menu-inner">
        <a href="javascript:void(0)" class="closebtn col-12 d-none" onclick="closeNav()">×</a>
        <div class="minicart-content">
            <div class="text-center mobile-menu col-4 p-l-none d-lg-none" style="display:block">
                <a type="button" class="btn btn-default btn-block text-white btn-sm btn-cart-header-top" onclick="closeNav()">
                    <i class="fa fa-arrow-left">&nbsp;</i>
                </a>
                <br/>
            </div>
            <div class="minicart-heading text-center">
                <h4>{{ __('Shopping Cart') }}</h4>
            </div>
            <div class="searchable-container">
                <div id="cartList">
                    <div  class="cart-loader">
                        <span class="loader-outer">
                            <span class="loader-inner"></span>
                        </span>
                    </div>
                    <div v-for="item in items" class="items col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix" :class="'cart-item-line-'+item.attributes.id">
                        <input type="hidden" :name="item.id" :id="item.id" :value="item.attributes.id">
                        <div class="info-block block-info clearfix" v-cloak>
                            <div class="square-box pull-left d-none">
                                <img :src="item.attributes.image"  class="productImage" width="100" height="105" alt="">
                            </div>
                            <h6 class="product-item_title">@{{ item.name }}</h6>
                            
                            <div class="row m-r-0">
                                <div class="col-5">
                                    <p class="product-item_quantity">@{{ item.attributes.friendly_price }}</p>
                                </div>
                                <div class="row col-7 pr-0 flex-right-direction">
                                    <input :id="'cart-item-product-' + item.attributes.id" type="hidden" :name="'cart-item-product-' + item.attributes.id" :value="item.id">
                                    <input :id="'cart-item-product-qty-' + item.attributes.id" type="hidden" :name="'cart-item-product-qty-' + item.attributes.id" :value="item.quantity">
                                    <button :id="'cart-item-btn-trash-' + item.attributes.id" type="button" v-on:click="remove(item.id, item.attributes.id)"  :value="item.id" class="btn btn-outline-primary btn-icon btn-sm page-link btn-cart-radius">
                                        <svg fill="#03643b" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px" viewBox="0 0 490.646 490.646" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M399.179,67.285l-74.794,0.033L324.356,0L166.214,0.066l0.029,67.318l-74.802,0.033l0.025,62.914h307.739L399.179,67.285z M198.28,32.11l94.03-0.041l0.017,35.262l-94.03,0.041L198.28,32.11z"></path> <path d="M91.465,490.646h307.739V146.359H91.465V490.646z M317.461,193.372h16.028v250.259h-16.028V193.372L317.461,193.372z M237.321,193.372h16.028v250.259h-16.028V193.372L237.321,193.372z M157.18,193.372h16.028v250.259H157.18V193.372z"></path> </g> </g> </g></svg>
                                    </button>
                                    <button :id="'cart-item-btn-minus-' + item.attributes.id" type="button" v-on:click="decQuantity(item.id, item.attributes.id)" :value="item.id" class="btn btn-outline-primary btn-icon btn-sm page-link btn-cart-radius" style="display: none;">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="currentColor" data-spec="icon-minus" class="w-5 h-5" style="width: 16px; height: 16px;"><path fill="currentColor" d="M376 232H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h368c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8z"></path></svg>
                                    </button>
                                    <input :id="'cart-item-product-qty-txt-' + item.attributes.id" type="number" :name="'cart-item-product-qty-txt-' + item.attributes.id" :value="item.quantity" class="form-control form-control-alternative express-quantity-input"  onfocus="this.blur()" readonly="readonly">
                                    <button :id="'cart-item-btn-plus-' + item.attributes.id"  type="button" v-on:click="incQuantity(item.id, item.attributes.id)" :value="item.id" class="btn btn-outline-primary btn-icon btn-sm page-link btn-cart-radius">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="currentColor" data-spec="icon-plus" class="w-5 h-5" style="width: 16px; height: 16px;"><path fill="currentColor" d="M376 232H216V72c0-4.42-3.58-8-8-8h-32c-4.42 0-8 3.58-8 8v160H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h160v160c0 4.42 3.58 8 8 8h32c4.42 0 8-3.58 8-8V280h160c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8z"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="totalPrices" v-cloak>
                    <div  class="card card-stats mb-1 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col text-center">
                                    <div v-if="itemsCount==0">
                                        <svg fill="#089151" height="48px" width="48px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 483.1 483.1" xml:space="preserve" stroke="#089151" style="
                                            margin-left: auto;
                                            margin-right:auto;
                                            display:block;
                                        "><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M434.55,418.7l-27.8-313.3c-0.5-6.2-5.7-10.9-12-10.9h-58.6c-0.1-52.1-42.5-94.5-94.6-94.5s-94.5,42.4-94.6,94.5h-58.6 c-6.2,0-11.4,4.7-12,10.9l-27.8,313.3c0,0.4,0,0.7,0,1.1c0,34.9,32.1,63.3,71.5,63.3h243c39.4,0,71.5-28.4,71.5-63.3 C434.55,419.4,434.55,419.1,434.55,418.7z M241.55,24c38.9,0,70.5,31.6,70.6,70.5h-141.2C171.05,55.6,202.65,24,241.55,24z M363.05,459h-243c-26,0-47.2-17.3-47.5-38.8l26.8-301.7h47.6v42.1c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h141.2v42.1 c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h47.6l26.8,301.8C410.25,441.7,389.05,459,363.05,459z"></path> </g> </g></svg>
                                    </div>
                                    <span v-if="itemsCount==0">{{ __('Cart is empty') }}</span>
                                    <span v-if="itemsCount"><strong>{{ __('Subtotal') }}:</strong></span>
                                    <span v-if="itemsCount" :value="itemsCount" class="ammount"><strong>@{{ totalPriceFormat }}</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div v-if="itemsCount" v-cloak>
                        <a href="javascript:void(0)" onClick="showCheckoutDetailsModel();" class="btn btn-primary text-white mb-7 hide-mobile-only">{{ __('Checkout') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
