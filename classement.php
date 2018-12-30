<?php
session_start();
//connection a la base de donnée
if (isset($_SESSION['page']) && $_SESSION['page']=='login_ok') {//tcheck login
include('include/login_bdd.php');

      // fonction d'affichage des entreprise par status : 1 2 3 4 = a demarcher, reponse imminente , attente réponse , refus
      // amélioration faire rajouter un argument pour modifier la mise en page de réponse imminente
      function cadre($status,$titre)
                                  {
                                    include('include/login_bdd.php');
                                      echo '  <div class="box_section">
                                                 <h2>' . $titre . '</h2>
                                                    <div class="box_de_tris">';
                                      //requette de selection des donnée par status de l'entreprise
                                                  $req=$bdd->prepare('SELECT id,nom,tel,mail,site,adresse,activite,DATE_FORMAT(date_ajout,"%d / %m / %Y") date_affich,statut,statut_mail,DATE_FORMAT(date_mail,"%d / %m / %Y") date_email,notes,interret,id_membre FROM entreprises WHERE statut=:status AND id_membre=:id_membre ORDER BY interret DESC');
                                                  $req->execute(array('status' => $status,
                                                  'id_membre'=>$_SESSION['id_membre']));
                                                  //alors maintenant on affiche
                                                                while ($entreprise=$req->fetch())
                                                            {
                                                            echo '<div class="box_entreprises">' ;
                        //entête de l'entreprise avec les différents interrets dans un form en:

                                                      ?>

                                          <?php
                                          // suppression de l'entreprise (vérifier la sécurité sur le get)
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


                                                     <form action="classement_post.php" method="post">
                                                       <p> <strong> <a href="notes.php?id_entreprise=<?php echo htmlspecialchars($entreprise['id']) ?>"><?php echo htmlspecialchars($entreprise['nom']) ?></a> : </strong>
                                                       <select name="interret" id="interret">
                                                     <!--affichage en php des différente option selectionné en fonction de la bdd -->
                                                         <?php if ($entreprise['interret']==3) {
                                                           echo '<option value="3" selected >fort</option>';
                                                         }
                                                         else {
                                                           echo '<option value="3">fort</option>';
                                                         }
                                                         if ($entreprise['interret']==2) {
                                                           echo '<option value="2" selected>moyen</option>';
                                                         }
                                                         else {
                                                           echo '<option value="2">moyen</option>';
                                                         }
                                                         if ($entreprise['interret']==1) {
                                                           echo '<option value="1" selected>faible</option>';
                                                         }
                                                         else {
                                                           echo '<option value="1">faible</option>';
                                                         }
                                                         ?>
                                                        <input type="submit" name="submit" value="ok !!" />
                                                         <input type="text" name="id" id="hide" value=" <?php echo $entreprise['id'] ?> ">
                                                       </select>

                                                     </form><br />
                                                     <a class="bouton_statut" href="classement.php?suppr=1&amp;id_entreprise=<?php echo htmlspecialchars($entreprise['id']) ?>">SUPPR</a>
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
                                               <a class="bouton_statut" href="classement_post.php?statut=3&amp;id_entreprise=<?php echo htmlspecialchars($entreprise['id']) ?>">attente rep</a></p>


                                               <?php
                                          }

                                                        echo '</div>';

                                    }
                                    echo '</div>';
                                  echo '</div>';
                            }//function
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
      
    </footer>
  </body>
  </html>
<?php }
else {
  header('location:inscription.php');
} ?>
