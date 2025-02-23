<?php

define('URL', __DIR__ . DIRECTORY_SEPARATOR);                       //    директория текущего проекта в системе
define ('APP', URL . 'app' . DIRECTORY_SEPARATOR);                  //    директория   /app
define ('VIEWS', APP . 'views' . DIRECTORY_SEPARATOR);              //    директория   /app/views/
define ('CONTROLLERS', APP . 'controllers' . DIRECTORY_SEPARATOR);  //    директория   /app/controllers/
define ('MODELS', APP . 'models' . DIRECTORY_SEPARATOR);            //    директория   /app/models/
define ('CONTROLLERS_NAMESPACE', 'app\\controllers\\' );

date_default_timezone_set('Asia/Yekaterinburg');          //    часовой пояс

// введите ваши настройки БД:
// MySQL
define ('HOST', 'localhost');                                       // наименование хоста
define ('USER', 'root');                                            // имя пользователя БД
define ('PASSWORD', 'root');                                        // пароль к БД
define ('DB_NAME', 'mess');                                         // наименование БД

// введите ваши настройки БД:
// PostgreSQL
//define ('USER', 'postgres');
//define ('PASSWORD', 'postgres');
//define ('DB_NAME', 'couriers');
