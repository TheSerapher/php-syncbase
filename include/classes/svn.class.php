<?php

// Make sure we are called from index.php
if (!defined('SECURITY'))
    die('Hacking attempt');

/**
 * Class designed around SVN commands to use as an API between PHP and svn Shell
 * @package SVN
 * @author Sebastian 'Seraph' Grewe
 * @copyright Sebastian Grewe
 * @version 1.0
 * */
class SVN {

    /**
     * @param object $debug Our debugger
     * @param array $config Our configuration from global.inc.php
     * @return none
     */
    function __construct(&$debug, $config) {
        $this->debug = $debug;
        $this->config = $config;
        $this->debug->append("Class loaded", __FILE__, __LINE__, 2, __CLASS__, __METHOD__);
    }

    /**
     * Execute a pre-defined set of SVN commands and assign the output to $this->output
     * @param string $command The command to be executed
     * @param string $project Which project are we running the command for
     * @param string $option1 Optional argument required for some svn calls
     * @param string $option2 Optional argument required for some svn calls
     * @param string $current_tag_url Required for SVN Diff: The current tag URL
     * @param string comment Comment used when creating a new tag
     * @return bool
     */
    private function exec_svn($command, $project, $option1="", $option2="", $option3="") {
        $this->debug->append("Executing SVN $command for $project", __FILE__, __LINE__, 2, __CLASS__, __METHOD__);

        // Security: Escape all arguments prior to sending the command to the shell
        $command = escapeshellcmd($command);
        $project = escapeshellcmd($project);
        $option1 = escapeshellcmd($option1);
        $option2 = escapeshellcmd($option2);
        $option3 = escapeshellcmd($option3);

        // Custom set of commands
        switch ($command) {
            case 'list':
                // No options required
                $cmd = $this->config['svn']['binary'] . ' --xml --username ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['username'] . ' --password ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['password'] . '  --non-interactive list ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['url'] . '/tags 2>&1';
                break;
            case 'info':
                // No options required
                $cmd = $this->config['svn']['binary'] . ' --xml --username ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['username'] . ' --password ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['password'] . ' --non-interactive info ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['checkout'] . ' 2>&1';
                break;
            case 'infotag':
                // $option1 : tag name to fetch information for
                $cmd = $this->config['svn']['binary'] . ' --xml --username ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['username'] . ' --password ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['password'] . ' --non-interactive info ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['url'] . '/tags/' . $option1 . ' 2>&1';
                break;
            case 'diff':
                // $option1 : tag name
                // $option2 : current URL of deployed tag
                $cmd = $this->config['svn']['binary'] . ' --summarize --xml --username ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['username'] . ' --password ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['password'] . ' --non-interactive diff ' . $option2 . ' ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['url'] . '/tags/' . $option1 . ' 2>&1';
                break;
            case 'difftags':
                // $option1 : tag name to compare
                // $option2 : tag name to compare
                $cmd = $this->config['svn']['binary'] . ' --summarize --xml --username ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['username'] . ' --password ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['password'] . ' --non-interactive diff ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['url'] . '/tags/' . $option2 . ' ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['url'] . '/tags/' . $option1 . ' 2>&1';
                break;
            case 'difffiles':
                // $option1 : full file path to diff
                // $option2 : full file path to diff
                $cmd = $this->config['svn']['binary'] . ' --username ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['username'] . ' --password ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['password'] . ' --non-interactive diff ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['url'] . '/tags/' . $option1 . '/' . $option3 . ' ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['url'] . '/tags/' . $option2 . '/' . $option3 . ' 2>&1';
                break;
            case 'switch':
                // $option1 : tag to switch to
                $cmd = $this->config['svn']['binary'] . ' --username ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['username'] . ' --password ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['password'] . '  --non-interactive switch ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['url'] . '/tags/' . $option1 . ' ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['checkout'] . ' 2>&1';
                break;
            case 'copy':
                // $option1 : tag name to copy to
                // $option2 : comment for this commit
                $cmd = $this->config['svn']['binary'] . ' --username ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['username'] . ' --password ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['password'] . ' --non-interactive copy ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['url'] . '/trunk ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['url'] . '/tags/' . $option1 . ' -m "' . $option2 . '" 2>&1';
                break;
            case 'log':
                $cmd = $this->config['svn']['binary'] . ' --revision ' . $option1 . ':HEAD --xml --username ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['username'] . ' --password ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['password'] . ' --non-interactive log ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['url'] . '/trunk 2>&1';
                break;
            case 'logtag':
                // $option1 : revision number to fetch log for
                // $option2 : tag name to fetch log from $option1 revision
                $cmd = $this->config['svn']['binary'] . ' --revision ' . $option1 . ' --xml --username ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['username'] . ' --password ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['password'] . ' --non-interactive log ' . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['url'] . '/tags/' . $option2 . ' 2>&1';
                break;
            default:
                $this->debug->append("Command '$command' not configured", __FILE__, __LINE__, 1, __CLASS__, __METHOD__);
                return false;
                break;
        }

        if ($cmd) {
            exec($cmd, $output, $retval);
        }
        // Make output a string (since we use XML output and wish to load it with SimpleXML)
        $this->output = implode("\n", $output);

        // Simple error handling
        if ($retval != 0) {
            $this->debug->append("SVN Command failed: " . $cmd, __FILE__, __LINE__, 1, __CLASS__, __METHOD__);
            $this->error = $this->output;
            return false;
        } else {
            $this->debug->append("SVN Command succeeded ($cmd): " . $this->output, __FILE__, __LINE__, 3, __CLASS__, __METHOD__);
            return true;
        }
    }

    /**
     * Grab the assigned output
     * @return string
     */
    public function get_output() {
        return $this->output;
    }

    /**
     * Grab the assigned error output
     * @return string
     */
    public function get_error() {
        return $this->error;
    }

    /**
     * Assign the diff between two tags to $this->output
     * @param string $project Project name
     * @param string $new_tag New Tag
     * @return bool 
     */
    public function get_diff($project, $new_tag) {
        $this->debug->append("List diffs for tag $new_tag for project $project", __FILE__, __LINE__, 2, __CLASS__, __METHOD__);
        // Grab the tag version of our local checkout
        if ($this->get_tag_url($project)) {
            $current_tag_url = $this->get_output();
        } else {
            $this->error = "Unable to fetch current URL for project $project";
            return false;
        }
        if ($this->exec_svn('diff', $project, $new_tag, $current_tag_url)) {
            $diff = $this->get_output();
        } else {
            $this->error = "Unable to fetch diff changes for $project : " . $this->get_error();
            return false;
        }
        $xml = simplexml_load_string($diff);
        foreach ($xml->paths->path as $change) {
            $arrChanges[] = array(
                'file' => str_replace($this->config['svn']['url'], "", (string) $change[0]),
                'kind' => (string) $change['kind'],
                'item' => (string) $change['item'],
            );
        }
        $this->output = $arrChanges;
        return true;
    }

    /**
     * Grab changes between two tags
     */
    public function get_compare_tags($project, $tag1, $tag2) {
        $this->debug->append("List diffs between tag $tag1 and $tag2 for project $project", __FILE__, __LINE__, 2, __CLASS__, __METHOD__);
        // Grab the tag version of our local checkout
        if ($this->exec_svn('difftags', $project, $tag1, $tag2)) {
            $diff = $this->get_output();
        } else {
            $this->error = "Unable to fetch diff changes for $project : " . $this->get_error();
            return false;
        }
        $xml = simplexml_load_string($diff);
        foreach ($xml->paths->path as $change) {
            $arrChanges[] = array(
                'file' => ereg_replace('.*/' . $project . '/tags/' . $tag2 . "(/)?", "/", (string) $change[0]),
                'kind' => (string) $change['kind'],
                'item' => (string) $change['item'],
            );
        }
        $this->output = $arrChanges;
        return true;
    }

    /**
     * Grab changes between two tags
     */
    public function get_compare_files($project, $tag1, $tag2, $file) {
        $this->debug->append("List diffs between tag $tag1 and $tag2 for project $project", __FILE__, __LINE__, 2, __CLASS__, __METHOD__);
        // Grab the tag version of our local checkout
        if ($this->exec_svn('difffiles', $project, $tag1, $tag2, $file)) {
            $diff = $this->get_output();
        } else {
            $this->error = "Unable to fetch diff changes for $project : " . $this->get_error();
            return false;
        }
        $this->output = $diff;
        return true;
    }

    /**
     * Assign the current tag version to $this->output
     * @param string $project Project name
     * @return bool
     */
    public function get_current_tag($project) {
        $this->debug->append("Fetching deployed tag for $project", __FILE__, __LINE__, 2, __CLASS__, __METHOD__);
        if ($this->get_tag_url($project)) {
            $url = $this->get_output();
            $this->output = basename(parse_url($url, PHP_URL_PATH));
            return true;
        } else {
            $this->debug->append("Failed to read URL for $project", __FILE__, __LINE__, 1, __CLASS__, __METHOD__);
            return false;
        }
    }

    /**
     * Assign the URL of the checkout to $this->output for later parsing/usage
     * @param string $project Project name
     * @return bool 
     */
    private function get_tag_url($project) {
        $this->debug->append("Fetching tag URL for $project in " . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['checkout'], __FILE__, __LINE__, 2, __CLASS__, __METHOD__);
        if (!is_dir($this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['checkout'])) {
            $this->debug->append($this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project] . " is not a local checkout", __FILE__, __LINE__, 1, __CLASS__, __METHOD__);
            $this->error = $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project] . " is not a local checkout in " . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project]['checkout'] . "/" . $this->config['svn']['projects'][$_SERVER['SERVER_NAME']][$project];
            return false;
        }
        if ($this->exec_svn('info', $project)) {
            $xml = simplexml_load_string($this->get_output());
            $this->debug->append("URL : " . $xml->entry->url, __FILE__, __LINE__, 3, __CLASS__, __METHOD__);
            $this->output = $xml->entry->url;
            return true;
        }
        return false;
    }

    /**
     * Get all stored tags for a project
     * @param string $project Project name
     * @return array
     */
    public function get_tags($project) {
        $this->debug->append("Fetching tags for project $project", __FILE__, __LINE__, 2, __CLASS__, __METHOD__);
        if ($this->exec_svn('list', $project)) {
            $tags = $this->get_output();
        } else {
            $this->error = "Unable to fetch tags from $project/tags/";
            return false;
        }
        $xml = simplexml_load_string($tags);
        if (empty($xml->list->entry)) {
            $this->debug->append("No tags found for project $project", __FILE__, __LINE__, 1, __CLASS__, __METHOD__);
            $this->error = "No tags found for project $project";
            return false;
        }
        foreach ($xml->list->entry as $data) {
            $arrTags[(string) $data->name] = array(
                'name' => (string) $data->name,
                'author' => (string) $data->commit->author,
                'date' => date("Y-m-d_h:m:s", strtotime((string) $data->commit->date)),
            );
        }
        // Tags are read from oldest do newest, reverse order to get newest to oldest
        return array_reverse($arrTags);
    }

    public function svn_switch($project, $tag) {
        $this->debug->append("Switching to tag $tag for project $project", __FILE__, __LINE__, 2, __CLASS__, __METHOD__);
        if (!$this->exec_svn('switch', $project, $tag)) {
            $this->error = "Unable to switch to new SVN tag $tag for project $project. SVN returned: " . $this->get_error();
            return false;
        }
        return true;
    }

    public function create_tag($project, $version, $comment) {
        $this->debug->append("Creating new tag $version for project $project", __FILE__, __LINE__, 2, __CLASS__, __METHOD__);
        if (!$arrTags = $this->get_tags($_REQUEST['project'])) {
            $this->error = "Unable to fetch tags : " . $this->get_error();
            return false;
        }
        if (!array_key_exists($version, $arrTags)) {
            if (!$this->exec_svn('copy', $project, $version, "TAG : " . $comment)) {
                $this->error = "Failed to create new tag $version for project $project. SVN Returned: " . $this->get_error();
                return false;
            }
        } else {
            $this->error = "Tag $version seems to exist already.";
            return false;
        }
        return true;
    }

    /**
     * Get the revision from the info output
     * @param string $output
     * @return int
     */
    private function get_revision($output) {
        $xml = simplexml_load_string($output);
        return (int) $xml->entry->commit->attributes()->revision;
    }

    /**
     * Fetch a list of commit messages since last tag
     * @param string $project
     * @param string $tag 
     */
    public function get_comments($project, $tag) {
        $this->debug->append("Fetching commit messages since last tag $tag for project $project", __FILE__, __LINE__, 2, __CLASS__, __METHOD__);
        // Load revision of tag to compare trunk against
        if ($this->exec_svn('infotag', $project, $tag)) {
            if (!$revision = $this->get_revision($this->output)) {
                $this->error = "Failed to fetch revision for tag $tag : " . $this->get_error();
                return false;
            }
        } else {
            $this->error = "Failed to fetch information for tag $tag : " . $this->get_error();
            return false;
        }
        if ($this->exec_svn('log', $project, $revision)) {
            $xml = simplexml_load_string($this->output);
            foreach ($xml->logentry as $entry) {
                $arrLog[] = array(
                    'author' => (string) $entry->author,
                    'msg' => htmlspecialchars((string) $entry->msg),
                    'date' => date("Y-m-d h:m:s", strtotime((string) $entry->date)),
                );
            }
        } else {
            $this->error = "Failed to fetch log for project $project for trunk from revision $revision to HEAD : " . $this->get_error();
            return false;
        }
        return $arrLog;
    }

    /**
     * Fetch a list of commit messages since last tag
     * @param string $project
     * @param string $tag 
     */
    public function get_comment_tag($project, $tag) {
        $this->debug->append("Fetching commit messages since last tag $tag for project $project", __FILE__, __LINE__, 2, __CLASS__, __METHOD__);
        // Load revision of tag to compare trunk against
        if ($this->exec_svn('infotag', $project, $tag)) {
            if (!$revision = $this->get_revision($this->output)) {
                $this->error = "Failed to fetch revision for tag $tag : " . $this->get_error();
                return false;
            }
        } else {
            $this->error = "Failed to fetch information for tag $tag : " . $this->get_error();
            return false;
        }
        if ($this->exec_svn('logtag', $project, $revision, $tag)) {
            $xml = simplexml_load_string($this->output);
            return $xml->logentry->msg;
        } else {
            $this->error = "Failed to fetch log for project $project for trunk from revision $revision : " . $this->get_error();
            return false;
        }
    }

}

if (!file_exists($config['svn']['binary'])) {
    die('Unable to locate your SVN binary : ' . $config['svn']['binary'] . '. Please check your configuration.');
}

// Instantiate this class
$svn = new SVN($debug, $config);
?>
