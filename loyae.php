<?php
/**
 * Plugin Name: Loyae
 * Plugin URI:        https://loyae.com/
 * Description:       Seamlessly using machine learning to optimise web pages for SEO and SEM.
 * Author:            Lins Technologies
 */

 echo 'Loyae Says Hello !';

$args = array(
    'numberposts'	=> 20,
    'category'		=> 0
);

$GLOBALS['posts'] = get_posts( $args );


 add_action('admin_menu', 'my_menu');
 function my_menu() {
     add_menu_page('Loyae Admin', 'Loyae', 'manage_options', 'my-page-slug', 'loyae_admin_page'/*, 'https://www.loyae.com/assets/logos/logo.svg'*/, null);
 }
 
 function loyae_admin_page() {
     echo '<i>Loyae!</i><br/>';
     echo '<button>Optimize</button>';
     


     //latest 20 posts, not quite working yet
        


    $output = '<ul>';
        if( ! empty( $GLOBALS['posts'] ) ){
            
            foreach ( $GLOBALS['posts'] as $p ){
                $output .= '<li><a href="' . get_permalink( $p->ID ) . '">' 
                . $p->post_title . '</a></li>';
            }
            $output .= '</ul>';
            
        }
    echo $output;
 }


 // add_post_meta( $GLOBALS['posts'][0], 'description', 'Loyae Meta Des', false);

  function loyae_add_meta_tag($post_id) {
    //if you don't specify an ID, it updates all posts
        if(is_single($post_id) or $post_id == null){
            echo '<meta name="description" content="' . "LOYAE TEST" . '" />' . "\n";
            echo '<meta name="keywords" content="' . "LOYAE TEST" . '" />' . "\n";
        }
   
    }

  
  
add_action( 'wp_head', 'loyae_add_meta_tag');

//   update_post_meta()


//TO ADD MENU PAGE ON THE DASHBOARD: add_menu_page() and add_submenu_page()
//Follow this: https://github.com/mpeshev/DX-Plugin-Base

//https://www.loyae.com/assets/logos/logo.svg