<?php
/**
 * Vira Sections — Hero Widget
 *
 * Hero section with Aurora gradient background, mouse spotlight,
 * 3D Tilt mockup, rotating words, animated counters and Marquee.
 *
 * @package ViraSections
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
 
class Vira_Sections_Widget_Hero extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'vira_hero';
	}
 
	public function get_title() {
		return __( 'Hero (Vira)', 'vira-sections' );
	}
 
	public function get_icon() {
		return 'eicon-banner';
	}
 
	public function get_categories() {
		return array( 'vira-sections' );
	}
 
	public function get_keywords() {
		return array( 'vira', 'hero', 'banner', 'header', 'aurora' );
	}
 
	protected function register_controls() {
 
		/* ============= Content: Header ============= */
		$this->start_controls_section(
			'section_content',
			array( 'label' => __( 'Hero Content', 'vira-sections' ), 'tab' => \Elementor\Controls_Manager::TAB_CONTENT )
		);
 
		$this->add_control(
			'badge_icon',
			array(
				'label'   => __( 'Top Badge Icon (Emoji or Letter)', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '🚀',
			)
		);
 
		$this->add_control(
			'badge_text',
			array(
				'label'       => __( 'Top Badge Text', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( '۱۲۰+ پروژه موفق', 'vira-sections' ),
				'label_block' => true,
			)
		);
 
		$this->add_control(
			'heading_before',
			array(
				'label'       => __( 'Heading (before rotating words)', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => __( "ایده‌ت رو\nتبدیل کن به یه", 'vira-sections' ),
				'rows'        => 3,
				'description' => __( 'Multiple lines supported.', 'vira-sections' ),
			)
		);
 
		$rep_words = new \Elementor\Repeater();
		$rep_words->add_control(
			'word',
			array(
				'label'   => __( 'Word', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'محصول موفق', 'vira-sections' ),
			)
		);
 
		$this->add_control(
			'rotating_words',
			array(
				'label'       => __( 'Rotating Words', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $rep_words->get_controls(),
				'title_field' => '{{{ word }}}',
				'default'     => array(
					array( 'word' => __( 'محصول موفق', 'vira-sections' ) ),
					array( 'word' => __( 'برند ماندگار', 'vira-sections' ) ),
					array( 'word' => __( 'کسب‌وکار رشد یافته', 'vira-sections' ) ),
					array( 'word' => __( 'تجربه بی‌نظیر', 'vira-sections' ) ),
				),
			)
		);
 
		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'تیم ما با ۱۰ سال تجربه، ایده شما را به محصولی واقعی و درآمدزا تبدیل می‌کند. از طراحی تا توسعه و رشد — همه در یک جا.', 'vira-sections' ),
				'rows'    => 4,
			)
		);
 
		$this->end_controls_section();
 
		/* ============= Content: CTA Buttons ============= */
		$this->start_controls_section(
			'section_cta',
			array( 'label' => __( 'CTA Buttons', 'vira-sections' ), 'tab' => \Elementor\Controls_Manager::TAB_CONTENT )
		);
 
		$this->add_control(
			'btn_primary_text',
			array(
				'label'   => __( 'Primary Button Text', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'درخواست مشاوره رایگان', 'vira-sections' ),
			)
		);
		$this->add_control(
			'btn_primary_link',
			array(
				'label'   => __( 'Primary Button Link', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::URL,
				'default' => array( 'url' => '#contact' ),
			)
		);
		$this->add_control(
			'btn_secondary_text',
			array(
				'label'   => __( 'Secondary Button Text', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'مشاهده پکیج‌ها', 'vira-sections' ),
			)
		);
		$this->add_control(
			'btn_secondary_link',
			array(
				'label'   => __( 'Secondary Button Link', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::URL,
				'default' => array( 'url' => '#pricing' ),
			)
		);
 
		$this->end_controls_section();
 
		/* ============= Content: Stats ============= */
		$this->start_controls_section(
			'section_stats',
			array( 'label' => __( 'Stats', 'vira-sections' ), 'tab' => \Elementor\Controls_Manager::TAB_CONTENT )
		);
 
		$rep_stat = new \Elementor\Repeater();
		$rep_stat->add_control(
			'value',
			array( 'label' => __( 'Number', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::NUMBER, 'default' => 100 )
		);
		$rep_stat->add_control(
			'suffix',
			array( 'label' => __( 'Suffix', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '+' )
		);
		$rep_stat->add_control(
			'label',
			array( 'label' => __( 'Label', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __( 'پروژه موفق', 'vira-sections' ) )
		);
 
		$this->add_control(
			'stats',
			array(
				'label'       => __( 'Stats', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $rep_stat->get_controls(),
				'title_field' => '{{{ value }}}{{{ suffix }}} - {{{ label }}}',
				'default'     => array(
					array( 'value' => 120, 'suffix' => '+', 'label' => __( 'پروژه موفق', 'vira-sections' ) ),
					array( 'value' => 95, 'suffix' => '٪', 'label' => __( 'رضایت مشتری', 'vira-sections' ) ),
					array( 'value' => 10, 'suffix' => '+', 'label' => __( 'سال تجربه', 'vira-sections' ) ),
				),
			)
		);
 
		$this->end_controls_section();
 
		/* ============= Content: Visual ============= */
		$this->start_controls_section(
			'section_visual',
			array( 'label' => __( 'Hero Visual', 'vira-sections' ), 'tab' => \Elementor\Controls_Manager::TAB_CONTENT )
		);
 
		$this->add_control(
			'visual_type',
			array(
				'label'   => __( 'Visual Type', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'mockup',
				'options' => array(
					'mockup' => __( 'Built-in Mockup', 'vira-sections' ),
					'image'  => __( 'Custom Image', 'vira-sections' ),
					'none'   => __( 'No Visual', 'vira-sections' ),
				),
			)
		);
 
		$this->add_control(
			'visual_image',
			array(
				'label'     => __( 'Custom Image', 'vira-sections' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'condition' => array( 'visual_type' => 'image' ),
			)
		);
 
		$this->add_control(
			'visual_caption',
			array(
				'label'     => __( 'Mockup Caption', 'vira-sections' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => __( 'پروژه شما — زنده و حرفه‌ای', 'vira-sections' ),
				'condition' => array( 'visual_type' => 'mockup' ),
			)
		);
 
		$this->end_controls_section();
 
		/* ============= Content: Floating Cards ============= */
		$this->start_controls_section(
			'section_floats',
			array( 'label' => __( 'Floating Cards', 'vira-sections' ), 'tab' => \Elementor\Controls_Manager::TAB_CONTENT )
		);
 
		$this->add_control(
			'show_floats',
			array(
				'label'        => __( 'Show Floating Cards', 'vira-sections' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);
 
		$rep_float = new \Elementor\Repeater();
		$rep_float->add_control(
			'float_icon',
			array(
				'label'   => __( 'Icon', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => array( 'value' => 'fas fa-bolt', 'library' => 'fa-solid' ),
			)
		);
		$rep_float->add_control(
			'float_title',
			array( 'label' => __( 'Title', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __( 'عنوان', 'vira-sections' ) )
		);
		$rep_float->add_control(
			'float_subtitle',
			array( 'label' => __( 'Subtitle', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __( 'توضیح کوتاه', 'vira-sections' ) )
		);
		$rep_float->add_control(
			'float_position',
			array(
				'label'   => __( 'Position', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'top-right',
				'options' => array(
					'top-right'    => __( 'بالا راست', 'vira-sections' ),
					'top-left'     => __( 'بالا چپ', 'vira-sections' ),
					'middle-right' => __( 'وسط راست', 'vira-sections' ),
					'middle-left'  => __( 'وسط چپ', 'vira-sections' ),
					'bottom-right' => __( 'پایین راست', 'vira-sections' ),
					'bottom-left'  => __( 'پایین چپ', 'vira-sections' ),
				),
			)
		);
		$rep_float->add_control(
			'float_color_from',
			array(
				'label'   => __( 'Icon Gradient — From', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#128BE0',
			)
		);
		$rep_float->add_control(
			'float_color_to',
			array(
				'label'   => __( 'Icon Gradient — To', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#170C79',
			)
		);
 
		$this->add_control(
			'floats',
			array(
				'label'       => __( 'Floating Cards', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $rep_float->get_controls(),
				'title_field' => '{{{ float_title }}}',
				'condition'   => array( 'show_floats' => 'yes' ),
				'default'     => array(
					array(
						'float_icon'       => array( 'value' => 'fas fa-bolt', 'library' => 'fa-solid' ),
						'float_title'      => __( 'سرعت بالا', 'vira-sections' ),
						'float_subtitle'   => __( 'PageSpeed 95+', 'vira-sections' ),
						'float_position'   => 'top-right',
						'float_color_from' => '#128BE0',
						'float_color_to'   => '#170C79',
					),
					array(
						'float_icon'       => array( 'value' => 'fas fa-chart-line', 'library' => 'fa-solid' ),
						'float_title'      => __( 'رشد ۲۰۰٪', 'vira-sections' ),
						'float_subtitle'   => __( 'میانگین مشتریان', 'vira-sections' ),
						'float_position'   => 'middle-left',
						'float_color_from' => '#8ACBD0',
						'float_color_to'   => '#0170B9',
					),
					array(
						'float_icon'       => array( 'value' => 'fas fa-shield-alt', 'library' => 'fa-solid' ),
						'float_title'      => __( 'امنیت بانکی', 'vira-sections' ),
						'float_subtitle'   => __( 'رمزنگاری کامل', 'vira-sections' ),
						'float_position'   => 'bottom-right',
						'float_color_from' => '#0170B9',
						'float_color_to'   => '#170C79',
					),
				),
			)
		);
 
		$this->end_controls_section();
 
		/* ============= Content: Marquee ============= */
		$this->start_controls_section(
			'section_marquee',
			array( 'label' => __( 'Marquee (Bottom Strip)', 'vira-sections' ), 'tab' => \Elementor\Controls_Manager::TAB_CONTENT )
		);
 
		$this->add_control(
			'show_marquee',
			array(
				'label'        => __( 'Show Marquee', 'vira-sections' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);
 
		$rep_mq = new \Elementor\Repeater();
		$rep_mq->add_control(
			'item',
			array( 'label' => __( 'Item', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __( 'ویژگی', 'vira-sections' ) )
		);
 
		$this->add_control(
			'marquee_items',
			array(
				'label'       => __( 'Marquee Items', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $rep_mq->get_controls(),
				'title_field' => '{{{ item }}}',
				'default'     => array(
					array( 'item' => __( 'طراحی اختصاصی', 'vira-sections' ) ),
					array( 'item' => __( 'سرعت بالا', 'vira-sections' ) ),
					array( 'item' => __( 'پشتیبانی ۲۴/۷', 'vira-sections' ) ),
					array( 'item' => __( 'سئو فنی', 'vira-sections' ) ),
					array( 'item' => __( 'ریسپانسیو', 'vira-sections' ) ),
					array( 'item' => __( 'امنیت بانکی', 'vira-sections' ) ),
				),
				'condition'   => array( 'show_marquee' => 'yes' ),
			)
		);
 
		$this->end_controls_section();
 
		/* ============= Style: Background ============= */
		$this->start_controls_section(
			'style_bg',
			array( 'label' => __( 'Background', 'vira-sections' ), 'tab' => \Elementor\Controls_Manager::TAB_STYLE )
		);
 
		$this->add_control(
			'bg_color',
			array(
				'label'   => __( 'Background Base Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#060832',
			)
		);
 
		$this->add_control(
			'aurora_color_1',
			array(
				'label'   => __( 'Aurora Color 1', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#128BE0',
			)
		);
 
		$this->add_control(
			'aurora_color_2',
			array(
				'label'   => __( 'Aurora Color 2', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#170C79',
			)
		);
 
		$this->end_controls_section();
 
		/* ============= Style: Colors ============= */
		$this->start_controls_section(
			'style_colors',
			array( 'label' => __( 'Colors', 'vira-sections' ), 'tab' => \Elementor\Controls_Manager::TAB_STYLE )
		);
 
		$this->add_control(
			'text_color',
			array(
				'label'   => __( 'Text Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
			)
		);
 
		$this->add_control(
			'rotating_grad_from',
			array(
				'label'   => __( 'Rotating Words Gradient 1', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#8ACBD0',
			)
		);
 
		$this->add_control(
			'rotating_grad_to',
			array(
				'label'   => __( 'Rotating Words Gradient 2', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#EFE3CA',
			)
		);
 
		$this->add_control(
			'btn_grad_from',
			array(
				'label'   => __( 'Button Gradient 1', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#128BE0',
			)
		);
 
		$this->add_control(
			'btn_grad_to',
			array(
				'label'   => __( 'Button Gradient 2', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#8ACBD0',
			)
		);
 
		$this->end_controls_section();
	}
 
	protected function render() {
		$s         = $this->get_settings_for_display();
		$unique_id = 'vira-hero-' . $this->get_id();
 
		$bg          = ! empty( $s['bg_color'] ) ? $s['bg_color'] : '#060832';
		$aurora_1    = ! empty( $s['aurora_color_1'] ) ? $s['aurora_color_1'] : '#128BE0';
		$aurora_2    = ! empty( $s['aurora_color_2'] ) ? $s['aurora_color_2'] : '#170C79';
		$text        = ! empty( $s['text_color'] ) ? $s['text_color'] : '#FFFFFF';
		$rot_from    = ! empty( $s['rotating_grad_from'] ) ? $s['rotating_grad_from'] : '#8ACBD0';
		$rot_to      = ! empty( $s['rotating_grad_to'] ) ? $s['rotating_grad_to'] : '#EFE3CA';
		$btn_from    = ! empty( $s['btn_grad_from'] ) ? $s['btn_grad_from'] : '#128BE0';
		$btn_to      = ! empty( $s['btn_grad_to'] ) ? $s['btn_grad_to'] : '#8ACBD0';
 
		$words = ! empty( $s['rotating_words'] ) ? $s['rotating_words'] : array();
		$stats = ! empty( $s['stats'] ) ? $s['stats'] : array();
		$mq    = ! empty( $s['marquee_items'] ) ? $s['marquee_items'] : array();
 
		$word_count   = max( 1, count( $words ) );
		$rotate_height = $word_count * 1.25;
 
		$btn1_url = ! empty( $s['btn_primary_link']['url'] ) ? $s['btn_primary_link']['url'] : '#';
		$btn2_url = ! empty( $s['btn_secondary_link']['url'] ) ? $s['btn_secondary_link']['url'] : '#';
		?>
		<style>
			#<?php echo esc_attr( $unique_id ); ?>{
				--vira-bg: <?php echo esc_attr( $bg ); ?>;
				--vira-aurora-1: <?php echo esc_attr( $aurora_1 ); ?>;
				--vira-aurora-2: <?php echo esc_attr( $aurora_2 ); ?>;
				--vira-text: <?php echo esc_attr( $text ); ?>;
				--vira-rot-from: <?php echo esc_attr( $rot_from ); ?>;
				--vira-rot-to: <?php echo esc_attr( $rot_to ); ?>;
				--vira-btn-from: <?php echo esc_attr( $btn_from ); ?>;
				--vira-btn-to: <?php echo esc_attr( $btn_to ); ?>;
			}
			#<?php echo esc_attr( $unique_id ); ?>.vira-hero{
				position:relative;min-height:90vh;padding:90px 24px 0;overflow:hidden;
				background:var(--vira-bg);
				font-family:'Vazirmatn','IRANSans',Tahoma,sans-serif;direction:rtl;
				color:var(--vira-text);isolation:isolate;
			}
			#<?php echo esc_attr( $unique_id ); ?>.vira-hero::before,
			#<?php echo esc_attr( $unique_id ); ?>.vira-hero::after{
				content:"";position:absolute;border-radius:50%;filter:blur(110px);
				pointer-events:none;z-index:0;mix-blend-mode:screen;opacity:.55;
			}
			#<?php echo esc_attr( $unique_id ); ?>.vira-hero::before{
				width:55vw;height:55vw;top:-12vw;right:-8vw;
				background:radial-gradient(circle,var(--vira-aurora-1) 0%,var(--vira-aurora-2) 55%,transparent 70%);
				animation:vira-hero-aurora1 16s ease-in-out infinite;
			}
			#<?php echo esc_attr( $unique_id ); ?>.vira-hero::after{
				width:50vw;height:50vw;bottom:-18vw;left:-8vw;
				background:radial-gradient(circle,var(--vira-aurora-1) 0%,var(--vira-aurora-2) 50%,transparent 70%);
				animation:vira-hero-aurora2 18s ease-in-out infinite;
			}
			@keyframes vira-hero-aurora1{0%,100%{transform:translate(0,0) scale(1)}50%{transform:translate(-8vw,8vh) scale(1.12)}}
			@keyframes vira-hero-aurora2{0%,100%{transform:translate(0,0) scale(1)}50%{transform:translate(8vw,-6vh) scale(1.08)}}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__spot{
				position:absolute;inset:0;pointer-events:none;z-index:1;
				background:radial-gradient(600px circle at var(--mx,50%) var(--my,30%),rgba(255,255,255,.10),transparent 40%);
				transition:background .15s ease;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__grid-bg{
				position:absolute;inset:0;z-index:0;pointer-events:none;opacity:.30;
				background-image:linear-gradient(rgba(255,255,255,.06) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.06) 1px,transparent 1px);
				background-size:60px 60px;
				-webkit-mask-image:radial-gradient(ellipse 80% 60% at 50% 30%,#000,transparent 70%);
				        mask-image:radial-gradient(ellipse 80% 60% at 50% 30%,#000,transparent 70%);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__wrap{
				position:relative;z-index:2;max-width:1240px;margin:0 auto;
				display:grid;grid-template-columns:1.05fr 1fr;gap:60px;align-items:center;
				min-height:calc(90vh - 90px);padding-bottom:90px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__badge{
				display:inline-flex;align-items:center;gap:10px;
				background:rgba(255,255,255,.07);backdrop-filter:blur(10px);
				border:1px solid rgba(255,255,255,.14);
				padding:8px 18px 8px 8px;border-radius:999px;
				font-size:13px;font-weight:600;margin-bottom:22px;color:var(--vira-text);
				text-decoration:none;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__badge .pulse{
				width:24px;height:24px;border-radius:50%;
				background:linear-gradient(135deg,var(--vira-btn-from),var(--vira-btn-to));
				display:grid;place-items:center;position:relative;font-size:13px;color:var(--vira-bg);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__badge .pulse::before{
				content:"";position:absolute;inset:-6px;border-radius:50%;
				border:2px solid color-mix(in srgb, var(--vira-btn-from) 50%, transparent);
				animation:vira-hero-pulse 2s ease-out infinite;
			}
			@keyframes vira-hero-pulse{0%{transform:scale(1);opacity:1}100%{transform:scale(1.6);opacity:0}}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero h1{
				font-size:clamp(34px,5vw,64px);font-weight:900;
				line-height:1.25;letter-spacing:-1px;margin:0 0 22px;color:var(--vira-text);
				white-space:pre-line;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero h1 .rot{
				display:inline-block;
				background:linear-gradient(135deg,var(--vira-rot-from) 0%,var(--vira-rot-to) 100%);
				-webkit-background-clip:text;background-clip:text;color:transparent;
				-webkit-text-fill-color:transparent;position:relative;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero h1 .rot__list{
				display:inline-flex;flex-direction:column;vertical-align:top;
				height:1.25em;overflow:hidden;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero h1 .rot__list{
				transition: transform .6s cubic-bezier(.4,0,.2,1);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero h1 .rot__list span{
				display:block;height:1.25em;line-height:1.25em;white-space:nowrap;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero h1 .rot::after{
				content:"";display:inline-block;width:3px;height:.85em;
				background:var(--vira-rot-from);vertical-align:middle;margin-right:4px;
				animation:vira-hero-blink 1s steps(2) infinite;
			}
			@keyframes vira-hero-blink{50%{opacity:0}}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero p.lead{
				font-size:18px;color:rgba(255,255,255,.78);line-height:1.95;
				max-width:560px;margin:0 0 36px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__cta{display:flex;gap:14px;flex-wrap:wrap;margin-bottom:42px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__btn{
				display:inline-flex;align-items:center;gap:10px;
				padding:16px 30px;border-radius:14px;
				font-weight:700;font-size:16px;text-decoration:none;
				transition:all .25s ease;cursor:pointer;border:none;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__btn--primary{
				background:linear-gradient(135deg,var(--vira-btn-from),var(--vira-btn-to));
				color:var(--vira-bg);box-shadow:0 18px 40px rgba(0,0,0,.30);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__btn--primary:hover{transform:translateY(-2px);box-shadow:0 24px 56px rgba(0,0,0,.40);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__btn--ghost{
				background:rgba(255,255,255,.06);color:var(--vira-text);
				border:1.5px solid rgba(255,255,255,.18);backdrop-filter:blur(10px);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__btn--ghost:hover{background:rgba(255,255,255,.12);border-color:rgba(255,255,255,.40);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__stats{
				display:flex;gap:36px;flex-wrap:wrap;padding-top:28px;
				border-top:1px solid rgba(255,255,255,.10);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__stat .num{
				font-size:32px;font-weight:900;line-height:1;color:var(--vira-text);
				display:flex;align-items:baseline;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__stat .num em{
				font-style:normal;
				background:linear-gradient(135deg,var(--vira-rot-from),var(--vira-rot-to));
				-webkit-background-clip:text;background-clip:text;color:transparent;
				-webkit-text-fill-color:transparent;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__stat .lbl{color:rgba(255,255,255,.55);font-size:13px;margin-top:6px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__visual{
				position:relative;perspective:1500px;display:flex;align-items:center;justify-content:center;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__visual-stage{
				position:relative;width:100%;max-width:540px;aspect-ratio:1/1;
				transform-style:preserve-3d;transition:transform .15s ease-out;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__mockup{
				position:absolute;inset:8%;
				background:linear-gradient(160deg,rgba(255,255,255,.10),rgba(255,255,255,.04));
				border-radius:24px;border:1px solid rgba(255,255,255,.15);
				backdrop-filter:blur(20px);overflow:hidden;
				box-shadow:0 30px 80px rgba(0,0,0,.45);
				display:flex;flex-direction:column;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__mockup-bar{
				display:flex;align-items:center;gap:6px;padding:14px 18px;
				background:rgba(0,0,0,.20);border-bottom:1px solid rgba(255,255,255,.10);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__mockup-bar i{width:11px;height:11px;border-radius:50%;background:rgba(255,255,255,.30);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__mockup-content{
				flex:1;padding:24px;display:flex;flex-direction:column;gap:14px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__mockup-grad{
				height:60%;border-radius:14px;
				background:linear-gradient(135deg,var(--vira-aurora-1),var(--vira-aurora-2));
				position:relative;overflow:hidden;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__mockup-grad::after{
				content:"";position:absolute;inset:14px;border-radius:8px;
				background:linear-gradient(135deg,var(--vira-rot-from),transparent);
				opacity:.6;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__mockup-row{height:8px;border-radius:4px;background:rgba(255,255,255,.20);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__mockup-row.sm{width:60%;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__mockup-caption{
				margin-top:auto;font-size:13px;color:rgba(255,255,255,.72);
				font-weight:600;text-align:center;padding-top:8px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__visual img{
				width:100%;height:100%;object-fit:contain;border-radius:24px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__marquee{
				position:relative;z-index:2;margin:0 -24px;
				background:rgba(0,0,0,.35);backdrop-filter:blur(8px);
				border-block:1px solid rgba(255,255,255,.08);overflow:hidden;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__marquee-track{
				display:flex;gap:60px;padding:18px 0;width:max-content;
				animation:vira-hero-mq 32s linear infinite;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__marquee-track span{
				color:rgba(255,255,255,.55);font-weight:700;font-size:17px;
				letter-spacing:-.5px;white-space:nowrap;
				display:inline-flex;align-items:center;gap:60px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-hero__marquee-track span::after{content:"✦";color:var(--vira-rot-from);opacity:.7;}
			@keyframes vira-hero-mq{to{transform:translateX(50%);}}
			@media(max-width:980px){
				#<?php echo esc_attr( $unique_id ); ?> .vira-hero__wrap{grid-template-columns:1fr;gap:40px;padding-bottom:60px;}
				#<?php echo esc_attr( $unique_id ); ?>.vira-hero{min-height:auto;padding:60px 20px 0;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-hero__visual{order:-1;max-width:400px;margin:0 auto;}
			}
			@media(max-width:560px){
				#<?php echo esc_attr( $unique_id ); ?> .vira-hero__stats{gap:20px;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-hero__stat .num{font-size:24px;}
			}
		</style>
 
		<section id="<?php echo esc_attr( $unique_id ); ?>" class="vira-hero" data-vira-hero>
			<div class="vira-hero__grid-bg"></div>
			<div class="vira-hero__spot"></div>
 
			<div class="vira-hero__wrap">
				<div class="vira-hero__content">
					<?php if ( ! empty( $s['badge_text'] ) ) : ?>
						<a href="#" class="vira-hero__badge" onclick="return false;">
							<span class="pulse"><?php echo esc_html( $s['badge_icon'] ); ?></span>
							<span><?php echo esc_html( $s['badge_text'] ); ?></span>
						</a>
					<?php endif; ?>
 
					<h1>
						<?php echo nl2br( esc_html( $s['heading_before'] ) ); ?>
						<?php if ( ! empty( $words ) ) : ?>
							<span class="rot">
								<span class="rot__list">
									<?php foreach ( $words as $w ) : ?>
										<span><?php echo esc_html( $w['word'] ); ?></span>
									<?php endforeach; ?>
								</span>
							</span>
						<?php endif; ?>
					</h1>
 
					<?php if ( ! empty( $s['description'] ) ) : ?>
						<p class="lead"><?php echo esc_html( $s['description'] ); ?></p>
					<?php endif; ?>
 
					<div class="vira-hero__cta">
						<?php if ( ! empty( $s['btn_primary_text'] ) ) : ?>
							<a href="<?php echo esc_url( $btn1_url ); ?>" class="vira-hero__btn vira-hero__btn--primary">
								<span><?php echo esc_html( $s['btn_primary_text'] ); ?></span>
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="18" height="18"><path d="M19 12H5M12 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/></svg>
							</a>
						<?php endif; ?>
						<?php if ( ! empty( $s['btn_secondary_text'] ) ) : ?>
							<a href="<?php echo esc_url( $btn2_url ); ?>" class="vira-hero__btn vira-hero__btn--ghost">
								<span><?php echo esc_html( $s['btn_secondary_text'] ); ?></span>
							</a>
						<?php endif; ?>
					</div>
 
					<?php if ( ! empty( $stats ) ) : ?>
						<div class="vira-hero__stats">
							<?php foreach ( $stats as $stat ) : ?>
								<div class="vira-hero__stat">
									<div class="num" data-counter="<?php echo (int) $stat['value']; ?>" data-suffix="<?php echo esc_attr( $stat['suffix'] ); ?>">
										<em>۰</em>
									</div>
									<div class="lbl"><?php echo esc_html( $stat['label'] ); ?></div>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
 
				<?php if ( 'none' !== $s['visual_type'] ) : ?>
					<div class="vira-hero__visual">
						<div class="vira-hero__visual-stage" data-vira-tilt>
							<?php if ( 'image' === $s['visual_type'] && ! empty( $s['visual_image']['url'] ) ) : ?>
								<img src="<?php echo esc_url( $s['visual_image']['url'] ); ?>" alt="" />
							<?php else : ?>
								<div class="vira-hero__mockup">
									<div class="vira-hero__mockup-bar"><i></i><i></i><i></i></div>
									<div class="vira-hero__mockup-content">
										<div class="vira-hero__mockup-grad"></div>
										<div class="vira-hero__mockup-row"></div>
										<div class="vira-hero__mockup-row sm"></div>
										<?php if ( ! empty( $s['visual_caption'] ) ) : ?>
											<div class="vira-hero__mockup-caption">✦ <?php echo esc_html( $s['visual_caption'] ); ?> ✦</div>
										<?php endif; ?>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
 
			<?php if ( 'yes' === $s['show_marquee'] && ! empty( $mq ) ) : ?>
				<div class="vira-hero__marquee">
					<div class="vira-hero__marquee-track">
						<?php for ( $i = 0; $i < 2; $i++ ) : ?>
							<?php foreach ( $mq as $item ) : ?>
								<span><?php echo esc_html( $item['item'] ); ?></span>
							<?php endforeach; ?>
						<?php endfor; ?>
					</div>
				</div>
			<?php endif; ?>
		</section>
 
		<script>
		(function(){
			var hero = document.getElementById('<?php echo esc_js( $unique_id ); ?>');
			if (!hero) return;
 
			hero.addEventListener('pointermove', function(e){
				var r = hero.getBoundingClientRect();
				hero.style.setProperty('--mx', (e.clientX - r.left) + 'px');
				hero.style.setProperty('--my', (e.clientY - r.top) + 'px');
			});
 
			var stage = hero.querySelector('[data-vira-tilt]');
			if (stage) {
				stage.addEventListener('pointermove', function(e){
					var r = stage.getBoundingClientRect();
					var px = (e.clientX - r.left) / r.width - .5;
					var py = (e.clientY - r.top) / r.height - .5;
					stage.style.transform = 'rotateY(' + (px * -8) + 'deg) rotateX(' + (py * 6) + 'deg)';
				});
				stage.addEventListener('pointerleave', function(){
					stage.style.transform = 'rotateX(0) rotateY(0)';
				});
			}
 
			function toFa(n){ return String(n).replace(/\d/g, function(d){ return '۰۱۲۳۴۵۶۷۸۹'[d]; }); }
 
			var counters = hero.querySelectorAll('[data-counter]');
			function animate(el){
				var target = parseInt(el.getAttribute('data-counter'), 10);
				var suffix = el.getAttribute('data-suffix') || '';
				var dur = 1800;
				var start = performance.now();
				function step(now){
					var t = Math.min(1, (now - start) / dur);
					var eased = 1 - Math.pow(1 - t, 3);
					var val = Math.floor(eased * target);
					el.innerHTML = '<em>' + toFa(val) + '</em>' + suffix;
					if (t < 1) requestAnimationFrame(step);
				}
				requestAnimationFrame(step);
			}
			if ('IntersectionObserver' in window) {
				var io = new IntersectionObserver(function(entries){
					entries.forEach(function(e){ if(e.isIntersecting){ animate(e.target); io.unobserve(e.target); } });
				}, { threshold: .5 });
				counters.forEach(function(c){ io.observe(c); });
			} else {
				counters.forEach(animate);
			}
		})();
		</script>
		<?php
	}
}
 
