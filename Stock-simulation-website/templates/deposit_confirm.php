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
    <?php print("Deposit completed!");
    ?>
</p>
<p>
    <?php print("Deposited $" .$deposit);
    ?>
</p>
<p>
    <?php print("New Balance: $" . $newBalance);
    ?>
</p>


