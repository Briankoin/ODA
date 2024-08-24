<?php
	if (!defined('ABSPATH')) {
		exit; 
	}
	global $conult_post;
	if (!$conult_post){
		return;
	}
	?>
	
	<div class="post-category">
		<?php 
			if($settings['show_icon']){ 
				echo '<i class="far fa-folder-open"></i>';
			}
			echo get_the_category_list( ", ", '', $conult_post->ID ) . '</span>';
		?>
	</div>      

