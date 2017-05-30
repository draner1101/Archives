<?php
session_start();
?>
<!DOCTYPE html>
<html>
<script type="text/javascript">
    function MessageConfirmation(msg) 
    {
        if (confirm(msg) == true)
        {
            return true;
        }
        else
        {
            return false;
        }

    }
</script>
<body style="background-color:#CCC;color: Black;">

<?php
        if(isset($_SESSION['acces']) && ($_SESSION['acces'] >= 0)){
            echo "<form action='uploadpub.php' method='post' enctype='multipart/form-data'>
    Charger votre image dans le slider : <br>
    <input type='file' name='fileToUpload' id='fileToUpload'><br><br>
    <input type='submit' value='Ajouter vos images' name='submit'>
</form>
<br>
<form onsubmit='var x=MessageConfirmation('Voulez-vous supprimer toutes les photos?');return x;' action='uploadpub.php' method='post' enctype='multipart/form-data'>
<input type='submit' value='Supprimer toutes les photos' name='vider'>
</form>
";
        }
        else{
            echo "<script>alert('Vous n\'avez pas accès à la console de publicité');</script>";
        }
        ?>



</body>
</html>
