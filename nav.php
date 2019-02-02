

<div class="menu">
<?php if (isset($_SESSION['page']) && $_SESSION['page']=="login_ok")
{
?>
<div>
  <a class="lien_menu" href="index.php">
        ajouter une entreprise
  </a>
</div>
<div >
  <a class="lien_menu" href="classement.php">
      classement
   </a>
</div>
 <div>
   <a class="lien_menu" href="conseils.php">
      cible & conseils
   </a>
 </div>
 <div >
   <a class="lien_menu" href="paramètres_du_compte.php">
       <em class ="pseudo_menu"><?php echo htmlspecialchars($_SESSION['pseudo_membre']); ?></em>
   </a>
 </div>
 <div>
   <a class="lien_menu" href="logout.php">
      logout
   </a>
 </div>
 <?php if (isset($_SESSION['id_membre']) && $_SESSION['id_membre'] == 5 ) {
   ?>
   <div>
     <a class="lien_menu" href="admin.php">
        admin
     </a>
   </div>
   <?php
 } ?>

<?php
}
else {
  ?>
<div>
  <a class="lien_menu" href="inscription.php">

        log in (dev) / inscription
  </a>
</div>
  <?php
} ?>

</div>
