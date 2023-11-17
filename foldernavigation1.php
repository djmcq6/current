<?php
// Include the file with database connection
include 'connection.php';

// Default breadcrumb path
$breadcrumb = 'Users/Derek/Portfolio';

// Check for 'zig' value in the URL
$clickedZig = $_GET['zig'] ?? '';

if (!empty($clickedZig)) {
    $zigArray = explode('.', $clickedZig);
    $currentZig = '';

    foreach ($zigArray as $zigPart) {
        $currentZig .= $zigPart;

        $getZigQuery = "SELECT account_name FROM accounts WHERE zig = '$currentZig'";
        $zigResult = $conn->query($getZigQuery);

        if ($zigResult->num_rows > 0) {
            $row = $zigResult->fetch_assoc();
            $accountName = $row['account_name'];

            // Construct breadcrumb path for each level
            $breadcrumb .= "/$accountName";
        }

        $currentZig .= '.';
    }
}

// Check for 'portfolio' variable in the URL if 'zig' is empty
if (empty($clickedZig)) {
    $portfolioName = $_GET['portfolio'] ?? '';

    if (!empty($portfolioName)) {
        $breadcrumb .= "/$portfolioName";
    }
}

echo '<!-- foldernavigation.php -->
<div class="row">
    <div class="col col-c">
        <h5 class="text-left">' . $breadcrumb . '</h5>
        <!-- Add content for the first row in column B here -->
    </div>
</div>';
?>
