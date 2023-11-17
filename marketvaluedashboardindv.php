<?php
include 'connection.php';

$portfolio = isset($_GET['portfolio']) ? $_GET['portfolio'] : ''; 
$portfolioID = isset($_GET['portfolioID']) ? $_GET['portfolioID'] : ''; 
$dash = isset($_GET['dash']) ? $_GET['dash'] : '';
$brokers = isset($_GET['brokers']) ? $_GET['brokers'] : '';
$brokerName = isset($_GET['brokerName']) ? $_GET['brokerName'] : '';
$brokerID = isset($_GET['brokerID']) ? $_GET['brokerID'] : '';


echo '<a href="displayport.php?portfolio=' . $portfolio . '&portfolioID=' . $portfolioID . '"><button>Portfolio Dashboard</button></a><br><br>';
    
echo '<a href="marketvaluedashboardmulti.php?portfolio=' . $portfolio . '&portfolioID=' . $portfolioID . '&dash=' . $dash . '&brokers=' . $brokers . '"><button>Securities Dashboard</button></a><br><br>';

echo "$brokerName Broker Account <br><br>";


$sql = "SELECT assets FROM mvassets WHERE id_portfolio = $portfolioID AND id_broker = $brokerID";
    $result = $conn->query($sql);

    echo '<table border="1">';
    echo '<tr><th>Assets</th></tr>';

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr><td><a href="marketvaluedashboardindv.php?portfolio=' . $portfolio . '&portfolioID=' . $portfolioID . '&dash=' . $dash . '&brokers=' . $brokers . '&brokerName=' . $row['broker_name'] . '">' . $row['broker_name'] . '</a></td></tr>';
        }
    } else {
        echo '<tr><td>No assets found</td></tr>';
    }

    echo '</table><br><br>';
?>
