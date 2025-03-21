<!-- BEGIN: MAIN -->
<div class="uk-section uk-background-primary uk-padding-y-10" uk-height-viewport="expand: true">
  <div class="uk-container uk-container-large">
    <div class="uk-card uk-margin uk-margin-top">
      <header>
        <div class="uk-flex-middle" uk-grid>
          <div class="uk-width-1-5 uk-width-auto@m uk-text-center">
            <i class="fa-solid fa-newspaper fa-2xl"></i>
          </div>
          <div class="uk-width-4-5 uk-width-expand@m">
            <h1 class="uk-text-lead">{PHP.L.userarticles_list_title}</h1>
          </div>
        </div>
      </header>
    </div>
    <div class="uk-card uk-background-muted uk-card-small uk-border-rounded-mdm uk-border-btm-muted shadow-scmtdlight uk-margin-medium-bottom">
      <div class="uk-card-body">
        <!-- Форма поиска -->
        <form action="{PHP|cot_url('plug', 'e=userarticles')}" method="get" class="uk-form-stacked uk-margin-bottom">
          <input type="hidden" name="e" value="userarticles" />
          <div class="uk-margin">
            <label class="uk-form-label" for="search">{PHP.L.userarticles_search_label}</label>
            <div class="uk-form-controls">
              <input class="uk-input uk-form-width-medium" id="search" name="search" type="text" value="{PHP.search}" placeholder="{PHP.L.userarticles_search_placeholder}" />
              <button class="uk-button uk-button-primary uk-margin-small-left" type="submit">{PHP.L.userarticles_search_button}</button>
            </div>
          </div>
        </form>
        <!-- BEGIN: USER_LIST -->
        <div class="uk-overflow-auto">
          <table class="uk-table uk-table-striped uk-table-hover">
            <thead>
              <tr>
                <th>{PHP.L.userarticles_username}</th>
                <th>{PHP.L.userarticles_article_count}</th>
              </tr>
            </thead>
            <tbody>
              <!-- BEGIN: USER -->
              <tr>
                <td>
                  <a href="{USER_URL}">{USER_NAME}</a>
                </td>
                <td>{USER_ARTICLE_COUNT}</td>
              </tr>
              <!-- END: USER -->
            </tbody>
          </table>
        </div>
        <!-- END: USER_LIST -->
      </div>
    </div>
    <!-- BEGIN: NO_USERS -->
    <p class="uk-text-muted">{PHP.L.userarticles_no_users}</p>
    <!-- END: NO_USERS -->
    <!-- IF {PAGINATION} -->
    <ul class="uk-pagination uk-flex-center uk-margin-top"> {PREVIOUS_PAGE} {PAGINATION} {NEXT_PAGE} </ul>
    <div class="uk-text-center uk-margin-small-top">
      <p>{PHP.L.userarticles_total_users}: {TOTAL_ENTRIES}</p>
      <p>{PHP.L.userarticles_users_on_page}: {ENTRIES_ON_CURRENT_PAGE}</p>
    </div>
    <!-- ENDIF -->
  </div>
</div>
<!-- END: MAIN -->
