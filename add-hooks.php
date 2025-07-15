<?php

namespace StaticJsonGenerator\AddHooks;

use StaticJsonGenerator\StaticJsonGenerator;

$generator = StaticJsonGenerator::instance();

/* --------------------------------------------------
 * Posts
 */

add_action("init", function() use($generator){
  do_action("generate_static_json", $generator);
});

add_action('wp_after_insert_post', function ($post_id) use($generator) {
  if(wp_is_post_revision($post_id)) return;

  $post = get_post($post_id);
  if(!$post) return;

  foreach($generator->getPostListStructures() as $structure){
    if(in_array($post->post_type, $structure->post_types)){
      $structure->saveJson();
    }
  }

  foreach($generator->getPostDetailStructures() as $structure){
    if(in_array($post->post_type, $structure->post_types)){
      $structure->saveJson($post);
    }
  }

  if($post->post_type === "page"){
    foreach($generator->getPageDetailStructures() as $structure){
      if(in_array($post->post_name, $structure->slugs)){
        $structure->saveJson($post);
      }
    }
  }
});

add_action('before_delete_post', function ($post_id) use($generator) {
  $post = get_post($post_id);
  if(!$post) return;

  foreach($generator->getPostListStructures() as $structure){
    if(in_array($post->post_type, $structure->post_types)){
      $structure->saveJson();
    }
  }

  foreach($generator->getPostDetailStructures() as $structure){
    if(in_array($post->post_type, $structure->post_types)){
      $structure->removeJson($post);
    }
  }

  if($post->post_type === "page"){
    foreach($generator->getPageDetailStructures() as $structure){
      if(in_array($post->post_name, $structure->slugs)){
        $structure->removeJson($post);
      }
    }
  }
});


/* --------------------------------------------------
 * Terms
 */

$saveTermHook = function($term_id, $tt_id, $taxonomy) use($generator){
  $term = get_term_by("id", $term_id);

  foreach($generator->getTermListStructures() as $structure){
    if($taxonomy === $structure->taxonomy){
      $structure->saveJson();
    }
  }

  foreach($generator->getTermDetailStructures() as $structure){
    if($taxonomy === $structure->taxonomy){
      $structure->saveJson($term);
    }
  }
};

add_action('created_term', $saveTermHook);
add_action('edited_term', $saveTermHook);

add_action('delete_term', function($term_id, $tt_id, $taxonomy, $deleted_term) use($generator) {
  foreach($generator->getTermListStructures() as $structure){
    if($taxonomy === $structure->taxonomy){
      $structure->saveJson();
    }
  }

  foreach($generator->getTermDetailStructures() as $structure){
    if($taxonomy === $structure->taxonomy){
      $structure->saveJson($deleted_term);
    }
  }
});
