<?php
/**
 * Vira Sections — CTA Form Widget
 *
 * Final CTA section with glass-morphism contact form, animated success
 * state, online badge and configurable form fields.
 *
 * @package ViraSections
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Vira_Sections_Widget_Cta_Form extends \Elementor\Widget_Base {

	use Vira_Sections_Preset_Trait;

	public function get_name() { return 'vira_cta_form'; }
	public function get_title() { return __( 'CTA Form (Vira)', 'vira-sections' ); }
	public function get_icon() { return 'eicon-form-horizontal'; }
	public function get_categories() { return array( 'vira-sections' ); }
	public function get_keywords() { return array( 'vira', 'cta', 'form', 'contact', 'lead' ); }

	protected function register_controls() {

		$this->register_preset_control();

		/* ============= Content: Left Side ============= */
		$this->start_controls_section(
			'section_left',
			array( 'label' => __( 'Left Content', 'vira-sections' ), 'tab' => \Elementor\Controls_Manager::TAB_CONTENT )
		);

		$this->add_control(
			'badge_text',
			array( 'label' => __( 'Online Badge Text', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __( 'کارشناسان آنلاین — آماده پاسخگویی', 'vira-sections' ) )
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => __( "آماده‌ای ایده <em>پروژه‌ت</em>\nرو واقعی کنی؟", 'vira-sections' ),
				'rows'        => 3,
				'description' => __( 'Wrap highlighted parts in &lt;em&gt;...&lt;/em&gt; for gradient. Newlines supported.', 'vira-sections' ),
			)
		);

		$this->register_tag_control( 'heading_tag', __( 'Heading HTML Tag (SEO)', 'vira-sections' ), 'h2' );

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'همین حالا فرم رو پر کن تا یه جلسه مشاوره رایگان ۳۰ دقیقه‌ای با کارشناس ما داشته باشی. بدون تعهد، بدون فشار فروش.', 'vira-sections' ),
				'rows'    => 4,
			)
		);

		$rep_feat = new \Elementor\Repeater();
		$rep_feat->add_control(
			'feat_text',
			array( 'label' => __( 'Feature', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __( 'مشاوره رایگان', 'vira-sections' ) )
		);

		$this->add_control(
			'features',
			array(
				'label'       => __( 'Features List', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $rep_feat->get_controls(),
				'title_field' => '{{{ feat_text }}}',
				'default'     => array(
					array( 'feat_text' => __( 'مشاوره رایگان فنی', 'vira-sections' ) ),
					array( 'feat_text' => __( 'تخمین زمان دقیق', 'vira-sections' ) ),
					array( 'feat_text' => __( 'پیشنهاد راهکار مناسب', 'vira-sections' ) ),
					array( 'feat_text' => __( 'بدون تعهد و بدون فشار فروش', 'vira-sections' ) ),
				),
			)
		);

		$this->end_controls_section();

		/* ============= Content: Form ============= */
		$this->start_controls_section(
			'section_form',
			array( 'label' => __( 'Form', 'vira-sections' ), 'tab' => \Elementor\Controls_Manager::TAB_CONTENT )
		);

		$this->add_control(
			'form_action',
			array(
				'label'       => __( 'Form Action URL', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => '',
				'description' => __( 'URL where form data is sent. Leave empty to just show success message.', 'vira-sections' ),
				'placeholder' => 'https://yoursite.com/handle-form.php',
			)
		);

		$this->add_control(
			'show_name',
			array( 'label' => __( 'Show Name Field', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => 'yes', 'return_value' => 'yes' )
		);
		$this->add_control(
			'name_label',
			array( 'label' => __( 'Name Label', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __( 'نام و نام خانوادگی', 'vira-sections' ) )
		);

		$this->add_control(
			'show_phone',
			array( 'label' => __( 'Show Phone Field', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => 'yes', 'return_value' => 'yes' )
		);
		$this->add_control(
			'phone_label',
			array( 'label' => __( 'Phone Label', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __( 'شماره تماس', 'vira-sections' ) )
		);

		$this->add_control(
			'show_email',
			array( 'label' => __( 'Show Email Field', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => 'yes', 'return_value' => 'yes' )
		);
		$this->add_control(
			'email_label',
			array( 'label' => __( 'Email Label', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __( 'ایمیل', 'vira-sections' ) )
		);

		$this->add_control(
			'show_select',
			array( 'label' => __( 'Show Select Field', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => 'yes', 'return_value' => 'yes' )
		);
		$this->add_control(
			'select_label',
			array( 'label' => __( 'Select Label', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __( 'علاقه‌مند به', 'vira-sections' ) )
		);

		$rep_opt = new \Elementor\Repeater();
		$rep_opt->add_control(
			'opt_text',
			array( 'label' => __( 'Option Text', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __( 'گزینه', 'vira-sections' ) )
		);
		$this->add_control(
			'select_options',
			array(
				'label'       => __( 'Select Options', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $rep_opt->get_controls(),
				'title_field' => '{{{ opt_text }}}',
				'default'     => array(
					array( 'opt_text' => __( 'طراحی سایت', 'vira-sections' ) ),
					array( 'opt_text' => __( 'ساخت اپلیکیشن', 'vira-sections' ) ),
					array( 'opt_text' => __( 'سئو و دیجیتال مارکتینگ', 'vira-sections' ) ),
					array( 'opt_text' => __( 'مشاوره', 'vira-sections' ) ),
					array( 'opt_text' => __( 'سایر موارد', 'vira-sections' ) ),
				),
			)
		);

		$this->add_control(
			'show_message',
			array( 'label' => __( 'Show Message Field', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => 'yes', 'return_value' => 'yes' )
		);
		$this->add_control(
			'message_label',
			array( 'label' => __( 'Message Label', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __( 'توضیحات (اختیاری)', 'vira-sections' ) )
		);

		$this->add_control(
			'submit_text',
			array( 'label' => __( 'Submit Button Text', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __( 'دریافت مشاوره رایگان', 'vira-sections' ) )
		);

		$this->add_control(
			'success_title',
			array( 'label' => __( 'Success Title', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __( 'درخواست شما ثبت شد!', 'vira-sections' ) )
		);

		$this->register_tag_control( 'success_title_tag', __( 'Success Title HTML Tag (SEO)', 'vira-sections' ), 'h3' );
		$this->add_control(
			'success_text',
			array( 'label' => __( 'Success Text', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => __( 'کارشناس ما در کمتر از ۲ ساعت کاری برای هماهنگی با شما تماس می‌گیرد.', 'vira-sections' ), 'rows' => 3 )
		);

		$this->add_control(
			'online_text',
			array( 'label' => __( 'Online Badge (Below Form)', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __( 'کارشناسان آنلاین — پاسخ‌گویی سریع', 'vira-sections' ) )
		);

		$this->end_controls_section();

		/* ============= Style ============= */
		$this->start_controls_section(
			'style_section',
			array( 'label' => __( 'Section', 'vira-sections' ), 'tab' => \Elementor\Controls_Manager::TAB_STYLE )
		);

		$this->add_control(
			'section_padding',
			array(
				'label'      => __( 'Padding', 'vira-sections' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array( 'px' => array( 'min' => 60, 'max' => 200 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 110 ),
			)
		);

		$this->add_control(
			'bg_color',
			array( 'label' => __( 'Background Color', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::COLOR, 'default' => '#060832' )
		);

		$this->add_control(
			'glow_1',
			array( 'label' => __( 'Background Glow 1', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::COLOR, 'default' => '#128BE0' )
		);

		$this->add_control(
			'glow_2',
			array( 'label' => __( 'Background Glow 2', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::COLOR, 'default' => '#170C79' )
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_colors',
			array( 'label' => __( 'Colors', 'vira-sections' ), 'tab' => \Elementor\Controls_Manager::TAB_STYLE )
		);

		$this->add_control(
			'accent_color',
			array( 'label' => __( 'Accent Color', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::COLOR, 'default' => '#128BE0' )
		);

		$this->add_control(
			'btn_grad_from',
			array( 'label' => __( 'Button Gradient 1', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::COLOR, 'default' => '#128BE0' )
		);

		$this->add_control(
			'btn_grad_to',
			array( 'label' => __( 'Button Gradient 2', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::COLOR, 'default' => '#170C79' )
		);

		$this->end_controls_section();
	}

	protected function render() {
		$s         = $this->get_settings_for_display();
		$unique_id = 'vira-cta-' . $this->get_id();

		$pad      = ! empty( $s['section_padding']['size'] ) ? (int) $s['section_padding']['size'] : 110;
		$bg       = ! empty( $s['bg_color'] ) ? $s['bg_color'] : '#060832';
		$glow_1   = ! empty( $s['glow_1'] ) ? $s['glow_1'] : '#128BE0';
		$glow_2   = ! empty( $s['glow_2'] ) ? $s['glow_2'] : '#170C79';
		$accent   = ! empty( $s['accent_color'] ) ? $s['accent_color'] : '#128BE0';
		$btn_from = ! empty( $s['btn_grad_from'] ) ? $s['btn_grad_from'] : '#128BE0';
		$btn_to   = ! empty( $s['btn_grad_to'] ) ? $s['btn_grad_to'] : '#170C79';

		$features = ! empty( $s['features'] ) ? $s['features'] : array();
		$options  = ! empty( $s['select_options'] ) ? $s['select_options'] : array();
		$action   = ! empty( $s['form_action'] ) ? $s['form_action'] : '';
		?>
		<style>
			#<?php echo esc_attr( $unique_id ); ?>{
				--vira-pad: <?php echo (int) $pad; ?>px;
				--vira-bg: <?php echo esc_attr( $bg ); ?>;
				--vira-glow-1: <?php echo esc_attr( $glow_1 ); ?>;
				--vira-glow-2: <?php echo esc_attr( $glow_2 ); ?>;
				--vira-accent: <?php echo esc_attr( $accent ); ?>;
				--vira-btn-from: <?php echo esc_attr( $btn_from ); ?>;
				--vira-btn-to: <?php echo esc_attr( $btn_to ); ?>;
			}
			#<?php echo esc_attr( $unique_id ); ?>.vira-cta{
				padding:var(--vira-pad) 24px;background:var(--vira-bg);
				font-family:'Vazirmatn','IRANSans',Tahoma,sans-serif;direction:rtl;color:#fff;
				position:relative;overflow:hidden;
			}
			#<?php echo esc_attr( $unique_id ); ?>.vira-cta::before{
				content:"";position:absolute;top:18%;left:5%;width:46vw;height:46vw;
				background:radial-gradient(circle,color-mix(in srgb, var(--vira-glow-1) 22%, transparent),transparent 60%);
				border-radius:50%;filter:blur(80px);pointer-events:none;
			}
			#<?php echo esc_attr( $unique_id ); ?>.vira-cta::after{
				content:"";position:absolute;bottom:10%;right:5%;width:42vw;height:42vw;
				background:radial-gradient(circle,color-mix(in srgb, var(--vira-glow-2) 22%, transparent),transparent 60%);
				border-radius:50%;filter:blur(80px);pointer-events:none;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__inner{max-width:1240px;margin:0 auto;position:relative;z-index:1;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__grid{display:grid;grid-template-columns:1fr 1fr;gap:64px;align-items:center;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__badge{
				display:inline-flex;align-items:center;gap:8px;
				background:rgba(18,139,224,.16);color:var(--vira-accent);
				border:1px solid rgba(18,139,224,.40);
				padding:8px 14px;border-radius:999px;font-size:13px;font-weight:600;margin-bottom:24px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__badge .dot{
				width:8px;height:8px;border-radius:50%;background:var(--vira-accent);
				animation:vira-cta-blink 2s ease infinite;
			}
			@keyframes vira-cta-blink{0%,100%{opacity:1;}50%{opacity:.3;}}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta h2, #<?php echo esc_attr( $unique_id ); ?> .vira-cta__title{
				font-size:clamp(28px,3.4vw,44px);font-weight:900;
				line-height:1.4;margin:0 0 20px;color:#fff;white-space:pre-line;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta h2 em, #<?php echo esc_attr( $unique_id ); ?> .vira-cta__title em{
				font-style:normal;
				background:linear-gradient(135deg,var(--vira-btn-from),var(--vira-btn-to));
				-webkit-background-clip:text;background-clip:text;color:transparent;
				-webkit-text-fill-color:transparent;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__desc{
				font-size:17px;line-height:2;color:rgba(255,255,255,.72);margin:0 0 32px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__features{list-style:none;padding:0;margin:0;display:grid;gap:14px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__features li{
				display:flex;align-items:center;gap:12px;font-size:15px;color:rgba(255,255,255,.88);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__features li .check{
				width:30px;height:30px;border-radius:9px;
				background:rgba(18,139,224,.16);color:var(--vira-accent);
				display:grid;place-items:center;flex-shrink:0;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__form-wrap{
				background:rgba(255,255,255,.05);
				backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);
				border:1px solid rgba(255,255,255,.10);
				border-radius:28px;padding:40px;position:relative;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__form-wrap::before{
				content:"";position:absolute;top:0;left:0;right:0;height:3px;
				background:linear-gradient(90deg,var(--vira-btn-from),var(--vira-btn-to),transparent);
				border-radius:28px 28px 0 0;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__form{display:grid;gap:16px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__field{display:flex;flex-direction:column;gap:6px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__field label{font-size:13px;font-weight:600;color:rgba(255,255,255,.72);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__field input,
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__field select,
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__field textarea{
				padding:13px 16px;border-radius:12px;
				background:rgba(255,255,255,.06);border:1.5px solid rgba(255,255,255,.12);
				color:#fff;font-family:inherit;font-size:15px;
				transition:all .3s ease;outline:none;width:100%;resize:none;box-sizing:border-box;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__field textarea{min-height:90px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__field input::placeholder,
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__field textarea::placeholder{color:rgba(255,255,255,.35);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__field input:focus,
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__field select:focus,
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__field textarea:focus{
				border-color:var(--vira-accent);background:rgba(255,255,255,.08);
				box-shadow:0 0 0 4px color-mix(in srgb, var(--vira-accent) 16%, transparent);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__field select{
				appearance:none;cursor:pointer;
				background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
				background-repeat:no-repeat;background-position:left 14px center;padding-left:42px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__field select option{background:#1D2327;color:#fff;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__submit{
				width:100%;padding:18px;border:none;border-radius:14px;
				background:linear-gradient(135deg,var(--vira-btn-from),var(--vira-btn-to));
				color:#fff;font-family:inherit;font-size:17px;font-weight:800;
				cursor:pointer;transition:all .3s ease;
				box-shadow:0 14px 32px rgba(18,139,224,.30);
				display:inline-flex;align-items:center;justify-content:center;gap:8px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__submit:hover{
				transform:translateY(-2px);box-shadow:0 18px 42px rgba(18,139,224,.45);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__online{
				display:flex;align-items:center;justify-content:center;gap:8px;
				margin-top:18px;font-size:13px;color:rgba(255,255,255,.55);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__online .pulse{
				width:8px;height:8px;border-radius:50%;background:var(--vira-accent);position:relative;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__online .pulse::before{
				content:"";position:absolute;inset:-4px;border-radius:50%;
				border:2px solid color-mix(in srgb, var(--vira-accent) 55%, transparent);
				animation:vira-cta-pulse 2s ease-out infinite;
			}
			@keyframes vira-cta-pulse{0%{transform:scale(1);opacity:1;}100%{transform:scale(2);opacity:0;}}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__success{display:none;text-align:center;padding:30px 20px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__success.is-visible{display:block;animation:vira-cta-fade .5s ease;}
			@keyframes vira-cta-fade{from{opacity:0;transform:translateY(20px);}to{opacity:1;transform:none;}}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__success-icon{
				width:80px;height:80px;border-radius:50%;margin:0 auto 22px;
				background:linear-gradient(135deg,var(--vira-btn-from),var(--vira-btn-to));
				display:grid;place-items:center;
				box-shadow:0 14px 36px rgba(18,139,224,.40);
				animation:vira-cta-pop .5s cubic-bezier(.34,1.56,.64,1);
			}
			@keyframes vira-cta-pop{0%{transform:scale(0) rotate(-90deg);}100%{transform:scale(1) rotate(0);}}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__success h3, #<?php echo esc_attr( $unique_id ); ?> .vira-cta__success-title{font-size:22px;font-weight:800;margin:0 0 8px;color:#fff;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__success p{color:rgba(255,255,255,.65);font-size:15px;margin:0;line-height:1.8;}
			@media(max-width:980px){#<?php echo esc_attr( $unique_id ); ?> .vira-cta__grid{grid-template-columns:1fr;gap:48px;}}
			@media(max-width:560px){#<?php echo esc_attr( $unique_id ); ?> .vira-cta__form-wrap{padding:24px;}}
			/* Field focus animated border gradient */
			@keyframes vira-cta-border-glow{
				0%{box-shadow:0 0 0 4px rgba(18,139,224,.12),0 0 20px rgba(18,139,224,.08);}
				50%{box-shadow:0 0 0 6px rgba(18,139,224,.20),0 0 28px rgba(18,139,224,.14);}
				100%{box-shadow:0 0 0 4px rgba(18,139,224,.12),0 0 20px rgba(18,139,224,.08);}
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__field input:focus,
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__field select:focus,
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__field textarea:focus{
				animation:vira-cta-border-glow 2s ease-in-out infinite;
			}
			/* Submit button idle shimmer */
			@keyframes vira-cta-shimmer{
				0%{background-position:200% center;}
				100%{background-position:-200% center;}
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__submit{
				background-size:200% 100%;
				background-image:linear-gradient(90deg,var(--vira-btn-from) 0%,var(--vira-btn-to) 30%,rgba(255,255,255,.25) 50%,var(--vira-btn-to) 70%,var(--vira-btn-from) 100%);
				animation:vira-cta-shimmer 4s linear infinite;
			}
			/* Submit button loading state */
			@keyframes vira-cta-spin{0%{transform:rotate(0deg);}100%{transform:rotate(360deg);}}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__submit.is-loading{
				pointer-events:none;opacity:.8;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__submit.is-loading .vira-cta__spinner{
				display:inline-block;width:20px;height:20px;
				border:3px solid rgba(255,255,255,.3);border-top-color:#fff;
				border-radius:50%;animation:vira-cta-spin .7s linear infinite;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__spinner{display:none;}
			/* Submit button success state */
			@keyframes vira-cta-check-draw{
				0%{stroke-dashoffset:24;}
				100%{stroke-dashoffset:0;}
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__submit.is-success{
				background:linear-gradient(135deg,#10B981,#059669);
				animation:none;pointer-events:none;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__submit.is-success .vira-cta__check{
				display:inline-block;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__submit.is-success .vira-cta__check svg path{
				stroke-dasharray:24;stroke-dashoffset:0;
				animation:vira-cta-check-draw .4s ease-out;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__check{display:none;}
			/* Glass-morphism depth enhancement */
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__form-wrap{
				background:linear-gradient(135deg,rgba(255,255,255,.07),rgba(255,255,255,.03));
				backdrop-filter:blur(24px);-webkit-backdrop-filter:blur(24px);
				box-shadow:0 32px 80px rgba(0,0,0,.2),inset 0 1px 0 rgba(255,255,255,.1);
			}
			/* Form card entrance animation */
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__form-wrap.vira-entrance{
				opacity:0;transform:translateY(40px) scale(0.96);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__form-wrap.vira-entrance-in{
				opacity:1;transform:translateY(0) scale(1);
				transition:opacity .7s cubic-bezier(.4,0,.2,1),transform .7s cubic-bezier(.4,0,.2,1);
			}
			/* Content entrance animation */
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__content.vira-entrance{
				opacity:0;transform:translateY(30px);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-cta__content.vira-entrance-in{
				opacity:1;transform:translateY(0);
				transition:opacity .6s cubic-bezier(.4,0,.2,1),transform .6s cubic-bezier(.4,0,.2,1);
			}
			/* Reduced motion support */
			@media(prefers-reduced-motion: reduce){
				#<?php echo esc_attr( $unique_id ); ?> .vira-cta__submit{animation:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-cta__field input:focus,
				#<?php echo esc_attr( $unique_id ); ?> .vira-cta__field select:focus,
				#<?php echo esc_attr( $unique_id ); ?> .vira-cta__field textarea:focus{animation:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-cta__form-wrap.vira-entrance{opacity:1;transform:none;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-cta__form-wrap.vira-entrance-in{transition:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-cta__content.vira-entrance{opacity:1;transform:none;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-cta__content.vira-entrance-in{transition:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-cta__submit.is-loading .vira-cta__spinner{animation:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-cta__badge .dot{animation:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-cta__online .pulse::before{animation:none !important;}
			}
		</style>

		<section id="<?php echo esc_attr( $unique_id ); ?>" class="vira-cta" data-vira-cta>
			<div class="vira-cta__inner">
				<div class="vira-cta__grid">
					<div class="vira-cta__content">
						<?php if ( ! empty( $s['badge_text'] ) ) : ?>
							<div class="vira-cta__badge">
								<span class="dot"></span>
								<span><?php echo esc_html( $s['badge_text'] ); ?></span>
							</div>
						<?php endif; ?>
						<?php $cta_heading_tag = $this->vira_safe_tag( isset( $s['heading_tag'] ) ? $s['heading_tag'] : 'h2', 'h2' ); ?>
						<<?php echo $cta_heading_tag; ?> class="vira-cta__title"><?php echo wp_kses_post( nl2br( $s['heading'] ) ); ?></<?php echo $cta_heading_tag; ?>>
						<?php if ( ! empty( $s['description'] ) ) : ?>
							<p class="vira-cta__desc"><?php echo esc_html( $s['description'] ); ?></p>
						<?php endif; ?>
						<?php if ( ! empty( $features ) ) : ?>
							<ul class="vira-cta__features">
								<?php foreach ( $features as $f ) : ?>
									<li>
										<span class="check"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
										<?php echo esc_html( $f['feat_text'] ); ?>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>

					<div class="vira-cta__form-wrap">
						<form class="vira-cta__form" data-vira-form<?php if ( $action ) : ?> action="<?php echo esc_url( $action ); ?>" method="POST"<?php endif; ?>>
							<?php if ( 'yes' === $s['show_name'] ) : ?>
								<div class="vira-cta__field">
									<label><?php echo esc_html( $s['name_label'] ); ?></label>
									<input type="text" name="vira_name" placeholder="<?php esc_attr_e( 'مثلاً: علی محمدی', 'vira-sections' ); ?>" required />
								</div>
							<?php endif; ?>
							<?php if ( 'yes' === $s['show_phone'] ) : ?>
								<div class="vira-cta__field">
									<label><?php echo esc_html( $s['phone_label'] ); ?></label>
									<input type="tel" name="vira_phone" placeholder="۰۹۱۲۳۴۵۶۷۸۹" required dir="ltr" />
								</div>
							<?php endif; ?>
							<?php if ( 'yes' === $s['show_email'] ) : ?>
								<div class="vira-cta__field">
									<label><?php echo esc_html( $s['email_label'] ); ?></label>
									<input type="email" name="vira_email" placeholder="you@example.com" dir="ltr" />
								</div>
							<?php endif; ?>
							<?php if ( 'yes' === $s['show_select'] && ! empty( $options ) ) : ?>
								<div class="vira-cta__field">
									<label><?php echo esc_html( $s['select_label'] ); ?></label>
									<select name="vira_select" required>
										<option value="" disabled selected><?php esc_html_e( 'یک گزینه را انتخاب کنید...', 'vira-sections' ); ?></option>
										<?php foreach ( $options as $opt ) : ?>
											<option value="<?php echo esc_attr( $opt['opt_text'] ); ?>"><?php echo esc_html( $opt['opt_text'] ); ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							<?php endif; ?>
							<?php if ( 'yes' === $s['show_message'] ) : ?>
								<div class="vira-cta__field">
									<label><?php echo esc_html( $s['message_label'] ); ?></label>
									<textarea name="vira_message" rows="3"></textarea>
								</div>
							<?php endif; ?>
							<button type="submit" class="vira-cta__submit">
								<span class="vira-cta__btn-text"><?php echo esc_html( $s['submit_text'] ); ?></span>
								<span class="vira-cta__spinner"></span>
								<span class="vira-cta__check"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
								<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/></svg>
							</button>
						</form>

						<div class="vira-cta__success" data-vira-success>
							<div class="vira-cta__success-icon">
								<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3.5"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
							</div>
							<?php $cta_success_tag = $this->vira_safe_tag( isset( $s['success_title_tag'] ) ? $s['success_title_tag'] : 'h3', 'h3' ); ?>
							<<?php echo $cta_success_tag; ?> class="vira-cta__success-title"><?php echo esc_html( $s['success_title'] ); ?></<?php echo $cta_success_tag; ?>>
							<p><?php echo esc_html( $s['success_text'] ); ?></p>
						</div>

						<?php if ( ! empty( $s['online_text'] ) ) : ?>
							<div class="vira-cta__online">
								<span class="pulse"></span>
								<span><?php echo esc_html( $s['online_text'] ); ?></span>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>

		<?php if ( empty( $action ) ) : ?>
		<script>
		(function(){
			var section = document.getElementById('<?php echo esc_js( $unique_id ); ?>');
			if (!section) return;
			var form = section.querySelector('[data-vira-form]');
			var success = section.querySelector('[data-vira-success]');
			var submit = section.querySelector('.vira-cta__submit');
			if (!form) return;

			// Inject hidden honeypot field (anti-spam) once.
			if (!form.querySelector('input[name="vira_hp"]')) {
				var hp = document.createElement('input');
				hp.type = 'text';
				hp.name = 'vira_hp';
				hp.tabIndex = -1;
				hp.autocomplete = 'off';
				hp.style.cssText = 'position:absolute;left:-9999px;top:-9999px;height:0;width:0;opacity:0;';
				hp.setAttribute('aria-hidden', 'true');
				form.appendChild(hp);
			}

			function setButtonState(state){
				if (!submit) return;
				submit.classList.remove('is-loading','is-success');
				var btnText = submit.querySelector('.vira-cta__btn-text');
				if (state === 'loading') {
					submit.classList.add('is-loading');
					if (btnText) btnText.style.display = 'none';
				} else if (state === 'success') {
					submit.classList.add('is-success');
					if (btnText) btnText.style.display = 'none';
				} else {
					if (btnText) btnText.style.display = '';
				}
			}

			function showError(msg){
				var existing = form.querySelector('.vira-cta__error');
				if (existing) existing.remove();
				var div = document.createElement('div');
				div.className = 'vira-cta__error';
				div.style.cssText = 'background:rgba(220,38,38,.15);color:#fecaca;border:1px solid rgba(220,38,38,.40);padding:12px 16px;border-radius:10px;margin-top:12px;font-size:14px;';
				div.textContent = msg;
				form.appendChild(div);
			}

			form.addEventListener('submit', function(e){
				e.preventDefault();
				var existing = form.querySelector('.vira-cta__error');
				if (existing) existing.remove();

				// If global Vira AJAX object isn't available, fall back to local-only success state.
				if (typeof window.ViraSectionsForm === 'undefined' || !window.ViraSectionsForm.ajaxurl) {
					setButtonState('loading');
					setTimeout(function(){
						setButtonState('success');
						setTimeout(function(){
							form.style.display = 'none';
							if (success) success.classList.add('is-visible');
						}, 800);
					}, 1200);
					return;
				}

				setButtonState('loading');

				var data = new FormData(form);
				data.append('action', 'vira_submit_lead');
				data.append('vira_nonce', window.ViraSectionsForm.nonce);
				data.append('page_url', window.location.href);

				// Map field names to backend convention (name, phone, email, select, message)
				if (data.has('vira_name')) { data.append('name', data.get('vira_name')); }
				if (data.has('vira_phone')) { data.append('phone', data.get('vira_phone')); }
				if (data.has('vira_email')) { data.append('email', data.get('vira_email')); }
				if (data.has('vira_select')) { data.append('select', data.get('vira_select')); }
				if (data.has('vira_message')) { data.append('message', data.get('vira_message')); }

				fetch(window.ViraSectionsForm.ajaxurl, {
					method: 'POST',
					body: data,
					credentials: 'same-origin'
				})
				.then(function(r){ return r.json().catch(function(){ return { success:false, data:{ msg:'خطا در پاسخ سرور' } }; }); })
				.then(function(res){
					if (res && res.success) {
						setButtonState('success');
						setTimeout(function(){
							form.style.display = 'none';
							if (success) success.classList.add('is-visible');
						}, 800);
					} else {
						setButtonState('idle');
						var msg = (res && res.data && res.data.msg) ? res.data.msg : 'خطا در ارسال پیام. لطفاً بعداً تلاش کنید.';
						showError(msg);
					}
				})
				.catch(function(){
					setButtonState('idle');
					showError('خطا در ارتباط با سرور. لطفاً اتصال اینترنت خود را بررسی کنید.');
				});
			});

			/* IntersectionObserver entrance animation */
			var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
			if (!reducedMotion && 'IntersectionObserver' in window) {
				var formWrap = section.querySelector('.vira-cta__form-wrap');
				var content = section.querySelector('.vira-cta__content');
				if (formWrap) formWrap.classList.add('vira-entrance');
				if (content) content.classList.add('vira-entrance');
				var observer = new IntersectionObserver(function(entries){
					entries.forEach(function(entry){
						if (entry.isIntersecting) {
							if (content) {
								content.classList.remove('vira-entrance');
								content.classList.add('vira-entrance-in');
							}
							setTimeout(function(){
								if (formWrap) {
									formWrap.classList.remove('vira-entrance');
									formWrap.classList.add('vira-entrance-in');
								}
							}, 200);
							observer.disconnect();
						}
					});
				}, { threshold: 0.15 });
				observer.observe(section);
			}
		})();
		</script>
		<?php endif; ?>
		<?php
	}
}
