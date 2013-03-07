        <div class="contentBox">
            <div class="contentBoxText">
                <table>
                    <thead>
                        <th>Repository</th>
                        <th>Deployed Version</th>
                        <th>Current Version</th>
                    </thead>
                    {foreach from=$PROJECTS key=name item=data}
                        <tr class="{cycle values="odd,even"}">
                            <td><a href="{$smarty.server.PHP_SELF}?page=syncbase&action=tags&project={$data.name}">{$data.name}</a></td>
                            <td><font color="{if $data.current != $data.version}red{else}green{/if}">{$data.version}</font></td>
                            <td>{$data.current}</td>
                        </tr>
                    {/foreach}
                </table>
            </div>
        </div>