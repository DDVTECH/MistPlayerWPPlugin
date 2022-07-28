<?php
/**
 * @package MistPlayer
 * @version 1.0
 */
/*
Plugin Name:  MistPlayer
Plugin URI:   https://www.mistserver.org
Description:  This plugin allows you to embed the fantastic, scalable and reliable MistServer Meta-Player (that connects to your MistServer instance) into your WordPress website.  MistServer is a full-featured, next-generation streaming media toolkit for OTT (internet streaming), designed to be ideal for developers and system integrators.
Version:      1.0
Author:       MistServer team
Author URI:   https://www.mistserver.org
License:      Unlicense
*/
// Make sure we don't expose any info if called directly


if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

function dbi_add_settings_page() {
  add_options_page( 'MistPlayer', 'MistPlayer', 'manage_options', 'mistplayer_defaults', 'dbi_render_plugin_settings_page' );
}
add_action( 'admin_menu', 'dbi_add_settings_page' );

function dbi_render_plugin_settings_page() {
  ?>
  <h2>Set MistPlayer plugin default settings</h2>
  <form action="options.php" method="post">
    <?php 
    settings_fields( 'mistplayer_defaults' );
    do_settings_sections( 'dbi_example_plugin' ); ?>
    <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Save' ); ?>" />
  </form>
  <?php
}

function dbi_register_settings() {
  register_setting( 'mistplayer_defaults', 'mistplayer_defaults', 'mistplayer_defaults_validate' );
  add_settings_section( 'mistplayer_settings', '', 'dbi_plugin_section_text', 'dbi_example_plugin' );

  add_settings_field( 'dbi_plugin_setting_http', '<span style="color:grey;">HTTP host (required)</span>', 'dbi_plugin_setting_http', 'dbi_example_plugin', 'mistplayer_settings' );

  add_settings_field( 'dbi_plugin_setting_https', '<span style="color:grey;">HTTPS host</span>', 'dbi_plugin_setting_https', 'dbi_example_plugin', 'mistplayer_settings' );

  add_settings_field( 'dbi_plugin_setting_opts', '<span style="color:grey;">Options</span>', 'dbi_plugin_setting_opts', 'dbi_example_plugin', 'mistplayer_settings' );

  add_settings_field( 'dbi_plugin_setting_loadbalancer', '<span style="color:grey;">Load balancer URL address</span>', 'dbi_plugin_setting_loadbalancer', 'dbi_example_plugin', 'mistplayer_settings' );
}
add_action( 'admin_init', 'dbi_register_settings' );

function dbi_plugin_section_text() {
  echo '<p style="color:grey;">Here you can set common default values  for all your MistPlayer streams</p>';
}

function dbi_plugin_setting_http() {
  $options = get_option( 'mistplayer_defaults' );
  echo "<div style='display:flex;align-items:baseline;flex-row:no-wrap;width:30em;'><label style='color:grey;'>http:// </label><input style='flex-grow:1;' id='dbi_plugin_setting_http' name='mistplayer_defaults[http]' type='text' value='" . esc_attr( $options['http'] ) . "' required/></div>
  <tr><td colspan=2 style='padding:0 0 1em;color:grey;'>For instance: <span style='color:black;'>example.com:8080 </span>or<span style='color:black'> example.com/mistserver</span></td></tr>";
}

function dbi_plugin_setting_https() {
  $options = get_option( 'mistplayer_defaults' );
  echo "<div style='display:flex;align-items:baseline;flex-row:no-wrap;width:30em;'><label style='color:grey;'>https:// </label><input style='flex-grow:1; id='dbi_plugin_setting_https' name='mistplayer_defaults[https]' type='text' value='" . esc_attr( $options['https'] ) . "'/></div>
  <tr><td colspan=2 style='padding:0 0 1em;color:grey;'>For instance: <span style='color:black;'>example.com:4433</span> or <span style='color:black;'>example.com/mistserver</span>
  <p>You can leave this field blank to default to the HTTP url, but the video might not play if it is viewed from an HTTPS connection.</p></td></tr>";
}

function dbi_plugin_setting_opts() {
  $options = get_option( 'mistplayer_defaults' );
  echo "<textarea style='width:30em;' id='dbi_plugin_setting_opts' name='mistplayer_defaults[opts]' type='text' >" . esc_attr( $options['opts'] ) . "</textarea>
  <tr><td colspan=2 style='padding:0 0 1em;color:grey;'>For instance: <span style='color:black;'>{width:300, muted:true}</span><p>  <span style='cursor:pointer;' title='
   
  autoplay: false,       (does not start playing when loaded)
  controls: false,       (does not show controls (MistControls when available)
  loop: true,          (loop when the stream has finished)
  poster: true,        (show an image before the stream has started)
  muted: true,         (start muted)
  fillSpace: true,     (fill parent container)
  width: 300,         (example of set width, default is false)
  height: 300,        (example of set height, default is false)
  maxwidth: 600,      (example max width (apart from targets dimensions)
  maxheight: 600,     (example max height (apart from targets dimensions)
  '>  Hover over for more options</span></p></td></tr>";
}

function dbi_plugin_setting_loadbalancer() {
  $options = get_option( 'mistplayer_defaults' );
  echo "<input style='width:30em;' id='dbi_plugin_setting_loadbalancer' name='mistplayer_defaults[loadbalancer]' type='text' value='" . esc_attr( $options['loadbalancer'] ) . "'/>
  <tr><td colspan=2 style='padding:0 0 1.5em;color:grey;'>For instance: <span style='color:black;'>http://hostname:8045</span></td></tr> ";
}
function mistplayer_shortcode($attr, $content = null){
  $default_info = get_option('mistplayer_defaults'); 
  // give info why the player is not dipslayed, in case not settings are defined
  if((($default_info['http'] == null) && ($attr['http'] == null)) || ($attr['stream'] == null)){
    return '<h3>Please set http host name(example: "myhost:8080") and stream name(example "bunny")</h3>';
  }
  else{
    extract(shortcode_atts( array(
      'http' => ($attr['http'] ? $attr['http'] : $default_info['http']),
      'https' => ($attr['https'] ? $attr['https'] : $default_info['https']),
      'stream' => ($attr['stream'] ? $attr['stream'] : $default_info['stream']),
      'options_attr' => $attr['opts'],
      'options_default' =>  $default_info['opts'],
      'loadbalancer' => ($attr['loadbalancer'] ? $attr['loadbalancer'] : $default_info['loadbalancer'])
    ), $attr));

    // if load_balancer: contact load balancer address with `/STREAMNAME` (use actual streamname) appended to the URL
    $data = '';
    if($loadbalancer && $loadbalancer != ''){
      $loadb_res = $loadbalancer.'/'.$stream; 
      $ch = curl_init($loadb_res);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      
      $data = curl_exec($ch);
      if(curl_error($ch)) { $data = ''; }
      if($data == 'FULL'){$data = '';}
      curl_close($ch);
    }

    if($options_attr == ''){$options_attr = '{}';}
    if($options_default == ''){$options_default = '{}';}
    $flag_https = true;
    if($https == ''){$flag_https = false;}

   // replace loadbalancer res host name on the http or https 
    if($data !== ''){
      $arr_hosts = [$http, $https];
      foreach ($arr_hosts as $i => $val){
        if($val && $val !== ''){
          if(strpos($val, ':') !== false){
            $temp = explode(":", $val);
            $arr_val = str_replace($temp[0], $data, $temp);
            $new_val = implode(":", $arr_val);
            $arr_hosts[$i] = $new_val;
          }else if(strpos($val, '/') !== false){
            $temp = explode("/", $val);
            $arr_val = str_replace($temp[0], $data, $temp);
            $new_val = implode("/", $arr_val);
            $arr_hosts[$i] = $new_val;
          }else{
		  $arr_hosts[$i] = $data;
        }
      }
      $http = $arr_hosts[0];
      $https = $arr_hosts[1];
    }

    // create random id string for each stream
    $id = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(12/strlen($x)) )),1,12);
    $id = esc_attr($stream).'_'.$id;

    return '<div class="mistvideo" id="'.esc_attr($id).'">
      <noscript>
        <a href="http://'.esc_attr($http).'/'.esc_attr($stream).'.html" target="_blank">
          Click here to play this video
        </a>
      </noscript>
      <script>
        function b(){
          let attr_opts_obj = '.$options_attr.';
          let options = '.$options_default.';

          for (let i in attr_opts_obj) {
            options[i] = attr_opts_obj[i];
          }

          options.target = document.getElementById("'.$id.'");
          
          var a = function(){
            mistPlay("' . esc_attr($stream) . '", options);
          };

          
          if (!window.mistplayers) {
            var p = document.createElement("script");
            '.($flag_https ? '
                if (location.protocol == "https:") { p.src = "https://'.esc_attr($https).'/player.js" } 
                else { p.src = "http://'.esc_attr($http).'/player.js" } 
              ' : '
              p.src = "http://'.esc_attr($http).'/player.js";
            ').'
            var timeout = setTimeout(function(){
              options.target.innerHTML = "Failed to load "+p.src;
            },5e3);
            document.head.appendChild(p);
            p.onload = function(){
              clearTimeout(timeout);
              a();
            };
          }else { a(); }
        }
        b();
      </script>
    </div>';
  }
}

add_shortcode('mistplayer', 'mistplayer_shortcode'); 


