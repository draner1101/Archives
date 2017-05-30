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

function saveRow(mode) {
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
				data : 'text='+text+'&mode='+mode, // send données en GET
				success : function(html){ // traitements JS à faire APRES le retour d'ajax-search.php
				//alert(html);
				annuler();
				
				var q = document.getElementById('ch_sport').value;
				showPositions(q);
				}
			});
}	
	/*
function supRow(id) {
	if (confirm('Souhaitez-vous supprimer définitivement cette position?')) {
    $.ajax({
				type : 'GET', // send données en GET
				url : "ajax_sup_row.php", // url du fichier
				data : 'id='+id, // send données en GET
				success : function(html){ // traitements JS à faire APRES le retour d'ajax-search.php
				annuler();}
			});
	} 
}*/
	
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

var td = document.getElementById(name2);
td.innerText = "";
td.appendChild(newInput);

	
}


function annuler (){
var button = document.getElementById("btnAjouter");
button.disabled = false;

var q = document.getElementById('ch_sport').value;
//document.getElementById(q-1).selected;
showPositions(q);

/*
document.getElementById("ch_sport").selectedIndex = q

alert(q);*/
//location.assign("position_sport.php?ch=positions&q="+q);


//"+document.getElementById("ch_sport").value);
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
if ($q == 0){
	//$sql = 'SELECT distinct id_sport, p.position,s.sport FROM `positions` p inner join sports s on p.id_sport = s.id_sport';
}
else{
	$sql = 'SELECT distinct id_sport, sport FROM sports ';
	 $result =  $conn->query($sql);
if ($q != "tous"){
 echo '<table id="tablePos">';
 echo '<tr>';
 echo '<td>Sport</td>';
 echo '<td>Modifier</td>';
 echo '<td style="visibility:hidden;" id="savedel" >Options</td>';
 echo '</tr>';
 $ctr = 1;
 foreach ($result as $row){
		$vSave = "'save'";
		echo '<tr id="'.$row['id_sport'].'">';
		echo '<td id="col2'.$row['id_sport'].'></td>'.$row['sport'].'</td>';
		echo '<td style="width:100%;height:100%;"><button onclick="activerMod('.$row['id_sport'].');" style="width:50px;height:50px;" type="button">Modifier</button></td>';
		echo '<td style="visibility:hidden;" id="col4'.$row['id_sport'].'">
		<button onclick="saveRow('.$row['id_sport'].','.$vSave.');" style="width:50px;height:50px;" type="button">Sauvegarder</button>
		<button onclick="annuler();" style="width:50px;height:50px;" type="button">Annuler</button>
		</td>';
		echo '</tr>';
		//<button onclick="supRow('.$row['id_sport'].');" style="width:50px;height:50px;" type="button">Supprimer</button>
//	echo '<td>'; echo $row[3]; echo '</td>';
 echo '<tr></tr>';
 $ctr += 1;
 }
 echo '<script>showPositions('.$_GET['q'].');<script>';
 }/*
while($row = mysqli_fetch_array($result)) {
    echo '<tr>';
    echo '<td></td>';
    echo '<td>' . $row['Nom'] . '</td>';
    echo '<td>' . $row['Sport'] . '</td>';
    echo '</tr>';
}*/
echo '</table>';
$conn = null;
echo '</form>';
}



?>
</body>
</html>