<?php
/**
 * Vira Sections — Interactive Tabs Widget
 *
 * Two-column tabs (vertical nav + dark gradient detail panel) with
 * editable tab buttons, panel copy/features, three KPI metrics, and
 * optional auto-rotate.
 *
 * @package ViraSections
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Vira_Sections_Widget_Tabs
 */
class Vira_Sections_Widget_Tabs extends \Elementor\Widget_Base {

	use Vira_Sections_Preset_Trait;

	public function get_name() {
		return 'vira_tabs';
	}

	public function get_title() {
		return __( 'Interactive Tabs (Vira)', 'vira-sections' );
	}

	public function get_icon() {
		return 'eicon-tabs';
	}

	public function get_categories() {
		return array( 'vira-sections' );
	}

	public function get_keywords() {
		return array( 'vira', 'tabs', 'why-us', 'features', 'interactive' );
	}

	/**
	 * Register controls.
	 */
	protected function register_controls() {

		$this->register_preset_control();

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
				'default' => __( 'چرا ما', 'vira-sections' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'چه چیزی ما را <em>متفاوت</em> می‌کند؟', 'vira-sections' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'تجربه واقعی، روش‌های اثبات‌شده و حمایت بعد از پروژه — تفاوت ما در جزئیات است.', 'vira-sections' ),
				'rows'    => 3,
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * Tabs Repeater
		 * ============================================================ */
		$this->start_controls_section(
			'section_tabs',
			array(
				'label' => __( 'Tabs', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'tab_icon',
			array(
				'label'   => __( 'Tab Icon', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-star',
					'library' => 'fa-solid',
				),
			)
		);

		$repeater->add_control(
			'tab_title',
			array(
				'label'   => __( 'Tab Title', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'عنوان تب', 'vira-sections' ),
			)
		);

		$repeater->add_control(
			'tab_subtitle',
			array(
				'label'   => __( 'Tab Subtitle', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'توضیح کوتاه', 'vira-sections' ),
			)
		);

		$repeater->add_control(
			'panel_title',
			array(
				'label'   => __( 'Panel Title', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'عنوان پنل', 'vira-sections' ),
			)
		);

		$repeater->add_control(
			'panel_badge',
			array(
				'label'   => __( 'Panel Badge', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'برچسب', 'vira-sections' ),
			)
		);

		$repeater->add_control(
			'panel_description',
			array(
				'label'   => __( 'Panel Description', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'توضیح کامل درباره این تب و ارزش پیشنهادی به مشتری.', 'vira-sections' ),
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
				'default' => __( 'یک ویژگی کلیدی', 'vira-sections' ),
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
					array( 'feature_text' => __( 'ویژگی اول', 'vira-sections' ) ),
					array( 'feature_text' => __( 'ویژگی دوم', 'vira-sections' ) ),
					array( 'feature_text' => __( 'ویژگی سوم', 'vira-sections' ) ),
					array( 'feature_text' => __( 'ویژگی چهارم', 'vira-sections' ) ),
				),
			)
		);

		$repeater->add_control(
			'metric_1_value',
			array(
				'label'   => __( 'Metric 1 Value', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( '۸۰۰+', 'vira-sections' ),
			)
		);
		$repeater->add_control(
			'metric_1_label',
			array(
				'label'   => __( 'Metric 1 Label', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'مشتری', 'vira-sections' ),
			)
		);
		$repeater->add_control(
			'metric_2_value',
			array(
				'label'   => __( 'Metric 2 Value', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( '۹۲٪', 'vira-sections' ),
			)
		);
		$repeater->add_control(
			'metric_2_label',
			array(
				'label'   => __( 'Metric 2 Label', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'رضایت', 'vira-sections' ),
			)
		);
		$repeater->add_control(
			'metric_3_value',
			array(
				'label'   => __( 'Metric 3 Value', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( '۱۰ سال', 'vira-sections' ),
			)
		);
		$repeater->add_control(
			'metric_3_label',
			array(
				'label'   => __( 'Metric 3 Label', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'تجربه', 'vira-sections' ),
			)
		);

		$this->add_control(
			'tabs',
			array(
				'label'       => __( 'Tabs', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ tab_title }}}',
				'default'     => array(
					array(
						'tab_title'         => __( 'تجربه واقعی، نه تئوری', 'vira-sections' ),
						'tab_subtitle'      => __( '۱۰ سال تجربه عملی', 'vira-sections' ),
						'panel_title'       => __( 'تجربه واقعی', 'vira-sections' ),
						'panel_badge'       => __( '۱۰ سال در میدان', 'vira-sections' ),
						'panel_description' => __( 'ما فقط کتاب نخوندیم — هر روز با پروژه‌های واقعی کار می‌کنیم. آنچه ارائه می‌دهیم، آن چیزی است که خودمان امروز در پروژه‌های مشتریان استفاده می‌کنیم.', 'vira-sections' ),
					),
					array(
						'tab_title'         => __( 'محتوای به‌روز ۱۴۰۴', 'vira-sections' ),
						'tab_subtitle'      => __( 'الگوریتم‌های جدید', 'vira-sections' ),
						'panel_title'       => __( 'محتوای به‌روز', 'vira-sections' ),
						'panel_badge'       => __( 'Updated 2026', 'vira-sections' ),
						'panel_description' => __( 'فضای دیجیتال هر ۶ ماه عوض می‌شود. ما هر فصل سرفصل‌ها را به‌روزرسانی می‌کنیم تا با آخرین تغییرات هماهنگ باشید.', 'vira-sections' ),
					),
					array(
						'tab_title'         => __( 'پشتیبانی پس از تحویل', 'vira-sections' ),
						'tab_subtitle'      => __( 'پاسخگویی تا ۶ ماه', 'vira-sections' ),
						'panel_title'       => __( 'پشتیبانی پایدار', 'vira-sections' ),
						'panel_badge'       => __( 'تا ۶ ماه', 'vira-sections' ),
						'panel_description' => __( 'پروژه که تموم شد، تنها نیستی. در ۶ ماه پس از تحویل، می‌تونی سوالاتت رو مطرح کنی یا برای جلسات Q&A رایگان شرکت کنی.', 'vira-sections' ),
					),
					array(
						'tab_title'         => __( 'تیم بومی تبریز', 'vira-sections' ),
						'tab_subtitle'      => __( 'کیس‌استادی محلی', 'vira-sections' ),
						'panel_title'       => __( 'تیم بومی', 'vira-sections' ),
						'panel_badge'       => __( 'تبریز · آذربایجان', 'vira-sections' ),
						'panel_description' => __( 'به جای تیم‌های آنلاین تهرانی، اینجا تیمی داری که با کسب‌وکار تبریز آشناست. کیس‌استادی‌های ما از کسب‌وکارهای واقعی منطقه است.', 'vira-sections' ),
					),
				),
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * Settings (Auto-rotate)
		 * ============================================================ */
		$this->start_controls_section(
			'section_settings',
			array(
				'label' => __( 'Settings', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'auto_rotate',
			array(
				'label'        => __( 'Auto Rotate', 'vira-sections' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'rotate_interval',
			array(
				'label'   => __( 'Rotate Interval (ms)', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 6000,
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

		$this->add_control(
			'section_bg',
			array(
				'label'   => __( 'Background', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * STYLE — Colors / Gradient
		 * ============================================================ */
		$this->start_controls_section(
			'style_colors',
			array(
				'label' => __( 'Colors & Gradient', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'accent_color',
			array(
				'label'   => __( 'Accent Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#0170B9',
			)
		);

		$this->add_control(
			'nav_active_bg',
			array(
				'label'   => __( 'Nav Active Background', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#EFF6FF',
			)
		);

		$this->add_control(
			'panel_grad_from',
			array(
				'label'   => __( 'Panel Gradient 1', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#0a0640',
			)
		);

		$this->add_control(
			'panel_grad_to',
			array(
				'label'   => __( 'Panel Gradient 2', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#170C79',
			)
		);

		$this->add_control(
			'badge_color',
			array(
				'label'   => __( 'Badge Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#FBBF24',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render frontend output.
	 */
	protected function render() {
		$settings  = $this->get_settings_for_display();
		$unique_id = 'vira-tabs-' . $this->get_id();

		$bg          = ! empty( $settings['section_bg'] ) ? $settings['section_bg'] : '#FFFFFF';
		$pad         = ! empty( $settings['section_padding']['size'] ) ? (int) $settings['section_padding']['size'] : 110;
		$accent      = ! empty( $settings['accent_color'] ) ? $settings['accent_color'] : '#0170B9';
		$nav_active  = ! empty( $settings['nav_active_bg'] ) ? $settings['nav_active_bg'] : '#EFF6FF';
		$grad_from   = ! empty( $settings['panel_grad_from'] ) ? $settings['panel_grad_from'] : '#0a0640';
		$grad_to     = ! empty( $settings['panel_grad_to'] ) ? $settings['panel_grad_to'] : '#170C79';
		$badge_color = ! empty( $settings['badge_color'] ) ? $settings['badge_color'] : '#FBBF24';

		$auto     = ! empty( $settings['auto_rotate'] ) && 'yes' === $settings['auto_rotate'];
		$interval = ! empty( $settings['rotate_interval'] ) ? (int) $settings['rotate_interval'] : 6000;
		$tabs     = ! empty( $settings['tabs'] ) && is_array( $settings['tabs'] ) ? $settings['tabs'] : array();
		?>
		<style>
			#<?php echo esc_attr( $unique_id ); ?>{
				--vira-bg: <?php echo esc_attr( $bg ); ?>;
				--vira-pad: <?php echo (int) $pad; ?>px;
				--vira-accent: <?php echo esc_attr( $accent ); ?>;
				--vira-nav-active: <?php echo esc_attr( $nav_active ); ?>;
				--vira-grad-from: <?php echo esc_attr( $grad_from ); ?>;
				--vira-grad-to: <?php echo esc_attr( $grad_to ); ?>;
				--vira-badge: <?php echo esc_attr( $badge_color ); ?>;
			}
			#<?php echo esc_attr( $unique_id ); ?>.vira-tabs{
				padding:var(--vira-pad) 24px;background:var(--vira-bg);
				font-family:'Vazirmatn','IRANSans',Tahoma,sans-serif;direction:rtl;color:#1D2327;
				position:relative;overflow:hidden;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tabs__inner{max-width:1240px;margin:0 auto;position:relative;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tabs__head{text-align:center;margin-bottom:60px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tabs__eyebrow{
				display:inline-flex;align-items:center;gap:8px;
				background:rgba(1,112,185,.10);color:var(--vira-accent);
				border:1px solid rgba(1,112,185,.25);
				padding:8px 16px;border-radius:999px;font-size:14px;font-weight:600;margin-bottom:16px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tabs__eyebrow i{
				width:8px;height:8px;border-radius:50%;background:var(--vira-accent);
				box-shadow:0 0 0 4px rgba(1,112,185,.16);display:inline-block;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tabs h2{font-size:clamp(28px,3.4vw,46px);font-weight:800;margin:0 0 16px;line-height:1.4;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tabs h2 em{
				font-style:normal;
				background:linear-gradient(135deg,var(--vira-grad-from),var(--vira-accent));
				-webkit-background-clip:text;background-clip:text;color:transparent;-webkit-text-fill-color:transparent;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tabs__head p{color:#64748B;font-size:18px;max-width:680px;margin:0 auto;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tabs__shell{
				display:grid;grid-template-columns:1fr 1.4fr;gap:32px;align-items:stretch;
				background:#fff;border:1px solid #E2E8F0;border-radius:32px;padding:32px;
				box-shadow:0 24px 60px rgba(1,112,185,.06);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tabs__nav{display:flex;flex-direction:column;gap:10px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tab-btn{
				display:flex;align-items:center;gap:14px;
				padding:18px 20px;border-radius:18px;cursor:pointer;
				background:transparent;border:1.5px solid transparent;
				text-align:right;transition:all .3s ease;
				font-family:inherit;font-size:16px;color:#1D2327;width:100%;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tab-btn:hover{background:var(--vira-nav-active);border-color:rgba(1,112,185,.18);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tab-btn.is-active{background:var(--vira-nav-active);border-color:rgba(1,112,185,.30);box-shadow:0 12px 30px rgba(1,112,185,.10);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tab-btn .ic{
				width:46px;height:46px;border-radius:12px;display:grid;place-items:center;
				background:rgba(1,112,185,.10);color:var(--vira-accent);flex-shrink:0;
				transition:all .3s ease;font-size:22px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tab-btn.is-active .ic{
				background:linear-gradient(135deg,var(--vira-accent),#128BE0);color:#fff;
				transform:scale(1.05);box-shadow:0 6px 14px rgba(1,112,185,.30);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tab-btn .lbl{display:flex;flex-direction:column;gap:2px;flex:1;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tab-btn .lbl strong{font-weight:800;font-size:16.5px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tab-btn .lbl small{color:#64748B;font-size:13px;font-weight:400;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tabs__panels{
				position:relative;
				background:linear-gradient(160deg,var(--vira-grad-from) 0%,var(--vira-grad-to) 100%);
				border-radius:24px;padding:36px;color:#fff;overflow:hidden;min-height:420px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-panel{
				position:absolute;inset:36px;opacity:0;transform:translateY(20px);
				transition:opacity .4s ease,transform .4s ease;pointer-events:none;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-panel.is-active{opacity:1;transform:none;pointer-events:auto;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-panel h3{
				font-size:22px;font-weight:800;margin:0 0 12px;color:#fff;
				display:flex;align-items:center;gap:10px;flex-wrap:wrap;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-panel h3 .badge{
				background:rgba(251,191,36,.20);color:var(--vira-badge);
				font-size:11px;padding:4px 10px;border-radius:999px;font-weight:700;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-panel p{color:rgba(255,255,255,.78);line-height:1.95;margin:0 0 20px;font-size:15px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-panel ul{list-style:none;padding:0;margin:0;display:grid;gap:10px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-panel li{display:flex;align-items:flex-start;gap:10px;color:rgba(255,255,255,.92);font-size:14.5px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-panel li svg{flex-shrink:0;margin-top:4px;color:var(--vira-badge);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-panel__metrics{
				display:flex;gap:16px;flex-wrap:wrap;margin-top:22px;padding:16px;
				background:rgba(0,0,0,.30);border:1px solid rgba(255,255,255,.10);border-radius:14px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-panel__metrics > div{flex:1;min-width:100px;text-align:center;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-panel__metrics .num{color:var(--vira-badge);font-weight:900;font-size:26px;line-height:1;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-panel__metrics .lbl{color:rgba(255,255,255,.55);font-size:11px;margin-top:4px;}
			@media(max-width:980px){
				#<?php echo esc_attr( $unique_id ); ?> .vira-tabs__shell{grid-template-columns:1fr;padding:20px;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-tabs__panels{min-height:460px;padding:28px;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-panel{inset:28px;}
			}

			/* === Animated Tab Indicator === */
			#<?php echo esc_attr( $unique_id ); ?> .vira-tabs__nav{position:relative;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tabs__indicator{
				position:absolute;right:0;width:4px;border-radius:4px;
				background:linear-gradient(180deg,var(--vira-accent),var(--vira-grad-from));
				transition:top .4s cubic-bezier(.4,0,.2,1),height .4s cubic-bezier(.4,0,.2,1);
				pointer-events:none;z-index:2;
			}

			/* === Smooth Height Transition for Panels === */
			#<?php echo esc_attr( $unique_id ); ?> .vira-tabs__panels{
				transition:height .4s cubic-bezier(.4,0,.2,1);
			}

			/* === Gradient Mesh Background Animation === */
			@keyframes <?php echo esc_attr( $unique_id ); ?>-mesh{
				0%{background-position:0% 50%;}
				50%{background-position:100% 50%;}
				100%{background-position:0% 50%;}
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tabs__panels::after{
				content:"";position:absolute;inset:0;border-radius:24px;
				background:linear-gradient(160deg,var(--vira-grad-from) 0%,var(--vira-grad-to) 50%,rgba(1,112,185,.3) 100%);
				background-size:200% 200%;
				animation:<?php echo esc_attr( $unique_id ); ?>-mesh 8s ease-in-out infinite;
				opacity:.15;pointer-events:none;z-index:0;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-panel{z-index:1;}

			/* === Entrance Animation === */
			#<?php echo esc_attr( $unique_id ); ?>.vira-tabs{
				opacity:0;transform:translateY(30px);
			}
			#<?php echo esc_attr( $unique_id ); ?>.vira-tabs.vira-visible{
				opacity:1;transform:translateY(0);
				transition:opacity .7s cubic-bezier(.4,0,.2,1),transform .7s cubic-bezier(.4,0,.2,1);
			}

			/* === Reduced Motion === */
			@media(prefers-reduced-motion:reduce){
				#<?php echo esc_attr( $unique_id ); ?>.vira-tabs{opacity:1;transform:none;transition:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-tabs__panels::after{animation:none;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-tabs__indicator{transition:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-tabs__panels{transition:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-panel{transition:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-tab-btn{transition:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-tab-btn .ic{transition:none !important;}
			}
		</style>

		<section id="<?php echo esc_attr( $unique_id ); ?>" class="vira-tabs" data-vira-tabs>
			<div class="vira-tabs__inner">
				<div class="vira-tabs__head">
					<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
						<span class="vira-tabs__eyebrow"><i></i><?php echo esc_html( $settings['eyebrow'] ); ?></span>
					<?php endif; ?>
					<?php if ( ! empty( $settings['heading'] ) ) : ?>
						<h2><?php echo wp_kses_post( $settings['heading'] ); ?></h2>
					<?php endif; ?>
					<?php if ( ! empty( $settings['description'] ) ) : ?>
						<p><?php echo esc_html( $settings['description'] ); ?></p>
					<?php endif; ?>
				</div>

				<div class="vira-tabs__shell">
					<div class="vira-tabs__nav" role="tablist">
						<?php foreach ( $tabs as $i => $tab ) : ?>
							<button class="vira-tab-btn<?php echo 0 === $i ? ' is-active' : ''; ?>" data-tab="<?php echo (int) $i; ?>" role="tab" aria-selected="<?php echo 0 === $i ? 'true' : 'false'; ?>" type="button">
								<span class="ic">
									<?php if ( ! empty( $tab['tab_icon'] ) ) : ?>
										<?php \Elementor\Icons_Manager::render_icon( $tab['tab_icon'], array( 'aria-hidden' => 'true' ) ); ?>
									<?php endif; ?>
								</span>
								<span class="lbl">
									<strong><?php echo esc_html( $tab['tab_title'] ); ?></strong>
									<?php if ( ! empty( $tab['tab_subtitle'] ) ) : ?>
										<small><?php echo esc_html( $tab['tab_subtitle'] ); ?></small>
									<?php endif; ?>
								</span>
							</button>
						<?php endforeach; ?>
						<div class="vira-tabs__indicator" data-indicator></div>
					</div>

					<div class="vira-tabs__panels">
						<?php foreach ( $tabs as $i => $tab ) :
							$features = ! empty( $tab['panel_features'] ) && is_array( $tab['panel_features'] ) ? $tab['panel_features'] : array();
							?>
							<div class="vira-panel<?php echo 0 === $i ? ' is-active' : ''; ?>" data-panel="<?php echo (int) $i; ?>">
								<h3>
									<?php echo esc_html( $tab['panel_title'] ); ?>
									<?php if ( ! empty( $tab['panel_badge'] ) ) : ?>
										<span class="badge"><?php echo esc_html( $tab['panel_badge'] ); ?></span>
									<?php endif; ?>
								</h3>
								<?php if ( ! empty( $tab['panel_description'] ) ) : ?>
									<p><?php echo esc_html( $tab['panel_description'] ); ?></p>
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
								<div class="vira-panel__metrics">
									<div><div class="num"><?php echo esc_html( $tab['metric_1_value'] ); ?></div><div class="lbl"><?php echo esc_html( $tab['metric_1_label'] ); ?></div></div>
									<div><div class="num"><?php echo esc_html( $tab['metric_2_value'] ); ?></div><div class="lbl"><?php echo esc_html( $tab['metric_2_label'] ); ?></div></div>
									<div><div class="num"><?php echo esc_html( $tab['metric_3_value'] ); ?></div><div class="lbl"><?php echo esc_html( $tab['metric_3_label'] ); ?></div></div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</section>

		<script>
		(function(){
			var root = document.getElementById('<?php echo esc_js( $unique_id ); ?>');
			if (!root) return;
			var btns = root.querySelectorAll('.vira-tab-btn');
			var panels = root.querySelectorAll('.vira-panel');
			var indicator = root.querySelector('[data-indicator]');
			var panelsWrap = root.querySelector('.vira-tabs__panels');

			function moveIndicator(idx){
				if (!indicator || !btns[idx]) return;
				var btn = btns[idx];
				var nav = btn.parentElement;
				var navRect = nav.getBoundingClientRect();
				var btnRect = btn.getBoundingClientRect();
				indicator.style.top = (btnRect.top - navRect.top) + 'px';
				indicator.style.height = btnRect.height + 'px';
			}

			function adjustHeight(){
				if (!panelsWrap) return;
				var activePanel = root.querySelector('.vira-panel.is-active');
				if (activePanel) {
					panelsWrap.style.height = activePanel.scrollHeight + 72 + 'px';
				}
			}

			function activate(idx){
				btns.forEach(function(b,i){
					var a = (i===idx);
					b.classList.toggle('is-active', a);
					b.setAttribute('aria-selected', a ? 'true' : 'false');
				});
				panels.forEach(function(p,i){ p.classList.toggle('is-active', i===idx); });
				moveIndicator(idx);
				adjustHeight();
			}
			btns.forEach(function(b,i){ b.addEventListener('click', function(){ activate(i); resetAuto(); }); });

			// Initial indicator position
			moveIndicator(0);
			adjustHeight();

			// IntersectionObserver entrance animation
			var reduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
			if (reduced) {
				root.classList.add('vira-visible');
			} else {
				var obs = new IntersectionObserver(function(entries){
					entries.forEach(function(entry){
						if (entry.isIntersecting) {
							root.classList.add('vira-visible');
							obs.unobserve(entry.target);
						}
					});
				}, { threshold: 0.1 });
				obs.observe(root);
			}

			var auto = null;
			<?php if ( $auto ) : ?>
			function startAuto(){
				auto = setInterval(function(){
					var active = root.querySelector('.vira-tab-btn.is-active');
					var idx = Array.prototype.indexOf.call(btns, active);
					activate((idx+1) % btns.length);
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
