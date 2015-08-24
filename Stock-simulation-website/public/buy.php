<?php
    //configuration
    require("../includes/config.php");
    
    // if user reached page via GET (as by clicking a link or via redirect), ex: if they click "register" button
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("buy_form.php", ["title" => "Buy"]);
    }
    
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["symbol"]))
        {
            apologize("You must provide a stock symbol");
        }
        if (empty($_POST["shares"]))
        {
            apologize("You must enter number of shares");
        }
        if (!preg_match("/^\d+$/", $_POST["shares"]))
        {
            apologize("You can only buy whole shares!");
        }
       
        // lookup the stock symbol they gave
        $stock = lookup($_POST["symbol"]);
        if ($stock === false)
        {
            apologize("Stock doesn't exist");
        }
        
        // find the latest price of the stock
        $stockPrice = $stock["price"];
        
        // find available cash on hand
        $rows = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
        $balance = $rows[0]["cash"];
        $valueofBuy = $stockPrice * $_POST["shares"];
        
        // make sure user has enough cash
        if ($balance < $valueofBuy)
        {
            apologize("Not enough cash available for transaction");
        }
        
       
        $buy = query("INSERT INTO portfolios (id, symbol, shares) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $_SESSION["id"], strtoupper($_POST["symbol"]), $_POST["shares"]);
        
        if ($buy === false)
        {
            apologize("Error with buying");
        }
        
        query("INSERT INTO history (id, symbol, shares, transaction, price) VALUES (?, ?, ?, ?, ?)", $_SESSION["id"], strtoupper($_POST["symbol"]), $_POST["shares"], "BUY", $stockPrice);
        
        $payment = query("UPDATE users SET cash = cash - ? WHERE id = ?", $valueofBuy, $_SESSION["id"]);
        
        render("buy_confirm.php", ["title" => "Transaction Complete", "symbol" => $_POST["symbol"], "shares" => $_POST["shares"], "price" => $stockPrice, "value" => $valueofBuy]);
    }
    
?>
