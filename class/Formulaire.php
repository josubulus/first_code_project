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


    //functions de l'instance :
  private function getValue($index){
    if (isset($this->data)) {
      return $this->data[$index];
    }
  }
/**
@method interne a l'instance pour maintenanir les données dans les champs de saisie
*/
  public function input($name){
  return $this->surround('
<input type="text" name="'.$name.'" value="'.$this->getValue($name).'" />
');
}
/**
@method appeler un input text
*/

 public function submit($value){
   return $this->surround('<button type="submit" name="button">' . $value . '</button>');
 }

 /**
@method appeler un bouton de validation
 */

}
 ?>
