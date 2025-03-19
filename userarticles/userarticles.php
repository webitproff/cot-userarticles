<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=standalone
[END_COT_EXT]
==================== */

defined('COT_CODE') or die('Wrong URL');

// Подключаем файлы
require_once cot_langfile('userarticles', 'plug');
require_once cot_incfile('userarticles', 'plug', 'functions');
require_once cot_incfile('forms'); // Подключаем forms.php для cot_selectbox

// Регистрируем таблицы
global $db_pages, $db_users, $db_structure;
cot::$db->registerTable('pages');
cot::$db->registerTable('users');
cot::$db->registerTable('structure');

// Определяем параметры
$action = cot_import('action', 'G', 'ALP', 16);
$user_id = cot_import('uid', 'G', 'INT');
$page = cot_import('d', 'G', 'INT') ?: 1;
$search = cot_import('search', 'G', 'TXT');
$cat = cot_import('cat', 'G', 'TXT'); // Новый параметр для категории

// Получаем настройки из конфига
$max_users = (int) Cot::$cfg['plugin']['userarticles']['max_rows_per_users'] ?: 20;
$max_articles = (int) Cot::$cfg['plugin']['userarticles']['max_rows_per_pages'] ?: 25;

// Основной список пользователей
if (empty($action) || $action == 'list') {
    Cot::$out['subtitle'] = Cot::$L['userarticles_list_title'];

    $t = new XTemplate(cot_tplfile('userarticles', 'plug'));
    $t->assign('SEARCH', htmlspecialchars($search ?? ''));

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

    $pagination_params = ['e' => 'userarticles'];
    if (!empty($search)) {
        $pagination_params['search'] = $search;
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
        'USER_PROFILE_URL' => cot_url('users', 'm=details&id=' . $user_id),
        'USER_ID' => $user_id // Явно передаём user_id в шаблон
    ]);

    // Получаем категории из cot_structure для статей пользователя с иерархией
    $categories_raw = cot::$db->query("
        SELECT DISTINCT s.structure_code, s.structure_title, s.structure_path
        FROM $db_structure AS s
        INNER JOIN $db_pages AS p ON p.page_cat = s.structure_code
        WHERE s.structure_area = 'page' AND p.page_ownerid = ? AND p.page_state = 0
        ORDER BY s.structure_path, s.structure_title
    ", [$user_id])->fetchAll();

    // Строим иерархический массив категорий
    $categories = ['' => Cot::$L['userarticles_all_categories']]; // "Все категории" в корне
    foreach ($categories_raw as $cat_row) {
        $path_parts = explode('.', $cat_row['structure_path']);
        $level = count($path_parts) - 1; // Уровень вложенности
        $prefix = str_repeat('    ', $level); // Отступы для визуальной иерархии (4 пробела на уровень)
        $categories[$cat_row['structure_code']] = $prefix . $cat_row['structure_title'];
    }

    // Создаём выпадающий список с автоматической отправкой формы (Bootstrap-стиль)
    $t->assign('CATEGORY_FILTER', cot_selectbox($cat, 'cat', array_keys($categories), array_values($categories), true, 'class="form-control" onchange="this.form.submit()"'));

    // Подсчёт общего количества статей с учётом фильтра категории
    $where = "p.page_ownerid = ? AND p.page_state = 0";
    $params = [$user_id];
    if (!empty($cat)) {
        $where .= " AND p.page_cat = ?";
        $params[] = $cat;
    }
    $total_articles = cot::$db->query("SELECT COUNT(page_id) FROM $db_pages AS p WHERE $where", $params)->fetchColumn();

    // Получение статей с учётом фильтра категории
    $offset = ($page - 1) * $max_articles;
    $params = array_merge($params, [$offset, $max_articles]);
    $sql = cot::$db->query("
        SELECT p.page_id, p.page_alias, p.page_cat, p.page_title, p.page_date, p.page_updated, p.page_count
        FROM $db_pages AS p
        WHERE $where
        ORDER BY p.page_date DESC
        LIMIT ?, ?
    ", $params);

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

    // Пагинация для статей с учётом категории
    $pagination_params = ['e' => 'userarticles', 'action' => 'details', 'uid' => $user_id];
    if (!empty($cat)) {
        $pagination_params['cat'] = $cat;
    }
    $pagination = cot_pagenav('plug', $pagination_params, $offset, $total_articles, $max_articles, 'd');
    $t->assign(cot_generatePaginationTags($pagination));
} else {
    cot_die_message(404);
}
