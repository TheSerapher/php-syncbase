<?php
// Make sure we are called from index.php
if (!defined('SECURITY'))
    die('Hacking attempt');

// Ensure we are running on a local checkout
if (is_dir($config['svn']['projects'][$_SERVER['SERVER_NAME']][$_REQUEST['project']]['checkout'])) {
    // Fetch the tag list for the chose project
    if ($arrTags = $svn->get_tags($_REQUEST['project'])) {
        $smarty->assign("TAGS", $arrTags);
    } else {
        $smarty->assign("ERROR", "No tags found.");
    }

    // Get currently active tag in checkout
    if ($svn->get_current_tag($_REQUEST['project'])) {
        $smarty->assign("TAG", $svn->get_output());
    }
} else {
    $smarty->assign("ERROR", "No local checkout found.");
}

// Template specifics
$smarty->assign("SUBTITLE", "Deploy Tag");      // Create subtitle
$smarty->assign("CONTENT", "default.tpl");     // Load local template
?>