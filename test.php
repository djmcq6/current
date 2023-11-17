<?php
$command = "python test.py";
exec($command, $output, $resultCode);
var_dump($output);


?>
