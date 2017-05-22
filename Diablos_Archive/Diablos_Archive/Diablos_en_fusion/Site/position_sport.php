<?php
session_start();
include 'getposition.php';
require_once ("./Connexion_BD/Connect.php");

/*
Izaac Beaudoin
Adam Grenon
*/

?>
<html style="zoom: 100%;">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="CSS/style.css">
<link rel="stylesheet" type="text/css" href="CSS/liste.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<meta charset="utf-8" />
</head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script>
function showPositions(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","getposition.php?q="+str,true);
        xmlhttp.send();
    }
}
function addRow (){

var rowCount;
rowCount = $('#tablePos tr').length;

if (rowCount < 1){
	
}else{
	
var table = document.getElementById("tablePos");
var row = table.insertRow(1);
var cell3 = row.insertCell(0);
var cell2 = row.insertCell(1);
var cell1 = row.insertCell(2);
var cell4 = row.insertCell(3);

cell1.id = "idcell1";
cell2.id = "idcell2";
cell3.id = "idcell3";
cell4.id = "idcell4";

document.getElementById("savedel").style.visibility = 'visible'; 

var newButton = document.createElement('button');
newButton.id = "newButton";
//newButton.style = "width:50px;height:50px;";
newButton.setAttribute('class','btn btn-primary btn-lg');
newButton.innerText = "Modifier";
newButton.disabled = true;

var newButton2 = document.createElement('button');
newButton2.id = "newButton";
//newButton2.style = "width:50px;height:50px;";
newButton2.setAttribute('class','btn btn-primary btn-lg');
newButton2.innerText = "Sauvegarder";
var func = "'add'";
newButton2.setAttribute('onclick', 'saveRow(0,'+func+');');

var newInput = document.createElement('input');
newInput.id = "newInput" ;

var newSelect = document.createElement('select');
newSelect.id = "newSelect" ;

var button = document.getElementById("idcell1");
button.appendChild(newButton);

var button = document.getElementById("idcell4");
button.appendChild(newButton2);


var td = document.getElementById("idcell2");
td.appendChild(newInput);

var select = document.getElementById("idcell3");
select.appendChild(newSelect);

newSelect.innerHTML = document.getElementById('ch_sport').innerHTML;
	
var button = document.getElementById("btnAjouter");
button.disabled = true;
	}}
</script>


<body>
<div class="DivCentral">
	<div class="Header" style='padding-top:10px;'>
		<div class='row'>
			<div class='col-sm-6'><h1 class="text-header">Archives Diablos<br> Cégep de Trois-Rivières</h1></div>
			<div class='col-sm-6'><img class='img-header' src='Images/diablos_logo.png' onclick="location.href = '../../index.php'" style="weight:274px;height:78px;"></img></div>
		</div>
			<?php
				echo '<div class="Header2">';
					echo '<ul class="filtreListe">';
					if (isset($_SESSION['userid']) and isset($_SESSION['nom_utilisateur']) and isset($_SESSION['acces'])){
							echo "<li><a href='formulaire.php?AS=joueurs&MODE=aj' class='btn'>Joueurs</a></li>";
							echo "<li><a href='formulaire.php?AS=entraineurs&MODE=aj' class='btn'>Personnel</a></li>";
							if ($_SESSION['acces'] == '0') {
								echo "<li><a href='formulaire.php?AS=equipes&MODE=aj' class='btn'>Équipes</a></li>";
								echo "<li><a href='sport.php' class='btn'>Sports</a></li>";
								echo "<li><a href='position_sport.php' class='btn btn-info active'>Positions</a></li>";
								echo "<li><a href='createUser.php' class='btn'>Utilisateurs</a></li>";
							
							}
							echo "<li style='float:right;'><a href='connexion.php' class='btn'>Déconnexion</a></li>";
						}
						else
							echo "<li style='float:right;'><a href='connexion.php' class='btn'>Se connecter</a></li>";
					echo '</ul>';
				echo '</div>';
			?>
	</div>

<select onchange="showPositions(this.value)" name="ch_sport" id="ch_sport" class="inputChamps">
<option selected="selected" disabled >Sélectionner une position</option>
<div class="table-responsive">
<?php

echo '<script>
var elementExists = document.getElementById("tablePos");
if (elementExists !== null)
{
	elementExists.parentNode.removeChild(elementExists);
}
</script>';	

	$servername = SERVEUR;
	$username = NOM;
	$password = PASSE;
	$dbname = BASE;
	$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);	
	
	$sql = "SELECT id_sport, sport FROM sports";
	$champs = $conn->query($sql);
							
foreach($champs as $row){
	echo '<option id="'.$row[0].'" value="'.$row[0].'">'.$row[1].'</option>';
}

	echo '</select>';
	echo '<button id="btnAjouter" class="btn btn-default" onclick="addRow();" >Ajouter une position</button>';
 
 if ((isset($_GET['q']) != 0)){
	echo '<script> document.getElementById("ch_sport").selectedIndex = '.$_GET['q'].'; </script>';
 }
 

?>


 <div  id="txtHint"><b></b></div>
</div>
</div>

</body>
</html>