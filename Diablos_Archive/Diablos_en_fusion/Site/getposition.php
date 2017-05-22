<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<style>
<!-- 

Izaac Beaudoin
Adam Grenon

-->

table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
<script>

function saveRow(id,mode) {
	if (mode == "save")
	{
		var text = document.getElementById("newInput"+id).value;
		
	}
	else
	{
		
		var text = document.getElementById("newInput").value;
		var e = document.getElementById("newSelect");
		console.log(text);
		console.log(e);
		var strUser = e.options[e.selectedIndex].value;
		id = strUser;
	}
			$.ajax({
				
				
				type : 'GET', // send données en GET
				url : "ajax_save_row.php", // url du fichier
				data : 'text='+text+'&id='+id+'&mode='+mode, // send données en GET
				success : function(html){ // traitements JS à faire APRES le retour d'ajax-search.php
				
				alert("1");
				annuler();
				
		
				
				var $response=$(html);
				alert (html);
				var val = $response.filter('#count').text();
				alert (val);
				
				if (val != 0 )
					{
						alert ("Position enregistrée avec succès.");
					}
					else if (val == 0)
					{
						alert ("Erreur lors de l'enregistrement d'une position.");
					}
				
				
				var q = document.getElementById('ch_sport').value;
				showPositions(q);
				
				}
			});
}	
	
function supRow(id) {
	if (confirm('Souhaitez-vous supprimer définitivement cette position?')) {
    $.ajax({
				type : 'GET', // send données en GET
				url : "ajax_sup_row.php", // url du fichier
				data : 'id='+id, // send données en GET
				success : function(html){ 
				// traitements JS à faire APRES le retour d'ajax-search.php

	
				var $response=$(html);
				var val = $response.filter('#count').text();
	
				annuler();
				
					if (val != 0 )
					{
						alert ("Position supprimée avec succès.");
					}
					else if (val == 0)
					{
						alert ("Impossible de supprimer une position associée à un joueur.");
					}
				
				}
			});
	} 
}
	
function supSport(id) {
	if (confirm('Souhaitez-vous supprimer définitivement ce sport?')) {
    $.ajax({
				type : 'GET', // send données en GET
				url : "sport_ajax_sup_row.php", // url du fichier
				data : 'id='+id, // send données en GET
				success : function(html){ 
				// traitements JS à faire APRES le retour d'ajax-search.php

	
				var $response=$(html);
				var val = $response.filter('#count').text();
	
				
				
					if (val != 0 )
					{
						alert ("Sport supprimé avec succès.");
					}
					else if (val == 0)
					{
						alert ("Impossible de supprimer un sport associé à des équipes.");
					}
				annuler();
				}
			});
	} 
}
	
	
function activerMod(id){
	
var name4 = "col4" + id;
var name2 = "col2" + id;
console.log(name2);

document.getElementById(name4).style.visibility = 'visible'; 
document.getElementById("savedel").style.visibility = 'visible'; 	
	

var text = document.getElementById(name2).innerText;
console.log("text="+text);
var newInput = document.createElement('input');
newInput.value = text;
newInput.id = "newInput" + id;

var td = document.getElementById(name2);
td.innerText = "";
td.appendChild(newInput);

	
}


function annuler (){
var button = document.getElementById("btnAjouter");
button.disabled = false;

var q = document.getElementById('ch_sport').value;
showPositions(q);


}
</script>

</head>
<body>
<br><br>
<?php
echo '<form method="GET" action="">';
require_once ("./Connexion_BD/Connect.php");

	$servername = SERVEUR;
	$username = NOM;
	$password = PASSE;
	$dbname = BASE;

$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);	
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!isset($_GET['q'])){
	$q = 0;
}
else{
	$q = $_GET['q'];
}
if ($q !== 0){
	$sql = 'SELECT distinct id_position, p.position,s.sport FROM `positions` p inner join sports s on p.id_sport = s.id_sport where p.id_sport = "'.$q.'"';
	 $result =  $conn->query($sql);
if ($q != "tous"){
 echo '<table class="table table-striped table-hover table-bordered" id="tablePos">'; //TABLE
 echo '<thead><tr class="info">';
 echo '<th>Sport</th>';
 echo '<th>Nom</th>';
 echo '<th>Modifier</th>';
 echo '<th style="visibility:hidden;max-width:356px;" id="savedel" >Options</th>';
 echo '</tr></thead><tbody>';
 $ctr = 1;
 foreach ($result as $row){
		$vSave = "'save'";
		echo '<tr id="'.$row['id_position'].'">';
		echo '<td>' . $row['sport'] . '</td>';
		echo '<td id="col2'.$row['id_position'].'">'. $row['position'].'</td>';
		echo '<td><button onclick="activerMod('.$row['id_position'].');" class="btn btn-primary btn-lg" type="button">Modifier</button></td>';
		echo '<td style="visibility:hidden;" id="col4'.$row['id_position'].'">
		<button onclick="saveRow('.$row['id_position'].','.$vSave.');" type="button" class="btn btn-primary btn-lg">Sauvegarder</button>
		<button onclick="supRow('.$row['id_position'].');" type="button" class="btn btn-primary btn-lg">Supprimer</button>
		<button onclick="annuler();" type="button" class="btn btn-primary btn-lg">Annuler</button>
		</td>';
		echo '</tr>';
 $ctr += 1;
 }
 echo '<script>showPositions('.$_GET['q'].');<script>';
 }
echo '</tbody></table>';
$conn = null;
echo '</form>';
}



?>
</body>
</html>