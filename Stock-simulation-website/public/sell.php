<?php
    //configuration
    require("../includes/config.php");
    
    // if user reached page via GET (as by clicking a link or via redirect), ex: if they click "register" button
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("sell_form.php", ["title" => "Sell"]);
    }
    
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["symbol"]))
        {
            apologize("You must provide a stock symbol");
        }
       
        // lookup the stock symbol they gave
        $stock = lookup($_POST["symbol"]);
        if ($stock === false)
        {
            apologize("Stock doesn't exist");
        }
        
        // find the latest price of the stock
        $stockPrice = $stock["price"];
        
        // find value of their stock sell
        $rows = query("SELECT * FROM portfolios WHERE id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
        
        if (empty($rows))
        {
            apologize("You don't own shares of that company!");
        }
        $shares = $rows[0]["shares"];
        $value = $stock["price"] * $shares;
        
        
       
        $row = query("DELETE FROM portfolios WHERE id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
        
        if ($row === false)
        {
            apologize("You don't own any shares of that company!");
        }
        
        query("INSERT INTO history (id, symbol, shares, transaction, price) VALUES (?, ?, ?, ?, ?)", $_SESSION["id"], strtoupper($_POST["symbol"]), $shares, "SELL", $stock["price"]);
        
        $payment = query("UPDATE users SET cash = cash + ? WHERE id = ?", $value, $_SESSION["id"]);
        
        render("shares_sold.php", ["title" => "Transaction Complete", "symbol" => $_POST["symbol"], "shares" => $shares, "price" => $stockPrice, "value" => $value]);
    }
    
?>
