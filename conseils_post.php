<?php
session_start();
//connection a la base de donnée
include('include/login_bdd.php');

// suppression Conseils

  if (isset($_GET['id_suppr']) && !empty($_GET['id_suppr']))
      {
        $req=$bdd->prepare('DELETE FROM conseils WHERE id=:id_suppr');
        $req->execute(array('id_suppr'=>intval($_GET['id_suppr'])));
      }
//ajouter conseils  ajouter fonction strip espace
  if (isset($_POST['conseil']) && !empty($_POST['conseil']))
       {
         $req=$bdd->prepare('INSERT INTO conseils(date_conseil,conseil,id_membre) VALUES ( NOW(),:conseil,:id_membre )');
         $req->execute(array('conseil'=>$_POST['conseil'],'id_membre'=>$_SESSION['id_membre']));
       }
//update conseils ajouter fonction strip espace
  if (isset($_POST['update']) && !empty($_POST['update']) && isset($_POST['id_ok']) && !empty($_POST['id_ok']))
      {
        $req=$bdd->prepare('UPDATE conseils SET date_conseil=NOW(),conseil=:conseil WHERE id=:id_ok');
        $req->execute(array('conseil'=>$_POST['update'],
                            'id_ok'=>intval($_POST['id_ok'])));
      }
      /*echo '' . $_POST['update'] . ' // ' . $_POST['id_ok'] . '';*/

header('location:conseils.php');
?>
