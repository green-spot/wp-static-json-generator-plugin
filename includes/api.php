<?php

namespace StaticJsonGenerator;

function addAPI($route, $method, $callback){
  register_rest_route('static-json-generator/v1', $route, [
    'methods' => $method,
    'callback' => $callback,
    'permission_callback' => function() {
      return current_user_can('manage_options');
    },
  ]);
}

add_action('rest_api_init', function() {
  addAPI("/save-all", "POST", function($req){
    $generator = StaticJsonGenerator::instance();

    foreach($generator->getPostListStructures() as $structure){
      $structure->saveJson();
    }

    foreach($generator->getPostDetailStructures() as $structure){
      $posts = get_posts(["post_type" => $structure->post_types, "post_status" => "publish", "posts_per_page" => -1]);

      foreach($posts as $post){
        $structure->saveJson($post);
      }
    }

    foreach($generator->getPageDetailStructures() as $structure){
      foreach($structure->slugs as $slug){
        $page = get_page_by_path($slug);
        if($page){
          $structure->saveJson($page);
        }
      }
    }

    foreach($generator->getTermListStructures() as $structure){
      $structure->saveJson();
    }

    foreach($generator->getTermDetailStructures() as $structure){
      $terms = get_terms(["taxonomy" => $structure->taxonomy]);
      foreach($terms as $term){
        $structure->saveJson($term);
      }
    }

    return rest_ensure_response(['message' => 'ok']);
  });

  // Settings
  /*
  addAPI("/settings", "GET", function($req){
    return rest_ensure_response(['message' => 'OK!']);
  });

  addAPI("/settings", "POST", function($req){
    return rest_ensure_response(['message' => 'OK!']);
  });
  */
});
