<!-- BEGIN: MAIN -->
<div class="uk-section uk-padding-remove-vertical uk-background-blur-silver uk-border-btm-primary">
  <div class="uk-container uk-container-large uk-padding-small uk-link-text">
    <ul class="uk-breadcrumb">
      <li>
        <a href="{PHP.cfg.mainurl}">
          <span class="uk-margin-auto-left@m">
            <i class="fa-solid fa-house fa-xl"></i>
          </span>
        </a>
      </li>
      <li>
        <a href="{PHP|cot_url('userarticles')}" title="{PHP.L.userarticles_title}">{PHP.L.userarticles_title}</a>
      </li>
      <li>
        <span>{PHP.L.userarticles_details_title}: <a href="{USER_PROFILE_URL}">{USER_NAME}</a>
        </span>
      </li>
    </ul>
  </div>
</div>
<div class="uk-section uk-background-primary uk-padding-y-10" uk-height-viewport="expand: true">
  <div class="uk-container uk-container-large">
    <div class="uk-card uk-margin uk-margin-top">
      <header>
        <div class="uk-flex-middle" uk-grid>
          <div class="uk-width-1-5 uk-width-auto@m uk-text-center">
            <i class="fa-solid fa-newspaper fa-2xl"></i>
          </div>
          <div class="uk-width-4-5 uk-width-expand@m">
            <h1 class="uk-text-lead">{USER_NAME} {PHP.L.userarticles_posted_on_website}</h1>
          </div>
        </div>
      </header>
    </div>
    <div class="uk-card uk-background-muted uk-card-small uk-border-rounded-mdm uk-border-btm-muted shadow-scmtdlight uk-margin-medium-bottom">
      <div class="uk-card-body">
        <!-- Выпадающий список категорий -->
        <form action="{PHP.sys.request_uri}" method="get" class="uk-form-stacked uk-margin-bottom">
          <input type="hidden" name="e" value="userarticles" />
          <input type="hidden" name="action" value="details" />
          <input type="hidden" name="uid" value="{USER_ID}" />
          <div class="uk-margin">
            <label class="uk-form-label" for="cat">{PHP.L.userarticles_category_filter_label}</label>
            <div class="uk-form-controls"> {CATEGORY_FILTER} </div>
          </div>
        </form>
        <!-- BEGIN: ARTICLE_LIST -->
        <div class="uk-overflow-auto">
          <table class="uk-table uk-table-striped">
            <thead>
              <tr>
                <th>{PHP.L.userarticles_category}</th>
                <th>{PHP.L.userarticles_title_page}</th>
                <th>{PHP.L.userarticles_date}</th>
                <th>{PHP.L.userarticles_updated}</th>
                <th>{PHP.L.userarticles_views}</th>
              </tr>
            </thead>
            <tbody>
              <!-- BEGIN: ARTICLE -->
              <tr>
                <td>{ARTICLE_CATEGORY}</td>
                <td>
                  <a href="{ARTICLE_URL}">{ARTICLE_TITLE}</a>
                </td>
                <td>{ARTICLE_DATE}</td>
                <td>{ARTICLE_UPDATED}</td>
                <td>{ARTICLE_VIEWS}</td>
              </tr>
              <!-- END: ARTICLE -->
            </tbody>
          </table>
        </div>
        <!-- END: ARTICLE_LIST -->
      </div>
    </div>
    <!-- BEGIN: NO_ARTICLES -->
    <p class="uk-text-muted">{PHP.L.userarticles_no_articles}</p>
    <!-- END: NO_ARTICLES -->
    <!-- IF {PAGINATION} -->
    <ul class="uk-pagination uk-flex-center uk-margin-top"> {PREVIOUS_PAGE} {PAGINATION} {NEXT_PAGE} </ul>
    <div class="uk-text-center uk-margin-small-top">
      <p>{PHP.L.userarticles_total_articles}: {TOTAL_ENTRIES}</p>
      <p>{PHP.L.userarticles_articles_on_page}: {ENTRIES_ON_CURRENT_PAGE}</p>
    </div>
    <!-- ENDIF -->
  </div>
</div>
<!-- END: MAIN -->
