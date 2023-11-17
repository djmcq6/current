<?php
    include 'connection.php';

    if (isset($_GET['portfolioID'])) {
        $portfolioID = $_GET['portfolioID'];

        $sql = "SELECT * FROM brokers WHERE id_portfolio = '$portfolioID'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $query_string = urldecode($_SERVER['QUERY_STRING']);
            if (strpos($query_string, 'dash=mv') === false) {
                $query_string .= "dash=mv";
            }
            header("Location: mvdb1.php?" . $query_string);
            exit();
        } else {
            echo "Looks like you don't have a broker account set up, add one now.";
            echo '<br><br>';
            $form_action = "insert_broker.php?" . urldecode($_SERVER['QUERY_STRING']);
            echo '<form action="' . $form_action . '" method="post">';
            echo 'Broker Name: <input type="text" name="broker_name"><br>';

            $sql_account_type = "SELECT id_bat, broker_account_type FROM broker_account_type";
            $result_account_type = $conn->query($sql_account_type);

            echo 'Account Type: <select name="account_type">';
            if ($result_account_type->num_rows > 0) {
                while ($row = $result_account_type->fetch_assoc()) {
                    echo '<option value="' . $row['broker_account_type'] . '">' . $row['broker_account_type'] . '</option>';
                }
            } else {
                echo '<option value="">No account types found</option>';
            }
            echo '</select><br>';
            echo '<button type="submit">Submit</button>';
            echo '</form>';
        }
    } else {
        header("portfolio.php");
    }

    $conn->close();
?>
