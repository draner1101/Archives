<!DOCTYPE html>
<html>
<body style="background-color:#CCC;color: Black;">

<?php
$numero = $_GET['nopersonne'];
?>

<form action="upload.php?numero=<?=$numero?>" method="post" enctype="multipart/form-data">
    Charger votre image : <br>
    <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
    <input type="submit" value="Ajouter l'image" name="submit">
</form>

</body>
</html>
