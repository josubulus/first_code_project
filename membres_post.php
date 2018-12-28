
    <?php
session_start();

include('include/login_bdd.php');

if (isset($_POST['pseudo']) && !empty(trim($_POST['pseudo'])) && isset($_POST['pass']) && !empty($_POST['pass'])
 && isset($_POST['mail']) && !empty(trim($_POST['mail'])) && isset($_POST['pass_confirm']) && !empty($_POST['pass_confirm']))
{
  if ($_POST['pass']==$_POST['pass_confirm']) {//pass pas identique ou pas a pass_confirm

      $req=$bdd->prepare('SELECT * FROM membres WHERE pseudo=:pseudo');
      $req->execute(array('pseudo'=>$_POST['pseudo']));
      $pseudo_deja_present=$req->fetch();
      if (isset($pseudo_deja_present['pseudo']) && !empty($pseudo_deja_present))//vérification de la présence mdp et pseudo dans la base
          {
            $_SESSION['post_retour']="le pseudo existe déjà";
          }
          else {// vérification pseudo utilisé
                  $req=$bdd->prepare('SELECT * FROM membres WHERE email=:email');
                  $req->execute(array('email'=>$_POST['mail']));
                  $mail_deja_present=$req->fetch();
                  if (isset($mail_deja_present['pseudo']) && !empty($mail_deja_present)) {//mail déjà utilisé
                    $_SESSION['post_retour']="le mail existe déjà";
                  }
                  else {  //requette écriture nouveau membre
                    $_SESSION['post_retour']='connectez-vous';
                    $_SESSION['page']='login';
                    //$_SESSION['test_post']=$_POST['mail'];
                            // H pass
                               $pass_hash=password_hash($_POST['pass'],PASSWORD_DEFAULT);
                                    //requette écriture nouveau membre
                                    $req=$bdd->prepare('INSERT INTO membres(pseudo,pass,email,date_inscription)VALUES(:pseudo,:pass,:email,now())');
                                    $req->execute(array('pseudo'=>$_POST['pseudo'],
                                                  'pass'=>$pass_hash,
                                                  'email'=>$_POST['mail']));
                  }  //requette écriture nouveau membre
          }// vérification pseudo utilisé
}//pass pas identique ou pas a pass_confirm
  else {//si mdp pas identique alors :
    $_SESSION['post_retour']="mdp non conforme";
  }

}//vérification form post complet


//login :
if (isset($_POST['login_pseudo']) && isset($_POST['login_pass'])) //tchek variables post
{
      $req=$bdd->prepare('SELECT * FROM membres WHERE pseudo=:pseudo');
      $req->execute(array('pseudo'=>$_POST['login_pseudo']));
      $login=$req->fetch();


  if ($login['pseudo'] == $_POST['login_pseudo']){//tchek pseudo //

          if (password_verify($_POST['login_pass'],$login['pass'])) {//tchek mdp
            $_SESSION['page']="login_ok";
            $_SESSION['id_membre']=$login['id'];
            $_SESSION['pseudo_membre']=$login['pseudo'];

          }//tchek mdp
          else {
            $_SESSION['post_retour']="mdp erroné";
          }

  }//tchek pseudo
  else {
    $_SESSION['post_retour']="pseudo erroné";
  }
}//tchek variables post

//---------supression membre-------
if (isset($_GET['id_membre']) && !empty($_GET['id_membre']) && $_GET['id_membre'] != 5) {
        //suppr membre :
          $req=$bdd->prepare('DELETE FROM membres WHERE id=:id_membre');
          $req->execute(array('id_membre'=>$_GET['id_membre']));
          $req_entreprise=$bdd->prepare('DELETE FROM entreprises WHERE id_membre=:id_membre');
          $req_entreprise->execute(array('id_membre'=>$_GET['id_membre']));


}

//gestion du compte :
    //mise a jour du mdp :
    //vérification ancien mdp
    if (isset($_POST['old_pass']) OR $_POST['new_pass']) {
      if (isset($_POST['old_pass']) && !empty($_POST['old_pass']))
            {
              $req=$bdd->prepare('SELECT pass FROM membres WHERE id=:id_membre');//requête aller chercher mfb bdd
              $req->execute(array('id_membre' => $_SESSION['id_membre']));
              $passok=$req->fetch();
                if (password_verify($_POST['old_pass'],$passok['pass']))
                {
                  $_SESSION['post_retour']= "OK";
                }

                else {
                $_SESSION['post_retour']='mdp erroné';
                }
            }
            else if (isset($_POST['new_pass']) && isset($_POST['confirm_new_pass']) && $_POST['new_pass'] == $_POST['confirm_new_pass'])
             {
               $pass_hash=password_hash($_POST['new_pass'],PASSWORD_DEFAULT);
                    //requette update nouveau pass
                    $req=$bdd->prepare('UPDATE membres SET pass=:pass WHERE id=:id_membre');
                    $req->execute(array('id_membre'=>$_SESSION['id_membre'],
                                        'pass'=>$pass_hash));
                $_SESSION['post_retour']= "changement effectué";


              /*$_SESSION['post_retour']= "CCACCACFCHHHDDTYDTJYJDTYDTJYDTJYDTJYF";*/
            }
            else {
            $_SESSION['post_retour']='mdp erroné';
            }

    }//variable présentes

    //changement du pseudo
    if (isset($_POST['new_pseudo']) && !empty($_POST['new_pseudo']))
    {
      $req=$bdd->prepare('SELECT pseudo FROM membres WHERE pseudo=:pseudo_membre');
      $req->execute(array('pseudo_membre'=>$_POST['new_pseudo']));
      $membre=$req->fetch();
      if ( $_POST['new_pseudo'] !== $membre['pseudo'])//vérification pseudo déjà existant
      {
        $req=$bdd->prepare('UPDATE membres SET pseudo=:new_pseudo WHERE id=:id_membre');
        $req->execute(array('new_pseudo'=>$_POST['new_pseudo'],
                            'id_membre' =>$_SESSION['id_membre']));
      }//vérification pseudo déjà existant
      else
      {
       $_SESSION['post_retour']="pseudo déjà utilisé";
      }


    }




//header en fonction de la page qui envoit le formulaire tester et fonctionnnel
if (isset($_SESSION['page']) && $_SESSION['page']=="inscription") {
  header('location:inscription.php?inscription=1');
}
if (isset($_SESSION['page']) && $_SESSION['page']=="login") {
  header('location:inscription.php');
}
      if (isset($_POST['old_pass']) OR isset($_POST['new_pass']) OR isset($_POST['new_pseudo'])) {
        header('location:paramètres_du_compte.php');
      }
            else if (isset($_SESSION['page']) && $_SESSION['page']=="login_ok" )
            {
              header('location:classement.php');
            }
if (isset($_GET['id_membre'])) {
  header('location:admin.php');
}

     ?>
