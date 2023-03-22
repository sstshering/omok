<?php include 'MoveStrategy.php'; include 'Board.php'; include 'Player.php';
    class SmartStrategy extends MoveStrategy {
        private $symbol;
        function __construct($symbol){
            $this->symbol = $symbol;
        }
        function setSymbol($symbol){
            $this->symbol = $symbol;
        }
        function getSymbol(){
            return $this->symbol;
        }
        // picks winning move or a blocking move according the empty_places
        function pickPlace() {
            //Get a list of all empty places on the board
            $empty_places = $this->board->getEmptyPlaces();
    
            //check for winning move for current player symbol
            $winMove = $this->isaWinningMove($empty_places, $this->getSymbol());
            if ($winMove !== false) { //if not false
                return $winMove;
            }
    
            // check for blocking move for the opponent symbol
            $rival_symbol = $this->getSymbol() == 'X' ? 'O' : 'X'; //check and get the rival's symbol according the current player symbol
            $blockMove = $this->isaWinningMove($empty_places, $rival_symbol);
            if ($blockMove !== false) { //if not false
                return $blockMove;
            }
    
            // Otherwise, pick a random move
            return $this->pickRandomPlace();
        }
    
        // Helper method to check for winning moves
        function isaWinningMove($empty_places, $symbol) {
            //for every empty place
            foreach ($empty_places as $place) {
                //make a move 
                $this->board->makeMove($place[0], $place[1], $symbol);
                //check if its a win
                if ($this->board->isWinner($symbol)) {
                    return $place;
                }
                //else undo the move
                $this->board->makeMove($place[0], $place[1], '-');
            }
            return false;
        }
        // Pick a random empty place from the board
        function pickRandomPlace() {
            // Get a list of all empty places on the board
            $empty_places = $this->board->getEmptyPlaces();

            // Pick a random empty place from the list
            $random_place = array_rand($empty_places);  
            return $empty_places[$random_place];
        }
    }

?>