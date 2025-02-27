<?php
    namespace App;
    use App\models\DB;

    // при AJAX-запросе компилятор теряет все классы, поэтому надо их загружать по новому
    // загружаем все классы:
    require_once dirname(__DIR__, 1) . DIRECTORY_SEPARATOR. 'vendor' . DIRECTORY_SEPARATOR. 'autoload.php';
    require_once dirname(__DIR__, 1) . DIRECTORY_SEPARATOR.'config.php';
    require_once 'models' . DIRECTORY_SEPARATOR .'DB.php';

    if (isset($_POST['act'])) { 
        header("Content-Type: application/json; charset=utf-8");

        switch ($_POST['act']) {
            case "getAllmes" :
                // загрузка соообщений для текущей страницы с номером page
                $arr =DB::getAllMessage($_POST['page']);
                echo json_encode($arr);
                break;
            case "getMesById" :
                // загрузка сообщения по id
                $arr =DB::getMessageById($_POST['id']);
                echo json_encode($arr);
                break;
            case "getCommByIdMes" :
                // загрузка всех комметариев одного сообщения по id сообщения
                $arr =DB::getCommentsByIdOfMes($_POST['id']);
                echo json_encode($arr);
                break;
            case "updateMesById" :
                // изменение текста сообщения по id сообщения
                $status =DB::updateMessageById($_POST['id'], $_POST['text']);
                if ($status)  $response['status'] = 'ok';
                else $response['status'] = 'error';
                echo json_encode($response);
                break;
            default :
            exit();
        }
    }








