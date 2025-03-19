<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=standalone
[END_COT_EXT]
==================== */

defined('COT_CODE') or die('Wrong URL');

// Подключаем файлы
require_once cot_langfile('userarticles', 'plug');
require_once cot_incfile('userarticles', 'plug', 'functions'); // Подключаем функции

// Регистрируем таблицы
global $db_pages, $db_users;
cot::$db->registerTable('pages');
cot::$db->registerTable('users');

// Определяем параметры
$action = cot_import('action', 'G', 'ALP', 16);
$user_id = cot_import('uid', 'G', 'INT');
$page = cot_import('d', 'G', 'INT') ?: 1;
$search = cot_import('search', 'G', 'TXT');

// $search = cot_import('search', 'G', 'TXT', 64, true); // true возвращает '' вместо null
// Вызывает Deprecated: htmlspecialchars() в PHP 8.2+
// если  $t->assign('SEARCH', htmlspecialchars($search)); // $search строка

// Получаем настройки из конфига
$max_users = (int) Cot::$cfg['plugin']['userarticles']['max_rows_per_users'] ?: 20;
$max_articles = (int) Cot::$cfg['plugin']['userarticles']['max_rows_per_pages'] ?: 25;

// Основной список пользователей
if (empty($action) || $action == 'list') {
    Cot::$out['subtitle'] = Cot::$L['userarticles_list_title'];

    $t = new XTemplate(cot_tplfile('userarticles', 'plug'));

    // Передаём значение поиска в шаблон
   
	$t->assign('SEARCH', htmlspecialchars($search ?? ''));
	
    // Получаем данные пользователей с учётом поиска
    $offset = ($page - 1) * $max_users;
    list($total_users, $users) = userarticles_get_users($search, $offset, $max_users);

    if (count($users) > 0) {
        foreach ($users as $row) {
            $t->assign([
                'USER_ID' => $row['user_id'],
                'USER_NAME' => htmlspecialchars($row['user_name']),
                'USER_ARTICLE_COUNT' => $row['article_count'],
                'USER_URL' => cot_url('plug', 'e=userarticles&action=details&uid=' . $row['user_id'])
            ]);
            $t->parse('MAIN.USER_LIST.USER');
        }
        $t->parse('MAIN.USER_LIST');
    } else {
        $t->parse('MAIN.NO_USERS');
    }

    // Пагинация для пользователей
    $pagination_params = ['e' => 'userarticles'];
    if (!empty($search)) {
        $pagination_params['search'] = $search; // Добавляем параметр поиска в пагинацию
    }
    $pagination = cot_pagenav('plug', $pagination_params, $offset, $total_users, $max_users, 'd');
    $t->assign(cot_generatePaginationTags($pagination));
}

// Детальный список статей пользователя
elseif ($action == 'details' && $user_id > 0) {
    $user = cot::$db->query("SELECT user_name FROM $db_users WHERE user_id = ?", [$user_id])->fetch();
    if (!$user) {
        cot_die_message(404, Cot::$L['userarticles_user_not_found']);
    }

    Cot::$out['subtitle'] = Cot::$L['userarticles_details_title'] . ' ' . htmlspecialchars($user['user_name']);

    $t = new XTemplate(cot_tplfile('userarticles.details', 'plug'));

    $t->assign([
        'USER_NAME' => htmlspecialchars($user['user_name']),
        'USER_PROFILE_URL' => cot_url('users', 'm=details&id=' . $user_id)
    ]);

    $total_articles = cot::$db->query("
        SELECT COUNT(page_id)
        FROM $db_pages AS p
        WHERE p.page_ownerid = ? AND p.page_state = 0
    ", [$user_id])->fetchColumn();

    $offset = ($page - 1) * $max_articles;
    $sql = cot::$db->query("
        SELECT p.page_id, p.page_alias, p.page_cat, p.page_title, p.page_date, p.page_updated, p.page_count
        FROM $db_pages AS p
        WHERE p.page_ownerid = ? AND p.page_state = 0
        ORDER BY p.page_date DESC
        LIMIT ?, ?
    ", [$user_id, $offset, $max_articles]);

    $articles = $sql->fetchAll();
    if (count($articles) > 0) {
        foreach ($articles as $row) {
            $urlParams = ['c' => $row['page_cat']];
            if (!empty($row['page_alias'])) {
                $urlParams['al'] = $row['page_alias'];
            } else {
                $urlParams['id'] = $row['page_id'];
            }

            $categoryTitle = isset(Cot::$structure['page'][$row['page_cat']]['title']) 
                ? Cot::$structure['page'][$row['page_cat']]['title'] 
                : $row['page_cat'];

            $t->assign([
                'ARTICLE_CATEGORY' => htmlspecialchars($categoryTitle),
                'ARTICLE_TITLE' => htmlspecialchars($row['page_title']),
                'ARTICLE_URL' => cot_url('page', $urlParams),
                'ARTICLE_DATE' => cot_date('d.m.Y', $row['page_date']),
                'ARTICLE_UPDATED' => cot_date('d.m.Y', $row['page_updated']),
                'ARTICLE_VIEWS' => $row['page_count']
            ]);
            $t->parse('MAIN.ARTICLE_LIST.ARTICLE');
        }
        $t->parse('MAIN.ARTICLE_LIST');
    } else {
        $t->parse('MAIN.NO_ARTICLES');
    }

    // Пагинация для статей
    $pagination = cot_pagenav('plug', ['e' => 'userarticles', 'action' => 'details', 'uid' => $user_id], $offset, $total_articles, $max_articles, 'd');
    $t->assign(cot_generatePaginationTags($pagination));
} else {
    cot_die_message(404);
}