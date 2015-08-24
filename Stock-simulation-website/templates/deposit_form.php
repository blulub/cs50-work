<ul class = "nav nav-pills">
    <li> <a href="quote.php">Quote</a></li>
    <li> <a href="buy.php">Buy</a></li>
    <li> <a href="sell.php">Sell</a></li>
    <li> <a href="history.php">History</a><li>
    <li> <a href="deposit.php">Deposit</a><li>
    <li> <a href="logout.php"><strong> Log Out </a></li>
    
</ul>

<div> <?php print("Current Balance is: $". number_format($balance, 2));
       ?> 
</div>
</br>

<form action="deposit.php" method="post">
    <fieldset>
        
        <div class="form-group">
            <input autofocus class="form-control" name="amount" placeholder="Amount to Deposit" type="text"/>
        </div>
      
       
        <div class="form-group">
            <button type="submit" class="btn btn-default">Submit Transaction</button>
        </div>
    </fieldset>
</form>
<div>
    or <a href="portfolio.php">Back to Portfolio</a>
</div>
