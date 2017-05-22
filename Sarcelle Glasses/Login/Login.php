<?php
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Le nom d'dutilisateur ou le mot de passe est vide.";
}
else
{
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";

$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$username=$_POST['username'];
$password=$_POST['password'];
// SQL query to fetch information of registerd users and finds user match.
$rows = $connection->query("SELECT count(*) FROM users WHERE password='" .$password ."' AND username='" .$username ."'")->fetchColumn();
if ($rows == 1) {
$_SESSION['login_user']=$username; // Initializing Session

header("location: Session.php"); // Redirecting To Other Page
} else {
$error = "Le nom d'utilisateur ou le mot de passe n'est pas valide.";
}
}
}
?>