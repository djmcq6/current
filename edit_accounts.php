<?php
// Check if form data was sent
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection
    include('connection.php');

    // Get the posted data
    $accountId = $_POST['accountId'];
    $accountName = $_POST['accountName'];
    $zig = $_POST['zig'];
    $idPortfolio = $_POST['idPortfolio'];
    $declareTransactionAccount = $_POST['transactionAccountType'];

    // Update the account details in the database
    $updateQuery = "UPDATE accounts SET 
                    account_name = '$accountName', 
                    zig = '$zig', 
                    id_portfolio = '$idPortfolio', 
                    transactionAccountType = '$declareTransactionAccount' 
                    WHERE id_acc = '$accountId'";

    if ($conn->query($updateQuery) === TRUE) {
        // If the update was successful, redirect back to the previous page
        $portfolio = $_POST['portfolio'] ?? ''; // Get the 'portfolio' value or set default
        $previousPage = "newportfolio1.php?portfolio=" . urlencode($portfolio) . "&view=TRUE&zig=" . urlencode($zig);
        header("Location: " . $previousPage);
        exit();

        exit();
    } else {
        // If an error occurred, display an error message
        echo "Error updating record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // If the form data was not sent through POST method, handle accordingly
    echo "Invalid request!";
}
