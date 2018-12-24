<?php
session_start();
if (isset($_SESSION['page']) && $_SESSION['page'] == 'login_ok')
{
 include('include/login_bdd.php');

    ?>
   <!DOCTYPE html>
   <html lang="fr" dir="ltr" />
     <head>
       <meta charset="utf-8" />
       <link rel="stylesheet" href="css/style.css" />
       <title>conseils</title>
     </head>


     <body>
       <header>
         <h1>Conseils et astuces sur les recherches en cours</h1>
         <nav>
           <?php include('include/nav.php'); ?>
         </nav>
       </header>
       <section><!--affichage conseils--->
         <?php
             if (isset($_GET['new']) && !empty($_GET['new']) && $_GET['new']==1)//ajouter conseil
             {
             ?>

                <p> <a class="bouton_statut" href="conseils.php">Retour</a> </p><!--ajouter conseil-->
                   <h2>Ajouter un conseil :</h2>
                   <form action="conseils_post.php" method="post">
                     <textarea name="conseil" rows="8" cols="80"></textarea>
                     <input type="submit" name="envoyer" value="envoyer" />
                   </form>
             <?php
             }
             //confiramtion de suppression récupération id affichage conseil via get
             elseif (isset($_GET['suppr']) && !empty($_GET['suppr']) && $_GET['suppr']==1 && isset($_GET['id_ok']) && !empty($_GET['id_ok']))
             {
               ?>
               <p> <a class="bouton_statut" href="conseils.php">Retour</a> </p>
               <p> <a class="bouton_statut"  href="conseils_post.php?id_suppr=<?php echo '' . intval($_GET['id_ok']) . ''; ?>">supprimer le conseil </a> </p>
               <?php
             }
             //mettre a jour le conseil : finir de sécurisé le get sur id
             elseif (isset($_GET['update']) && !empty($_GET['update']) && $_GET['update']==1 && isset($_GET['id_ok']) && !empty($_GET['id_ok']))
             {//afficher texte actuel
               $req=$bdd->prepare('SELECT id,DATE_FORMAT(date_conseil,"%d / %m / %Y"),conseil,id_membre FROM conseils WHERE id=:id_update AND id_membre=:id_membre');
               $req->execute(array('id_update'=>intval($_GET['id_ok']),
                                   'id_membre'=>$_SESSION['id_membre']));
               $conseils = $req->fetch();
               ?>
               <p> <a class="bouton_statut" href="conseils.php">Retour</a> </p>
               <form action="conseils_post.php" method="post">
                 <h2>Mettre a jour le conseil :</h2>
                 <form action="conseils_post.php" method="post">
                   <input  id="hide" type="text" name="id_ok" value="<?php echo '' . $conseils['id'] . ''; ?>">
                   <textarea name="update" rows="8" cols="80"><?php echo'' . $conseils['conseil'] . ''; ?></textarea>
                   <input type="submit" name="envoyer" value="envoyer" />
                 </form>

               </form>
               <?php
               // code...
             }
             else // sinon afficher les conseil exsistant
              {

                 ?>
                 <p> <a class="bouton_statut" href="conseils.php?new=1">Nouveau conseil</a> </p>
                     <div class="box_de_tris"><!---cadre d'affichage du conseil-->
                       <?php
                           $req=$bdd->prepare('SELECT id,DATE_FORMAT(date_conseil,"%d / %m / %Y"),conseil,id_membre FROM conseils WHERE id_membre=:id_membre ORDER BY date_conseil DESC');
                           $req->execute(array('id_membre'=>$_SESSION['id_membre']));
                           /*$conseils = $req->fetch();*/
                             while ($conseils = $req->fetch())
                             {
                                 ?>
                                 <p> <p><em>Conseils</em> :</p> <?php echo '' . nl2br(htmlspecialchars($conseils['conseil'])) . ''; ?> </p>
                                 <p> <a class="bouton_statut"  href="conseils.php?suppr=1&amp;id_ok=<?php echo '' . $conseils['id'] . ''; ?>">supprimer conseil</a>
                                  <a class="bouton_statut"  href="conseils.php?update=1&amp;id_ok=<?php echo '' . $conseils['id'] . ''; ?>">mettre a jour le conseil</a> </p>
                 <?php
                       }
                     }
                    ?>
                 </div>
                 <?php

           ?>



       </section>

     </body>
   </html>
<?php
}

else {
  header('location:inscription.php');
}
?>
