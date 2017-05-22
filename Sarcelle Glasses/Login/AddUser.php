<?php
    function redirect($page){
        header("Location: " .$page);
        exit;
    }
    $date = getdate();
    $now = $date['year'] ."-" .$date['mon'] ."-" .$date['mday'];
    echo $now;
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "web";

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $row = $conn->query("SELECT COUNT(*) FROM USERS WHERE username='" .$_POST['username'] ."'")->fetchColumn();

    if($row == 1){
        redirect("Register.php?action=deja");
    }
    else{
    $query = $conn->prepare("INSERT INTO users(idtype, username, password, courriel, status, date_creation) VALUES(:idtype, :username, :password, :courriel, :status, :date_creation)");
             $query->execute(array(
                                "idtype" => "2",
                                "username" => $_POST["username"],
                                "password" => $_POST["password"],
                                "courriel" => $_POST["courriel"],
                                "status" => "Actif",
                                "date_creation"=>$now
                            ));
    redirect("LoginForm.php");
    //header("Location: LoginForm.php");
    }
?>