<?php
    namespace App;

    // при AJAX-запросе компилятор теряет все классы, поэтому надо их загружать по новому
    // загружаем все классы и константы
    require_once dirname(__DIR__, 1) . DIRECTORY_SEPARATOR. 'vendor' . DIRECTORY_SEPARATOR. 'autoload.php';
    require_once dirname(__DIR__, 1) . DIRECTORY_SEPARATOR.'config.php';

    use App\controllers\ControllerAJAX;
    use App\models\DB;

    // вызов метода handle для обработки AJAX запроса
    ControllerAJAX::handle();









