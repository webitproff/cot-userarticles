# cot-userarticles
The plugin for CMF Cotonti displays a list of users with the number of their articles and a detailed list of articles for each user

# User Articles Plugin for Cotonti

## Overview

The **User Articles** plugin is a simple and useful tool for Cotonti CMF-based websites. It allows you to display a list of users along with the number of articles they've published, and provides a detailed view of each user's articles. This plugin is perfect for communities, blogs, or any site where user-generated content is key.

### Features
- **User List**: Shows all users with the total number of their published articles.
- **Article Details**: Displays a detailed list of articles for each user, including category, title, publication date, update date, and view count.
- **Pagination**: Supports easy navigation through users and articles with Bootstrap 5.3.3-styled pagination.
- **Localization**: Available in English (`en`) and Russian (`ru`), with customizable language strings.
- **Configurable Limits**: Set the maximum number of users or articles per page via the admin panel.

Tested on **Cotonti 0.9.26** with **PHP 8.2**.

---

## Installation

Follow these steps to install the **User Articles** plugin on your Cotonti-powered website:

### Prerequisites
- A working installation of Cotonti CMF (version 0.9.26 or compatible).
- PHP 8.2 or higher.
- Access to your site's file system (via FTP, SFTP, or a control panel).

### Steps
1. **Download the Plugin**

Download ZIP file from GitHub [userarticles](https://github.com/webitproff/cot-userarticles/)
- If you downloaded a ZIP, unzip it.

2. **Upload Files**
- Copy the `userarticles` folder to the `plugins` directory of your Cotonti installation (e.g., `path/to/cotonti/plugins/`).

3. **Install via Admin Panel**
- Log in to your Cotonti admin panel (e.g., `yourwebsite.com/admin`).
- Go to **Extensions** (`Administration > Extensions`).
- Find **User Articles** in the list of available plugins.
- Click **Install** next to it. This will register the plugin and set up its database hooks.

4. **Configure Settings (Optional)**
- In the admin panel, go to **Configuration** (`Administration > Configuration`).
- Select **User Articles** from the list of plugins.
- Adjust the following settings if needed:
- **Maximum number of articles per page**: Default is 25.
- **Maximum number of users per page**: Default is 20.
- Save your changes.

5. **Check It Out**
- Visit the plugin page on your site: `yourwebsite.com/index.php?e=userarticles`.
- You should see a list of users with their article counts.
- Click a username to view their articles: `yourwebsite.com/index.php?e=userarticles&action=details&uid=[user_id]`.

---

## Usage
- **User List Page**: Displays all users with links to their article details.
- **Article Details Page**: Shows a table of articles for a selected user, with pagination if there are more articles than the set limit.
- **Language Support**: The plugin automatically uses the site’s language (English or Russian). Add more languages by creating new `userarticles.[lang].lang.php` files in the `lang` folder.

---

## Files Included
- `userarticles.php`: Main plugin logic.
- `userarticles.tpl`: Template for the user list page.
- `userarticles.details.tpl`: Template for the article details page.
- `lang/userarticles.en.lang.php`: English localization.
- `lang/userarticles.ru.lang.php`: Russian localization.

---

## Customization
- **Templates**: Edit `userarticles.tpl` and `userarticles.details.tpl` to match your site’s design (styled with Bootstrap 5.3.3 by default).
- **Localization**: Modify or add language files in the `lang` folder.
- **Settings**: Change pagination limits in the admin panel.

---

## Notes
- Ensure your Cotonti installation has the `page` and `users` modules enabled, as this plugin relies on them.
- Tested with Bootstrap 5.3.3 for styling, but you can adapt it to other frameworks by editing the templates.

---

## Contributing
Feel free to submit issues or pull requests on GitHub if you find bugs or want to improve the plugin!

---


# Плагин "Статьи пользователей" для Cotonti

## Описание

Плагин **"Статьи пользователей"** — это простой и удобный инструмент для сайтов на Cotonti CMF. Он позволяет показать список пользователей с количеством их статей и подробный список статей каждого пользователя. Отлично подходит для сообществ, блогов или любых сайтов, где важно показать контент от пользователей.

### Возможности
- **Список пользователей**: Показывает всех пользователей и количество их опубликованных статей.
- **Детали статей**: Отображает полный список статей выбранного пользователя с категорией, заголовком, датой публикации, датой обновления и количеством просмотров.
- **Пагинация**: Удобная навигация по списку пользователей и статей в стиле Bootstrap 5.3.3.
- **Локализация**: Поддержка русского (`ru`) и английского (`en`) языков с возможностью настройки.
- **Настраиваемые лимиты**: Можно указать максимальное число пользователей или статей на странице через админ-панель.

Протестировано на **Cotonti 0.9.26** с **PHP 8.2**.

---

## Установка

Чтобы установить плагин **"Статьи пользователей"** на сайт под управлением Cotonti, выполните следующие шаги:

### Требования
- Установленная Cotonti CMF (версия 0.9.26 или совместимая).
- PHP 8.2 или выше.
- Доступ к файлам сайта (через FTP, SFTP или панель управления).

### Инструкция
1. **Скачайте плагин**
   скачайте ZIP-архив с GitHub:

- Если скачали ZIP, распакуйте его.

2. **Загрузите файлы**
- Скопируйте папку `userarticles` в директорию `plugins` вашего сайта Cotonti (например, `path/to/cotonti/plugins/`).

3. **Установите через админ-панель**
- Войдите в админ-панель Cotonti (например, `yourwebsite.com/admin`).
- Перейдите в **Расширения** (`Администрирование > Расширения`).
- Найдите **"Статьи пользователей"** в списке доступных плагинов.
- Нажмите **Установить**. Это подключит плагин и настроит его хуки в базе данных.

4. **Настройте параметры (по желанию)**
- В админ-панели перейдите в **Конфигурация** (`Администрирование > Конфигурация`).
- Выберите **"Статьи пользователей"** в списке плагинов.
- Измените настройки, если нужно:
- **Максимальное число статей на странице**: По умолчанию 25.
- **Максимальное число пользователей на странице**: По умолчанию 20.
- Сохраните изменения.

5. **Проверьте работу**
- Откройте страницу плагина на сайте: `yourwebsite.com/index.php?e=userarticles`.
- Вы увидите список пользователей с количеством их статей.
- Кликните по имени пользователя, чтобы посмотреть его статьи: `yourwebsite.com/index.php?e=userarticles&action=details&uid=[user_id]`.

---

## Использование
- **Страница со списком пользователей**: Показывает всех пользователей с ссылками на их статьи.
- **Страница с деталями статей**: Выводит таблицу статей выбранного пользователя с пагинацией, если статей больше, чем указано в настройках.
- **Поддержка языков**: Плагин использует язык сайта (русский или английский). Добавьте новые языки, создав файлы `userarticles.[lang].lang.php` в папке `lang`.

---

## Состав плагина
- `userarticles.php`: Основная логика плагина.
- `userarticles.tpl`: Шаблон для списка пользователей.
- `userarticles.details.tpl`: Шаблон для списка статей пользователя.
- `lang/userarticles.en.lang.php`: Локализация на английском.
- `lang/userarticles.ru.lang.php`: Локализация на русском.

---

## Настройка
- **Шаблоны**: Измените `userarticles.tpl` и `userarticles.details.tpl`, чтобы адаптировать дизайн под ваш сайт (по умолчанию используется Bootstrap 5.3.3).
- **Локализация**: Отредактируйте или добавьте языковые файлы в папке `lang`.
- **Параметры**: Установите лимиты пагинации в админ-панели.

---

## Замечания
- Убедитесь, что на вашем сайте включены модули `page` и `users`, так как плагин зависит от них.
- Стилизация выполнена под Bootstrap 5.3.3, но вы можете адаптировать шаблоны под другие фреймворки.

---

## Как помочь проекту
Если найдёте ошибки или захотите улучшить плагин, создавайте issues или pull requests на GitHub!

---
