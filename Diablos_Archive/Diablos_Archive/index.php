<?php 
header("Cache-Control: no-cache, must-revalidate");    
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");  
session_start();
require_once ("Diablos_en_fusion/Site/Connexion_BD/Connect.php");
require_once ("Diablos_en_fusion/Site/Connexion_BD/Connexion.php");
require_once ("Diablos_en_fusion/Site/Connexion_BD/ExecRequete.php");
require_once ("Diablos_en_fusion/Site/Connexion_BD/Normalisation.php");

// Connexion à la base
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
Normalisation(); 
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Diablos Accueil</title>
    <!--Liens fichiers CSS-->
    <link rel="stylesheet" type="text/css" target=_blank href="Diablos_en_fusion/Site/CSS/style.css">
    <link rel="stylesheet" type="text/css" target=_blank href="Diablos_en_fusion/Site/CSS/liste.css">
    <link rel="stylesheet" type="text/css" target=_blank href="Diablos_en_fusion/Site/CSS/tableauPopup.css">
    <link rel="stylesheet" type="text/css" target=_blank href="Diablos_en_fusion/Site/slick/slick.css">
    <link rel="stylesheet" type="text/css" target=_blank href="Diablos_en_fusion/Site/slick/slick-theme.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->

    <script type="text/javascript" src="Diablos_en_fusion/Site/Script/jquery.js"></script>
    <script type="text/javascript" src="Diablos_en_fusion/Site/Script/javascript.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="Diablos_en_fusion/Site/Script/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="Diablos_en_fusion/Site/Script/classie.js"></script>
    <!--<script src="Diablos_en_fusion/Site/Script/slider.js"></script>-->
    <script>
        function init() {
            window.addEventListener('scroll', function(e) {
                var distanceY = window.pageYOffset || document.documentElement.scrollTop,
                    shrinkOn = 300,
                    header = document.querySelector("header");
                if (distanceY > shrinkOn) {
                    classie.add(header, "smaller");
                } else {
                    if (classie.has(header, "smaller")) {
                        classie.remove(header, "smaller");
                    }
                }
            });
        }
        window.onload = init();
    </script>
</head>

<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>

<body onload = "remplirAnnee();">
    <div class="Header" id="accueil">
        <div>
            <header>
                <div class="container clearfix">
                    <img src='Diablos_en_fusion/Site/Images/diablos_logo.png' onclick="location.href = 'index.php'"></img>
                    <!--<div class='col-sm-6'><h1 class="text-header">Archives Diablos <br> Cégep de Trois-Rivières</h1></div>-->
                    <nav>
                        <a href="#accueil">Accueil</a>
                        <a href="#recherche">Recherche</a>
                        <a href="#info">Nous Joindre</a>
                    </nav>
                </div>
            </header>
        </div>
    </div>
    <div id="mycarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <?php
					$nomDossier = "Diablos_en_fusion/Site/Images/Carousel";
					$images = scandir($nomDossier);
					$ignore = Array(".", "..", "Publicite");
					foreach($images as $imageCour){
						if(!in_array($imageCour, $ignore)){
							echo "<div class='item'><img src=\"" . $nomDossier . "/" . $imageCour . "\"></div>";
						}
					}
				?>
        </div>
        <!-- Controls -->
        <!--<a class="carousel-caption" href="#recherche">
            <span class="glyphicon glyphicon-menu-down" aria-hidden="true" style="font-size: 50px;"></span>
        </a>-->
        <div class="carousel-caption">
            <input type="text" class="recherche" name="search" placeholder="Je recherche...">
            <button class="weirdButton search" onclick="recherche()">s</button>
            <div class="select">
                <span class="arr" style ="margin-right:-5px"></span>
                <select id="annee">
                </select>
            </div>
        </div>
        <a class="left carousel-control" href="#mycarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#mycarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="container">
        <div class="DivListe">
            <?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////?>
            <?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////?>
            <?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////?>
            <div id="recherche">
                <?php
				echo "<div class='row' style='margin-bottom:5px; margin-top:4px; margin-left:28.4%;'>";
				
				// echo "<div class='col-sm-12 col-xl-6 col-md-6' style='margin-top:4px;'><table class='tblRech'><tr><td style='vertical-align:middle'><label style='font-size:medium;margin-bottom:0px;'>Rechercher </label></td>";
				// $nom = isset($_POST['text']) ? $_POST['text'] : '';
				// echo "<td style='width:100%'><input type='text' name='text' id='text' class='form-control rech LookupFiltre' style='width:95%' placeholder='ex: Alex' value=\"".htmlspecialchars($nom, ENT_QUOTES)."\"></input></td></tr></table></div>";
				
				echo "<div class='col-sm-12 col-xl-6 col-md-6' style='margin-top:4px;'><table class='tblRech'><tr><td style='vertical-align:middle'><label style='margin-bottom:0px;'>Entre </label></td>";

				echo "<td><input type='number' id='date1' class='form-control LookupFiltre' style='width:95%' name='date1' placeholder='AAAA'  onfocusout =\"anneeAuto('date1')\"></input></td>";
				
				echo "<td style='vertical-align:middle'><label style='margin-bottom:0px;'> et </label></td>";

				echo "<td><input type='number' id='date2' class='form-control LookupFiltre' style='width:95%' name='date2' placeholder='AAAA'  onfocusout =\"anneeAuto('date2')\"></input></td>";
				echo "</tr></table></div></div>";
			    ?>
                    <div class="row">
                        <div class="col-sm-10 ">
                            <div class="btn-group btn-gr" data-toggle="buttons" style="margin-left:9%">

                                
                                <label id="Joueur" onclick="check(this.id)" class="btn btnR btn-default ">
							    <input class="cbAutre" id="btnJoueur" name="btnJoueur" type="checkbox" autocomplete="off"> <div class ="large">Joueurs</div><div class ="small">J</div>
						        </label>

                                <label id="Ent" onclick="check(this.id)" class="btn btnR btn-default ">
							    <input class="cbAutre" id="btnEnt" name="btnEnt" type="checkbox" autocomplete="off"> <div class ="large">Entraîneurs</div> <div class ="small">Ent</div>
						        </label>

                                <label id="Pers" onclick="check(this.id)" class="btn btnR btn-default ">
							    <input class="cbAutre" id="btnPers" name="btnPers" type="checkbox" autocomplete="off"> <div class ="large">Personnels-Artisans</div> <div class ="small">Pers</div>
						        </label>

                                <label id="Equi" onclick="check(this.id)" class="btn btnR btn-default ">
							    <input class="cbAutre" id="btnEqui" name="btnEqui" type="checkbox" autocomplete="off"> <div class ="large">Équipes</div> <div class ="small">Éq</div>
					        	</label>                        
                            </div>
                        </div>
                    </div>
            </div>

         <!--div qui load les données   -->
         <div class="data"></div>

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" style="width:80%;" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="info">
        <h1>Nous joindre</h1>
    </div>
    <div class="contact">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 textInfo">
                    <h3 style="font-weight: bold; color: #264d73;">Vous avez des questions ou vous <br>voulez fournir plus d'information?</h3>
                    
                     <?php
                     $stmt = $conn->prepare('Select * from nous_joindre');
		             $stmt->execute();
		             $resultat = $stmt->fetchAll();
		             foreach($resultat as $row) {
                     echo "<p class='information'>Numéro de téléphone: $row[telephone]</p>";
                     echo "<p class='information'>Twitter: $row[twitter]</p>";
                     echo "<p class='information'>Facebook: $row[facebook]</p>";
                     echo "<p class='information'>Adresse Postale: $row[adresse_postal]</p>";
                     echo "<p class='information'>Adresse courriel: $row[courriel]</p>";
                     $courriel = $row['courriel'];
                     }?>

                    <img style="width: 237px; height: 300px; margin-left: 80px;" src="Diablos_en_fusion/Site/Images/default.png" s alt=" Logo des Diablos ">
                </div>
                <div class="col-xs-6 mail ">
                    <form action="index.php" onsubmit="var x=MessageConfirmation('Êtes-vous sûr de votre choix ?');return x;">
                        <h4 class="title ">Nom*</h4>
                        <input class="message " type="text " name='nom' required><br> 
                        <h4 class="title ">Adresse courriel*</h4>
                        <input class="message " type="text " name='adresse' required><br>
                        <h4 class="title ">Objet*</h4>
                        <input class="message " type="text " name='objet' required><br>
                        <h4 class="title ">Message*</h4>
                        <textarea class="message " rows="8" cols="83 " name='message' required></textarea><br><br>
                        <input type="submit" value="Envoyer" class="btn btn-default" style="float:right; margin-bottom:10px;"></input>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

<script type="text/javascript" src="Diablos_en_fusion/Site/slick/slick.min.js"></script>
<script>

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

    $('a[href*="#"]:not([href="#mycarousel"])').click(function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });

    $('a').click(function() {
        this.blur();
    });

    var $item = $('.carousel .item');
    var $wHeight = $(window).height();
    $item.eq(0).addClass('active');
    $item.height($wHeight - 100);
    $item.addClass('full-screen');

    $('.carousel img').each(function() {
        var $src = $(this).attr('src');
        var $color = $(this).attr('data-color');
        $(this).parent().css({
            'background-image': 'url(' + $src + ')',
            'background-color': $color
        });
        $(this).remove();
    });

    /*$(window).on('resize', function() {
        $wHeight = $(window).height();
        $item.height($wHeight - 100);
    });*/

    $('.carousel').carousel({
        interval: 6000,
        pause: "false"
    });

    $(document).ready(function() {
        $('#text').keypress(function(e) {
            if (e.keyCode == 13)
                $('#btnrecherche').click();
        });
    });

    function ShowCard(id, type, pop) {
        $("#myModal").modal();
        $('.modal-body').load("Diablos_en_fusion/Site/profilPopup.php?idPopup=" + id + "&typePopup=" + type);
    }

    function slickLoad() {
        $('.slickDiaporamaProfil').slick({
            arrows: true,
            dots: true,
            accessibility: false
        });
         //$('.slickDiaporamaProfil').slick('slickGoTo',1);
         $('.slickDiaporamaProfil').slick('slickGoTo',0);

         // Ce code à été trouver sur https://github.com/kenwheeler/slick/issues/1320, Vincent Dufresne
         $('.slickDiaporamaProfil').find(".slick-slide").height("500px");
         $('.slickDiaporamaProfil').slickSetOption(null, null, true);
    }

    function ShowOtherCard(id, type) {
        ShowCard(id, type, 1);
    }


    function ShowCardModifier(id, type) {
        $("#myModal").modal();
        $('.modal-body').load("Diablos_en_fusion/Site/popupModifier.php?idPopup=" + id + "&typePopup=" + type);
    }

    function check(id) {
        if (id == "Tous") {
            if ($('.cbTous').prop('checked') == false) {
                $('.cbAutre').prop('checked', false);
                $('.cbTous').prop('checked', true);
                $('#Tous').addClass('active');
                $('#Joueur').removeClass('active');
                $('#Ent').removeClass('active');
                $('#Equi').removeClass('active');

            }
        } else {
            $('.cbTous').prop('checked', false);
            $('#Tous').removeClass('active');

            if ($('#btn' + id).prop('checked') == true) {
                $('#bttn' + id).prop('checked', false);
                $('#' + id).removeClass('active');
            } else {
                $('#btn' + id).prop('checked', true);
                $('#' + id).addClass('active');
            }

        }

    }

    function ajaxEquipeSaison(id)
    {
        var e = document.getElementsByName('nomEquipe' + id)[0];
        var equipe = e.options[e.selectedIndex].value;//id de l'equipe'
        var position = document.getElementsByName("position" + id)[0];
        position.options.length = 0;
        $.ajax({
                       type: "GET",
                       url: "Diablos_en_fusion/Site/ajaxEquipe.php",
                       data: {"Id": equipe,
                             "Saison": 'True',
                             "Position": 'True'},
                       dataType: "json",     
                       success:function(result){
                         document.getElementsByName('saison'+ id)[0].innerHTML = result.saisonValue;
                         for (vPosition in result.positionValue)
                         {
                             vPosition = result.positionValue[vPosition];
                             var textPosition = vPosition.split("+")[0];
                             var idPosition = vPosition.split("+")[1];	
                             var option = document.createElement("option");
                             option.value = idPosition;
                             option.text = textPosition;
                             position.add(option);
                             
                             
                         }
                         if(position.options.length == 0)
                         {
                             position.style.visibility = "hidden";
                         }
                         else
                         position.style.visibility = "visible";                
                       }
                });

                if(equipe == "TEMP")
                         {
                             document.getElementsByName('saison'+ id)[0].innerHTML = "";
                             position.style.visibility = "hidden";
                         }
    }

    function ajaxEquipeSexe(id)
    {
        var e = document.getElementsByName('nomEquipe' + id)[0];
        var equipe = e.options[e.selectedIndex].value;//id de l'equipe'
        var role = document.getElementsByName("role" + id)[0];
        role.options.length = 0;
        $.ajax({
                       type: "GET",
                       url: "Diablos_en_fusion/Site/ajaxEquipe.php",
                       data: {"Id": equipe,
                             "Saison": 'True',
                             "Sexe": 'True'},
                       dataType: "json",     
                       success:function(result){
                         document.getElementsByName('saison'+ id)[0].innerHTML = result.saisonValue;
                         document.getElementsByName('sexe'+ id)[0].innerHTML = result.sexeValue;

                         if(role.options.length == 0)
                         {
                             role.style.visibility = "hidden";
                         }
                         else
                         role.style.visibility = "visible";                      
                       }
                });

        if(equipe == "TEMP")
                {
                   document.getElementsByName('saison'+ id)[0].innerHTML = "";
                   role.style.visibility = "hidden";
                   document.getElementsByName('sexe'+ id)[0].innerHTML = "";
                }
                alert(equipe);
    }

	function ajouterEquipeJoueur() {
        var x = document.getElementById("joueurEquipe").rows.length;
		var table = document.getElementById('joueurEquipe');
		var row = table.insertRow(x);
		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		var cell3 = row.insertCell(2);
		var cell4 = row.insertCell(3);
		cell2.innerHTML = "<input type='number' name='numero" + x + "' min='1' max='999'></input>";
		cell4.innerHTML = "<p name='saison" + x + "'></p>";

        $( "#og1" ).clone().appendTo(cell1); //copie le combobox des équipe
        document.getElementsByName('nomEquipe1')[1].name = "nomEquipe" + x;
        document.getElementsByName('nomEquipe' + x)[0].addEventListener("change", function(){ajaxEquipeSaison(x)});        

        $( "#og2" ).clone().appendTo(cell3); //copie le combobox des positions
        document.getElementsByName('position1')[1].name = "position" + x;
        ajaxEquipeSaison(x);
		}

    function ajouterEquipeEntraineur() {
        var x = document.getElementById("entraineurEquipe").rows.length;
		var table = document.getElementById('entraineurEquipe');
		var row = table.insertRow(x);
		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		var cell3 = row.insertCell(2);
		var cell4 = row.insertCell(3);
		cell2.innerHTML = "<p name='sexe" + x + "'></p>";
		cell4.innerHTML = "<p name='saison" + x + "'></p>";

        $( "#og1" ).clone().appendTo(cell1); //copie le combobox des équipe
        document.getElementsByName('nomEquipe1')[1].name = "nomEquipe" + x;
        document.getElementsByName('nomEquipe' +x)[0].addEventListener("change", function(){ajaxEquipeSexe(x)});
		
        $( "#og2" ).clone().appendTo(cell3); //copie le combobox des équipe
        document.getElementsByName('role1')[1].name = "role" + x;
        ajaxEquipeSexe(x);
		}

    function recherche() {

        $(".carte").html("");
        var data = '?';
        var tous = 1;

        data = data + 'recherche=' + $('.recherche').val().replace(' ', '&nbsp');


        data = data + '&date1=' + $('#date1').val();
        data = data + '&date2=' + $('#date2').val();
        data = data + '&date=' + $('#annee').val();


        if ($('#btnJoueur').prop('checked') == true) {
            data = data + '&joueur=1';
            tous = 0;
        } else {
            data = data + '&joueur=0';
        }

        if ($('#btnEnt').prop('checked') == true) {
            data = data + '&entraineur=1';
            tous = 0;
        } else {
            data = data + '&entraineur=0';
        }

        if ($('#btnPers').prop('checked') == true) {
            data = data + '&personnel=1';
            tous = 0;
        } else {
            data = data + '&personnel=0';
        }

        if ($('#btnEqui').prop('checked') == true) {
            data = data + '&equipe=1';
            tous = 0;
        } else {
            data = data + '&equipe=0';
        }

        data = data + '&tous=' + tous;

        $('.data').html("");
        // $('html, body').animate({
        //     scrollTop: $(".data").offset().top
        // }, 1000)
        $('.data').load("Diablos_en_fusion/Site/Recherche.php" + data);

    }

    $(window).on("load", function() {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 400) {
                $(".Header #moved").fadeIn();
            } else {
                $(".Header #moved").fadeOut();
            }
        });
    });


    function remplirAnnee()
    {
        var currentTime = new Date();
        var date1 = (currentTime.getFullYear());
        var date2 = 1969;
        var mois = currentTime.getMonth()+1;
       if(mois >= 1 && mois < 7 )
            date1 = date1;
       else
            date1=(currentTime.getFullYear()+1);

        while (date1 > date2)
        {
            document.getElementById('annee').innerHTML += "<option>" + (date1-1) + "-" + date1 + "</option>";
            date1 = (date1-1);
        }
        

    }
	
	function anneeAuto(sender)
    {
        var currentTime = new Date();
        var currentYear = (currentTime.getFullYear() + 1);
		
		if ($("#" + sender).val().length != 0)
		{
			if (($( "#date1" ).val().length > 0) || ($( "#date2" ).val().length > 0))
			{
				if (($( "#date1" ).val().length == 0) || ($( "#date1" ).val() < 1969))
					$( "#date1" ).val(1969);
				
				if  ($( "#date1" ).val() > currentYear)
					$( "#date1" ).val(currentYear);

				
				if (($( "#date2" ).val().length == 0) || ($( "#date2" ).val() > currentYear))
					$( "#date2" ).val(currentYear);
				
				if  ($( "#date2" ).val() < 1969)
					$( "#date2" ).val(1969);
			} 
		}		
    }

						function changerTaille() // Créer par Vincent Dufresne, permet le chagement de taille entre cm et pieds/pouces
  						{
   						   if(!document.getElementById('tCm').checked)
   						       {
                                   //Variables
    						       var pieds = document.getElementById('taille');
								   var ligne = document.getElementById('ligneTaille');
								   var pouces = document.createElement('INPUT');
								   var enfant = document.getElementById('tCm');
								   var br = document.createElement('br');
								   var sautDeLigne = document.getElementById('pouces');
								   var tailleCm = document.getElementById('taille').value;
								  
                                   //Conversion
                                   var x = Math.round(tailleCm * 0.3937007874);
								   var taillePo = x % 12;
								   var taillePi = (x - taillePo) / 12;


                                   //Création des textbox dans la page
     						       pieds.setAttribute('id', 'pieds');
								   pieds.setAttribute('name', 'pieds');
								   pieds.value = taillePi;
								   pouces.setAttribute('type', 'text');
     						       pouces.setAttribute('id', 'pouces');
								   pouces.setAttribute('name', 'pouces');
								   pouces.value = taillePo;
								   br.setAttribute('id', 'sautdeligne');
     						       ligne.insertBefore(pouces, enfant);
								   ligne.insertBefore(br, enfant);
								   

  						        }
   						       else
    						      {
                                    if(!document.getElementById('tPieds').checked)
   						             {
                                       //Variables
    						           var pieds = document.getElementById('pieds');
									   var pouces = document.getElementById('pouces');
									   var sautdeligne = document.getElementById('sautdeligne');
     						           var taillePi = 0.00;
									   var taillePo = 0.00;
									   var tailleCm = 0.00;
									   var temp = 0.00;


                                       //Conversion
									   taillePo = pouces.value;
									   temp = 	parseInt(pieds.value);
									   taillePi = (taillePo * 0.0833333) + 10;
									   tailleCm = Math.round((((taillePi + temp) - 10) / 0.032808));

                                       //Création des textbox dans la page
									   pieds.setAttribute('id', 'taille');
								       pieds.setAttribute('name', 'taille');
     						           pouces.parentNode.removeChild(pouces);
									   sautdeligne.parentNode.removeChild(sautdeligne);
									   taille.value = tailleCm;
  						              }
    						      }
							}

							function changerPoids() // Créer par Vincent Dufresne, permet le changement entre Kg et Lbs
							{
                               if(!document.getElementById('pLbs').checked)
   						        {
                                  //Variables
								  var parent = 	document.getElementById('poids');   
								  var poidsLbs = document.getElementById('poids').value;
								  
                                  //Conversion
                                  var poidsKg = poidsLbs / 2.2046;
								  parent.value = Math.round(poidsKg);
                                  
								}

								else
								{
                                    if(!document.getElementById('pKg').checked)
									{ 
									   var parent = document.getElementById('poids');   
								       var poidsKg = document.getElementById('poids').value;
								       var poidsLbs = poidsKg * 2.2046;
								       parent.value = Math.round(poidsLbs);
									}
								}}
</script>
    <?php   
                if (isset($_GET['Envoie']))
                    {
                    echo "<script>window.alert('Modifications Envoyées')</script>";
                    
                    echo "<script>ShowCard(".$_GET['Envoie'].",'".$_GET['Type']."',0)</script>";
                    }

                if (isset($_GET['message']) and isset($_GET['nom']) and isset($_GET['objet']) and isset($_GET['adresse']))
                    {
                        $to      = $courriel;
                        $subject = $_GET['objet'];
                        $message = $_GET['message'];
                        $message = wordwrap($message,70);
                        $headers[] = 'To: Archives Diablos <'.$courriel.'>';
                        $headers[] = 'From: '.$_GET['nom']. '<'.$_GET['adresse'].'>';

                if (!empty($message) and !empty($subject) and !empty($_GET['nom']) and !empty($_GET['adresse']))
                     { 
                           mail($to, $subject, $message, implode("\r\n", $headers));
                           echo "<script>window.alert('Message Envoyé')</script>";
                     }
                else
                     {
                          echo "<script> document.location.href='index.php#info'</script>";
                     }
   
                     }
    ?>
</html>