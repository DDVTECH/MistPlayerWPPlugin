=== MistPlayer ===
Contributors: pskpetya
Tags: 'media server', 'metaplayer'
Donate: https://mistserver.org
Requires at least: 1.0
Tested up to: 1.0
Stable tag: 1.0
Requires PHP: 7.0
License: Unlicense
License URI: https://unlicense.org/

MistPlayer is a MistServer Meta-Player which allows you to embed the highly-efficient, scalable and reliable MistServer Meta-Player (that connects to your MistServer instance) into your WordPress website.  MistServer is a full-featured, next-generation streaming media toolkit for OTT (internet streaming), designed to be ideal for developers and system integrators.

== Installation ==
Steps: 

1. Activate mistplayer plugin through the "Plugins" menu in WordPress dashboard

2. In your wp-admin page (accessed through the url or simply clicking on dashboard from your username icon), go to `settings`->`MistPlayer` default values can be set for all future or past posts. HTTP host value is required, the rest is optional. 
The HTTP host value needs to point towards the HTTP address of your running MistServer (default port `8080`). 

3. Setting up specific stream: You need to add your MistPlayer as a 'shortcode' element and there can set different individual settings. Stream name is required. Example `[mistplayer stream="bunny"]`.
In the case the HTTP value needs to be different or is not set  you can set it in addition with the short code, example: `[mistplayer stream="bunny" http="mistserver.org"]`

**HTTPS**
In order to use HTTPS MistServer needs to have HTTPS set up either directly or as reverse proxy. Please read upon documention to set those up [here](https://docs.mistserver.org/howto/https/). The HTTPS host value needs to point towards the HTTPS address of your running MistServer.

**Optional player options**
Optional player options can be passed as an array. These will determine default player behaviour, like setting a specific with or having it start muted. A list of options is available from the settings page.

**Load balancer**
If you have a MistServer load balancer you can have the wordpress plugin work in combination with MistServer. Fill in your load balancer address to use it automatically.


== Changelog ==

= 1.0 =
* Initial version
