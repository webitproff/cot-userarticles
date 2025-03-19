<!-- BEGIN: MAIN -->
<div class="container my-4">
    <h2 class="mb-3">{PHP.L.userarticles_list_title}</h2>

    <!-- Форма поиска -->
    <form action="{PHP|cot_url('plug', 'e=userarticles')}" method="get" class="mb-4">
        <input type="hidden" name="e" value="userarticles" />
        <div class="mb-3">
            <label class="form-label" for="search">{PHP.L.userarticles_search_label}</label>
            <div class="d-flex align-items-center">
                <input class="form-control w-50 me-2" id="search" name="search" type="text" value="{PHP.search}" placeholder="{PHP.L.userarticles_search_placeholder}" />
                <button class="btn btn-primary" type="submit">{PHP.L.userarticles_search_button}</button>
            </div>
        </div>
    </form>

    <!-- BEGIN: USER_LIST -->
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">{PHP.L.userarticles_username}</th>
                    <th scope="col">{PHP.L.userarticles_article_count}</th>
                </tr>
            </thead>
            <tbody>
                <!-- BEGIN: USER -->
                <tr>
                    <td><a href="{USER_URL}">{USER_NAME}</a></td>
                    <td>{USER_ARTICLE_COUNT}</td>
                </tr>
                <!-- END: USER -->
            </tbody>
        </table>
    </div>
    <!-- END: USER_LIST -->

    <!-- BEGIN: NO_USERS -->
    <p class="text-muted">{PHP.L.userarticles_no_users}</p>
    <!-- END: NO_USERS -->

    <!-- IF {PAGINATION} -->
    <nav aria-label="User pagination" class="mt-3">
        <ul class="pagination justify-content-center">
            {PREVIOUS_PAGE}
            {PAGINATION}
            {NEXT_PAGE}
        </ul>
    </nav>
    <div class="text-center mt-2">
        <p>{PHP.L.userarticles_total_users}: {TOTAL_ENTRIES}</p>
        <p>{PHP.L.userarticles_users_on_page}: {ENTRIES_ON_CURRENT_PAGE}</p>
    </div>
    <!-- ENDIF -->
</div>
<!-- END: MAIN -->