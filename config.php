<?php

define('URL', __DIR__ . DIRECTORY_SEPARATOR);
define ('APP', URL . 'app' . DIRECTORY_SEPARATOR);
define ('VIEWS', APP . 'views' . DIRECTORY_SEPARATOR);             //    директория   /app/views/
define ('CONTROLLERS', APP . 'controllers' . DIRECTORY_SEPARATOR); //    директория   /app/controllers/
define ('MODELS', APP . 'models' . DIRECTORY_SEPARATOR);           //    директория   /app/models/
define ('CONTROLLERS_NAMESPACE', 'app\\controllers\\' );

date_default_timezone_set('Asia/Yekaterinburg');                // определить часовой пояс

// введите ваши нстройки БД:
// MySQL
define ('HOST', 'localhost');                                       // определить наименование хоста
define ('USER', 'root');                                            // определить имя пользователя БД
define ('PASSWORD', 'root');                                        // определить пароль к БД
define ('DB_NAME', 'mess');                                      // определить наименование БД

// введите ваши настройки БД:
// PostgreSQL
//define ('USER', 'postgres');
//define ('PASSWORD', 'postgres');
//define ('DB_NAME', 'couriers');
