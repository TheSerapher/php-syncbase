<?php

// Make sure we are called from index.php
if (!defined('SECURITY'))
    die('Hacking attempt');

// Tempalte specifics
$smarty->assign("SUBTITLE", "Home");                // Create subtitle
$smarty->assign("CONTENT", "default.tpl");     // Use local template
?>