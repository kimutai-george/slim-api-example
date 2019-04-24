<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;



$app = new \Slim\App;

//get all customers
$app->get('/api/customers',function(Request $request,Response $response){
		$sql = "SELECT * FROM customers";

		try{
			$dbconfig = new dbconfig();

			$dbconfig = $dbconfig->connect();

			$stmt = $dbconfig->query($sql);
			$customers = $stmt->fetchall(PDO::FETCH_OBJ);
			$dbconfig = null;

			echo json_encode($customers);

		}catch(PDOException $e){
			echo '{"error" : {"text" : '.$e->getMessage().'}';

		}
});

//Get a Single Customer

$app->get('/api/customers/{id}',function(Request $request,Response $response){
	$id = $request->getAttribute('id');
		$sql = "SELECT * FROM customers WHERE id = $id";

		try{
			$dbconfig = new dbconfig();

			$dbconfig = $dbconfig->connect();

			$stmt = $dbconfig->query($sql);
			$customers = $stmt->fetchall(PDO::FETCH_OBJ);
			$dbconfig = null;

			echo json_encode($customers);

		}catch(PDOException $e){
			echo '{"error" : {"text" : '.$e->getMessage().'}';

		}
});

//Add a Customer

$app->post('/api/customers/add',function(Request $request,Response $response){
	$first_name = $request->getParam('first_name');
	$last_name = $request->getParam('last_name');
	$phone_number = $request->getParam('phone_number');
	$email = $request->getParam('email');

		$sql = "INSERT INTO customers (`first_name`,`last_name`,`phone_number`,`email`)
		VALUES (:first_name,:last_name,:phone_number,:email)";

		try{
			$dbconfig = new dbconfig();

			$dbconfig = $dbconfig->connect();

			$stmt = $dbconfig->prepare($sql);
			
			$stmt->bindParam(':first_name', $first_name);
			$stmt->bindParam(':last_name', $last_name);
			$stmt->bindParam(':phone_number', $phone_number);
			$stmt->bindParam(':email', $email);

			$stmt->execute();

			echo '{"notice" : {"text": "Customer Added Successfully"}';

		}catch(PDOException $e){
			echo '{"error" : {"text" : '.$e->getMessage().'}';

		}
});


//Update a Customer

$app->put('/api/customers/update/{id}',function(Request $request,Response $response){
	$id = $request->getAttribute('id');
	$first_name = $request->getParam('first_name');
	$last_name = $request->getParam('last_name');
	$phone_number = $request->getParam('phone_number');
	$email = $request->getParam('email');

		$sql = "UPDATE customers SET 
				first_name = :first_name,
				last_name = :last_name,
				phone_number = :phone_number,
				email = :email
				WHERE id = $id";

		try{
			$dbconfig = new dbconfig();

			$dbconfig = $dbconfig->connect();

			$stmt = $dbconfig->prepare($sql);
			
			$stmt->bindParam(':first_name', $first_name);
			$stmt->bindParam(':last_name', $last_name);
			$stmt->bindParam(':phone_number', $phone_number);
			$stmt->bindParam(':email', $email);

			$stmt->execute();

			echo '{"notice" : {"text": "Customer Updated Successfully"}';

		}catch(PDOException $e){
			echo '{"error" : {"text" : '.$e->getMessage().'}';

		}
});


//Delete a Customer
$app->delete('/api/customers/delete/{id}',function(Request $request,Response $response){
	$id = $request->getAttribute('id');
		$sql = "DELETE FROM customers WHERE id = $id";

		try{
			$dbconfig = new dbconfig();

			$dbconfig = $dbconfig->connect();

			$stmt = $dbconfig->prepare($sql);
			$stmt->execute();
			$dbconfig = null;

			echo '{"notice" : {"text": "Customer Deleted Successfully"}';

		}catch(PDOException $e){
			echo '{"error" : {"text" : '.$e->getMessage().'}';

		}
});


