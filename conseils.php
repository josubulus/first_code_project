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
    <title>conseils</title>
  </head>


  <body>
    <header>
      <h1>Conseils et astuces sur les recherches en cours</h1>
    </header>
    <section><!--affichage conseils--->

    </section>
    <section> <!---rajouté un conseil---->

    </section>
  </body>
</html>
