<?php
/**
 * Trait for adding preset dropdown control to widgets.
 *
 * @package ViraSections
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Provides preset dropdown control registration for Elementor widgets.
 */
trait Vira_Sections_Preset_Trait {

	/**
	 * Register the preset selector control at the top of the Content tab.
	 *
	 * Call this method at the very beginning of register_controls().
	 */
	protected function register_preset_control() {
		$widget_name = $this->get_name();
		$options     = Vira_Sections_Presets::get_preset_options( $widget_name );

		if ( empty( $options ) ) {
			return;
		}

		$this->start_controls_section(
			'section_preset',
			array(
				'label' => 'قالب آماده',
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'vira_preset',
			array(
				'label'       => 'انتخاب قالب',
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'custom',
				'options'     => $options,
				'description' => 'با انتخاب قالب، تمام تنظیمات با داده‌های آن صفحه پر می‌شوند.',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Get the preset defaults for the currently selected preset.
	 *
	 * @return array Associative array of control_id => value, or empty array if 'custom'.
	 */
	protected function get_preset_defaults() {
		$settings    = $this->get_settings_for_display();
		$preset_slug = isset( $settings['vira_preset'] ) ? $settings['vira_preset'] : 'custom';

		if ( 'custom' === $preset_slug ) {
			return array();
		}

		$widget_name = $this->get_name();
		$presets     = Vira_Sections_Presets::get_presets( $widget_name );

		if ( isset( $presets[ $preset_slug ] ) ) {
			return $presets[ $preset_slug ];
		}

		return array();
	}
}
