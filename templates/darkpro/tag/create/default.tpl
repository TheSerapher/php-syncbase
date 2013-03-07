
        <div class="contentBox">
          <h1>Tag Details</h1>
          <p class="teaser">Please enter a new version number and a comment for this new tag.</p>
          <form id="form" action="{$smarty.server.PHP_SELF}" method="get">
            <input type="hidden" name="page" value="tag" />
            <input type="hidden" name="action" value="create" />
            <input type="hidden" name="project" value="{$smarty.request.project}" />
            <table>
                <tr>
                    <td><b>Version</b></td>
                    <td><input type="text" size="5" name="version" class="in" value="{if $smarty.request.version}{$smarty.request.version}{else}Last: {$VERSION}"{/if}" onclick="this.value=''" /></td>
                </tr>
                <tr>
                    <td><b>Comment</b></td>
                    <td><input type="text" size="50" name="comment" value="{if $smarty.request.comment}{$smarty.request.comment}{else}Please enter a comment{/if}" class="in" onclick="this.value=''" /></td>
                </tr>
                <tr>
                    <td align="center" colspan="2"><button type="submit" class="submit">Create</button></td>
                </tr>
             </table>
          </form>
        </div>
        
        <div class="contentBox">
            </br></br>
            <h1>Changes</h1>
            {if is_array($COMMENTS)}
            <table>
                <thead>
                    <th width="70">Author</th>
                    <th width="200">Date</th>
                    <th width="*">Comment</th>
                </thead>
            {foreach from=$COMMENTS item=comment}
                <tr class="{cycle values="odd,even"}">
                    <td>{$comment.author}</td>
                    <td>{$comment.date}</td>
                    <td>{$comment.msg}</td>
                </tr>
            {/foreach}
            </table>
            {else}
                <p>No changes logged since last tag</p>
            {/if}
        </div>
