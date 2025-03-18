<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=standalone
[END_COT_EXT]
==================== */

defined('COT_CODE') or die('Wrong URL');

// Подключаем файл локализации
require_once cot_langfile('userarticles', 'plug');

// Регистрируем таблицы
global $db_pages, $db_users;
cot::$db->registerTable('pages');
cot::$db->registerTable('users');

// Определяем действие, ID пользователя и страницу
$action = cot_import('action', 'G', 'ALP', 16);
$user_id = cot_import('uid', 'G', 'INT');
$page = cot_import('d', 'G', 'INT') ?: 1;

// Получаем настройки из конфига с fallback-значениями
$max_users = (int) Cot::$cfg['plugin']['userarticles']['max_rows_per_users'] ?: 20;
$max_articles = (int) Cot::$cfg['plugin']['userarticles']['max_rows_per_pages'] ?: 25;

// Основной список пользователей
if (empty($action) || $action == 'list') {
    Cot::$out['subtitle'] = Cot::$L['userarticles_list_title'];

    $t = new XTemplate(cot_tplfile('userarticles', 'plug'));

    $total_users = cot::$db->query("
        SELECT COUNT(DISTINCT u.user_id)
        FROM $db_users AS u
        LEFT JOIN $db_pages AS p ON p.page_ownerid = u.user_id AND p.page_state = 0
    ")->fetchColumn();

    $offset = ($page - 1) * $max_users;
    $sql = cot::$db->query("
        SELECT u.user_id, u.user_name, COUNT(p.page_id) AS article_count
        FROM $db_users AS u
        LEFT JOIN $db_pages AS p ON p.page_ownerid = u.user_id AND p.page_state = 0
        GROUP BY u.user_id, u.user_name
        ORDER BY article_count DESC
        LIMIT ?, ?
    ", [$offset, $max_users]);

    $users = $sql->fetchAll();
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
    $pagination = cot_pagenav('plug', ['e' => 'userarticles'], $offset, $total_users, $max_users, 'd');
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