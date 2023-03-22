<?php 
define('STRATEGY', 'strategy'); // constant
$strategies = ["smart", "random"]; // supported strategies

if (!array_key_exists(STRATEGY, $_GET)) {
    $result = array("response" => false, "reason" => "Strategy not specified");
    echo json_encode($result);

}else{
    $strategy = $_GET[STRATEGY];
    $strategy = strtolower($strategy);

    // Initializes smart stategy
    if ($strategy == $strategies[0]){
        $playerId = uniqid();
        $result = array("response" => true, "pid" => $playerId);
        echo json_encode($result);
        $filename ='../writable/' . $playerId . '.txt';
        $file = fopen($filename, 'w') or die("Unable to open file!");
        // fput pid, strategy, player, computer, board
        fputs($file, json_encode(array('pid' => $playerId, 'strategy' => $strategy, 'player' => [], 'computer' => [], 'board' => [])) );
        fclose($file);
    
    // Initializes random strategy
    } else if ($strategy == $strategies[1]){
        $playerId = uniqid();
        $result = array("response" => true, "pid" => $playerId);
        echo json_encode($result);
        $filename = "../writable/" . $playerId . '.txt';
        $file = fopen($filename, 'w') or die("Unable to open file!");
        // fput id, strategy, player, computer, board
        fputs($file, json_encode(array('pid' => $playerId, 'strategy' => $strategy, 'player' => [], 'computer' => [], 'board' => [])) );
        fclose($file);
    
    }else {
        $result = array("response" => false, "reason" => "Unknown strategy");
        echo json_encode($result);
    }
}
?>