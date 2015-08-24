<ul class = "nav nav-pills">
    <li> <a href="quote.php">Quote</a></li>
    <li> <a href="buy.php">Buy</a></li>
    <li> <a href="sell.php">Sell</a></li>
    <li> <a href="history.php">History</a><li>
    <li> <a href="deposit.php">Deposit</a><li>
    <li> <a href="logout.php"><strong> Log Out </a></li>
</ul>

<form action="quote.php" method="POST">
    <fieldset>
        <div class="form-group">
            <input autofocus class="form-control" name="ticker" placeholder="Enter Stock Symbol" type="text"/>
        </div>
        
       
        <div class="form-group">
            <button type="submit" class="btn btn-default">Submit Symbol</button>
        </div>
    </fieldset>
</form>

