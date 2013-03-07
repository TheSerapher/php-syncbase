<?php

// Make sure we are called from index.php
if (!defined('SECURITY'))
    die('Hacking attempt');

// Fetch our configured projects from configuration
foreach ($config['svn']['projects'][$_SERVER['SERVER_NAME']] as $repository => $data) {
    // Get currently active tag in checkout
    if ($repotags = $svn->get_tags($repository)) {
        $repotags = reset($repotags);
    } else {
        $smarty->assign("ERROR", $svn->get_error());
    }

    if ($svn->get_current_tag($repository)) {
        $projects[] = array(
            'name' => $repository,
            'version' => $svn->get_output(),
            'current' => $repotags['name'],
        );
    }
}

if (is_array($projects)) {
    $smarty->assign("PROJECTS", $projects);
} else {
    $smarty->assign("ERROR", "No projects configured for this Host : " . $_SERVER['SERVER_NAME']);
}

// Tempalte specifics
$smarty->assign("SUBTITLE", "Create Tag");                  // Create subtitle
$smarty->assign("FORMACTION", "create");                        // Our action for the global template
$smarty->assign("CONTENT", "default.tpl");     // Load local template
?>