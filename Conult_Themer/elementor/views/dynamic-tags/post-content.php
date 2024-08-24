<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $conult_post;
   if (!$conult_post){
      return;
   }
   ?>
   
   <div class="post-content">
         <?php 
           echo apply_filters ('the_content', $conult_post->post_content);
         ?>
   </div>      

