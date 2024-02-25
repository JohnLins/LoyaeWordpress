<?php
/**
 * Plugin Name:       Loyae
 * Plugin URI:        https://loyae.com/
 * Description:       Bulk AI-generated HTML meta tags and alt text for images; improve searchability (SEO), usability, and accessibility!
 * Version: 1.0.1
 * Author:            Loyae
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       loyae
 */


if (!defined('ABSPATH')) {
    exit;
}

include_once(plugin_dir_path(__FILE__) . 'includes/types.php');



global $wpdb;
$wpdb->show_errors();

function loyae_enqueue_styles() {
    wp_enqueue_style('loyae-table-css', plugins_url('css/table.css', __FILE__));
}

add_action('admin_enqueue_scripts', 'loyae_enqueue_styles');

function loyae_enqueue_script() {
    wp_enqueue_script('loyae-js', plugins_url('js/scripts.js', __FILE__), array(), '1.0', true);
}
add_action('admin_enqueue_scripts', 'loyae_enqueue_script');



add_action('admin_menu', 'loyae_menu');
function loyae_menu() {
    add_menu_page('Loyae Admin', 'Loyae', 'manage_options', 'my-page-slug', 'loyae_home', plugins_url('assets/icon.ico', __FILE__), null);
}


/*
function loyae_home(){
    echo '<br/><div><center>
    <img src="'.esc_attr(plugins_url('assets/icon.svg', __FILE__)).'" height="20px;"/> 
    <h1 style="display:inline-block;">Loyae </h1> <h6 style="display:inline-block;">V1.0.1</h6><br/>
    <br/><hr/><br/>
    <h2 id="loader" style="display:none">Loading... Please be patient as we diagnose these selected posts/pages (this may take time)</h2>
    </div></center>';
    echo '<form method="post" action="">';
    echo '</br>';
    echo '<button type="submit" name="all" class="button-primary" onclick="showLoader();">';
    echo esc_html( 'Diagnose all ' . esc_html( wp_count_posts( 'post' )->publish ) . ' posts' );
    echo '</button>';

    





    if(wp_count_posts('post')->publish > 20){
        echo '</br><br/>';

        echo '<button type="submit" name="some" class="button-primary" onclick="showLoader();">';
        echo esc_html( 'Diagnose the last 10 posts (takes less time to load)' );
        echo '</button>';


    }

    echo '</form>';


   if (isset($_POST['some'])) {
        loyae_admin_page(array(
            'numberposts'	=> 10,
            'category'		=> 0
        ));
    }





    if (isset($_POST['all'])) {
        loyae_admin_page(array(
            'numberposts'	=> -1,
            'category'		=> 0
        ));
    }





}
*/



// Add nonce to your form
function loyae_home(){
    // Add nonce field


    echo '<br/><div><center>
    <img src="'.esc_attr(plugins_url('assets/icon.svg', __FILE__)).'" height="20px;"/>
    <h1 style="display:inline-block;">Loyae </h1> <h6 style="display:inline-block;">V1.0.1</h6><br/>
    <br/><hr/><br/>
    <h2 id="loader" style="display:none">Loading... Please be patient as we diagnose these selected posts/pages (this may take time)</h2>
    </div></center>';
    echo '<form method="post" action="">';
    wp_nonce_field( 'loyae_diagnose_nonce', 'loyae_diagnose_nonce_field' );
    echo '</br>';
    echo '<button type="submit" name="all" class="button-primary" onclick="showLoader();">';
    echo esc_html( 'Diagnose all ' . esc_html( wp_count_posts( 'post' )->publish ) . ' posts' );
    echo '</button>';

    if(wp_count_posts('post')->publish > 20){
        echo '</br><br/>';

        echo '<button type="submit" name="some" class="button-primary" onclick="showLoader();">';
        echo esc_html( 'Diagnose the last 10 posts (takes less time to load)' );
        echo '</button>';
    }

    echo '</form>';


    // Check nonce and user capability before handling form submissions
    if ( isset( $_POST['all'] ) && isset( $_POST['loyae_diagnose_nonce_field'] ) && wp_verify_nonce( $_POST['loyae_diagnose_nonce_field'], 'loyae_diagnose_nonce' ) && current_user_can( 'manage_options' ) ) {
        loyae_admin_page(array(
            'numberposts'	=> -1,
            'category'		=> 0
        ));
    }

    if ( isset( $_POST['some'] ) && isset( $_POST['loyae_diagnose_nonce_field'] ) && wp_verify_nonce( $_POST['loyae_diagnose_nonce_field'], 'loyae_diagnose_nonce' ) && current_user_can( 'manage_options' ) ) {
        loyae_admin_page(array(
            'numberposts'	=> 10,
            'category'		=> 0
        ));
    }
}






function loyae_local_diagnostic($id, $calculate_cost){
    $output = new loyae_Diagnostic();


    $cost_to_optimize = 0;
    if($calculate_cost == true){
        $prices = null;
        $pricesresp = wp_remote_get("https://api.loyae.com/prices?who=".sanitize_text_field(home_url()));
        if(!is_wp_error($pricesresp)){
            $prices= json_decode(wp_remote_retrieve_body($pricesresp));
        }

        $cost_to_optimize = 3*$prices->DESCRIPTIONRATE + 2*$prices->ALTRATE + 17*$prices->SIMPLEMETARATE;
    }
    

    $response = wp_remote_get( get_permalink($id) );
    $body = wp_remote_retrieve_body( $response );
    $dom = new DOMDocument();

    
    libxml_use_internal_errors(true); 
    $dom->loadHTML($body);
    libxml_clear_errors();
    
    $images = $dom->getElementsByTagName("img");
    

    $output->number_of_imgs = count($images);

    $output->num_of_imgs_with_alt = 0;
    for ($i = 0; $i < $output->number_of_imgs; $i++){
        
      if($images->item($i)->attributes->getNamedItem("alt") && $images->item($i)->attributes->getNamedItem("alt")->value!=""){
        $output->num_of_imgs_with_alt++;
      }
    }

    $cost_to_optimize += $prices->ALTRATE * ($output->number_of_imgs - $output->num_of_imgs_with_alt);

    $metas = $dom->getElementsByTagName("meta");
    





    $output->is_meta_description = false;
    $output->is_meta_og_description = false;
    $output->is_meta_og_image = false;
    $output->is_meta_og_image_alt = false;
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
        } else if($metas->item($i)->attributes->getNamedItem("property") != null && $metas->item($i)->attributes->getNamedItem("property")!="<NULL>") {
            $temp = $metas->item($i)->attributes->getNamedItem("property")->value;
        } else {
            $temp = null;
        }
        

        if($temp == "description"){$output->is_meta_description = true;if($calculate_cost == true){$cost_to_optimize-=$prices->DESCRIPTIONRATE;}}
        if($temp == "og:description"){$output->is_meta_og_description = true;if($calculate_cost == true){$cost_to_optimize-=$prices->DESCRIPTIONRATE;}}
        if($temp == "og:image"){$output->is_meta_og_image = true;if($calculate_cost == true){$cost_to_optimize-=$prices->SIMPLEMETARATE;}}
        if($temp == "og:image:alt"){$output->is_meta_og_image_alt = true;if($calculate_cost == true){$cost_to_optimize-=$prices->ALTRATE;}}
        if($temp == "og:image:width"){$output->is_meta_og_image_width = true;if($calculate_cost == true){$cost_to_optimize-=$prices->SIMPLEMETARATE;}}
        if($temp == "og:image:height"){$output->is_meta_og_image_height = true;if($calculate_cost == true){$cost_to_optimize-=$prices->SIMPLEMETARATE;}}
        if($temp == "og:image:type"){$output->is_meta_og_image_type = true;if($calculate_cost == true){$cost_to_optimize-=$prices->SIMPLEMETARATE;}}
        if($temp == "og:site_name"){$output->is_meta_og_site_name = true;if($calculate_cost == true){$cost_to_optimize-=$prices->SIMPLEMETARATE;}}
        if($temp == "og:keywords"){$output->is_meta_og_keywords = true;if($calculate_cost == true){$cost_to_optimize-=$prices->SIMPLEMETARATE;}}
        if($temp == "og:title"){$output->is_meta_og_title = true;if($calculate_cost == true){$cost_to_optimize-=$prices->SIMPLEMETARATE;}}
        if($temp == "og:url"){$output->is_meta_og_url = true;if($calculate_cost == true){$cost_to_optimize-=$prices->SIMPLEMETARATE;}}
        if($temp == "og:type"){$output->is_meta_og_type = true;if($calculate_cost == true){$cost_to_optimize-=$prices->SIMPLEMETARATE;}}
        if($temp == "keywords"){$output->is_meta_keywords = true;if($calculate_cost == true){$cost_to_optimize-=$prices->SIMPLEMETARATE;}}
        if($temp == "theme-color"){$output->is_meta_theme_color = true;if($calculate_cost == true){$cost_to_optimize-=$prices->SIMPLEMETARATE;}}
        if($temp == "twitter:card"){$output->is_meta_twitter_card = true;if($calculate_cost == true){$cost_to_optimize-=$prices->SIMPLEMETARATE;}}
        if($temp == "twitter:title"){$output->is_meta_twitter_title = true;if($calculate_cost == true){$cost_to_optimize-=$prices->SIMPLEMETARATE;}}
        if($temp == "twitter:description"){$output->is_meta_twitter_description = true;if($calculate_cost == true){$cost_to_optimize-=$prices->DESCRIPTIONRATE;}}
        if($temp == "twitter:image"){$output->is_meta_twitter_image = true;if($calculate_cost == true){$cost_to_optimize-=$prices->SIMPLEMETARATE;}}
        if($temp == "twitter:image:alt"){$output->is_meta_twitter_image_alt = true;if($calculate_cost == true){$cost_to_optimize-=$prices->ALTRATE;}}
        if($temp == "twitter:url"){$output->is_meta_twitter_url = true;if($calculate_cost == true){$cost_to_optimize-=$prices->SIMPLEMETARATE;}}
        if($temp == "apple-mobile-web-app-status-bar-style"){$output->is_meta_apple_mobile_web_app_status_bar_style = true;if($calculate_cost == true){$cost_to_optimize-=$prices->SIMPLEMETARATE;}}
        if($temp == "apple-mobile-web-app-title"){$output->is_meta_apple_mobile_web_app_title = true;if($calculate_cost == true){$cost_to_optimize-=$prices->SIMPLEMETARATE;}}


    }

    if($calculate_cost == true){
        $output->cost_to_optimize = round($cost_to_optimize,2);

        if(abs($output->cost_to_optimize) < .01){
            $output->cost_to_optimize = 0.00;
        }
    }

    return $output;
}


add_action( 'admin_post_loyae_form', 'loyae_form_handler' );
function loyae_admin_page($args) {
    
   
    $content = array (
        'posts' => get_posts($args),
        'pages' => get_pages()
    );
    

        echo   '<script>
                var totalAmount = 0.0;
                loader.style.display = "none";
                </script>';


        echo '<form action="admin-post.php" method="post">';
        wp_nonce_field( 'loyae_form_nonce', 'loyae_form_nonce_field' );
        echo '<input type="hidden" name="action" value="loyae_form">';

        foreach(array("posts", "pages") as $cat){
            if(!empty( $content[$cat] ) ){
               echo '<center> Everything: <input type="checkbox" cost="0" onclick="toggle(this, `'.esc_html($cat).'`)" onchange="sumAmount(this)"/><br/><br/><div class="table-container"><table class="timecard">
                                <caption>'.esc_html(ucfirst($cat)).'</caption>
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

                              
                
                for($i = 0; $i < count($content[$cat]); $i++){
                    $class = ''; if($i % 2 == 0){ $class = 'even';}else {$class = 'odd';}
                        $id = ($content[$cat])[$i]->ID;
                        $temp_local_diagnostic = loyae_local_diagnostic($id, true);
                                
                                echo '<tr class="'. esc_attr($class) .'">


                                <td><input type="checkbox" name="'.esc_attr($id).'_box" class="'.esc_attr($cat).'" cost="'.esc_attr($temp_local_diagnostic->cost_to_optimize).'" onchange="sumAmount(this)"/> ($'.esc_html($temp_local_diagnostic->cost_to_optimize).')</td>
                                <td><a href="' . esc_attr(get_permalink($id)) .'">' 
                                . esc_html(($content[$cat])[$i]->post_title).' ('.esc_html($id).') </a></td>
                                <!--<td><a href="javascript:diagnose('.esc_html($content[$cat][$i]->ID).')">🔍</a></td>-->

                                <td><span>Missing <b>'. esc_html($temp_local_diagnostic->number_of_imgs - $temp_local_diagnostic->num_of_imgs_with_alt) .'</b> of '.esc_html($temp_local_diagnostic->number_of_imgs).'</span></td>
                            

                                <td>'. ($temp_local_diagnostic->is_meta_description==true ? '<span style="color: green;">Has</span>'  : ' <span style="color: red;">Missing</span>') .'</td>
                            

                                <td>'.wp_kses_post(
                                ($temp_local_diagnostic->is_meta_og_description==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:description<br/>".
                                ($temp_local_diagnostic->is_meta_og_image==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:image<br/>".
                                ($temp_local_diagnostic->is_meta_og_image_alt==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:image:alt<br/>".
                                ($temp_local_diagnostic->is_meta_og_image_width==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:image:width<br/>".
                                ($temp_local_diagnostic->is_meta_og_image_height==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:image:height<br/>".
                                ($temp_local_diagnostic->is_meta_og_image_type==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:image:type<br/>".
                                ($temp_local_diagnostic->is_meta_og_site_name==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:site_name<br/>".
                                ($temp_local_diagnostic->is_meta_og_keywords==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:keywords<br/>".
                                ($temp_local_diagnostic->is_meta_og_title==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:title<br/>".
                                ($temp_local_diagnostic->is_meta_og_url==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:url<br/>".
                                ($temp_local_diagnostic->is_meta_og_type==true?"<b style='color:green'>Has</b>":"<b style='color:red'>Missing</b>"). " og:type<br/>"
                                      ).'</td>
                            



                                <td>'.wp_kses_post(
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
                                      ).'</td>
                               

                                </tr>';
                }

                echo '</table></div></center> </br></br></br>';
                
        
            } else {
                echo '<table class="timecard">
                                <caption>'.esc_html(ucfirst($cat)).'</caption>
                                <thread>NONE</thread>
                                </table>';
            }



        }


        
    


        echo   '<br/><!--<center>
                <b>Override All Current:</b> Alt data: <input type="checkbox"/>, 
                Meta Descriptions: <input type="checkbox"/>, 
                Meta Keywords: <input type="checkbox"/>,
                Open Graph Meta Tags: <input type="checkbox"/>,
                Essential Tags: <input type="checkbox"/>,
                Non-Essential Tags: <input type="checkbox"/>

                <br/></center>-->





                <!--payment-->
                <div id="outcard">
                <div id="card-contain">
                <div style="text-align: left;">
                <div class="input-label">First Name</div>
                <input type="text" name="fname"/>
                <br/><br/>

                <div class="input-label">Last Name</div>
                <input type="text" name="lname"/>
                <br/><br/>

                <div class="input-label">Email</div>
                <input type="text" name="email"/>
                <br/><br/>

                <div class="input-label">Card Number </div>
                <input type="text" name="number" maxlength="16" placeholder="• • • •   • • • •   • • • •   • • • •" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
                <br/><br/>

                <div class="input-label">CVC</div>
                <input type="text" name="cvc" maxlength="3" style="width: 60px;" placeholder="• • •" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
                <br/><br/>

                <div class="input-label">Expiration Year</div>
                <input type="text" name="expy" maxlength="4" style="width: 80px;" placeholder="20 • •" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
                <br/><br/>

                <div class="input-label">Expiration month</div>
                <input type="text" name="expm" maxlength="2" min="1" max="12" style="width: 50px;" placeholder="• •" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
                <br/><br/>

                <div class="input-label">Billing Address</div>
                <input type="text" name="address"/>
                <br/><br/>

                <div class="input-label">City</div>
                <input type="text" name="city"/>
                <br/><br/>

                <div class="input-label">State</div>
                <input type="text" name="state"/>
                <br/><br/>

                <div class="input-label">Zip or Postal Code</div>
                <input type="text" name="zip"/>
                <br/><br/>
                <div class="input-label">Country</div>
                <input type="text" name="country"/>


                <input type="number" name="amount" id="amount" step="0.01" min="0" style="display:none"/>
                <br/><br/>
                <div id="auth-logo">
                <a href="https://www.authorize.net/">
                <img src="'.esc_url(plugins_url('assets/authorizenet.png', __FILE__)).'" border="0" alt="Authorize.net Logo" width="100" height="25"/>
                </a>
                </div>
                </div>
                </div>
                </div>


                



                <br/><center>
                <p>By continuing, you agree to the <a href="https://www.loyae.com/terms.pdf">terms</a></p>
                <br/>
                <input type="submit" name="optimize" value="Optimize ($0.00)" id="optimize" onclick="return optmiz()"/>
                </center>
                </form>';

    
        echo '<script>loader.style.display = "none";</script>';

       
        
       
}


function loyae_null_case($str){
    if($str == null || $str == ""){
        return "<NULL>";
    }

    return $str;
} 

function loyae_get_generated_meta($id, $email, $cardnum){
    $rootapiurl = "https://api.loyae.com";//"http://localhost:8080";

    $meta = new loyae_GeneratedMeta();
    $post_class = get_post($id);



    $post_text = wp_strip_all_tags(apply_filters('the_content', get_post_field('post_content', $id)));
    
    $srcs = array();
    $imgs = array('null'=>'null');
    $dom = new DOMDocument();
    libxml_use_internal_errors(true); 
    $dom->loadHTML($post_class->post_content);
    libxml_clear_errors();
    $images = $dom->getElementsByTagName('img');


    if(count($images) != 0){
        for ($i = 0; $i < count($images); $i++) {
            $srcs[$i] = $images[$i]->getAttribute('src');
            $imgs[$srcs[$i]] = $images[$i]->getAttribute('alt');
        }
    }


    $all_metas = array(''=>'');
    $metas = $dom->getElementsByTagName("meta");
    for ($i = 0; $i < count($metas); $i++){
        $temp;
        if($metas->item($i)->attributes->getNamedItem("name") != null){
            $temp = $metas->item($i)->attributes->getNamedItem("name")->value;
        } else if($metas->item($i)->attributes->getNamedItem("property") != null && $metas->item($i)->attributes->getNamedItem("property")!="<NULL>") {
            $temp = $metas->item($i)->attributes->getNamedItem("property")->value;
        } else {
            $temp = null;
        }


        if($temp != null){
            $all_metas[$temp] = $metas->item($i)->attributes->getNamedItem("value")->value ?? $metas->item($i)->attributes->getNamedItem("content")->value;
        }
        
    }



    $apiurl = $rootapiurl.'/optimize/manual';

    
    $data = array(
        'User' => array('Email' => $email, 'CardNum' => $cardnum),
        'Url' => get_permalink($id),
        'Content' => $post_text,
        'Metas' => $all_metas,
        'Imgs' => $imgs
    );

   
    
    $json_data = json_encode($data);
    
    
    $response = wp_remote_post(
        $apiurl,
        array(
            'headers'   => array('Content-Type' => 'application/json'),
            'body'      => $json_data,
            'timeout'   => 86400, //Will take 24 hours to timeout
            'sslverify' => true, 
        )
    );
    
    if (is_wp_error($response)) {
        echo 'HTTP error: ' . esc_html($response->get_error_message());
    } else {
        $response_data = wp_remote_retrieve_body($response);
        $response_data = $response_data ? json_decode($response_data, true) : null;
    }
    


if($response_data != null){

   $diagnostic = loyae_local_diagnostic($id, false);
    $meta->ID = $id;
    $meta->loyae_description = (!$diagnostic->is_meta_description) ? loyae_null_case($response_data['Metas']['description']): "<NULL>";
    $meta->loyae_og_description = (!$diagnostic->is_meta_og_description) ? loyae_null_case($response_data['Metas']['og:description']): "<NULL>";
    $meta->loyae_og_image = (!$diagnostic->is_meta_og_image) ? loyae_null_case($response_data['Metas']['og:image']): "<NULL>";
    $meta->loyae_og_image_alt = (!$diagnostic->is_meta_og_image_alt) ? loyae_null_case($response_data['Metas']['og:image:alt']): "<NULL>";
    $meta->loyae_og_image_width = (!$diagnostic->is_meta_og_image_width) ? loyae_null_case($response_data['Metas']['og:image:width']): "<NULL>";
    $meta->loyae_og_image_height = (!$diagnostic->is_meta_og_image_height) ? loyae_null_case($response_data['Metas']['og:image:height']): "<NULL>";
    $meta->loyae_og_image_type = (!$diagnostic->is_meta_og_image_type) ? loyae_null_case($response_data['Metas']['og:image:type']): "<NULL>";
    $meta->loyae_og_site_name = (!$diagnostic->is_meta_og_site_name) ? loyae_null_case($response_data['Metas']['og:site_name']): "<NULL>";
    $meta->loyae_og_title = (!$diagnostic->is_meta_og_title) ? loyae_null_case($response_data['Metas']['og:title']): "<NULL>";
    $meta->loyae_og_url = (!$diagnostic->is_meta_og_url) ? loyae_null_case($response_data['Metas']['og:url']): "<NULL>";
    $meta->loyae_og_type = (!$diagnostic->is_meta_og_type) ? loyae_null_case($response_data['Metas']['og:type']): "<NULL>";
    $meta->loyae_og_keywords = (!$diagnostic->is_meta_og_keywords) ? loyae_null_case($response_data['Metas']['og:keywords']): "<NULL>";
    $meta->loyae_keywords = (!$diagnostic->is_meta_keywords) ? loyae_null_case($response_data['Metas']['keywords']): "<NULL>";
    $meta->loyae_theme_color = (!$diagnostic->is_meta_theme_color) ? loyae_null_case($response_data['Metas']['theme-color']): "<NULL>";
    $meta->loyae_twitter_card = (!$diagnostic->is_meta_twitter_card) ? loyae_null_case($response_data['Metas']['twitter:card']): "<NULL>";
    $meta->loyae_twitter_title = (!$diagnostic->is_meta_twitter_title) ? loyae_null_case($response_data['Metas']['twitter:title']): "<NULL>";
    $meta->loyae_twitter_description = (!$diagnostic->is_meta_twitter_description) ? loyae_null_case($response_data['Metas']['twitter:description']): "<NULL>";
    $meta->loyae_twitter_image = (!$diagnostic->is_meta_twitter_image) ? loyae_null_case($response_data['Metas']['twitter:image']): "<NULL>";
    $meta->loyae_twitter_image_alt = (!$diagnostic->is_meta_twitter_image_alt) ? loyae_null_case($response_data['Metas']['twitter:image:alt']): "<NULL>";
    $meta->loyae_twitter_url = (!$diagnostic->is_meta_twitter_url) ? loyae_null_case($response_data['Metas']['twitter:url']): "<NULL>";
    $meta->loyae_apple_mobile_web_app_status_bar_style = (!$diagnostic->is_meta_apple_mobile_web_app_status_bar_style) ? loyae_null_case($response_data['Metas']['apple-mobile-web-app-status-bar-style']): "<NULL>";
    $meta->loyae_apple_mobile_web_app_title = (!$diagnostic->is_meta_apple_mobile_web_app_title) ? loyae_null_case($response_data['Metas']['apple-mobile-web-app-title']): "<NULL>";
    $meta->loyae_optimized = date('Y-m-d');
   

    $temp_loyae_alt = $response_data['Alts'];
    $meta->loyae_alt = serialize($temp_loyae_alt);




   //Alt text could potentially be inputted here

        
}

    return (array)$meta; 
}






function loyae_form_handler() {

    // Verify nonce
    if( isset( $_POST['loyae_form_nonce_field'] ) && wp_verify_nonce( $_POST['loyae_form_nonce_field'], 'loyae_form_nonce' ) && current_user_can( 'manage_options' )) {
        //Check to make sure the form is filled out
        if( sanitize_email($_POST['email']) != "" && sanitize_text_field($_POST['fname']) != "" && sanitize_text_field($_POST['lname']) != "" && sanitize_text_field($_POST['number']) != "" && sanitize_text_field($_POST['cvc']) != "" && sanitize_text_field($_POST['expm']) != "" && sanitize_text_field($_POST['expy']) != "" && floatVal(sanitize_text_field( $_POST['amount'])) >= 0 && sanitize_text_field($_POST['address']) != "" && sanitize_text_field($_POST['city']) != "" && sanitize_text_field($_POST['state']) != "" && sanitize_text_field($_POST['zip']) != "" && sanitize_text_field($_POST['country']) != ""){

            $fundurl = "https://api.loyae.com/optimize/fund?email=".sanitize_email($_POST['email'])."&fname=".sanitize_text_field($_POST['fname'])."&lname=".sanitize_text_field($_POST['lname'])."&number=".sanitize_text_field($_POST['number'])."&cvc=".sanitize_text_field($_POST['cvc'])."&expm=".sanitize_text_field($_POST['expm'])."&expy=".sanitize_text_field($_POST['expy'])."&amount=".floatVal(sanitize_text_field( $_POST['amount']))."&discount=NONE"."&address=".sanitize_text_field($_POST['address']) ."&city=". sanitize_text_field($_POST['city']) ."&state=". sanitize_text_field($_POST['state']) ."&zip=". sanitize_text_field($_POST['zip']) ."&country=". sanitize_text_field($_POST['country']);

           $funddata = null;
            $fund = wp_remote_get($fundurl);
            if(!is_wp_error($fund)){
                $funddata= json_decode(wp_remote_retrieve_body($fund));
            }


            if ($funddata != null && $funddata->Err === false){


                global $wpdb;
                $loyae_generated_data = $wpdb->prefix . 'loyae_generated_data';


                ////////////////   For testing
                    //$wpdb->query("DROP TABLE IF EXISTS $loyae_generated_data");
                ///////////////


                $charset_collate = $wpdb->get_charset_collate();

                echo "<div style='text-align:center; font-family: arial'><span style='color:green;font-size: 25px;'>Thank You!</span><br/><br/>
                <span style='color:black;font-size: 20px;'>PLEASE CONTACT US AT contact@loyae.com IF ISSUES ARISE</span><br/><br/>
                <span style='color:black;font-size: 20px;'>Note: sometimes Loyae will deliberately avoid placing some metadata on pages with not enough content.</span><br/><br/>
                <br/><br/><br/></div>";
                $data_entries = array("description", "og_description", "og_image", "og_image_alt", "og_image_width", "og_image_height", "og_image_type", "og_site_name", "og_title", "og_url", "og_type", "og_keywords", "keywords", "theme_color", "twitter_card", "twitter_title", "twitter_description", "twitter_image", "twitter_image_alt", "twitter_url", "apple_mobile_web_app_status_bar_style", "apple_mobile_web_app_title", "optimized", "alt");
                $entry = "";
                for($i = 0; $i < count($data_entries); $i++){
                    $entry .= "\nloyae_".$data_entries[$i]." text DEFAULT '' NOT NULL,";
                }

                $sql = "CREATE TABLE $loyae_generated_data (
                ID int NOT NULL,".$entry."
                PRIMARY KEY (ID)
                ) $charset_collate;";

                require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
                dbDelta( $sql );


                status_header(200);

                echo '<br/><br/>';

                    // Iterate through $_POST keys
                    foreach($_POST as $key => $value) {
                        // Sanitize the key to ensure it's safe to use
                        $sanitized_key = sanitize_key($key);

                        // Extract the ID from the key
                        $id = (int)substr($sanitized_key, 0, strpos($sanitized_key, "_"));

                        // Check if the ID is valid and not empty
                        if (!empty($id)) {
                            // Check if the ID is different from the form ID
                            if ($id != $form_id) {
                                // Check if the ID doesn't exist in the database
                                if ($wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$loyae_generated_data} WHERE ID = %d", $id)) == 0) {
                                    // Get generated data
                                    $generated_data = loyae_get_generated_meta($id, sanitize_email($_POST['email']), sanitize_text_field((string)($_POST['number'])));

                                    // Check if generated data ID is not null
                                    if ($generated_data["ID"] != null) {
                                        // Insert generated data into the database
                                        $wpdb->insert($loyae_generated_data, $generated_data);
                                    }
                                }
                            }
                        }
                    }


                    echo "<br/><br/>";
                    echo '<div style="text-align: center;"><a href="'.esc_url(get_home_url()).'" style="border: 0; background-color: lightcoral; border-radius: 10px; height: 30px; width: 50px; padding: 10px; color: white;text-decoration: none;">Home</a></div>';
                    echo "<br/><br/>";






            } else {
                echo 'There was an error with your payment';
            }
        } else {
            echo 'ERROR: Please select at least one page to optimize and enter your card information in its entirety';
        }
    } else {
        echo 'Nonce verification failed. Please email contact@loyae.com';
    }
}


/*
function loyae_form_handler() {
    //Check to make sure the form is filled out
    if(sanitize_email($_POST['email']) != "" && sanitize_text_field($_POST['fname']) != "" && sanitize_text_field($_POST['lname']) != "" && sanitize_text_field($_POST['number']) != "" && sanitize_text_field($_POST['cvc']) != "" && sanitize_text_field($_POST['expm']) != "" && sanitize_text_field($_POST['expy']) != "" && (float)$_POST['amount'] >= 0 && sanitize_text_field($_POST['address']) != "" && sanitize_text_field($_POST['city']) != "" && sanitize_text_field($_POST['state']) != "" && sanitize_text_field($_POST['zip']) != "" && sanitize_text_field($_POST['country']) != ""){
            
    $fundurl = "https://api.loyae.com/optimize/fund?email=".sanitize_email($_POST['email'])."&fname=".sanitize_text_field($_POST['fname'])."&lname=".sanitize_text_field($_POST['lname'])."&number=".sanitize_text_field($_POST['number'])."&cvc=".sanitize_text_field($_POST['cvc'])."&expm=".sanitize_text_field($_POST['expm'])."&expy=".sanitize_text_field($_POST['expy'])."&amount=".(float)$_POST['amount']."&discount=NONE"."&address=".sanitize_text_field($_POST['address']) ."&city=". sanitize_text_field($_POST['city']) ."&state=". sanitize_text_field($_POST['state']) ."&zip=". sanitize_text_field($_POST['zip']) ."&country=". sanitize_text_field($_POST['country']);
      
       $funddata = null;
        $fund = wp_remote_get($fundurl);
        if(!is_wp_error($fund)){
            $funddata= json_decode(wp_remote_retrieve_body($fund));
        }
       
        
        if ($funddata != null && $funddata->Err === false){
                    
            
            global $wpdb;
            $loyae_generated_data = $wpdb->prefix . 'loyae_generated_data';


            ////////////////   For testing
                //$wpdb->query("DROP TABLE IF EXISTS $loyae_generated_data");
            ///////////////


            $charset_collate = $wpdb->get_charset_collate();
            
            echo "<div style='text-align:center; font-family: arial'><span style='color:green;font-size: 25px;'>Thank You!</span><br/><br/>
            <span style='color:black;font-size: 20px;'>PLEASE CONTACT US AT contact@loyae.com IF ISSUES ARISE</span><br/><br/>
            <span style='color:black;font-size: 20px;'>Note: sometimes Loyae will deliberately avoid placing some metadata on pages with not enough content.</span><br/><br/>
            <br/><br/><br/></div>";
            $data_entries = array("description", "og_description", "og_image", "og_image_alt", "og_image_width", "og_image_height", "og_image_type", "og_site_name", "og_title", "og_url", "og_type", "og_keywords", "keywords", "theme_color", "twitter_card", "twitter_title", "twitter_description", "twitter_image", "twitter_image_alt", "twitter_url", "apple_mobile_web_app_status_bar_style", "apple_mobile_web_app_title", "optimized", "alt");
            $entry = "";
            for($i = 0; $i < count($data_entries); $i++){
                $entry .= "\nloyae_".$data_entries[$i]." text DEFAULT '' NOT NULL,";
            }
            
            $sql = "CREATE TABLE $loyae_generated_data (
            ID int NOT NULL,".$entry."
            PRIMARY KEY (ID)
            ) $charset_collate;";
            
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );


            status_header(200);
            
            echo '<br/><br/>';

                // Iterate through $_POST keys
                foreach($_POST as $key => $value) {
                    // Sanitize the key to ensure it's safe to use
                    $sanitized_key = sanitize_key($key);

                    // Extract the ID from the key
                    $id = (int)substr($sanitized_key, 0, strpos($sanitized_key, "_"));

                    // Check if the ID is valid and not empty
                    if (!empty($id)) {
                        // Check if the ID is different from the form ID
                        if ($id != $form_id) {
                            // Check if the ID doesn't exist in the database
                            if ($wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $loyae_generated_data WHERE ID = %d", $id)) == 0) {
                                // Get generated data
                                $generated_data = loyae_get_generated_meta($id, sanitize_email($_POST['email']), (string)($_POST['number']));

                                // Check if generated data ID is not null
                                if ($generated_data["ID"] != null) {
                                    // Insert generated data into the database
                                    $wpdb->insert($loyae_generated_data, $generated_data);
                                }
                            }
                        }
                    }
                }


                echo "<br/><br/>";
                echo '<div style="text-align: center;"><a href="'.esc_url(get_home_url()).'" style="border: 0; background-color: lightcoral; border-radius: 10px; height: 30px; width: 50px; padding: 10px; color: white;text-decoration: none;">Home</a></div>';
                echo "<br/><br/>";




            
            
        } else {
            echo 'There was an error with your payment';
        }
    } else {
        echo 'ERROR: Please select at least one page to optimize and enter your card information in its entirety';
    }
}
*/




function loyae_add_meta_tag() {
    global $wpdb;
    $loyae_generated_data = $wpdb->prefix . 'loyae_generated_data';

        if(is_single() or is_page()){
            $meta = NULL;
            if(!empty($loyae_generated_data) && !empty(get_the_ID()) && $wpdb->get_var("SHOW TABLES LIKE '$loyae_generated_data'") == $loyae_generated_data && $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $loyae_generated_data WHERE ID = %d", get_the_ID()))){
                $meta = ($wpdb->get_results($wpdb->prepare("SELECT * FROM $loyae_generated_data WHERE ID = %d", get_the_ID())))[0];
            }

    
            echo '<!--LOYAE: the following metadata has been generated by loyae.com-->'."\n";

            if($meta != NULL){
            

                //If it's <NULL> then don't put it in
                if($meta->loyae_description!="<NULL>"){
                    echo '<meta name="description" content="' . esc_attr($meta->loyae_description) . '" />' . "\n";
                }
                if($meta->loyae_og_description!="<NULL>"){
                    echo '<meta property="og:description" content="' . esc_attr($meta->loyae_og_description) . '" />' . "\n";
                }
                if($meta->loyae_og_image!="<NULL>"){
                    echo '<meta property="og:image" content="' . esc_url($meta->loyae_og_image) . '" />' . "\n";
                }
                if($meta->loyae_og_image_alt!="<NULL>"){
                    echo '<meta property="og:image:alt" content="' . esc_attr($meta->loyae_og_image_alt) . '" />' . "\n";
                }
                if($meta->loyae_og_image_width!="<NULL>"){
                    echo '<meta property="og:image:width" content="' . esc_attr($meta->loyae_og_image_width) . '" />' . "\n";
                }
                if($meta->loyae_og_image_height!="<NULL>"){
                    echo '<meta property="og:image:height" content="' . esc_attr($meta->loyae_og_image_height) . '" />' . "\n";
                }
                if($meta->loyae_og_image_type!="<NULL>"){
                    echo '<meta property="og:image:type" content="' . esc_attr($meta->loyae_og_image_type) . '" />' . "\n";
                }
                if($meta->loyae_og_site_name!="<NULL>"){
                    echo '<meta property="og:site_name" content="' . esc_attr($meta->loyae_og_site_name) . '" />' . "\n";
                }
                if($meta->loyae_og_title!="<NULL>"){
                    echo '<meta property="og:title" content="' . esc_attr($meta->loyae_og_title) . '" />' . "\n";
                }
                if($meta->loyae_og_url!="<NULL>"){
                    echo '<meta property="og:url" content="' . esc_url($meta->loyae_og_url) . '" />' . "\n";
                }
                if($meta->loyae_og_type!="<NULL>"){
                    echo '<meta property="og:type" content="' . esc_attr($meta->loyae_og_type) . '" />' . "\n";
                }
                if($meta->loyae_og_keywords != "<NULL>"){
                    echo '<meta property="og:keywords" content="' . esc_attr($meta->loyae_og_keywords) . '" />' . "\n";
                }
                if($meta->loyae_keywords!="<NULL>"){
                    echo '<meta name="keywords" content="' . esc_attr($meta->loyae_keywords) . '" />' . "\n";
                }
                if($meta->loyae_theme_color!="<NULL>"){
                    echo '<meta name="theme-color" content="' . esc_attr($meta->loyae_theme_color) . '" />' . "\n";
                }
                if($meta->loyae_twitter_card!="<NULL>"){
                    echo '<meta name="twitter:card" content="' . esc_attr($meta->loyae_twitter_card) . '" />' . "\n";
                }
                if($meta->loyae_twitter_title!="<NULL>"){
                    echo '<meta name="twitter:title" content="' . esc_attr($meta->loyae_twitter_title) . '" />' . "\n";
                }
                if($meta->loyae_twitter_description!="<NULL>"){
                    echo '<meta name="twitter:description" content="' . esc_attr($meta->loyae_twitter_description) . '" />' . "\n";
                }
                if($meta->loyae_twitter_image!="<NULL>"){
                    echo '<meta name="twitter:image" content="' . esc_url($meta->loyae_twitter_image) . '" />' . "\n";
                }
                if($meta->loyae_twitter_image_alt!="<NULL>"){
                    echo '<meta name="twitter:image:alt" content="' . esc_attr($meta->loyae_twitter_image_alt) . '" />' . "\n";
                }
                if($meta->loyae_twitter_url!="<NULL>"){
                    echo '<meta name="twitter:url" content="' . esc_url($meta->loyae_twitter_url) . '" />' . "\n";
                }
                if($meta->loyae_apple_mobile_web_app_status_bar_style!="<NULL>"){
                    echo '<meta name="apple-mobile-web-app-status-bar-style" content="' . esc_attr($meta->loyae_apple_mobile_web_app_status_bar_style) . '" />' . "\n";
                }
                if($meta->loyae_apple_mobile_web_app_title!="<NULL>"){
                    echo '<meta name="apple-mobile-web-app-title" content="' . esc_attr($meta->loyae_apple_mobile_web_app_title) . '" />' . "\n";
                }
                if($meta->loyae_optimized!="<NULL>"){
                    echo '<meta property="loyae:optimized" content="'. esc_attr($meta->loyae_optimized) .'" />' . "\n";
                }

                echo '<meta name="generator" content="https://loyae.com" />' . "\n";



               
            } else {
                echo '<!--No metadata yet! Please click optimize on the plugin dashboard-->'."\n";
            }
            echo '<!--LOYAE END-->'."\n";

           

    }
}


add_action( 'wp_head', 'loyae_add_meta_tag');



function loyae_add_alt_text($post_content) {
    global $wpdb;
    $loyae_generated_data = $wpdb->prefix . 'loyae_generated_data';

    $loyae_alt = NULL;
    $meta = NULL;
    if(!empty($loyae_generated_data) && !empty(get_the_ID()) && $wpdb->get_var("SHOW TABLES LIKE '$loyae_generated_data'") == $loyae_generated_data && $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $loyae_generated_data WHERE ID = %d", get_the_ID()))){
        $meta = ($wpdb->get_results($wpdb->prepare("SELECT * FROM $loyae_generated_data WHERE ID = %d", get_the_ID())))[0];
    }
        


    if($meta != NULL){
        $loyae_alt = unserialize($meta->loyae_alt);
    }     


    
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML(mb_convert_encoding($post_content, 'HTML-ENTITIES', 'UTF-8'));
    libxml_use_internal_errors(false);

    
    $images = $dom->getElementsByTagName('img');

    
    foreach ($images as $image) {
        $src = $image->getAttribute('src');
        if($loyae_alt != null && array_key_exists($src, $loyae_alt)){
            $image->setAttribute('alt', esc_attr($loyae_alt[$src]));
        }
    }

    //Insert alt text
    $updated_post_content = $dom->saveHTML();

    return $updated_post_content;
}



add_filter('the_content', 'loyae_add_alt_text');

?>
