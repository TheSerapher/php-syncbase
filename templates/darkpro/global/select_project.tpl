        <div class="contentBox">
          <div class="contentBoxText">
            <h1>Select Project</h1>
            <p class="teaser">Please chose a project from the dropdown list and click Select.</p>
          </div>
          <form id="form" action="{$smarty.server.PHP_SELF}" method="get">
            <table>
                <input type="hidden" name="page" value="{$smarty.request.page}" />
                <input type="hidden" name="action" value="{$FORMACTION}" />
                <tr>
                    <td>
                <select name="project" class="sel" width="300">
                    {foreach from=$PROJECTS key=name item=data}
                        <option value="{$name}">{$name}</option>
                    {/foreach}
                </select>
                    </td>
                    <td><button type="submit" id="submit">Select</button></td>
                </tr>
            </table>
          </form>
        </div>