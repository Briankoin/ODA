<?php
   if (!defined('ABSPATH')){ exit; }

   global $conult_post, $post;

   if(!$conult_post){ return; }
   $post = $conult_post;
?>
   
<div class="post-comment">
   <?php
      if(comments_open($conult_post->ID)){
         comments_template();
      }else{
         if(\Elementor\Plugin::$instance->editor->is_edit_mode()){
            echo '<div class="alert alert-info">' . esc_html__('This Post Disabled Comment', 'conult-themer') . '</div>';
         }
      }
   ?>
</div>      

