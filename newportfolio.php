<?php
if (!function_exists('renderTable')) {
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css"> <!-- Include the external CSS file -->
</head>

<body>

    <?php



    //navbar
    echo '<div class="container-fluid p-0">';
    include 'navbar.php';
    include 'portfolionavbar.php';
    echo '</div>';

    //top row
    echo '<div class="container-fluid">';
        //folder navigation
        echo '<div class="row">';
            //Page Name
            echo '<div class="col-md-2 col-a text-center">';
            if (isset($_GET['portfolio']) && !empty($_GET['portfolio'])) {
                $portfolio = $_GET['portfolio'];
                echo $portfolio . " Portfolio";
            } else {
                echo '<h5>Portfolio Tracker</h5>';
            } 
            echo '</div>';
            //folder navigation
            echo '<div class="col-md-10 col-a">';
                include 'foldernavigation.php';
            echo '</div>';
        echo '</div>';
    echo '</div>';

    //2nd row
    echo '<div class="container-fluid max-height: 100%">';
        //sidebar left
        echo '<div class="row">';
            echo '<div class="col-2 col-a">';
                include 'sidebarleft.php';
            echo '</div>';
            //main section
            echo '<div class="col-10 col-a">';
                echo '<div class="row col-a">';
                    //main content
                    echo '<div class="col-10 col-a p-0">';
                        include 'maincontent.php';
                    echo '</div>';
                    //sidebar right
                    echo '<div class="col-2 col-a">';
                        include 'sidebarright.php';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</div>';

    ?>
    <div class="container-fluid max-height: 100%">
        <div class="row max-height: 100%">
            <!-- Sidebar -->
            <div class="col-md-2 col-a d-flex flex-column max-height: 100%">
            <?php include 'sidebarleft.php'; ?>
            </div>

            <!-- Main Section -->
            <div class="col-md-10 col-b d-flex flex-column">
                <?php include 'foldernavigation.php'; ?>


                <!-- Main content + side bar -->
                <div class="row max-height: 100%">
                    <?php include 'maincontent.php'; ?>


                    <!-- sidebar -->
                    <div class="col-md-2 col-a">
                    <?php include 'sidebarright.php'; ?>
                    </div>


                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>