<?php
echo '<div class="container">';
echo '<div class="col">';
if (isset($_GET['portfolio']) && !empty($_GET['portfolio'])) {
    $portfolio = $_GET['portfolio'];
    echo '<h5>' . $portfolio . ' Portfolio</h5>';
} else {
    echo '<h5>Portfolio Tracker</h5>';
}

echo '</div>';
echo '</div>';
?>