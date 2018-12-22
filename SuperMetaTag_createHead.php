<?php

add_action('wp_head', 'supermetatagAddMetaTags');

function supermetatagAddMetaTags(){
    /*Search Engine Tags*/
    $Description = esc_attr(get_option('Description'));
    $Keywords = esc_attr(get_option('Keywords'));
    /**/
    
    /*Open Graph Tags */
    $ogTitle = esc_attr(get_option('Title'));
    $ogDescription = esc_attr(get_option('Ogdescription'));
    $ogUrl = esc_attr(get_option('Ogurl'));
    $ogLocale = esc_attr(get_option('Oglocale'));
    $ogImage = esc_attr(get_option('Ogimage'));
    $ogType = esc_attr(get_option('Ogtype'));
    /**/
    echo '
    
    <!---SuperMetaTag Plugin by Maik Proba --->
        <!---SEO Tags--->
        <meta name="description" content="'.$Description.'">
        <meta name="keywords" content="'.$Keywords.'">
        <!---SEO Tags--->

        <!---OG Tags--->
        <meta property="og:title" content="'.$ogTitle.'">
        <meta property="og:description" content="'.$ogDescription.'">
        <meta property="og:url" content="'.$ogUrl.'">
        <meta property="og:locale" content="'.$ogLocale.'">
        <meta property="og:image" content="'.$ogImage.'">
        <meta property="og:type" content="'.$ogType.'">
        <!---OG Tags--->
    <!---SuperMetaTag Plugin by Maik Proba --->
    ';
}
