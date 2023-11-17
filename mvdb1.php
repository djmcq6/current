<?php
    include 'connection.php';

    if (isset($_GET['portfolioID'])) {
        $portID = $_GET['portfolioID'];

        $sql = "SELECT broker_name FROM brokers WHERE id_portfolio = $portID";
        $result = $conn->query($sql);

        if ($result->num_rows > 1) {
            $brokers = "brokers=multi";
            $query_string = $_SERVER['QUERY_STRING'] . "&dash=mv&" . $brokers;
            header("Location: marketvaluedashboardmulti.php?" . $query_string);
            exit();
        } elseif ($result->num_rows === 1) {
            $broker = "brokers=indv";
            $query_string = $_SERVER['QUERY_STRING'] . "&dash=mv&" . $broker;
            header("Location: marketvaluedashboardindv.php?" . $query_string);
            exit();
        } else {
            $query_string = "portfolioID=$portID";
            header("Location: form_broker.php?" . $query_string);
            exit();
        }
    } else {
        echo "PortfolioID is not set in the URL.";
    }
?>
