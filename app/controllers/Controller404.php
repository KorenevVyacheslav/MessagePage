<?php

namespace App\controllers;

use App\core\Controller;

/**
 * контроллер для обработки несуществующего адреса
 * ControllerPage class
 */
class Controller404 extends Controller
{
    /**
     * метод для обработки несуществующего адреса страницы
     * @return void
     */
    function action_index(): void
    {
        $this->view->generate('404_view.php', 'template_view.php');
    }

}


