<?php
/**
 * Vira Sections — Logo Marquee Widget
 *
 * A dual-row, infinite-scrolling logo wall. The two rows glide in opposite
 * directions. Logos render grayscale by default and bloom to full color on
 * hover. Each logo can be an image or a text wordmark.
 *
 * @package ViraSections
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Vira_Sections_Widget_Logo_Marquee
 */
class Vira_Sections_Widget_Logo_Marquee extends \Elementor\Widget_Base {

	use Vira_Sections_Preset_Trait;

	public function get_name() {
		return 'vira_logo_marquee';
	}

	public function get_title() {
		return __( 'Logo Marquee (Vira)', 'vira-sections' );
	}

	public function get_icon() {
		return 'eicon-slider-push';
	}

	public function get_categories() {
		return array( 'vira-sections' );
	}

	public function get_keywords() {
		return array( 'vira', 'logo', 'marquee', 'clients', 'brands', 'scroll', 'ticker', 'wall' );
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
				'default' => __( 'مورد اعتماد بزرگان', 'vira-sections' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'برندهایی که <em>به ما اعتماد کردند</em>', 'vira-sections' ),
				'label_block' => true,
				'description' => __( 'Wrap highlighted words in &lt;em&gt;...&lt;/em&gt; for accent color.', 'vira-sections' ),
			)
		);

		$this->register_tag_control( 'heading_tag', __( 'Heading HTML Tag (SEO)', 'vira-sections' ), 'h2' );

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
		 * CONTENT — Logos
		 * ============================================================ */
		$this->start_controls_section(
			'section_logos',
			array(
				'label' => __( 'Logos', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'logo_type',
			array(
				'label'   => __( 'Type', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'text',
				'options' => array(
					'image' => __( 'Image', 'vira-sections' ),
					'text'  => __( 'Text Wordmark', 'vira-sections' ),
				),
			)
		);

		$repeater->add_control(
			'logo_image',
			array(
				'label'     => __( 'Logo Image', 'vira-sections' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'   => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
				'condition' => array( 'logo_type' => 'image' ),
			)
		);

		$repeater->add_control(
			'logo_text',
			array(
				'label'       => __( 'Logo Text', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'برند شما', 'vira-sections' ),
				'label_block' => true,
				'condition'   => array( 'logo_type' => 'text' ),
			)
		);

		$repeater->add_control(
			'logo_row',
			array(
				'label'   => __( 'Row', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'top',
				'options' => array(
					'top'    => __( 'Top Row', 'vira-sections' ),
					'bottom' => __( 'Bottom Row', 'vira-sections' ),
				),
			)
		);

		$repeater->add_control(
			'logo_link',
			array(
				'label'       => __( 'Link (optional)', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => 'https://example.com/',
			)
		);

		$default_logos = array(
			array( 'logo_type' => 'text', 'logo_text' => 'دیجی‌کالا', 'logo_row' => 'top' ),
			array( 'logo_type' => 'text', 'logo_text' => 'اسنپ', 'logo_row' => 'top' ),
			array( 'logo_type' => 'text', 'logo_text' => 'تپسی', 'logo_row' => 'top' ),
			array( 'logo_type' => 'text', 'logo_text' => 'علی‌بابا', 'logo_row' => 'top' ),
			array( 'logo_type' => 'text', 'logo_text' => 'بامیلو', 'logo_row' => 'top' ),
			array( 'logo_type' => 'text', 'logo_text' => 'دیوار', 'logo_row' => 'bottom' ),
			array( 'logo_type' => 'text', 'logo_text' => 'شیپور', 'logo_row' => 'bottom' ),
			array( 'logo_type' => 'text', 'logo_text' => 'فیلیمو', 'logo_row' => 'bottom' ),
			array( 'logo_type' => 'text', 'logo_text' => 'نماوا', 'logo_row' => 'bottom' ),
			array( 'logo_type' => 'text', 'logo_text' => 'بلد', 'logo_row' => 'bottom' ),
		);

		$this->add_control(
			'logos',
			array(
				'label'       => __( 'Logos', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ logo_text || "Logo" }}}',
				'default'     => $default_logos,
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * CONTENT — Settings
		 * ============================================================ */
		$this->start_controls_section(
			'section_settings',
			array(
				'label' => __( 'Marquee Settings', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_second_row',
			array(
				'label'        => __( 'Show Bottom Row', 'vira-sections' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'grayscale',
			array(
				'label'        => __( 'Grayscale (color on hover)', 'vira-sections' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'pause_on_hover',
			array(
				'label'        => __( 'Pause on Hover', 'vira-sections' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'speed',
			array(
				'label'      => __( 'Scroll Speed (seconds per loop)', 'vira-sections' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 's' ),
				'range'      => array( 's' => array( 'min' => 10, 'max' => 90 ) ),
				'default'    => array( 'unit' => 's', 'size' => 35 ),
			)
		);

		$this->add_control(
			'gap',
			array(
				'label'      => __( 'Gap Between Logos', 'vira-sections' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => 16, 'max' => 120 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 48 ),
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
				'default'    => array( 'unit' => 'px', 'size' => 90 ),
			)
		);

		$this->add_control(
			'section_bg',
			array(
				'label'   => __( 'Background Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
			)
		);

		$this->add_control(
			'fade_edges',
			array(
				'label'        => __( 'Fade Edges', 'vira-sections' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * STYLE — Logos / Colors
		 * ============================================================ */
		$this->start_controls_section(
			'style_logos',
			array(
				'label' => __( 'Logos & Colors', 'vira-sections' ),
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
			'chip_bg',
			array(
				'label'   => __( 'Logo Chip Background', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
			)
		);

		$this->add_control(
			'chip_border',
			array(
				'label'   => __( 'Logo Chip Border', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#E2E8F0',
			)
		);

		$this->add_control(
			'logo_text_color',
			array(
				'label'   => __( 'Logo Text Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#170C79',
			)
		);

		$this->add_control(
			'heading_color',
			array(
				'label'   => __( 'Heading Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#1D2327',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Frontend render.
	 */
	protected function render() {
		$settings  = $this->get_settings_for_display();
		$unique_id = 'vira-marquee-' . $this->get_id();

		$pad        = isset( $settings['section_padding']['size'] ) ? (int) $settings['section_padding']['size'] : 90;
		$bg         = ! empty( $settings['section_bg'] ) ? $settings['section_bg'] : '#FFFFFF';
		$accent     = ! empty( $settings['accent_color'] ) ? $settings['accent_color'] : '#0170B9';
		$chip_bg    = ! empty( $settings['chip_bg'] ) ? $settings['chip_bg'] : '#FFFFFF';
		$chip_bd    = ! empty( $settings['chip_border'] ) ? $settings['chip_border'] : '#E2E8F0';
		$logo_txt   = ! empty( $settings['logo_text_color'] ) ? $settings['logo_text_color'] : '#170C79';
		$head_color = ! empty( $settings['heading_color'] ) ? $settings['heading_color'] : '#1D2327';

		$speed      = isset( $settings['speed']['size'] ) ? (float) $settings['speed']['size'] : 35;
		$speed      = $speed > 0 ? $speed : 35;
		$gap        = isset( $settings['gap']['size'] ) ? (int) $settings['gap']['size'] : 48;

		$grayscale  = ! isset( $settings['grayscale'] ) || 'yes' === $settings['grayscale'];
		$pause      = ! isset( $settings['pause_on_hover'] ) || 'yes' === $settings['pause_on_hover'];
		$show_2nd   = ! isset( $settings['show_second_row'] ) || 'yes' === $settings['show_second_row'];
		$fade       = ! isset( $settings['fade_edges'] ) || 'yes' === $settings['fade_edges'];
		$show_head  = ! isset( $settings['show_header'] ) || 'yes' === $settings['show_header'];

		$logos = ! empty( $settings['logos'] ) && is_array( $settings['logos'] ) ? $settings['logos'] : array();

		$top_logos    = array();
		$bottom_logos = array();
		foreach ( $logos as $logo ) {
			if ( isset( $logo['logo_row'] ) && 'bottom' === $logo['logo_row'] ) {
				$bottom_logos[] = $logo;
			} else {
				$top_logos[] = $logo;
			}
		}
		if ( empty( $bottom_logos ) ) {
			$bottom_logos = $top_logos;
		}

		/**
		 * Render a single track. Items are printed twice for a seamless loop.
		 *
		 * @param array  $items     Logo items.
		 * @param string $direction 'normal' or 'reverse'.
		 * @param string $uid       Widget unique id (for fallback alt text).
		 */
		$render_track = function ( $items, $direction, $uid ) {
			if ( empty( $items ) ) {
				return;
			}
			$dir_class = 'reverse' === $direction ? ' is-reverse' : '';
			?>
			<div class="vira-mq__row<?php echo esc_attr( $dir_class ); ?>">
				<div class="vira-mq__track">
					<?php for ( $copy = 0; $copy < 2; $copy++ ) : ?>
						<div class="vira-mq__group" <?php echo 1 === $copy ? 'aria-hidden="true"' : ''; ?>>
							<?php foreach ( $items as $item ) :
								$type     = ! empty( $item['logo_type'] ) ? $item['logo_type'] : 'text';
								$has_link = ! empty( $item['logo_link']['url'] );
								$url      = $has_link ? $item['logo_link']['url'] : '';
								$ext      = ! empty( $item['logo_link']['is_external'] ) ? ' target="_blank"' : '';
								$nf       = ! empty( $item['logo_link']['nofollow'] ) ? ' rel="nofollow"' : '';
								$tag      = $has_link ? 'a' : 'div';
								?>
								<<?php echo esc_attr( $tag ); ?> class="vira-mq__chip"
									<?php if ( $has_link ) : ?>href="<?php echo esc_url( $url ); ?>"<?php echo $ext . $nf; // phpcs:ignore ?><?php endif; ?>>
									<?php if ( 'image' === $type && ! empty( $item['logo_image']['url'] ) ) : ?>
										<img src="<?php echo esc_url( $item['logo_image']['url'] ); ?>" alt="<?php echo esc_attr( ! empty( $item['logo_text'] ) ? $item['logo_text'] : 'logo' ); ?>" loading="lazy" />
									<?php else : ?>
										<span class="vira-mq__word"><?php echo esc_html( ! empty( $item['logo_text'] ) ? $item['logo_text'] : '—' ); ?></span>
									<?php endif; ?>
								</<?php echo esc_attr( $tag ); ?>>
							<?php endforeach; ?>
						</div>
					<?php endfor; ?>
				</div>
			</div>
			<?php
		};
		?>
		<style>
			#<?php echo esc_attr( $unique_id ); ?>{
				--vira-pad: <?php echo (int) $pad; ?>px;
				--vira-bg: <?php echo esc_attr( $bg ); ?>;
				--vira-accent: <?php echo esc_attr( $accent ); ?>;
				--vira-chip-bg: <?php echo esc_attr( $chip_bg ); ?>;
				--vira-chip-bd: <?php echo esc_attr( $chip_bd ); ?>;
				--vira-logo-txt: <?php echo esc_attr( $logo_txt ); ?>;
				--vira-head: <?php echo esc_attr( $head_color ); ?>;
				--vira-speed: <?php echo esc_attr( $speed ); ?>s;
				--vira-gap: <?php echo (int) $gap; ?>px;
			}
			#<?php echo esc_attr( $unique_id ); ?>.vira-mq{
				padding:var(--vira-pad) 0;background:var(--vira-bg);
				font-family:'Vazirmatn','IRANSans',Tahoma,sans-serif;direction:rtl;
				position:relative;overflow:hidden;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mq__head{text-align:center;margin-bottom:48px;padding:0 24px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mq__eyebrow{
				display:inline-flex;align-items:center;gap:8px;
				background:rgba(1,112,185,.10);color:var(--vira-accent);
				border:1px solid rgba(1,112,185,.25);
				padding:8px 16px;border-radius:999px;font-size:14px;font-weight:600;margin-bottom:16px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mq__eyebrow i{
				width:8px;height:8px;border-radius:50%;background:var(--vira-accent);
				box-shadow:0 0 0 4px rgba(1,112,185,.16);display:inline-block;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mq h2, #<?php echo esc_attr( $unique_id ); ?> .vira-mq__title{font-size:clamp(26px,3.2vw,42px);font-weight:800;margin:0;line-height:1.4;color:var(--vira-head);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mq h2 em, #<?php echo esc_attr( $unique_id ); ?> .vira-mq__title em{
				font-style:normal;
				background:linear-gradient(135deg,#170C79,#128BE0);
				-webkit-background-clip:text;background-clip:text;color:transparent;-webkit-text-fill-color:transparent;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mq__rows{display:flex;flex-direction:column;gap:24px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mq__row{
				display:flex;width:100%;overflow:hidden;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mq__track{
				display:flex;flex-wrap:nowrap;width:max-content;
				gap:var(--vira-gap);padding-inline:calc(var(--vira-gap) / 2);
				animation:vira-mq-scroll var(--vira-speed) linear infinite;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mq__row.is-reverse .vira-mq__track{
				animation-direction:reverse;
			}
			<?php if ( $pause ) : ?>
			#<?php echo esc_attr( $unique_id ); ?> .vira-mq__row:hover .vira-mq__track{animation-play-state:paused;}
			<?php endif; ?>
			#<?php echo esc_attr( $unique_id ); ?> .vira-mq__group{
				display:flex;flex-wrap:nowrap;gap:var(--vira-gap);flex-shrink:0;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mq__chip{
				flex-shrink:0;display:flex;align-items:center;justify-content:center;
				min-width:160px;height:88px;padding:0 28px;
				background:var(--vira-chip-bg);border:1px solid var(--vira-chip-bd);border-radius:18px;
				text-decoration:none;
				transition:transform .3s ease, box-shadow .3s ease, border-color .3s ease, filter .3s ease, opacity .3s ease;
				<?php if ( $grayscale ) : ?>filter:grayscale(1);opacity:.65;<?php endif; ?>
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mq__chip:hover{
				transform:translateY(-4px);box-shadow:0 16px 36px rgba(1,112,185,.14);
				border-color:var(--vira-accent);
				<?php if ( $grayscale ) : ?>filter:grayscale(0);opacity:1;<?php endif; ?>
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mq__chip img{
				max-height:48px;max-width:130px;width:auto;height:auto;object-fit:contain;display:block;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mq__word{
				font-size:22px;font-weight:800;color:var(--vira-logo-txt);white-space:nowrap;
			}
			<?php if ( $fade ) : ?>
			#<?php echo esc_attr( $unique_id ); ?> .vira-mq__rows{
				-webkit-mask-image:linear-gradient(90deg,transparent,#000 12%,#000 88%,transparent);
				mask-image:linear-gradient(90deg,transparent,#000 12%,#000 88%,transparent);
			}
			<?php endif; ?>

			@keyframes vira-mq-scroll{
				from{transform:translateX(0);}
				to{transform:translateX(-50%);}
			}

			@media(max-width:560px){
				#<?php echo esc_attr( $unique_id ); ?> .vira-mq__chip{min-width:130px;height:72px;padding:0 20px;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-mq__word{font-size:18px;}
			}
			@media(prefers-reduced-motion:reduce){
				#<?php echo esc_attr( $unique_id ); ?> .vira-mq__track{animation:none;flex-wrap:wrap;justify-content:center;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-mq__group[aria-hidden="true"]{display:none;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-mq__chip{transition:none;}
			}
		</style>

		<section id="<?php echo esc_attr( $unique_id ); ?>" class="vira-mq" data-vira-logo-marquee>
			<?php if ( $show_head ) : ?>
				<div class="vira-mq__head">
					<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
						<span class="vira-mq__eyebrow"><i></i><?php echo esc_html( $settings['eyebrow'] ); ?></span>
					<?php endif; ?>
					<?php if ( ! empty( $settings['heading'] ) ) : ?>
						<?php $heading_tag = $this->vira_safe_tag( isset( $settings['heading_tag'] ) ? $settings['heading_tag'] : 'h2', 'h2' ); ?>
						<<?php echo $heading_tag; ?> class="vira-mq__title"><?php echo wp_kses_post( $settings['heading'] ); ?></<?php echo $heading_tag; ?>>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<div class="vira-mq__rows">
				<?php $render_track( $top_logos, 'normal', $unique_id ); ?>
				<?php if ( $show_2nd ) : ?>
					<?php $render_track( $bottom_logos, 'reverse', $unique_id ); ?>
				<?php endif; ?>
			</div>
		</section>

		<script>
		(function(){
			var root = document.getElementById('<?php echo esc_js( $unique_id ); ?>');
			if (!root) return;
			// Guard: if a row has no items it stays empty; nothing else needed since
			// the marquee is CSS-driven. We only neutralize animation when reduced motion.
			var reduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
			if (reduced){
				root.querySelectorAll('.vira-mq__track').forEach(function(t){ t.style.animation = 'none'; });
			}
		})();
		</script>
		<?php
	}
}
