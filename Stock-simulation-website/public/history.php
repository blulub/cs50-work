<?php
    //configuration
    require("../includes/config.php");
    
    $rows = query("SELECT * FROM history WHERE id = ?", $_SESSION["id"]);
    if (empty($rows))
    {
        apologize("You don't have any transactions yet!");
    }
    
    $positions = [];
    foreach ($rows as $row)
    {
        
        $positions[] = [
            "transaction" => $row["transaction"],
            "time" => $row["time"],
            "price" => number_format($row["price"], 2),
            "shares" => $row["shares"],
            "symbol" => $row["symbol"]
         ];
        
    }
    
    
    
    // if user reached page via GET (as by clicking a link or via redirect), ex: if they click "register" button
    render("history_table.php", ["title" => "history", "positions" => $positions]);
    
    
    
?>
