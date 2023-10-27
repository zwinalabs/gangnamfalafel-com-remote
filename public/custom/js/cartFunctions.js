"use strict";
var cartContent = null;
var cartContentCheckout = null;
var cartContentMobile = null;
var cartContentCheckoutDetails = null;
var cartTotal = null;
var cartTotalMobile = null;
var cartTotalCheckoutDetails = null;
var cartCounter = null;
var footerPages = null;
var total = null;
var cartTotalQty = 0;

// "Global" flag to indicate whether the select2 control is oedropped down).
var _selectIsOpen = false;

$('#localorder_phone').hide();

/**
 *
 * @param {Number} net The net value
 * @param {Number} delivery The delivery value
 * @param {Boolean} enableDelivery Disable or enable delivery
 */
function updatePrices(net, delivery, enableDelivery) {
    net = parseFloat(net + "");
    delivery = parseFloat(delivery + "");
    var deduct = cartTotal.deduct;
    console.log("Deduct is " + deduct);

    var formatter = new Intl.NumberFormat(LOCALE, {
        style: 'currency',
        currency: CASHIER_CURRENCY,
    });

    //totalPrice -- Subtotal
    //withDelivery -- Total with delivery

    //Subtotal
    cartTotal.totalPrice = net;
    cartTotal.totalPriceFormat = formatter.format(net);

    if (enableDelivery) {
        //Delivery
        cartTotal.delivery = true;
        cartTotal.deliveryPrice = delivery;
        cartTotal.deliveryPriceFormated = formatter.format(delivery);

        //Total
        var ndd = net + delivery - deduct;
        cartTotal.withDelivery = ndd;
        cartTotal.withDeliveryFormat = formatter.format(ndd); //+"==>"+new Date().getTime();
        total.totalPrice = ndd;



    } else {
        //No delivery
        //Delivery
        cartTotal.delivery = false;

        //Total
        var nd = net - deduct;
        cartTotal.withDelivery = nd;
        cartTotal.withDeliveryFormat = formatter.format(nd);
        total.totalPrice = nd;
    }
    total.lastChange = new Date().getTime();
    cartTotal.lastChange = new Date().getTime();
    cartTotalCheckoutDetails = cartTotal;
    console.log("DAta");
    console.log(cartTotal)
    console.log("TotalPrice is " + total.totalPrice);
    console.log("TotalPricewithDelivery is " + cartTotal.withDelivery);
    setTotalPriceBottomCart(total.totalPrice);
}

function setDeduct(deduction) {
    var formatter = new Intl.NumberFormat(LOCALE, {
        style: 'currency',
        currency: CASHIER_CURRENCY,
    });

    cartTotal.deduct = deduction;
    cartTotal.deductFormat = formatter.format(deduction);
    total.lastChange = null;
    cartTotal.lastChange = null;
    getCartContentAndTotalPrice();
}

function updateSubTotalPrice(net, enableDelivery) {
    updatePrices(net, (cartTotal.deliveryPrice ? cartTotal.deliveryPrice : 0), enableDelivery)
}
/**
 * getCartContentAndTotalPrice
 * This functions connect to laravel to get the current cart items and total price
 * Saves the values in vue
 */
function getCartContentAndTotalPrice(checkout=false) {
    displayLoader(false);
    if (localStorage.getItem("cartLS") && checkout == false) {
        cartLS = JSON.parse(localStorage.getItem("cartLS"));
        cartLS.total = (Object.keys(cartLS.data).length > 0)?cartLS.total:0;
        cartContent.items = cartLS.data;
        cartContentCheckout = cartContent;
        cartContentCheckoutDetails.items = cartLS.data;
        //cartContentMobile.items=response.data.data;
        updateSubTotalPrice(cartLS.total, true);
    }else {
        axios.get('/cart-getContent').then(function(response) {
            let fullCartData = response.data;
            let cItems = fullCartData.data;
            for(var key in cItems ) {
                if (cItems.hasOwnProperty(key)) {
                    cItems[key].remote = 1;
                }
            }
            fullCartData.data = cItems;
                
        cartContent.items = fullCartData.data;
        cartContentCheckout = cartContent;
        cartContentCheckoutDetails.items = fullCartData.data;
        cartLS = fullCartData;
        localStorage.setItem("cartLS", JSON.stringify(cartLS));
        console.log("getCartContentAndTotalPrice:::::::cartContentCheckout".cartContentCheckout);
        updateSubTotalPrice(response.data.total, true);
        })
        .catch(function(error) {

        });
    } 
}

$("#promo_code_btn").on('click', function() {
    var code = $('#coupon_code').val();

    axios.post('/coupons/apply', { code: code, cartValue: cartTotal.totalPrice }).then(function(response) {
        if (response.data.status) {
            $("#promo_code_btn").attr("disabled", true);
            $("#promo_code_btn").attr("readonly");

            $("#promo_code_war").hide();
            $("#promo_code_succ").show();

            setDeduct(response.data.deduct);
            js.notify(response.data.msg, "success");

            $('#promo_code_btn').hide();

            //$( "#coupon_code" ).prop( "disabled", true );
        } else {
            $("#promo_code_succ").hide();
            $("#promo_code_war").show();

            js.notify(response.data.msg, "warning");
        }
    }).catch(function(error) {

    });

});

$("#fborder_btn").on('click', function() {

    var address = $('#addressID').val();
    var comment = $('#comment').val();

    axios.post('/fb-order', {
            address: address,
            comment: comment
        })
        .then(function(response) {

            if (response.status) {
                var text = response.data.msg;

                var fullLink = document.createElement('input');
                document.body.appendChild(fullLink);
                fullLink.value = text;
                fullLink.select();
                document.execCommand("copy", false);
                fullLink.remove();

                swal({
                    title: "Good job!",
                    text: "Order is submited in the system and copied in your clipboard. Next, messenger will open and you need to paste the order details there.",
                    icon: "success",
                    button: "Continue to messenger",
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        document.getElementById('order-form').submit();
                    }
                });

            }
        }).catch(function(error) {

        });
});

/**
 * Removes product from cart, and calls getCartConent
 * @param {Number} product_id
 */
function removeProductIfFromCart(product_id, item_id=null) {
    if (localStorage.getItem("cartLS")) {
        cartLS = JSON.parse(localStorage.getItem("cartLS"));
    }
    let id_full_express = $("#modalID").text();
    showAddBtnAfterRemoveFromCart(item_id);
    removeByIdLS(product_id);
    if(id_full_express ==  item_id){
        $('#full-addToCartExpress').show();
        $('#full-quantity-express-bloc').hide();
        $("#full-quantityExpress").val(1);
    }
    
    localStorage.setItem("cartLS", JSON.stringify(cartLS));
    getCartContentAndTotalPrice();
    hideFoodQty(item_id);
    axios.post('/cart-remove', { id: product_id }).then(function(response) {
        console.log(response);
    }).catch(function(error) {
    });
}

/**
 * Update the product quantity, and calls getCartConent
 * @param {Number} product_id
 */
function incCart(product_id, item_id=null) {
    if (localStorage.getItem("cartLS")) {
        cartLS = JSON.parse(localStorage.getItem("cartLS"));
    }
    let id_full_express = $("#modalID").text();
    let cart_product_qty = $("#cart-item-product-qty-txt-" + item_id).val();
    hideTrashShowMinus(item_id);
    let qty = parseInt(cartLS.data[product_id].quantity);
    cartLS.data[product_id].quantity = ++qty;
    if(id_full_express ==  item_id){
        $("#full-quantityExpress").val(qty);
    }
    cartLS.total = calculeTotal(product_id);
    localStorage.setItem("cartLS", JSON.stringify(cartLS));
    getCartContentAndTotalPrice();

    /*axios.get('/cartinc/' + product_id).then(function(response) {
        if(response.status){
            console.log('success > incCart > st: '+response.status+' > msg:'+response.errMsg);
        }else{
            console.log('error > incCart > st: '+response.status+' > msg:'+response.errMsg);
        }
    }).catch(function(error) { 

    });*/
}

function decCart(product_id, item_id=null) {
    if (localStorage.getItem("cartLS")) {
        cartLS = JSON.parse(localStorage.getItem("cartLS"));
    }
    let cart_product_qty = $("#cart-item-product-qty-txt-" + item_id);
    let id_full_express = $("#modalID").text();
    if(cart_product_qty !== undefined && typeof cart_product_qty !== 'undefined'){
        if(cart_product_qty.val() <=2 ){
            if(id_full_express ==  item_id){
                $("#full-quantityExpress").val(1);
            }
            decQuantityHideAndRemoveCartItem(item_id);
            if(cart_product_qty.val() <= 1 ){
                $('#full-btn-add-tocart-express-' + item_id).show();
                $('#quantity-express-bloc-' + item_id).hide();
                $("#quantityExpress-" + item_id).val(1);
                removeProductIfFromCart(product_id, item_id);
            }
        }
    }else{
        $('#full-btn-add-tocart-express-' + item_id).show();
        $('#quantity-express-bloc-' + item_id).hide();
        $("#quantityExpress-" + item_id).val(1);
    }
    let qty = parseInt(cartLS.data[product_id].quantity);
    cartLS.data[product_id].quantity = --qty;
    if(id_full_express ==  item_id){
        $("#full-quantityExpress").val(qty);
    }
    cartLS.total = calculeTotal(product_id, "-");
    localStorage.setItem("cartLS", JSON.stringify(cartLS));
    getCartContentAndTotalPrice();

   /* axios.get('/cartdec/' + product_id).then(function(response) {
        if(response.status){
            console.log('success > incCart > st: '+response.status+' > msg:'+response.errMsg);
        }else{
            console.log('error > incCart > st: '+response.status+' > msg:'+response.errMsg);
        }
    }).catch(function(error) {
    });*/
}

//GET PAGES FOR FOOTER
function getPages() {
    axios.get('/footer-pages').then(function(response) {
            footerPages.pages = response.data.data;
        })
        .catch(function(error) {

        });

};

/**
 * Removes product from cart, and calls getCartConent
 * @param {Number} product_id
 */
function removeProductIfFromCartCheckout(product_id, remote=true){
    if (localStorage.getItem("cartLS")) {
        cartLS = JSON.parse(localStorage.getItem("cartLS"));
    }
    console.log("removeProductIfFromCartCheckout: "+product_id);
    cartLS.total = calculeTotal(product_id, "-");
    removeByIdLS(product_id);
    localStorage.setItem("cartLS", JSON.stringify(cartLS));
    if(remote){
        axios.post('/cart-remove', {id:product_id}).then(function (response) {
            getCartContentAndTotalPrice(true);
        }).catch(function (error) {
        
        });
    }
 }

 /**
 * Update the product quantity, and calls getCartConent
 * @param {Number} product_id
 */
function incCartCheckout(product_id){
    if (localStorage.getItem("cartLS")) {
        cartLS = JSON.parse(localStorage.getItem("cartLS"));
    }
    console.log("incCartCheckout: "+product_id);
    let qty = parseInt(cartLS.data[product_id].quantity);
    cartLS.data[product_id].quantity = --qty;
    cartLS.total = calculeTotal(product_id);
    localStorage.setItem("cartLS", JSON.stringify(cartLS));
    axios.get('/cartinc/'+product_id).then(function (response) {
        getCartContentAndTotalPrice(true);
    }).catch(function (error) {
        
    });
}


function decCartCheckout(product_id){
    if (localStorage.getItem("cartLS")) {
        cartLS = JSON.parse(localStorage.getItem("cartLS"));
    }
    console.log("decCartCheckout: "+product_id);
    let cart_product_qty = $("#checkout-qty-span-ipt-" + product_id);
    if(cart_product_qty !== undefined && typeof cart_product_qty !== 'undefined'){
        if(cart_product_qty.val() <= 2 ){
            $("#cart-item-btns-minus-"+ product_id).hide();
            $("#cart-item-btns-trash-"+ product_id).show();
            if(cart_product_qty.val() <= 1 ){
                removeProductIfFromCartCheckout(product_id);
            }
        }
    }
    let qty = parseInt(cartLS.data[product_id].quantity);
    cartLS.data[product_id].quantity = --qty;
    localStorage.setItem("cartLS", JSON.stringify(cartLS));
    axios.get('/cartdec/'+product_id).then(function (response) {
        getCartContentAndTotalPrice(true);
    }).catch(function (error) {
    
    });
}

function dineTypeSwitch(mod) {


    //Phone field width
    $('#phone').css("padding-left", "95px");

    $('.tablepicker').hide();
    $('.takeaway_picker').hide();
    $('.qraddressBox').hide();

    if (mod == "dinein") {
        $('.tablepicker').show();
        $('.takeaway_picker').hide();
        $('.qraddressBox').hide();

        //phone
        $('#localorder_phone').hide();
    }

    if (mod == "takeaway") {
        $('.tablepicker').hide();
        $('.takeaway_picker').show();
        $('.c').hide();

        //phone
        $('#localorder_phone').show();
    }



    if (mod == "delivery") {
        $('.tablepicker').hide();
        $('.takeaway_picker').show();
        orderTypeSwither(mod);
        $('.qraddressBox').show();

        //phone
        $('#localorder_phone').show();
    }

}

function orderTypeSwither(mod) {


    $('.delTime').hide();
    $('.picTime').hide();

    if (mod == "pickup") {
        updatePrices(cartTotal.totalPrice, null, false)
        $('.picTime').show();
        $('#addressBox').hide();
    }

    if (mod == "delivery") {
        $('.delTime').show();
        $('#addressBox').show();
        getCartContentAndTotalPrice(true);
    }
}

setTimeout(function() {
    if (typeof initialOrderType !== 'undefined') {

        orderTypeSwither(initialOrderType);
    } else {

    }

}, 1000);

function chageDeliveryCost(deliveryCost) {
    $("#deliveryCost").val(deliveryCost);
    updatePrices(cartTotal.totalPrice, deliveryCost, true);

}

//First we beed to capture the event of chaning of the address
function deliveryAddressSwithcer() {
    $("#addressID").change(function() {
        //The delivery cost
        var deliveryCost = $(this).find(':selected').data('cost');



        //We now need to pass this cost to some parrent funct for handling the delivery cost change
        if (deliveryCost != undefined) {
            chageDeliveryCost(deliveryCost);
        }

    });

}

function deliveryAreaSwithcer() {
    $("#delivery_area").change(function() {
        //The delivery cost
        var deliveryCost = $(this).find(':selected').data('cost');



        //We now need to pass this cost to some parrent funct for handling the delivery cost change
        chageDeliveryCost(deliveryCost);



    });

}

function deliveryTypeSwitcher() {
    $('.picTime').hide();
    $('input:radio[name="deliveryType"]').change(function() {
        orderTypeSwither($(this).val());
    })
}

function dineTypeSwitcher() {
    $('input:radio[name="dineType"]').on('change', function() {
        $('.delTimeTS').hide();
        $('.picTimeTS').show();
        dineTypeSwitch($(this).val());
    })
}

function paymentTypeSwitcher() {
    $('input:radio[name="paymentType"]').change(

        function() {
            //HIDE ALL
            $('#totalSubmitCOD').hide()
            $('#totalSubmitStripe').hide()
            $('#stripe-payment-form').hide()

            //One for all
            $('.payment_form_submiter').hide()


            if ($(this).val() == "cod") {
                //SHOW COD
                $('#totalSubmitCOD').show();
            } else if ($(this).val() == "stripe") {
                //SHOW STRIPE
                $('#totalSubmitStripe').show();
                $('#stripe-payment-form').show()
            } else {
                $('#' + $(this).val() + '-payment-form').show()
            }
        });
}

function itemSearch() {

    $("body")
        .on("select2:opening", event => {})

    .on("keypress", event => {
        if ($(event.target).is('input, textarea, select')) return;
        if (_selectIsOpen) {
            return;
        }


        if (event.keyCode === 13) {
            if ($('#addToCart1').is(":visible")) {
                addToCartVUE();
            }
            return;
        }
        const charCode = event.which;
        if (!(event.altKey || event.ctrlKey || event.metaKey) &&
            ((charCode >= 48 && charCode <= 57) ||
                (charCode >= 65 && charCode <= 90) ||
                (charCode >= 97 && charCode <= 122))
        ) {
            $('#itemsSearch').select2("open");
            $("input.select2-search__field")
                .eq(0)
                .val(String.fromCharCode(charCode));
        }
    });

    $('select').on('change', function() {
        if (this.id == "itemsSearch" && this.value != "") {
            let target = $("#item-listing-"+this.value);
            $(document).scrollTop(target.offset().top-100);
            //setCurrentItem(this.value);
            //openCurrentItem(this.value);
        }
    });
}
function setTotalPriceBottomCart(totPrice){
    var formatter = new Intl.NumberFormat(LOCALE, {
        style: 'currency',
        currency: CASHIER_CURRENCY,
    });
    totPrice = formatter.format(totPrice);
    if($("#total-footer-basket").length > 0)
    {
        $("#total-footer-basket").html("<strong>"+totPrice+"</strong>");
    }
    if($("#total-footer-basket-borne").length > 0)
    {
        $("#total-footer-basket-borne").html("<strong>"+totPrice+"</strong>");
    }
    hideAddExpressButton();
    displayTotalItemsBasket();
}

var removeCheckout = function(product_id) {
    removeProductIfFromCartCheckout(product_id);
}

var incQuantityCheckout = function(product_id) {
    incCartCheckout(product_id);
}
var decQuantityCheckout = function(product_id) {
    decCartCheckout(product_id);
}

window.onload = function() {

    itemSearch();

    //VUE CART
    cartContent = new Vue({
        el: '#cartList',
        data: {
            items: [],
            itemsCount: 0,
        },
        methods: {
            remove: function(product_id , item_id=null) {
                removeProductIfFromCart(product_id, item_id)
            },
            incQuantity: function(product_id, item_id=null) {
                incCart(product_id, item_id)
            },
            decQuantity: function(product_id, item_id=null) {
                decCart(product_id, item_id)
            },
            removeCh: function(product_id) {
                removeProductIfFromCartCheckout(product_id, true)
            },
            incCartCh: function(product_id) {
                incCartCheckout(product_id)
            },
            decCartCh: function(product_id) {
                decCartCheckout(product_id)
            },
        }, 
        computed: {
            itemsCount: function() {
                return Object.keys(cartContent.items).length
            }
        }
    })

    //VUE CART
    cartContentCheckoutDetails = new Vue({
        el: '#cartListDetails',
        data: {
            items: [],
            itemsCount: 0,
        }, 
        computed: {
            itemsCount: function() {
                return Object.keys(cartContent.items).length
            }
        },
        created: function () {
          console.log('kal itemsCount is: ' + this.itemsCount)
        }
    })
    
    /*cartContentCheckout = new Vue({
        el: '#cartListCheckout',
        data: {
            items: [],
            itemsCount: 0,
        },
        methods: {  
            removeCh: function(product_id) {
                removeProductIfFromCartCheckout(product_id, true)
            },
            incCartCh: function(product_id) {
                incCartCheckout(product_id)
            },
            decCartCh: function(product_id) {
                decCartCheckout(product_id)
            },
        }, 
        computed: {
            itemsCount: function() {
                return Object.keys(cartContentCheckout.items).length
            }
        }
    })*/
    //VUE CART Mobile
    cartContentMobile = new Vue({
        el: '#cartListMobile',
        data: {
            items: []
        },
        computed: {
            items: function() {
                return cartContent.items
            }
        },

        methods: {
            remove: function(product_id, item_id=null) {
                removeProductIfFromCart(product_id, item_id)
            },
            incQuantity: function(product_id, item_id=null) {
                incCart(product_id, item_id)
            },
            decQuantity: function(product_id, item_id=null)  {
                decCart(product_id, item_id)
            },
        }
    })

    cartCounter = new Vue({
        el: '#cartButtonHolder',
        data: {
            counter: 0,
        },
        computed: {
            counter: function() {
                return Object.keys(cartContent.items).length
            }
        },
    })

    //GET PAGES FOR FOOTER
    getPages();

    //Payment Method switcher
    paymentTypeSwitcher();

    //Delivery type switcher
    deliveryTypeSwitcher();

    //For Dine in / takeout
    dineTypeSwitcher();

    //Activate address switcher
    deliveryAddressSwithcer();

    //Activate deliveryAreaSwithcer
    deliveryAreaSwithcer();


    //VUE FOOTER PAGES
    footerPages = new Vue({
        el: '#footer-pages',
        data: {
            pages: []
        }
    })

    //VUE COMPLETE ORDER TOTAL PRICE
    total = new Vue({
        el: '#totalSubmit',
        data: {
            totalPrice: 0
        }
    })
    

    //VUE TOTAL
    cartTotal = new Vue({
        el: '#totalPrices',
        data: {
            itemsCount: 0,
            totalPrice: 0,
            deduct: 0,
            deductFormat: "",
            minimalOrder: 0,
            totalPriceFormat: "",
            deliveryPriceFormated: "",
            withDeliveryFormat: "",
            delivery: true,
        },
        computed: {
            itemsCount: function() {
                return Object.keys(cartContent.items).length
            }
        }
    })
    //VUE TOTAL
    cartTotalCheckoutDetails = new Vue({
        el: '#totalPricesCheckout',
        data: {
            itemsCount: 0,
            totalPrice: 0,
            deduct: 0,
            deductFormat: "",
            minimalOrder: 0,
            totalPriceFormat: "",
            deliveryPriceFormated: "",
            withDeliveryFormat: "",
            delivery: true,
        },
        computed: {
            itemsCount: function() {
                return Object.keys(cartContent.items).length
            },
            totalPrice: function() {
                return cartTotal.totalPrice
            },
            deduct: function() {
                return cartTotal.deduct
            },
            deductFormat: function() {
                return cartTotal.deductFormat
            },
            minimalOrder: function() {
                return cartTotal.minimalOrder
            },
            totalPriceFormat: function() {
                return cartTotal.totalPriceFormat
            },
            deliveryPriceFormated: function() {
                return cartTotal.deliveryPriceFormated
            },
            withDeliveryFormat: function() {
                return cartTotal.withDeliveryFormat
            },
            delivery: function() {
                return cartTotal.delivery
            }
        }
    })
    //VUE TOTAL Mobile
    /*cartTotalMobile = new Vue({
        el: '#totalPricesMobile',
        data: {
            totalPrice: 0,
            deduct: 0,
            deductFormat: "",
            minimalOrder: 0,
            totalPriceFormat: "",
            deliveryPriceFormated: "",
            withDeliveryFormat: "",
            delivery: true,
        },
        computed: {
            totalPrice: function() {
                return cartTotal.totalPrice
            },
            deduct: function() {
                return cartTotal.deduct
            },
            deductFormat: function() {
                return cartTotal.deductFormat
            },
            minimalOrder: function() {
                return cartTotal.minimalOrder
            },
            totalPriceFormat: function() {
                return cartTotal.totalPriceFormat
            },
            deliveryPriceFormated: function() {
                return cartTotal.deliveryPriceFormated
            },
            withDeliveryFormat: function() {
                return cartTotal.withDeliveryFormat
            },
            delivery: function() {
                return cartTotal.delivery
            }
        },
    })*/

    //Call to get the total price and items
    getCartContentAndTotalPrice();
    var addToCart1 = new Vue({
        el: '#addToCart1',
        methods: {
            addToCartAct() {
                if (localStorage.getItem("cartLS")) {
                    cartLS = JSON.parse(localStorage.getItem("cartLS"));
                }
                let item_id = $('#modalID').text();
                let unix = unixTimestamp();
                $("#itemUnix-"+item_id).val(unix);
                let cartLSitem = [];
                let extra = [];
                let condit = [];
                let price = $("#inputModalPrice").val();
                $('#full-addToCartExpress').hide();
                $('#full-quantity-express-bloc').show();
                sum  = cartLS.total + parseFloat(price);
                let qtyExp = $("#quantityExpress-" + item_id).val();
                addItemCartHideShow($('#modalID').text()); 
                //displayLoader();    
                if (findObject(cartLS, 'id', item_id).length > 0) {
                    inqQty(unix);
                } else {
                    let conditions = condit;
                    let extras = extrasSelected;
                    let attributes = new Attributes(item_id, null, extras, $('#rid').val(), "", $("#itemFriendlyPrice-" + item_id).val());
                    cartLSitem = new Cartitem(unix, $("#itemName-" + item_id).val(), price, ((qtyExp > 0) ? qtyExp : 1), attributes, conditions, 0);
                    cart(cartLS, cartLSitem, unix , sum, false, "");
                }
                hideAddExpressButton();
                localStorage.setItem("cartLS", JSON.stringify(cartLS));
                getCartContentAndTotalPrice();
               
                /*axios.post('/cart-add', {
                        id: $('#modalID')text.(),
                        quantity: $('#full-quantityExpress').val(),
                        extras: extrasSelected,
                        variantID: variantID,
                        timesTamp: unix
                    })
                    .then(function(response) {
                        if(response.status){
                            console.log('success > addToCart1 > st: '+response.status+' > msg:'+response.errMsg);
                        }else{
                            console.log('error > addToCart1 > st: '+response.status+' > msg:'+response.errMsg);
                        }
                    })
                    .catch(function(error) {
                        
                    });*/
            },
        },
    });
}