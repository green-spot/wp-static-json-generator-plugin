<?php

namespace StaticJsonGenerator;

add_action( 'admin_enqueue_scripts', function() {
  $url = plugin_dir_url(__DIR__);
  wp_enqueue_script('my-custom-script', $url.'assets/js/admin.js', ['jquery'], filemtime(__DIR__ . "/../assets/js/admin.js"));

  // Nonceをローカライズ
  wp_localize_script(
    'my-custom-script', // Nonceを紐付けるスクリプトのハンドル名
    'myRestApi',         // JavaScriptでアクセスするグローバルオブジェクト名
    array(
      'root'  => esc_url_raw( rest_url() ), // REST APIのルートURL
      'nonce' => wp_create_nonce( 'wp_rest' ) // wp_restアクションに対するNonce
    )
  );
});

add_action('admin_enqueue_scripts', function(){
  $url = plugin_dir_url(__DIR__);

  wp_enqueue_style('my_admin_css', $url.'assets/css/admin.css', [], filemtime(__DIR__ . "/../assets/css/admin.css"));
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
