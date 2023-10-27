<!-- List of items -->
<div  id="cartListDetails" class="border-top pt-3">
    <div class="items col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix headed-div pl-0 p-10px">
        <div class="row m-r-0">
            <div class="col-7 text-center pl-0 pr-0">{{ __('Item') }}</div>
            {{--<div class="col-2 text-center pl-0 pr-0 d-none">{{ __('Unit Price') }}</div>--}}
            <div class="col-2 text-center pl-0 pr-0">{{ __('Quantity') }}</div>
            <div class="col-3 text-center pl-0 pr-0">{{ __('Amount') }}</div>
        </div>
    </div>
    <div  v-for="item in items" class="items col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix border-top pl-0 p-10px">
        <div v-if="itemsCount!=0" class="info-block block-info clearfix" v-cloak>
            <div class="row m-r-0">
                <div class="col-1 text-left pl-0 pr-0">&nbsp;</div>
                <div class="col-6 text-left pl-0 pr-0">@{{ item.name }}</div>
                {{--<div class="col-2 text-center pl-0 pr-0 d-none">@{{ item.attributes.friendly_price }}</div>--}}
                <div class="col-2 text-center pl-0 pr-0">x@{{ item.quantity }}</div>
                <div class="col-3 text-center pl-0 pr-0">&euro;@{{ item.quantity * item.price }}</div>
            </div>
        </div>
    </div>
</div>
<div id="totalPricesCheckout" v-cloak>
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
                </div>
                <div class="col text-right">
                    <span v-if="itemsCount" class=""><strong>{{ __('Total Price') }}:</strong></span>
                    <span v-if="itemsCount" :value="itemsCount" class="ammount"><strong>@{{ totalPriceFormat }}</strong></span>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-6">
        <h6 class="mt-3 comment-title">{{ __('Comment') }}<span class="font-weight-light"></span></h6>
        <textarea name="comment" id="cart-details-comment" class="green-border comment-field" placeholder="{{ __( 'Your comment here' ) }} ..." onChange="setComments('cart-details-comment');" ></textarea>
    </div>
    <div class="text-center" v-if="itemsCount" v-cloak>
        <a href="javascript:void(0)" onClick="showCheckoutModel();"  class="btn btn-success mt-4 paymentbutton bg-gradient-red icon-shape callOutShoppingButtonBottomCheckout mb-1 go_pay_btn_bord hide-mobile-only">{{ __('Valider') }}</a>
    </div>
</div>
<!-- End List of items -->
