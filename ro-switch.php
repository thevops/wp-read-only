<?php

if (!isset($_GET['s'])) {
    echo "<h1>Opcja nieznana</h1>";
    die();
}

$functions_file="wp-content/themes/enigma-parallax/functions.php";

$switch = $_GET['s'];

if ($switch == "off") {
    exec("sed -i '/wp-read-only/s/^#//g' $functions_file" );
    exec('find -type f -exec chmod 0444 {} \;');
    exec('find -type d -exec chmod 0555 {} \;');    
    echo "<h1>Możliwość edycji wyłączona</h1>";
} elseif ($switch == "on") {
    exec('find -type f -exec chmod 0644 {} \;');
    exec('find -type d -exec chmod 0755 {} \;');
    exec("sed -i '/wp-read-only/s/^/#/g' $functions_file" );
    echo "<h1>Możliwość edycji włączona</h1>";
} else {
    echo "<h1>Opcja nieznana</h1>";
}

