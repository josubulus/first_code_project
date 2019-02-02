<?php session_start(); ?>

<?php if (isset($_SESSION['page']) && $_SESSION['page'] == "login_ok"   && $_SESSION['id_membre'] == 5)
{
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr" />
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/style.css" />
    <title>admin</title>
  </head>
  <body>
    <header>
      <nav>
        <?php include('include/nav.php'); ?>
      </nav>
    </header>
    <section>
<?php include('include/login_bdd.php');?>

<h2>Membres</h2>


                      <table class="membres">
                        <tr>
                          <td>id</td>
                          <td>Pseudo</td>
                          <td>email</td>
                          <td>date d'inscription</td>
                        </tr>
                        <?php
                        if (isset($_GET['suppr']) && $_GET['suppr']==1 && $_GET['id_membre'] != 5)
                         {
                         ?>
                            <p> <em> Etes-vous sûr de vouloir supprimer <?php echo $_GET['pseudo']; ?>  </em> </p>
                            <p><a class="bouton_statut" href="admin.php"> <em>NON</em>  </a></p>
                            <p><a class="bouton_statut" href="membres_post.php?id_membre=<?php echo $_GET['id_membre']; ?>"> <em>OUI</em> </a></p>


                         <?php

                        }
                        else {// requette affichage des membres
                          $req=$bdd->query('SELECT * FROM membres ORDER BY id DESC');
                                  while ($membres=$req->fetch())
                                  {
                          ?>
                          <tr>
                            <td><?php echo $membres['id']; ?></td>
                            <td> <?php echo $membres['pseudo']; ?><a class="bouton_statut"  href="admin.php?suppr=1&amp;pseudo=<?php echo $membres['pseudo']; ?>&amp;id_membre=<?php echo $membres['id']; ?>"> X </a> </td>
                            <td><?php echo $membres['email']; ?></td>
                            <td><?php echo $membres['date_inscription']; ?></td>
                          </tr>
                      <?php }
                    }?>
                    </table>
                    <section>
                      <h1>Inscription</h1>

                  <?php
                  $_SESSION['page']="login_ok";//HEADER post vers inscription
                  // retour d'erreur sur le formulaire
                  if (isset($_SESSION['post_retour']) && $_SESSION['post_retour']=="mdp non conforme" OR $_SESSION['post_retour'] == "le pseudo existe déjà" OR $_SESSION['post_retour']=="le mail existe déjà" OR $_SESSION['post_retour']=="ça marche" )
                  {

                      switch($_SESSION['post_retour'])
                                  {
                                    case "mdp non conforme":
                                      ?><p><em>mot de passe erroné</em></p><?php
                                      break;
                                    case "le pseudo existe déjà":
                                      ?><p><em>le pseudo existe déjà</em></p><?php
                                      break;
                                    case "le mail existe déjà":
                                      ?><p><em>mail déjà existant</em></p><?php
                                      break;
                                    case "ça marche":
                                      ?><p>remplir les champs si dessous<?php
                                      break;
                                  }
                  }

                  ?>
                  <?php
                  require 'class/Formulaire.php';
                  $inscription= new Form($_POST);
                  ?>
                      <div class="box_formulaires">
                        <form action="membres_post.php" method="post">
                  <!--vérifier mdp identique dans les 2 champs-->
                              <?php
                                echo $inscription->input('pseudo','Pseudo');
                                echo $inscription->pass('pass','mot de passe');
                                echo $inscription->pass('pass_confirm','confirmation de mot de passe');
                                echo $inscription->mail('mail','@ Email');
                                echo $inscription->submit('creer');
                              ?>

                        </form>
                      </div>
                    </section>

    </section>
  </body>
</html>
<?php
}
else
{
  header('location:inscription.php');
}
