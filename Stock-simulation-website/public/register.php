<?php
    //configuration
    require("../includes/config.php");
    
    // if user reached page via GET (as by clicking a link or via redirect), ex: if they click "register" button
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("register_form.php", ["title" => "Register"]);
    }
    
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["username"]))
        {
            apologize("You must provide username");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide password");
        }
        else if ($_POST["password"] !== $_POST["confirmpassword"])
        {
            apologize("Passwords don't match");
        }
        
        // insert user into database if all above is correct
        $row = query("INSERT INTO users (username, hash, cash) VALUES (?, ?, 10000.0000)", $_POST["username"], crypt($_POST["password"]));
        
        if ($row === false)
        {
            apologize("User already registered!");
        }
        
        $completedInstert = query("SELECT LAST_INSERT_ID() AS id");
        $id = $rows[0]["id"];
        
        $_SESSION["id"] = $id;
        
        redirect("index.php");
    }
    
?>
