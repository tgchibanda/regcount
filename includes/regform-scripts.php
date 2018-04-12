<?php

//Add scripts

function regfrm_add_scripts(){
    // Add main css
    wp_enqueue_style('regfrm-main-style', plugins_url().'/regform/css/style.css');

    // Add main js
    wp_enqueue_script('regfrm-main-script', plugins_url().'/regform/js/main.js');

   
}

add_action('wp_enqueue_scripts', 'regfrm_add_scripts');