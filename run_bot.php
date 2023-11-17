<!DOCTYPE html>
<html>
<head>
    <title>Run Batch File</title>
</head>
<body>
    <form method="post">
        <input type="submit" name="runBatch" value="Run Batch File">
    </form>

    <?php
if(isset($_POST['runBatch'])) {
    // Execute the batch file and capture any output or errors
    $output = shell_exec('C:\wamp64\www\test\run_bot.bat 2>&1');
    
    if ($output !== null) {
        echo "Batch file executed successfully.<br>";
        echo "<pre>$output</pre>";
    } else {
        echo "Error executing batch file.";
    }
}
?>

</body>
</html>
