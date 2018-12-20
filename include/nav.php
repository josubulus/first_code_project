<?php session_start(); ?>
<div class="menu">
<?php if (isset($_SESSION['page']) && $_SESSION['page']=="login_ok")
{
?>
<a class="lien_menu" href="index.php">
  <div class="bouton_menu">
      ajouter une entreprise
  </div>
</a>
<a class="lien_menu" href="classement.php">
   <div class="bouton_menu">
    classement
   </div>
 </a>
 <a class="lien_menu" href="conseils.php">
   <div class="bouton_menu">
    cible & conseils recherche
   </div>

<?php
} ?>

  <a class="lien_menu" href="inscription.php">
    <div class="bouton_menu">
        log in (dev) / inscription
    </div>
  </a>


   </a>

</div>
