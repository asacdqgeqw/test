<?php
/**
 * Vira Sections — Clickable Process Timeline Widget
 *
 * Vertical timeline of process steps with side detail panel, progress bar
 * and optional auto-play. Supports a dark or light theme.
 *
 * @package ViraSections
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Vira_Sections_Widget_Process_Timeline
 */
class Vira_Sections_Widget_Process_Timeline extends \Elementor\Widget_Base {

	public function get_name() {
		return 'vira_process_timeline';
	}

	public function get_title() {
		return __( 'Process Timeline (Vira)', 'vira-sections' );
	}

	public function get_icon() {
		return 'eicon-time-line';
	}

	public function get_categories() {
		return array( 'vira-sections' );
	}

	public function get_keywords() {
		return array( 'vira', 'process', 'timeline', 'steps', 'roadmap' );
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
				'label'   => __( 'Eyebrow', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'فرآیند کار', 'vira-sections' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'از ایده تا انتشار، در <em>۵ گام شفاف</em>', 'vira-sections' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'هر مرحله از پروژه با شفافیت کامل پیش می‌رود. روی هر گام کلیک کن تا جزئیات اون مرحله رو ببینی.', 'vira-sections' ),
				'rows'    => 3,
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * Steps Repeater
		 * ============================================================ */
		$this->start_controls_section(
			'section_steps',
			array(
				'label' => __( 'Steps', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'step_number',
			array(
				'label'   => __( 'Number', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '۱',
			)
		);

		$repeater->add_control(
			'step_title',
			array(
				'label'   => __( 'Step Title', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'عنوان مرحله', 'vira-sections' ),
			)
		);

		$repeater->add_control(
			'step_duration',
			array(
				'label'   => __( 'Step Duration (short)', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( '۱ هفته', 'vira-sections' ),
			)
		);

		$repeater->add_control(
			'panel_title',
			array(
				'label'   => __( 'Panel Title', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'عنوان جزئیات', 'vira-sections' ),
			)
		);

		$repeater->add_control(
			'panel_duration_text',
			array(
				'label'   => __( 'Panel Duration Text', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'مدت: ۱ هفته', 'vira-sections' ),
			)
		);

		$repeater->add_control(
			'panel_description',
			array(
				'label'   => __( 'Panel Description', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'توضیح کامل درباره این مرحله و فعالیت‌هایی که در آن انجام می‌شود.', 'vira-sections' ),
				'rows'    => 4,
			)
		);

		// Sub-repeater for features.
		$features_sub = new \Elementor\Repeater();
		$features_sub->add_control(
			'feature_text',
			array(
				'label'   => __( 'Feature', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'یک فعالیت', 'vira-sections' ),
			)
		);

		$repeater->add_control(
			'panel_features',
			array(
				'label'       => __( 'Panel Features', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $features_sub->get_controls(),
				'title_field' => '{{{ feature_text }}}',
				'default'     => array(
					array( 'feature_text' => __( 'فعالیت اول', 'vira-sections' ) ),
					array( 'feature_text' => __( 'فعالیت دوم', 'vira-sections' ) ),
					array( 'feature_text' => __( 'فعالیت سوم', 'vira-sections' ) ),
					array( 'feature_text' => __( 'فعالیت چهارم', 'vira-sections' ) ),
				),
			)
		);

		$this->add_control(
			'steps',
			array(
				'label'       => __( 'Steps', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ step_title }}}',
				'default'     => array(
					array(
						'step_number'         => '۱',
						'step_title'          => __( 'کشف و تحلیل', 'vira-sections' ),
						'step_duration'       => __( '۱ هفته', 'vira-sections' ),
						'panel_title'         => __( 'کشف و تحلیل نیازمندی‌ها', 'vira-sections' ),
						'panel_duration_text' => __( 'مدت: ۱ هفته', 'vira-sections' ),
						'panel_description'   => __( 'قبل از خط زدن یک خط کد، باید بدونیم دقیقاً چی می‌خواهیم بسازیم. در این مرحله نقشه راه پروژه طراحی می‌شه.', 'vira-sections' ),
					),
					array(
						'step_number'         => '۲',
						'step_title'          => __( 'طراحی UI/UX', 'vira-sections' ),
						'step_duration'       => __( '۲ هفته', 'vira-sections' ),
						'panel_title'         => __( 'طراحی UI/UX اختصاصی', 'vira-sections' ),
						'panel_duration_text' => __( 'مدت: ۲ هفته', 'vira-sections' ),
						'panel_description'   => __( 'طراحان UI/UX ما در فیگما تجربه کاربری رو طراحی می‌کنن. ابتدا وایرفریم، سپس Mockup نهایی و در پایان پروتوتایپ تعاملی.', 'vira-sections' ),
					),
					array(
						'step_number'         => '۳',
						'step_title'          => __( 'توسعه و کدنویسی', 'vira-sections' ),
						'step_duration'       => __( '۴-۸ هفته', 'vira-sections' ),
						'panel_title'         => __( 'توسعه با متد Agile', 'vira-sections' ),
						'panel_duration_text' => __( 'مدت: ۴ تا ۸ هفته', 'vira-sections' ),
						'panel_description'   => __( 'توسعه با متد Agile در Sprintهای ۲ هفته‌ای. در پایان هر Sprint نسخه قابل تست دریافت می‌کنید.', 'vira-sections' ),
					),
					array(
						'step_number'         => '۴',
						'step_title'          => __( 'تست و QA', 'vira-sections' ),
						'step_duration'       => __( '۱ هفته', 'vira-sections' ),
						'panel_title'         => __( 'تست، QA و بهینه‌سازی', 'vira-sections' ),
						'panel_duration_text' => __( 'مدت: ۱ هفته', 'vira-sections' ),
						'panel_description'   => __( 'قبل از تحویل، تیم QA همه چیز رو تست می‌کنه. تست عملکرد، امنیت و سناریوهای Edge Case.', 'vira-sections' ),
					),
					array(
						'step_number'         => '۵',
						'step_title'          => __( 'انتشار و پشتیبانی', 'vira-sections' ),
						'step_duration'       => __( 'پشتیبانی ۳-۶ ماه', 'vira-sections' ),
						'panel_title'         => __( 'انتشار و پشتیبانی پایدار', 'vira-sections' ),
						'panel_duration_text' => __( '۳-۶ ماه پشتیبانی رایگان', 'vira-sections' ),
						'panel_description'   => __( 'پروژه شما منتشر می‌شه. پس از انتشار، مانیتورینگ مداوم و پشتیبانی فنی رایگان ارائه می‌شه.', 'vira-sections' ),
					),
				),
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * Settings
		 * ============================================================ */
		$this->start_controls_section(
			'section_settings',
			array(
				'label' => __( 'Settings', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'theme',
			array(
				'label'   => __( 'Theme', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'dark',
				'options' => array(
					'dark'  => __( 'Dark', 'vira-sections' ),
					'light' => __( 'Light', 'vira-sections' ),
				),
			)
		);

		$this->add_control(
			'auto_play',
			array(
				'label'        => __( 'Auto Play', 'vira-sections' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'auto_interval',
			array(
				'label'   => __( 'Interval (ms)', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 5000,
				'min'     => 2000,
				'max'     => 20000,
				'step'    => 500,
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
				'default'    => array( 'unit' => 'px', 'size' => 110 ),
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * STYLE — Colors
		 * ============================================================ */
		$this->start_controls_section(
			'style_colors',
			array(
				'label' => __( 'Colors & Gradient', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'grad_from',
			array(
				'label'   => __( 'Timeline Gradient 1', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#170C79',
			)
		);

		$this->add_control(
			'grad_to',
			array(
				'label'   => __( 'Timeline Gradient 2', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#128BE0',
			)
		);

		$this->add_control(
			'active_color',
			array(
				'label'   => __( 'Step Active Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#0170B9',
			)
		);

		$this->add_control(
			'panel_bg_dark',
			array(
				'label'   => __( 'Panel Background (Dark Theme)', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#060832',
			)
		);

		$this->add_control(
			'panel_bg_light',
			array(
				'label'   => __( 'Panel Background (Light Theme)', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render frontend output.
	 */
	protected function render() {
		$settings  = $this->get_settings_for_display();
		$unique_id = 'vira-proc-' . $this->get_id();

		$pad        = ! empty( $settings['section_padding']['size'] ) ? (int) $settings['section_padding']['size'] : 110;
		$grad_from  = ! empty( $settings['grad_from'] ) ? $settings['grad_from'] : '#170C79';
		$grad_to    = ! empty( $settings['grad_to'] ) ? $settings['grad_to'] : '#128BE0';
		$active     = ! empty( $settings['active_color'] ) ? $settings['active_color'] : '#0170B9';
		$panel_dark = ! empty( $settings['panel_bg_dark'] ) ? $settings['panel_bg_dark'] : '#060832';
		$panel_lite = ! empty( $settings['panel_bg_light'] ) ? $settings['panel_bg_light'] : '#FFFFFF';

		$theme    = ! empty( $settings['theme'] ) ? $settings['theme'] : 'dark';
		$auto     = ! empty( $settings['auto_play'] ) && 'yes' === $settings['auto_play'];
		$interval = ! empty( $settings['auto_interval'] ) ? (int) $settings['auto_interval'] : 5000;
		$steps    = ! empty( $settings['steps'] ) && is_array( $settings['steps'] ) ? $settings['steps'] : array();
		$count    = max( 1, count( $steps ) );
		$is_dark  = ( 'dark' === $theme );
		$bg_color = $is_dark ? $panel_dark : $panel_lite;
		?>
		<style>
			#<?php echo esc_attr( $unique_id ); ?>{
				--vira-pad: <?php echo (int) $pad; ?>px;
				--vira-grad-from: <?php echo esc_attr( $grad_from ); ?>;
				--vira-grad-to: <?php echo esc_attr( $grad_to ); ?>;
				--vira-active: <?php echo esc_attr( $active ); ?>;
				--vira-bg: <?php echo esc_attr( $bg_color ); ?>;
				--vira-fg: <?php echo $is_dark ? '#ffffff' : '#1D2327'; ?>;
				--vira-fg-soft: <?php echo $is_dark ? 'rgba(255,255,255,.65)' : '#64748B'; ?>;
				--vira-line: <?php echo $is_dark ? 'rgba(255,255,255,.10)' : '#E2E8F0'; ?>;
				--vira-card: <?php echo $is_dark ? 'rgba(255,255,255,.04)' : '#F8FAFC'; ?>;
			}
			#<?php echo esc_attr( $unique_id ); ?>.vira-proc{
				padding:var(--vira-pad) 24px;background:var(--vira-bg);color:var(--vira-fg);
				font-family:'Vazirmatn','IRANSans',Tahoma,sans-serif;direction:rtl;
				position:relative;overflow:hidden;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-proc__inner{max-width:1240px;margin:0 auto;position:relative;z-index:1;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-proc__head{text-align:center;margin-bottom:64px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-proc__eyebrow{
				display:inline-flex;align-items:center;gap:8px;
				background:rgba(1,112,185,.12);color:var(--vira-active);
				border:1px solid rgba(1,112,185,.30);
				padding:8px 16px;border-radius:999px;font-size:14px;font-weight:600;margin-bottom:16px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-proc__eyebrow i{
				width:8px;height:8px;border-radius:50%;background:var(--vira-active);
				box-shadow:0 0 0 4px rgba(1,112,185,.20);display:inline-block;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-proc h2{font-size:clamp(28px,3.4vw,46px);font-weight:800;margin:0 0 16px;line-height:1.4;color:var(--vira-fg);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-proc h2 em{
				font-style:normal;
				background:linear-gradient(135deg,var(--vira-grad-from),var(--vira-grad-to));
				-webkit-background-clip:text;background-clip:text;color:transparent;-webkit-text-fill-color:transparent;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-proc__head p{color:var(--vira-fg-soft);font-size:18px;max-width:680px;margin:0 auto;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-proc__tl{display:grid;grid-template-columns:320px 1fr;gap:48px;align-items:start;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-proc__steps{display:flex;flex-direction:column;gap:0;position:relative;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-proc__steps::before{
				content:"";position:absolute;top:0;bottom:0;right:23px;width:2px;
				background:linear-gradient(180deg,var(--vira-grad-from),var(--vira-grad-to),var(--vira-line));
				border-radius:2px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-step{
				display:flex;align-items:center;gap:16px;padding:18px 16px;
				border-radius:16px;cursor:pointer;position:relative;
				transition:all .3s ease;background:transparent;border:1.5px solid transparent;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-step:hover{background:var(--vira-card);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-step.is-active{background:rgba(1,112,185,.08);border-color:rgba(1,112,185,.25);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-step__ring{
				width:46px;height:46px;border-radius:50%;display:grid;place-items:center;flex-shrink:0;
				background:var(--vira-card);border:2px solid var(--vira-line);
				color:var(--vira-fg-soft);font-weight:800;font-size:16px;
				transition:all .3s ease;position:relative;z-index:1;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-step.is-active .vira-step__ring{
				background:linear-gradient(135deg,var(--vira-grad-from),var(--vira-grad-to));
				border-color:var(--vira-active);color:#fff;
				box-shadow:0 0 24px rgba(1,112,185,.45);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-step__info{flex:1;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-step__info strong{display:block;font-size:16px;font-weight:700;color:var(--vira-fg);margin-bottom:2px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-step__info span{font-size:13px;color:var(--vira-fg-soft);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-step.is-active .vira-step__info span{color:var(--vira-active);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-proc__detail{
				background:var(--vira-card);border:1px solid var(--vira-line);
				border-radius:28px;padding:40px;min-height:380px;
				position:relative;overflow:hidden;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-proc__detail::before{
				content:"";position:absolute;top:0;left:0;right:0;height:3px;
				background:linear-gradient(90deg,var(--vira-grad-from),var(--vira-grad-to),transparent);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-proc__panel{display:none;animation:vira-proc-fade .4s ease;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-proc__panel.is-active{display:block;}
			@keyframes vira-proc-fade{from{opacity:0;transform:translateY(16px);}to{opacity:1;transform:none;}}
			#<?php echo esc_attr( $unique_id ); ?> .vira-proc__panel h3{font-size:24px;font-weight:800;margin:0 0 8px;color:var(--vira-fg);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-proc__panel .dur{
				display:inline-flex;align-items:center;gap:6px;
				background:rgba(1,112,185,.15);color:var(--vira-active);
				padding:4px 12px;border-radius:8px;font-size:13px;font-weight:600;margin-bottom:20px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-proc__panel p{color:var(--vira-fg-soft);line-height:1.95;font-size:15px;margin:0 0 22px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-proc__panel ul{list-style:none;padding:0;margin:0;display:grid;gap:12px;grid-template-columns:1fr 1fr;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-proc__panel li{display:flex;align-items:flex-start;gap:10px;color:var(--vira-fg);font-size:14.5px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-proc__panel li svg{flex-shrink:0;margin-top:3px;color:var(--vira-active);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-proc__progress{margin-top:48px;text-align:center;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-proc__progress-bar{height:6px;background:var(--vira-line);border-radius:3px;overflow:hidden;margin-bottom:12px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-proc__progress-fill{
				height:100%;background:linear-gradient(90deg,var(--vira-grad-from),var(--vira-grad-to));
				border-radius:3px;transition:width .6s ease;width:<?php echo (int) ( 100 / $count ); ?>%;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-proc__progress-label{color:var(--vira-fg-soft);font-size:13px;}
			@media(max-width:980px){
				#<?php echo esc_attr( $unique_id ); ?> .vira-proc__tl{grid-template-columns:1fr;gap:32px;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-proc__panel ul{grid-template-columns:1fr;}
			}
		</style>

		<section id="<?php echo esc_attr( $unique_id ); ?>" class="vira-proc" data-vira-process>
			<div class="vira-proc__inner">
				<div class="vira-proc__head">
					<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
						<span class="vira-proc__eyebrow"><i></i><?php echo esc_html( $settings['eyebrow'] ); ?></span>
					<?php endif; ?>
					<?php if ( ! empty( $settings['heading'] ) ) : ?>
						<h2><?php echo wp_kses_post( $settings['heading'] ); ?></h2>
					<?php endif; ?>
					<?php if ( ! empty( $settings['description'] ) ) : ?>
						<p><?php echo esc_html( $settings['description'] ); ?></p>
					<?php endif; ?>
				</div>

				<div class="vira-proc__tl">
					<div class="vira-proc__steps">
						<?php foreach ( $steps as $i => $step ) : ?>
							<div class="vira-step<?php echo 0 === $i ? ' is-active' : ''; ?>" data-step="<?php echo (int) $i; ?>">
								<div class="vira-step__ring"><?php echo esc_html( $step['step_number'] ); ?></div>
								<div class="vira-step__info">
									<strong><?php echo esc_html( $step['step_title'] ); ?></strong>
									<span><?php echo esc_html( $step['step_duration'] ); ?></span>
								</div>
							</div>
						<?php endforeach; ?>
					</div>

					<div class="vira-proc__detail">
						<?php foreach ( $steps as $i => $step ) :
							$features = ! empty( $step['panel_features'] ) && is_array( $step['panel_features'] ) ? $step['panel_features'] : array();
							?>
							<div class="vira-proc__panel<?php echo 0 === $i ? ' is-active' : ''; ?>" data-panel="<?php echo (int) $i; ?>">
								<h3><?php echo esc_html( $step['panel_title'] ); ?></h3>
								<?php if ( ! empty( $step['panel_duration_text'] ) ) : ?>
									<div class="dur">
										<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2" stroke-linecap="round"/></svg>
										<?php echo esc_html( $step['panel_duration_text'] ); ?>
									</div>
								<?php endif; ?>
								<?php if ( ! empty( $step['panel_description'] ) ) : ?>
									<p><?php echo esc_html( $step['panel_description'] ); ?></p>
								<?php endif; ?>
								<?php if ( ! empty( $features ) ) : ?>
									<ul>
										<?php foreach ( $features as $feat ) : ?>
											<?php if ( ! empty( $feat['feature_text'] ) ) : ?>
												<li>
													<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
													<?php echo esc_html( $feat['feature_text'] ); ?>
												</li>
											<?php endif; ?>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="vira-proc__progress">
					<div class="vira-proc__progress-bar"><div class="vira-proc__progress-fill" data-progress></div></div>
					<div class="vira-proc__progress-label" data-progress-label><?php printf( esc_html__( 'مرحله ۱ از %s', 'vira-sections' ), esc_html( $count ) ); ?></div>
				</div>
			</div>
		</section>

		<script>
		(function(){
			var root = document.getElementById('<?php echo esc_js( $unique_id ); ?>');
			if (!root) return;
			var steps = root.querySelectorAll('.vira-step');
			var panels = root.querySelectorAll('.vira-proc__panel');
			var fill = root.querySelector('[data-progress]');
			var label = root.querySelector('[data-progress-label]');
			var total = steps.length;
			function toFa(n){ return String(n).replace(/\d/g, function(d){ return '۰۱۲۳۴۵۶۷۸۹'[d]; }); }
			function activate(idx){
				steps.forEach(function(s,i){ s.classList.toggle('is-active', i===idx); });
				panels.forEach(function(p,i){ p.classList.toggle('is-active', i===idx); });
				if (fill) fill.style.width = (((idx+1)/total)*100) + '%';
				if (label) label.textContent = 'مرحله ' + toFa(idx+1) + ' از ' + toFa(total);
			}
			steps.forEach(function(s,i){ s.addEventListener('click', function(){ activate(i); resetAuto(); }); });
			var auto = null;
			<?php if ( $auto ) : ?>
			function startAuto(){
				auto = setInterval(function(){
					var active = root.querySelector('.vira-step.is-active');
					var idx = Array.prototype.indexOf.call(steps, active);
					activate((idx+1) % total);
				}, <?php echo (int) $interval; ?>);
			}
			function resetAuto(){ if(auto) clearInterval(auto); startAuto(); }
			startAuto();
			<?php else : ?>
			function resetAuto(){}
			<?php endif; ?>
		})();
		</script>
		<?php
	}
}
