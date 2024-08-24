<?php
   if (!defined('ABSPATH')){ exit; }

   global $conult_post;
   if( !$conult_post || $conult_post->post_type != 'product' ||  !$conult_post->post_excerpt ){ return; }
   
   $post_id = $conult_post->ID;
   $this->add_render_attribute('block', 'class', [ 'cf-item-social-share' ]);
?>

<div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
   <?php wpcf_function()->template('include/social-share'); ?>
</div>