<?php
class Form{
/**
@class creer des formulaires.
*/

  public $surround='p';
  public $data;

 public function __construct($data = array()){
   $this->data=$data;
 }
                    //méthodes interne a l'instance

  public function surround($html){
    return "<{$this->surround}>{$html}</{$this->surround}>";
  }
  /**
  @method sert a entourer les formulaire avec un tag surround accessible depuis l'extèreieur
  */
  private function getValue($index){
    if (isset($this->data[$index])) {//attention rajout de [$index] non testé.
      return $this->data[$index];
    }
    else {
      return null;
    }
  }
/**
@method interne a l'instance pour maintenanir les données dans les champs de saisie
sur la vue : $objet = new Form($_POST) avant la balise form
*/

    //functions de l'instance :

  public function input($name,$label){
  return $this->surround('
<label for="'.$name.'">' .$label. '</label><br />
<input type="text" name="'.$name.'" value="'.$this->getValue($name).'" required />
');
}
/**
@method appeler un input text
@parameters : string nom form puis label form
*/
public function textarea($name,$label){
  return $this->surround('
      <label for="'.$name.'">' .$label. '</label><br />
      <textarea name="'.$name.'" rows="3" cols="60">'.$this->getValue($name).'</textarea>

  ');
}
 public function submit($value){
   return $this->surround('<button type="submit" name="button">' . $value . '</button>');
 }

 /**
@method appeler un bouton de validation
 */

}
 ?>
