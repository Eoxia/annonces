# Annonces

Annonces is a WordPress plugin. It display announces posted in your WordPress interface on a Google map.

## Getting Started
### Prerequisites
- CMS : https://wordpress.org/
- Plugin : https://fr.wordpress.org/plugins/advanced-custom-fields/
- GoogleMaps : https://developers.google.com/maps/documentation/javascript/get-api-key

### Installing
- In your backadmin, go to "Plugins" pannel
- Install the plugin Annonces
- Install required plugin : ACF Free and update it to version 5.x.x
- Activate plugins Annonces and ACF

## How to use
1) Download the plugin
2) Active the plugin
3) Follow the informations
4) Create your first annonce
5) Choose the category, pin-color
6) View you annonce
7) View all the annonces put the shortcode in a page

### Shortcodes
[annonces] : Display the Google Map in a page with the shortcode :

### Filters
#### Change metadatas in infowindow of map
```
add_filter('set_marker_data', 'mytheme_set_marker_data', 10, 2);
function mytheme_set_marker_data($microdata, $annonce_id) {
    // datas
    return $microdata;
}
```
#### Change title of filter bloc over the map
```
add_filter('bloc_filter_title', 'mytheme_set_filter_title', 10, 1);
function mytheme_set_filter_title($filter_title) {
    // datas
    return $filter_title;
}
```
### Template
You can create single-announces.php in your child theme to edit the single page of announce : [code for the single-annouce.php](https://github.com/Eoxia/annonces/blob/master/modules/annonce/view/single-announce.php)

### ACF
- Width the ACF plugin, you can create or import fields to personalize your announces.
- Edit the templates as explain above.
- You will obtain custom announces which will suit your project

## Versioning
We use [SemVer](https://semver.org/) for versioning. For the versions available, see the tags on this repository.
