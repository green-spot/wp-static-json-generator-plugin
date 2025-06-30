<?php

namespace StaticJsonGenerator;

class TermListStructure {
  public string $taxonomy;
  public string $file_name;
  public $normalizer;
  private array $options = ["number" => -1];

  public function __construct($taxonomy, $file_name, $normalizer){
    $this->taxonomy = $taxonomy;
    $this->file_name = $file_name;
    $this->normalizer = $normalizer;
  }

  public function addOption($k, $v){
    $this->options[$k] = $v;
  }

  public function getOptions(){
    $options = [...$this->options];
    $options["taxonomy"] = $this->taxonomy;
    return $options;
  }

  public function getDraftOptions(){
    // TODO 下書き記事の有無を条件に追加
    return $this->getOptions();
  }

  public function saveJson(){
    $terms = get_terms($this->getOptions());
    $data = ($this->normalizer)($terms);
    DataStore::saveJson($this->file_name, $data);
  }
}
