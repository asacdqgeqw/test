<?php
/**
 * Preset data for all widgets across all pages.
 *
 * @package ViraSections
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Central class that stores all preset data arrays for all 12 widgets.
 */
class Vira_Sections_Presets {

	private static $page_labels = array(
		'website-design'      => 'طراحی سایت',
		'seo-google'          => 'سئو گوگل',
		'seo-training-tabriz' => 'آموزش سئو تبریز',
		'app-android-tabriz'  => 'اپلیکیشن اندروید تبریز',
		'homepage'            => 'صفحه اصلی',
	);

	private static $widget_pages = array(
		'vira_hero'                 => array( 'website-design', 'seo-google', 'seo-training-tabriz', 'app-android-tabriz', 'homepage' ),
		'vira_services_bento'       => array( 'website-design', 'seo-training-tabriz', 'app-android-tabriz', 'homepage' ),
		'vira_tabs'                 => array( 'seo-google', 'seo-training-tabriz' ),
		'vira_process_timeline'     => array( 'website-design', 'seo-google', 'app-android-tabriz', 'homepage' ),
		'vira_tech_stack'           => array( 'app-android-tabriz' ),
		'vira_pricing'              => array( 'website-design', 'seo-google', 'seo-training-tabriz', 'app-android-tabriz', 'homepage' ),
		'vira_testimonials_slider'  => array( 'website-design', 'seo-google', 'seo-training-tabriz', 'app-android-tabriz', 'homepage' ),
		'vira_faq_search'           => array( 'website-design', 'seo-google', 'seo-training-tabriz', 'app-android-tabriz', 'homepage' ),
		'vira_cta_form'             => array( 'website-design', 'seo-google', 'seo-training-tabriz', 'app-android-tabriz', 'homepage' ),
		'vira_trust_strip'          => array( 'website-design', 'homepage' ),
		'vira_stats_counter'        => array( 'seo-google', 'homepage' ),
		'vira_curriculum'           => array( 'seo-training-tabriz' ),
	);

	private static $palettes = array(
		'website-design' => array(
			'aurora_color_1'     => '#128BE0',
			'aurora_color_2'     => '#170C79',
			'btn_grad_from'      => '#128BE0',
			'btn_grad_to'        => '#8ACBD0',
			'rotating_grad_from' => '#8ACBD0',
			'rotating_grad_to'   => '#EFE3CA',
			'bg_color'           => '#0a0640',
		),
		'seo-google' => array(
			'aurora_color_1'     => '#22c55e',
			'aurora_color_2'     => '#128BE0',
			'btn_grad_from'      => '#22c55e',
			'btn_grad_to'        => '#128BE0',
			'rotating_grad_from' => '#22c55e',
			'rotating_grad_to'   => '#8ACBD0',
			'bg_color'           => '#060832',
		),
		'seo-training-tabriz' => array(
			'aurora_color_1'     => '#F59E0B',
			'aurora_color_2'     => '#FBBF24',
			'btn_grad_from'      => '#F59E0B',
			'btn_grad_to'        => '#FBBF24',
			'rotating_grad_from' => '#F59E0B',
			'rotating_grad_to'   => '#EFE3CA',
			'bg_color'           => '#0a0640',
		),
		'app-android-tabriz' => array(
			'aurora_color_1'     => '#3DDC84',
			'aurora_color_2'     => '#A855F7',
			'btn_grad_from'      => '#3DDC84',
			'btn_grad_to'        => '#A855F7',
			'rotating_grad_from' => '#3DDC84',
			'rotating_grad_to'   => '#EFE3CA',
			'bg_color'           => '#060832',
		),
		'homepage' => array(
			'aurora_color_1'     => '#128BE0',
			'aurora_color_2'     => '#170C79',
			'btn_grad_from'      => '#128BE0',
			'btn_grad_to'        => '#8ACBD0',
			'rotating_grad_from' => '#8ACBD0',
			'rotating_grad_to'   => '#EFE3CA',
			'bg_color'           => '#060832',
		),
	);

	public static function get_presets( $widget_name ) {
		$method = 'get_' . str_replace( '-', '_', $widget_name ) . '_presets';
		if ( method_exists( __CLASS__, $method ) ) {
			return self::$method();
		}
		return array();
	}

	public static function get_preset_options( $widget_name ) {
		$options = array( 'custom' => 'سفارشی (بدون تغییر)' );
		if ( ! isset( self::$widget_pages[ $widget_name ] ) ) {
			return $options;
		}
		foreach ( self::$widget_pages[ $widget_name ] as $page_slug ) {
			if ( isset( self::$page_labels[ $page_slug ] ) ) {
				$options[ $page_slug ] = self::$page_labels[ $page_slug ];
			}
		}
		return $options;
	}

	public static function get_all_presets_for_js() {
		$all = array();
		foreach ( array_keys( self::$widget_pages ) as $widget_name ) {
			$all[ $widget_name ] = self::get_presets( $widget_name );
		}
		return $all;
	}

	private static function get_vira_hero_presets() {
		return array(
			'website-design' => array_merge( self::$palettes['website-design'], array(
				'badge_icon'         => '+',
				'badge_text'         => '۴۸ پروژه فعال در حال انجام',
				'heading_before'     => 'ما سایت‌هایی می‌سازیم که',
				'rotating_words'     => array(
					array( 'word' => 'می‌فروشند' ),
					array( 'word' => 'رشد می‌کنند' ),
					array( 'word' => 'ماندگار می‌شوند' ),
				),
				'description'        => 'طراحی اختصاصی، سرعت برق‌آسا و سئوی فنی استاندارد — همه در یک پروژه. ما کسب‌وکار شما را به برند تبدیل می‌کنیم، نه فقط یک سایت در گوشه‌ای از اینترنت.',
				'btn_primary_text'   => 'شروع پروژه من',
				'btn_secondary_text' => 'مشاهده نمونه‌کارها',
				'stats'              => array(
					array( 'value' => '۴۵۰', 'suffix' => '+', 'label' => 'پروژه موفق' ),
					array( 'value' => '۹۸', 'suffix' => '٪', 'label' => 'رضایت مشتری' ),
					array( 'value' => '۱۰', 'suffix' => '+', 'label' => 'سال تجربه' ),
				),
				'marquee_items'      => array(
					array( 'item' => 'وردپرس + المنتور' ),
					array( 'item' => 'طراحی ریسپانسیو' ),
					array( 'item' => 'سئو فنی' ),
					array( 'item' => 'سرعت بالا' ),
					array( 'item' => 'UI/UX اختصاصی' ),
					array( 'item' => 'پشتیبانی ۲۴/۷' ),
				),
			) ),
			'seo-google' => array_merge( self::$palettes['seo-google'], array(
				'badge_icon'         => '↑',
				'badge_text'         => '۱۲۵ سایت در صفحه اول گوگل ایران',
				'heading_before'     => 'سایت شما را به',
				'rotating_words'     => array(
					array( 'word' => 'صفحه اول گوگل' ),
					array( 'word' => 'رتبه ۱ نتایج' ),
					array( 'word' => 'ترافیک ارگانیک' ),
					array( 'word' => 'فروش مداوم' ),
				),
				'description'        => 'سئوی تخصصی و داده‌محور با تیمی از متخصصان رشد — نه فقط رتبه، بلکه درآمد واقعی از گوگل. تحقیق کلمات کلیدی، سئو فنی، لینک‌سازی و محتوای هدفمند در یک پکیج منسجم.',
				'btn_primary_text'   => 'آنالیز رایگان سایت من',
				'btn_secondary_text' => 'مشاهده پکیج‌ها',
				'stats'              => array(
					array( 'value' => '۲۸۰', 'suffix' => '٪+', 'label' => 'میانگین رشد ترافیک' ),
					array( 'value' => '۱۲۵', 'suffix' => '+', 'label' => 'سایت در صفحه اول' ),
					array( 'value' => '۳', 'suffix' => ' ماهه', 'label' => 'شروع نتایج پایدار' ),
				),
				'marquee_items'      => array(
					array( 'item' => 'سئو فنی' ),
					array( 'item' => 'لینک‌سازی' ),
					array( 'item' => 'تحقیق کلمات کلیدی' ),
					array( 'item' => 'محتوای هدفمند' ),
					array( 'item' => 'سئو محلی' ),
					array( 'item' => 'آنالیز رقبا' ),
					array( 'item' => 'Core Web Vitals' ),
				),
			) ),
			'seo-training-tabriz' => array_merge( self::$palettes['seo-training-tabriz'], array(
				'badge_icon'         => "\xF0\x9F\x8E\x93",
				'badge_text'         => '۸۰۰+ شاگرد در تبریز و سراسر ایران',
				'heading_before'     => 'تو تبریز',
				'rotating_words'     => array(
					array( 'word' => 'متخصص سئو شو' ),
					array( 'word' => 'درآمد دلاری بساز' ),
					array( 'word' => 'سایت خودت رو رشد بده' ),
					array( 'word' => 'گوگل رو بشناس' ),
				),
				'description'        => 'از آموزش خصوصی تا دوره‌های گروهی، از مشاوره ساعتی تا آنالیز کامل سایت — هر آنچه برای ورود حرفه‌ای به دنیای سئو نیاز داری، با تجربه ۱۰ سال تدریس در تبریز.',
				'btn_primary_text'   => 'ثبت‌نام دوره',
				'btn_secondary_text' => 'مشاوره رایگان',
				'stats'              => array(
					array( 'value' => '۸۰۰', 'suffix' => '+', 'label' => 'شاگرد آموزش‌دیده' ),
					array( 'value' => '۹۲', 'suffix' => '٪', 'label' => 'رضایت شاگردان' ),
					array( 'value' => '۱۰', 'suffix' => '+', 'label' => 'سال تدریس' ),
				),
				'marquee_items'      => array(
					array( 'item' => 'آموزش خصوصی' ),
					array( 'item' => 'دوره گروهی' ),
					array( 'item' => 'آموزش سازمانی' ),
					array( 'item' => 'مشاوره ساعتی' ),
					array( 'item' => 'آنالیز سایت' ),
					array( 'item' => 'گواهی معتبر' ),
					array( 'item' => 'پروژه واقعی' ),
				),
			) ),
			'app-android-tabriz' => array_merge( self::$palettes['app-android-tabriz'], array(
				'badge_icon'         => "\xF0\x9F\x93\xB1",
				'badge_text'         => '۱۲۰+ اپلیکیشن منتشرشده در گوگل پلی',
				'heading_before'     => 'ایده‌ت رو تبدیل کن به یه',
				'rotating_words'     => array(
					array( 'word' => 'اپ اندرویدی موفق' ),
					array( 'word' => 'محصول دیجیتال' ),
					array( 'word' => 'کسب‌وکار اسکیل‌پذیر' ),
					array( 'word' => 'تجربه کاربری بی‌نظیر' ),
				),
				'description'        => 'از طراحی UI/UX تا توسعه و انتشار در گوگل پلی — تیم ما در تبریز با ۱۰ سال تجربه ساخت اپلیکیشن‌های Native و Cross-Platform ایده‌ت رو به محصولی واقعی و درآمدزا تبدیل می‌کنه.',
				'btn_primary_text'   => 'درخواست مشاوره رایگان',
				'btn_secondary_text' => 'مشاهده پکیج‌ها',
				'stats'              => array(
					array( 'value' => '۱۲۰', 'suffix' => '+', 'label' => 'اپلیکیشن منتشرشده' ),
					array( 'value' => '۲', 'suffix' => 'M+', 'label' => 'دانلود فعال' ),
					array( 'value' => '۴.۷', 'suffix' => '★', 'label' => 'میانگین امتیاز' ),
				),
				'marquee_items'      => array(
					array( 'item' => 'Native Android' ),
					array( 'item' => 'Flutter' ),
					array( 'item' => 'React Native' ),
					array( 'item' => 'Kotlin' ),
					array( 'item' => 'Firebase' ),
					array( 'item' => 'درگاه پرداخت' ),
					array( 'item' => 'Push Notification' ),
				),
			) ),
			'homepage' => array_merge( self::$palettes['homepage'], array(
				'badge_icon'         => '✦',
				'badge_text'         => '۱۰ سال تجربه در خدمات دیجیتال',
				'heading_before'     => 'ما برای شما',
				'rotating_words'     => array(
					array( 'word' => 'سایت می‌سازیم' ),
					array( 'word' => 'سئو می‌کنیم' ),
					array( 'word' => 'اپلیکیشن می‌سازیم' ),
					array( 'word' => 'آموزش می‌دهیم' ),
				),
				'description'        => 'آژانس دیجیتال مارکتینگ ویرا سئو — از طراحی سایت و سئو گوگل تا ساخت اپلیکیشن و آموزش. همه خدمات دیجیتال در یک تیم حرفه‌ای با بیش از ۱۰ سال تجربه.',
				'btn_primary_text'   => 'مشاوره رایگان',
				'btn_secondary_text' => 'نمونه‌کارها',
				'stats'              => array(
					array( 'value' => '۴۵۰', 'suffix' => '+', 'label' => 'پروژه موفق' ),
					array( 'value' => '۹۸', 'suffix' => '٪', 'label' => 'رضایت مشتری' ),
					array( 'value' => '۱۰', 'suffix' => '+', 'label' => 'سال تجربه' ),
				),
				'marquee_items'      => array(
					array( 'item' => 'طراحی سایت' ),
					array( 'item' => 'سئو گوگل' ),
					array( 'item' => 'اپلیکیشن اندروید' ),
					array( 'item' => 'آموزش سئو' ),
					array( 'item' => 'دیجیتال مارکتینگ' ),
					array( 'item' => 'پشتیبانی ۲۴/۷' ),
				),
			) ),
		);
	}

	private static function get_vira_faq_search_presets() {
		return array(
			'website-design' => array(
				'eyebrow'    => 'سوالات متداول',
				'heading'    => 'پاسخ به پرسش‌های رایج',
				'categories' => array(
					array( 'cat_slug' => 'all', 'cat_label' => 'همه' ),
					array( 'cat_slug' => 'time', 'cat_label' => 'زمان و فرآیند' ),
					array( 'cat_slug' => 'seo', 'cat_label' => 'سئو و رشد' ),
					array( 'cat_slug' => 'price', 'cat_label' => 'قیمت و پشتیبانی' ),
					array( 'cat_slug' => 'tech', 'cat_label' => 'فنی' ),
				),
				'items' => array(
					array( 'question' => 'زمان طراحی یک سایت چقدر است؟', 'answer' => 'بسته به نوع پروژه، طراحی سایت معمولی بین ۲ تا ۴ هفته و فروشگاهی یا اختصاصی بین ۶ تا ۱۰ هفته زمان می‌برد. در جلسه مشاوره، زمان دقیق پروژه شما اعلام می‌شود و در یک تقویم مشترک قابل پیگیری است.', 'item_categories' => 'time' ),
					array( 'question' => 'آیا می‌توانم خودم سایت را مدیریت کنم؟', 'answer' => 'بله. تمام سایت‌ها روی وردپرس + المنتور یا پنل اختصاصی تحویل داده می‌شوند. یک دوره آموزش ویدیویی + ۲ ساعت جلسه آنلاین برای آشنایی کامل با پنل ارائه می‌شود.', 'item_categories' => 'tech' ),
					array( 'question' => 'آیا خدمات سئو هم ارائه می‌دهید؟', 'answer' => 'بله. سئوی فنی پایه (اسکیما، سایت‌مپ، Core Web Vitals) در تمام پکیج‌ها رایگان است. برای سئوی مستمر و رشد رتبه گوگل، پلن‌های ماهانه اختصاصی از ۲.۹ میلیون تومان شروع می‌شوند.', 'item_categories' => 'seo' ),
					array( 'question' => 'هزینه پشتیبانی پس از پایان دوره رایگان چقدر است؟', 'answer' => 'پلن‌های نگهداری از ماهانه ۹۹۰ هزار تومان شروع می‌شوند که شامل بک‌آپ، به‌روزرسانی، رفع خطا و ۲ ساعت تغییرات اختصاصی است. در پلن طلایی، تعداد ساعات تغییرات نامحدود می‌شود.', 'item_categories' => 'price' ),
					array( 'question' => 'اگر از طراحی راضی نباشم چه می‌شود؟', 'answer' => 'طراحی در مراحل با تأیید شما پیش می‌رود و تا ۳ نوبت بازنگری در هر مرحله رایگان است. تمرکز ما روی رضایت کامل شما در پایان پروژه است. در صورت عدم توافق، ضمانت بازگشت وجه برای مرحله طراحی وجود دارد.', 'item_categories' => 'time' ),
					array( 'question' => 'آیا سایت روی هاست خودم منتقل می‌شود؟', 'answer' => 'بله. ما پکیج‌های هاست بهینه‌شده اختصاصی هم ارائه می‌دهیم، اما اگر هاست خودتان را دارید، سایت کاملاً روی آن نصب و راه‌اندازی می‌شود. در صورت نیاز، مشاوره خرید هاست مناسب هم رایگان است.', 'item_categories' => 'tech' ),
					array( 'question' => 'سئو سایت من چقدر زمان می‌برد تا نتیجه دهد؟', 'answer' => 'معمولاً ۳ تا ۶ ماه برای دیدن نتایج پایدار. کلمات کلیدی کم‌رقابت در ماه ۲ و کلمات اصلی در ماه ۴ تا ۶ به صفحه اول می‌رسند. گزارش هفتگی از روند رشد ارائه می‌شود.', 'item_categories' => 'seo' ),
				),
			),
			'seo-google' => array(
				'eyebrow'    => 'سوالات متداول',
				'heading'    => 'پاسخ سوالات شما',
				'categories' => array(
					array( 'cat_slug' => 'all', 'cat_label' => 'همه' ),
					array( 'cat_slug' => 'general', 'cat_label' => 'عمومی' ),
					array( 'cat_slug' => 'technical', 'cat_label' => 'فنی' ),
					array( 'cat_slug' => 'pricing', 'cat_label' => 'قیمت' ),
					array( 'cat_slug' => 'results', 'cat_label' => 'نتایج' ),
				),
				'items' => array(
					array( 'question' => 'سئو چقدر زمان می‌برد تا نتیجه دهد؟', 'answer' => 'معمولاً نتایج اولیه سئو بین ۳ تا ۶ ماه قابل مشاهده است. البته این بستگی به رقابت کلمات کلیدی، وضعیت فعلی سایت و بودجه دارد. ما از همان ماه اول Quick Winها را اجرا می‌کنیم تا بهبودهای اولیه زودتر دیده شوند.', 'item_categories' => 'results' ),
					array( 'question' => 'آیا تضمین رتبه اول دارید؟', 'answer' => 'هیچ شرکت معتبری نمی‌تواند رتبه ۱ را تضمین کند چون الگوریتم گوگل خارج از کنترل ماست. اما ما تضمین می‌کنیم که با بهترین متدهای روز دنیا کار می‌کنیم و در ۹۵٪ پروژه‌هایمان، کلمات کلیدی به صفحه اول رسیده‌اند.', 'item_categories' => 'general' ),
					array( 'question' => 'تفاوت سئو با تبلیغات گوگل چیست؟', 'answer' => 'تبلیغات گوگل (Google Ads) نتیجه فوری دارد اما با پایان بودجه متوقف می‌شود. سئو یک سرمایه‌گذاری بلندمدت است که ترافیک رایگان و مداوم ایجاد می‌کند. بهترین استراتژی ترکیب هر دو است.', 'item_categories' => 'general' ),
					array( 'question' => 'اگر الگوریتم گوگل تغییر کند چه می‌شود؟', 'answer' => 'ما همیشه از روش‌های White-Hat و مطابق با دستورالعمل‌های گوگل استفاده می‌کنیم. به‌روزرسانی‌های الگوریتم معمولاً سایت‌هایی را جریمه می‌کنند که از روش‌های غیراستاندارد استفاده کرده‌اند.', 'item_categories' => 'technical' ),
					array( 'question' => 'آیا لینک‌سازی شما امن است؟', 'answer' => 'بله، ما فقط از روش‌های White-Hat لینک‌سازی استفاده می‌کنیم: Guest Posting در سایت‌های معتبر، Digital PR، و Broken Link Building. هیچ PBN یا لینک اسپمی در کار نیست.', 'item_categories' => 'technical' ),
					array( 'question' => 'گزارش‌ها شامل چه مواردی هستند؟', 'answer' => 'گزارش‌های ما شامل: رتبه‌بندی کلمات کلیدی، ترافیک ارگانیک، بک‌لینک‌های جدید، وضعیت فنی سایت، نرخ کلیک (CTR)، صفحات برتر و اقدامات انجام‌شده و برنامه ماه آینده است.', 'item_categories' => 'results' ),
					array( 'question' => 'چه تفاوتی بین پکیج‌ها وجود دارد؟', 'answer' => 'تفاوت اصلی در تعداد کلمات کلیدی هدف، حجم لینک‌سازی و تولید محتوا، و سطح پشتیبانی است. پکیج پایه برای شروع مناسب است، حرفه‌ای برای رشد جدی و سازمانی برای برندهای بزرگ با نیازهای خاص طراحی شده.', 'item_categories' => 'pricing' ),
					array( 'question' => 'آیا می‌توانم پکیج را در طول مسیر تغییر دهم؟', 'answer' => 'بله، می‌توانید هر زمان پکیج خود را ارتقا دهید. همچنین بعد از ۳ ماه اول، امکان تنظیم سفارشی بر اساس نیازهای شما وجود دارد.', 'item_categories' => 'pricing' ),
				),
			),
			'seo-training-tabriz' => array(
				'eyebrow'    => 'سوالات متداول',
				'heading'    => 'پاسخ سوالات شما',
				'categories' => array(
					array( 'cat_slug' => 'all', 'cat_label' => 'همه' ),
					array( 'cat_slug' => 'courses', 'cat_label' => 'دوره‌ها' ),
					array( 'cat_slug' => 'consultation', 'cat_label' => 'مشاوره' ),
					array( 'cat_slug' => 'analysis', 'cat_label' => 'آنالیز' ),
					array( 'cat_slug' => 'financial', 'cat_label' => 'مالی' ),
				),
				'items' => array(
					array( 'question' => 'آموزش‌ها حضوری در تبریز برگزار می‌شود یا آنلاین؟', 'answer' => 'آموزش خصوصی هم به صورت حضوری در تبریز و هم آنلاین (با Google Meet) قابل برگزاری است. دوره‌های گروهی به صورت ترکیبی برگزار می‌شوند.', 'item_categories' => 'courses' ),
					array( 'question' => 'آیا برای دوره گروهی پیش‌نیاز خاصی نیاز است؟', 'answer' => 'دوره گروهی از مبانی شروع می‌شود و نیازی به دانش قبلی سئو ندارید. تنها پیش‌نیاز، آشنایی پایه با کار با کامپیوتر و اینترنت است.', 'item_categories' => 'courses' ),
					array( 'question' => 'بعد از دوره گواهی دریافت می‌کنم؟', 'answer' => 'بله، در دوره‌های گروهی و سازمانی پس از اتمام موفق دوره و ارائه پروژه پایانی، گواهی پایان دوره معتبر صادر می‌شود.', 'item_categories' => 'courses' ),
					array( 'question' => 'چه تفاوتی بین مشاوره و آنالیز سایت وجود دارد؟', 'answer' => 'مشاوره ساعتی یک جلسه گفت‌وگوی زنده است. اما آنالیز سایت یک کار پژوهشی و چندروزه است: بررسی کامل ۲۰۰+ فاکتور، تحلیل رقبا، گزارش PDF.', 'item_categories' => 'consultation' ),
					array( 'question' => 'آنالیز سایت چه مدت طول می‌کشد؟', 'answer' => 'گزارش آنالیز سایت معمولاً ۵ تا ۷ روز کاری طول می‌کشد. پس از تحویل گزارش PDF، یک جلسه ۱ ساعته توضیح حضوری/آنلاین برگزار می‌شود.', 'item_categories' => 'analysis' ),
					array( 'question' => 'آیا امکان پرداخت اقساطی برای دوره‌ها وجود دارد؟', 'answer' => 'بله، برای دوره‌های گروهی امکان پرداخت در ۲ یا ۳ قسط بدون افزایش قیمت فراهم است.', 'item_categories' => 'financial' ),
					array( 'question' => 'مشاوره ساعتی برای کدام نوع کسب‌وکار مناسب‌تر است؟', 'answer' => 'مشاوره ساعتی برای کسانی مناسب است که قبلاً سایت دارند و با چالش مشخصی روبه‌رو هستند.', 'item_categories' => 'consultation' ),
					array( 'question' => 'اگر از دوره راضی نباشم، هزینه برمی‌گردد؟', 'answer' => 'بله، در دوره‌های گروهی تا پایان جلسه دوم اگر از دوره راضی نباشید، کل هزینه پرداختی شما عودت داده می‌شود.', 'item_categories' => 'financial' ),
					array( 'question' => 'آموزش سازمانی چقدر زمان می‌برد؟', 'answer' => 'زمان دوره سازمانی بسته به سطح فعلی تیم، تعداد افراد و سرفصل‌های انتخابی، معمولاً بین ۱۵ تا ۴۰ ساعت در ۲ تا ۸ هفته متغیر است.', 'item_categories' => 'courses' ),
				),
			),
			'app-android-tabriz' => array(
				'eyebrow'    => 'سوالات متداول',
				'heading'    => 'پاسخ سوالات شما',
				'categories' => array(
					array( 'cat_slug' => 'all', 'cat_label' => 'همه' ),
					array( 'cat_slug' => 'tech', 'cat_label' => 'فنی' ),
					array( 'cat_slug' => 'time', 'cat_label' => 'زمان‌بندی' ),
					array( 'cat_slug' => 'price', 'cat_label' => 'قیمت' ),
					array( 'cat_slug' => 'support', 'cat_label' => 'پشتیبانی' ),
				),
				'items' => array(
					array( 'question' => 'مدت ساخت اپلیکیشن چقدر است؟', 'answer' => 'زمان ساخت اپلیکیشن بسته به پیچیدگی و امکانات متفاوت است. اپ پایه ۴ تا ۶ هفته، اپ حرفه‌ای ۸ تا ۱۲ هفته، و اپ‌های سازمانی ۳ تا ۶ ماه زمان می‌برند.', 'item_categories' => 'time' ),
					array( 'question' => 'آیا اپلیکیشن من در گوگل پلی منتشر می‌شود؟', 'answer' => 'بله، انتشار در گوگل پلی استور بخشی از تمام پکیج‌های ماست.', 'item_categories' => 'tech' ),
					array( 'question' => 'تفاوت اپلیکیشن Native و Cross-Platform چیست؟', 'answer' => 'Native یعنی اپلیکیشنی که با زبان رسمی پلتفرم نوشته می‌شود. Cross-Platform مثل Flutter یا React Native، با یک کدبیس واحد اپ هر دو پلتفرم را تولید می‌کند.', 'item_categories' => 'tech' ),
					array( 'question' => 'آیا کد منبع به من تحویل داده می‌شود؟', 'answer' => 'بله، در پایان پروژه و پس از تسویه نهایی، تمام کد منبع به همراه مستندات فنی کامل به شما تحویل داده می‌شود.', 'item_categories' => 'tech' ),
					array( 'question' => 'آپدیت‌های اپلیکیشن چگونه انجام می‌شود؟', 'answer' => 'آپدیت‌های امنیتی و رفع باگ در دوره پشتیبانی رایگان انجام می‌شود. آپدیت‌های قابلیت‌های جدید بعد از تحلیل و توافق روی هزینه توسعه داده می‌شود.', 'item_categories' => 'support' ),
					array( 'question' => 'آیا امکان ارتقای اپلیکیشن به iOS هم هست؟', 'answer' => 'قطعاً. اگر اپ شما با Flutter یا React Native توسعه یافته باشد، نسخه iOS تقریباً با همان کدبیس قابل تولید است.', 'item_categories' => 'tech' ),
					array( 'question' => 'هزینه پشتیبانی پس از تحویل چقدر است؟', 'answer' => 'پشتیبانی فنی رایگان در پکیج پایه ۳ ماه و در پکیج حرفه‌ای ۶ ماه است. پس از آن قراردادهای پشتیبانی سالیانه از ۱۸٪ ارزش پروژه شروع می‌شود.', 'item_categories' => 'price' ),
					array( 'question' => 'آیا اپلیکیشن من امن است؟', 'answer' => 'امنیت در تمام پروژه‌های ما در اولویت است. ما از SSL/HTTPS، رمزنگاری AES-256، و رعایت OWASP Mobile Top 10 استفاده می‌کنیم.', 'item_categories' => 'tech' ),
					array( 'question' => 'نسخه دمو قبل از تحویل ارائه می‌شود؟', 'answer' => 'بله، ما با متد Agile کار می‌کنیم و در پایان هر Sprint یک نسخه قابل نصب APK روی گوشی شما قرار می‌دهیم.', 'item_categories' => 'support' ),
				),
			),
			'homepage' => array(
				'eyebrow'    => 'سوالات متداول',
				'heading'    => 'پاسخ سوالات شما',
				'categories' => array(
					array( 'cat_slug' => 'all', 'cat_label' => 'همه' ),
					array( 'cat_slug' => 'general', 'cat_label' => 'عمومی' ),
					array( 'cat_slug' => 'pricing', 'cat_label' => 'قیمت‌گذاری' ),
					array( 'cat_slug' => 'process', 'cat_label' => 'فرآیند' ),
					array( 'cat_slug' => 'support', 'cat_label' => 'پشتیبانی' ),
				),
				'items' => array(
					array( 'question' => 'ویرا سئو چه خدماتی ارائه می‌دهد؟', 'answer' => 'ما خدمات طراحی سایت، سئو گوگل، ساخت اپلیکیشن اندروید و آموزش سئو را به صورت تخصصی ارائه می‌دهیم. تمام خدمات توسط یک تیم منسجم با بیش از ۱۰ سال تجربه انجام می‌شود.', 'item_categories' => 'general' ),
					array( 'question' => 'چرا باید همه خدمات را از یک تیم بگیریم؟', 'answer' => 'وقتی طراحی سایت، سئو و محتوا توسط یک تیم انجام شود، هماهنگی کامل بین بخش‌ها وجود دارد. نتیجه سریع‌تر، باکیفیت‌تر و مقرون‌به‌صرفه‌تر خواهد بود.', 'item_categories' => 'general' ),
					array( 'question' => 'هزینه خدمات شما چقدر است؟', 'answer' => 'هزینه بسته به نوع خدمت و حجم پروژه متفاوت است. پکیج‌های طراحی سایت از ۱۸ میلیون، سئو از ۴.۹ میلیون ماهانه و ساخت اپلیکیشن از ۲۵ میلیون شروع می‌شود. مشاوره اولیه رایگان است.', 'item_categories' => 'pricing' ),
					array( 'question' => 'آیا امکان پرداخت اقساطی وجود دارد؟', 'answer' => 'بله، برای پروژه‌های بالای ۲۰ میلیون تومان امکان پرداخت در ۲ تا ۳ قسط بدون افزایش قیمت فراهم است.', 'item_categories' => 'pricing' ),
					array( 'question' => 'فرآیند شروع همکاری چگونه است؟', 'answer' => 'ابتدا فرم مشاوره را پر کنید. کارشناس ما در کمتر از ۲ ساعت تماس می‌گیرد، نیاز شما را بررسی می‌کند و پیشنهاد فنی و مالی ارائه می‌دهد. پس از توافق، پروژه شروع می‌شود.', 'item_categories' => 'process' ),
					array( 'question' => 'مدت زمان انجام پروژه چقدر است؟', 'answer' => 'طراحی سایت ۲ تا ۶ هفته، سئو ۳ تا ۶ ماه برای نتایج پایدار، و ساخت اپلیکیشن ۴ تا ۱۲ هفته زمان می‌برد. زمان دقیق در جلسه مشاوره اعلام می‌شود.', 'item_categories' => 'process' ),
					array( 'question' => 'آیا پشتیبانی پس از تحویل ارائه می‌دهید؟', 'answer' => 'بله، تمام پروژه‌ها شامل ۳ تا ۶ ماه پشتیبانی رایگان هستند. پس از آن، پلن‌های نگهداری ماهانه با قیمت مناسب ارائه می‌شود.', 'item_categories' => 'support' ),
					array( 'question' => 'اگر از نتیجه راضی نباشیم چه می‌شود؟', 'answer' => 'تمام پروژه‌ها مرحله‌ای با تأیید شما پیش می‌روند. در هر مرحله امکان بازنگری رایگان وجود دارد. برای طراحی سایت، ضمانت بازگشت وجه در مرحله اول ارائه می‌شود.', 'item_categories' => 'support' ),
				),
			),
		);
	}

	private static function get_vira_pricing_presets() {
		return array(
			'website-design' => array(
				'eyebrow'     => 'پکیج‌های طراحی',
				'heading'     => 'پکیجی متناسب با هر کسب‌وکار',
				'description' => 'قیمت‌ها شفاف و بدون هزینه پنهان. با پرداخت سالانه ۲ ماه رایگان دریافت کنید.',
				'show_toggle' => 'yes',
				'plans'       => array(
					array( 'plan_name' => 'شروع', 'plan_desc' => 'برای کسب‌وکارهای کوچک و استارتاپ‌ها', 'plan_price_monthly' => '۱۸', 'plan_price_yearly' => '۱۸۰', 'plan_period' => 'میلیون', 'plan_features' => "تا ۸ صفحه اختصاصی\nطراحی کاملاً ریسپانسیو\nسئوی پایه + اسکیما\n۳ ماه پشتیبانی رایگان", 'plan_featured' => '', 'plan_badge' => '', 'plan_cta_text' => 'انتخاب پکیج' ),
					array( 'plan_name' => 'حرفه‌ای', 'plan_desc' => 'برای کسب‌وکارهای در حال رشد', 'plan_price_monthly' => '۳۸', 'plan_price_yearly' => '۳۸۰', 'plan_period' => 'میلیون', 'plan_features' => "تا ۲۰ صفحه اختصاصی + بلاگ\nطراحی UI/UX اختصاصی\nسئو فنی + تحقیق کلمات کلیدی\nدرگاه پرداخت + چندزبانه\n۶ ماه پشتیبانی + آموزش کامل", 'plan_featured' => 'yes', 'plan_badge' => 'پرطرفدار', 'plan_cta_text' => 'شروع پکیج حرفه‌ای' ),
					array( 'plan_name' => 'سازمانی', 'plan_desc' => 'برای فروشگاه‌ها و سازمان‌های بزرگ', 'plan_price_monthly' => 'سفارشی', 'plan_price_yearly' => 'سفارشی', 'plan_period' => '', 'plan_features' => "صفحات و قابلیت‌های نامحدود\nتوسعه اختصاصی Headless/Custom\nاتوماسیون و اتصال CRM/ERP\nSLA پشتیبانی اختصاصی", 'plan_featured' => '', 'plan_badge' => '', 'plan_cta_text' => 'دریافت پیشنهاد' ),
				),
				'bottom_note' => '',
			),
			'seo-google' => array(
				'eyebrow'     => 'قیمت‌گذاری شفاف',
				'heading'     => 'پکیج مناسب کسب‌وکار شما',
				'description' => 'بدون هزینه پنهان — دقیقاً می‌دانید برای چه چیزی هزینه می‌کنید.',
				'show_toggle' => 'yes',
				'plans'       => array(
					array( 'plan_name' => 'پایه', 'plan_desc' => 'برای کسب‌وکارهای کوچک و استارتاپ‌ها', 'plan_price_monthly' => '۴.۹', 'plan_price_yearly' => '۴.۱', 'plan_period' => 'میلیون تومان', 'plan_features' => "۱۰ کلمه کلیدی هدف\nگزارش ماهانه\nلینک‌سازی پایه (۱۰ بک‌لینک/ماه)\nآدیت فنی اولیه\nبهینه‌سازی On-Page", 'plan_featured' => '', 'plan_badge' => '', 'plan_cta_text' => 'شروع پکیج پایه' ),
					array( 'plan_name' => 'حرفه‌ای', 'plan_desc' => 'برای کسب‌وکارهای در حال رشد', 'plan_price_monthly' => '۹.۸', 'plan_price_yearly' => '۸.۲', 'plan_period' => 'میلیون تومان', 'plan_features' => "۳۰ کلمه کلیدی هدف\nگزارش هفتگی + داشبورد زنده\nلینک‌سازی پیشرفته (۳۰+ بک‌لینک/ماه)\nتولید ۸ محتوا/ماه\nبهینه‌سازی فنی کامل\nآنالیز رقبا ماهانه\nپشتیبانی اولویت‌دار", 'plan_featured' => 'yes', 'plan_badge' => 'محبوب‌ترین', 'plan_cta_text' => 'شروع پکیج حرفه‌ای' ),
					array( 'plan_name' => 'سازمانی', 'plan_desc' => 'برای برندها و سازمان‌های بزرگ', 'plan_price_monthly' => 'سفارشی', 'plan_price_yearly' => 'سفارشی', 'plan_period' => 'بر اساس نیاز شما', 'plan_features' => "کلمات کلیدی نامحدود\nمدیر سئو اختصاصی\nمانیتورینگ روزانه\nتولید محتوا نامحدود\nلینک‌سازی Premium (DA 50+)\nجلسات هفتگی استراتژی\nSLA تضمینی + پشتیبانی ۲۴/۷", 'plan_featured' => '', 'plan_badge' => '', 'plan_cta_text' => 'درخواست مشاوره' ),
				),
				'bottom_note' => '',
			),
			'seo-training-tabriz' => array(
				'eyebrow'     => 'خدمات و قیمت‌ها',
				'heading'     => '۵ خدمت برای هر نیاز شما',
				'description' => 'از آموزش خصوصی و گروهی تا مشاوره و آنالیز — هر چیزی که برای رشد حرفه‌ای در سئو نیاز دارید.',
				'show_toggle' => '',
				'plans'       => array(
					array( 'plan_name' => 'آموزش سئو خصوصی', 'plan_desc' => 'جلسات تک‌نفره با تمرکز کامل روی نیاز و سطح شما', 'plan_price_monthly' => '۸۵۰ هزار', 'plan_price_yearly' => '۸۵۰ هزار', 'plan_period' => 'تومان / هر جلسه', 'plan_features' => "جلسات کاملاً اختصاصی و تک‌نفره\nانعطاف کامل در زمان‌بندی\nتمرکز روی پروژه واقعی شما\nپشتیبانی پیامی بین جلسات", 'plan_featured' => '', 'plan_badge' => '', 'plan_cta_text' => 'رزرو جلسه خصوصی' ),
					array( 'plan_name' => 'آموزش سئو گروهی', 'plan_desc' => 'دوره منظم با هم‌کلاسی‌ها — یادگیری همراه با تعامل', 'plan_price_monthly' => '۲.۹ میلیون', 'plan_price_yearly' => '۲.۹ میلیون', 'plan_period' => 'تومان / دوره کامل', 'plan_features' => "کلاس‌های ۸ نفره — تعامل بالا\n۱۲ جلسه آموزش جامع\nگواهی پایان دوره معتبر\nدسترسی به فایل‌های آموزشی\nپروژه پایانی روی سایت واقعی", 'plan_featured' => '', 'plan_badge' => '', 'plan_cta_text' => 'ثبت‌نام دوره گروهی' ),
					array( 'plan_name' => 'آموزش سئو سازمانی', 'plan_desc' => 'آموزش حضوری برای کادر شرکت‌ها و کارخانجات در محل خودتان', 'plan_price_monthly' => 'قیمت سفارشی', 'plan_price_yearly' => 'قیمت سفارشی', 'plan_period' => 'بسته به تعداد و سرفصل', 'plan_features' => "برگزاری در محل شرکت شما\nسرفصل تیم محور و سفارشی\nCase Study مستقیم روی شرکت شما\nپشتیبانی ۳ ماهه پس از دوره\nگواهی برای کل کادر", 'plan_featured' => 'yes', 'plan_badge' => 'پیشنهاد ویژه شرکت‌ها', 'plan_cta_text' => 'درخواست مشاوره سازمانی' ),
				),
				'bottom_note' => '',
			),
			'app-android-tabriz' => array(
				'eyebrow'     => 'پکیج‌های ساخت اپلیکیشن',
				'heading'     => 'پکیج مناسب پروژه شما',
				'description' => 'از اپ ساده تا پلتفرم پیچیده — هر بودجه‌ای جواب دارد.',
				'show_toggle' => '',
				'plans'       => array(
					array( 'plan_name' => 'پایه', 'plan_desc' => 'اپلیکیشن ساده با ۵-۸ صفحه', 'plan_price_monthly' => '۲۵', 'plan_price_yearly' => '۲۵', 'plan_period' => 'میلیون تومان', 'plan_features' => "۵ تا ۸ صفحه اپلیکیشن\nطراحی UI استاندارد\nاتصال به API\n۳ ماه پشتیبانی رایگان\nانتشار در گوگل پلی", 'plan_featured' => '', 'plan_badge' => '', 'plan_cta_text' => 'شروع پکیج پایه' ),
					array( 'plan_name' => 'حرفه‌ای', 'plan_desc' => 'اپلیکیشن کامل با امکانات پیشرفته', 'plan_price_monthly' => '۶۵', 'plan_price_yearly' => '۶۵', 'plan_period' => 'میلیون تومان', 'plan_features' => "۱۵+ صفحه با امکانات کامل\nطراحی UI/UX اختصاصی\nپنل مدیریت اختصاصی\nPush Notification\nدرگاه پرداخت\n۶ ماه پشتیبانی\nانتشار در گوگل پلی + کافه‌بازار", 'plan_featured' => 'yes', 'plan_badge' => 'محبوب‌ترین', 'plan_cta_text' => 'شروع پکیج حرفه‌ای' ),
					array( 'plan_name' => 'سازمانی', 'plan_desc' => 'پلتفرم اختصاصی برای سازمان‌ها', 'plan_price_monthly' => 'سفارشی', 'plan_price_yearly' => 'سفارشی', 'plan_period' => 'بر اساس نیاز شما', 'plan_features' => "معماری Microservices\nCI/CD اختصاصی\nتست نفوذ و امنیت\nSLA پشتیبانی اختصاصی\nتیم اختصاصی توسعه", 'plan_featured' => '', 'plan_badge' => '', 'plan_cta_text' => 'درخواست مشاوره' ),
				),
				'bottom_note' => '',
			),
			'homepage' => array(
				'eyebrow'     => 'پکیج‌های خدمات',
				'heading'     => 'پکیج مناسب هر کسب‌وکار',
				'description' => 'قیمت‌ها شفاف و بدون هزینه پنهان.',
				'show_toggle' => 'yes',
				'plans'       => array(
					array( 'plan_name' => 'شروع', 'plan_desc' => 'برای کسب‌وکارهای کوچک و استارتاپ‌ها', 'plan_price_monthly' => '۱۸', 'plan_price_yearly' => '۱۸۰', 'plan_period' => 'میلیون', 'plan_features' => "طراحی سایت تا ۸ صفحه\nسئوی پایه ۳ ماهه\nپشتیبانی ۳ ماهه رایگان\nآموزش مدیریت سایت", 'plan_featured' => '', 'plan_badge' => '', 'plan_cta_text' => 'انتخاب پکیج' ),
					array( 'plan_name' => 'حرفه‌ای', 'plan_desc' => 'برای کسب‌وکارهای در حال رشد', 'plan_price_monthly' => '۳۸', 'plan_price_yearly' => '۳۸۰', 'plan_period' => 'میلیون', 'plan_features' => "طراحی سایت + سئو ۶ ماهه\nتولید محتوا ماهانه\nمدیریت شبکه‌های اجتماعی\nگزارش هفتگی عملکرد\n۶ ماه پشتیبانی اختصاصی", 'plan_featured' => 'yes', 'plan_badge' => 'پرطرفدار', 'plan_cta_text' => 'شروع پکیج حرفه‌ای' ),
					array( 'plan_name' => 'سازمانی', 'plan_desc' => 'برای سازمان‌ها و برندهای بزرگ', 'plan_price_monthly' => 'سفارشی', 'plan_price_yearly' => 'سفارشی', 'plan_period' => '', 'plan_features' => "طراحی سایت + اپلیکیشن\nسئو + تبلیغات گوگل\nتیم اختصاصی دیجیتال مارکتینگ\nSLA پشتیبانی اختصاصی\nجلسات استراتژی هفتگی", 'plan_featured' => '', 'plan_badge' => '', 'plan_cta_text' => 'دریافت پیشنهاد' ),
				),
				'bottom_note' => '',
			),
		);
	}

	private static function get_vira_testimonials_slider_presets() {
		return array(
			'website-design' => array(
				'eyebrow'     => 'نظر مشتریان',
				'heading'     => 'داستان موفقیت‌هایی که با ما ساختیم',
				'description' => 'رشد، رضایت و تأثیر واقعی — به زبان خود مشتریان ما.',
				'items'       => array(
					array( 'avatar_text' => 'ا', 'quote' => 'تیم ویرا سئو دقیقاً همان چیزی را ساخت که در ذهن داشتم. در سه ماه اول رتبه ما در گوگل سه برابر شد و فروش ماهانه ۲ برابر.', 'name' => 'امیر حسینی', 'company' => 'مدیرعامل، نواکالا', 'badge_text' => '+۲۰۰٪ رشد فروش' ),
					array( 'avatar_text' => 'س', 'quote' => 'برخورد حرفه‌ای، تحویل به‌موقع و پشتیبانی بی‌نظیر. سایت جدید ما در همان ماه اول لانچ، کلی لید با کیفیت آورد.', 'name' => 'سارا کریمی', 'company' => 'بنیان‌گذار، پیکسل‌پلاس', 'badge_text' => '۳.۲× افزایش لید' ),
					array( 'avatar_text' => 'م', 'quote' => 'طراحی فوق‌العاده مدرن و سریع است. مشاوره‌های سئو هم به ما کمک کرد رقبا را در نتایج گوگل پشت سر بگذاریم.', 'name' => 'محمد رضایی', 'company' => 'مدیر بازاریابی، فورتک', 'badge_text' => 'رتبه ۱ در ۸ کلمه' ),
					array( 'avatar_text' => 'ز', 'quote' => 'بعد از سال‌ها سایت‌های بی‌کیفیت، بالاخره یه تیم پیدا کردیم که واقعاً به جزئیات اهمیت می‌ده. صد در صد توصیه می‌کنم.', 'name' => 'زهرا ملکی', 'company' => 'مدیر برند، آوا کالکشن', 'badge_text' => '۹۸/۱۰۰ PageSpeed' ),
				),
			),
			'seo-google' => array(
				'eyebrow'     => 'داستان‌های موفقیت',
				'heading'     => 'مشتریانی که به صفحه اول رسیدند',
				'description' => 'نتایج واقعی از کسب‌وکارهایی که با سئوی ما رشد کردند.',
				'items'       => array(
					array( 'avatar_text' => 'م', 'quote' => 'بعد از ۴ ماه همکاری، ترافیک ارگانیک سایتمون ۳۴۰ درصد رشد کرد. الان بیشتر مشتری‌هامون از گوگل میان.', 'name' => 'محمد احمدی', 'company' => 'مدیرعامل، فروشگاه آنلاین نوین‌تک', 'badge_text' => '+۳۴۰٪ ترافیک' ),
					array( 'avatar_text' => 'س', 'quote' => 'تو ۶ ماه، ۱۲ کلمه کلیدی اصلی‌مون به رتبه ۱ گوگل رسید. تیم سئو واقعاً حرفه‌ای و منظم بودن.', 'name' => 'سارا کریمی', 'company' => 'مدیر مارکتینگ، کلینیک زیبایی رز', 'badge_text' => 'رتبه ۱ در ۱۲ کلمه' ),
					array( 'avatar_text' => 'ع', 'quote' => 'فروش ارگانیک ما ۴ برابر شد! قبلاً کل فروشمون از تبلیغات بود ولی الان ۶۰ درصد فروش از سئو میاد.', 'name' => 'علی رضایی', 'company' => 'بنیان‌گذار، استارتاپ فین‌پی', 'badge_text' => '4x فروش ارگانیک' ),
					array( 'avatar_text' => 'ن', 'quote' => 'با سئو محلی، تعداد تماس‌ها و مراجعه حضوری‌مون ۲۵۰ درصد بیشتر شد. الان تو Map Pack گوگل جزو ۳ نتیجه اول هستیم.', 'name' => 'نازنین محمدی', 'company' => 'مالک، رستوران سنتی باغ ایرانی', 'badge_text' => 'Top 3 نقشه گوگل' ),
				),
			),
			'seo-training-tabriz' => array(
				'eyebrow'     => 'نظر شاگردان',
				'heading'     => 'شاگردانی که موفق شدند',
				'description' => 'تجربه واقعی کسانی که با آموزش ما مسیر حرفه‌ای خود را ساختند.',
				'items'       => array(
					array( 'avatar_text' => 'ع', 'quote' => 'بعد از دوره گروهی، سایت خودم رو از صفر به صفحه اول گوگل رسوندم. بهترین سرمایه‌گذاری روی خودم بود.', 'name' => 'علی رضایی', 'company' => 'شاگرد دوره گروهی', 'badge_text' => 'صفحه اول گوگل' ),
					array( 'avatar_text' => 'س', 'quote' => 'مشاوره ساعتی خیلی مفید بود. دقیقاً فهمیدم چه کارهایی باید انجام بدم و الان خودم سئوی سایتم رو انجام می‌دم.', 'name' => 'سارا کریمی', 'company' => 'مشاوره ساعتی', 'badge_text' => 'رشد ۲۰۰٪ ترافیک' ),
					array( 'avatar_text' => 'م', 'quote' => 'آموزش سازمانی برای تیم مارکتینگ شرکت ما فوق‌العاده بود. الان کل تیم درک درستی از سئو داره.', 'name' => 'محمد احمدی', 'company' => 'مدیر مارکتینگ، شرکت تبریزتک', 'badge_text' => 'آموزش ۱۵ نفر' ),
				),
			),
			'app-android-tabriz' => array(
				'eyebrow'     => 'نظر مشتریان',
				'heading'     => 'پروژه‌هایی که به موفقیت رسیدند',
				'description' => 'تجربه واقعی کسب‌وکارهایی که اپلیکیشنشان را با ما ساختند.',
				'items'       => array(
					array( 'avatar_text' => 'ا', 'quote' => 'اپلیکیشن فروشگاهی ما در ۳ ماه اول ۵۰۰۰ دانلود فعال گرفت. تیم توسعه عالی بود و به‌موقع تحویل دادن.', 'name' => 'امیر حسینی', 'company' => 'مدیرعامل، فروشگاه آنلاین', 'badge_text' => '۵۰۰۰+ دانلود' ),
					array( 'avatar_text' => 'ن', 'quote' => 'کیفیت UI/UX اپلیکیشن ما واقعاً در سطح اپ‌های بین‌المللی است. کاربران از تجربه کاربری عالی تشکر می‌کنند.', 'name' => 'نازنین محمدی', 'company' => 'بنیان‌گذار، استارتاپ سلامت', 'badge_text' => '۴.۸ امتیاز' ),
					array( 'avatar_text' => 'م', 'quote' => 'از مشاوره اولیه تا انتشار در گوگل پلی، تمام مراحل حرفه‌ای و شفاف بود. پشتیبانی بعد از تحویل هم عالی است.', 'name' => 'محمد رضایی', 'company' => 'مدیر فنی، شرکت حمل‌ونقل', 'badge_text' => 'تحویل به‌موقع' ),
				),
			),
			'homepage' => array(
				'eyebrow'     => 'تجربه مشتریان ما',
				'heading'     => 'داستان‌های موفقیت واقعی',
				'description' => 'رضایت مشتریان از خدمات متنوع ما — به زبان خودشان.',
				'items'       => array(
					array( 'avatar_text' => 'ا', 'quote' => 'تیم ویرا سئو هم سایت ما رو طراحی کرد و هم سئو. نتیجه فوق‌العاده بود — در ۳ ماه فروش ما ۲ برابر شد.', 'name' => 'امیر حسینی', 'company' => 'مدیرعامل، نواکالا', 'badge_text' => '+۲۰۰٪ رشد فروش' ),
					array( 'avatar_text' => 'س', 'quote' => 'از آموزش سئو شروع کردیم و الان خودمون سئوی سایتمون رو انجام می‌دیم. بهترین سرمایه‌گذاری روی تیممون بود.', 'name' => 'سارا کریمی', 'company' => 'مدیر مارکتینگ، پیکسل‌پلاس', 'badge_text' => 'رشد ۳۰۰٪ ترافیک' ),
					array( 'avatar_text' => 'م', 'quote' => 'اپلیکیشن فروشگاهی ما رو با کیفیت بالا و در زمان مقرر تحویل دادند. پشتیبانی بعد از تحویل هم عالی بود.', 'name' => 'محمد رضایی', 'company' => 'بنیان‌گذار، فروشگاه آنلاین', 'badge_text' => '۴.۸ امتیاز گوگل پلی' ),
					array( 'avatar_text' => 'ز', 'quote' => 'همه خدمات دیجیتالمون رو از ویرا سئو می‌گیریم. هماهنگی بین طراحی، سئو و محتوا واقعاً تفاوت ایجاد کرده.', 'name' => 'زهرا ملکی', 'company' => 'مدیر برند، آوا کالکشن', 'badge_text' => 'رتبه ۱ در ۱۲ کلمه' ),
				),
			),
		);
	}

	private static function get_vira_cta_form_presets() {
		return array(
			'website-design' => array_merge( self::$palettes['website-design'], array(
				'badge_text'      => 'کارشناسان آنلاین — همین الان',
				'heading'         => 'پروژه شما، یک تماس دور است.',
				'description'     => 'فرم را پر کنید یا مستقیم تماس بگیرید. در کمتر از ۲ ساعت کارشناس ما با شما تماس می‌گیرد و یک پیشنهاد اولیه ارائه می‌دهد.',
				'features'        => array(
					array( 'feat_text' => 'مشاوره رایگان' ),
					array( 'feat_text' => 'بدون تعهد خرید' ),
					array( 'feat_text' => 'پاسخ زیر ۲ ساعت' ),
				),
				'select_options'  => array(
					array( 'opt_text' => 'سایت شرکتی / معرفی خدمات' ),
					array( 'opt_text' => 'فروشگاه اینترنتی' ),
					array( 'opt_text' => 'سایت خبری / محتوایی' ),
					array( 'opt_text' => 'پلتفرم اختصاصی' ),
					array( 'opt_text' => 'سایر' ),
				),
				'submit_text'     => 'ارسال درخواست',
			) ),
			'seo-google' => array_merge( self::$palettes['seo-google'], array(
				'badge_text'      => 'کارشناسان آنلاین',
				'heading'         => 'آماده‌ای سایتت رو به صفحه اول گوگل ببری؟',
				'description'     => 'همین الان فرم رو پر کن تا تیم سئو ما یک آنالیز رایگان از سایتت انجام بده. بدون تعهد، بدون هزینه.',
				'features'        => array(
					array( 'feat_text' => 'آنالیز رایگان سایت و رقبا' ),
					array( 'feat_text' => 'گزارش کامل رقبای شما' ),
					array( 'feat_text' => 'بدون تعهد و کاملاً رایگان' ),
					array( 'feat_text' => 'پاسخ‌گویی در کمتر از ۲ ساعت' ),
				),
				'select_options'  => array(
					array( 'opt_text' => 'تا ۵ میلیون تومان' ),
					array( 'opt_text' => '۵ تا ۱۰ میلیون تومان' ),
					array( 'opt_text' => 'بیش از ۱۰ میلیون تومان' ),
					array( 'opt_text' => 'نیاز به مشاوره دارم' ),
				),
				'submit_text'     => 'دریافت آنالیز رایگان',
			) ),
			'seo-training-tabriz' => array_merge( self::$palettes['seo-training-tabriz'], array(
				'badge_text'      => 'مشاوره رایگان',
				'heading'         => 'آماده‌ای مسیر حرفه‌ای سئو رو شروع کنی؟',
				'description'     => 'فرم زیر رو پر کن تا کارشناس ما بهترین مسیر آموزشی رو بر اساس سطح و هدف تو پیشنهاد بده.',
				'features'        => array(
					array( 'feat_text' => 'مشاوره رایگان انتخاب دوره' ),
					array( 'feat_text' => 'بدون تعهد ثبت‌نام' ),
					array( 'feat_text' => 'پاسخ در کمتر از ۲ ساعت' ),
				),
				'select_options'  => array(
					array( 'opt_text' => 'آموزش خصوصی' ),
					array( 'opt_text' => 'دوره گروهی' ),
					array( 'opt_text' => 'آموزش سازمانی' ),
					array( 'opt_text' => 'مشاوره ساعتی' ),
					array( 'opt_text' => 'آنالیز سایت' ),
				),
				'submit_text'     => 'ارسال درخواست',
			) ),
			'app-android-tabriz' => array_merge( self::$palettes['app-android-tabriz'], array(
				'badge_text'      => 'مشاوره رایگان',
				'heading'         => 'ایده‌ت رو بگو، ما اپش رو می‌سازیم!',
				'description'     => 'فرم زیر رو پر کن تا تیم ما در کمتر از ۲۴ ساعت با تو تماس بگیره و پیشنهاد فنی و مالی ارائه بده.',
				'features'        => array(
					array( 'feat_text' => 'مشاوره فنی رایگان' ),
					array( 'feat_text' => 'تخمین زمان و هزینه' ),
					array( 'feat_text' => 'بدون تعهد اولیه' ),
				),
				'select_options'  => array(
					array( 'opt_text' => 'اپ فروشگاهی' ),
					array( 'opt_text' => 'اپ خدماتی' ),
					array( 'opt_text' => 'شبکه اجتماعی' ),
					array( 'opt_text' => 'اپ سازمانی' ),
					array( 'opt_text' => 'سایر' ),
				),
				'submit_text'     => 'ارسال درخواست مشاوره',
			) ),
			'homepage' => array_merge( self::$palettes['homepage'], array(
				'badge_text'      => 'کارشناسان آنلاین — همین الان',
				'heading'         => 'آماده‌ای رشد دیجیتال کسب‌وکارت رو شروع کنی؟',
				'description'     => 'فرم رو پر کن تا کارشناس ما در کمتر از ۲ ساعت با شما تماس بگیرد. مشاوره اولیه کاملاً رایگان است.',
				'features'        => array(
					array( 'feat_text' => 'مشاوره رایگان' ),
					array( 'feat_text' => 'بدون تعهد خرید' ),
					array( 'feat_text' => 'پاسخ زیر ۲ ساعت' ),
				),
				'select_options'  => array(
					array( 'opt_text' => 'طراحی سایت' ),
					array( 'opt_text' => 'سئو گوگل' ),
					array( 'opt_text' => 'اپلیکیشن اندروید' ),
					array( 'opt_text' => 'آموزش سئو' ),
					array( 'opt_text' => 'سایر' ),
				),
				'submit_text'     => 'ارسال درخواست مشاوره',
			) ),
		);
	}

	private static function get_vira_process_timeline_presets() {
		return array(
			'website-design' => array(
				'eyebrow'     => 'فرآیند کار',
				'heading'     => 'از ایده تا انتشار، در ۴ گام شفاف',
				'description' => 'هیچ ابهامی، هیچ هزینه پنهانی. روی هر مرحله کلیک کنید.',
				'steps'       => array(
					array( 'step_number' => '۱', 'step_title' => 'کشف', 'step_duration' => '۲ روز', 'panel_title' => 'کشف و استراتژی', 'panel_description' => 'جلسه تحلیل کسب‌وکار، رقبا و مخاطب هدف. در این مرحله نقشه راه پروژه تدوین و KPI‌های موفقیت تعیین می‌شوند.', 'panel_features' => "جلسه ۹۰ دقیقه‌ای کشف نیازمندی‌ها\nتحلیل ۵ رقیب اصلی شما\nتعریف Persona و User Journey\nتدوین سند RFP و نقشه راه" ),
					array( 'step_number' => '۲', 'step_title' => 'طراحی', 'step_duration' => '۷ روز', 'panel_title' => 'طراحی UI/UX اختصاصی', 'panel_description' => 'ابتدا وایرفریم برای تأیید ساختار، سپس طراحی نهایی در فیگما با امکان مشاهده زنده و کامنت‌گذاری شما.', 'panel_features' => "وایرفریم تعاملی در Figma\nطراحی نهایی موبایل + دسکتاپ\nسیستم طراحی (Design System)\n۳ نوبت بازنگری رایگان" ),
					array( 'step_number' => '۳', 'step_title' => 'توسعه', 'step_duration' => '۱۴ روز', 'panel_title' => 'توسعه و پیاده‌سازی', 'panel_description' => 'کدنویسی استاندارد روی وردپرس + المنتور یا Headless. Code review مرحله‌ای + تست کیفی توسط تیم QA.', 'panel_features' => "کدنویسی Clean و Semantic\nتست Cross-Browser + موبایل\nبهینه‌سازی سرعت (PageSpeed 90+)\nآموزش استفاده از پنل" ),
					array( 'step_number' => '۴', 'step_title' => 'انتشار', 'step_duration' => '۲ روز', 'panel_title' => 'انتشار و پشتیبانی', 'panel_description' => 'انتشار نهایی با SSL، CDN و مانیتورینگ. شروع دوره پشتیبانی رایگان و آموزش تیم شما.', 'panel_features' => "راه‌اندازی SSL و CDN\nتنظیم Google Analytics + Search Console\nشروع پشتیبانی ۳-۶ ماهه\nگزارش هفتگی عملکرد" ),
				),
			),
			'seo-google' => array(
				'eyebrow'     => 'فرآیند سئو',
				'heading'     => 'مسیر رشد ارگانیک شما',
				'description' => 'یک فرآیند شفاف و داده‌محور از آنالیز تا نتیجه.',
				'steps'       => array(
					array( 'step_number' => '۱', 'step_title' => 'آنالیز', 'step_duration' => '۱ هفته', 'panel_title' => 'آدیت و آنالیز', 'panel_description' => 'بررسی کامل وضعیت فنی سایت، تحلیل رقبا و تحقیق کلمات کلیدی.', 'panel_features' => "آدیت فنی ۲۰۰+ فاکتور\nتحقیق کلمات کلیدی\nتحلیل ۵ رقیب اصلی\nتدوین استراتژی ۶ ماهه" ),
					array( 'step_number' => '۲', 'step_title' => 'بهینه‌سازی', 'step_duration' => '۲ هفته', 'panel_title' => 'سئو فنی و On-Page', 'panel_description' => 'رفع مشکلات فنی، بهینه‌سازی محتوا و ساختار سایت.', 'panel_features' => "رفع خطاهای Crawl\nبهینه‌سازی Core Web Vitals\nSchema Markup\nبهینه‌سازی محتوای موجود" ),
					array( 'step_number' => '۳', 'step_title' => 'محتوا', 'step_duration' => 'مستمر', 'panel_title' => 'تولید محتوا و لینک‌سازی', 'panel_description' => 'تولید محتوای هدفمند و لینک‌سازی White-Hat برای افزایش اتوریتی.', 'panel_features' => "تولید محتوای SEO-Friendly\nلینک‌سازی Guest Post\nDigital PR\nبهینه‌سازی مداوم" ),
					array( 'step_number' => '۴', 'step_title' => 'رشد', 'step_duration' => 'مستمر', 'panel_title' => 'مانیتورینگ و رشد', 'panel_description' => 'پایش روزانه رتبه‌ها، گزارش‌دهی و بهینه‌سازی مستمر برای حفظ و ارتقای نتایج.', 'panel_features' => "داشبورد زنده رتبه‌ها\nگزارش هفتگی/ماهانه\nآنالیز رقبا مستمر\nبهینه‌سازی نرخ تبدیل" ),
				),
			),
			'app-android-tabriz' => array(
				'eyebrow'     => 'فرآیند توسعه',
				'heading'     => 'از ایده تا انتشار در گوگل پلی',
				'description' => 'فرآیند شفاف و Agile برای ساخت اپلیکیشن شما.',
				'steps'       => array(
					array( 'step_number' => '۱', 'step_title' => 'نیازسنجی', 'step_duration' => '۱ هفته', 'panel_title' => 'تحلیل و نیازسنجی', 'panel_description' => 'بررسی ایده، تحلیل بازار و رقبا، تعریف MVP و نقشه راه توسعه.', 'panel_features' => "جلسه نیازسنجی\nتحلیل رقبا\nتعریف MVP\nRoadmap توسعه" ),
					array( 'step_number' => '۲', 'step_title' => 'طراحی', 'step_duration' => '۲ هفته', 'panel_title' => 'طراحی UI/UX', 'panel_description' => 'طراحی تجربه کاربری و رابط گرافیکی اپلیکیشن در Figma.', 'panel_features' => "وایرفریم تعاملی\nطراحی UI نهایی\nDesign System\nپروتوتایپ قابل تست" ),
					array( 'step_number' => '۳', 'step_title' => 'توسعه', 'step_duration' => '۴-۸ هفته', 'panel_title' => 'کدنویسی و توسعه', 'panel_description' => 'توسعه اپلیکیشن با Kotlin/Flutter، اتصال به Backend و تست.', 'panel_features' => "توسعه Frontend\nتوسعه Backend/API\nتست QA\nنسخه Beta" ),
					array( 'step_number' => '۴', 'step_title' => 'انتشار', 'step_duration' => '۱ هفته', 'panel_title' => 'انتشار و پشتیبانی', 'panel_description' => 'انتشار در گوگل پلی، ASO اولیه و شروع دوره پشتیبانی.', 'panel_features' => "انتشار گوگل پلی\nASO (App Store Optimization)\nمانیتورینگ Crash\nپشتیبانی ۳-۶ ماهه" ),
				),
			),
			'homepage' => array(
				'eyebrow'     => 'فرآیند همکاری',
				'heading'     => 'از مشاوره تا موفقیت شما',
				'description' => 'فرآیند شفاف و بدون ابهام — در هر مرحله می‌دانید چه اتفاقی می‌افتد.',
				'steps'       => array(
					array( 'step_number' => '۱', 'step_title' => 'مشاوره', 'step_duration' => '۱ روز', 'panel_title' => 'مشاوره رایگان و نیازسنجی', 'panel_description' => 'در جلسه مشاوره رایگان، نیاز شما را بررسی می‌کنیم و بهترین راهکار را پیشنهاد می‌دهیم.', 'panel_features' => "جلسه مشاوره رایگان\nبررسی نیاز و اهداف\nپیشنهاد خدمات مناسب\nتخمین زمان و هزینه" ),
					array( 'step_number' => '۲', 'step_title' => 'تحلیل', 'step_duration' => '۳ روز', 'panel_title' => 'تحلیل و استراتژی', 'panel_description' => 'تحلیل کسب‌وکار، رقبا و بازار هدف شما. تدوین نقشه راه و استراتژی اجرایی.', 'panel_features' => "تحلیل رقبا و بازار\nتدوین استراتژی\nتعریف KPI‌های موفقیت\nنقشه راه پروژه" ),
					array( 'step_number' => '۳', 'step_title' => 'طراحی و توسعه', 'step_duration' => '۲-۶ هفته', 'panel_title' => 'طراحی و پیاده‌سازی', 'panel_description' => 'اجرای پروژه با بالاترین استانداردها. در هر مرحله شما در جریان پیشرفت کار هستید.', 'panel_features' => "طراحی UI/UX اختصاصی\nتوسعه و کدنویسی\nتست کیفیت\nبازنگری با تأیید شما" ),
					array( 'step_number' => '۴', 'step_title' => 'تست', 'step_duration' => '۳ روز', 'panel_title' => 'تست و بهینه‌سازی', 'panel_description' => 'تست جامع عملکرد، سرعت و سازگاری. رفع مشکلات و بهینه‌سازی نهایی.', 'panel_features' => "تست Cross-Browser\nتست سرعت و عملکرد\nبهینه‌سازی نهایی\nآمادگی برای انتشار" ),
					array( 'step_number' => '۵', 'step_title' => 'انتشار و پشتیبانی', 'step_duration' => 'مستمر', 'panel_title' => 'انتشار و پشتیبانی مداوم', 'panel_description' => 'انتشار نهایی و شروع دوره پشتیبانی. تیم ما همیشه در کنار شماست.', 'panel_features' => "انتشار و راه‌اندازی\nآموزش تیم شما\nپشتیبانی ۳-۶ ماهه رایگان\nگزارش عملکرد هفتگی" ),
				),
			),
		);
	}

	private static function get_vira_services_bento_presets() {
		return array(
			'website-design' => array(
				'eyebrow'     => 'چرا ویرا سئو',
				'heading'     => 'هرچه برای رشد آنلاین لازم دارید، یکجا',
				'description' => 'نه فقط یک طراحی زیبا — یک سیستم کامل برای جذب، تبدیل و نگهداشت مشتری.',
				'cards'       => array(
					array( 'card_title' => 'طراحی UI/UX اختصاصی', 'card_desc' => 'طراحی رابط کاربری مدرن و تجربه کاربری بهینه مخصوص برند شما', 'card_meta' => '', 'card_size' => 'large' ),
					array( 'card_title' => 'سرعت برق‌آسا', 'card_desc' => 'بهینه‌سازی Core Web Vitals و PageSpeed بالای ۹۰', 'card_meta' => '', 'card_size' => 'large' ),
					array( 'card_title' => 'سئو فنی استاندارد', 'card_desc' => 'اسکیما، سایت‌مپ و ساختار بهینه از روز اول', 'card_meta' => '', 'card_size' => 'small' ),
					array( 'card_title' => 'امنیت و پایداری', 'card_desc' => 'SSL، فایروال و بک‌آپ روزانه برای آرامش خاطر شما', 'card_meta' => '', 'card_size' => 'small' ),
					array( 'card_title' => 'پشتیبانی حرفه‌ای', 'card_desc' => 'تیم پشتیبانی ۲۴/۷ با زمان پاسخ کمتر از ۲ ساعت', 'card_meta' => '', 'card_size' => 'small' ),
				),
			),
			'seo-training-tabriz' => array(
				'eyebrow'     => 'خدمات آموزشی',
				'heading'     => 'انواع خدمات آموزش سئو',
				'description' => 'هر سطح و هر نیازی — ما خدمت مناسب شما را داریم.',
				'cards'       => array(
					array( 'card_title' => 'آموزش خصوصی', 'card_desc' => 'جلسات تک‌نفره با تمرکز کامل روی سایت و نیاز شما', 'card_meta' => '۸۵۰ هزار / جلسه', 'card_size' => 'large' ),
					array( 'card_title' => 'دوره گروهی', 'card_desc' => 'کلاس‌های ۸ نفره با تعامل بالا و پروژه واقعی', 'card_meta' => '۲.۹ میلیون / دوره', 'card_size' => 'large' ),
					array( 'card_title' => 'آموزش سازمانی', 'card_desc' => 'آموزش حضوری در محل شرکت شما', 'card_meta' => 'قیمت سفارشی', 'card_size' => 'small' ),
					array( 'card_title' => 'مشاوره ساعتی', 'card_desc' => 'جلسه گفت‌وگوی زنده برای حل چالش‌های سئو', 'card_meta' => '۴۵۰ هزار / ساعت', 'card_size' => 'small' ),
					array( 'card_title' => 'آنالیز سایت', 'card_desc' => 'بررسی ۲۰۰+ فاکتور و گزارش PDF جامع', 'card_meta' => '۱.۵ میلیون', 'card_size' => 'small' ),
				),
			),
			'app-android-tabriz' => array(
				'eyebrow'     => 'خدمات ما',
				'heading'     => 'هر چیزی که برای ساخت اپ نیاز دارید',
				'description' => 'از ایده‌پردازی تا انتشار و پشتیبانی — همه در یک تیم.',
				'cards'       => array(
					array( 'card_title' => 'طراحی UI/UX موبایل', 'card_desc' => 'طراحی رابط کاربری مدرن و تجربه کاربری بهینه مخصوص موبایل', 'card_meta' => '', 'card_size' => 'large' ),
					array( 'card_title' => 'توسعه Native Android', 'card_desc' => 'برنامه‌نویسی با Kotlin و Java برای بالاترین Performance', 'card_meta' => '', 'card_size' => 'large' ),
					array( 'card_title' => 'توسعه Cross-Platform', 'card_desc' => 'Flutter و React Native برای صرفه‌جویی ۴۰-۵۰٪', 'card_meta' => '', 'card_size' => 'small' ),
					array( 'card_title' => 'Backend و API', 'card_desc' => 'طراحی و پیاده‌سازی سرور، دیتابیس و APIها', 'card_meta' => '', 'card_size' => 'small' ),
					array( 'card_title' => 'انتشار و ASO', 'card_desc' => 'انتشار حرفه‌ای در گوگل پلی و بهینه‌سازی استور', 'card_meta' => '', 'card_size' => 'small' ),
				),
			),
			'homepage' => array(
				'eyebrow'     => 'خدمات ما',
				'heading'     => 'هر آنچه برای رشد دیجیتال نیاز دارید، <em>یکجا</em>',
				'description' => 'از طراحی سایت و سئو تا ساخت اپلیکیشن و آموزش — تیم ویرا سئو تمام نیازهای دیجیتال کسب‌وکار شما را پوشش می‌دهد.',
				'cards'       => array(
					array( 'card_title' => 'طراحی سایت حرفه‌ای', 'card_desc' => 'طراحی اختصاصی UI/UX، سرعت بالا و سئوی فنی استاندارد — سایتی که می‌فروشد.', 'card_meta' => '', 'card_size' => 'large', 'card_is_dark' => 'yes' ),
					array( 'card_title' => 'سئو و رشد ارگانیک', 'card_desc' => 'از تحقیق کلمات کلیدی تا لینک‌سازی — رسیدن به صفحه اول گوگل با روش‌های White-Hat.', 'card_meta' => '', 'card_size' => 'large' ),
					array( 'card_title' => 'ساخت اپلیکیشن اندروید', 'card_desc' => 'توسعه Native و Cross-Platform با تیم مجرب — از ایده تا انتشار در گوگل پلی.', 'card_meta' => '', 'card_size' => 'medium' ),
					array( 'card_title' => 'آموزش سئو', 'card_desc' => 'آموزش خصوصی، گروهی و سازمانی — با بیش از ۸۰۰ شاگرد موفق.', 'card_meta' => '', 'card_size' => 'medium' ),
					array( 'card_title' => 'مشاوره دیجیتال مارکتینگ', 'card_desc' => 'استراتژی رشد دیجیتال متناسب با کسب‌وکار شما — از مشاوره تا اجرا.', 'card_meta' => '', 'card_size' => 'medium' ),
				),
			),
		);
	}

	private static function get_vira_tabs_presets() {
		return array(
			'seo-google' => array(
				'eyebrow'     => 'خدمات سئو',
				'heading'     => 'خدمات جامع سئو برای رشد کسب‌وکار شما',
				'description' => 'هر آنچه برای رسیدن به صفحه اول گوگل نیاز دارید.',
				'tabs'        => array(
					array( 'tab_title' => 'سئو فنی', 'tab_subtitle' => 'زیرساخت قدرتمند', 'panel_title' => 'سئو فنی و Core Web Vitals', 'panel_description' => 'بهینه‌سازی زیرساخت سایت برای Crawl و Index بهتر توسط گوگل.', 'panel_features' => "بهینه‌سازی Core Web Vitals\nSchema Markup\nسایت‌مپ و robots.txt\nرفع خطاهای Crawl" ),
					array( 'tab_title' => 'محتوا', 'tab_subtitle' => 'محتوای هدفمند', 'panel_title' => 'استراتژی محتوا و تولید', 'panel_description' => 'تولید محتوای SEO-Friendly با تمرکز بر Search Intent.', 'panel_features' => "تحقیق کلمات کلیدی\nتقویم محتوایی\nتولید محتوای حرفه‌ای\nبهینه‌سازی محتوای موجود" ),
					array( 'tab_title' => 'لینک‌سازی', 'tab_subtitle' => 'اتوریتی بالا', 'panel_title' => 'لینک‌سازی White-Hat', 'panel_description' => 'ساخت بک‌لینک‌های باکیفیت از سایت‌های معتبر.', 'panel_features' => "Guest Posting\nDigital PR\nBroken Link Building\nNiche Edits" ),
					array( 'tab_title' => 'آنالیز', 'tab_subtitle' => 'داده‌محور', 'panel_title' => 'آنالیز و گزارش‌دهی', 'panel_description' => 'مانیتورینگ مداوم رتبه‌ها و ارائه گزارش شفاف.', 'panel_features' => "داشبورد زنده\nگزارش هفتگی\nآنالیز رقبا\nپیشنهاد بهبود" ),
				),
			),
			'seo-training-tabriz' => array(
				'eyebrow'     => 'چرا ما',
				'heading'     => 'چرا آموزش سئو با ما متفاوت است',
				'description' => 'تجربه، عمق علمی و رویکرد عملی — تفاوت ما با بقیه.',
				'tabs'        => array(
					array( 'tab_title' => 'تجربه عملی', 'tab_subtitle' => '۱۰ سال تدریس', 'panel_title' => 'تجربه واقعی، نه فقط تئوری', 'panel_description' => 'تمام مثال‌ها و تمرین‌ها روی پروژه‌های واقعی و سایت‌های زنده انجام می‌شود.', 'panel_features' => "پروژه روی سایت واقعی\nCase Study از مشتریان\nابزارهای حرفه‌ای\nتجربه ۱۰ ساله تدریس" ),
					array( 'tab_title' => 'پشتیبانی', 'tab_subtitle' => 'بعد از دوره', 'panel_title' => 'پشتیبانی مادام‌العمر', 'panel_description' => 'بعد از پایان دوره هم می‌توانید سوالات خود را بپرسید.', 'panel_features' => "گروه تلگرامی شاگردان\nپشتیبانی پیامی\nجلسات Q&A ماهانه\nآپدیت محتوای دوره" ),
					array( 'tab_title' => 'گواهی', 'tab_subtitle' => 'معتبر', 'panel_title' => 'گواهی پایان دوره معتبر', 'panel_description' => 'گواهی با QR Code قابل راستی‌آزمایی برای رزومه شما.', 'panel_features' => "QR Code راستی‌آزمایی\nمعتبر برای رزومه\nقابل استعلام آنلاین\nصادر پس از پروژه پایانی" ),
					array( 'tab_title' => 'جامعه', 'tab_subtitle' => 'شبکه‌سازی', 'panel_title' => 'جامعه حرفه‌ای شاگردان', 'panel_description' => 'عضویت در شبکه‌ای از متخصصان سئو برای همکاری و رشد.', 'panel_features' => "شبکه‌سازی حرفه‌ای\nمعرفی فرصت‌های شغلی\nهمکاری در پروژه‌ها\nایونت‌های تخصصی" ),
				),
			),
		);
	}

	private static function get_vira_tech_stack_presets() {
		return array(
			'app-android-tabriz' => array(
				'eyebrow'     => 'تکنولوژی‌ها',
				'heading'     => 'تکنولوژی‌هایی که استفاده می‌کنیم',
				'description' => 'از بهترین و به‌روزترین ابزارها و فریمورک‌ها برای ساخت اپلیکیشن شما استفاده می‌کنیم.',
				'tabs'        => array(
					array( 'tab_label' => 'Frontend', 'panel_title' => 'Frontend', 'panel_subtitle' => 'Kotlin · Flutter · React Native · Jetpack Compose' ),
					array( 'tab_label' => 'Backend', 'panel_title' => 'Backend', 'panel_subtitle' => 'Node.js · Laravel · Firebase · Supabase' ),
					array( 'tab_label' => 'DevOps', 'panel_title' => 'DevOps', 'panel_subtitle' => 'Docker · GitHub Actions · CI/CD · AWS' ),
					array( 'tab_label' => 'ابزارها', 'panel_title' => 'ابزارها', 'panel_subtitle' => 'Figma · Jira · Postman · Sentry' ),
				),
				'logos'       => array(
					array( 'logo_name' => 'Kotlin' ),
					array( 'logo_name' => 'Flutter' ),
					array( 'logo_name' => 'Firebase' ),
					array( 'logo_name' => 'React Native' ),
					array( 'logo_name' => 'Node.js' ),
					array( 'logo_name' => 'Docker' ),
				),
			),
		);
	}

	private static function get_vira_stats_counter_presets() {
		return array(
			'seo-google' => array(
				'eyebrow'     => 'آمار و نتایج',
				'heading'     => 'نتایج واقعی مشتریان ما',
				'description' => 'اعداد دروغ نمی‌گویند — عملکرد ما به زبان آمار.',
				'counters'    => array(
					array( 'number_value' => '۳۴۰', 'suffix' => '٪', 'label' => 'میانگین رشد ترافیک' ),
					array( 'number_value' => '۱۲۵', 'suffix' => '+', 'label' => 'سایت در صفحه اول' ),
					array( 'number_value' => '۹۵', 'suffix' => '٪', 'label' => 'رضایت مشتریان' ),
					array( 'number_value' => '۵۸', 'suffix' => '+', 'label' => 'کلمه کلیدی رتبه ۱' ),
				),
				'compare_before_title' => 'قبل از سئو',
				'compare_after_title'  => 'بعد از سئو',
			),
			'homepage' => array(
				'eyebrow'     => 'عملکرد ما در اعداد',
				'heading'     => 'اعدادی که خودشان حرف می‌زنند',
				'description' => 'هر عدد نتیجه سال‌ها کار تخصصی تیم ما روی پروژه‌های واقعی است.',
				'counters'    => array(
					array( 'number_value' => '۴۵۰', 'suffix' => '+', 'label' => 'پروژه موفق' ),
					array( 'number_value' => '۱۲۵', 'suffix' => '+', 'label' => 'سایت در صفحه اول' ),
					array( 'number_value' => '۸۰۰', 'suffix' => '+', 'label' => 'شاگرد آموزش‌دیده' ),
					array( 'number_value' => '۱۰', 'suffix' => '+', 'label' => 'سال تجربه' ),
				),
			),
		);
	}

	private static function get_vira_trust_strip_presets() {
		return array(
			'website-design' => array(
				'mode'        => 'showcase',
				'eyebrow'     => 'کاملاً ریسپانسیو',
				'heading'     => 'روی هر دستگاهی، بی‌نقص',
				'logos'       => array(
					array( 'logo_text' => 'دیجی‌کالا' ),
					array( 'logo_text' => 'اسنپ' ),
					array( 'logo_text' => 'فیلیمو' ),
					array( 'logo_text' => 'کافه‌بازار' ),
					array( 'logo_text' => 'تپسی' ),
					array( 'logo_text' => 'آپارات' ),
				),
			),
			'homepage' => array(
				'mode'        => 'logos_only',
				'logos_title' => 'اعتماد بیش از ۴۵۰ کسب‌وکار ایرانی',
				'logos'       => array(
					array( 'logo_text' => 'دیجی‌کالا' ),
					array( 'logo_text' => 'اسنپ' ),
					array( 'logo_text' => 'فیلیمو' ),
					array( 'logo_text' => 'کافه‌بازار' ),
					array( 'logo_text' => 'تپسی' ),
					array( 'logo_text' => 'آپارات' ),
				),
			),
		);
	}

	private static function get_vira_curriculum_presets() {
		return array(
			'seo-training-tabriz' => array(
				'eyebrow'       => 'سرفصل دوره',
				'heading'       => 'سرفصل کامل دوره آموزش سئو',
				'description'   => 'از مبانی تا پیشرفته — تمام آنچه برای حرفه‌ای شدن نیاز دارید.',
				'totals_modules' => '۸',
				'totals_hours'  => '۴۰+',
				'modules'       => array(
					array( 'module_number' => '۱', 'module_title' => 'مبانی سئو و موتورهای جستجو', 'module_subtitle' => 'شناخت پایه‌ای دنیای سئو', 'sessions_count' => '۴ جلسه', 'duration' => '۶ ساعت', 'level' => 'مقدماتی', 'topics' => "مفاهیم پایه و تاریخچه سئو\nنحوه کار موتورهای جستجو (Crawl, Index, Rank)\nالگوریتم‌های مهم گوگل (Panda, Penguin, BERT, Helpful Content)\nE-E-A-T و فاکتورهای کیفیت محتوا\nتفاوت White-Hat و Black-Hat SEO\nنقشه راه شخصی برای ورود به سئو" ),
					array( 'module_number' => '۲', 'module_title' => 'تحقیق کلمات کلیدی حرفه‌ای', 'module_subtitle' => 'پیدا کردن کلمات طلایی برای رتبه گرفتن', 'sessions_count' => '۵ جلسه', 'duration' => '۷ ساعت', 'level' => 'متوسط', 'topics' => "مفاهیم Search Volume، KD و Search Intent\nکار با Ahrefs و Semrush در تحقیق کلمات\nکلمات Long-tail و Question-based\nTopic Cluster و Keyword Mapping\nتحلیل کلمات کلیدی رقبا\nپروژه عملی: ساخت Keyword Plan کامل" ),
					array( 'module_number' => '۳', 'module_title' => 'سئو فنی و Core Web Vitals', 'module_subtitle' => 'زیرساخت قدرتمند برای رتبه‌گیری', 'sessions_count' => '۶ جلسه', 'duration' => '۸ ساعت', 'level' => 'پیشرفته', 'topics' => "Crawlability و Indexability سایت\nCore Web Vitals (LCP, INP, CLS)\nSchema Markup و Structured Data\nrobots.txt، sitemap.xml و canonical\nHTTPS، Mobile-First و JavaScript SEO\nپروژه عملی: آدیت فنی یک سایت واقعی" ),
					array( 'module_number' => '۴', 'module_title' => 'سئو محتوا و Content Strategy', 'module_subtitle' => 'محتوایی که گوگل و کاربر هر دو دوست دارند', 'sessions_count' => '۵ جلسه', 'duration' => '۷ ساعت', 'level' => 'متوسط', 'topics' => "اصول نوشتن محتوای SEO-Friendly\nساختار هدینگ‌ها و Featured Snippets\nContent Gap Analysis\nتقویم محتوایی\nبهینه‌سازی محتوای موجود\nپروژه عملی: نوشتن محتوای رتبه‌ساز" ),
					array( 'module_number' => '۵', 'module_title' => 'لینک‌سازی حرفه‌ای', 'module_subtitle' => 'ساخت اتوریتی با روش‌های امن', 'sessions_count' => '۴ جلسه', 'duration' => '۶ ساعت', 'level' => 'پیشرفته', 'topics' => "اصول لینک‌سازی White-Hat\nGuest Posting حرفه‌ای\nDigital PR و HARO\nBroken Link Building\nتحلیل بک‌لینک رقبا\nپروژه عملی: ساخت ۵ بک‌لینک واقعی" ),
					array( 'module_number' => '۶', 'module_title' => 'سئو محلی (Local SEO)', 'module_subtitle' => 'تسلط بر Google Map و نتایج محلی', 'sessions_count' => '۳ جلسه', 'duration' => '۴ ساعت', 'level' => 'متوسط', 'topics' => "Google Business Profile\nNAP Consistency\nReview Management\nLocal Citations\nMap Pack Ranking\nپروژه عملی: بهینه‌سازی GBP" ),
					array( 'module_number' => '۷', 'module_title' => 'ابزارهای سئو', 'module_subtitle' => 'تسلط بر ابزارهای حرفه‌ای', 'sessions_count' => '۴ جلسه', 'duration' => '۵ ساعت', 'level' => 'متوسط', 'topics' => "Google Search Console\nGoogle Analytics 4\nAhrefs و Semrush\nScreaming Frog\nSurfer SEO و Clearscope\nپروژه عملی: ساخت داشبورد سئو" ),
					array( 'module_number' => '۸', 'module_title' => 'پروژه پایانی و کسب درآمد', 'module_subtitle' => 'شروع کار حرفه‌ای در دنیای سئو', 'sessions_count' => '۳ جلسه', 'duration' => '۵ ساعت', 'level' => 'پیشرفته', 'topics' => "ساخت رزومه و پورتفولیو\nقیمت‌گذاری خدمات سئو\nجذب مشتری اول\nفریلنسری vs استخدام\nارائه پروژه پایانی\nدریافت گواهی پایان دوره" ),
				),
			),
		);
	}
}
