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

MistPlayer is a MistServer Meta-Player which allows you to embed the fantastic, scalable and reliable MistServer Meta-Player (that connects to your MistServer instance) into your WordPress website.  MistServer is a full-featured, next-generation streaming media toolkit for OTT (internet streaming), designed to be ideal for developers and system integrators.

== Description ==
???????
This is the long description.  No limit, and you can use Markdown (as well as in the following sections).
????? do we explain something abt the loadbalancer feature?


For backwards compatibility, if this section is missing, the full length of the short description will be used, and
Markdown parsed.

A few notes about the sections above:

* "Contributors" is a comma separated list of wordpress.org usernames
* "Tags" is a comma separated list of tags that apply to the plugin
* "Requires at least" is the lowest version that the plugin will work on
* "Tested up to" is the highest version that you've *successfully used to test the plugin*
* Stable tag must indicate the Subversion "tag" of the latest stable version

Note that the `readme.txt` value of stable tag is the one that is the defining one for the plugin.  If the `/trunk/readme.txt` file says that the stable tag is `4.3`, then it is `/tags/4.3/readme.txt` that'll be used for displaying information about the plugin.

If you develop in trunk, you can update the trunk `readme.txt` to reflect changes in your in-development version, without having that information incorrectly disclosed about the current stable version that lacks those changes -- as long as the trunk's `readme.txt` points to the correct stable tag.

If no stable tag is provided, your users may not get the correct version of your code.

== Frequently Asked Questions ==

= A question that someone might have =

An answer to that question.

= What about foo bar? =

Answer to foo bar dilemma.

== Installation ==
Steps: 

1. Activate mistplayer plugin through the "Plugins" menu in WordPress dashboard.
2. In your wp-admin page in dashboard->settings->MistPlayer default values can be set for all future or past posts. HTTP host value is required, the rest is optional. 
3. Setting up specific stream: You need to add your MistPlayer as a 'shortcode' element and there can set different individual settings. Stream name is required. Example [mistplayer stream="bunny"].
Http value is required, as well, provided you haven't set it up in the wp-admin page(settings->MistPlayer). Example [mistplayer stream="bunny" http="mistserver.org"]
Optional settings are https and opts: [mistplayer stream="bunny" http="name.org" https="mistserver.org" opts='{muted:true, width: 300}'] 
!Important: please notice, on your dashboard->settings->MistPlayer you add opts as array {muted=true, width=500}. However, when adding the Mistplayer shortcode element opts='{muted:true,width:300}' is in ''
! You can find all the MistPlayer options in our Documentation https://mistserver.org/guides/latest
Another useful feature is [mistplayer loadbalancer="http://example.com:8045"] 
        

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Screenshots are stored in the /assets directory.
2. This is the second screen shot

== Changelog ==

= 1.0 =
* Initial version

== Upgrade Notice ==

= 1.0 =
???Upgrade notices describe the reason a user should upgrade.  No more than 300 characters.

== A brief Markdown Example ==

Markdown is what the parser uses to process much of the readme file.

[markdown syntax]: https://daringfireball.net/projects/markdown/syntax

Ordered list:

1. Some feature
1. Another feature
1. Something else about the plugin

Unordered list:

* something
* something else
* third thing

Links require brackets and parenthesis:

Here's a link to [WordPress](https://wordpress.org/ "Your favorite software") and one to [Markdown's Syntax Documentation][markdown syntax]. Link titles are optional, naturally.

Blockquotes are email style:

> Asterisks for *emphasis*. Double it up  for **strong**.

And Backticks for code:

`<?php code(); ?>`
