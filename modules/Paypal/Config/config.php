<?php

return [
    'name' => 'PayPal',
    'enabled'=>env('ENABLE_PAYPAL',true),
    'useVendor'=>env('VENDORS_OR_ADMIN_PAYPAL','admin')=="vendor",
    'useAdmin'=>env('VENDORS_OR_ADMIN_PAYPAL','admin')=="admin",
    'client_id'=>env('PAYPAL_CLIENT_ID','AUtqy2h0BJw-14TA77QiPLb3CgANagskDT6peo8e1NYVua6VhvcesKHmOm_eM9fQnDiZp8oNmxHbd8js'),
    'secret'=>env('PAYPAL_SECRET',"ELr_dVQitf1fsc3j1Uk8NWehlS1fs2IZ1Pkb6N3uauu3OOVYSU5xrgeEZDgfrZge7pWffjv5hGziub6O"),
    'mode'=>env('PAYPAL_MODE','sandbox')
];
