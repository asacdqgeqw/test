<?php
/**
 * Vira Sections — 3D Testimonials Slider Widget
 *
 * Editable testimonial cards with avatar (image or fallback letter),
 * quote, author info, and a customizable badge. 3D-style transitions,
 * controls (prev/next + dots), touch swipe, and optional auto-play.
 *
 * @package ViraSections
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Vira_Sections_Widget_Testimonials_Slider
 */
class Vira_Sections_Widget_Testimonials_Slider extends \Elementor\Widget_Base {

	public function get_name() {
		return 'vira_testimonials_slider';
	}

	public function get_title() {
		return __( 'Testimonials Slider (Vira)', 'vira-sections' );
	}

	public function get_icon() {
		return 'eicon-testimonial-carousel';
	}

	public function get_categories() {
		return array( 'vira-sections' );
	}

	public function get_keywords() {
		return array( 'vira', 'testimonials', 'reviews', 'slider', 'carousel' );
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
				'default' => __( 'تجربه مشتریان', 'vira-sections' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'پروژه‌هایی که <em>نتیجه واقعی</em> دادند', 'vira-sections' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'کسب‌وکارهایی که با همکاری ما، فروش و رضایت مشتری‌شان را چند برابر کردند.', 'vira-sections' ),
				'rows'    => 3,
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * Testimonials Repeater
		 * ============================================================ */
		$this->start_controls_section(
			'section_items',
			array(
				'label' => __( 'Testimonials', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'avatar_text',
			array(
				'label'       => __( 'Avatar Letter', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'م',
				'description' => __( 'Single letter shown when no avatar image is set.', 'vira-sections' ),
			)
		);

		$repeater->add_control(
			'avatar_image',
			array(
				'label'   => __( 'Avatar Image', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array( 'url' => '' ),
			)
		);

		$repeater->add_control(
			'quote',
			array(
				'label'   => __( 'Quote', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'متن نقل قول مشتری در این قسمت قرار می‌گیرد.', 'vira-sections' ),
				'rows'    => 4,
			)
		);

		$repeater->add_control(
			'name',
			array(
				'label'   => __( 'Name', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'نام مشتری', 'vira-sections' ),
			)
		);

		$repeater->add_control(
			'company',
			array(
				'label'   => __( 'Company / Role', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'مدیرعامل، شرکت نمونه', 'vira-sections' ),
			)
		);

		$repeater->add_control(
			'badge_text',
			array(
				'label'   => __( 'Badge Text', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( '+۲۰۰٪ نتیجه', 'vira-sections' ),
			)
		);

		$repeater->add_control(
			'badge_icon',
			array(
				'label'   => __( 'Badge Icon', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-chart-line',
					'library' => 'fa-solid',
				),
			)
		);

		$this->add_control(
			'items',
			array(
				'label'       => __( 'Items', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ name }}}',
				'default'     => array(
					array(
						'avatar_text' => 'ف',
						'quote'       => __( 'پروژه‌ای که برامون انجام دادن، فروش‌مون رو ۲ برابر کرد. سرعت پشتیبانی بی‌نظیره و کاربرها مدام بازخورد مثبت می‌دن.', 'vira-sections' ),
						'name'        => __( 'فرهاد رضایی', 'vira-sections' ),
						'company'     => __( 'مدیرعامل، فروشگاه آنلاین آذرتاپ', 'vira-sections' ),
						'badge_text'  => __( '+۲۰۰٪ فروش', 'vira-sections' ),
					),
					array(
						'avatar_text' => 'س',
						'quote'       => __( 'تو ۸ هفته یه پروژه کامل تحویل دادن که الان ۱۰،۰۰۰ کاربر فعال داره. تجربه کاربری روان و طراحی مدرن.', 'vira-sections' ),
						'name'        => __( 'سعید نجفی', 'vira-sections' ),
						'company'     => __( 'بنیان‌گذار، استارتاپ دلیوری', 'vira-sections' ),
						'badge_text'  => __( '۱۰K کاربر فعال', 'vira-sections' ),
					),
					array(
						'avatar_text' => 'ل',
						'quote'       => __( 'سیستم نوبت‌دهی ما بعد از ۳ ماه راه‌اندازی، هزینه پذیرش رو نصف کرد. بیمارها هم راحت‌تر نوبت می‌گیرن.', 'vira-sections' ),
						'name'        => __( 'دکتر لیلا کریمی', 'vira-sections' ),
						'company'     => __( 'مدیر، کلینیک نوین تبریز', 'vira-sections' ),
						'badge_text'  => __( '۵۰٪ صرفه‌جویی', 'vira-sections' ),
					),
					array(
						'avatar_text' => 'م',
						'quote'       => __( 'پروژه کاربردی برای فروشنده‌های ما کاملاً مطابق نیازمون طراحی شد. اتصال به ERP بدون مشکل انجام شد.', 'vira-sections' ),
						'name'        => __( 'مهدی احمدی', 'vira-sections' ),
						'company'     => __( 'معاون فروش، پارس‌صنعت', 'vira-sections' ),
						'badge_text'  => __( 'Custom Solution', 'vira-sections' ),
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
				'default' => 5500,
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
				'label'      => __( 'Padding (Vertical)', 'vira-sections' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => 40, 'max' => 200 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 110 ),
			)
		);

		$this->add_control(
			'bg_grad_from',
			array(
				'label'   => __( 'Background Gradient 1', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
			)
		);

		$this->add_control(
			'bg_grad_to',
			array(
				'label'   => __( 'Background Gradient 2', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#FAF6EC',
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * STYLE — Card / Colors
		 * ============================================================ */
		$this->start_controls_section(
			'style_cards',
			array(
				'label' => __( 'Cards & Colors', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
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
			'accent_color',
			array(
				'label'   => __( 'Accent Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#0170B9',
			)
		);

		$this->add_control(
			'badge_color',
			array(
				'label'   => __( 'Badge Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#0F8A4A',
			)
		);

		$this->add_control(
			'avatar_grad_from',
			array(
				'label'   => __( 'Avatar Gradient 1', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#170C79',
			)
		);

		$this->add_control(
			'avatar_grad_to',
			array(
				'label'   => __( 'Avatar Gradient 2', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#128BE0',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render frontend output.
	 */
	protected function render() {
		$settings  = $this->get_settings_for_display();
		$unique_id = 'vira-test-' . $this->get_id();

		$pad      = ! empty( $settings['section_padding']['size'] ) ? (int) $settings['section_padding']['size'] : 110;
		$bg_from  = ! empty( $settings['bg_grad_from'] ) ? $settings['bg_grad_from'] : '#FFFFFF';
		$bg_to    = ! empty( $settings['bg_grad_to'] ) ? $settings['bg_grad_to'] : '#FAF6EC';
		$card_bg  = ! empty( $settings['card_bg'] ) ? $settings['card_bg'] : '#FFFFFF';
		$accent   = ! empty( $settings['accent_color'] ) ? $settings['accent_color'] : '#0170B9';
		$badge    = ! empty( $settings['badge_color'] ) ? $settings['badge_color'] : '#0F8A4A';
		$av_from  = ! empty( $settings['avatar_grad_from'] ) ? $settings['avatar_grad_from'] : '#170C79';
		$av_to    = ! empty( $settings['avatar_grad_to'] ) ? $settings['avatar_grad_to'] : '#128BE0';

		$auto     = ! empty( $settings['auto_play'] ) && 'yes' === $settings['auto_play'];
		$interval = ! empty( $settings['auto_interval'] ) ? (int) $settings['auto_interval'] : 5500;
		$items    = ! empty( $settings['items'] ) && is_array( $settings['items'] ) ? $settings['items'] : array();
		?>
		<style>
			#<?php echo esc_attr( $unique_id ); ?>{
				--vira-pad: <?php echo (int) $pad; ?>px;
				--vira-bg-from: <?php echo esc_attr( $bg_from ); ?>;
				--vira-bg-to: <?php echo esc_attr( $bg_to ); ?>;
				--vira-card-bg: <?php echo esc_attr( $card_bg ); ?>;
				--vira-accent: <?php echo esc_attr( $accent ); ?>;
				--vira-badge: <?php echo esc_attr( $badge ); ?>;
				--vira-av-from: <?php echo esc_attr( $av_from ); ?>;
				--vira-av-to: <?php echo esc_attr( $av_to ); ?>;
			}
			#<?php echo esc_attr( $unique_id ); ?>.vira-test{
				padding:var(--vira-pad) 24px;
				background:linear-gradient(180deg,var(--vira-bg-from) 0%,var(--vira-bg-to) 100%);
				font-family:'Vazirmatn','IRANSans',Tahoma,sans-serif;direction:rtl;color:#1D2327;
				position:relative;overflow:hidden;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__inner{max-width:1240px;margin:0 auto;position:relative;z-index:1;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__head{text-align:center;margin-bottom:64px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__eyebrow{
				display:inline-flex;align-items:center;gap:8px;
				background:rgba(1,112,185,.10);color:var(--vira-accent);
				border:1px solid rgba(1,112,185,.25);
				padding:8px 16px;border-radius:999px;font-size:14px;font-weight:600;margin-bottom:16px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__eyebrow i{
				width:8px;height:8px;border-radius:50%;background:var(--vira-accent);
				box-shadow:0 0 0 4px rgba(1,112,185,.16);display:inline-block;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test h2{font-size:clamp(28px,3.4vw,46px);font-weight:800;margin:0 0 16px;line-height:1.4;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test h2 em{
				font-style:normal;
				background:linear-gradient(135deg,var(--vira-av-from),var(--vira-av-to));
				-webkit-background-clip:text;background-clip:text;color:transparent;-webkit-text-fill-color:transparent;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__head p{color:#64748B;font-size:18px;max-width:680px;margin:0 auto;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__slider{position:relative;perspective:1200px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__track{
				display:flex;align-items:center;justify-content:center;
				min-height:400px;position:relative;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__slide{
				position:absolute;width:100%;max-width:740px;
				background:var(--vira-card-bg);border:1px solid #E2E8F0;border-radius:28px;
				padding:46px;box-shadow:0 20px 50px rgba(0,0,0,.06);
				opacity:0;transform:translateX(100px) rotateY(-8deg) scale(.9);
				transition:all .6s cubic-bezier(.4,0,.2,1);pointer-events:none;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__slide.is-active{
				opacity:1;transform:translateX(0) rotateY(0) scale(1);pointer-events:auto;z-index:3;
				border-color:rgba(1,112,185,.25);
				box-shadow:0 24px 60px rgba(15,23,42,.08),0 0 0 1px rgba(1,112,185,.12);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__slide.is-prev{opacity:.4;transform:translateX(120px) rotateY(5deg) scale(.85);z-index:1;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__slide.is-next{opacity:.4;transform:translateX(-120px) rotateY(-5deg) scale(.85);z-index:1;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__quote{
				font-size:18px;line-height:2;color:#334155;margin:0 0 28px;
				position:relative;padding-right:30px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__quote::before{
				content:"\201C";position:absolute;right:0;top:-14px;
				font-size:56px;color:var(--vira-accent);opacity:.45;font-weight:900;line-height:1;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__author{display:flex;align-items:center;gap:16px;flex-wrap:wrap;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__avatar{
				width:56px;height:56px;border-radius:50%;
				background:linear-gradient(135deg,var(--vira-av-from),var(--vira-av-to));
				display:grid;place-items:center;color:#fff;font-weight:900;font-size:20px;
				flex-shrink:0;box-shadow:0 8px 20px rgba(1,112,185,.30);
				background-size:cover;background-position:center;overflow:hidden;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__avatar img{width:100%;height:100%;object-fit:cover;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__info{flex:1;min-width:0;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__name{font-weight:800;font-size:16.5px;color:#1D2327;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__company{font-size:13px;color:#64748B;margin-top:2px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__badge{
				display:inline-flex;align-items:center;gap:6px;
				background:rgba(15,138,74,.12);color:var(--vira-badge);
				border:1px solid rgba(15,138,74,.30);
				padding:8px 14px;border-radius:12px;font-size:13.5px;font-weight:800;white-space:nowrap;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__controls{
				display:flex;align-items:center;justify-content:center;gap:16px;margin-top:40px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__btn{
				width:48px;height:48px;border-radius:50%;
				background:#fff;border:1.5px solid #E2E8F0;
				display:grid;place-items:center;cursor:pointer;
				transition:all .3s ease;color:#1D2327;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__btn:hover{border-color:var(--vira-accent);color:var(--vira-accent);box-shadow:0 4px 12px rgba(1,112,185,.20);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__dots{display:flex;gap:8px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__dot{
				width:10px;height:10px;border-radius:50%;
				background:#E2E8F0;cursor:pointer;transition:all .3s ease;border:none;padding:0;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-test__dot.is-active{
				background:linear-gradient(135deg,var(--vira-av-from),var(--vira-av-to));
				transform:scale(1.4);width:26px;border-radius:6px;
			}
			@media(max-width:768px){
				#<?php echo esc_attr( $unique_id ); ?> .vira-test__slide{padding:28px;max-width:92%;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-test__slide.is-prev,
				#<?php echo esc_attr( $unique_id ); ?> .vira-test__slide.is-next{opacity:0;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-test__quote{font-size:16px;}
			}
		</style>

		<section id="<?php echo esc_attr( $unique_id ); ?>" class="vira-test" data-vira-testimonials>
			<div class="vira-test__inner">
				<div class="vira-test__head">
					<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
						<span class="vira-test__eyebrow"><i></i><?php echo esc_html( $settings['eyebrow'] ); ?></span>
					<?php endif; ?>
					<?php if ( ! empty( $settings['heading'] ) ) : ?>
						<h2><?php echo wp_kses_post( $settings['heading'] ); ?></h2>
					<?php endif; ?>
					<?php if ( ! empty( $settings['description'] ) ) : ?>
						<p><?php echo esc_html( $settings['description'] ); ?></p>
					<?php endif; ?>
				</div>

				<div class="vira-test__slider" data-slider>
					<div class="vira-test__track">
						<?php foreach ( $items as $i => $item ) :
							$has_image = ! empty( $item['avatar_image']['url'] );
							?>
							<div class="vira-test__slide<?php echo 0 === $i ? ' is-active' : ''; ?>" data-slide="<?php echo (int) $i; ?>">
								<?php if ( ! empty( $item['quote'] ) ) : ?>
									<p class="vira-test__quote"><?php echo esc_html( $item['quote'] ); ?></p>
								<?php endif; ?>
								<div class="vira-test__author">
									<div class="vira-test__avatar">
										<?php if ( $has_image ) : ?>
											<img src="<?php echo esc_url( $item['avatar_image']['url'] ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>" />
										<?php else : ?>
											<?php echo esc_html( $item['avatar_text'] ); ?>
										<?php endif; ?>
									</div>
									<div class="vira-test__info">
										<div class="vira-test__name"><?php echo esc_html( $item['name'] ); ?></div>
										<?php if ( ! empty( $item['company'] ) ) : ?>
											<div class="vira-test__company"><?php echo esc_html( $item['company'] ); ?></div>
										<?php endif; ?>
									</div>
									<?php if ( ! empty( $item['badge_text'] ) ) : ?>
										<div class="vira-test__badge">
											<?php if ( ! empty( $item['badge_icon'] ) ) : ?>
												<?php \Elementor\Icons_Manager::render_icon( $item['badge_icon'], array( 'aria-hidden' => 'true' ) ); ?>
											<?php endif; ?>
											<?php echo esc_html( $item['badge_text'] ); ?>
										</div>
									<?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>

					<div class="vira-test__controls">
						<button type="button" class="vira-test__btn" data-prev aria-label="<?php esc_attr_e( 'قبلی', 'vira-sections' ); ?>">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</button>
						<div class="vira-test__dots">
							<?php foreach ( $items as $i => $item ) : ?>
								<button type="button" class="vira-test__dot<?php echo 0 === $i ? ' is-active' : ''; ?>" data-dot="<?php echo (int) $i; ?>" aria-label="<?php echo esc_attr( ( $i + 1 ) ); ?>"></button>
							<?php endforeach; ?>
						</div>
						<button type="button" class="vira-test__btn" data-next aria-label="<?php esc_attr_e( 'بعدی', 'vira-sections' ); ?>">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</button>
					</div>
				</div>
			</div>
		</section>

		<script>
		(function(){
			var root = document.getElementById('<?php echo esc_js( $unique_id ); ?>');
			if (!root) return;
			var slides = root.querySelectorAll('.vira-test__slide');
			var dots = root.querySelectorAll('.vira-test__dot');
			var prev = root.querySelector('[data-prev]');
			var next = root.querySelector('[data-next]');
			var current = 0; var total = slides.length;
			if (!total) return;
			function goTo(idx){
				current = ((idx % total) + total) % total;
				slides.forEach(function(s,i){
					s.classList.remove('is-active','is-prev','is-next');
					if (i === current) s.classList.add('is-active');
					else if (i === ((current-1+total)%total)) s.classList.add('is-prev');
					else if (i === ((current+1)%total)) s.classList.add('is-next');
				});
				dots.forEach(function(d,i){ d.classList.toggle('is-active', i===current); });
			}
			if (prev) prev.addEventListener('click', function(){ goTo(current+1); resetAuto(); });
			if (next) next.addEventListener('click', function(){ goTo(current-1); resetAuto(); });
			dots.forEach(function(d,i){ d.addEventListener('click', function(){ goTo(i); resetAuto(); }); });

			var startX = 0;
			root.addEventListener('touchstart', function(e){ startX = e.touches[0].clientX; }, { passive: true });
			root.addEventListener('touchend', function(e){
				var diff = e.changedTouches[0].clientX - startX;
				if (Math.abs(diff) > 50) { (diff > 0) ? goTo(current+1) : goTo(current-1); resetAuto(); }
			}, { passive: true });

			var auto = null;
			<?php if ( $auto ) : ?>
			function startAuto(){ auto = setInterval(function(){ goTo(current+1); }, <?php echo (int) $interval; ?>); }
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
