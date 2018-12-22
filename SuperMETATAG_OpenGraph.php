<?php

/*REMOVE SCRIPT */
//wp_dequeue_script( 'counting_script' );
/**/

/*Add Script */
wp_enqueue_script('opengraph_script', plugin_dir_url(__FILE__).'OpenGraph.js', array('jquery')); 
/**/



add_action('admin_menu', 'supermetatag_og_page');

function supermetatag_og_page(){
    
    add_submenu_page( 
        'supermetatag', 
        'SuperMetaTag 1.0', 
        'Open Graph Tags', 
        'manage_options', 
        'supermetatag-opengraphtags', 
        'supermetatag_og_page_html'
    );
}

function supermetatag_og_page_html()
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
            settings_fields('supermetatag-og-group');
            // output setting sections and their fields
            // (sections are registered for "wporg", each field is registered to a specific section)
            do_settings_sections('supermetatag-opengraphtags');
            // output save settings button
            submit_button();
            ?>
        </form>
        <h2 style="float: right;">by Maik Proba</h2>
    </div>
    <?php
}

add_action('admin_menu', 'supermetatag_og_settings');

function supermetatag_og_settings(){
    register_setting('supermetatag-og-group', 'Title');
    register_setting('supermetatag-og-group', 'Ogdescription');
    register_setting('supermetatag-og-group', 'Ogurl');
    register_setting('supermetatag-og-group', 'Oglocale');
    register_setting('supermetatag-og-group', 'Ogimage');
    register_setting('supermetatag-og-group', 'Ogtype');
    
    add_settings_section('supermetatag-og-options', '<span class="dashicons dashicons-facebook"></span> Meta Tags for Facebook', 'supermetatag_og_options', 'supermetatag-opengraphtags');
   
    /*OG TAGS*/
    add_settings_field('supermetatag-og-title', '<span class="dashicons dashicons-format-quote"></span> Title', 'supermetatag_og_title', 'supermetatag-opengraphtags','supermetatag-og-options' );
    add_settings_field('supermetatag-og-description', '<span class="dashicons dashicons-editor-alignleft"></span> Description', 'supermetatag_og_description', 'supermetatag-opengraphtags','supermetatag-og-options' );
    add_settings_field('supermetatag-og-url', '<span class="dashicons dashicons-admin-links"></span> Url', 'supermetatag_og_url','supermetatag-opengraphtags','supermetatag-og-options' );
    add_settings_field('supermetatag-og-locale', '<span class="dashicons dashicons-location"></span> Locale', 'supermetatag_og_locale','supermetatag-opengraphtags','supermetatag-og-options' );
    add_settings_field('supermetatag-og-image', ' <span class="dashicons dashicons-format-image"></span> Image', 'supermetatag_og_image', 'supermetatag-opengraphtags','supermetatag-og-options' );
    add_settings_field('supermetatag-og-type', '<span class="dashicons dashicons-editor-help"></span> Type', 'supermetatag_og_type','supermetatag-opengraphtags','supermetatag-og-options' );
}

/*

<!-- SEO by Maik Proba --->
	<meta property="og:type" content="website" />
<!-- SEO by Maik Proba --->

*/

function supermetatag_og_options(){
    echo '';
}

function supermetatag_og_title(){
    $ogTitle = esc_attr(get_option('Title'));
    echo '<input id="Title" type="text" name="Title" value="'.$ogTitle.'" />';
}

function supermetatag_og_description(){
    $ogDescription = esc_attr(get_option('Ogdescription'));
    $copyDescription = esc_attr(get_option('Description'));
    echo '
    <Textarea id="Ogdescription" name="Ogdescription">'.$ogDescription.'</Textarea>
    <input style="display: none;" id="copyText" type="text" name="copyText" value="'.$copyDescription.'" />
    <input type="button" id="copyDescription" class="button button-secondary" value="Copy description from previous page"/>
    ';
}

function supermetatag_og_url(){
    $ogUrl = esc_attr(get_option('Ogurl'));
    if($ogUrl == ""){
        $ogUrl = esc_attr(update_option('Ogurl', site_url()));
        echo '<input id="Ogurl" type="text" name="Ogurl" value="'.site_url().'"/>';
    }
    else{
        echo '<input id="Ogurl" type="text" name="Ogurl" value="'.$ogUrl.'" />';
    }
}

function supermetatag_og_locale(){
    $ogLocale = esc_attr(get_option('Oglocale'));
    echo '

    <select id="DropdownLocale">
        <option value="de_DE">de_DE</option>
        <option value="en_US">en_US</option>
        <option value="it_IT">it_IT</option>
        <option value="en_GB">en_GB</option>
        <option value="fr_FR">fr_FR</option>
        <option value="cz_CZ">cz_CZ</option>
        <option value="pl_PL">pl_PL</option>
        <option value="ru_RU">ru_RU</option>
    </select>

    <input style="display: none;" id="Oglocale" type="text" name="Oglocale" value="'.$ogLocale.'" />
    <input type="button" id="addLocale" class="button button-secondary" value="Add another locale" />
    <div id="Flags"></div>';
}

function supermetatag_og_image(){
    /*Use MediaUploader */
    wp_enqueue_media();
    /**/

    $ogImage = esc_attr(get_option('Ogimage'));
    echo '<input id="Ogimage" type="text" name="Ogimage" value="'.$ogImage.'" />
    <input type="button" id="OgImageSelect" class="button button-secondary" value="Select Image"/>
    <br>
    <label><em>Best resolution: <span style="color: green;">1200 x 630px</span> or <span style="color: orange;">600 x 315px</span></em></label>';
}

function supermetatag_og_type(){
    $ogType = esc_attr(get_option('Ogtype'));
    echo '
    <select id="DropdownType">
        <option value="website">Website</option>
        <option value="article">Article</option>
        <option value="book">Book</option>
        <option value="product">Product</option>
        <option value="profile">Profile</option>
        <option value="restaurant.restaurant">Restaurant</option>
        <option value="video.movie">Video</option>
        <option value="music.song">Music Song</option>
        <option value="music.playlist">Music Playlist</option>
        <option value="place">Place</option>
    </select>
    
    <input style="display: none;" id="Ogtype" type="text" name="Ogtype" value="'.$ogType.'" />
    <input type="button" id="addType" class="button button-secondary" value="Add another type" />
    ';

}

