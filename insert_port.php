<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $portfolio = $_POST["portfolio"];

    $sql = "INSERT INTO portfolio (portfolio) VALUES ('$portfolio')";

    if ($conn->query($sql) === FALSE) {
        echo 'Error adding Portfolio try again <a href="form_port.php"><button>New Portfolio</button></a>';
    } else {
        header("Location: newportfolio1.php?portfolio=$portfolio");
    }
}

$conn->close();
?>