"use strict";
var items = [];
var currentItem = null;
var currentItemSelectedPrice = null;
var lastAdded = null;
var previouslySelected = [];
var extrasSelected = [];
var variantID = null;
var debug = true;
var cartLS = {"data": {}, "total":0, "status":false, "errMsg":""};
let count = 0;
let sum = 0;
let comment = "";
var deletedList = {"deletedList": {}};
var mPayment = "";

function cart(cartLS, datas, id, total, status, errMsg){
    const keyUnix = id.toString();
    let oldObj = cartLS.data;
    let newData = {};
    newData[keyUnix] = datas;
    cartLS.data = { ...oldObj, ...newData };
    cartLS.total = total;
    cartLS.status = status;
    cartLS.errMsg = errMsg;
}

function Cartitem(id, name, price, quantity, attributes, conditions, remote){
    this.id = id;
    this.name = name;
    this.price = price;
    this.quantity = quantity;
    this.attributes = attributes;
    this.conditions = conditions;
    this.remote = remote;
}

function Attributes(id, variant, extras, restorant_id, image, friendly_price){
    this.id = id;
    this.variant = variant;
    this.extras = extras;
    this.restorant_id = restorant_id;
    this.image = image;
    this.friendly_price = friendly_price;
}

function extras(extra){
    return extra;
}

function conditions(conditions){
    return conditions;
}


if (localStorage.getItem("count")) {
    count = parseInt(localStorage.getItem("count"));
}

if (localStorage.getItem("sum")) {
    sum = parseInt(localStorage.getItem("total"));
}

if (localStorage.getItem("cartLS")) {
    cartLS = JSON.parse(localStorage.getItem("cartLS"));

    if(cartLS.total < 0){
        cartLS.total = 0;
        localStorage.setItem("cartLS", JSON.stringify(cartLS));
    }
}

if (localStorage.getItem("deletedList")) {
    deletedList = JSON.parse(localStorage.getItem("deletedList"));
}

if (localStorage.getItem("comment")) {
    comment = localStorage.getItem("comment");
    if($('#cart-comment').length > 0){
        $('#cart-comment').val(comment.toString());
    }
    if($('#cart-details-comment').length > 0){
        $('#cart-details-comment').val(comment.toString());
    }
}

if (localStorage.getItem("mPayment")) {
    mPayment = parseInt(localStorage.getItem("mPayment"));
}

$( document ).ready(function() {
    hideAddExpressButton();
});

$(function() {
    hideAddExpressButton();
});

function debugMe(title, message) {
    if (debug) {
        console.log("Dum dum code hhhh");
    }
}

/*
 * Price formater
 * @param {Nummber} price
 */
function formatPrice(price) {
    var locale = LOCALE;
    if (CASHIER_CURRENCY.toUpperCase() == "USD") {
        locale = locale + "-US";
    }

    var formatter = new Intl.NumberFormat(locale, {
        style: 'currency',
        currency: CASHIER_CURRENCY,
    });

    var formated = formatter.format(price);

    return formated;
}

/**
 * Load extras for variant
 * @param {Number} variant_id the variant id
 * */
function loadExtras(variant_id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'GET',
        url: '/items/variants/' + variant_id + '/extras',
        success: function(response) {
            if (response.status) {
                response.data.forEach(element => {
                    $('#exrtas-area-inside').append('<div class="custom-control custom-checkbox mb-3"><input onclick="recalculatePrice(' + element.item_id + ');" class="custom-control-input" id="' + element.id + '" name="extra"  value="' + element.price + '" type="checkbox"><label class="custom-control-label" for="' + element.id + '">' + element.name + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+' + formatPrice(element.price) + '</label></div>');
                });
                $('#exrtas-area').show();

            }
        },
        error: function(response) {}
    })
}




/**
 *
 * Set the selected variant, set price and shows qty area and calls load extras
 * */
function setSelectedVariant(element) {

    $('#modalPrice').html(formatPrice(element.price));
    $('#inputModalPrice').val(element.price);
    //Set current item price
    currentItemSelectedPrice = element.price;

    //Show QTY
    $('.quantity-area').show();

    //Set variantID
    variantID = element.id;

    //Empty the extras, and call it
    $('#exrtas-area-inside').empty();
    loadExtras(variantID);

}

function getTheDataForTheFoundVariable() {

    var comparableObject = {};
    previouslySelected.forEach(element => {
        comparableObject[element.option_id] = element.name.trim().toLowerCase().replace(/\s/g, "-");
    });
    comparableObject = JSON.stringify(comparableObject)
    currentItem['variants'].forEach(element => {
        if (comparableObject == JSON.stringify(JSON.parse(element.options))) {
            setSelectedVariant(element);
        }
    });

}


function checkIfVariableExists(forOption, optionValue) {

    var newElement = { "option_id": forOption, "name": optionValue };

    var possibleSelection = JSON.parse(JSON.stringify(previouslySelected));
    possibleSelection.push(newElement);

    var filteredObjects = [];
    currentItem.variants.forEach(theVariant => {
        var theOptions = JSON.parse(theVariant.optionsiconv ? theVariant.optionsiconv : theVariant.options);
        var ok = true;
        Object.keys(theOptions).map((key) => {
            possibleSelection.forEach(element => {
                if (key == element.option_id) {
                    if (theOptions[key] + "" != element.name.trim().toLowerCase().replace(/\s/g, "-") + "") {
                        ok = false;
                    }
                }
            });

        })

        if (ok) {
            filteredObjects.push(theVariant);
        }
    });



    return filteredObjects.length > 0;

}

function appendOption(name, id) {
    lastAdded = id;
    $('#variants-area-inside').append('<div id="variants-area-' + id + '"><br /><label class="form-control-label"><b>' + name + '<b></label><div><div id="variants-area-inside-' + id + '" class="flex-wrap btn-group btn-group-toggle" data-toggle="buttons"> </div></div>');
}

function optionChanged(option_id, name) {

    var newElement = { "option_id": option_id, "name": name };
    debugMe("selected option", JSON.stringify(newElement));


    //Append / insert the new selectioin
    var newSelectionState = [];
    var userClickedOnAlreadySelectedOption = false;
    previouslySelected.forEach(element => {

        if (userClickedOnAlreadySelectedOption) {
            $("#variants-area-" + element.option_id).remove();
        }

        if (element.option_id != newElement.option_id) {
            //If we haven't yet found the item add this in the selection
            if (!userClickedOnAlreadySelectedOption) { newSelectionState.push(element); }
        } else {
            userClickedOnAlreadySelectedOption = true;
        }


    });



    if (userClickedOnAlreadySelectedOption && lastAdded != newElement.option_id) {
        //remove also last inserted, and readded it
        $("#variants-area-" + lastAdded).remove();
    }

    newSelectionState.push(newElement);
    previouslySelected = newSelectionState;
    debugMe("Selection", JSON.stringify(previouslySelected));
    setVariants();


}

function appendOptionValue(name, value, enabled, option_id) {
    $('#variants-area-inside-' + option_id).append('<label style="opacity: ' + (enabled ? 1 : 0.5) + '" class="btn btn-outline-primary"><input  onchange="optionChanged(' + option_id + ',\'' + value + '\')"  ' + (enabled ? "" : "disabled") + ' type="radio" name="option_' + option_id + '" value="option_' + option_id + "_" + name + '" autocomplete="off" />' + js.trans(name) + '</label>')
}

function setVariants() {
    //1. Determine previously selected variants

    //HIDE QTY
    $('.quantity-area').hide();
    $('#exrtas-area-inside').empty();
    $('#exrtas-area').hide();

    //2. Get the new option to show
    var newOptionToShow = null;
    debugMe("previouslySelected length", previouslySelected.length);
    newOptionToShow = currentItem.options[previouslySelected.length];
    debugMe("newOptionToShow", JSON.stringify(newOptionToShow));

    if (newOptionToShow != undefined) {
        //2.1 Add the options in the table
        appendOption(newOptionToShow.name, newOptionToShow.id);


        var values = (newOptionToShow.optionsiconv ? newOptionToShow.optionsiconv : newOptionToShow.options).split(",");
        var titles = (newOptionToShow.options).split(",");

        for (let index = 0; index < values.length; index++) {
            const theValue = values[index];
            const theTitle = titles[index];

            if (checkIfVariableExists(newOptionToShow.id, theValue)) {
                //Next variable exists
                appendOptionValue(theTitle, theValue, true, newOptionToShow.id);
            } else {
                //Varaiable with the next option value doens't exists
                appendOptionValue(theTitle, theValue, false, newOptionToShow.id);
            }

        }

    } else {

        getTheDataForTheFoundVariable();
    }




    //3. Add the new option options
    //3.1 If new option is null, show the variant price
}


function setCurrentItem(id) {

    var item = items[id];
    currentItem = item;
    previouslySelected = [];
    $('#full-modalTitle').text(item.name);
    $('#modalName').text(item.name);
    $('#modalPrice').html(item.price);
    $('#inputModalPrice').val(item.priceNotFormated);
    $('#modalID').text(item.id);
    $('#quantity').val(1);
    let  item_qty_cart = parseInt($('#quantityExpress-' + item.id).val());
    $('#full-quantityExpress').val(item_qty_cart);
    if($("#cart-item-btn-plus-"+item.id).length > 0){
        if(item_qty_cart > 1){
            $('#full-addToCartExpress').hide();
            $('#full-quantity-express-bloc').show();
            $('#full-cart-item-btn-trash').hide();
            $('#full-cart-item-btn-minus').show();
        }else{
            $('#full-addToCartExpress').hide();
            $('#full-quantity-express-bloc').show();
            $('#full-cart-item-btn-trash').show();
            $('#full-cart-item-btn-minus').hide();
        }
    }else{
            $('#full-addToCartExpress').show();
            $('#full-quantity-express-bloc').hide();
    }
    if (item.image != "/default/restaurant_large.jpg") {
        $("#full-modalImg").attr("src", item.image);
        $("#full-modalDialogItem").addClass("modal-lg");
        $("#full-modalImgPart").show();

        $("#full-modalItemDetailsPart").removeClass("col-sm-6 col-md-6 col-lg-6 offset-3");
        $("#full-modalItemDetailsPart").addClass("col-sm col-md col-lg");
    } else {
        $("#full-modalImgPart").hide();
        $("#full-modalItemDetailsPart").removeClass("col-sm col-md col-lg");
        $("#full-modalItemDetailsPart").addClass("col-sm-6 col-md-6 col-lg-6 offset-3");

        $("#full-modalDialogItem").removeClass("modal-lg");
        $("#full-modalDialogItem").addClass("col-sm-6 col-md-6 col-lg-6 offset-3");
    }

    $('#full-modalDescription').html(item.description);


    if (item.has_variants) {
        //Vith variants
        //Hide the counter, and extrasts
        $('.full-quantity-area').hide();

        //Now show the variants options
        $('#full-variants-area-inside').empty();
        $('#full-variants-area').show();
        setVariants();
    } else {
        //Normal
        currentItemSelectedPrice = item.priceNotFormated;
        $('#full-variants-area').hide();
        $('.full-quantity-area').show();
    }

    extrasSelected = [];

    variantID = null;

    //Now set the extrast
    if (item.extras.length == 0 || item.has_variants) {

        $('#full-exrtas-area-inside').empty();
        $('#full-exrtas-area').hide();
    } else {

        $('#full-exrtas-area-inside').empty();
        item.extras.forEach(element => {
            $('#full-exrtas-area-inside').append('<div class="custom-control custom-checkbox mb-3"><input onclick="recalculatePrice(' + id + ');" class="custom-control-input" id="' + element.id + '" name="extra"  value="' + element.price + '" type="checkbox">'+
            '<label class="custom-control-label col-12" for="' + element.id + '">' + 
                '<div class="row">' +
                    '<div class="col-8 pr-0">'+ element.name + '</div>' +
                    '<div class="col-4">+ ' +  element.priceFormated + '</div>' +
                '</div>' +        
            '</label></div>');
        });
        $('#full-exrtas-area').show();
    }
}

function closeCurrentItem(){
    let container = $('#productsListing');
    let item_id = $('#modalID').text();
    $('#productFullDetails').hide();
    container.show();
    if (item_id !== null && item_id !== undefined && typeof item_id !== 'undefined') {
        let target = $("#item-listing-"+item_id);
        console.log("closeCurrentItem::::"+item_id);
        if (target.length) {
            $(document).scrollTop(target.offset().top-90);
        }
    }
}

function openCurrentItem(item_id=null){
    if (item_id !== null && item_id !== undefined && typeof item_id !== 'undefined') {
        console.log("openCurrentItem::::"+item_id);
        $('#productFullDetails').show();
        $('#productsListing').hide();
    }
}


function recalculatePrice(id, value) {
    var mainPrice = parseFloat(currentItemSelectedPrice);
    extrasSelected = [];

    //Get the selected check boxes
    $.each($("input[name='extra']:checked"), function() {
        mainPrice += parseFloat(($(this).val() + ""));
        extrasSelected.push($(this).attr('id'));
    });
    $('#modalPrice').html(formatPrice(mainPrice));
    $('#inputModalPrice').val(mainPrice);

}

function getLocation(callback) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'GET',
        url: '/get/rlocation/' + $('#rid').val(),
        success: function(response) {
            if (response.status) {
                return callback(true, response.data)
            }
        },
        error: function(response) {
            return callback(false, response.responseJSON.errMsg);
        }
    })
}

function initializeMap(lat, lng) {
   /* var map_options = {
        zoom: 13,
        center: new google.maps.LatLng(lat, lng),
        mapTypeId: "terrain",
        scaleControl: true
    }

    map_location = new google.maps.Map(document.getElementById("map3"), map_options);*/
}

function initializeMarker(lat, lng) {
    /*var markerData = new google.maps.LatLng(lat, lng);
    marker = new google.maps.Marker({
        position: markerData,
        map: map_location,
        icon: start
    });*/
}
/**
 * 
 * @param {*} mode 
 */
function chooseOnsiteTakeAway(mode) {
    let choosen = 0;
    if (localStorage.getItem("onsiteTakeAway")) {
        choosen = localStorage.getItem("onsiteTakeAway");
    }
    if (mode == 0) {
        $("#landing-page").hide();
        $("#restaurant-content").show();
        choosen = "dinein";
    } else if (mode == 1) {
        $("#landing-page").hide();
        $("#restaurant-content").show();
        choosen = "takeaway";
    } else {
        $("#landing-page").show();
        $("#restaurant-content").hide();
    }
    if($("#dineInTakewayChoice").length > 0){
        if(choosen == "dinein"){
            $("#dineInTakewayChoice_dinein").show();
            $("#dineInTakewayChoice_takeaway").hide();
        }
        if(choosen == "takeaway"){
            $("#dineInTakewayChoice_dinein").hide();
            $("#dineInTakewayChoice_takeaway").show();
        }
    }
    localStorage.setItem("onsiteTakeAway", choosen);
    if($(".sidenav-cart").length > 0){
        document.getElementsByClassName('sidenav-cart')[1].style.display = 'none';
    }
}

function checkoutOnsiteTakeAway(mode){
    let choosen = 0;
    if (localStorage.getItem("onsiteTakeAway")) {
        choosen = localStorage.getItem("onsiteTakeAway");
    }
    if (mode == 0) {
        choosen = "dinein";
    } else if (mode == 1) {
        choosen = "takeaway";
    }
    if($("#dineInTakewayChoice").length > 0){
        if(choosen == "dinein"){
            $("#dineInTakewayChoice_dinein").show();
            $("#dineInTakewayChoice_takeaway").hide();
        }
        if(choosen == "takeaway"){
            $("#dineInTakewayChoice_dinein").hide();
            $("#dineInTakewayChoice_takeaway").show();
        }
    }
    localStorage.setItem("onsiteTakeAway", choosen);
}

var start = "/images/pin.png"
var area = "/images/green_pin.png"
var map_location = null;
var map_area = null;
var marker = null;
var infoWindow = null;
var lat = null;
var lng = null;
var circle = null;
var isClosed = false;
var poly = null;
var markers = [];
var markerArea = null;
var markerIndex = null;
var path = null;

window.onload ? window.onload() : null;

window.onload = function() {

   /* getLocation(function(isFetched, currPost) {
        if (isFetched) {


            if (currPost.lat != 0 && currPost.lng != 0) {
                //initialize map
                initializeMap(currPost.lat, currPost.lng)

                //initialize marker
                initializeMarker(currPost.lat, currPost.lng)
            }
        }
    });*/
    //check
    setInterval(displayTotalItemsBasket, 100);

    $('#landingBtnOnsite').on('click', function(){
        chooseOnsiteTakeAway(0);
    });
    $('#landingBtnTakeAway').on('click', function(){
        chooseOnsiteTakeAway(1);
    });
    
    if (localStorage.getItem("comment")) {
        comment = localStorage.getItem("comment");
        if($('#cart-comment').length > 0){
            $('#cart-comment').val(comment.toString());
        }
        if($('#cart-details-comment').length > 0){
            $('#cart-details-comment').val(comment.toString());
        }
    }

    $('#productFullDetails').hide();
    $('#productsListing').show();
    /*if (DISPLAY_CADDY !== null && DISPLAY_CADDY !== undefined &&  DISPLAY_CADDY === "1"){
        openNav();
        $("#landing-page").hide();
        $("#restaurant-content").show();
    }*/
    mPaymentChoice(mPayment);
}



$(".nav-item-category").on('click', function() {
    $.each(categories, function(index, value) {
        $("." + value).show();
    });

    var id = $(this).attr("id");
    var category_id = id.substr(id.indexOf("_") + 1, id.length);

    $.each(categories, function(index, value) {
        if (value != category_id) {
            $("." + value).hide();
        }
    });
});


/**
 * Update the product quantity, and calls getCartConent
 * @param {Number} product_id
 */
function incQuantityExpress(product_id) {
    if (localStorage.getItem("cartLS")) {
        cartLS = JSON.parse(localStorage.getItem("cartLS"));
    }
    let cart_product_id = $("#cart-item-product-" + product_id).val();
    modifyValQty(product_id, cart_product_id, "+");
    if (cart_product_id !== undefined && typeof cart_product_id !== 'undefined') {
        displayLoader(false);
        /*let qty = parseInt(cartLS.data[cart_product_id].quantity);
        cartLS.data[cart_product_id].quantity = ++qty;
        $('#quantityExpress-' + product_id).val(qty);
        $("#full-quantityExpress").val(qty);*/
        hideTrashShowMinus(product_id);
        cartLS.total = calculeTotal(cart_product_id);
        localStorage.setItem("cartLS", JSON.stringify(cartLS));
        getCartContentAndTotalPrice();

        /*$.ajax({
            type: 'GET',
            url: '/cartinc/' + cart_product_id,
            success: function(response) {
                if (response.status) {
                    console.log('success > incQuantityExpress > st: '+response.status+' > msg:'+response.errMsg);
                } else {
                    console.log('success > incQuantityExpress > st: '+response.status+' > msg:'+response.errMsg);
                }
            },
            error: function(response) {
               
            }
        })*/
    }
}
/**
 * 
 * @param {*} product_id 
 */
function decQuantityExpress(product_id) {
    if (localStorage.getItem("cartLS")) {
        cartLS = JSON.parse(localStorage.getItem("cartLS"));
    }
    let cart_product_id = $("#cart-item-product-" + product_id).val();
    if((cartLS.data[cart_product_id] !== null && cartLS.data[cart_product_id] !== undefined && typeof cartLS.data[cart_product_id] !== 'undefined')){
        displayLoader(false);
        let cart_product_qty = $("#cart-item-product-qty-txt-" + product_id).val();
        if(cart_product_qty <=2 ){
            decQuantityHideAndRemoveCartItem(product_id);
            let prod_id = $("#cart-item-btn-trash-"+ product_id).val();
            if(cart_product_qty <= 1 ){
                $('#btn-add-tocart-express-' + product_id).show();
                $('#quantity-express-bloc-' + product_id).hide();
                $("#quantityExpress-" + product_id).val(1);
                removeProductIfFromCart(prod_id, product_id);
                return true;
            }
        }
        modifyValQty(product_id, cart_product_id, "-");
        /*let qty = parseInt(cartLS.data[cart_product_id].quantity);
        cartLS.data[cart_product_id].quantity = --qty;
        $('#quantityExpress-' + product_id).val(qty);
        $("#full-quantityExpress").val(qty);*/
        cartLS.total = calculeTotal(cart_product_id, "-");
        localStorage.setItem("cartLS", JSON.stringify(cartLS));
        getCartContentAndTotalPrice();
    }
    /*$.ajax({
        type: 'GET',
        url: '/cartdec/' + cart_product_id,
        success: function(response) {
            if (response.status) {
                console.log('success > decQuantityExpress > st: '+response.status+' > msg:'+response.errMsg);
            } else {
                console.log('success > decQuantityExpress > st: '+response.status+' > msg:'+response.errMsg);
            }
        },
        error: function(response) {
        }
    })*/
}
/**
 * 
 * @param {*} item_id
 */
function addToCartActExpress(item_id) {
    if (localStorage.getItem("cartLS")) {
        cartLS = JSON.parse(localStorage.getItem("cartLS"));
    }
    let qtyExp = $("#quantityExpress-" + item_id).val();
    let unix = unixTimestamp();
    $("#itemUnix-"+item_id).val(unix);
    let obj = cartLS;
    let cartLSitem = [];
    let extra = [];
    let condit = [];
    let price = $("#itemPrice-" + item_id).val();
    displayLoader(false);
    addItemCartHideShow(item_id);
    count++;
    sum  = cartLS.total + parseFloat(price);
    if (findObject(cartLS, 'id', item_id).length > 0) {
        inqQty(unix);
    } else {
        let conditions = condit;
        let extras = extra;
        let attributes = new Attributes(item_id, null, extras, $('#rid').val(), "", $("#itemFriendlyPrice-" + item_id).val());
        cartLSitem = new Cartitem(unix, $("#itemName-" + item_id).val(), price, ((qtyExp > 0) ? qtyExp : 1), attributes, conditions, 0);
        cart(cartLS, cartLSitem, unix , sum, false, "");
    }
    localStorage.setItem("cartLS", JSON.stringify(cartLS));
    getCartContentAndTotalPrice();

   /* $.ajax({
        type: 'POST',
        url: '/cart-add',
        data: {
            id: item_id,
            quantity: (qtyExp > 0) ? qtyExp : 1,
            extras: [],
            variantID: null,
            timesTamp: unix
        },
        success: function(response) {
            if (response.status) {
                console.log('success > addToCartActExpress > st: '+response.status+' > msg:'+response.errMsg);
            } else {
                console.log('success > addToCartActExpress > st: '+response.status+' > msg:'+response.errMsg);
            }
        },
        error: function(response) {}
    })*/
}

function hideAddExpressButton(){
    let cart_elements = Object.keys(cartContent.items);
    let cart_elements_val = 0;
    let cart_item_val = 0;
    if(cart_elements.length > 0){
        for(let i=0; i < cart_elements.length; ++i) {
            cart_elements_val = $("#"+cart_elements[i]).val();
            cart_item_val = $("#cart-item-product-qty-txt-"+ cart_elements_val).val();

            $('#btn-add-tocart-express-' + cart_elements_val).hide();
            $('#quantity-express-bloc-' + cart_elements_val).css('display', 'flex');
            $('#quantityExpress-' + cart_elements_val).val(cart_item_val);
            $('#item-listing-' + cart_elements_val+' .food-item__quantity').show();
            $('#item-listing-' + cart_elements_val+' .food-item__quantity').html(cart_item_val);
            hideTrashShowMinus(cart_elements_val);
            if(cart_item_val <= 1 ){
                decQuantityHideAndRemoveCartItem(cart_elements_val);
            }
        }
    }
}

function showAddBtnAfterRemoveFromCart(product_id){
    console.log("showAddBtnAfterRemoveFromCart: "+product_id);
    $('#btn-add-tocart-express-' + product_id).show();
    $('#quantity-express-bloc-' + product_id).hide();
    $('#quantityExpress-' + product_id).val(1);
}

function addItemCartHideShow(item_id){
    $('#btn-add-tocart-express-' + item_id).hide();
    $('#quantity-express-bloc-' + item_id).css('display', 'flex');
    $("#cart-item-btn-minus-"+ item_id).hide();
    $("#cart-item-btn-trash-"+ item_id).show();
    $("#cart-item-btns-minus-"+ item_id).hide();
    $("#cart-item-btns-trash-"+ item_id).show();
}

function decQuantityHideAndRemoveCartItem(product_id){
    let full_product_id = $('#modalID').text();
    $("#list-express-minus-"+ product_id).hide();
    $("#list-express-trash-"+ product_id).show();
    $("#cart-item-btn-minus-"+ product_id).hide();
    $("#cart-item-btn-trash-"+ product_id).show();
    $("#cart-item-btns-minus-"+ product_id).hide();
    $("#cart-item-btns-trash-"+ product_id).show();
    if(full_product_id == product_id){
        $('#full-cart-item-btn-trash').show();
        $('#full-cart-item-btn-minus').hide();
    }
}


function hideTrashShowMinus(product_id){
    let full_product_id = $('#modalID').text();
    $("#list-express-minus-"+ product_id).show();
    $("#list-express-trash-"+ product_id).hide();
    $("#cart-item-btn-minus-"+ product_id).show();
    $("#cart-item-btn-trash-"+ product_id).hide();
    $("#cart-item-btns-minus-"+ product_id).show();
    $("#cart-item-btns-trash-"+ product_id).hide();
    if(full_product_id == product_id){
        $("#full-cart-item-btn-trash").hide();
        $('#full-cart-item-btn-minus').show();
    }
}

function removeItemFromCartByListing(item_id){
    $('#btn-add-tocart-express-' + item_id).show();
    $('#quantity-express-bloc-' + item_id).hide();
    $('#quantitExpress-y' + item_id).val(1);
    hideFoodQty(item_id);
    if($("#cart-item-btn-trash-"+ item_id).length > 0){
        let prod_id = $("#cart-item-btn-trash-"+ item_id).val();
        removeProductIfFromCart(prod_id, item_id);
    }
    
}

function incCartAct(){
    $('#full-cart-item-btn-trash').hide();
    $('#full-cart-item-btn-minus').show();
    let product_id = $('#modalID').text();
    let cart_product_qty = $("#full-quantityExpress").val();
    $("#full-quantityExpress").val(++cart_product_qty);
    console.log("incCartAct id:"+product_id);
    console.log("incCartAct qty:"+cart_product_qty);
    incQuantityExpress(product_id);
}

function decCartAct(){
    let product_id = $('#modalID').text();
    let cart_product_qty = $("#full-quantityExpress").val();
    if(cart_product_qty <= 2 ){
        $('#full-cart-item-btn-trash').show();
        $('#full-cart-item-btn-minus').hide();
        $("#full-quantityExpress").val(1);
        let item_id = $("#cart-item-btn-plus-"+product_id).val();
        if(cart_product_qty <= 1 ){
           removeProductIfFromCartCheckout(item_id, false);
        }
    }
    cart_product_qty = (cart_product_qty > 1) ? --cart_product_qty : 1;
    $("#full-quantityExpress").val(cart_product_qty);
    console.log("decCartAct id:"+product_id);
    console.log("decCartAct qty:"+cart_product_qty);
    decQuantityExpress(product_id);
}

function removeCartAct(){
    let product_id = $('#modalID').text();
    $('#full-addToCartExpress').show();
    $('#full-quantity-express-bloc').hide();
    $("#full-quantityExpress").val(1);
    console.log("removeCartAct id:"+product_id);
    let item_id = $("#cart-item-btn-plus-"+product_id).val();
    displayLoader(false);
    hideFoodQty(product_id);
    removeProductIfFromCart(item_id, product_id);
    removeProductIfFromCartCheckout(item_id, false);

}

function displayTotalItemsBasket(){
    if (localStorage.getItem("cartLS")) {
        cartLS = JSON.parse(localStorage.getItem("cartLS"));
    }
    $('#total-items-in-basket').html(Object.keys(cartLS.data).length);
    hideAddExpressButton();
}

function displayLoader(display=true){
    if(display){
        $('.cart-loader').show();
    }else{
        $('.cart-loader').hide();
    }
}

function unixTimestamp(){
    return Math.round(+new Date()/1000);
}

const findObject = (obj = {}, key, value) => {
    const result = [];
    const recursiveSearch = (obj = {}) => {
        if (!obj || typeof obj !== 'object') { 
            return;
        };
        if (obj[key] === value){
            result.push(obj);
        };
        Object.keys(obj).forEach(function (k) {
            recursiveSearch(obj[k]);
        });
    };
    recursiveSearch(obj);
    return result;
 };

function inqQty(key){
   let qty = parseInt(cartLS.data[key].quantity);
   cartLS.data[key].quantity = ++qty;

}

function updateCartLocalStorage(){
    console.log("updateCartLocalStorage");
}

const removeByIdLS = (key) => {
    calculeTotal(key,"-");
    deletedList[key] = key;
    delete cartLS.data[key];
};

const calculeTotal = (cart_product_id, add="+") => {
    let total = parseFloat(cartLS.total);
    if (cartLS.data[cart_product_id] != 'undefined'  && typeof cartLS.data[cart_product_id] !== 'undefined') {
        if(add == "+"){
            total = parseFloat(cartLS.total) +  parseFloat(cartLS.data[cart_product_id].price);
        }else{
            total = parseFloat(cartLS.total) -  parseFloat(cartLS.data[cart_product_id].price);
        }
        
        cartLS.total = (total > 0) ? total : 0;
        localStorage.setItem("cartLS", JSON.stringify(cartLS));
    }
    return total;
}

const setComments = (elemId) => {
    comment = $('#'+elemId).val();
    localStorage.setItem("comment", comment);
}

function modifyValQty(product_id, cart_product_id, plusMinus){
    let qty = parseInt(cartLS.data[cart_product_id].quantity);
    let id_full_express = $("#modalID").text();
    qty = (plusMinus == "+")?++qty:--qty;
    cartLS.data[cart_product_id].quantity = qty;
    $('#quantityExpress-' + product_id).val(qty);
    if(id_full_express == product_id){
        $("#full-quantityExpress").val(qty);
    }
}

function hideFoodQty(item_id){
    $('#item-listing-' + item_id+' .food-item__quantity').html("");
    $('#item-listing-' + item_id+' .food-item__quantity').hide();
}

function mPaymentChoice(mode=""){
    if(mode == ""){
        mode = mPayment;
    }
    if(mode == "applepay"){
        $("#payementNotSelected").hide();
        $("#paymentAppelPay").show();
        $("#paymentCache").hide();
        $("#paymentCard").hide();
        $('#linModifyPaymentMethod').show();
        $('#paymentPaypal').hide();
    }
    if(mode == "cod"){
        $("#payementNotSelected").hide();
        $("#paymentAppelPay").hide();
        $("#paymentCache").show();
        $("#paymentCard").hide();
        $('#linModifyPaymentMethod').show();
        $('#paymentPaypal').hide();
    }
    if(mode == "stripelinks"){
        $("#payementNotSelected").hide();
        $("#paymentAppelPay").hide();
        $("#paymentCache").hide();
        $("#paymentCard").show();
        $('#linModifyPaymentMethod').show();
        $('#paymentPaypal').hide();
    }
    if(mode == "paypal"){
        $("#payementNotSelected").hide();
        $("#paymentAppelPay").hide();
        $("#paymentCache").hide();
        $("#paymentCard").hide();
        $('#linModifyPaymentMethod').show();
        $('#paymentPaypal').show();
    }
    if(mode == ""){
        $("#payementNotSelected").show();
        $("#paymentAppelPay").hide();
        $("#paymentCache").hide();
        $("#paymentCard").hide();
        $('#linModifyPaymentMethod').show();
        $('#paymentPaypal').hide();
    }
    localStorage.setItem("mPayment", mode);
}

function showCommentIcone(){
    if($('#comment').length > 0){
        $('#comment').val(comment);
    }
    if(comment !== ""){
        $("#fullCommentArea").html(comment.slice(0, 50)+"...");
        $("#fullCommentArea").show();
    }else{
        $("#fullCommentArea").hide();
    }
}

var showLandingPageAfterPayment = function(){
    $("#landing-page").show();
    $("#restaurant-content").hide();
}