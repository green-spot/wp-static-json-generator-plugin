<?php

namespace StaticJsonGenerator\Route;

function listPage(){
  include __DIR__ . "/views/list.php";
}

function settingPage(){
  include __DIR__ . "/views/settings.php";
}

add_action('admin_menu', function() {
  $cap = 'manage_options';

  add_menu_page(
    'JSON',
    'JSON',
    $cap,
    "static-json-generator",
    function(){
      listPage();
    },
    'dashicons-admin-generic',
    100
  );

  add_submenu_page(
    "static-json-generator",
    __( 'Settings', 'static-json-generator' ),
    __( 'Settings', 'static-json-generator' ),
    $cap,
    "static-json-generator-settings",
    function(){
      settingPage();
    }
  );
});
