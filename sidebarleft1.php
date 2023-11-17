<?php
echo '<div class="container p-0">
<div class="row text-center">';

// Check if 'form' variable exists in the GET request
include 'sidebarleftFormVariable.php';

echo '</div>
</div>';

// underneath the buttons when $portfolio exist this is the whole column


echo '<div class="row col-a justify-content-center text-center">';
include 'connection.php';

if (isset($_GET['portfolio'])) {
    $portfolioValue = $_GET['portfolio'];

    if (isset($_GET['add'])) {
        $zigValue = isset($_GET['zig']) ? $_GET['zig'] : '';

        if ($zigValue !== '' && $_GET['add'] !== 'acc') {
            // Extract the numeric part of the zig (e.g., 1.1 becomes 11, 1.1.1 becomes 111)
            $numericZig = str_replace('.', '', $zigValue);

            // Increment the zig value
            $newNumericZig = $numericZig + 1;

            // Calculate the new zig with proper formatting
            $newZigValue = implode('.', str_split($newNumericZig, 1));

            echo '
                <div class="col col-c">
                    <h5 class="text-center">Add Sub Account</h5>
                    <p>New Zig: ' . $newZigValue . '</p>
                    <form method="POST" action="insert_account.php">
                        <label for="accountName">Account:</label>
                        <input type="text" id="accountName" name="accountName">
                        <input type="hidden" name="portfolio" value="' . $portfolioValue . '">
                        <input type="hidden" name="zig" value="' . $newZigValue . '">
                        <input type="submit" value="Add">
                    </form>
                </div>';
        } elseif (!empty($zigValue)) {
            // Append .1 to the zig value
            $newZigValue = $zigValue . '.1';

            echo '
                <div class="col col-c">
                    <h5 class="text-center">Add Sub Account</h5>
                    <p>New Zig: ' . $newZigValue . '</p>
                    <form method="POST" action="insert_account.php">
                        <label for="accountName">Account:</label>
                        <input type="text" id="accountName" name="accountName">
                        <input type="hidden" name="portfolio" value="' . $portfolioValue . '">
                        <input type="hidden" name="zig" value="' . $newZigValue . '">
                        <input type="submit" value="Add">
                    </form>
                </div>';
        }
    } else {
        // Fetch and display existing accounts
        $getPortfolioIdQuery = "SELECT id_portfolio FROM portfolio WHERE portfolio = '$portfolioValue'";
        $portfolioIdResult = $conn->query($getPortfolioIdQuery);

        if ($portfolioIdResult->num_rows > 0) {
            $row = $portfolioIdResult->fetch_assoc();
            $idPortfolio = $row['id_portfolio'];

            $getAccountsQuery = "SELECT account_name, zig FROM accounts WHERE id_portfolio = '$idPortfolio' ORDER BY zig ASC";
            $accountsResult = $conn->query($getAccountsQuery);

            if ($accountsResult->num_rows > 0) {
                echo "<div class='col col-c' style='text-align: left;'>";
                echo "<h5 class='text-center'>Accounts</h5>";
                echo "<table class='table table-sm table-bordered' style='margin-top: 10px;'>"; // Apply margin-top as an example

                while ($row = $accountsResult->fetch_assoc()) {
                    $padding = strlen($row['zig']) * 10; // Adjust the padding factor as needed
                    $accountName = $row['account_name'];
                    $zig = $row['zig'];

                    // Creating a link around the account name
                    echo "<tr><td style='padding-left: {$padding}px;'><a href='newportfolio1.php?portfolio=$portfolioValue&zig=$zig'>$accountName</a></td></tr>";
                }
                echo "</tbody></table></div>";
            } else {
                // Insert original portfolio value into 'accounts' table with id_portfolio and zig = 1
                $insertAccountQuery = "INSERT INTO accounts (account_name, id_portfolio, zig) VALUES ('$portfolioValue', '$idPortfolio', '1')";
                if ($conn->query($insertAccountQuery) === TRUE) {
                    header("Location: newportfolio1.php?portfolio=$portfolioValue");
                    exit();
                } else {
                    echo "Error: " . $conn->error;
                }
            }
        } else {
            echo "Portfolio not found";
        }
    }
} else {
    // If portfolio variable is not set, handle accordingly
}

$conn->close();
echo '</div>';
