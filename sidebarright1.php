<?php
echo '<!-- Indicies -->
<div class="row">';
    
include 'connection.php';
include 'portTables.php'; // Include portTables.php here

$indicies = "SELECT ticker_name, current_price FROM tickers WHERE ticker_type = 'Indicies'";
$result = $conn->query($indicies);

renderTable($result, "Indicies");

$conn->close();

echo '</div>

<!-- Bonds -->
<div class="row">';
    
include 'connection.php';
include 'portTables.php'; // Include portTables.php here

$bonds = "SELECT ticker_name, current_price FROM tickers WHERE ticker_type = 'Bonds'";
$result = $conn->query($bonds);

renderTable($result, "Bonds");

$conn->close();

echo '</div>

<!-- Currency -->
<div class="row">';
    
include 'connection.php';
include 'portTables.php'; // Include portTables.php here

$currency = "SELECT ticker_name, current_price FROM tickers WHERE ticker_type = 'Currency'";
$result = $conn->query($currency);

renderTable($result, "Currency");

$conn->close();

echo '</div>

<!-- Commodity -->
<div class="row">';
    
include 'connection.php';
include 'portTables.php'; // Include portTables.php here

$commodity = "SELECT ticker_name, current_price FROM tickers WHERE ticker_type = 'Commodity Future'";
$result = $conn->query($commodity);

renderTable($result, "Commodity Future");

$conn->close();

echo '</div>

<!-- Indicies Future -->
<div class="row">';
    
include 'connection.php';
include 'portTables.php'; // Include portTables.php here

$indiciesFuture = "SELECT ticker_name, current_price FROM tickers WHERE ticker_type = 'Indicies Future'";
$result = $conn->query($indiciesFuture);

renderTable($result, "Indicies Future");

$conn->close();

echo '</div>

<!-- Bond Futures -->
<div class="row">';
    
include 'connection.php';
include 'portTables.php'; // Include portTables.php here

$bondFutures = "SELECT ticker_name, current_price FROM tickers WHERE ticker_type = 'Bond Futures'";
$result = $conn->query($bondFutures);

renderTable($result, "Bond Futures");

$conn->close();

echo '</div>';
?>
