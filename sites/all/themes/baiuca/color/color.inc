<?php

// Put the logo path into JavaScript for the live preview.
drupal_add_js(array('color' => array('logo' => theme_get_setting('logo', 'baiuca'))), 'setting');

$info = array(
  // Available colors and color labels used in theme.
  'fields' => array(
    'top' => t('Header and footer'),
    'base' => t("Base color"),
    //'footer' => t("footer"),
    'sidebarborders' => t("Sidebar borders"),
    'titleslogan' => t("Light slogans"),
    'text' => t("Text"),
    'link' => t('Links and Theme color'),
  ),
  // Pre-defined color schemes.
  'schemes' => array(
    'default' => array(
      'title' => t('Blue'),
      'colors' => array(
          'top' => '#92886A',
          'base' => '#2E3035',
          //'bg' => '#ffffff',
          //'footer' => '#92886A',
          'sidebarborders' => '#424347',
          'titleslogan' => '#e4dec6',
          'text' => '#92886A',
          'link' => '#92886A',
      ),
    ),
    'red' => array(
      'title' => t('Red'),
      'colors' => array(
          'top' => '#333333',
          //'bottom' => '#48a9e4',
          'base' => '#A2292A',
          //'bg' => '#ffffff',
          //'footer' => '#333333',
          'sidebarborders' => '#A16565',
          'titleslogan' => '#e5e5e5',
          'text' => '#333333',
          'link' => '#333333',
      ),
    ),
    'orange' => array(
          'title' => t('Orange'),
          'colors' => array(
              'top' => '#333333',
              //'bottom' => '#48a9e4',
              'base' => '#222222',
              //'bg' => '#ffffff',
              //'footer' => '#333333',
              'sidebarborders' => '#363434',
              'titleslogan' => '#ffffff',
              'text' => '#333333',
              'link' => '#E78316',
          ),
    ),
    'blue_greek' => array(
          'title' => t('Greek Blue'),
          'colors' => array(
              'top' => '#666666',
              //'bottom' => '#48a9e4',
              'base' => '#6699cc',
              //'bg' => '#ffffff',
              //'footer' => '#333333',
              'sidebarborders' => '#4d739a',
              'titleslogan' => '#ffffff',
              'text' => '#666666',
              'link' => '#666666',
          ),
      )
  ),

  // CSS files (excluding @import) to rewrite with new color scheme.
  'css' => array(
    'css/colors.css',
  ),

  // Files to copy.
  'copy' => array(
    'logo.png',
  ),

  // Gradient definitions.
  'gradients' => array(
    array(
        'dimension' => array(0, 0, 0, 0),
    ),
  ),

  // Color areas to fill (x, y, width, height).
  'fill' => array(),

  // Coordinates of all the theme slices (x, y, width, height)
  // with their filename as used in the stylesheet.
  'slices' => array(),

  // Reference color used for blending. Matches the base.png's colors.
  'blend_target' => '#ffffff',

  // Preview files.
  'preview_css' => 'color/preview.css',
  'preview_js' => 'color/preview.js',
  'preview_html' => 'color/preview.html',

  // Base file for image generation.
  'base_image' => 'color/base.png',
);
