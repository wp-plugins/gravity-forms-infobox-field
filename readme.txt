=== Gravity Forms - Infobox field ===
Contributors: ovann86
Donate link: http://www.itsupportguides.com/
Tags: gravity forms
Requires at least: 4.1
Tested up to: 4.1
Stable tag: 1.0.1
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Extends the Gravity Forms plugin - adding an infobox field that can be used to display information throughout the form.

== Description ==

This plugin extends the Gravity Forms plugin - adding an infobox field that can be used to display information throughout the form.

Infoboxes can be placed anywhere in a form, like you would any other form field.

Each infobox can be styled using the 'Infobox type' field, options include  - help, note, critical, warning, information and highlight.

== Installation ==

1. This plugin requires the Gravity Forms plugin, installed and activated
1. Install plugin from WordPress administration or upload folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in the WordPress administration
1. Open the form you want to add an infobox to
1. In the 'Standard fields' section you will find a new field option - 'Infobox'
1. Add the field to the location required
1. Use the 'Field Label' field for the infobox title
1. Use the 'Infobox type' field to select a style
1. Use the 'Description' field for the infobox text
1. Use the 'More information' field for additional infobox text - this text will be hidden by default and expanded when the user clicks on the 'More information' link

== Frequently Asked Questions ==

= How do I apply my own styles? =

You can override infobox styles by applying your own CSS class name to the field then add desired CSS code to your theme's CSS file.

For example, if you apply the CSS class name of custombox - you would add the following CSS to your theme's CSS file.

.custombox.gform_infobox {
    background: white;
}

This will give this infobox a white background.

== Screenshots ==

1. This screen shot shows several infoboxes in a form. There are six different styles that can selected. More information can be displayed in a text area that is hidden until the user clicks on the 'More information' link.
2. This screen shot shows the infobox options in the form editor.
3. This screen shot shows the infobox button, in the 'Standard Fields' section.

== Changelog ==

= 1.0.1 =
* FIX: 'Infobox type' and 'More information' fields not displaying saved data on reload.
* IMPROVEMENT: Changed More information text area to display with inline-block, rather than block - this allows for more complicated HTML to be included in the More information text area, such as tables.
* IMPROVEMENT: Added CSS styles to give tables inside of the More information text area a white background and slight padding on th and td.

= 1.0 =
* First public release.

== Upgrade Notice ==

= 1.0.1 =
* FIX: 'Infobox type' and 'More information' fields not displaying saved data on reload.
* IMPROVEMENT: Changed More information text area to display with inline-block, rather than block - this allows for more complicated HTML to be included in the More information text area, such as tables.
* IMPROVEMENT: Added CSS styles to give tables inside of the More information text area a white background and slight padding on th and td.