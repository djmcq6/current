<div class="container p-0">
    <!-- Second Row in sidebar -->
    <div class="row text-center">
        <?php
        // Check if 'portfolio' variable exists in the GET request
        if (isset($_GET['portfolio'])) {
            $portfolioName = $_GET['portfolio'];

            if ($portfolioName === 'New') {
                // Display the form if 'portfolio' is 'New'
                echo '
                                            <form action="insert_port.php" method="post">
                                            <label for="portfolio">Portfolio:</label><br>
                                            <input type="text" id="portfolio" name="portfolio"><br><br>
                                            <input type="submit" value="Submit">
                                        </form>';
            } else {
                include 'connection.php'; // Include your database connection file

                // Step 1: Get $portfolioID from the 'portfolio' table
                $portfolioQuery = "SELECT id_portfolio FROM portfolio WHERE portfolio = '$portfolioName'";
                $portfolioResult = $conn->query($portfolioQuery);

                if ($portfolioResult->num_rows > 0) {
                    $portfolioRow = $portfolioResult->fetch_assoc();
                    $portfolioID = $portfolioRow['id_portfolio'];

                    // Step 2: Select all accounts_name from accounts where id_portfolio = $portfolioID
                    $accountsQuery = "SELECT account_name, zig FROM accounts WHERE id_portfolio = $portfolioID ORDER BY zig";
                    $accountsResult = $conn->query($accountsQuery);

                    if ($accountsResult->num_rows > 0) {
                        echo '<table border=1>';
                        while ($row = $accountsResult->fetch_assoc()) {
                            $padding = strlen($row["zig"]) * 7.5; // Adjust the padding factor as needed
                            echo '<tr><td style="padding-left:' . $padding . 'px;">' . $row["account_name"] . '</td></tr>';
                        }
                        echo '</table>';
                    } else {
                        echo '<div class="text-center">';
                        echo 'No accounts found for the selected portfolio. Start by adding your investments here.';
                        echo '<br>';
                        echo '<a href="investments.php?portfolio=' . $portfolioName . '" class="btn btn-primary">Add Investments</a>';
                        echo '</div>';
                    }
                } else {
                    echo 'Portfolio not found.';
                }

                // Close the database connection
                $conn->close();
            }
        } else {
            // If 'portfolio' doesn't exist, echo this specific HTML block
            echo '
                                        <div class="col col-c text-center">
                                            <br>
                                            <a href="newportfolio.php?portfolio=New" class="btn btn-primary">
                                                New Portfolio
                                            </a>
                                            <br><br>';

            include 'connection.php';

            // Select all data from the "portfolio" table
            $sql = "SELECT * FROM portfolio";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<div class="table-responsive">';
                echo '<table class="table table-dark table-striped">';
                echo '<tbody>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr><td><a href="newportfolio.php?portfolio=' . $row["portfolio"] . '&portfolioID=' . $row["id_portfolio"] . '">' . $row["portfolio"] . '</a></td></tr>';
                }
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            } else {
                echo 'You have no Portfolios. Add one here <a href="form_port.php"><button class="btn btn-primary">New Portfolio</button></a>';
            }
            $conn->close();
            echo '</div>'; // Close the div for the specified HTML block
        }
        ?>
    </div>
</div>