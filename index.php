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
                <?php include('include/nav.php');?>
            </nav>
        <h1>DemarchlanD</h1> <br /><h2>Entrer un nouvelle entreprise</h2>

      </header>

      <section class="recherche">

        <?php
        include('include/login_bdd.php');

         ?>
      </section>
      <section class="box_formulaires">
        <p> !!!! Tout les champs doivent être renseigné quitte à mettre pas de num dans numéro de téléphone  !!!!</p>

        <?php

         /*include('include/entreprise_form.php');*/
          require 'class/Formulaire.php';
          $ajout=new Form($_POST);
        ?>
        <form class="saisie_entreprise" action="index_post.php" method="post">
          <?php echo $ajout->input('nom','nom de l\'entreprise');
                echo $ajout->input('tel','Tel de l\'entrprise');
                echo $ajout->input('mail','mail de l\'entreprise');
                echo $ajout->input('site','Site de l\'entreprise');
                echo $ajout->input('activite','Activitées');
                echo $ajout->textarea('adresse','adresse');
                echo $ajout->submit('creer');



          ?>

        </form>
      </section>

    </body>
  </html>



  <?php
}
else {// not log
  header('location:inscription.php');
}


 ?>
