<!-- ticker.php -->
<!DOCTYPE html>
<html>
<body>

<form action="php_py.php" method="post">
  Ticker: <input type="text" name="ticker"><br>
  <input type="submit" value="Submit">
</form>

<?php
if (isset($_GET['ticker'])) {
    $ticker = $_GET['ticker'];
    echo "<p>The current price of $ticker is: </p>";
    $command = escapeshellcmd('python py_php.py ' . $ticker);
    $output = shell_exec($command);
    echo "<p>$output</p>";
}
?>

</body>
</html>
