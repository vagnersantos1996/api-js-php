<?php
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	// get database connection
	include_once '../config/database.php';

	// instantiate product object
	include_once '../objects/product.php';

	$database = new Database();
	$db = $database->getConnection();

	$product = new Product($db);

	//get posted data
	$data = json_decode(file_get_contents("php://input"));
	//https://stackoverflow.com/questions/8893574/php-php-input-vs-post

	// set ID property of product to be edited
	$product->id = $data->id;

	// leio o produto com a id
	$product->readOne();

	// confirmo se ele existe
	if($product->name != null) {
		// set product property values
		$product->name = $data->name;
		$product->price = $data->price;
		$product->description = $data->description;
		$product->category_id = $data->category_id;

		// update the product
		if($product->update()) {

			// set response code - 200 ok
			http_response_code(200);

			// tell the user
			echo json_encode(array("message" => "Product was updated."));

		// if unable to update the product, tell the user
		} else {

			// set response code - 503 service unavailable
			http_response_code(503);

			// tell the user
			echo json_encode(array("message" => "Unable to update the product."));
		}
	} else {
		// set response code - 503 service unavailable
		http_response_code(503);
		
		// aviso que não há produto com a id
		echo json_encode(array("message" => "Product was not found."));
	}
?>