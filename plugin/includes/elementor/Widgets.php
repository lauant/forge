<?php

class Elementor_Widgets {

	protected static $instance = null;

	public static function get_instance() {
		if ( ! isset( static::$instance ) ) {
			static::$instance = new static;
		}

		return static::$instance;
	}

	protected function __construct() {
		require_once('MailchimpButton.php');
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}

	public function register_widgets() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Mailchimp_Button() );
	}

}

add_action( 'init', 'sba_elementor_init' );
function sba_elementor_init() {
	Elementor_Widgets::get_instance();
}