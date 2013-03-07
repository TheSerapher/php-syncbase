<?php

// Make sure we are called from index.php
if (!defined('SECURITY'))
    die('Hacking attempt');

// What is our overall theme
define('THEME', 'darkpro');

// Our include directory for additional features
define('INCLUDE_DIR', 'include');

// Our class directory
define('CLASS_DIR', INCLUDE_DIR . '/classes');

// Our pages directory which takes care of
define('PAGES_DIR', INCLUDE_DIR . '/pages');

// Set debugging level for our debug class
define('DEBUG', 0);

// Our configuration
$config = array(
    'svn' => array(
        'binary' => '/usr/bin/svn',                             // Full path to your SVN binary
        'projects' => array(
            'localhost' => array(                               // VHost Name, various projects running under this vhost
                'syncbase' => array(                            // Project name
                    'checkout' => '../syncbase',                // Local Checkout location, relative or full
                    'url' => 'http://svn.example.com/syncbase', // Base URL to your SVN Project
                    'username' => @$_SERVER['PHP_AUTH_USER'],   // Username to login to SVN, default to HTTP_AUTH
                    'password' => @$_SERVER['PHP_AUTH_PW'],     // Pasword to login to SVN, defaults to HTTP_AUTH
                ),
            ),
        ),
    ),
);
?>
