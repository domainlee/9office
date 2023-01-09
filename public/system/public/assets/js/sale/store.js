
function store(http) {
    this._http = http;
    this.curentpage = 1;
    var _productList = [];
    var _total = {};

    http({
        url: '/admin/product/sale',
        method: "POST",
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        transformRequest: function(obj) {
            var str = [];
            for(var p in obj)
                str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
            return str.join("&");
        },
        data: { totalPage: true }
    }).success(function (t) {
        _total['total'] = t.totalPage;
    });

    http({
        url: '/admin/product/sale',
        method: "POST",
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        transformRequest: function(obj) {
            var str = [];
            for(var p in obj)
                str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
            return str.join("&");
        },
        data: { page: 1, json: true }
    }).success(function (r) {
        angular.forEach(r, function (value, key) {
            _productList.push(new productList(value.id, value.storeId, value.code, value.title, value.price, value.priceOld, value.quantity, value.img));
        });
    });

    console.log(_total);

    this.totalPage = _total;
    this.productList = _productList;

    // this.products = [
    //     new product("APL", "Apple iPhone", "Eat one every day to keep the doctor away!", 12, 90, 0, 2, 0, 1, 2),
    //     new product("AVC", "Avocado", "Guacamole anyone?", 16, 90, 0, 1, 1, 1, 2),
    //     new product("BAN", "Banana", "These are rich in Potassium and easy to peel.", 4, 120, 0, 2, 1, 2, 2)
    // ];

}

store.prototype.pagePrev = function (page) {

    this.curentpage >= 2 ? this.curentpage -= 1:1;
    var _productList = [];
    this._http({
        url: '/admin/product/sale',
        method: "POST",
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        transformRequest: function(obj) {
            var str = [];
            for(var p in obj)
                str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
            return str.join("&");
        },
        data: { page: this.curentpage, json: true }
    }).success(function (r) {
        angular.forEach(r, function (value, key) {
            _productList.push(new productList(value.id, value.storeId, value.code, value.title, value.price, value.priceOld, value.quantity, value.img));
        });
    });
    this.productList = _productList;
}

store.prototype.pageNext = function (page) {
    console.log(this.totalPage);

    this.curentpage < this.totalPage ? this.curentpage += 1:this.totalPage;
    var _productList = [];
    this._http({
        url: '/admin/product/sale',
        method: "POST",
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        transformRequest: function(obj) {
            var str = [];
            for(var p in obj)
                str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
            return str.join("&");
        },
        data: { page: this.curentpage, json: true }
    }).success(function (r) {
        angular.forEach(r, function (value, key) {
            _productList.push(new productList(value.id, value.storeId, value.code, value.title, value.price, value.priceOld, value.quantity, value.img));
        });
    });
    this.productList = _productList;
}

// store.prototype.getProduct = function (sku) {
//     for (var i = 0; i < this.products.length; i++) {
//         if (this.products[i].sku == sku)
//             return this.products[i];
//     }
//     return null;
// }
