<?php
// Make sure we are called from index.php
if (!defined('SECURITY'))
    die('Hacking attempt');

// Try to create the tag if user supplied the infos, display error and form if failed
if ($_REQUEST['version'] && $_REQUEST['comment']) {
    if (!$svn->create_tag($_REQUEST['project'], $_REQUEST['version'], $_REQUEST['comment'])) {
        $smarty->assign("ERROR", "Failed to create tag for " . $_REQUEST['project'] . " : " . $svn->get_error());
    } else {
        $smarty->assign("OK", "Tag created.");
    }
}

// Get latest Tag to add to the input field
if ($arrTags = $svn->get_tags($_REQUEST['project'])) {
    // Also get our comments since the last tag
    $smarty->assign("COMMENTS", $svn->get_comments($_REQUEST['project'], key($arrTags)));
    $smarty->assign("VERSION", key($arrTags));
}

// Template specifics
$smarty->assign("SUBTITLE", "Create Tag");              // Create subtitle
$smarty->assign("CONTENT", "default.tpl");     // Load local template
?>