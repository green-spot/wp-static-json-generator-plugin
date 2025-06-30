<?php

namespace StaticJsonGenerator;

add_action('admin_enqueue_scripts', function(){
  $url = plugin_dir_url(__DIR__);

  wp_enqueue_style('my_admin_css', $url.'assets/css/admin.css', [], filemtime(__DIR__ . "/../assets/css/admin.css"));
  wp_enqueue_script('my_admin_script', $url.'assets/js/admin.js', [], filemtime(__DIR__ . "/../assets/js/admin.js"));
});

add_action('admin_bar_menu', function($wp_admin_bar) {
  if (!is_admin()) return;

  $wp_admin_bar->add_node([
    'id'    => 'sjg-js-button',
    'title' => 'Update Static JSON',
    'href'  => '#',
    'meta'  => [
      'class' => 'sjg-update-all-json-button',
      'title' => 'Update All JSON',
    ],
  ]);
}, 100);
