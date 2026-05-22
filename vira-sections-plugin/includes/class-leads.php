<?php
/**
 * Vira Sections — Leads (Form Submissions) System
 *
 * Custom post type for storing form submissions, AJAX handler,
 * email notifications and admin UI.
 *
 * @package ViraSections
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Vira_Sections_Leads
 */
class Vira_Sections_Leads {

	const CPT       = 'vira_lead';
	const NONCE_KEY = 'vira_lead_submit';

	/**
	 * Constructor — registers all hooks.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_cpt' ) );
		add_action( 'wp_ajax_vira_submit_lead', array( $this, 'handle_ajax' ) );
		add_action( 'wp_ajax_nopriv_vira_submit_lead', array( $this, 'handle_ajax' ) );
		add_filter( 'manage_' . self::CPT . '_posts_columns', array( $this, 'columns' ) );
		add_action( 'manage_' . self::CPT . '_posts_custom_column', array( $this, 'column_content' ), 10, 2 );
		add_action( 'add_meta_boxes', array( $this, 'meta_boxes' ) );
		add_filter( 'post_row_actions', array( $this, 'row_actions' ), 10, 2 );
		add_filter( 'bulk_actions-edit-' . self::CPT, array( $this, 'bulk_actions' ) );
		add_action( 'admin_head-edit.php', array( $this, 'admin_styles' ) );
		add_action( 'admin_head-post.php', array( $this, 'admin_styles' ) );
	}

	/**
	 * Register the leads custom post type. Visible only inside our plugin menu.
	 */
	public function register_cpt() {
		register_post_type(
			self::CPT,
			array(
				'labels'              => array(
					'name'               => __( 'پیام‌های فرم', 'vira-sections' ),
					'singular_name'      => __( 'پیام', 'vira-sections' ),
					'menu_name'          => __( 'پیام‌های فرم', 'vira-sections' ),
					'all_items'          => __( 'همه پیام‌ها', 'vira-sections' ),
					'view_item'          => __( 'مشاهده پیام', 'vira-sections' ),
					'search_items'       => __( 'جستجو در پیام‌ها', 'vira-sections' ),
					'not_found'          => __( 'پیامی یافت نشد', 'vira-sections' ),
					'not_found_in_trash' => __( 'پیامی در سطل زباله نیست', 'vira-sections' ),
				),
				'public'              => false,
				'show_ui'             => true,
				'show_in_menu'        => 'vira-sections',
				'show_in_admin_bar'   => false,
				'show_in_rest'        => false,
				'capability_type'     => 'post',
				'capabilities'        => array(
					'create_posts' => 'do_not_allow', // Disable "Add New" — only created via form.
				),
				'map_meta_cap'        => true,
				'supports'            => array( 'title' ),
				'menu_icon'           => 'dashicons-email-alt',
				'exclude_from_search' => true,
				'has_archive'         => false,
				'rewrite'             => false,
			)
		);
	}

	/**
	 * AJAX handler: validate, save, notify.
	 */
	public function handle_ajax() {
		// Verify nonce.
		if ( ! check_ajax_referer( self::NONCE_KEY, 'vira_nonce', false ) ) {
			wp_send_json_error( array( 'msg' => __( 'درخواست معتبر نیست. لطفاً صفحه را تازه کنید.', 'vira-sections' ) ), 403 );
		}

		// Honeypot — silently reject if filled.
		if ( ! empty( $_POST['vira_hp'] ) ) {
			wp_send_json_error( array( 'msg' => 'spam detected' ), 400 );
		}

		// Sanitize inputs.
		$name     = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
		$phone    = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
		$email    = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
		$select   = isset( $_POST['select'] ) ? sanitize_text_field( wp_unslash( $_POST['select'] ) ) : '';
		$message  = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
		$page_url = isset( $_POST['page_url'] ) ? esc_url_raw( wp_unslash( $_POST['page_url'] ) ) : '';

		// Validate.
		if ( '' === $name ) {
			wp_send_json_error( array( 'msg' => __( 'نام الزامی است.', 'vira-sections' ) ), 400 );
		}
		if ( '' === $phone && '' === $email ) {
			wp_send_json_error( array( 'msg' => __( 'شماره تماس یا ایمیل الزامی است.', 'vira-sections' ) ), 400 );
		}
		if ( '' !== $email && ! is_email( $email ) ) {
			wp_send_json_error( array( 'msg' => __( 'آدرس ایمیل نامعتبر است.', 'vira-sections' ) ), 400 );
		}

		// Build title.
		$title = $name;
		if ( '' !== $phone ) {
			$title .= ' (' . $phone . ')';
		}
		$title .= ' — ' . wp_date( 'Y-m-d H:i' );

		// Insert lead post.
		$post_id = wp_insert_post(
			array(
				'post_type'   => self::CPT,
				'post_status' => 'publish',
				'post_title'  => $title,
				'post_content' => $message,
			),
			true
		);

		if ( is_wp_error( $post_id ) ) {
			wp_send_json_error( array( 'msg' => __( 'خطا در ذخیره پیام.', 'vira-sections' ) ), 500 );
		}

		// Save meta.
		update_post_meta( $post_id, '_vira_name', $name );
		update_post_meta( $post_id, '_vira_phone', $phone );
		update_post_meta( $post_id, '_vira_email', $email );
		update_post_meta( $post_id, '_vira_select', $select );
		update_post_meta( $post_id, '_vira_message', $message );
		update_post_meta( $post_id, '_vira_page_url', $page_url );
		update_post_meta(
			$post_id,
			'_vira_user_ip',
			isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : ''
		);
		update_post_meta(
			$post_id,
			'_vira_user_agent',
			isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) : ''
		);
		update_post_meta( $post_id, '_vira_received_at', current_time( 'mysql' ) );

		/**
		 * Fires after a new lead is saved. Useful for integration with CRM/SMS gateways.
		 *
		 * @param int   $post_id
		 * @param array $data
		 */
		do_action(
			'vira_sections_lead_saved',
			$post_id,
			array(
				'name'     => $name,
				'phone'    => $phone,
				'email'    => $email,
				'select'   => $select,
				'message'  => $message,
				'page_url' => $page_url,
			)
		);

		// Send notification email.
		$this->send_notification(
			$post_id,
			array(
				'name'     => $name,
				'phone'    => $phone,
				'email'    => $email,
				'select'   => $select,
				'message'  => $message,
				'page_url' => $page_url,
			)
		);

		wp_send_json_success(
			array(
				'msg'     => __( 'پیام شما با موفقیت ثبت شد.', 'vira-sections' ),
				'post_id' => $post_id,
			)
		);
	}

	/**
	 * Send HTML notification email if enabled.
	 *
	 * @param int   $post_id
	 * @param array $data
	 */
	private function send_notification( $post_id, $data ) {
		$opts = get_option( 'vira_sections_settings', array() );

		// Disabled by user.
		if ( empty( $opts['enable_emails'] ) || '1' !== $opts['enable_emails'] ) {
			return;
		}

		// Resolve recipient(s) — fall back to admin email.
		$recipients_raw = ! empty( $opts['notification_email'] ) ? $opts['notification_email'] : get_option( 'admin_email' );
		if ( empty( $recipients_raw ) ) {
			return;
		}

		// Support comma-separated list.
		$recipients = array_filter(
			array_map(
				'sanitize_email',
				array_map( 'trim', explode( ',', $recipients_raw ) )
			)
		);
		if ( empty( $recipients ) ) {
			return;
		}

		$subject = ! empty( $opts['email_subject'] )
			? $opts['email_subject']
			: __( 'درخواست جدید از سایت', 'vira-sections' );

		$site_name = get_bloginfo( 'name' );
		$admin_url = admin_url( 'post.php?post=' . $post_id . '&action=edit' );

		$row = function ( $label, $value, $is_link = false, $link_prefix = '' ) {
			if ( '' === $value ) {
				return '';
			}
			$content = $is_link
				? sprintf( '<a href="%s%s" style="color:#0170B9;">%s</a>', esc_attr( $link_prefix ), esc_attr( $value ), esc_html( $value ) )
				: esc_html( $value );
			return sprintf(
				'<tr><td style="padding:10px 14px;border-bottom:1px solid #eef0f3;font-weight:700;color:#1D2327;width:140px;background:#FAF6EC;">%s</td><td style="padding:10px 14px;border-bottom:1px solid #eef0f3;color:#475569;line-height:1.8;">%s</td></tr>',
				esc_html( $label ),
				$content
			);
		};

		$body  = '<!DOCTYPE html><html lang="fa" dir="rtl"><head><meta charset="UTF-8"></head>';
		$body .= '<body style="font-family:Vazirmatn,Tahoma,sans-serif;direction:rtl;background:#f6f7f9;margin:0;padding:24px;color:#1D2327;">';
		$body .= '<table cellpadding="0" cellspacing="0" style="max-width:640px;margin:0 auto;background:#fff;border-radius:14px;overflow:hidden;box-shadow:0 4px 20px rgba(15,23,42,.05);">';
		$body .= '<tr><td style="padding:20px 24px;background:linear-gradient(135deg,#170C79,#128BE0);color:#fff;">';
		$body .= '<h2 style="margin:0;font-size:20px;font-weight:700;">📩 پیام جدید از فرم سایت</h2>';
		$body .= '<p style="margin:6px 0 0;font-size:13px;opacity:.85;">' . esc_html( $site_name ) . '</p>';
		$body .= '</td></tr>';
		$body .= '<tr><td style="padding:0;">';
		$body .= '<table cellpadding="0" cellspacing="0" style="width:100%;border-collapse:collapse;">';
		$body .= $row( __( 'نام', 'vira-sections' ), $data['name'] );
		$body .= $row( __( 'تلفن', 'vira-sections' ), $data['phone'], true, 'tel:' );
		$body .= $row( __( 'ایمیل', 'vira-sections' ), $data['email'], true, 'mailto:' );
		$body .= $row( __( 'موضوع', 'vira-sections' ), $data['select'] );
		if ( '' !== $data['message'] ) {
			$body .= sprintf(
				'<tr><td style="padding:10px 14px;border-bottom:1px solid #eef0f3;font-weight:700;color:#1D2327;width:140px;background:#FAF6EC;vertical-align:top;">%s</td><td style="padding:10px 14px;border-bottom:1px solid #eef0f3;color:#475569;line-height:1.9;white-space:pre-wrap;">%s</td></tr>',
				esc_html__( 'پیام', 'vira-sections' ),
				esc_html( $data['message'] )
			);
		}
		$body .= $row( __( 'صفحه ارسال', 'vira-sections' ), $data['page_url'], true, '' );
		$body .= '</table>';
		$body .= '</td></tr>';
		$body .= '<tr><td style="padding:18px 24px;background:#FAF6EC;text-align:center;">';
		$body .= '<a href="' . esc_url( $admin_url ) . '" style="display:inline-block;background:linear-gradient(135deg,#170C79,#128BE0);color:#fff;padding:10px 20px;border-radius:10px;text-decoration:none;font-weight:700;font-size:14px;">';
		$body .= esc_html__( 'مشاهده در پنل', 'vira-sections' ) . ' →</a>';
		$body .= '</td></tr>';
		$body .= '<tr><td style="padding:14px;background:#1D2327;text-align:center;color:#94A3B8;font-size:11px;">';
		$body .= esc_html__( 'این ایمیل به‌صورت خودکار توسط افزونه Vira Sections ارسال شده است.', 'vira-sections' );
		$body .= '</td></tr>';
		$body .= '</table></body></html>';

		$headers = array(
			'Content-Type: text/html; charset=UTF-8',
			'From: ' . $site_name . ' <' . get_option( 'admin_email' ) . '>',
		);
		if ( '' !== $data['email'] ) {
			$headers[] = 'Reply-To: ' . $data['email'];
		}

		wp_mail( $recipients, $subject, $body, $headers );
	}

	/**
	 * Customize the leads list table columns.
	 *
	 * @param array $cols
	 * @return array
	 */
	public function columns( $cols ) {
		$new            = array();
		$new['cb']      = isset( $cols['cb'] ) ? $cols['cb'] : '';
		$new['title']   = __( 'فرستنده', 'vira-sections' );
		$new['vira_phone']   = __( 'تلفن', 'vira-sections' );
		$new['vira_email']   = __( 'ایمیل', 'vira-sections' );
		$new['vira_select']  = __( 'موضوع', 'vira-sections' );
		$new['vira_message'] = __( 'پیام', 'vira-sections' );
		$new['date']    = __( 'تاریخ', 'vira-sections' );
		return $new;
	}

	/**
	 * Render custom column content.
	 *
	 * @param string $col
	 * @param int    $post_id
	 */
	public function column_content( $col, $post_id ) {
		switch ( $col ) {
			case 'vira_phone':
				$phone = get_post_meta( $post_id, '_vira_phone', true );
				if ( $phone ) {
					echo '<a href="tel:' . esc_attr( $phone ) . '" dir="ltr" style="font-family:monospace;">' . esc_html( $phone ) . '</a>';
				} else {
					echo '<span style="color:#cbd5e1;">—</span>';
				}
				break;

			case 'vira_email':
				$email = get_post_meta( $post_id, '_vira_email', true );
				if ( $email ) {
					echo '<a href="mailto:' . esc_attr( $email ) . '" dir="ltr">' . esc_html( $email ) . '</a>';
				} else {
					echo '<span style="color:#cbd5e1;">—</span>';
				}
				break;

			case 'vira_select':
				$sel = get_post_meta( $post_id, '_vira_select', true );
				if ( $sel ) {
					echo '<span style="background:rgba(1,112,185,.10);color:#0170B9;padding:3px 10px;border-radius:6px;font-size:12px;font-weight:600;">' . esc_html( $sel ) . '</span>';
				} else {
					echo '<span style="color:#cbd5e1;">—</span>';
				}
				break;

			case 'vira_message':
				$msg = get_post_meta( $post_id, '_vira_message', true );
				if ( $msg ) {
					$short = mb_strimwidth( $msg, 0, 60, '…' );
					echo '<span title="' . esc_attr( $msg ) . '" style="color:#475569;">' . esc_html( $short ) . '</span>';
				} else {
					echo '<span style="color:#cbd5e1;">—</span>';
				}
				break;
		}
	}

	/**
	 * Add a "Lead Details" meta box on the lead edit page.
	 */
	public function meta_boxes() {
		add_meta_box(
			'vira_lead_details',
			__( 'جزئیات کامل پیام', 'vira-sections' ),
			array( $this, 'render_details_meta_box' ),
			self::CPT,
			'normal',
			'high'
		);
	}

	/**
	 * Render the lead details meta box.
	 *
	 * @param WP_Post $post
	 */
	public function render_details_meta_box( $post ) {
		$name       = get_post_meta( $post->ID, '_vira_name', true );
		$phone      = get_post_meta( $post->ID, '_vira_phone', true );
		$email      = get_post_meta( $post->ID, '_vira_email', true );
		$select     = get_post_meta( $post->ID, '_vira_select', true );
		$message    = get_post_meta( $post->ID, '_vira_message', true );
		$ip         = get_post_meta( $post->ID, '_vira_user_ip', true );
		$page       = get_post_meta( $post->ID, '_vira_page_url', true );
		$ua         = get_post_meta( $post->ID, '_vira_user_agent', true );
		$received   = get_post_meta( $post->ID, '_vira_received_at', true );
		?>
		<style>
			.vira-lead-table{width:100%;border-collapse:collapse;margin:0;direction:rtl;}
			.vira-lead-table th{
				width:140px;padding:14px 18px;text-align:right;
				background:#FAF6EC;color:#1D2327;font-weight:700;font-size:13px;
				border-bottom:1px solid #eef0f3;vertical-align:top;
			}
			.vira-lead-table td{
				padding:14px 18px;color:#475569;
				border-bottom:1px solid #eef0f3;line-height:1.8;
			}
			.vira-lead-table tr:last-child th,
			.vira-lead-table tr:last-child td{border-bottom:none;}
			.vira-lead-table .ltr{direction:ltr;font-family:monospace;text-align:left;}
			.vira-lead-table a{color:#0170B9;}
			.vira-lead-msg{background:#fff;border:1px solid #E2E8F0;border-radius:8px;padding:12px 14px;white-space:pre-wrap;color:#1D2327;}
		</style>
		<table class="vira-lead-table">
			<?php if ( $name ) : ?>
				<tr><th><?php esc_html_e( 'نام:', 'vira-sections' ); ?></th><td><strong><?php echo esc_html( $name ); ?></strong></td></tr>
			<?php endif; ?>
			<?php if ( $phone ) : ?>
				<tr><th><?php esc_html_e( 'شماره تماس:', 'vira-sections' ); ?></th><td class="ltr"><a href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( $phone ); ?></a></td></tr>
			<?php endif; ?>
			<?php if ( $email ) : ?>
				<tr><th><?php esc_html_e( 'ایمیل:', 'vira-sections' ); ?></th><td class="ltr"><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></td></tr>
			<?php endif; ?>
			<?php if ( $select ) : ?>
				<tr><th><?php esc_html_e( 'موضوع/علاقه‌مندی:', 'vira-sections' ); ?></th><td><?php echo esc_html( $select ); ?></td></tr>
			<?php endif; ?>
			<?php if ( $message ) : ?>
				<tr><th><?php esc_html_e( 'پیام:', 'vira-sections' ); ?></th><td><div class="vira-lead-msg"><?php echo esc_html( $message ); ?></div></td></tr>
			<?php endif; ?>
			<?php if ( $page ) : ?>
				<tr><th><?php esc_html_e( 'صفحه ارسال:', 'vira-sections' ); ?></th><td><a href="<?php echo esc_url( $page ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $page ); ?></a></td></tr>
			<?php endif; ?>
			<?php if ( $received ) : ?>
				<tr><th><?php esc_html_e( 'زمان دریافت:', 'vira-sections' ); ?></th><td><?php echo esc_html( $received ); ?></td></tr>
			<?php endif; ?>
			<?php if ( $ip ) : ?>
				<tr><th><?php esc_html_e( 'IP فرستنده:', 'vira-sections' ); ?></th><td class="ltr"><?php echo esc_html( $ip ); ?></td></tr>
			<?php endif; ?>
			<?php if ( $ua ) : ?>
				<tr><th><?php esc_html_e( 'User Agent:', 'vira-sections' ); ?></th><td class="ltr" style="font-size:11px;"><?php echo esc_html( $ua ); ?></td></tr>
			<?php endif; ?>
		</table>
		<?php
	}

	/**
	 * Remove "Quick Edit" from leads list.
	 *
	 * @param array   $actions
	 * @param WP_Post $post
	 * @return array
	 */
	public function row_actions( $actions, $post ) {
		if ( self::CPT !== $post->post_type ) {
			return $actions;
		}
		unset( $actions['inline hide-if-no-js'] );
		return $actions;
	}

	/**
	 * Remove "Edit" bulk action — only allow Trash.
	 *
	 * @param array $actions
	 * @return array
	 */
	public function bulk_actions( $actions ) {
		unset( $actions['edit'] );
		return $actions;
	}

	/**
	 * Tweak the leads admin table style.
	 */
	public function admin_styles() {
		$screen = get_current_screen();
		if ( ! $screen || self::CPT !== $screen->post_type ) {
			return;
		}
		?>
		<style>
			.column-title{width:25%;}
			.column-vira_phone{width:130px;}
			.column-vira_email{width:200px;}
			.column-vira_select{width:140px;}
			.column-date{width:150px;}
		</style>
		<?php
	}

	/**
	 * Get total leads count.
	 *
	 * @return int
	 */
	public static function count() {
		$counts = wp_count_posts( self::CPT );
		return isset( $counts->publish ) ? (int) $counts->publish : 0;
	}
}
