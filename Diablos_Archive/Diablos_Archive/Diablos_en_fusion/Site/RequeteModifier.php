<?php
	// session_start();
	
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

    if (isset($_GET["joueur"]))
     {
        $mode = 'Joueur';
     }

    if (isset($_GET["entraineur"]))
     {
        $mode = 'Ent';
     }

    if (isset($_GET["personnel"]))
     {
        $mode = 'Personnel';
     }

     if (isset($_GET["equipe"]))
     {
        $mode = 'equipe';
     }

     $detection = false;

//---------------------------Personnes------------------------------//
//Ajoute une entrée dans la table personnes
$stmt = $conn->prepare('Select * from personnes where id_personne = ' .$_GET["personne"] );
		$stmt->execute();
		$resultat = $stmt->fetchAll();
		foreach($resultat as $row)
        {
            if (isset($_GET["prenom"]))
            {
                if($_GET["prenom"] == $row['prenom'])
                $prenom = NULL;
                else
                $prenom = $_GET["prenom"];      
            }
            else
            $prenom = NULL;

            if (isset($_GET["nom"]))
            {
                if($_GET["nom"] == $row['nom'])
                $nom = NULL;
                else
                $nom = $_GET["nom"];      
            }
            else
            $nom = NULL;

            if (isset($_GET["sexe"]))
            {
                if($_GET["sexe"] == $row['sexe'])
                $sexe = NULL;
                else
                $sexe = $_GET["sexe"];      
            }
            else
            $nom = NULL;

            if (isset($_GET["date"]))
            {
                if($_GET["date"] == $row['date_naissance'] or $_GET["date"] == '')
                $date = NULL;
                else
                $date = $_GET["date"];      
            }
            else
            $date = NULL;

            if (isset($_GET["ville"]))
            {
                if($_GET["ville"] == $row['ville'])
                $ville = NULL;
                else
                $ville = $_GET["ville"];      
            }
            else
            $ville = NULL;

            if (isset($_GET["email"]))
            {
                if($_GET["email"] == $row['courriel'])
                $email = NULL;
                else
                $email = $_GET["email"];      
            }
            else
            $email = NULL;


           if(!empty($nom) or !empty($prenom) or !empty($sexe) or !empty($date) or !empty($ville) or !empty($email))//si il y a eu des modifications
           {
                $req = $conn->prepare("INSERT INTO personnes (nom, prenom, sexe, date_naissance, ville, courriel, statut, id_parent)
                VALUES (:nom, :prenom, :sexe, :date_naissance, :ville, :courriel, :statut, :id_parent)");
                $req->execute(array(
                "nom" => $nom,
                "prenom" => $prenom,
                "sexe" => $sexe, 
                "date_naissance" => $date, 
                "ville" => $ville,
                "courriel" => $email,
                "statut" => 'Temporaire', 
                "id_parent" => $_GET["personne"]
                ));
                $detection = true;

                $maxid=999;
                $req2 = $conn->prepare('SELECT MAX(id_personne) AS `maxid` FROM `personnes`');
                $req2->execute();
                $resultat2 = $req2->fetchAll();
                foreach($resultat2 as $row2)
                {
                   $maxid = $row2['maxid']; 
                }


                
           }
        }


//-----------------------------Personnel----------------------------//

if (isset($_GET["personnel"]))
{
    $stmt = $conn->prepare('Select * from personnels where id_personnel = ' .$_GET["personnel"] );
            $stmt->execute();
            $resultat = $stmt->fetchAll();
            foreach($resultat as $row)
            {

                if (isset($_GET["role"]))
                {
                    if($_GET["role"] == $row['role'])
                    $role = NULL;
                    else
                    $role = $_GET["role"];      
                }
                else
                $role = NULL;


                if (isset($_GET["dateE"]))
                {
                    if($_GET["dateE"] == $row['dateEmbauche'] or $_GET["dateE"] == '')
                    $dateE = NULL;
                    else
                    $dateE = $_GET["dateE"];      
                }
                else
                $dateE = NULL;


                if (isset($_GET["dateF"]))
                {
                    if($_GET["dateF"] == $row['dateFin'] or $_GET["dateF"] == '')
                    $dateF = NULL;
                    else
                    $dateF = $_GET["dateF"];      
                }
                else
                $dateF = NULL;



           if(!empty($role) or !empty($dateE) or !empty($dateF))//si il y a eu des modifications
           {
                $req = $conn->prepare("INSERT INTO personnels (id_personne, role, dateEmbauche, dateFin, statut, id_parent)
                VALUES (:id_personne, :role, :dateEmbauche, :dateFin, :statut, :id_parent)");
                $req->execute(array(
                "id_personne" => $_GET["personne"],
                "role" => $role, 
                "dateEmbauche" => $dateE, 
                "dateFin" => $dateF,
                "statut" => 'Temporaire', 
                "id_parent" => $_GET["personnel"]
                ));
                
            }
           
            else if($detection == true)
            {
                $req = $conn->prepare("INSERT INTO personnels (id_personne, statut, id_parent)
                VALUES (:id_personne, :statut, :id_parent)");
                $req->execute(array(
                "id_personne" => $maxid,
                "statut" => 'Temporaire',
                "id_parent" => $_GET["personnel"]
                ));           
            }

            }


   }




//-----------------------------Joueur-------------------------------//
//Ajoute une entrée dans la table joueur
if (isset($_GET["joueur"]))
{
    $stmt = $conn->prepare('Select * from joueurs where id_joueur = ' .$_GET["joueur"] );
            $stmt->execute();
            $resultat = $stmt->fetchAll();
            foreach($resultat as $row)
            {

                if (isset($_GET["taille"]))
                {
                    if($_GET["taille"] == $row['taille'])
                    $taille = NULL;
                    else
                    $taille = $_GET["taille"];      
                }
                else
                $taille = NULL;


                if (isset($_GET["poids"]))
                {
                    if($_GET["poids"] == $row['poids'])
                    $poids = NULL;
                    else
                    $poids = $_GET["poids"];      
                }
                else
                $poids = NULL;


                if (isset($_GET["ecole"]))
                {
                    if($_GET["ecole"] == $row['ecole_prec'])
                    $ecole = NULL;
                    else
                    $ecole = $_GET["ecole"];      
                }
                else
                $ecole = NULL;

                if (isset($_GET["domaine_etude"]))
                {
                    if($_GET["domaine_etude"] == $row['domaine_etude'])
                    $domaine_etude = NULL;
                    else
                    $domaine_etude = $_GET["domaine_etude"];      
                }
                else
                $domaine_etude = NULL;

                if (isset($_GET["note"]))
                {
                    if($_GET["note"] == $row['note'])
                    $note = NULL;
                    else
                    $note = $_GET["note"];      
                }
                else
                $note = NULL;


           if(!empty($taille) or !empty($poids) or !empty($ecole) or !empty($domaine_etude) or !empty($note))//si il y a eu des modifications
           {
                $req = $conn->prepare("INSERT INTO joueurs (id_personne, taille, poids, ecole_prec, domaine_etude, note, statut, id_parent)
                VALUES (:id_personne, :taille, :poids, :ecole_prec, :domaine_etude, :note, :statut, :id_parent)");
                $req->execute(array(
                "id_personne" => $_GET["personne"],
                "taille" => $taille, 
                "poids" => $poids, 
                "ecole_prec" => $ecole,
                "domaine_etude" => $domaine_etude,
                "note" => $note,
                "statut" => 'Temporaire', 
                "id_parent" => $_GET["joueur"]
                ));
           }

            else if($detection == true)
            {
                $req = $conn->prepare("INSERT INTO joueurs (id_personne, statut, id_parent)
                VALUES (:id_personne, :statut, :id_parent)");
                $req->execute(array(
                "id_personne" => $maxid,
                "statut" => 'Temporaire',
                "id_parent" => $_GET["joueur"]
                ));          
            }
        }
}



//-----------------------------Entraineur---------------------------//
if (isset($_GET["entraineur"]))
{
    $stmt = $conn->prepare('Select * from entraineurs where id_entraineur = ' .$_GET["entraineur"] );
            $stmt->execute();
            $resultat = $stmt->fetchAll();
            foreach($resultat as $row)
            {

                if (isset($_GET["note"]))
                {
                    if($_GET["note"] == $row['note'])
                    $note = NULL;
                    else
                    $note = $_GET["note"];      
                }
                else
                $note = NULL;

           if(!empty($note))//si il y a eu des modifications
           {
                $req = $conn->prepare("INSERT INTO entraineurs (id_personne, note, statut, id_parent)
                VALUES (:id_personne, :note, :statut, :id_parent)");
                $req->execute(array(
                "id_personne" => $_GET["personne"],
                "note" => $note,
                "statut" => 'Temporaire', 
                "id_parent" => $_GET["entraineur"]
                ));
           }

           else if($detection == true)
            {
                $req = $conn->prepare("INSERT INTO entraineurs (id_personne, statut, id_parent)
                VALUES (:id_personne, :statut, :id_parent)");
                $req->execute(array(
                "id_personne" => $maxid,               
                "statut" => 'Temporaire',
                "id_parent" => $_GET["entraineur"]       
                ));        
            }
        }
}


//-----------------------------Entraineur-Equipe---------------------------//

if (isset($_GET["entraineur"]))
{
    $ctr = 0;
    $flag = false;
    while($flag == false)
    {   
        $flag2 = false;
        $ctr = $ctr+1;
        if (isset($_GET["nomEquipe".$ctr]))
        {
                $stmt = $conn->prepare("Select * from entraineur_equipe where statut = 'Actif' and id_entraineur = " .$_GET["entraineur"] );
                $stmt->execute();
                $resultat = $stmt->fetchAll();
                foreach($resultat as $row)
                {

                    if (isset($_GET["nomEquipe".$ctr]))
                    {
                        if($_GET["nomEquipe".$ctr] == $row['id_equipe'])
                        $nomEquipe = NULL;
                        else
                        {
                            $nomEquipe = $_GET["nomEquipe".$ctr];
                            //$flag2 = true; 
                        }
                            
                    }
                    else
                    $nomEquipe = NULL;
    //---------------------------------------------------------------------------------------
    //                 if (isset($_GET["sexe".$ctr]))
    //                 {
    //                     if($_GET["sexe".$ctr] == $row['sexe'] or $_GET["sexe".$ctr] == '')
    //                     $sexe = NULL;
    //                     else
    //                     {
    //                         $sexe = $_GET["sexe".$ctr];
    //                         //$flag2 = true; 
    //                     }
                            
    //                 }
    //                 else
    //                 $sexe = NULL;
    // //---------------------------------------------------------------------------------------
                    if (isset($_GET["role".$ctr]))
                    {
                        if($_GET["role".$ctr] == $row['role'])
                        $role = NULL;
                        else
                        {
                            $role = $_GET["role".$ctr];
                            //$flag2 = true; 
                        }
                            
                    }
                    else
                    $role = NULL;
    //---------------------------------------------------------------------------------------
                    // if (isset($_GET["saison".$ctr]))
                    // {
                    //     if($_GET["saison".$ctr] == $row['saison'])
                    //     $saison = NULL;
                    //     else
                    //     {
                    //         $saison = $_GET["saison".$ctr];
                    //         $flag2 = true; 
                    //     }
                            
                    // }
                    // else
                    // $saison = NULL;
    //---------------------------------------------------------------------------------------
                    if(empty($nomEquipe) and empty($role))//si l'entré existe déja'
                    {
                        $flag2 = true;
                    }
                }

                if($flag2 == false)
                {
                    if(!empty($nomEquipe) or !empty($role))//si il y a eu des modifications
                        {
                            $req = $conn->prepare("INSERT INTO entraineur_equipe (id_entraineur, id_equipe, role, statut)
                            VALUES (:id_entraineur, :id_equipe, :role, :statut)");
                            $req->execute(array(
                            "id_entraineur" => $_GET["entraineur"],
                            "id_equipe" => $nomEquipe,
                            "role" => $role,
                            "statut" => 'Temporaire'
                            ));
                        }
                    $flag2 = true;
                }
        }

        else
        $flag = true;
    }
}

//-----------------------------Joueur-Equipe---------------------------//

if (isset($_GET["joueur"]))
{
    $ctr = 0;
    $flag = false;
    while($flag == false)
    {   
        $flag2 = false;
        $ctr = $ctr+1;
        if (isset($_GET["nomEquipe".$ctr]))
        {
                $stmt = $conn->prepare("Select * from joueurs_equipes where statut = 'Actif' and id_joueur = " .$_GET["joueur"] );
                $stmt->execute();
                $resultat = $stmt->fetchAll();
                foreach($resultat as $row)
                {

                    if (isset($_GET["nomEquipe".$ctr]))
                    {
                        if($_GET["nomEquipe".$ctr] == $row['id_equipe'])
                        $nomEquipe = NULL;
                        else
                        {
                            $nomEquipe = $_GET["nomEquipe".$ctr];
                            //$flag2 = true; 
                        }
                            
                    }
                    else
                    $nomEquipe = NULL;
    //---------------------------------------------------------------------------------------
                    if (isset($_GET["numero".$ctr]))
                    {
                        if($_GET["numero".$ctr] == $row['numero'] or $_GET["numero".$ctr] == '')
                        $numero = NULL;
                        else
                        {
                            $numero = $_GET["numero".$ctr];
                            //$flag2 = true; 
                        }
                            
                    }
                    else
                    $numero = NULL;
    //---------------------------------------------------------------------------------------
                    if (isset($_GET["position".$ctr]))
                    {
                        if($_GET["position".$ctr] == $row['id_position'])
                        $position = NULL;
                        else
                        {
                            $position = $_GET["position".$ctr];
                            //$flag2 = true; 
                        }
                            
                    }
                    else
                    $position = NULL;
    //---------------------------------------------------------------------------------------
                    // if (isset($_GET["saison".$ctr]))
                    // {
                    //     if($_GET["saison".$ctr] == $row['saison'])
                    //     $saison = NULL;
                    //     else
                    //     {
                    //         $saison = $_GET["saison".$ctr];
                    //         $flag2 = true; 
                    //     }
                            
                    // }
                    // else
                    // $saison = NULL;
    //---------------------------------------------------------------------------------------
                    if(empty($nomEquipe) and empty($numero) and empty($position)) // si l'entré existe déja'
                    {
                        $flag2 = true;                    
                    }
                }


                if($flag2 == false)
                {
                    if(!empty($nomEquipe) or !empty($numero) or !empty($position))//si il y a eu des modifications
                        {
                                $req = $conn->prepare("INSERT INTO joueurs_equipes (id_joueur, id_equipe, id_position, numero, statut)
                                VALUES (:id_joueur, :id_equipe, :id_position, :numero, :statut)");
                                $req->execute(array(
                                "id_joueur" => $_GET["joueur"],
                                "id_equipe" => $nomEquipe,
                                "id_position" => $position,
                                "numero" => $numero,
                                "statut" => 'Temporaire'
                                ));

                                $nomEquipe = NULL;
                                $position = NULL;
                        }
                    $flag2 = true;                  
                }
        }

        else
        $flag = true;
    }
}

//-------------------------------------------------------------------------//
if($mode == 'equipe')
header('Location: ' . $_SERVER['HTTP_REFERER']."?Envoie=". $_GET['equipe']."&Type=$mode");
else
header('Location: ' . $_SERVER['HTTP_REFERER']."?Envoie=". $_GET['personne']."&Type=$mode");
?>