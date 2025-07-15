<?php

namespace StaticJsonGenerator;

class PageDetailStructure {
  public array $slugs;
  public string $file_name;
  public $normalizer;

  public function __construct($slugs, $file_name, $normalizer){
    $this->slugs = $slugs;
    $this->file_name = $file_name;
    $this->normalizer = $normalizer;
  }

  public function getFileName($post){
    return str_replace(["[id]", "[slug]"], [$post->ID, $post->post_name], $this->file_name);
  }

  public function saveJson($post){
    $data = ($this->normalizer)($post);
    $file_name = $this->getFileName($post);

    DataStore::saveJson($file_name, $data);
  }

  public function removeJson($post){
    $file_name = $this->getFileName($post);
    DataStore::removeJson($file_name);
  }
}
