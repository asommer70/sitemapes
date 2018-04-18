<?php
/*
Plugin Name: Sitemapes
Plugin URI: https://sitemaps.thehoick.com/
Version: 0.0.1
Author: Adam Sommer
Description: Simple sitemap.xml creator.
*/


//
// Add a rewrite rule to intercept /sitemap.xml.
//
function sitemapes_rewrite_rule() {
  add_rewrite_rule( 'sitemap.xml$', 'index.php', 'top' );
}
add_action( 'init', 'sitemapes_rewrite_rule');


//
// Add sitemap query_var.
//
function sitemapes_query_vars($query_vars) {
  $query_vars[] = 'sitemap';
  return $query_vars;
}
add_filter( 'query_vars', 'sitemapes_query_vars' );


//
// Check the request for sitemap in query_vars and if it's there use the sitemap-template.xml file.
//
function sitemapes_parse_request(&$wp) {
  if (array_key_exists( 'sitemap', $wp->query_vars )) {
    header('Content-type: text/xml');
    include 'sitemap-template.xml';
    exit();
  }
  return;
}
add_action('parse_request', 'sitemapes_parse_request');
