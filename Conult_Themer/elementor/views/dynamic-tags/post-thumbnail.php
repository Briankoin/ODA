<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $conult_post;
   if (!$conult_post){
      return;
   }
?>

<?php 
   $thumbnail_size = $settings['conult_image_size'];

   if(has_post_thumbnail($conult_post)){
      echo get_the_post_thumbnail($conult_post, $thumbnail_size);
   }
?>

