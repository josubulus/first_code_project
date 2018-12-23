<?php
session_start();
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

          $req=$bdd->prepare('INSERT INTO entreprises(nom,tel,mail,site,adresse,activite,date_ajout,statut,statut_mail,interret,id_membre) VALUES (:nom,:tel,:mail,:site,:adresse,:activite,now(),1,1,1,:id_membre)');
          $req->execute(array('nom'=>$_POST['nom'],
                              'tel' =>$_POST['tel'],
                              'mail'=>$_POST['mail'],
                              'site'=>$_POST['site'],
                              'activite'=>$_POST['activite'],
                              'adresse'=>$_POST['adresse'],
                               'id_membre'=>$_SESSION['id_membre']));
      }





header('location:index.php');
?>
