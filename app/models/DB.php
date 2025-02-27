<?php

namespace App\models;

use PDO;
use PDOException;

/**
 * класс - обертка для работы с БД MySQL
 * DB class
 */
class DB
{
    /**
     * Data Source Name
     * строка для подключения к БД
     * @var string
     */
    public static $dsn = 'mysql:dbname=' . DB_NAME . ';host=' . HOST . '';

    /**
     * имя пользователя
     * @var string
     */
    public static $user = USER;

    /**
     * пароль
     * @var string
     */
    public static $pass = PASSWORD;

    /**
     * объект PDO (database handler)
     * для обращения к БД
     */
    public static $dbh = null;

    /**
     * подготовленный запрос (statement handle).
     */
    public static $sth = null;

    /**
     * Выполняемый SQL запрос.
     */
    public static $query = '';

    /**
     * Метод для подключения к БД.
     * реализуем паттерн Singleton
     * @return PDO
     */
    public static function getDbh()
    {
        if (!self::$dbh) {
            try {
                self::$dbh = new PDO(
                    self::$dsn,
                    self::$user,
                    self::$pass,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
                );
                // Устанавливаем режим, при котором PDO генерирует предупреждения
                self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            } catch (PDOException $e) {
                exit('Error connecting to database: ' . $e->getMessage());
            }
        }
        return self::$dbh;
    }

    // получение всех записей таблицы messages

    /**
     * Метод получения записей из таблицы messeges для определённой страницы
     * номер страницы
     * @param $page
     * @return array
     */
    public static function getAllMessage($page)
    {
        $perpage = 3;                           // количество сообщений на страницу
        $offset = ($page - 1) * $perpage;       // вычисляем смещение для запроса к БД

        // Запрос к БД для получения сообщений с учетом пагинации
        $query = "SELECT * FROM messeges LIMIT :perpage OFFSET :offset";
        self::$sth = self::getDbh()->prepare($query);
        self::$sth->bindValue('perpage', $perpage, PDO::PARAM_INT);
        self::$sth->bindValue('offset', $offset, PDO::PARAM_INT);
        self::$sth->execute();
        $messages = self::$sth->fetchAll(PDO::FETCH_ASSOC);

        // Запрос к БД для получения общего количества сообщений
        $query = "SELECT COUNT(*) FROM messeges";
        self::$sth = self::getDbh()->prepare($query);
        self::$sth->execute();
        $totalMessages = (self::$sth->fetch(PDO::FETCH_ASSOC)) ['COUNT(*)'];

        return (['messages' => $messages, 'total' => $totalMessages]);
    }

    /**
     * Метод получения сообщения по id
     * @param $id
     * @return mixed
     */
    public static function getMessageById($id)
    {
        $query = "SELECT * FROM messeges WHERE id = :id";
        self::$sth = self::getDbh()->prepare($query);
        self::$sth->execute(array('id' => $id));
        return self::$sth->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Метод получения всех комметариев к сообщению
     * по id сообщения
     * @param $id
     * @return array
     */
    public static function getCommentsByIdOfMes($id)
    {
        $query = "SELECT * FROM comments WHERE messege_id= :id";
        self::$sth = self::getDbh()->prepare($query);
        self::$sth->execute(array('id' => $id));
        return self::$sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Метод для сохранения сообщения
     * заголовок
     * @param string $title
     * автор
     * @param string $author
     * краткое содержание
     * @param string $brief
     * сообщение
     * @param string $message
     * @return false|int
     */
    public static function saveMessage($title, $author, $brief, $message)
    {
        $query = "INSERT INTO messeges SET `title` = :title , `author` = :author, `brief` = :brief, `text_` = :message";
        self::$sth = self::getDbh()->prepare($query);
        return (self::$sth->execute(array('title' => $title, 'author' => $author, 'brief' => $brief, 'message' => $message))) ? self::getDbh()->lastInsertId() : 0;
    }

    // внесение изменений в текст сообщения по его id

    /**
     * Метод для изменения существующего сообщения по id
     * @param $id
     * текст сообщения
     * @param $newText
     * @return false|int
     */
    public static function updateMessageById($id, $newText)
    {
        $query = "UPDATE messeges SET `text_` = :text WHERE `id` = :id";
        self::$sth = self::getDbh()->prepare($query);
        return (self::$sth->execute(array('text' => $newText, 'id' => $id))) ? $id : 0;
    }

    // добавление комментария к сообщению по id сообщения

    /**
     * Метод записи комметария
     * id сообщения
     * @param $mesId
     * текст комметария
     * @param $commentText
     * @return false|int
     */
    public static function saveComment($mesId, $commentText)
    {
        $query = "INSERT INTO comments SET `text_` = :text, `messege_id` = :messege_id";
        self::$sth = self::getDbh()->prepare($query);
        // сохраняем комментарий и получаем id сохранённого комментария
        return (self::$sth->execute(array('text' => $commentText, 'messege_id' => $mesId))) ? self::getDbh()->lastInsertId() : 0;

    }

}






