<?php

// Check if 'form' variable exists in the GET request
if (isset($_GET['form'])) {
    $formValue = $_GET['form'];

    if ($formValue === 'portfolio') {
        // Display the form if 'form' is 'portfolio'
        echo '
        <form action="insert_port.php" method="post">
            <label for="portfolio">Portfolio:</label><br>
            <input type="text" id="portfolio" name="portfolio"><br><br>
            <input type="submit" value="Submit">
        </form>';
    } elseif ($formValue === 'delete') {
        // Add logic to handle delete functionality
        if (isset($_GET['zig'])) {
            $zigValue = $_GET['zig'];

            // Fetch the row from the accounts table based on 'zig' value
            $getAccountQuery = "SELECT * FROM accounts WHERE zig = '$zigValue'";
            $accountResult = $conn->query($getAccountQuery);

            if ($accountResult->num_rows > 0) {
                $row = $accountResult->fetch_assoc();

                // Display the details for deletion
                // Display the details for deletion
                echo '<div class="container">';
                echo '<h5>Delete Account</h2>';
                echo '<p>Account Name: ' . $row['account_name'] . '</p>';
                echo '<p>Zig: ' . $row['zig'] . '</p>';
                echo '<p>Portfolio ID: ' . $row['id_portfolio'] . '</p>';
                echo '<p>Transaction Account: ' . $row['transactionAccountType'] . '</p>';
                echo '<form action="delete_accounts.php" method="POST">';
                echo '<input type="hidden" name="accountId" value="' . $row['id_acc'] . '">';
                // Place the hidden input fields here, within the form block
                if (isset($_GET['portfolio']) && isset($_GET['view']) && isset($_GET['zig'])) {
                    $portfolioValue = $_GET['portfolio'] ?? '';
                    echo '<input type="hidden" name="portfolio" value="' . htmlspecialchars($portfolioValue) . '">';
                    echo '<input type="hidden" name="view" value="' . $_GET['view'] . '">';
                    echo '<input type="hidden" name="zig" value="' . $_GET['zig'] . '">';
                }
                echo '<input type="submit" value="Confirm Delete" class="btn btn-danger">';
                echo '<a href="newportfolio1.php?portfolio=' . urlencode($_GET['portfolio']) . '&view=TRUE&zig=' . $_GET['zig'] . '" class="btn btn-secondary">Cancel</a>';
                echo '</form>';
                echo '</div>';
            } else {
                echo "Account not found";
            }
        } else {
            echo "Zig value not provided";
        }
    } elseif ($formValue === 'edit') {
        // Add the 'Edit' form handling logic here
        if (isset($_GET['zig'])) {
            $zigValue = $_GET['zig'];

            // Fetch the row from the accounts table based on 'zig' value
            $getAccountQuery = "SELECT * FROM accounts WHERE zig = '$zigValue'";
            $accountResult = $conn->query($getAccountQuery);

            if ($accountResult->num_rows > 0) {
                $row = $accountResult->fetch_assoc();

                // Display the form to edit the selected row
                echo '<div class="container">';
                echo '<form action="edit_accounts.php" method="POST">';
                echo '<div class="row">';
                echo '<div class="col">';
                echo '<label for="accountName">Account Name:</label>';
                echo '<input type="hidden" name="accountId" value="' . $row['id_acc'] . '">';
                echo '<input type="text" name="accountName" value="' . $row['account_name'] . '" class="form-control">';
                echo '<br>';
                echo '</div>';
                echo '</div>';

                echo '<div class="row">';
                echo '<div class="col">';
                echo '<label for="zig">Zig:</label>';
                echo '<input type="text" name="zig" value="' . $row['zig'] . '" class="form-control">';
                echo '<br>';
                echo '</div>';
                echo '</div>';

                echo '<div class="row">';
                echo '<div class="col">';
                echo '<label for="idPortfolio">Portfolio ID:</label>';
                echo '<input type="text" name="idPortfolio" value="' . $row['id_portfolio'] . '" class="form-control">';
                echo '<br>';
                echo '</div>';
                echo '</div>';

                echo '<div class="row">';
                echo '<div class="col">';
                echo '<label for="transactionAccountType">Transaction Account:</label>';
                echo '<input type="text" name="transactionAccountType" value="' . $row['transactionAccountType'] . '" class="form-control">';
                echo '<br>';
                echo '</div>';
                echo '</div>';

                if (isset($_GET['portfolio']) && isset($_GET['view']) && isset($_GET['zig'])) {
                    $portfolioValue = $_GET['portfolio'] ?? ''; // Get the 'portfolio' value or set default
                    echo '<input type="hidden" name="portfolio" value="' . htmlspecialchars($portfolioValue) . '">';
                    echo '<input type="hidden" name="view" value="' . $_GET['view'] . '">';
                    echo '<input type="hidden" name="zig" value="' . $_GET['zig'] . '">';
                }

                // Include other input fields for editing

                echo '<div class="row">';
                echo '<div class="col">';
                echo '<br>';
                echo '<input type="submit" value="Save" class="btn btn-primary">';
                echo '<a href="newportfolio1.php?portfolio=' . urlencode($_GET['portfolio']) . '&view=TRUE&zig=' . $_GET['zig'] . '" class="btn btn-secondary">Cancel</a>';
                echo '<br>';
                echo '<br>';
                echo '</div>';
                echo '</div>';
                echo '</form>';
                echo '</div>';
            } else {
                echo "Account not found";
            }
        } else {
            echo "Zig value not provided";
        }
    } elseif ($formValue === 'transaction'){
        
 } else {
        // Display the default HTML block if 'form' has an unexpected value
        echo '<div class="col col-c text-center">
        <br>
        <a href="newportfolio1.php?form=portfolio" class="btn btn-primary">
            New Portfolio
        </a>
        <br><br>';
    }
} elseif (isset($_GET['portfolio'])) {
    // Check if 'portfolio' variable exists
    $portfolioValue = $_GET['portfolio'];

    // Check if 'view' variable exists
    $view = isset($_GET['view']) ? $_GET['view'] : '';

    if (!$view) {
        // If 'view' variable doesn't exist, create an 'Edit' button
        echo '<div class="col col-c text-center"><br>';
        echo '<a href="newportfolio1.php?portfolio=' . urlencode($portfolioValue) . '&view=TRUE" class="btn btn-secondary">Control Center</a><br><br>';
        echo '</div>';
    } else {
        // If 'view' variable exists, create a 'View' button
        echo '<div class="col col-c text-center"><br>';
        echo '<a href="newportfolio1.php?portfolio=' . urlencode($portfolioValue) . '" class="btn btn-secondary">Display View</a><br><br>';
        echo '</div>';
    }
} else {
    // Display the default HTML block if 'form' doesn't exist
    echo '<div class="col col-c text-center">
            <br>
            <a href="newportfolio1.php?form=portfolio" class="btn btn-primary">
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
            echo '<tr><td><a href="newportfolio1.php?portfolio=' . $row["portfolio"] . '&portfolioID=' . $row["id_portfolio"] . '">' . $row["portfolio"] . '</a></td></tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    } else {
        echo '';
    }
    $conn->close();
    echo '</div>'; // Close the div for the specified HTML block
}
