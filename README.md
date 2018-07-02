# Annonces

Annonces is a WordPress plugin. It display announces posted in your WordPress interface on a Google map.

## Getting Started
### Prerequisites
You need a website on WordPress CMS.

### Installing
- In your backadmin, go to "Plugins" pannel
- Install the plugin Annonces
- Install required plugin : ACF Free and update it to version 5.x.x
- Activate plugins Annonces and ACF

## How to use

### Shortcodes
Display the Google Map in a page with the shortcode :
```
[annonces]
```
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
function mytheme_set_marker_data($filter_title) {
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
