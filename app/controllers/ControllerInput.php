<?php
namespace App\controllers;
use App\core\Controller;
use App\core\View;
use App\models\DB;


//контроллер входной страницы
class ControllerInput extends Controller	{

	public function __construct()	{				
	 	$this->view = new View();					// инициализация объекта представления
	}

	function action_index()	{

        /** @var array $data */

        $data = [
		'errors' => [],							// массив ошибок
		'messages'=>[],							// массив сообщений
        'reg' => false,							// флаг успешной записи сообщения
	];

//        $rt = DB::get_message_table();
//echo '<pre>';
//print_r($rt); die();


        // обработка кнопки добавления сообщения
        if (isset($_POST['action']) && isset ($_POST['title']) && isset ($_POST['author']) && isset ($_POST['brief']) && isset ($_POST['message']))	{

            $reg=true; 															// флаг разрешения записи

            // проверка длины вводимых данных дублирует ограничение на уровне html
            // поэтому заккоментировано
            // так как все данные текстовые, то проверять больше нечего

            // безопасность вводимых данных
            $title = htmlspecialchars($_POST['title']);
            $author = htmlspecialchars($_POST['author']);
            $brief = htmlspecialchars($_POST['brief']);
            $message = htmlspecialchars($_POST['message']);

//            if (mb_strlen($title) > 25 || mb_strlen($title) < 3)	{
//                $data['errors'] [] = "Заголовок должен быть не менее 3 и не больше 25символов";
//                $reg=false;
//            }
//
//            if (mb_strlen($author) > 25 || mb_strlen($author) < 3)	{
//                $data['errors'] [] = "ФИО автора должно быть не менее 5 и не больше 20 символов";
//                $reg=false;
//            }
//
//            if (mb_strlen($brief) > 40 || mb_strlen($brief) < 5)	{
//                $data['errors'] [] = "Краткое содержание должно быть не менее 5 и не больше 40 символов";
//                $reg=false;
//            }
//
//            if (mb_strlen($message) < 5)	{
//                $data['errors'] [] = "Сообщение должно быть не менее 5 символов";
//                $reg=false;
//            }

            // так как все данные текстовые, то проверять больше нечего. По ТЗ проверки не оговариваются

            // запись сообщения в БД
            if ($reg==true) {

                $id =false; // если произойдёт ошибка при записи и id не будет возвращен
                $id = DB::save_message ($title, $author, $brief, $message);

                if ($id) {
                    $data['reg']=true;  //  для вывода надписи об успешной записи
                }	else $data['errors'] [] = "Во время записи сообщения в БД произошла ошибка";
            }
        } 	//	if (isset($_POST['action'])...

		$this->view->generate('input_view.php', 'template_view.php', $data);		// генерация view
	}
}

