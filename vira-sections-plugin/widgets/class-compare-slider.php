<?php
/**
 * Vira Sections — Before/After Compare Slider Widget
 *
 * A draggable image comparison slider that reveals a "before" image and an
 * "after" image as the user drags a handle (mouse + touch + keyboard).
 * Perfect for showcasing redesigns, retouching, and SEO before/after results.
 *
 * @package ViraSections
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Vira_Sections_Widget_Compare_Slider
 */
class Vira_Sections_Widget_Compare_Slider extends \Elementor\Widget_Base {

	use Vira_Sections_Preset_Trait;

	public function get_name() {
		return 'vira_compare_slider';
	}

	public function get_title() {
		return __( 'Compare Slider (Vira)', 'vira-sections' );
	}

	public function get_icon() {
		return 'eicon-image-before-after';
	}

	public function get_categories() {
		return array( 'vira-sections' );
	}

	public function get_keywords() {
		return array( 'vira', 'compare', 'before', 'after', 'slider', 'image', 'reveal', 'redesign' );
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
				'default' => __( 'قبل و بعد', 'vira-sections' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'تفاوت را <em>با چشم خودتان</em> ببینید', 'vira-sections' ),
				'label_block' => true,
				'description' => __( 'Wrap highlighted words in &lt;em&gt;...&lt;/em&gt; for accent color.', 'vira-sections' ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'دستگیره را بکشید و نتیجه واقعی کار تیم ما را روی پروژه‌های واقعی مقایسه کنید.', 'vira-sections' ),
				'rows'    => 3,
			)
		);

		$this->add_control(
			'show_header',
			array(
				'label'        => __( 'Show Header', 'vira-sections' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * CONTENT — Images
		 * ============================================================ */
		$this->start_controls_section(
			'section_images',
			array(
				'label' => __( 'Images', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'before_image',
			array(
				'label'   => __( 'Before Image', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'after_image',
			array(
				'label'   => __( 'After Image', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'before_label',
			array(
				'label'   => __( 'Before Label', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'قبل', 'vira-sections' ),
			)
		);

		$this->add_control(
			'after_label',
			array(
				'label'   => __( 'After Label', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'بعد', 'vira-sections' ),
			)
		);

		$this->add_control(
			'initial_position',
			array(
				'label'      => __( 'Initial Handle Position (%)', 'vira-sections' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( '%' ),
				'range'      => array( '%' => array( 'min' => 0, 'max' => 100 ) ),
				'default'    => array( 'unit' => '%', 'size' => 50 ),
			)
		);

		$this->add_control(
			'orientation',
			array(
				'label'   => __( 'Drag Orientation', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => array(
					'horizontal' => __( 'Horizontal', 'vira-sections' ),
					'vertical'   => __( 'Vertical', 'vira-sections' ),
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
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 200 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 100 ),
			)
		);

		$this->add_control(
			'bg_from',
			array(
				'label'   => __( 'Background — Top', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#060832',
			)
		);

		$this->add_control(
			'bg_to',
			array(
				'label'   => __( 'Background — Bottom', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#170C79',
			)
		);

		$this->add_control(
			'max_width',
			array(
				'label'      => __( 'Slider Max Width', 'vira-sections' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => 400, 'max' => 1400 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 960 ),
			)
		);

		$this->add_control(
			'aspect_ratio',
			array(
				'label'   => __( 'Aspect Ratio', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '16-9',
				'options' => array(
					'16-9' => '16:9',
					'4-3'  => '4:3',
					'3-2'  => '3:2',
					'1-1'  => '1:1',
				),
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
			'handle_color',
			array(
				'label'   => __( 'Handle Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
			)
		);

		$this->add_control(
			'handle_icon_color',
			array(
				'label'   => __( 'Handle Icon Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#170C79',
			)
		);

		$this->add_control(
			'label_bg',
			array(
				'label'   => __( 'Label Background', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => 'rgba(6,8,50,0.72)',
			)
		);

		$this->add_control(
			'label_text',
			array(
				'label'   => __( 'Label Text Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
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
		$unique_id = 'vira-compare-' . $this->get_id();

		$pad        = isset( $settings['section_padding']['size'] ) ? (int) $settings['section_padding']['size'] : 100;
		$bg_from    = ! empty( $settings['bg_from'] ) ? $settings['bg_from'] : '#060832';
		$bg_to      = ! empty( $settings['bg_to'] ) ? $settings['bg_to'] : '#170C79';
		$maxw       = isset( $settings['max_width']['size'] ) ? (int) $settings['max_width']['size'] : 960;
		$accent     = ! empty( $settings['accent_color'] ) ? $settings['accent_color'] : '#128BE0';
		$handle     = ! empty( $settings['handle_color'] ) ? $settings['handle_color'] : '#FFFFFF';
		$handle_ic  = ! empty( $settings['handle_icon_color'] ) ? $settings['handle_icon_color'] : '#170C79';
		$label_bg   = ! empty( $settings['label_bg'] ) ? $settings['label_bg'] : 'rgba(6,8,50,0.72)';
		$label_text = ! empty( $settings['label_text'] ) ? $settings['label_text'] : '#FFFFFF';
		$head_color = ! empty( $settings['heading_color'] ) ? $settings['heading_color'] : '#FFFFFF';
		$text_color = ! empty( $settings['text_color'] ) ? $settings['text_color'] : '#8ACBD0';

		$ratio_map = array(
			'16-9' => '56.25%',
			'4-3'  => '75%',
			'3-2'  => '66.66%',
			'1-1'  => '100%',
		);
		$ratio_key = ! empty( $settings['aspect_ratio'] ) ? $settings['aspect_ratio'] : '16-9';
		$ratio     = isset( $ratio_map[ $ratio_key ] ) ? $ratio_map[ $ratio_key ] : '56.25%';

		$orientation = ! empty( $settings['orientation'] ) && 'vertical' === $settings['orientation'] ? 'vertical' : 'horizontal';
		$pos         = isset( $settings['initial_position']['size'] ) ? (float) $settings['initial_position']['size'] : 50;
		$pos         = max( 0, min( 100, $pos ) );

		$before_url = ! empty( $settings['before_image']['url'] ) ? $settings['before_image']['url'] : \Elementor\Utils::get_placeholder_image_src();
		$after_url  = ! empty( $settings['after_image']['url'] ) ? $settings['after_image']['url'] : \Elementor\Utils::get_placeholder_image_src();
		$show_head  = ! isset( $settings['show_header'] ) || 'yes' === $settings['show_header'];
		?>
		<style>
			#<?php echo esc_attr( $unique_id ); ?>{
				--vira-pad: <?php echo (int) $pad; ?>px;
				--vira-bg-from: <?php echo esc_attr( $bg_from ); ?>;
				--vira-bg-to: <?php echo esc_attr( $bg_to ); ?>;
				--vira-maxw: <?php echo (int) $maxw; ?>px;
				--vira-accent: <?php echo esc_attr( $accent ); ?>;
				--vira-handle: <?php echo esc_attr( $handle ); ?>;
				--vira-handle-ic: <?php echo esc_attr( $handle_ic ); ?>;
				--vira-label-bg: <?php echo esc_attr( $label_bg ); ?>;
				--vira-label-text: <?php echo esc_attr( $label_text ); ?>;
				--vira-head: <?php echo esc_attr( $head_color ); ?>;
				--vira-text: <?php echo esc_attr( $text_color ); ?>;
				--vira-ratio: <?php echo esc_attr( $ratio ); ?>;
			}
			#<?php echo esc_attr( $unique_id ); ?>.vira-cmp{
				padding:var(--vira-pad) 24px;
				background:linear-gradient(160deg,var(--vira-bg-from),var(--vira-bg-to));
				font-family:'Vazirmatn','IRANSans',Tahoma,sans-serif;direction:rtl;color:var(--vira-text);
				position:relative;overflow:hidden;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__inner{max-width:var(--vira-maxw);margin:0 auto;position:relative;z-index:1;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__head{text-align:center;margin-bottom:48px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__eyebrow{
				display:inline-flex;align-items:center;gap:8px;
				background:rgba(18,139,224,.16);color:var(--vira-accent);
				border:1px solid rgba(18,139,224,.30);
				padding:8px 16px;border-radius:999px;font-size:14px;font-weight:600;margin-bottom:16px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__eyebrow i{
				width:8px;height:8px;border-radius:50%;background:var(--vira-accent);
				box-shadow:0 0 0 4px rgba(18,139,224,.18);display:inline-block;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp h2{font-size:clamp(28px,3.4vw,46px);font-weight:800;margin:0 0 16px;line-height:1.4;color:var(--vira-head);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp h2 em{
				font-style:normal;
				background:linear-gradient(135deg,var(--vira-accent),#8ACBD0);
				-webkit-background-clip:text;background-clip:text;color:transparent;-webkit-text-fill-color:transparent;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__head p{font-size:18px;max-width:640px;margin:0 auto;opacity:.9;}

			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__stage{
				position:relative;width:100%;padding-bottom:var(--vira-ratio);
				border-radius:24px;overflow:hidden;
				box-shadow:0 30px 80px rgba(0,0,0,.45);
				user-select:none;-webkit-user-select:none;touch-action:none;
				background:#0b0d3a;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__img{
				position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:block;
				pointer-events:none;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__after-wrap{
				position:absolute;inset:0;overflow:hidden;
				/* clip to reveal "after" from the start edge up to the handle */
				clip-path:inset(0 0 0 var(--vira-clip,50%));
				will-change:clip-path;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__stage.is-vertical .vira-cmp__after-wrap{
				clip-path:inset(var(--vira-clip,50%) 0 0 0);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__label{
				position:absolute;top:16px;z-index:4;
				background:var(--vira-label-bg);color:var(--vira-label-text);
				padding:6px 16px;border-radius:999px;font-size:13px;font-weight:700;
				backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px);
				pointer-events:none;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__label--before{right:16px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__label--after{left:16px;}

			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__divider{
				position:absolute;top:0;bottom:0;left:var(--vira-clip,50%);
				width:3px;transform:translateX(-50%);
				background:var(--vira-handle);z-index:5;
				box-shadow:0 0 16px rgba(0,0,0,.4);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__stage.is-vertical .vira-cmp__divider{
				left:0;right:0;top:var(--vira-clip,50%);bottom:auto;width:auto;height:3px;
				transform:translateY(-50%);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__handle{
				position:absolute;top:50%;left:var(--vira-clip,50%);
				transform:translate(-50%,-50%);
				width:52px;height:52px;border-radius:50%;
				background:var(--vira-handle);color:var(--vira-handle-ic);
				display:grid;place-items:center;cursor:ew-resize;z-index:6;
				box-shadow:0 8px 24px rgba(0,0,0,.4);
				transition:transform .15s ease, box-shadow .2s ease;
				border:none;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__stage.is-vertical .vira-cmp__handle{
				top:var(--vira-clip,50%);left:50%;cursor:ns-resize;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__handle:hover{transform:translate(-50%,-50%) scale(1.08);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__handle:focus-visible{outline:3px solid var(--vira-accent);outline-offset:3px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__handle::before{
				content:"";position:absolute;inset:-10px;border-radius:50%;
				border:2px solid var(--vira-handle);opacity:.35;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__handle svg{width:22px;height:22px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__stage.is-vertical .vira-cmp__handle svg{transform:rotate(90deg);}

			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__hint{
				text-align:center;margin-top:20px;font-size:14px;opacity:.7;
				display:flex;align-items:center;justify-content:center;gap:8px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__hint span{
				display:inline-flex;animation:vira-cmp-nudge 1.8s ease-in-out infinite;
			}
			@keyframes vira-cmp-nudge{0%,100%{transform:translateX(0);}50%{transform:translateX(-6px);}}

			/* Entrance */
			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__stage{opacity:0;transform:translateY(36px) scale(.98);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__stage.is-visible{
				opacity:1;transform:translateY(0) scale(1);
				transition:opacity .7s cubic-bezier(.22,1,.36,1),transform .7s cubic-bezier(.22,1,.36,1);
			}

			@media(max-width:560px){
				#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__handle{width:44px;height:44px;}
			}
			@media(prefers-reduced-motion:reduce){
				#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__stage{opacity:1;transform:none;transition:none;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__hint span{animation:none;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-cmp__handle{transition:none;}
			}
		</style>

		<section id="<?php echo esc_attr( $unique_id ); ?>" class="vira-cmp" data-vira-compare-slider>
			<div class="vira-cmp__inner">
				<?php if ( $show_head ) : ?>
					<div class="vira-cmp__head">
						<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
							<span class="vira-cmp__eyebrow"><i></i><?php echo esc_html( $settings['eyebrow'] ); ?></span>
						<?php endif; ?>
						<?php if ( ! empty( $settings['heading'] ) ) : ?>
							<h2><?php echo wp_kses_post( $settings['heading'] ); ?></h2>
						<?php endif; ?>
						<?php if ( ! empty( $settings['description'] ) ) : ?>
							<p><?php echo esc_html( $settings['description'] ); ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<div class="vira-cmp__stage <?php echo 'vertical' === $orientation ? 'is-vertical' : ''; ?>"
					data-orientation="<?php echo esc_attr( $orientation ); ?>"
					data-position="<?php echo esc_attr( $pos ); ?>"
					style="--vira-clip:<?php echo esc_attr( $pos ); ?>%;">

					<img class="vira-cmp__img vira-cmp__img--before" src="<?php echo esc_url( $before_url ); ?>" alt="<?php echo esc_attr( $settings['before_label'] ); ?>" loading="lazy" />

					<div class="vira-cmp__after-wrap">
						<img class="vira-cmp__img vira-cmp__img--after" src="<?php echo esc_url( $after_url ); ?>" alt="<?php echo esc_attr( $settings['after_label'] ); ?>" loading="lazy" />
					</div>

					<?php if ( ! empty( $settings['before_label'] ) ) : ?>
						<span class="vira-cmp__label vira-cmp__label--before"><?php echo esc_html( $settings['before_label'] ); ?></span>
					<?php endif; ?>
					<?php if ( ! empty( $settings['after_label'] ) ) : ?>
						<span class="vira-cmp__label vira-cmp__label--after"><?php echo esc_html( $settings['after_label'] ); ?></span>
					<?php endif; ?>

					<div class="vira-cmp__divider" aria-hidden="true"></div>

					<button type="button" class="vira-cmp__handle"
						role="slider"
						tabindex="0"
						aria-label="<?php esc_attr_e( 'مقایسه قبل و بعد', 'vira-sections' ); ?>"
						aria-valuemin="0" aria-valuemax="100" aria-valuenow="<?php echo esc_attr( (int) $pos ); ?>">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<path d="M9 7l-5 5 5 5M15 7l5 5-5 5"/>
						</svg>
					</button>
				</div>

				<div class="vira-cmp__hint">
					<span aria-hidden="true">⇄</span>
					<?php esc_html_e( 'برای مقایسه دستگیره را بکشید', 'vira-sections' ); ?>
				</div>
			</div>
		</section>

		<script>
		(function(){
			var root = document.getElementById('<?php echo esc_js( $unique_id ); ?>');
			if (!root) return;
			var stage = root.querySelector('.vira-cmp__stage');
			var handle = root.querySelector('.vira-cmp__handle');
			if (!stage || !handle) return;

			var orientation = stage.getAttribute('data-orientation') || 'horizontal';
			var isVertical = orientation === 'vertical';
			var dragging = false;

			function clamp(v){ return Math.max(0, Math.min(100, v)); }

			function setPos(pct){
				pct = clamp(pct);
				stage.style.setProperty('--vira-clip', pct + '%');
				handle.setAttribute('aria-valuenow', Math.round(pct));
			}

			function pointToPct(clientX, clientY){
				var rect = stage.getBoundingClientRect();
				if (isVertical){
					if (rect.height === 0) return 50;
					return ((clientY - rect.top) / rect.height) * 100;
				}
				// RTL note: clip-path inset-left maps directly to left offset, so use raw x.
				if (rect.width === 0) return 50;
				return ((clientX - rect.left) / rect.width) * 100;
			}

			function onMove(e){
				if (!dragging) return;
				var pt = (e.touches && e.touches[0]) ? e.touches[0] : e;
				setPos(pointToPct(pt.clientX, pt.clientY));
				if (e.cancelable) e.preventDefault();
			}
			function start(e){
				dragging = true;
				var pt = (e.touches && e.touches[0]) ? e.touches[0] : e;
				setPos(pointToPct(pt.clientX, pt.clientY));
			}
			function end(){ dragging = false; }

			handle.addEventListener('mousedown', function(e){ e.preventDefault(); dragging = true; });
			stage.addEventListener('mousedown', start);
			window.addEventListener('mousemove', onMove);
			window.addEventListener('mouseup', end);

			handle.addEventListener('touchstart', function(e){ dragging = true; if (e.cancelable) e.preventDefault(); }, { passive: false });
			stage.addEventListener('touchstart', start, { passive: true });
			window.addEventListener('touchmove', onMove, { passive: false });
			window.addEventListener('touchend', end);

			// Keyboard support
			handle.addEventListener('keydown', function(e){
				var cur = parseFloat(handle.getAttribute('aria-valuenow')) || 50;
				var step = e.shiftKey ? 10 : 2;
				if (e.key === 'ArrowLeft' || e.key === 'ArrowUp'){ setPos(cur - step); e.preventDefault(); }
				else if (e.key === 'ArrowRight' || e.key === 'ArrowDown'){ setPos(cur + step); e.preventDefault(); }
				else if (e.key === 'Home'){ setPos(0); e.preventDefault(); }
				else if (e.key === 'End'){ setPos(100); e.preventDefault(); }
			});

			// Entrance reveal
			var reduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
			if (reduced || !('IntersectionObserver' in window)){
				stage.classList.add('is-visible');
			} else {
				var io = new IntersectionObserver(function(entries){
					entries.forEach(function(en){
						if (en.isIntersecting){ stage.classList.add('is-visible'); io.unobserve(en.target); }
					});
				}, { threshold: 0.25 });
				io.observe(stage);
			}
		})();
		</script>
		<?php
	}
}
