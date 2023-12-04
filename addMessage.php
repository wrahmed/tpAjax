<!-- addMessage.php -->
<?php
session_start();
include('userDButil.php') ; 
$dbConnection = new DatabaseConnection("localhost", "root", "", "tpAjax");
$conn = $dbConnection->connect();


$user = $_POST['user'];
$_SESSION['username'] = $_POST['user'];
$message = $_POST['message'];


$stmt = $conn->prepare("INSERT INTO Conversation (User, Message) VALUES (?, ?)");
$stmt->bind_param("ss", $user, $message);
$stmt->execute();
$stmt->close();

$_SESSION['last_inserted_id'] = $conn->insert_id;

$dbConnection->close();
?>
