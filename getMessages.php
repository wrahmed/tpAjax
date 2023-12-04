<?php
session_start();
include('userDButil.php') ; 

$dbConnection = new DatabaseConnection("localhost", "root", "", "tpAjax");
$conn = $dbConnection->connect();

$result = $conn->query("SELECT * FROM Conversation ORDER BY idMessage DESC");

$messages = array();

while ($row = $result->fetch_assoc()) {
    $authorClass = ($row['User'] == $_SESSION['username']) ? 'self' : 'other';
    $messageText = htmlspecialchars($row['Message']);
    $messages[] = array(
        'author' => $row['User'],
        'message' => $messageText,
        'authorClass' => $authorClass
    );
}

echo json_encode($messages);

$dbConnection->close();

?>
