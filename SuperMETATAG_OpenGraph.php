<?php

add_action('admin_menu', 'supermetatag_og_page');

function supermetatag_og_page(){
    
    add_submenu_page( 
        'supermetatag', 
        'Super Meta Tag by Maik Proba', 
        'Open Graph Tags', 
        'manage_options', 
        'supermetatag-opengraphtags', 
        'supermetatag_og_page_html'
    );
}

/*
add_menu_page( 
    string $page_title, 
    string $menu_title, 
    string $capability, 
    string $menu_slug, 
    callable $function = '', 
    string $icon_url = '', 
    int $position = null 
)
*/

function supermetatag_og_page_html()
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
            settings_fields('supermetatag-og-group');
            // output setting sections and their fields
            // (sections are registered for "wporg", each field is registered to a specific section)
            do_settings_sections('supermetatag-opengraphtags');
            // output save settings button
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

add_action('admin_menu', 'supermetatag_og_settings');

function supermetatag_og_settings(){
    register_setting('supermetatag-og-group', 'Title');
    register_setting('supermetatag-og-group', 'Ogdescription');
    
    add_settings_section('supermetatag-og-options', 'Meta Tags for Open Graph / Social Media', 'supermetatag_og_options', 'supermetatag-opengraphtags');
   
    /*OG TAGS*/
    add_settings_field('supermetatag-og-title', 'Title', 'supermetatag_og_title', 'supermetatag-opengraphtags','supermetatag-og-options' );
    add_settings_field('supermetatag-og-description', 'Description', 'supermetatag_og_description', 'supermetatag-opengraphtags','supermetatag-og-options' );
}

/*

<!-- SEO by Maik Proba --->
	<meta property="og:description" content="Gemütliche Wohnzimmeratmosphäre, frischer Kaffee, Frühstück, leckerer Kuchen, Lunch, Snacks und eine große Auswahl an Kaltgetränken, mit Umdrehungen und ohne." />
	<meta property="og:url" content="http://www.pensionschmidt.se" />
	<meta property="og:locale" content="de_DE" />
	<meta property="og:image" content="http://www.pensionschmidt.se/wp-content/uploads/2018/11/PensionSchmidt-Logo-Slider.svg" />
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
    echo '<input id="Ogdescription" type="text" name="Ogdescription" value="'.$ogDescription.'" />';
}