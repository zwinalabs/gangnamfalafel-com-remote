@if(!config('settings.hide_cod'))
    <div class="text-center" id="totalSubmitCOD"  style="display: {{ config('settings.default_payment')=="cod"&&!config('settings.hide_cod')?"block":"none"}};" >
        <button
            id="go_payement_btn"
            v-if="totalPrice"
            type="button"
            class="btn btn-success mt-4 paymentbutton bg-gradient-red icon-shape callOutShoppingButtonBottom mb-1 go_pay_btn_bord"
            onclick="document.getElementById('order-form').submit(); "
        >{{ __('Place order') }}</button>
    </div>
@endif
