<?php
/**
 * Welcome Screen Class
 */
class Parallax_One_Welcome {

	/**
	 * Constructor for the welcome screen
	 */
	public function __construct() {

		/* create dashbord page */
		add_action( 'admin_menu', array( $this, 'parallax_one_welcome_register_menu' ) );

		/* activation notice */
		add_action( 'load-themes.php', array( $this, 'parallax_one_activation_admin_notice' ) );

		/* enqueue script and style for welcome screen */
		add_action( 'admin_enqueue_scripts', array( $this, 'parallax_one_welcome_style_and_scripts' ) );
		
		/* enqueue script for customizer */
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'parallax_one_welcome_scripts_for_customizer' ) );

		/* load welcome screen */
		add_action( 'parallax_one_welcome', array( $this, 'parallax_one_welcome_getting_started' ), 	    10 );
		add_action( 'parallax_one_welcome', array($this, 'parallax_one_welcome_actions_required' ),         20 );
		add_action( 'parallax_one_welcome', array( $this, 'parallax_one_welcome_github' ), 		            30 );
		add_action( 'parallax_one_welcome', array( $this, 'parallax_one_welcome_changelog' ), 				40 );
		
		/* ajax callback for dismissable required actions */
		add_action( 'wp_ajax_parallax_one_dismiss_required_action', array( $this, 'parallax_one_dismiss_required_action_callback') );
		add_action( 'wp_ajax_nopriv_parallax_one_dismiss_required_action', array($this, 'parallax_one_dismiss_required_action_callback') );

	}

	/**
	 * Creates the dashboard page
	 * @see  add_theme_page()
	 */
	public function parallax_one_welcome_register_menu() {
		add_theme_page( 'About Llorix One', 'About Llorix One', 'activate_plugins', 'parallax-one-welcome', array( $this, 'parallax_one_welcome_screen' ) );
	}

	/**
	 * Adds an admin notice upon successful activation.
	 */
	public function parallax_one_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'parallax_one_welcome_admin_notice' ), 99 );
		}
	}

	/**
	 * Display an admin notice linking to the welcome screen
	 */
	public function parallax_one_welcome_admin_notice() {
		?>
			<div class="updated notice is-dismissible">
				<p><?php echo sprintf( esc_html__( 'Welcome! Thank you for choosing Llorix One! To fully take advantage of the best our theme can offer please make sure you visit our %swelcome page%s.', 'llorix-one' ), '<a href="' . esc_url( admin_url( 'themes.php?page=parallax-one-welcome' ) ) . '">', '</a>' ); ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=parallax-one-welcome' ) ); ?>" class="button" style="text-decoration: none;"><?php _e( 'Get started with Llorix One', 'llorix-one' ); ?></a></p>
			</div>
		<?php
	}

	/**
	 * Load welcome screen css and javascript
	 */
	public function parallax_one_welcome_style_and_scripts( $hook_suffix ) {

		if ( 'appearance_page_parallax-one-welcome' == $hook_suffix ) {
			wp_enqueue_style( 'parallax-one-welcome-screen-css', get_template_directory_uri() . '/inc/admin/welcome-screen/css/welcome.css' );
			wp_enqueue_script( 'parallax-one-welcome-screen-js', get_template_directory_uri() . '/inc/admin/welcome-screen/js/welcome.js', array('jquery') );
			
			global $llorix_one_required_actions;
			
			$nr_actions_required = 0;
			
			/* get number of required actions */
			if( get_option('parallax_one_show_required_actions') ):
				$llorix_one_show_required_actions = get_option('parallax_one_show_required_actions');
			else:
				$llorix_one_show_required_actions = array();
			endif;
			if( !empty($llorix_one_required_actions) ):
				foreach( $llorix_one_required_actions as $llorix_one_required_action_value ):
					if(( !isset( $llorix_one_required_action_value['check'] ) || ( isset($llorix_one_required_action_value['check'] ) && ( $llorix_one_required_action_value['check'] == false ) ) ) && ( (isset($llorix_one_show_required_actions[$llorix_one_required_action_value['id']]) && ($llorix_one_show_required_actions[$llorix_one_required_action_value['id']] == true)) || !isset($llorix_one_show_required_actions[$llorix_one_required_action_value['id']]) )) :
						$nr_actions_required++;
					endif;
				endforeach;
			endif;
			wp_localize_script( 'parallax-one-welcome-screen-js', 'parallaxOneWelcomeScreenObject', array(
				'nr_actions_required' => $nr_actions_required,
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'template_directory' => get_template_directory_uri(),
				'no_required_actions_text' => __( 'Hooray! There are no required actions for you right now.','llorix-one' )
			) );
		}
	}
	
	/**
	 * Load scripts for customizer page
	 */
	public function parallax_one_welcome_scripts_for_customizer() {
		
		wp_enqueue_style( 'parallax-one-welcome-screen-customizer-css', get_template_directory_uri() . '/inc/admin/welcome-screen/css/welcome_customizer.css' );
		wp_enqueue_script( 'parallax-one-welcome-screen-customizer-js', get_template_directory_uri() . '/inc/admin/welcome-screen/js/welcome_customizer.js', array('jquery'), '20120206', true );
		
		global $llorix_one_required_actions;
		$nr_actions_required = 0;
		/* get number of required actions */
		if( get_option('parallax_one_show_required_actions') ):
			$llorix_one_show_required_actions = get_option('parallax_one_show_required_actions');
		else:
			$llorix_one_show_required_actions = array();
		endif;
		if( !empty($llorix_one_required_actions) ):
			foreach( $llorix_one_required_actions as $llorix_one_required_action_value ):
				if(( !isset( $llorix_one_required_action_value['check'] ) || ( isset( $llorix_one_required_action_value['check'] ) && ( $llorix_one_required_action_value['check'] == false ) ) ) && ((isset($llorix_one_show_required_actions[$llorix_one_required_action_value['id']]) && ($llorix_one_show_required_actions[$llorix_one_required_action_value['id']] == true)) || !isset($llorix_one_show_required_actions[$llorix_one_required_action_value['id']]) )) :
					$nr_actions_required++;
				endif;
			endforeach;
		endif;
		wp_localize_script( 'parallax-one-welcome-screen-customizer-js', 'parallaxOneWelcomeScreenCustomizerObject', array(
			'nr_actions_required' => $nr_actions_required,
			'aboutpage' => esc_url( admin_url( 'themes.php?page=parallax-one-welcome' ) ),
			'customizerpage' => esc_url( admin_url( 'customize.php#actions_required' ) ),
			'themeinfo' => __('View Theme Info','llorix-one'),
		) );
	}
	
	/**
	 * Dismiss required actions
	 */
	public function parallax_one_dismiss_required_action_callback() {
		
		global $llorix_one_required_actions;
		
		$llorix_one_dismiss_id = (isset($_GET['dismiss_id'])) ? $_GET['dismiss_id'] : 0;
		echo $llorix_one_dismiss_id; /* this is needed and it's the id of the dismissable required action */
		if( !empty($llorix_one_dismiss_id) ):
			/* if the option exists, update the record for the specified id */
			if( get_option('parallax_one_show_required_actions') ):
				$llorix_one_show_required_actions = get_option('parallax_one_show_required_actions');
				$llorix_one_show_required_actions[$llorix_one_dismiss_id] = false;
				update_option( 'parallax_one_show_required_actions',$llorix_one_show_required_actions );
			/* create the new option,with false for the specified id */
			else:
				$llorix_one_show_required_actions_new = array();
				if( !empty($llorix_one_required_actions) ):
					foreach( $llorix_one_required_actions as $llorix_one_required_action ):
						if( $llorix_one_required_action['id'] == $llorix_one_dismiss_id ):
							$llorix_one_show_required_actions_new[$llorix_one_required_action['id']] = false;
						else:
							$llorix_one_show_required_actions_new[$llorix_one_required_action['id']] = true;
						endif;
					endforeach;
				update_option( 'parallax_one_show_required_actions', $llorix_one_show_required_actions_new );
				endif;
			endif;
		endif;
		die(); // this is required to return a proper result
	}


	/**
	 * Welcome screen content
	 */
	public function parallax_one_welcome_screen() {

		require_once( ABSPATH . 'wp-load.php' );
		require_once( ABSPATH . 'wp-admin/admin.php' );
		require_once( ABSPATH . 'wp-admin/admin-header.php' );
		?>

		<ul class="parallax-one-nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#getting_started" aria-controls="getting_started" role="tab" data-toggle="tab"><?php esc_html_e( 'Getting started','llorix-one'); ?></a></li>
			<li role="presentation" class="parallax-one-w-red-tab"><a href="#actions_required" aria-controls="actions_required" role="tab" data-toggle="tab"><?php esc_html_e( 'Actions required','llorix-one'); ?></a></li>
			<li role="presentation"><a href="#github" aria-controls="github" role="tab" data-toggle="tab"><?php esc_html_e( 'Contribute','llorix-one'); ?></a></li>
			<li role="presentation"><a href="#changelog" aria-controls="changelog" role="tab" data-toggle="tab"><?php esc_html_e( 'Changelog','llorix-one'); ?></a></li>
		</ul>

		<div class="parallax-one-tab-content">

			<?php
			/**
			 * @hooked parallax_one_welcome_getting_started - 10
			 * @hooked parallax_one_welcome_actions_required - 20
			 * @hooked parallax_one_welcome_child_themes - 30
			 * @hooked parallax_one_welcome_github - 40
			 * @hooked parallax_one_welcome_changelog - 50
			 * @hooked parallax_one_welcome_free_pro - 60
			 */
			do_action( 'parallax_one_welcome' ); ?>

		</div>
		<?php
	}

	/**
	 * Getting started
	 */
	public function parallax_one_welcome_getting_started() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/getting-started.php' );
	}

	/**
	 * Actions required
	 */
	public function parallax_one_welcome_actions_required() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/actions-required.php' );
	}


	/**
	 * Contribute
	 */
	public function parallax_one_welcome_github() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/github.php' );
	}

	/**
	 * Changelog
	 */
	public function parallax_one_welcome_changelog() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/changelog.php' );
	}


}

$GLOBALS['Parallax_One_Welcome'] = new Parallax_One_Welcome();