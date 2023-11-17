<?php
    include 'connection.php';

    if (isset($_GET['portfolioID']) && isset($_POST['broker_name']) && isset($_POST['account_type'])) {
        $portfolioID = $_GET['portfolioID'];
        $brokerName = $_POST['broker_name'];
        $accountType = $_POST['account_type'];

        // Retrieve the id_bat from the broker_account_type table
        $sql_select_bat = "SELECT id_bat FROM broker_account_type WHERE broker_account_type = '$accountType'";
        $result_select_bat = $conn->query($sql_select_bat);
        if ($result_select_bat->num_rows > 0) {
            $row = $result_select_bat->fetch_assoc();
            $idBat = $row['id_bat'];

            $sql_insert = "INSERT INTO brokers (broker_name, id_bat, id_portfolio) VALUES ('$brokerName', '$idBat', '$portfolioID')";

            if ($conn->query($sql_insert) === TRUE) {
                $query_string = urldecode($_SERVER['QUERY_STRING']);
                header("Location: form_broker1.php?" . $query_string) . "dash=mv";
                exit();
            } else {
                echo "Error: " . $sql_insert . "<br>" . $conn->error;
            }
        } else {
            echo "No matching account type found in the database.";
        }
    } else {
        echo "Required parameters are missing. Please go back and try again.";
    }

    $conn->close();
?>
