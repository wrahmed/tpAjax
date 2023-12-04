<?php
// login.php - Example login script

session_start();

session_start();

$conn = new mysqli("localhost", "root", "", "tpAjax");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = $_POST['user'];
$message = $_POST['message'];

$stmt = $conn->prepare("INSERT INTO Conversation (User, Message) VALUES (?, ?)");
$stmt->bind_param("ss", $user, $message);
$stmt->execute();
$stmt->close();

$_SESSION['last_inserted_id'] = $conn->insert_id;

$conn->close();


// Check if the login form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate username and password (you may want to use more secure methods)
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the user (replace this with your authentication logic)
    if ($username === 'your_valid_username' && $password === 'your_valid_password') {
        // Set the username in the session
        $_SESSION['username'] = $username;

        // Redirect to the chat page or wherever you want the user to go after login
        header('Location: index.html');
        exit;
    } else {
        echo "Invalid username or password.";
    }
}
?>
