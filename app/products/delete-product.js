$(document).ready(function() {
 
    // show html form when 'delete product' button was clicked
    $(document).on('click', '.delete-product-button', function() {
		// get product id
		var product_id = $(this).attr("data-id");
		
		// bootbox for good looking 'confirm pop up'
		bootbox.confirm({

			message: "<h4>Are you sure?</h4>",
			buttons: {
				confirm: {
					label: '<span class="glyphicon glyphicon-ok"></span> Yes',
					className: 'btn-danger'
				},
				cancel: {
					label: '<span class="glyphicon glyphicon-remove"></span> No',
					className: 'btn-primary'
				}
			},
			callback: function(result) {
				if(result == true) {
					$.ajax({
						url: "http://localhost/api-js-php/product/delete.php",
						type: "POST",
						contentType: 'application/json',
						data: JSON.stringify({ id: product_id }),
						success: function(result) {
							// re-load list of products
							showProducts();
						},
						error: function(xhr, resp, text) {
							// show error to console
							console.log(xhr, resp, text);
						}
					});
				}
			}
		});
	});
});