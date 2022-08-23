<?php
/**
 * Plugin Name: Loyae
 * Plugin URI:        https://loyae.com/
 * Description:       Seamlessly using machine learning to optimise web pages for SEO and SEM.
 * Author:            Lins Technologies
 */

$args = array(
    'numberposts'	=> 20,
    'category'		=> 0
);

$GLOBALS['posts'] = get_posts( $args );
$GLOBALS['pages'] = get_pages();


 add_action('admin_menu', 'my_menu');
 function my_menu() {
     add_menu_page('Loyae Admin', 'Loyae', 'manage_options', 'my-page-slug', 'loyae_admin_page'/*, 'https://www.loyae.com/assets/logos/logo.svg'*/, null);
 }
 
 function loyae_admin_page() {
        echo '<div><img src="https://www.loyae.com/assets/logos/logo.svg" height="30px;" style="display:inline-block;"/> <h1 style="display:inline-block;">Loyae!</h1><br/><hr/></div>';
     

        //latest 20 posts, not quite working yet
        $post_table = '<center><div class="table-container"><table>
        <table class="timecard">
        <caption>Posts</caption>
        <thread>
        <tr>
        <th>Post</th>
        <th>Diagnostic (Free)</th>
        <!--<th>Optimize Alt <br/>{AI}</th>-->
        <th>Optimize Meta <br/>(Description)<br/>{AI}</th>
        <th>Optimize Meta <br/>(keywords)<br/>{AI}</th>
        <th>Optimize OG Meta Tags</th>
        <th>Optimize Essential Tags</th>
        <th>Optimize 3rd-party Tags (Non-Essential)</th>
        <!--<th>Compress</th>-->
        
        </tr>
        </thread>
        

        <form method="post">';

        if( ! empty( $GLOBALS['posts'] ) ){
            
            for($i = 0; $i < count($GLOBALS['posts']); $i++){
                $class = '';
                if($i % 2 == 0){ $class = 'even';}else {$class = 'odd';}
                $post_table .= '<tr class="'. $class .'">
                            <td><a href="' . get_permalink( ($GLOBALS['posts'])[$i]->ID ) . '">' 
                            . ($GLOBALS['posts'])[$i]->post_title . '</a></td>
                            <td><a href="javascript:diagnose('.$GLOBALS['posts'][$i]->ID.')">🔍</a></td>
                            <td><input type="checkbox"/><span style="color:red">(9 missing)</span></td>
                           <!-- <td><input type="checkbox"/>(1 missing)</td>-->
                            <td><input type="checkbox"/>(4 remaining)</td>
                            <td><input type="checkbox"/>(3 missing)</td>
                            <td><!--<input type="checkbox"/>--><span style="color:green">(0 missing)</span></td>
                            <td><input type="checkbox"/>(43 missing)</td>
                            <!--<td><input type="checkbox"/>(50 bytes-to-remove)</td>-->
                            </tr>';
            }
            $post_table .= '</table></div></center>
            <script>
            
            function diagnose(id){
                window.alert(id);
            }
            
            </script>
            ';
            
        }
    echo $post_table;

    echo '<br/><center>
    <input type="submit" name="optimize" class="button" value="optimize" />
    </center></form>';

    echo '<br/><br/>PAGES: <br/><br/>';
    for($i = 0; $i < count($GLOBALS['pages']); $i++){
    echo json_encode($GLOBALS['pages'][$i]->post_name) . '</br>';
    }


    //css
    echo '<style>

    .table-container{
        overflow-y:scroll;
        max-height: 300px;
        

        width: 90%;
        position: relative; 
        
    }
    

   

        caption {
            border-top-right-radius: 10px;
            border-top-left-radius: 10px;
        }
            
        table.timecard {
            margin: auto;
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 0 25px gray;
        }

        table.timecard caption {
            background-color: lightcoral;
            color: #fff;
            letter-spacing: .3em;
        }

        table.timecard thead th {
            padding: 8px;
            background-color: white;
            font-size: large;
        }

        table.timecard thead th #thDay {
            width: 40%;	
        }

        table.timecard thead th #thRegular, table.timecard thead th#thOvertime, table.timecard thead th#thTotal {
            width: 20%;
        }

        table.timecard th, table.timecard td {
            padding: 3px;
            border-width: 1px;
            border-style: solid;
            border-color: #fdf1f1 lightgray;
        }

        table.timecard td {
            text-align: left;
        }

        table.timecard tbody th {
            text-align: left;
            font-weight: normal;
        }

        table.timecard tr.even {
            background-color: #fdf1f1;
        }
        table.timecard tr.odd {
            background-color: white;
        }

        .button{
            padding: 7px;
            margin: 7px;
            background-color: lightcoral;
            border-radius: 5px;
            border: 0;
            color: white;
            box-shadow: 0px 0px 15px lightgray;
        }

        .button:hover {
            filter: brightness(95%);
            cursor: pointer;
        }
        </style>';

       
 }

 class GeneratedMeta {
    public $keywords;
    public $description;
 }

 // add_post_meta( $GLOBALS['posts'][0], 'description', 'Loyae Meta Des', false);

function get_generated_meta($text){
    //put into meta API
    $meta = new GeneratedMeta();
    $meta->keywords = "abc, bca, cab";
    $meta->description = "abcdefg3";
    return $meta;
}

  function loyae_add_meta_tag($id) {
    $post_text = wp_strip_all_tags(apply_filters('the_content', get_post_field('post_content', $id)));

    //if you don't specify an ID, it updates all posts
        if(is_single($id) or $id == null){

            $meta = get_generated_meta($id);

            echo '<meta name="description" content="' . $meta->description . '" />' . "\n";
            echo '<meta name="keywords" content="' . $meta->keywords . '" />' . "\n";
        }
   
    }


  function loyae_add_body_data($id){

    echo 'ALT DATA IS SUS!!';
  }

    if(array_key_exists('optimize', $_POST)) {
        echo ':::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::' . date('Y-m-d H:i:s');
        
      
    }

add_action( 'wp_head', 'loyae_add_meta_tag');
add_action('wp_body_open', 'loyae_add_body_data');


//   update_post_meta()


//TO ADD MENU PAGE ON THE DASHBOARD: add_menu_page() and add_submenu_page()
//Follow this: https://github.com/mpeshev/DX-Plugin-Base

//https://www.loyae.com/assets/logos/logo.svg