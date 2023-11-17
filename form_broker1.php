<?php
    include 'connection.php';

    if (isset($_GET['portfolioID'])) {
        $portfolioID = $_GET['portfolioID'];

        $sql = "SELECT * FROM brokers WHERE id_portfolio = '$portfolioID'";
        $result = $conn->query($sql);

        echo "<h2>Here is your current Brokers:</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Broker</th><th>Account Type</th></tr>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id_bat = $row["id_bat"];
                $sql_account_type = "SELECT broker_account_type FROM broker_account_type WHERE id_bat = '$id_bat'";
                $result_account_type = $conn->query($sql_account_type);
                $account_type = "";

                if ($result_account_type->num_rows > 0) {
                    $account_type_row = $result_account_type->fetch_assoc();
                    $account_type = $account_type_row['broker_account_type'];
                }

                echo "<tr><td>" . $row["broker_name"] . "</td><td>" . $account_type . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No Brokers Found</td></tr>";
        }
        echo "</table>";

        echo "<br><br>";
        echo "<h2>Add More Brokers Here:</h2>";
        echo '<form action="insert_broker.php?' . $_SERVER['QUERY_STRING'] . '" method="post">';
        echo 'Broker Name: <input type ="text" name="broker_name"><br>';

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
    } else {
        echo "PortfolioID not set in the URL";
    }

    $conn->close();


?>
<a href="mvdb1.php?<?php echo htmlentities($_SERVER['QUERY_STRING']); ?>"><button>Done Adding Brokers</button></a>

