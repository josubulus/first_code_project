<?php
session_start();
if(isset($_SESSION['page']) && $_SESSION['page']=="login_ok")//si login ok
{
  ?>
  <!DOCTYPE html>
  <html lang="fr" dir="ltr" />
    <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" href="css/style.css" />
      <title>demarchage</title>
    </head>
    <body>
      <header>
            <nav>
                <?php include('include/nav.php'); ?>
            </nav>
        <h1>DemarchlanD</h1> <br /><h2>Entrer un nouvelle entreprise</h2>

      </header>

      <section class="recherche">
        <h2>Vérification si l'entreprise existe déjà</h2>
        <form class="recherche_get" action="index.php" method="get">
          <p> <input type="text" name="recherche" autofocus> </p>
      <p> <input type="submit" name="recherche_ok" value="Envoyer" /> </p>
        </form>
        <?php
        try
            {
              $bdd = new PDO('mysql:host=127.0.0.1;dbname=demarchage;charset=utf8', 'phpmyadmin','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }
            catch (Exception $e)
            {
              die('Erreur : '.$e->getMessage());
            }

        if(isset($_GET['recherche']) && !empty(trim($_GET['recherche'])))
        {
          $req=$bdd->prepare('SELECT id,nom,tel,mail,adresse,activite,DATE_FORMAT(date_ajout,"%d / %m / %Y") date_affich,statut,statut_mail,DATE_FORMAT(date_mail,"%d / %m / %Y") date_email,notes,interret,id_membre FROM entreprises WHERE nom=:recherche AND id_membre=:id_membre');
          $req->execute(array('recherche'=>$_GET['recherche'],
                              'id_membre'=>$_SESSION['id_membre']));
          $entreprise_deja_presente=$req->fetch();
              if ($entreprise_deja_presente['nom'] == $_GET['recherche'])
               {
                echo '<p class="titre_info_entreprise" > l\'entreprise :' . htmlspecialchars($entreprise_deja_presente['nom']) . ' existe déjà dans la base </p>';
              }
              else
              {
                echo '  <p class="titre_info_entreprise" >l\'entreprise n\'existe pas dans la base</p>';
              }
        }


         ?>
      </section>
      <section>
        <p> !!!! Tout les champs doivent être renseigné quitte à mettre pas de num dans numéro de téléphone  !!!!</p>

        <?php include('include/entreprise_form.php'); ?>
      </section>

    </body>
  </html>



  <?php
}
else {// not log
  header('location:inscription.php');
}


 ?>
