<form class="saisie_entreprise" action="index_post.php" method="post">
  <table>
    <tr>
      <td><label for="nom">Nom de l'entreprise</label></td>
      <td><input type="text" name="nom" id='nom'required="required" /></td>
    </tr>
    <tr>
      <td><label for="tel">tel de l'entreprise</label> </td>
      <td><input type="text" name="tel"id='tel' required="required"/></td>
    </tr>
    <tr>
      <td><label for="mail">mail de l'entreprise</label></td>
      <td><input type="text" name="mail"id='mail' required="required"/></td>
    </tr>
    <tr>
      <td><label for="activite">activité</label></td>
      <td><textarea name="activite" rows="4" cols="40" id="activite" required="required" ></textarea></td>
    </tr>
    <tr>
      <td><label for="adresse">adresse de l'entreprise</label></td>
      <td><textarea name="adresse" id='adresse'required="required" rows="8" cols="80"> </textarea></td>
    </tr>
    <tr>
      <td><input type="submit" name="valider" value="envoyer" /></td>
    </tr>
  </table>

</form>
