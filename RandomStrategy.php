<?php include 'MoveStrategy.php'; include 'Board.php'; include 'Player.php';
   class RandomStrategy extends MoveStrategy {
      function __construct(){} 
      //Pick a random empty place from the board
      function pickPlace() {
         // Get a list of all empty places on the board
         $empty_places = $this->board->getEmptyPlaces();
              
         // Pick a random empty place from the list
         $random_place = array_rand($empty_places);   
         return $empty_places[$random_place];
     }

   }

  
   
   
?>