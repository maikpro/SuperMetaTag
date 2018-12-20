<?php 

/*
Plugin Name:  SuperMETATAG
Plugin URI:   https://mpcoding.de/plugins/supermetatag/
Description:  A simple Wordpress Plugin to create SEO Meta Tags for Google, Facebook and Twitter.
Version:      1.0
Author:       Maik Proba
Author URI:   https://mpcoding.de/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
function supermetatag_options_page_html()
{
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?= esc_html(get_admin_page_title());?></h1>
        <?php settings_errors(); ?>
        <form method="post" action="options.php">
            
            <?php
            // output security fields for the registered setting "wporg_options"
            settings_fields('supermetatag-settings-group');
            // output setting sections and their fields
            // (sections are registered for "wporg", each field is registered to a specific section)
            do_settings_sections('SuperMetaTag');
            // output save settings button
            submit_button();
            ?>
        </form>
        
    </div>
    <?php
}

/*Add a Top-Level Menu */
function supermetatag_options_page()
{
    add_menu_page(
        'SuperMetaTag 1.0',
        'SuperMetaTag',
        'manage_options',
        'supermetatag',
        'supermetatag_options_page_html',
        plugin_dir_url(__FILE__) . '/logo/smt_logo.svg',
        20
    );
}
add_action('admin_menu', 'supermetatag_options_page');
/************************************ */

/*Meta Tags for Search Engines*/
add_action('admin_menu', 'supermetatag_seo_settings');

function supermetatag_seo_settings(){
    register_setting('supermetatag-settings-group', 'Description');
    register_setting('supermetatag-settings-group','Keywords');
    add_settings_section('supermetatag-options', 'Meta Tags for Search Engines', 'supermetatag_options', 'SuperMetaTag');
   
    /*META TAGS*/
    add_settings_field('supermetatag-description', '<span class="dashicons dashicons-editor-alignleft"></span> Description', 'supermetatag_description', 'SuperMetaTag','supermetatag-options' );
    add_settings_field('supermetatag-keywords', '<span class="dashicons dashicons-search"></span> Keywords', 'supermetatag_keywords', 'SuperMetaTag','supermetatag-options' );
}
/**/

function supermetatag_options(){
    echo '';
}

/*SEO META TAGS */
function supermetatag_description(){
    $Description = esc_attr(get_option('Description'));
    echo '<Textarea id="Description" name="Description">'.$Description.'</Textarea>
    <label id="Result"></label>
    <p><em>The Description should have at least <span style="color: red">140</span> characters. Everything below is <span style="color: red;">bad</span>.</p> 
    <p>Anything between <span style="color: orange">140</span> and <span style="color: orange">150</span> characters is <span style="color: orange">OK</span>. 160 characters are <span style="color: green">perfect</span>. </em></p>
    ';
}

function supermetatag_keywords(){
    $Keywords = esc_attr(get_option('Keywords'));
    echo '<input id="Keywords" type="text" name="Keywords" value="'.$Keywords.'" />
    <p><em>Separate each <strong>keyword</strong> with a comma <code>,</code><em></p>';
}
/**/

/*Add Script */
wp_enqueue_script('counting_script', plugin_dir_url(__FILE__).'/js/Counting.js', array('jquery')); 
/**/

/*Add Style */
wp_enqueue_style('custom_style', plugin_dir_url(__FILE__).'/css/Style.css', null);
/**/

/*Add php file */
include( plugin_dir_path( __FILE__ ) . 'SuperMetaTag_createHead.php');
include( plugin_dir_path( __FILE__ ) . 'SuperMetaTag_OpenGraph.php');
/**/