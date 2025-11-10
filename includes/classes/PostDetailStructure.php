<?php

namespace StaticJsonGenerator;

class PostDetailStructure {
  public array $post_types;
  public string $file_name;
  public $normalizer;

  public function __construct($post_types, $file_name, $normalizer){
    $this->post_types = $post_types;
    $this->file_name = $file_name;
    $this->normalizer = $normalizer;
  }

  public function getFileName($post){
    return str_replace(["[id]", "[slug]"], [$post->ID, $post->post_name], $this->file_name);
  }

  public function saveJson($post){
    $data = ($this->normalizer)($post);
    $file_name = $this->getFileName($post);

    DataStore::saveJson($file_name, $data, true);

    if($post->status === "publish"){
      DataStore::saveJson($file_name, $data);
    }
  }

  public function removeJson($post){
    $file_name = $this->getFileName($post);
    DataStore::removeJson($file_name);
    DataStore::removeJson($file_name, true);
  }
}
