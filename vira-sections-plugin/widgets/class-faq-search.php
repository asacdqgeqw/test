<?php
/**
 * Vira Sections — FAQ with Search & Category Filter
 *
 * Accordion-style FAQ with a live text search, category filter pills,
 * and an empty-state message. Items are tagged via space-separated
 * category slugs.
 *
 * @package ViraSections
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Vira_Sections_Widget_Faq_Search
 */
class Vira_Sections_Widget_Faq_Search extends \Elementor\Widget_Base {

	use Vira_Sections_Preset_Trait;

	public function get_name() {
		return 'vira_faq_search';
	}

	public function get_title() {
		return __( 'FAQ Search (Vira)', 'vira-sections' );
	}

	public function get_icon() {
		return 'eicon-help-o';
	}

	public function get_categories() {
		return array( 'vira-sections' );
	}

	public function get_keywords() {
		return array( 'vira', 'faq', 'questions', 'accordion', 'search', 'filter' );
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
				'label'   => __( 'Eyebrow', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'سوالات متداول', 'vira-sections' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'پاسخ <em>سوالات شما</em>', 'vira-sections' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'search_placeholder',
			array(
				'label'   => __( 'Search Placeholder', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'جستجو در سوالات...', 'vira-sections' ),
			)
		);

		$this->add_control(
			'all_label',
			array(
				'label'   => __( '"All" Filter Label', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'همه', 'vira-sections' ),
			)
		);

		$this->add_control(
			'empty_text',
			array(
				'label'   => __( 'Empty State Message', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'سوالی با این عبارت پیدا نشد. لطفاً عبارت دیگری جستجو کنید.', 'vira-sections' ),
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * Categories Repeater
		 * ============================================================ */
		$this->start_controls_section(
			'section_categories',
			array(
				'label' => __( 'Categories', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$cat_rep = new \Elementor\Repeater();
		$cat_rep->add_control(
			'cat_slug',
			array(
				'label'       => __( 'Category Slug (no spaces)', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'tech',
				'description' => __( 'Used to match against FAQ items. Must be a single word (no spaces).', 'vira-sections' ),
			)
		);
		$cat_rep->add_control(
			'cat_label',
			array(
				'label'   => __( 'Category Label', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'دسته‌بندی', 'vira-sections' ),
			)
		);

		$this->add_control(
			'categories',
			array(
				'label'       => __( 'Categories', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $cat_rep->get_controls(),
				'title_field' => '{{{ cat_label }}}',
				'default'     => array(
					array( 'cat_slug' => 'tech', 'cat_label' => __( 'فنی', 'vira-sections' ) ),
					array( 'cat_slug' => 'time', 'cat_label' => __( 'زمان‌بندی', 'vira-sections' ) ),
					array( 'cat_slug' => 'price', 'cat_label' => __( 'قیمت', 'vira-sections' ) ),
					array( 'cat_slug' => 'support', 'cat_label' => __( 'پشتیبانی', 'vira-sections' ) ),
				),
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * FAQ Items Repeater
		 * ============================================================ */
		$this->start_controls_section(
			'section_items',
			array(
				'label' => __( 'FAQ Items', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$rep = new \Elementor\Repeater();
		$rep->add_control(
			'question',
			array(
				'label'       => __( 'Question', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'سوال؟', 'vira-sections' ),
				'label_block' => true,
			)
		);
		$rep->add_control(
			'answer',
			array(
				'label'   => __( 'Answer', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'پاسخ کامل سوال در اینجا قرار می‌گیرد.', 'vira-sections' ),
				'rows'    => 5,
			)
		);
		$rep->add_control(
			'item_categories',
			array(
				'label'       => __( 'Categories (space-separated slugs)', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'tech',
				'description' => __( 'Match the slugs you defined in Categories. Example: "tech support".', 'vira-sections' ),
			)
		);

		$this->add_control(
			'items',
			array(
				'label'       => __( 'Items', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $rep->get_controls(),
				'title_field' => '{{{ question }}}',
				'default'     => array(
					array(
						'question'        => __( 'مدت زمان انجام پروژه چقدر است؟', 'vira-sections' ),
						'answer'          => __( 'زمان انجام پروژه بسته به پیچیدگی متفاوت است. پروژه پایه ۴ تا ۶ هفته، پروژه حرفه‌ای ۸ تا ۱۲ هفته و پروژه‌های سازمانی ۳ تا ۶ ماه زمان می‌برند.', 'vira-sections' ),
						'item_categories' => 'time',
					),
					array(
						'question'        => __( 'آیا کد منبع به من تحویل داده می‌شود؟', 'vira-sections' ),
						'answer'          => __( 'بله، در پایان پروژه و پس از تسویه نهایی، تمام کد منبع به همراه مستندات فنی کامل به شما تحویل داده می‌شود.', 'vira-sections' ),
						'item_categories' => 'tech',
					),
					array(
						'question'        => __( 'تفاوت Native و Cross-Platform چیست؟', 'vira-sections' ),
						'answer'          => __( 'Native بالاترین Performance را دارد ولی برای هر پلتفرم باید جداگانه کدنویسی شود. Cross-Platform مثل Flutter، با یک کدبیس واحد، اپ هر دو پلتفرم را تولید می‌کند.', 'vira-sections' ),
						'item_categories' => 'tech',
					),
					array(
						'question'        => __( 'آپدیت‌های پروژه چگونه انجام می‌شود؟', 'vira-sections' ),
						'answer'          => __( 'آپدیت‌های امنیتی و رفع باگ در دوره پشتیبانی رایگان، کاملاً رایگان انجام می‌شود. آپدیت‌های قابلیت‌های جدید بعد از توافق روی هزینه، توسط تیم ما توسعه و منتشر می‌شود.', 'vira-sections' ),
						'item_categories' => 'support',
					),
					array(
						'question'        => __( 'هزینه پشتیبانی پس از تحویل چقدر است؟', 'vira-sections' ),
						'answer'          => __( 'پشتیبانی فنی رایگان در پکیج پایه ۳ ماه و در پکیج حرفه‌ای ۶ ماه است. پس از این دوره، قراردادهای پشتیبانی سالیانه از ۱۸٪ ارزش پروژه شروع می‌شود.', 'vira-sections' ),
						'item_categories' => 'price support',
					),
					array(
						'question'        => __( 'آیا پروژه من امن است؟', 'vira-sections' ),
						'answer'          => __( 'امنیت در تمام پروژه‌های ما در اولویت است. ما از SSL/HTTPS، رمزنگاری دیتاهای حساس، احراز هویت دو مرحله‌ای و رعایت OWASP Top 10 استفاده می‌کنیم.', 'vira-sections' ),
						'item_categories' => 'tech',
					),
					array(
						'question'        => __( 'نسخه دمو قبل از تحویل ارائه می‌شود؟', 'vira-sections' ),
						'answer'          => __( 'بله، ما با متد توسعه چابک کار می‌کنیم و در پایان هر Sprint نسخه قابل تست در اختیار شما قرار می‌گیرد تا بازخورد بدهید.', 'vira-sections' ),
						'item_categories' => 'support',
					),
					array(
						'question'        => __( 'امکان ارتقای پروژه در آینده هست؟', 'vira-sections' ),
						'answer'          => __( 'قطعاً. تمام پروژه‌های ما با معماری ماژولار طراحی می‌شوند که اضافه کردن قابلیت‌های جدید را آسان می‌کند.', 'vira-sections' ),
						'item_categories' => 'tech',
					),
					array(
						'question'        => __( 'گارانتی کیفیت چه مدت است؟', 'vira-sections' ),
						'answer'          => __( 'تمام پروژه‌ها دارای گارانتی کیفیت در دوره پشتیبانی هستند. هر باگ نرم‌افزاری در این دوره به صورت رایگان رفع می‌شود.', 'vira-sections' ),
						'item_categories' => 'support price',
					),
					array(
						'question'        => __( 'پرداخت چگونه انجام می‌شود؟', 'vira-sections' ),
						'answer'          => __( 'پرداخت معمولاً در ۳ مرحله انجام می‌شود: ۳۰٪ پیش‌پرداخت در شروع، ۴۰٪ در میانه پروژه و ۳۰٪ در تحویل نهایی.', 'vira-sections' ),
						'item_categories' => 'price',
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
				'label'      => __( 'Padding (Vertical)', 'vira-sections' ),
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
			'accent_color',
			array(
				'label'   => __( 'Accent Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#0170B9',
			)
		);

		$this->add_control(
			'card_bg',
			array(
				'label'   => __( 'Card Background', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#F8FAFC',
			)
		);

		$this->add_control(
			'cat_grad_from',
			array(
				'label'   => __( 'Active Category Gradient 1', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#0170B9',
			)
		);

		$this->add_control(
			'cat_grad_to',
			array(
				'label'   => __( 'Active Category Gradient 2', 'vira-sections' ),
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
		$unique_id = 'vira-faq-' . $this->get_id();

		$pad     = ! empty( $settings['section_padding']['size'] ) ? (int) $settings['section_padding']['size'] : 110;
		$bg      = ! empty( $settings['section_bg'] ) ? $settings['section_bg'] : '#FFFFFF';
		$accent  = ! empty( $settings['accent_color'] ) ? $settings['accent_color'] : '#0170B9';
		$card_bg = ! empty( $settings['card_bg'] ) ? $settings['card_bg'] : '#F8FAFC';
		$g_from  = ! empty( $settings['cat_grad_from'] ) ? $settings['cat_grad_from'] : '#0170B9';
		$g_to    = ! empty( $settings['cat_grad_to'] ) ? $settings['cat_grad_to'] : '#128BE0';

		$cats  = ! empty( $settings['categories'] ) && is_array( $settings['categories'] ) ? $settings['categories'] : array();
		$items = ! empty( $settings['items'] ) && is_array( $settings['items'] ) ? $settings['items'] : array();
		?>
		<style>
			#<?php echo esc_attr( $unique_id ); ?>{
				--vira-pad: <?php echo (int) $pad; ?>px;
				--vira-bg: <?php echo esc_attr( $bg ); ?>;
				--vira-accent: <?php echo esc_attr( $accent ); ?>;
				--vira-card: <?php echo esc_attr( $card_bg ); ?>;
				--vira-grad-from: <?php echo esc_attr( $g_from ); ?>;
				--vira-grad-to: <?php echo esc_attr( $g_to ); ?>;
			}
			#<?php echo esc_attr( $unique_id ); ?>.vira-faq{
				padding:var(--vira-pad) 24px;background:var(--vira-bg);
				font-family:'Vazirmatn','IRANSans',Tahoma,sans-serif;direction:rtl;color:#1D2327;
				position:relative;overflow:hidden;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__inner{max-width:860px;margin:0 auto;position:relative;z-index:1;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__head{text-align:center;margin-bottom:48px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__eyebrow{
				display:inline-flex;align-items:center;gap:8px;
				background:rgba(1,112,185,.10);color:var(--vira-accent);
				border:1px solid rgba(1,112,185,.25);
				padding:8px 16px;border-radius:999px;font-size:14px;font-weight:600;margin-bottom:16px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__eyebrow i{
				width:8px;height:8px;border-radius:50%;background:var(--vira-accent);
				box-shadow:0 0 0 4px rgba(1,112,185,.16);display:inline-block;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq h2{font-size:clamp(28px,3.4vw,46px);font-weight:800;margin:0 0 16px;line-height:1.4;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq h2 em{
				font-style:normal;
				background:linear-gradient(135deg,var(--vira-grad-from),var(--vira-grad-to));
				-webkit-background-clip:text;background-clip:text;color:transparent;-webkit-text-fill-color:transparent;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__search{position:relative;margin-bottom:24px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__search input{
				width:100%;padding:16px 20px 16px 48px;
				border:1.5px solid #E2E8F0;border-radius:16px;
				font-family:inherit;font-size:16px;color:#1D2327;
				background:#F8FAFC;transition:all .3s ease;outline:none;box-sizing:border-box;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__search input:focus{
				border-color:var(--vira-accent);background:#fff;
				box-shadow:0 4px 16px rgba(1,112,185,.16);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__search input::placeholder{color:#94A3B8;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__search svg{
				position:absolute;left:16px;top:50%;transform:translateY(-50%);
				color:#94A3B8;pointer-events:none;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__cats{
				display:flex;gap:8px;flex-wrap:wrap;margin-bottom:32px;justify-content:center;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__cat{
				padding:8px 16px;border-radius:10px;border:1.5px solid #E2E8F0;
				background:transparent;cursor:pointer;font-family:inherit;
				font-size:14px;font-weight:600;color:#64748B;transition:all .3s ease;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__cat:hover{border-color:var(--vira-accent);color:var(--vira-accent);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__cat.is-active{
				background:linear-gradient(135deg,var(--vira-grad-from),var(--vira-grad-to));
				color:#fff;border-color:transparent;
				box-shadow:0 4px 14px rgba(1,112,185,.30);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__list{display:grid;gap:12px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__item{
				background:var(--vira-card);border:1px solid #E2E8F0;border-radius:16px;
				overflow:hidden;transition:all .3s ease;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__item:hover{border-color:rgba(1,112,185,.30);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__item.is-open{
				border-color:var(--vira-accent);background:#fff;
				box-shadow:0 10px 28px rgba(1,112,185,.10);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__q{
				display:flex;align-items:center;gap:14px;padding:20px 24px;
				cursor:pointer;width:100%;border:none;background:transparent;
				font-family:inherit;font-size:16px;font-weight:700;color:#1D2327;text-align:right;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__q span.txt{flex:1;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__q .icon{
				width:32px;height:32px;border-radius:8px;
				background:rgba(1,112,185,.10);color:var(--vira-accent);
				display:grid;place-items:center;flex-shrink:0;
				transition:transform .3s cubic-bezier(.4,0,.2,1);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__item.is-open .vira-faq__q .icon{transform:rotate(45deg);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__a{
				max-height:0;overflow:hidden;
				transition:max-height .45s cubic-bezier(.4,0,.2,1),padding .3s ease;padding:0 24px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__item.is-open .vira-faq__a{max-height:480px;padding:0 24px 22px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__a p{margin:0;font-size:15px;line-height:2;color:#475569;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__empty{text-align:center;padding:48px 24px;display:none;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__empty.is-visible{display:block;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__empty svg{color:#CBD5E1;margin-bottom:16px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__empty p{color:#94A3B8;font-size:16px;margin:0;}
			@media(max-width:560px){
				#<?php echo esc_attr( $unique_id ); ?> .vira-faq__q{padding:16px 18px;font-size:14.5px;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-faq__cat{padding:7px 12px;font-size:13px;}
			}
			/* Smooth accordion height animation using grid-template-rows */
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__a{
				display:grid;grid-template-rows:0fr;
				transition:grid-template-rows .45s cubic-bezier(.4,0,.2,1),padding .3s ease;
				max-height:none;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__a-inner{overflow:hidden;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__item.is-open .vira-faq__a{
				grid-template-rows:1fr;padding:0 24px 22px;
			}
			/* Search highlight flash animation */
			@keyframes vira-faq-highlight{
				0%{background-color:rgba(1,112,185,.15);}
				100%{background-color:transparent;}
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__item.vira-highlight{
				animation:vira-faq-highlight .8s ease-out;
			}
			/* Input focus glow effect */
			@keyframes vira-faq-input-glow{
				0%{box-shadow:0 0 0 4px rgba(1,112,185,.10),0 4px 16px rgba(1,112,185,.10);}
				50%{box-shadow:0 0 0 6px rgba(1,112,185,.18),0 4px 20px rgba(1,112,185,.20);}
				100%{box-shadow:0 0 0 4px rgba(1,112,185,.10),0 4px 16px rgba(1,112,185,.10);}
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__search input:focus{
				animation:vira-faq-input-glow 2s ease-in-out infinite;
			}
			/* Entrance animation for FAQ items */
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__item.vira-entrance{
				opacity:0;transform:translateY(20px);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-faq__item.vira-entrance-in{
				opacity:1;transform:translateY(0);
				transition:opacity .5s cubic-bezier(.4,0,.2,1),transform .5s cubic-bezier(.4,0,.2,1);
			}
			/* Reduced motion support */
			@media(prefers-reduced-motion: reduce){
				#<?php echo esc_attr( $unique_id ); ?> .vira-faq__a{transition:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-faq__item{transition:none !important;animation:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-faq__item.vira-entrance{opacity:1;transform:none;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-faq__item.vira-entrance-in{transition:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-faq__search input:focus{animation:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-faq__q .icon{transition:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-faq__cat{transition:none !important;}
			}
		</style>

		<section id="<?php echo esc_attr( $unique_id ); ?>" class="vira-faq" data-vira-faq>
			<div class="vira-faq__inner">
				<div class="vira-faq__head">
					<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
						<span class="vira-faq__eyebrow"><i></i><?php echo esc_html( $settings['eyebrow'] ); ?></span>
					<?php endif; ?>
					<?php if ( ! empty( $settings['heading'] ) ) : ?>
						<h2><?php echo wp_kses_post( $settings['heading'] ); ?></h2>
					<?php endif; ?>
				</div>

				<div class="vira-faq__search">
					<input type="text" placeholder="<?php echo esc_attr( $settings['search_placeholder'] ); ?>" data-faq-search />
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.3-4.3" stroke-linecap="round"/></svg>
				</div>

				<div class="vira-faq__cats">
					<button type="button" class="vira-faq__cat is-active" data-cat="all"><?php echo esc_html( $settings['all_label'] ); ?></button>
					<?php foreach ( $cats as $cat ) : ?>
						<button type="button" class="vira-faq__cat" data-cat="<?php echo esc_attr( $cat['cat_slug'] ); ?>"><?php echo esc_html( $cat['cat_label'] ); ?></button>
					<?php endforeach; ?>
				</div>

				<div class="vira-faq__list">
					<?php foreach ( $items as $item ) :
						$item_cats = ! empty( $item['item_categories'] ) ? trim( $item['item_categories'] ) : '';
						?>
						<div class="vira-faq__item" data-category="<?php echo esc_attr( $item_cats ); ?>">
							<button class="vira-faq__q" type="button">
								<span class="txt"><?php echo esc_html( $item['question'] ); ?></span>
								<span class="icon">
									<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M12 5v14M5 12h14" stroke-linecap="round"/></svg>
								</span>
							</button>
							<div class="vira-faq__a">
								<div class="vira-faq__a-inner">
								<p><?php echo esc_html( $item['answer'] ); ?></p>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="vira-faq__empty">
					<svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.3-4.3" stroke-linecap="round"/><path d="M8 11h6" stroke-linecap="round"/></svg>
					<p><?php echo esc_html( $settings['empty_text'] ); ?></p>
				</div>
			</div>
		</section>

		<script>
		(function(){
			var section = document.getElementById('<?php echo esc_js( $unique_id ); ?>');
			if (!section) return;
			var items = section.querySelectorAll('.vira-faq__item');
			var cats = section.querySelectorAll('.vira-faq__cat');
			var searchInput = section.querySelector('[data-faq-search]');
			var emptyState = section.querySelector('.vira-faq__empty');
			var activeCategory = 'all';

			items.forEach(function(item){
				var btn = item.querySelector('.vira-faq__q');
				if (!btn) return;
				btn.addEventListener('click', function(){
					var wasOpen = item.classList.contains('is-open');
					items.forEach(function(i){ i.classList.remove('is-open'); });
					if (!wasOpen) item.classList.add('is-open');
				});
			});

			cats.forEach(function(cat){
				cat.addEventListener('click', function(){
					cats.forEach(function(c){ c.classList.remove('is-active'); });
					cat.classList.add('is-active');
					activeCategory = cat.getAttribute('data-cat');
					filterItems();
				});
			});

			if (searchInput) searchInput.addEventListener('input', filterItems);

			function filterItems(){
				var query = (searchInput && searchInput.value || '').trim().toLowerCase();
				var visible = 0;
				items.forEach(function(item){
					var qEl = item.querySelector('.vira-faq__q .txt');
					var aEl = item.querySelector('.vira-faq__a p');
					var text = qEl ? qEl.textContent.toLowerCase() : '';
					var answer = aEl ? aEl.textContent.toLowerCase() : '';
					var itemCats = (item.getAttribute('data-category') || '').split(/\s+/);
					var catMatch = (activeCategory === 'all') || (itemCats.indexOf(activeCategory) !== -1);
					var searchMatch = !query || text.indexOf(query) !== -1 || answer.indexOf(query) !== -1;
					var show = catMatch && searchMatch;
					item.style.display = show ? '' : 'none';
					if (show) visible++;
					/* Highlight flash on search match */
					if (show && query) {
						item.classList.remove('vira-highlight');
						void item.offsetWidth;
						item.classList.add('vira-highlight');
					} else {
						item.classList.remove('vira-highlight');
					}
				});
				if (emptyState) emptyState.classList.toggle('is-visible', visible === 0);
			}

			/* IntersectionObserver staggered entrance animation */
			var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
			if (!reducedMotion && 'IntersectionObserver' in window) {
				items.forEach(function(item){ item.classList.add('vira-entrance'); });
				var observer = new IntersectionObserver(function(entries){
					entries.forEach(function(entry){
						if (entry.isIntersecting) {
							var list = entry.target.querySelectorAll('.vira-faq__item.vira-entrance');
							list.forEach(function(item, i){
								setTimeout(function(){
									item.classList.remove('vira-entrance');
									item.classList.add('vira-entrance-in');
								}, i * 80);
							});
							observer.disconnect();
						}
					});
				}, { threshold: 0.1 });
				observer.observe(section.querySelector('.vira-faq__list'));
			}
		})();
		</script>
		<?php
	}
}
