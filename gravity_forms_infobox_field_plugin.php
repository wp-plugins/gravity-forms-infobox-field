<?php
/*
Plugin Name: Gravity Forms - Infobox field
Version: 1.2.3
Description: Extends the Gravity Forms plugin, adding an infobox field that can be used to display information throughout the form.
Author: Adrian Gordon
Author URI: http://www.itsupportguides.com 
License: GPL2
*/

add_action('admin_notices', array('ITSP_GF_Infobox', 'admin_warnings'), 20);

if (!class_exists('ITSP_GF_Infobox')) {
    class ITSP_GF_Infobox
    {
	private static $name = 'Gravity Forms - Infobox field';
    private static $slug = 'itsp_gf_infobox_field';
	private static $version = '1.2.1';
        /**
         * Construct the plugin object
         */
        public function __construct()
        {
            // register actions
            if (self::is_gravityforms_installed()) {
                //start plug in
                add_filter('gform_add_field_buttons', array(&$this,'infobox_add_field') );
				add_filter('gform_field_type_title' , array(&$this,'infobox_title'), 10, 2);
				add_action('gform_editor_js', array(&$this,'infobox_editor_js'));
				add_action('gform_field_standard_settings', array(&$this,'infobox_settings_type') , 10, 2 );
				add_action('gform_field_standard_settings', array(&$this,'infobox_settings_more_info'), 10, 2 );
				add_filter('gform_tooltips', array(&$this,'infobox_tooltip_more_info'));
				add_action('gform_field_css_class', array(&$this,'infobox_custom_class'), 10, 3);
				add_action('gform_enqueue_scripts', array(&$this,'infobox_custom_js'), 90, 3);
				add_filter('gform_field_content', array(&$this,'infobox_display_field'), 10, 5);
            }
        } // END __construct
        
        /**
         * Add infobox field to 'standard fields' group in Gravity Forms forms editor
         */        
        public static function infobox_add_field($field_groups)
        {
            foreach ($field_groups as &$group) {
                if ($group["name"] == "standard_fields") {
                    $group["fields"][] = array(
                        "class" => "button",
                        "value" => __("Infobox", "gravityforms"),
                        "onclick" => "StartAddField('Infobox');"
                    );
                    break;
                }
            }
            return $field_groups;
        } // END infobox_add_field
        
        /**
         * Add title to infobox field, displayed in Gravity Forms forms editor
         */        
        public static function infobox_title($title, $field_type)
        {
            if ($field_type == "Infobox")
                return "Infobox";
        } // END infobox_title
        
        /**
         * JavaSript to add field options to infoxbox field in the Gravity forms editor
         */
        public static function infobox_editor_js()
        {
?>
		<script type='text/javascript'>
			jQuery(document).ready(function($) {
				// standard field options
				fieldSettings["Infobox"] = ".label_setting, .description_setting, .css_class_setting, .infobox_type_field_setting, .infobox_more_info_field_setting, .conditional_logic_field_setting"; 
		 
				//custom field options				
				jQuery(document).bind("gform_load_field_settings", function(event, field, form){
					if ('Infobox' == field['type']) {
					jQuery("#infobox_type_field_setting").val(field["infobox_type_field_setting"] == undefined ? "help" : field["infobox_type_field_setting"]);
					jQuery("#infobox_more_info_field").val(field["infobox_more_info_field"] == undefined ? "" : field["infobox_more_info_field"]);
						if (jQuery("#field_css_class").val() == '') {
							jQuery("#field_css_class").val("exclude");				
						}
					}
				});
			});
		 
		</script>
		<?php
        } // END infobox_editor_js
        
        /**
         * Add infobox 'Type' field, displayed in Gravity Forms forms editor 
         */
        public static function infobox_settings_type($position, $form_id)
        {      
            // Create settings on position 50 (right after Field Label)
            if ($position == 50) {
?>
			<li class="infobox_type_field_setting field_setting">
												<label for="infobox_type_field">
													<?php _e("Infobox type", "gravityforms"); ?>
												</label>
												<select id="infobox_type_field_setting" onBlur="SetFieldProperty('infobox_type_field_setting', this.value);">
													<option value="help"><?php _e("Help", "gravityforms"); ?></option>
													<option value="note"><?php _e("Note", "gravityforms"); ?></option>
													<option value="critical"><?php _e("Critical", "gravityforms"); ?></option>
													<option value="warning"><?php _e("Warning", "gravityforms"); ?></option>
													<option value="info"><?php _e("Information", "gravityforms"); ?></option>
													<option value="highlight"><?php _e("Highlight", "gravityforms");?></option>
												</select>
											</li>
			<?php
            }
        } // END infobox_settings_type
        
		/**
         * Add infobox 'More information' field, displayed in Gravity Forms forms editor 
         */
        public static function infobox_settings_more_info($position, $form_id)
        {
            // Create settings on position 50 (right after Field Label)
            if ($position == 1430) {
?>
		 
			<li class="infobox_more_info_field_setting field_setting">
												<label for="infobox_more_info_field">
												<?php _e("More information", "gravityforms"); ?>
												<?php gform_tooltip("infobox_more_info_field_tooltip");?>
												</label>
												<textarea id="infobox_more_info_field" class="fieldwidth-3 fieldheight-2" onkeyup="SetFieldProperty('infobox_more_info_field', this.value);"></textarea>
											</li>
											
											
			<?php
                
            }
        } // END infobox_settings_more_info
        
		/**
         * Add tooltip for 'More information' field
         */
		public static function infobox_tooltip_more_info($tooltips){
			$tooltips["infobox_more_info_field_tooltip"] = "<h6>More information</h6>Text will be display in an hidden but expandable section below the main description";
			return $tooltips;
		}

        /**
         * Add custom classes to infobox fields, controls CSS applied to field
         */
        public static function infobox_custom_class($classes, $field, $form)
        {
            
            if ($field["type"] == "Infobox") {
                $classes .= " gform_infobox";
            }
            
            if ($field['infobox_type_field_setting'] == "help") {
                $classes .= " gform_infobox_help";
            }
            
            if ($field['infobox_type_field_setting'] == "note") {
                $classes .= " gform_infobox_note";
            }
            
            if ($field['infobox_type_field_setting'] == "critical") {
                $classes .= " gform_infobox_critical";
            }
            
            if ($field['infobox_type_field_setting'] == "info") {
                $classes .= " gform_infobox_information";
            }
            
            if ($field['infobox_type_field_setting'] == "warning") {
                $classes .= " gform_infobox_warning";
            }
            
            if ($field['infobox_type_field_setting'] == "highlight") {
                $classes .= " gform_infobox_highlight";
            }
            
            return $classes;
        } // END infobox_custom_class
        
        /**
         * Queue JavaScript and stylesheet for front end
         */
        public function infobox_custom_js()
        {
            add_action('wp_footer', array(&$this,'infobox_custom_js_script'));
        } // END infobox_custom_js
        
		/**
         * JavaScript, when 'More information' is clicked, expands more information
         */
        public static function infobox_custom_js_script()
        {
?>
			<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('itsp_infobox_css.css', __FILE__);?>" media="all" />
				<script>
				jQuery(function ($) {
				$('[class*=gfield_infobox_more_info_]').on('click',function(e){
				$(this).next().toggleClass('gfield_infobox_more_display'); 
					});
				});
			</script>
		 <?php
        } // END infobox_custom_js_script
        
		/**
         * Displays infobox field
         */
        public static function infobox_display_field($content, $field, $value, $lead_id, $form_id)
        {     
            if ((!is_admin()) && ($field['type'] == 'Infobox')) {
                $content = "";
                if ((isset($field["label"])) && ($field["label"]) <> "") {
                    $content .= "<div class='gfield_label'>" . $field["label"] . "</div>";
                }
                if ((isset($field["description"])) && ($field["description"]) <> "") {
                    $content .= "<div class='gfield_description'>" . $field["description"] . "</div>";
                    
                }
                if ((isset($field["infobox_more_info_field"])) && ($field["infobox_more_info_field"]) <> "") {
                    $content .= "<div class='gfield_description gfield_infobox_more_info_" . $field["id"] . " gfield_infobox_more_info_button'>More information</div>";
                    $content .= "<div style='display: none;' class='gfield_description gfield_infobox_more_info_" . $field["id"] . "_box'>" . $field["infobox_more_info_field"] . "</div>";
                    
                }
            } 
            return $content;
        } // END infobox_display_field
        
		/*
         * Warning message if Gravity Forms is installed and enabled
         */
		public static function admin_warnings() {
			if ( !self::is_gravityforms_installed() ) {
				$message = __('Requires Gravity Forms to be installed.', self::$slug);
			} 
			
			if (empty($message)) {
				return;
			}
			?>
			<div class="error">
				<p>
					<?php _e('The plugin ', self::$slug); ?><strong><?php echo self::$name; ?></strong> <?php echo $message; ?><br />
					<?php _e('Please ',self::$slug); ?><a href="http://www.gravityforms.com/"><?php _e(' download the latest version',self::$slug); ?></a><?php _e(' of Gravity Forms and try again.',self::$slug) ?>
				</p>
			</div>
			<?php
		}
        /*
         * Check if GF is installed
         */
        private static function is_gravityforms_installed()
        {
            return class_exists('GFAPI');
        } // END is_gravityforms_installed
    }
    $ITSP_GF_Infobox = new ITSP_GF_Infobox();
}