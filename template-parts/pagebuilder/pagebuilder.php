<?php

/**
 * Template:			pagebuilder.php
 * Description:			Master template that controls all the pagebuilder templates
 */

if (!in_array('../../../../plugins/advanced-custom-fields-pro/acf.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    //plugin is not active
    return;
}


// Modify this name to the name 
// of the ACF pagebuilder.
$pagebuilder = 'layout';


// Loop over pagebuilder rows
if (have_rows($pagebuilder)) {
    while (have_rows($pagebuilder)) {
        the_row();

        // Get template name
        $template = get_row_layout();

        // Get template with the name of the template
        get_template_part('./template-parts/pagebuilder/pagebuilder', $template);
    }
}
