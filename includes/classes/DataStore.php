<?php

namespace StaticJsonGenerator;

class DataStore {
  public static function saveJson($file_name, $data, $is_draft=false){
    $generator = StaticJsonGenerator::instance();
    $json_path = $generator->getJsonPath($file_name, $is_draft);

    if(!file_exists(dirname($json_path))) mkdir(dirname($json_path), 0755, true);
    file_put_contents($json_path, json_encode($data));
  }

  public static function removeJson($file_name, $is_draft=false){
    $generator = StaticJsonGenerator::instance();
    $json_path = $generator->getJsonPath($file_name, $is_draft);

    unlink($json_path);
  }
}
