<?php
function begin_kirki_config() {
	return 'begin_kirki_config';
}

function begin_defaults( $key = '' ) {
	$defaults = array();

	# site identify
	$defaults['use-custom-logo'] = '1';
	$defaults['custom-logo'] = BEGIN_THEME_URI.'/images/logo.png';
	$defaults['custom-dark-logo'] = BEGIN_THEME_URI.'/images/light-logo.png';
	$defaults['site_icon'] = BEGIN_THEME_URI.'/images/favicon.ico';

	# site layout
	$defaults['site-layout'] = 'wide';

	# site skin
	$defaults['use-predefined-skin'] = '0';
	$defaults['predefined-skin'] = 'blue';
	$defaults['primary-color'] = '#00b7f1';
	$defaults['secondary-color'] = '#50d3fb';
	$defaults['tertiary-color'] = '#0293be';

	# site breadcrumb
	$defaults['customize-breadcrumb-title-typo'] = '1';
	$defaults['breadcrumb-title-typo'] = array( 'font-family' => 'Rubik',
		'variant' => 'regular',
		'subsets' => array( 'latin-ext' ),
		'font-size' => '30px',
		'line-height' => '',
		'letter-spacing' => '0.02em',
		'color' => '#252525',
		'text-align' => 'unset',
		'text-transform' => 'none' );
	$defaults['customize-breadcrumb-typo'] = '0';
	$defaults['breadcrumb-typo'] = array( 'font-family' => 'Lato',
		'variant' => 'regular',
		'subsets' => array( 'latin-ext' ),
		'font-size' => '13px',
		'line-height' => '',
		'letter-spacing' => '0',
		'color' => '#252525',
		'text-align' => 'unset',
		'text-transform' => 'none' );

	# site header
	$defaults['header-type'] = 'fullwidth-header';
	$defaults['enable-sticy-nav'] = '1';
	$defaults['header-position'] = 'above slider';
	$defaults['header-transparency'] = 'default';
	$defaults['enable-header-darkbg'] = '0';
	$defaults['menu-search-icon'] = '1';
	$defaults['search-box-type'] = 'type2';
	$defaults['menu-cart-icon'] = '0';
	$defaults['enable-top-bar-content'] = '0';
	$defaults['top-bar-content'] = '[vc_row]
[vc_column width="1/2" el_class="alignleft"][dt_sc_contact_info 

icon="fa fa-map-marker" type="type1"]123, New Melbourne, 23082015

[/dt_sc_contact_info][/vc_column]
[vc_column width="1/2" el_class="alignright"][dt_sc_contact_info 

type="type1"]Call Us Toll Free <strong>0123 456 789</strong>
[/dt_sc_contact_info][/vc_column]
[/vc_row]';

	# site menu
	$defaults['menu-active-style'] =  'menu-active-border-with-arrow';
	$defaults['menu-hover-style'] =  '';

	# site footer
	$defaults['show-footer'] = '1';
	$defaults['footer-columns'] = '4';
	$defaults['customize-footer-title-typo'] = '1';
	$defaults['footer-title-typo'] = array( 'font-family' => 'Rubik',
		'variant' => '700',
		'subsets' => array( 'latin-ext' ),
		'font-size' => '20px',
		'line-height' => '36px',
		'letter-spacing' => '0',
		'color' => '#252525',
		'text-align' => 'left',
		'text-transform' => 'none' );
	$defaults['customize-footer-content-typo'] = '1';
	$defaults['footer-content-typo'] = array( 'font-family' => 'Lato',
		'variant' => 'regular',
		'subsets' => array( 'latin-ext' ),
		'font-size' => '15px',
		'line-height' => '26px',
		'letter-spacing' => '0',
		'color' => '#252525',
		'text-align' => 'left',
		'text-transform' => 'none' );	

	# site copyright
	$defaults['show-copyright-text'] = '1';
	$defaults['copyright-text'] = 'Copyright &copy; 2017. All rights reserved by, <a title="" href="http://themeforest.net/user/designthemes">DesignThemes</a>';
	$defaults['enable-copyright-darkbg'] = '0';
	$defaults['copyright-next'] = 'sociable';
	$defaults['footer-sociables'] = array( 'facebook', 'twitter', 'google-plus', 'instagram', 'digg' );
	$defaults['customize-footer-copyright-bg'] = '0';
	$defaults['customize-footer-copyright-text-typo'] = '0';
	$defaults['customize-footer-menu-typo'] = '0';

	# site social
	$defaults['facebook'] = '#';
	$defaults['twitter'] = '#';
	$defaults['google-plus'] = '#';
	$defaults['instagram'] = '#';

	# site typography
	$defaults['customize-body-h1-typo'] = '1';
	$defaults['h1'] = array(
		'font-family' => 'Rubik',
		'variant' => '700',
		'font-size' => '34px',
		'line-height' => '',
		'letter-spacing' => '0.02em',
		'color' => '#252525',
		'text-align' => 'unset',
		'text-transform' => 'none'
	);
	$defaults['customize-body-h2-typo'] = '1';
	$defaults['h2'] = array(
		'font-family' => 'Rubik',
		'variant' => '700',
		'font-size' => '30px',
		'line-height' => '',
		'letter-spacing' => '0.02em',
		'color' => '#252525',
		'text-align' => 'unset',
		'text-transform' => 'none'
	);
	$defaults['customize-body-h3-typo'] = '1';
	$defaults['h3'] = array(
		'font-family' => 'Rubik',
		'variant' => '700',
		'font-size' => '28px',
		'line-height' => '',
		'letter-spacing' => '0.02em',
		'color' => '#252525',
		'text-align' => 'unset',
		'text-transform' => 'none'
	);
	$defaults['customize-body-h4-typo'] = '1';
	$defaults['h4'] = array(
		'font-family' => 'Rubik',
		'variant' => '700',
		'font-size' => '24px',
		'line-height' => '',
		'letter-spacing' => '0.02em',
		'color' => '#252525',
		'text-align' => 'unset',
		'text-transform' => 'none'
	);
	$defaults['customize-body-h5-typo'] = '1';
	$defaults['h5'] = array(
		'font-family' => 'Rubik',
		'variant' => '700',
		'font-size' => '22px',
		'line-height' => '',
		'letter-spacing' => '0.02em',
		'color' => '#252525',
		'text-align' => 'unset',
		'text-transform' => 'none'
	);
	$defaults['customize-body-h6-typo'] = '1';
	$defaults['h6'] = array(
		'font-family' => 'Rubik',
		'variant' => '700',
		'font-size' => '20px',
		'line-height' => '',
		'letter-spacing' => '0.02em',
		'color' => '#252525',
		'text-align' => 'unset',
		'text-transform' => 'none'
	);
	$defaults['customize-menu-typo'] = '1';
	$defaults['menu-typo'] = array(
		'font-family' => 'Rubik',
		'variant' => '500',
		'font-size' => '18px',
		'line-height' => '',
		'letter-spacing' => '0.02em',
		'color' => '#252525',
		'text-align' => 'unset',
		'text-transform' => 'none'
	);
	$defaults['customize-body-content-typo'] = '1';
	$defaults['body-content-typo'] = array(
		'font-family' => 'Lato',
		'variant' => 'normal',
		'font-size' => '17px',
		'line-height' => '28px',
		'letter-spacing' => '',
		'color' => '#666666',
		'text-align' => 'unset',
		'text-transform' => 'none'
	);

	if( !empty( $key ) && array_key_exists( $key, $defaults) ) {
		return $defaults[$key];
	}

	return '';
}

function begin_image_positions() {

	$positions = array( "top left" => esc_attr__('Top Left','begin'),
		"top center"    => esc_attr__('Top Center','begin'),
		"top right"     => esc_attr__('Top Right','begin'),
		"center left"   => esc_attr__('Center Left','begin'),
		"center center" => esc_attr__('Center Center','begin'),
		"center right"  => esc_attr__('Center Right','begin'),
		"bottom left"   => esc_attr__('Bottom Left','begin'),
		"bottom center" => esc_attr__('Bottom Center','begin'),
		"bottom right"  => esc_attr__('Bottom Right','begin'),
	);

	return $positions;
}

function begin_image_repeats() {

	$image_repeats = array( "repeat" => esc_attr__('Repeat','begin'),
		"repeat-x"  => esc_attr__('Repeat in X-axis','begin'),
		"repeat-y"  => esc_attr__('Repeat in Y-axis','begin'),
		"no-repeat" => esc_attr__('No Repeat','begin')
	);

	return $image_repeats;
}

function begin_border_styles() {

	$image_repeats = array(
		"none"	 => esc_attr__('None','begin'),
		"dotted" => esc_attr__('Dotted','begin'),
		"dashed" => esc_attr__('Dashed','begin'),
		"solid"	 => esc_attr__('Solid','begin'),
		"double" => esc_attr__('Double','begin'),
		"groove" => esc_attr__('Groove','begin'),
		"ridge"	 => esc_attr__('Ridge','begin'),
	);

	return $image_repeats;
}

function begin_animations() {

	$animations = array(
		'' 					 => esc_html__('Default','begin'),	
		"bigEntrance"        =>  esc_attr__("bigEntrance",'begin'),
        "bounce"             =>  esc_attr__("bounce",'begin'),
        "bounceIn"           =>  esc_attr__("bounceIn",'begin'),
        "bounceInDown"       =>  esc_attr__("bounceInDown",'begin'),
        "bounceInLeft"       =>  esc_attr__("bounceInLeft",'begin'),
        "bounceInRight"      =>  esc_attr__("bounceInRight",'begin'),
        "bounceInUp"         =>  esc_attr__("bounceInUp",'begin'),
        "bounceOut"          =>  esc_attr__("bounceOut",'begin'),
        "bounceOutDown"      =>  esc_attr__("bounceOutDown",'begin'),
        "bounceOutLeft"      =>  esc_attr__("bounceOutLeft",'begin'),
        "bounceOutRight"     =>  esc_attr__("bounceOutRight",'begin'),
        "bounceOutUp"        =>  esc_attr__("bounceOutUp",'begin'),
        "expandOpen"         =>  esc_attr__("expandOpen",'begin'),
        "expandUp"           =>  esc_attr__("expandUp",'begin'),
        "fadeIn"             =>  esc_attr__("fadeIn",'begin'),
        "fadeInDown"         =>  esc_attr__("fadeInDown",'begin'),
        "fadeInDownBig"      =>  esc_attr__("fadeInDownBig",'begin'),
        "fadeInLeft"         =>  esc_attr__("fadeInLeft",'begin'),
        "fadeInLeftBig"      =>  esc_attr__("fadeInLeftBig",'begin'),
        "fadeInRight"        =>  esc_attr__("fadeInRight",'begin'),
        "fadeInRightBig"     =>  esc_attr__("fadeInRightBig",'begin'),
        "fadeInUp"           =>  esc_attr__("fadeInUp",'begin'),
        "fadeInUpBig"        =>  esc_attr__("fadeInUpBig",'begin'),
        "fadeOut"            =>  esc_attr__("fadeOut",'begin'),
        "fadeOutDownBig"     =>  esc_attr__("fadeOutDownBig",'begin'),
        "fadeOutLeft"        =>  esc_attr__("fadeOutLeft",'begin'),
        "fadeOutLeftBig"     =>  esc_attr__("fadeOutLeftBig",'begin'),
        "fadeOutRight"       =>  esc_attr__("fadeOutRight",'begin'),
        "fadeOutUp"          =>  esc_attr__("fadeOutUp",'begin'),
        "fadeOutUpBig"       =>  esc_attr__("fadeOutUpBig",'begin'),
        "flash"              =>  esc_attr__("flash",'begin'),
        "flip"               =>  esc_attr__("flip",'begin'),
        "flipInX"            =>  esc_attr__("flipInX",'begin'),
        "flipInY"            =>  esc_attr__("flipInY",'begin'),
        "flipOutX"           =>  esc_attr__("flipOutX",'begin'),
        "flipOutY"           =>  esc_attr__("flipOutY",'begin'),
        "floating"           =>  esc_attr__("floating",'begin'),
        "hatch"              =>  esc_attr__("hatch",'begin'),
        "hinge"              =>  esc_attr__("hinge",'begin'),
        "lightSpeedIn"       =>  esc_attr__("lightSpeedIn",'begin'),
        "lightSpeedOut"      =>  esc_attr__("lightSpeedOut",'begin'),
        "pullDown"           =>  esc_attr__("pullDown",'begin'),
        "pullUp"             =>  esc_attr__("pullUp",'begin'),
        "pulse"              =>  esc_attr__("pulse",'begin'),
        "rollIn"             =>  esc_attr__("rollIn",'begin'),
        "rollOut"            =>  esc_attr__("rollOut",'begin'),
        "rotateIn"           =>  esc_attr__("rotateIn",'begin'),
        "rotateInDownLeft"   =>  esc_attr__("rotateInDownLeft",'begin'),
        "rotateInDownRight"  =>  esc_attr__("rotateInDownRight",'begin'),
        "rotateInUpLeft"     =>  esc_attr__("rotateInUpLeft",'begin'),
        "rotateInUpRight"    =>  esc_attr__("rotateInUpRight",'begin'),
        "rotateOut"          =>  esc_attr__("rotateOut",'begin'),
        "rotateOutDownRight" =>  esc_attr__("rotateOutDownRight",'begin'),
        "rotateOutUpLeft"    =>  esc_attr__("rotateOutUpLeft",'begin'),
        "rotateOutUpRight"   =>  esc_attr__("rotateOutUpRight",'begin'),
        "shake"              =>  esc_attr__("shake",'begin'),
        "slideDown"          =>  esc_attr__("slideDown",'begin'),
        "slideExpandUp"      =>  esc_attr__("slideExpandUp",'begin'),
        "slideLeft"          =>  esc_attr__("slideLeft",'begin'),
        "slideRight"         =>  esc_attr__("slideRight",'begin'),
        "slideUp"            =>  esc_attr__("slideUp",'begin'),
        "stretchLeft"        =>  esc_attr__("stretchLeft",'begin'),
        "stretchRight"       =>  esc_attr__("stretchRight",'begin'),
        "swing"              =>  esc_attr__("swing",'begin'),
        "tada"               =>  esc_attr__("tada",'begin'),
        "tossing"            =>  esc_attr__("tossing",'begin'),
        "wobble"             =>  esc_attr__("wobble",'begin'),
        "fadeOutDown"        =>  esc_attr__("fadeOutDown",'begin'),
        "fadeOutRightBig"    =>  esc_attr__("fadeOutRightBig",'begin'),
        "rotateOutDownLeft"  =>  esc_attr__("rotateOutDownLeft",'begin')
    );

	return $animations;
}