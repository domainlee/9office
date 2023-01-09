'use strict';

var storeApp = angular.module('DWEBApp', []).config(['$routeProvider', function($routeProvider) {
    $routeProvider.
      when('/store', {
        templateUrl: '/assets/js/partials/store.htm',
        controller: storeController
      }).
      when('/products/:productSku', {
        templateUrl: '/assets/js/partials/product.htm',
        controller: storeController
      }).
      when('/cart', {
        templateUrl: '/assets/js/partials/shoppingCart.htm',
        controller: storeController
      }).
      otherwise({
        redirectTo: '/store'
      });
}]);

storeApp.factory("DataService", function ($http) {
    var myStore = new store($http);
    var myCart1 = new shoppingCart("DWEB");

    myCart1.addCheckoutParameters("PayPal", "paypaluser@youremail.com");
    myCart1.addCheckoutParameters("Google", "xxxxxxx",
        {
            ship_method_name_1: "UPS Next Day Air",
            ship_method_price_1: "20.00",
            ship_method_currency_1: "USD",
            ship_method_name_2: "UPS Ground",
            ship_method_price_2: "15.00",
            ship_method_currency_2: "USD"
        }
    );
    myCart1.addCheckoutParameters("Stripe", "pk_test_xxxx",
        {
            // chargeurl: "https://theme.com/shoppingcart"
        }
    );

    return {
        store: myStore,
        cart: myCart1
    };
});