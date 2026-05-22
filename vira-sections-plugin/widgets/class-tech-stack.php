<?php
/**
 * Vira Sections — Tech Stack Widget (Tabs + Logos Grid)
 *
 * Tabbed technology showcase with description, "suitable for" and
 * "advantages" lists, a code preview block, plus a logos grid below.
 *
 * @package ViraSections
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Vira_Sections_Widget_Tech_Stack
 */
class Vira_Sections_Widget_Tech_Stack extends \Elementor\Widget_Base {

	public function get_name() {
		return 'vira_tech_stack';
	}

	public function get_title() {
		return __( 'Tech Stack (Vira)', 'vira-sections' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return array( 'vira-sections' );
	}

	public function get_keywords() {
		return array( 'vira', 'tech', 'stack', 'logos', 'tabs', 'code' );
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
				'default' => __( 'تکنولوژی‌ها و فریم‌ورک‌ها', 'vira-sections' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'با بهترین <em>ابزار روز دنیا</em> پروژه می‌سازیم', 'vira-sections' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'برای هر پروژه، تکنولوژی متناسب با نیاز، بودجه و آینده محصول شما را پیشنهاد می‌دهیم.', 'vira-sections' ),
				'rows'    => 3,
			)
		);

		$this->add_control(
			'suitable_label',
			array(
				'label'   => __( 'Suitable Items Label', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'مناسب چه پروژه‌هایی است؟', 'vira-sections' ),
			)
		);

		$this->add_control(
			'advantages_label',
			array(
				'label'   => __( 'Advantages Label', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'مزیت‌های کلیدی', 'vira-sections' ),
			)
		);

		$this->add_control(
			'logos_title',
			array(
				'label'   => __( 'Logos Title', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'تکنولوژی‌هایی که در پروژه‌ها استفاده می‌کنیم', 'vira-sections' ),
			)
		);

		$this->add_control(
			'logos_subtitle',
			array(
				'label'   => __( 'Logos Subtitle', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'پشته فنی کامل از فرانت تا بک‌اند و دیتابیس', 'vira-sections' ),
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * Tabs Repeater
		 * ============================================================ */
		$this->start_controls_section(
			'section_tabs',
			array(
				'label' => __( 'Tech Tabs', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$rep = new \Elementor\Repeater();

		$rep->add_control(
			'tab_icon',
			array(
				'label'   => __( 'Tab Icon', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => array( 'value' => 'fas fa-code', 'library' => 'fa-solid' ),
			)
		);

		$rep->add_control(
			'tab_label',
			array(
				'label'   => __( 'Tab Label', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'تکنولوژی', 'vira-sections' ),
			)
		);

		$rep->add_control(
			'panel_icon',
			array(
				'label'   => __( 'Panel Icon', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => array( 'value' => 'fas fa-layer-group', 'library' => 'fa-solid' ),
			)
		);

		$rep->add_control(
			'panel_color',
			array(
				'label'   => __( 'Panel Icon Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#0170B9',
			)
		);

		$rep->add_control(
			'panel_title',
			array(
				'label'   => __( 'Panel Title', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'عنوان پنل', 'vira-sections' ),
			)
		);

		$rep->add_control(
			'panel_subtitle',
			array(
				'label'   => __( 'Panel Subtitle', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'توضیح کوتاه فناوری', 'vira-sections' ),
			)
		);

		$rep->add_control(
			'panel_description',
			array(
				'label'   => __( 'Panel Description', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'توضیح کامل درباره این تکنولوژی و کاربردهای آن.', 'vira-sections' ),
				'rows'    => 4,
			)
		);

		// Sub-repeater suitable.
		$suitable_sub = new \Elementor\Repeater();
		$suitable_sub->add_control(
			'item_text',
			array(
				'label'   => __( 'Item', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'یک کاربرد', 'vira-sections' ),
			)
		);
		$rep->add_control(
			'suitable_items',
			array(
				'label'       => __( 'Suitable Items', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $suitable_sub->get_controls(),
				'title_field' => '{{{ item_text }}}',
				'default'     => array(
					array( 'item_text' => __( 'مناسب اول', 'vira-sections' ) ),
					array( 'item_text' => __( 'مناسب دوم', 'vira-sections' ) ),
					array( 'item_text' => __( 'مناسب سوم', 'vira-sections' ) ),
				),
			)
		);

		$adv_sub = new \Elementor\Repeater();
		$adv_sub->add_control(
			'item_text',
			array(
				'label'   => __( 'Item', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'یک مزیت', 'vira-sections' ),
			)
		);
		$rep->add_control(
			'advantage_items',
			array(
				'label'       => __( 'Advantage Items', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $adv_sub->get_controls(),
				'title_field' => '{{{ item_text }}}',
				'default'     => array(
					array( 'item_text' => __( 'مزیت اول', 'vira-sections' ) ),
					array( 'item_text' => __( 'مزیت دوم', 'vira-sections' ) ),
					array( 'item_text' => __( 'مزیت سوم', 'vira-sections' ) ),
				),
			)
		);

		$rep->add_control(
			'code_filename',
			array(
				'label'   => __( 'Code Filename', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'main.kt',
			)
		);

		$rep->add_control(
			'code_content',
			array(
				'label'       => __( 'Code Content', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => "// Sample code\nfun main() {\n  println(\"Hello, Vira\")\n}",
				'rows'        => 8,
				'description' => __( 'Plain text code snippet shown in dark code block.', 'vira-sections' ),
			)
		);

		$this->add_control(
			'tabs',
			array(
				'label'       => __( 'Tabs', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $rep->get_controls(),
				'title_field' => '{{{ tab_label }}}',
				'default'     => array(
					array(
						'tab_label'         => __( 'Native Android', 'vira-sections' ),
						'panel_color'       => '#3DDC84',
						'panel_title'       => __( 'Native Android', 'vira-sections' ),
						'panel_subtitle'    => __( 'Kotlin · Java · Jetpack Compose', 'vira-sections' ),
						'panel_description' => __( 'برای پروژه‌هایی که بالاترین سطح کیفیت و عملکرد مدنظر است. Kotlin زبان رسمی توسعه اندروید است.', 'vira-sections' ),
						'code_filename'     => 'MainActivity.kt',
						'code_content'      => "// Jetpack Compose UI\nclass MainActivity : ComponentActivity() {\n  override fun onCreate(state: Bundle?) {\n    super.onCreate(state)\n    setContent {\n      AppTheme { Greeting(name = \"تبریز\") }\n    }\n  }\n}",
					),
					array(
						'tab_label'         => __( 'Flutter', 'vira-sections' ),
						'panel_color'       => '#0170B9',
						'panel_title'       => __( 'Flutter', 'vira-sections' ),
						'panel_subtitle'    => __( 'Dart · کراس پلتفرم گوگل', 'vira-sections' ),
						'panel_description' => __( 'یک کدبیس واحد برای Android و iOS با Performance نزدیک به Native. انتخاب ایده‌آل برای استارتاپ‌ها.', 'vira-sections' ),
						'code_filename'     => 'main.dart',
						'code_content'      => "// Flutter Widget\nclass HomeScreen extends StatelessWidget {\n  @override\n  Widget build(BuildContext ctx) {\n    return Scaffold(\n      appBar: AppBar(title: Text('اپ تبریز')),\n      body: Center(child: Greeting()),\n    );\n  }\n}",
					),
					array(
						'tab_label'         => __( 'React Native', 'vira-sections' ),
						'panel_color'       => '#A855F7',
						'panel_title'       => __( 'React Native', 'vira-sections' ),
						'panel_subtitle'    => __( 'JavaScript · TypeScript · فیسبوک', 'vira-sections' ),
						'panel_description' => __( 'انتخاب عالی برای تیم‌هایی که از قبل با React و JavaScript آشنا هستند.', 'vira-sections' ),
						'code_filename'     => 'App.tsx',
						'code_content'      => "// React Native Component\nimport { View, Text } from 'react-native';\n\nexport default function App() {\n  return (\n    <View style={styles.container}>\n      <Text>سلام تبریز</Text>\n    </View>\n  );\n}",
					),
					array(
						'tab_label'         => __( 'Backend', 'vira-sections' ),
						'panel_color'       => '#1D2327',
						'panel_title'       => __( 'Backend & APIs', 'vira-sections' ),
						'panel_subtitle'    => __( 'Node.js · Firebase · Spring Boot', 'vira-sections' ),
						'panel_description' => __( 'قدرت پشت پرده پروژه شما — از احراز هویت تا پرداخت و نوتیفیکیشن.', 'vira-sections' ),
						'code_filename'     => 'api.js',
						'code_content'      => "// Node.js + Express API\nconst express = require('express');\nconst app = express();\n\napp.get('/api/products', async (req, res) => {\n  const data = await Product.find();\n  res.json({ ok: true, data });\n});\n\napp.listen(3000);",
					),
				),
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * Logos Repeater
		 * ============================================================ */
		$this->start_controls_section(
			'section_logos',
			array(
				'label' => __( 'Logos', 'vira-sections' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$logo_rep = new \Elementor\Repeater();

		$logo_rep->add_control(
			'logo_image',
			array(
				'label' => __( 'Logo Image (optional)', 'vira-sections' ),
				'type'  => \Elementor\Controls_Manager::MEDIA,
			)
		);

		$logo_rep->add_control(
			'logo_text',
			array(
				'label'       => __( 'Logo Letter (fallback)', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'K',
				'description' => __( 'Used when no image is set.', 'vira-sections' ),
			)
		);

		$logo_rep->add_control(
			'logo_name',
			array(
				'label'   => __( 'Logo Name', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'تکنولوژی', 'vira-sections' ),
			)
		);

		$this->add_control(
			'logos',
			array(
				'label'       => __( 'Logos', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $logo_rep->get_controls(),
				'title_field' => '{{{ logo_name }}}',
				'default'     => array(
					array( 'logo_text' => 'K', 'logo_name' => 'Kotlin' ),
					array( 'logo_text' => 'J', 'logo_name' => 'Java' ),
					array( 'logo_text' => 'F', 'logo_name' => 'Flutter' ),
					array( 'logo_text' => 'R', 'logo_name' => 'React Native' ),
					array( 'logo_text' => 'N', 'logo_name' => 'Node.js' ),
					array( 'logo_text' => 'M', 'logo_name' => 'MongoDB' ),
					array( 'logo_text' => 'S', 'logo_name' => 'Spring Boot' ),
					array( 'logo_text' => 'F', 'logo_name' => 'Firebase' ),
					array( 'logo_text' => 'P', 'logo_name' => 'PostgreSQL' ),
					array( 'logo_text' => 'D', 'logo_name' => 'Docker' ),
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
			'bg_from',
			array(
				'label'   => __( 'Background Gradient 1', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
			)
		);

		$this->add_control(
			'bg_to',
			array(
				'label'   => __( 'Background Gradient 2', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#FAF6EC',
			)
		);

		$this->end_controls_section();

		/* ============================================================
		 * STYLE — Colors
		 * ============================================================ */
		$this->start_controls_section(
			'style_colors',
			array(
				'label' => __( 'Colors & Code Block', 'vira-sections' ),
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
			'grad_from',
			array(
				'label'   => __( 'Highlight Gradient 1', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#170C79',
			)
		);

		$this->add_control(
			'grad_to',
			array(
				'label'   => __( 'Highlight Gradient 2', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#128BE0',
			)
		);

		$this->add_control(
			'code_bg',
			array(
				'label'   => __( 'Code Block Background', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#0B1020',
			)
		);

		$this->add_control(
			'code_text',
			array(
				'label'   => __( 'Code Text Color', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#E2E8F0',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render frontend output.
	 */
	protected function render() {
		$settings  = $this->get_settings_for_display();
		$unique_id = 'vira-tech-' . $this->get_id();

		$pad       = ! empty( $settings['section_padding']['size'] ) ? (int) $settings['section_padding']['size'] : 110;
		$bg_from   = ! empty( $settings['bg_from'] ) ? $settings['bg_from'] : '#FFFFFF';
		$bg_to     = ! empty( $settings['bg_to'] ) ? $settings['bg_to'] : '#FAF6EC';
		$accent    = ! empty( $settings['accent_color'] ) ? $settings['accent_color'] : '#0170B9';
		$grad_from = ! empty( $settings['grad_from'] ) ? $settings['grad_from'] : '#170C79';
		$grad_to   = ! empty( $settings['grad_to'] ) ? $settings['grad_to'] : '#128BE0';
		$code_bg   = ! empty( $settings['code_bg'] ) ? $settings['code_bg'] : '#0B1020';
		$code_text = ! empty( $settings['code_text'] ) ? $settings['code_text'] : '#E2E8F0';

		$tabs  = ! empty( $settings['tabs'] ) && is_array( $settings['tabs'] ) ? $settings['tabs'] : array();
		$logos = ! empty( $settings['logos'] ) && is_array( $settings['logos'] ) ? $settings['logos'] : array();
		?>
		<style>
			#<?php echo esc_attr( $unique_id ); ?>{
				--vira-pad: <?php echo (int) $pad; ?>px;
				--vira-bg-from: <?php echo esc_attr( $bg_from ); ?>;
				--vira-bg-to: <?php echo esc_attr( $bg_to ); ?>;
				--vira-accent: <?php echo esc_attr( $accent ); ?>;
				--vira-grad-from: <?php echo esc_attr( $grad_from ); ?>;
				--vira-grad-to: <?php echo esc_attr( $grad_to ); ?>;
				--vira-code-bg: <?php echo esc_attr( $code_bg ); ?>;
				--vira-code-text: <?php echo esc_attr( $code_text ); ?>;
			}
			#<?php echo esc_attr( $unique_id ); ?>.vira-tech{
				padding:var(--vira-pad) 24px;
				background:linear-gradient(180deg,var(--vira-bg-from) 0%,var(--vira-bg-to) 100%);
				font-family:'Vazirmatn','IRANSans',Tahoma,sans-serif;direction:rtl;color:#1D2327;
				position:relative;overflow:hidden;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__inner{max-width:1240px;margin:0 auto;position:relative;z-index:1;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__head{text-align:center;margin-bottom:48px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__eyebrow{
				display:inline-flex;align-items:center;gap:8px;
				background:rgba(1,112,185,.10);color:var(--vira-accent);
				border:1px solid rgba(1,112,185,.25);
				padding:8px 16px;border-radius:999px;font-size:14px;font-weight:600;margin-bottom:16px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__eyebrow i{
				width:8px;height:8px;border-radius:50%;background:var(--vira-accent);
				box-shadow:0 0 0 4px rgba(1,112,185,.16);display:inline-block;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech h2{font-size:clamp(28px,3.4vw,46px);font-weight:800;margin:0 0 16px;line-height:1.4;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech h2 em{
				font-style:normal;
				background:linear-gradient(135deg,var(--vira-grad-from),var(--vira-grad-to));
				-webkit-background-clip:text;background-clip:text;color:transparent;-webkit-text-fill-color:transparent;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__head p{color:#64748B;font-size:18px;max-width:680px;margin:0 auto;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__tabs{
				display:flex;flex-wrap:wrap;gap:10px;justify-content:center;margin-bottom:36px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__tab{
				display:inline-flex;align-items:center;gap:10px;
				padding:12px 20px;border-radius:14px;border:1.5px solid #E2E8F0;
				background:#fff;cursor:pointer;font-family:inherit;
				font-size:14.5px;font-weight:700;color:#475569;
				transition:all .3s cubic-bezier(.4,0,.2,1);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__tab .ico{
				width:24px;height:24px;border-radius:7px;
				background:#F1F5F9;color:#64748B;
				display:grid;place-items:center;flex-shrink:0;
				transition:all .3s ease;font-size:12px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__tab:hover{border-color:var(--vira-accent);color:var(--vira-accent);transform:translateY(-2px);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__tab.is-active{
				background:linear-gradient(135deg,var(--vira-grad-from),var(--vira-grad-to));
				color:#fff;border-color:transparent;
				box-shadow:0 10px 26px rgba(1,112,185,.30);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__tab.is-active .ico{background:rgba(255,255,255,.22);color:#fff;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__panel-wrap{position:relative;min-height:420px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__panel{
				display:none;
				background:#fff;border:1px solid #E2E8F0;border-radius:24px;padding:36px;
				box-shadow:0 16px 40px rgba(15,23,42,.05);
				animation:vira-tech-fade .45s cubic-bezier(.4,0,.2,1);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__panel.is-active{display:grid;grid-template-columns:1fr 1fr;gap:34px;align-items:stretch;}
			@keyframes vira-tech-fade{from{opacity:0;transform:translateY(14px);}to{opacity:1;transform:none;}}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__info{display:flex;flex-direction:column;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__info-head{display:flex;align-items:center;gap:14px;margin-bottom:18px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__info-icon{
				width:54px;height:54px;border-radius:14px;
				color:#fff;display:grid;place-items:center;font-size:24px;
				box-shadow:0 10px 24px rgba(1,112,185,.30);flex-shrink:0;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__info h3{font-size:22px;font-weight:800;margin:0;color:#1D2327;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__info-sub{font-size:13.5px;color:#94A3B8;margin-top:2px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__desc{font-size:15px;line-height:2;color:#475569;margin:0 0 22px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__lists{display:grid;gap:18px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__list-title{
				display:flex;align-items:center;gap:8px;
				font-size:13px;font-weight:800;color:#1D2327;
				text-transform:uppercase;letter-spacing:.5px;margin:0 0 10px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__list-title svg{color:var(--vira-accent);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__list-title.purple svg{color:var(--vira-grad-from);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__list ul{list-style:none;padding:0;margin:0;display:grid;gap:8px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__list li{
				display:flex;align-items:flex-start;gap:9px;
				font-size:14px;color:#475569;line-height:1.7;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__list li svg{flex-shrink:0;margin-top:4px;color:var(--vira-accent);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__list.purple li svg{color:var(--vira-grad-from);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__code{
				background:var(--vira-code-bg);border-radius:18px;overflow:hidden;
				border:1px solid #1E2640;
				display:flex;flex-direction:column;
				font-family:'JetBrains Mono','Fira Code',monospace;direction:ltr;
				box-shadow:inset 0 0 0 1px rgba(255,255,255,.04),0 12px 28px rgba(15,23,42,.20);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__code-bar{
				display:flex;align-items:center;gap:6px;
				padding:12px 16px;background:rgba(0,0,0,.30);border-bottom:1px solid #1E2640;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__code-bar .dot{width:11px;height:11px;border-radius:50%;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__code-bar .dot.r{background:#FF5F57;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__code-bar .dot.y{background:#FEBC2E;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__code-bar .dot.g{background:#28C840;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__code-bar .file{
				margin-left:auto;font-size:11.5px;color:#94A3B8;
				background:rgba(255,255,255,.05);padding:4px 10px;border-radius:6px;
				border:1px solid rgba(255,255,255,.08);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__code pre{
				margin:0;padding:18px 20px;font-size:13px;line-height:1.85;
				color:var(--vira-code-text);flex:1;overflow:auto;white-space:pre;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__logos{
				margin-top:60px;
				background:#fff;border:1px solid #E2E8F0;border-radius:24px;padding:36px;
				box-shadow:0 12px 32px rgba(15,23,42,.04);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__logos-head{text-align:center;margin-bottom:26px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__logos-head h4{font-size:18px;font-weight:800;margin:0 0 6px;color:#1D2327;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__logos-head p{color:#94A3B8;font-size:14px;margin:0;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__logos-grid{
				display:grid;grid-template-columns:repeat(auto-fit,minmax(118px,1fr));gap:12px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__logo{
				display:flex;flex-direction:column;align-items:center;gap:8px;
				padding:18px 10px;border-radius:14px;
				background:#F8FAFC;border:1.5px solid #E2E8F0;
				transition:all .35s cubic-bezier(.4,0,.2,1);cursor:default;
				position:relative;overflow:hidden;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__logo:hover{
				transform:translateY(-4px);
				border-color:var(--vira-accent);
				box-shadow:0 14px 30px rgba(1,112,185,.16);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__logo img{width:36px;height:36px;object-fit:contain;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__logo .placeholder{
				width:36px;height:36px;display:grid;place-items:center;
				background:linear-gradient(135deg,var(--vira-grad-from),var(--vira-grad-to));
				color:#fff;font-weight:900;border-radius:10px;font-size:18px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-tech__logo span{
				font-size:12.5px;font-weight:700;color:#475569;text-align:center;
			}
			@media(max-width:880px){
				#<?php echo esc_attr( $unique_id ); ?> .vira-tech__panel.is-active{grid-template-columns:1fr;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-tech__panel{padding:24px;}
			}
			@media(max-width:560px){
				#<?php echo esc_attr( $unique_id ); ?> .vira-tech__tab{padding:10px 14px;font-size:13px;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-tech__logos{padding:22px;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-tech__logos-grid{grid-template-columns:repeat(3,1fr);}
			}
		</style>

		<section id="<?php echo esc_attr( $unique_id ); ?>" class="vira-tech" data-vira-tech>
			<div class="vira-tech__inner">
				<div class="vira-tech__head">
					<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
						<span class="vira-tech__eyebrow"><i></i><?php echo esc_html( $settings['eyebrow'] ); ?></span>
					<?php endif; ?>
					<?php if ( ! empty( $settings['heading'] ) ) : ?>
						<h2><?php echo wp_kses_post( $settings['heading'] ); ?></h2>
					<?php endif; ?>
					<?php if ( ! empty( $settings['description'] ) ) : ?>
						<p><?php echo esc_html( $settings['description'] ); ?></p>
					<?php endif; ?>
				</div>

				<div class="vira-tech__tabs" role="tablist">
					<?php foreach ( $tabs as $i => $tab ) : ?>
						<button type="button" class="vira-tech__tab<?php echo 0 === $i ? ' is-active' : ''; ?>" data-tab="<?php echo (int) $i; ?>">
							<span class="ico">
								<?php if ( ! empty( $tab['tab_icon'] ) ) : ?>
									<?php \Elementor\Icons_Manager::render_icon( $tab['tab_icon'], array( 'aria-hidden' => 'true' ) ); ?>
								<?php endif; ?>
							</span>
							<?php echo esc_html( $tab['tab_label'] ); ?>
						</button>
					<?php endforeach; ?>
				</div>

				<div class="vira-tech__panel-wrap">
					<?php foreach ( $tabs as $i => $tab ) :
						$suitable = ! empty( $tab['suitable_items'] ) && is_array( $tab['suitable_items'] ) ? $tab['suitable_items'] : array();
						$advs     = ! empty( $tab['advantage_items'] ) && is_array( $tab['advantage_items'] ) ? $tab['advantage_items'] : array();
						$pcolor   = ! empty( $tab['panel_color'] ) ? $tab['panel_color'] : $accent;
						?>
						<div class="vira-tech__panel<?php echo 0 === $i ? ' is-active' : ''; ?>" data-panel="<?php echo (int) $i; ?>">
							<div class="vira-tech__info">
								<div class="vira-tech__info-head">
									<div class="vira-tech__info-icon" style="background:linear-gradient(135deg,<?php echo esc_attr( $pcolor ); ?>,<?php echo esc_attr( $grad_to ); ?>);">
										<?php if ( ! empty( $tab['panel_icon'] ) ) : ?>
											<?php \Elementor\Icons_Manager::render_icon( $tab['panel_icon'], array( 'aria-hidden' => 'true' ) ); ?>
										<?php endif; ?>
									</div>
									<div>
										<h3><?php echo esc_html( $tab['panel_title'] ); ?></h3>
										<?php if ( ! empty( $tab['panel_subtitle'] ) ) : ?>
											<div class="vira-tech__info-sub"><?php echo esc_html( $tab['panel_subtitle'] ); ?></div>
										<?php endif; ?>
									</div>
								</div>
								<?php if ( ! empty( $tab['panel_description'] ) ) : ?>
									<p class="vira-tech__desc"><?php echo esc_html( $tab['panel_description'] ); ?></p>
								<?php endif; ?>
								<div class="vira-tech__lists">
									<?php if ( ! empty( $suitable ) ) : ?>
										<div class="vira-tech__list">
											<div class="vira-tech__list-title">
												<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
												<?php echo esc_html( $settings['suitable_label'] ); ?>
											</div>
											<ul>
												<?php foreach ( $suitable as $it ) : ?>
													<?php if ( ! empty( $it['item_text'] ) ) : ?>
														<li>
															<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
															<?php echo esc_html( $it['item_text'] ); ?>
														</li>
													<?php endif; ?>
												<?php endforeach; ?>
											</ul>
										</div>
									<?php endif; ?>
									<?php if ( ! empty( $advs ) ) : ?>
										<div class="vira-tech__list purple">
											<div class="vira-tech__list-title purple">
												<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" stroke-linejoin="round"/></svg>
												<?php echo esc_html( $settings['advantages_label'] ); ?>
											</div>
											<ul>
												<?php foreach ( $advs as $it ) : ?>
													<?php if ( ! empty( $it['item_text'] ) ) : ?>
														<li>
															<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
															<?php echo esc_html( $it['item_text'] ); ?>
														</li>
													<?php endif; ?>
												<?php endforeach; ?>
											</ul>
										</div>
									<?php endif; ?>
								</div>
							</div>

							<div class="vira-tech__code">
								<div class="vira-tech__code-bar">
									<span class="dot r"></span><span class="dot y"></span><span class="dot g"></span>
									<?php if ( ! empty( $tab['code_filename'] ) ) : ?>
										<span class="file"><?php echo esc_html( $tab['code_filename'] ); ?></span>
									<?php endif; ?>
								</div>
<pre><?php echo esc_html( $tab['code_content'] ); ?></pre>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

				<?php if ( ! empty( $logos ) ) : ?>
					<div class="vira-tech__logos">
						<div class="vira-tech__logos-head">
							<?php if ( ! empty( $settings['logos_title'] ) ) : ?>
								<h4><?php echo esc_html( $settings['logos_title'] ); ?></h4>
							<?php endif; ?>
							<?php if ( ! empty( $settings['logos_subtitle'] ) ) : ?>
								<p><?php echo esc_html( $settings['logos_subtitle'] ); ?></p>
							<?php endif; ?>
						</div>
						<div class="vira-tech__logos-grid">
							<?php foreach ( $logos as $logo ) :
								$has_image = ! empty( $logo['logo_image']['url'] );
								?>
								<div class="vira-tech__logo">
									<?php if ( $has_image ) : ?>
										<img src="<?php echo esc_url( $logo['logo_image']['url'] ); ?>" alt="<?php echo esc_attr( $logo['logo_name'] ); ?>" />
									<?php else : ?>
										<div class="placeholder"><?php echo esc_html( $logo['logo_text'] ); ?></div>
									<?php endif; ?>
									<span><?php echo esc_html( $logo['logo_name'] ); ?></span>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</section>

		<script>
		(function(){
			var root = document.getElementById('<?php echo esc_js( $unique_id ); ?>');
			if (!root) return;
			var tabs = root.querySelectorAll('.vira-tech__tab');
			var panels = root.querySelectorAll('.vira-tech__panel');
			tabs.forEach(function(t,i){
				t.addEventListener('click', function(){
					tabs.forEach(function(x){ x.classList.remove('is-active'); });
					t.classList.add('is-active');
					panels.forEach(function(p,j){ p.classList.toggle('is-active', i===j); });
				});
			});
		})();
		</script>
		<?php
	}
}
