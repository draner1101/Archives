<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="Gestion.css">
</head>
<body style="background-color: #EEE">
    <?php 
        include('../Pages partielles/navigationGestion.htm'); 
        if(isset($_GET["Table"])){
            $table = $_GET["Table"];
            echo "<script>
            document.getElementById('$table').classList.add('active');
            </script>
            <div class='contenu'>
            <div class='divForm'>
            <h1>Ajouter $table</h1>
            <form action='AddAll.php'>";
            switch($table){
                case "Produit":
                    echo"
                    <input type='hidden' name='table' value='produits'>
                    Nom du produit: <input  class='formulaire'type='text' name='nom'>
                    <br>
                    Prix: <br><input class='formulaire prix' type='numeric' name='prix'>
                    <br>
                    Photo: <input class='formulaire' type='file' name='photo'>
                    <br>
                    Tags: <input class='formulaire' type='text' name='tags'>
                    <br>
                    <input class='button' type='submit' value='Creer'>
                    ";
                    break;
                case "Fichier":
                    echo"
                    <input type='hidden' name='table' value='fichiers'>
                    Nom du produit: <input  class='formulaire'type='text' name='nom'>
                    <br>
                    Lien: <input class='formulaire' type='file' name='path'>
                    <br>
                    <input class='button' type='submit' value='Creer'>
                    ";
                    break;
            }
            echo"</form></div></div>";
        }
    ?>
</body>