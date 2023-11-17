<?php
include 'navbar.php';
include 'connection.php';

$portfolio = isset($_GET['portfolio']) ? $_GET['portfolio'] : ''; 
$portfolioID = isset($_GET['portfolioID']) ? $_GET['portfolioID'] : ''; 
$dash = isset($_GET['dash']) ? $_GET['dash'] : '';
$brokers = isset($_GET['brokers']) ? $_GET['brokers'] : '';

echo '<a href="displayport.php?portfolio=' . $portfolio . '&portfolioID=' . $portfolioID . '"><button>Portfolio Dashboard</button></a><br><br>';

$sql = "SELECT id_broker, broker_name FROM brokers WHERE id_portfolio = $portfolioID";
$result = $conn->query($sql);

echo '<table border="1">';
echo '<tr><th>Brokers</th></tr>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr><td><a href="marketvaluedashboardindv.php?portfolio=' . $portfolio . '&portfolioID=' . $portfolioID . '&dash=' . $dash . '&brokers=' . $brokers . '&brokerName=' . $row['broker_name'] . '&brokerID=' . $row['id_broker'] . '">' . $row['broker_name'] . '</a></td></tr>';
    }
} else {
    echo '<tr><td>No brokers found</td></tr>';
}

echo '</table><br><br>';

echo '<a href="form_mv.php?portfolio=' . $portfolio . '&portfolioID=' . $portfolioID . '&dash=' . $dash . '&brokers=' . $brokers . '"><button>Record Transaction</button></a>';
?>
