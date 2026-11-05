<?php if(get_theme_mod('hero_about_section_disable') != "on") { ?>			
<!-- About Section -->
<section class="about-section">
			
			<div class="container">
		
		<div class="row box-wrapper">

			<?php for ($i = 1; $i <= 3; $i++) { 
			
					$hero_about_page_id = esc_html(get_theme_mod('hero_about_page'.$i));

		if($hero_about_page_id){
			$args = array( 
                        'page_id' => absint($hero_about_page_id) 
                        );
			$query = new WP_Query($args);
			if( $query->have_posts() ):
				while($query->have_posts()) : $query->the_post();
				?>
		
				<div class="col-md-4 col-sm-4">
				
					<div class="box-head">
	
					<?php 
					if(has_post_thumbnail()){
						$hero_about_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'full');
						echo '<img alt="'. the_title_attribute('echo=0') .'" src="'.esc_url($hero_about_image[0]).'">';
			} else echo '<img alt="'. the_title_attribute('echo=0') .'" src="'.get_template_directory_uri() . '/images/pic'.$i.'.jpg'.'">';
					?>

					
					</div> <!--box-head close-->
					
				<div class="title-box">						
						
				<div class="title-head">
				
				<?php if(the_title_attribute('echo=0') != NULL){ echo the_title_attribute('echo=0');} else echo __('Heading', 'hero'); ?>
						
			</div>		
				</div>
					
					<div class="box-content">

    				<?php 
					if(has_excerpt()){
						the_excerpt();
					}else{
						the_content(); 
					} ?>
					
					</div> <!--box-content close-->
					
		<div class="about-btn-wrapper">
		<?php if(esc_url(get_theme_mod('hero_about_link' . $i)) != NULL){ ?>
							<a href="<?php echo esc_url(get_theme_mod('hero_about_link'.$i)); ?>"><?php echo __('Read More', 'hero'); ?></a><?php }?>	
						</div> 
						
					
					<div class="clear"></div>
			
				</div><!--boxes  end-->
				
				<?php
				endwhile;
			endif;
		}
	} ?>
			
	</div>
		</div>
		
</section>
<!-- /about Section -->

<div class="clearfix"></div>	
<?php }  ?>		
