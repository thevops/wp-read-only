<?php

if (!isset($_GET['s'])) {
    echo "<h1>Opcja nieznana</h1>";
    die();
}

define( 'WP_ADMIN', TRUE );
define( 'WP_USER_ADMIN', TRUE );

require_once( 'wp-load.php' );
require_once( 'wp-admin/includes/admin.php' );
require_once( 'wp-admin/includes/plugin.php' );

$switch = $_GET['s'];

if ($switch == "on") {
    activate_plugin( 'wp-read-only/wp-read-only.php' );
    exec('find -type f -exec chmod 0444 {} \;');
    exec('find -type d -exec chmod 0555 {} \;');    
    echo "<h1>Tryb read-only włączony</h1>";
} elseif ($switch == "off") {
    deactivate_plugins( 'wp-read-only/wp-read-only.php' );
    exec('find -type f -exec chmod 0644 {} \;');
    exec('find -type d -exec chmod 0755 {} \;');
    echo "<h1>Tryb read-only wyłączony</h1>";
} else {
    echo "<h1>Opcja nieznana</h1>";
}

sleep(2);
header("Location: " . home_url());
