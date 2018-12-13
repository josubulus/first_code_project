<?php
//connaction a la base de donnée
try
    {
      $bdd = new PDO('mysql:host=127.0.0.1;dbname=demarchage;charset=utf8','phpmyadmin','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch (Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }

 ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr" />
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/style.css" />
    <title>classement</title>
  </head>
  <body>
<header>

</header>
<nav>
  <?php include('include/nav.php'); ?>
</nav>
<section>

                  <?php
                  //requette : statut  : 1 =a démarcher 2 = acceptation imminante 3 =attente réponse 4 = refus
                  $req=$bdd->query('SELECT id,nom,tel,mail,adresse,activite,DATE_FORMAT(date_ajout,"%d / %m / %Y") date_affich,statut,statut_mail,DATE_FORMAT(date_mail,"%d / %m / %Y") date_email,notes FROM entreprises WHERE statut=2 ORDER BY date_ajout DESC');

                  //alors maintenant on affiche

                                      while ($entreprise=$req->fetch())
                                        {
                                          if ($entreprise['id'] > 0)
                                          {
                                              ?><h2>REPONSE IMMINENTE</h2><?php
                                              ?><div class="box_entreprises"><?php


                                              echo '<p> <strong>' . htmlspecialchars($entreprise['nom']) . ' : </strong>';
                                              if (isset($entreprise['notes']))
                                              {
                                                echo '<a class="titre_info_entreprise" href="notes.php?id_entreprise=' . htmlspecialchars($entreprise['id']) . '">|| NOTES ! || </a>';
                                              }
                                                // a copier : status mail date , mise en page entreprise et bouttons entreprise
                                                        if ( isset($entreprise['statut_mail']) && $entreprise['statut_mail'] == 2)
                                                         {
                                                           echo ' <a href="classement_post.php?statut_mail=1&amp;id_entreprise=' . htmlspecialchars($entreprise['id']) . '"> X </a>MAIL ENVOYE: ' . htmlspecialchars($entreprise['date_email']) . ' </p>';
                                                         }
                                                         else {
                                                          echo '<a class="bouton_statut" href="classement_post.php?statut_mail=2&amp;id_entreprise=' . htmlspecialchars($entreprise['id']) . '">Envoyer mail</a></p>';
                                                         }
                                              echo '
                                              <p> <em class="titre_info_entreprise"> Activité </em> : ' . htmlspecialchars($entreprise['activite']) . ' </p>
                                              <em class="titre_info_entreprise">ajouté le</em> : ' . htmlspecialchars($entreprise['date_affich']) . '</p>

                                               <!--bouton de tris des entreprise par status : 1= a demarcher 3=attente réponse 4=refusé-->
                                              <p><a class="bouton_statut" href="classement_post.php?statut=4&amp;id_entreprise=' . htmlspecialchars($entreprise['id']) . '">refus</a>
                                              <a class="bouton_statut" href="classement_post.php?statut=1&amp;id_entreprise=' . htmlspecialchars($entreprise['id']) . '">a demarcher</a>
                                              <a class="bouton_statut" href="classement_post.php?statut=3&amp;id_entreprise=' . htmlspecialchars($entreprise['id']) . '">attente rep</a>
                                              <a class="bouton_statut" href="notes.php?id_entreprise=' . htmlspecialchars($entreprise['id']) . '">GERER</a></p>

                                              ';
                                              ?></div><?php

                                          }

                                }
                           ?>





  </section>
  <!--                   cration de la fonction  cadre pour afficher les entreprise en fonction des status                   -->

<?php
function cadre($trouduc)
      {
        try
            {
              $bdd = new PDO('mysql:host=127.0.0.1;dbname=demarchage;charset=utf8','phpmyadmin','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }
            catch (Exception $e)
            {
              die('Erreur : '.$e->getMessage());
            }


                $status=$trouduc;
                $req=$bdd->prepare('SELECT id,nom,tel,mail,adresse,activite,DATE_FORMAT(date_ajout,"%d / %m / %Y") date_affich,statut,statut_mail,DATE_FORMAT(date_mail,"%d / %m / %Y") date_email,notes FROM entreprises WHERE statut=:status ORDER BY date_ajout DESC');
                $req->execute(array('status' => $status));
                //alors maintenant on affiche
                      while ($entreprise=$req->fetch())
                        {
                        echo '<div class="box_entreprises">' ;


                  echo '<p> <strong>' . htmlspecialchars($entreprise['nom']) . ' : </strong>';
                        if (isset($entreprise['notes']))
                        {
                          echo '<a class="titre_info_entreprise" href="notes.php?id_entreprise=' . htmlspecialchars($entreprise['id']) . '">|| NOTES ! || </a>';
                        }
                          // a copier : status mail date , mise en page entreprise et bouttons entreprise
                                  if ( isset($entreprise['statut_mail']) && $entreprise['statut_mail'] == 2)
                                   {
                                     echo ' <a href="classement_post.php?statut_mail=1&amp;id_entreprise=' . htmlspecialchars($entreprise['id']) . '"> X </a>MAIL ENVOYE: ' . htmlspecialchars($entreprise['date_email']) . ' </p>';
                                   }
                                   else {
                                    echo '<a class="bouton_statut" href="classement_post.php?statut_mail=2&amp;id_entreprise=' . htmlspecialchars($entreprise['id']) . '">Envoyer mail</a></p>';
                                   }
                echo '
                    <p> <em class="titre_info_entreprise"> Activité </em> : ' . htmlspecialchars($entreprise['activite']) . ' </p>
                    <em class="titre_info_entreprise">ajouté le</em> : ' . htmlspecialchars($entreprise['date_affich']) . '</p>

                         <!--bouton de tris des entreprise par status : 1= a demarcher 3=attente réponse 4=refusé-->
                  <p><a class="bouton_statut" href="classement_post.php?statut=4&amp;id_entreprise=' . htmlspecialchars($entreprise['id']) . '">refus</a>
                  <a class="bouton_statut" href="classement_post.php?statut=1&amp;id_entreprise=' . htmlspecialchars($entreprise['id']) . '">a demarcher</a>
                  <a class="bouton_statut" href="classement_post.php?statut=3&amp;id_entreprise=' . htmlspecialchars($entreprise['id']) . '">attente rep</a>
                  <a class="bouton_statut" href="notes.php?id_entreprise=' . htmlspecialchars($entreprise['id']) . '">GERER</a></p>

                    ';
                    echo '</div>';
        }
}
 ?>











                                  <!---     entreprise a démarcher --->
  <div id="box_classement">
  <section class="box_section">
    <h2>Entreprises a demarcher</h2>
              <div class="box_de_tris">

                              <?php
cadre(1);
                         ?>

           </div>
  </section>
  <section class="box_section">
    <h2>attente réponse</h2>
                                          <!---     attente reponse --->

                      <div class="box_de_tris">

                        <?php
cadre(3);
      ?>
    </div>
  </section>
  <section class="box_section">
    <h2>Refus</h2>
  <!--refus-->
  <div class="box_de_tris">

  <?php
cadre(4);
                            ?>
  </div>
  </section>
  </div><!--box classement--->
  <footer>
    <nav>
      <?php include('include/nav.php'); ?>
    </nav>
  </footer>
</body>
</html>
