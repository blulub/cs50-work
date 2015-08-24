<!DOCTYPE HTML>
<ul class = "nav nav-pills">
    <li> <a href="quote.php">Quote</a></li>
    <li> <a href="buy.php">Buy</a></li>
    <li> <a href="sell.php">Sell</a></li>
    <li> <a href="history.php">History</a><li>
    <li> <a href="deposit.php">Deposit</a><li>
    <li> <a href="logout.php"><strong> Log Out </a></li>
</ul>


<p>
    <?php print("Transaction completed!");
    ?>
</p>
<p>
    <?php print("Bought " .$shares . " of ". $symbol. " at $". $price. " per share");
    ?>
</p>
<p>
    <?php print("Total amount paid: $" . $value);
    ?>
</p>


