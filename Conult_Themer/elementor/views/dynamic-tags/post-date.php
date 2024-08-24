<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $conult_post;
   if (!$conult_post){
      return;
   }
   ?>
   
   <div class="post-date">
         <?php 
            if($settings['show_icon']){ 
               echo '<i class="far fa-calendar"></i>';
            }
            echo get_the_date( get_option('date_format'), $conult_post->ID);
         ?>
   </div>      

