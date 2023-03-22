<?php
    class Player{
        private $symbol;
        function __construct($symbol){
            $this->symbol = $symbol;
        }

        function getSymbol(){
            return $this->symbol;
        }

        function makeMove(Board $board) {
            $row = $col = 0;
            while (true) {
                echo "Enter row and column (e.g. 0 0) or -1 to quit the game: ";
                fscanf(STDIN, "%d %d", $row, $col);
                if ($row == -1) {
                    exit(0);
                }
                if ($board->makeMove($row, $col, $this->getSymbol())) {
                    break;
                } else {
                    echo "Invalid move. Try again.\n";
                }
            }
            return array($row, $col);
        }
        
    }
    
?>