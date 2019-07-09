<?php
function createDateRangeArray($strDateFrom,$strDateTo)
{
    // takes two dates formatted as YYYY-MM-DD and creates an
    // inclusive array of the dates between the from and to dates.

    $aryRange=array();

    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

    if ($iDateTo>=$iDateFrom)
    {
        array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
        while ($iDateFrom<$iDateTo)
        {
            $iDateFrom+=86400; // add 24 hours
            array_push($aryRange,date('Y-m-d',$iDateFrom));
        }
    }
    return $aryRange;
}
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Academies_V1
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php if (get_field("is_there_a_cap_form") ) { ?>
<script type="text/javascript">
                    var enableSubmitButton = function() {
                        var submitButton = document.getElementById('submit_button');
                        var explanation = document.getElementById('disabled-explanation');
                        if (submitButton != null) {
                            submitButton.removeAttribute('disabled');
                            if (explanation != null) {
                                explanation.style.display = 'none';
                            }
                        }
                    };
                    var disableSubmitButton = function() {
                        var submitButton = document.getElementById('submit_button');
                        var explanation = document.getElementById('disabled-explanation');
                        if (submitButton != null) {
                            submitButton.disabled = true;
                            if (explanation != null) {
                                explanation.style.display = 'block';
                            }
                        }
                    };
                    var onloadCallback = function () {
                        grecaptcha.render('g-recaptcha-render-div', {
                            'sitekey': '6LeISQ8UAAAAAL-Qe-lDcy4OIElnii__H_cEGV0C',
                            'theme': 'light',
                            'size': 'normal',
                            'callback': 'enableSubmitButton',
                            'expired-callback': 'disableSubmitButton'
                        });
                        var oldRecaptchaCheck = parseInt('0');
                        if (oldRecaptchaCheck === -1) {
                            var standardCaptcha = document.getElementById("tfa_captcha_text");
                            standardCaptcha = standardCaptcha.parentNode.parentNode.parentNode;
                            standardCaptcha.parentNode.removeChild(standardCaptcha);
                        }
                        document.getElementById("g-recaptcha-render-div").parentNode.parentNode.parentNode.style.display = "block";
                        document.getElementById("g-recaptcha-render-div").parentNode.parentNode.parentNode.removeAttribute("hidden");
                        document.getElementById("g-recaptcha-render-div").getAttributeNode('id').value = 'tfa_captcha_text';

                        var captchaError = '';
                        if (captchaError == '1') {
                            var errMsgText = 'The CAPTCHA was not completed successfully.';
                            var errMsgDiv = document.createElement('div');
                            errMsgDiv.id = "tfa_captcha_text-E";
                            errMsgDiv.className = "err errMsg";
                            errMsgDiv.innerText = errMsgText;
                            var loc = document.querySelector('.g-captcha-error');
                            loc.insertBefore(errMsgDiv, loc.childNodes[0]);

                            /* See wFORMS.behaviors.paging.applyTo for origin of this code */
                            if (wFORMS.instances['paging']) {
                                var b = wFORMS.instances['paging'][0];
                                var pp = base2.DOM.Element.querySelector(document, wFORMS.behaviors.paging.CAPTCHA_ERROR);
                                if (pp) {
                                    var lastPage = 1;
                                    for (var i = 1; i < 100; i++) {
                                        if (b.behavior.isLastPageIndex(i)) {
                                            lastPage = i;
                                            break;
                                        }
                                    }
                                    b.jumpTo(lastPage);
                                }
                            }
                        }
                    };
                </script>
                <script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit' async
                        defer></script>
                <script type="text/javascript">
                    document.addEventListener("DOMContentLoaded", function() {
                        var warning = document.getElementById("javascript-warning");
                        if (warning != null) {
                            warning.parentNode.removeChild(warning);
                        }
                        var oldRecaptchaCheck = parseInt('0');
                        if (oldRecaptchaCheck !== -1) {
                            var explanation = document.getElementById('disabled-explanation');
                            var submitButton = document.getElementById('submit_button');
                            if (submitButton != null) {
                                submitButton.disabled = true;
                                if (explanation != null) {
                                    explanation.style.display = 'block';
                                }
                            }
                        }
                    });
                </script>
                <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function(){
            const FORM_TIME_START = Math.floor((new Date).getTime()/1000);
            let formElement = document.getElementById("tfa_0");
            let appendJsTimerElement = function(){
                let formTimeDiff = Math.floor((new Date).getTime()/1000) - FORM_TIME_START;
                let cumulatedTimeElement = document.getElementById("tfa_dbCumulatedTime");
                if (null !== cumulatedTimeElement) {
                    let cumulatedTime = parseInt(cumulatedTimeElement.value);
                    if (null !== cumulatedTime && cumulatedTime > 0) {
                        formTimeDiff += cumulatedTime;
                    }
                }
                let jsTimeInput = document.createElement("input");
                jsTimeInput.setAttribute("type", "hidden");
                jsTimeInput.setAttribute("value", formTimeDiff.toString());
                jsTimeInput.setAttribute("name", "tfa_dbElapsedJsTime");
                jsTimeInput.setAttribute("id", "tfa_dbElapsedJsTime");
                jsTimeInput.setAttribute("autocomplete", "off");
                if (null !== formElement) {
                    formElement.appendChild(jsTimeInput);
                }
            };
            if (null !== formElement) {
                if(formElement.addEventListener){
                    formElement.addEventListener('submit', appendJsTimerElement, false);
                } else if(formElement.attachEvent){
                    formElement.attachEvent('onsubmit', appendJsTimerElement);
                }
            }
        });
    </script>
    <link href="https://www.tfaforms.com/form-builder/4.4.0/css/wforms-layout.css?v=4614-1" rel="stylesheet" type="text/css" />
    <!--[if IE 8]>
    <link href="https://www.tfaforms.com/form-builder/4.4.0/css/wforms-layout-ie8.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <!--[if IE 7]>
    <link href="https://www.tfaforms.com/form-builder/4.4.0/css/wforms-layout-ie7.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <!--[if IE 6]>
    <link href="https://www.tfaforms.com/form-builder/4.4.0/css/wforms-layout-ie6.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <link href="https://www.tfaforms.com/themes/get/45036" rel="stylesheet" type="text/css" />
    <link href="https://www.tfaforms.com/form-builder/4.4.0/css/wforms-jsonly.css?v=4614-1" rel="alternate stylesheet" title="This stylesheet activated by javascript" type="text/css" />
    <script type="text/javascript" src="https://www.tfaforms.com/wForms/3.10/js/wforms.js?v=4614-1"></script>
    <script type="text/javascript">
        wFORMS.behaviors.prefill.skip = false;
    </script>
        <script type="text/javascript" src="https://www.tfaforms.com/wForms/3.10/js/localization-en_US.js?v=4614-1"></script>
<?php } ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'academies_v1' ); ?></a>
	<div class="gdpr-popup">
            This site uses cookies to store information on your computer. By using this site, you consent to the placement and use of these cookies. Read our <a href="/privacy-policy/">Privacy Policy</a> to learn more.  
            <a href="#" class="accept">ACCEPT </a> 
        </div> 
	<?php if( have_rows('alert') ){
      while ( have_rows('alert') ) : the_row();
  if( get_sub_field('alert_active')) {
    $banner = true;
  }
  endwhile;

   if($banner == true) {
  ?>
   <div class="ticker-wrap">
     <div class="mask">
<ul class="ticker"><?php
$dater = date('M d, Y');
$dater = strtotime($dater);
$dateArray = array();
  while ( have_rows('alert') ) : the_row();
  if( get_sub_field('alert_active')) {
  if( get_sub_field('recurring_event') == "Not Recurring"){
   if( get_sub_field('alert_end_date')){
     $startString = get_sub_field('alert_start_date')." ".get_sub_field('alert_start_hour').":".get_sub_field('alert_start_minute')." ".get_sub_field('alert_start_time_am_pm');
     $startTime = strtotime( $startString );
     $startTest = strtotime (date('Ymd g:i A'));
     $endString = get_sub_field('alert_end_date')." ".get_sub_field('alert_end_time_hour').":".get_sub_field('alert_end_time_minute')." ".get_sub_field('alert_end_time_am_pm');
     $endTime = strtotime( $endString );
     $endTest = strtotime (date('Ymd g:i A'));
   if ( $startTime <= $startTest && $endTime > $endTest ) { ?><li class="ticker__item"><?php if (get_sub_field('alert_url')) { ?><a href="<?php the_sub_field('alert_url'); ?>" target="_blank" class="alert-link" onClick="ga('send', 'event', 'homepage', 'internalLink', 'alert');"><?php } ?><?php the_sub_field('alert_text'); ?><?php if (get_sub_field('alert_url')) { ?> <i class="fa fa-angle-double-right fa-1" aria-hidden="true"></i></a><?php } ?></li>
	<?php } } else {
	   if ( get_sub_field('alert_start_date') <= date('Y-m-d')) { ?><li class="ticker__item"><?php if (get_sub_field('alert_url')) { ?><a href="<?php the_sub_field('alert_url'); ?>" target="_blank" class="alert-link" onClick="ga('send', 'event', 'homepage', 'internalLink', 'alert');"><?php } ?><?php the_sub_field('alert_text'); ?><?php if (get_sub_field('alert_url')) { ?> <i class="fa fa-angle-double-right fa-1" aria-hidden="true"></i></a><?php } ?></li>
  <?php } } }
  else {
    $event_date = get_sub_field('alert_start_date');
    //echo $event_date;
 		$pastDayKeep = date('Ymd',strtotime("-3 day", $dater));
 		$year = date('Y');
 		$end = "01-01-".$year;
 		$toit =  strtotime(" +1 year" . $end);
 		$event_repetition_type = get_sub_field('recurring_event');
		
 		if($event_repetition_type != 'Not Recurring') {
 		$date_calculation = "";
 		switch ($event_repetition_type) {
 		    case "Daily":
 		    $date_calculation = " +1 day";
 		    break;
 		case "Weekly":
 		    $date_calculation = " +1 week";
 		    break;
 		case "Monthly":
 		    $date_calculation = " +1 month";
 		    break;
 		case "Yearly":
 			$date_calculation = " +1 year";
 			break;
 		default:
 		    $date_calculation = "none";
 		}
 		//$dateArray[] =  $event_date;
 		$day = strtotime($event_date);
      echo $day;
 		while( $day <= $toit ) 
 		{
 		    $day = strtotime(date("Ymd", $day) . $date_calculation);
 			$finalDay = date("Ymd" , $day);
 			if($finalDay >= $pastDayKeep){
 		    $dateArray[] = strtotime($finalDay);
 			}
 		}
 	if($event_date >= $pastDayKeep){
 		$dateArray[] =  date("Ymd", $event_date);
 	}
   ksort($dateArray);
   //print_r($dateArray);
  if ( in_array(strtotime(date('Ymd')), $dateArray)) { ?><li class="ticker__item"><?php if (get_sub_field('alert_url')) { ?><a href="<?php the_sub_field('alert_url'); ?>" target="_blank" class="alert-link" onClick="ga('send', 'event', 'homepage', 'internalLink', 'alert');"><?php } ?><?php the_sub_field('alert_text'); ?><?php if (get_sub_field('alert_url')) { ?> <i class="fa fa-angle-double-right fa-1" aria-hidden="true"></i></a><?php } ?></li>
	  <?php } } } }
  endwhile; ?> </ul>
     </div>
     <div class="ticker-left-mask">Alert</div>
  </div>
  		  <script>
  jQuery(document).ready(function(){
    jQuery(".ticker").webTicker({ duplicate:true, hoverpause:false, startEmpty: false });
});
  </script>
	<?php  } } ?>
	<header id="masthead" class="site-header" role="banner">
    <section class="container">
      <a href="http://dioceseofbrooklyn.org/" target="_blank"><div class="home-icon"></div></a>
      <div class="site-branding">
        <h1 class="site-title">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
            <img src="<?php the_field('ogo_image', 'option') ?>" class="aca-logo"/>
            <span><?php bloginfo( 'name' ); ?></span>
          </a></h1>
        <?php the_field('header_description', 'option') ?>
        
      </div><!-- .site-branding -->
   
        
        <a href="<?php the_field('sign_up_link', 'option');?>" class="sign-in"><?php the_field('sign_up_text', 'option') ?></a>
        
      
      </section>
    <?php if ( !is_front_page()) { ?>
     <nav id="site-navigation" class="inner main-navigation" role="navigation">
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'MENU', 'academies_v1' ); ?></button>
        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?> 
       <div class="clear"></div>
      </nav><?php } ?><!-- #site-navigation -->
    
      
  </header><!-- #masthead -->
	<?php if ( is_front_page()) { ?>
  	<div class="site-content full">

<nav id="site-navigation" class="main-navigation" role="navigation">
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'MENU', 'academies_v1' ); ?></button>
        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
   <?php if(get_field ('homepage_button_text')): ?>
	   <?php endif; ?><div class="clear"></div>
      </nav><!-- #site-navigation -->

    	<?php 
					$royalsliderid = get_field('royal_slider');
					if(get_field('royal_slider')):
					echo do_shortcode('[kingslider id="'.$royalsliderid.'"]');
					endif;
				?>
        <?php 
          $nivosliderid = get_field('nivo_slider');
          if(get_field('nivo_slider')):
          echo do_shortcode('[nivoslider id="'.$nivosliderid.'"]');
          endif;
        ?>
        <script>
          var interval = null;

          function addNivoArrowClass(){
            if( jQuery('.nivo-nextNav').length && jQuery('.nivo-prevNav').length ){
              jQuery('.nivo-nextNav').addClass('fa fa-caret-square-o-right');
              jQuery('.nivo-prevNav').addClass('fa fa-caret-square-o-left');
              clearInterval(interval);
            }
          }

          jQuery(document).ready(function(){
            if( window.location.pathname == '/' ){
              interval = setInterval(addNivoArrowClass, 750);
            }
          });
        </script>
  	</div>
	<?php } ?>  
	<div id="content" class="site-content">