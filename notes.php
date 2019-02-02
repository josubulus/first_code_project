<?php session_start();
if (isset($_SESSION['page']) && $_SESSION['page'] == 'login_ok')// vérifie que l'utilisateur est connecté
{
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr" />
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/style.css" />
    <title>notes</title>
  </head>
  <body>
                  <?php include('include/login_bdd.php'); ?>
    <header>
      <nav>
        <?php include('include/nav.php'); ?>
      </nav>
<?php
//récupération des donné de l'entreprise
if (isset($_GET['id_entreprise']) && !empty($_GET['id_entreprise']))
{
            $id_entreprise=intval($_GET['id_entreprise']);
          $req=$bdd->prepare('SELECT id,nom,tel,mail,site,adresse,activite,DATE_FORMAT(date_ajout,"%d / %m / %Y") date_affich,statut,statut_mail,DATE_FORMAT(date_mail,"%d / %m / %Y") date_email,notes,interret FROM entreprises WHERE id=:id_entreprise');
          $req->execute(array('id_entreprise'=>$id_entreprise));
          $info_entreprise=$req->fetch();
        //suppr entreprise
 ?>


      <h1><a href="<?php echo htmlspecialchars($info_entreprise['site']); ?>"><?php echo htmlspecialchars($info_entreprise['nom']); ?></a> </h1>
    </header>

    <section>
                    <?php

if (isset($_GET['suppr']) && $_GET['suppr'] ==1 && $_GET['id_entreprise'] == $info_entreprise['id']) {
              ?>
            <h2>Etes vous sur de vouloir supprimer : <?php echo $info_entreprise['nom'] ?> </h2>
              <a class="bouton_statut" href="notes_post.php?suppr=1&amp;id_entreprise=<?php echo $info_entreprise['id'] ?>">oui</a>
                <a class="bouton_statut" href="notes.php?id_entreprise= <?php echo $_GET['id_entreprise'] ?> ">non</a>
              <?php
            }
else {
            //affichage info entreprise
                ?><div class="box_entreprises"><?php

                          //affiche update des données de l'entreprise

                            if (isset($_GET['page']) && $_GET['page'] == 'update') {
                              ?>

                                        <h2>Mise a jours des données de l'entreprise</h2>
                                            <p> <em>Il faut remettre toute les données dans ce formulaire ! </em> </p>
                              <nav>
                                <p> <a class="bouton_modif" href="notes.php?id_entreprise=<?php echo $_GET['id_entreprise'] ?>"> RETOURRRRR </a> </p>
                                <p> <a class="bouton_modif" href="notes.php?id_entreprise=<?php echo $_GET['id_entreprise'] ?>&amp;page=note"> NOTES </a> </p>
                              </nav>
                              <form class="saisie_entreprise" action="notes_post.php" method="POST">
                                    <?php
                                      require 'class/Formulaire.php';
                                      $ajour = new Form($info_entreprise);
                                      echo $ajour->input('nom','Nom De l Entreprise');
                                      echo $ajour->input('tel','TEL');
                                      echo $ajour->input('mail','@mail');
                                      echo $ajour->input('site','site de l\'entreprise');
                                      echo $ajour->input('activite','Activite');
                                      echo $ajour->textarea('adresse','Adresse');
                                      echo $ajour->submit('envoyer');?>
                                     <p> <input type="text" name="id_entreprise" id="hide" value="<?php echo htmlspecialchars($info_entreprise['id']); ?>"> </p>

                              </form>
                              <?php
                            }
                            else {?>

                  <?php
                  //affiche notes de l'entreprise
                    if (isset($_GET['page']) && $_GET['page'] == 'note') {
                      ?>
                      <nav>
                        <p> <a class="bouton_modif" href="notes.php?id_entreprise=<?php echo $_GET['id_entreprise'] ?>"> RETOURRRRR </a> </p>
                        <p> <a class="bouton_modif" href="notes.php?id_entreprise=<?php echo $_GET['id_entreprise'] ?>&amp;page=update"> MISE A JOUR INFOS </a> </p>
                      </nav>
                      <form action="notes_post.php" method="post">
                            <?php
                              require 'class/Formulaire.php';
                              $note = new Form($info_entreprise);
                             echo $note->textarea('notes','NOTES : ');
                             echo $note->submit('sauvegarder');?>
                            <p> <input type="text" name="id_entreprise" id="hide" value="<?php echo htmlspecialchars($info_entreprise['id']); ?>"> </p>
                      </form>
                      <?php
                    }

/*----------------------------Info de l'entreprise : -----------------------------------------------*/


                    else {// affichage info entreprises?>

                      <section class="bloc_entreprise_et_notes">

                        <div>
                        <h3>Niveau d'interret : </h3>  <form action="notes_post.php" method="post">
                                <select name="interret" id="interret">
                                <!--affichage en php des différente option selectionné en fonction de la bdd -->
                                <?php if ($info_entreprise['interret']==3) {
                                echo '<option value="3" selected >FORT</option>';
                                }
                                else {
                                echo '<option value="3">FORT</option>';
                                }
                                if ($info_entreprise['interret']==2) {
                                echo '<option value="2" selected>Moyen</option>';
                                }
                                else {
                                echo '<option value="2">Moyen</option>';
                                }
                                if ($info_entreprise['interret']==1) {
                                echo '<option value="1" selected>Faible</option>';
                                }
                                else {
                                echo '<option value="1">Faible</option>';
                                }
                                ?>
                                <input type="text" name="id" id="hide" value=" <?php echo $info_entreprise['id'] ?> ">
                                <input type="submit" name="submit" value="ok !!" />
                                </select>
                              </p>
                                    </form><!--form interret entreprises-->
                          <p>
                            <ul class="liste_modif_entreprise">
                              <li><a class="bouton_modif" href="notes.php?suppr=1&amp;id_entreprise=<?php echo htmlspecialchars($info_entreprise['id']); ?>">SUPPRIMER ENTREPRISE</a></li>
                              <li><a class="bouton_modif" href="notes.php?id_entreprise=<?php echo $_GET['id_entreprise'] ?>&amp;page=update"> MISE A JOUR INFOS </a></li>
        <?php if ($info_entreprise['statut'] == 1)
        {
        echo '<p class="titre_info_entreprise">Statut actuel : <em>A démarcher</em> </p>';
        }
        elseif ($info_entreprise['statut'] == 3)
        {
        echo '<p class="titre_info_entreprise">Statut actuel : <em>Attente réponse</em> </p>';
        }
        elseif ($info_entreprise['statut'] == 4)
        {
        echo '<p class="titre_info_entreprise">Statut actuel : <em>Refusé</em> </p>';
        }
        elseif ($info_entreprise['statut'] == 2)
        {
        echo '<p class="titre_info_entreprise">Statut actuel : <em id="statut_reponse_imminente">REPONSE IMMINANTE</em> </p>';
        } ?>
        <?php if ( isset($info_entreprise['statut_mail']) && $info_entreprise['statut_mail'] == 2)
            {
            echo '<p> MAIL ENVOYE le : ' . $info_entreprise['date_email'] . '<br /><a class="bouton_statut" href="notes_post.php?statut_mail=1&amp;id_entreprise=' . $info_entreprise['id'] . '"> Mail non envoyé </a> </p>';
            }
            else
            {
            echo '<p><a class="bouton_modif" href="notes_post.php?statut_mail=2&amp;id_entreprise=' . $info_entreprise['id'] . '"> contact par mail effectué</a></p>';
            } ?>
                                    <ul><!--bouton de tris des entreprise par status : 1= a demarcher 3=attente réponse 4=refusé-->
                                      <li> <h3> Status de l'entreprise :  </h3> </li>
                                      <li><a class="bouton_modif" href="notes_post.php?statut=4&amp;id_entreprise= <?php echo htmlspecialchars($info_entreprise['id']); ?>">refus</a></li>
                                      <li><a class="bouton_modif" href="notes_post.php?statut=1&amp;id_entreprise=<?php echo htmlspecialchars($info_entreprise['id']); ?>">a demarcher</a></li>
                                      <li><a class="bouton_modif" href="notes_post.php?statut=3&amp;id_entreprise=<?php echo htmlspecialchars($info_entreprise['id']); ?>">attente rep</a></li>
                                      <li><a class="bouton_modif" href="notes_post.php?statut=2&amp;id_entreprise=<?php echo htmlspecialchars($info_entreprise['id']); ?>">REPONSE OK</a></li>
                                    </ul>
                            </ul>
                            <ul>
                              <li><p>ajouté le : <?php echo htmlspecialchars($info_entreprise['date_affich']); ?></p></li>
                              <li><em class="titre_info_entreprise">TEL</em> :  <?php echo htmlspecialchars($info_entreprise['tel']); ?></li>
                              <li><em class="titre_info_entreprise">Mail</em> :  <?php echo htmlspecialchars($info_entreprise['mail']); ?></li>
                              <li><em class="titre_info_entreprise">Adressse</em> :  <?php echo htmlspecialchars($info_entreprise['adresse']); ?></li>
                              <li><em class="titre_info_entreprise">activité</em> : <?php echo htmlspecialchars($info_entreprise['activite']); ?></li>
                            </ul>

                        </div><!--bloc entreprise-->
                        <div>
                          <p> <a class="bouton_modif" href="notes.php?id_entreprise=<?php echo $_GET['id_entreprise'] ?>&amp;page=note"> NOTES </a> </p>
                          <p><em class="titre_info_entreprise">Notes et commentaires : </em></p><p><?php echo nl2br(htmlspecialchars($info_entreprise['notes'])); ?></p>
                        </div><!-- bloc notes -->
                      </section>
                    </div><!--class="box_entreprises"-->
                    <?php }//si get != de note?>
              <?php }//si get != de update ?>
        <?php } // affiche les infos de l'entreprise ?>
<?php }//vérifie la présence de l'id de l'entreprise dans le get  ?>
    </section>
  </body>
</html>
<?php

// vérifie que l'utilisateur est connecté
}
else {
  header('location:inscription.php');
}

?>
