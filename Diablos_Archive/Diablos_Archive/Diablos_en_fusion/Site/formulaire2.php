<?php
ini_set('error_reporting', 0);
ini_set('display_errors', 0);
session_start();
	require_once ("./Connexion_BD/Connect.php");

	$servername = SERVEUR;
	$username = NOM;
	$password = PASSE;
	$dbname = BASE;
	
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}
 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link type="text/css" rel="stylesheet" href="CSS/StyleSheet.css"/>
<link rel="stylesheet" type="text/css" href="CSS/style.css">
<link rel="stylesheet" type="text/css" href="CSS/liste.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script type="text/javascript" src="Script/javascript.js"></script> 
    <title>Formulaire</title>
	<meta charset="utf-8" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>    
<script language=javascript>

function readURL(input) {
if (input.files && input.files[0]) {
	
var reader = new FileReader();

reader.onload = function (e) {
$('#img_photoDefault')
.attr('src', e.target.result);
};
reader.readAsDataURL(input.files[0]);
}
}

/*function readURLBase(input) {
if (input.files && input.files[0]) {
	
var reader = new FileReader();

reader.onload = function (e) {
$('#img_photoBase')
.attr('src', e.target.result);
};
reader.readAsDataURL(input.files[0]);
}
}*/
 
function readURLDyn(input,ctrPhoto) {
if (input.files && input.files[0]) {
	var path = '#img_photo'+ctrPhoto
if (ctrPhoto == 0){
	path = '#img_photo';
} 

var reader = new FileReader();

reader.onload = function (e) {
$(path)
.attr('src', e.target.result);
};
reader.readAsDataURL(input.files[0]);
//alert(ctrPhoto);
}
}
var pathImage = "";
function setPath(){
var fullPath = document.getElementById('photo_athleteDefault').value;
if (fullPath) {
    var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
    var filename = fullPath.substring(startIndex);
    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
        filename = filename.substring(1);
    }
	pathImage = filename;
	document.getElementById("inputHid").value = pathImage;
  //  alert(filename);
 }
}
function getPath(){
	//var inputHid = document.createElement('input');
	//inputHid.setAttribute("type","hidden");
	////inputHid.innerHTML = pathImage;
	return document.getElementById('photo_athleteDefault').value;
	//alert(pathImage);
}

</script>  
<script src="Script/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="Script/javascript_MaskedTextBox.js" type="text/javascript"></script>
<script src="Script/classRegex.js" type="text/javascript"></script>
<script type="text/javascript">
	var ctrEquipe = 0;
	var ctrPosition = 0;
	var ctrNumero = 0;
	var ctrSaison = 0;
	var ctrDiv = 0;
	var ctrA = 0;
	var ctrImg = 0;
	var ctrInput = 0;
	var k = 0;
	function getColor(r,g,b){
		return "rgb("+r+","+g+","+b+")";
	}
	function setAlert(r,g,b,message){
		document.getElementById('p_alert').style.color =  getColor(r,g,b);
		//document.getElementById('p_alert').style.backgroundColor = getColor(r,g,b);
		document.getElementById('p_alert').innerHTML = message;
	}
	function unsetAlert(){
		document.getElementById('p_alert').style.color = 'white';
		document.getElementById('p_alert').innerHTML = "";
	}
	function setCtrEquipe(){
		ctrEquipe++;
		return ctrEquipe;
	};
	function getCtrEquipe(){
		return ctrEquipe;
	};
	function getCtrPosition(){
		ctrPosition++;
		return ctrPosition;
	};
	function getCtrNumero(){
		ctrNumero++;
		return ctrNumero;
	};
	function getCtrSaison(){
		ctrSaison++;
		return ctrSaison;
	};
	function setCtrA(){
		ctrA++;
		return ctrA;
	};
	function setCtrImg(){
		ctrImg++;
		return ctrImg;
	};
	function setCtrInput(){
		ctrInput++;
		return ctrInput;
	};
	function setCtrDiv(){
		ctrDiv++;
		return ctrDiv;
	};
	function getCtrDiv(){
		return ctrDiv;
	};
	function delctrDiv(){
		ctrDiv--;
	};
	function resetCtrDiv(){
		ctrDiv = 0;
	};
	function incrementeAllctr(){
		ctrEquipe++;
		ctrPosition++;
		ctrNumero++;
		ctrSaison++;
		ctrA++;
		//ctrImg++;
		//ctrInput++;
	};
	function resetAllctr(){
		ctrDiv=0;
		ctrEquipe=0;
		ctrPosition=0;
		ctrNumero=0;
		ctrSaison=0;
		ctrImg=0;
		ctrInput=0;
		ctrA=0;
	};
	function putValueCtrDiv(new_value){
		ctrDiv = new_value;
		ctrEquipe=new_value;
		ctrPosition=new_value;
		ctrNumero=new_value;
		ctrSaison=new_value;
		ctrImg=new_value;
		ctrInput=new_value;
		ctrA=new_value;
	};
  //ADD REGION
	function changeHTML(id,message){
		console.log('ID = ' +id);
		console.log('MESSAGE = ' +message);
		document.getElementById(id).value = message;
	};
	function changeSRC(id,message){
		console.log('ID = ' +id);
		console.log('MESSAGE = ' +message);
		document.getElementById(id).src = message;
	};
	function addRegionEquipe(){
		var value = setCtrDiv();
		var newMainDiv = document.createElement('div');
		newMainDiv.id = "div_equipe" + value;
		newMainDiv.setAttribute("style","position:relative;margin-bottom:-10px;overflow:hidden;min-width:590px;border-top: 1px solid black;padding-top:10px;");
		var newFirstDiv = document.createElement('div');
		newFirstDiv.setAttribute("style","float:left;min-height:80px;");
		
		var value = setCtrEquipe();
		var newFirstSelect = document.createElement('select');
		newFirstSelect.id = "id_equipe" + value; //$_SESSION['ctrEquipe'];
		newFirstSelect.name = "id_equipe" + value;// $_SESSION['ctrEquipe'];
		
		var AS = <?php  echo "'".$_GET['AS']."'"; ?>;
		if (AS == 'entraineurs'){
			newFirstSelect.setAttribute("style","display:initial;width:126%;height:30px;float:left;");
			newFirstSelect.setAttribute("onchange","fetch_position(this.value,"+value+")");
			newFirstSelect.className = "form-control";
		}
		else{
			newFirstSelect.setAttribute("style","display:initial;width:100%;height:30px;float:left;");
			newFirstSelect.setAttribute("onchange","fetch_position(this.value,"+value+")");
			newFirstSelect.className = "form-control";
		}
		
		
		newFirstSelect.innerHTML = document.getElementById('id_equipe').innerHTML;
		//console.log(AS);
		if (AS == 'joueurs'){
			var value = getCtrPosition();
			var newSecSelect = document.createElement('select');
			newSecSelect.id = "id_position" + value; //$_SESSION['ctrEquipe'];
			newSecSelect.name = "id_position" + value;// $_SESSION['ctrEquipe'];
			newSecSelect.setAttribute("style","display:initial;width:100%;height:30px;");
			newSecSelect.className = "form-control";
		
			newSecSelect.innerHTML = document.getElementById('id_position').innerHTML;
		
			newFirstDiv.appendChild(newFirstSelect);
			var x = document.createElement("BR");
			var y = document.createElement("BR");
			newFirstDiv.appendChild(newSecSelect);
			newFirstDiv.insertBefore(x,newSecSelect);
			newFirstDiv.insertBefore(y,newSecSelect);
			
						
			var value = getCtrNumero(); //<?php echo $_SESSION['ctrNumero']; ?>;
			//console.log(value);
		
			var newSecDiv = document.createElement('div');
				newSecDiv.setAttribute("style","display:initial;width:30%;overflow:hidden;float:left;margin-left:2%;padding-bottom:20px;");
			var newFirstInput = document.createElement('input');
				newFirstInput.setAttribute("style","display:initial;width:60%;");
				newFirstInput.placeholder = "Numéro"
				newFirstInput.name = "numero" + value;//'<%= Session["ctrNumero"]%>'; //$_SESSION['ctrNumero']
				newFirstInput.id = "numero" + value;//'<%= Session("ctrNumero") %>'; //$_SESSION['ctrNumero'];
				newFirstInput.title = "Numéro";
				newFirstInput.className = "form-control regexNum";
				//newFirstInput->setAttribute("class","equipe_prec");
				newFirstInput.type = "text";
			
			
			var value = getCtrSaison();
			var newSecInput = document.createElement('input');
				newSecInput.setAttribute("style","display:initial;width:60%;margin-top:5px;");
				newSecInput.placeholder = "Saison"
				newSecInput.name = "saison" + value;
				newSecInput.id = "saison" + value;
				newSecInput.title = "Saison";
				newSecInput.className = "form-control regexSaison";
				newSecInput.type = "text";
			
				newSecDiv.appendChild(newFirstInput);
				newSecDiv.appendChild(newSecInput);
				
				var valueA = setCtrA();
				var value = getCtrDiv();
				var newA = document.createElement('a');
				newA.setAttribute('onclick', 'deleteRegionEquipe('+value+')')
				newA.name = "a"+valueA;
				newA.id = "a"+valueA;
				newA.className = "btn formulaire_button";
				newA.setAttribute("style","float:right;font-size:20px;margin:5px;width:10.5px;height:25px;");
				newA.innerHTML = '-';
				
			newMainDiv.appendChild(newFirstDiv);
			newMainDiv.appendChild(newSecDiv);
			newMainDiv.appendChild(newA);
		}
		else if (AS == 'entraineurs'){
			var newFirstInput = document.createElement('input');
				newFirstInput.placeholder = "Rôle"
				newFirstInput.name = "role" + value;
				newFirstInput.id = "role" + value;
				newFirstInput.title = "Rôle";
				newFirstInput.className = "form-control regexNom";
				newFirstInput.setAttribute("style","display:initial;width:initial;width:156%;paddind-bottom:5px");
				newFirstInput.type = "text";
			
			
			newFirstDiv.appendChild(newFirstSelect);
			var x = document.createElement("BR");
			var y = document.createElement("BR");
			newFirstDiv.appendChild(newFirstInput);
			newFirstDiv.insertBefore(x,newFirstInput);
			newFirstDiv.insertBefore(y,newFirstInput);
			
			var valueA = setCtrA();
			var value = getCtrDiv();
				var newA = document.createElement('a');
				newA.setAttribute('onclick', 'deleteRegionEquipe('+value+')')
				newA.name = "a"+valueA;
				newA.id = "a"+valueA;
				newA.className = "btn formulaire_button";
				newA.setAttribute("style","float:right;font-size:20px;margin:5px;width:10.5px;height:25px;");
				newA.innerHTML = '-';
				
			
			newMainDiv.appendChild(newFirstDiv);
			newMainDiv.appendChild(newA);
		}
		document.getElementById('full_div_equipe').appendChild(newMainDiv);
	};
	function changeID_NAME(id,new_value){
		//console.log("ID = "+id);
		//console.log("VALUE = "+new_value);
		document.getElementById(id).name = new_value;
		document.getElementById(id).id = new_value;
	};
	function changeAllChilds(ctr,new_ctr){
		var AS = <?php echo "'".$_GET['AS']."'"; ?>;
		var first;
		var second;
		var thrid;
		if (ctr == 0){
			first = "";
		}
		else{
			first = ctr;
		}
		if (new_ctr == 0){
			second = "";
			thrid = 0;
		}
		else{
			second = new_ctr;
			thrid = new_ctr;
		}
		//id_equipe
		document.getElementById("id_equipe"+first).name = "id_equipe"+second;
		document.getElementById("id_equipe"+first).id = "id_equipe"+second;
		
		//document.getElementById("img_photo"+first).name = "img_photo"+second;
		//document.getElementById("img_photo"+first).id = "img_photo"+second;
		fourth = second;
		if(second == ""){
			fourth = 0;
		}
		
		//document.getElementById("photo_athlete"+first).setAttribute("onchange","readURLDyn(this,"+fourth+"),setPath();");
		//document.getElementById("photo_athlete"+first).name = "photo_athlete"+second;
		//document.getElementById("photo_athlete"+first).id = "photo_athlete"+second;
		
		if (AS == 'joueurs'){
			document.getElementById("id_position"+first).name ="id_position"+second;
			document.getElementById("id_position"+first).id = "id_position"+second;
			//numero
			document.getElementById("numero"+first).name ="numero"+second;
			document.getElementById("numero"+first).id = "numero"+second;
			//saison
			document.getElementById("saison"+first).name ="saison"+second;
			document.getElementById("saison"+first).id = "saison"+second;
		}
		else{
			//role
			document.getElementById("role"+first).name ="role"+second;
			document.getElementById("role"+first).id = "role"+second;
		}
			//a
			document.getElementById("a"+first).setAttribute('onclick', 'deleteRegionEquipe('+thrid+')');
			document.getElementById("a"+first).name = "a"+second;
			document.getElementById("a"+first).id = "a"+second;
			incrementeAllctr();
	};
	function deleteRegionEquipe(id){
		var ctrDiv = getCtrDiv();
		var value = getCtrDiv();
		var new_ctrDiv = 0;
		resetAllctr();
							console.log("-1");
		if (value > 0){
							console.log("0");
				console.log("ctrDiv = "+ctrDiv);
			for(k = 0;k<ctrDiv+1;k++){
				console.log("k = "+k);
				if (k != id){
					if(k == 0){
						if (new_ctrDiv == 0){
							changeID_NAME("div_equipe","div_equipe");
							changeAllChilds(0,0);
							new_ctrDiv++;
							console.log("1");
						}
					}
					else{	
						if (new_ctrDiv == 0){
							changeID_NAME("div_equipe"+k,"div_equipe");
							changeAllChilds(k,0);
							console.log("2");
						}
						else{
							changeID_NAME("div_equipe"+k,"div_equipe"+new_ctrDiv);
							changeAllChilds(k,new_ctrDiv);
							console.log("3");
						}
						new_ctrDiv++;
					}
				}
				else{
					if(id == 0){
						document.getElementById('full_div_equipe').removeChild(document.getElementById('div_equipe'));
							console.log("4");
					}
					else{	
						document.getElementById('full_div_equipe').removeChild(document.getElementById('div_equipe'+id));
							console.log("5");
					}
				}
			}
			putValueCtrDiv(new_ctrDiv-1);
		}
		else{
			
		}
	};
	function showhide(){
		if (document.getElementById('grandeur').checked) {
			document.getElementById('txtcm').style.display = 'block';
			document.getElementById('txtpi').style.display = 'none';
		} else {
			document.getElementById('txtpi').style.display = 'block';
			document.getElementById('txtcm').style.display = 'none';
		}
	};
	
	function verifequipe(){
		console.log(ctrDiv)
	
	}
	
	var listPhoto = [];
	function getListPhoto(pos){
		return listPhoto[pos];
	}
	function pushListPhoto(){
		listPhoto.push(document.getElementById('photo_athleteDefault').value);
		console.log(getListPhoto(1));
	}
    </script>
</head>
	  <!-- Body -->
<body>
<?php
	if (isset($_GET['AS'])){
		$_SESSION['AS'] = $_GET['AS'];
	}
/////fonctions
//checkDate
function safeDate($post){
		if (checkdate(substr($post,5,2),substr($post,8,2),substr($post,0,4))){
			return true;
		}
		else{
			echo '<script>window.alert("La date est invalide")</script>';
			return false;
		}
}
//checkVide
function checkVide($post){
		if (empty($_POST[$post])){
			return "null";
		}
		else{
			return $_POST[$post];
		}
}
//checkNum
function checkNum($post){
	if ($post == ""){
		return true;
	}
	if (is_numeric($post)){
		return true;
	}
	else{
		return false;
	}
}
//safe
function safePass($post){
		$post = str_replace("'","''",$post);
		return $post;
}
//Check la saison
function checkSaison($saison){
		if ($saison == ""){
			return true;
		}
		$array = explode("-",$saison);
		$dateD = $array[0];
		$dateF = $array[1];
		if($dateF > $dateD){
			if (($dateF - $dateD) == 1){
				return true;
			}
			else{
				echo '<script>window.alert("Il faut que la saison a une différence de 1 entre la deuxième année et la première année")</script>';
				return false;
			}
		}
		else{
			echo '<script>window.alert("Il faut que la deuxième année soit plus grande que la première année de la saison")</script>';
			return false;
		}
}
//Set les placeholders selon le nom de table
function trueName($var){
	if ($var == 'prenom'){
		return "Prénom";
	}
	elseif($var == 'ecole_prec'){
		return "École précédente";
	}
	elseif($var == 'ville_natal'){
		return "Ville natale";
	}
	elseif($var == 'domaine_etude'){
		return "Domaine d'étude";
	}
	elseif($var == 'no_tel'){
		return "Numéro de téléphone";
	}
	else{
		$var = ucfirst($var);
		$var = str_replace("_"," ",$var);
		return $var;
	}
}
//Set les maskedInput selon le nom de table
function setMasked($var){
	if (($var == 'taille') or ($var == 'poids')){
		return "regexTaiPoi";
	}
	elseif($var == 'date_naissance'){
		return "regexDaNa";
	}
	elseif($var == 'code_postal'){
		return "regexCoPo";
	}
	elseif($var == 'no_tel'){
		return "regexTel";
	}
	elseif($var == 'courriel'){
		return "regexCourriel";
	}
	elseif($var == 'note'){
		return "regexNote";
	}
	elseif($var == 'annee_obtention'){
		return "regexAn";
	}
	elseif($var == 'saison'){
		return "regexSaison";
	}
	elseif($var == 'rue'){
		return "regexNom";
	}
	elseif( ($var == 'niveau' or $var == 'nom') and $_GET['AS'] == 'equipes'){
		return "regexNomEqu";
	}
	else{
		return "regexNom";
	}
}

function checkEQ($var1){
	
	for($k=0;$k<$var1 -1 ;$k++){
		for($k2=$k+1;$k2<$var1 -1 ;$k2++){
			if(($k == 0) and (isset($_POST['id_equipe'])) ){
				if($_POST['id_equipe'] == $_POST['id_equipe'.$k2]){
					return false;
				}
			}
			elseif(isset($_POST['id_equipe'.$k])){
				if($_POST['id_equipe'.$k] == $_POST['id_equipe'.$k2]){
					return false;
				}
			}
		}
	}
	return true;
}
	
?>
<div class="DivCentral">
	<div class="Header" style='padding-top:10px;'>
		<div class='row'>
			<div class='col-sm-6'><h1 class="text-header">Archives Diablos <br>Cégep de Trois-Rivières</h1></div>
			<div class='col-sm-6'><img class='img-header' src='Images/diablos_logo.png' onclick="location.href = '../../index.php'" style="weight:274px;height:78px;"></img></div>
		</div>
			<?php
				echo '<div class="Header2">';
					echo '<ul class="filtreListe">';
					if (isset($_SESSION['userid']) and isset($_SESSION['nom_utilisateur']) and isset($_SESSION['acces'])){
							echo "<li><a href='formulaire.php?AS=joueurs&MODE=aj' class='btn";
							if ($_GET['AS'] == 'joueurs') {
								echo " btn-info active'>Joueurs</a></li>";
							} else {
								echo "'>Joueurs</a></li>";
							}
							echo "<li><a href='formulaire.php?AS=entraineurs&MODE=aj' class='btn";
							if ($_GET['AS'] == 'entraineurs') {
								echo " btn-info active'>Personnel</a></li>";
							} else {
								echo "'>Personnel</a></li>";
							}
							if ($_SESSION['acces'] == '0') {
								echo "<li><a href='formulaire.php?AS=equipes&MODE=aj' class='btn";
								if ($_GET['AS'] == 'equipes') {
									echo " btn-info active'>Équipes</a></li>";
								} else {
									echo "'>Équipes</a></li>";
								}
								echo "<li><a href='sport.php' class='btn'>Sports</a></li>";
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
	  <form novalidate method="POST"  action="" enctype="multipart/form-data">
	  
	  <div class='row'>
	  <div class='col-sm-4'>
      <div class="divImage">
	  <!-- Photo -->
<?php

		if ($_GET['MODE'] == 'aj'){
			
			
			echo '<img  src="/Diablos_en_fusion/Site/Images/default.png" style="visibility: visible;"  id="img_photoDefault" class="formulaire_photo" alt="Photo introuvable" />  <br>';
            
			echo '<input onchange="readURL(this),setPath();" type="file" name="photo_athleteDefault" id="photo_athleteDefault"><br>';
			echo '<script>pushListPhoto()</script>';
			//<!-- image "mystère" et input submit et input file -->  ';		
						
		}
		else{
			
			
			/*
			//Si joueurs		
			if ($_SESSION['AS'] == 'joueurs'){
				$sql = "Select photo_profil from joueurs where id_joueur = ".$_GET['id'];
			}
			//Si entraineurs
			if ($_SESSION['AS'] == 'entraineurs'){
				$sql = "Select photo_profil from entraineurs where id_entraineur = ".$_GET['id'];
			}
			//Si equipe
			if ($_SESSION['AS'] == 'equipes'){
				$sql = "Select photo_equipe from equipes where id_equipe = ".$_GET['id'];
			}
				$photo = $conn->query($sql);
	
			echo '<div>';			
			foreach ($photo as $row){
				echo "<img src='".$row[0]."' id='img_photoDefault' class='formulaire_photo' />";
			}
			echo '</div>';*/
		}

	echo '</div><br><br>';
	echo '</div>';
	echo '<div class="col-sm-8">';
	  //<!-- Champs -->

	  echo '<div>';
				echo '<input id="inputHid" name="inputHid" type="hidden" />';
		echo '<div>';
			//Si equipe Champ Sport
			if ($_SESSION['AS'] == 'equipes'){
				//Sport
				$sql2 = "SELECT id_sport, sport from sports";
				$champs = $conn->query($sql2);
				echo '<select name="id_sport" id="0" style="width: initial;height:30px;margin-bottom:5px" class="form-control" required>
					<option value="" selected disabled>Choisir un sport</option>';
						foreach($champs as $row){
							echo '<option value="'.$row[0].'">'.$row[1].'</option>';
						}
				echo '</select>';
			}
			
			if($_SESSION['AS'] == 'joueurs'){
				$sql = "SELECT column_name, column_type FROM information_schema.columns WHERE table_schema = 'concep8t_diablos' AND table_name = 'personnes' and (column_name = 'nom' or column_name = 'prenom' or column_name like 'sexe') union SELECT column_name, column_type FROM information_schema.columns WHERE table_schema = 'concep8t_diablos' AND table_name = 'joueurs' and column_name not like 'id%' and column_name not like 'photo_profil'	";			
				//Count nbr champs - Personnes
				$sql2 = "SELECT count(column_name) FROM information_schema.columns WHERE table_schema = 'concep8t_diablos' AND table_name = 'personnes' and (column_name = 'nom' or column_name = 'prenom' or column_name like 'sexe')";
				$ctr_champs = $conn->query($sql2);
				foreach ($ctr_champs as $nbr) {
						$_SESSION['ctr_champs'] = $nbr[0];
				}
			}
			elseif($_SESSION['AS'] == 'entraineurs'){
				$sql = "SELECT column_name, column_type FROM information_schema.columns WHERE table_schema = 'concep8t_diablos' AND table_name = 'personnes' and column_name not like 'id%' union SELECT column_name, column_type FROM information_schema.columns WHERE table_schema = 'concep8t_diablos' AND table_name = 'entraineurs' and column_name not like 'id%' and column_name not like 'photo%'";
				//Count nbr champs - Personnes
				$sql2 = "SELECT count(column_name) FROM information_schema.columns WHERE table_schema = 'concep8t_diablos' AND table_name = 'personnes' and column_name not like 'id%'";
				$ctr_champs = $conn->query($sql2);
				foreach ($ctr_champs as $nbr) {
						$_SESSION['ctr_champs'] = $nbr[0];
				}
			}
			elseif($_SESSION['AS'] == 'equipes'){
				$sql = "SELECT column_name, column_type FROM information_schema.columns WHERE table_schema = 'concep8t_diablos' AND table_name = 'equipes' and column_name not like 'id%' and column_name not like 'niveau%' and column_name not like 'photo%'";
			}
			/*
			elseif($_SESSION['AS'] == 'prix'){
				$sql = "SELECT column_name, column_type FROM information_schema.columns WHERE table_schema = 'concep8t_diablos' AND table_name = 'prix' and column_name not like 'id%'";
			}*/
			
			$champs = $conn->query($sql);
			
			$myArray  = [];
			$myArrayType  = [];
			$ctr = 0;
			if ($_SESSION['AS'] == 'equipes'){
				$ctr = 1;	
			}
			echo '<table class="tableChamps" style="width:100%">';
			foreach ($champs as $row) {
				$myArray[$ctr] = $row[0];
				$myArrayType[$ctr] = $row[1];
				if ($row[0] !== 'photo_profil'){ // and $row[0] !== 'note'){
					//Set placeholder Ex: prénom
					$v_new = trueName($row[0]);
					//$v_new = str_replace("_"," ",$v_new);
					$maskedClass = setMasked($row[0]);
						echo "<tr>";
						if ($ctr < 5) {							
						if ($row[0] == 'sexe'){
								echo '<td><label>Sexe</label></td><td><select name="sexe" id="2" class="form-control LookupFiltre" style="margin-top:5px;width:auto;">';
								echo '<option value="M" selected>Masculin</option>';
								echo '<option value="F">Féminin</option>';
								if ($_GET['AS'] == 'equipes'){
									echo '<option value="X">Mixte</option>';
								}
								echo '</select></td>';
							}
							elseif ($row[0] == 'taille'){
								echo '<td><label>'.$v_new.'</label></td>';
								$taillecm = isset($_POST['taillecm']) ? $_POST['taillecm'] : '0';
								echo '<td><div id="txtcm"><input min="1" max="9999" class="form-control LookupFiltre" min="1" max="9999" id="taillecm" type="number" name="taillecm" value="$taillecm" style="width:90px;margin-top:5px;"></input></div>';								
								$taillepi = isset($_POST['taillepi']) ? $_POST['taillepi'] : '0';
								$taillepo = isset($_POST['taillepo']) ? $_POST['taillepo'] : '0';
								echo "<div id='txtpi' style='display: none'><input  min='1' max='9999' class='form-control LookupFiltre' id='taillepi' type='number' name='taillepi' value='$taillepi' style='width:60px;'>	pi</input>";
								echo "<input  min='1' max='9999' class='form-control LookupFiltre' id='taillepo' type='number' name='taillepo' value='$taillepo' style='width:60px;margin-top:5px;'></input>	po</div>";
								echo '<input id="grandeur" type="radio" name="grandeur" value="cm" onclick="showhide()" checked></input> Centimètres (cm)';
								echo '<input id="grandeur" type="radio" name="grandeur" value="pi" onclick="showhide()"></input> Pieds (pi)</td></div>';
							}
							elseif ($row[0] == 'poids'){
								$poids = isset($_POST['poids']) ? $_POST['poids'] : '0';
								echo '<td><label>'.$v_new.'</label></td><td><input  min="1" max="9999" class="form-control LookupFiltre" style="margin-top:5px;width:90px;" id="poids" type="number" name="poids" value="$poids"></input>	';
								echo '<input type="radio" name="poid" value="lb" checked> Livres (lb)	';
								echo '<input type="radio" name="poid" value="kg"> Kilogrammes (kg)</td>';
							}
							elseif ($row[0] == 'note'){ //note equipe 
								echo '<td style="float:left;"><label>'.$v_new.'</label></td></br><td><textarea minlength="2" rows="5" name="'.$row[0].'" id="'.$ctr.'" title="'.$v_new.'" class="form-control LookupFiltre" style="margin-top:5px;width:450px;"></textarea></td>';
							}
							else{
								echo '<td><label>'.$v_new.'</label></td><td><input name="'.$row[0].'" id="'.$ctr.'" title="'.$v_new.'" class="form-control LookupFiltre '.$maskedClass.'" style="margin-top:5px;width:auto;" type="text"/></td>';
							}
							$ctr = $ctr + 1;
						}
						else{
							if ($row[0] == 'note'){
								echo '<td style="float:left;"><label >'.$v_new.'</label></td></br><td colspan="4"><textarea minlength="2" rows="5" name="'.$row[0].'" id="'.$ctr.'" title="'.$v_new.'" class="form-control LookupFiltre" style="margin-top:5px;width:450px;"></textarea></td>';
								$ctr = $ctr + 1;
							}
							elseif (($ctr % 2) == 0){
								echo '<td><label>'.$v_new.'</label></td><td><input name="'.$row[0].'" id="'.$ctr.'" title="'.$v_new.'" class="form-control LookupFiltre '.$maskedClass.'" style="margin-top:5px;width:auto;" type="text"/></td>';
								$ctr = $ctr + 1;
							}
							else{
								echo '<td><label>'.$v_new.'</label></td><td><input name="'.$row[0].'" id="'.$ctr.'" title="'.$v_new.'" class="form-control LookupFiltre '.$maskedClass.'" style="margin-top:5px;width:auto;" type="text"/></td>';
								$ctr = $ctr + 1;
							}
						}
						echo "</tr>";
				}
			}
			echo "</table>";
			$_SESSION['arrayChamps'] = $myArray;
			$_SESSION['arrayType'] = $myArrayType;
			echo '</div>'; 
			//Si joueurs
			if ($_SESSION['AS'] == 'joueurs'){
			echo '<div id="full_div_equipe" style="display:inline-block;">';
					echo '<a onclick="addRegionEquipe()" class="btn formulaire_button" style="float:right;font-size:18px;margin:5px;">+</a>';
				if ($_GET['MODE'] == 'aj'){
					echo '<h3>Associer à une Équipe </h3>';
				}
				elseif ($_GET['MODE'] == 'mod'){
					echo '<h3>Équipes</h3>';
				}
				echo '<div id="div_equipe" style="border-top:2px solid black;margin-bottom:-5px;border-radius:5px;position:relative;overflow:hidden;padding-top:10px;min-width: 590px;">';
					
						//echo '<div style="display:initial;width:95%;height:30px;float:left;float:left;min-height:80px;"> ';
						//echo '<div style="float:left;min-height:80px;">'; 
							$sql = "SELECT id_equipe, nom from equipes";
							$champs = $conn->query($sql);
							

								echo '<select name="id_equipe" id="id_equipe" style="display:initial;width:35%;height:30px;float:left;" onchange="fetch_position(this.value,\'0\')" class="form-control">
								   <option value="0">Selectionner une équipe</option>';
								   foreach($champs as $row){
									  echo '<option value="'.$row[0].'">'.$row[1].'</option>';
									}
								echo '</select>';
								echo '<a name="a" id="a" onclick="deleteRegionEquipe(0)" class="btn formulaire_button" style="float:right;font-size:20px;margin:5px;width:10.5px;height:25px;">-</a>';
								echo '</br></br>';
								
							//Position
								echo '<select name="id_position" id="id_position" style="display:initial;width:35%;height:30px;float:left" class="form-control">
								   <option value="">Selectionner une position</option>';
									
								echo '</select>';
						//echo '</div';
						echo '<div style="display:initial;width:30%;overflow:hidden;float:left;margin-left:2%;padding-bottom:20px;margin-top:-45px;">';						
							echo '<input placeholder="Numéro" style="display:initial;width:60%;margin-top:5px;" id="numero" name="numero" title="Numero" class="form-control regexNum" type="text"/>';
							echo '<input placeholder="Saison" style="display:initial;width:60%;margin-top:5px;" id="saison" name="saison" title="Saison" class="form-control regexSaison" style="width:100px" type="text"/>';
						echo '</div>';
					//echo '</div>';
					//echo '<div style="overflow:hidden;float:left;margin-left:2%;padding-bottom:20px;">';
							
					//echo '</div>';
						echo '</div>';
			echo '</div>';
			}
			//Si entraineurs
			if ($_SESSION['AS'] == 'entraineurs'){
				//CHAMPS CERTIFICAT
				echo '<div id="div_certificat" style="border-top:2px solid black;border-radius:5px;position: relative;">';
				echo '<h3>Certificat</h3>';
						echo '<input placeholder="Titre" style="display:initial;width:60%;height:30px;" name="titre" id="'.$ctr.'" title="Titre" class="form-control regexNom" type="text"/></br></br>';
							$ctr = $ctr + 1;
						echo '<input placeholder="Description" style="display:initial;width:60%;" name="description" id="'.$ctr.'" title="Description" class="form-control regexNom" type="text"/></br></br>';
							$ctr = $ctr + 1;
						echo '<input placeholder="Date certificat obtenu" style="display:initial;width:30%;" name="annee_obtention" id="'.$ctr.'" title="Date certificat obtenu" class="form-control regexAn" type="text"/></br></br>';
							$ctr = $ctr + 1;
				echo '</div>';
				
			echo '<div id="full_div_equipe" style="display:inline-block;min-width:600px">';
				echo '<a onclick="addRegionEquipe()" class="btn formulaire_button" style="float:right;font-size:18px;margin:5px;":>+</a>';
				if ($_GET['MODE'] == 'aj'){
					echo '<h3>Associer à une Équipe </h3>';
				}
				elseif ($_GET['MODE'] == 'mod'){
					echo '<h3>Équipes</h3>';
				}
				echo '<div id="div_equipe" style="border-top:2px solid black;margin-bottom:-15px;border-radius:5px;position:relative;overflow:hidden;padding-top:10px;min-width:590px;">';
				//echo '<div style="border-top:2px solid black;border-radius:5px;position: relative;overflow:hidden;">';
					echo '<a name="a" id="a" onclick="deleteRegionEquipe(0)" class="btn formulaire_button" style="float:right;font-size:20px;margin:5px;width:10.5px;height:25px;">-</a>';
					
						$sql = "SELECT id_equipe, nom from equipes";
						$champs = $conn->query($sql);
						
							echo '<select name="id_equipe" id="id_equipe" style="display:initial;width:40%;height:30px;float:left;" class="form-control">
							  <option value="" selected="selected">Indéfinie</option>';
							   foreach($champs as $row){
								  echo '<option value="'.$row[0].'">'.$row[1].'</option>';
								}
							echo '</select></br></br>';
							
						echo '<input placeholder="Rôle" style="display:initial;width:initial;width:50%" id="role" name="role" title="Rôle" class="form-control regexNom" type="text"/></br></br>';
					//}
				echo '</div>';
				echo '</div>';
			}
			
		echo '</div>'; 
	echo '</div>'; 
	echo '</div>'; 
	 
	  //<!-- Footer -->
		echo '<footer class="footerFormulaire">';
			echo '<button type="submit" class="btn btn-primary" name="submit" id="submit" style="margin-right:5px;"> Enregistrer </button>'; ?>
			
			</form>
			
			<?php
				echo '<div style="float:right;">';
					echo '<form method="GET" action="">';
						if ($_GET['MODE'] == 'aj'){
							echo '<a href="../../index.php" class="btn formulaire_button"> Retour </a>';
						}
						elseif ($_GET['MODE'] == 'mod'){
							echo '<a href="../../index.php?" class="btn formulaire_button"> Retour </a>';
						}
					echo '</form>';
			echo '</div>';
		echo '</footer>';
	  
	
	//MODE AJOUTER - NOTHING ATM
	if ($_GET['MODE'] == 'aj'){}
	//MODE MODIFIER - Transfert Données
	elseif ($_GET['MODE'] == 'mod'){
		try {
			$k = 0;
					
			// Change le mode à exception (PDO)
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//JOUEURS
			if ($_GET['AS'] == joueurs) {
				//Transfert DATA
					$sql = "SELECT p.nom, p.prenom, p.sexe, j.taille, j.poids, j.ecole_prec, j.ville_natal, j.domaine_etude FROM personnes p INNER JOIN joueurs j ON j.id_personne = p.id_personne WHERE p.id_personne = (SELECT personnes.id_personne FROM personnes INNER JOIN joueurs ON joueurs.id_personne = personnes.id_personne WHERE joueurs.id_joueur = ".$_GET['id'].")"; //inner join joueurs";
					
					$_values = $conn->query($sql);
					
					$array = array();
					foreach ($_values as $key=>$value){
						$array += $value;
					}
					$conteur = 0;
					foreach ($_SESSION['arrayChamps'] as $key=>$value){							
						if ($_SESSION['arrayChamps'][$conteur] == 'taille') {
							//$new_value = str_replace("_","'",$array[$key]);
							echo '<script>changeHTML("taillecm","'.$new_value.'")</script>';
							
							$tail = round($new_value*0.3937007874);
							$pou = $tail % 12;
							$pie = ($tail - $pou) / 12;
							echo '<script>changeHTML("taillepo","'.round($pou).'")</script>';
							echo '<script>changeHTML("taillepi","'.round($pie).'")</script>';
						}
						elseif ($_SESSION['arrayChamps'][$conteur] == 'poids') {
							//$new_value = str_replace("_","'",$array[$key]);
							echo '<script>changeHTML("poids","'.$new_value.'")</script>';
						}
						else {
							if ((is_null($array[$key])) or ($array[$key] == 'null') or ($array[$key]=='')){
								echo '<script>changeHTML('.$key.',"-")</script>';
							}
							else{
								$new_value = str_replace("_","'",$array[$key]);
								echo '<script>changeHTML('.$key.',"'.$new_value.'")</script>';
							}
						}
						$conteur = $conteur + 1;
					}
			//Transfert DATA - FIN
				//SET EQUIPES
				$sql = "select count(*) as nbr, (select GROUP_CONCAT(e.id_equipe) from joueurs_equipes e where e.id_joueur = j.id_joueur) as listID from joueurs j inner join joueurs_equipes je on j.id_joueur = je.id_joueur where j.id_joueur = ".$_GET['id'];
				$result = $conn->query($sql);
				foreach($result as $row) { 
					$listID = explode(',',$row[1]);
						if ($row[0] > 0){
							for ($k = 0;$k<$row[0];$k++){
								$getInfo = new PDO("mysql:host=$servername;dbname=concep8t_diablos", $username, $password);
								$sql = "SELECT CONCAT_WS(',',ifnull(je.id_equipe,''),ifnull(je.id_position,''),ifnull(je.numero,''),ifnull(je.saison,'')) FROM joueurs j left outer join joueurs_equipes je on j.id_joueur = je.id_joueur where j.id_joueur = ".$_GET['id']." and je.id_equipe = ".$listID[$k];
								echo '<script>console.log("sql = '.$sql.'");</script>';
								$infoEquipe = $getInfo->query($sql);
										
								foreach ($infoEquipe as $data){
									$listInfoEquipe = explode(',',$data[0]);
									if ($k == 0){
										echo '<script type="text/javascript">$("#id_equipe").val('.$listInfoEquipe[0].');
										document.getElementById("id_equipe").onchange();
										$("#id_position").val('.$listInfoEquipe[1].');</script>';
										echo '<script type="text/javascript">changeHTML("numero","'.$listInfoEquipe[2].'");</script>';
										echo '<script type="text/javascript">changeHTML("saison","'.$listInfoEquipe[3].'");</script>';
									}

									else{						
										echo '<script type="text/javascript">addRegionEquipe();</script>';
										echo '<script type="text/javascript">$("#id_equipe'.$k.'").val('.$listInfoEquipe[0].');
										document.getElementById("id_equipe'.$k.'").onchange();
										$("#id_position"'.$k.').val('.$listInfoEquipe[1].');</script>';
										echo '<script type="text/javascript">changeHTML("numero'.$k.'",'.$listInfoEquipe[2].');</script>';
										echo '<script type="text/javascript">changeHTML("saison'.$k.'","'.$listInfoEquipe[3].'");</script>';
									}
								}
							}
						}
				}
			//SET EQUIPES - FIN
			//JOUEURS - FIN
			}
			//ENTRAINEURS
			elseif ($_GET['AS'] == entraineurs) {
				$k = 0;
				//Transfert DATA
					$sql = "SELECT p.nom, p.prenom, p.sexe, p.date_naissance, p.rue,p.ville, p.province, p.code_postal, p.courriel, p.no_tel, e.note, ce.titre, ce.description, ce.annee_obtention FROM personnes p INNER JOIN entraineurs e ON e.id_personne = p.id_personne left outer JOIN certifications_entraineurs ce ON ce.id_entraineur = e.id_entraineur LEFT JOIN entraineurs_equipes ee ON ee.id_entraineur = e.id_entraineur WHERE e.id_entraineur = ".$_GET['id'];
					$_values = $conn->query($sql);
				
					$array = array();
					foreach ($_values as $key=>$value){
						$array += $value;
					}
					foreach ($_SESSION['arrayChamps'] as $key=>$value){
						/*if ((is_null($array[$key])) or ($array[$key] == 'null') or ($array[$key]=='')){
							echo '<script type="text/javascript">changeHTML('.$key.',"-")</script>';
						}
						else{*/
							//$new_value = str_replace("_","'",$array[$k]);
							echo '<script type="text/javascript">changeHTML('.$k.',"'.$array[$k].'")</script>';
						//}
						$k = $k + 1;
					}
					//SET certificat
					echo '<script type="text/javascript">changeHTML('.$k.',"'.$array[$k].'")</script>';
					$k++;
					echo '<script type="text/javascript">changeHTML('.$k.',"'.$array[$k].'")</script>';
					$k++;
					echo '<script type="text/javascript">changeHTML('.$k.',"'.$array[$k].'")</script>';
			//Transfert DATA - FIN
				//SET EQUIPES
				$sql = "select count(*) as nbr, (select GROUP_CONCAT(ee.id_equipe) from entraineurs_equipes ee where ee.id_entraineur = e.id_entraineur) as listID from entraineurs e inner join entraineurs_equipes ee on e.id_entraineur = ee.id_entraineur where e.id_entraineur = ".$_GET['id'];
				//echo '<script type="text/javascript">console.log('.$conn->quote($sql).');</script>';
				$result = $conn->query($sql);
				foreach($result as $row) { 
					$listID = explode(',',$row[1]);
						if ($row[0] > 0){
							for ($k = 0;$k<$row[0];$k++){
								echo '<script>console.log("pass")</script>';
								$getInfo = new PDO("mysql:host=$servername;dbname=concep8t_diablos", $username, $password);
								$sql = "SELECT CONCAT_WS(',',ee.id_equipe,ee.role) FROM entraineurs_equipes ee inner join entraineurs e on e.id_entraineur = ee.id_entraineur where e.id_entraineur = ".$_GET['id']." and ee.id_equipe = ".$listID[$k];
								
								$infoEquipe = $getInfo->query($sql);
								foreach ($infoEquipe as $data){
									$listInfoEquipe = explode(',',$data[0]);
									if ($k == 0){
										//$new_value = str_replace("_","'",$listInfoEquipe[1]);
										echo '<script type="text/javascript">changeHTML("id_equipe",'.$listInfoEquipe[0].');</script>';
										echo '<script type="text/javascript">changeHTML("role","'.$listInfoEquipe[1].'");</script>';
									}
									else{
										//$new_value = str_replace("_","'",$listInfoEquipe[1]);
										echo '<script type="text/javascript">addRegionEquipe();</script>';
										echo '<script type="text/javascript">changeHTML("id_equipe'.$k.'",'.$listInfoEquipe[0].');</script>';
										echo '<script type="text/javascript">changeHTML("role'.$k.'","'.$listInfoEquipe[1].'");</script>';
									}
								}
							}
						}
				}
			//SET EQUIPES - FIN
			}
				//EQUIPES
			elseif ($_GET['AS'] == equipes) {
				//Transfert DATA
					$sql = "SELECT e.id_sport,e.nom, e.sexe,e.saison,e.note FROM equipes e inner join sports s on s.id_sport = e.id_sport where id_equipe = ".$_GET['id'];
					$_values = $conn->query($sql);
					
					$array = array();
					//$ctr = 0;
					foreach ($_values as $key=>$value){
						$array += $value;
					}
					foreach ($array as $key=>$value){
							/*if ((is_null($array[$key])) or ($array[$key] == 'null') or ($array[$key]=='')){
								echo '<script>changeHTML('.$key.',"-")</script>';
							}
							else{*/
								//$new_value = str_replace("_","'",$array[$k]);
								echo '<script>changeHTML('.$k.',"'.$new_value.'")</script>';
							//}
							echo '<script>console.log("arrayKEY='.$array[$k].'")</script>';
							echo '<script>console.log("VALUE='.$new_value.'")</script>';
							echo '<script>console.log("k='.$k.'")</script>';
							$k = $key + 1;
					}
				//echo '<script type="text/javascript">changeHTML('.$k.','.$array[$k].');</script>';
			}
			//Transfert DATA - FIN
			
		}
		catch (Exception $e) {
			echo 'Exception : ',  $e->getMessage(), "\n";
		}
	}
	 
	//SUBMIT
 	if(isset($_POST['submit'])){
		//extra validations 
		/*$boo_checkSaison = true;
		$boo_checkNum = true;
		if($_SESSION['AS'] == 'joueurs'){
			//check all saison
			$EonPage = array();
			$boo = true;
			$i = 0;
			//nbr equipe sur la page actuelle
			while ($boo){
				if ($i == 0){
					if( (isset($_POST['id_equipe'])) and (!empty($_POST['id_equipe'])) ){
						if (strtolower($_POST['id_equipe']) !== 'null'){
							$EonPage[$i] = $_POST['id_equipe'];
						}
					}
				}
				else{
					if(isset($_POST['id_equipe'.$i])){
						if(!empty($_POST['id_equipe'.$i])){
							if (($_POST['id_equipe'.$i] !== null) or (strtolower($_POST['id_equipe'.$i]) !== 'null')){
								$EonPage[$i] = $_POST['id_equipe'.$i];
							}
							else{
								$boo = false;
							}
						}
					}
					else{
						$boo = false;
				}
					}
				$i++;
			}	
			$end = count($EonPage);
			if($end > 0){
				for ($k = 0;$k<$i-1;$k++){
					if(($k == 0) and (isset($_POST['saison'])) ){
						$boo_checkSaison = checkSaison($_POST['saison']);
					}
					elseif( ($k > 0) and (isset($_POST['saison'.$k])) ){
						$boo_checkSaison = checkSaison($_POST['saison'.$k]);
					}
				}
			}
			if($end > 0){
				for ($k = 0;$k<$i-1;$k++){
					if(($k == 0) and (isset($_POST['numero'])) ){
						$boo_checkNum = checkNum($_POST['numero']);
					}
					elseif( ($k > 0) and (isset($_POST['numero'.$k])) ){
						$boo_checkNum = checkNum($_POST['numero'.$k]);
					}
				}
				if ($boo_checkNum == false){
					echo '<script>window.alert("Vérifier les numéros du joueur dans les équipes")</script>';
				}
			}
			$boo_checkEQ = true;
			$boo_checkEQ=checkEQ($i);
		}*/
	   //INSERTs INTO
		//if(($boo_checkSaison) and ($boo_checkNum) and ($boo_checkEQ) and( ($_POST['date_naissance'] == "") or (safeDate($_POST['date_naissance']))) ){
			if ($_GET['MODE'] == 'aj'){
				try {
					
					//CHECK VARIABLE IF NULL
					//$_SESSION['photo_url'] = isset($_SESSION['photo_url']) ? $_SESSION['photo_url'] : 'null';
				
					//Joueurs
					if( ($_SESSION['AS'] == 'joueurs') and (!empty($_POST['nom']))and (!empty($_POST['prenom'])) ){
						$sql = "INSERT INTO `concep8t_diablos`.`personnes` (";
						$sql2 = "INSERT INTO `concep8t_diablos`.`joueurs` (";
						$ctr = 0;
						foreach ($_SESSION['arrayChamps'] as $key=>$value){
							if ($ctr < $_SESSION['ctr_champs']){
								$sql = substr_replace($sql,"`", strlen($sql), 0);
								$sql = substr_replace($sql,$value, strlen($sql), 0);
								$sql = substr_replace($sql,"`,", strlen($sql), 0);
							}
							else{
								if ($_SESSION['arrayChamps'][$ctr] == 'taille') {	
									$sql2 = substr_replace($sql2,"`", strlen($sql2), 0);
									$sql2 = substr_replace($sql2,"taille", strlen($sql2), 0);
									$sql2 = substr_replace($sql2,"`,", strlen($sql2), 0);
								}
								elseif ($_SESSION['arrayChamps'][$ctr] == 'poids') {
									$sql2 = substr_replace($sql2,"`", strlen($sql2), 0);
									$sql2 = substr_replace($sql2,"poids", strlen($sql2), 0);
									$sql2 = substr_replace($sql2,"`,", strlen($sql2), 0);
								}
								else {
									$sql2 = substr_replace($sql2,"`", strlen($sql2), 0);
									$sql2 = substr_replace($sql2,$value, strlen($sql2), 0);
									$sql2 = substr_replace($sql2,"`,", strlen($sql2), 0);
								}
							}
							$ctr = $ctr + 1;
						}
						
					 
						$sql = substr($sql,0,strlen($sql)-1);
						$sql = substr_replace($sql,") VALUES (", strlen($sql), 0);
					 
						$sql2 = substr($sql2,0,strlen($sql2)-1);
						
						$checkPhoto = false;
						$url_photo = "/Diablos_en_fusion/Site/Images/default.png";
						$max_value = $conn->query('select max(id_personne) from personnes');
						//Avec/sans photo
						//foreach ($max_value as $id_personne){
							//$result = $conn2->query('select nom,courriel from personnes where id_personne = '.$id_personne[0]);
							//foreach ($result as $row){
								//if($_FILES['photo_athlete']['name']!=""){
						$sql2 = substr_replace($sql2,",`id_personne`) VALUES (", strlen($sql2), 0);
									//$url_photo = $row[1];
									//$checkPhoto = true;
									///$conn2->query('delete from personnes where id_personne = '.$id_personne[0]);
								/*}
								else{
									echo '<script type="text/javascript">console.log("pass3");</script>';
									$sql2 = substr_replace($sql2,",`id_personne`) VALUES (", strlen($sql2), 0);
								}*/
							//}
						//}
						
						$ctr = 0;
						foreach ($_SESSION['arrayChamps'] as $key=>$value){
							if ($_SESSION['arrayChamps'][$ctr] == 'taille') {
								echo '<script>console.log("taille")</script>';
								if ($_POST['grandeur'] == 'cm') {
									$new_value = $_POST['taillecm'];
								}
								else {
									$new_value = $_POST['taillepi'] * 12 + $_POST['taillepo'];
									$new_value = $new_value * 2.54;
								}
							}
							elseif ($_SESSION['arrayChamps'][$ctr] == 'poids') {
								echo '<script>console.log("poids")</script>';
								if ($_POST['poid'] == 'lb') {
									$new_value = $_POST['poids'];
								}
								else {
									$new_value = $_POST['poids'] * 2.2046;
								}
							}
							else {
								$new_value = isset($_POST[$value]) ? $_POST[$value] : '';
							}
							$new_value = str_replace("'","''",$new_value);
							if ($ctr < $_SESSION['ctr_champs']){
								if ( (strpos($_SESSION['arrayType'][$key], 'int') !== false) or (strpos($_SESSION['arrayType'][$key],'double') !== false) ){
									if (empty($new_value)){
										$new_value = 'null';
									}
									$sql = substr_replace($sql,$new_value, strlen($sql), 0);
									$sql = substr_replace($sql,",", strlen($sql), 0);
								}
								else{
									$sql = substr_replace($sql,"'", strlen($sql), 0);
									$sql = substr_replace($sql,$new_value, strlen($sql), 0);
									$sql = substr_replace($sql,"',", strlen($sql), 0);
								}
							}
							else{
								if ( (strpos($_SESSION['arrayType'][$key], 'int') !== false) or (strpos($_SESSION['arrayType'][$key],'double') !== false) ){
									if (empty($new_value)){
										$new_value = 'null';
									}
									$sql2 = substr_replace($sql2,$new_value, strlen($sql2), 0);
									$sql2 = substr_replace($sql2,",", strlen($sql2), 0);
								}
								else{
									$sql2 = substr_replace($sql2,"'", strlen($sql2), 0);
									$sql2 = substr_replace($sql2,$new_value, strlen($sql2), 0);
									$sql2 = substr_replace($sql2,"',", strlen($sql2), 0);
								}
							}
							$ctr = $ctr + 1;
						}
						
						$sql = substr($sql,0,strlen($sql)-1);
						$sql = substr_replace($sql,")", strlen($sql), 0);
					 
						//echo '<script type="text/javascript">console.log("'.$sql.'");</script>';
						$conn->exec($sql);
						
							//last_id - Personnes
							$max = "SELECT max(id_personne) FROM personnes";
							$max = $conn->query($max);
							foreach ($max as $nbr) {
									$_SESSION['max'] = $nbr[0];
							}
						$sql2 = substr_replace($sql2,$_SESSION['max'], strlen($sql2), 0);
						// //Si Avec/Sans photo
							// //if ($checkPhoto){
								// //echo '<script type="text/javascript">console.log("pass");</script>';
								// $target_dir = "/Images/";
								// $target_file = $target_dir . basename($_FILES["photo_athleteDefault"]["name"]);
								// $uploadOk = 1;
								// $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
								
								 //$inputHid = $_POST["inputHid"];
							
								// $sql2 = substr_replace($sql2,",'", strlen($sql2), 0);
								
								//if((isset($_POST['inputHid'])) and $_POST['inputHid'] != ""){
									// $sql2 = substr_replace($sql2,$target_file, strlen($sql2), 0);
									
									// //echo '<script type="text/javascript">console.log("before");</script>';
									// move_uploaded_file($_FILES["photo_athleteDefault"]["tmp_name"], "Profil/".$_FILES["photo_athleteDefault"]["name"]);
									// //echo '<script type="text/javascript">console.log("after");</script>';
								//}
								//else{
								// $sql2 = substr_replace($sql2,'/Diablos_en_fusion/Site/Images/default.png', strlen($sql2), 0);
								//}
								
								// $sql2 = substr_replace($sql2,"'", strlen($sql2), 0);
							
							// //}
						
						$sql2 = substr_replace($sql2,")", strlen($sql2), 0);
						//echo '<script type="text/javascript">console.log("'.$sql2.'");</script>';
						$conn->exec($sql2);
						
						//associer joueurs-equipe
						//last_id - Joueurs
							$max = "SELECT max(id_joueur) FROM joueurs";
							$max = $conn->query($max);
							foreach ($max as $nbr) {
									$_SESSION['max'] = $nbr[0];
							}
							
						//ajout photo-joueurs
								if((isset($_POST['inputHid'])) and $_POST['inputHid'] != ""){
									$target_dir = "/Images/";
									$target_file = $target_dir . basename($_FILES["photo_athleteDefault"]["name"]);
									$uploadOk = 1;
									$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
									
								    move_uploaded_file($_FILES["photo_athleteDefault"]["tmp_name"], "/Diablos_en_fusion/Site/Images/".$_FILES["photo_athleteDefault"]["name"]);
									
									echo '<script>alert("here");</script>';
									
									$conn->exec("update joueurs set photo_profil = '/Images/".$_POST["inputHid"]."' where id_joueur = ".$_SESSION['max']);
									
								}
								else{
									$sql2 = substr_replace($sql2,'/Diablos_en_fusion/Site/Images/default.png', strlen($sql2), 0);
									$conn->exec("update joueurs set photo_profil = '/Diablos_en_fusion/Site/Images/default.png'");
								}
							
								
								
								
							$EonPage = array();
							$boo = true;
							$i = 0;
							//nbr equipe sur la page actuelle
							while ($boo){
								if ($i == 0){
									if( (isset($_POST['id_equipe'])) and (!empty($_POST['id_equipe'])) ){
										if (strtolower($_POST['id_equipe']) !== 'null'){
											$EonPage[$i] = $_POST['id_equipe'];
										}
									}
								}
								else{
									if(isset($_POST['id_equipe'.$i])){
										if(!empty($_POST['id_equipe'.$i])){
											if (($_POST['id_equipe'.$i] !== null) or (strtolower($_POST['id_equipe'.$i]) !== 'null')){
												$EonPage[$i] = $_POST['id_equipe'.$i];
											}
											else{
												$boo = false;
											}
										}
									}
									else{
										$boo = false;
									}
								}
								$i++;
							echo '<script>console.log("i = '.$i.'");</script>';
							}	
							$end = count($EonPage);
							echo '<script>console.log("END = '.$end.'");</script>';
							if($end > 0){// and (!empty($_POST['position'])) ){
								for ($k = 0;$k<=$i;$k++){
									echo '<script>console.log("k='.$k.'");</script>';
										if(($k == 0) and (!empty($_POST['id_equipe'])) ){
											
											//$target_dir = "/Images/";
											//$target_file = $target_dir . basename($_FILES["photo_athlete"]["name"]);
											//if ($target_file == "/Images/"){
											//		$target_file = "/Diablos_en_fusion/Site/Images/default.png";
											//}
											$valueNum = checkVide('numero');
											$sql = "insert into `joueurs_equipes` (`id_joueur`,`id_equipe`,`id_position`,`numero`,`saison`) VALUES (".$_SESSION['max'].",".$_POST['id_equipe'].",".$_POST['id_position'].",".$valueNum.",'".$_POST['saison']."')";
											$conn->exec($sql);
											//move_uploaded_file($_FILES["photo_athlete"]["tmp_name"], "Profil/".$_FILES["photo_athlete"]["name"]);
										}
									
										elseif( ($k > 0) and (($_POST['id_equipe'.$k])!="") ){
											$stmt = new PDO("mysql:host=localhost;dbname=concep8t_diablos", "concep8t_admin", "admin");		
											$stmt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
											$requete = "select count(id_joueur_equipe) from joueurs_equipes where id_equipe = ".$_POST['id_equipe'.$k]." and id_joueur = ".$_SESSION['max']."";
											echo '<script>console.log("rMatch='.$requete.'");</script>';
											$countMatch = $stmt->query($requete);
											foreach ($countMatch as $row){
												$nbrMatch = $row[0];
											}
											echo '<script>console.log("Match='.$nbrMatch.'");</script>';
											if ($nbrMatch == 0){
											echo '<script>console.log("ici3");</script>';
												/*$target_dir = "/Images/";
												$target_file = $target_dir . basename($_FILES["photo_athlete".$k]["name"]);
												if ($target_file == "/Images/"){
													$target_file = "/Diablos_en_fusion/Site/Images/default.png";
												}*/
												$valueNum = checkVide('numero'.$k);
												$sql = "insert into `joueurs_equipes` (`id_joueur`,`id_equipe`,`id_position`,`numero`,`saison`) VALUES (".$_SESSION['max'].",".$_POST['id_equipe'.$k].",".$_POST['id_position'.$k].",".$valueNum.",'".$_POST['saison'.$k]."')";
												//echo '<script>console.log("'.$sql.'");</script>';
												$conn->exec($sql);
												//move_uploaded_file($_FILES["photo_athlete".$k]["tmp_name"], "Profil/".$_FILES["photo_athlete".$k]["name"]);
												//echo '<script>console.log("'.$sql2.'");</script>';
											}
											else{
												$m_equipe = "Le joueur ne peut être dans la même équipe deux fois";
												echo '<script>window.alert("'.$m_equipe.'");</script>';
											}
										}

								//echo '<script>console.log("'.$k.'");</script>';
								echo '<script>console.log("END2");</script>';
								}
							}
						//Joueurs - FIN
						//MESSAGE
						echo '<script>alert("Le joueur a bien été ajouté");</script>';
						//echo '<script>setAlert(92,184,92,"Le joueur a bien été ajouté");</script>';
						//echo '<script>setTimeout(function(){unsetAlert()},10000);</script>';
					}
					//entraineurs
					elseif( ($_SESSION['AS'] == 'entraineurs')  and (!empty($_POST['nom']))and (!empty($_POST['prenom'])) ){
						$sql = "INSERT INTO `concep8t_diablos`.`personnes` (";
						$sql2 = "INSERT INTO `concep8t_diablos`.`entraineurs` (";
						$ctr = 0;
						foreach ($_SESSION['arrayChamps'] as $key=>$value){
							if ($ctr < $_SESSION['ctr_champs']){
								$sql = substr_replace($sql,"`", strlen($sql), 0);
								$sql = substr_replace($sql,$value, strlen($sql), 0);
								$sql = substr_replace($sql,"`,", strlen($sql), 0);
							}
							else{
								$sql2 = substr_replace($sql2,"`", strlen($sql2), 0);
								$sql2 = substr_replace($sql2,$value, strlen($sql2), 0);
								$sql2 = substr_replace($sql2,"`,", strlen($sql2), 0);
							}
							$ctr = $ctr + 1;
						}
						
					 
						$sql = substr($sql,0,strlen($sql)-1);
						$sql = substr_replace($sql,") VALUES (", strlen($sql), 0);
					 
					 
						//echo '<script type="text/javascript">console.log("'.$_SESSION['photo_url'].'");</script>';
						//Si Avec/Sans photo
						$checkPhoto = false;
						$url_photo = "/Diablos_en_fusion/Site/Images/default.png";
						$max_value = $conn->query('select max(id_personne) from personnes');
						//Avec/sans photo
						//foreach ($max_value as $id_personne){
							//$result = $conn2->query('select nom,courriel from personnes where id_personne = '.$id_personne[0]);
							//foreach ($result as $row){
								//if($_FILES['photo_athlete']['name']!=""){
						$sql2 = substr_replace($sql2,"`id_personne`) VALUES (", strlen($sql2), 0);
									//$url_photo = $row[1];
									//$checkPhoto = true;
									///$conn2->query('delete from personnes where id_personne = '.$id_personne[0]);
								/*}
								else{
									echo '<script type="text/javascript">console.log("pass3");</script>';
									$sql2 = substr_replace($sql2,",`id_personne`) VALUES (", strlen($sql2), 0);
								}*/
							//}
						//}
						//Avec/sans photo
						/*foreach ($max_value as $id_personne){
							$result = $conn2->query('select nom,courriel from personnes where id_personne = '.$id_personne[0]);
							foreach ($result as $row){
								if ($row[0] == 'i_get_photo'){
									$sql2 = substr($sql2,0,strlen($sql2)-1);
									$sql2 = substr_replace($sql2,",`id_personne`,`photo_profil`) VALUES (", strlen($sql2), 0);
									$url_photo = $row[1];
									$checkPhoto = true;
									$conn2->query('delete from personnes where id_personne = '.$id_personne[0]);
								}
								else{
									$sql2 = substr($sql2,0,strlen($sql2)-1);
									$sql2 = substr_replace($sql2,",`id_personne`) VALUES (", strlen($sql2), 0);
								}
							}
						}*/
						
						$ctr = 0;
						foreach ($_SESSION['arrayChamps'] as $key=>$value){
							$new_value = isset($_POST[$value]) ? $_POST[$value] : '';
							$new_value = str_replace("'","''",$new_value);
							if ($ctr < $_SESSION['ctr_champs']){
								if ( (strpos($_SESSION['arrayType'][$key], 'int') !== false) or (strpos($_SESSION['arrayType'][$key],'double') !== false) ){
									$sql = substr_replace($sql,$new_value, strlen($sql), 0);
									$sql = substr_replace($sql,",", strlen($sql), 0);
								}
								else{
									$sql = substr_replace($sql,"'", strlen($sql), 0);
									$sql = substr_replace($sql,$new_value, strlen($sql), 0);
									$sql = substr_replace($sql,"',", strlen($sql), 0);
								}
							}
							else{
								if ( (strpos($_SESSION['arrayType'][$key], 'int') !== false) or (strpos($_SESSION['arrayType'][$key],'double') !== false) ){
									$sql2 = substr_replace($sql2,$new_value, strlen($sql2), 0);
									$sql2 = substr_replace($sql2,",", strlen($sql2), 0);
								}
								else{
									$sql2 = substr_replace($sql2,"'", strlen($sql2), 0);
									$sql2 = substr_replace($sql2,$new_value, strlen($sql2), 0);
									$sql2 = substr_replace($sql2,"',", strlen($sql2), 0);
								}
							}
							$ctr = $ctr + 1;
						}
						
						$sql = substr($sql,0,strlen($sql)-1);
						$sql = substr_replace($sql,")", strlen($sql), 0);
					 
						echo '<script type="text/javascript">console.log("'.$sql.'");</script>';
						$conn->exec($sql);
						
							//last_id - Personnes
							$max = "SELECT max(id_personne) FROM personnes";
							$max = $conn->query($max);
							foreach ($max as $nbr) {
									$_SESSION['max'] = $nbr[0];
							}
							$sql2 = substr_replace($sql2,$_SESSION['max'],strlen($sql2), 0);
							$sql2 = substr_replace($sql2,")", strlen($sql2), 0);
							echo '<script type="text/javascript">console.log("'.$sql2.'");</script>';
							$conn->exec($sql2);
						//Si Avec/Sans photo
							//if ($checkPhoto){
								//echo '<script type="text/javascript">console.log("pass");</script>';
								// $target_dir = "/Images/";
								// $target_file = $target_dir . basename($_FILES["photo_athleteDefault"]["name"]);
								// $uploadOk = 1;
								// $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
								
								// $inputHid = $_POST["inputHid"];
							
								//$sql2 = substr_replace($sql2,",'", strlen($sql2), 0);
								/*
								$sql2 = substr_replace($sql2,",'",strlen($sql2), 0);
								if((isset($_POST['inputHid'])) and $_POST['inputHid'] != ""){
									$sql2 = substr_replace($sql2,$target_file, strlen($sql2), 0);
									
									//echo '<script type="text/javascript">console.log("before");</script>';
								//	move_uploaded_file($_FILES["photo_athleteDefault"]["tmp_name"], "Profil/".$_FILES["photo_athleteDefault"]["name"]);
									//echo '<script type="text/javascript">console.log("after");</script>';
								}
								else{
									$sql2 = substr_replace($sql2,'/Diablos_en_fusion/Site/Images/default.png', strlen($sql2), 0);
								}
								*/
							
							//}
							/*
							//Si photo
							if ($checkPhoto){
								$sql2 = substr_replace($sql2,$_SESSION['max'],strlen($sql2), 0);
								$sql2 = substr_replace($sql2,",'",strlen($sql2), 0);
								$sql2 = substr_replace($sql2,$url_photo, strlen($sql2), 0);
								$sql2 = substr_replace($sql2,"'",strlen($sql2), 0);
							}
							else{
								$sql2 = substr_replace($sql2,$_SESSION['max'],strlen($sql2), 0);
							}
						
							$sql2 = substr_replace($sql2,")", strlen($sql2), 0);*/
			
						//certificat
						$maxID = 0;
						//last_id - entraineurs
						$stmt = $conn->query("SELECT max(id_entraineur) FROM entraineurs");
						foreach ($stmt as $nbr) {
							$maxID = $nbr[0];
							echo '<script>console.log("1'.$maxID.'")</script>';
						}
						//if( (isset($_POST['titre'])) and (!empty($_POST['titre'])) ){
							$sql3 = "INSERT INTO `concep8t_diablos`.`certifications_entraineurs` (`id_entraineur`,`titre`,`description`,`annee_obtention`) VALUES (";
							$sql3 = substr_replace($sql3,$maxID, strlen($sql3), 0);
							$sql3 = substr_replace($sql3,",'", strlen($sql3), 0);
							$sql3 = substr_replace($sql3,str_replace("'","''",$_POST['titre']), strlen($sql3), 0);
							$sql3 = substr_replace($sql3,"','", strlen($sql3), 0);
							$sql3 = substr_replace($sql3,str_replace("'","''",$_POST['description']), strlen($sql3), 0);
							$sql3 = substr_replace($sql3,"',", strlen($sql3), 0);
							if (empty($_POST['annee_obtention'])){
								$new_value = 'null';
							}
							else{
								$new_value = $_POST['annee_obtention'];
							}
							$sql3 = substr_replace($sql3,$new_value, strlen($sql3), 0);
							$sql3 = substr_replace($sql3,")", strlen($sql3), 0);
							
							//echo '<script type="text/javascript">console.log("'.$sql3.'");</script>';
							$conn->exec($sql3);
						//}
						
						//associer entraineurs-equipe
							$EonPage = array();
							$boo = true;
							$sql = "";
							$i = 0;
							//nbr equipe sur la page actuelle
							while ($boo){
								if ($i == 0){
									if( (isset($_POST['id_equipe'])) and (!empty($_POST['id_equipe'])) ){
										if (strtolower($_POST['id_equipe']) !== 'null'){
											$EonPage[$i] = $_POST['id_equipe'];
										}
									}
								}
								else{
									if(isset($_POST['id_equipe'.$i])){
										if(!empty($_POST['id_equipe'.$i])){
											if (($_POST['id_equipe'.$i] !== null) or (strtolower($_POST['id_equipe'.$i]) !== 'null')){
												$EonPage[$i] = $_POST['id_equipe'.$i];
											}
											else{
												$boo = false;
											}
										}
									}
									else{
										$boo = false;
									}
								}
								$i++;
							}	
										echo '<script>console.log("2'.$maxID.'")</script>';
							$end = count($EonPage);
							if ($end > 0){
								for ($k = 0;$k<$i-1;$k++){
									if(($k == 0) and (!empty($_POST['id_equipe'])) ){
											/*$target_dir = "/Images/";
											$target_file = $target_dir . basename($_FILES["photo_athlete"]["name"]);
											if ($target_file == "/Images/"){
													$target_file = "/Diablos_en_fusion/Site/Images/default.png";
											}
											echo '<script>console.log("a'.$_POST['id_equipe'].'a")</script>';
											echo '<script>console.log("PASS")</script>';*/
										$sql = "insert into `entraineurs_equipes` (`id_entraineur`,`id_equipe`,`role`) VALUES (".$maxID.",".$_POST['id_equipe'].",'".str_replace("'","''",$_POST['role'])."')";
										$conn->exec($sql);
										
										//move_uploaded_file($_FILES["photo_athlete"]["tmp_name"], "Profil/".$_FILES["photo_athlete"]["name"]);
										
									}
									elseif( ($k > 0) and (!empty($_POST['id_equipe'.$k])) ){
										$stmt = new PDO("mysql:host=localhost;dbname=concep8t_diablos", "concep8t_admin", "admin");		
										$stmt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
										$requete = "select count(id_entr_equipe) from entraineurs_equipes where id_equipe = ".$_POST['id_equipe'.$k]." and id_entraineur = ".$maxID;
										$countMatch = $stmt->query($requete);
										foreach ($countMatch as $row){
											$nbrMatch = $row[0];
										}
										if ($nbrMatch == 0){
											/*$target_dir = "/Images/";
											$target_file = $target_dir . basename($_FILES["photo_athlete".$k]["name"]);
											if ($target_file == "/Images/"){
												$target_file = "/Diablos_en_fusion/Site/Images/default.png";
											}*/
											$sql = "insert into `entraineurs_equipes` (`id_entraineur`,`id_equipe`,`role`) VALUES (".$maxID.",".$_POST['id_equipe'.$k].",'".str_replace("'","''",$_POST['role'.$k])."')";
											$conn->exec($sql);
											//move_uploaded_file($_FILES["photo_athlete".$k]["tmp_name"], "Profil/".$_FILES["photo_athlete".$k]["name"]);
												
										}
										else{
											$m_equipe = "L'entraineur ne peut être dans la même équipe deux fois";
											echo '<script>window.alert("'.$m_equipe.'");</script>';
										}
									}
								//echo '<script>console.log("'.$k.'");</script>';
								}
							}
						//Entraineurs - FIN
						//MESSAGE
						$m_entraineur = "L'entraineur a bien été ajouté";
						echo '<script>alert("'.$m_entraineur.'");</script>';
						///echo '<script>setAlert(92,184,92,"'.$m_entraineur.'");</script>';
						//echo '<script>setTimeout(function(){unsetAlert()},10000);</script>';
					}
					//Équipe
					elseif  ($_SESSION['AS'] == 'equipes') {
					//and (!empty($_POST['nom'])) and (!empty($_POST['id_sport'])) and (checkSaison($_POST['saison'])) ){
					
						/*
						//Si Avec/Sans photo
						$checkPhoto = false;
						$url_photo = "/Diablos_en_fusion/Site/Images/default.png";
						$conn2 = new PDO("mysql:host=localhost;dbname=concep8t_diablos", "concep8t_admin", "admin");
						$max_value = $conn2->query('select max(id_personne) from personnes');
						//Avec/sans photo
						foreach ($max_value as $id_personne){
							$result = $conn2->query('select nom,courriel from personnes where id_personne = '.$id_personne[0]);
							foreach ($result as $row){
								if ($row[0] == 'i_get_photo'){
									
									$url_photo = $row[1];
									$checkPhoto = true;
									$conn2->query('delete from personnes where id_personne = '.$id_personne[0]);
								}
								else{
									$sql = "INSERT INTO `concep8t_diablos`.`equipes` (`id_sport`,`niveau`,`nom`,`saison`,`sexe`) VALUES (";
								}
							}
						}*/
						
						$sql = "INSERT INTO `concep8t_diablos`.`equipes` (`id_sport`,`nom`,`saison`,`sexe`,`note`) VALUES (";
						
						$sql = substr_replace($sql,$_POST['id_sport'], strlen($sql), 0);
						$sql = substr_replace($sql,",'", strlen($sql), 0);
						$sql = substr_replace($sql,str_replace("'","''",$_POST['nom']), strlen($sql), 0);
						$sql = substr_replace($sql,"','", strlen($sql), 0);
						$sql = substr_replace($sql,$_POST['saison'], strlen($sql), 0);
						$sql = substr_replace($sql,"','", strlen($sql), 0);
						$sql = substr_replace($sql,$_POST['sexe'], strlen($sql), 0);
						$sql = substr_replace($sql,"','", strlen($sql), 0);
						$sql = substr_replace($sql,str_replace("'","''",$_POST['note']), strlen($sql), 0);	
						$sql = substr_replace($sql,"')", strlen($sql), 0);
						echo '<script type="text/javascript">console.log("before");</script>';
						//Si Avec/Sans photo
						/*if ($checkPhoto){
							$sql = substr_replace($sql,"','", strlen($sql), 0);
							$sql = substr_replace($sql,$url_photo, strlen($sql), 0);
						}*/
						/*if((isset($_POST['inputHid'])) and $_POST['inputHid'] != ""){
							$target_dir = "/Diablos_en_fusion/Site/Images/";
							$target_file = $target_dir . basename($_FILES["photo_athleteDefault"]["name"]);
							$uploadOk = 1;
							$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
							
							$sql = substr_replace($sql,$target_file, strlen($sql), 0);
									
							//echo '<script type="text/javascript">console.log("before");</script>';
							move_uploaded_file($_FILES["photo_athleteDefault"]["tmp_name"], "Profil/".$_FILES["photo_athleteDefault"]["name"]);
							//echo '<script type="text/javascript">console.log("after");</script>';
							}
							else{
								$sql = substr_replace($sql,'/Diablos_en_fusion/Site/Images/default.png', strlen($sql), 0);
							}
							*/	
						//echo '<script type="text/javascript">console.log("after");</script>';
						echo '<script type="text/javascript">console.log("'.$sql.'");</script>';
						$conn->exec($sql);
					//Équipe - FIN
					//MESSAGE
					$m_equipe = "L'équipe a bien été ajoutée";
					echo '<script>alert("'.$m_equipe.'");</script>';
					//echo '<script>setAlert(92,184,92,"'.$m_equipe.'");</script>';
					//echo '<script>setTimeout(function(){unsetAlert()},10000);</script>';
					}
					
				}
				catch(PDOException $e){
						echo $sql . "<br>" . $e->getMessage();
				}
				$conn = null;
				//Message Help
				if( (isset($_POST['prenom'])) and (isset($_POST['nom'])) and ( (empty($_POST['prenom'])) or (empty($_POST['nom'])) ) ){
					if( ($_GET['AS'] == 'aj') and ($_SESSION['joueurs']) ){
						$m_equipe = "Le nom et le prénom sont obligatoire à l'ajout d'un joueur";
					}
					else{
						$m_equipe = "Le nom et le prénom sont obligatoire à l'ajout d'un entraineur";
					}
					echo '<script>alert("'.$m_equipe.'");</script>';
					//echo '<script>setAlert(204,56,74,"'.$m_equipe.'");</script>';
					//echo '<script>setTimeout(function(){unsetAlert()},10000);</script>';
				}
				elseif( (isset($_POST['nom'])) and (isset($_POST['id_sport'])) and ( (empty($_POST['nom'])) or (empty($_POST['id_sport'])) ) ){
					$m_equipe = "Le nom et le sport sont obligatoire à l'ajout d'une équipe";
					echo '<script>alert("'.$m_equipe.'");</script>';
					//echo '<script>setAlert(204,56,74,"'.$m_equipe.'");</script>';
					//echo '<script>setTimeout(function(){unsetAlert()},10000);</script>';
				}
			}
			//UPDATE
			elseif($_GET['MODE'] == 'mod'){
				try {

					//JOUEURS - UPDATE
					if ($_GET['AS'] == joueurs) {
						//photo
						//info personnelle
							$sql = "UPDATE `concep8t_diablos`.`personnes` SET ";
							$sql2 = "UPDATE `concep8t_diablos`.`joueurs` SET ";
							$ctr = 0;
							foreach ($_SESSION['arrayChamps'] as $key=>$value){
								if ($_SESSION['arrayChamps'][$ctr] == 'taille') {
									if ($_POST['grandeur'] == 'cm') {
										$new_value = $_POST['taillecm'];
									}
									else {
										$new_value = $_POST['taillepi'] * 12 + $_POST['taillepo'];
										$new_value = $new_value * 2.54;
									}
								}
								elseif ($_SESSION['arrayChamps'][$ctr] == 'poids') {
									if ($_POST['poid'] == 'lb') {
										$new_value = $_POST['poids'];
									}
									else {
										$new_value = $_POST['poids'] * 2.2046;
									}
								}
								else {
									$new_value = isset($_POST[$value]) ? $_POST[$value] : '';
								}
								$new_value = str_replace("'","''",$new_value);
								if ($ctr < $_SESSION['ctr_champs']){
									if ( (strpos($_SESSION['arrayType'][$key], 'int') !== false) or (strpos($_SESSION['arrayType'][$key],'double') !== false) ){
										if($new_value == ""){
											$new_value = 'null';
										}
										$sql = substr_replace($sql,"`".$value."` = ".$new_value." ,", strlen($sql), 0);
									}
									else{
										$sql = substr_replace($sql,"`".$value."` = '".$new_value."' ,", strlen($sql), 0);
									}
								}
								else{
									if ( (strpos($_SESSION['arrayType'][$key], 'int') !== false) or (strpos($_SESSION['arrayType'][$key],'double') !== false) ){
										//echo '<script>console.log("VALUE 1 = '.$new_value.'")</script>';
										if($new_value == ""){
											$new_value = 'null';
										}
										//echo '<script>console.log("VALUE 2 = '.$new_value.'")</script>';
										$sql2 = substr_replace($sql2,"`".$value."` = ".$new_value." ,", strlen($sql2), 0);
									}
									else{
										$sql2 = substr_replace($sql2,"`".$value."` = '".$new_value."' ,", strlen($sql2), 0);
									}
								}
								$ctr = $ctr + 1;
							}
							$sql = substr($sql,0,strlen($sql)-1);
							$sql2 = substr($sql2,0,strlen($sql2)-1);
							//get id_personne
							$id_personne = $conn->query("select id_personne from joueurs where id_joueur = ".$_GET['id']);
							foreach ($id_personne as $row){
								$sql .= " where `personnes`.`id_personne` = ".$row[0];
							}
							$sql2 .= " where `joueurs`.`id_joueur` = ".$_GET['id'];
							
							$conn->exec($sql);
							//echo '<script>console.log("VALUE 1 = '.$sql.'")</script>';
							$conn->exec($sql2);	
							//echo '<script>console.log("VALUE 1 = '.$sql2.'")</script>';
						//UPDATE JOUEURS-EQUIPES
							$result = $conn->query($sql);
							
							$EonPage = array();
							$boo = true;
							$i = 0;
							//nbr equipe sur la page actuelle
							while ($boo){
								//echo '<script>console.log("I = '.$i.'");</script>';	
								if ($i == 0){
									if( (isset($_POST['id_equipe'])) and (!empty($_POST['id_equipe'])) ){
										if (strtolower($_POST['id_equipe']) !== 'null'){
											$EonPage[$i] = $_POST['id_equipe'];
										}	
									}
								}
								else{
									if(isset($_POST['id_equipe'.$i])){
										if(!empty($_POST['id_equipe'.$i])){
											if (($_POST['id_equipe'.$i] !== null) or (strtolower($_POST['id_equipe'.$i]) !== 'null')){
												$EonPage[$i] = $_POST['id_equipe'.$i];
											}
											else{
												$boo = false;
											}
										}
									}
									else{
										$boo = false;
									}
								}
								$i++;
							}	
							$end = count($EonPage);
							//echo '<script>console.log("END = '.$end.'");</script>';
							$conn->exec("Delete from joueurs_equipes where id_joueur = ".$_GET['id']);
							if ($end > 0){
								for ($k = 0;$k<$i-1;$k++){
									if(($k == 0) and (!empty($_POST['id_equipe'])) ){
										$valueNum = checkVide('numero');
										$sql = "insert into `joueurs_equipes` (`id_joueur`,`id_equipe`,`id_position`,`numero`,`saison`) VALUES (".$_GET['id'].",".$_POST['id_equipe'].",".$_POST['id_position'].",".$valueNum.",'".$_POST['saison']."')";
										$conn->exec($sql);
									}
									elseif( ($k > 0) and (!empty($_POST['id_equipe'.$k])) ){
										$stmt = new PDO("mysql:host=localhost;dbname=concep8t_diablos", "concep8t_admin", "admin");		
										$stmt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
										$requete = "select count(id_joueur_equipe) from joueurs_equipes where id_equipe = ".$_POST['id_equipe'.$k]." and id_joueur = ".$_GET['id'];
										$countMatch = $stmt->query($requete);
										foreach ($countMatch as $row){
											$nbrMatch = $row[0];
										}
										if ($nbrMatch == 0){
											$valueNum = checkVide('numero'.$k);
											$sql = "insert into `joueurs_equipes` (`id_joueur`,`id_equipe`,`id_position`,`numero`,`saison`) VALUES (".$_GET['id'].",".$_POST['id_equipe'.$k].",".$_POST['id_position'.$k].",".$valueNum.",'".$_POST['saison'.$k]."')";
											$conn->exec($sql);
										}
										else{
											$m_equipe = "Le joueur ne peut être dans la même équipe deux fois";
											echo '<script>window.alert("'.$m_equipe.'");</script>';
										}
									}
								}
							}
						$conn = null;
					//UPDATE JOUEURS-EQUIPES - FIN
						//MESSAGE
						echo '<script>window.alert("Le joueur a bien été modifié");</script>';
						echo '<script language="javascript">location.assign("../../index.php")</script>';
						//$m_joueur = "Le joueur a bien été modifié";
							//echo '<script>setAlert(92,184,92,"'.$m_joueur.'");</script>';
						//echo '<script>setTimeout(function(){unsetAlert()},10000);</script>';
					}
				
						//echo '<script type="text/javascript">console.log("'.$sql.'");</script>';
						//echo '<script type="text/javascript">console.log("'.$sql2.'");</script>';
			
					//ENTRAINEURS - UPDATE
					elseif ($_GET['AS'] == entraineurs) {
						//photo
						//info personnelle
							$sql = "UPDATE `concep8t_diablos`.`personnes` SET ";
							$sql2 = "UPDATE `concep8t_diablos`.`entraineurs` SET ";
							$ctr = 0;
							foreach ($_SESSION['arrayChamps'] as $key=>$value){
								$new_value = isset($_POST[$value]) ? $_POST[$value] : '';
								$new_value = str_replace("'","''",$new_value);
								if ($ctr < $_SESSION['ctr_champs']){
									if ( (strpos($_SESSION['arrayType'][$key], 'int') !== false) or (strpos($_SESSION['arrayType'][$key],'double') !== false) ){
										$sql = substr_replace($sql,"`".$value."` = ".$new_value." ,", strlen($sql), 0);
									}
									else{
										$sql = substr_replace($sql,"`".$value."` = '".$new_value."' ,", strlen($sql), 0);
									}
								}
								else{
									if ( (strpos($_SESSION['arrayType'][$key], 'int') !== false) or (strpos($_SESSION['arrayType'][$key],'double') !== false) ){
										$sql2 = substr_replace($sql2,"`".$value."` = ".$new_value." ,", strlen($sql2), 0);
									}
									else{
										$sql2 = substr_replace($sql2,"`".$value."` = '".$new_value."' ,", strlen($sql2), 0);
									}
								}
								$ctr = $ctr + 1;
							}
							$sql = substr($sql,0,strlen($sql)-1);
							$sql2 = substr($sql2,0,strlen($sql2)-1);
							//get id_personne
							$id_personne = $conn->query("select id_personne from entraineurs where id_entraineur = ".$_GET['id']);
							foreach ($id_personne as $row){
								$sql .= " where `personnes`.`id_personne` = ".$row[0];
							}
							$sql2 .= " where `entraineurs`.`id_entraineur` = ".$_GET['id'];
							
							$conn->exec($sql);
							$conn->exec($sql2);
						//CERTIFICAT
						if ($_POST['annee_obtention'] == ""){
							$new_value = 'null';
						}
						else{
							$new_value = $_POST['annee_obtention'];
						}
						$sql3 = "UPDATE `concep8t_diablos`.`certifications_entraineurs` SET ";
						$sql3 .= "`titre` = '".str_replace("'","''",$_POST['titre'])."', `description` = '".str_replace("'","''",$_POST['description'])."', `annee_obtention` = ".$new_value;
						$sql3 .= " where `id_entraineur` = ".$_GET['id'];
						
						echo '<script>console.log("'.$sql3.'");</script>';
						$conn->exec($sql3);
						//UPDATE ENTRAINEURS-EQUIPES
							$result = $conn->query($sql);
							
							$EonPage = array();
							$boo = true;
							$i = 0;
							//nbr equipe sur la page actuelle
							while ($boo){
								//echo '<script>console.log("I = '.$i.'");</script>';	
								if ($i == 0){
									if( (isset($_POST['id_equipe'])) and (!empty($_POST['id_equipe'])) ){
										if (strtolower($_POST['id_equipe']) !== 'null'){
											$EonPage[$i] = $_POST['id_equipe'];
										}
									}
								}
								else{
									if(isset($_POST['id_equipe'.$i])){
										if(!empty($_POST['id_equipe'.$i])){
											if (($_POST['id_equipe'.$i] !== null) or (strtolower($_POST['id_equipe'.$i]) !== 'null')){
												$EonPage[$i] = $_POST['id_equipe'.$i];
											}
											else{
												$boo = false;
											}
										}
									}
									else{
										$boo = false;
									}
								}
								$i++;
							}	
							$end = count($EonPage);
							//echo '<script>console.log("END = '.$end.'");</script>';
							$conn->exec("Delete from entraineurs_equipes where id_entraineur = ".$_GET['id']);
							if ($end > 0){
								for ($k = 0;$k<$i-1;$k++){
									if(($k == 0) and (!empty($_POST['id_equipe'])) ){
										$sql = "insert into `entraineurs_equipes` (`id_entraineur`,`id_equipe`,`role`) VALUES (".$_GET['id'].",".$_POST['id_equipe'].",'".str_replace("'","''",$_POST['role'])."')";
										$conn->exec($sql);
									}
									elseif( ($k > 0) and (!empty($_POST['id_equipe'.$k])) ){
										$stmt = new PDO("mysql:host=localhost;dbname=concep8t_diablos", "concep8t_admin", "admin");		
										$stmt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
										$requete = "select count(id_entr_equipe) from entraineurs_equipes where id_equipe = ".$_POST['id_equipe'.$k]." and id_entraineur = ".$_GET['id'];
										$countMatch = $stmt->query($requete);
										foreach ($countMatch as $row){
											$nbrMatch = $row[0];
										}
										if ($nbrMatch == 0){
											$sql = "insert into `entraineurs_equipes` (`id_entraineur`,`id_equipe`,`role`) VALUES (".$_GET['id'].",".$_POST['id_equipe'.$k].",'".str_replace("'","''",$_POST['role'.$k])."')";
											$conn->exec($sql);
										}
										else{
											$m_equipe = "L'entraineur ne peut être dans la même équipe deux fois";
											echo '<script>window.alert("'.$m_equipe.'");</script>';
										}
									}
								//echo '<script>console.log("'.$k.'");</script>';
								}
							}
						//FIN ENTRAINEUR
						//MESSAGE
						echo '<script>window.alert("L\'entraineur a bien été modifié");</script>';
						echo '<script language="javascript">location.assign("../../index.php")</script>';
						//$m_entraineur = "L'entraineur a bien été modifié";
						//echo '<script>setAlert(92,184,92,"'.$m_entraineur.'");</script>';
						//echo '<script>setTimeout(function(){unsetAlert()},10000);</script>';
					}
					//EQUIPES - UPDATE
					elseif (($_GET['AS'] == equipes) and (!empty($_POST['nom'])) ){
						//info personnelle
							$sql = "UPDATE `concep8t_diablos`.`equipes` SET ";
							$ctr = 0;
							foreach ($_SESSION['arrayChamps'] as $key=>$value){
								$new_value = isset($_POST[$value]) ? $_POST[$value] : '';
								$new_value = str_replace("'","''",$new_value);
									if ( (strpos($_SESSION['arrayType'][$key], 'int') !== false) or (strpos($_SESSION['arrayType'][$key],'double') !== false) ){
										$sql = substr_replace($sql,"`".$value."` = ".$new_value." ,", strlen($sql), 0);	
									}
									else{
										$sql = substr_replace($sql,"`".$value."` = '".$new_value."' ,", strlen($sql), 0);
									}
								$ctr = $ctr + 1;
							}
						
							$sql .= " `id_sport` = ".$_POST['id_sport']." where `equipes`.`id_equipe` = ".$_GET['id'];
						
							//echo '<script>console.log("'.$sql.'");</script>';
							$conn->exec($sql);
						//FIN - EQUIPE
							//MESSAGE
							echo '<script>window.alert("L\'équipe a bien été modifiée");</script>';
							echo '<script language="javascript">location.assign("../../index.php")</script>';
							//echo '<script>setAlert(92,184,92,"'.$m_equipe.'");</script>';
							//$m_equipe = "L'équipe a bien été modifiée";
							//echo '<script>setTimeout(function(){unsetAlert()},10000);</script>';
					}
					//Message Help
					elseif( (empty($_POST['nom'])) or (empty($_POST['id_sport'])) ){
						$m_equipe = "Le nom et le sport sont obligatoire à la modification d'une équipe";
						echo '<script>alert("'.$m_equipe.'");</script>';
						//echo '<script>setAlert(204,56,74,"'.$m_equipe.'");</script>';
						//echo '<script>setTimeout(function(){unsetAlert()},10000);</script>';
					}
				}
				catch(PDOException $e){
						echo $sql . "<br>" . $e->getMessage();
				}
			}
		//}
	}
	?>
	</div>
</body>
</html>
