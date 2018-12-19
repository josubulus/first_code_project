<?php session_start();
$_SESSION['page']="inscription";//testé fonctionnel
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
      <nav>
          <?php include('include/nav.php'); ?>
          <a href="membres_post.php">test session header page </a>
      </nav>
    </header>
    <section>
      <h1>Inscription</h1>
      <h2>test form</h2>
      <p>
                                      <!--ici les tests -->
<?php echo $_SESSION['mail_retour']; ?>
<?php echo $_SESSION['mdp_retour']; ?>
<?php echo $_SESSION['pseudo_retour']; ?>


      </p>
          <form action="membres_post.php" method="post">
    <!--vérifier mdp identique dans les 2 champs-->
            <table>
              <tr>
                <td> <label for="pseudo">votre pseudo</label> </td>
                <td> <input type="text" name="pseudo" id="pseudo" /> </td>
              </tr>
              <tr>
                <td> <label for="pass">mot de passe ici</label> </td>
                <td> <input type="password" name="pass" id="pass"/> </td>
              </tr>
              <tr>
                <td> <label for="pass_confirm">confirmation mot de passe</label> </td>
                <td> <input type="password" name="pass_confirm" id="pass_confirm"> </td>
              </tr>
              <tr>
                <td> <label for="email">email</label> </td>
                <td> <input type="mail" name="mail" id="mail"> </td>
              </tr>
              <tr>
                <td> <input type="submit" name="submit" value="creer"> </td>
              </tr>
            </table>
          </form>
    </section>
  </body>
</html>
