<div id="cartCheckoutContent" class="sidenav-cart sidenav-cart-close notranslate">
    <div class="offcanvas-menu-inner">
        <div class="minicart-content">
            <div class="minicart-heading">
                <h4>{{ __('Votre command') }}</h4>
            </div>
            <div class="searchable-container">
                <div id="cartListCheckout">
                    @include('cart.cartcheckouts')
                </div>
            </div>
        </div>
    </div>
</div>
