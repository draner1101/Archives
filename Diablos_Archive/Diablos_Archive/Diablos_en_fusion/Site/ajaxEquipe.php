<?php
require_once ("Connexion_BD/Connect.php");
require_once ("Connexion_BD/Connexion.php");
require_once ("Connexion_BD/ExecRequete.php");
require_once ("Connexion_BD/Normalisation.php");

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

    $values = array();

    if (isset($_GET['Saison']))
    {
        //requete saison
        $req = $conn->prepare('Select * from equipes where id_equipe = '.$_GET['Id']);
							$req->execute();
							$resultat = $req->fetchAll();
							if($req->rowCount() > 0)
							{			
							    foreach($resultat as $row)
                                {
                                    $SaisonEquipe = $row['saison'];
                                    $Sport = $row['id_sport'];
                                    $sexeValue = $row['sexe'];
                                }
                                $values['saisonValue'] = $SaisonEquipe;
                            }

        if (isset($_GET['Position']))                                     
        {
            $arrayPosition = array();
            $req = $conn->prepare('Select * from positions where id_sport = '.$Sport.' order by position');
                                $req->execute();
                                $resultat = $req->fetchAll();
                                if($req->rowCount() > 0)
                                {			
                                    foreach($resultat as $row)
                                    {
                                        $arrayPosition[] = $row['position']."+".$row['id_position'];
                                    }
                                    $values['positionValue'] = $arrayPosition;
                                   
                                }       
        }

        if (isset($_GET['Sexe']))                                     
        {
					switch ($sexeValue) 
					{
					case 'X':
						$sexeValue = 'Mixte';
						break;
					case 'M':
						$sexeValue = 'Masculin';
						break;
					case 'F':
						$sexeValue = 'Féminin';
						break;
					} 
                    $values['sexeValue'] = $sexeValue;
        }

         echo json_encode($values);
    }


?>