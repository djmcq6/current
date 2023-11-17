<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ticker = $_POST['ticker'];
    $command = escapeshellcmd('python py_php.py ' . $ticker);
    $output = shell_exec($command);
    header("Location: ticker.php?ticker=$ticker");
} else {
    header("Location: ticker.php");
}
?>
