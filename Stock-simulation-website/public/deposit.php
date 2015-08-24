<?php
    //configuration
    require("../includes/config.php");
    
    // if user reached page via GET (as by clicking a link or via redirect), ex: if they click "register" button
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $balance = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
        $balance = $balance[0]["cash"];
        render("deposit_form.php", ["title" => "Buy", "balance" => $balance]);
    }
    
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["amount"]))
        {
            apologize("You must provide an amount!");
        }
        
        if ($_POST["amount"] < 0)
        {
            apologize("You can't deposit negative amounts!");
        }
       
               
       
        $deposit = query("UPDATE users SET cash = cash + ? WHERE id = ?", $_POST["amount"], $_SESSION["id"]);
        
        if ($deposit === false)
        {
            apologize("Error with deposit");
        }
        
        $newBalance = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
        $newBalance = $newBalance[0]["cash"];
        
        render("deposit_confirm.php", ["title" => "Deposit Complete", "newBalance" => $newBalance, "deposit" => $_POST["amount"]]);
    }
    
?>
