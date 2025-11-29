<?php
/**
 * Plugin Name: Elementor Menu Widget
 * Description: Custom Elementor widget for menu toggle
 * Version: 1.0.0
 * Author: Your Name
 * Text Domain: elementor-menu-widget
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Main Elementor Menu Widget Class
 */
final class Elementor_Menu_Widget {

    const VERSION = '1.0.0';
    const MINIMUM_ELEMENTOR_VERSION = '3.0.0';
    const MINIMUM_PHP_VERSION = '7.0';

    private static $_instance = null;

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        add_action('plugins_loaded', [$this, 'init']);
    }

    public function init() {
        // Check if Elementor is installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
            return;
        }

        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return;
        }

        // Check for required PHP version
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return;
        }

        // Register widget
        add_action('elementor/widgets/register', [$this, 'register_widgets']);

        // Register widget styles
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'widget_styles']);

        // Register widget scripts
        add_action('elementor/frontend/after_register_scripts', [$this, 'widget_scripts']);
    }

    public function admin_notice_missing_main_plugin() {
        if (isset($_GET['activate'])) unset($_GET['activate']);
        $message = sprintf(
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'elementor-menu-widget'),
            '<strong>' . esc_html__('Elementor Menu Widget', 'elementor-menu-widget') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'elementor-menu-widget') . '</strong>'
        );
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    public function admin_notice_minimum_elementor_version() {
        if (isset($_GET['activate'])) unset($_GET['activate']);
        $message = sprintf(
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-menu-widget'),
            '<strong>' . esc_html__('Elementor Menu Widget', 'elementor-menu-widget') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'elementor-menu-widget') . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    public function admin_notice_minimum_php_version() {
        if (isset($_GET['activate'])) unset($_GET['activate']);
        $message = sprintf(
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-menu-widget'),
            '<strong>' . esc_html__('Elementor Menu Widget', 'elementor-menu-widget') . '</strong>',
            '<strong>' . esc_html__('PHP', 'elementor-menu-widget') . '</strong>',
            self::MINIMUM_PHP_VERSION
        );
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    public function register_widgets($widgets_manager) {
        require_once(__DIR__ . '/widgets/menu-toggle-widget.php');
        $widgets_manager->register(new \Elementor_Menu_Toggle_Widget());
        
        require_once(__DIR__ . '/widgets/menu-toggle-widget-v2.php');
        $widgets_manager->register(new \Elementor_Menu_Toggle_Widget_V2());
    }

    public function widget_styles() {
        wp_enqueue_style('elementor-menu-widget', plugins_url('assets/css/menu-widget.css', __FILE__), [], self::VERSION);
    }

    public function widget_scripts() {
        wp_register_script('elementor-menu-widget', plugins_url('assets/js/menu-widget.js', __FILE__), ['jquery'], self::VERSION, true);
    }
}

Elementor_Menu_Widget::instance();
