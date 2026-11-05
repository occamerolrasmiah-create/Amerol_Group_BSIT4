<?php
/**
 * hero Theme Customizer
 *
 * @package hero
 */

/**
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function hero_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$hero_categories = get_categories(array('hide_empty' => 0));
	foreach ($hero_categories as $hero_category) {
		$hero_cat[$hero_category->term_id] = $hero_category->cat_name;
	}
	
	global $wp_registered_sidebars;

	$hero_widget_list[] = esc_html__( "-- Don't Replace --", "hero" ) ;
	foreach ($wp_registered_sidebars as $wp_registered_sidebar) {
		$hero_widget_list[$wp_registered_sidebar['id']] = $wp_registered_sidebar['name'];
	}	
    
	$hero_pages = get_pages(array('hide_empty' => 0));
	foreach ($hero_pages as $hero_pages_single) {
		$hero_page_choice[$hero_pages_single->ID] = $hero_pages_single->post_title; 
	}

	/*============GENERAL SETTINGS PANEL============*/
	$wp_customize->add_panel(
		'hero_general_settings_panel',
		array(
			'title' => esc_html__( 'General Settings', 'hero' ),
			'priority' => 10
		)
	);

	//STATIC FRONT PAGE
	$wp_customize->add_section( 'static_front_page', array(
	    'title' => esc_html__( 'Static Front Page', 'hero' ),
	    'panel' => 'hero_general_settings_panel',
	    'description' => esc_html__( 'Your theme supports a static front page.', 'hero'),
	) );

	//TITLE AND TAGLINE SETTINGS
	$wp_customize->add_section( 'title_tagline', array(
	     'title' => esc_html__( 'Site Logo/Title/Tagline', 'hero' ),
	     'panel' => 'hero_general_settings_panel',
	) );

	//BACKGROUND IMAGE
	$wp_customize->add_section( 'background_image', array(
	     'title' => esc_html__( 'Background Image', 'hero' ),
	     'panel' => 'hero_general_settings_panel',
	) );

	//COLOR SETTINGS
	$wp_customize->add_section( 'colors', array(
	     'title' => esc_html__( 'Colors' , 'hero'),
	     'panel' => 'hero_general_settings_panel',
	) );

	//Footer SETTINGS
	$wp_customize->add_section( 'footer', array(
	     'title' => esc_html__( 'Footer Settings' , 'hero'),
	     'panel' => 'hero_general_settings_panel',
	) );
	
		$wp_customize->add_setting(
		'hero_footer_title',
		array(
			'sanitize_callback' => 'hero_sanitize_text',
			'default'			=> esc_html__( 'Your Company name', 'hero' )
		)
	);

	$wp_customize->add_control(
		'hero_footer_title',
		array(
			'settings'		=> 'hero_footer_title',
			'section'		=> 'footer',
			'type'			=> 'text',
			'label'			=> esc_html__( 'Footer copyright text', 'hero' )
		)
	);

	//Blog SETTINGS
	$wp_customize->add_section( 'blog', array(
	     'title' => esc_html__( 'Blog Settings' , 'hero'),
	     'panel' => 'hero_general_settings_panel',
	) );
	
		$wp_customize->add_setting(
		'hero_blog_title',
		array(
			'sanitize_callback' => 'hero_sanitize_text',
			'default'			=> esc_html__( 'Blog', 'hero' )
		)
	);

	$wp_customize->add_control(
		'hero_blog_title',
		array(
			'settings'		=> 'hero_blog_title',
			'section'		=> 'blog',
			'type'			=> 'text',
			'label'			=> esc_html__( 'Blog title', 'hero' )
		)
	);

	/*============HOME PANEL============*/
	$wp_customize->add_panel(
		'hero_home_panel',
		array(
			'title' => esc_html__( 'Home Settings', 'hero' ),
			'priority' => 20,
			'description' => esc_html__('Allows you to setup home page section.', 'hero'),
		)
	);

	/*============SLIDER IMAGES SECTION============*/
	$wp_customize->add_section(
		'hero_slider_section',
		array(
			'title' => esc_html__( 'Slider Settings', 'hero' ),
			'panel' => 'hero_home_panel',
			'priority' => ''
		)
	);

	//SLIDERS
	for ( $i=1; $i < 2; $i++ ){

		$wp_customize->add_setting(
			'hero_slider_heading'.$i,
			array(
				'sanitize_callback' => 'hero_sanitize_text'
			)
		);

		$wp_customize->add_control(
			new hero_Customize_Heading(
				$wp_customize,
				'hero_slider_heading'.$i,
				array(
					'settings'		=> 'hero_slider_heading'.$i,
					'section'		=> 'hero_slider_section',
					'label'			=> esc_html__( 'Slider ', 'hero' ).$i,
				)
			)
		);

		$wp_customize->add_setting(
			'hero_slider_page'.$i,
			array(
				'sanitize_callback' => 'absint'
			)
		);

		$wp_customize->add_control(
			'hero_slider_page'.$i,
			array(
				'settings'		=> 'hero_slider_page'.$i,
				'section'		=> 'hero_slider_section',
				'type'			=> 'dropdown-pages',
				'label'			=> esc_html__( 'Select a Page', 'hero' ),	
			)
		);

		$wp_customize->add_setting(
			'hero_slider_link'.$i,
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
			'hero_slider_link'.$i,
			array(
				'settings'		=> 'hero_slider_link'.$i,
				'section'		=> 'hero_slider_section',
				'type'			=> 'url',
				'label'			=> esc_html__( 'Slide Link', 'hero' ),	
			)
		);
		
	}

	$wp_customize->add_setting(
		'hero_slider_info',
		array(
			'sanitize_callback' => 'hero_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new hero_Info_Text( 
			$wp_customize,
			'hero_slider_info',
			array(
				'settings'		=> 'hero_slider_info',
				'section'		=> 'hero_slider_section',
				'label'			=> esc_html__( 'Note:', 'hero' ),	
				'description'	=> wp_kses_post(__( 'The Page featured image works as a slider banner and the title & content work as a slider caption. <br/> Recommended Image Size: 2500X1000', 'hero' )),
			)
		)
	);
	
	//ENABLE/DISABLE SECTION
	$wp_customize->add_setting(
		'hero_caption_section_disable',
		array(
			'sanitize_callback' => 'hero_sanitize_text',
			'default' => 'off'
		)
	);

	$wp_customize->add_control(
		new hero_Switch_Control(
			$wp_customize,
			'hero_caption_section_disable',
			array(
				'settings'		=> 'hero_caption_section_disable',
				'section'		=> 'hero_slider_section',
				'label'			=> esc_html__( 'Disable Caption', 'hero' ),
				'on_off_label' 	=> array(
					'on' => esc_html__( 'Yes', 'hero' ),
					'off' => esc_html__( 'No', 'hero' )
					)	
			)
		)
	);	
	
	//ENABLE/DISABLE SECTION
	$wp_customize->add_setting(
		'hero_imgoverlay_section_disable',
		array(
			'sanitize_callback' => 'hero_sanitize_text',
			'default' => 'off'
		)
	);

	$wp_customize->add_control(
		new hero_Switch_Control(
			$wp_customize,
			'hero_imgoverlay_section_disable',
			array(
				'settings'		=> 'hero_imgoverlay_section_disable',
				'section'		=> 'hero_slider_section',
				'label'			=> esc_html__( 'Disable Image Overlay', 'hero' ),
				'on_off_label' 	=> array(
					'on' => esc_html__( 'Yes', 'hero' ),
					'off' => esc_html__( 'No', 'hero' )
					)	
			)
		)
	);

	/*============ABOUT SECTION PANEL============*/
	$wp_customize->add_section(
		'hero_about_section',
		array(
			'title' 			=> esc_html__( 'About Settings', 'hero' ),
			'panel'				=> 'hero_home_panel',
			'priority' => ''
		)
	);

	//ENABLE/DISABLE about SECTION
	$wp_customize->add_setting(
		'hero_about_section_disable',
		array(
			'sanitize_callback' => 'hero_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new hero_Switch_Control(
			$wp_customize,
			'hero_about_section_disable',
			array(
				'settings'		=> 'hero_about_section_disable',
				'section'		=> 'hero_about_section',
				'label'			=> esc_html__( 'Disable Section', 'hero' ),
				'on_off_label' 	=> array(
					'on' => esc_html__( 'Yes', 'hero' ),
					'off' => esc_html__( 'No', 'hero' )
					),
			)
		)
	);

	//PAGES
	for( $i = 1; $i < 4; $i++ ){
		$wp_customize->add_setting(
			'hero_about_header'.$i,
			array(
				'sanitize_callback' => 'hero_sanitize_text'
			)
		);

		$wp_customize->add_control(
			new hero_Customize_Heading(
				$wp_customize,
				'hero_about_header'.$i,
				array(
					'settings'		=> 'hero_about_header'.$i,
					'section'		=> 'hero_about_section',
					'label'			=> esc_html__( 'About Page ', 'hero' ).$i
				)
			)
		);

		$wp_customize->add_setting(
			'hero_about_page'.$i,
			array(
				'sanitize_callback' => 'absint'
			)
		);

		$wp_customize->add_control(
			'hero_about_page'.$i,
			array(
				'settings'		=> 'hero_about_page'.$i,
				'section'		=> 'hero_about_section',
				'type'			=> 'dropdown-pages',
				'label'			=> esc_html__( 'Select a Page', 'hero' )
			)
		);
		
		$wp_customize->add_setting(
			'hero_about_link'.$i,
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
			'hero_about_link'.$i,
			array(
				'settings'		=> 'hero_about_link'.$i,
				'section'		=> 'hero_about_section',
				'type'			=> 'url',
				'label'			=> esc_html__( 'About Link', 'hero' ),	
			)
		);		
	}

	/*============CALL TO ACTION PANEL============*/
	$wp_customize->add_section(
		'hero_cta_section',
		array(
			'title' 			=> esc_html__( 'Call To Action Settings', 'hero' ),
			'panel'				=> 'hero_home_panel',
			'priority' => ''
		)
	);

	//ENABLE/DISABLE SECTION
	$wp_customize->add_setting(
		'hero_cta_section_disable',
		array(
			'sanitize_callback' => 'hero_sanitize_text',
			'default' => 'off'
		)
	);

	$wp_customize->add_control(
		new hero_Switch_Control(
			$wp_customize,
			'hero_cta_section_disable',
			array(
				'settings'		=> 'hero_cta_section_disable',
				'section'		=> 'hero_cta_section',
				'label'			=> esc_html__( 'Disable Section', 'hero' ),
				'on_off_label' 	=> array(
					'on' => esc_html__( 'Yes', 'hero' ),
					'off' => esc_html__( 'No', 'hero' )
					)	
			)
		)
	);

	$wp_customize->add_setting(
		'hero_cta_sub_title',
		array(
			'sanitize_callback' => 'hero_sanitize_text',
			'default'			=> esc_html__( 'Write your welcome headline here. Have fun with the Hero theme.', 'hero' )
		)
	);

	$wp_customize->add_control(
		'hero_cta_sub_title',
		array(
			'settings'		=> 'hero_cta_sub_title',
			'section'		=> 'hero_cta_section',
			'type'			=> 'textarea',
			'label'			=> esc_html__( 'Cta text ', 'hero' )
		)
	);

	$wp_customize->add_setting(
		'hero_cta_button_text',
		array(
			'sanitize_callback' => 'hero_sanitize_text'
		)
	);

	$wp_customize->add_control(
		'hero_cta_button_text',
		array(
			'settings'		=> 'hero_cta_button_text',
			'section'		=> 'hero_cta_section',
			'type'			=> 'text',
			'label'			=> esc_html__( 'Button Text', 'hero' )
		)
	);

	$wp_customize->add_setting(
		'hero_cta_button_link',
		array(
			'default'			=> '',
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control(
		'hero_cta_button_link',
		array(
			'settings'		=> 'hero_cta_button_link',
			'section'		=> 'hero_cta_section',
			'type'			=> 'url',
			'label'			=> esc_html__( 'Button Link', 'hero' )
		)
	);
	
}
add_action( 'customize_register', 'hero_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function hero_customize_preview_js() {
	wp_enqueue_script( 'hero-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'hero_customize_preview_js' );

function hero_customizer_script() {
	wp_enqueue_script( 'hero-customizer-script', get_template_directory_uri() .'/admin/js/customizer-scripts.js', array("jquery"),'', true  );
	wp_enqueue_style( 'hero-customizer-style', get_template_directory_uri() .'/inc/css/customizer-style.css');	
}
add_action( 'customize_controls_enqueue_scripts', 'hero_customizer_script' );

if( class_exists( 'WP_Customize_Control' ) ):	

class hero_Dropdown_Chooser extends WP_Customize_Control{
	public $type = 'dropdown_chooser';

	public function render_content(){
		if ( empty( $this->choices ) )
                return;
		?>
            <label>
                <span class="customize-control-title">
                	<?php echo esc_html( $this->label ); ?>
                </span>

                <?php if($this->description){ ?>
	            <span class="description customize-control-description">
	            	<?php echo wp_kses_post($this->description); ?>
	            </span>
	            <?php } ?>

                <select class="hs-chosen-select" <?php $this->link(); ?>>
                    <?php
                    foreach ( $this->choices as $value => $label )
                        echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . esc_html( $label ) . '</option>';
                    ?>
                </select>
            </label>
		<?php
	}
}

class hero_Customize_Checkbox_Multiple extends WP_Customize_Control {
    public $type = 'checkbox-multiple';

    public function render_content() {

        if ( empty( $this->choices ) )
            return; ?>

        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

        <?php if ( !empty( $this->description ) ) : ?>
            <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
        <?php endif; ?>

        <?php $multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>

        <ul>
            <?php foreach ( $this->choices as $value => $label ) : ?>

                <li>
                    <label>
                        <input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> /> 
                        <?php echo esc_html( $label ); ?>
                    </label>
                </li>

            <?php endforeach; ?>
        </ul>

        <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
    <?php }
}

class hero_Customize_Heading extends WP_Customize_Control {
	public $type = 'heading';

    public function render_content() {
    	if ( !empty( $this->label ) ) : ?>
            <h3 class="hero-accordion-section-title"><?php echo esc_html( $this->label ); ?></h3>
        <?php endif;

        if($this->description){ ?>
			<span class="description customize-control-description">
			<?php echo wp_kses_post($this->description); ?>
			</span>
		<?php }
    }
}

class hero_Dropdown_Multiple_Chooser extends WP_Customize_Control{
	public $type = 'dropdown_multiple_chooser';
	public $placeholder = '';

	public function __construct($manager, $id, $args = array()){
        $this->placeholder = $args['placeholder'];

        parent::__construct( $manager, $id, $args );
    }

	public function render_content(){
		if ( empty( $this->choices ) )
                return;

            $saved_value = $this->value();
            if(!is_array($saved_value)){
            	$saved_value = array();
            }
		?>
            <label>
                <span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>

				<?php if($this->description){ ?>
					<span class="description customize-control-description">
					<?php echo wp_kses_post($this->description); ?>
					</span>
				<?php } ?>

                <select data-placeholder="<?php echo esc_html( $this->placeholder ); ?>" multiple="multiple" class="hs-chosen-select" <?php $this->link(); ?>>
                    <?php
                    foreach ( $this->choices as $value => $label ){
                    	$selected = '';
                    	if(in_array($value, $saved_value)){
                    		$selected = 'selected="selected"';
                    	}
                        echo '<option value="' . esc_attr( $value ) . '"' . esc_attr($selected) . '>' . esc_html($label) . '</option>';
                    }
                    ?>
                </select>
            </label>
		<?php
	}
}

class hero_Category_Dropdown extends WP_Customize_Control{
    private $cats = false;

    public function __construct($manager, $id, $args = array(), $options = array()){
        $this->cats = get_categories($options);

        parent::__construct( $manager, $id, $args );
    }

    public function render_content(){
        if(!empty($this->cats)){
            ?>
            <label>
                <span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>

				<?php if($this->description){ ?>
					<span class="description customize-control-description">
					<?php echo wp_kses_post($this->description); ?>
					</span>
				<?php } ?>

                <select <?php $this->link(); ?>>
                   <?php
                    foreach ( $this->cats as $cat )
                    {
                        printf('<option value="%s" %s>%s</option>', esc_attr($cat->term_id), selected($this->value(), $cat->term_id, false), esc_html($cat->name));
                    }
                   ?>
                </select>
            </label>
        <?php
        }
    }
}

class hero_Switch_Control extends WP_Customize_Control{
	public $type = 'switch';
	public $on_off_label = array();

	public function __construct($manager, $id, $args = array() ){
        $this->on_off_label = $args['on_off_label'];
        parent::__construct( $manager, $id, $args );
    }

	public function render_content(){
    ?>
	    <span class="customize-control-title">
			<?php echo esc_html( $this->label ); ?>
		</span>

		<?php if($this->description){ ?>
			<span class="description customize-control-description">
			<?php echo wp_kses_post($this->description); ?>
			</span>
		<?php } ?>

		<?php
			$switch_class = ($this->value() == 'on') ? 'switch-on' : '';
			$on_off_label = $this->on_off_label;
		?>
		<div class="onoffswitch <?php echo esc_attr($switch_class); ?>">
			<div class="onoffswitch-inner">
				<div class="onoffswitch-active">
					<div class="onoffswitch-switch"><?php echo esc_html($on_off_label['on']) ?></div>
				</div>

				<div class="onoffswitch-inactive">
					<div class="onoffswitch-switch"><?php echo esc_html($on_off_label['off']) ?></div>
				</div>
			</div>	
		</div>
		<input <?php $this->link(); ?> type="hidden" value="<?php echo esc_attr($this->value()); ?>"/>
		<?php
    }
}

class hero_Info_Text extends WP_Customize_Control{

    public function render_content(){
    ?>
	    <span class="customize-control-title">
			<?php echo esc_html( $this->label ); ?>
		</span>

		<?php if($this->description){ ?>
			<span class="description customize-control-description">
			<?php echo wp_kses_post($this->description); ?>
			</span>
		<?php }
    }
}
endif;

//SANITIZATION FUNCTIONS
function hero_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function hero_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

function hero_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}

function hero_sanitize_choices( $input, $setting ) {
    global $wp_customize;
 
    $control = $wp_customize->get_control( $setting->id );
 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function hero_sanitize_choices_array( $input, $setting ) {
    global $wp_customize;
 	
 	if(!empty($input)){
    	$input = array_map('absint', $input);
    }

    return $input;
} 