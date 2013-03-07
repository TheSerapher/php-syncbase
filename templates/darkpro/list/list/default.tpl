        <div class="contentBox">
            <div class="contentBoxText">
            {if $TAGS}
            <h1>List Tags</h1>
            <p class="teaser"><b>{$smarty.request.project}</b> selected. Here a list of Tags. Click on the tag version to compare with other tags.</p>
            <div id="changes">
            <table>
                <thead>
                    <th>Version</th>
                    <th>Author</th>
                    <th>Date</th>
                    <th>Comment</th>
                </thead>
                {foreach from=$TAGS item=data}
              <tr class="{cycle values="odd,even"}">
                   <td><a href="{$smarty.server.PHP_SELF}?page={$smarty.request.page}&action=compare&project={$smarty.request.project}&tag={$data.name}">{$data.name}</a></td>
                   <td>{$data.author}</td>
                   <td>{$data.date}</td>
                   <td>{$data.comment}</td>
              </tr>
                {/foreach}
            </table>
            </div>
            {/if}
            </div>
        </div>