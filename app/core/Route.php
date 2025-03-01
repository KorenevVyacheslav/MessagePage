<?php
namespace App\core;
use App\controllers\Controller404;

class Route	{

	static function start()	{
		// контроллер и действие по умолчанию
		$controller_name = 'Input';							// стартуем со страницы input
		$action_name = 'index';
        $id = null;

		$routes = explode('/', $_SERVER['REQUEST_URI']);

		// получаем имя контроллера
		 if ( !empty($routes[1]) )	 {	
		 	$controller_name = $routes[1];					//
		 }

		 //получаем имя экшена
		if ( !empty($routes[2]) )	 {
		 	$action_name = $routes[2];							 
		}

        //получаем id
        if ( !empty($routes[3]) )	 {
            $id = $routes[3];
        }

		$controller_name = 'Controller'.ucfirst (strtolower($controller_name));  		//  ControllerInput

		$action_name = 'action_'.$action_name;											//  action_index

		// подключаем файл с классом контроллера
		$controller_file = $controller_name.'.php';					
		$controller_path = CONTROLLERS.$controller_file;			

		if (file_exists($controller_path))	{
			include CONTROLLERS.$controller_file;						                //   подключаем файл контроллера
		}
		else   {	
			Route::ErrorPage();			
			return;
		}

		// создаем контроллер
		$controller_class= CONTROLLERS_NAMESPACE.$controller_name;          // app\controllers\ControllerInput

        if ($controller_name == 'ControllerPage' && !is_null($id))      {   // объект ControllerPage нужно вызывать с передачей в него id cообщения
            $controller = new $controller_class ($id);
        }  else $controller = new $controller_class;	                    // $controller = new app\controllers\ControllerInput

		$action = $action_name;										        // $action = action_index

		if (method_exists($controller, $action))	{
					$controller->$action(); 							    // вызываем действие контроллера
		}				
		else   {
			Route::ErrorPage();						
			return;		
		}
	}

	public static function ErrorPage()	{
		require_once CONTROLLERS.'Controller404.php';												
		$controller = new Controller404; 
		$controller->action_index();

         $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
         header('HTTP/1.1 404 Not Found');
		 header("Status: 404 Not Found");
		 header('Location:'.$host.'404');
    }
}

