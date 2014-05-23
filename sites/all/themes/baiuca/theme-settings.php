<?php
/**
 * @file
 * theme-settings.php
 *
 * Provides theme settings for Bootstrap based themes when admin theme is not.
 *
 * @see theme/settings.inc
 */
define('BAIUCA_THEME',"baiuca");

function baiuca_form_system_theme_settings_alter(&$form, &$form_state) {

    if(theme_get_setting('slider_type') == null){
        $default = "partial";
    }
    else{
        $default = theme_get_setting('slider_type');
    }

    $form['baiuca'] = array(
        '#type' => 'vertical_tabs',
        '#attached' => array(
            'js'  => array(drupal_get_path('theme', 'bootstrap') . '/js/bootstrap.admin.js'),
        ),
        '#prefix' => '<h2><small>' . t('baiuca Settings') . '</small></h2>',
        '#weight' => -9,
    );

    // Components.
    $form['slideshow'] = array(
        '#type' => 'fieldset',
        '#title' => t('Slideshow'),
        '#group' => 'baiuca',
    );

    $form['slideshow']['slider_type'] = array(
        '#type' => 'radios',
        '#title' => t('Homepage slider size'),
        '#description' => t('Specify ur type of slider.'),
        '#options' => array(
            'partial' => t('Partial'),
            'full' => t('Full height'),
        ),
        '#default_value' => $default,
    );

    $form['layout'] = array(
        '#type' => 'fieldset',
        '#title' => t('Layout'),
        '#group' => 'baiuca',
    );

    if(theme_get_setting('layout_type') == null){
        $default_layout = "full_width";
    }
    else{
        $default_layout = theme_get_setting('layout_type');
    }

    $form['layout']['layout_type'] = array(
        '#type' => 'radios',
        '#title' => t('Homepage slider size'),
        '#description' => t('Specify ur type of slider.'),
        '#options' => array(
            'full_width' => t('Full width'),
            'boxed' => t('Boxed'),
        ),
        '#default_value' => $default_layout,
    );

    $form['background_image'] = array(
        '#type' => 'fieldset',
        '#title' => t('Background image'),
        '#group' => 'baiuca',
    );

    $form['background_image']['background_file'] = array(
        '#type' => 'managed_file',
        '#title'    => t('Background'),
        '#required' => FALSE,
        '#description' => t('Specify your background image'),
        '#upload_location' => 'public://',
        '#default_value' => theme_get_setting('background_file'),
        '#upload_validators' => array(
            'file_validate_extensions' => array('gif png jpg jpeg'),
        ),
    );

    $form['background_image_quotes'] = array(
        '#type' => 'fieldset',
        '#title' => t('Background Quotes'),
        '#group' => 'baiuca',
    );

    $form['background_image_quotes']['background_quote'] = array(
        '#type' => 'managed_file',
        '#title'    => t('Background for quotes'),
        '#required' => FALSE,
        '#description' => t('Specify your background image for the quotes section'),
        '#upload_location' => 'public://',
        '#default_value' => theme_get_setting('background_quote'),
        '#upload_validators' => array(
            'file_validate_extensions' => array('gif png jpg jpeg'),
        ),
    );

    $form['background_image_social'] = array(
        '#type' => 'fieldset',
        '#title' => t('Background Social region'),
        '#group' => 'baiuca',
    );

    $form['background_image_social']['background_social'] = array(
        '#type' => 'managed_file',
        '#title'    => t('Background for social region'),
        '#required' => FALSE,
        '#description' => t('Specify your background image for the social section'),
        '#upload_location' => 'public://',
        '#default_value' => theme_get_setting('background_social'),
        '#upload_validators' => array(
            'file_validate_extensions' => array('gif png jpg jpeg'),
        ),
    );

    drupal_add_js('jQuery(document).ready(function () { jQuery("#edit-theme-preset-radio input").change(function(){

                    var value = jQuery(this).val();

                    jQuery(".color-form #edit-scheme").val(value).change();

                }); });',
        array('type' => 'inline', 'scope' => 'footer', 'weight' => 5)
    );

    $form['baiuca_demo'] = array(
        '#type' => 'vertical_tabs',
        '#attached' => array(
            'js'  => array(drupal_get_path('theme', 'bootstrap') . '/js/bootstrap.admin.js'),
        ),
        '#prefix' => '<h2><small>' . t('Demo Content and features') . '</small></h2>',
        '#weight' => -8,
    );

    // Components.
    $form['demo_content'] = array(
        '#type' => 'fieldset',
        '#title' => t('Features content'),
        '#group' => 'baiuca_demo',
    );

    if(theme_get_setting('demo_features_installed') == null){
        $default_demo = 0;
    }
    else{
        $default_demo = theme_get_setting('demo_features_installed');
    }

    $form['demo_content']['demo_features_installed'] = array(
        '#type' => 'checkbox',
        '#title' => t('Install features'),
        '#description' => t('Click to install theme features like flexslider,quotes,menu.'),
        '#default_value' => $default_demo,
    );

    if(theme_get_setting('demo_content_installed') == null){
        $default_demo_content = 0;
    }
    else{
        $default_demo_content = theme_get_setting('demo_content_installed');
    }

    $form['demo_content']['demo_content_installed'] = array(
        '#type' => 'checkbox',
        '#title' => t('Install demo Content'),
        '#description' => t('Click to install the theme demonstration content.'),
        '#default_value' => $default_demo_content,
    );

    if(theme_get_setting('demo_content_installed') == null){
        $default_preset = "blue";
    }
    else{
        $default_preset = theme_get_setting('theme_preset_radio');
    }

    $form['demo_content']['theme_preset_radio'] = array(
        '#type' => 'radios',
        '#default_value' => 'baiuca',
        '#options' => array(
            'blue' => t('Baiuca Baker'),
            'red' => t('Baiuca Pizza'),
            'orange' => t('Baiuca Sushi'),
            'blue_greek' => t('Baiuca Greek'),
        ),
        '#title' => t('What demo would you like to install?'),
        '#default_value' => $default_preset,
    );
    //array_unshift($form['#submit'], "baiuca_form_system_theme_settings_submit");
    $form['#submit'][] = "baiuca_settings_form_submit";
    //$form['submit'][] = "simplicity_form_system_theme_settings_submit";

    // Get all themes.
    $themes = list_themes();
    // Get the current theme
    $active_theme = $GLOBALS['theme_key'];
    $form_state['build_info']['files'][] = str_replace("/$active_theme.info", '', $themes[$active_theme]->filename) . '/theme-settings.php';

}

function baiuca_settings_form_submit(&$form, $form_state){

    $image_fid = $form_state['values']['background_file'];
    $image = file_load($image_fid);
    if (is_object($image)) {
        // Check to make sure that the file is set to be permanent.
        if ($image->status == 0) {
            // Update the status.
            $image->status = FILE_STATUS_PERMANENT;
            // Save the update.
            file_save($image);
            // Add a reference to prevent warnings.
            file_usage_add($image, BAIUCA_THEME, 'theme', 1);
        }
    }

    $image_fid = $form_state['values']['background_quote'];
    $image = file_load($image_fid);
    if (is_object($image)) {
        // Check to make sure that the file is set to be permanent.
        if ($image->status == 0) {
            // Update the status.
            $image->status = FILE_STATUS_PERMANENT;
            // Save the update.
            file_save($image);
            // Add a reference to prevent warnings.
            file_usage_add($image, BAIUCA_THEME, 'theme', 1);
        }
    }

    $image_fid = $form_state['values']['background_social'];
    $image = file_load($image_fid);
    if (is_object($image)) {
        // Check to make sure that the file is set to be permanent.
        if ($image->status == 0) {
            // Update the status.
            $image->status = FILE_STATUS_PERMANENT;
            // Save the update.
            file_save($image);
            // Add a reference to prevent warnings.
            file_usage_add($image, BAIUCA_THEME, 'theme', 1);
        }
    }


    $preset_selected = $form_state['values']['theme_preset_radio'];

    $preset_selected = variable_set("baiuca_preset_selected",$preset_selected);

    $module_list = array(
        "jota_flexslider",
        "simplicity_blog",
        "menu_bakery",
        "fontawesome",
        "fontyourface",
        "fontyourface_ui",
        "google_fonts_api",
        "jota_quotes",
        "contact",
    );

    if($form_state['values']['demo_features_installed']){

        //THEME FEATURES HAS BEEN ENABLED (StiLL CHECK FOR IF IT HAD ALREADY BEEN SET)

        $features_enabled = variable_get("baiuca_features","disabled");

        if($features_enabled != "enabled"){

            //RUN THEM
            foreach($module_list as $module){
                if(!module_exists($module)){
                    module_enable(array($module));
                }
            }

            $features_enabled = variable_set("baiuca_features","enabled");

            demo_insert_blocks_in_places();

            drupal_flush_all_caches();

            demo_insert_terms();

            demo_insert_drupal_menus();

            demo_insert_custom_blocks();

            demo_set_font();

            drupal_set_message(t("Baiuca features where installed"));

        }



    }
    else{

        $features_enabled = variable_set("baiuca_features","disabled");

    }


    if($form_state['values']['demo_content_installed']){

        $demo_content_enabled = variable_get("baiuca_demo_content","disabled");

        if($demo_content_enabled != "enabled"){

            //CHECK IF IS TO INSERT DEMO CONTENT

            //demo_set_preset();

            demo_insert_slide1();
            demo_insert_slide2();
            demo_insert_slide3();

            demo_insert_menus();

            demo_insert_blogs();

            //demo_insert_contact_form();

            demo_insert_pages();

            $demo_content_enabled = variable_set("baiuca_demo_content","enabled");

            drupal_set_message(t("Baiuca demo content was installed"));

        }

    }

}

function demo_insert_blocks_in_places(){
// Enable some baiuca blocks.
    $default_theme = BAIUCA_THEME;
    $admin_theme = 'seven';
    $values = array(
        array(
            'module' => 'views',
            'delta' => 'flexslider_slideshow-block',
            'theme' => $default_theme,
            'status' => 1,
            'weight' => 0,
            'region' => 'hero',
            'visibility' => 1,
            'pages' => '<front>',
            'title' => '<none>',
            'cache' => -1,
        ),array(
            'module' => 'views',
            'delta' => 'quotes_block-block',
            'theme' => $default_theme,
            'status' => 1,
            'weight' => 0,
            'region' => 'quotes',
            'visibility' => 1,
            'pages' => '<front>',
            'title' => '<none>',
            'cache' => -1,
        ),
        array(
            'module' => 'views',
            'delta' => 'blocks-block_3',
            'theme' => $default_theme,
            'status' => 1,
            'weight' => 0,
            'region' => 'content',
            'visibility' => 1,
            'pages' => '<front>',
            'title' => '<none>',
            'cache' => -1,
        ),
        array(
            'module' => 'views',
            'delta' => 'menu-block',
            'theme' => $default_theme,
            'status' => 1,
            'weight' => 1,
            'region' => 'third_content',
            'visibility' => 1,
            'pages' => '<front>',
            'title' => '<none>',
            'cache' => -1,
        ),
        /* array(
             'module' => 'system',
             'delta' => 'main-menu',
             'theme' => $default_theme,
             'status' => 1,
             'weight' => 0,
             'region' => 'navigation',
             'visibility' => 0,
             'pages' => '',
             'title' => '<none>',
             'cache' => -1,
         ),*/
        /* array(
             'module' => 'system',
             'delta' => 'main',
             'theme' => $default_theme,
             'status' => 1,
             'weight' => 1,
             'region' => 'content',
             'visibility' => 0,
             'pages' => '',
             'title' => '<none>',
             'cache' => -1,
         ),*/
    );
    $query = db_insert('block')->fields(array('module', 'delta', 'theme', 'status', 'weight', 'visibility', 'region', 'pages', 'title', 'cache'));
    foreach ($values as $record) {
        $query->values($record);
    }
    $query->execute();

    //TAKE SEARCH  OUT - NOT SUPPORTED BY THEME

    db_merge('block')
        ->key(array('theme' => $default_theme, 'delta' => "form", 'module' => "search"))
        ->fields(array(
            'region' => (BLOCK_REGION_NONE),
            'pages' => trim(""),
            'status' => (int) (BLOCK_REGION_NONE),
            'visibility' => 0,
        ))
        ->execute();

    db_merge('block')
        ->key(array('theme' => $default_theme, 'delta' => "navigation", 'module' => "system"))
        ->fields(array(
            'region' => (BLOCK_REGION_NONE),
            'pages' => trim(""),
            'status' => (int) (BLOCK_REGION_NONE),
            'visibility' => 0,
        ))
        ->execute();

    db_merge('block')
        ->key(array('theme' => $default_theme, 'delta' => "login", 'module' => "user"))
        ->fields(array(
            'region' => (BLOCK_REGION_NONE),
            'pages' => trim(""),
            'status' => (int) (BLOCK_REGION_NONE),
            'visibility' => 0,
        ))
        ->execute();
}

function demo_insert_terms(){
    //Post type taxonomy
    $post_terms[0]['name'] = "Standard";
    $post_terms[1]['name'] = "Embed video";
    $post_terms[2]['name'] = "Self hosted video";
    $post_terms[3]['name'] = "Soundcloud";
    $post_terms[4]['name'] = "Self hosted audio";

    $voc = taxonomy_vocabulary_machine_name_load('blog_type');
    foreach ($post_terms as $post_term_name) {
        $post_term = new stdClass();
        $post_term->name = $post_term_name['name'];
        $post_term->vid = $voc->vid;
        taxonomy_term_save($post_term);
    }
}

function demo_insert_blogs(){

    $theme = BAIUCA_THEME;

    $preset = variable_get("baiuca_preset_selected","blue");

    $dir_root = dirname($_SERVER['SCRIPT_FILENAME']);
    $path_theme = $dir_root . "/sites/all/themes/" . $theme;

    $dir = 'content';
    $ext = 'content';
    $account = NULL;

    $path = dirname(__FILE__);

    //$files = file_scan_directory($path . '/' . $dir, "\.content$");
//    die(var_dump($path_theme));

    $files = file_scan_directory($path_theme . '/' . $dir.'/'.$preset, '/\.content/', array('key' => 'name'));

    foreach ($files as $file) {

        if ($file->filename == "blogs.content") {

            $blogs = array();
            ob_start();

            require $file->uri;

            ob_end_clean();

            $blogs = (object) $blogs;

            foreach ($blogs as $node_item) {

                $node = (object) $node_item;

                $node->uid = $account ? $account->uid : 1;

                node_save($node);

                //Save project Image
                if (isset($node->field_image) && is_array($node->field_image)) {

                    $count_index = 0;
                    foreach ($node->field_image as $image) {

                        /**
                         * Add a file.
                         */
                        // Some filepath on our system. It's the Druplicon! :D
                        //$filepath = drupal_realpath('misc/' . $image);
                        $filepath = drupal_realpath($image);

                        // Create managed File object and associate with Image field.
                        $file = (object) array(
                            'uid' => 1,
                            'uri' => $filepath,
                            'filemime' => file_get_mimetype($filepath),
                            'status' => 1,
                        );

                        // We save the file to the root of the files directory.
                        $file = file_copy($file, 'public://');

                        $node->field_image["und"][$count_index] = (array) $file;
                        $node->field_image["und"][$count_index]['fid'] = (string) $file->fid;

                        $count_index = $count_index + 1;
                    }

                    //node_save((object) $node);
                }


                //$node = (object) $node;
                //Insert taxonomy
                foreach ($node->field_post_type as $blog_type) {

                    //die(var_dump($placement));

                    foreach ($blog_type as $last_term) {

                        //Se hover varios termos so esta a inserir um pq e uma dropdown
                        $term = taxonomy_get_term_by_name($last_term);

                        foreach ($term as $term_item) {
                            if ($term_item != null) {
                                //die(var_dump($term_item->tid));
                                $node->field_post_type["und"][0]['tid'] = $term_item->tid;
                            }
                        }
                    }
                }

                //Field tags

                $voc = taxonomy_vocabulary_machine_name_load('Tags');

                $count = 0;
                foreach ($node->field_tags as $tag) {

                    $tag_term = new stdClass();
                    $tag_term->name = $tag['name'];
                    $tag_term->vid = $voc->vid;
                    taxonomy_term_save($tag_term);

                    $node->field_tags["und"][$count]['tid'] = $tag_term->tid;
                    $count++;
                }


                if (isset($node->field_video_embed) && is_array($node->field_video_embed)) {

                    foreach ($node->field_video_embed as $video_embed) {

                        $node->field_video_embed["und"][0]['video_url'] = $video_embed['video_url'];

                    }

                }


                //MEDIA FILES (VIDEO)
                if (isset($node->field_media_element) && is_array($node->field_media_element)) {

                    $count_index = 0;
                    foreach ($node->field_media_element as $video) {

                        /**
                         * Add a file.
                         */
                        // Some filepath on our system. It's the Druplicon! :D
                        //$filepath = drupal_realpath('misc/' . $image);
                        $filepath = drupal_realpath($video);

                        // Create managed File object and associate with Image field.
                        $file = (object) array(
                            'uid' => 1,
                            'uri' => $filepath,
                            'filemime' => file_get_mimetype($filepath),
                            'status' => 1,
                        );

                        // We save the file to the root of the files directory.
                        $file = file_copy($file, 'public://');

                        $node->field_media_element["und"][$count_index] = (array) $file;
                        $node->field_media_element["und"][$count_index]['fid'] = (string) $file->fid;
                        $node->field_media_element["und"][$count_index]['display'] = "1";


                        $count_index = $count_index + 1;
                    }

                    //node_save((object) $node);
                }

                //MEDIA FILES (AUDIO)
                if (isset($node->field_audio_upload) && is_array($node->field_audio_upload)) {

                    $count_index = 0;
                    foreach ($node->field_audio_upload as $audio) {

                        /**
                         * Add a file.
                         */
                        // Some filepath on our system. It's the Druplicon! :D
                        //$filepath = drupal_realpath('misc/' . $image);
                        $filepath = drupal_realpath($audio);

                        // Create managed File object and associate with Image field.
                        $file = (object) array(
                            'uid' => 1,
                            'uri' => $filepath,
                            'filemime' => file_get_mimetype($filepath),
                            'status' => 1,
                        );

                        // We save the file to the root of the files directory.
                        $file = file_copy($file, 'public://');

                        $node->field_audio_upload["und"][$count_index] = (array) $file;
                        $node->field_audio_upload["und"][$count_index]['fid'] = (string) $file->fid;
                        $node->field_audio_upload["und"][$count_index]['display'] = "1";

                        $count_index = $count_index + 1;
                    }

                    //node_save((object) $node);
                }

                //SOUNDCLOUD
                if (isset($node->field_soundcloud) && is_array($node->field_soundcloud)) {

                    foreach ($node->field_soundcloud as $soundcloud) {

                        $node->field_soundcloud["und"][0]['url'] = $soundcloud;

                    }

                }

                node_save((object) $node);

            }
        }
    }
}

function demo_insert_custom_blocks(){

    $theme = BAIUCA_THEME;

    $preset = variable_get("baiuca_preset_selected","blue");

    $dir_root = dirname($_SERVER['SCRIPT_FILENAME']);
    $path_theme = $dir_root . "/sites/all/themes/" . $theme;

    $dir = 'content';
    $ext = 'content';
    $account = NULL;

    $path = dirname(__FILE__);

    //$files = file_scan_directory($path . '/' . $dir, "\.content$");
//    die(var_dump($path_theme));

    $files = file_scan_directory($path_theme . '/' . $dir.'/'.$preset, '/\.content/', array('key' => 'name'));

    foreach ($files as $file) {

        if ($file->filename == "custom_blocks.content") {

            $custom_blocks = array();
            ob_start();

            require $file->uri;

            ob_end_clean();

            $custom_blocks = (object) $custom_blocks;

            foreach ($custom_blocks as $block_item) {

                $custom_block = $block_item;

                //CODE TO CREATE THE BLOCK
                $delta = db_insert('block_custom')
                    ->fields(array(
                        'body' => $custom_block['content'],
                        'info' => $custom_block['description'],
                        'format' => "full_html",
                    ))
                    ->execute();
                // Store block delta to allow other modules to work with new block.
                $custom_block_new_delta = $delta;
                $query = db_insert('block')->fields(array('visibility', 'pages', 'custom', 'title', 'module', 'theme','region', 'status', 'weight', 'delta', 'cache'));
                $query->values(array(
                    'visibility' => (int) $custom_block['visibility'],
                    'pages' => trim($custom_block['pages']),
                    'custom' => 1,
                    'title' => $custom_block['title'],
                    'module' => "block",
                    'theme' => $theme,
                    'region' => $custom_block['region'],
                    'status' => 1,
                    'weight' => $custom_block['weight'],
                    'delta' => $delta,
                    'cache' => DRUPAL_NO_CACHE,
                ));
                $query->execute();
                /*$query = db_insert('block_role')->fields(array('rid', 'module', 'delta'));
                $query->values(array(
                    'rid' => 1,
                    'module' => "block",
                    'delta' => $delta,
                ));
                $query->execute();*/
                // Store regions per theme for this block
                /*foreach ($form_state['values']['regions'] as $theme => $region) {
                    db_merge('block')
                        ->key(array('theme' => $theme, 'delta' => $delta, 'module' => $form_state['values']['module']))
                        ->fields(array(
                            'region' => ($region == BLOCK_REGION_NONE ? '' : $region),
                            'pages' => trim($form_state['values']['pages']),
                            'status' => (int) ($region != BLOCK_REGION_NONE),
                        ))
                        ->execute();
                }*/

            }
        }
    }
}

function demo_set_font(){

    $preset = variable_get("baiuca_preset_selected","blue");

    switch ($preset) {
        case 'blue':
            // Get array list of documents and chapters.

            //QUERY THE FONT ID - HEADER
            $name = 'Oswald regular (latin)';

            //Install raleways fonts

            //QUERY THE FONT ID - HEADER
            $name_body = 'Droid Serif regular (latin)';

            /*.titles selector*/
            $name_titles = 'Oswald regular (latin-ext)';
            $titles_selector = ".title, .menu";

            break;
        case 'red':

            //QUERY THE FONT ID - HEADER
            $name = 'Playfair Display italic (latin)';

            //Install raleways fonts

            //QUERY THE FONT ID - HEADER
            $name_body = 'Rosario italic (latin)';

            /*.titles selector*/
            $name_titles = 'Playfair Display italic (latin-ext)';
            $titles_selector = ".title, .menu";

            break;
        case 'blue_greek':

            //QUERY THE FONT ID - HEADER
            //$name = 'Roboto Condensed 700 (latin)';

            //Install raleways fonts

            //QUERY THE FONT ID - HEADER
            $name_body = 'Open Sans 300 (latin)';

            /*.titles selector*/
            $name_titles = 'Caesar Dressing regular (latin)';

            $titles_selector = ".title, .menu,h1,h2,h3,h4,h5,h6,.region-quotes p,.region-quotes,.views-field-title";

            break;
        case 'orange':

            //QUERY THE FONT ID - HEADER
            //$name = 'Roboto Condensed 700 (latin)';

            //Install raleways fonts

            //QUERY THE FONT ID - HEADER
            $name_body = 'Lato 300 (latin)';

            /*.titles selector*/
            $name_titles = 'Lato 700 (latin)';

            $titles_selector = ".menu,.title,h1,h2,h3,h4,h5,h6,body,p";

            break;
    }

    if(isset($name)){

        $query = db_select('fontyourface_font', 'font');
        $query->fields('font',array('name','fid'));
        $query->condition('name', '%' . db_like($name) . '%', 'LIKE');

        $fid = "";

        $result = $query->execute();
        while($record = $result->fetchAssoc()) {
            $fid = $record['fid'];
        }

        $headers_font = $fid;

        $fonts_update_headers = db_update('fontyourface_font') // Table name no longer needs {}
            ->fields(array(
                'enabled' => 1,
                'css_selector' => "h1, h2, h3, h4, h5, h6",
            ))
            ->condition('fid', $headers_font)
            ->execute();

    }


    if(isset($name_body)){

        $query = db_select('fontyourface_font', 'font');
        $query->fields('font',array('name','fid'));
        $query->condition('name', '%' . db_like($name_body) . '%', 'LIKE');

        $fid_body = "";

        $result = $query->execute();
        while($record = $result->fetchAssoc()) {
            $fid_body = $record['fid'];
        }
        $body_font = $fid_body;

        $fonts_update_body = db_update('fontyourface_font') // Table name no longer needs {}
            ->fields(array(
                'enabled' => 1,
                'css_selector' => "body",
            ))
            ->condition('fid', $body_font)
            ->execute();

    }


    if(isset($name_titles)){

        $query = db_select('fontyourface_font', 'font');
        $query->fields('font',array('name','fid'));
        $query->condition('name', '%' . db_like($name_titles) . '%', 'LIKE');

        $fid = "";

        $result = $query->execute();
        while($record = $result->fetchAssoc()) {
            $fid = $record['fid'];
        }

        $titles_font = $fid;

        $fonts_update_titles = db_update('fontyourface_font') // Table name no longer needs {}
            ->fields(array(
                'enabled' => 1,
                'css_selector' => $titles_selector,
            ))
            ->condition('fid', $titles_font)
            ->execute();

    }

}

function demo_set_preset(){

    $theme = BAIUCA_THEME;

    $preset = variable_get("baiuca_preset_selected","blue");

    //debug($preset);

    if($preset != "blue"){

        $fform = array();
        $fform_state = array();

        $fform_state['build_info']['args'][0] = $theme;
        $fform = system_theme_settings($fform, $fform_state, $theme);

        color_form_system_theme_settings_alter($fform, $fform_state);

        $fform_state['values']['theme'] = $theme;
        $fform_state['values']['info'] = color_get_info($theme);
        $fform_state['values']['palette'] = $fform_state['values']['info']['schemes'][$preset]['colors'];
        $fform_state['values']['scheme'] = $preset;

        color_scheme_form_submit($fform, $fform_state);

    }

}

function demo_insert_slide1(){

    $theme = BAIUCA_THEME;

    $preset = variable_get("baiuca_preset_selected","blue");

    $dir_root = dirname($_SERVER['SCRIPT_FILENAME']);
    $path_theme = $dir_root . "/sites/all/themes/" . $theme;

    $dir = 'content';
    $ext = 'content';
    $account = NULL;

    $path = dirname(__FILE__);

    //$files = file_scan_directory($path . '/' . $dir, "\.content$");
//    die(var_dump($path_theme));

    $files = file_scan_directory($path_theme . '/' . $dir.'/'.$preset, '/\.content/', array('key' => 'name'));

    foreach ($files as $file) {

        if ($file->filename == "slide1.content") {

            $node = array();
            ob_start();

            require $file->uri;

            ob_end_clean();

            $node = (object) $node;

            $node->uid = $account ? $account->uid : 1;

            node_save($node);

            //Get the node just saved to attach images
            $node_id_saved = $node->nid;

            node_object_prepare($node);

            if (is_array($node->field_hp_slide)) {

                $count_index = 0;
                foreach ($node->field_hp_slide as $image) {

                    /**
                     * Add a file.
                     */
                    // Some filepath on our system. It's the Druplicon! :D
                    //$filepath = drupal_realpath('misc/' . $image);
                    $filepath = drupal_realpath($image);

                    // Create managed File object and associate with Image field.
                    $file = (object) array(
                        'uid' => 1,
                        'uri' => $filepath,
                        'filemime' => file_get_mimetype($filepath),
                        'status' => 1,
                    );

                    // We save the file to the root of the files directory.
                    $file = file_copy($file, 'public://');

                    $node->field_hp_slide["und"][$count_index] = (array) $file;
                    $node->field_hp_slide["und"][$count_index]['fid'] = (string) $file->fid;

                    $count_index = $count_index + 1;
                }

                node_save((object) $node);
            }
        }
    }
}

function demo_insert_slide2(){

    $theme = BAIUCA_THEME;

    $preset = variable_get("baiuca_preset_selected","blue");

    $dir_root = dirname($_SERVER['SCRIPT_FILENAME']);
    $path_theme = $dir_root . "/sites/all/themes/" . $theme;

    $dir = 'content';
    $ext = 'content';
    $account = NULL;

    $path = dirname(__FILE__);

    //$files = file_scan_directory($path . '/' . $dir, "\.content$");
//    die(var_dump($path_theme));

    $files = file_scan_directory($path_theme . '/' . $dir.'/'.$preset, '/\.content/', array('key' => 'name'));

    foreach ($files as $file) {

        if ($file->filename == "slide2.content") {

            $node = array();
            ob_start();

            require $file->uri;

            ob_end_clean();

            $node = (object) $node;

            $node->uid = $account ? $account->uid : 1;

            node_save($node);

            //Get the node just saved to attach images
            $node_id_saved = $node->nid;

            node_object_prepare($node);

            if (is_array($node->field_hp_slide)) {

                $count_index = 0;
                foreach ($node->field_hp_slide as $image) {

                    /**
                     * Add a file.
                     */
                    // Some filepath on our system. It's the Druplicon! :D
                    //$filepath = drupal_realpath('misc/' . $image);
                    $filepath = drupal_realpath($image);

                    // Create managed File object and associate with Image field.
                    $file = (object) array(
                        'uid' => 1,
                        'uri' => $filepath,
                        'filemime' => file_get_mimetype($filepath),
                        'status' => 1,
                    );

                    // We save the file to the root of the files directory.
                    $file = file_copy($file, 'public://');

                    $node->field_hp_slide["und"][$count_index] = (array) $file;
                    $node->field_hp_slide["und"][$count_index]['fid'] = (string) $file->fid;

                    $count_index = $count_index + 1;
                }

                node_save((object) $node);
            }
        }
    }
}

function demo_insert_slide3(){

    $theme = BAIUCA_THEME;

    $preset = variable_get("baiuca_preset_selected","blue");

    $dir_root = dirname($_SERVER['SCRIPT_FILENAME']);
    $path_theme = $dir_root . "/sites/all/themes/" . $theme;

    $dir = 'content';
    $ext = 'content';
    $account = NULL;

    $path = dirname(__FILE__);

    //$files = file_scan_directory($path . '/' . $dir, "\.content$");
//    die(var_dump($path_theme));

    $files = file_scan_directory($path_theme . '/' . $dir.'/'.$preset, '/\.content/', array('key' => 'name'));

    foreach ($files as $file) {

        if ($file->filename == "slide3.content") {

            $node = array();
            ob_start();

            require $file->uri;

            ob_end_clean();

            $node = (object) $node;

            $node->uid = $account ? $account->uid : 1;

            node_save($node);

            //Get the node just saved to attach images
            $node_id_saved = $node->nid;

            node_object_prepare($node);

            if (is_array($node->field_hp_slide)) {

                $count_index = 0;
                foreach ($node->field_hp_slide as $image) {

                    /**
                     * Add a file.
                     */
                    // Some filepath on our system. It's the Druplicon! :D
                    //$filepath = drupal_realpath('misc/' . $image);
                    $filepath = drupal_realpath($image);

                    // Create managed File object and associate with Image field.
                    $file = (object) array(
                        'uid' => 1,
                        'uri' => $filepath,
                        'filemime' => file_get_mimetype($filepath),
                        'status' => 1,
                    );

                    // We save the file to the root of the files directory.
                    $file = file_copy($file, 'public://');

                    $node->field_hp_slide["und"][$count_index] = (array) $file;
                    $node->field_hp_slide["und"][$count_index]['fid'] = (string) $file->fid;

                    $count_index = $count_index + 1;
                }

                node_save((object) $node);
            }
        }
    }

}

function demo_insert_menus(){

    $theme = BAIUCA_THEME;

    $preset = variable_get("baiuca_preset_selected","blue");

    $dir_root = dirname($_SERVER['SCRIPT_FILENAME']);
    $path_theme = $dir_root . "/sites/all/themes/" . $theme;

    $dir = 'content';
    $ext = 'content';
    $account = NULL;

    $path = dirname(__FILE__);

    //$files = file_scan_directory($path . '/' . $dir, "\.content$");
//    die(var_dump($path_theme));

    $files = file_scan_directory($path_theme . '/' . $dir.'/'.$preset, '/\.content/', array('key' => 'name'));

    foreach ($files as $file) {

        if ($file->filename == "menus.content") {

            $menus = array();
            ob_start();

            require $file->uri;

            ob_end_clean();

            $menus = (object) $menus;

            foreach ($menus as $node_item) {

                $node = (object) $node_item;

                $node->uid = $account ? $account->uid : 1;

                node_save($node);

                //Save project Image
                if (is_array($node->field_image)) {

                    $count_index = 0;
                    foreach ($node->field_image as $image) {

                        /**
                         * Add a file.
                         */
                        // Some filepath on our system. It's the Druplicon! :D
                        //$filepath = drupal_realpath('misc/' . $image);
                        $filepath = drupal_realpath($image);

                        // Create managed File object and associate with Image field.
                        $file = (object) array(
                            'uid' => 1,
                            'uri' => $filepath,
                            'alt' => 'project_image',
                            'filemime' => file_get_mimetype($filepath),
                            'status' => 1,
                        );

                        // We save the file to the root of the files directory.
                        $file = file_copy($file, 'public://');

                        $node->field_image["und"][$count_index] = (array) $file;
                        $node->field_image["und"][$count_index]['fid'] = (string) $file->fid;

                        $count_index = $count_index + 1;
                    }

                    //node_save((object) $node);
                }

                node_save((object) $node);

            }
        }
    }
}

function demo_insert_contact_form(){

    $theme = BAIUCA_THEME;

    $preset = variable_get("baiuca_preset_selected","blue");

    $dir_root = dirname($_SERVER['SCRIPT_FILENAME']);
    $path_theme = $dir_root . "/sites/all/themes/" . $theme;

    $dir = 'content';
    $ext = 'content';
    $account = NULL;

    $path = dirname(__FILE__);

    //$files = file_scan_directory($path . '/' . $dir, "\.content$");
//    die(var_dump($path_theme));

    $files = file_scan_directory($path_theme . '/' . $dir.'/'.$preset, '/\.content/', array('key' => 'name'));

    foreach ($files as $file) {

        if ($file->filename == "contact.content") {

            $node = array();

            ob_start();

            require $file->uri;

            ob_end_clean();

            $node = (object) $node;

            $node->uid = $account ? $account->uid : 1;

            node_save($node);

            //INSERIR FIELDS NO FORMULARIO
        }
    }
}

function demo_insert_pages(){

    $theme = BAIUCA_THEME;

    $preset = variable_get("baiuca_preset_selected","blue");

    $dir_root = dirname($_SERVER['SCRIPT_FILENAME']);
    $path_theme = $dir_root . "/sites/all/themes/" . $theme;

    $dir = 'content';
    $ext = 'content';
    $account = NULL;

    $path = dirname(__FILE__);

    //$files = file_scan_directory($path . '/' . $dir, "\.content$");
//    die(var_dump($path_theme));

    $files = file_scan_directory($path_theme . '/' . $dir.'/'.$preset, '/\.content/', array('key' => 'name'));

    foreach ($files as $file) {

        if ($file->filename == "pages.content") {

            $pages = array();
            ob_start();

            require $file->uri;

            ob_end_clean();

            $pages = (object) $pages;

            foreach ($pages as $node_item) {

                $node = (object) $node_item;

                $node->uid = $account ? $account->uid : 1;

                node_save($node);
            }
        }
    }
}

function demo_insert_drupal_menus(){

    $preset = variable_get("baiuca_preset_selected","blue");

    switch ($preset) {
        case 'red':

            global $base_url;

            // Create a Home link in the main menu.
            $item = array(
                'link_title' => st('Home'),
                'link_path' => '<front>',
                'menu_name' => 'main-menu',
                'weight' => -5,
            );
            menu_link_save($item);

            $item = array(
                'link_title' => st('Menu'),
                'link_path' => 'menu',
                'menu_name' => 'main-menu',
                'weight' => 3,
            );
            $work_lid = menu_link_save($item);

            $item = array(
                'link_title' => st('Menu 2 columns'),
                'link_path' => 'menu-2-cols',
                'menu_name' => 'main-menu',
                'weight' => 0,
                'plid' => $work_lid,
            );
            menu_link_save($item);

            $item = array(
                'link_title' => st('Menu 4 columns'),
                'link_path' => 'menu-4-cols',
                'menu_name' => 'main-menu',
                'weight' => 1,
                'plid' => $work_lid,
            );
            menu_link_save($item);

            $item = array(
                'link_title' => st('Blog'),
                'link_path' => 'blog-masonry',
                'menu_name' => 'main-menu',
                'weight' => 4,
            );
            $blog_lid = menu_link_save($item);

            $item = array(
                'link_title' => st('Blog 1 column'),
                'link_path' => 'blog-1-col',
                'menu_name' => 'main-menu',
                'weight' => 1,
                'plid' => $blog_lid,
            );
            menu_link_save($item);

            $item = array(
                'link_title' => st('Blog 2 columns'),
                'link_path' => 'blog-2-cols',
                'menu_name' => 'main-menu',
                'weight' => 3,
                'plid' => $blog_lid,
            );
            menu_link_save($item);

            $item = array(
                'link_title' => st('Blog 3 columns'),
                'link_path' => 'blog-3-cols',
                'menu_name' => 'main-menu',
                'weight' => 4,
                'plid' => $blog_lid,
            );
            menu_link_save($item);

            $item_contact = array(
                'link_title' => st('Contact'),
                'link_path' => 'contact',
                'menu_name' => 'main-menu',
                'weight' => 5,
            );
            menu_link_save($item_contact);

            // Update the menu router information.
            menu_rebuild();

            break;

        default:
            global $base_url;

            // Create a Home link in the main menu.
            $item = array(
                'link_title' => st('HOME'),
                'link_path' => '<front>',
                'menu_name' => 'main-menu',
                'weight' => 0,
            );
            menu_link_save($item);

            $item = array(
                'link_title' => st('MENU'),
                'link_path' => 'menu',
                'menu_name' => 'main-menu',
                'weight' => 3,
            );
            $work_lid = menu_link_save($item);

            $item = array(
                'link_title' => st('MENU 2 COLUMNS'),
                'link_path' => 'menu-2-cols',
                'menu_name' => 'main-menu',
                'weight' => 0,
                'plid' => $work_lid,
            );
            menu_link_save($item);

            $item = array(
                'link_title' => st('MENU 4 COLUMNS'),
                'link_path' => 'menu-4-cols',
                'menu_name' => 'main-menu',
                'weight' => 1,
                'plid' => $work_lid,
            );
            menu_link_save($item);

            $item = array(
                'link_title' => st('BLOG'),
                'link_path' => 'blog-masonry',
                'menu_name' => 'main-menu',
                'weight' => 4,
            );
            $blog_lid = menu_link_save($item);

            $item = array(
                'link_title' => st('BLOG 1 COLUMN'),
                'link_path' => 'blog-1-col',
                'menu_name' => 'main-menu',
                'weight' => 1,
                'plid' => $blog_lid,
            );
            menu_link_save($item);

            $item = array(
                'link_title' => st('BLOG 2 COLUMNS'),
                'link_path' => 'blog-2-cols',
                'menu_name' => 'main-menu',
                'weight' => 3,
                'plid' => $blog_lid,
            );
            menu_link_save($item);

            $item = array(
                'link_title' => st('BLOG 3 COLUMNS'),
                'link_path' => 'blog-3-cols',
                'menu_name' => 'main-menu',
                'weight' => 4,
                'plid' => $blog_lid,
            );
            menu_link_save($item);

            $item_contact = array(
                'link_title' => st('CONTACT'),
                'link_path' => 'contact',
                'menu_name' => 'main-menu',
                'weight' => 5,
            );
            menu_link_save($item_contact);

            // Update the menu router information.
            menu_rebuild();
    }
}