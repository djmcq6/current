<?php
include 'connection.php'; // Include your database connection

$currentURL = ''; // Initialize the variable to store the URL

if (isset($_GET['zig']) && isset($_GET['portfolio'])) {
    $zigValue = $_GET['zig'];
    $portfolioValue = $_GET['portfolio'];

    // Fetch id_portfolio based on the provided portfolio value
    $portfolioQuery = "SELECT id_portfolio FROM portfolio WHERE portfolio = ?";
    $portfolioStmt = $conn->prepare($portfolioQuery);
    $portfolioStmt->bind_param("s", $portfolioValue);
    $portfolioStmt->execute();
    $portfolioResult = $portfolioStmt->get_result();

    if ($portfolioResult->num_rows > 0) {
        $portfolioRow = $portfolioResult->fetch_assoc();
        $id_portfolio = $portfolioRow['id_portfolio'];

        // Query for transactionAccountType using zig and id_portfolio
        $query = "SELECT transactionAccountType 
                  FROM accounts 
                  WHERE zig = ? AND id_portfolio = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $zigValue, $id_portfolio); // Assuming id_portfolio is an integer, use "i" for binding
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $transactionAccountType = $row['transactionAccountType'];
            // Construct the URL here
            $currentURL = $_SERVER['REQUEST_URI'];
            if (strpos($currentURL, '?') !== false) {
                $currentURL .= '&form=transaction';
            } else {
                $currentURL .= '?form=transaction';
            }
            $currentURL .= '&transaction=' . $transactionAccountType;
        }

        $stmt->close();
    }

    $portfolioStmt->close();
}



$currentURL = $_SERVER['REQUEST_URI'];

// Check if there are existing parameters in the URL
if (strpos($currentURL, '?') !== false) {
    // URL already contains parameters

    // Construct the URL with the 'transaction' parameter
    $currentURL .= '&form=transaction';

    if (isset($transactionAccountType)) {
        $currentURL .= '&transaction=' . $transactionAccountType;
    }
} else {
    // URL doesn't have any parameters yet

    // Construct the URL with the 'transaction' parameter
    $currentURL .= '?form=transaction';

    if (isset($transactionAccountType)) {
        $currentURL .= '&transaction=' . $transactionAccountType;
    }
}
?>

<!-- portfolionavbar.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="newportfolio1.php">Portfolio</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarPortfolio" aria-controls="navbarPortfolio" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarPortfolio">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="controlcenter.php">Control Center</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="<?php echo htmlspecialchars($currentURL); ?>">Transaction</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="run_bot.php">Run Bot</a>
      </li>
    </ul>
  </div>
</nav>