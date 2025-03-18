<!-- BEGIN: MAIN -->
<div class="container my-4">
    <h2 class="mb-3">{PHP.L.userarticles_list_title}</h2>

    <!-- BEGIN: USER_LIST -->
    <div class="table-responsive">
        <table class="table table-striped">
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