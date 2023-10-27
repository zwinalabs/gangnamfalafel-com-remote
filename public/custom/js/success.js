"use strict";
var cartLS = {"data": {}, "total":0, "status":true, "errMsg":"" };
localStorage.setItem("cartLS", JSON.stringify(cartLS));
localStorage.setItem("comment","");
localStorage.setItem("onsiteTakeAway", "");
getCartContentAndTotalPrice(true);
