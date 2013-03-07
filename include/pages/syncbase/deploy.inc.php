<?php

// Make sure we are called from index.php
if (!defined('SECURITY'))
    die('Hacking attempt');

if (!$svn->svn_switch($_REQUEST['project'], $_REQUEST['tag'])) {
    $smarty->assign("ERROR", "Failed to switch to the new tag: " . $svn->get_error());
}
$smarty->assign("SUBTITLE", "Deploy Tag");
$smarty->assign("CONTENT", "default.tpl");
?>