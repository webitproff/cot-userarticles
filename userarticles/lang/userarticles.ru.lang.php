<?php
defined('COT_CODE') or die('Wrong URL');


/**
 * Plugin Info
 */

$L['info_name'] = 'Статьи пользователей';
$L['info_desc'] = 'Плагин отображает список пользователей с количеством их статей и подробный список статей для каждого пользователя';
$L['info_notes'] = 'Тестировалось на Cotonti 0.9.26 под PHP 8.2';

/**
 * Plugin Title & Subtitle
 */
/**
$L['plu_title'] = 'Статьи пользователей'; смотреть class ExtensionsHelper
$L['userarticles_title'] = 'Статьи пользователей';  смотреть class ExtensionsHelper
 */
$L['cfg_max_rows_per_pages'] = 'Максимальное число статей на страницу (в шаблоне userarticles.details.tpl)';
$L['cfg_max_rows_per_users'] = 'Максимальное число пользователей на страницу (в шаблоне userarticles.tpl)';

$L['userarticles_title'] = 'Статьи пользователей';

$L['userarticles_list_title'] = 'Список пользователей и их статей';
$L['userarticles_details_title'] = 'Статьи пользователя';
$L['userarticles_user_not_found'] = 'Пользователь не найден';
$L['userarticles_no_users'] = 'Пользователи не найдены';
$L['userarticles_no_articles'] = 'У этого пользователя нет опубликованных статей';
$L['userarticles_username'] = 'Имя пользователя';
$L['userarticles_article_count'] = 'Количество статей';
$L['userarticles_category'] = 'Категория';
$L['userarticles_title_page'] = 'Заголовок';
$L['userarticles_date'] = 'Дата публикации';
$L['userarticles_updated'] = 'Дата обновления';
$L['userarticles_views'] = 'Просмотры';

// Новые строки для вывода количества
$L['userarticles_total_users'] = 'Пользователей всего';
$L['userarticles_users_on_page'] = 'Пользователей на этой странице';
$L['userarticles_total_articles'] = 'Статей данного пользователя всего';
$L['userarticles_articles_on_page'] = 'Статей на этой странице';

$L['userarticles_search_label'] = 'Поиск по имени пользователя';
$L['userarticles_search_placeholder'] = 'Введите имя пользователя';
$L['userarticles_search_button'] = 'Найти';