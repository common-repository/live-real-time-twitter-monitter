<?
/*
Plugin Name: zMonitter
Plugin URI: http://www.zmastaa.com/zmonitter
Description: Live action twittering on your widget bar using Monitter.com
Version: 1.4
Author: Eugene zMastaa Agyeman
Author URI: http://www.zmastaa.com
*/
/*  Copyright 2008  Eugene Agyeman  (email : eugene@zmastaa.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
    
*/
function zMonitter()
{
	  $options = get_option("widget_zMonitter");
	echo "<script type=\"text/javascript\" src=\""; 
echo WP_PLUGIN_URL . "/live-real-time-twitter-monitter/jquery.min.js\"></script><script type=\"text/javascript\" src=\""; 
echo WP_PLUGIN_URL . "/live-real-time-twitter-monitter/monitter.min.js\"></script>
<style type=\"text/css\">
.tweet
{
display: block;
clear: both;
padding: .6em;
margin: .3em;
overflow: hidden;
}
.tweet img
{
float: left;
margin-right: 1em;
border: 3px solid #222;
}
.tweet p.text
{
margin: 0;
padding: 0;
padding-left: 70px;
}
.monitter 
{
display: block;
float: left;
width: 100%;
height: 320px;
overflow:hidden;
}
.widg
{
height: 320px;
}
</style>
<div class=\"monitter\" id=\"tweets\" title=\"";?><?php echo $options['twit'];?> 
<?php echo "\" lang=\"en\"></div>";
}
function widget_zMonitter($args) {
  extract($args);

  $options = get_option("widget_zMonitter");
  if (!is_array( $options ))
	{
		$options = array(
      'title' => 'My Widget Title', 'twit' => 'wordpress'
      );
  }      

  echo $before_widget;
    echo $before_title;
      echo $options['title'];
    echo $after_title;
echo "<div class=\"widg\">";
    //Our Widget Content
    zMonitter();
  echo $after_widget;
echo "</div>";
} 
function zMonitter_control()
{
  $options = get_option("widget_zMonitter");

  if (!is_array( $options ))
	{
		$options = array(
      'title' => 'My Widget Title', 'twit' => 'monitter'
      );
  }    
  if ($_POST['zMonitter-Submit'])
  {
    $options['title'] = htmlspecialchars($_POST['zMonitter-WidgetTitle']);
    $options['twit'] = htmlspecialchars($_POST['zMonitter-TwitterText']);
    $twit = $options['twit'];
    update_option("widget_zMonitter", $options);
  }

?>
  <p>
    <label for="zMonitter-WidgetTitle">Widget Title: </label>
    <input type="text" id="zMonitter-WidgetTitle" name="zMonitter-WidgetTitle" value="<?php echo $options['title'];?>" /><br>
    <label for="zMonitter-WidgetTitle">Twitter Text: </label>
    <input type="text" id="zMonitter-TwitterText" name="zMonitter-TwitterText" value="<?php echo $options['twit'];?>" />
    <input type="hidden" id="zMonitter-Submit" name="zMonitter-Submit" value="1" />
  </p>
<?php
}

function zMonitter_init()
{
  register_sidebar_widget(__('zMonitter'), 'widget_zMonitter');
  register_widget_control(   'zMonitter', 'zMonitter_control', 300, 200 );

}
add_action("plugins_loaded", "zMonitter_init");
