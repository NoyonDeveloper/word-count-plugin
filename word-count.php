<?php
/*
Plugin Name: Word Count
Plugin URI: noyonhossain560@gmail.com
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Word Count. When activated you will randomly see a lyric from Word Count in the upper right of your admin screen on every page.
Version: 1.0.0
Author: Noyon Hossain
Author URI: noyonhossain560@gmail.com
License: GPLv2 or Later
Text Domain: wordcount
Domain Path: /languages
 */

/*function wordcount_activation_hook(){

}
register_activation_hook( __FILE__, "wordcount_activation_hook" );

function wordcount_deactivation_hook(){

}
register_deactivation_hook( __FILE__, "wordcount_deactivation_hook" );*/

function wordcount_loaded_textdomain() {
    load_plugin_textdomain( "wordcount", false, dirname( __FILE__ ) . '/languages' );
}
add_action( "plugin_loaded", "wordcount_loaded_textdomain" );

function wordcount_counting_word_content( $content ) {
    $strip_content = strip_tags( $content );
    $words_count = str_word_count( $strip_content );
    $label = __( "Total Word Count", "wordcount" );

    $label_heading = apply_filters( "wordcount_label_heading", $label );
    $content_tag = apply_filters( "wordcount_tag_change", 'h2' );
    $content .= sprintf( "<%s>%s: %s</%s>", $content_tag, $label_heading, $words_count, $content_tag );
    return $content;
}
add_filter( "the_content", "wordcount_counting_word_content" );

function wordcount_reding_time( $redingtime ) {
    $reding_content = strip_tags( $redingtime );
    $reding_words = str_word_count( $reding_content );
    $reding_minute = floor( $reding_words / 200 );
    $reding_secound = floor( $reding_words % 200 / ( 200 / 60 ) );
    $is_visable = apply_filters( "wordcount_reding_time_display", 1 );
    if ( $is_visable ) {
        $label = __( "Total Reding Time", "wordcount" );
        $reding_label = apply_filters( "wordcount_reding_label", $label );
        $reding_tag = apply_filters( "wordcount_reding_tag", 'h4' );
        $redingtime .= sprintf( '<%s>%s: %s minute %s secound</%s>', $reding_tag, $reding_label, $reding_minute, $reding_secound, $reding_tag );

    }
    return $redingtime;
}
add_filter( "the_content", "wordcount_reding_time" );
