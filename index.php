<?php
// Our security check to ensure all files run through index.php
define("SECURITY", 1);

// Include our configuration (holding defines for the requires)
require_once('include/config/global.inc.php');

// Load Classes, they name defines the $ variable used
// We include all needed files here, even though our templates could load them themself
require_once(CLASS_DIR . '/debug.class.php');
require_once(CLASS_DIR . '/svn.class.php');
require_once(INCLUDE_DIR . '/smarty.inc.php');

// Create our pages array from existing files
if (is_dir(INCLUDE_DIR . '/pages/')) {
    foreach (glob(INCLUDE_DIR . '/pages/*.inc.php') as $filepath) {
        $filename = basename($filepath);
        $pagename = substr($filename, 0, strlen($filename) - 8);
        $arrPages[$pagename] = $filename;
        $debug->append("Adding $pagename as " . $filename . " to accessible pages", __FILE__, __LINE__, 4);
    }
}

// Set a default action here if no page has been requested
$page = isset($_REQUEST['page']) && isset($arrPages[$_REQUEST['page']]) ? $_REQUEST['page'] : 'home';

// Create our pages array from existing files
if (is_dir(INCLUDE_DIR . '/pages/' . $page)) {
    foreach (glob(INCLUDE_DIR . '/pages/' . $page . '/*.inc.php') as $filepath) {
        $filename = basename($filepath);
        $pagename = substr($filename, 0, strlen($filename) - 8);
        $arrActions[$pagename] = $filename;
        $debug->append("Adding $pagename as " . $filename . ".inc.php to accessible actions", __FILE__, __LINE__, 4);
    }    
}
// Default to empty (nothing) if nothing set or not known
$action = isset($_REQUEST['action']) && isset($arrActions[$_REQUEST['action']]) ? $_REQUEST['action'] : "";

// TODO: Add more ways to handle infinite amounts of subactions for pages
 
// Load the page code setting the content for the page OR the page action instead if set

if (!empty($action)) {
    $debug->append('Loading Action: ' . $action . ' -> ' . $arrActions[$action], __FILE__, __LINE__, 2);
    require_once(PAGES_DIR . '/' . $page . '/' . $arrActions[$action]);
} else {
    $debug->append('Loading Page: ' . $page . ' -> ' . $arrPages[$page], __FILE__, __LINE__, 2);
    require_once(PAGES_DIR . '/' . $arrPages[$page]);
}

// For page content inclusion
$smarty->assign('PAGE', $page);
$smarty->assign('ACTION', $action);

// Load our debug inforation 
$debug->append("Loading debug information into template", __FILE__, __LINE__, 4);
$smarty->assign('DebuggerInfo', $debug->getDebugInfo());

// Display our master template assuming all sub-routines loaded the content properly
if (!@$supress_master)
    $smarty->display("master.tpl");
?>