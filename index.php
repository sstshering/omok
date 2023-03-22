<?php 
    include('Board.php');
    include('MoveStrategy.php');

    define('PID', 'pid');
    define('MOVE', 'move');
    $board = new Board();
    
    //if PID is not entered
    if(!array_key_exists(PID, $_GET)){
        $result = array("response" => false, "reason" => "PID not specified");
        echo json_encode($result);
    
    }else{
        // Get the file with the same id
        $playerId = $_GET[PID];
        $file_path = "../writable/" . $playerId . ".txt";

        // checks if file exists
        if (!file_exists($file_path)){
            $result = array("response" => false, "reason" => "Unknow pid");
            echo json_encode($result);
        }
        //if file with PID exists
        else{
            $file = file_get_contents($file_path) or die("Unable to open file");
            $decoded_file = json_decode($file);

            if (!array_key_exists(MOVE, $_GET)){
                $result = array("response" => false, "reason" => "Move not specified");
                echo json_encode($result);
            }else{
                // Splits string to x,y
                $move = explode(",",$_GET[MOVE]);
                if (count($move) != 2){
                    $result = array("response" => false, "reason" => "Move not well-formed");
                    echo json_encode($result);

                }else{
                    //check if x val is withing the board range
                    if ($move[0] < 0 || $move[0] > 14){
                        $result = array("response" => false, "reason" => "Invalid x coordinate, $move[0]");
                        echo json_encode($result);
                     //check if y val is withing the board range
                    }else if ($move[1] < 0 || $move[1] > 14){
                        $result = array("response" => false, "reason" => "Invalid y coordinate, $move[1]");
                        echo json_encode($result);
                    //if both x,y in range, create newGame
                    }else{
                        //while (!$board->isGameOver()){
                            // Player move
                            //check if move is valid
                            if ($board->makeMove($move[0], $move[1], 'x')){
                                echo "Player move x: $move[0], y: $move[1]";
                                // Checks if winner
                                if ($board->isWinner('x')){
                                    $ack_move = array('x' => $move[0], 'y' => $move[1], 'isWinner' => $board->isWinner('x'), 'isDraw' => $board->isBoardFull());
                                    $result = array("response" => true, 'ack_move' => $ack_move);
                                    echo json_encode($result);
                                // Checks if draw
                                }else if ($board->isBoardFull()){
                                    $ack_move = array('x' => $move[0], 'y' => $move[1], 'isWinner' => $board->isWinner('x'), 'isDraw' => $board->isBoardFull());
                                    $result = array("response" => true, 'ack_move' => $ack_move);
                                    echo json_encode($result);
                                // Computer move
                                }else{
                                    echo "this is computers else";
                                    //check if strategy==random
                                    if (isset($decoded_file->{'strategy'}) && is_string($decoded_file->{'strategy'}) && $decoded_file->{'strategy'} == "random") {
                                        $s = $decoded_file->{'strategy'};
                                        echo "this is the strategy being used: $s ";
                                        $strategy = new RandomStrategy();
                                        $computer_move = $strategy->pickPlace($board);
                                        echo "Moves $computer_move[0], $computer_move[1]";
                                    }
                                    //check if strategy==smart
                                else if (isset($decoded_file->{'strategy'}) && is_string($decoded_file->{'strategy'}) && $decoded_file->{'strategy'} == "smart") {
                                    $s = $decoded_file->{'strategy'};
                                    echo "this is the strategy being used: $s ";
                                    $strategy = new SmartStrategy('x');
                                    $computer_move = $strategy->pickPlace();
                                    echo "Moves $computer_move[0], $computer_move[1]";
                                }
                                    
                                }
                                
                            }
                        // }
                    }
                }

            }

        }
    }


    
?>