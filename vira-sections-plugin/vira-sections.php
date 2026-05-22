<?php
/**
 * Plugin Name:       Vira Sections
 * Plugin URI:        https://viraseo.com/
 * Description:       افزونه المنتور حاوی ۱۲ ویجت آماده و حرفه‌ای برای ساخت لندینگ‌پیج: Hero، خدمات، فرآیند، تب‌ها، پکیج‌ها، نظرات، FAQ، تکنولوژی، فرم تماس، Trust Strip + Showcase، Stats Counter + Compare و Curriculum. تمام متن‌ها، رنگ‌ها و تصاویر کاملاً قابل ویرایش.
 * Version:           1.0.0
 * Author:            Vira SEO Team
 * Author URI:        https://viraseo.com/
 * Text Domain:       vira-sections
 * Domain Path:       /languages
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Elementor tested up to: 3.20
 * Elementor Pro tested up to: 3.20
 *
 * @package ViraSections
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'VIRA_SECTIONS_VERSION', '1.0.0' );
define( 'VIRA_SECTIONS_FILE', __FILE__ );
define( 'VIRA_SECTIONS_PATH', plugin_dir_path( __FILE__ ) );
define( 'VIRA_SECTIONS_URL', plugin_dir_url( __FILE__ ) );
define( 'VIRA_SECTIONS_MIN_ELEMENTOR_VERSION', '3.0.0' );
define( 'VIRA_SECTIONS_MIN_PHP_VERSION', '7.4' );

/**
 * Main plugin class — singleton.
 */
final class Vira_Sections_Plugin {

	/**
	 * @var Vira_Sections_Plugin
	 */
	private static $instance = null;

	/**
	 * Singleton accessor.
	 */
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	private function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Plugin bootstrap.
	 */
	public function init() {
		// Translations.
		load_plugin_textdomain( 'vira-sections', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

		// Check Elementor.
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'notice_missing_elementor' ) );
			return;
		}

		// Check Elementor version.
		if ( ! version_compare( ELEMENTOR_VERSION, VIRA_SECTIONS_MIN_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'notice_min_elementor_version' ) );
			return;
		}

		// Check PHP version.
		if ( version_compare( PHP_VERSION, VIRA_SECTIONS_MIN_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'notice_min_php_version' ) );
			return;
		}

		// Add custom Elementor category.
		add_action( 'elementor/elements/categories_registered', array( $this, 'add_widget_category' ) );

		// Register widgets.
		add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );

		// Frontend scripts/styles for editor preview.
		add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'enqueue_editor_styles' ) );

		// Load Vazirmatn font on frontend (optional - only if enabled in settings).
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_assets' ) );

		// Settings page.
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	/**
	 * Register the "Vira Sections" widget category in Elementor.
	 *
	 * @param \Elementor\Elements_Manager $elements_manager
	 */
	public function add_widget_category( $elements_manager ) {
		$elements_manager->add_category(
			'vira-sections',
			array(
				'title' => __( 'Vira Sections', 'vira-sections' ),
				'icon'  => 'fa fa-cubes',
			)
		);
	}

	/**
	 * Register all widgets.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager
	 */
	public function register_widgets( $widgets_manager ) {
		$widgets = array(
			'class-hero.php'                 => 'Vira_Sections_Widget_Hero',
			'class-services-bento.php'       => 'Vira_Sections_Widget_Services_Bento',
			'class-tabs.php'                 => 'Vira_Sections_Widget_Tabs',
			'class-process-timeline.php'     => 'Vira_Sections_Widget_Process_Timeline',
			'class-tech-stack.php'           => 'Vira_Sections_Widget_Tech_Stack',
			'class-pricing.php'              => 'Vira_Sections_Widget_Pricing',
			'class-testimonials-slider.php'  => 'Vira_Sections_Widget_Testimonials_Slider',
			'class-faq-search.php'           => 'Vira_Sections_Widget_Faq_Search',
			'class-cta-form.php'             => 'Vira_Sections_Widget_Cta_Form',
			'class-trust-strip.php'          => 'Vira_Sections_Widget_Trust_Strip',
			'class-stats-counter.php'        => 'Vira_Sections_Widget_Stats_Counter',
			'class-curriculum.php'           => 'Vira_Sections_Widget_Curriculum',
		);

		foreach ( $widgets as $file => $class ) {
			$path = VIRA_SECTIONS_PATH . 'widgets/' . $file;
			if ( file_exists( $path ) ) {
				require_once $path;
				if ( class_exists( $class ) ) {
					$widgets_manager->register( new $class() );
				}
			}
		}
	}

	/**
	 * Enqueue assets for the Elementor editor.
	 */
	public function enqueue_editor_styles() {
		wp_enqueue_style(
			'vira-sections-editor',
			VIRA_SECTIONS_URL . 'assets/css/editor.css',
			array(),
			VIRA_SECTIONS_VERSION
		);
	}

	/**
	 * Enqueue frontend assets.
	 */
	public function enqueue_frontend_assets() {
		$opts = get_option( 'vira_sections_settings', array() );
		// Optional Vazirmatn font.
		if ( ! empty( $opts['load_vazirmatn'] ) ) {
			wp_enqueue_style(
				'vira-sections-vazirmatn',
				'https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css',
				array(),
				'33.003'
			);
		}
		wp_enqueue_style(
			'vira-sections-frontend',
			VIRA_SECTIONS_URL . 'assets/css/frontend.css',
			array(),
			VIRA_SECTIONS_VERSION
		);
	}

	/**
	 * Add admin menu page.
	 */
	public function admin_menu() {
		add_menu_page(
			__( 'Vira Sections', 'vira-sections' ),
			__( 'Vira Sections', 'vira-sections' ),
			'manage_options',
			'vira-sections',
			array( $this, 'render_settings_page' ),
			'dashicons-layout',
			59
		);
	}

	/**
	 * Register settings.
	 */
	public function register_settings() {
		register_setting(
			'vira_sections_group',
			'vira_sections_settings',
			array(
				'type'              => 'array',
				'sanitize_callback' => array( $this, 'sanitize_settings' ),
				'default'           => array(
					'load_vazirmatn' => '1',
				),
			)
		);
	}

	/**
	 * Sanitize settings.
	 */
	public function sanitize_settings( $input ) {
		$out                   = array();
		$out['load_vazirmatn'] = ! empty( $input['load_vazirmatn'] ) ? '1' : '0';
		return $out;
	}

	/**
	 * Render settings page.
	 */
	public function render_settings_page() {
		$opts = get_option( 'vira_sections_settings', array( 'load_vazirmatn' => '1' ) );
		?>
		<div class="wrap" style="max-width:800px;">
			<h1 style="display:flex;align-items:center;gap:10px;">
				<span style="background:linear-gradient(135deg,#170C79,#128BE0);color:#fff;width:40px;height:40px;border-radius:10px;display:grid;place-items:center;font-weight:900;">V</span>
				<?php esc_html_e( 'Vira Sections', 'vira-sections' ); ?>
				<span style="background:#22c55e;color:#fff;font-size:12px;padding:4px 10px;border-radius:6px;font-weight:700;">v<?php echo esc_html( VIRA_SECTIONS_VERSION ); ?></span>
			</h1>
			<p style="font-size:15px;color:#475569;line-height:1.8;max-width:680px;">
				<?php esc_html_e( 'افزونه ویرا سکشنز شامل ۱۲ ویجت تعاملی و حرفه‌ای برای المنتور است که کاملاً قابل ویرایش هستند. متن، رنگ، تصاویر و استایل هر ویجت را می‌توانید از پنل المنتور تغییر دهید.', 'vira-sections' ); ?>
			</p>

			<form method="post" action="options.php" style="margin-top:24px;background:#fff;padding:24px;border:1px solid #ccd0d4;border-radius:8px;">
				<?php settings_fields( 'vira_sections_group' ); ?>
				<table class="form-table">
					<tr>
						<th scope="row"><?php esc_html_e( 'بارگذاری فونت Vazirmatn', 'vira-sections' ); ?></th>
						<td>
							<label>
								<input type="checkbox" name="vira_sections_settings[load_vazirmatn]" value="1" <?php checked( ! empty( $opts['load_vazirmatn'] ) ); ?> />
								<?php esc_html_e( 'فونت Vazirmatn را از CDN بارگذاری کن (پیشنهاد می‌شود اگر قالب شما فونت فارسی استاندارد ندارد).', 'vira-sections' ); ?>
							</label>
						</td>
					</tr>
				</table>
				<?php submit_button(); ?>
			</form>

			<div style="margin-top:32px;background:linear-gradient(135deg,#F0F9FF,#FFFBEB);padding:24px;border-radius:12px;border:1px solid #E2E8F0;">
				<h2 style="margin-top:0;"><?php esc_html_e( 'ویجت‌های موجود', 'vira-sections' ); ?></h2>
				<ol style="font-size:14.5px;line-height:2;">
					<li><strong>Hero (Vira)</strong> — بنر اصلی با Aurora متحرک، اسپات‌لایت موس، کلمات چرخان و موکاپ تعاملی</li>
					<li><strong>Services Bento (Vira)</strong> — گرید Bento با اندازه‌های متغیر</li>
					<li><strong>Interactive Tabs (Vira)</strong> — تب‌های تعاملی با پنل گرادیانی</li>
					<li><strong>Process Timeline (Vira)</strong> — تایم‌لاین کلیک‌شونده با پنل جزئیات</li>
					<li><strong>Tech Stack (Vira)</strong> — نمایش تکنولوژی با تب و کد</li>
					<li><strong>Pricing (Vira)</strong> — پکیج‌های قیمت با Toggle ماهانه/سالانه</li>
					<li><strong>Testimonials Slider (Vira)</strong> — اسلایدر ۳بعدی نظرات</li>
					<li><strong>FAQ Search (Vira)</strong> — سوالات متداول با جستجو و فیلتر</li>
					<li><strong>CTA Form (Vira)</strong> — دعوت به اقدام با فرم تماس</li>
					<li><strong>Trust Strip + Showcase (Vira)</strong> — تب‌های دسکتاپ/تبلت/موبایل با موکاپ متغیر و نوار لوگوها (دو حالت)</li>
					<li><strong>Stats Counter + Compare (Vira)</strong> — شمارنده‌های انیمیشنی + مقایسه قبل/بعد با تب‌های قابل سوییچ</li>
					<li><strong>Curriculum Modules (Vira)</strong> — آکاردئون سرفصل دوره با چیپ‌های اطلاعات و لیست تاپیک‌ها</li>
				</ol>
				<p style="margin-bottom:0;"><strong><?php esc_html_e( 'نحوه استفاده:', 'vira-sections' ); ?></strong> <?php esc_html_e( 'به پنل المنتور برو، در پنل ویجت‌ها دنبال "Vira Sections" بگرد و ویجت دلخواه رو روی صفحه بکش.', 'vira-sections' ); ?></p>
			</div>
		</div>
		<?php
	}

	/**
	 * Notice: Elementor missing.
	 */
	public function notice_missing_elementor() {
		echo '<div class="notice notice-warning is-dismissible"><p>';
		printf(
			/* translators: %s: Elementor */
			esc_html__( '%1$s نیازمند نصب و فعال‌سازی افزونه %2$s است.', 'vira-sections' ),
			'<strong>Vira Sections</strong>',
			'<strong>Elementor</strong>'
		);
		echo '</p></div>';
	}

	/**
	 * Notice: Min Elementor version.
	 */
	public function notice_min_elementor_version() {
		echo '<div class="notice notice-warning is-dismissible"><p>';
		printf(
			esc_html__( '%1$s نیازمند نسخه %2$s یا بالاتر از %3$s است.', 'vira-sections' ),
			'<strong>Vira Sections</strong>',
			esc_html( VIRA_SECTIONS_MIN_ELEMENTOR_VERSION ),
			'<strong>Elementor</strong>'
		);
		echo '</p></div>';
	}

	/**
	 * Notice: Min PHP version.
	 */
	public function notice_min_php_version() {
		echo '<div class="notice notice-warning is-dismissible"><p>';
		printf(
			esc_html__( '%1$s نیازمند PHP نسخه %2$s یا بالاتر است.', 'vira-sections' ),
			'<strong>Vira Sections</strong>',
			esc_html( VIRA_SECTIONS_MIN_PHP_VERSION )
		);
		echo '</p></div>';
	}
}

Vira_Sections_Plugin::instance();
