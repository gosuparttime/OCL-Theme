<?php

// shortcodes

// Gallery shortcode

// remove the standard shortcode



// Buttons
function buttons( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'color' => 'default', /* primary, default, info, success, danger, warning, inverse */
	'url'  => '',
	'text' => '',
	'subtext' => '',
	'blank' => false,
	'block' => false,
	'size' => '',
	'icon'=>'',
	), $atts ) );
	
	if($color == "default"){
		$color = "btn-default";
	}
	else{ 
		$color = "btn btn-" . $color;
	}
	if($blank == false){
		$blank = "_self";
	}
	else{ 
		$blank = "_blank";
	}
	if($block == true){
		$color = $color + " btn-block";
	}
	else{ 
		$color = $color;
	}
	if(! $icon){
		$icon = "icon-chevron-right";
	}
	if($size == "large"){
		$icon = $icon." icon-2x";
	}
	
		
	$output = '<a href="' . $url . '" class="'.$color.'" target="'.$blank.'" title="'.$text.'" role="button">';
	
	
	if($subtext){
		$output .= '<div class="emphasize">';
		$output .= '<i class="pull-right ' . $icon . '"></i>';
		$output .= $text;
		$output .= '</div>';
		$output .= '<small>';
		$output .= $subtext;
		$output .= '</small>';
	} else{
		$output .= $text;
		$output .= '<i class="' . $icon . '"></i>';
	}
	$output .= '</a>';
	
	return $output;
}

add_shortcode('button', 'buttons');

// Alerts
function alerts( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'alert-info', /* alert-info, alert-success, alert-error */
	'close' => 'false', /* display close link */
	'text' => '', 
	), $atts ) );
	
	$output = '<div class="fade in alert alert-'. $type . '">';
	if($close == 'true') {
		$output .= '<a class="close" data-dismiss="alert">×</a>';
	}
	$output .= $text . '</div>';
	
	return $output;
}

add_shortcode('alert', 'alerts');

// Block Messages
function block_messages( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'alert-info', /* alert-info, alert-success, alert-error */
	'close' => 'false', /* display close link */
	'text' => '', 
	), $atts ) );
	
	$output = '<div class="fade in alert alert-block alert-'. $type . '">';
	if($close == 'true') {
		$output .= '<a class="close" data-dismiss="alert">×</a>';
	}
	$output .= '<p>' . $text . '</p></div>';
	
	return $output;
}

add_shortcode('block-message', 'block_messages'); 

// Block Messages
function blockquotes( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'float' => '', /* left, right */
	'cite' => '', /* text for cite */
	), $atts ) );
	
	$output = '<blockquote';
	if($float == 'left') {
		$output .= ' class="pull-left"';
	}
	elseif($float == 'right'){
		$output .= ' class="pull-right"';
	}
	$output .= '><p>' . $content . '</p>';
	
	if($cite){
		$output .= '<small>' . $cite . '</small>';
	}
	
	$output .= '</blockquote>';
	
	return $output;
}

add_shortcode('blockquote', 'blockquotes'); 
 



?>