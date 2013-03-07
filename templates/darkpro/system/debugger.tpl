
{if $DebuggerInfo}
    <!-- This will be loaded if we have debug information available -->
    <button id="toggle" class="toggle">Debugger Console</button>
    <div id="panel">
        <div id="DebuggerConsole">
            <table>
                <thead>
                    <tr>
                        <th width="2%"><b>Level</b></th>
                        <th width="2%"><b>Time</b></th>
                        <th width="5%"><b>File</b></th>
                        <th width="2%"><b>Line</b></th>
                        <th width="5%"><b>Class</b></th>
                        <th width="10%"><b>Method</b></th>
                        <th width="*"><b>Message</b></th>
                    </tr>
                </thead>
                <tbody>
                    {section name=debug loop=$DebuggerInfo}
                        <tr class="{cycle values="even,odd"}">
                            <td>{$DebuggerInfo[debug].level}</td>
                            <td>{$DebuggerInfo[debug].time}</td>
                            <td>{$DebuggerInfo[debug].file}</td>
                            <td>{$DebuggerInfo[debug].line}</td>
                            <td>{$DebuggerInfo[debug].class}</td>
                            <td>{$DebuggerInfo[debug].method}</td>
                            <td>{$DebuggerInfo[debug].message}</td>
                        </tr>
                    {/section}
                </tbody>
            </table>

        </div>
    </div>
{/if}