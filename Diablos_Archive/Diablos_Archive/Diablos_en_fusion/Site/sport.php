<?php
session_start();
include 'getposition.php';
require_once ("./Connexion_BD/Connect.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="CSS/style.css">
<link rel="stylesheet" type="text/css" href="CSS/liste.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<meta charset="utf-8" />
</head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
/*
Izaac Beaudoin 
Adam Grenon
*/
function saveRow(id,mode) {
	if (mode == "save")
	{
		var text = document.getElementById("newInput"+id).value;
	}
	else
	{
		var text = document.getElementById("newInput").value;
	}
		$.ajax({
			type : 'GET', // send données en GET
			url : "sport_ajax_save_row.php", // url du fichier
			data : 'text='+text+'&id='+id+'&mode='+mode, // send données en GET
			success : function(html){ // traitements JS à faire APRES le retour d'ajax-search.php
			//alert(html);
			annuler();
			<?php sleep(1); ?>
			alert("Le sport a bien été ajouté.");
			location.assign("sport.php?ch=positions");
			}
		});
}	
	
function activerMod(id){
	
var name4 = "col2" + id;
var name2 = "col1" + id;
console.log(name2);

document.getElementById(name4).style.visibility = 'visible'; 
document.getElementById("savedel").style.visibility = 'visible'; 		

var text = document.getElementById(name2).innerText;
console.log("text="+text);
var newInput = document.createElement('input');
newInput.value = text;
newInput.id = "newInput" + id;
newInput.setAttribute("style","width:100%;");

var td = document.getElementById(name2);
td.innerText = "";
td.appendChild(newInput);
	
}

function addRow (){
var rowCount;
rowCount = $('#tablePos tr').length;

if (rowCount < 1){
	
}else{
	
var table = document.getElementById("tablePos");
var row = table.insertRow(1);
var cell2 = row.insertCell(0);
var cell1 = row.insertCell(1);
var cell3 = row.insertCell(2);

cell1.id = "idcell1";
cell2.id = "idcell2";
cell3.id = "idcell3";

document.getElementById("savedel").style.visibility = 'visible'; 

var newButton = document.createElement('button');
newButton.id = "newButton";
newButton.innerText = "Modifier";
newButton.setAttribute('class', 'btn btn-primary btn-lg');
newButton.disabled = true;

var newButton2 = document.createElement('button');
newButton2.id = "newButton";
newButton2.innerText = "Sauvegarder";
var func = "'add'";
newButton2.setAttribute('onclick', 'saveRow(0,'+func+');');
newButton2.setAttribute('class', 'btn btn-primary btn-lg');

var newInput = document.createElement('input');
newInput.id = "newInput" ;
newInput.setAttribute("style","width:100%;");

var button = document.getElementById("idcell1");
button.appendChild(newButton);

var button = document.getElementById("idcell3");
button.appendChild(newButton2);

var td = document.getElementById("idcell2");
td.appendChild(newInput);

var button = document.getElementById("btnAjouter");
button.disabled = true;
	}}
	
function annuler(){
var button = document.getElementById("btnAjouter");
button.disabled = false;

location.assign("sport.php?ch=positions");
}
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
								echo "<li><a href='sport.php' class='btn btn-info active'>Sports</a></li>";
								echo "<li><a href='position_sport.php' class='btn'>Positions</a></li>";
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
	
<button id="btnAjouter" class="btn btn-default" style="margin-bottom:7px;" onclick="addRow();" >Ajouter un sport</button>

<?php

echo '<script>
var elementExists = document.getElementById("tablePos");
if (elementExists !== null)
{
	elementExists.parentNode.removeChild(elementExists);
}
</script>';	


echo '<br>';
echo '<div>';
 echo '<div  id="txtHint"></div>';
$sql = 'SELECT distinct id_sport, sport FROM sports ';
	 $result =  $conn->query($sql);

 echo '<table class="table table-striped table-hover table-bordered" id="tablePos">';
 echo '<thead>';
 echo '<tr class="info">';
 echo '<th style="width:200px;">Sport</th>';
 echo '<th style="width:120px;">Modifier</th>';
 echo '<th style="visibility:hidden;" id="savedel" >Options</th>';
 echo '</tr>';
 echo '</thead><tbody>';
 $ctr = 1;
 foreach ($result as $row){
		$vSave = "'save'";
		echo '<tr id="'.$row['id_sport'].'">';
		echo '<td id=col1'.$row['id_sport'].'>' . $row['sport'] . '</td>';
		echo '<td><button onclick="activerMod('.$row['id_sport'].');" class="btn btn-primary btn-lg" type="button">Modifier</button></td>';
		echo '<td style="visibility:hidden;width:255px;" id="col2'.$row['id_sport'].'">
		<button onclick="saveRow('.$row['id_sport'].','.$vSave.');" type="button" class="btn btn-primary btn-lg">Sauvegarder</button>
		<button onclick="supSport('.$row['id_sport'].');" class="btn btn-primary btn-lg" type="button">Supprimer</button>
		<button onclick="annuler();" type="button" class="btn btn-primary btn-lg">Annuler</button>
		</td></tr>';
 $ctr += 1;
 }
echo '</tbody>';
echo '</table>';
echo '</div>';
echo '</form>';


?>
</div>
</body>
</html>