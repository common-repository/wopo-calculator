<?php
/**
 * Plugin Name:       WoPo Calculator
 * Plugin URI:        https://wopoweb.com/contact-us/
 * Description:       Microsoft Calculator clone for your website
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.1
 * Author:            WoPo Web
 * Author URI:        https://wopoweb.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wopo-calculator
 * Domain Path:       /languages
 */

function wopocc_get_app_url(){
    return plugins_url('html/app/index.html',__FILE__);
}

add_action('wp_enqueue_scripts', 'wopocc_enqueue_scripts');

function wopocc_enqueue_scripts(){
    global $post;
    $is_shortcode = intval(has_shortcode( $post->post_content, 'wopo-calculator'));
    if ((function_exists('wopopp_add_drawing_button') && is_singular()) || $is_shortcode){
        wp_enqueue_style('XP',plugins_url( '/assets/css/XP.css', __FILE__ ));
        wp_enqueue_style('wopo-calculator',plugins_url( '/assets/css/main.css', __FILE__ ));
        wp_enqueue_script('wopo-calculator', plugins_url( '/assets/js/main.js', __FILE__ ),array('jquery'));
        wp_localize_script( 'wopo-calculator', 'wopo_calculator', array(
            'app_url' => wopocc_get_app_url(),
            'is_shortcode' => $is_shortcode,
        ) ); 
        do_action('wopo_calculator_enqueue_scripts');
    }
}

add_shortcode('wopo-calculator', 'wopo_calculator_shortcode');
function wopo_calculator_shortcode( $atts = [], $content = null) {
    ob_start();?>
    <div id="wopo_calculator_window" class="window">
        <div class="title-bar">
            <div class="title-bar-text"><?php echo __('WoPo Calculator','wopo-calculator') ?></div>
            <div class="title-bar-controls">
            <button class="btn-minimize" aria-label="Minimize"></button>
            <button class="btn-maximize" aria-label="Maximize"></button>
            <button class="btn-close" aria-label="Close"></button>
            </div>
        </div>
        <div class="window-body">
            <iframe id="wopo_calculator"></iframe>
        </div>
    </div>
    <?php
    $content = ob_get_clean();
    return $content;
}