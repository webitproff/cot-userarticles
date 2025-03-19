<!-- BEGIN: MAIN -->
<div class="container my-4">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{PHP|cot_url('userarticles')}" title="{PHP.L.userarticles_title}">{PHP.L.userarticles_title}</a></li>
		<li class="breadcrumb-item active">{PHP.L.userarticles_details_title}: <a href="{USER_PROFILE_URL}">{USER_NAME}</a></li>
	  </ol>
	</nav>

    <!-- Выпадающий список категорий -->
    <form action="{PHP.sys.request_uri}" method="get" class="mb-4">
        <input type="hidden" name="e" value="userarticles" />
        <input type="hidden" name="action" value="details" />
        <input type="hidden" name="uid" value="{USER_ID}" />
        <div class="mb-3">
            <label class="form-label" for="cat">{PHP.L.userarticles_category_filter_label}</label>
            {CATEGORY_FILTER}
        </div>
    </form>

    <!-- BEGIN: ARTICLE_LIST -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col">{PHP.L.userarticles_category}</th>
                    <th scope="col">{PHP.L.userarticles_title_page}</th>
                    <th scope="col">{PHP.L.userarticles_date}</th>
                    <th scope="col">{PHP.L.userarticles_updated}</th>
                    <th scope="col">{PHP.L.userarticles_views}</th>
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
    <p class="text-muted">{PHP.L.userarticles_no_articles}</p>
    <!-- END: NO_ARTICLES -->

    <!-- IF {PAGINATION} -->
    <nav aria-label="Article pagination" class="mt-3">
        <ul class="pagination justify-content-center">
            {PREVIOUS_PAGE}
            {PAGINATION}
            {NEXT_PAGE}
        </ul>
    </nav>
    <div class="text-center mt-2">
        <p>{PHP.L.userarticles_total_articles}: {TOTAL_ENTRIES}</p>
        <p>{PHP.L.userarticles_articles_on_page}: {ENTRIES_ON_CURRENT_PAGE}</p>
    </div>
    <!-- ENDIF -->
</div>
<!-- END: MAIN -->
