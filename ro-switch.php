<?php

if (!isset($_GET['s'])) {
    echo "<h1>Opcja nieznana</h1>";
    die();
}

$functions_file="wp-content/themes/enigma-parallax/functions.php";

$switch = $_GET['s'];

if ($switch == "on") {
    exec("sed -i '/wp-read-only/s/^#//g' $functions_file" );
    exec('find -type f -exec chmod 0444 {} \;');
    exec('find -type d -exec chmod 0555 {} \;');    
    echo "<h1>Tryb read-only włączony</h1>";
} elseif ($switch == "off") {
    exec("sed -i '/wp-read-only/s/^/#/g' $functions_file" );
    exec('find -type f -exec chmod 0644 {} \;');
    exec('find -type d -exec chmod 0755 {} \;');
    echo "<h1>Tryb read-only wyłączony</h1>";
} else {
    echo "<h1>Opcja nieznana</h1>";
}

