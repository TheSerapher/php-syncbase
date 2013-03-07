<?php

// Make sure we are called from index.php
if (!defined('SECURITY'))
    die('Hacking attempt');

// Ensure we are running on a local checkout
$debug->append("is_dir :  " . $config['svn']['projects'][$_SERVER['SERVER_NAME']][$_REQUEST['project']]['checkout']);

if (is_dir($config['svn']['projects'][$_SERVER['SERVER_NAME']][$_REQUEST['project']]['checkout'])) {
    // Fetch the tag list for the chose project
    if ($arrTags = $svn->get_tags($_REQUEST['project'])) {
        foreach ($arrTags as $tag => $data) {
            $arrTags[$tag]['comment'] = $svn->get_comment_tag($_REQUEST['project'], $tag);
        }
        $smarty->assign("TAGS", $arrTags);
    } else {
        $smarty->assign("ERROR", "No tags found.");
    }
} else {
    $smarty->assign("ERROR", "No local checkout found.");
}

// Tempalte specifics
$smarty->assign("SUBTITLE", "List Tags");                  // Create subtitle
$smarty->assign("ACTION", "details");                          // Our action for the global template
$smarty->assign("CONTENT", "default.tpl");     // Load local template
?>