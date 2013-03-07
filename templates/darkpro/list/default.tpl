        <div class="contentBox">
            <h3>Compare Tags</h3>
            <p class="teaser">Compare your selected tag {$TAG} with a previous version from the dropdown list.</p>
            <br>
            <form action="{$smarty.server.PHP_SELF}" method="get">
                <input type="hidden" name="page" value="{$smarty.request.page}">
                <input type="hidden" name="action" value="{$smarty.request.action}">
                <input type="hidden" name="project" value="{$smarty.request.project}">
                <input type="hidden" name="tag" value="{$smarty.request.tag}">
                <select class="sel" name="tag2"">
                {foreach from=$TAGS item=tag}
                    <option value="{$tag}"{if $tag == $smarty.request.tag2} selected{/if}>{$tag}</option>
                {/foreach}
                </select>
                <button type="submit" class="submit" id="submit">Compare</button>
            </form>
            <br>
            <div class="contentBox">
            {if is_array($CHANGES)}
            <table>
                <tr>
                    <th>Action</th>
                    <th>File</th>
                </tr>
            {foreach from=$CHANGES item=data}
                <tr class="{cycle values="even,odd"}">
                    <td><img src="site_assets/icons/{$data.kind}_{$data.item}.gif" /></td>
                    <td><a href="{$smarty.server.PHP_SELF}?page={$smarty.request.page}&action=diff&file={$data.file}">{$data.file}</a></td>
                </tr>
            {/foreach}
            </table>
            {/if}
            </div>
        </div>