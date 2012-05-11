<?php
/*
Plugin Name: British Embassy Finder
Plugin URI: http://travelchimps.com/widgets/uk-embassy-widget.php
Description: Search for a Britsh Embassy, High Commission, or Consul anywhere in the world. Customisable
Author: Andrew Wrigley
Version: 0.8.0
Author URI: http://travelchimps.com/
*/
/* FOR WP 2.8 ON 
   tested on 3.3.1, & PHP 5 */


class UKembassyWidget extends WP_Widget
{

/* constructor */
    function UKembassyWidget() {
      $widget_ops = array('classname' => 'aw_ukembassywidget', 'description' => __( "UK Embassy Locator") );
      $control_ops = array('width' => 320, 'height' => 300,  'id_base' => 'awukembassy');
      $this->WP_Widget('awukembassy', 'UK Embassy Locator', $widget_ops, $control_ops);
    }

/* displays widget overrides class WP_Widget with own stuff */
	 	function widget($args, $instance) {		
		/*$args = standard widget variables what to display before and after widget etc as defined by WP themes*/
		/* more than one instance object can be created*/
      extract( $args );
			/*variables holding website specified config settings for widget look */
      $title = apply_filters('widget_title', $instance['title']);
      $width = $instance['width'];
      $btnbkg = $instance['btnbkg'];
      $btnfnt = $instance['btnfnt'];		
			$btntxt=$instance['btntxt'];
			$inputbg=$instance['inputbg'];
			$inputfnt=$instance['inputfnt'];
			$inputlbltxt=$instance['inputlbltxt'];
			$inputlblclr=$instance['inputlblclr'];
			$credanc=$instance['credanc'];
			$newtab=strtolower($instance['newtab']);
			$aline=$instance['aline'];
			$abovewidget=$instance['abovewidget'];
			$belowtitle=$instance['belowtitle'];
			$belowwidget=$instance['belowwidget'];			
      echo $before_widget;
/* build widget form using selected styles or defaults */
			if (strlen($abovewidget) > 2 ) echo "<div style='height:$abovewidget;'>&nbsp;</div>\n";
      if ( $title )echo $before_title . $title . $after_title;
			$formstyle='';
			if (strlen($aline) > 0 && $aline != 'theme') $formstyle=" style='text-align:$aline;'";		
      $inputstyle='';
      if (strlen($width) > 0 ) $inputstyle="width:$width;";
      if (strlen($inputbg) > 0 ) $inputstyle .= "background:$inputbg;";
      if (strlen($inputfnt) > 0 ) $inputstyle .= "color:$inputfnt;";
      if (strlen($inputstyle) > 0 ) $inputstyle = " style='" . $inputstyle . "' ";

      if (strlen($belowtitle) > 2 ) echo "<div style='height:$belowtitle;'>&nbsp;</div>\n";

			echo  "<div style='color:$inputlblclr'>$inputlbltxt</div><form ";
      if ($newtab != 'n'){echo "target='_blank '" ;};
			echo "method='post' action='http://travelchimps.com/country/find-an-embassy.php' $formstyle>\n";
			echo "<input $inputstyle size='' maxlength='30' name='in_words' />\n";

      $btnstyle='';
      if (strlen($btnbkg) > 0 ) $btnstyle="background:$btnbkg;";
      if (strlen($btnfnt) > 0 ) $btnstyle .="color:$btnfnt;";
      if (strlen($btnstyle) > 0 ) $btnstyle = " style='" . $btnstyle . "' ";
			echo "<input $btnstyle type='submit' value='$btntxt' name='submit' />";
      if (($credanc)== 'y' ||($credanc) == 'Y') echo "<br /><a href='http://travelchimps.com/dashboard/dashpage-gb.php' target='_blank' style='font-size:small'>more Travel Advice</a>\n";
			echo "</form><br />";			
      if (strlen($belowwidget) > 2 ) echo "<div style='height:$belowwidget;'>&nbsp;</div>\n";
      echo $after_widget;
   }

/*$instance is an array that will store all of your widget’s configurable options, which in this case is $title, $lineOne, and $lineTwo. 
/*called on "save" settings page from WP widgets admin*/ 
    function update($new_instance, $old_instance) {
		// $instance, new information about this particular instance of the widget	
		//$old_instance, previously saved widget information
			$instance = $old_instance;
    	$instance['title'] = strip_tags($new_instance['title']);
      $instance['width'] = strip_tags(stripslashes($new_instance['width']));
      $instance['btnbkg'] = strip_tags(stripslashes($new_instance['btnbkg']));
      $instance['btnfnt'] = strip_tags(stripslashes($new_instance['btnfnt']));
      $instance['btntxt'] = strip_tags(stripslashes($new_instance['btntxt']));
      $instance['inputbg'] = strip_tags(stripslashes($new_instance['inputbg']));
      $instance['inputfnt'] = strip_tags(stripslashes($new_instance['inputfnt']));
			$instance['inputlbltxt'] = strip_tags(stripslashes($new_instance['inputlbltxt']));
			$instance['inputlblclr'] = strip_tags(stripslashes($new_instance['inputlblclr']));		
      $instance['credanc'] = strip_tags(stripslashes($new_instance['credanc']));
      $instance['newtab'] = strip_tags(stripslashes($new_instance['newtab']));
      $instance['aline'] = strip_tags(stripslashes($new_instance['aline']));
      $instance['abovewidget'] = strip_tags(stripslashes($new_instance['abovewidget']));	
      $instance['belowtitle'] = strip_tags(stripslashes($new_instance['belowtitle']));
      $instance['belowwidget'] = strip_tags(stripslashes($new_instance['belowwidget']));		
      return $instance;
    }

    function form($instance) {			

      //Defaults
      $instance = wp_parse_args( (array) $instance, array('title'=>'Find a British Embassy', 'width'=>'180px', 'btnbkg'=>'', 'btntxt'=>' Find ', 'inputlbltxt'=>'in Country or City:', 'inputlblclr'=>'', 'inputbg'=>'', 'inputfnt'=>'', 'credanc'=>'', 'newtab'=>'y', 'aline'=>'', 'abovewidget'=>'', 'belowtitle'=>'', 'belowwidget'=>'' ) );
      $title = htmlspecialchars($instance['title']);
      $width = htmlspecialchars($instance['width']);
      $btntxt = htmlspecialchars($instance['btntxt']);
      $btnbkg = htmlspecialchars($instance['btnbkg']);
			$btnfnt = htmlspecialchars($instance['btnfnt']);
      $inputbg = htmlspecialchars($instance['inputbg']);
      $inputfnt = htmlspecialchars($instance['inputfnt']);
      $inputlbltxt = htmlspecialchars($instance['inputlbltxt']);
			$inputlblclr = htmlspecialchars($instance['inputlblclr']);
      $credanc = htmlspecialchars($instance['credanc']);
      $newtab = htmlspecialchars($instance['newtab']);
      $aline = htmlspecialchars($instance['aline']);
      $abovewidget = htmlspecialchars($instance['abovewidget']);	
      $belowtitle = htmlspecialchars($instance['belowtitle']);			
      $belowwidget = htmlspecialchars($instance['belowwidget']);	
      # Output the options
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('title') . '">' . __('Title:') . ' <input style="width: 250px;" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('width') . '">' . __('Text Box width:') . ' <input style="width: 50px;" id="' . $this->get_field_id('width') . '" name="' . $this->get_field_name('width') . '" type="text" value="' . $width . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('btntxt') . '">' . __('Button Text:') . ' <input style="width: 150px;" id="' . $this->get_field_id('btntxt') . '" name="' . $this->get_field_name('btntxt') . '" type="text" value="' . $btntxt . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('btnbkg') . '">' . __('Button Color e.g. "black" or "#000000":') . ' <input style="width: 60px;" id="' . $this->get_field_id('btnbkg') . '" name="' . $this->get_field_name('btnbkg') . '" type="text" value="' . $btnbkg . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('btnfnt') . '">' . __('Button Font Color e.g. "white" or "#ffffff":') . ' <input style="width: 60px;" id="' . $this->get_field_id('btnfnt') . '" name="' . $this->get_field_name('btnfnt') . '" type="text" value="' . $btnfnt . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('inputbg') . '">' . __('Text Input background color e.g. "black" or "#000000":') . ' <input style="width: 60px;" id="' . $this->get_field_id('inputbg') . '" name="' . $this->get_field_name('inputbg') . '" type="text" value="' . $inputbg . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('inputfnt') . '">' . __('Text Input font color e.g. "black" or "#000000":') . ' <input style="width: 60px;" id="' . $this->get_field_id('inputfnt') . '" name="' . $this->get_field_name('inputfnt') . '" type="text" value="' . $inputfnt . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('inputlbltxt') . '">' . __('Input Box label:') . ' <input style="width: 200px;" id="' . $this->get_field_id('inputlbltxt') . '" name="' . $this->get_field_name('inputlbltxt') . '" type="text" value="' . $inputlbltxt . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('inputlblclr') . '">' . __('Color of Label e.g. "black" or "#000000":') . ' <input style="width: 50px;" id="' . $this->get_field_id('inputlblclr') . '" name="' . $this->get_field_name('inputlblclr') . '" type="text" value="' . $inputlblclr . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('credanc') . '">' . __('Display Travel Advice Link:Y/N') . ' <input style="width: 15px;" id="' . $this->get_field_id('credanc') . '" name="' . $this->get_field_name('credanc') . '" type="text" value="' . $credanc . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('newtab') . '">' . __('Display Embassy Info on new page Y/N?') . ' <input style="width:15px;" id="' . $this->get_field_id('newtab') . '" name="' . $this->get_field_name('newtab') . '" type="text" value="' . $newtab . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('aline') . '">' . __('Text Box alignment, leave empty for theme default, or "left","right" or "center":') . ' <input style="width: 50px;" id="' . $this->get_field_id('aline') . '" name="' . $this->get_field_name('aline') . '" type="text" value="' . $aline . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('abovewidget') . '">' . __('(extra) Padding above Widget e.g. 5px') . ' <input style="width: 50px;" id="' . $this->get_field_id('abovewidget') . '" name="' . $this->get_field_name('abovewidget') . '" type="text" value="' . $abovewidget . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('belowtitle') . '">' . __('(extra) Padding below Title in px') . ' <input style="width: 50px;" id="' . $this->get_field_id('belowtitle') . '" name="' . $this->get_field_name('belowtitle') . '" type="text" value="' . $belowtitle . '" /></label></p>';
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('belowwidget') . '">' . __('(extra) Padding below Widget in px') . ' <input style="width: 50px;" id="' . $this->get_field_id('belowwidget') . '" name="' . $this->get_field_name('belowwidget') . '" type="text" value="' . $belowwidget . '" /></label></p>';
    }
} // end class countrywidget

/* registers/initialises widget*/
  function UKembassyInit() {
  register_widget('UKembassyWidget');
  }
  add_action('widgets_init', 'UKembassyInit');