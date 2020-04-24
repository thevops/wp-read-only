<?php

/*
Plugin Name: WP Read Only
Plugin URI: https://github.com/vizarch/wp-read-only
Description: Make your WordPress read only to be secure
Version: 1.0
Author: Krzysztof Łuczak
Author URI: https://luczak.pro
*/


/**
 * Credits: https://wordpress.stackexchange.com/a/243441
 * Whitelist "SELECT" and "SHOW FULL COLUMNS" queries.
 */
function my_readonly_filter( $query ) {
    global $wpdb;
  
    if ( preg_match( '/^\s*select|show full columns\s+/i', $query ) ) {
      return $query;
    }
  
    // Return arbitrary query for everything else otherwise you get 'empty query' db errors.
    return "SELECT ID from $wpdb->posts LIMIT 1;";
  }

add_filter( 'query', 'my_readonly_filter' );
