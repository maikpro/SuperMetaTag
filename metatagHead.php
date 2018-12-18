<?php

add_action('wp_head', 'addMetaTags');

function addMetaTags(){
    /*SEO Tags*/
    $Description = esc_attr(get_option('Description'));
    $Keywords = esc_attr(get_option('Keywords'));
    /**/
    
    /*OG Tags */
    $ogTitle = esc_attr(get_option('Title'));
    $ogDescription = esc_attr(get_option('Ogdescription'));
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

        <!---OG Tags--->
    <!---SuperMetaTag Plugin by Maik Proba --->


    ';
}
