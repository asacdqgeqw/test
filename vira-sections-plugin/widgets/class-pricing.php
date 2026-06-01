<?php
/**
 * Vira Sections — Pricing Widget
 *
 * Pricing cards with optional monthly/yearly toggle, featured highlight,
 * editable features list, and per-card colors.
 *
 * @package ViraSections
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Vira_Sections_Widget_Pricing extends \Elementor\Widget_Base {

	use Vira_Sections_Preset_Trait;

	public function get_name() { return 'vira_pricing'; }
	public function get_title() { return __( 'Pricing (Vira)', 'vira-sections' ); }
	public function get_icon() { return 'eicon-price-table'; }
	public function get_categories() { return array( 'vira-sections' ); }
	public function get_keywords() { return array( 'vira', 'pricing', 'plans', 'packages' ); }

	protected function register_controls() {

		$this->register_preset_control();

		/* ============= Section Header ============= */
		$this->start_controls_section(
			'section_header',
			array( 'label' => __( 'Section Header', 'vira-sections' ), 'tab' => \Elementor\Controls_Manager::TAB_CONTENT )
		);

		$this->add_control(
			'eyebrow',
			array( 'label' => __( 'Eyebrow', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __( 'پکیج‌های ما', 'vira-sections' ) )
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Heading', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'قیمت‌گذاری <em>شفاف و منصفانه</em>', 'vira-sections' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'پکیج مناسب نیاز خود را انتخاب کنید. در صورت نیاز به طرح اختصاصی، با ما تماس بگیرید.', 'vira-sections' ),
				'rows'    => 3,
			)
		);

		$this->add_control(
			'show_toggle',
			array(
				'label'        => __( 'Show Monthly/Yearly Toggle', 'vira-sections' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'default'      => '',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'monthly_label',
			array( 'label' => __( 'Monthly Label', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __( 'ماهانه', 'vira-sections' ), 'condition' => array( 'show_toggle' => 'yes' ) )
		);
		$this->add_control(
			'yearly_label',
			array( 'label' => __( 'Yearly Label', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __( 'سالانه', 'vira-sections' ), 'condition' => array( 'show_toggle' => 'yes' ) )
		);
		$this->add_control(
			'save_label',
			array( 'label' => __( 'Save Badge Label', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __( '۲ ماه رایگان', 'vira-sections' ), 'condition' => array( 'show_toggle' => 'yes' ) )
		);

		$this->end_controls_section();

		/* ============= Plans Repeater ============= */
		$this->start_controls_section(
			'section_plans',
			array( 'label' => __( 'Plans', 'vira-sections' ), 'tab' => \Elementor\Controls_Manager::TAB_CONTENT )
		);

		$rep = new \Elementor\Repeater();

		$rep->add_control(
			'plan_icon',
			array(
				'label'   => __( 'Icon', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => array( 'value' => 'fas fa-cube', 'library' => 'fa-solid' ),
			)
		);

		$rep->add_control( 'plan_name', array( 'label' => __( 'Name', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __( 'پایه', 'vira-sections' ) ) );
		$rep->add_control( 'plan_desc', array( 'label' => __( 'Description', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __( 'مناسب کسب‌وکارهای کوچک', 'vira-sections' ) ) );
		$rep->add_control( 'plan_price_monthly', array( 'label' => __( 'Price (Monthly)', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '۱۸ میلیون' ) );
		$rep->add_control( 'plan_price_yearly', array( 'label' => __( 'Price (Yearly)', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '۱۵۰ میلیون' ) );
		$rep->add_control( 'plan_period', array( 'label' => __( 'Period Label', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __( 'تومان · پروژه کامل', 'vira-sections' ) ) );

		$feat_sub = new \Elementor\Repeater();
		$feat_sub->add_control( 'feat_text', array( 'label' => __( 'Feature', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __( 'یک ویژگی', 'vira-sections' ) ) );
		$feat_sub->add_control(
			'feat_disabled',
			array( 'label' => __( 'Disabled?', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => '', 'return_value' => 'yes' )
		);

		$rep->add_control(
			'plan_features',
			array(
				'label'       => __( 'Features', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $feat_sub->get_controls(),
				'title_field' => '{{{ feat_text }}}',
				'default'     => array(
					array( 'feat_text' => __( 'تا ۸ صفحه', 'vira-sections' ) ),
					array( 'feat_text' => __( 'طراحی ریسپانسیو', 'vira-sections' ) ),
					array( 'feat_text' => __( 'سئوی پایه', 'vira-sections' ) ),
					array( 'feat_text' => __( '۳ ماه پشتیبانی', 'vira-sections' ) ),
				),
			)
		);

		$rep->add_control( 'plan_cta_text', array( 'label' => __( 'CTA Text', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __( 'انتخاب پکیج', 'vira-sections' ) ) );
		$rep->add_control( 'plan_cta_link', array( 'label' => __( 'CTA Link', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::URL, 'default' => array( 'url' => '#contact' ) ) );

		$rep->add_control(
			'plan_featured',
			array(
				'label'        => __( 'Featured Plan?', 'vira-sections' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'default'      => '',
				'return_value' => 'yes',
			)
		);

		$rep->add_control(
			'plan_badge',
			array( 'label' => __( 'Featured Badge Text', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => __( 'محبوب‌ترین', 'vira-sections' ) )
		);

		$this->add_control(
			'plans',
			array(
				'label'       => __( 'Plans', 'vira-sections' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $rep->get_controls(),
				'title_field' => '{{{ plan_name }}}',
				'default'     => array(
					array(
						'plan_name'          => __( 'پایه', 'vira-sections' ),
						'plan_desc'          => __( 'مناسب کسب‌وکارهای کوچک', 'vira-sections' ),
						'plan_price_monthly' => '۱۸ میلیون',
						'plan_price_yearly'  => '۱۵۰ میلیون',
					),
					array(
						'plan_name'          => __( 'حرفه‌ای', 'vira-sections' ),
						'plan_desc'          => __( 'مناسب کسب‌وکارهای در حال رشد', 'vira-sections' ),
						'plan_price_monthly' => '۴۸ میلیون',
						'plan_price_yearly'  => '۴۰۰ میلیون',
						'plan_featured'      => 'yes',
						'plan_badge'         => __( 'محبوب‌ترین', 'vira-sections' ),
					),
					array(
						'plan_name'          => __( 'سازمانی', 'vira-sections' ),
						'plan_desc'          => __( 'مناسب سازمان‌ها و برندها', 'vira-sections' ),
						'plan_price_monthly' => __( 'سفارشی', 'vira-sections' ),
						'plan_price_yearly'  => __( 'سفارشی', 'vira-sections' ),
						'plan_period'        => __( 'بر اساس نیاز پروژه', 'vira-sections' ),
					),
				),
			)
		);

		$this->add_control(
			'bottom_note',
			array(
				'label'   => __( 'Bottom Note (HTML allowed)', 'vira-sections' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'همه پکیج‌ها شامل: <strong>پشتیبانی فنی</strong> · <strong>مستندسازی کامل</strong> · <strong>گارانتی کیفیت</strong>', 'vira-sections' ),
				'rows'    => 3,
			)
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
				'range'      => array( 'px' => array( 'min' => 40, 'max' => 200 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 110 ),
			)
		);

		$this->add_control(
			'bg_from',
			array( 'label' => __( 'BG Gradient 1', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::COLOR, 'default' => '#FAF6EC' )
		);

		$this->add_control(
			'bg_to',
			array( 'label' => __( 'BG Gradient 2', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::COLOR, 'default' => '#FFFFFF' )
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_colors',
			array( 'label' => __( 'Colors', 'vira-sections' ), 'tab' => \Elementor\Controls_Manager::TAB_STYLE )
		);

		$this->add_control(
			'accent_color',
			array( 'label' => __( 'Accent Color', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::COLOR, 'default' => '#0170B9' )
		);
		$this->add_control(
			'grad_from',
			array( 'label' => __( 'Featured Gradient 1', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::COLOR, 'default' => '#170C79' )
		);
		$this->add_control(
			'grad_to',
			array( 'label' => __( 'Featured Gradient 2', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::COLOR, 'default' => '#128BE0' )
		);
		$this->add_control(
			'check_color',
			array( 'label' => __( 'Check Icon Color', 'vira-sections' ), 'type' => \Elementor\Controls_Manager::COLOR, 'default' => '#0170B9' )
		);

		$this->end_controls_section();
	}

	protected function render() {
		$s         = $this->get_settings_for_display();
		$unique_id = 'vira-pricing-' . $this->get_id();

		$pad         = ! empty( $s['section_padding']['size'] ) ? (int) $s['section_padding']['size'] : 110;
		$bg_from     = ! empty( $s['bg_from'] ) ? $s['bg_from'] : '#FAF6EC';
		$bg_to       = ! empty( $s['bg_to'] ) ? $s['bg_to'] : '#FFFFFF';
		$accent      = ! empty( $s['accent_color'] ) ? $s['accent_color'] : '#0170B9';
		$grad_from   = ! empty( $s['grad_from'] ) ? $s['grad_from'] : '#170C79';
		$grad_to     = ! empty( $s['grad_to'] ) ? $s['grad_to'] : '#128BE0';
		$check_color = ! empty( $s['check_color'] ) ? $s['check_color'] : '#0170B9';

		$show_toggle = ! empty( $s['show_toggle'] ) && 'yes' === $s['show_toggle'];
		$plans       = ! empty( $s['plans'] ) ? $s['plans'] : array();
		$count       = max( 1, count( $plans ) );
		?>
		<style>
			#<?php echo esc_attr( $unique_id ); ?>{
				--vira-pad: <?php echo (int) $pad; ?>px;
				--vira-bg-from: <?php echo esc_attr( $bg_from ); ?>;
				--vira-bg-to: <?php echo esc_attr( $bg_to ); ?>;
				--vira-accent: <?php echo esc_attr( $accent ); ?>;
				--vira-grad-from: <?php echo esc_attr( $grad_from ); ?>;
				--vira-grad-to: <?php echo esc_attr( $grad_to ); ?>;
				--vira-check: <?php echo esc_attr( $check_color ); ?>;
			}
			#<?php echo esc_attr( $unique_id ); ?>.vira-pricing{
				padding:var(--vira-pad) 24px;
				background:linear-gradient(180deg,var(--vira-bg-from) 0%,var(--vira-bg-to) 100%);
				font-family:'Vazirmatn','IRANSans',Tahoma,sans-serif;direction:rtl;color:#1D2327;
				position:relative;overflow:hidden;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pricing__inner{max-width:1240px;margin:0 auto;position:relative;z-index:1;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pricing__head{text-align:center;margin-bottom:48px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pricing__eyebrow{
				display:inline-flex;align-items:center;gap:8px;
				background:rgba(1,112,185,.10);color:var(--vira-accent);
				border:1px solid rgba(1,112,185,.25);
				padding:8px 16px;border-radius:999px;font-size:14px;font-weight:600;margin-bottom:16px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pricing__eyebrow i{
				width:8px;height:8px;border-radius:50%;background:var(--vira-accent);
				box-shadow:0 0 0 4px rgba(1,112,185,.16);display:inline-block;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pricing h2{font-size:clamp(28px,3.4vw,46px);font-weight:800;margin:0 0 16px;line-height:1.4;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pricing h2 em{
				font-style:normal;
				background:linear-gradient(135deg,var(--vira-grad-from),var(--vira-grad-to));
				-webkit-background-clip:text;background-clip:text;color:transparent;-webkit-text-fill-color:transparent;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pricing__head p{color:#64748B;font-size:18px;max-width:680px;margin:0 auto;}

			#<?php echo esc_attr( $unique_id ); ?> .vira-pricing__toggle{
				display:flex;align-items:center;justify-content:center;gap:14px;margin:32px 0;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pricing__toggle-label{
				font-size:14.5px;font-weight:600;color:#64748B;cursor:pointer;
				transition:color .25s ease;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pricing__toggle-label.is-active{color:#1D2327;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pricing__toggle-switch{
				width:54px;height:30px;background:#E2E8F0;border-radius:999px;
				position:relative;cursor:pointer;transition:background .3s ease;
				border:none;padding:0;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pricing__toggle-switch::after{
				content:"";position:absolute;top:3px;right:3px;
				width:24px;height:24px;border-radius:50%;background:#fff;
				transition:transform .3s ease;box-shadow:0 2px 6px rgba(0,0,0,.18);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pricing__toggle-switch.is-yearly{
				background:linear-gradient(135deg,var(--vira-grad-from),var(--vira-grad-to));
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pricing__toggle-switch.is-yearly::after{transform:translateX(-24px);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pricing__save-badge{
				background:rgba(34,197,94,.15);color:#16A34A;
				padding:5px 12px;border-radius:8px;font-size:12px;font-weight:700;
			}

			#<?php echo esc_attr( $unique_id ); ?> .vira-pricing__grid{
				display:grid;grid-template-columns:repeat(<?php echo (int) min( 3, $count ); ?>,1fr);gap:24px;align-items:stretch;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard{
				background:#fff;border:1.5px solid #E2E8F0;border-radius:24px;
				padding:34px 28px;display:flex;flex-direction:column;
				transition:all .35s cubic-bezier(.4,0,.2,1);position:relative;overflow:hidden;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard:hover{
				transform:translateY(-4px);box-shadow:0 18px 44px rgba(15,23,42,.08);
				border-color:rgba(1,112,185,.30);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard--featured{
				border:2px solid transparent;
				background:linear-gradient(#fff,#fff) padding-box,
					linear-gradient(135deg,var(--vira-grad-from),var(--vira-grad-to)) border-box;
				box-shadow:0 24px 60px rgba(1,112,185,.18);
				transform:translateY(-8px);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard--featured::before{
				content:"";position:absolute;top:0;left:0;right:0;height:4px;
				background:linear-gradient(90deg,var(--vira-grad-from),var(--vira-grad-to));
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard__badge{
				position:absolute;top:-1px;left:24px;
				background:linear-gradient(135deg,var(--vira-grad-from),var(--vira-grad-to));
				color:#fff;padding:7px 14px;border-radius:0 0 12px 12px;
				font-size:11.5px;font-weight:800;
				display:inline-flex;align-items:center;gap:5px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard__badge svg{width:11px;height:11px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard__icon{
				width:54px;height:54px;border-radius:14px;
				background:rgba(1,112,185,.10);color:var(--vira-accent);
				display:grid;place-items:center;margin-bottom:18px;font-size:24px;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard--featured .vira-pcard__icon{
				background:linear-gradient(135deg,var(--vira-grad-from),var(--vira-grad-to));
				color:#fff;box-shadow:0 10px 22px rgba(1,112,185,.25);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard__name{font-size:20px;font-weight:800;margin:0 0 6px;color:#1D2327;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard__desc{font-size:13.5px;color:#64748B;margin:0 0 22px;line-height:1.7;min-height:46px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard__price{margin-bottom:24px;padding-bottom:22px;border-bottom:1px dashed #E2E8F0;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard__amount{font-size:clamp(28px,2.8vw,36px);font-weight:900;color:#1D2327;line-height:1;transition:opacity .25s ease;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard--featured .vira-pcard__amount{
				background:linear-gradient(135deg,var(--vira-grad-from),var(--vira-grad-to));
				-webkit-background-clip:text;background-clip:text;color:transparent;-webkit-text-fill-color:transparent;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard__period{font-size:13.5px;color:#94A3B8;font-weight:500;display:block;margin-top:6px;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard__features{
				list-style:none;padding:0;margin:0 0 24px;display:grid;gap:11px;flex:1;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard__features li{
				display:flex;align-items:flex-start;gap:9px;
				font-size:14px;color:#475569;line-height:1.6;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard__features li.is-disabled{color:#CBD5E1;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard__features li svg{flex-shrink:0;margin-top:3px;color:var(--vira-check);}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard__features li.is-disabled svg{color:#CBD5E1;}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard__btn{
				display:block;width:100%;padding:14px;border-radius:12px;
				text-align:center;font-weight:700;font-size:15px;
				text-decoration:none;transition:all .3s ease;border:none;font-family:inherit;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard__btn--outline{
				background:transparent;border:2px solid #E2E8F0;color:#1D2327;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard__btn--outline:hover{
				border-color:var(--vira-accent);color:var(--vira-accent);
				background:rgba(1,112,185,.05);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard__btn--primary{
				background:linear-gradient(135deg,var(--vira-grad-from),var(--vira-grad-to));
				color:#fff;box-shadow:0 12px 28px rgba(1,112,185,.25);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard__btn--primary:hover{
				box-shadow:0 16px 36px rgba(1,112,185,.40);transform:translateY(-2px);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pricing__note{
				margin-top:36px;text-align:center;
				background:#fff;border:1px dashed #CBD5E1;border-radius:16px;
				padding:18px 24px;font-size:14.5px;color:#475569;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pricing__note strong{color:#1D2327;}
			@media(max-width:980px){
				#<?php echo esc_attr( $unique_id ); ?> .vira-pricing__grid{grid-template-columns:1fr;max-width:480px;margin:0 auto;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-pcard--featured{transform:none;}
			}

			/* === Card Entrance Stagger Animation === */
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard{
				opacity:0;transform:translateY(40px);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard.vira-visible{
				opacity:1;transform:translateY(0);
				transition:opacity .6s cubic-bezier(.4,0,.2,1),transform .6s cubic-bezier(.4,0,.2,1);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard--featured.vira-visible{
				transform:translateY(-8px);
			}

			/* === Hover Scale Effect === */
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard.vira-visible:hover{
				transform:translateY(-4px) scale(1.02);
				box-shadow:0 24px 50px rgba(15,23,42,.12);
				border-color:rgba(1,112,185,.30);
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard--featured.vira-visible:hover{
				transform:translateY(-12px) scale(1.04);
				box-shadow:0 32px 64px rgba(1,112,185,.25);
			}

			/* === Animated Gradient Border on Featured Card === */
			@keyframes <?php echo esc_attr( $unique_id ); ?>-border-rotate{
				0%{background-position:0% 50%;}
				50%{background-position:100% 50%;}
				100%{background-position:0% 50%;}
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard--featured{
				background:linear-gradient(#fff,#fff) padding-box,
					linear-gradient(135deg,var(--vira-grad-from),var(--vira-grad-to),var(--vira-accent),var(--vira-grad-from)) border-box;
				background-size:100% 100%,300% 300%;
				animation:<?php echo esc_attr( $unique_id ); ?>-border-rotate 4s ease-in-out infinite;
			}

			/* === Subtle Shadow Depth on Hover === */
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard{
				transition:all .4s cubic-bezier(.4,0,.2,1);
			}

			/* === Price Count-Up Animation Class === */
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard__amount{
				transition:opacity .25s ease,transform .3s ease;
			}
			#<?php echo esc_attr( $unique_id ); ?> .vira-pcard__amount.vira-counting{
				transform:scale(1.05);
			}

			/* === Reduced Motion === */
			@media(prefers-reduced-motion:reduce){
				#<?php echo esc_attr( $unique_id ); ?> .vira-pcard{opacity:1;transform:none;transition:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-pcard.vira-visible{transform:none;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-pcard--featured{animation:none;transform:none;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-pcard--featured.vira-visible{transform:none;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-pcard.vira-visible:hover{transform:none;transition:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-pcard--featured.vira-visible:hover{transform:none;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-pcard__amount{transition:none !important;}
				#<?php echo esc_attr( $unique_id ); ?> .vira-pcard__btn{transition:none !important;}
			}
		</style>

		<section id="<?php echo esc_attr( $unique_id ); ?>" class="vira-pricing" data-vira-pricing>
			<div class="vira-pricing__inner">
				<div class="vira-pricing__head">
					<?php if ( ! empty( $s['eyebrow'] ) ) : ?>
						<span class="vira-pricing__eyebrow"><i></i><?php echo esc_html( $s['eyebrow'] ); ?></span>
					<?php endif; ?>
					<?php if ( ! empty( $s['heading'] ) ) : ?>
						<h2><?php echo wp_kses_post( $s['heading'] ); ?></h2>
					<?php endif; ?>
					<?php if ( ! empty( $s['description'] ) ) : ?>
						<p><?php echo esc_html( $s['description'] ); ?></p>
					<?php endif; ?>

					<?php if ( $show_toggle ) : ?>
						<div class="vira-pricing__toggle">
							<span class="vira-pricing__toggle-label is-active" data-period="monthly"><?php echo esc_html( $s['monthly_label'] ); ?></span>
							<button type="button" class="vira-pricing__toggle-switch" data-toggle aria-label="toggle"></button>
							<span class="vira-pricing__toggle-label" data-period="yearly">
								<?php echo esc_html( $s['yearly_label'] ); ?>
							</span>
							<?php if ( ! empty( $s['save_label'] ) ) : ?>
								<span class="vira-pricing__save-badge">✦ <?php echo esc_html( $s['save_label'] ); ?></span>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>

				<div class="vira-pricing__grid">
					<?php foreach ( $plans as $p ) :
						$is_featured = ! empty( $p['plan_featured'] ) && 'yes' === $p['plan_featured'];
						$class       = 'vira-pcard' . ( $is_featured ? ' vira-pcard--featured' : '' );
						$cta_url     = ! empty( $p['plan_cta_link']['url'] ) ? $p['plan_cta_link']['url'] : '#';
						$btn_class   = $is_featured ? 'vira-pcard__btn--primary' : 'vira-pcard__btn--outline';
						$features    = ! empty( $p['plan_features'] ) ? $p['plan_features'] : array();
						?>
						<div class="<?php echo esc_attr( $class ); ?>">
							<?php if ( $is_featured && ! empty( $p['plan_badge'] ) ) : ?>
								<div class="vira-pcard__badge">
									<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
									<?php echo esc_html( $p['plan_badge'] ); ?>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $p['plan_icon'] ) ) : ?>
								<div class="vira-pcard__icon"><?php \Elementor\Icons_Manager::render_icon( $p['plan_icon'], array( 'aria-hidden' => 'true' ) ); ?></div>
							<?php endif; ?>
							<div class="vira-pcard__name"><?php echo esc_html( $p['plan_name'] ); ?></div>
							<div class="vira-pcard__desc"><?php echo esc_html( $p['plan_desc'] ); ?></div>
							<div class="vira-pcard__price">
								<span class="vira-pcard__amount" data-monthly="<?php echo esc_attr( $p['plan_price_monthly'] ); ?>" data-yearly="<?php echo esc_attr( $p['plan_price_yearly'] ); ?>"><?php echo esc_html( $p['plan_price_monthly'] ); ?></span>
								<span class="vira-pcard__period"><?php echo esc_html( $p['plan_period'] ); ?></span>
							</div>
							<ul class="vira-pcard__features">
								<?php foreach ( $features as $f ) :
									$disabled = ! empty( $f['feat_disabled'] ) && 'yes' === $f['feat_disabled'];
									?>
									<li class="<?php echo $disabled ? 'is-disabled' : ''; ?>">
										<?php if ( $disabled ) : ?>
											<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M18 6L6 18M6 6l12 12" stroke-linecap="round" stroke-linejoin="round"/></svg>
										<?php else : ?>
											<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
										<?php endif; ?>
										<?php echo esc_html( $f['feat_text'] ); ?>
									</li>
								<?php endforeach; ?>
							</ul>
							<a href="<?php echo esc_url( $cta_url ); ?>" class="vira-pcard__btn <?php echo esc_attr( $btn_class ); ?>"><?php echo esc_html( $p['plan_cta_text'] ); ?></a>
						</div>
					<?php endforeach; ?>
				</div>

				<?php if ( ! empty( $s['bottom_note'] ) ) : ?>
					<div class="vira-pricing__note"><?php echo wp_kses_post( $s['bottom_note'] ); ?></div>
				<?php endif; ?>
			</div>
		</section>

		<?php if ( $show_toggle ) : ?>
		<script>
		(function(){
			var section = document.getElementById('<?php echo esc_js( $unique_id ); ?>');
			if (!section) return;
			var sw = section.querySelector('[data-toggle]');
			var labels = section.querySelectorAll('.vira-pricing__toggle-label');
			var amounts = section.querySelectorAll('.vira-pcard__amount');
			var isYearly = false;
			if (sw) sw.addEventListener('click', function(){
				isYearly = !isYearly;
				sw.classList.toggle('is-yearly', isYearly);
				labels.forEach(function(l){
					var period = l.getAttribute('data-period');
					l.classList.toggle('is-active', (isYearly && period === 'yearly') || (!isYearly && period === 'monthly'));
				});
				amounts.forEach(function(a){
					a.style.opacity = '0';
					setTimeout(function(){
						a.textContent = isYearly ? a.getAttribute('data-yearly') : a.getAttribute('data-monthly');
						a.style.opacity = '1';
					}, 180);
				});
			});
			labels.forEach(function(l){
				l.addEventListener('click', function(){
					var target = (l.getAttribute('data-period') === 'yearly');
					if (target !== isYearly && sw) sw.click();
				});
			});
		})();
		</script>
		<?php endif; ?>

		<script>
		(function(){
			var root = document.getElementById('<?php echo esc_js( $unique_id ); ?>');
			if (!root) return;
			var cards = root.querySelectorAll('.vira-pcard');
			var amounts = root.querySelectorAll('.vira-pcard__amount');
			var reduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

			// Entrance stagger animation
			if (reduced) {
				cards.forEach(function(c){ c.classList.add('vira-visible'); });
			} else {
				var obs = new IntersectionObserver(function(entries){
					entries.forEach(function(entry){
						if (entry.isIntersecting) {
							var card = entry.target;
							var idx = Array.prototype.indexOf.call(cards, card);
							setTimeout(function(){ card.classList.add('vira-visible'); }, idx * 150);
							obs.unobserve(card);
						}
					});
				}, { threshold: 0.15 });
				cards.forEach(function(c){ obs.observe(c); });
			}

			// Price counter animation (count-up effect on scroll)
			if (!reduced) {
				var priceObs = new IntersectionObserver(function(entries){
					entries.forEach(function(entry){
						if (entry.isIntersecting) {
							var el = entry.target;
							el.classList.add('vira-counting');
							setTimeout(function(){ el.classList.remove('vira-counting'); }, 600);
							priceObs.unobserve(el);
						}
					});
				}, { threshold: 0.5 });
				amounts.forEach(function(a){ priceObs.observe(a); });
			}
		})();
		</script>
		<?php
	}
}
