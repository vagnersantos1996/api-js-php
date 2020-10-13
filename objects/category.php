<?php
	class Category {

		// database connection and table name
		private $conn;
		private $table_name = "categories";

		// object properties
		public $id;
		public $name;
		public $description;
		public $created;

		// constructor with $db as database connection
		public function __construct($db) {
			$this->conn = $db;
		}
		
		// used by select drop-down list
		function read() {

			// select all query
			$query =
			"SELECT
				id, name, description
			FROM
				".$this->table_name."
			ORDER BY
				name";

			// prepare query statement
			$stmt = $this->conn->prepare($query);

			// execute query
			$stmt->execute();

			return $stmt;
		}
	}

	//AQUI
	//https://www.codeofaninja.com/2017/02/create-simple-rest-api-in-php.html

	// 11.0 categories
?>