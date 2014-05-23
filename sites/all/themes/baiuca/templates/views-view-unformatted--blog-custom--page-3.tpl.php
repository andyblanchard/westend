<?php
/**
 * @file views-view-unformatted.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
$size = 1;
$count = 0;

//$sizes_array = array("2","1","1","3","1","1","2","2");
//$sizes_array = array("2","1","1","3","1","3","2","2");
  $sizes_array = array("2","1","1","2","1","1","3","1");
  $sizes_array = array("3","1","2","2","1","3","3","1","3");

?>
<?php if (!empty($title)): ?>
    <h3><?php print $title; ?></h3>
<?php endif; ?>

<div id="masonry_container">
    <div class="grid-sizer"></div>
    <?php foreach ($rows as $id => $row): ?>

        <?php

            //debug($id);
        if($id <= (sizeof($sizes_array) - 1) ){
            $size = $sizes_array[$id];
        }
        else{
            $size = $sizes_array[$id - sizeof($sizes_array)];
        }

        ?>



        <?php
/*
        if($size == 1 && $count == 0){
            $size = 1;
            $count = $count + 1;
        }
        else if($size == 2 && $count == 0){
            $size = 2;
            $count = $count + 1;
        }
        else if($size == 1 && $count == 1){
            $size = 1;
            $count = $count + 1;
        }
        else if($size == 2 && $count == 1){
            $size = 2;
            $count = $count + 1;
        }
        else if($size == 1 && $count == 2){
            $size = 2;
            $count = 0;
        }
        else if($size == 2 && $count == 2){
            $size = 1;
            $count = 0;
        }*/

        $random = rand(1,2);
        $random_class_size = "w".$random;

        ?>

        <div class="<?php print $classes_array[$id]; ?> <?php print "w".$size; ?>">
            <div class="item_inner">
                <?php print $row; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>