<?php session_start(); ?>
<?php if (isset($_SESSION['page']) && $_SESSION['page'] == "login_ok" && $_SESSION['id_membre'] == 5)
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


    </section>
  </body>
</html>
<?php
}
else
{
  header('location:inscription.php');
}
