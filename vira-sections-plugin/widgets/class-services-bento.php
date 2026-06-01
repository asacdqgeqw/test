<?php
/**
 * Vira Sections — Services Bento Widget
 *
 * A flexible "bento grid" of service cards with editable icons, copy,
 * pricing/meta text, link, card size, and dark-card switcher per item.
 *
 * @package ViraSections
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Vira_Sections_Widget_Services_Bento
 *
 * Renders a responsive bento-style services grid where each card can be
 * sized small (2 cols), medium (2 cols) or large (3 cols) on a 6-col grid.
 */
class Vira_Sections_Widget_Services_Bento extends \Elementor\Widget_Base {

	use Vira_Sections_Preset_Trait;

	public function get_name() {
		return 'vira_services_bento';
	}

	public function get_title() {
		return __( 'Services Bento (Vira)', 'vira-sections' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return array( 'vira-sections' );
	}

	public function get_keywords() {
		return array( 'vira', 'services', 'bento', 'grid', 'cards', 'features' );
	}

	/**
	 * Register Elementor controls (Content + Style tabs).
	 */
	protected function register_controls() {

		$this->register_preset_control();

		/* ============================================================
		 * CONTENT TAB — Section Header
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
				'default'     => __( 'خدمات ما', 'vira-sections' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'برای هر صنعت و کسب‌وکار، <em>راهکار مناسب</em>', 'vira-sections' ),
				'label_block' => true,
				'description' => __( 'Wrap highlighted words in &lt;em&gt;...&lt;/em&gt; for gradient color.', 'vira-sections' ),
			)
		);

		$this->register_tag_control( 'heading_tag', __( 'Heading HTML Tag (SEO)', 'vira-sections' ), 'h2' );
		$this->register_tag_control( 'card_title_tag', __( 'Card Title HTML Tag (SEO)', 'vira-sections' ), 'h3' );

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'هر کسب‌وکار دنیای خاص خودش رو داره. ما با شناخت دقیق نیاز هر صنعت، راهکاری می‌سازیم که برای کاربرانش معنا داشته باشه.', 'vira-sections' ),
				'rows'    => 3,
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * CONTENT TAB — Service Cards (Repeater)
		 * ============================================================ */
		$this->start_controls_section(
			'section_cards',
			array(
				'label' => __( 'Service Cards', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'card_icon',
			array(
				'label'   => __( 'Icon', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-cube',
					'library' => 'fa-solid',
				),
			)
		);

		$repeater->add_control(
			'card_title',
			array(
				'label'       => __( 'Title', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'عنوان خدمت', 'vira-sections' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'card_desc',
			array(
				'label'   => __( 'Description', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'توضیح کوتاه درباره این خدمت، مزایای آن و ارزشی که برای مشتری ایجاد می‌کند.', 'vira-sections' ),
				'rows'    => 4,
			)
		);

		$repeater->add_control(
			'card_meta',
			array(
				'label'       => __( 'Meta / Price Text', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'از ۲ میلیون تومان', 'vira-sections' ),
				'label_block' => true,
				'description' => __( 'Wrap emphasized text in &lt;strong&gt;...&lt;/strong&gt;', 'vira-sections' ),
			)
		);

		$repeater->add_control(
			'card_link_text',
			array(
				'label'       => __( 'Link Text', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'جزئیات بیشتر', 'vira-sections' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'card_link',
			array(
				'label'       => __( 'Link', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => 'https://example.com/',
				'default'     => array(
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => false,
				),
			)
		);

		$repeater->add_control(
			'card_size',
			array(
				'label'   => __( 'Card Size', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'medium',
				'options' => array(
					'small'  => __( 'Small (2 cols)', 'vira-sections' ),
					'medium' => __( 'Medium (3 cols)', 'vira-sections' ),
					'large'  => __( 'Large (full row)', 'vira-sections' ),
				),
			)
		);

		$repeater->add_control(
			'card_is_dark',
			array(
				'label'        => __( 'Dark Card', 'vira-sections' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'vira-sections' ),
				'label_off'    => __( 'No', 'vira-sections' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_control(
			'cards',
			array(
				'label'       => __( 'Cards', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ card_title }}}',
				'default'     => array(
					array(
						'card_title'     => __( 'اپلیکیشن فروشگاهی', 'vira-sections' ),
						'card_desc'      => __( 'یک فروشگاه کامل در جیب مشتری. مدیریت محصولات، سبد خرید، درگاه پرداخت داخلی و باشگاه مشتریان.', 'vira-sections' ),
						'card_meta'      => __( '<strong>از ۸۰ میلیون</strong> / پروژه', 'vira-sections' ),
						'card_link_text' => __( 'جزئیات بیشتر', 'vira-sections' ),
						'card_size'      => 'large',
						'card_is_dark'   => 'yes',
					),
					array(
						'card_title'     => __( 'اپلیکیشن خدماتی', 'vira-sections' ),
						'card_desc'      => __( 'برای کسب‌وکارهای On-Demand مثل دلیوری، تاکسی، خدمات منزل و رزرو آنلاین با نقشه زنده.', 'vira-sections' ),
						'card_meta'      => __( '<strong>از ۹۰ میلیون</strong> / پروژه', 'vira-sections' ),
						'card_link_text' => __( 'جزئیات بیشتر', 'vira-sections' ),
						'card_size'      => 'large',
					),
					array(
						'card_title'     => __( 'اپ محتوایی', 'vira-sections' ),
						'card_desc'      => __( 'برای رسانه‌ها، بلاگ‌ها و پلتفرم‌های آموزشی با امکان پخش ویدیو و آفلاین خوانی.', 'vira-sections' ),
						'card_meta'      => __( '<strong>از ۴۵ میلیون</strong>', 'vira-sections' ),
						'card_link_text' => __( 'مشاهده', 'vira-sections' ),
						'card_size'      => 'medium',
					),
					array(
						'card_title'     => __( 'اپ سازمانی', 'vira-sections' ),
						'card_desc'      => __( 'برای فروشندگان، کادر و انبار با اتصال به ERP و گزارش‌های لحظه‌ای داخلی.', 'vira-sections' ),
						'card_meta'      => __( '<strong>قیمت سفارشی</strong>', 'vira-sections' ),
						'card_link_text' => __( 'مشاوره', 'vira-sections' ),
						'card_size'      => 'medium',
					),
					array(
						'card_title'     => __( 'اپ پزشکی', 'vira-sections' ),
						'card_desc'      => __( 'نوبت‌دهی آنلاین، پرونده الکترونیک، ویزیت آنلاین و ارتباط با بیمار.', 'vira-sections' ),
						'card_meta'      => __( '<strong>از ۶۰ میلیون</strong>', 'vira-sections' ),
						'card_link_text' => __( 'جزئیات', 'vira-sections' ),
						'card_size'      => 'medium',
					),
					array(
						'card_title'     => __( 'پروژه شما اینجا نیست؟', 'vira-sections' ),
						'card_desc'      => __( 'ما با هر ایده‌ای کار می‌کنیم. از یه اپ بازی ساده تا پلتفرم‌های پیچیده با اتصال به سخت‌افزار IoT.', 'vira-sections' ),
						'card_meta'      => __( '<strong>ایده‌ت رو بگو</strong>', 'vira-sections' ),
						'card_link_text' => __( 'تماس با ما', 'vira-sections' ),
						'card_size'      => 'large',
					),
				),
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * STYLE TAB — Section
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
				'label'   => __( 'Background Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * STYLE TAB — Cards
		 * ============================================================ */
		$this->start_controls_section(
			'style_cards',
			array(
				'label' => __( 'Cards', 'vira-sections' ),
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
			'card_dark_bg',
			array(
				'label'   => __( 'Dark Card Background', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#170C79',
			)
		);

		$this->add_control(
			'card_border',
			array(
				'label'   => __( 'Card Border Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#E2E8F0',
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * STYLE TAB — Colors / Gradient
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
			'gradient_from',
			array(
				'label'   => __( 'Gradient Color 1', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#170C79',
			)
		);

		$this->add_control(
			'gradient_to',
			array(
				'label'   => __( 'Gradient Color 2', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#128BE0',
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'   => __( 'Body Text Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#1D2327',
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * STYLE TAB — Typography
		 * ============================================================ */
		$this->start_controls_section(
			'style_typography',
			array(
				'label' => __( 'Typography', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_typography',
				'label'    => __( 'Heading', 'vira-sections' ),
				'selector' => '{{WRAPPER}} .vira-svc h2',
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'card_title_typography',
				'label'    => __( 'Card Title', 'vira-sections' ),
				'selector' => '{{WRAPPER}} .vira-svc__title',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Frontend render.
	 */
	protected function render() {
		$settings  = $this->get_settings_for_display();
		$unique_id = 'vira-svc-' . $this->get_id();

		$bg            = ! empty( $settings['section_bg'] ) ? $settings['section_bg'] : '#FFFFFF';
		$pad           = ! empty( $settings['section_padding']['size'] ) ? (int) $settings['section_padding']['size'] : 110;
		$accent        = ! empty( $settings['accent_color'] ) ? $settings['accent_color'] : '#0170B9';
		$grad_from     = ! empty( $settings['gradient_from'] ) ? $settings['gradient_from'] : '#170C79';
		$grad_to       = ! empty( $settings['gradient_to'] ) ? $settings['gradient_to'] : '#128BE0';
		$card_bg       = ! empty( $settings['card_bg'] ) ? $settings['card_bg'] : '#FFFFFF';
		$card_dark_bg  = ! empty( $settings['card_dark_bg'] ) ? $settings['card_dark_bg'] : '#170C79';
		$card_border   = ! empty( $settings['card_border'] ) ? $settings['card_border'] : '#E2E8F0';
		$text_color    = ! empty( $settings['text_color'] ) ? $settings['text_color'] : '#1D2327';

		$cards = ! empty( $settings['cards'] ) && is_array( $settings['cards'] ) ? $settings['cards'] : array();
		?>
		<style>
			#<?php echo esc_attr( $unique_id ); ?>{
				--vira-bg: <?php echo esc_attr( $bg ); ?>;
				--vira-pad: <?php echo (int) $pad; ?>px;
				--vira-accent: <?php echo esc_attr( $accent ); ?>;
				--vira-grad-from: <?php echo esc_attr( $grad_from ); ?>;
				--vira-grad-to: <?php echo esc_attr( $grad_to ); ?>;
				--vira-card-bg: <?php echo esc_attr( $card_bg ); ?>;
				--vira-card-dark-bg: <?php echo esc_attr( $card_dark_bg ); ?>;
				--vira-card-border: <?php echo esc_attr( $card_border ); ?>;
				--vira-text: <?php echo esc_attr( $text_color ); ?>;
			}
			#<?php echo esc_attr( $unique_id ); ?>.vira-svc{
				padding:var(--vira-pad) 24px;background:var(--vira-bg);
				font-family:'Vazirmatn','IRANSans',Tahoma,sans-serif;direction:rtl;color:var(--vira-text);
				position:relative;overflow:hidden;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__inner{max-width:1240px;margin:0 auto;position:relative;z-index:1;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__head{text-align:center;margin-bottom:60px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__eyebrow{
				display:inline-flex;align-items:center;gap:8px;
				background:rgba(1,112,185,.10);color:var(--vira-accent);
				border:1px solid rgba(1,112,185,.25);
				padding:8px 16px;border-radius:999px;font-size:14px;font-weight:600;margin-bottom:16px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__eyebrow i{
				width:8px;height:8px;border-radius:50%;background:var(--vira-accent);
				box-shadow:0 0 0 4px rgba(1,112,185,.16);display:inline-block;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc h2, #<?php echo esc_attr( $unique_id ); ?> .vira-svc__heading{font-size:clamp(28px,3.4vw,46px);font-weight:800;margin:0 0 16px;line-height:1.4;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc h2 em, #<?php echo esc_attr( $unique_id ); ?> .vira-svc__heading em{
				font-style:normal;
				background:linear-gradient(135deg,var(--vira-grad-from),var(--vira-grad-to));
				-webkit-background-clip:text;background-clip:text;color:transparent;-webkit-text-fill-color:transparent;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__head p{color:#64748B;font-size:18px;max-width:680px;margin:0 auto;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__grid{display:grid;grid-template-columns:repeat(6,1fr);gap:20px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card{
				background:var(--vira-card-bg);border:1.5px solid var(--vira-card-border);border-radius:24px;
				padding:32px;position:relative;overflow:hidden;
				transition:transform .35s cubic-bezier(.4,0,.2,1),box-shadow .35s ease,border-color .35s ease;
				display:flex;flex-direction:column;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card:hover{
				transform:translateY(-6px);box-shadow:0 24px 50px rgba(1,112,185,.12);
				border-color:var(--vira-accent);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card::after{
				content:"";position:absolute;top:0;left:0;right:0;height:3px;
				background:linear-gradient(90deg,var(--vira-grad-from),var(--vira-grad-to));
				transform:scaleX(0);transform-origin:right;transition:transform .4s ease;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card:hover::after{transform:scaleX(1);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card.size-small{grid-column:span 2;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card.size-medium{grid-column:span 3;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card.size-large{grid-column:span 6;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card.is-dark{
				background:var(--vira-card-dark-bg);border-color:transparent;color:#fff;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card.is-dark .vira-svc__title,
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card.is-dark .vira-svc__desc,
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card.is-dark .vira-svc__meta{color:#fff;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card.is-dark .vira-svc__desc{color:rgba(255,255,255,.78);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card.is-dark .vira-svc__meta{border-top-color:rgba(255,255,255,.15);color:rgba(255,255,255,.6);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__icon{
				width:60px;height:60px;border-radius:16px;
				background:linear-gradient(135deg,rgba(23,12,121,.10),rgba(1,112,185,.08));
				color:var(--vira-accent);
				display:grid;place-items:center;margin-bottom:20px;font-size:28px;
				transition:all .35s ease;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card:hover .vira-svc__icon{
				background:linear-gradient(135deg,var(--vira-grad-from),var(--vira-grad-to));
				color:#fff;transform:rotate(-5deg) scale(1.05);
				box-shadow:0 12px 24px rgba(1,112,185,.30);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card.is-dark .vira-svc__icon{
				background:rgba(255,255,255,.10);color:#fff;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__title{font-size:20px;font-weight:800;margin:0 0 10px;color:var(--vira-text);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__desc{color:#64748B;font-size:14.5px;line-height:1.85;margin:0 0 20px;flex:1;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__meta{
				display:flex;align-items:center;gap:8px;
				padding-top:18px;border-top:1px dashed var(--vira-card-border);
				font-size:13px;color:#94A3B8;font-weight:600;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__meta strong{color:var(--vira-accent);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card.is-dark .vira-svc__meta strong{color:#fff;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__link{
				display:inline-flex;align-items:center;gap:6px;margin-top:16px;
				font-size:14px;font-weight:700;color:var(--vira-accent);text-decoration:none;
				transition:gap .25s ease;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__link:hover{gap:10px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card.is-dark .vira-svc__link{color:#fff;}
			@media(max-width:980px){
				#<?php echo esc_attr( $unique_id ); ?> .vira-svc__grid{grid-template-columns:repeat(2,1fr);}
				#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card.size-small,
				#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card.size-medium,
				#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card.size-large{grid-column:span 2;}
			}
			@media(max-width:560px){
				#<?php echo esc_attr( $unique_id ); ?> .vira-svc__grid{grid-template-columns:1fr;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card.size-small,
				#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card.size-medium,
				#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card.size-large{grid-column:span 1;}
			}

			/* === Entrance Animation === */
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card{
				opacity:0;transform:translateY(40px);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card.vira-visible{
				opacity:1;transform:translateY(0);
				transition:opacity .6s cubic-bezier(.4,0,.2,1),transform .6s cubic-bezier(.4,0,.2,1);
			}

			/* === Tilt/Depth on Hover === */
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card:hover{
				transform:translateY(-6px) perspective(800px) rotateX(2deg) rotateY(-2deg);
				box-shadow:0 24px 50px rgba(1,112,185,.12),0 8px 16px rgba(0,0,0,.06);
				border-color:var(--vira-accent);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card.vira-visible:hover{
				transform:translateY(-6px) perspective(800px) rotateX(2deg) rotateY(-2deg);
			}

			/* === Animated Icon Hover === */
			@keyframes <?php echo esc_attr( $unique_id ); ?>-icon-spin{
				0%{transform:rotate(-5deg) scale(1.05);}
				50%{transform:rotate(5deg) scale(1.1);}
				100%{transform:rotate(-5deg) scale(1.05);}
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card:hover .vira-svc__icon{
				background:linear-gradient(135deg,var(--vira-grad-from),var(--vira-grad-to));
				color:#fff;
				animation:<?php echo esc_attr( $unique_id ); ?>-icon-spin 2s ease-in-out infinite;
				box-shadow:0 12px 24px rgba(1,112,185,.30);
			}

			/* === Shimmer/Glow Border on Hover === */
			@keyframes <?php echo esc_attr( $unique_id ); ?>-shimmer{
				0%{background-position:200% center;}
				100%{background-position:-200% center;}
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card::before{
				content:"";position:absolute;inset:-2px;border-radius:26px;
				background:linear-gradient(90deg,transparent,rgba(1,112,185,.4),transparent,rgba(18,139,224,.4),transparent);
				background-size:200% 100%;
				opacity:0;transition:opacity .4s ease;z-index:-1;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card:hover::before{
				opacity:1;
				animation:<?php echo esc_attr( $unique_id ); ?>-shimmer 3s linear infinite;
			}

			/* === Reduced Motion === */
			@media(prefers-reduced-motion:reduce){
				#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card{opacity:1;transform:none;transition:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card:hover{transform:none;transition:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card:hover .vira-svc__icon{animation:none;transform:none;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card::before{animation:none;opacity:0 !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-svc__card::after{transition:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-svc__icon{transition:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-svc__link{transition:none !important;}
			}
		</style>

		<section id="<?php echo esc_attr( $unique_id ); ?>" class="vira-svc" data-vira-services-bento>
			<div class="vira-svc__inner">
				<div class="vira-svc__head">
					<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
						<span class="vira-svc__eyebrow"><i></i><?php echo esc_html( $settings['eyebrow'] ); ?></span>
					<?php endif; ?>
					<?php if ( ! empty( $settings['heading'] ) ) : ?>
						<?php $heading_tag = $this->vira_safe_tag( isset( $settings['heading_tag'] ) ? $settings['heading_tag'] : 'h2', 'h2' ); ?>
						<<?php echo $heading_tag; ?> class="vira-svc__heading"><?php echo wp_kses_post( $settings['heading'] ); ?></<?php echo $heading_tag; ?>>
					<?php endif; ?>
					<?php if ( ! empty( $settings['description'] ) ) : ?>
						<p><?php echo esc_html( $settings['description'] ); ?></p>
					<?php endif; ?>
				</div>

				<div class="vira-svc__grid">
					<?php foreach ( $cards as $card ) :
						$size      = ! empty( $card['card_size'] ) ? $card['card_size'] : 'medium';
						$is_dark   = ! empty( $card['card_is_dark'] ) && 'yes' === $card['card_is_dark'];
						$class     = 'vira-svc__card size-' . $size . ( $is_dark ? ' is-dark' : '' );
						$link_url  = ! empty( $card['card_link']['url'] ) ? $card['card_link']['url'] : '#';
						$link_ext  = ! empty( $card['card_link']['is_external'] ) ? ' target="_blank"' : '';
						$link_nf   = ! empty( $card['card_link']['nofollow'] ) ? ' rel="nofollow"' : '';
						?>
						<div class="<?php echo esc_attr( $class ); ?>">
							<?php if ( ! empty( $card['card_icon'] ) ) : ?>
								<div class="vira-svc__icon">
									<?php \Elementor\Icons_Manager::render_icon( $card['card_icon'], array( 'aria-hidden' => 'true' ) ); ?>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $card['card_title'] ) ) : ?>
								<?php $card_title_tag = $this->vira_safe_tag( isset( $settings['card_title_tag'] ) ? $settings['card_title_tag'] : 'h3', 'h3' ); ?>
								<<?php echo $card_title_tag; ?> class="vira-svc__title"><?php echo esc_html( $card['card_title'] ); ?></<?php echo $card_title_tag; ?>>
							<?php endif; ?>
							<?php if ( ! empty( $card['card_desc'] ) ) : ?>
								<p class="vira-svc__desc"><?php echo esc_html( $card['card_desc'] ); ?></p>
							<?php endif; ?>
							<?php if ( ! empty( $card['card_meta'] ) ) : ?>
								<div class="vira-svc__meta"><?php echo wp_kses_post( $card['card_meta'] ); ?></div>
							<?php endif; ?>
							<?php if ( ! empty( $card['card_link_text'] ) ) : ?>
								<a class="vira-svc__link" href="<?php echo esc_url( $link_url ); ?>"<?php echo $link_ext . $link_nf; // phpcs:ignore ?>>
									<?php echo esc_html( $card['card_link_text'] ); ?>
									<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 5l-7 7 7 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
								</a>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<script>
		(function(){
			var root = document.getElementById('<?php echo esc_js( $unique_id ); ?>');
			if (!root) return;
			var cards = root.querySelectorAll('.vira-svc__card');
			if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
				cards.forEach(function(c){ c.classList.add('vira-visible'); });
				return;
			}
			var observer = new IntersectionObserver(function(entries){
				entries.forEach(function(entry){
					if (entry.isIntersecting) {
						var card = entry.target;
						var idx = Array.prototype.indexOf.call(cards, card);
						setTimeout(function(){ card.classList.add('vira-visible'); }, idx * 120);
						observer.unobserve(card);
					}
				});
			}, { threshold: 0.15 });
			cards.forEach(function(c){ observer.observe(c); });
		})();
		</script>
		<?php
	}
}
