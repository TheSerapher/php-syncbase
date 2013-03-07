<?php

// Make sure we are called from index.php
if (!defined('SECURITY'))
    die('Hacking attempt');

// Fetch our configured projects from configuration
foreach ($config['svn']['projects'][$_SERVER['SERVER_NAME']] as $repository => $data) {
    $debug->append("is_dir :  " . $data['checkout'], __FILE__, __LINE__, 3);
    if (is_dir($data['checkout'])) {
        // Does a checkout exist for this project
        $projects[$repository] = $repository;
    } else {
        // No checkout available
        $nocheckout .= " $repository,";
    }
}

if (is_array($projects)) {
    $smarty->assign("PROJECTS", $projects);
} else {
    $smarty->assign("ERROR", "No projects configured for this Host : " . $_SERVER['SERVER_NAME']);
}


if (!empty($nocheckout)) {
    $smarty->assign("ERROR", "No checkout available for projects : $nocheckout");
}

// Tempalte specifics
$smarty->assign("SUBTITLE", "Create Tag");                  // Create subtitle
$smarty->assign("FORMACTION", "create");                        // Our action for the global template
$smarty->assign("CONTENT", "../global/select_project.tpl");    // Use global template
?>