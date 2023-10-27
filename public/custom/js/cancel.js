"use strict";
var cartLS = {"data": {}, "total":0, "status":true, "errMsg":"" , "deletedItems": {}};
localStorage.setItem("cartLS", JSON.stringify(cartLS));
localStorage.setItem("comment","");
localStorage.setItem("onsiteTakeAway", "");