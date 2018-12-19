<?php session_start();

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
if (isset($_SESSION['post_retour'])) {
}
    switch($_SESSION['post_retour']){
      case "mdp non conforme":
        ?><p><em>confirmation mot de passe incorrect</em></p><?php
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

?>

        <form action="membres_post.php" method="post">
  <!--vérifier mdp identique dans les 2 champs-->
          <table>
            <tr>
              <td> <label for="pseudo">votre pseudo</label> </td>
              <td> <input type="text" name="pseudo" id="pseudo"  required/> </td>
            </tr>
            <tr>
              <td> <label for="pass">mot de passe ici</label> </td>
              <td> <input type="password" name="pass" id="pass" required/> </td>
            </tr>
            <tr>
              <td> <label for="pass_confirm">confirmation mot de passe</label> </td>
              <td> <input type="password" name="pass_confirm" id="pass_confirm" required/> </td>
            </tr>
            <tr>
              <td> <label for="email">email</label> </td>
              <td> <input type="mail" name="mail" id="mail" placeholder="mail@mail.com" required/> </td>
            </tr>
            <tr>
              <td> <input type="submit" name="submit" value="creer" /> </td>
            </tr>
          </table>
        </form>
  </section>

  <?php
}//page inscription
  else {//page login
    ?>
      <section>
            <?php $_SESSION['page']="login"; ?>
            <h1>LOGIN</h1>
          <p><a href="inscription.php?inscription=1">Inscription</a></p>
          <p><a href="membres_post.php">test ret login post</a></p>


          <form action="membres_post.php" method="post">
            <table>
              <tr>
                <td> <label for="login_pseudo"></label>pseudo </td>
                <td> <input type="text" name="pseudo"id="login_pseudo" required/> </td>
              </tr>
              <tr>
                <td> <label for="login_pass"></label>mot de passe </td>
                <td> <input type="password" name="pass" id="login_pass"/> </td>
              </tr>
            </table>
          </form>
          <p><a href="logout.php">logout</a></p>
        </section>
<?php
  }//page login
   ?>

  </body>
</html>
