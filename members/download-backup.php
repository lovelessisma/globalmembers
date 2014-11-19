<?php
//Set the time out
require 'common/functions.php';

$filename = isset($_GET['filename']) ? $_GET['filename'] : '';
set_time_limit(0);

output_file(stripslashes($filename));
?>