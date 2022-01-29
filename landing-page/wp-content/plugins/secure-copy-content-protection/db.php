<?php
global $wpdb;
if( ! defined( 'SCCP_DB_VERSION' ) )
    define( 'SCCP_DB_VERSION', '1.4.4' );

if( ! defined( 'SCCP_TABLE' ) )
    define( 'SCCP_TABLE', $wpdb->prefix . 'ays_sccp' );

if( ! defined( 'SCCP_CHARSET' ) )
    define( 'SCCP_CHARSET', $wpdb->get_charset_collate() );