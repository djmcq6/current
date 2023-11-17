<?php
// Include portTables.php only if it hasn't been included before
if (!function_exists('renderTable')) {
    function renderTable($result, $tableName) {
        echo "<div class='col col-c'>";
        echo "<h5 class='text-center'>$tableName</h5>";

        if ($result->num_rows > 0) {
            echo "<table class='table-sm table-bordered'>";
            echo "<thead><tr><th class='text-center'>{$tableName} Name</th><th class='text-center'>Current Price</th></tr></thead><tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td class='text-center'>{$row['ticker_name']}</td>
                        <td class='text-center'>{$row['current_price']}</td>
                    </tr>";
            }

            echo "</tbody></table><br>";
        } else {
            echo "No data found in the 'tickers' table for '$tableName'";
        }

        echo "</div>";
    }
}

?>
