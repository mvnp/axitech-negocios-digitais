<?php

// options helper
require_once QODE_CORE_ABS_PATH . '/helpers/select-options-helper.php';

//load lib
require_once QODE_CORE_ABS_PATH . '/lib/post-type-interface.php';
require_once QODE_CORE_ABS_PATH . '/lib/shortcode-interface.php';

// load modules
require_once QODE_CORE_ABS_PATH . '/modules/google-fonts.php';
require_once QODE_CORE_ABS_PATH . '/modules/like/load.php';

//load post-post-types
require_once QODE_CORE_ABS_PATH . '/post-types/load.php';

//load shortcodes
require_once QODE_CORE_ABS_PATH . '/modules/shortcodes/load.php';

// load widgets
require_once QODE_CORE_ABS_PATH . '/modules/widgets/load.php';

if ( file_exists( QODE_CORE_ABS_PATH . '/core-dashboard' ) ) {
    require_once 'core-dashboard/load.php';
}
