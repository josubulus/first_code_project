<?php session_start();
if (isset($_SESSION['page']) && $_SESSION['page']=='login_ok')
 {
   include('include/login_bdd.php');
   $req=$bdd->prepare('SELECT * FROM membres WHERE id=:id_membre');
   $req->execute(array('id_membre'=>$_SESSION['id_membre']));
   $membre=$req->fetch();
   $_SESSION['pseudo_membre']=$membre['pseudo'];
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
    <section class="box_formulaires"><!-- changer de mot de passe  -->
      <!-- changement de mot de passe -->
<?php //echo $_SESSION['post_retour'];
if (isset($_SESSION['post_retour']) && $_SESSION['post_retour'] != "OK") {
  switch ($_SESSION['post_retour']) {
    case 'mdp caca':
      ?> <p> <em>mot de passe erroné</em> </p> <?php
      break;
    case'changement effectué':
    ?> <p> <em>mot de passe changé</em> </p> <?php
      break;
    case 'pseudo déjà utilisé':
    ?> <p> <em>pseudo déjà utilisé</em> </p> <?php
      break;
    default:
      ?>retour formulaire<?php
      break;
  }
}

?>
<?php if (isset($_SESSION['post_retour']) && $_SESSION['post_retour'] == "OK")//formulaire nouveau mdp
{
  ?>
  <form class="saisie_entreprise" action="membres_post.php" method="post">
    <table>
      <tr>
        <td class="input_saisie_entreprise" ><label for="new_pass">nouveau mot de passe: </label></td>
      </tr>
      <tr>
        <td><input type="password" name="new_pass" /></td>
      </tr>
      <tr>
        <td class="input_saisie_entreprise" ><label for="confirm_new_pass">confirmation nouveau mot de passe: </label></td>
      </tr>
      <tr>
        <td><input type="password" name="confirm_new_pass" /></td>
      </tr>
      <tr>
        <td class="input_saisie_entreprise" ><input type="submit" name="submit" value="OK" /></td>
      </tr>
    </table>
  </form>
  <?php
}//formulaire nouveau mdp
else//formulaire ancien mdp
{
  ?>
  <form class="saisie_entreprise" action="membres_post.php" method="post">
    <table>
      <tr>
        <td class="ligne_tableau_entreprise" ><label for="old_pass">changer mot de passe</label></td>
      </tr>
      <tr>
        <td><input type="password" name="old_pass" id="old_pass" placeholder="ancien mot de passe"/></td>
      </tr>
      <tr>
        <td><input type="submit" name="submit" value="valider" /></td>
      </tr>
    </table>
  </form>
  <?php
}//formulaire ancien mdp
?>


    </section>
    <section class="box_formulaires"><!--     changer de pseudo    -->
      <form class="saisie_entreprise" action="membres_post.php" method="post">
        <table>
          <tr>
            <td>pseudo actuel : </td><td><?php echo $membre['pseudo']; ?></td>
          </tr>
          <tr>
            <td><label for="new_pseudo">changer pseudo</label></td>
          </tr>
          <tr>
            <td><input type="text" name="new_pseudo" id="new_pseudo" placeholder="nouveau pseudo" /></td>
          </tr>
          <tr>
            <td><input type="submit" name="submit" value="valider" /></td>
          </tr>
        </table>
      </form>

    </section>
    <section><!--changer l'adresse email-->

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
