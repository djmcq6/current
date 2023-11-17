<?php
    // Check if the 'button' and 'row' variables are set in the URL
    if (isset($_GET['button']) && isset($_GET['row'])) {
        // Retrieve the values of the 'button' and 'row' variables from the URL
        $buttonClicked = $_GET['button'];
        $rowValue = $_GET['row'];

        // Establish connection and perform further actions or logic using these variables here
        include 'connection.php';

        if ($rowValue == 0) {
            $newZig = 1;
        } else {
            $sql = "SELECT zig FROM accounts WHERE id_acc = '$rowValue'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $oldZig = $result->fetch_assoc()['zig'];

                if ($buttonClicked == 1) {
                    if (strpos($oldZig, '.') !== false) {
                        $lastDotPosition = strrpos($oldZig, '.');
                        $decimalPart = substr($oldZig, $lastDotPosition + 1);
                        $newDecimalPart = intval($decimalPart) + 1;
                        $newZig = substr_replace($oldZig, strval($newDecimalPart), $lastDotPosition + 1);
                    } else {
                        $newZig = $oldZig + 1;
                    }
                } elseif ($buttonClicked == 2) {
                    if (strpos($oldZig, '.') !== false) {
                        $newZig = $oldZig . ".1";
                    } else {
                        $newZig = $oldZig . ".1";
                    }
                } else {
                    $newZig = "No Button Found";
                }
                

            }     
        }

        // Use the variables as needed within this PHP code block
        echo "Button " . $buttonClicked . "<br>";
        echo "Row: " . $rowValue;
    } else {
        echo "No variables found.";
    }
?>

<br><br>

<form action="insertacc.php" method="post">
    <label for="column">Select a Financial Statement:</label><br>
    <select name="column" id="column">
        <?php
            include 'connection.php';
            $sql = "SELECT id_finst, statement_name FROM finstate";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["id_finst"] . "'>" . $row["statement_name"] . "</option>";
                }
            } else {
                echo "<option value=''>No columns found</option>";
            }
        ?>
    </select><br><br>

    <label for="account_name">Account Name:</label><br>
    <input type="text" id="account_name" name="account_name"><br><br>

    <label for="zig">Zig:</label><br>
    <input type="text" id="zig" name="zig" value="<?php echo $newZig; ?>"><br><br>

    <input type="submit" value="Submit">
</form>
