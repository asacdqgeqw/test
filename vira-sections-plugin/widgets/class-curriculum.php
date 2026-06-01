<?php
/**
 * Vira Sections — Curriculum Modules Widget
 *
 * Accordion of modules. Each module has a numbered amber badge, a title,
 * subtitle, and an expandable panel with chips (sessions, hours, level)
 * and a checkmark-list of topics.
 *
 * @package ViraSections
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Vira_Sections_Widget_Curriculum
 */
class Vira_Sections_Widget_Curriculum extends \Elementor\Widget_Base {

	use Vira_Sections_Preset_Trait;

	public function get_name() {
		return 'vira_curriculum';
	}

	public function get_title() {
		return __( 'Curriculum Modules (Vira)', 'vira-sections' );
	}

	public function get_icon() {
		return 'eicon-bullet-list';
	}

	public function get_categories() {
		return array( 'vira-sections' );
	}

	public function get_keywords() {
		return array( 'vira', 'curriculum', 'course', 'modules', 'syllabus', 'training', 'accordion' );
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
				'default' => __( 'سرفصل آموزش', 'vira-sections' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'چه چیزی <em>یاد خواهی گرفت؟</em>', 'vira-sections' ),
				'label_block' => true,
				'description' => __( 'Wrap highlighted words in &lt;em&gt;...&lt;/em&gt; for accent color.', 'vira-sections' ),
			)
		);

		$this->register_tag_control( 'heading_tag', __( 'Heading HTML Tag (SEO)', 'vira-sections' ), 'h2' );
		$this->register_tag_control( 'module_title_tag', __( 'Module Title HTML Tag (SEO)', 'vira-sections' ), 'h3' );

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'یک مسیر گام‌به‌گام از مبانی تا حرفه‌ای — طراحی‌شده توسط متخصصان فعال در پروژه‌های واقعی سئو.', 'vira-sections' ),
				'rows'    => 3,
			)
		);

		$this->add_control(
			'show_totals',
			array(
				'label'        => __( 'Show Totals Pill', 'vira-sections' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'totals_modules',
			array(
				'label'     => __( 'Total Modules Text', 'vira-sections' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => __( '۸ ماژول', 'vira-sections' ),
				'condition' => array( 'show_totals' => 'yes' ),
			)
		);

		$this->add_control(
			'totals_hours',
			array(
				'label'     => __( 'Total Hours Text', 'vira-sections' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => __( '۴۰+ ساعت آموزش', 'vira-sections' ),
				'condition' => array( 'show_totals' => 'yes' ),
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * Modules Repeater
		 * ============================================================ */
		$this->start_controls_section(
			'section_modules',
			array(
				'label' => __( 'Modules', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$module_rep = new \Elementor\Repeater();

		$module_rep->add_control(
			'module_number',
			array(
				'label'   => __( 'Module Number', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( '۱', 'vira-sections' ),
			)
		);

		$module_rep->add_control(
			'module_title',
			array(
				'label'   => __( 'Module Title', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'عنوان ماژول', 'vira-sections' ),
			)
		);

		$module_rep->add_control(
			'module_subtitle',
			array(
				'label'   => __( 'Module Subtitle', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'توضیح کوتاه', 'vira-sections' ),
			)
		);

		$module_rep->add_control(
			'sessions_count',
			array(
				'label'   => __( 'Sessions Count', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( '۴ جلسه', 'vira-sections' ),
			)
		);

		$module_rep->add_control(
			'duration',
			array(
				'label'   => __( 'Duration', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( '۶ ساعت', 'vira-sections' ),
			)
		);

		$module_rep->add_control(
			'level',
			array(
				'label'   => __( 'Level', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'سطح: مقدماتی', 'vira-sections' ),
			)
		);

		$module_rep->add_control(
			'is_open',
			array(
				'label'        => __( 'Open by Default', 'vira-sections' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'default'      => '',
				'return_value' => 'yes',
			)
		);

		$topic_sub = new \Elementor\Repeater();
		$topic_sub->add_control(
			'topic_text',
			array(
				'label'   => __( 'Topic', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'یک سرفصل', 'vira-sections' ),
			)
		);

		$module_rep->add_control(
			'topics',
			array(
				'label'       => __( 'Topics', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $topic_sub->get_controls(),
				'title_field' => '{{{ topic_text }}}',
				'default'     => array(
					array( 'topic_text' => __( 'سرفصل اول', 'vira-sections' ) ),
					array( 'topic_text' => __( 'سرفصل دوم', 'vira-sections' ) ),
					array( 'topic_text' => __( 'سرفصل سوم', 'vira-sections' ) ),
				),
			)
		);

		$this->add_control(
			'modules',
			array(
				'label'       => __( 'Modules', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $module_rep->get_controls(),
				'title_field' => '{{{ module_title }}}',
				'default'     => array(
					array(
						'module_number'   => __( '۱', 'vira-sections' ),
						'module_title'    => __( 'مبانی سئو و الگوریتم‌های گوگل', 'vira-sections' ),
						'module_subtitle' => __( 'پایه‌گذاری دانش سئو از صفر', 'vira-sections' ),
						'sessions_count'  => __( '۴ جلسه', 'vira-sections' ),
						'duration'        => __( '۶ ساعت', 'vira-sections' ),
						'level'           => __( 'سطح: مقدماتی', 'vira-sections' ),
						'is_open'         => 'yes',
						'topics'          => array(
							array( 'topic_text' => __( 'مفاهیم پایه و تاریخچه سئو', 'vira-sections' ) ),
							array( 'topic_text' => __( 'نحوه کار موتورهای جستجو (Crawl, Index, Rank)', 'vira-sections' ) ),
							array( 'topic_text' => __( 'الگوریتم‌های مهم گوگل (Panda, Penguin, BERT, Helpful Content)', 'vira-sections' ) ),
							array( 'topic_text' => __( 'E-E-A-T و فاکتورهای کیفیت محتوا', 'vira-sections' ) ),
							array( 'topic_text' => __( 'تفاوت White-Hat و Black-Hat SEO', 'vira-sections' ) ),
							array( 'topic_text' => __( 'نقشه راه شخصی برای ورود به سئو', 'vira-sections' ) ),
						),
					),
					array(
						'module_number'   => __( '۲', 'vira-sections' ),
						'module_title'    => __( 'تحقیق کلمات کلیدی حرفه‌ای', 'vira-sections' ),
						'module_subtitle' => __( 'پیدا کردن کلمات طلایی برای رتبه گرفتن', 'vira-sections' ),
						'sessions_count'  => __( '۵ جلسه', 'vira-sections' ),
						'duration'        => __( '۷ ساعت', 'vira-sections' ),
						'level'           => __( 'سطح: متوسط', 'vira-sections' ),
						'topics'          => array(
							array( 'topic_text' => __( 'مفاهیم Search Volume، KD و Search Intent', 'vira-sections' ) ),
							array( 'topic_text' => __( 'کار با Ahrefs و Semrush در تحقیق کلمات', 'vira-sections' ) ),
							array( 'topic_text' => __( 'کلمات Long-tail و Question-based', 'vira-sections' ) ),
							array( 'topic_text' => __( 'Topic Cluster و Keyword Mapping', 'vira-sections' ) ),
							array( 'topic_text' => __( 'تحلیل کلمات کلیدی رقبا', 'vira-sections' ) ),
							array( 'topic_text' => __( 'پروژه عملی: ساخت Keyword Plan کامل', 'vira-sections' ) ),
						),
					),
					array(
						'module_number'   => __( '۳', 'vira-sections' ),
						'module_title'    => __( 'سئو فنی و Core Web Vitals', 'vira-sections' ),
						'module_subtitle' => __( 'زیرساخت قدرتمند برای رتبه‌گیری', 'vira-sections' ),
						'sessions_count'  => __( '۶ جلسه', 'vira-sections' ),
						'duration'        => __( '۸ ساعت', 'vira-sections' ),
						'level'           => __( 'سطح: پیشرفته', 'vira-sections' ),
						'topics'          => array(
							array( 'topic_text' => __( 'Crawlability و Indexability سایت', 'vira-sections' ) ),
							array( 'topic_text' => __( 'Core Web Vitals (LCP, INP, CLS)', 'vira-sections' ) ),
							array( 'topic_text' => __( 'Schema Markup و Structured Data', 'vira-sections' ) ),
							array( 'topic_text' => __( 'robots.txt، sitemap.xml و canonical', 'vira-sections' ) ),
							array( 'topic_text' => __( 'HTTPS، Mobile-First و JavaScript SEO', 'vira-sections' ) ),
							array( 'topic_text' => __( 'پروژه عملی: آدیت فنی یک سایت واقعی', 'vira-sections' ) ),
						),
					),
					array(
						'module_number'   => __( '۴', 'vira-sections' ),
						'module_title'    => __( 'سئو محتوا و Content Strategy', 'vira-sections' ),
						'module_subtitle' => __( 'محتوایی که گوگل و کاربر هر دو دوست دارند', 'vira-sections' ),
						'sessions_count'  => __( '۵ جلسه', 'vira-sections' ),
						'duration'        => __( '۷ ساعت', 'vira-sections' ),
						'level'           => __( 'سطح: متوسط', 'vira-sections' ),
						'topics'          => array(
							array( 'topic_text' => __( 'اصول نوشتن محتوای SEO-Friendly', 'vira-sections' ) ),
							array( 'topic_text' => __( 'ساختار هدینگ‌ها و Featured Snippets', 'vira-sections' ) ),
							array( 'topic_text' => __( 'Search Intent و انواع آن', 'vira-sections' ) ),
							array( 'topic_text' => __( 'Pillar Pages و Topic Clusters', 'vira-sections' ) ),
							array( 'topic_text' => __( 'بازنشر و بروزرسانی محتوای قدیمی', 'vira-sections' ) ),
							array( 'topic_text' => __( 'تقویم محتوایی ۶ ماهه برای کسب‌وکار', 'vira-sections' ) ),
						),
					),
					array(
						'module_number'   => __( '۵', 'vira-sections' ),
						'module_title'    => __( 'لینک‌سازی White-Hat', 'vira-sections' ),
						'module_subtitle' => __( 'بک‌لینک‌های واقعی و پایدار', 'vira-sections' ),
						'sessions_count'  => __( '۴ جلسه', 'vira-sections' ),
						'duration'        => __( '۶ ساعت', 'vira-sections' ),
						'level'           => __( 'سطح: پیشرفته', 'vira-sections' ),
						'topics'          => array(
							array( 'topic_text' => __( 'اصول و فاکتورهای کیفیت بک‌لینک', 'vira-sections' ) ),
							array( 'topic_text' => __( 'Guest Posting و Digital PR', 'vira-sections' ) ),
							array( 'topic_text' => __( 'Broken Link Building و Skyscraper', 'vira-sections' ) ),
							array( 'topic_text' => __( 'تحلیل پروفایل لینک رقبا', 'vira-sections' ) ),
							array( 'topic_text' => __( 'Disavow و حذف لینک‌های مضر', 'vira-sections' ) ),
							array( 'topic_text' => __( 'پروژه عملی: کمپین لینک‌سازی واقعی', 'vira-sections' ) ),
						),
					),
					array(
						'module_number'   => __( '۶', 'vira-sections' ),
						'module_title'    => __( 'ابزارهای سئو', 'vira-sections' ),
						'module_subtitle' => __( 'Ahrefs · Semrush · Search Console · GA4', 'vira-sections' ),
						'sessions_count'  => __( '۶ جلسه', 'vira-sections' ),
						'duration'        => __( '۸ ساعت', 'vira-sections' ),
						'level'           => __( 'سطح: متوسط تا پیشرفته', 'vira-sections' ),
						'topics'          => array(
							array( 'topic_text' => __( 'کار حرفه‌ای با Ahrefs (Site Explorer, Keywords Explorer)', 'vira-sections' ) ),
							array( 'topic_text' => __( 'Semrush برای تحلیل رقبا و کمپین', 'vira-sections' ) ),
							array( 'topic_text' => __( 'Google Search Console — کاربردی', 'vira-sections' ) ),
							array( 'topic_text' => __( 'Google Analytics 4 و گزارش‌های سئو', 'vira-sections' ) ),
							array( 'topic_text' => __( 'Screaming Frog، PageSpeed Insights', 'vira-sections' ) ),
							array( 'topic_text' => __( 'Looker Studio برای داشبوردهای حرفه‌ای', 'vira-sections' ) ),
						),
					),
					array(
						'module_number'   => __( '۷', 'vira-sections' ),
						'module_title'    => __( 'سئو محلی و Google Business', 'vira-sections' ),
						'module_subtitle' => __( 'دیده شدن در نقشه و جستجوهای محلی تبریز', 'vira-sections' ),
						'sessions_count'  => __( '۳ جلسه', 'vira-sections' ),
						'duration'        => __( '۴ ساعت', 'vira-sections' ),
						'level'           => __( 'سطح: متوسط', 'vira-sections' ),
						'topics'          => array(
							array( 'topic_text' => __( 'راه‌اندازی و بهینه‌سازی Google Business Profile', 'vira-sections' ) ),
							array( 'topic_text' => __( 'بهینه‌سازی برای Map Pack و Local 3-Pack', 'vira-sections' ) ),
							array( 'topic_text' => __( 'NAP Citations و Local Business Schema', 'vira-sections' ) ),
							array( 'topic_text' => __( 'مدیریت ریویوها و واکنش حرفه‌ای', 'vira-sections' ) ),
							array( 'topic_text' => __( 'صفحات Location و سئو چندشهری', 'vira-sections' ) ),
							array( 'topic_text' => __( 'کیس‌استادی کسب‌وکارهای موفق تبریز', 'vira-sections' ) ),
						),
					),
					array(
						'module_number'   => __( '۸', 'vira-sections' ),
						'module_title'    => __( 'گزارش‌گیری و KPIها', 'vira-sections' ),
						'module_subtitle' => __( 'اندازه‌گیری دقیق نتایج سئو', 'vira-sections' ),
						'sessions_count'  => __( '۳ جلسه', 'vira-sections' ),
						'duration'        => __( '۴ ساعت', 'vira-sections' ),
						'level'           => __( 'سطح: متوسط', 'vira-sections' ),
						'topics'          => array(
							array( 'topic_text' => __( 'تعیین KPIهای مهم سئو (Organic Traffic, CTR, Conversions)', 'vira-sections' ) ),
							array( 'topic_text' => __( 'ساخت داشبورد در Looker Studio', 'vira-sections' ) ),
							array( 'topic_text' => __( 'گزارش ماهانه برای کارفرما / مدیر', 'vira-sections' ) ),
							array( 'topic_text' => __( 'محاسبه ROI واقعی سئو', 'vira-sections' ) ),
							array( 'topic_text' => __( 'تحلیل روند رقبا در طول زمان', 'vira-sections' ) ),
							array( 'topic_text' => __( 'پروژه نهایی: ارائه گزارش حرفه‌ای', 'vira-sections' ) ),
						),
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
				'label'      => __( 'Section Padding (Vertical)', 'vira-sections' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => 40, 'max' => 200 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 110 ),
			)
		);

		$this->add_control(
			'bg_grad_from',
			array(
				'label'   => __( 'Background — Top', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#FAF6EC',
			)
		);

		$this->add_control(
			'bg_grad_to',
			array(
				'label'   => __( 'Background — Bottom', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * STYLE — Modules
		 * ============================================================ */
		$this->start_controls_section(
			'style_modules',
			array(
				'label' => __( 'Modules', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'accent_color',
			array(
				'label'   => __( 'Accent Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#F59E0B',
			)
		);

		$this->add_control(
			'module_bg',
			array(
				'label'   => __( 'Module Background', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
			)
		);

		$this->add_control(
			'border_color',
			array(
				'label'   => __( 'Border Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#E2E8F0',
			)
		);

		$this->add_control(
			'badge_grad_from',
			array(
				'label'   => __( 'Number Badge — From', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#F59E0B',
			)
		);

		$this->add_control(
			'badge_grad_to',
			array(
				'label'   => __( 'Number Badge — To', 'vira-sections' ),
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
		$unique_id = 'vira-curriculum-' . $this->get_id();

		$pad        = ! empty( $settings['section_padding']['size'] ) ? (int) $settings['section_padding']['size'] : 110;
		$bg_from    = ! empty( $settings['bg_grad_from'] ) ? $settings['bg_grad_from'] : '#FAF6EC';
		$bg_to      = ! empty( $settings['bg_grad_to'] ) ? $settings['bg_grad_to'] : '#FFFFFF';
		$accent     = ! empty( $settings['accent_color'] ) ? $settings['accent_color'] : '#F59E0B';
		$mod_bg     = ! empty( $settings['module_bg'] ) ? $settings['module_bg'] : '#FFFFFF';
		$border     = ! empty( $settings['border_color'] ) ? $settings['border_color'] : '#E2E8F0';
		$badge_from = ! empty( $settings['badge_grad_from'] ) ? $settings['badge_grad_from'] : '#F59E0B';
		$badge_to   = ! empty( $settings['badge_grad_to'] ) ? $settings['badge_grad_to'] : '#FBBF24';

		$show_totals = ! empty( $settings['show_totals'] ) && 'yes' === $settings['show_totals'];
		$modules     = ! empty( $settings['modules'] ) && is_array( $settings['modules'] ) ? $settings['modules'] : array();
		?>
		<style>
			#<?php echo esc_attr( $unique_id ); ?>{
				--vira-pad: <?php echo (int) $pad; ?>px;
				--vira-bg-from: <?php echo esc_attr( $bg_from ); ?>;
				--vira-bg-to: <?php echo esc_attr( $bg_to ); ?>;
				--vira-accent: <?php echo esc_attr( $accent ); ?>;
				--vira-mod-bg: <?php echo esc_attr( $mod_bg ); ?>;
				--vira-border: <?php echo esc_attr( $border ); ?>;
				--vira-badge-from: <?php echo esc_attr( $badge_from ); ?>;
				--vira-badge-to: <?php echo esc_attr( $badge_to ); ?>;
			}
			#<?php echo esc_attr( $unique_id ); ?>.vira-curriculum{
				padding: var(--vira-pad) 24px;
				background: linear-gradient(180deg, var(--vira-bg-from) 0%, var(--vira-bg-to) 100%);
				font-family:'Vazirmatn','IRANSans',Tahoma,sans-serif;direction:rtl;color:#1D2327;
				position:relative;overflow:hidden;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-curriculum__inner{max-width:1180px;margin:0 auto;position:relative;z-index:1;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-curriculum__head{text-align:center;margin-bottom:48px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-curriculum__eyebrow{
				display:inline-flex;align-items:center;gap:8px;
				background:rgba(245,158,11,.15);color:#B45309;
				border:1px solid rgba(245,158,11,.30);
				padding:8px 16px;border-radius:999px;font-size:14px;font-weight:600;margin-bottom:16px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-curriculum__eyebrow i{
				width:8px;height:8px;border-radius:50%;background:var(--vira-accent);
				box-shadow:0 0 0 4px rgba(245,158,11,.18);display:inline-block;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-curriculum h2, #<?php echo esc_attr( $unique_id ); ?> .vira-curriculum__title{font-size:clamp(28px,3.4vw,46px);font-weight:800;margin:0 0 16px;line-height:1.4;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-curriculum h2 em, #<?php echo esc_attr( $unique_id ); ?> .vira-curriculum__title em{
				font-style:normal;
				background:linear-gradient(135deg,var(--vira-accent),#128BE0);
				-webkit-background-clip:text;background-clip:text;color:transparent;-webkit-text-fill-color:transparent;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-curriculum__head p{color:#64748B;font-size:18px;max-width:680px;margin:0 auto 20px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-curriculum__totals{
				display:inline-flex;align-items:center;gap:10px;
				background:#fff;border:1.5px solid var(--vira-accent);
				padding:10px 20px;border-radius:14px;
				font-size:14.5px;font-weight:700;color:#1D2327;
				box-shadow:0 6px 20px rgba(245,158,11,.12);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-curriculum__totals strong{color:var(--vira-accent);font-weight:900;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-curriculum__totals .sep{color:#CBD5E1;}

			/* Expand All / Collapse All button */
			#<?php echo esc_attr( $unique_id ); ?> .vira-curriculum__actions{
				display:flex;align-items:center;justify-content:center;gap:12px;margin-top:20px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-curriculum__toggle-all{
				display:inline-flex;align-items:center;gap:8px;
				padding:10px 20px;border-radius:12px;border:1.5px solid var(--vira-border);
				background:#fff;cursor:pointer;font-family:inherit;
				font-size:14px;font-weight:700;color:#475569;
				transition:all .3s ease;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-curriculum__toggle-all:hover{
				border-color:var(--vira-accent);color:var(--vira-accent);
				transform:translateY(-1px);box-shadow:0 6px 16px rgba(245,158,11,.12);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-curriculum__toggle-all svg{
				transition:transform .3s ease;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-curriculum__toggle-all.is-expanded svg{
				transform:rotate(180deg);
			}

			/* Progress tracking */
			#<?php echo esc_attr( $unique_id ); ?> .vira-curriculum__progress{
				display:flex;align-items:center;gap:10px;
				padding:10px 18px;border-radius:12px;
				background:rgba(245,158,11,.08);border:1px solid rgba(245,158,11,.20);
				font-size:13px;font-weight:600;color:#B45309;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-curriculum__progress-bar{
				width:80px;height:6px;border-radius:3px;background:#E2E8F0;overflow:hidden;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-curriculum__progress-fill{
				height:100%;border-radius:3px;
				background:linear-gradient(90deg,var(--vira-badge-from),var(--vira-badge-to));
				transition:width .4s cubic-bezier(.22,1,.36,1);width:0%;
			}

			#<?php echo esc_attr( $unique_id ); ?> .vira-modules{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-top:48px;}

			#<?php echo esc_attr( $unique_id ); ?> .vira-mod{
				background:var(--vira-mod-bg);border:1.5px solid var(--vira-border);border-radius:18px;
				overflow:hidden;transition:all .35s cubic-bezier(.4,0,.2,1);position:relative;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mod:hover{
				border-color:rgba(245,158,11,.40);transform:translateY(-2px);
				box-shadow:0 10px 28px rgba(23,12,121,.06);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mod.is-open{
				border-color:var(--vira-accent);
				box-shadow:0 18px 40px rgba(245,158,11,.14);
				grid-column:1 / -1;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mod__head{
				display:flex;align-items:center;gap:14px;
				padding:18px 20px;cursor:pointer;width:100%;
				border:none;background:transparent;text-align:right;font-family:inherit;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mod__num{
				width:48px;height:48px;border-radius:14px;flex-shrink:0;
				background:linear-gradient(135deg,var(--vira-badge-from),var(--vira-badge-to));
				color:#fff;font-weight:900;font-size:18px;
				display:grid;place-items:center;
				box-shadow:0 6px 16px rgba(245,158,11,.30);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mod__title{flex:1;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mod__title strong, #<?php echo esc_attr( $unique_id ); ?> .vira-mod__name{display:block;font-size:16.5px;font-weight:800;color:#1D2327;margin:0 0 3px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mod__title span{font-size:12.5px;color:#64748B;font-weight:500;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mod__chev{
				width:32px;height:32px;border-radius:10px;flex-shrink:0;
				background:#F1F5F9;color:#64748B;
				display:grid;place-items:center;transition:all .35s ease;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mod.is-open .vira-mod__chev{
				background:rgba(245,158,11,.15);color:var(--vira-accent);
				transform:rotate(180deg);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mod__body{
				display:grid;
				grid-template-rows:0fr;
				transition:grid-template-rows .5s cubic-bezier(.4,0,.2,1);
				padding:0 20px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mod__body-inner{
				overflow:hidden;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mod.is-open .vira-mod__body{grid-template-rows:1fr;padding:0 20px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mod.is-open .vira-mod__body-inner{padding-bottom:22px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mod__meta{
				display:flex;flex-wrap:wrap;gap:10px;
				padding:14px 0;border-top:1px dashed var(--vira-border);margin-bottom:14px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mod__chip{
				display:inline-flex;align-items:center;gap:6px;
				background:#F8FAFC;border:1px solid var(--vira-border);
				padding:6px 12px;border-radius:10px;
				font-size:13px;font-weight:600;color:#475569;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mod__chip svg{color:var(--vira-accent);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mod__topics{
				list-style:none;padding:0;margin:0;
				display:grid;grid-template-columns:1fr 1fr;gap:8px 20px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mod__topics li{
				display:flex;align-items:flex-start;gap:8px;
				font-size:14px;color:#475569;line-height:1.7;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mod__topics li svg{flex-shrink:0;margin-top:5px;color:var(--vira-accent);}

			/* Entrance stagger animation */
			#<?php echo esc_attr( $unique_id ); ?> .vira-mod{
				opacity:0;transform:translateY(20px);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-mod.is-visible{
				opacity:1;transform:translateY(0);
				transition:opacity .5s cubic-bezier(.22,1,.36,1), transform .5s cubic-bezier(.22,1,.36,1);
			}

			/* Hover lift on module headers */
			#<?php echo esc_attr( $unique_id ); ?> .vira-mod__head:hover{
				opacity:.9;
			}

			/* Reduced motion */
			@media(prefers-reduced-motion:reduce){
				#<?php echo esc_attr( $unique_id ); ?> .vira-mod{opacity:1;transform:none;transition:none;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-mod__body{transition:none;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-mod__chev{transition:none;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-mod:hover{transform:none;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-curriculum__toggle-all:hover{transform:none;}
			}

			@media(max-width:780px){
				#<?php echo esc_attr( $unique_id ); ?> .vira-modules{grid-template-columns:1fr;}
			}
			@media(max-width:560px){
				#<?php echo esc_attr( $unique_id ); ?> .vira-mod__topics{grid-template-columns:1fr;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-mod__head{padding:14px 16px;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-mod__num{width:42px;height:42px;font-size:16px;}
			}
		</style>

		<section id="<?php echo esc_attr( $unique_id ); ?>" class="vira-curriculum" data-vira-curriculum>
			<div class="vira-curriculum__inner">

				<div class="vira-curriculum__head">
					<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
						<span class="vira-curriculum__eyebrow"><i></i><?php echo esc_html( $settings['eyebrow'] ); ?></span>
					<?php endif; ?>
					<?php if ( ! empty( $settings['heading'] ) ) : ?>
						<?php $heading_tag = $this->vira_safe_tag( isset( $settings['heading_tag'] ) ? $settings['heading_tag'] : 'h2', 'h2' ); ?>
						<<?php echo $heading_tag; ?> class="vira-curriculum__title"><?php echo wp_kses_post( $settings['heading'] ); ?></<?php echo $heading_tag; ?>>
					<?php endif; ?>
					<?php if ( ! empty( $settings['description'] ) ) : ?>
						<p><?php echo esc_html( $settings['description'] ); ?></p>
					<?php endif; ?>
					<?php if ( $show_totals ) : ?>
						<div class="vira-curriculum__totals">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" style="color:var(--vira-accent)"><path d="M2 3h20v14H2zM6 21h12M12 17v4" stroke-linecap="round" stroke-linejoin="round"/></svg>
							<?php if ( ! empty( $settings['totals_modules'] ) ) : ?>
								<strong><?php echo esc_html( $settings['totals_modules'] ); ?></strong>
							<?php endif; ?>
							<?php if ( ! empty( $settings['totals_modules'] ) && ! empty( $settings['totals_hours'] ) ) : ?>
								<span class="sep">·</span>
							<?php endif; ?>
							<?php if ( ! empty( $settings['totals_hours'] ) ) : ?>
								<strong><?php echo esc_html( $settings['totals_hours'] ); ?></strong>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<div class="vira-curriculum__actions">
						<button type="button" class="vira-curriculum__toggle-all" data-toggle-all>
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
							<span data-toggle-label><?php echo esc_html__( 'باز کردن همه', 'vira-sections' ); ?></span>
						</button>
						<div class="vira-curriculum__progress">
							<div class="vira-curriculum__progress-bar"><div class="vira-curriculum__progress-fill" data-progress-fill></div></div>
							<span data-progress-text>۰ / <?php echo count( $modules ); ?></span>
						</div>
					</div>
				</div>

				<?php if ( ! empty( $modules ) ) : ?>
					<div class="vira-modules">
						<?php foreach ( $modules as $i => $mod ) :
							$open_cls = ( ! empty( $mod['is_open'] ) && 'yes' === $mod['is_open'] ) ? ' is-open' : '';
							$topics   = ! empty( $mod['topics'] ) && is_array( $mod['topics'] ) ? $mod['topics'] : array();
							?>
							<div class="vira-mod<?php echo esc_attr( $open_cls ); ?>" data-mod>
								<button class="vira-mod__head" type="button" aria-expanded="<?php echo $open_cls ? 'true' : 'false'; ?>">
									<div class="vira-mod__num"><?php echo esc_html( $mod['module_number'] ); ?></div>
									<div class="vira-mod__title">
										<?php $module_title_tag = $this->vira_safe_tag( isset( $settings['module_title_tag'] ) ? $settings['module_title_tag'] : 'h3', 'h3' ); ?>
										<<?php echo $module_title_tag; ?> class="vira-mod__name"><?php echo esc_html( $mod['module_title'] ); ?></<?php echo $module_title_tag; ?>>
										<?php if ( ! empty( $mod['module_subtitle'] ) ) : ?>
											<span><?php echo esc_html( $mod['module_subtitle'] ); ?></span>
										<?php endif; ?>
									</div>
									<div class="vira-mod__chev">
										<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
									</div>
								</button>
								<div class="vira-mod__body">
									<div class="vira-mod__body-inner">
									<div class="vira-mod__meta">
										<?php if ( ! empty( $mod['sessions_count'] ) ) : ?>
											<span class="vira-mod__chip">
												<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2" stroke-linecap="round"/></svg>
												<?php echo esc_html( $mod['sessions_count'] ); ?>
											</span>
										<?php endif; ?>
										<?php if ( ! empty( $mod['duration'] ) ) : ?>
											<span class="vira-mod__chip">
												<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18" stroke-linecap="round"/></svg>
												<?php echo esc_html( $mod['duration'] ); ?>
											</span>
										<?php endif; ?>
										<?php if ( ! empty( $mod['level'] ) ) : ?>
											<span class="vira-mod__chip">
												<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 12h-4l-3 9L9 3l-3 9H2" stroke-linecap="round" stroke-linejoin="round"/></svg>
												<?php echo esc_html( $mod['level'] ); ?>
											</span>
										<?php endif; ?>
									</div>
									<?php if ( ! empty( $topics ) ) : ?>
										<ul class="vira-mod__topics">
											<?php foreach ( $topics as $topic ) :
												if ( empty( $topic['topic_text'] ) ) {
													continue;
												}
												?>
												<li>
													<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
													<?php echo esc_html( $topic['topic_text'] ); ?>
												</li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

			</div>
		</section>

		<script>
		(function(){
			var root = document.getElementById('<?php echo esc_js( $unique_id ); ?>');
			if (!root) return;

			var prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
			var mods = root.querySelectorAll('[data-mod]');
			var totalMods = mods.length;
			var toggleAllBtn = root.querySelector('[data-toggle-all]');
			var toggleLabel = root.querySelector('[data-toggle-label]');
			var progressFill = root.querySelector('[data-progress-fill]');
			var progressText = root.querySelector('[data-progress-text]');

			var toFa = function(n){ return String(n).replace(/\d/g, function(d){ return '\u06F0\u06F1\u06F2\u06F3\u06F4\u06F5\u06F6\u06F7\u06F8\u06F9'[d]; }); };

			function updateProgress(){
				var opened = root.querySelectorAll('[data-mod].is-open').length;
				if (progressFill) progressFill.style.width = (totalMods > 0 ? (opened / totalMods * 100) : 0) + '%';
				if (progressText) progressText.textContent = toFa(opened) + ' / ' + toFa(totalMods);
			}

			function toggleMod(mod, open){
				if (open) {
					mod.classList.add('is-open');
					var h = mod.querySelector('.vira-mod__head');
					if (h) h.setAttribute('aria-expanded', 'true');
				} else {
					mod.classList.remove('is-open');
					var h = mod.querySelector('.vira-mod__head');
					if (h) h.setAttribute('aria-expanded', 'false');
				}
			}

			mods.forEach(function(mod){
				var head = mod.querySelector('.vira-mod__head');
				if (!head) return;
				head.addEventListener('click', function(){
					var wasOpen = mod.classList.contains('is-open');
					toggleMod(mod, !wasOpen);
					updateProgress();
				});
			});

			// Expand All / Collapse All
			if (toggleAllBtn) {
				toggleAllBtn.addEventListener('click', function(){
					var allOpen = root.querySelectorAll('[data-mod].is-open').length === totalMods;
					mods.forEach(function(mod){
						toggleMod(mod, !allOpen);
					});
					toggleAllBtn.classList.toggle('is-expanded', !allOpen);
					if (toggleLabel) toggleLabel.textContent = allOpen ? '<?php echo esc_js( __( 'باز کردن همه', 'vira-sections' ) ); ?>' : '<?php echo esc_js( __( 'بستن همه', 'vira-sections' ) ); ?>';
					updateProgress();
				});
			}

			// Entrance stagger animation via IntersectionObserver
			if ('IntersectionObserver' in window && !prefersReduced) {
				var entranceObs = new IntersectionObserver(function(entries){
					entries.forEach(function(e){
						if (e.isIntersecting) {
							var idx = Array.prototype.indexOf.call(mods, e.target);
							var delay = idx * 100;
							setTimeout(function(){ e.target.classList.add('is-visible'); }, delay);
							entranceObs.unobserve(e.target);
						}
					});
				}, { threshold: 0.15 });
				mods.forEach(function(m){ entranceObs.observe(m); });
			} else {
				mods.forEach(function(m){ m.classList.add('is-visible'); });
			}

			updateProgress();
		})();
		</script>
		<?php
	}
}
