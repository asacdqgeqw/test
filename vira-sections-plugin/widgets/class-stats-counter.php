<?php
/**
 * Vira Sections — Stats Counter + Compare Widget
 *
 * Animated counter cards (4 by default) plus an optional Before/After
 * comparison panel with toggle tabs that swap data sets.
 *
 * @package ViraSections
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Vira_Sections_Widget_Stats_Counter
 */
class Vira_Sections_Widget_Stats_Counter extends \Elementor\Widget_Base {

	public function get_name() {
		return 'vira_stats_counter';
	}

	public function get_title() {
		return __( 'Stats Counter + Compare (Vira)', 'vira-sections' );
	}

	public function get_icon() {
		return 'eicon-counter';
	}

	public function get_categories() {
		return array( 'vira-sections' );
	}

	public function get_keywords() {
		return array( 'vira', 'stats', 'counter', 'compare', 'before', 'after', 'kpi', 'seo' );
	}

	/**
	 * Register controls.
	 */
	protected function register_controls() {

		/* ============================================================
		 * Section Header
		 * ============================================================ */
		$this->start_controls_section(
			'section_header',
			array(
				'label' => __( 'Section Header', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'eyebrow',
			array(
				'label'   => __( 'Eyebrow Text', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'نتایج واقعی', 'vira-sections' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'اعدادی که <em>خودشان حرف می‌زنند</em>', 'vira-sections' ),
				'label_block' => true,
				'description' => __( 'Wrap highlighted words in &lt;em&gt;...&lt;/em&gt; for accent color.', 'vira-sections' ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'این‌ها فقط آمار نیستند — هر عدد نتیجه ماه‌ها کار تخصصی تیم سئو ما روی سایت‌های واقعی است.', 'vira-sections' ),
				'rows'    => 3,
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * Counters Repeater
		 * ============================================================ */
		$this->start_controls_section(
			'section_counters',
			array(
				'label' => __( 'Counter Cards', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$counter_rep = new \Elementor\Repeater();

		$counter_rep->add_control(
			'icon',
			array(
				'label'   => __( 'Icon', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-chart-line',
					'library' => 'fa-solid',
				),
			)
		);

		$counter_rep->add_control(
			'number_value',
			array(
				'label'   => __( 'Number Value', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 100,
				'min'     => 0,
				'max'     => 9999999,
			)
		);

		$counter_rep->add_control(
			'suffix',
			array(
				'label'   => __( 'Suffix', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( '+', 'vira-sections' ),
			)
		);

		$counter_rep->add_control(
			'label',
			array(
				'label'   => __( 'Label', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'برچسب', 'vira-sections' ),
			)
		);

		$this->add_control(
			'counters',
			array(
				'label'       => __( 'Counters', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $counter_rep->get_controls(),
				'title_field' => '{{{ label }}}',
				'default'     => array(
					array(
						'icon'         => array( 'value' => 'fas fa-search', 'library' => 'fa-solid' ),
						'number_value' => 850,
						'suffix'       => __( '+', 'vira-sections' ),
						'label'        => __( 'کلمه کلیدی رتبه‌بندی شده', 'vira-sections' ),
					),
					array(
						'icon'         => array( 'value' => 'fas fa-chart-line', 'library' => 'fa-solid' ),
						'number_value' => 340,
						'suffix'       => __( '٪', 'vira-sections' ),
						'label'        => __( 'میانگین رشد ترافیک', 'vira-sections' ),
					),
					array(
						'icon'         => array( 'value' => 'fas fa-file-alt', 'library' => 'fa-solid' ),
						'number_value' => 12500,
						'suffix'       => __( '+', 'vira-sections' ),
						'label'        => __( 'صفحه ایندکس شده', 'vira-sections' ),
					),
					array(
						'icon'         => array( 'value' => 'fas fa-shield-alt', 'library' => 'fa-solid' ),
						'number_value' => 45,
						'suffix'       => __( '+', 'vira-sections' ),
						'label'        => __( 'افزایش Domain Authority', 'vira-sections' ),
					),
				),
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * Compare Section
		 * ============================================================ */
		$this->start_controls_section(
			'section_compare',
			array(
				'label' => __( 'Compare (Before/After)', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_compare',
			array(
				'label'        => __( 'Show Compare Section', 'vira-sections' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'compare_title',
			array(
				'label'     => __( 'Compare Title', 'vira-sections' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => __( 'مقایسه قبل و بعد از سئو', 'vira-sections' ),
				'condition' => array( 'show_compare' => 'yes' ),
			)
		);

		$this->add_control(
			'before_badge',
			array(
				'label'     => __( 'Before Badge Label', 'vira-sections' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => __( 'قبل از سئو', 'vira-sections' ),
				'condition' => array( 'show_compare' => 'yes' ),
			)
		);

		$this->add_control(
			'after_badge',
			array(
				'label'     => __( 'After Badge Label', 'vira-sections' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => __( 'بعد از ۶ ماه سئو', 'vira-sections' ),
				'condition' => array( 'show_compare' => 'yes' ),
			)
		);

		// Sub-repeaters: before / after metric pairs (5 each).
		$metric_sub = new \Elementor\Repeater();
		$metric_sub->add_control(
			'metric_label',
			array(
				'label'   => __( 'Label', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'برچسب متریک', 'vira-sections' ),
			)
		);
		$metric_sub->add_control(
			'metric_value',
			array(
				'label'   => __( 'Value', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( '۰', 'vira-sections' ),
			)
		);

		// Tabs repeater (each contains its own before & after sub-repeaters).
		$tab_rep = new \Elementor\Repeater();

		$tab_rep->add_control(
			'tab_slug',
			array(
				'label'   => __( 'Tab Slug (unique)', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'organic', 'vira-sections' ),
			)
		);

		$tab_rep->add_control(
			'tab_label',
			array(
				'label'   => __( 'Tab Label', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'ترافیک ارگانیک', 'vira-sections' ),
			)
		);

		$tab_rep->add_control(
			'before_metrics',
			array(
				'label'       => __( 'Before Metrics', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $metric_sub->get_controls(),
				'title_field' => '{{{ metric_label }}}',
				'default'     => array(
					array( 'metric_label' => __( 'ترافیک ماهانه', 'vira-sections' ),    'metric_value' => __( '۱,۲۰۰', 'vira-sections' ) ),
					array( 'metric_label' => __( 'صفحات ایندکس', 'vira-sections' ),     'metric_value' => __( '۲۳', 'vira-sections' ) ),
					array( 'metric_label' => __( 'کلمات صفحه اول', 'vira-sections' ),    'metric_value' => __( '۲', 'vira-sections' ) ),
					array( 'metric_label' => __( 'نرخ کلیک (CTR)', 'vira-sections' ),    'metric_value' => __( '۱.۲٪', 'vira-sections' ) ),
					array( 'metric_label' => __( 'Domain Authority', 'vira-sections' ),  'metric_value' => __( '۱۲', 'vira-sections' ) ),
				),
			)
		);

		$tab_rep->add_control(
			'after_metrics',
			array(
				'label'       => __( 'After Metrics', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $metric_sub->get_controls(),
				'title_field' => '{{{ metric_label }}}',
				'default'     => array(
					array( 'metric_label' => __( 'ترافیک ماهانه', 'vira-sections' ),    'metric_value' => __( '۱۸,۶۰۰', 'vira-sections' ) ),
					array( 'metric_label' => __( 'صفحات ایندکس', 'vira-sections' ),     'metric_value' => __( '۱۵۶', 'vira-sections' ) ),
					array( 'metric_label' => __( 'کلمات صفحه اول', 'vira-sections' ),    'metric_value' => __( '۵۸', 'vira-sections' ) ),
					array( 'metric_label' => __( 'نرخ کلیک (CTR)', 'vira-sections' ),    'metric_value' => __( '۸.۴٪', 'vira-sections' ) ),
					array( 'metric_label' => __( 'Domain Authority', 'vira-sections' ),  'metric_value' => __( '۴۵', 'vira-sections' ) ),
				),
			)
		);

		$this->add_control(
			'compare_tabs',
			array(
				'label'       => __( 'Compare Tabs', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $tab_rep->get_controls(),
				'title_field' => '{{{ tab_label }}}',
				'condition'   => array( 'show_compare' => 'yes' ),
				'default'     => array(
					array(
						'tab_slug'       => 'organic',
						'tab_label'      => __( 'ترافیک ارگانیک', 'vira-sections' ),
						'before_metrics' => array(
							array( 'metric_label' => __( 'ترافیک ماهانه', 'vira-sections' ),    'metric_value' => __( '۱,۲۰۰', 'vira-sections' ) ),
							array( 'metric_label' => __( 'صفحات ایندکس', 'vira-sections' ),     'metric_value' => __( '۲۳', 'vira-sections' ) ),
							array( 'metric_label' => __( 'کلمات صفحه اول', 'vira-sections' ),    'metric_value' => __( '۲', 'vira-sections' ) ),
							array( 'metric_label' => __( 'نرخ کلیک (CTR)', 'vira-sections' ),    'metric_value' => __( '۱.۲٪', 'vira-sections' ) ),
							array( 'metric_label' => __( 'Domain Authority', 'vira-sections' ),  'metric_value' => __( '۱۲', 'vira-sections' ) ),
						),
						'after_metrics' => array(
							array( 'metric_label' => __( 'ترافیک ماهانه', 'vira-sections' ),    'metric_value' => __( '۱۸,۶۰۰', 'vira-sections' ) ),
							array( 'metric_label' => __( 'صفحات ایندکس', 'vira-sections' ),     'metric_value' => __( '۱۵۶', 'vira-sections' ) ),
							array( 'metric_label' => __( 'کلمات صفحه اول', 'vira-sections' ),    'metric_value' => __( '۵۸', 'vira-sections' ) ),
							array( 'metric_label' => __( 'نرخ کلیک (CTR)', 'vira-sections' ),    'metric_value' => __( '۸.۴٪', 'vira-sections' ) ),
							array( 'metric_label' => __( 'Domain Authority', 'vira-sections' ),  'metric_value' => __( '۴۵', 'vira-sections' ) ),
						),
					),
					array(
						'tab_slug'       => 'rankings',
						'tab_label'      => __( 'رتبه‌بندی', 'vira-sections' ),
						'before_metrics' => array(
							array( 'metric_label' => __( 'میانگین رتبه', 'vira-sections' ),       'metric_value' => __( 'صفحه ۵+', 'vira-sections' ) ),
							array( 'metric_label' => __( 'کلمات Top 3', 'vira-sections' ),         'metric_value' => __( '۰', 'vira-sections' ) ),
							array( 'metric_label' => __( 'کلمات صفحه اول', 'vira-sections' ),     'metric_value' => __( '۲', 'vira-sections' ) ),
							array( 'metric_label' => __( 'نرخ ایندکس', 'vira-sections' ),          'metric_value' => __( '۱۲٪', 'vira-sections' ) ),
							array( 'metric_label' => __( 'Featured Snippets', 'vira-sections' ),   'metric_value' => __( 'غیرفعال', 'vira-sections' ) ),
						),
						'after_metrics' => array(
							array( 'metric_label' => __( 'میانگین رتبه', 'vira-sections' ),       'metric_value' => __( 'صفحه ۱', 'vira-sections' ) ),
							array( 'metric_label' => __( 'کلمات Top 3', 'vira-sections' ),         'metric_value' => __( '۱۲', 'vira-sections' ) ),
							array( 'metric_label' => __( 'کلمات صفحه اول', 'vira-sections' ),     'metric_value' => __( '۵۸', 'vira-sections' ) ),
							array( 'metric_label' => __( 'نرخ ایندکس', 'vira-sections' ),          'metric_value' => __( '۸۹٪', 'vira-sections' ) ),
							array( 'metric_label' => __( 'Featured Snippets', 'vira-sections' ),   'metric_value' => __( 'فعال و بهینه', 'vira-sections' ) ),
						),
					),
					array(
						'tab_slug'       => 'revenue',
						'tab_label'      => __( 'درآمد', 'vira-sections' ),
						'before_metrics' => array(
							array( 'metric_label' => __( 'درآمد ماهانه (تومان)', 'vira-sections' ), 'metric_value' => __( '۲.۱M', 'vira-sections' ) ),
							array( 'metric_label' => __( 'نرخ تبدیل', 'vira-sections' ),            'metric_value' => __( '۰.۸٪', 'vira-sections' ) ),
							array( 'metric_label' => __( 'لید ارگانیک', 'vira-sections' ),          'metric_value' => __( '۱۵', 'vira-sections' ) ),
							array( 'metric_label' => __( 'بازدید ارگانیک', 'vira-sections' ),       'metric_value' => __( '۱۲,۰۰۰', 'vira-sections' ) ),
							array( 'metric_label' => __( 'فروش مستقیم SEO', 'vira-sections' ),       'metric_value' => __( 'ندارد', 'vira-sections' ) ),
						),
						'after_metrics' => array(
							array( 'metric_label' => __( 'درآمد ماهانه (تومان)', 'vira-sections' ), 'metric_value' => __( '۲۸.۵M', 'vira-sections' ) ),
							array( 'metric_label' => __( 'نرخ تبدیل', 'vira-sections' ),            'metric_value' => __( '۳.۲٪', 'vira-sections' ) ),
							array( 'metric_label' => __( 'لید ارگانیک', 'vira-sections' ),          'metric_value' => __( '۱۸۰+', 'vira-sections' ) ),
							array( 'metric_label' => __( 'بازدید ارگانیک', 'vira-sections' ),       'metric_value' => __( '۱۵۶,۰۰۰', 'vira-sections' ) ),
							array( 'metric_label' => __( 'فروش مستقیم SEO', 'vira-sections' ),       'metric_value' => __( 'فعال', 'vira-sections' ) ),
						),
					),
				),
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * STYLE — Section
		 * ============================================================ */
		$this->start_controls_section(
			'style_section',
			array(
				'label' => __( 'Section', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'section_padding',
			array(
				'label'      => __( 'Section Padding (Vertical)', 'vira-sections' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => 40, 'max' => 200 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 100 ),
			)
		);

		$this->add_control(
			'bg_grad_from',
			array(
				'label'   => __( 'Background — Top', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
			)
		);

		$this->add_control(
			'bg_grad_to',
			array(
				'label'   => __( 'Background — Bottom', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#FAF6EC',
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * STYLE — Counter Card
		 * ============================================================ */
		$this->start_controls_section(
			'style_card',
			array(
				'label' => __( 'Counter Card', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'accent_color',
			array(
				'label'   => __( 'Accent Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#22c55e',
			)
		);

		$this->add_control(
			'card_bg',
			array(
				'label'   => __( 'Card Background', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
			)
		);

		$this->add_control(
			'card_top_grad_from',
			array(
				'label'   => __( 'Card Top Accent — From', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#22c55e',
			)
		);

		$this->add_control(
			'card_top_grad_to',
			array(
				'label'   => __( 'Card Top Accent — To', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#128BE0',
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * STYLE — Compare
		 * ============================================================ */
		$this->start_controls_section(
			'style_compare',
			array(
				'label'     => __( 'Compare Panels', 'vira-sections' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => array( 'show_compare' => 'yes' ),
			)
		);

		$this->add_control(
			'before_color',
			array(
				'label'   => __( 'Before Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#DC2626',
			)
		);

		$this->add_control(
			'after_color',
			array(
				'label'   => __( 'After Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#16A34A',
			)
		);

		$this->add_control(
			'toggle_active_grad_from',
			array(
				'label'   => __( 'Toggle Active — From', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#22c55e',
			)
		);

		$this->add_control(
			'toggle_active_grad_to',
			array(
				'label'   => __( 'Toggle Active — To', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#16A34A',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render frontend output.
	 */
	protected function render() {
		$settings  = $this->get_settings_for_display();
		$unique_id = 'vira-stats-' . $this->get_id();

		$pad        = ! empty( $settings['section_padding']['size'] ) ? (int) $settings['section_padding']['size'] : 100;
		$bg_from    = ! empty( $settings['bg_grad_from'] ) ? $settings['bg_grad_from'] : '#FFFFFF';
		$bg_to      = ! empty( $settings['bg_grad_to'] ) ? $settings['bg_grad_to'] : '#FAF6EC';
		$accent     = ! empty( $settings['accent_color'] ) ? $settings['accent_color'] : '#22c55e';
		$card_bg    = ! empty( $settings['card_bg'] ) ? $settings['card_bg'] : '#FFFFFF';
		$top_from   = ! empty( $settings['card_top_grad_from'] ) ? $settings['card_top_grad_from'] : '#22c55e';
		$top_to     = ! empty( $settings['card_top_grad_to'] ) ? $settings['card_top_grad_to'] : '#128BE0';
		$before_c   = ! empty( $settings['before_color'] ) ? $settings['before_color'] : '#DC2626';
		$after_c    = ! empty( $settings['after_color'] ) ? $settings['after_color'] : '#16A34A';
		$togg_from  = ! empty( $settings['toggle_active_grad_from'] ) ? $settings['toggle_active_grad_from'] : '#22c55e';
		$togg_to    = ! empty( $settings['toggle_active_grad_to'] ) ? $settings['toggle_active_grad_to'] : '#16A34A';

		$counters     = ! empty( $settings['counters'] ) && is_array( $settings['counters'] ) ? $settings['counters'] : array();
		$show_compare = ! empty( $settings['show_compare'] ) && 'yes' === $settings['show_compare'];
		$tabs         = ! empty( $settings['compare_tabs'] ) && is_array( $settings['compare_tabs'] ) ? $settings['compare_tabs'] : array();

		// Build a JS-friendly data dictionary keyed by slug.
		$data_js = array();
		foreach ( $tabs as $t ) {
			$slug = ! empty( $t['tab_slug'] ) ? sanitize_title( $t['tab_slug'] ) : '';
			if ( '' === $slug ) {
				continue;
			}
			$labels = array();
			$before = array();
			$after  = array();
			if ( ! empty( $t['before_metrics'] ) && is_array( $t['before_metrics'] ) ) {
				foreach ( $t['before_metrics'] as $m ) {
					$labels[] = isset( $m['metric_label'] ) ? (string) $m['metric_label'] : '';
					$before[] = isset( $m['metric_value'] ) ? (string) $m['metric_value'] : '';
				}
			}
			if ( ! empty( $t['after_metrics'] ) && is_array( $t['after_metrics'] ) ) {
				$i = 0;
				foreach ( $t['after_metrics'] as $m ) {
					// Prefer "after" labels if before list was shorter, otherwise keep before-labels.
					if ( ! isset( $labels[ $i ] ) || '' === $labels[ $i ] ) {
						$labels[ $i ] = isset( $m['metric_label'] ) ? (string) $m['metric_label'] : '';
					}
					$after[] = isset( $m['metric_value'] ) ? (string) $m['metric_value'] : '';
					$i++;
				}
			}
			$data_js[ $slug ] = array(
				'labels' => $labels,
				'before' => $before,
				'after'  => $after,
			);
		}
		?>
		<style>
			#<?php echo esc_attr( $unique_id ); ?>{
				--vira-pad: <?php echo (int) $pad; ?>px;
				--vira-bg-from: <?php echo esc_attr( $bg_from ); ?>;
				--vira-bg-to: <?php echo esc_attr( $bg_to ); ?>;
				--vira-accent: <?php echo esc_attr( $accent ); ?>;
				--vira-card-bg: <?php echo esc_attr( $card_bg ); ?>;
				--vira-top-from: <?php echo esc_attr( $top_from ); ?>;
				--vira-top-to: <?php echo esc_attr( $top_to ); ?>;
				--vira-before: <?php echo esc_attr( $before_c ); ?>;
				--vira-after: <?php echo esc_attr( $after_c ); ?>;
				--vira-togg-from: <?php echo esc_attr( $togg_from ); ?>;
				--vira-togg-to: <?php echo esc_attr( $togg_to ); ?>;
			}
			#<?php echo esc_attr( $unique_id ); ?>.vira-stats{
				padding: var(--vira-pad) 24px 80px;
				background: linear-gradient(180deg, var(--vira-bg-from) 0%, var(--vira-bg-to) 100%);
				font-family:'Vazirmatn','IRANSans',Tahoma,sans-serif;direction:rtl;color:#1D2327;
				position:relative;overflow:hidden;
			}
			#<?php echo esc_attr( $unique_id ); ?>.vira-stats::before{
				content:"";position:absolute;top:0;left:0;width:45%;height:100%;
				background:radial-gradient(50% 50% at 0% 40%, rgba(34,197,94,.08), transparent 60%);
				pointer-events:none;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-stats__inner{max-width:1240px;margin:0 auto;position:relative;z-index:1;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-stats__head{text-align:center;margin-bottom:64px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-stats__eyebrow{
				display:inline-flex;align-items:center;gap:8px;
				background:rgba(34,197,94,.15);color:var(--vira-accent);
				border:1px solid rgba(34,197,94,.25);
				padding:8px 16px;border-radius:999px;font-size:14px;font-weight:600;margin-bottom:16px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-stats__eyebrow i{
				width:8px;height:8px;border-radius:50%;background:var(--vira-accent);
				box-shadow:0 0 0 4px rgba(34,197,94,.18);display:inline-block;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-stats h2{font-size:clamp(28px,3.4vw,46px);font-weight:800;margin:0 0 16px;line-height:1.4;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-stats h2 em{
				font-style:normal;
				background:linear-gradient(135deg,var(--vira-accent),#128BE0);
				-webkit-background-clip:text;background-clip:text;color:transparent;-webkit-text-fill-color:transparent;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-stats__head p{color:#64748B;font-size:18px;max-width:680px;margin:0 auto;}

			/* Counter Grid */
			#<?php echo esc_attr( $unique_id ); ?> .vira-counters{
				display:grid;grid-template-columns:repeat(4,1fr);gap:24px;margin-bottom:72px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-counter{
				background:var(--vira-card-bg);border:1px solid #E2E8F0;border-radius:24px;
				padding:36px 28px;text-align:center;position:relative;overflow:hidden;
				transition:transform .3s ease, box-shadow .3s ease;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-counter:hover{transform:translateY(-4px);box-shadow:0 16px 40px rgba(23,12,121,.10);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-counter::before{
				content:"";position:absolute;top:0;left:50%;transform:translateX(-50%);
				width:60%;height:3px;border-radius:0 0 4px 4px;
				background:linear-gradient(90deg,var(--vira-top-from),var(--vira-top-to));
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-counter .ic{
				width:56px;height:56px;border-radius:16px;margin:0 auto 18px;
				display:grid;place-items:center;
				background:rgba(34,197,94,.15);color:var(--vira-accent);font-size:22px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-counter .num{
				font-size:clamp(36px,4vw,52px);font-weight:900;line-height:1;
				background:linear-gradient(135deg,#1D2327 0%,#170C79 100%);
				-webkit-background-clip:text;background-clip:text;color:transparent;-webkit-text-fill-color:transparent;
				margin-bottom:8px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-counter .lbl{color:#64748B;font-size:15px;font-weight:500;}

			/* Compare */
			#<?php echo esc_attr( $unique_id ); ?> .vira-compare{
				background:#fff;border:1px solid #E2E8F0;border-radius:32px;
				padding:48px;box-shadow:0 24px 60px rgba(23,12,121,.06);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-compare__header{
				display:flex;align-items:center;justify-content:space-between;
				margin-bottom:36px;flex-wrap:wrap;gap:16px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-compare__header h3{font-size:24px;font-weight:800;margin:0;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-compare__toggle{
				display:flex;align-items:center;gap:12px;
				background:#F1F5F9;border-radius:12px;padding:6px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-compare__toggle-btn{
				padding:10px 20px;border-radius:8px;border:none;cursor:pointer;
				font-family:inherit;font-size:14px;font-weight:600;
				background:transparent;color:#64748B;transition:all .3s ease;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-compare__toggle-btn.is-active{
				background:linear-gradient(135deg,var(--vira-togg-from),var(--vira-togg-to));
				color:#fff;box-shadow:0 4px 12px rgba(34,197,94,.30);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-compare__grid{
				display:grid;grid-template-columns:1fr 1fr;gap:32px;position:relative;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-compare__panel{
				border-radius:20px;padding:32px;position:relative;transition:all .4s ease;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-compare__panel--before{
				background:linear-gradient(135deg,#FEF2F2,#FFF);border:1px solid #FECACA;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-compare__panel--after{
				background:linear-gradient(135deg,#F0FDF4,#FFF);border:1px solid #BBF7D0;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-compare__panel-badge{
				display:inline-flex;align-items:center;gap:6px;
				padding:6px 12px;border-radius:8px;font-size:12px;font-weight:700;margin-bottom:20px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-compare__panel--before .vira-compare__panel-badge{
				background:#FEE2E2;color:var(--vira-before);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-compare__panel--after .vira-compare__panel-badge{
				background:#DCFCE7;color:var(--vira-after);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-compare__metric{
				display:flex;align-items:center;justify-content:space-between;
				padding:14px 0;border-bottom:1px solid rgba(0,0,0,.06);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-compare__metric:last-child{border-bottom:none;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-compare__metric .label{font-size:14px;color:#64748B;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-compare__metric .value{font-size:18px;font-weight:800;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-compare__panel--before .vira-compare__metric .value{color:var(--vira-before);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-compare__panel--after .vira-compare__metric .value{color:var(--vira-after);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-compare__arrow{
				position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);
				width:56px;height:56px;border-radius:50%;
				background:linear-gradient(135deg,var(--vira-togg-from),var(--vira-togg-to));
				display:grid;place-items:center;color:#fff;
				box-shadow:0 8px 24px rgba(34,197,94,.35);z-index:2;
			}

			@media(max-width:980px){
				#<?php echo esc_attr( $unique_id ); ?> .vira-counters{grid-template-columns:repeat(2,1fr);}
				#<?php echo esc_attr( $unique_id ); ?> .vira-compare__grid{grid-template-columns:1fr;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-compare__arrow{position:static;transform:none;margin:16px auto;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-compare{padding:28px;}
			}
			@media(max-width:560px){
				#<?php echo esc_attr( $unique_id ); ?> .vira-counters{grid-template-columns:1fr;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-counter{padding:28px 20px;}
			}
		</style>

		<section id="<?php echo esc_attr( $unique_id ); ?>" class="vira-stats" data-vira-stats>
			<div class="vira-stats__inner">

				<div class="vira-stats__head">
					<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
						<span class="vira-stats__eyebrow"><i></i><?php echo esc_html( $settings['eyebrow'] ); ?></span>
					<?php endif; ?>
					<?php if ( ! empty( $settings['heading'] ) ) : ?>
						<h2><?php echo wp_kses_post( $settings['heading'] ); ?></h2>
					<?php endif; ?>
					<?php if ( ! empty( $settings['description'] ) ) : ?>
						<p><?php echo esc_html( $settings['description'] ); ?></p>
					<?php endif; ?>
				</div>

				<?php if ( ! empty( $counters ) ) : ?>
					<div class="vira-counters">
						<?php foreach ( $counters as $c ) :
							$num = isset( $c['number_value'] ) ? (int) $c['number_value'] : 0;
							$suf = isset( $c['suffix'] ) ? $c['suffix'] : '';
							?>
							<div class="vira-counter">
								<div class="ic">
									<?php if ( ! empty( $c['icon'] ) ) : ?>
										<?php \Elementor\Icons_Manager::render_icon( $c['icon'], array( 'aria-hidden' => 'true' ) ); ?>
									<?php endif; ?>
								</div>
								<div class="num" data-counter="<?php echo (int) $num; ?>" data-suffix="<?php echo esc_attr( $suf ); ?>">۰<?php echo esc_html( $suf ); ?></div>
								<div class="lbl"><?php echo esc_html( $c['label'] ); ?></div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<?php if ( $show_compare && ! empty( $tabs ) ) :
					$first_tab     = $tabs[0];
					$first_slug    = ! empty( $first_tab['tab_slug'] ) ? sanitize_title( $first_tab['tab_slug'] ) : 'tab-1';
					$before_first  = ! empty( $first_tab['before_metrics'] ) ? $first_tab['before_metrics'] : array();
					$after_first   = ! empty( $first_tab['after_metrics'] ) ? $first_tab['after_metrics'] : array();
					?>
					<div class="vira-compare" data-vira-compare>
						<div class="vira-compare__header">
							<h3><?php echo esc_html( $settings['compare_title'] ); ?></h3>
							<div class="vira-compare__toggle">
								<?php foreach ( $tabs as $i => $t ) :
									$slug = ! empty( $t['tab_slug'] ) ? sanitize_title( $t['tab_slug'] ) : 'tab-' . ( $i + 1 );
									?>
									<button type="button" class="vira-compare__toggle-btn<?php echo 0 === $i ? ' is-active' : ''; ?>" data-compare="<?php echo esc_attr( $slug ); ?>">
										<?php echo esc_html( $t['tab_label'] ); ?>
									</button>
								<?php endforeach; ?>
							</div>
						</div>

						<div class="vira-compare__grid">
							<div class="vira-compare__panel vira-compare__panel--before">
								<div class="vira-compare__panel-badge">
									<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 15l-6 6-6-6M12 21V3" stroke-linecap="round" stroke-linejoin="round"/></svg>
									<?php echo esc_html( $settings['before_badge'] ); ?>
								</div>
								<div class="vira-compare__metrics" data-before-metrics>
									<?php foreach ( $before_first as $m ) : ?>
										<div class="vira-compare__metric">
											<span class="label"><?php echo esc_html( $m['metric_label'] ); ?></span>
											<span class="value"><?php echo esc_html( $m['metric_value'] ); ?></span>
										</div>
									<?php endforeach; ?>
								</div>
							</div>

							<div class="vira-compare__arrow">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
							</div>

							<div class="vira-compare__panel vira-compare__panel--after">
								<div class="vira-compare__panel-badge">
									<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 9l-6-6-6 6M12 3v18" stroke-linecap="round" stroke-linejoin="round"/></svg>
									<?php echo esc_html( $settings['after_badge'] ); ?>
								</div>
								<div class="vira-compare__metrics" data-after-metrics>
									<?php foreach ( $after_first as $m ) : ?>
										<div class="vira-compare__metric">
											<span class="label"><?php echo esc_html( $m['metric_label'] ); ?></span>
											<span class="value"><?php echo esc_html( $m['metric_value'] ); ?></span>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>

			</div>
		</section>

		<script>
		(function(){
			var root = document.getElementById('<?php echo esc_js( $unique_id ); ?>');
			if (!root) return;

			var toFa = function(n){ return String(n).replace(/\d/g, function(d){ return '۰۱۲۳۴۵۶۷۸۹'[d]; }); };
			var formatNum = function(n){ return toFa(n.toLocaleString('en-US')); };

			// Counter animation
			var counters = root.querySelectorAll('[data-counter]');
			var animate = function(el){
				var target = parseInt(el.getAttribute('data-counter'), 10) || 0;
				var suffix = el.getAttribute('data-suffix') || '';
				var dur = 2200, start = performance.now();
				var step = function(now){
					var t = Math.min(1, (now - start) / dur);
					var eased = 1 - Math.pow(1 - t, 4);
					var val = Math.floor(eased * target);
					el.textContent = formatNum(val) + suffix;
					if (t < 1) requestAnimationFrame(step);
				};
				requestAnimationFrame(step);
			};
			if ('IntersectionObserver' in window) {
				var io = new IntersectionObserver(function(entries){
					entries.forEach(function(e){ if (e.isIntersecting) { animate(e.target); io.unobserve(e.target); } });
				}, { threshold: 0.4 });
				counters.forEach(function(c){ io.observe(c); });
			} else {
				counters.forEach(animate);
			}

			<?php if ( $show_compare && ! empty( $tabs ) ) : ?>
			// Compare data
			var data = <?php echo wp_json_encode( $data_js ); ?>;
			var btns = root.querySelectorAll('.vira-compare__toggle-btn');
			var beforePanel = root.querySelector('[data-before-metrics]');
			var afterPanel = root.querySelector('[data-after-metrics]');
			function escapeHtml(s){ return String(s).replace(/[&<>"']/g, function(c){ return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]; }); }
			function updateMetrics(slug){
				var d = data[slug];
				if (!d || !beforePanel || !afterPanel) return;
				var labels = d.labels || [];
				beforePanel.innerHTML = labels.map(function(l, i){
					var v = (d.before && d.before[i]) || '';
					return '<div class="vira-compare__metric"><span class="label">' + escapeHtml(l) + '</span><span class="value">' + escapeHtml(v) + '</span></div>';
				}).join('');
				afterPanel.innerHTML = labels.map(function(l, i){
					var v = (d.after && d.after[i]) || '';
					return '<div class="vira-compare__metric"><span class="label">' + escapeHtml(l) + '</span><span class="value">' + escapeHtml(v) + '</span></div>';
				}).join('');
			}
			btns.forEach(function(btn){
				btn.addEventListener('click', function(){
					btns.forEach(function(b){ b.classList.remove('is-active'); });
					btn.classList.add('is-active');
					updateMetrics(btn.getAttribute('data-compare'));
				});
			});
			<?php endif; ?>
		})();
		</script>
		<?php
	}
}
