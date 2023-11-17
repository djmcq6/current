<!DOCTYPE html>
<html>
<head>
    <title>Portfolio</title>
</head>
<body>

<?php include 'navbar.php'; ?><br>

<a href="form_port.php"><button>New Portfolio</button></a><br><br>
<table border="1">
    <?php 
    include 'connection.php'; 

    // Select all data from the "portfolio" table
    $sql = "SELECT * FROM portfolio";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<tr><td><a href="displayport.php?portfolio=' . $row["portfolio"] . '&portfolioID=' . $row["id_portfolio"] . '">' . $row["portfolio"] . '</a></td></tr>';
        }
    } else {
        echo 'You have no Portfolios add one here  <a href="form_port.php"><button>New Portfolio</button></a>';
    }
    $conn->close();
    ?>
</table>
</body>
</html>
