<?php

namespace StaticJsonGenerator;

class PostListStructure {
  public array $post_types;
  public string $file_name;
  public $normalizer;
  private array $options = ["posts_per_page" => -1];

  public function __construct($post_types, $file_name, $normalizer){
    $this->post_types = $post_types;
    $this->file_name = $file_name;
    $this->normalizer = $normalizer;
  }

  public function addOption($k, $v){
    $this->options[$k] = $v;
  }

  public function getOptions(){
    $options = [...$this->options];
    $options["post_type"] = $this->post_types;
    $options["post_status"] = "publish";
    return $options;
  }

  public function getDraftOptions(){
    $options = $this->getOptions();
    $options["post_status"] = ["publish", "draft"];
    return $options;
  }

  public function saveJson(){
    $posts = get_posts($this->getOptions());
    $data = ($this->normalizer)($posts);
    DataStore::saveJson($this->file_name, $data);

    $posts = get_posts($this->getDraftOptions());
    $data = ($this->normalizer)($posts);
    DataStore::saveJson($this->file_name, $data, true);
  }
}
