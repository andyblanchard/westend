<?php

/**
 * @file
 * template.php
 */

function baiuca_js_alter(&$javascript) {
    //We define the path of our new jquery core file
    //assuming we are using the minified version 1.8.3
    $jquery_path = drupal_get_path('theme','baiuca') . '/js/jquery.min.js';

    //We duplicate the important information from the Drupal one
    $javascript[$jquery_path] = $javascript['misc/jquery.js'];
    //..and we update the information that we care about
    $javascript[$jquery_path]['version'] = '1.7.1';
    $javascript[$jquery_path]['data'] = $jquery_path;

    //Then we remove the Drupal core version
    unset($javascript['misc/jquery.js']);
}

function baiuca_preprocess_page(&$vars, $hook) {
    if (isset($vars['page']['content']['system_main']['default_message'])) {
        unset($vars['page']['content']['system_main']['default_message']);
        drupal_set_title('');
    }
}

function baiuca_process_html(&$vars) {
    // Hook into color.module.
    if (module_exists('color')) {
        _color_html_alter($vars);
    }
}
function baiuca_process_page(&$vars) {
    // Hook into color.module.
    if (module_exists('color')) {
        _color_page_alter($vars);
    }
}

/**
 * Implements hook_form_FORM_ID_alter() for system_theme_settings().
 *
 * Workaround for bug https://drupal.org/node/1862892.
 */
function baiuca_form_system_theme_settings_alter($form, &$form_state) {

    if ($form['var']['#value'] != 'theme_settings') {

        $key = preg_replace(array('/^theme_/', '/_settings$/'), '', $form['var']['#value']);
        $themes = list_themes();
        if (isset($themes[$key]->base_themes)) {
            $theme_keys = array_keys($themes[$key]->base_themes);
            $theme_keys[] = $key;
        }
        else {
            $theme_keys = array($key);
        }
        foreach ($theme_keys as $theme) {
            $theme_path = drupal_get_path('theme', $theme);
            if (file_exists($theme_path . '/theme-settings.php')) {
                $form_state['build_info']['files'][] = $theme_path . '/theme-settings.php';
            }
        }
    }
}