<?php 
	use Elementor\Icons_Manager;
	$has_icon = ! empty( $item['selected_icon']['value']); 
?>

<?php if($settings['style'] == 'style-1'): ?>
   <div class="service-item style-1">
      
      <div class="service-item-content">
			<?php if ( $has_icon ){ ?>
				<span class="box-icon">
					<?php Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
				</span>
			<?php } ?>

			<?php if($item['title']){ ?>
				<h3 class="title"><span><?php echo $item['title'] ?></span></h3>
			<?php } ?>

			<?php if($item['desc']){ ?>
				<div class="desc"><?php echo $item['desc'] ?></div>
			<?php } ?>

			<div class="arrow"><span class="icon"><i class="fas fa-arrow-right"></i></span></div>
		</div>

		<div class="number">0<?php echo esc_html($index) ?></div>

		<?php if($item['image']['url']){ ?>
			<div class="service-background">
				<img <?php echo $this->conult_get_image_size($item['image']['url']) ?> src="<?php echo esc_url($item['image']['url']) ?>" alt="<?php echo esc_html($item['title']) ?>"/>
			</div>
		<?php } ?>		

		<?php echo $this->gva_render_link_overlay($item['link']) ?>
	</div>
<?php endif; ?>	

<?php if($settings['style'] == 'style-2'): ?>
   <div class="service-item style-2">
      
      <?php if($item['image']['url']){ ?>
	      <div class="service-image text-center">
	      	<img <?php echo $this->conult_get_image_size($item['image']['url']) ?> src="<?php echo esc_url($item['image']['url']) ?>" alt="<?php echo esc_html($item['title']) ?>"/>
	      </div>
	   <?php } ?>

      <div class="service-content">
			<div class="content-inner">
				<?php if($item['title']){ ?>
					<h3 class="title"><span><?php echo $item['title'] ?></span></h3>
				<?php } ?>

				<?php if ( $has_icon ){ ?>
					<span class="box-icon">
						<?php Icons_Manager::render_icon($item['selected_icon'], [ 'aria-hidden' => 'true' ]); ?>
					</span>
				<?php } ?>
			</div>	
		</div>

		
		<div class="service-content-hover">
			<div class="content-inner">
				<?php if ( $has_icon ){ ?>
					<span class="box-icon">
						<?php Icons_Manager::render_icon($item['selected_icon'], [ 'aria-hidden' => 'true' ]); ?>
					</span>
				<?php } ?>

				<?php if($item['title']){ ?>
					<h3 class="title"><span><?php echo $item['title'] ?></span></h3>
				<?php } ?>
				<?php if($item['desc']){ ?>
					<div class="desc"><?php echo $item['desc'] ?></div>
				<?php } ?>
			</div>	
			<div class="service-background">
				<?php if($item['image']['url']){ ?>
					<img src="<?php echo esc_url($item['image']['url']) ?>" alt="<?php echo esc_html($item['title']) ?>"/>
				<?php } ?>	
			</div>
			<?php echo $this->gva_render_link_overlay($item['link']) ?>
		</div>	
	</div>
<?php endif; ?>	


<?php if($settings['style'] == 'style-3'): ?>
   <div class="service-item style-3">
      <div class="service-item-content">
      	
      	<?php if($item['image']['url']){ ?>
		      <div class="service-image">
		      	<img <?php echo $this->conult_get_image_size($item['image']['url']) ?> src="<?php echo esc_url($item['image']['url']) ?>" alt="<?php echo esc_html($item['title']) ?>" />
		      	<?php if($has_icon){ ?>
						<span class="box-icon">
							<?php Icons_Manager::render_icon($item['selected_icon'], [ 'aria-hidden' => 'true' ]); ?>
						</span>
					<?php } ?>
					<?php echo $this->gva_render_link_overlay($item['link']) ?> 
		      </div>
		   <?php } ?>

		   <div class="service-content">
				<?php if($item['title']){ ?>
					<h3 class="title">
						<?php $this->gva_render_link_html($item['title'], $item['link']) ?>
					</h3>
				<?php } ?>

				<?php if($item['desc']){ ?>
					<div class="desc"><?php echo $item['desc'] ?></div>
				<?php } ?>

				<div class="read-more">
               <?php $this->gva_render_link_html(esc_html__('Read more', 'conult'), $item['link'], 'btn-inline btn-read-more'); ?>
               <?php $this->gva_render_link_html('<i class="las la-arrow-right"></i>', $item['link'], 'arrow-read-more'); ?>
            </div>
			</div>

		</div>
	</div>
<?php endif; ?>

<?php if($settings['style'] == 'style-4'): ?>
   <div class="service-item style-4">
      <div class="service-item-content">
		   <div class="service-content">
		   	<?php if($has_icon){ ?>
					<span class="box-icon">
						<?php Icons_Manager::render_icon($item['selected_icon'], [ 'aria-hidden' => 'true' ]); ?>
					</span>
				<?php } ?>

				<?php if($item['title']){ ?>
					<h3 class="title"><span><?php echo $item['title'] ?></span></h3>
				<?php } ?>

				<?php if($item['desc']){ ?>
					<div class="desc"><?php echo $item['desc'] ?></div>
				<?php } ?>

				<?php echo $this->gva_render_link_overlay($item['link']) ?> 
			</div>

		</div>
	</div>
<?php endif; ?>