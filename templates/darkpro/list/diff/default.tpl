        <div class="contentBox">
            <h3>Compare Files</h3>
            <p class="teaser">File changes between <b>{$smarty.request.tag}</b> and <b>{$smarty.request.tag2}</b> for file <b>{$smarty.request.file}</b>.</p>
            <br>
            <div class="contentBox">
            {if $DIFF}
                <pre class="code">{$DIFF}</pre>
            {/if}
            </div>
        </div>