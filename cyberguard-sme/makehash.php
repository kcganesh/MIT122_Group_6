// infinity free site didn't support the hash created by other default hash generator so had to create this file for infinity free. Please note that this isn't linked with another files but only for encoding process. 
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$plain = "Admin123!";
$hash = password_hash($plain, PASSWORD_DEFAULT);

echo "Plain: $plain<br>";
echo "Hash: $hash<br>";
