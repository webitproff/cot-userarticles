<?php
defined('COT_CODE') or die('Wrong URL');
// Подключаем файл локализации
require_once cot_langfile('userarticles', 'plug');
// Здесь будут функции для плагина User Articles в будущем


/**
 * Get users with article counts, optionally filtered by username
 *
 * @param string|null $search Search term for username (optional)
 * @param int $offset Pagination offset
 * @param int $limit Number of users per page
 * @return array [total_users, users]
 */
function userarticles_get_users($search = null, $offset = 0, $limit = 20)
{
    global $db, $db_users, $db_pages;

    $where = '';
    $params = [];
    if (!empty($search)) {
        $where = " WHERE u.user_name LIKE ?";
        $params[] = '%' . $db->prep($search) . '%';
    }

    // Подсчёт общего количества пользователей
    $total_users = $db->query("
        SELECT COUNT(DISTINCT u.user_id)
        FROM $db_users AS u
        LEFT JOIN $db_pages AS p ON p.page_ownerid = u.user_id AND p.page_state = 0
        $where
    ", $params)->fetchColumn();

    // Получение списка пользователей
    $params = array_merge($params, [$offset, $limit]);
    $sql = $db->query("
        SELECT u.user_id, u.user_name, COUNT(p.page_id) AS article_count
        FROM $db_users AS u
        LEFT JOIN $db_pages AS p ON p.page_ownerid = u.user_id AND p.page_state = 0
        $where
        GROUP BY u.user_id, u.user_name
        ORDER BY article_count DESC
        LIMIT ?, ?
    ", $params);

    $users = $sql->fetchAll();

    return [$total_users, $users];
}