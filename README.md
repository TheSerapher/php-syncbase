Description
===========

Sync.Base can be used to deploy SVN repositories to a webhost. It is
using a locally installed SVN binary for all commands.

You can find the official project homepage and screenshots here:

* http://www.grewe.ca/projects/php/syncbase/

Features
========

* Project Configuration per Virtual Host (e.g. syncbase.example.com)
* Multiple projects per Virtual Host
* Fully customizable templates using Smarty
* Create new Tags for a project
* List all Tags for a project and compare the changes between tags
* Full version listing of all configured projects
* Deploy a newly created tag to a site
* Use Basic Authentication to pass through to SVN or configure fixed
  usernames and passwords

Requirements
============

* Installed SVN binary
* For each project you need to have a tag already deployed for Sync.Base
  to pick it up, e.g. by uploading the checkout to your project location
  on the Webserver
* Each project requires Sync.Base to have full read and write access to
  the code deployed by SVN

Limitations
===========

* Sync.Base only supports on-site checkouts on the same server
* Database updates are not done automatically by Sync.Base

Installation
============

Installation of Sync.Base is fairly simple:

# Download the Sync.Base Source (90)
# Upload source to your webserver
# Make syncbase/templates/compile writeable by the Webserver
# Upload a tag for a project to your webserver
# Configure your projects in syncbase/include/config/global.inc.php
# Test your settings by getting the Version listing for your configured
  projects

License and Author
==================

Author:: Sebastian Grewe (<sebastian.grewe@gmail.com>) 
Website:: http://www.grewe.ca

Copyright:: 2013, Sebastian Grewe

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
