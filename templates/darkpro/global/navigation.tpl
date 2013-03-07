          <!-- put class="tab_selected" in the li tag for the selected page - to highlight which page you're on -->
          <ul>
            <li {if $smarty.request.page == "home" || $smarty.request.page == ""} class="act"{/if}><a href="{$smarty.server.PHP_SELF}">Home</a></li>
            <li {if $smarty.request.page == "version"} class="act"{/if}><a href="{$smarty.server.PHP_SELF}?page=version">Versions</a></li>
            <li {if $smarty.request.page == "tag"} class="act"{/if}><a href="{$smarty.server.PHP_SELF}?page=tag">Create Tag</a></li>
            <li {if $smarty.request.page == "list"} class="act"{/if}><a href="{$smarty.server.PHP_SELF}?page=list">List Tags</a></li>
            <li {if $smarty.request.page == "syncbase"} class="act"{/if}><a href="{$smarty.server.PHP_SELF}?page=syncbase">Deploy Tag</a></li>
          </ul>