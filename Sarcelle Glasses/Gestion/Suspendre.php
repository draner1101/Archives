<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "web";

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $query = $conn->prepare("UPDATE " .$_GET["table"] ." SET status='" .$_GET["status"] ."' WHERE " .$_GET["idtype"] ." = " .$_GET["id"]);
    $query->execute();
    header("Location: Gestion" .$_GET["table"] .".php");
?> 