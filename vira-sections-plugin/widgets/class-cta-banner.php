<?php
/**
 * Vira Sections — CTA Banner Widget
 *
 * A bold, full-width call-to-action closer with an animated gradient-mesh
 * background (drifting conic/radial gradients) plus floating blurred shapes,
 * a badge, heading, subheading, and dual buttons.
 *
 * @package ViraSections
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Vira_Sections_Widget_Cta_Banner
 */
class Vira_Sections_Widget_Cta_Banner extends \Elementor\Widget_Base {

	use Vira_Sections_Preset_Trait;

	public function get_name() {
		return 'vira_cta_banner';
	}

	public function get_title() {
		return __( 'CTA Banner (Vira)', 'vira-sections' );
	}

	public function get_icon() {
		return 'eicon-call-to-action';
	}

	public function get_categories() {
		return array( 'vira-sections' );
	}

	public function get_keywords() {
		return array( 'vira', 'cta', 'banner', 'gradient', 'mesh', 'closer', 'call to action' );
	}

	/**
	 * Register controls.
	 */
	protected function register_controls() {

		$this->register_preset_control();

		/* ============================================================
		 * CONTENT — Content
		 * ============================================================ */
		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'badge_text',
			array(
				'label'   => __( 'Badge Text', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'آماده شروع هستید؟', 'vira-sections' ),
			)
		);

		$this->add_control(
			'show_badge',
			array(
				'label'        => __( 'Show Badge', 'vira-sections' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'default'     => __( 'بیایید چیزی <em>به‌یادماندنی</em> بسازیم', 'vira-sections' ),
				'label_block' => true,
				'description' => __( 'Wrap highlighted words in &lt;em&gt;...&lt;/em&gt; for accent color.', 'vira-sections' ),
			)
		);

		$this->register_tag_control( 'heading_tag', __( 'Heading HTML Tag (SEO)', 'vira-sections' ), 'h2' );

		$this->add_control(
			'subheading',
			array(
				'label'   => __( 'Subheading', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'rows'    => 3,
				'default' => __( 'همین حالا یک مشاوره رایگان رزرو کنید و اولین قدم را برای رشد کسب‌وکارتان بردارید.', 'vira-sections' ),
			)
		);

		$this->add_control(
			'primary_text',
			array(
				'label'   => __( 'Primary Button Text', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'شروع رایگان', 'vira-sections' ),
			)
		);

		$this->add_control(
			'primary_link',
			array(
				'label'       => __( 'Primary Button Link', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => 'https://example.com/',
				'default'     => array( 'url' => '#' ),
			)
		);

		$this->add_control(
			'secondary_text',
			array(
				'label'   => __( 'Secondary Button Text', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'تماس با ما', 'vira-sections' ),
			)
		);

		$this->add_control(
			'secondary_link',
			array(
				'label'       => __( 'Secondary Button Link', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => 'https://example.com/',
				'default'     => array( 'url' => '#' ),
			)
		);

		$this->add_control(
			'footnote',
			array(
				'label'   => __( 'Footnote (optional)', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'بدون نیاز به کارت بانکی · پاسخ در کمتر از ۲۴ ساعت', 'vira-sections' ),
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
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 240 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 120 ),
			)
		);

		$this->add_control(
			'inner_radius',
			array(
				'label'      => __( 'Banner Corner Radius', 'vira-sections' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 36 ),
			)
		);

		$this->add_control(
			'page_bg',
			array(
				'label'   => __( 'Outer Page Background', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * STYLE — Gradient Mesh
		 * ============================================================ */
		$this->start_controls_section(
			'style_gradient',
			array(
				'label' => __( 'Gradient Mesh', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'grad_1',
			array(
				'label'   => __( 'Gradient Color 1', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#170C79',
			)
		);

		$this->add_control(
			'grad_2',
			array(
				'label'   => __( 'Gradient Color 2', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#0170B9',
			)
		);

		$this->add_control(
			'grad_3',
			array(
				'label'   => __( 'Gradient Color 3', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#128BE0',
			)
		);

		$this->add_control(
			'shape_color',
			array(
				'label'   => __( 'Floating Shape Tint', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#8ACBD0',
			)
		);

		$this->add_control(
			'animate_mesh',
			array(
				'label'        => __( 'Animate Mesh', 'vira-sections' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * STYLE — Text & Buttons
		 * ============================================================ */
		$this->start_controls_section(
			'style_text',
			array(
				'label' => __( 'Text & Buttons', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
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
			'em_color',
			array(
				'label'   => __( 'Highlight (em) Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#8ACBD0',
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'   => __( 'Subheading Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => 'rgba(239,227,202,0.92)',
			)
		);

		$this->add_control(
			'btn_primary_bg',
			array(
				'label'   => __( 'Primary Button Background', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
			)
		);

		$this->add_control(
			'btn_primary_text',
			array(
				'label'   => __( 'Primary Button Text Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#170C79',
			)
		);

		$this->add_control(
			'btn_secondary_text',
			array(
				'label'   => __( 'Secondary Button Text Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Frontend render.
	 */
	protected function render() {
		$settings  = $this->get_settings_for_display();
		$unique_id = 'vira-cta-' . $this->get_id();

		$pad        = isset( $settings['section_padding']['size'] ) ? (int) $settings['section_padding']['size'] : 120;
		$radius     = isset( $settings['inner_radius']['size'] ) ? (int) $settings['inner_radius']['size'] : 36;
		$page_bg    = ! empty( $settings['page_bg'] ) ? $settings['page_bg'] : '#FFFFFF';
		$g1         = ! empty( $settings['grad_1'] ) ? $settings['grad_1'] : '#170C79';
		$g2         = ! empty( $settings['grad_2'] ) ? $settings['grad_2'] : '#0170B9';
		$g3         = ! empty( $settings['grad_3'] ) ? $settings['grad_3'] : '#128BE0';
		$shape      = ! empty( $settings['shape_color'] ) ? $settings['shape_color'] : '#8ACBD0';
		$animate    = ! isset( $settings['animate_mesh'] ) || 'yes' === $settings['animate_mesh'];
		$head_color = ! empty( $settings['heading_color'] ) ? $settings['heading_color'] : '#FFFFFF';
		$em_color   = ! empty( $settings['em_color'] ) ? $settings['em_color'] : '#8ACBD0';
		$text_color = ! empty( $settings['text_color'] ) ? $settings['text_color'] : 'rgba(239,227,202,0.92)';
		$pbtn_bg    = ! empty( $settings['btn_primary_bg'] ) ? $settings['btn_primary_bg'] : '#FFFFFF';
		$pbtn_tx    = ! empty( $settings['btn_primary_text'] ) ? $settings['btn_primary_text'] : '#170C79';
		$sbtn_tx    = ! empty( $settings['btn_secondary_text'] ) ? $settings['btn_secondary_text'] : '#FFFFFF';

		$show_badge = ! isset( $settings['show_badge'] ) || 'yes' === $settings['show_badge'];

		$p_url = ! empty( $settings['primary_link']['url'] ) ? $settings['primary_link']['url'] : '#';
		$p_ext = ! empty( $settings['primary_link']['is_external'] ) ? ' target="_blank"' : '';
		$p_nf  = ! empty( $settings['primary_link']['nofollow'] ) ? ' rel="nofollow"' : '';
		$s_url = ! empty( $settings['secondary_link']['url'] ) ? $settings['secondary_link']['url'] : '#';
		$s_ext = ! empty( $settings['secondary_link']['is_external'] ) ? ' target="_blank"' : '';
		$s_nf  = ! empty( $settings['secondary_link']['nofollow'] ) ? ' rel="nofollow"' : '';
		?>
		<style>
			#<?php echo esc_attr( $unique_id ); ?>{
				--vira-pad: <?php echo (int) $pad; ?>px;
				--vira-radius: <?php echo (int) $radius; ?>px;
				--vira-page-bg: <?php echo esc_attr( $page_bg ); ?>;
				--vira-g1: <?php echo esc_attr( $g1 ); ?>;
				--vira-g2: <?php echo esc_attr( $g2 ); ?>;
				--vira-g3: <?php echo esc_attr( $g3 ); ?>;
				--vira-shape: <?php echo esc_attr( $shape ); ?>;
				--vira-head: <?php echo esc_attr( $head_color ); ?>;
				--vira-em: <?php echo esc_attr( $em_color ); ?>;
				--vira-text: <?php echo esc_attr( $text_color ); ?>;
				--vira-pbtn-bg: <?php echo esc_attr( $pbtn_bg ); ?>;
				--vira-pbtn-tx: <?php echo esc_attr( $pbtn_tx ); ?>;
				--vira-sbtn-tx: <?php echo esc_attr( $sbtn_tx ); ?>;
			}
			#<?php echo esc_attr( $unique_id ); ?>.vira-ctab{
				padding:var(--vira-pad) 24px;background:var(--vira-page-bg);
				font-family:'Vazirmatn','IRANSans',Tahoma,sans-serif;direction:rtl;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__banner{
				position:relative;max-width:1200px;margin:0 auto;
				border-radius:var(--vira-radius);overflow:hidden;
				padding:84px 40px;text-align:center;isolation:isolate;
				background:
					radial-gradient(60% 80% at 20% 20%, var(--vira-g2) 0%, transparent 60%),
					radial-gradient(70% 90% at 80% 10%, var(--vira-g3) 0%, transparent 55%),
					radial-gradient(80% 90% at 70% 90%, var(--vira-g1) 0%, transparent 60%),
					linear-gradient(135deg, var(--vira-g1), var(--vira-g2));
				background-size:200% 200%, 200% 200%, 200% 200%, 100% 100%;
				box-shadow:0 40px 100px rgba(23,12,121,.30);
			}
			<?php if ( $animate ) : ?>
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__banner{
				animation:vira-ctab-mesh 16s ease-in-out infinite;
			}
			@keyframes vira-ctab-mesh{
				0%{background-position:0% 50%, 100% 0%, 50% 100%, 0 0;}
				50%{background-position:100% 50%, 0% 100%, 80% 0%, 0 0;}
				100%{background-position:0% 50%, 100% 0%, 50% 100%, 0 0;}
			}
			<?php endif; ?>

			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__shape{
				position:absolute;border-radius:50%;filter:blur(50px);opacity:.55;z-index:-1;
				background:var(--vira-shape);pointer-events:none;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__shape--a{width:320px;height:320px;top:-120px;right:-80px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__shape--b{width:260px;height:260px;bottom:-120px;left:-60px;background:var(--vira-g3);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__shape--c{width:180px;height:180px;top:40%;left:18%;opacity:.35;}
			<?php if ( $animate ) : ?>
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__shape--a{animation:vira-ctab-float-a 12s ease-in-out infinite;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__shape--b{animation:vira-ctab-float-b 15s ease-in-out infinite;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__shape--c{animation:vira-ctab-float-a 18s ease-in-out infinite reverse;}
			@keyframes vira-ctab-float-a{0%,100%{transform:translate(0,0) scale(1);}50%{transform:translate(-30px,30px) scale(1.12);}}
			@keyframes vira-ctab-float-b{0%,100%{transform:translate(0,0) scale(1);}50%{transform:translate(40px,-24px) scale(1.08);}}
			<?php endif; ?>

			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__inner{position:relative;z-index:2;max-width:760px;margin:0 auto;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__badge{
				display:inline-flex;align-items:center;gap:8px;
				background:rgba(255,255,255,.14);color:#fff;border:1px solid rgba(255,255,255,.28);
				padding:8px 18px;border-radius:999px;font-size:14px;font-weight:600;margin-bottom:24px;
				backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__badge i{
				width:8px;height:8px;border-radius:50%;background:var(--vira-em);
				box-shadow:0 0 0 4px rgba(138,203,208,.25);display:inline-block;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__title{
				font-size:clamp(30px,4.4vw,56px);font-weight:900;line-height:1.3;margin:0 0 18px;color:var(--vira-head);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__title em{
				font-style:normal;color:var(--vira-em);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__sub{
				font-size:clamp(16px,1.8vw,20px);line-height:1.9;color:var(--vira-text);margin:0 auto 36px;max-width:620px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__actions{
				display:flex;align-items:center;justify-content:center;gap:16px;flex-wrap:wrap;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__btn{
				display:inline-flex;align-items:center;gap:10px;
				padding:16px 34px;border-radius:14px;font-size:16px;font-weight:800;
				text-decoration:none;cursor:pointer;transition:transform .25s ease, box-shadow .25s ease, background .25s ease;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__btn--primary{
				background:var(--vira-pbtn-bg);color:var(--vira-pbtn-tx);
				box-shadow:0 12px 30px rgba(0,0,0,.25);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__btn--primary:hover{transform:translateY(-3px);box-shadow:0 18px 40px rgba(0,0,0,.32);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__btn--secondary{
				background:rgba(255,255,255,.10);color:var(--vira-sbtn-tx);border:1.5px solid rgba(255,255,255,.45);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__btn--secondary:hover{background:rgba(255,255,255,.20);transform:translateY(-3px);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__btn svg{width:18px;height:18px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__foot{
				margin-top:24px;font-size:13.5px;color:rgba(255,255,255,.78);
			}

			/* Entrance */
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__inner > *{opacity:0;transform:translateY(24px);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab.is-visible .vira-ctab__inner > *{
				opacity:1;transform:translateY(0);
				transition:opacity .6s cubic-bezier(.22,1,.36,1), transform .6s cubic-bezier(.22,1,.36,1);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab.is-visible .vira-ctab__title{transition-delay:.08s;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab.is-visible .vira-ctab__sub{transition-delay:.16s;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-ctab.is-visible .vira-ctab__actions{transition-delay:.24s;}

			@media(max-width:560px){
				#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__banner{padding:60px 24px;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__btn{width:100%;justify-content:center;}
			}
			@media(prefers-reduced-motion:reduce){
				#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__banner{animation:none;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__shape{animation:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__inner > *{opacity:1;transform:none;transition:none;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-ctab__btn{transition:none;}
			}
		</style>

		<section id="<?php echo esc_attr( $unique_id ); ?>" class="vira-ctab">
			<div class="vira-ctab__banner" data-vira-cta-banner>
				<span class="vira-ctab__shape vira-ctab__shape--a" aria-hidden="true"></span>
				<span class="vira-ctab__shape vira-ctab__shape--b" aria-hidden="true"></span>
				<span class="vira-ctab__shape vira-ctab__shape--c" aria-hidden="true"></span>

				<div class="vira-ctab__inner">
					<?php if ( $show_badge && ! empty( $settings['badge_text'] ) ) : ?>
						<span class="vira-ctab__badge"><i></i><?php echo esc_html( $settings['badge_text'] ); ?></span>
					<?php endif; ?>

					<?php if ( ! empty( $settings['heading'] ) ) : ?>
						<?php $heading_tag = $this->vira_safe_tag( isset( $settings['heading_tag'] ) ? $settings['heading_tag'] : 'h2', 'h2' ); ?>
						<<?php echo $heading_tag; ?> class="vira-ctab__title"><?php echo wp_kses_post( $settings['heading'] ); ?></<?php echo $heading_tag; ?>>
					<?php endif; ?>

					<?php if ( ! empty( $settings['subheading'] ) ) : ?>
						<p class="vira-ctab__sub"><?php echo esc_html( $settings['subheading'] ); ?></p>
					<?php endif; ?>

					<div class="vira-ctab__actions">
						<?php if ( ! empty( $settings['primary_text'] ) ) : ?>
							<a class="vira-ctab__btn vira-ctab__btn--primary" href="<?php echo esc_url( $p_url ); ?>"<?php echo $p_ext . $p_nf; // phpcs:ignore ?>>
								<?php echo esc_html( $settings['primary_text'] ); ?>
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
							</a>
						<?php endif; ?>
						<?php if ( ! empty( $settings['secondary_text'] ) ) : ?>
							<a class="vira-ctab__btn vira-ctab__btn--secondary" href="<?php echo esc_url( $s_url ); ?>"<?php echo $s_ext . $s_nf; // phpcs:ignore ?>>
								<?php echo esc_html( $settings['secondary_text'] ); ?>
							</a>
						<?php endif; ?>
					</div>

					<?php if ( ! empty( $settings['footnote'] ) ) : ?>
						<div class="vira-ctab__foot"><?php echo esc_html( $settings['footnote'] ); ?></div>
					<?php endif; ?>
				</div>
			</div>
		</section>

		<script>
		(function(){
			var root = document.getElementById('<?php echo esc_js( $unique_id ); ?>');
			if (!root) return;
			var reduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
			if (reduced || !('IntersectionObserver' in window)){
				root.classList.add('is-visible');
				return;
			}
			var io = new IntersectionObserver(function(entries){
				entries.forEach(function(en){
					if (en.isIntersecting){ root.classList.add('is-visible'); io.unobserve(en.target); }
				});
			}, { threshold: 0.2 });
			io.observe(root);
		})();
		</script>
		<?php
	}
}
