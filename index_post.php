<?php
try
    {
      $bdd = new PDO('mysql:host=127.0.0.1;dbname=demarchage;charset=utf8', 'phpmyadmin','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch (Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }

//vérification doublon . (a faire)

//écrire les infos des entreprise dans la base de donnée
if (isset($_POST['nom']) && isset($_POST['tel']) && isset($_POST['mail']) && isset($_POST['adresse']) && isset($_POST['activite'])
&& !empty(trim($_POST['nom'])) && !empty(trim($_POST['tel'])) && !empty(trim($_POST['mail'])) && !empty(trim($_POST['adresse'])) && !empty(trim($_POST['activite'])))
        {

          $req=$bdd->prepare('INSERT INTO entreprises(nom,tel,mail,adresse,activite,date_ajout,statut,statut_mail) VALUES (:nom,:tel,:mail,:adresse,:activite,now(),1,1)');
          $req->execute(array('nom'=>$_POST['nom'],
                              'tel' =>$_POST['tel'],
                              'mail'=>$_POST['mail'],
                              'activite'=>$_POST['activite'],
                              'adresse'=>$_POST['adresse']));
      }





header('location:index.php');
?>
