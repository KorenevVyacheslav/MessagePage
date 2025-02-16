<?php
namespace App\controllers;
use App\core\Controller;
use App\core\View;
use App\models\DB;

// контроллер страницы сообщения
class ControllerPage extends Controller {

    public $id;                                     // id сообщения
	public function __construct( $id )	{
        $this->view = new View();					// инициализация  View страницы
        $this->id = $id;
   }

   function action_index()	{

      $data = [
       'errors' => [],							// массив ошибок
       'id' => $this->id,                       // сохраняем id текущего сообщения
   ];

       // обработка кнопки добавления сообщения
       if (isset($_POST['action']) && isset ($_POST['commentText']) )	{

           $reg=true; 															// флаг разрешения записи

           // безопасность вводимых данных
           $commentText = htmlspecialchars($_POST['commentText']);
           // так как все данные текстовые, то кроме длины комментария проверять нечего. По ТЗ проверки не оговариваются

           // запись комментария в БД
           if ($reg==true) {
               $id =false; // если произойдёт ошибка при записи и id не будет возвращен
               // запись комментария в БД
               $id = DB::save_comment ($data['id'], $commentText);
               if (!$id) {
                   $data['errors'] [] = "Во время записи комметария в БД произошла ошибка";
               }
           }
       } 	//	if (isset($_POST['action'])...

       $this->view->generate('page_view.php', 'template_view.php', $data);		// генерация изображения
   }

}


