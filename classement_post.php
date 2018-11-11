<?php
try
    {
      $bdd = new PDO('mysql:host=localhost;dbname=demarchage;charset=utf8', 'phpmyadmin','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch (Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }
// changement de statut des entreprises
//statut 1 = a_demarcher 3 en attente de réponse 4 refus
        if (isset($_GET['statut']) && isset($_GET['id_entreprise']) && !empty($_GET['id_entreprise']))
         {
         $statut=$_GET['statut'];
         $id_ok=intval($_GET['id_entreprise']);
          $statut_write=$bdd->prepare("UPDATE entreprises SET statut=:statut WHERE id=:id");
          $statut_write->execute(array(
            'id'=>$id_ok,
            'statut'=>$statut
          ));
//ecriture du statut mail envoyé 1 non 2 oui
        }
        if (isset($_GET['statut_mail']) && isset($_GET['id_entreprise']) && !empty($_GET['id_entreprise']))
         {
         $statut_mail=intval($_GET['statut_mail']);
         $id_ok=intval($_GET['id_entreprise']);
          $statut_write=$bdd->prepare("UPDATE entreprises SET statut_mail=:statut_mail, date_mail=now() WHERE id=:id");
          $statut_write->execute(array(
            'id'=>$id_ok,
            'statut_mail'=>$statut_mail
          ));

        }

header('location:classement.php');
 ?>
