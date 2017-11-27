<?php
# magic
if( !defined('ABSPATH') ) die('Bad dog. No biscuit!');

/**
 * This hack avoid files cache in WP 4.9
 * @author Jose Lazo
 */
add_filter('init', function() {

    $theme_root = dirname(__DIR__);
    $stylesheet = basename(__DIR__);

    $theme = wp_get_theme( $stylesheet, $theme_root );
    $theme_version = $theme["Version"];

    $cache_hash = md5( $theme_root. '/' . $stylesheet );

    $label = sanitize_key( 'files_' . $cache_hash . '-' . $theme_version );
    $transient_key = substr( $label, 0, 29 ) . md5( $label );

    delete_transient($transient_key);

});