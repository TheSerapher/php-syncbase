{if !$ERROR}
<div class="contentBox">
            {if is_array($CHANGES)}
            <h1>Validate Tag Information</h1>
            <p class="teaser"><b>{$smarty.request.project}</b> selected, please confirm the file changes and hit deploy</p>
            <div id="changeset">
            <table>
                <tr>
                    <th>Action</th>
                    <th>File</th>
                </tr>
            {foreach from=$CHANGES item=data}
                <tr class="{cycle values="even,odd"}">
                    <td><img src="site_assets/icons/{$data.kind}_{$data.item}.gif" /></td>
                    <td>{$data.file}</td>
                </tr>
            {/foreach}
                <tr>
                    <td colspan="2" align="center">
                        <form id="form" action="{$smarty.server.PHP_SELF}" method="get">
                            <input type="hidden" name="page" value="syncbase" />
                            <input type="hidden" name="action" value="deploy" />
                            <input type="hidden" name="tag" value="{$smarty.request.tag}" />
                            <input type="hidden" name="project" value="{$smarty.request.project}" />
                            <button type="submit" class="submit">Deploy</button>
                        </form>
                    </td>
                </tr>
           </table>
           </div>
           {else}
           <h1>No Changes logged</h1>
           <p class="teaser">No changes between current and selected tag</p>
           {/if}
        </div>
{/if}