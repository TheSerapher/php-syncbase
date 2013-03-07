<div class="contentBox">
    <div class="contentBoxText">
        <h1>Syncbase Mini-Howto</h1>
        <p>A quick overview how to use SyncBase. For more information please go to http://www.grewe.ca</p>
        <h2>Tag Creation</h2>
        <p>Creating a new tag that can be deployed to the live site is very easy and can either be done via command line, Tortoise SVN or the WebGUI.
            We recommend using the WebGUI if you are not familiar with the creation of tags (which is a simple svn copy from trunk to tags).
            You can access the tag creation page right <a href="?page=tag">here</a>.
            Please also leave a comment that sums up all the changes that were merged into trunk since the last tag was created.
            When creating a new tag the version input field should hold the lastest tag version that was created.
            When assigning a new version to a tag please keep the ''x.y.z'' notation for the versioning.
            It will ensure that Syncbase properly orders the version numbers.</p>
        <h2>Deploy Tag to Live Site</h2>
        <p>When you created the tag you can access the!SyncBase that allows you to deploy the tag into the live site.
            Simply browse to <a href="?page=syncbase">SyncBase Deploy Tag</a> and select your product.
            You will be offered with all tags that are on the SVN and you can chose to either UPDATE or ROLLBACK an update (keep in mind: Database updates are not rolled back by SyncBase and need to be done manually with a backup!).
            Once you have chose a tag you need to validate that the changes listed are the ones you would expect by this tag.
            As soon as you hit *Deploy* your changes are added to the live site and will show right away.</p>
        <h2>Version Checking</h2>
        <p>You can get a quick overview of all your checkouts and their version at the <a href="?page=versions">Versions page</a>.
            It will list all your checkouts, their most recent version found in tags and the currently deployed version.
            By clicking on the project name you will be sent directly to the deployment page for this project.</p>
        <h2>Database Updates</h2>
        <p>As mentioned before database updates are not handled by SyncBase.
            Too many things could potentially go wrong if this is done via a script so we leave database updates to the developers.
            Each update (like ALTER TABLE or UPDATE) needs to go into a SQL file.
            This file can be stored into the trunk of a product in a subfolder called SQL.
            Each developer can then add their update commands into this file.
            Once a tag is deployed this file should contain all the updates necessary and only needs to be imported via phpMyAdmin into the database in question.
            This might seem cumbersome at first but rest assured that later in development not a whole lot will change in a Database.</p>
    </div>
</div>