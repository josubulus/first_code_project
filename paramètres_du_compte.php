<?php session_start();
if (isset($_SESSION['page']) && $_SESSION['page']=='login_ok')
 {
   include('include/login_bdd.php');
       ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr" />
  <head>
    <meta charset="utf-8" />
    <title>paramètre_du_compte</title>
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <header>
        <nav>
          <?php include('include/nav.php'); ?>
        </nav>
    </header>
    <section>
      <!-- changement de mot de passe -->
<?php echo $_SESSION['post_retour']; ?>
<?php if (isset($_SESSION['post_retour']) && $_SESSION['post_retour'] == "OK")//formulaire nouveau mdp
{
  ?>
  <form action="membres_post.php" method="post">
    <p><label for="new_pass">nouveau mot de passe</label>
    <input type="password" name="new_pass" /></p>
    <p><label for="confirm_new_pass">confirmation nouveau mot de passe</label>
    <input type="password" name="confirm_new_pass" /></p>
    <input type="submit" name="submit" value="OK" />
  </form>
  <?php
}//formulaire nouveau mdp
else//formulaire ancien mdp
{
  ?>
  <form action="membres_post.php" method="post">
    <input type="password" name="old_pass" />
    <input type="submit" name="submit" value="valider" />
  </form>
  <?php
}//formulaire ancien mdp
?>


    </section>
    <footer>
      <nav>
        <?php include('include/nav.php'); ?>
      </nav>
    </footer>
  </body>
</html>

<?php
}
else
 {
  header('location:inscription.php');
}
 ?>
