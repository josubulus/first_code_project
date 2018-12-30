<?php session_start();
if (isset($_SESSION['page']) && $_SESSION['page'] == 'login_ok') {
  header('location:classement.php');
}
else
{
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr"/>
  <head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/style.css">
    <title>inscription</title>
  </head>
  <body>
    <header>
      <h1>Prospection</h1>
    <nav>
      <p> <a class="bouton_statut" href="inscription.php">Connexion</a> </p>
      <p><a class="bouton_statut" href="inscription.php?inscription=1">Inscription</a></p>
    </nav>
    </header>
    <?php
  if(isset($_GET['inscription']) && $_GET['inscription']==1)
  {//page inscription
  ?>
  <section>
    <h1>Inscription</h1>

<?php
$_SESSION['page']="inscription";//HEADER post vers inscription
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

  <?php
}//page inscription
  else {//page login
    $_SESSION['page']="login";
    ?>
      <section>

            <h1>LOGIN</h1>
          <form action="membres_post.php" method="post">
            <table>
              <tr>
                <td> <label for="login_pseudo"></label>pseudo </td>
                <td> <input type="text" name="login_pseudo" id="login_pseudo" required/> </td>
              </tr>
              <tr>
                <td> <label for="login_pass"></label>mot de passe </td>
                <td> <input type="password" name="login_pass" id="login_pass"/> </td>
              </tr>
              <tr>
                <td> <input type="submit" name="submit" value="login"> </td>
              </tr>
            </table>
          </form>

          <?php
          if (isset($_SESSION['post_retour']) && $_SESSION['post_retour']=='pseudo erroné' OR $_SESSION['post_retour']=='mdp erroné' OR $_SESSION['post_retour'] =='connectez-vous')
          {
            switch ($_SESSION['post_retour']) {
              case 'pseudo erroné':
                ?><p><em>pseudo erroné</em></p><?php
                break;
              case 'mdp erroné':
               ?> <p> <em>mot de passe erroné</em> </p> <?php
               break;
               case 'connectez-vous':
                ?> <p> <em>connectez vous </em> </p> <?php
               break;
             }
          }

           ?>
        </section>
<?php } ?>
  </body>
</html>


<?php
}
?>
