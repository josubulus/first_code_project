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

    //écriture du status d'interret de l'entreprisetrès interressant 3 interressant 2  juste un taf 1
    if (isset($_POST['interret']) && !empty($_POST['interret']) && $_POST['interret'] <= 3 && $_POST['interret'] >= 1  && isset($_POST['id']) && !empty($_POST['id']))
    {
      $id_ok=intval($_POST['id']);
       $req=$bdd->prepare("UPDATE entreprises SET interret=:interret WHERE id=:id");
       $req->execute(array('interret' => $_POST['interret'],
                            'id' =>$id_ok));
    }


//écriture de la note
    if (isset($_POST['notes']) && !empty(trim($_POST['notes'])) && isset($_POST['id_entreprise']) && !empty($_POST['id_entreprise']))
     {
     $notes=$_POST['notes'];
     $id_ok=intval($_POST['id_entreprise']);
      $notes_write=$bdd->prepare("UPDATE entreprises SET notes=:notes WHERE id=:id");
      $notes_write->execute(array(
        'id'=>$id_ok,
        'notes'=>$notes));
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
              //update des donnée de l'entreprise
              //écrire les infos des entreprise dans la base de donnée
              if (isset($_POST['nom']) && isset($_POST['tel']) && isset($_POST['mail']) && isset($_POST['adresse']) && isset($_POST['activite']) && isset($_POST['id_entreprise'])
              && !empty(trim($_POST['nom'])) && !empty(trim($_POST['mail'])) && !empty(trim($_POST['adresse'])) && !empty(trim($_POST['activite'])))
                      {
                            $id_ok=intval($_POST['id_entreprise']);
                                      $req=$bdd->prepare('UPDATE entreprises SET nom=:nom,tel=:tel,mail=:mail,site=:site,adresse=:adresse,activite=:activite WHERE id=:id');
                                      $req->execute(array('nom'=>$_POST['nom'],
                                                          'tel' =>$_POST['tel'],
                                                          'mail'=>$_POST['mail'],
                                                          'site'=>$_POST['site'],
                                                          'activite'=>$_POST['activite'],
                                                          'adresse'=>$_POST['adresse'],
                                                          'id'=>$id_ok));

                      }
                      //supprimer entreprise :
                      if (isset($_GET['suppr']) && $_GET['suppr'] == 1 && isset($_GET['id_entreprise']) && !empty($_GET['id_entreprise']))
                       {
                        $id_ok_suppr=intval($_GET['id_entreprise']);
                        $req=$bdd->prepare("DELETE FROM entreprises WHERE id=:id");
                        $req->execute(array('id'=>$id_ok_suppr));
                        /*$req->blidValue(":id",$id_ok,PDO::PARAM_INT);
                        $req->execute();*/
                      }

//changement du header en fonction de l'action effectué :

if (isset($id_ok)) {
  header('location:notes.php?id_entreprise=' . $id_ok . '');
}
elseif (isset($id_ok_suppr)) {
  header('location:classement.php');
}
else {
  header('location:inscription.php');
}

 ?>
