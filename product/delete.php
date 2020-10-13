<?php
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: GET");
	header("Access-Control-Allow-Credentials: true");
	header('Content-Type: application/json');

	// include database and object files
	include_once '../config/database.php';
	include_once '../objects/product.php';
	
	// get database connection
	$database = new Database();
	$db = $database->getConnection();

	// prepare product object
	$product = new Product($db);

	// get product id
	$data = json_decode(file_get_contents("php://input"));
	
	// set product id to be deleted
	$product->id = $data->id;

	$product->readOne();

	if($product->name != null) {
		// delete the product
		if($product->delete()) {

			// set response code - 200 ok
			http_response_code(200);

			// tell the user
			echo json_encode(array("message" => "Product was deleted."));

		// if unable to delete the product
		} else {

			// set response code - 503 service unavailable
			http_response_code(503);

			// tell the user
			echo json_encode(array("message" => "Unable to delete product."));
		}
	} else {
		// set response code - 503 service unavailable
		http_response_code(503);
		
		// aviso que não há produto com a id
		echo json_encode(array("message" => "Product was not found."));
	}
?>