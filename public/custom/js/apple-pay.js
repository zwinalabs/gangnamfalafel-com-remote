$('#paymentApplePay').on('click', function() {
  var paymentRequest = {
    requiredBillingContactFields: ['postalAddress'],
    requiredShippingContactFields: ['phone'],
    countryCode: 'FR',
    currencyCode: 'EUR',
    total: {
      label: 'Gangnamfalafel commande',
      amount: $("#tootalPricewithDeliveryRaw").val()
    }
  };
  var session = Stripe.applePay.buildSession(paymentRequest,
    function(result, completion) {
    console.log(result.token.card.address_line1); // 12 Main St
    console.log(result.shippingContact.phoneNumber); // 8885551212
    completion(true);
  });
  session.begin();
});