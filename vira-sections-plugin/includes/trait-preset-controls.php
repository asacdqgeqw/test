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
	 * Allowed HTML tags for heading/title controls.
	 *
	 * @return array
	 */
	protected function vira_tag_options() {
		return array(
			'h1'   => 'H1',
			'h2'   => 'H2',
			'h3'   => 'H3',
			'h4'   => 'H4',
			'h5'   => 'H5',
			'h6'   => 'H6',
			'div'  => 'div',
			'p'    => 'p',
			'span' => 'span',
		);
	}

	/**
	 * Sanitize a tag value against the allowlist.
	 *
	 * @param string $tag      Raw tag.
	 * @param string $fallback Fallback tag.
	 * @return string Safe tag.
	 */
	protected function vira_safe_tag( $tag, $fallback = 'h2' ) {
		$allowed = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'p', 'span' );
		$tag     = is_string( $tag ) ? strtolower( trim( $tag ) ) : '';
		return in_array( $tag, $allowed, true ) ? $tag : $fallback;
	}

	/**
	 * Register a SELECT control for choosing an HTML tag.
	 *
	 * @param string $control_id Control id (e.g. 'heading_tag').
	 * @param string $label      Control label.
	 * @param string $default    Default tag (SEO-optimal).
	 * @param array  $condition  Optional Elementor condition array.
	 */
	protected function register_tag_control( $control_id, $label, $default = 'h2', $condition = array() ) {
		$args = array(
			'label'   => $label,
			'type'    => \Elementor\Controls_Manager::SELECT,
			'default' => $default,
			'options' => $this->vira_tag_options(),
		);
		if ( ! empty( $condition ) ) {
			$args['condition'] = $condition;
		}
		$this->add_control( $control_id, $args );
	}
}
