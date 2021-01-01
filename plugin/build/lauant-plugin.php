<?php //phpcs:ignore WordPress.Files.Filename.InvalidClassFileName
/**
 * Plugin Name:       Lauant Plugin
 * Plugin URI:        https://lauant.com
 * Description:       Connect parts of your site to mailchimp
 * Version:           0.0.1
 * Requires at least: 5.0
 * Requires PHP:      7.0
 * Author:            Subaphotic
 * Author URI:        https://lauant.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       mailchimp
 * Domain Path:       /languages
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    die();
}

require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
require_once 'defines.php';
require_once 'includes/Utility.php';

use const PLUGIN_URL;
use Utility as U;

class Init{

    public function __construct(){
        add_action( 'wp_ajax_nopriv_sba_controller', array( 'SBA\\MCD\\Controller', 'main' ) );
        add_action( 'wp_ajax_sba_controller', array( 'SBA\\MCD\\Controller', 'main' ) );

        if ( ! is_admin() ) {
            add_action( 'wp_enqueue_scripts', array( $this, 'load_client_assets' ) );
        }
        // require_once 'includes/elementor/Widgets.php';
    }

    public function create_menu(){
        add_menu_page(
            __( 'Mailchimp Direct', 'textdomain' ),
            'Mailchimp Direct',
            'manage_options',
            'mailchimp-direct',
            array( $this, 'admin_root' ),
            'dashicons-networking',
            6
        );
    }

    public function load_client_assets() {

        wp_enqueue_style( 'sba-dashboard-icons', 'https://use.fontawesome.com/releases/v5.15.1/css/all.css', false, '1.0.0' );

        wp_enqueue_media();
        wp_enqueue_style(
            'sba-client-css', // Handle.
            PLUGIN_URL . '/dist/client/sba-client-app.css', // Block style CSS.
            null,
            '1.0.0' // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.style.build.css' ) // Version: File modification time.
        );

        wp_enqueue_script(
            'sba-client-js', // Handle.
            PLUGIN_URL . '/dist/client/sba-client-app.js', // Block.build.js: We register the block here. Built with Webpack.
            array( 'wp-i18n' ), // Dependencies, defined above.
            '0.0.1', // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
            true // Enqueue the script in the footer.
        );
        wp_localize_script(
            'sba-client-js',
            'app_data', // Array containing dynamic data for a JS Global.
            array(
                'pluginDirPath' => plugin_dir_path( __DIR__ ),
                'pluginDirUrl'  => plugin_dir_url( __DIR__ ),
                'ajax_url'      => admin_url( 'admin-ajax.php' ),
                // Add more data here that you want to access from `cgbGlobal` object.
            )
        );
    }
}

( new Init() );
