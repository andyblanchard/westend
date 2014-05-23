<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see bootstrap_preprocess_page()
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see bootstrap_process_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>


<?php

$header_type = "full";

$layout_type = "full_width";


//Get the background image
$bg_image = theme_get_setting('background_file');

if(isset($bg_image)){
    $file_bg_image = file_load($bg_image);

    if(isset($file_bg_image->uri)){
        $bg_image_url = file_create_url($file_bg_image->uri);
    }
}
?>
<?php if (isset($bg_image_url)): ?>
    <style>
        body{
            background: url("<?php print $bg_image_url; ?>") 0px fixed;
            background-repeat: no-repeat !important;
            background-size: cover !important;
        }
    </style>
<?php endif; ?>
<div class="blank_overall">

</div>

<div class="navmenu navmenu-default navmenu-fixed-left offcanvas-sm">

    <div>
        <br/>
        <div class="logo">
            <?php if ($logo): ?>
                <a class="logo navbar-btn" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
                    <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
                </a>
            <?php endif; ?>
        </div>
        <h4>
            <?php print variable_get("site_name","The Bakery");?>
        </h4>

        <br/>

        <?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation'])): ?>
            <div class="navbar-collapse">
                <nav role="navigation">
                    <?php if (!empty($primary_nav)): ?>
                        <?php
                        print render($primary_nav);
                        ?>
                    <?php endif; ?>
                    <?php if (!empty($secondary_nav)): ?>
<?php
//              print render($secondary_nav);
                        ?>
                    <?php endif; ?>
                    <?php if (!empty($page['navigation'])): ?>
<?php
//                print render($page['navigation']);
                        ?>
                    <?php endif; ?>
                </nav>
            </div>
        <?php endif; ?>

        <br/>

        <div class="container">
            <footer class="footer">
                <!--<div class="top_button">
                    <a class="back_to_top">
                        <i class="fa fa-2x fa-angle-double-up">

                        </i>
                    </a>
                </div>-->


                <div class="container">
                    <?php print render($page['footer']); ?>
                </div>
            </footer>
        </div>


    </div>

</div>
<div class="navbar navbar-default navbar-fixed-top hidden-md hidden-lg">
    <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navmenu">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#"></a>
</div>

<div id="wrapper_overall" class="<?php print $layout_type; ?>">

    <div class="loader">


    </div>
    <div class="loading_text">

        <i class="fa fa-cog fa-4x">

        </i>
        <h3>
            Loading page...
        </h3>
    </div>
    <div class="la-anim-1"></div>

    <?php if (!empty($page['hero'])): ?>
        <section class="header_<?php print $header_type; ?>" id="hero">

            <?php print render($page['hero']); ?>

            <div class="arrow_slide_down">
                <a href="#">
                    <i class="fa fa-angle-down fa-2x"></i>
                </a>
            </div>

        </section>
    <?php endif; ?>



    <div id="main_container" class="main-container">

        <div class="contact_map_full">
            <button type="button" class="btn btn-default contact_vieform_button_full">
                <span class="glyphicon glyphicon-envelope"></span> View map
            </button>

            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d170129.24812898802!2d16.38005995!3d48.2206849!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sat!4v1394991753308" width="100%" height="100%" frameborder="0" style="border:0"></iframe>
        </div>


        <div class="white-container">

            <button type="button" class="btn btn-default contact_viewmap_button_full">
                <span class="glyphicon glyphicon-map-marker"></span> View map
            </button>

            <div class="container">

                <header role="banner" id="page-header">
                    <?php if (!empty($site_slogan)): ?>
                        <p class="lead"><?php print $site_slogan; ?></p>
                    <?php endif; ?>

                    <?php print render($page['header']); ?>
                </header> <!-- /#page-header -->

                <div class="row container">

                    <?php if (!empty($page['sidebar_first'])): ?>
                        <aside class="col-sm-3" role="complementary">
                            <?php print render($page['sidebar_first']); ?>
                        </aside>  <!-- /#sidebar-first -->
                    <?php endif; ?>

                    <section<?php print $content_column_class; ?>>
                        <?php if (!empty($page['highlighted'])): ?>
                            <div class="highlighted jumbotron"><?php print render($page['highlighted']); ?></div>
                        <?php endif; ?>
                        <?php if (!empty($breadcrumb)): print $breadcrumb; endif;?>
                        <a id="main-content"></a>
                        <?php print render($title_prefix); ?>
                        <?php if (!empty($title)): ?>
                            <h1 class="page-header"><i class="fa fa-1x fa-envelope theme_color">
                                    <!-- icon --></i><p>
                                </p><span><?php print $title; ?></span></h1>
                        <?php endif; ?>
                        <?php print render($title_suffix); ?>
                        <?php print $messages; ?>
                        <?php if (!empty($tabs)): ?>
                            <?php print render($tabs); ?>
                        <?php endif; ?>
                        <?php if (!empty($page['help'])): ?>
                            <?php print render($page['help']); ?>
                        <?php endif; ?>
                        <?php if (!empty($action_links)): ?>
                            <ul class="action-links"><?php print render($action_links); ?></ul>
                        <?php endif; ?>
                        <?php print render($page['content']); ?>
                    </section>

                    <?php if (!empty($page['sidebar_second'])): ?>
                        <aside class="col-sm-3" role="complementary">
                            <?php print render($page['sidebar_second']); ?>
                        </aside>  <!-- /#sidebar-second -->
                    <?php endif; ?>

                </div>

            </div>

        </div>
    </div>

    <?php if (!empty($page['third_content'])): ?>
        <div id="third_content" class="third_content">
            <div class="container">
                <?php print render($page['third_content']); ?>
            </div>
        </div>
    <?php endif; ?>



</div>


<div class="page_overlay">

</div>
