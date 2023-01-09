/*!
 * jQuery ShoppingCart Plugin v1.4.3
 * http://knopix.net/
 *
 * Copyright 2014 Volodymyr Stelmakh (vov1)
 * Released under the MIT license
 */
(function( $ ){
	
	// Local storage check
	function supportsStorage() {
  		try {
    		return 'localStorage' in window && window['localStorage'] !== null;
		} catch (e) {
    		return false;
  		}
	}
	
	if ( supportsStorage() === true ) {
		
		// Reset all cart
		function Reset() {
			localStorage.setItem('CartProductsDWEB', JSON.stringify( [] ));
			localStorage.setItem('CartCountDWEB', 0);
			localStorage.setItem('CartTotalPriceDWEB', 0);
		}
		
		// Find item index
		function FindItem( id ) {
			var shoppingcartArray = JSON.parse( localStorage.getItem('CartProductsDWEB') );
			
			for(var i in shoppingcartArray) {
    			if ( !shoppingcartArray.hasOwnProperty(i) ) continue;
    			if ( shoppingcartArray[i].id == id ) return i;
    		}
    		
			return null;
		}
		
		// Create empty cart if NOT exist
		if ( localStorage.getItem('CartProductsDWEB') === null ) {
			Reset();
		}
		
		var methods = {
   			// Add item
    		add : function( content ) {
    			
    			// Check for required id & price
    			if ( ! content.id || ! content.price ) {
    				$.error( "'id' OR 'price' is NOT defined!" );
    				return false;
    			}
    			
    			// Get items
    			var shoppingcartArray = JSON.parse( localStorage.getItem('CartProductsDWEB') );
    			
    			// Check if item already in cart
    			index = FindItem( content.id );
    			
    			if ( index === null ) {
    				// item not exist
					shoppingcartArray.push( { 
					'id': parseInt(content.id),
					'image': content.image || '',
					'name': content.name || '',
					'code': content.code || '',
					'url': content.url || '',
					'attributes': content.attributes || [],
					'price': parseFloat(content.price),
					'priceOff': parseFloat((content.priceOff || 0)),
					'count': parseInt( (content.count || 1) ),
					'totalQuantity': parseInt( (content.totalQuantity || 0) )
					} );
				} else {
					if(shoppingcartArray[index].count + 1 <= content.totalQuantity) {
						shoppingcartArray[index].count += parseInt( (content.count || 1) );
                    }
				}
    			
				// Update storage
				localStorage.setItem('CartProductsDWEB', JSON.stringify(shoppingcartArray));

				// Update count
				var Count = parseInt( localStorage.getItem('CartCountDWEB') ) + (content.count || 1);
				localStorage.setItem( 'CartCountDWEB', Count );

				// Update price
				var Price = parseFloat( localStorage.getItem('CartTotalPriceDWEB') ) + (content.price * (content.count || 1));
				localStorage.setItem( 'CartTotalPriceDWEB', Price);
				
				return true;
    		},
    		
    		// Edit item
    		edit : function( content ) {
    			// Check for required id
    			if ( ! content.id ) {
    				$.error( "'id' is NOT defined!" );
    				return false;
    			}
    			
    			// Get items
    			var shoppingcartArray = JSON.parse( localStorage.getItem('CartProductsDWEB') );
    			
    			// Check if item already in cart
    			index = FindItem( content.id );
    			
    			if ( index === null ) {
    				$.error( "No item with required id!" );
    				return false;
    			}
    			else {
					// item exist
					if (content.image !== undefined) {
						shoppingcartArray[index].image = content.image;
					}
					if (content.name !== undefined) {
						shoppingcartArray[index].name = content.name;
					}
					if (content.code !== undefined) {
						shoppingcartArray[index].code = content.code;
					}
					if (content.url !== undefined) {
						shoppingcartArray[index].url = content.url;
					}
					if (content.attributes !== undefined) {
						shoppingcartArray[index].attributes = content.attributes;
					}
                    if (content.totalQuantity !== undefined) {
                        shoppingcartArray[index].totalQuantity = content.totalQuantity;
                    }
					var oldPrice = shoppingcartArray[index].price;
					if (content.price !== undefined) {
						shoppingcartArray[index].price = parseFloat(content.price);
					}
                    if (content.priceOff !== undefined) {
						if(parseFloat(content.priceOff) > shoppingcartArray[index].price) {
							alert('Số tiền lớn hơn giá trị sản phẩm');
						} else {
                        	shoppingcartArray[index].priceOff = parseFloat(content.priceOff);
                        }
                    }
					var oldCount = shoppingcartArray[index].count;
					if (content.count !== undefined) {
						if(content.count <= shoppingcartArray[index].totalQuantity) {
							shoppingcartArray[index].count = parseInt(content.count);
                        } else {
							alert('Số tồn không đủ');
						}
					}
				}
				
				// Update storage
				localStorage.setItem('CartProductsDWEB', JSON.stringify(shoppingcartArray));
				
				// Update count & price
				if ( content.count !== undefined || content.price !== undefined ) {
					var Count = parseInt( localStorage.getItem('CartCountDWEB') ) + (parseInt(content.count) - oldCount);
					localStorage.setItem( 'CartCountDWEB', Count );
					
					var Price = parseFloat( localStorage.getItem('CartTotalPriceDWEB') ) + (shoppingcartArray[index].count * shoppingcartArray[index].price) - (oldCount * oldPrice);
					localStorage.setItem( 'CartTotalPriceDWEB', Price);
				}
				
				return true;
    		},
    		
    		// Remove selected item
   			remove : function( content ) {
      			// Check for required id
    			if ( ! content.id ) {
    				$.error( "'id' is NOT defined!" );
    				return false;
    			}
    			
    			index = FindItem( parseInt(content.id) );
    			if ( index === null) return false;
    			
    			// Get items
    			var shoppingcartArray = JSON.parse( localStorage.getItem('CartProductsDWEB') );
    			// Update count
				var Count = parseInt( localStorage.getItem('CartCountDWEB') ) - shoppingcartArray[index].count;
				localStorage.setItem( 'CartCountDWEB', Count );				
				// Update price
				var Price = parseFloat( localStorage.getItem('CartTotalPriceDWEB') ) - (shoppingcartArray[index].price * shoppingcartArray[index].count);
				localStorage.setItem( 'CartTotalPriceDWEB', Price);		
    			// Remove selected item
    			shoppingcartArray.splice( index, 1 );			
    			// Update storage
				localStorage.setItem('CartProductsDWEB', JSON.stringify(shoppingcartArray));
				
				return true;	
    		},
    		
    		
    		// Clear all cart
    		clear : function(  ) {
      			Reset();
				return true;
    		},
    		
    		
    		// Get items count
    		getCount : function(  ) {
      			return parseInt( localStorage.getItem('CartCountDWEB') );
    		},
    		
    		
    		// Get cart price
    		getPrice : function(  ) {
      			return parseFloat( localStorage.getItem('CartTotalPriceDWEB') );
    		},
    		
    		
    		// Get cart items
    		getAll : function(  ) {
      			// Get items
    			return JSON.parse( localStorage.getItem('CartProductsDWEB') );
    		},
    		
    		// Get item by id
    		getById : function( id ) {
				index = FindItem( parseInt(id) );
				if ( index === null) {
					$.error( "No item with required id!" );
    				return false;
				}
				else {
					// Get all items
    				var shoppingcartArray = JSON.parse( localStorage.getItem('CartProductsDWEB') );
    				return shoppingcartArray[index];
				}
			}
  		};

  		$.shoppingcart = function( method ) {
    		// Method call logic
    		if ( methods[method] ) {
    	  		return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
    		} else if ( typeof method === 'object' || ! method ) {
    	  		return methods.init.apply( this, arguments );
    		} else {
      			$.error( 'Method ' +  method + ' not exist in jQuery.shoppingcart' );
    		} 
  		};
  		
  		
	} else {
		$.error( 'jQuery.shoppingcart: window.localStorage is NOT available!' );
	}
	

})( jQuery );
