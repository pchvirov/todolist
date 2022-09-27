<?php
// Задаем общие константы:
define('START_TIME', microtime(true));//время старта скрипта
define('DS', DIRECTORY_SEPARATOR); // разделитель для путей к файлам
define('RELATIVE_PATH', ''); // путь к сайту относительно корня
define('SITE_PATH', ROOT_PATH . RELATIVE_PATH); // полный путь к сайту
// Задаем константы для подключения к бд
define('DB_USER', 'root');//имя пользователя
define('DB_PASS', 'test');//пароль
define('DB_HOST', 'localhost');//имя хоста
define('DB_NAME', 'todolist');//имя базы данных
//Задаем константы вывода сообщений
define('MAX_TOPIC', 3);//количество задач на странице

//функция автоподгрузки классов
function my_autoloader($class)
{
    $mass = explode('\\', $class);
    if (count($mass) === 1) {
        include SITE_PATH . '/' . $class . '.php';
    } else {
        include SITE_PATH . '/MVC/' . implode('/', $mass) . '.php';
    }
}
spl_autoload_register('my_autoloader');
