<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $conult_post;
   if (!$conult_post){
      return;
   }
   $html_tag = $settings['html_tag'];
?>

<div class="conult-post-title">
   <<?php echo esc_attr($html_tag) ?> class="post-title">
      <span><?php echo get_the_title($conult_post) ?></span>
   </<?php echo esc_attr($html_tag) ?>>
</div>   