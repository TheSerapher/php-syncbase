<?php
// Make sure we are called from index.php
if (!defined('SECURITY'))
    die('Hacking attempt');

if ($svn->get_diff($_REQUEST['project'], $_REQUEST['tag'])) {
    // Try to get the changed files since last tag
    $changes = $svn->get_output();
} else {
    // It failed, display the error
    $error = 1;
    $smarty->assign("ERROR", "Failed to fetch diff for current tag vs. new tag: " . $svn->get_error());
}

if (empty($changes) && $error != 1) {
    // We have no changes and we have no error, show the no changes template
    $smarty->assign("CONTENT",$_REQUEST['page'] . "/" . $_REQUEST['action'] . "/nochanges.tpl");
} else if ($error != 1) {
    // We had no error and we have changes, display them
    $smarty->assign("CHANGES", $changes);
}

// Template specifics
$smarty->assign("SUBTITLE", "Deploy Tag");          // Create subtitle
$smarty->assign("CONTENT", "default.tpl");     // Load local template
?>