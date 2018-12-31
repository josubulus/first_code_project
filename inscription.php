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
      <!--<p> <a class="bouton_statut" href="inscription.php">Connexion</a> </p>-->
      <!--<p><a class="bouton_statut" href="inscription.php?inscription=1">Inscription</a></p>-->
    </nav>
    </header>
  

  <?php
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

  </body>
</html>


<?php
}
?>
