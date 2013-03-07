<?php

// Make sure we are called from index.php
if (!defined('SECURITY'))
    die('Hacking attempt');
// Ensure we are running on a local checkout
// Fetch the tag list for the chose project
$arrTags = $svn->get_tags($_REQUEST['project']);
foreach ($arrTags as $tag) {
    $arrTagList[] = $tag['name'];
}

$smarty->assign("TAGS", $arrTagList);
$smarty->assign("TAG", $_REQUEST['tag']);

if (!empty($_REQUEST['tag2'])) {
    // Check for diff between tag and tag2
    if ($svn->get_compare_files($_REQUEST['project'], $_REQUEST['tag'], $_REQUEST['tag2'], $_REQUEST['file'])) {
        $smarty->assign("DIFF", htmlspecialchars($svn->get_output()));
    } else {
        $smarty->assign("ERROR", $svn->get_error());
    }
}
// Tempalte specifics
$smarty->assign("SUBTITLE", "List Tags");                  // Create subtitle
$smarty->assign("CONTENT", "default.tpl");     // Load local template
?>