<?php
echo '<!-- main content -->
<div class="col max-height: 100%">
    <!-- top sections -->
    <div class="row text-center max-height: 100%">';

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

    echo "<div class='col col-a'><h1>S&P 500: $$formattedPrice</h1></div>";
} else {
    echo "<div class='col col-a'>Ticker not found in the database.</div>";
}

// Close the database connection
$conn->close();

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

    echo "<div class='col col-a'><h1>NASDAQ: $$formattedPrice</h1></div>";
} else {
    echo "<div class='col col-a'>Ticker not found in the database.</div>";
}

// Close the database connection
$conn->close();

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

    echo "<div class='col col-a'><h1>US 10-YR: $currentPrice%</h1></div>";
} else {
    echo "<div class='col col-a'>Ticker not found in the database.</div>";
}

// Close the database connection
$conn->close();

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

    echo "<div class='col col-a'><h1>USDJPY: ¥$currentPrice</h1></div>";
} else {
    echo "<div class='col col-a'>Ticker not found in the database.</div>";
}

// Close the database connection
$conn->close();

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

    echo "<div class='col col-a'><h1>Crude Oil: $$currentPrice</h1></div>";
} else {
    echo "<div class='col col-a'>Ticker not found in the database.</div>";
}

// Close the database connection
$conn->close();

echo '</div>
</div>';

//underneath the top section

echo '<div class="row">';
include 'connection.php';

$showTable = isset($_GET['portfolio']) && isset($_GET['view']) && $_GET['view'] === 'TRUE';

if ($showTable) {
    // Retrieve 'portfolio' variable from URL
    $portfolioValue = $_GET['portfolio'];

    // Query to get id_portfolio from table 'portfolio'
    $getPortfolioIdQuery = "SELECT id_portfolio FROM portfolio WHERE portfolio = '$portfolioValue'";
    $portfolioIdResult = $conn->query($getPortfolioIdQuery);

    if ($portfolioIdResult->num_rows > 0) {
        // Fetch the id_portfolio
        $row = $portfolioIdResult->fetch_assoc();
        $idPortfolio = $row['id_portfolio'];

        // Query to select account_name and zig from 'accounts' table where id_portfolio matches, sorted by 'zig' ascending
        $getAccountsQuery = "SELECT * FROM accounts WHERE id_portfolio = '$idPortfolio' ORDER BY zig ASC";
        $accountsResult = $conn->query($getAccountsQuery);

        if ($accountsResult->num_rows > 0) {
            echo "<div class='col'>";
            echo "<h5 class='text-center'></h5>";
            echo "<table class='table table-sm table-bordered'><br>";
            echo "<thead'><tr>
                    <th class='text-center'>Account</th>
                    <th class='text-center'>Zig</th>
                    <th class='text-center'>Transaction Account</th>
                    <th class='text-center'>Add Sub Account</th>
                    <th class='text-center'>Add Row</th>
                    <th class='text-center'>Update Row</th>
                  </tr></thead><tbody class='text-center'>";

            while ($row = $accountsResult->fetch_assoc()) {
                // Fetch the Zig value from the current row
                $zigValue = $row['zig'];

                // Calculate the padding based on the length of the zig value
                $padding = strlen($zigValue) * 12.5; // Adjust the multiplier for desired padding

                echo '<tr>';
                echo '<td class="col-2" style="text-align: left; padding-left: ' . $padding . 'px;">' . $row['account_name'] . '</td>'; // Apply style to the first column
                echo '<td class="col-1">' . $row['zig'] . '</td>';
                echo '<td class="col-1">' . $row['transactionAccountType'] . '</td>';
                echo '<td class="col-1"><a href="newportfolio1.php?portfolio=' . $portfolioValue . '&view=TRUE&add=acc&zig=' . $zigValue . '"><button>Add</button></a></td>';
                echo '<td class="col-1"><a href="newportfolio1.php?portfolio=' . $portfolioValue . '&view=TRUE&add=acc1&zig=' . $zigValue . '"><button>Add</button></a></td>';
                echo '<td class="col-1">
                    <a href="newportfolio1.php?portfolio=' . $portfolioValue . '&view=TRUE&form=edit&zig=' . $zigValue . '"><button>Edit</button></a>
                    <a href="newportfolio1.php?portfolio=' . $portfolioValue . '&view=TRUE&form=delete&zig=' . $zigValue . '"><button>Delete</button></a>
                    </td>';
                echo '</tr>';
            }

            echo "</tbody></table></div>";
        } else {
            // If no rows exist, insert original portfolio value into 'accounts' table with id_portfolio and zig = 1
            $insertAccountQuery = "INSERT INTO accounts (account_name, id_portfolio, zig) VALUES ('$portfolioValue', '$idPortfolio', '1')";
            if ($conn->query($insertAccountQuery) === TRUE) {
                // Redirect back to newportfolio1.php with the portfolio variable in the URL
                header("Location: newportfolio1.php?portfolio=$portfolioValue&view=TRUE");
                exit();
            } else {
                echo "Error: " . $conn->error;
            }
        }
    } else {
        echo "Portfolio not found";
    }
} else {
    // Query to select account_name, zig, and add the 'Value' column from 'accounts' table sorted by 'zig' ascending
    $getAccountsQuery = "SELECT * FROM accounts WHERE id_portfolio = '$idPortfolio' ORDER BY zig ASC";
        $accountsResult = $conn->query($getAccountsQuery);

    if ($accountsResult->num_rows > 0) {
        echo "<div class='col'>";
        echo "<h5 class='text-center'>Accounts</h5>";
        echo "<table class='table table-sm table-bordered'><br>";
        echo "<thead'><tr>
                <th class='text-center'>Account</th>
                <th class='text-center'>Value</th>
              </tr></thead><tbody class='text-center'>";

        while ($row = $accountsResult->fetch_assoc()) {
            $zigValue = $row['zig'];
            $padding = strlen($zigValue) * 12.5; // Adjust the multiplier for desired padding

            echo '<tr>';
            echo '<td class="col-2" style="text-align: left; padding-left: ' . $padding . 'px;">' . $row['account_name'] . '</td>';
            echo '<td class="col-1">';
                include 'accountValues.php'; // Include HTML content directly
            echo '</td>';

            echo '</tr>';
        }

        echo "</tbody></table></div>";
    } else {
        echo "No accounts found";
    }
}

$conn->close();
?>


<div></div>
</div>