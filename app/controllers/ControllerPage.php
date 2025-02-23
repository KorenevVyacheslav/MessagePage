<?php

namespace App\controllers;

use App\core\Controller;
use App\core\View;
use App\models\DB;

/**
 * контроллер для обработки страницы сообщения
 * ControllerPage class
 */
class ControllerPage extends Controller
{

    /**
     * @var int id
     * id сообщения
     */
    public $id;

    /** конструктор класса
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
        $this->view = new View();
    }

    /**
     * метод для обработки страницы сообщения
     * @return void
     */
    function action_index(): void
    {
        $data = [
            'errors' => [],                            // массив ошибок
            'id' => $this->id,                       // сохраняем id текущего сообщения
        ];

        // обработка кнопки добавления сообщения
        if (isset($_POST['action']) && isset ($_POST['commentText'])) {

            $reg = true;                                                            // флаг разрешения записи

            // защита от xss атак
            $commentText = htmlspecialchars($_POST['commentText']);

            // так как все данные текстовые, то кроме длины комментария проверять нечего. По ТЗ проверки не оговариваются
            // запись комментария в БД
            if ($reg == true) {
                $id = false; // если произойдёт ошибка при записи и id не будет возвращен
                // запись комментария в БД
                $id = DB::saveComment($data['id'], $commentText);
                if (!$id) {
                    $data['errors'] [] = "Во время записи комметария в БД произошла ошибка";
                }
            }
        }

        $this->view->generate('page_view.php', 'template_view.php', $data);        // генерация изображения
    }

}


