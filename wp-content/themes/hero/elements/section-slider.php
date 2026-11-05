
<div class="container">
<div class="row no-gutters">

<div class="col-md-12 col-sm-12">
	
		<div class="flex-container">

	<!--slideshow-->
	
	<div class="flexslider">
	 	<ul class="slides">

<?php for ($i = 1; $i <= 2; $i++) { 
		$hero_slider_page_id = esc_html(get_theme_mod('hero_slider_page'.$i));

		if($hero_slider_page_id){
			$args = array( 
                        'page_id' => absint($hero_slider_page_id) 
                        );
			$query = new WP_Query($args);
			if( $query->have_posts() ):
				while($query->have_posts()) : $query->the_post();
				?>
			<li>
			<div>
				<div class="slider-image">
		  <?php if(get_theme_mod('hero_imgoverlay_section_disable') != "on") { ?>
			<div class="overlay" style="background-color:rgba(0,0,0,0.30)"></div>
			<?php } ?>
					<?php 
					if(has_post_thumbnail()){
						$hero_slider_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'full');
						echo '<img alt="'. the_title_attribute('echo=0') .'" src="'.esc_url($hero_slider_image[0]).'">';
			} else echo '<img alt="'. the_title_attribute('echo=0') .'" src="'.get_template_directory_uri() . '/images/slide'.$i.'.jpg'.'">';
					?>
		
								</div>
				</div>				
			  
		  <div class="flexslider-content">
		  
		  <?php if(get_theme_mod('hero_caption_section_disable') != "on") { ?>
		  
		    <div class="flexslider-caption">
			  
			 
			
			
			<div class="flex-caption">
		<?php if(the_title_attribute('echo=0') != NULL){ echo the_title_attribute('echo=0');} else echo __('Consulting theme.', 'hero'); ?>
			</div>
			
			
		<div class="flex-caption2">
    				<?php 
					if(has_excerpt()){
						the_excerpt();
					}else{
						the_content(); 
					} ?>
		</div>
		
	</div>	<!--flexslider-caption-->
	
	
	
		<div class="flex-btn-wrapper">
		<?php if(esc_url(get_theme_mod('hero_slider_link' . $i)) != NULL){ ?>
							<a href="<?php echo esc_url(get_theme_mod('hero_slider_link'.$i)); ?>"><?php echo __('Read More', 'hero'); ?></a><?php }?>	
						</div> 
			
			 <?php } ?>
			 
			 </div>
			 
			</li>
			

				<?php
				endwhile;
			endif;
		}
	} ?>
		
		</ul>
</div> <!--slideshow end-->

  </div><!--flex container end--></div>
 
</div><!--row end--></div>