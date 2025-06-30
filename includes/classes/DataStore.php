<?php

namespace StaticJsonGenerator;

class DataStore {
  public static function saveJson($file_name, $data){
    $generator = StaticJsonGenerator::instance();
    $json_path = $generator->getJsonPath($file_name);

    if(!file_exists(dirname($json_path))) mkdir(dirname($json_path), 0755, true);
    file_put_contents($json_path, json_encode($data));
  }

  public static function removeJson($file_name){
    $generator = StaticJsonGenerator::instance();
    $json_path = $generator->getJsonPath($file_name);

    unlink($json_path);
  }
}
