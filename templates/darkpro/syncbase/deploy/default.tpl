    {if !$ERROR}
        <div class="contentBox">
            <h1>Deployment Status</h1>
            <p class="teaser">Deployed {$smarty.request.project} with new tag {$smarty.request.tag}</p>
        </div>
    {/if}