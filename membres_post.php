
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



    // hachage mdp
    // check pseudo déjà utiliser
    // chek mdp déjà utilisé
    //set cookie ???
    // check mail déjà utilisé ?
    // mail de confirmation pour activer profil ce servir des groupes status membre ok


if (isset($_POST['pseudo']) && !empty(trim($_POST['pseudo'])) && isset($_POST['pass']) && !empty($_POST['pass'])
 && isset($_POST['mail']) && !empty(trim($_POST['mail'])) && isset($_POST['pass_confirm']) && !empty($_POST['pass_confirm']))
{
  if ($_POST['pass']==$_POST['pass_confirm']) {//pass pas identique ou pas a pass_confirm
            unset ($_SESSION['mdp_retour']);
            $req=$bdd->prepare('SELECT * FROM membres WHERE pseudo=:pseudo');
            $req->execute(array('pseudo'=>$_POST['pseudo']));
            $pseudo_deja_present=$req->fetch();
            if (isset($pseudo_deja_present['pseudo']) && !empty($pseudo_deja_present))//vérification de la présence mdp et pseudo dans la base
            {
              $_SESSION['pseudo_retour']="le pseudo existe déjà";
            }
            else {
                    unset ($_SESSION['pseudo_retour']);
                    $req=$bdd->prepare('SELECT * FROM membres WHERE email=:email');
                    $req->execute(array('email'=>$_POST['mail']));
                    $mail_deja_present=$req->fetch();
                    if (isset($mail_deja_present['pseudo']) && !empty($mail_deja_present)) {//mail déjà utilisé
                      $_SESSION['mail_retour']="le mail existe déjà";
                    }
                    else {  //requette écriture nouveau membre
                      $_SESSION['mail_retour']='ça marche';
                      //$_SESSION['test_post']=$_POST['mail'];
                              // H pass
                                 /*$pass_hash=password_hash($_POST['pass'],PASSWORD_DEFAULT);
                                      //requette écriture nouveau membre
                                      $req=$bdd->prepare('INSERT INTO membres(pseudo,pass,email,date_inscription)VALUES(:pseudo,:pass,:email,now())');
                                      $req->execute(array('pseudo'=>$_POST['pseudo'],
                                                    'pass'=>$pass_hash,
                                                    'email'=>$_POST['mail']));*/
                    }

            }

  }//pass pas identique ou pas a pass_confirm
  else {//si mdp pas identique alors :
    $_SESSION['mdp_retour']="mdp non conforme";
  }

}//vérification form post complet


//header en fonction de la page qui envoit le formulaire tester et fonctionnnel
if (isset($_SESSION['page']) && $_SESSION['page']=="inscription") {
  header('location:inscription.php');
}


     ?>
