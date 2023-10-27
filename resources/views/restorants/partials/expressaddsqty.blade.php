@if (!(isset($canDoOrdering) && !$canDoOrdering))
    <div class="row p-l-none">
        <div id="addToCartExpress-{{ $item->id }}"
            class="add-to-cart-express-{{ $item->id }} order-0 text-center">
            <button id="btn-add-tocart-express-{{ $item->id }}" class="btn btn-primary btn-express-add-to-cart"
                onClick='addToCartActExpress({{ $item->id }})'>{{ __('Add') }}</button>
        </div>
    </div>
    <div class="row quantity-express-bloc p-l-none" id="quantity-express-bloc-{{ $item->id }}" style="display:none">
        <button type="button" onClick="decQuantityExpress({{ $item->id }})" :value="item.id"
            class="btn btn-outline-primary btn-icon btn-sm page-link btn-cart-radius">
            <span class="btn-inner--icon btn-cart-icon"><i class="fa fa-minus"></i></span>
        </button>
        <input type="number" min="1" step="1"
            onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57"
            name="quantityExpress-{{ $item->id }}" id="quantityExpress-{{ $item->id }}"
            class="form-control form-control-alternative" placeholder="1" value="1" required="" autofocus=""
            style="width:62px;margin-right: 0.5rem;text-align: center;">
        <button type="button" onClick="incQuantityExpress({{ $item->id }})" :value="item.id"
            class="btn btn-outline-primary btn-icon btn-sm page-link btn-cart-radius">
            <span class="btn-inner--icon btn-cart-icon"><i class="fa fa-plus"></i></span>
        </button>
    </div>
@endif
