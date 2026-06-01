<?php
/**
 * Vira Sections — ROI Calculator Widget
 *
 * An interactive ROI / pricing calculator. A range slider drives a set of
 * live-computed output figures (e.g. estimated leads, revenue growth). Each
 * output is sliderValue * factor, formatted in Persian digits and animated on
 * change. Presented inside a glassmorphism card on a dark gradient.
 *
 * @package ViraSections
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Vira_Sections_Widget_Roi_Calculator
 */
class Vira_Sections_Widget_Roi_Calculator extends \Elementor\Widget_Base {

	use Vira_Sections_Preset_Trait;

	public function get_name() {
		return 'vira_roi_calculator';
	}

	public function get_title() {
		return __( 'ROI Calculator (Vira)', 'vira-sections' );
	}

	public function get_icon() {
		return 'eicon-skill-bar';
	}

	public function get_categories() {
		return array( 'vira-sections' );
	}

	public function get_keywords() {
		return array( 'vira', 'roi', 'calculator', 'slider', 'estimate', 'pricing', 'leads', 'revenue' );
	}

	/**
	 * Register controls.
	 */
	protected function register_controls() {

		$this->register_preset_control();

		/* ============================================================
		 * CONTENT — Section Header
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
				'default' => __( 'محاسبه‌گر بازگشت سرمایه', 'vira-sections' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'ببینید سئو چقدر برایتان <em>سودآور</em> است', 'vira-sections' ),
				'label_block' => true,
				'description' => __( 'Wrap highlighted words in &lt;em&gt;...&lt;/em&gt; for accent color.', 'vira-sections' ),
			)
		);

		$this->register_tag_control( 'heading_tag', __( 'Heading HTML Tag (SEO)', 'vira-sections' ), 'h2' );

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'اسلایدر را حرکت دهید تا تخمین زنده‌ای از نتایج پروژه برای کسب‌وکار شما ببینید.', 'vira-sections' ),
				'rows'    => 3,
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * CONTENT — Slider Input
		 * ============================================================ */
		$this->start_controls_section(
			'section_input',
			array(
				'label' => __( 'Input Slider', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'slider_label',
			array(
				'label'   => __( 'Slider Label', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'بازدید ماهانه سایت شما', 'vira-sections' ),
			)
		);

		$this->add_control(
			'slider_unit',
			array(
				'label'   => __( 'Value Unit', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'بازدید', 'vira-sections' ),
			)
		);

		$this->add_control(
			'slider_min',
			array(
				'label'   => __( 'Minimum', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 1000,
				'min'     => 0,
			)
		);

		$this->add_control(
			'slider_max',
			array(
				'label'   => __( 'Maximum', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 100000,
				'min'     => 1,
			)
		);

		$this->add_control(
			'slider_step',
			array(
				'label'   => __( 'Step', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 1000,
				'min'     => 1,
			)
		);

		$this->add_control(
			'slider_default',
			array(
				'label'   => __( 'Default Value', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 25000,
				'min'     => 0,
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * CONTENT — Outputs
		 * ============================================================ */
		$this->start_controls_section(
			'section_outputs',
			array(
				'label' => __( 'Output Results', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'out_icon',
			array(
				'label'   => __( 'Icon', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-user-plus',
					'library' => 'fa-solid',
				),
			)
		);

		$repeater->add_control(
			'out_label',
			array(
				'label'       => __( 'Result Label', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'نتیجه', 'vira-sections' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'out_factor',
			array(
				'label'       => __( 'Multiplier (value × factor)', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'default'     => 0.03,
				'step'        => 0.0001,
				'description' => __( 'Result = slider value × this factor.', 'vira-sections' ),
			)
		);

		$repeater->add_control(
			'out_decimals',
			array(
				'label'   => __( 'Decimal Places', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 0,
				'min'     => 0,
				'max'     => 4,
			)
		);

		$repeater->add_control(
			'out_prefix',
			array(
				'label'   => __( 'Prefix', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '',
			)
		);

		$repeater->add_control(
			'out_suffix',
			array(
				'label'   => __( 'Suffix', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '',
			)
		);

		$repeater->add_control(
			'out_highlight',
			array(
				'label'        => __( 'Highlight (featured)', 'vira-sections' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_control(
			'outputs',
			array(
				'label'       => __( 'Outputs', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ out_label }}}',
				'default'     => array(
					array(
						'out_icon'     => array( 'value' => 'fas fa-user-plus', 'library' => 'fa-solid' ),
						'out_label'    => __( 'لید تخمینی ماهانه', 'vira-sections' ),
						'out_factor'   => 0.03,
						'out_decimals' => 0,
						'out_suffix'   => __( 'نفر', 'vira-sections' ),
					),
					array(
						'out_icon'      => array( 'value' => 'fas fa-coins', 'library' => 'fa-solid' ),
						'out_label'     => __( 'رشد درآمد تخمینی (تومان)', 'vira-sections' ),
						'out_factor'    => 4500,
						'out_decimals'  => 0,
						'out_highlight' => 'yes',
					),
					array(
						'out_icon'     => array( 'value' => 'fas fa-chart-line', 'library' => 'fa-solid' ),
						'out_label'    => __( 'بازدید ارگانیک پس از سئو', 'vira-sections' ),
						'out_factor'   => 2.4,
						'out_decimals' => 0,
						'out_suffix'   => __( 'بازدید', 'vira-sections' ),
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
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 220 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 110 ),
			)
		);

		$this->add_control(
			'bg_from',
			array(
				'label'   => __( 'Background — From', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#060832',
			)
		);

		$this->add_control(
			'bg_to',
			array(
				'label'   => __( 'Background — To', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#170C79',
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * STYLE — Colors
		 * ============================================================ */
		$this->start_controls_section(
			'style_colors',
			array(
				'label' => __( 'Colors', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'accent_color',
			array(
				'label'   => __( 'Accent Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#128BE0',
			)
		);

		$this->add_control(
			'accent_2',
			array(
				'label'   => __( 'Accent Color 2', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#8ACBD0',
			)
		);

		$this->add_control(
			'card_bg',
			array(
				'label'   => __( 'Card Background', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => 'rgba(255,255,255,0.06)',
			)
		);

		$this->add_control(
			'card_border',
			array(
				'label'   => __( 'Card Border', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => 'rgba(255,255,255,0.16)',
			)
		);

		$this->add_control(
			'heading_color',
			array(
				'label'   => __( 'Heading Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'   => __( 'Body Text Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#8ACBD0',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Frontend render.
	 */
	protected function render() {
		$settings  = $this->get_settings_for_display();
		$unique_id = 'vira-roi-' . $this->get_id();

		$pad        = isset( $settings['section_padding']['size'] ) ? (int) $settings['section_padding']['size'] : 110;
		$bg_from    = ! empty( $settings['bg_from'] ) ? $settings['bg_from'] : '#060832';
		$bg_to      = ! empty( $settings['bg_to'] ) ? $settings['bg_to'] : '#170C79';
		$accent     = ! empty( $settings['accent_color'] ) ? $settings['accent_color'] : '#128BE0';
		$accent2    = ! empty( $settings['accent_2'] ) ? $settings['accent_2'] : '#8ACBD0';
		$card_bg    = ! empty( $settings['card_bg'] ) ? $settings['card_bg'] : 'rgba(255,255,255,0.06)';
		$card_bd    = ! empty( $settings['card_border'] ) ? $settings['card_border'] : 'rgba(255,255,255,0.16)';
		$head_color = ! empty( $settings['heading_color'] ) ? $settings['heading_color'] : '#FFFFFF';
		$text_color = ! empty( $settings['text_color'] ) ? $settings['text_color'] : '#8ACBD0';

		$min  = isset( $settings['slider_min'] ) ? (float) $settings['slider_min'] : 1000;
		$max  = isset( $settings['slider_max'] ) ? (float) $settings['slider_max'] : 100000;
		$step = isset( $settings['slider_step'] ) && (float) $settings['slider_step'] > 0 ? (float) $settings['slider_step'] : 1000;
		$def  = isset( $settings['slider_default'] ) ? (float) $settings['slider_default'] : 25000;

		// Sanity clamp.
		if ( $max <= $min ) {
			$max = $min + $step;
		}
		$def = max( $min, min( $max, $def ) );

		$outputs = ! empty( $settings['outputs'] ) && is_array( $settings['outputs'] ) ? $settings['outputs'] : array();
		?>
		<style>
			#<?php echo esc_attr( $unique_id ); ?>{
				--vira-pad: <?php echo (int) $pad; ?>px;
				--vira-bg-from: <?php echo esc_attr( $bg_from ); ?>;
				--vira-bg-to: <?php echo esc_attr( $bg_to ); ?>;
				--vira-accent: <?php echo esc_attr( $accent ); ?>;
				--vira-accent2: <?php echo esc_attr( $accent2 ); ?>;
				--vira-card-bg: <?php echo esc_attr( $card_bg ); ?>;
				--vira-card-bd: <?php echo esc_attr( $card_bd ); ?>;
				--vira-head: <?php echo esc_attr( $head_color ); ?>;
				--vira-text: <?php echo esc_attr( $text_color ); ?>;
			}
			#<?php echo esc_attr( $unique_id ); ?>.vira-roi{
				padding:var(--vira-pad) 24px;
				background:linear-gradient(160deg,var(--vira-bg-from),var(--vira-bg-to));
				font-family:'Vazirmatn','IRANSans',Tahoma,sans-serif;direction:rtl;color:var(--vira-text);
				position:relative;overflow:hidden;
			}
			#<?php echo esc_attr( $unique_id ); ?>.vira-roi::before{
				content:"";position:absolute;top:-20%;left:-10%;width:50%;height:80%;
				background:radial-gradient(circle, rgba(18,139,224,.25), transparent 65%);
				filter:blur(40px);pointer-events:none;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__inner{max-width:1080px;margin:0 auto;position:relative;z-index:1;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__head{text-align:center;margin-bottom:48px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__eyebrow{
				display:inline-flex;align-items:center;gap:8px;
				background:rgba(18,139,224,.16);color:var(--vira-accent2);
				border:1px solid rgba(138,203,208,.30);
				padding:8px 16px;border-radius:999px;font-size:14px;font-weight:600;margin-bottom:16px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__eyebrow i{
				width:8px;height:8px;border-radius:50%;background:var(--vira-accent2);
				box-shadow:0 0 0 4px rgba(138,203,208,.18);display:inline-block;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi h2, #<?php echo esc_attr( $unique_id ); ?> .vira-roi__title{font-size:clamp(28px,3.4vw,46px);font-weight:800;margin:0 0 16px;line-height:1.4;color:var(--vira-head);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi h2 em, #<?php echo esc_attr( $unique_id ); ?> .vira-roi__title em{
				font-style:normal;
				background:linear-gradient(135deg,var(--vira-accent),var(--vira-accent2));
				-webkit-background-clip:text;background-clip:text;color:transparent;-webkit-text-fill-color:transparent;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__head p{font-size:18px;max-width:620px;margin:0 auto;opacity:.9;}

			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__card{
				background:var(--vira-card-bg);border:1px solid var(--vira-card-bd);
				border-radius:28px;padding:44px;
				backdrop-filter:blur(16px);-webkit-backdrop-filter:blur(16px);
				box-shadow:0 30px 80px rgba(0,0,0,.35);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__input-head{
				display:flex;align-items:flex-end;justify-content:space-between;gap:16px;margin-bottom:18px;flex-wrap:wrap;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__input-label{font-size:17px;font-weight:600;color:var(--vira-head);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__value{
				display:inline-flex;align-items:baseline;gap:8px;
				background:rgba(255,255,255,.08);border:1px solid var(--vira-card-bd);
				padding:8px 18px;border-radius:14px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__value b{
				font-size:26px;font-weight:900;color:#fff;line-height:1;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__value span{font-size:13px;opacity:.8;}

			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__range{
				-webkit-appearance:none;appearance:none;width:100%;height:10px;border-radius:999px;
				background:rgba(255,255,255,.14);outline:none;cursor:pointer;margin:8px 0 6px;
				direction:ltr;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__range::-webkit-slider-runnable-track{height:10px;border-radius:999px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__range::-moz-range-track{height:10px;border-radius:999px;background:rgba(255,255,255,.14);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__range::-moz-range-progress{height:10px;border-radius:999px;background:linear-gradient(90deg,var(--vira-accent),var(--vira-accent2));}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__range::-webkit-slider-thumb{
				-webkit-appearance:none;appearance:none;
				width:28px;height:28px;border-radius:50%;margin-top:-9px;
				background:#fff;border:4px solid var(--vira-accent);cursor:grab;
				box-shadow:0 6px 18px rgba(0,0,0,.35);transition:transform .15s ease;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__range::-webkit-slider-thumb:active{transform:scale(1.12);cursor:grabbing;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__range::-moz-range-thumb{
				width:28px;height:28px;border-radius:50%;
				background:#fff;border:4px solid var(--vira-accent);cursor:grab;
				box-shadow:0 6px 18px rgba(0,0,0,.35);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__range:focus-visible{box-shadow:0 0 0 4px rgba(18,139,224,.4);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__scale{
				display:flex;justify-content:space-between;font-size:12px;opacity:.6;margin-bottom:36px;
			}

			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__outputs{
				display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__out{
				background:rgba(255,255,255,.05);border:1px solid var(--vira-card-bd);
				border-radius:20px;padding:26px 22px;position:relative;overflow:hidden;
				transition:transform .3s ease, border-color .3s ease;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__out:hover{transform:translateY(-4px);border-color:var(--vira-accent);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__out.is-highlight{
				background:linear-gradient(135deg,rgba(18,139,224,.22),rgba(138,203,208,.12));
				border-color:rgba(138,203,208,.5);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__out-ic{
				width:48px;height:48px;border-radius:14px;display:grid;place-items:center;
				background:rgba(255,255,255,.10);color:var(--vira-accent2);font-size:20px;margin-bottom:16px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__out.is-highlight .vira-roi__out-ic{
				background:linear-gradient(135deg,var(--vira-accent),var(--vira-accent2));color:#06122b;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__out-num{
				font-size:clamp(26px,3vw,38px);font-weight:900;color:#fff;line-height:1.1;margin-bottom:8px;
				word-break:break-word;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__out-num .pf,
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__out-num .sf{font-size:15px;font-weight:700;opacity:.75;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-roi__out-label{font-size:14px;color:var(--vira-text);line-height:1.6;}

			@media(max-width:560px){
				#<?php echo esc_attr( $unique_id ); ?> .vira-roi__card{padding:28px 20px;}
			}
			@media(prefers-reduced-motion:reduce){
				#<?php echo esc_attr( $unique_id ); ?> .vira-roi__out{transition:none;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-roi__range::-webkit-slider-thumb{transition:none;}
			}
		</style>

		<section id="<?php echo esc_attr( $unique_id ); ?>" class="vira-roi" data-vira-roi>
			<div class="vira-roi__inner">
				<div class="vira-roi__head">
					<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
						<span class="vira-roi__eyebrow"><i></i><?php echo esc_html( $settings['eyebrow'] ); ?></span>
					<?php endif; ?>
					<?php if ( ! empty( $settings['heading'] ) ) : ?>
						<?php $heading_tag = $this->vira_safe_tag( isset( $settings['heading_tag'] ) ? $settings['heading_tag'] : 'h2', 'h2' ); ?>
						<<?php echo $heading_tag; ?> class="vira-roi__title"><?php echo wp_kses_post( $settings['heading'] ); ?></<?php echo $heading_tag; ?>>
					<?php endif; ?>
					<?php if ( ! empty( $settings['description'] ) ) : ?>
						<p><?php echo esc_html( $settings['description'] ); ?></p>
					<?php endif; ?>
				</div>

				<div class="vira-roi__card">
					<div class="vira-roi__input-head">
						<label class="vira-roi__input-label" for="<?php echo esc_attr( $unique_id ); ?>-range">
							<?php echo esc_html( $settings['slider_label'] ); ?>
						</label>
						<span class="vira-roi__value">
							<b data-roi-display>۰</b>
							<span><?php echo esc_html( $settings['slider_unit'] ); ?></span>
						</span>
					</div>

					<input type="range"
						id="<?php echo esc_attr( $unique_id ); ?>-range"
						class="vira-roi__range"
						min="<?php echo esc_attr( $min ); ?>"
						max="<?php echo esc_attr( $max ); ?>"
						step="<?php echo esc_attr( $step ); ?>"
						value="<?php echo esc_attr( $def ); ?>"
						data-roi-range
						aria-label="<?php echo esc_attr( $settings['slider_label'] ); ?>" />

					<div class="vira-roi__scale">
						<span data-roi-min><?php echo esc_html( $min ); ?></span>
						<span data-roi-max><?php echo esc_html( $max ); ?></span>
					</div>

					<?php if ( ! empty( $outputs ) ) : ?>
						<div class="vira-roi__outputs">
							<?php foreach ( $outputs as $i => $out ) :
								$factor    = isset( $out['out_factor'] ) ? (float) $out['out_factor'] : 0;
								$decimals  = isset( $out['out_decimals'] ) ? (int) $out['out_decimals'] : 0;
								$prefix    = isset( $out['out_prefix'] ) ? $out['out_prefix'] : '';
								$suffix    = isset( $out['out_suffix'] ) ? $out['out_suffix'] : '';
								$highlight = ! empty( $out['out_highlight'] ) && 'yes' === $out['out_highlight'];
								?>
								<div class="vira-roi__out<?php echo $highlight ? ' is-highlight' : ''; ?>"
									data-roi-out
									data-factor="<?php echo esc_attr( $factor ); ?>"
									data-decimals="<?php echo esc_attr( $decimals ); ?>">
									<?php if ( ! empty( $out['out_icon'] ) ) : ?>
										<div class="vira-roi__out-ic">
											<?php \Elementor\Icons_Manager::render_icon( $out['out_icon'], array( 'aria-hidden' => 'true' ) ); ?>
										</div>
									<?php endif; ?>
									<div class="vira-roi__out-num">
										<?php if ( '' !== $prefix ) : ?><span class="pf"><?php echo esc_html( $prefix ); ?></span> <?php endif; ?>
										<span data-roi-value>۰</span>
										<?php if ( '' !== $suffix ) : ?> <span class="sf"><?php echo esc_html( $suffix ); ?></span><?php endif; ?>
									</div>
									<div class="vira-roi__out-label"><?php echo esc_html( $out['out_label'] ); ?></div>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>

		<script>
		(function(){
			var root = document.getElementById('<?php echo esc_js( $unique_id ); ?>');
			if (!root) return;
			var range = root.querySelector('[data-roi-range]');
			var display = root.querySelector('[data-roi-display]');
			var outs = root.querySelectorAll('[data-roi-out]');
			if (!range) return;

			var reduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

			function toFa(str){ return String(str).replace(/[0-9]/g, function(d){ return '۰۱۲۳۴۵۶۷۸۹'[d]; }); }

			function formatNum(n, decimals){
				var fixed = Number(n).toFixed(decimals);
				var parts = fixed.split('.');
				parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
				return toFa(parts.join('.'));
			}

			// Paint the filled portion of the track (works for WebKit too).
			function paintTrack(){
				var min = parseFloat(range.min) || 0;
				var max = parseFloat(range.max) || 100;
				var val = parseFloat(range.value) || 0;
				var pct = max > min ? ((val - min) / (max - min)) * 100 : 0;
				range.style.background = 'linear-gradient(90deg, var(--vira-accent) 0%, var(--vira-accent2) ' + pct + '%, rgba(255,255,255,.14) ' + pct + '%)';
			}

			// Store current animated values per output for smooth tweening.
			var animState = [];
			outs.forEach(function(){ animState.push(0); });

			function animateValue(el, from, to, decimals){
				if (reduced){
					el.textContent = formatNum(to, decimals);
					return;
				}
				var start = performance.now(), dur = 450;
				function frame(now){
					var t = Math.min(1, (now - start) / dur);
					var eased = 1 - Math.pow(1 - t, 3);
					var cur = from + (to - from) * eased;
					el.textContent = formatNum(cur, decimals);
					if (t < 1) requestAnimationFrame(frame);
					else el.textContent = formatNum(to, decimals);
				}
				requestAnimationFrame(frame);
			}

			function compute(){
				var val = parseFloat(range.value) || 0;
				if (display) display.textContent = formatNum(val, 0);
				outs.forEach(function(out, i){
					var factor = parseFloat(out.getAttribute('data-factor')) || 0;
					var decimals = parseInt(out.getAttribute('data-decimals'), 10) || 0;
					var target = val * factor;
					var valEl = out.querySelector('[data-roi-value]');
					if (valEl){
						animateValue(valEl, animState[i], target, decimals);
						animState[i] = target;
					}
				});
				paintTrack();
			}

			// Localize the min/max scale labels.
			var minEl = root.querySelector('[data-roi-min]');
			var maxEl = root.querySelector('[data-roi-max]');
			if (minEl) minEl.textContent = formatNum(parseFloat(range.min) || 0, 0);
			if (maxEl) maxEl.textContent = formatNum(parseFloat(range.max) || 0, 0);

			range.addEventListener('input', compute);
			range.addEventListener('change', compute);
			compute();
		})();
		</script>
		<?php
	}
}
