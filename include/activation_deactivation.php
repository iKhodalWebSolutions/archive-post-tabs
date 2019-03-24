<?php

/**
 * Clean data on activation / deactivation
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  
 
register_activation_hook( __FILE__, 'archivesposttab_activation');

function archivesposttab_activation() {

	if( ! current_user_can ( 'activate_plugins' ) ) {
		return;
	} 
	add_option( 'archivesposttab_license_status', 'invalid' );
	add_option( 'archivesposttab_license_key', '' );
	add_option( 'archivesposttab_license_reff', '' );

}

register_uninstall_hook( __FILE__, 'archivesposttab_uninstall');

function archivesposttab_uninstall() {

	delete_option( 'archivesposttab_license_status' );
	delete_option( 'archivesposttab_license_key' );
	delete_option( 'archivesposttab_license_reff' ); 
	
}