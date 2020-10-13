$(document).ready(function() {
	// when a 'search products' button was clicked
    $(document).on('submit', '#search-product-form', function() {
 
        // get search keywords
        var keywords = $(this).find(":input[name='keywords']").val();
 
        // get data from the api based on search keywords
        $.getJSON("http://localhost/api-js-php/product/search.php?s="+keywords, function(data) {
 
            // template in products.js
            readProductsTemplate(data, keywords);
 
			var pageTitle = "";
			if(keywords != "") {
				pageTitle = "Search products: "+keywords;
			} else {
				pageTitle = "Read Products";
			}
			
            // chage page title
            changePageTitle(pageTitle);
 
        });
 
        // prevent whole page reload
        return false;
    });
});