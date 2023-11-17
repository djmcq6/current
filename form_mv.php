<?php
include 'connection.php';

$portfolio = isset($_GET['portfolio']) ? $_GET['portfolio'] : ''; 
$portfolioID = isset($_GET['portfolioID']) ? $_GET['portfolioID'] : ''; 
$dash = isset($_GET['dash']) ? $_GET['dash'] : '';
$brokers = isset($_GET['brokers']) ? $_GET['brokers'] : '';


$sql = "SELECT broker_name FROM brokers WHERE id_portfolio = $portfolioID";
$result = $conn->query($sql);



$form_action = ".php?" . urldecode($_SERVER['QUERY_STRING']);

echo '<form action="' . $form_action . '" method="post">';
echo '<label for="brokers">Broker:</label>' . '<br>';
echo '<select id="brokers" name="brokers">';
echo '<option value="">Select Broker</option>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['broker_name'] . '">' . $row['broker_name'] . '</option>';
    }
} else {
    echo '<option value="">No brokers found</option>';
}

echo '</select>' . '<br><br>';


echo '<label for="assets">Asset Type:</label>' . '<br>';
echo '<select id="assets" name="assets">';

echo '<option value="">Select Asset</option>';
echo '<option value="">Cash</option>';
echo '<option value="">Stocks</option>';
echo '<option value="">Options</option>';
echo '</select><br><br>';

echo 'label for="';
?>
