<?php
if (isset($_GET['zig'])) {
    $zigValue = $_GET['zig'];

    // Fetch the row from the accounts table based on 'zig' value
    $getAccountQuery = "SELECT * FROM accounts WHERE zig = '$zigValue'";
    $accountResult = $conn->query($getAccountQuery);

    if ($accountResult) {
        if ($accountResult->num_rows > 0) {
            $row = $accountResult->fetch_assoc();
            echo "Account 1: " . $row['account_name'];
        } else {
            echo "No account found for zig = $zigValue";
        }
    } else {
        // Handle query execution errors
        echo "Error executing the query: " . $conn->error;
    }
}
?>
