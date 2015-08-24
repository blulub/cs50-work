<?php

    // configuration
    require("../includes/config.php"); 
       
    // look up user ID for user's stock holdings
    $rows = query("SELECT * FROM portfolios WHERE id = ?", $_SESSION["id"]);
    $userrow = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
    $cash = $userrow[0]["cash"];
    $cash = number_format($cash, 2);
    
    $cashvalue = 0;
    // generate a table of positions
    $positions = [];
    foreach ($rows as $row)
    {
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $positions[] = [
                "name" => $stock["name"],
                "price" => number_format($stock["price"], 2),
                "shares" => $row["shares"],
                "symbol" => $row["symbol"]
            ];
            
            $cashvalue = $cashvalue + ($stock["price"] * $row["shares"]);
            $cashvalue = number_format($cashvalue, 2);
        }
    }

    // render portfolio
    render("portfolio.php", ["title" => "Portfolio", "positions" => $positions, "balance" => $cash, "cashvalue" => $cashvalue]);

?>
