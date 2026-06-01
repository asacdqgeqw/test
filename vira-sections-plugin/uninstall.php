<?php
/**
 * Uninstall handler for Vira Sections.
 *
 * @package ViraSections
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

global $wpdb;

// Remove plugin settings.
delete_option( 'vira_sections_settings' );

// Remove all leads (custom post type) and their meta.
$lead_ids = $wpdb->get_col(
	$wpdb->prepare(
		"SELECT ID FROM {$wpdb->posts} WHERE post_type = %s",
		'vira_lead'
	)
);
if ( ! empty( $lead_ids ) ) {
	foreach ( $lead_ids as $id ) {
		wp_delete_post( (int) $id, true );
	}
}
