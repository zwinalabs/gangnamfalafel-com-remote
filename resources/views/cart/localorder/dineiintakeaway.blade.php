<div class=" card-profile">
    <div class="px-4">
      <div class="mt-5">
        <h6>{{ __('Dine In / Takeaway') }}<span class="font-weight-light"></span></h6>
      </div>
      <div class="card-content border-top">
       
        <div class="custom-control custom-radio mb-3">
          <input name="dineType" class="custom-control-input" id="deliveryTypeDinein" type="radio" value="dinein" ontouchstart="checkoutOnsiteTakeAway(0)" onClick="checkoutOnsiteTakeAway(0)">
          <label class="custom-control-label" for="deliveryTypeDinein">{{ __('Dine In') }}</label>
        </div>
        <div class="custom-control custom-radio mb-3">
          <input name="dineType" class="custom-control-input" id="deliveryTypeTakeAway" type="radio" value="takeaway" ontouchstart="checkoutOnsiteTakeAway(1)" onClick="checkoutOnsiteTakeAway(1)">
          <label class="custom-control-label" for="deliveryTypeTakeAway">{{ __('Takeaway') }}</label>
        </div>
      </div>
    </div>
  </div>