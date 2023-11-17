<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action=".php" method="post">
    <table border="1">
        <tr>
            <th>Date</th>
            <th>Account</th>
            <th>Debit</th>
            <th>Credit</th>
        </tr>
        <tr>
            <td><input type="date" id="date" name="date" placeholder="Date"></td>

            <td>
                <?php
                    include 'connection.php';

                    $sql = "SELECT account_name FROM accounts WHERE account_type = 'End Account'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo '<select name="account" id="account">';
                        echo '<option>Select Account</option>';
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["account_name"] . '">' . $row["account_name"] . '</option>';
                        }
                        echo '</select>';
                    } else {
                        echo "No results found";
                    }

                    $conn->close();
                ?>
            </td>

            <td><input type="text" id="amount1" name="amount1" placeholder="Amount"></td>

            <td></td>
        </tr>
        <tr>
            <td>
                <?php
                    echo 'Date 1';
                ?>
            </td>

            <td>
                <?php
                    include 'connection.php';

                    $sql = "SELECT account_name FROM accounts WHERE account_type = 'End Account'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo '<select name="account" id="account">';
                        echo '<option>Select Account</option>';
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["account_name"] . '">' . $row["account_name"] . '</option>';
                        }
                        
                        echo '</select>';
                    } else {
                        echo "No results found";
                    }

                    $conn->close();
                ?>
            </td>
            
            <td></td>

            <td><input type="text" id="amount1" name="amount1" placeholder="Amount"></td>
        </tr>
    </table>
    <a href=".php"><button>Add Row</button></a>
    <input type="submit" value="Submit">
</form>

</body>
</html>
