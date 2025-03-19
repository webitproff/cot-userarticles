<?php
defined('COT_CODE') or die('Wrong URL');

/**
 * Plugin Info
 */

$L['info_name'] = 'User Articles';
$L['info_desc'] = 'The plugin displays a list of users with the number of their articles and a detailed list of articles for each user';
$L['info_notes'] = 'Tested on Cotonti 0.9.26 with PHP 8.2';

/**
 * Plugin Title & Subtitle
 */
/**
$L['plu_title'] = 'User Articles'; // See class ExtensionsHelper
$L['userarticles_title'] = 'User Articles'; // See class ExtensionsHelper
 */
$L['cfg_max_rows_per_pages'] = 'Maximum number of articles per page (in userarticles.details.tpl template)';
$L['cfg_max_rows_per_users'] = 'Maximum number of users per page (in userarticles.tpl template)';

$L['userarticles_list_title'] = 'List of Users and Their Articles';
$L['userarticles_details_title'] = 'User Articles';
$L['userarticles_user_not_found'] = 'User not found';
$L['userarticles_no_users'] = 'No users found';
$L['userarticles_no_articles'] = 'This user has no published articles';
$L['userarticles_username'] = 'Username';
$L['userarticles_article_count'] = 'Article Count';
$L['userarticles_category'] = 'Category';
$L['userarticles_title_page'] = 'Title'; // Changed from "userarticles_title" to "userarticles_title_page" as in your code
$L['userarticles_date'] = 'Publication Date';
$L['userarticles_updated'] = 'Update Date';
$L['userarticles_views'] = 'Views';

// New strings for totals and per-page counts
$L['userarticles_total_users'] = 'Total Users';
$L['userarticles_users_on_page'] = 'Users on This Page';
$L['userarticles_total_articles'] = 'Total Articles by This User';
$L['userarticles_articles_on_page'] = 'Articles on This Page';

$L['userarticles_search_label'] = 'Search by username';
$L['userarticles_search_placeholder'] = 'Enter username';
$L['userarticles_search_button'] = 'Search';

$L['userarticles_all_categories'] = 'All categories';
$L['userarticles_category_filter_label'] = 'Filter by category';
