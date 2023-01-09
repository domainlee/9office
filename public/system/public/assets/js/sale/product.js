//----------------------------------------------------------------
// product class
function product(sku, name, description, price, cal, carot, vitc, folate, potassium, fiber) {
    this.sku = sku; // product code (SKU = stock keeping unit)
    this.name = name;
    this.description = description;
    this.price = price;
    this.cal = cal;
    this.nutrients = {
        "Carotenoid": carot,
        "Vitamin C": vitc,
        "Folates": folate,
        "Potassium": potassium,
        "Fiber": fiber
    };
}

function productList(id, storeId, code, title, price, priceOld, quantity, img) {
    this.id = id ? id:null;
    this.storeId = storeId ? storeId:null;
    this.code = code ? code:null;
    this.title = title ? title:null;
    this.price = price ? price:null;
    this.priceOld = priceOld ? priceOld:null;
    this.quantity = quantity ? quantity:null;
    this.img = img ? img:null;
}