<?php

// Make sure we are called from index.php
if (!defined('SECURITY'))
    die('Hacking attempt');

$debug->append('Loading Smarty libraries', __FILE__, __LINE__, 2);
define('SMARTY_DIR', INCLUDE_DIR . '/smarty/libs/');

// Include the actual smarty class file
include(INCLUDE_DIR . '/smarty/libs/Smarty.class.php');

// We initialize smarty here
$debug->append('Instantiating Smarty Object', __FILE__, __LINE__, 3);
$smarty = new Smarty;

// Assign our local paths
$debug->append('Define Smarty Paths', __FILE__, __LINE__, 3);
$smarty->template_dir = 'templates/' . THEME . '/';
$smarty->compile_dir = 'templates/compile/';
$smarty->plugins_dir[] = INCLUDE_DIR . '/smarty/plugins/';
$smarty->cache_dir = "templates/cache";
$smarty->caching = 0;
?>
