<?php
/**
 * Vira Sections — Trust Strip + Showcase Widget
 *
 * Two-mode widget:
 *  - "showcase":   Header + Device tabs (desktop/tablet/mobile) showing
 *                  a CSS mockup that resizes + a logos strip below.
 *  - "logos_only": Just a centered title + logos strip (compact).
 *
 * @package ViraSections
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Vira_Sections_Widget_Trust_Strip
 */
class Vira_Sections_Widget_Trust_Strip extends \Elementor\Widget_Base {

	use Vira_Sections_Preset_Trait;

	public function get_name() {
		return 'vira_trust_strip';
	}

	public function get_title() {
		return __( 'Trust Strip + Showcase (Vira)', 'vira-sections' );
	}

	public function get_icon() {
		return 'eicon-image-rollover';
	}

	public function get_categories() {
		return array( 'vira-sections' );
	}

	public function get_keywords() {
		return array( 'vira', 'trust', 'logos', 'clients', 'showcase', 'devices', 'responsive' );
	}

	/**
	 * Register Elementor controls.
	 */
	protected function register_controls() {

		$this->register_preset_control();

		/* ============================================================
		 * Mode
		 * ============================================================ */
		$this->start_controls_section(
			'section_mode',
			array(
				'label' => __( 'Mode', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'mode',
			array(
				'label'   => __( 'Display Mode', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'showcase',
				'options' => array(
					'showcase'   => __( 'Showcase (devices + logos)', 'vira-sections' ),
					'logos_only' => __( 'Logos Only (compact)', 'vira-sections' ),
				),
			)
		);

		$this->end_controls_section();

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
				'label'       => __( 'Eyebrow Text', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'کاملاً ریسپانسیو', 'vira-sections' ),
				'label_block' => true,
				'condition'   => array( 'mode' => 'showcase' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'روی هر دستگاهی، <em>بی‌نقص</em>', 'vira-sections' ),
				'label_block' => true,
				'description' => __( 'Wrap highlighted words in &lt;em&gt;...&lt;/em&gt; for accent color.', 'vira-sections' ),
				'condition'   => array( 'mode' => 'showcase' ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'     => __( 'Description', 'vira-sections' ),
				'type'      => \Elementor\Controls_Manager::TEXTAREA,
				'default'   => __( 'روی دستگاه مورد نظر کلیک کنید و ببینید سایت چطور نمایش داده می‌شود.', 'vira-sections' ),
				'rows'      => 3,
				'condition' => array( 'mode' => 'showcase' ),
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * Device Tabs (Showcase mode only)
		 * ============================================================ */
		$this->start_controls_section(
			'section_devices',
			array(
				'label'     => __( 'Device Tabs', 'vira-sections' ),
				'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => array( 'mode' => 'showcase' ),
			)
		);

		$this->add_control(
			'desktop_label',
			array(
				'label'   => __( 'Desktop Label', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'دسکتاپ', 'vira-sections' ),
			)
		);

		$this->add_control(
			'tablet_label',
			array(
				'label'   => __( 'Tablet Label', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'تبلت', 'vira-sections' ),
			)
		);

		$this->add_control(
			'mobile_label',
			array(
				'label'   => __( 'Mobile Label', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'موبایل', 'vira-sections' ),
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * Logos Strip
		 * ============================================================ */
		$this->start_controls_section(
			'section_logos',
			array(
				'label' => __( 'Logos Strip', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'logos_title',
			array(
				'label'   => __( 'Logos Title', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'اعتماد بیش از ۴۵۰ کسب‌وکار ایرانی', 'vira-sections' ),
			)
		);

		$logo_rep = new \Elementor\Repeater();

		$logo_rep->add_control(
			'logo_image',
			array(
				'label'   => __( 'Logo Image (optional)', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array( 'url' => '' ),
			)
		);

		$logo_rep->add_control(
			'logo_text',
			array(
				'label'   => __( 'Logo Text (fallback)', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'BRAND', 'vira-sections' ),
			)
		);

		$logo_rep->add_control(
			'logo_name',
			array(
				'label'   => __( 'Logo Name (a11y)', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Brand', 'vira-sections' ),
			)
		);

		$this->add_control(
			'logos',
			array(
				'label'       => __( 'Logos', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $logo_rep->get_controls(),
				'title_field' => '{{{ logo_text }}}',
				'default'     => array(
					array( 'logo_text' => __( 'BRAND/۱', 'vira-sections' ),  'logo_name' => __( 'Brand 1', 'vira-sections' ) ),
					array( 'logo_text' => __( 'NAVA', 'vira-sections' ),      'logo_name' => __( 'Nava', 'vira-sections' ) ),
					array( 'logo_text' => __( 'PIXEL+', 'vira-sections' ),    'logo_name' => __( 'Pixel Plus', 'vira-sections' ) ),
					array( 'logo_text' => __( 'FORTECH', 'vira-sections' ),   'logo_name' => __( 'Fortech', 'vira-sections' ) ),
					array( 'logo_text' => __( 'AVA·CO', 'vira-sections' ),    'logo_name' => __( 'AvaCo', 'vira-sections' ) ),
					array( 'logo_text' => __( 'NEXTLY', 'vira-sections' ),    'logo_name' => __( 'Nextly', 'vira-sections' ) ),
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
				'range'      => array( 'px' => array( 'min' => 30, 'max' => 200 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 90 ),
			)
		);

		$this->add_control(
			'bg_grad_from',
			array(
				'label'   => __( 'Background Gradient — Top', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
			)
		);

		$this->add_control(
			'bg_grad_to',
			array(
				'label'   => __( 'Background Gradient — Bottom', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#FAF6EC',
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
				'default' => '#170C79',
			)
		);

		$this->add_control(
			'logo_color',
			array(
				'label'   => __( 'Logo Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#1D2327',
			)
		);

		$this->add_control(
			'logo_hover_color',
			array(
				'label'   => __( 'Logo Hover Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#170C79',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render frontend output.
	 */
	protected function render() {
		$settings  = $this->get_settings_for_display();
		$unique_id = 'vira-trust-' . $this->get_id();

		$mode      = ! empty( $settings['mode'] ) ? $settings['mode'] : 'showcase';
		$pad       = ! empty( $settings['section_padding']['size'] ) ? (int) $settings['section_padding']['size'] : 90;
		$bg_from   = ! empty( $settings['bg_grad_from'] ) ? $settings['bg_grad_from'] : '#FFFFFF';
		$bg_to     = ! empty( $settings['bg_grad_to'] ) ? $settings['bg_grad_to'] : '#FAF6EC';
		$accent    = ! empty( $settings['accent_color'] ) ? $settings['accent_color'] : '#170C79';
		$lcolor    = ! empty( $settings['logo_color'] ) ? $settings['logo_color'] : '#1D2327';
		$lhover    = ! empty( $settings['logo_hover_color'] ) ? $settings['logo_hover_color'] : '#170C79';
		$logos     = ! empty( $settings['logos'] ) && is_array( $settings['logos'] ) ? $settings['logos'] : array();

		$desktop_label = ! empty( $settings['desktop_label'] ) ? $settings['desktop_label'] : __( 'دسکتاپ', 'vira-sections' );
		$tablet_label  = ! empty( $settings['tablet_label'] ) ? $settings['tablet_label'] : __( 'تبلت', 'vira-sections' );
		$mobile_label  = ! empty( $settings['mobile_label'] ) ? $settings['mobile_label'] : __( 'موبایل', 'vira-sections' );
		?>
		<style>
			#<?php echo esc_attr( $unique_id ); ?>{
				--vira-pad: <?php echo (int) $pad; ?>px;
				--vira-bg-from: <?php echo esc_attr( $bg_from ); ?>;
				--vira-bg-to: <?php echo esc_attr( $bg_to ); ?>;
				--vira-accent: <?php echo esc_attr( $accent ); ?>;
				--vira-logo: <?php echo esc_attr( $lcolor ); ?>;
				--vira-logo-hover: <?php echo esc_attr( $lhover ); ?>;
			}
			#<?php echo esc_attr( $unique_id ); ?>.vira-trust{
				padding: var(--vira-pad) 24px;
				background: linear-gradient(180deg, var(--vira-bg-from) 0%, var(--vira-bg-to) 100%);
				font-family:'Vazirmatn','IRANSans',Tahoma,sans-serif;direction:rtl;color:#1D2327;
				position:relative;overflow:hidden;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-trust__inner{max-width:1240px;margin:0 auto;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-trust__head{text-align:center;margin-bottom:36px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-trust__eyebrow{
				display:inline-flex;align-items:center;gap:8px;
				background:rgba(23,12,121,.08);color:var(--vira-accent);
				border:1px solid rgba(23,12,121,.18);
				padding:8px 16px;border-radius:999px;font-size:14px;font-weight:600;margin-bottom:16px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-trust__eyebrow i{
				width:8px;height:8px;border-radius:50%;background:var(--vira-accent);
				box-shadow:0 0 0 4px rgba(23,12,121,.18);display:inline-block;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-trust h2{font-size:clamp(24px,2.6vw,36px);font-weight:800;margin:0 0 12px;line-height:1.4;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-trust h2 em{
				font-style:normal;
				background:linear-gradient(135deg,var(--vira-accent),#128BE0);
				-webkit-background-clip:text;background-clip:text;color:transparent;-webkit-text-fill-color:transparent;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-trust__head p{color:#64748B;font-size:16px;max-width:560px;margin:0 auto;}

			/* Device Tabs */
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev-tabs{
				display:flex;justify-content:center;gap:10px;
				background:rgba(23,12,121,.05);padding:6px;
				border-radius:14px;max-width:fit-content;margin:0 auto 32px;
				border:1px solid rgba(23,12,121,.08);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev-tab{
				padding:10px 20px;border-radius:10px;
				background:transparent;border:none;cursor:pointer;
				font-family:inherit;font-size:14px;font-weight:600;
				color:#64748B;display:inline-flex;align-items:center;gap:8px;
				transition:all .25s ease;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev-tab:hover{color:var(--vira-accent);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev-tab.is-active{
				background:#fff;color:var(--vira-accent);
				box-shadow:0 4px 12px rgba(23,12,121,.10);
			}

			/* Device Stage */
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev-stage{
				display:grid;place-items:center;
				min-height:420px;margin-bottom:60px;position:relative;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev{
				background:#1a1268;border-radius:18px;
				position:absolute;transition:all .55s cubic-bezier(.4,0,.2,1);
				border:8px solid #0e0a3e;
				box-shadow:0 30px 80px rgba(23,12,121,.30);
				opacity:0;pointer-events:none;overflow:hidden;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev.is-active{opacity:1;pointer-events:auto;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev__screen{
				background:linear-gradient(160deg,#fff,#FAF6EC);
				width:100%;height:100%;padding:14px;
				display:flex;flex-direction:column;gap:8px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev__bar{
				height:24px;border-radius:6px;
				background:linear-gradient(90deg,var(--vira-accent),#128BE0);
				position:relative;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev__bar::after{
				content:"";position:absolute;left:8px;top:50%;transform:translateY(-50%);
				width:40%;height:6px;background:rgba(255,255,255,.7);border-radius:3px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev__hero{
				flex:1;min-height:60px;border-radius:8px;
				background:radial-gradient(circle at 80% 20%, rgba(138,203,208,.5), transparent 50%),
					linear-gradient(135deg,#FAF6EC,#EFE3CA);
				position:relative;padding:16px;
				display:flex;flex-direction:column;gap:6px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev__hero::before{
				content:"";width:60%;height:8px;background:var(--vira-accent);border-radius:4px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev__hero::after{
				content:"";width:40%;height:6px;background:#0170B9;border-radius:3px;opacity:.5;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev__btn{
				position:absolute;bottom:14px;right:14px;
				width:40%;height:14px;border-radius:6px;
				background:linear-gradient(135deg,var(--vira-accent),#128BE0);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev__row{height:6px;background:rgba(23,12,121,.10);border-radius:3px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev__row--s{width:60%;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev__grid{display:grid;grid-template-columns:repeat(3,1fr);gap:6px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev__grid > div{
				height:36px;border-radius:6px;background:rgba(23,12,121,.06);
				border:1px solid rgba(23,12,121,.08);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev__grid > div:nth-child(2){
				background:linear-gradient(135deg,rgba(138,203,208,.40),rgba(18,139,224,.20));
				border-color:rgba(138,203,208,.50);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev--desktop{width:600px;aspect-ratio:16/10;border-radius:16px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev--tablet{width:380px;aspect-ratio:4/5;border-radius:24px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev--mobile{width:200px;aspect-ratio:9/19;border-radius:30px;border-width:6px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev--desktop::before{
				content:"";position:absolute;bottom:-20px;left:50%;transform:translateX(-50%);
				width:120%;height:14px;background:#0e0a3e;border-radius:3px;z-index:-1;
			}

			/* Logos Strip */
			#<?php echo esc_attr( $unique_id ); ?> .vira-strip__title{
				text-align:center;color:var(--vira-accent);
				font-size:13px;letter-spacing:2px;font-weight:700;
				margin-bottom:24px;text-transform:uppercase;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-strip__logos{
				display:flex;justify-content:space-around;align-items:center;
				flex-wrap:wrap;gap:36px;padding:24px 0;
				border-block:1px solid rgba(23,12,121,.10);
				position:relative;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-strip__logos .vira-logo{
				font-weight:800;color:var(--vira-logo);
				font-size:22px;letter-spacing:-.5px;
				opacity:.55;transition:all .25s ease;cursor:pointer;
				display:inline-flex;align-items:center;gap:8px;
				background:none;border:none;font-family:inherit;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-strip__logos .vira-logo:hover{
				opacity:1;transform:scale(1.05);color:var(--vira-logo-hover);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-strip__logos img{
				max-height:38px;width:auto;display:block;
				filter:grayscale(100%);transition:filter .25s ease;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-strip__logos .vira-logo:hover img{filter:none;}

			/* Logos-only mode */
			#<?php echo esc_attr( $unique_id ); ?>.vira-trust--logos-only .vira-strip__logos{
				justify-content:center;
			}

			@media(max-width:880px){
				#<?php echo esc_attr( $unique_id ); ?> .vira-dev--desktop{width:90%;max-width:500px;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-dev--tablet{width:280px;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-strip__logos{gap:24px;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-strip__logos .vira-logo{font-size:18px;}
			}
			/* Infinite marquee scroll animation for logos */
			@keyframes vira-trust-marquee{
				0%{transform:translateX(0);}
				100%{transform:translateX(-50%);}
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-strip__logos--marquee{
				display:flex;flex-wrap:nowrap;justify-content:flex-start;
				overflow:hidden;gap:0;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-strip__logos--marquee .vira-strip__marquee-track{
				display:flex;gap:48px;align-items:center;
				animation:vira-trust-marquee 25s linear infinite;
				flex-shrink:0;padding:24px 24px;
			}
			/* Logo hover tooltip */
			#<?php echo esc_attr( $unique_id ); ?> .vira-strip__logos .vira-logo{
				position:relative;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-strip__logos .vira-logo::after{
				content:attr(aria-label);
				position:absolute;bottom:calc(100% + 8px);left:50%;transform:translateX(-50%) scale(0.8);
				background:var(--vira-accent);color:#fff;
				padding:4px 10px;border-radius:6px;font-size:12px;font-weight:600;
				white-space:nowrap;opacity:0;pointer-events:none;
				transition:opacity .2s ease,transform .2s ease;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-strip__logos .vira-logo:hover::after{
				opacity:1;transform:translateX(-50%) scale(1);
			}
			/* Showcase mode entrance animation */
			#<?php echo esc_attr( $unique_id ); ?> .vira-trust__head.vira-entrance{
				opacity:0;transform:translateY(30px);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-trust__head.vira-entrance-in{
				opacity:1;transform:translateY(0);
				transition:opacity .6s cubic-bezier(.4,0,.2,1),transform .6s cubic-bezier(.4,0,.2,1);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev-stage.vira-entrance{
				opacity:0;transform:translateY(40px) scale(0.96);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev-stage.vira-entrance-in{
				opacity:1;transform:translateY(0) scale(1);
				transition:opacity .7s cubic-bezier(.4,0,.2,1) .15s,transform .7s cubic-bezier(.4,0,.2,1) .15s;
			}
			/* Device mockup breathing/float animation */
			@keyframes vira-trust-breathe{
				0%,100%{transform:translateY(0);}
				50%{transform:translateY(-6px);}
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-dev.is-active{
				animation:vira-trust-breathe 4s ease-in-out infinite;
			}
			/* Reduced motion support */
			@media(prefers-reduced-motion: reduce){
				#<?php echo esc_attr( $unique_id ); ?> .vira-strip__logos--marquee .vira-strip__marquee-track{animation:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-dev.is-active{animation:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-trust__head.vira-entrance{opacity:1;transform:none;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-trust__head.vira-entrance-in{transition:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-dev-stage.vira-entrance{opacity:1;transform:none;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-dev-stage.vira-entrance-in{transition:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-strip__logos .vira-logo{transition:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-dev-tab{transition:none !important;}
			}
		</style>

		<section id="<?php echo esc_attr( $unique_id ); ?>" class="vira-trust<?php echo 'logos_only' === $mode ? ' vira-trust--logos-only' : ''; ?>" data-vira-trust>
			<div class="vira-trust__inner">

				<?php if ( 'showcase' === $mode ) : ?>
					<div class="vira-trust__head">
						<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
							<span class="vira-trust__eyebrow"><i></i><?php echo esc_html( $settings['eyebrow'] ); ?></span>
						<?php endif; ?>
						<?php if ( ! empty( $settings['heading'] ) ) : ?>
							<h2><?php echo wp_kses_post( $settings['heading'] ); ?></h2>
						<?php endif; ?>
						<?php if ( ! empty( $settings['description'] ) ) : ?>
							<p><?php echo esc_html( $settings['description'] ); ?></p>
						<?php endif; ?>
					</div>

					<div class="vira-dev-tabs" role="tablist">
						<button type="button" class="vira-dev-tab is-active" data-dev="desktop" role="tab" aria-selected="true">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4" stroke-linecap="round"/></svg>
							<?php echo esc_html( $desktop_label ); ?>
						</button>
						<button type="button" class="vira-dev-tab" data-dev="tablet" role="tab" aria-selected="false">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="4" y="2" width="16" height="20" rx="2"/><path d="M11 18h2"/></svg>
							<?php echo esc_html( $tablet_label ); ?>
						</button>
						<button type="button" class="vira-dev-tab" data-dev="mobile" role="tab" aria-selected="false">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="6" y="2" width="12" height="20" rx="2"/><path d="M11 18h2"/></svg>
							<?php echo esc_html( $mobile_label ); ?>
						</button>
					</div>

					<div class="vira-dev-stage" data-vira-stage>
						<?php
						$frames = array( 'desktop', 'tablet', 'mobile' );
						foreach ( $frames as $f ) :
							$active_cls = 'desktop' === $f ? ' is-active' : '';
							?>
							<div class="vira-dev vira-dev--<?php echo esc_attr( $f ); ?><?php echo esc_attr( $active_cls ); ?>" data-frame="<?php echo esc_attr( $f ); ?>">
								<div class="vira-dev__screen">
									<div class="vira-dev__bar"></div>
									<div class="vira-dev__hero"><div class="vira-dev__btn"></div></div>
									<?php if ( 'mobile' !== $f ) : ?>
										<div class="vira-dev__grid"><div></div><div></div><div></div></div>
									<?php endif; ?>
									<div class="vira-dev__row"></div>
									<div class="vira-dev__row vira-dev__row--s"></div>
									<?php if ( 'mobile' === $f ) : ?>
										<div class="vira-dev__row"></div>
									<?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $settings['logos_title'] ) ) : ?>
					<div class="vira-strip__title"><?php echo esc_html( $settings['logos_title'] ); ?></div>
				<?php endif; ?>

				<?php if ( ! empty( $logos ) ) : ?>
					<div class="vira-strip__logos vira-strip__logos--marquee">
						<div class="vira-strip__marquee-track">
						<?php foreach ( $logos as $logo ) :
							$has_image = ! empty( $logo['logo_image']['url'] );
							$alt       = ! empty( $logo['logo_name'] ) ? $logo['logo_name'] : ( ! empty( $logo['logo_text'] ) ? $logo['logo_text'] : '' );
							?>
							<span class="vira-logo" role="img" aria-label="<?php echo esc_attr( $alt ); ?>">
								<?php if ( $has_image ) : ?>
									<img src="<?php echo esc_url( $logo['logo_image']['url'] ); ?>" alt="<?php echo esc_attr( $alt ); ?>" loading="lazy" />
								<?php else : ?>
									<?php echo esc_html( $logo['logo_text'] ); ?>
								<?php endif; ?>
							</span>
						<?php endforeach; ?>
						</div>
						<div class="vira-strip__marquee-track" aria-hidden="true">
						<?php foreach ( $logos as $logo ) :
							$has_image = ! empty( $logo['logo_image']['url'] );
							$alt       = ! empty( $logo['logo_name'] ) ? $logo['logo_name'] : ( ! empty( $logo['logo_text'] ) ? $logo['logo_text'] : '' );
							?>
							<span class="vira-logo" role="img" aria-label="<?php echo esc_attr( $alt ); ?>">
								<?php if ( $has_image ) : ?>
									<img src="<?php echo esc_url( $logo['logo_image']['url'] ); ?>" alt="<?php echo esc_attr( $alt ); ?>" loading="lazy" />
								<?php else : ?>
									<?php echo esc_html( $logo['logo_text'] ); ?>
								<?php endif; ?>
							</span>
						<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>

			</div>
		</section>

		<?php if ( 'showcase' === $mode ) : ?>
		<script>
		(function(){
			var root = document.getElementById('<?php echo esc_js( $unique_id ); ?>');
			if (!root) return;
			var tabs = root.querySelectorAll('.vira-dev-tab');
			var frames = root.querySelectorAll('[data-vira-stage] .vira-dev');
			tabs.forEach(function(t){
				t.addEventListener('click', function(){
					tabs.forEach(function(x){ x.classList.remove('is-active'); x.setAttribute('aria-selected','false'); });
					t.classList.add('is-active');
					t.setAttribute('aria-selected','true');
					var dev = t.getAttribute('data-dev');
					frames.forEach(function(f){
						f.classList.toggle('is-active', f.getAttribute('data-frame') === dev);
					});
				});
			});

			/* IntersectionObserver entrance animation */
			var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
			if (!reducedMotion && 'IntersectionObserver' in window) {
				var head = root.querySelector('.vira-trust__head');
				var stage = root.querySelector('.vira-dev-stage');
				if (head) head.classList.add('vira-entrance');
				if (stage) stage.classList.add('vira-entrance');
				var observer = new IntersectionObserver(function(entries){
					entries.forEach(function(entry){
						if (entry.isIntersecting) {
							if (head) {
								head.classList.remove('vira-entrance');
								head.classList.add('vira-entrance-in');
							}
							setTimeout(function(){
								if (stage) {
									stage.classList.remove('vira-entrance');
									stage.classList.add('vira-entrance-in');
								}
							}, 200);
							observer.disconnect();
						}
					});
				}, { threshold: 0.15 });
				observer.observe(root);
			}
		})();
		</script>
		<?php endif; ?>
		<?php
	}
}
