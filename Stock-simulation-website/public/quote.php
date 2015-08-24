<?php
    
    require("../includes/config.php");
    
    // check to see if page requested
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    
        // if stock is legitimate then extract symbol, name, price
    
        $stock = lookup($_POST["ticker"]);
    
        if ($stock === false)
        {
            apologize("Stock symbol invalid");
        }
    
        // render display page, passing in symbol name and price
        render("quote_display.php", ["title" => "quote display", "symbol" => $stock["symbol"], "name" => $stock["name"], "price" => $stock["price"]]);
    }
    else
    {
        render("quote_form.php");
    }
    
?>
