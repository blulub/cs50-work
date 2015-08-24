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
            <th>Symbol</th>
            <th>Name</th>
            <th>Shares</th>
            <th>Price</th>
            <th>Value</th>
        </tr>
    </thead>
    
    <tbody>
        <?php
        
            foreach($positions as $position)
            {
                print("<tr>");
                print("<td>" . $position["symbol"] . "</td>");
                print("<td>" . $position["name"] . "</td>");
                print("<td>" . $position["shares"] . "</td>");
                print("<td>" . "$".$position["price"] . "</td>");
                print("<td>" . "$".$position["price"] * $position["shares"] . "</td>");
                print("</tr>");
            }
        ?>
    </tbody>
</table>
<br />

<table>
    <tr>
        <th> Total Value:  </th>
        <td> <?php print("$".$cashvalue)?> </td>
    </tr>
    
    <tr>
        <th> Cash Available:   </th>
        <td> <?php print("$".$balance)?> </td>
    </tr>
</table>

