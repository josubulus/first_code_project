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
                                <p> <a class="bouton_statut" href="notes.php?id_entreprise=<?php echo $_GET['id_entreprise'] ?>"> RETOURRRRR </a> </p>
                                <p> <a class="bouton_statut" href="notes.php?id_entreprise=<?php echo $_GET['id_entreprise'] ?>&amp;page=note"> NOTES </a> </p>
                              </nav>
                              <form class="saisie_entreprise" action="notes_post.php" method="POST">
                                    <p><label for="nom">Nom de l'entreprise</label> <br /> <input type="text" value= "<?php echo htmlspecialchars($info_entreprise['nom']); ?>" name="nom" id="nom"   required="required" /></p>
                                    <p><label for="tel">tel de l'entreprise</label> <br /> <input type="text" value= "<?php echo htmlspecialchars($info_entreprise['tel']); ?>" name="tel"id="tel" required="required"/></p>
                                    <p><label for="mail">mail de l'entreprise</label> <br /> <input type="text" name="mail"id="mail"   value="<?php echo htmlspecialchars($info_entreprise['mail']); ?>" required="required"/></p>
                                    <p><label for="mail">site de l'entreprise</label> <br /> <input type="text" name="site"id="site"   value="<?php echo htmlspecialchars($info_entreprise['site']); ?>" required="required"/></p>
                                    <p><label for="activite">activité</label><br /><textarea name="activite" rows="4" cols="40" id="activite" required="required" ><?php echo htmlspecialchars(trim($info_entreprise['activite'])); ?></textarea></p>
                                    <p><label for="adresse">adresse de l'entreprise</label> <br /> <textarea name="adresse" id="adresse" required="required" rows="8" cols="80"><?php echo htmlspecialchars(trim($info_entreprise['adresse'])); ?></textarea></p>
                                    <p> <input type="text" name="id_entreprise" id="hide" value="<?php echo htmlspecialchars($info_entreprise['id']); ?>"> </p>
                                    <p><input type="submit" name="valider" value="envoyer" /> </p>
                              </form>
                              <?php
                            }
                            else {?>

                  <?php
                  //affiche notes de l'entreprise
                    if (isset($_GET['page']) && $_GET['page'] == 'note') {
                      ?>
                      <nav>
                        <p> <a class="bouton_statut" href="notes.php?id_entreprise=<?php echo $_GET['id_entreprise'] ?>"> RETOURRRRR </a> </p>
                        <p> <a class="bouton_statut" href="notes.php?id_entreprise=<?php echo $_GET['id_entreprise'] ?>&amp;page=update"> MISE A JOUR INFOS </a> </p>
                      </nav>
                      <form action="notes_post.php" method="post">
                            <p> <label for="notes">Modifier / mettre a jour / écrire la Note : </label> </p>
                            <p> <textarea name="notes" rows="8" cols="80"><?php echo trim($info_entreprise['notes']); ?></textarea> </p>
                            <p> <input type="text" name="id_entreprise" id="hide" value="<?php echo htmlspecialchars($info_entreprise['id']); ?>"> </p>
                            <p> <input type="submit" name="envoyer" value="envoyer" /> </p>
                      </form>
                      <?php
                    }

/*----------------------------Info de l'entreprise : -----------------------------------------------*/


                    else {// affichage info entreprises?>

                      <p>
                        <strong> </strong>
                        <p><a class="bouton_statut" href="notes.php?suppr=1&amp;id_entreprise=<?php echo htmlspecialchars($info_entreprise['id']); ?>">SUPPRIMER ENTREPRISE</a>
                         <a class="bouton_statut" href="notes.php?id_entreprise=<?php echo $_GET['id_entreprise'] ?>&amp;page=update"> MISE A JOUR INFOS </a> </p>
                        <!--bouton de tris des entreprise par status : 1= a demarcher 3=attente réponse 4=refusé-->
                            <p><a class="bouton_statut" href="notes_post.php?statut=4&amp;id_entreprise= <?php echo htmlspecialchars($info_entreprise['id']); ?>">refus</a>
                            <a class="bouton_statut" href="notes_post.php?statut=1&amp;id_entreprise=<?php echo htmlspecialchars($info_entreprise['id']); ?>">a demarcher</a>
                            <a class="bouton_statut" href="notes_post.php?statut=3&amp;id_entreprise=<?php echo htmlspecialchars($info_entreprise['id']); ?>">attente rep</a>
                            <a class="bouton_statut" href="notes_post.php?statut=2&amp;id_entreprise=<?php echo htmlspecialchars($info_entreprise['id']); ?>">REPONSE OK IMMINANTE</a></p><br />

                        <?php if ( isset($info_entreprise['statut_mail']) && $info_entreprise['statut_mail'] == 2)
                            {
                            echo '<p> MAIL ENVOYE le : ' . $info_entreprise['date_email'] . '<a class="bouton_statut" href="notes_post.php?statut_mail=1&amp;id_entreprise=' . $info_entreprise['id'] . '"> Mail non envoyé </a> </p>';
                            }
                            else
                            {
                            echo '<p><a class="bouton_statut" href="notes_post.php?statut_mail=2&amp;id_entreprise=' . $info_entreprise['id'] . '"> contact par mail effectué</a></p>';
                            }
                        if ($info_entreprise['statut'] == 1)
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
                        }?>
                        <ul>
                          <li><em class="titre_info_entreprise">TEL</em> :  <?php echo htmlspecialchars($info_entreprise['tel']); ?></li>
                          <li><em class="titre_info_entreprise">Mail</em> :  <?php echo htmlspecialchars($info_entreprise['mail']); ?></li>
                          <li><em class="titre_info_entreprise">Adressse</em> :  <?php echo htmlspecialchars($info_entreprise['adresse']); ?></li>
                          <li><em class="titre_info_entreprise">activité</em> : <?php echo htmlspecialchars($info_entreprise['activite']); ?></li>
                        </ul>





                    </p>
                    <p>ajouté le : <?php echo htmlspecialchars($info_entreprise['date_affich']); ?></p>
                            <form action="notes_post.php" method="post">
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
                                  </select>
                            <input type="submit" name="submit" value="ok !!" />
                            </form><br />
                            <p> <a class="bouton_statut" href="notes.php?id_entreprise=<?php echo $_GET['id_entreprise'] ?>&amp;page=note"> NOTES </a> </p>
                            <p><em class="titre_info_entreprise">Notes et commentaires : </em></p><p><?php echo nl2br(htmlspecialchars($info_entreprise['notes'])); ?>

                            </p>



                      </div>



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
