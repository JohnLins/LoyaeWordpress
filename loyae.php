<?php
/**
 * Plugin Name: Loyae
 * Plugin URI:        https://loyae.com/
 * Description:       Seamlessly using machine learning to optimise web pages for SEO and SEM.
 * Author:            Loyae
 */


global $wpdb;
$wpdb->show_errors();
//echo "<pre>";print_r($get);echo "</pre>";
//if (!in_array('loyae_generated_data', $wpdb->tables)) {
    
//}

 

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

    //returns the WP_post class whih contains stuff like the post data, author, ect (things you can out in meta tags): https://developer.wordpress.org/reference/classes/wp_post/
    //echo $res;
    /*$res = '
    <head>
    <meta name="description" content="Free Web tutorials">
<meta name="og:title" content="gdd">
    </head>
    <body>
    <div><img src="https://i0.wp.com/www.hadeninteractive.com/wp-content/uploads/2016/11/natureornurture1.png?w=480&ssl=1"/></div><img src="https://sourceforge.net/sflogo.php?type=16&group_id=218559" alt="stuff"/>
    </body>
    ';*/
    /*$res = get_post($id)->post_content;

    $dom = new DomDocument();
    @ $dom->loadHTML($res);*/
    $response = wp_remote_get( get_permalink($id) );
$body = wp_remote_retrieve_body( $response );
$dom = new DOMDocument();

// Load the HTML into the DOMDocument
libxml_use_internal_errors(true); // Disable libxml errors and warnings
$dom->loadHTML($body);
libxml_clear_errors();
    //DOMElement
    $images = $dom->getElementsByTagName("img");
    

    // echo $images->item(0)->attributes->getNamedItem("src")->value . "<br/><br/>";
    // echo $images->item(1)->attributes->getNamedItem("src")->value . "<br/><br/>";

    //Number of images
    $output->number_of_imgs = count($images);

    $output->num_of_imgs_with_alt = 0;
    for ($i = 0; $i < $output->number_of_imgs; $i++){
        
      if($images->item($i)->attributes->getNamedItem("alt") /*&& ->value*/){
        //echo $images->item($i)->attributes->getNamedItem("alt")->value;
        $output->num_of_imgs_with_alt++;
      }
    }


    

    $metas = $dom->getElementsByTagName("meta");
    

    $output->is_meta_description = false;
    $output->is_meta_og_description = false;
    $output->is_meta_og_image = false;
    $output->is_meta_og_image_width = false;
    $output->is_meta_og_image_height = false;
    $output->is_meta_og_image_type = false;
    $output->is_meta_og_site_name = false;
    $output->is_meta_og_keywords = false;
    $output->is_meta_og_title = false;
    $output->is_meta_og_url = false;
    $output->is_meta_og_type = false;
    $output->is_meta_keywords = false;
    $output->is_meta_theme_color = false;
    $output->is_meta_twitter_card = false;
    $output->is_meta_twitter_title = false;
    $output->is_meta_twitter_description = false;
    $output->is_meta_twitter_image = false;
    $output->is_meta_twitter_image_alt = false;
    $output->is_meta_twitter_url = false;
    $output->is_meta_apple_mobile_web_app_status_bar_style = false;
    $output->is_meta_apple_mobile_web_app_title = false;


    for ($i = 0; $i < count($metas); $i++){
        $temp;
        if($metas->item($i)->attributes->getNamedItem("name") != null){
            $temp = $metas->item($i)->attributes->getNamedItem("name")->value;
        } else if($metas->item($i)->attributes->getNamedItem("property") != null) {
            $temp = $metas->item($i)->attributes->getNamedItem("property")->value;
        } else {
            $temp = null;
        }
        

        if($temp == "description"){$output->is_meta_description = true;}
        if($temp == "og:description"){$output->is_meta_og_description = true;}
        if($temp == "og:image"){$output->is_meta_og_image = true;}
        if($temp == "og:image:width"){$output->is_meta_og_image_width = true;}
        if($temp == "og:image:height"){$output->is_meta_og_image_height = true;}
        if($temp == "og:image:type"){$output->is_meta_og_image_type = true;}
        if($temp == "og:site_name"){$output->is_meta_og_site_name = true;}
        if($temp == "og:keywords"){$output->is_meta_og_keywords = true;}
        if($temp == "og:title"){$output->is_meta_og_title = true;}
        if($temp == "og:url"){$output->is_meta_og_url = true;}
        if($temp == "og:type"){$output->is_meta_og_url = true;}
        if($temp == "keywords"){$output->is_meta_keywords = true;}
        if($temp == "theme-color"){$output->is_meta_theme_color = true;}
        if($temp == "twitter:card"){$output->is_meta_twitter_card = true;}
        if($temp == "twitter:title"){$output->is_meta_twitter_title = true;}
        if($temp == "twitter:description"){$output->is_meta_twitter_descriptio = true;}
        if($temp == "twitter:image"){$output->is_meta_twitter_image = true;}
        if($temp == "twitter:image:alt"){$output->is_meta_twitter_image = true;}
        if($temp == "twitter:url"){$output->is_meta_twitter_url = true;}
        if($temp == "apple-mobile-web-app-status-bar-style"){$output->is_meta_apple_mobile_web_app_status_bar_style = true;}
        if($temp == "apple-mobile-web-app-title"){$output->is_meta_apple_mobile_web_app_title = true;}


    }



//update_post_meta($attach_id, '_wp_attachment_image_alt', $alt);
// $attach_id: it is the image post id.

// $alt: the content of image alt text.

// If _wp_attachment_image_alt meta data does not exist, it will be created. Otherwise, it will be updated.
    return $output;

}



//When the form is submitted, create an array of Form objects



add_action( 'admin_post_loyae_form', 'loyae_form_handler' );
function loyae_admin_page() {

        echo    '<br/><div><center>
                <img src="https://www.loyae.com/assets/logos/logo.svg" height="20px;"/> 
                <h1 style="display:inline-block;">Loyae </h1> <h6 style="display:inline-block;">V1.01</h6><br/>
                <br/><hr/><br/>
                </center></div>';


        //latest 20 posts, not quite working yet
        $post_table = '<form action="admin-post.php" method="post">
                       <input type="hidden" name="action" value="loyae_form">';

        foreach(array("posts", "pages") as $cat){
            if( ! empty( $GLOBALS[$cat] ) ){
                $post_table .= '<center> Everything: <input type="checkbox" onclick="toggle(this, `'.$cat.'`)" /><br/><br/><div class="table-container"><table class="timecard">
                                <caption>'.ucfirst($cat).'</caption>
                                <thread>
                                <tr>
                                <th></th>
                                <th>Post</th>
                               <!-- <th>Diagnostic (Free)</th>-->
                                <th>Image Alt Text</th>
                                <th>Meta Description</th>
                                <th>OG Meta Tags</th>
                                <th>Other Tags<br/></th>
                                </tr>
                                </thread>';

                              
                
                for($i = 0; $i < count($GLOBALS[$cat]); $i++){
                    $class = ''; if($i % 2 == 0){ $class = 'even';}else {$class = 'odd';}
                        $id = ($GLOBALS[$cat])[$i]->ID;
                        $temp_local_diagnostic = local_diagnostic($id);
                                
                                $post_table .= '<tr class="'. $class .'">


                                <td><input type="checkbox" name="'.$id.'_box" class="'.$cat.'"/></td>
                                <td><a href="' . get_permalink($id) .'">' 
                                . ($GLOBALS[$cat])[$i]->post_title .' ('.$id.') </a></td>
                                <!--<td><a href="javascript:diagnose('.$GLOBALS[$cat][$i]->ID.')">🔍</a></td>-->

                                <td><span>Missing <b>'. ($temp_local_diagnostic->number_of_imgs - $temp_local_diagnostic->num_of_imgs_with_alt) .'</b> of '.$temp_local_diagnostic->number_of_imgs.'</span></td>
                            

                                <td>'. ($temp_local_diagnostic->is_meta_description==true ? '<span style="color: green;">Has</span>'  : ' <span style="color: red;">Missing</span>') .'</td>
                            

                                <td>'.
                                ($temp_local_diagnostic->is_meta_og_description==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:description<br/>".
                                ($temp_local_diagnostic->is_meta_og_image==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:image<br/>".
                                ($temp_local_diagnostic->is_meta_og_image_width==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:image:width<br/>".
                                ($temp_local_diagnostic->is_meta_og_image_height==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:image:height<br/>".
                                ($temp_local_diagnostic->is_meta_og_image_type==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:image:type<br/>".
                                ($temp_local_diagnostic->is_meta_og_site_name==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:site_name<br/>".
                                ($temp_local_diagnostic->is_meta_og_keywords==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:keywords<br/>".
                                ($temp_local_diagnostic->is_meta_og_title==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:title<br/>".
                                ($temp_local_diagnostic->is_meta_og_url==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:url<br/>".
                                ($temp_local_diagnostic->is_meta_og_type==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:type<br/>"
                                .'</td>
                            



                                <td>'.
                                ($temp_local_diagnostic->is_meta_keywords==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " keywords<br/>".
                                ($temp_local_diagnostic->is_meta_theme_color==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " theme-color<br/>".
                                ($temp_local_diagnostic->is_meta_twitter_card==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " twitter:card<br/>".
                                ($temp_local_diagnostic->is_meta_twitter_title==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " twitter:title<br/>".
                                ($temp_local_diagnostic->is_meta_twitter_description==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " twitter:description<br/>".
                                ($temp_local_diagnostic->is_meta_twitter_image==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " twitter:image<br/>".
                                ($temp_local_diagnostic->is_meta_twitter_image_alt==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " twitter:image:alt<br/>".
                                ($temp_local_diagnostic->is_meta_twitter_url==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " twitter:url<br/>".
                                ($temp_local_diagnostic->is_meta_apple_mobile_web_app_status_bar_style==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " apple-mobile-web-app-status-bar-style<br/>".
                                ($temp_local_diagnostic->is_meta_apple_mobile_web_app_title==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " apple-mobile-web-app-title<br/>"
                                .'</td>
                               

                                </tr>';
                }
                $post_table .= '</table></div></center> </br></br></br>';
                
        
            } else {
                $post_table .= '<table class="timecard">
                                <caption>'.ucfirst($cat).'</caption>
                                <thread>NONE</thread>
                                </table>';
            }



        }


        
        

        $post_table .= '<script>
                        function diagnose(id){
                        window.alert(id);
                        } 
                        
                        function toggle(source, name) {
                            checkboxes = document.getElementsByClassName(name);
                            for(var i=0, n=checkboxes.length;i<n;i++) {
                              checkboxes[i].checked = source.checked;
                            }
                          }
                        </script>';


        echo $post_table;

        echo   '<br/><!--<center>
                <b>Override All Current:</b> Alt data: <input type="checkbox"/>, 
                Meta Descriptions: <input type="checkbox"/>, 
                Meta Keywords: <input type="checkbox"/>,
                Open Graph Meta Tags: <input type="checkbox"/>,
                Essential Tags: <input type="checkbox"/>,
                Non-Essential Tags: <input type="checkbox"/>

                <br/></center>-->
                <br/><center>
                <input type="submit" name="optimize" value="optimize" />
                </center>
                </form>';


        if(isset($_POST["check_alt"])) {
            echo  $_POST['check_alt'];
        }
    
       
}





 class GeneratedMeta {
    public $loyae_description;
    public $loyae_keywords;

    public $loyae_alt;
 }

 // add_post_meta( $GLOBALS['posts'][0], 'description', 'Loyae Meta Des', false);

function get_generated_meta($id){
    $post_text = wp_strip_all_tags(apply_filters('the_content', get_post_field('post_content', $id)));

    //put into meta API
    $meta = new GeneratedMeta();

    //RUN IT THROUGH THE API HERE
    $post_class = get_post($id);
   // $diagnostic = ;
    $meta->ID = $id;
    $meta->loyae_description = (local_diagnostic($id)->is_meta_description) ? 'DES'.$post_text : "<NULL>";
    $meta->loyae_keywords = (local_diagnostic($id)->is_meta_keywords) ? "KEY1, KEY2, KEY3" : "<NULL>";

   
    $temp_loyae_alt = array();
    
    $dom = new DOMDocument();
    libxml_use_internal_errors(true); 
    $dom->loadHTML($post_class->post_content);
    libxml_clear_errors();
    $images = $dom->getElementsByTagName('img');
    foreach ($images as $image) {
        $src = $image->getAttribute('src');
        //add to map where src is the key
        $temp_loyae_alt[$src] = "ALT for: " . $src;
    }





    // $attachments = get_attached_media('', get_the_ID());

    // foreach ($attachments as $attachment) {
    //     $temp_loyae_alt[$attachment->ID] = "ALT for: " . wp_get_attachment_image_src($attachment->ID, 'full');;      
    // }



    $meta->loyae_alt = serialize($temp_loyae_alt);
        


    return (array)$meta; //generatedMeta type
}




    



function loyae_form_handler() {

    global $wpdb;
    $loyae_generated_data = $wpdb->prefix . 'loyae_generated_data';


////////////////   
     $wpdb->query("DROP TABLE IF EXISTS $loyae_generated_data");
///////////////


    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE $loyae_generated_data (
      ID int NOT NULL,
      loyae_description text DEFAULT '' NOT NULL,
      loyae_keywords text DEFAULT '' NOT NULL,
      loyae_alt text DEFAULT '' NOT NULL, 
      PRIMARY KEY (ID)
    ) $charset_collate;";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );





    status_header(200);
    print_r($_POST);
    echo '<br/><br/>';
    echo "\n Last Optimized" . date('Y-m-d H:i:s') . "<br/><br/>";

        $keys = array_keys($_POST); 
        $form_id=(int)substr($keys[0], 0, strpos($keys[0], "_"));
        foreach($keys as $p){ //for each page ID that was selected in the form
            $id = (int)substr($p, 0, strpos($p, "_"));

            if($id != $form_id){
            $wpdb->insert($loyae_generated_data, get_generated_meta($id));

            }
            
        }


    echo '<br/><br/>';
    $result = $wpdb->get_results ( "SELECT * FROM ".$loyae_generated_data );
    foreach ( $result as $print )   {
    
        print_r($print);
    }

        
//}
//print_r($wpdb->tables() );
    //request handlers should exit() when they complete their task
    echo '<br/><br/>';
    exit("Done :)");
}











function loyae_add_meta_tag() {
    global $wpdb;
    $loyae_generated_data = $wpdb->prefix . 'loyae_generated_data';


    

    //if you don't specify an ID, it updates all posts
        if(is_single() /*or $id == null*/){
           // $diagnostic = local_diagnostic(get_the_ID());
            //call from the wpdb database instead
            //$meta = get_generated_meta($id);
            //$meta = ($wpdb->get_results( "SELECT * FROM ".$loyae_generated_data))[$id]; //I'm just taking the first element, but you need to index it for the right post
            //echo implode(" ",$meta);
            $q = 'SELECT * FROM ' . $loyae_generated_data . ' WHERE ID = '. get_the_ID();
            $meta = ($wpdb->get_results($q))[0] ?? null;
    


            
            echo '<!--LOYAE: the following meta data has been generated by loyae.com-->'."\n";
            //If it's <NULL> then don't put it in
            if(/*local_diagnostic(get_the_ID())->is_meta_description &&*/ $meta->loyae_description!="<NULL>"){
                echo '<meta name="description" content="' . $meta->loyae_description . '" />' . "\n";
            }

            echo '<meta property="og:description" content="' . '-' . '" />' . "\n";
            echo '<meta property="og:image" content="' . "-" . '" />' . "\n";
            echo '<meta property="og:image:alt" content="' . "-" . '" />' . "\n";
            echo '<meta property="og:image:width" content="' . "-" . '" />' . "\n";
            echo '<meta property="og:image:height" content="' . "-" . '" />' . "\n";
            echo '<meta property="og:image:type" content="' . "-" . '" />' . "\n";
            echo '<meta property="og:site_name" content="' . "-" . '" />' . "\n";
            echo '<meta property="og:title" content="' . "-" . '" />' . "\n";
            echo '<meta property="og:url" content="' . "-" . '" />' . "\n";
            echo '<meta property="og:type" content="' . "-" . '" />' . "\n";
            echo '<meta property="og:keywords" content="' . $meta->loyae_keywords . '" />' . "\n";

            echo '<meta name="keywords" content="' . "-" . '" />' . "\n";
            echo '<meta name="theme-color" content="' . "-" . '" />' . "\n";
            echo '<meta name="twitter:card" content="' . "-" . '" />' . "\n";
            echo '<meta name="twitter:title" content="' . "-" . '" />' . "\n";
            echo '<meta name="twitter:description" content="' . "-" . '" />' . "\n";
            echo '<meta name="twitter:image" content="' . "-" . '" />' . "\n";
            echo '<meta name="twitter:image:alt" content="' . "-" . '" />' . "\n";
            echo '<meta name="twitter:url" content="' . "-" . '" />' . "\n";
            echo '<meta name="apple-mobile-web-app-status-bar-style" content="' . "-" . '" />' . "\n";
            echo '<meta name="apple-mobile-web-app-title" content="' . "-" . '" />' . "\n";

            echo '<meta property="loyae:optimized" content="DATE" />' . "\n";
            echo '<meta name="generator" content="https://loyae.com" />' . "\n";

            echo '<!--LOYAE END-->'."\n";
        }


        $loyae_alt = unserialize($wpdb->get_results ( "SELECT * FROM ". $wpdb->prefix . "loyae_generated_data" )[0]->loyae_alt);

        // $attachments = get_attached_media('', get_the_ID());

        // foreach ($attachments as $attachment) {
        //     update_post_meta($attachment->ID, '_wp_attachment_image_alt', $loyae_alt[$attachment->ID]);
            
        // }

        $post_content = get_post_field('post_content', get_the_ID()); // Replace $post_id with the ID of the desired post/page

        // Create a DOMDocument object
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($post_content);
        libxml_use_internal_errors(false);

        // Find all <img> elements in the content
        $images = $dom->getElementsByTagName('img');

        // Process each image and set the src value as the alt value
        foreach ($images as $image) {
            $src = $image->getAttribute('src');
            $image->setAttribute('alt', $loyae_alt[$src]);
        }

        // Get the updated post content
        $updated_post_content = $dom->saveHTML();

        // Update the post with the modified content
        $update_post_args = array(
            'ID'           => get_the_ID(),
            'post_content' => $updated_post_content,
        );

        wp_update_post($update_post_args);
   
}



//UNUSED-
// function loyae_add_body_data($id){
    
//     update_post_meta( $id, '_wp_attachment_image_alt', 'ALTDATA' );
//     $my_image_meta = array(
//         'ID' => $id,			
//         'post_title' => "ALTDATA",		

//     );
//     wp_update_post( $my_image_meta );
// }





add_action( 'wp_head', 'loyae_add_meta_tag');
// add_action('wp_body_open', 'loyae_add_body_data');



/*
//unserialize alt from database 

//experimenting--stillb buggy

//puts image url into alt
function callback($buffer) {	




     global $wpdb;
    // $loyae_alt=unserialize($wpdb->get_results ( "SELECT * FROM ". $wpdb->prefix . "loyae_generated_data" )->alt);



	preg_match_all('/<img (.*?)\/>/', $buffer, $images);
	if(!is_null($images)) {
		foreach($images[1] as $index => $value) {
			preg_match('/alt="(.*?)"/', $value, $img);
			preg_match('/alt=\"(.*?)\"/', $value, $img2);
			
			preg_match('/data-src="(.*?)"/', $value, $imgurl);
			
			$image_url = $imgurl[1] ?? null;
          
          	//get alt from url in WordPress
    		//global $wpdb;   		
    		$query_arr  = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE guid='%s';", strtolower( $image_url ) ) );
    		$image_id   = ( ! empty( $query_arr ) ) ? $query_arr[0] : 0;

    		$title = wp_get_attachment_image_url($image_id, '');//get_post_meta( $image_id, '_wp_attachment_image_alt', true );
			
			
			if(!is_null($images)) {
				if((!isset($img[1]) || $img[1] == '') || (!isset($img2[1]) || $img2[1] == '')) {
					
					$new_img = str_replace('<img', '<img alt="'.$image_id.':'.$title.'"', $images[0][$index]);
					$buffer = str_replace($images[0][$index], $new_img, $buffer);
				}
			}
		}
	}

return $buffer;
}

function buffer_start() { ob_start(); }

function buffer_end() { echo callback(ob_get_clean()); }

add_action('wp', 'buffer_start', 0);
add_action('wp_footer', 'buffer_end');

*/

//   update_post_meta()


//TO ADD MENU PAGE ON THE DASHBOARD: add_menu_page() and add_submenu_page()
//Follow this: https://github.com/mpeshev/DX-Plugin-Base

//https://www.loyae.com/assets/logos/logo.svg

?>














<style>
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
            padding: 4px;
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

        input[type="submit"]{
            padding: 7px;
            margin: 7px;
            background-color: lightcoral;
            border-radius: 5px;
            border: 0;
            color: white;
            box-shadow: 0px 0px 15px lightgray;
        }

        input[type="submit"]:hover {
            filter: brightness(95%);
            cursor: pointer;
        }
</style>