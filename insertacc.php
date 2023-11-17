<?php
include 'connection.php';

$accountName = $_POST["account_name"];
$zig = $_POST["zig"];
$column = $_POST["column"];

$sql = "INSERT INTO accounts (account_name, zig, id_finst)
        VALUES ('$accountName', '$zig', '$column')";


if ($conn->query($sql) === TRUE) {
    header("Location: displayport.php"); 
    exit();
} else {
    echo "Error: "  . $conn->error;
}

$conn->close();
?>

