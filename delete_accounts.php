<?php
// Include your database connection
include('connection.php');

// Check if form data was sent
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accountId'])) {
    // Get the account ID from the POST data
    $accountId = $_POST['accountId'];

    // Delete the account from the database
    $deleteQuery = "DELETE FROM accounts WHERE id_acc = '$accountId'";

    if ($conn->query($deleteQuery) === TRUE) {
        // If the deletion was successful, redirect back to the previous page
        $portfolio = $_POST['portfolio'] ?? ''; // Get the 'portfolio' value or set default
        $zig = $_POST['zig'] ?? '';

        $previousPage = "newportfolio1.php?portfolio=" . urlencode($portfolio) . "&view=TRUE&zig=" . urlencode($zig);
        header("Location: " . $previousPage);
        exit();
    } else {
        // If an error occurred, display an error message
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // If the form data was not sent through POST method or if account ID is missing, handle accordingly
    echo "Invalid request!";
}

// Close the database connection
$conn->close();
?>
