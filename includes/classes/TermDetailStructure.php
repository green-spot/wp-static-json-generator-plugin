<?php

namespace StaticJsonGenerator;

class TermDetailStructure {
  public string $taxonomy;
  public string $file_name;
  public $normalizer;

  public function __construct($taxonomy, $file_name, $normalizer){
    $this->taxonomy = $taxonomy;
    $this->file_name = $file_name;
    $this->normalizer = $normalizer;
  }

  public function getFileName($term){
    return str_replace(["[id]", "[slug]"], [$term->term_id, $term->slug], $this->file_name);
  }

  public function saveJson($term){
    $data = ($this->normalizer)($term);
    $file_name = $this->getFileName($term);
    DataStore::saveJson($file_name, $data);
  }

  public function removeJson($term){
    $file_name = $this->getFileName($term);
    DataStore::removeJson($file_name);
  }
}
