<?php
/**
 * Uninstall handler for Vira Sections.
 *
 * @package ViraSections
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Remove plugin settings.
delete_option( 'vira_sections_settings' );
