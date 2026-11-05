<?php if(get_theme_mod('hero_cta_section_disable') != "on") { ?>		
	
	<div class="slider_bar">
		<div class="container">
	<div class="row">		
		
		<div class="col-md-8 col-sm-8 sb-caption">
			<?php if(esc_html(get_theme_mod('hero_cta_sub_title')) != NULL){ echo esc_html(get_theme_mod('hero_cta_sub_title'));} else echo __('Write your welcome headline here. Have fun with the Hero theme.', 'hero');?>
			</div>
			
					<div class="col-md-4 col-sm-4 sb-btn-wrapper">
							<a href="<?php echo esc_url(get_theme_mod('hero_cta_button_link')); ?>"><?php if(esc_html(get_theme_mod('hero_cta_button_text')) != NULL){ echo esc_html(get_theme_mod('hero_cta_button_text'));} else echo __('Download Now!', 'hero'); ?></a>
							<div class="clear"></div>
						</div>
						
			</div>
		</div>
	</div>

 <?php } ?>