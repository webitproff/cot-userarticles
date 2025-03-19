<!-- BEGIN: MAIN -->
<div class="uk-container uk-margin-large">
    <ul class="uk-breadcrumb uk-margin-top">
        <li><a href="{PHP|cot_url('userarticles')}" title="{PHP.L.userarticles_title}">{PHP.L.userarticles_title}</a></li>
        <li class="uk-active">{PHP.L.userarticles_details_title}: <a href="{USER_PROFILE_URL}">{USER_NAME}</a></li>
    </ul>

    <!-- Выпадающий список категорий -->
    <form action="{PHP.sys.request_uri}" method="get" class="uk-form-stacked uk-margin-bottom">
        <input type="hidden" name="e" value="userarticles" />
        <input type="hidden" name="action" value="details" />
        <input type="hidden" name="uid" value="{USER_ID}" />
        <div class="uk-margin">
            <label class="uk-form-label" for="cat">{PHP.L.userarticles_category_filter_label}</label>
            <div class="uk-form-controls">
                {CATEGORY_FILTER}
            </div>
        </div>
    </form>

    <!-- BEGIN: ARTICLE_LIST -->
    <div class="uk-overflow-auto">
        <table class="uk-table uk-table-striped uk-table-hover">
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
                    <td><a href="{ARTICLE_URL}">{ARTICLE_TITLE}</a></td>
                    <td>{ARTICLE_DATE}</td>
                    <td>{ARTICLE_UPDATED}</td>
                    <td>{ARTICLE_VIEWS}</td>
                </tr>
                <!-- END: ARTICLE -->
            </tbody>
        </table>
    </div>
    <!-- END: ARTICLE_LIST -->

    <!-- BEGIN: NO_ARTICLES -->
    <p class="uk-text-muted">{PHP.L.userarticles_no_articles}</p>
    <!-- END: NO_ARTICLES -->

    <!-- IF {PAGINATION} -->
    <ul class="uk-pagination uk-flex-center uk-margin-top">
        {PREVIOUS_PAGE}
        {PAGINATION}
        {NEXT_PAGE}
    </ul>
    <div class="uk-text-center uk-margin-small-top">
        <p>{PHP.L.userarticles_total_articles}: {TOTAL_ENTRIES}</p>
        <p>{PHP.L.userarticles_articles_on_page}: {ENTRIES_ON_CURRENT_PAGE}</p>
    </div>
    <!-- ENDIF -->
</div>
<!-- END: MAIN -->
