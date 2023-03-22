<?php
    class Board {
        private $grid = array();
        private $BOARD_SIZE = 15;
        function __construct(){
            for ($row = 0; $row < $this->BOARD_SIZE; $row++){
                for ($col = 0; $col < $this->BOARD_SIZE; $col++){
                    $this->grid[$row][$col] = '-';
                }
            }
        }
        /**
         * Loops through the array looking for empty places -> '_', if any are found, it stores them in an array
         * @return $returns an array full of all empty places -> '_'
         */
        function getEmptyPlaces() {
            $empty_places = array();
            for ($row = 0; $row < $this->BOARD_SIZE; $row++) {
                for ($col = 0; $col < $this->BOARD_SIZE; $col++) {
                    if ($this->grid[$row][$col] == '-') {
                        // This place is empty
                        $empty_places[] = array($row, $col);
                    }
                }
            }
            return $empty_places;
        }

        /** Checks if the current move of the player is valid
         * @param $row row coordinate 
         * @param $col column coordinate
         * @param $playerSymbol current symbol of player
         * @return $returns false if move is invalid, returns true if space is empty
         */
        function makeMove($row, $col, $playerSymbol ){
            if ($row < 0 || $row >= $this->BOARD_SIZE || $col < 0 || $col >= $this->BOARD_SIZE || $this->grid[$row][$col] == $playerSymbol ){
                return false;
            }
            $this->grid[$row][$col] = $playerSymbol;
            return true;
        }

        /** Checks if the game is Over by checking the current status of the board or checking if there's a winner by using the {@link #isWinner(char) isWinner} method
         * @return $returns true if the winner is one of the players or if the board is full, if none of this is true, it returns false
         */
        function isGameOver(): bool{
            return $this->isWinner('X') || $this->isWinner('O') || $this->isBoardFull();
        }

        /** Loops through the whole board cheking the row, column, and diagonals of where the current symbols has been place and checks if there are 5 of the same symbols in a row to determine the winner
         * @param $playerSymbol current symbol of the player playing
         * @return $returns true if it finds 5 of the same symbols in a row, if it finds less than 5, it returns false
        */
        function isWinner($playerSymbol): bool{
            // Check rows
            for($row = 0; $row < $this->BOARD_SIZE; $row++){
                $count = 0;
                for ($col = 0; $col < $this->BOARD_SIZE; $col++){
                    if($this->grid[$row][$col] == $playerSymbol){
                        $count++;
                    }else{
                        $count = 0;
                    }
                    if($count == 5){
                        return true;
                    }
                }
            }

            // Check Columns
            for($col = 0; $col < $this->BOARD_SIZE; $col++){
                $count = 0;
                for ($row = 0; $row < $this->BOARD_SIZE; $row++){
                    if($this->grid[$row][$col] == $playerSymbol){
                        $count++;
                    }else{
                        $count = 0;
                    }
                    if ($count == 5){
                        return true;
                    }
                }
            }

            // Check diagonals
            for($row = 0; $row < $this->BOARD_SIZE; $row++){
                for ($col = 0; $col < $this->BOARD_SIZE; $col++){
                    $count1 = 0;
                    $count2 = 0;
                    for($i = 0; $i < 5; $i++){
                        if($row + $i < $this->BOARD_SIZE && $col + $i < $this->BOARD_SIZE && $this->grid[$row+$i][$col+$i] == $playerSymbol){
                            $count1++;
                        }
                        if($row+$i < $this->BOARD_SIZE && $col-$i >= 0 && $this->grid[$row+$i][$col-$i] == $playerSymbol){
                            $count2++;
                        }
                    }

                    if ($count1 == 5 || $count2 == 5){
                        return true;
                    }
                }
            }

            return false;
        }

        // Checks if the current board is full 
        //returns true if board is full, otherwise, it returns false
        function isBoardFull(): bool{
            for ($row = 0; $row < $this->BOARD_SIZE; $row++){
                for ($col = 0; $col < $this->BOARD_SIZE; $col++){
                    if ($this->grid[$row][$col] == '-'){
                        return false;
                    }
                }
            }
            return true;
        }

        /** 
         * Iterates through current board, and prints it
        */
        function displayBoard(){
            for ($row = 0; $row < $this->BOARD_SIZE; $row++){
                for ($col = 0; $col < $this->BOARD_SIZE; $col++){
                    echo  $this->grid[$row][$col] . " ";
                }
                echo "\n";
            }
        }


    }

?>