<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "web";

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $query = $conn->prepare("UPDATE users SET courriel='" .$_POST["courriel"] ."', password='" .$_POST['password'] ."' WHERE username = '" .$_SESSION['login_user'] ."'");
    
    $query->execute();

    header("Location: Session.php");
?> 