
<p>Profil de : <?php echo $_SESSION['pseudo_membre']; ?></p>
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
    cible & conseils
   </div>
 </a>
 <a class="lien_menu" href="paramètres_du_compte.php">
   <div class="bouton_menu">
    mon compte
   </div>
 </a>
 <a class="lien_menu" href="logout.php">
   <div class="bouton_menu">
    logout
   </div>
 </a>
 <?php if (isset($_SESSION['id_membre']) && $_SESSION['id_membre'] == 4 ) {
   ?>
   <a class="lien_menu" href="admin.php">
     <div class="bouton_menu">
      admin
     </div>
   </a>
   <?php
 } ?>

<?php
}
else {
  ?>
  <a class="lien_menu" href="inscription.php">
    <div class="bouton_menu">
        log in (dev) / inscription
    </div>
  </a>
  <?php
} ?>

</div>
