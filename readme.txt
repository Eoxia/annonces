=== Annonces ===
Contributors: Eoxia
Requires at least: 4.9.0
Tested up to: 4.9.6
Requires PHP: 5.6
Stable tag: 2.0.0
License: AGPLv3
License URI: https://spdx.org/licenses/AGPL-3.0-or-later.html

Annonces display announces posted in your WordPress interface on a Google map.

== Description ==

Annonces display announces posted in your WordPress interface on a Google map.

= Shortcodes =

Display the Google Map in a page with the shortcode :
`
[annonces]
`

= Filters =

= Change metadatas in infowindow of map =
`
add_filter(\'set_marker_data\', \'mytheme_set_marker_data\', 10, 2);
function mytheme_set_marker_data($microdata, $annonce_id) {
    // datas
    return $microdata;
}
`

= Change title of filter bloc over the map =

`
add_filter(\'bloc_filter_title\', \'mytheme_set_filter_title\', 10, 1);
function mytheme_set_marker_data($filter_title) {
    // datas
    return $filter_title;
}
`

= Template =

You can create single-announces.php in your child theme to edit the single page of announce : [code for the single-annouce.php](https://github.com/Eoxia/annonces/blob/master/modules/annonce/view/single-announce.php)

= ACF =

- Width the ACF plugin, you can create or import fields to personalize your announces.
- Edit the templates as explain above.
- You will obtain custom announces which will suit your project

== Installation ==
- In your backadmin, go to \"Plugins\" pannel
- Install the plugin Annonces
- Install required plugin : ACF Free and update it to version 5.x.x
- Activate plugins Annonces and ACF

== Screenshots ==
1. Map with announces
2. description of an announce

== Changelog ==

= 2.0.0 =

= Improvment =

* 19873 - Core remastering functionalities
