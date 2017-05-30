<!DOCTYPE html>
<html>
<head>

</head>
<body>
    <?php
        require_once("../Connexion_BD/Connect.php");
        $username = NOM;
        $servername = SERVEUR;
        $password = PASSE;
        $dbname = BASE;

        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);

        $sql = $conn->prepare("SELECT count(id_joueur) from joueurs WHERE id_parent is null");
        $sql->execute();

        $count = $sql->fetchColumn();
        echo $count;
    ?>
</body>
</html>