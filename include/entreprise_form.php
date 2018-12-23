<form class="saisie_entreprise" action="index_post.php" method="post">
  <table>
     <tr>
       <td><label for="nom">Nom de l'entreprise :</label></td>
     </tr>
     <tr>
       <td><input type="text" name="nom" id='nom'required="required" /> </td>
     </tr>
    <tr>
      <td class="input_saisie_entreprise"><label for="tel">Tel de l'entreprise :</label> </td>
    </tr>
    <tr class="ligne_tableau_entreprise">
      <td><input type="text" name="tel"id='tel' required="required"/></td>
    </tr>
    <tr>
      <td class="input_saisie_entreprise"><label for="mail">Mail de l'entreprise :</label></td>
    </tr>
    <tr>
      <td><input type="text" name="mail"id='mail' required="required"/></td>
    </tr>
    <tr>
      <td class="input_saisie_entreprise"><label for="mail">Site de l'entreprise :</label></td>
    </tr>
    <tr>
      <td><input type="text" name="site" id='site' required="required"/></td>
    </tr>
    <tr>
      <td class="input_saisie_entreprise"><label for="activite">Activité :</label></td>
    </tr>
    <tr>
      <td><textarea name="activite" rows="4" cols="40" id="activite" required="required" ></textarea></td>
    </tr>
    <tr>
      <td class="input_saisie_entreprise"><label for="adresse">Adresse de l'entreprise :</label></td>
    </tr>
    <tr>
      <td><textarea name="adresse" id='adresse'required="required" rows="8" cols="80"> </textarea></td>
    </tr>
    <tr>
      <td><input type="submit" name="valider" value="envoyer" /></td>
    </tr>
  </table>
</form>
