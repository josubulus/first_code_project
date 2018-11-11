<form class="saisie_entreprise" action="index_post.php" method="post">
      <p><label for="nom">Nom de l'entreprise</label> <br /> <input type="text" name="nom" id='nom'required="required" /></p>
      <p><label for="tel">tel de l'entreprise</label> <br /> <input type="text" name="tel"id='tel' required="required"/></p>
      <p><label for="mail">mail de l'entreprise</label> <br /> <input type="text" name="mail"id='mail' required="required"/></p>
      <p><label for="activite">activité</label><br /><textarea name="activite" rows="4" cols="40" id="activite" required="required" ></textarea></p>
      <p><label for="adresse">adresse de l'entreprise</label> <br /> <textarea name="adresse" id='adresse'required="required" rows="8" cols="80"> </textarea></p>
      <p><input type="submit" name="valider" /> </p>
</form>
