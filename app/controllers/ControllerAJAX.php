<?php

namespace App\controllers;

use App\models\DB;

/**
 * контроллер для обработки AJAX запросов
 */
class ControllerAJAX
{

    /**
     * Инициализация AJAX-запроса
     */

    public static function handle(): void
    {
        //  header("Content-Type: application/json; charset=utf-8");

        if (isset($_POST['act'])) {

            switch ($_POST['act']) {
                // загрузка соообщений для текущей страницы с номером page
                case "getAllmes":
                    if (!isset($_POST['page'])) {
                        throw new \Exception('Page parameter missing.');
                    }
                    self::getAllMessages((int)$_POST['page']);
                    break;

                // загрузка сообщения по id
                case "getMesById":
                    if (!isset($_POST['id'])) {
                        throw new \Exception('ID parameter missing.');
                    }
                    self::getMessageById((int)$_POST['id']);
                    break;

                // загрузка всех комметариев одного сообщения по id сообщения
                case "getCommByIdMes":
                    if (!isset($_POST['id'])) {
                        throw new \Exception('Message ID parameter missing.');
                    }
                    self::getCommentsByMessageId((int)$_POST['id']);
                    break;

                // изменение текста сообщения по id сообщения
                case "updateMesById":
                    if (!isset($_POST['id'], $_POST['text'])) {
                        throw new \Exception('ID or text parameter missing.');
                    }
                    self::updateMessageById((int)$_POST['id'], $_POST['text']);
                    break;

                default:
                    throw new \Exception('Unknown action.');
            }           // switch
        }           // if

    }

    // загрузка соообщений для текущей страницы с номером page
    private static function getAllMessages(int $page): void
    {
        $arr = DB::getAllMessage($page);
        self::sendJsonResponse($arr);
    }

    // загрузка сообщения по id
    private static function getMessageById(int $id): void
    {
        $arr = DB::getMessageById($id);
        self::sendJsonResponse($arr);
    }

    // загрузка всех комметариев одного сообщения по id сообщения
    private static function getCommentsByMessageId(int $id): void
    {
        $arr = DB::getCommentsByIdOfMes($id);
        self::sendJsonResponse($arr);
    }

    // изменение текста сообщения по id сообщения
    private static function updateMessageById(int $id, string $text): void
    {
        $status = DB::updateMessageById($id, $text);
        $response = ['status' => $status ? 'ok' : 'error'];
        self::sendJsonResponse($response);
    }

    /**
     * отправка JSON от сервера на front
     * @param array $data
     * @return void
     * @throws \JsonException
     */
    private static function sendJsonResponse(array $data): void
    {
        try {
            echo json_encode($data, JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            self::sendErrorResponse('JSON encoding error.');
        }
    }

    /**
     * отправка сообщения об ошибке от сервера на front
     * @param string $message
     * @return void
     */
    private static function sendErrorResponse(string $message): void
    {
        http_response_code(400);
        echo json_encode(['error' => $message]);
        exit;
    }

}