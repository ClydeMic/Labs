<?php
$sql="SELECT * FROM Students WHERE name = ? AND grade = ?";

$stmt = $mysqli->prepare("SELECT * FROM Students WHERE name = ?");
$stmt->bind_param("s", $_POST['name']);
$stmt->execute();

$stmt->close();



mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
  $mysqli = new mysqli("localhost", "username", "password", "dbName");
  $mysqli->set_charset("utf8mb4");
} catch(Exception $e) {
  error_log($e->getMessage());
  //Echo an understandable message to the user.
  exit('Error connecting to database'); 
}

$expected_data = 'Angela';
$query = "SELECT * FROM Students where name=$expected_data";

$manipulated_data = "1; DROP TABLE Students;";
$query = "SELECT * FROM Students where id=$manipulated_data";

$sql = "INSERT INTO Students (name, grade) VALUES (?, ?)";


$db = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8mb4', $username, $password);    
// Make sure that PDO will throw an exception in case of error to make error handling easier
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {
    //Transaction begins all calls can be reverted before commit is called.
    $db->beginTransaction();    
    // Insert the metadata of the order into the database
    $preparedStatement = $db->prepare("INSERT INTO orders (order_id, name, address, created_at)VALUES (?, ?, ?, ?)");
    $preparedStatement->execute( $name,$address,$telephone,time());
    // Get the generated order_id
    $orderId = $db->lastInsertId();

    // Query for inserting the products of the order
    $insertProductsQuery = "INSERT INTO orders_products (order_id, product_id, quantity) VALUES (?,?,?) ";
    $count = 0;
    foreach ( $products as $productId => $quantity ) {
        $insertProductsQuery .= ' (:order_id' . $count . ', :product_id' . $count . ', :quantity' . $count . ')'; 
        $insertProductsParams['order_id' . $count] = $orderId;
        $insertProductsParams['product_id' . $count] = $productId;
        $insertProductsParams['quantity' . $count] = $quantity;
        ++$count;
    }
    // Insert the productsthe order into the database
    $preparedStatement = $db->prepare($insertProductsQuery);
    $preparedStatement->execute($insertProductsParams);
    //Make Changes permanent
    $db->commit();
}
catch ( PDOException $e ) { 
    // Failed to insert the order into the database so we rollback any changes
    $db->rollback();
    throw $e;
}