<?php

namespace StaticJsonGenerator;

require_once __DIR__ . "/PostListStructure.php";
require_once __DIR__ . "/PostDetailStructure.php";
require_once __DIR__ . "/PageDetailStructure.php";
require_once __DIR__ . "/TermListStructure.php";
require_once __DIR__ . "/TermDetailStructure.php";
require_once __DIR__ . "/DataStore.php";

class StaticJsonGenerator {
  private static $instance;
  private array $structures;
  public string $data_directory;
  public string $draft_data_directory;

  public function __construct(){
    $this->structures = [
      "post_list" => [],
      "post_detail" => [],
      "page_detail" => [],
      "term_list" => [],
      "term_detail" => []
    ];
    $this->data_directory = ABSPATH . "/";
  }

  public static function instance(){
    if(!self::$instance) self::$instance = new self;
    return self::$instance;
  }

  public function setDataDirectory($dir){
    $this->data_directory = $dir;
  }

  public function setDraftDataDirectory($dir){
    $this->draft_data_directory = $dir;
  }

  private function addStructure($type, $structure){
    $this->structures[$type][] = $structure;
  }

  public function getJsonPath($file_name, $is_draft=false){
    return rtrim($is_draft ? $this->draft_data_directory : $this->data_directory, "/") . "/{$file_name}.json";
  }

  public function addPostListStructure($post_types, $file_name, $normalizer){
    if(is_string($post_types)) $post_types = [$post_types];
    $structure = new PostListStructure($post_types, $file_name, $normalizer);

    $this->addStructure("post_list", $structure);
  }

  public function addPostDetailStructure($post_types, $file_name, $normalizer){
    if(is_string($post_types)) $post_types = [$post_types];
    $structure = new PostDetailStructure($post_types, $file_name, $normalizer);

    $this->addStructure("post_detail", $structure);
  }

  public function addPageDetailStructure($slugs, $file_name, $normalizer){
    if(is_string($slugs)) $slugs = [$slugs];
    $structure = new PageDetailStructure($slugs, $file_name, $normalizer);

    $this->addStructure("page_detail", $structure);
  }

  public function addTermListStructure($taxonomy, $file_name, $normalizer){
    $structure = new TermListStructure($taxonomy, $file_name, $normalizer);

    $this->addStructure("term_list", $structure);
  }

  public function addTermDetailStructure($taxonomy, $file_name, $normalizer){
    $structure = new TermDetailStructure($taxonomy, $file_name, $normalizer);

    $this->addStructure("term_detail", $structure);

  }

  public function getPostListStructures(){
    return $this->structures["post_list"];
  }

  public function getPostDetailStructures(){
    return $this->structures["post_detail"];
  }

  public function getPageDetailStructures(){
    return $this->structures["page_detail"];
  }

  public function getTermListStructures(){
    return $this->structures["term_list"];
  }

  public function getTermDetailStructures(){
    return $this->structures["term_detail"];
  }
}