<?php 
header("Cache-Control: no-cache, must-revalidate");    
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");  
session_start();
require_once ("Diablos_en_fusion/Site/Connexion_BD/Connect.php");
require_once ("Diablos_en_fusion/Site/Connexion_BD/Connexion.php");
require_once ("Diablos_en_fusion/Site/Connexion_BD/ExecRequete.php");
require_once ("Diablos_en_fusion/Site/Connexion_BD/Normalisation.php");

// Connexion à la base
$connexion =Connexion(NOM, PASSE, BASE, SERVEUR);
mysqli_set_charset($connexion,'utf8');
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
    <script src="Diablos_en_fusion/Site/Script/slider.js"></script>
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

<body>
    <div class="Header" id="accueil">
        <div>
            <header>
                <div class="container clearfix">
                    <img src='Diablos_en_fusion/Site/Images/diablos_logo.png' onclick="location.href = '../index.php'"></img>
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
            <input type="text" name="search" placeholder="Je recherche...">
            <button class="weirdButton search">s</button>
            <a class="combobox" href="">2016-2017<i class="glyphicon glyphicon-menu-down"></i></a>
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
                <h1>Bienvenue dans l'histoire des Diablos(To change)</h1>
                <?php
				echo "<div class='row' style='margin-bottom:5px; margin-top:4px;'>";
				
				echo "<div class='col-sm-12 col-xl-6 col-md-6' style='margin-top:4px;'><table class='tblRech'><tr><td style='vertical-align:middle'><label style='font-size:medium;margin-bottom:0px;'>Rechercher </label></td>";
				$nom = isset($_POST['text']) ? $_POST['text'] : '';
				echo "<td style='width:100%'><input type='text' name='text' id='text' class='form-control rech LookupFiltre' style='width:95%' placeholder='ex: Alex' value=\"".htmlspecialchars($nom, ENT_QUOTES)."\"></input></td></tr></table></div>";
				
				echo "<div class='col-sm-12 col-xl-6 col-md-6' style='margin-top:4px;'><table class='tblRech'><tr><td style='vertical-align:middle'><label style='margin-bottom:0px;'>Entre </label></td>";
				$date1 = isset($_POST['date1']) ? $_POST['date1'] : 2010;
				echo "<td><input type='number' id='date1' class='form-control LookupFiltre' style='width:95%' name='date1' placeholder='AAAA' value='$date1'></input></td>";
				
				echo "<td style='vertical-align:middle'><label style='margin-bottom:0px;'> et </label></td>";
				$date2 = isset($_POST['date2']) ? $_POST['date2'] : 2016;
				echo "<td><input type='number' id='date2' class='form-control LookupFiltre' style='width:95%' name='date2' placeholder='AAAA' value='$date2'></input></td>";
				echo "</tr></table></div></div>";
			?>
                    <div class="row">
                        <div class="col-sm-7 ">
                            <div class="btn-group btn-gr" data-toggle="buttons">
                                <label id="Tous" onclick="check(this.id)" class="btn btnR btn-default active">
							<input class="cbTous" id="btnTous" name="btnTous" type="checkbox" autocomplete="off" checked> <div class ="large">Tous</div> <div class ="small">Tous</div>
						</label>
                                <label id="Joueur" onclick="check(this.id)" class="btn btnR btn-default ">
							<input class="cbAutre" id="btnJoueur" name="btnJoueur" type="checkbox" autocomplete="off"> <div class ="large">Joueurs</div><div class ="small">J</div>
						</label>
                                <label id="Ent" onclick="check(this.id)" class="btn btnR btn-default ">
							<input class="cbAutre" id="btnEnt" name="btnEnt" type="checkbox" autocomplete="off"> <div class ="large">Personnel</div> <div class ="small">Ent</div>
						</label>
                                <label id="Equi" onclick="check(this.id)" class="btn btnR btn-default ">
							<input class="cbAutre" id="btnEqui" name="btnEqui" type="checkbox" autocomplete="off"> <div class ="large">Équipes</div> <div class ="small">Éq</div>
						</label>
                            </div>
                        </div>

                        <div class=" col-sm-4 col-md-4 col-lg-2">
                            <button id="btnrecherche" onclick="recherche()" class="btn btnR btn-default btnrecherche">Rechercher</button>
                        </div>
                    </div>
                    <div style="height:30px"></div>
            </div>
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
        <div class="container">
            <center>
                <h1>Vous avez plus d'information?</h1>
                <h2>Voici comment nous joindre.</h2>
            </center>
        </div>
    </div>
    <div id="footer">
        <p>This will be the footer</p>
    </div>
</body>

<script type="text/javascript" src="Diablos_en_fusion/Site/slick/slick.min.js"></script>
<script>
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

    $(window).on('resize', function() {
        $wHeight = $(window).height();
        $item.height($wHeight - 100);
    });

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

    // function slickLoad() {
    //     $('.slickDiaporamaProfil').slick({
    //         arrows: false,
    //         dots: false,
    //         accessibility: false
    //     });
    // }

    function ShowOtherCard(id, type) {

        ShowCard(id, type, 1);
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

    function recherche() {

        $(".carte").html("");
        var data = '?';

        data = data + 'recherche=' + $('.rech').val().replace(' ', '&nbsp');


        data = data + '&date1=' + $('#date1').val();
        data = data + '&date2=' + $('#date2').val();

        if ($('#btnTous').prop('checked') == true) {
            data = data + '&tous=1';
        } else {
            data = data + '&tous=0';
        }

        if ($('#btnJoueur').prop('checked') == true) {
            data = data + '&joueur=1';
        } else {
            data = data + '&joueur=0';
        }

        if ($('#btnEnt').prop('checked') == true) {
            data = data + '&entraineur=1';
        } else {
            data = data + '&entraineur=0';
        }

        if ($('#btnEqui').prop('checked') == true) {
            data = data + '&equipe=1';
        } else {
            data = data + '&equipe=0';
        }

        $('.data').html("");
        $('html, body').animate({
            scrollTop: $(".data").offset().top
        }, 1000)
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
</script>

</html>