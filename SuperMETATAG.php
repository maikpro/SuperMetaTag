<?php 

/*
Plugin Name:  SuperMETATAG
Plugin URI:   https://mpcoding.de/plugins/supermetatag/
Description:  Wordpress Plugin to create SEO Meta Tags
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
        <h1><?= esc_html(get_admin_page_title()); ?></h1>
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

        <?php $Test = get_option('Description'); 
        echo '<label id="Result"></label>';
        ?>
        
    </div>
    <?php
}

/*Add a Top-Level Menu */
function supermetatag_options_page()
{
    add_menu_page(
        'SuperMetaTag',
        'Super Meta Tag',
        'manage_options',
        'supermetatag',
        'supermetatag_options_page_html',
        'https://dummyimage.com/20x20/00aeff/fff',
        /*plugin_dir_url(__FILE__) . 'images/icon_wporg.png',*/
        20
    );
}

add_action('admin_menu', 'supermetatag_options_page');
/************************************ */



/*Custom Settings */

add_action('admin_menu', 'supermetatag_custom_settings');

function supermetatag_custom_settings(){
    register_setting('supermetatag-settings-group', 'Description');
    register_setting('supermetatag-settings-group','Keywords');
    add_settings_section('supermetatag-options', 'Meta Tags', 'supermetatag_options', 'SuperMetaTag');
   
    /*META TAGS*/
    add_settings_field('supermetatag-description', 'Description', 'supermetatag_description', 'SuperMetaTag','supermetatag-options' );
    add_settings_field('supermetatag-keywords', 'Keywords', 'supermetatag_keywords', 'SuperMetaTag','supermetatag-options' );

}

/*

<!-- SEO by Maik Proba --->
	<meta name="description" content="Gemütliche Wohnzimmeratmosphäre, frischer Kaffee, Frühstück, leckerer Kuchen, Lunch, Snacks und eine große Auswahl an Kaltgetränken, mit Umdrehungen und ohne.">
	<meta name="keywords" content="Pensionschmidt,Münster,Kaffee,Cafe,Bar,Kultur,Culture,Tickets,Veranstaltungen,Quiche,Kuchen,Frühstück">
    
    <meta property="og:title" content="Pensionschmidt - Café, Bar und Kultur – seit 2012 mitten in Münster." />
	<meta property="og:description" content="Gemütliche Wohnzimmeratmosphäre, frischer Kaffee, Frühstück, leckerer Kuchen, Lunch, Snacks und eine große Auswahl an Kaltgetränken, mit Umdrehungen und ohne." />
	<meta property="og:url" content="http://www.pensionschmidt.se" />
	<meta property="og:locale" content="de_DE" />
	<meta property="og:image" content="http://www.pensionschmidt.se/wp-content/uploads/2018/11/PensionSchmidt-Logo-Slider.svg" />
	<meta property="og:type" content="website" />
<!-- SEO by Maik Proba --->

*/


function supermetatag_options(){
    echo '';
}


function supermetatag_description(){
    $Description = esc_attr(get_option('Description'));
    echo '<Textarea style="width: 500px;" id="Description" name="Description" value="'.$Description.'"></Textarea>
    <label id="Result"></label>
    ';
}

function supermetatag_keywords(){
    $Keywords = esc_attr(get_option('Keywords'));
    echo '<input type="text" name="Keywords" value="'.$Keywords.'" />';
}


/*Add Script */
wp_enqueue_script('custom_script', plugin_dir_url(__FILE__).'Counting.js', array('jquery')); 
