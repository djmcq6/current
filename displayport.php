<!DOCTYPE html>
<html>
<head>
    <title>Portfolio</title>
</head>
<body>

<?php include 'navbar.php'; ?><br>

<?php
if (isset($_GET['portfolio']) && !empty($_GET['portfolio'])) {
    $portfolio = $_GET['portfolio'];
    echo "<h1>" . $portfolio . " Portfolio Tracker</h1>";
} else {
    echo "No variable detected";
}
    date_default_timezone_set('America/Denver'); // Set the timezone to Mountain Time
    $date = date("M d  g:i A");
    echo "<h2>Today is " . $date . "</h2>";
?>

<a href=".php?<?php echo $_SERVER['QUERY_STRING']; ?>"><button>Book Value Dashboard</button></a><br><br>
<a href="mvdb1.php?<?php echo $_SERVER['QUERY_STRING']; ?>"><button>Market Value Dashboard</button></a><br><br>

<a href="marketvaluedashboardindv.php?<?php echo $_SERVER['QUERY_STRING']; ?>"><button>Market Value Dashboard INDV</button></a><br><br>

<br><br>

<a href="cc_port.php?<?php echo $_SERVER['QUERY_STRING']; ?>"><button>Control Center</button></a><br><br>


<form>
    <label for="column">Select a Financial Statement:</label><br>
    <select name="column" id="column">
        <?php
            include 'connection.php';
            $sql = "SELECT statement_name FROM finstate";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='".$row["statement_name"]."'>".$row["statement_name"]."</option>";
                }
            } else {
                echo "<option value=''>No columns found</option>";
            }
        ?>
    </select><br><br>
</form>


<a href=".php?<?php echo $_SERVER['QUERY_STRING']; ?>"><button>Record Transaction</button></a>

<table border=1>
    <tr>
        <th>Accounts</th>
        <th>Value1</th>
        <th>Value2</th>
    </tr>

    <?php
        include 'connection.php';
        $sql = "SELECT account_name, zig FROM accounts WHERE id_finst = 1 AND zig LIKE '1%' ORDER BY zig ASC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $padding = strlen($row["zig"]) * 7.5; // Adjust the padding factor as needed
                echo '<tr><td style="padding-left:' . $padding . 'px;">' . $row["account_name"] . '</td>';
                echo '<td></td>';
                echo '<td>$value</td>';
                echo '</tr>';
            }
            echo "</table>";
        } else {
            echo '<tr><td colspan="1">You have no Accounts. Add one here <a href="form_acc.php?button=0&row=0"><button>New Account</button></a></td><td>$0.00</td><td>$0.00</td></tr>';
        }
        $conn->close();
    ?>
</table><br><br>

<table border=1>
    <tr>
        <th>Accounts</th>
        <th>Value1</th>
        <th>Value2</th>
    </tr>

    <?php
        include 'connection.php';
        $sql = "SELECT account_name, zig FROM accounts WHERE id_finst = 1 AND zig LIKE '2%' ORDER BY zig ASC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $padding = strlen($row["zig"]) * 7.5; // Adjust the padding factor as needed
                echo '<tr><td style="padding-left:' . $padding . 'px;">' . $row["account_name"] . '</td>';
                echo '<td></td>';
                echo '<td>$value</td>';
                echo '</tr>';
            }
            echo "</table>";
        } else {
            echo '<tr><td colspan="1">You have no Accounts. Add one here <a href="form_acc.php?button=0&row=0"><button>New Account</button></a></td><td>$0.00</td><td>$0.00</td></tr>';
        }
        $conn->close();
    ?>
</table><br><br>



</body>
</html>
