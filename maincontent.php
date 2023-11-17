<!-- main content -->
<div class="col col-b max-height: 100%">
    <!-- top sections -->
    <div class="row text-center max-height: 100%">
        <div class="col col-a">
            <?php
            include 'connection.php';

            // Ticker name to select
            $tickerName = "^gspc";

            // SQL query to select current_price
            $sql = "SELECT current_price FROM tickers WHERE ticker_name = '$tickerName'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of the selected ticker
                $row = $result->fetch_assoc();
                $currentPrice = $row["current_price"];

                // Round and add commas using number_format
                $formattedPrice = number_format($currentPrice, 2);

                echo "<h1>S&P 500: $$formattedPrice</h1>";
            } else {
                echo "Ticker not found in the database.";
            }

            // Close the database connection
            $conn->close();
            ?>


        </div>
        <div class="col col-a">
            <?php
            include 'connection.php';

            // Ticker name to select
            $tickerName = "^ixic";

            // SQL query to select current_price
            $sql = "SELECT current_price FROM tickers WHERE ticker_name = '$tickerName'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of the selected ticker
                $row = $result->fetch_assoc();
                $currentPrice = $row["current_price"];

                // Round and add commas using number_format
                $formattedPrice = number_format($currentPrice, 2);

                echo "<h1>NASDAQ: $$formattedPrice</h1>";
            } else {
                echo "Ticker not found in the database.";
            }

            // Close the database connection
            $conn->close();
            ?>



        </div>
        <div class="col col-a">
            <?php
            include 'connection.php';

            // Ticker name to select
            $tickerName = "^tnx";

            // SQL query to select current_price
            $sql = "SELECT current_price FROM tickers WHERE ticker_name = '$tickerName'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of the selected ticker
                $row = $result->fetch_assoc();
                $currentPrice = $row["current_price"];

                echo "<h1>US 10-YR: $currentPrice%</h1>";
            } else {
                echo "Ticker not found in the database.";
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>
        <div class="col col-a">
            <?php
            include 'connection.php';

            // Ticker name to select
            $tickerName = "jpy=x";

            // SQL query to select current_price
            $sql = "SELECT current_price FROM tickers WHERE ticker_name = '$tickerName'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of the selected ticker
                $row = $result->fetch_assoc();
                $currentPrice = $row["current_price"];

                echo "<h1>USDJPY: ¥$currentPrice</h1>";
            } else {
                echo "Ticker not found in the database.";
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>
        <div class="col col-a">
            <?php
            include 'connection.php';

            // Ticker name to select
            $tickerName = "cl=f";

            // SQL query to select current_price
            $sql = "SELECT current_price FROM tickers WHERE ticker_name = '$tickerName'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of the selected ticker
                $row = $result->fetch_assoc();
                $currentPrice = $row["current_price"];

                echo "<h1>Crude Oil: $" . $currentPrice . "</h1>";
            } else {
                echo "Ticker not found in the database.";
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>
    </div>

    <!--Main buttons-->
    <?php
    $portfolioName = $_GET['portfolio'] ?? '';
    $filter1 = $_GET['filter1'] ?? '';
    $filter2 = $_GET['filter2'] ?? '';
    ?>

    <?php if (!empty($filter2)) : ?>
        <div class="row text-center max-height: 100%">
            <div class="col col-a">
                <a href="newportfolio.php?portfolio=<?php echo $portfolioName; ?>&filter1=<?php echo $filter1; ?>&filter2=<?php echo $filter2; ?>&filter3=AssetType" class="btn btn-primary">Asset Type</a>
            </div>
            <div class="col col-a">
                <a href="newportfolio.php?portfolio=<?php echo $portfolioName; ?>&filter1=<?php echo $filter1; ?>&filter2=<?php echo $filter2; ?>&filter3=Position" class="btn btn-primary">Position</a>
            </div>
            <div class="col col-a">
                <a href="newportfolio.php?portfolio=<?php echo $portfolioName; ?>&filter1=<?php echo $filter1; ?>&filter2=<?php echo $filter2; ?>&filter3=Broker" class="btn btn-primary">Broker</a>
            </div>
        </div>

        <?php elseif (!empty($filter1)) : ?>
        <div class="row text-center max-height: 100%">
            <div class="col col-a">
                <a href="newportfolio.php?portfolio=<?php echo $portfolioName; ?>&filter1=<?php echo $filter1; ?>&filter2=Securites" class="btn btn-primary">Securities</a>
            </div>
            <div class="col col-a">
                <a href="newportfolio.php?portfolio=<?php echo $portfolioName; ?>&filter1=<?php echo $filter1; ?>&filter2=RealAssets" class="btn btn-primary">Real Assets</a>
            </div>

        </div>
        
    <?php elseif (!empty($portfolioName)) : ?>
        <div class="row text-center max-height: 100%">
            <div class="col col-a">
                <a href="newportfolio.php?portfolio=<?php echo $portfolioName; ?>&filter1=InvestmentsDashboard" class="btn btn-primary">Investment Dashboard</a>
            </div>
            <div class="col col-a">
                <a href="newportfolio.php?portfolio=<?php echo $portfolioName; ?>&filter1=CashflowDashboard" class="btn btn-primary">Cashflow Dashboard</a>
            </div>
            <div class="col col-a">
                <a href="newportfolio.php?portfolio=<?php echo $portfolioName; ?>&filter1=FinancialStatements" class="btn btn-primary">Financial Statements</a>
            </div>
        </div>
    <?php endif; ?> <!--No Row Added-->


</div>


// Main buttons
$portfolioName = $_GET['portfolio'] ?? '';
$filter1 = $_GET['filter1'] ?? '';
$filter2 = $_GET['filter2'] ?? '';

// Check if 'portfolio' is not 'New' before displaying the main buttons
if (!empty($portfolioName) && $portfolioName !== 'New') {
    if (!empty($filter2)) {
        echo '<div class="row text-center max-height: 100%">
                <div class="col col-a">
                    <a href="newportfolio.php?portfolio=' . $portfolioName . '&filter1=' . $filter1 . '&filter2=' . $filter2 . '&filter3=AssetType" class="btn btn-primary">Asset Type</a>
                </div>
                <div class="col col-a">
                    <a href="newportfolio.php?portfolio=' . $portfolioName . '&filter1=' . $filter1 . '&filter2=' . $filter2 . '&filter3=Position" class="btn btn-primary">Position</a>
                </div>
                <div class="col col-a">
                    <a href="newportfolio.php?portfolio=' . $portfolioName . '&filter1=' . $filter1 . '&filter2=' . $filter2 . '&filter3=Broker" class="btn btn-primary">Broker</a>
                </div>
            </div>';
    } elseif (!empty($filter1)) {
        echo '<div class="row text-center max-height: 100%">
                <div class="col col-a">
                    <a href="newportfolio.php?portfolio=' . $portfolioName . '&filter1=' . $filter1 . '&filter2=Securites" class="btn btn-primary">Securities</a>
                </div>
                <div class="col col-a">
                    <a href="newportfolio.php?portfolio=' . $portfolioName . '&filter1=' . $filter1 . '&filter2=RealAssets" class="btn btn-primary">Real Assets</a>
                </div>
            </div>';
    } else {
        echo '<div class="row text-center max-height: 100%">
            <div class="col col-a">
                <a href="newportfolio.php?portfolio=' . $portfolioName . '&filter1=InvestmentsDashboard" class="btn btn-primary">Investment Dashboard</a>
            </div>
            <div class="col col-a">
                <a href="newportfolio.php?portfolio=' . $portfolioName . '&filter1=CashflowDashboard" class="btn btn-primary">Cashflow Dashboard</a>
            </div>
            <div class="col col-a">
                <a href="newportfolio.php?portfolio=' . $portfolioName . '&filter1=FinancialStatements" class="btn btn-primary">Financial Statements</a>
            </div>
        </div>';
    }
}

echo '</div>
</div>';
?>
