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

 class Diagnostic {
    public $number_of_imgs;
    public $num_of_imgs_with_alt;
    public $is_meta_description;
    public $number_of_meta_keywords;
    public $number_of_og_meta;
    public $number_of_meta;
    
 }

 function local_diagnostic($id){
    $output = new Diagnostic();

    $res = get_post($id); //returns the WP_post class whih contains stuff like the post data, author, ect (things you can out in meta tags): https://developer.wordpress.org/reference/classes/wp_post/
    //echo $res;
    $res = '
    <head>
    <meta name="description" content="Free Web tutorials">
<meta name="og:title" content="gdd">
    </head>
    <body>
    <div><img src="https://i0.wp.com/www.hadeninteractive.com/wp-content/uploads/2016/11/natureornurture1.png?w=480&ssl=1"/></div><img src="https://sourceforge.net/sflogo.php?type=16&group_id=218559" alt="stuff"/>
    </body>
    ';
    $dom = new DomDocument();
    @ $dom->loadHTML($res);
    //DOMElement
    $images = $dom->getElementsByTagName("img");

    // echo $images->item(0)->attributes->getNamedItem("src")->value . "<br/><br/>";
    // echo $images->item(1)->attributes->getNamedItem("src")->value . "<br/><br/>";

    //Number of images
    $output->number_of_imgs = count($images);

    $output->num_of_imgs_with_alt = 0;
    for ($i = 0; $i < $output->number_of_imgs; $i++){
        
      if($images->item($i)->attributes->getNamedItem("alt") /*&& ->value*/){
        echo $images->item($i)->attributes->getNamedItem("alt")->value;
        $output->num_of_imgs_with_alt++;
      }
    }


    
    $metas = $dom->getElementsByTagName("meta");

    $output->is_meta_description = false;
    $output->number_of_meta_keywords = 0;
    $output->number_of_og_meta = 0;

    for ($i = 0; $i < count($metas); $i++){
        $temp = $metas->item($i)->attributes->getNamedItem("name")->value;

        if($temp == "description"){$output->is_meta_description = true;}
        if($temp == "keywords"){
            //explode(',', $myString);
            $output->number_of_meta_keywords = substr_count($meta->item(i)->attributes->getNamedItem("content"), ",");
        }
        if(substr($temp, 0, 3) == "og:"){$output->number_of_og_meta++;}


    }

    
    //number of meta tags
    $output->number_of_meta = count($metas);




//update_post_meta($attach_id, '_wp_attachment_image_alt', $alt);
// $attach_id: it is the image post id.

// $alt: the content of image alt text.

// If _wp_attachment_image_alt meta data does not exist, it will be created. Otherwise, it will be updated.
    return $output;

 }
 
 function loyae_admin_page() {
        echo '<div><img src="https://www.loyae.com/assets/logos/logo.svg" height="30px;" style="display:inline-block;"/> <h1 style="display:inline-block;">Loyae!</h1><br/><hr/></div>';
     

        //latest 20 posts, not quite working yet
        $post_table = '<form method="post"><center><div class="table-container"><table>
        <table class="timecard">
        <caption>Posts</caption>
        <thread>
        <tr>
        <th>Post</th>
        <th>Diagnostic (Free)</th>
        <th>Optimize Alt <br/>{AI}</th>
        <th>Optimize Meta <br/>(Description)<br/>{AI}</th>
        <th>Optimize Meta <br/>(keywords)<br/>{AI}</th>
        <th>Optimize Open Graph Meta Tags</th>
        <th>Optimize Essential Tags</th>
        <th>Optimize 3rd-party Tags (Non-Essential)</th>
        <!--<th>Compress</th>-->
        
        </tr>
        </thread>
        

        ';

        if( ! empty( $GLOBALS['posts'] ) ){
            
            for($i = 0; $i < count($GLOBALS['posts']); $i++){
                $class = ''; if($i % 2 == 0){ $class = 'even';}else {$class = 'odd';}

                    $temp_local_diagnostic = local_diagnostic(($GLOBALS['posts'])[$i]->ID);

                            $post_table .= '<tr class="'. $class .'">
                            <td><a href="' . get_permalink( ($GLOBALS['posts'])[$i]->ID ) . '">' 
                            . ($GLOBALS['posts'])[$i]->post_title . '</a></td>
                            <td><a href="javascript:diagnose('.$GLOBALS['posts'][$i]->ID.')">🔍</a></td>
                            <td><input type="checkbox"/><span style="color:red">('. ($temp_local_diagnostic->number_of_imgs - $temp_local_diagnostic->num_of_imgs_with_alt) .' of '.$temp_local_diagnostic->number_of_imgs.' missing)</span></td>
                           <td>'. ($temp_local_diagnostic->is_meta_description ? '<span style="color: green;">None Missing</span>'  : '<input type="checkbox"/> <span style="color: red;">Missing</span>') .'</td>
                            <td><input type="checkbox"/>(4 remaining)</td>
                            <td><input type="checkbox"/>('.(4-$temp_local_diagnostic->number_of_og_meta).' missing)</td>
                            <td><!--<input type="checkbox"/>--><span style="color:green">(0 missing)</span></td>
                            <td><input type="checkbox"/>(43 missing)</td>
                            <!--<td><input type="checkbox"/>(50 bytes-to-remove)</td>-->
                            </tr>';
            }
            $post_table .= '</table></div></center> </br></br></br>';
            
        }

        if( ! empty( $GLOBALS['pages'] ) ){
            $post_table .= '<center><div class="table-container"><table>
            <table class="timecard">
            <caption>Pages</caption>
            <thread>
            <tr>
            <th>Post</th>
            <th>Diagnostic (Free)</th>
            <th>Optimize Alt <br/>{AI}</th>
            <th>Optimize Meta <br/>(Description)<br/>{AI}</th>
            <th>Optimize Meta <br/>(keywords)<br/>{AI}</th>
            <th>Optimize Open Graph Meta Tags</th>
            <th>Optimize Essential Tags</th>
            <th>Optimize 3rd-party Tags (Non-Essential)</th>
            <!--<th>Compress</th>-->
            
            </tr>
            </thread> ';


        

        for($i = 0; $i < count($GLOBALS['pages']); $i++){
            $class = ''; if($i % 2 == 0){ $class = 'even';}else {$class = 'odd';}

                $temp_local_diagnostic = local_diagnostic(($GLOBALS['pages'])[$i]->ID);

                        $post_table .= '<tr class="'. $class .'">
                        <td><a href="' . get_permalink( ($GLOBALS['pages'])[$i]->ID ) . '">' 
                        . ($GLOBALS['pages'])[$i]->post_title . '</a></td>
                        <td><a href="javascript:diagnose('.$GLOBALS['posts'][$i]->ID.')">🔍</a></td>
                        <td><input type="checkbox"/><span style="color:red">('. ($temp_local_diagnostic->number_of_imgs - $temp_local_diagnostic->num_of_imgs_with_alt) .' of '.$temp_local_diagnostic->number_of_imgs.' missing)</span></td>
                       <td>'. ($temp_local_diagnostic->is_meta_description ? '<span style="color: green;">None Missing</span>'  : '<input type="checkbox"/> <span style="color: red;">Missing</span>') .'</td>
                        <td><input type="checkbox"/>(4 remaining)</td>
                        <td><input type="checkbox"/>('.(4-$temp_local_diagnostic->number_of_og_meta).' missing)</td>
                        <td><!--<input type="checkbox"/>--><span style="color:green">(0 missing)</span></td>
                        <td><input type="checkbox"/>(43 missing)</td>
                        <!--<td><input type="checkbox"/>(50 bytes-to-remove)</td>-->
                        </tr>';
        }
        $post_table .= '</table></div></center>
        </form>';
    }
        //echo '<br/><br/>PAGES: <br/><br/>';
        //for($i = 0; $i < count($GLOBALS['pages']); $i++){
        //echo json_encode($GLOBALS['pages'][$i]->post_name) . '</br>';
        //}

        $post_table .= '<script>
            
        function diagnose(id){
            window.alert(id);
        }
        
        </script>';


    echo $post_table;




    

    echo '<br/><center>
    <input type="submit" name="optimize" class="button" value="optimize" />
    </center></form>';

    


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
    public $author;
    public $date;
    public $title;
 }

 // add_post_meta( $GLOBALS['posts'][0], 'description', 'Loyae Meta Des', false);

function get_generated_meta($text, $id){
    //put into meta API
    $meta = new GeneratedMeta();

    //RUN IT THROUGH THE API HERE
    $post_class = get_post($id);

    $meta->keywords = "abc, bca, cab";
    $meta->description = 'abcdefg3'.$text;
    $meta->author = $post_class->post_author;
    $meta->date = $post_class->post_date;
    $meta->title = $post_class->post_title;

    return $meta;
}

  function loyae_add_meta_tag($id) {
    $post_text = wp_strip_all_tags(apply_filters('the_content', get_post_field('post_content', $id)));

    //if you don't specify an ID, it updates all posts
        if(is_single($id) or $id == null){

            $meta = get_generated_meta($post_text, $id);

            echo '<meta name="description" content="' . $meta->description . '" />' . "\n";
            echo '<meta name="keywords" content="' . $meta->keywords . '" />' . "\n";
            echo '<meta name="article:published_time" content="' . $meta->date . '" />' . "\n";
            echo '<meta name="article:author" content="' . $meta->author . '" />' . "\n";
            echo '<title>' . $meta->title . '</title>' . "\n";
            
            /*
            <meta property="article:published_time" content="2019-05-12 10:00" />
<meta property="article:modified_time" content="2019-09-18 18:00" />
<meta property="article:expiration_time" content="2119-05-12 10:00" /> 
<meta property="article:author" content="Shark" />
<meta property="article:publisher" content="https://www.facebook.com/SharkCoder" />
<meta property="article:section" content="HTML" />
<meta property="article:tag" content="tag1, tag2" />
<meta property="article:tag" content="tag3" />
*/

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