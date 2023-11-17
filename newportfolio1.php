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
                include 'topsidebarleft.php';
            echo '</div>';
            //folder navigation
            echo '<div class="col-md-10 col-a">';
                include 'foldernavigation1.php';
            echo '</div>';
        echo '</div>';
    echo '</div>';

    //2nd row
    echo '<div class="container-fluid max-height: 100%">';
        //sidebar left
        echo '<div class="row">';
            echo '<div class="col-2 col-a">';
                include 'sidebarleft1.php';
            echo '</div>';
            //main section
            echo '<div class="col-10 col-a">';
                echo '<div class="row col-a">';
                    //main content
                    echo '<div class="col-10 col-a">';
                        include 'maincontent1.php';
                    echo '</div>';
                    //sidebar right
                    echo '<div class="col-2 col-a">';
                        include 'sidebarright1.php';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</div>';