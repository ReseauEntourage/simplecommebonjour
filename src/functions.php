<?php
add_action('widgets_init','tp_add_sidebar');
function tp_add_sidebar()
{
  register_sidebar(array(
    'id' => 'zone_widget_droite',
    'name' => 'Zone latérale droite',
    'description' => 'Apparait sur la droite site',
    'before_widget' => '<aside>',
    'after_widget' => '</aside>',
    'before_title' => '<h1>',
    'after_title' => '</h1>'
  ));
}
add_action('init', 'tp_add_menu');
function tp_add_menu()
{
  register_nav_menu('main_menu', 'Menu principal');
}
add_theme_support( 'post-thumbnails' ); 

function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Vidéos';
    $submenu['edit.php'][5][0] = 'Vidéos';
    $submenu['edit.php'][10][0] = 'Ajouter vidéo';
    echo '';
}
function change_post_object_label() {
        global $wp_post_types;
        $labels = &$wp_post_types['post']->labels;
        $labels->name = 'Vidéos';
        $labels->singular_name = 'Vidéo';
        $labels->add_new = 'Ajouter une vidéo';
        $labels->add_new_item = 'Ajouter vidéo';
        $labels->edit_item = 'Editer vidéo';
        $labels->new_item = 'Nouvelle vidéo';
        $labels->view_item = 'Voir vidéo';
        $labels->search_items = 'Rechercher une vidéo';
        $labels->not_found = 'Pas de vidéo trouvée';
        $labels->not_found_in_trash = 'Pas de vidéo dans la corbeille';
}
add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );

register_post_type(
  'bonjour',
  array(
    'label' => 'Bonjour',
    'labels' => array(
      'name' => 'Bonjour',
      'singular_name' => 'Bonjour',
      'all_items' => 'Bonjour',
      'edit_item' => 'Éditer Bonjour',
      'new_item' => 'Nouveau Bonjour',
      'view_item' => 'Voir Bonjour',
      'not_found' => 'Pas de Bonjour trouvé',
      'not_found_in_trash'=> 'Pas de bonjour dans la corbeille'
      ),
    'public' => true,
    'capability_type' => 'post',
    'supports' => array(
      'title',
      'editor',
      'custom-fields',
      'thumbnail'
    ),
    'has_archive' => true
  )
);

register_post_type(
  'question',
  array(
    'label' => 'Questions',
    'labels' => array(
      'name' => 'Questions',
      'singular_name' => 'Question',
      'all_items' => 'Toutes les questions',
      'add_new_item' => 'Ajouter une question',
      'edit_item' => 'Éditer la question',
      'new_item' => 'Nouvelle question',
      'view_item' => 'Voir la question',
      'search_items' => 'Rechercher parmi les questions',
      'not_found' => 'Pas de question trouvé',
      'not_found_in_trash'=> 'Pas de question dans la corbeille'
      ),
    'public' => true,
    'capability_type' => 'post',
    'supports' => array(
      'title',
      'editor',
      'custom-fields',
      'thumbnail'
    ),
    'has_archive' => true
  )
);
register_taxonomy(
  'tags',
  'question',
  array(
    'label' => 'Tags',
    'labels' => array(
    'name' => 'Tags',
    'singular_name' => 'Tag',
    'all_items' => 'Tous les tags',
    'edit_item' => 'Éditer le tag',
    'view_item' => 'Voir le tag',
    'update_item' => 'Mettre à jour le tag',
    'add_new_item' => 'Ajouter un tag',
    'new_item_name' => 'Nouveau tag',
    'search_items' => 'Rechercher parmi les tags',
    'popular_items' => 'Tags les plus utilisés'
  ),
  'hierarchical' => true
  )
);
register_taxonomy(
  'categories',
  'question',
  array(
    'label' => 'Catégories',
    'labels' => array(
    'name' => 'Catégories',
    'singular_name' => 'Catégorie',
    'all_items' => 'Toutes les catégorie',
    'edit_item' => 'Éditer la catégorie',
    'view_item' => 'Voir la catégorie',
    'update_item' => 'Mettre à jour la catégorie',
    'add_new_item' => 'Ajouter une catégorie',
    'new_item_name' => 'Nouvelle catégorie',
    'search_items' => 'Rechercher parmi les catégories',
    'popular_items' => 'Catégorie les plus utilisées'
  ),
  'hierarchical' => true
  )
);
register_taxonomy_for_object_type( 'tags', 'question' );
register_taxonomy_for_object_type( 'categories', 'question' );

function asset_url($path) {
  $version = filemtime(path_join(get_stylesheet_directory(), $path));
  echo esc_url(path_join(get_template_directory_uri(), $path).'?'.$version);
}

?>
