        <div class="contentBox">
            <div class="contentBoxText">
            {if is_array($TAGS)}
            <h1>Tag Overview</h1>
            <p class="teaser"><b>{$smarty.request.project}</b> selected, please chose a tag</p>
            <form id="form" action="{$smarty.server.PHP_SELF}" method="get">
                <input type="hidden" name="page" value="syncbase" />
                <input type="hidden" name="action" value="validate" />
                <input type="hidden" name="project" value="{$smarty.request.project}">
            <table>
                <tr>
                    <td>
                        <select name="tag" class="sel">
                {foreach from=$TAGS item=data}
                    {if $data.name > $TAG}
                        <option value="{$data.name}">{$data.name}_UPDATE_{$data.author}_{$data.date}</option>
                    {else if $data.name == $TAG}
                        <option value="{$data.name}" SELECTED>{$data.name}_CURRENT_{$data.author}_{$data.date}</option>
                    {else}
                        <option value="{$data.name}">{$data.name}_ROLLBACK_{$data.author}_{$data.date}</option>
                    {/if}
                    
                {/foreach}
                        </select>
                    </td>
                    <td><button type="submit" class="submit" id="submit">Validate</button></td>
                </tr>
                </table>
            </form>
            {/if}
            </div>
        </div>