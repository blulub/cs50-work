<ul class = "nav nav-pills">
    <li> <a href="quote.php">Quote</a></li>
    <li> <a href="buy.php">Buy</a></li>
    <li> <a href="sell.php">Sell</a></li>
    <li> <a href="history.php">History</a><li>
    <li> <a href="deposit.php">Deposit</a><li>
    <li> <a href="logout.php"><strong> Log Out </a></li>
</ul>


<table class = "table table-striped">
    <thead>
        <tr>
            <th>Transaction</th>
            <th>Symbol</th>
            <th>Shares</th>
            <th>Price</th>
            <th>Time</th>
        </tr>
    </thead>
    
    <tbody>
        <?php
        
            foreach($positions as $position)
            {
                print("<tr>");
                print("<td>" . $position["transaction"] . "</td>");
                print("<td>" . $position["symbol"] . "</td>");
                print("<td>" . $position["shares"] . "</td>");
                print("<td>" . "$".$position["price"] . "</td>");
                print("<td>" . $position["time"]. "</td>");
                print("</tr>");
            }
        ?>
    </tbody>
</table>




