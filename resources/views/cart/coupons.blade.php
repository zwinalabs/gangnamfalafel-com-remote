
<div class="row col-12  mb-2 mt-2 ">
    <div class="col-11 f-float-left">
        <input  id="coupon_code" name="coupon_code" type="text" class="form-control coupons-input" placeholder="{{ __('Discount coupon')}}">
    </div>
    <div class="col-1 f-float-left p13-2">
        <span><i id="promo_code_succ" class="ni ni-check-bold text-success"></i></span>
        <span><i id="promo_code_war" class="ni ni-fat-remove text-danger"></i></span>
    </div>
</div>

<div class="row col-12 mb-2">
    <div class="col-6"><button id="btn-cancel-comment" type="button" class="btn btn-outline-primary action-btn close" data-dismiss="modal" aria-label="Close" onClick="setCommentToTxt();">{{ __('Cancel') }}</button></div>
    <div class="col-6 text-right"><button  id="btn-valid-comment" type="button" class="btn btn-outline-primary action-btn close"  onClick="setDiscountCoupon()">{{ __('Apply') }}</button></div>
</div>

