<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="Gestion.css">
</head>
<body style="background-color: #EEE">
    <?php 
        include('../Pages partielles/navigationGestion.htm'); 
        if(isset($_GET["table"])){
            $table = $_GET["table"];
            echo "
            <script>
                document.getElementById('$table').classList.add('active');
            </script>
            <div class='contenu'>
                <div class='divForm'>
                    <h1>Modifier $table</h1>                   
            ";
            switch($table){
                case "Produit":
                    echo"
                    <form action='UpdateAll.php'>
                    <input type='hidden' name='table' value='produits'>
                    <input type='hidden' name='id' value='" .$_GET["id"] ."'>
                    Nom du produit: <input class='formulaire' type='text' name='nom' value='" .$_GET["nom"] ."'>
                    <br>
                    Prix: <br><input class='formulaire prix' type='numeric' name='prix' value='" .$_GET["prix"] ."'>
                    <br>
                    Photo: <input class='formulaire' type='file' name='photo'>
                    <br>
                    Tags: <input class='formulaire' type='text' name='tags' value='" .$_GET["tags"] ."'>
                    <br>
                    <input class='button' type='submit' value='Modifier'>
                    ";
                    break;
                case "Fichier":
                    echo"
                    <form action='UpdateAll.php'>
                    <input type='hidden' name='table' value='fichiers'>
                    <input type='hidden' name='id' value='" .$_GET["id"] ."'>
                    Nom du produit: <input  class='formulaire'type='text' name='nom' value='" .$_GET["nom"] ."'>
                    <br>
                    Lien: <input class='formulaire' type='file' name='path'>
                    <br>
                    <input class='button' type='submit' value='Modifier'>
                    ";
                    break;
            }
            echo"</form></div></div>";
        }
    ?>
</body>