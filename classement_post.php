<?php
session_start();
try
    {
      $bdd = new PDO('mysql:host=127.0.0.1;dbname=demarchage;charset=utf8','phpmyadmin','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
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
//écriture du status d'interret de l'entreprisetrès interressant 3 interressant 2  juste un taf 1
  if (isset($_POST['interret']) && !empty($_POST['interret']) && $_POST['interret'] <= 3 && $_POST['interret'] >= 1  && isset($_POST['id']) && !empty($_POST['id']))
  {
     $req=$bdd->prepare("UPDATE entreprises SET interret=:interret WHERE id=:id");
     $req->execute(array('interret' => $_POST['interret'],
                          'id' =>intval($_POST['id'])));
  }
//supprimer entreprise :
if (isset($_GET['suppr']) && $_GET['suppr'] == 1 && isset($_GET['id_entreprise']) && !empty($_GET['id_entreprise']))
 {
  $id_ok=intval($_GET['id_entreprise']);
  $req=$bdd->prepare("DELETE FROM entreprises WHERE id=:id");
  $req->execute(array('id'=>$id_ok));
  /*$req->blidValue(":id",$id_ok,PDO::PARAM_INT);
  $req->execute();*/
}
header('location:classement.php');
 ?>
