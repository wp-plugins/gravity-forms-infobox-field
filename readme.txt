=== Infobox field for Gravity Forms ===
Contributors: ovann86
Donate link: http://www.itsupportguides.com/
Tags: gravity forms
Requires at least: 4.1
Tested up to: 4.2.4
Stable tag: 1.2.5
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Extends the Gravity Forms plugin - adding an infobox field that can be used to display information throughout the form.

== Description ==

This plugin extends the Gravity Forms plugin - adding an infobox field that can be used to display information throughout the form.

Infoboxes can be placed anywhere in a form, like you would any other form field.

Each infobox can be styled using the 'Infobox type' field, options include  - help, note, critical, warning, information and highlight.

== Installation ==

1. This plugin requires the Gravity Forms plugin, installed and activated
2. Install plugin from WordPress administration or upload folder to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in the WordPress administration
4. Open the form you want to add an infobox to
5. In the 'Standard fields' section you will find a new field option - 'Infobox'
6. Add the field to the location required
7. Use the 'Field Label' field for the infobox title
8. Use the 'Infobox type' field to select a style
9. Use the 'Description' field for the infobox text
10. Use the 'More information' field for additional infobox text - this text will be hidden by default and expanded when the user clicks on the 'More information' link

== Frequently Asked Questions ==

= How do I apply my own styles? =

You can override infobox styles by applying your own CSS class name to the field then add desired CSS code to your theme's CSS file.

For example, if you apply the CSS class name of custombox - you would add the following CSS to your theme's CSS file.

.custombox.gform_infobox {
    background: white;
}

This will give this infobox a white background.

= How to use with Gravity PDF (previously Gravity Forms PDF extended) =

To exclude the infoboxes from PDF's created using Gravity PDF ensure that the Infobox has a Custom CSS Class of 'exclude'.

This can be added in the form editor in the 'Appearance' tab.

== Screenshots ==

1. This screen shot shows several infoboxes in a form. There are six different styles that can selected. More information can be displayed in a text area that is hidden until the user clicks on the 'More information' link.
2. This screen shot shows the infobox options in the form editor.
3. This screen shot shows the infobox button, in the 'Standard Fields' section.

== Changelog ==

= 1.2.5 =
* FIX: Add 'data-type' property to Infobox button in form editor - provides support for old and new versions of Gravity Forms.
* MAINTENANCE: Place CSS and images into their own directories.
* MAINTENANCE: Change CSS to load using wp_enqueue_style
* MAINTENANCE: Change name from 'Gravity Forms - Infobox field' to 'Infobox field for Gravity Forms'
* MAINTENANCE: Resolve various PHP errors that were appearing in debug mode, but did not affect functionality.
* MAINTENANCE: Change constructor so plugin load is delayed using the 'plugins_loaded' action - this ensures the plugin loads after Gravity Forms has loaded and functions correctly.

= 1.2.4 =
* FIX: 'More information' link was not keyboard accessible.

= 1.2.3 =
* FIX: Modified JavaScript for 'More Information' click so that it will work in older versions of Internet Explorer (e.g. IE9).

= 1.2.2 =
* IMPROVEMENT: Added default 'Custom CSS Class' of 'exclude' so that the Infobox field does not appear in PDF's created using the Gravity PDF plugin (previously Gravity Forms PDF extended).

= 1.2.1 =
* FIX: 'Infobox type' and 'More information' fields not displaying saved data on reload.
* IMPROVEMENT: Changed More information text area to display with inline-block, rather than block - this allows for more complicated HTML to be included in the More information text area, such as tables.
* IMPROVEMENT: Added CSS styles to give tables inside of the More information text area a white background and slight padding on th and td.

= 1.0 =
* First public release.

== Upgrade Notice ==

= 1.2.1 =
Fixes 'Infobox type' and 'More information' fields not displaying saved data on reload.