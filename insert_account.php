<?php
// Ensure the form was submitted and contains necessary data
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['accountName']) && isset($_POST['portfolio']) && isset($_POST['zig'])) {
    $accountName = $_POST['accountName'];
    $portfolioValue = $_POST['portfolio'];
    $zigValue = $_POST['zig'];

    include 'connection.php';

    // Retrieve the id_portfolio based on the portfolio value
    $getPortfolioIdQuery = "SELECT id_portfolio FROM portfolio WHERE portfolio = '$portfolioValue'";
    $portfolioIdResult = $conn->query($getPortfolioIdQuery);

    if ($portfolioIdResult->num_rows > 0) {
        $row = $portfolioIdResult->fetch_assoc();
        $idPortfolio = $row['id_portfolio'];

        // Insert the account details into the 'accounts' table
        $insertAccountQuery = "INSERT INTO accounts (account_name, id_portfolio, zig) VALUES ('$accountName', '$idPortfolio', '$zigValue')";
        if ($conn->query($insertAccountQuery) === TRUE) {
            // Redirect back to newportfolio1.php with the portfolio variable in the URL
            header("Location: newportfolio1.php?portfolio=$portfolioValue&view=TRUE");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Portfolio not found";
    }

    $conn->close();
} else {
    echo "Form data missing or incorrect method used.";
}
?>
