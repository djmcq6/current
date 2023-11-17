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
    ?>

    <br><br>

    <a href="displayport.php?<?php echo $_SERVER['QUERY_STRING']; ?>"><button>Display Mode</button></a><br><br>

    <form>
        <label for="column">Select a Financial Statement:</label><br>
        <select name="column" id="column">
            <?php
            include 'connection.php';
            $sql = "SELECT statement_name FROM finstate";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["statement_name"] . "'>" . $row["statement_name"] . "</option>";
                }
            } else {
                echo "<option value=''>No columns found</option>";
            }
            ?>
        </select><br><br>
    </form>

    <a href=".php?<?php echo $_SERVER['QUERY_STRING']; ?>"><button>Record Transaction</button></a>

    <table border="1">
        <tr>
            <?php
            include 'connection.php';
            $sql = "SHOW COLUMNS FROM accounts";
            $result = $conn->query($sql);

            if ($result) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<th>" . $row['Field'] . "</th>";
                    }
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
            ?>
            <th>Add Row</th>
            <th>Add Sub Account</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Account Type</th>
            <th>Transaction Type</th>
            <th>Record Transaction</th>
            <th>Accounting</th>
        </tr>

        <?php
        include 'connection.php';
        $sql = "SELECT * FROM accounts WHERE id_finst = 1 ORDER BY zig ASC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                foreach ($row as $value) {
                    echo '<td>' . $value . '</td>';
                }
                echo '<td><a href="form_acc.php?button=1&row=' . $row['id_acc'] . '"><button>Add Row</button></td>';
                echo '<td><a href="form_acc.php?button=2&row=' . $row['id_acc'] . '"><button>Add Sub Account</button></td>';
                echo '<td><a href=".php?button=3&row=' . $row['id_acc'] . '"><button>Edit Account</button></td>';
                echo '<td><a href=".php?button=4&row=' . $row['id_acc'] . '"><button>Delete Account</button></td>';
                echo '<td><a href=".php?button=5&row=' . $row['id_acc'] . '"><button>Category / End Account</button></td>';
                echo '<td><a href=".php?button=6&row=' . $row['id_acc'] . '"><button>Transaction Type</button></td>';
                echo '<td><a href=".php?button=7&row=' . $row['id_acc'] . '"><button>Record Transaction</button></a></td>';
                echo '<td><a href=".php?button=8&row=' . $row['id_acc'] . '"><button>Book / Market</button></a></td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>
                    <td colspan="2">You have no Accounts. Add one here <a href="form_acc.php?button=0&row=0"><button>New Account</button></a></td>
                    <td><a href="form_acc.php?button=1&row=0"><button>Add Row</button></td>
                    <td><a href="form_acc.php?button=2&row=0"><button>Add Sub Account</button></td>
                </tr>';
        }
        $conn->close();
        ?>
    </table>

</body>
</html>
