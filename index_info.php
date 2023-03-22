<?php
define('SIZE', 15);
$strategies = array('Smart' => 'Smart Strategy', 'Random' => 'Random Strategy');
$info = new GameInfo(SIZE, array_keys($strategies));
echo json_encode($info); //turns objects into strings
 
class GameInfo {
   public $size;
   public $strategies;
   function __construct($size, $strategies) {
      $this->size= $size;
      $this->strategies= $strategies;
   }
}
?>