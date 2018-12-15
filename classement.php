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

    // fonction d'affichage des entreprise par status : 1 2 3 4 = a demarcher, reponse imminente , attente réponse , refus
    // amélioration faire rajouter un argument pour modifier la mise en page de réponse imminente
    function cadre($status,$titre)
                                {
                                  try
                                      {
                                        $bdd = new PDO('mysql:host=127.0.0.1;dbname=demarchage;charset=utf8','phpmyadmin','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                                      }
                                      catch (Exception $e)
                                      {
                                        die('Erreur : '.$e->getMessage());
                                      }
                                    echo '  <div class="box_section">
                                               <h2>' . $titre . '</h2>
                                                  <div class="box_de_tris">';
                                    //requette de selection des donnée par status de l'entreprise
                                                $req=$bdd->prepare('SELECT id,nom,tel,mail,adresse,activite,DATE_FORMAT(date_ajout,"%d / %m / %Y") date_affich,statut,statut_mail,DATE_FORMAT(date_mail,"%d / %m / %Y") date_email,notes,interret FROM entreprises WHERE statut=:status ORDER BY interret DESC');
                                                $req->execute(array('status' => $status));
                                                //alors maintenant on affiche
                                                              while ($entreprise=$req->fetch())
                                                          {
                                                          echo '<div class="box_entreprises">' ;
                      //entête de l'entreprise avec les différents interrets dans un form en:

                                                    ?>

                                        <?php
                                        // suppression de l'entreprise
                                        if (isset($_GET['suppr']) && $_GET['suppr'] ==1 && $_GET['id_entreprise'] == $entreprise['id']) {
                                          ?>
                                      <h2>Etes vous sur de vouloir supprimer : <?php echo $entreprise['nom'] ?> </h2>
                                          <a class="bouton_statut" href="classement_post.php?suppr=1&amp;id_entreprise=<?php echo $entreprise['id'] ?>">oui</a>
                                            <a class="bouton_statut" href="classement.php">non</a>
                                          <?php
                                        }
                                        else {//si le bouton suppr n'est pas enclancher :
                                          ?>
                                                   <!--TITRE de l'entreprise-->

                                                   <p> <strong> <?php echo htmlspecialchars($entreprise['nom']) ?> : </strong><a class="bouton_statut" href="classement.php?suppr=1&amp;id_entreprise=<?php echo htmlspecialchars($entreprise['id']) ?>">SUPPR</a>
                                                   <form action="classement_post.php" method="post">
                                                     <select name="interret" id="interret">
                                                   <!--affichage en php des différente option selectionné en fonction de la bdd -->
                                                       <?php if ($entreprise['interret']==3) {
                                                         echo '<option value="3" selected >très interressant</option>';
                                                       }
                                                       else {
                                                         echo '<option value="3">très interressant</option>';
                                                       }
                                                       if ($entreprise['interret']==2) {
                                                         echo '<option value="2" selected>interressant</option>';
                                                       }
                                                       else {
                                                         echo '<option value="2">interressant</option>';
                                                       }
                                                       if ($entreprise['interret']==1) {
                                                         echo '<option value="1" selected>juste un taf</option>';
                                                       }
                                                       else {
                                                         echo '<option value="1">juste un taf</option>';
                                                       }
                                                       ?>

                                                       <input type="text" name="id" id="hide" value=" <?php echo $entreprise['id'] ?> ">
                                                     </select>
                                                     <input type="submit" name="submit" value="ok !!" />
                                                   </form><br />
                                                     <?php

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
                                             ?>
                                             <p> <em class="titre_info_entreprise"> Activité </em> : <?php echo htmlspecialchars($entreprise['activite']) ?> </p>
                                             <em class="titre_info_entreprise">ajouté le</em> :<?php echo htmlspecialchars($entreprise['date_affich']) ?> </p>

                                                  <!--bouton de tris des entreprise par status : 1= a demarcher 3=attente réponse 4=refusé-->
                                             <p><a class="bouton_statut" href="classement_post.php?statut=4&amp;id_entreprise= <?php echo htmlspecialchars($entreprise['id']) ?> ">refus</a>
                                             <a class="bouton_statut" href="classement_post.php?statut=1&amp;id_entreprise=<?php echo htmlspecialchars($entreprise['id']) ?>">a demarcher</a>
                                             <a class="bouton_statut" href="classement_post.php?statut=3&amp;id_entreprise=<?php echo htmlspecialchars($entreprise['id']) ?>">attente rep</a>
                                             <a class="bouton_statut" href="notes.php?id_entreprise=<?php echo htmlspecialchars($entreprise['id']) ?>">GERER</a></p>


                                             <?php
                                        }

                                                      echo '</div>';

                                  }
                                  echo '</div>';
                                echo '</div>';
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
  <!--                   cration de la fonction  cadre pour afficher les entreprise en fonction des status                   -->


<!---affichage des classements----->
  <section id="box_classement">
              <?php
              cadre(2,'!! OK !!');
//status : 1 2 3 4 = a demarcher, reponse imminente , attente réponse , refus
              cadre(3,'Attente Réponse');
//status : 1 2 3 4 = a demarcher, reponse imminente , attente réponse , refus
              cadre(1,'A demarcher');
//status : 1 2 3 4 = a demarcher, reponse imminente , attente réponse , refus
              cadre(4,'refus');
              ?>
</section><!--box classement--->
  <footer>
    <nav>
      <?php include('include/nav.php'); ?>
    </nav>
  </footer>
</body>
</html>
