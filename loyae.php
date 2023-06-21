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
    $res = get_post($id)->post_content;
//echo $res;
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
    $output->number_of_meta_keywords = 0;
    $output->is_meta_theme_color = false;
    $output->is_meta_twitter_card = false;
    $output->is_meta_twitter_title = false;
    $output->is_meta_twitter_description = false;
    $output->is_meta_twitter_image = false;
    $output->is_meta_twitter_url = false;
    $output->is_meta_apple_mobile_web_app_status_bar_style = false;
    $output->is_meta_apple_mobile_web_app_title = false;


    for ($i = 0; $i < count($metas); $i++){
        $temp = $metas->item($i)->attributes->getNamedItem("name")->value;

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
        if($temp == "keywords"){$output->number_of_meta_keywords = substr_count($meta->item(i)->attributes->getNamedItem("content"), ",");}
        if($temp == "theme-color"){$output->is_meta_theme_color = true;}
        if($temp == "twitter:card"){$output->is_meta_twitter_card = true;}
        if($temp == "twitter:title"){$output->is_meta_twitter_title = true;}
        if($temp == "twitter:description"){$output->is_meta_twitter_descriptio = true;}
        if($temp == "twitter:image"){$output->is_meta_twitter_image = true;}
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
                <h1 style="display:inline-block;">Loyae</h1><br/>
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
                                <th>Diagnostic (Free)</th>
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
                                <td><a href="javascript:diagnose('.$GLOBALS[$cat][$i]->ID.')">🔍</a></td>

                                <td><span>Missing <b>'. ($temp_local_diagnostic->number_of_imgs - $temp_local_diagnostic->num_of_imgs_with_alt) .'</b> of '.$temp_local_diagnostic->number_of_imgs.'</span></td>
                            

                                <td>'. ($temp_local_diagnostic->is_meta_description==true ? '<span style="color: green;">Has</span>'  : ' <span style="color: red;">Missing</span>') .'</td>
                            

                                <td>'.
                                ($temp_local_diagnostic->is_meta_og_description==true?"<b>Has</b>":"<b>Missing</b>"). " og:description<br/>".
                                ($temp_local_diagnostic->is_meta_og_image==true?"<b>Has</b>":"<b>Missing</b>"). " og:image<br/>".
                                ($temp_local_diagnostic->is_meta_og_image_width==true?"<b>Has</b>":"<b>Missing</b>"). " og:image:width<br/>".
                                ($temp_local_diagnostic->is_meta_og_image_height==true?"<b>Has</b>":"<b>Missing</b>"). " og:image:height<br/>".
                                ($temp_local_diagnostic->is_meta_og_image_type==true?"<b>Has</b>":"<b>Missing</b>"). " og:image:type<br/>".
                                ($temp_local_diagnostic->is_meta_og_site_name==true?"<b>Has</b>":"<b>Missing</b>"). " og:site_name<br/>".
                                ($temp_local_diagnostic->is_meta_og_keywords==true?"<b>Has</b>":"<b>Missing</b>"). " og:keywords<br/>".
                                ($temp_local_diagnostic->is_meta_og_title==true?"<b>Has</b>":"<b>Missing</b>"). " og:title<br/>".
                                ($temp_local_diagnostic->is_meta_og_url==true?"<b>Has</b>":"<b>Missing</b>"). " og:url<br/>"
                                .'</td>
                            



                                <td>'.
                                ($temp_local_diagnostic->is_meta_og_description==true?"Has":"missing"). "<br/>".
                                ($temp_local_diagnostic->is_meta_og_image==true?"Has":"missing"). "<br/>".
                                ($temp_local_diagnostic->is_meta_og_image_width==true?"Has":"missing"). "<br/>".
                                ($temp_local_diagnostic->is_meta_og_image_height==true?"Has":"missing"). "<br/>".
                                ($temp_local_diagnostic->is_meta_og_image_type==true?"Has":"missing"). "<br/>".
                                ($temp_local_diagnostic->is_meta_og_site_name==true?"Has":"missing"). "<br/>".
                                ($temp_local_diagnostic->is_meta_og_keywords==true?"Has":"missing"). "<br/>"

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



class Form {
    public $id;
    public $alt;
    public $description;
    public $keywords;
    public $og;
    public $essential;
    public $nonessential;
}



 class GeneratedMeta {
    public $loyae_description;
    public $loyae_keywords;
    /*public $og;
    public $essential;
    public $nonessential;*/
    
    public $loyae_author;
    public $loyae_date;
    public $loyae_title;
 }


 /*
 <meta name='og:title' content='The Rock'>
<meta name='og:type' content='movie'>
<meta name='og:url' content='http://www.imdb.com/title/tt0117500/'>
<meta name='og:image' content='http://ia.media-imdb.com/rock.jpg'>
<meta name='og:site_name' content='IMDb'>
<meta name='og:description' content='A group of U.S. Marines, under command of...'>
*/
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
 // add_post_meta( $GLOBALS['posts'][0], 'description', 'Loyae Meta Des', false);

function get_generated_meta($form){
    $post_text = wp_strip_all_tags(apply_filters('the_content', get_post_field('post_content', $form->id)));

    //put into meta API
    $meta = new GeneratedMeta();

    //RUN IT THROUGH THE API HERE
    $post_class = get_post($form->id);

    $meta->ID = $form->id;
    $meta->loyae_description = ($form->description) ? 'DES'.$post_text : "<NULL>";
    $meta->loyae_keywords = ($form->keywords) ? "KEY1, KEY2, KEY3" : "<NULL>";
    $meta->loyae_author = ($form->essential) ? $post_class->post_author : "<NULL>";
    $meta->loyae_date = ($form->essential) ? $post_class->post_date : "<NULL>";
    $meta->loyae_title = ($form->essential) ? $post_class->post_title : "<NULL>";
    

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
      loyae_author text DEFAULT '' NOT NULL,
      loyae_date text DEFAULT '' NOT NULL,
      loyae_title text DEFAULT '' NOT NULL,
      PRIMARY KEY (ID)
    ) $charset_collate;";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );





    status_header(200);
    print_r($_POST);
    echo '<br/><br/>';
        echo "\n Last Optimized" . date('Y-m-d H:i:s') . "<br/><br/>";

        $keys = array_keys($_POST); 
        $form = new Form();
        $form->id=(int)substr($keys[0], 0, strpos($keys[0], "_"));
        foreach($keys as $p){
            $id = (int)substr($p, 0, strpos($p, "_"));

            if($id != $form->id){
            $wpdb->insert($loyae_generated_data, get_generated_meta($form));
                $form = null;
                $form = new Form();
                $form->id=$id;
            }


            $type = substr($p, strpos($p, "_") + 1);

            if($type == "alt"){
                $form->alt = true; 
            }
            if($type == "description"){
                $form->description = true; 
            }
            if($type == "keywords"){
                $form->keywords = true; 
            }
            if($type == "og"){
                $form->og = true; 
            }
            if($type == "essential"){
                $form->essential = true; 
            }
            if($type == "nonessential"){
                $form->nonessential = true; 
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

            //call from the wpdb database instead
            //$meta = get_generated_meta($id);
            //$meta = ($wpdb->get_results( "SELECT * FROM ".$loyae_generated_data))[$id]; //I'm just taking the first element, but you need to index it for the right post
            //echo implode(" ",$meta);
            $q = 'SELECT * FROM ' . $loyae_generated_data . ' WHERE ID = '. get_the_ID();
            $meta = ($wpdb->get_results($q))[0];
    


            
            echo '<!--LOYAE: the following meta data has been generated by loyae.com-->';
            //If it's <NULL> then don't put it in
            if(metadata_exists('post', get_the_ID(), 'description')){
                echo '<meta name="description" content="' . $meta->loyae_description . '" />' . "\n";
            }

            echo '<meta name="og:description" content="' . $meta->loyae_og_description . '" />' . "\n";
            echo '<meta name="og:image" content="' . "-" . '" />' . "\n";
            echo '<meta name="og:image:alt" content="' . "-" . '" />' . "\n";
            echo '<meta name="og:image:width" content="' . "-" . '" />' . "\n";
            echo '<meta name="og:image:height" content="' . "-" . '" />' . "\n";
            echo '<meta name="og:image:type" content="' . "-" . '" />' . "\n";
            echo '<meta name="og:site_name" content="' . "-" . '" />' . "\n";
            echo '<meta name="og:title" content="' . "-" . '" />' . "\n";
            echo '<meta name="og:url" content="' . "-" . '" />' . "\n";
            echo '<meta name="og:keywords" content="' . $meta->loyae_keyword . '" />' . "\n";

            echo '<meta name="keywords" content="' . "-" . '" />' . "\n";
            echo '<meta name="theme-color" content="' . "-" . '" />' . "\n";
            echo '<meta name="twitter:card" content="' . "-" . '" />' . "\n";
            echo '<meta name="twitter:title" content="' . "-" . '" />' . "\n";
            echo '<meta name="twitter:description" content="' . "-" . '" />' . "\n";
            echo '<meta name="twitter:image" content="' . "-" . '" />' . "\n";
            echo '<meta name="twitter:url" content="' . "-" . '" />' . "\n";
            echo '<meta name="apple-mobile-web-app-status-bar-style" content="' . "-" . '" />' . "\n";
            echo '<meta name="apple-mobile-web-app-title" content="' . "-" . '" />' . "\n";

            echo '<meta name="loyae:last_optimized" content="DATE" />' . "\n";

            echo '<!--LOYAE END-->';
        }
   
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






//experimenting--stillb buggy

//puts image url into alt
function callback($buffer) {	

	preg_match_all('/<img (.*?)\/>/', $buffer, $images);
	if(!is_null($images)) {
		foreach($images[1] as $index => $value) {
			preg_match('/alt="(.*?)"/', $value, $img);
			preg_match('/alt=\"(.*?)\"/', $value, $img2);
			
			preg_match('/data-src="(.*?)"/', $value, $imgurl);
			
			$image_url = $imgurl[1];
          
          	//get alt from url in WordPress
    		global $wpdb;   		
    		$query_arr  = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE guid='%s';", strtolower( $image_url ) ) );
    		$image_id   = ( ! empty( $query_arr ) ) ? $query_arr[0] : 0;

    		$title = wp_get_attachment_image_url($image_id, '');//get_post_meta( $image_id, '_wp_attachment_image_alt', true );
			
			
			if(!is_null($images)) {
				if((!isset($img[1]) || $img[1] == '') || (!isset($img2[1]) || $img2[1] == '')) {
					
					$new_img = str_replace('<img alt=\'\'', '<img alt="'.$image_url.':'.$title.'"', $images[0][$index]);
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