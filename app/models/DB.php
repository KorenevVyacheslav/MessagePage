<?php
namespace App\models;

use PDO;
use PDOException;

// класс - обертка для работы с БД MySQL
class DB {

	public static $dsn = 'mysql:dbname='.DB_NAME.';host='.HOST.'';
	public static $user = USER;
	public static $pass = PASSWORD;
 
	/**
	 * Объект PDO.
	 */
	public static $dbh = null;
 
	/**
	 * Statement Handle.
	 */
	public static $sth = null;
 
	/**
	 * Выполняемый SQL запрос.
	 */
	public static $query = '';
 
	/**
	 * Подключение к БД.
     * Реализуем паттерн Singleton
     * чтобы подключиться к БД только один раз
	 */
	public static function getDbh()
	{	
		if (!self::$dbh) {
			try {
				self::$dbh = new PDO(
					self::$dsn, 
					self::$user, 
					self::$pass, 
					//array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
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
    public static function get_message_table()	{
        $query = "SELECT * FROM messeges";
        self::$sth = self::getDbh()->prepare($query);
        self::$sth->execute();
        return self::$sth->fetchAll(PDO::FETCH_ASSOC);
    }

    // получение сообщения по id
    public static function get_message_byId($id)
    {
        $query = "SELECT * FROM messeges WHERE id = :id";
        self::$sth = self::getDbh()->prepare($query);
        self::$sth->execute(array('id' => $id));
        return self::$sth->fetch(PDO::FETCH_ASSOC);
    }

    // получение всех комментариев сообщения по его id
    public static function get_comments_by_Id_mes($id)
    {
       // $query = "SELECT messege_id FROM pivot WHERE comment_id = :id";
        $query = "SELECT * FROM comments WHERE id IN (SELECT comment_id FROM pivot WHERE messege_id = :id)";
        self::$sth = self::getDbh()->prepare($query);
        self::$sth->execute(array('id' => $id));
        return self::$sth->fetchAll(PDO::FETCH_ASSOC);
    }

    // добавление нового сообщения
    public static function save_message($title, $author, $brief, $message)
    {
        $query = "INSERT INTO messeges SET `title` = :title , `author` = :author, `brief` = :brief, `text_` = :message";
        self::$sth = self::getDbh()->prepare($query);
        return (self::$sth->execute(array ('title' => $title, 'author' => $author, 'brief' => $brief, 'message' => $message)) )? self::getDbh()->lastInsertId() : 0;
    }

    // внесение изменений в текст сообщения по его id
    public static function update_message_by_Id ($id, $newText)
    {
        $query = "UPDATE messeges SET `text_` = :text WHERE `id` = :id";
        self::$sth = self::getDbh()->prepare($query);
        return (self::$sth->execute(array ('text' => $newText, 'id' => $id)) )? $id : 0;
    }

    // добавление комментария к сообщению по id сообщения
    public static function save_comment ($mesId, $commentText)
    {
        $query = "INSERT INTO comments SET `text_` = :text";
        self::$sth = self::getDbh()->prepare($query);
        // сохраняем комментарий и получаем id сохранённого комментария
        $commentId = (self::$sth->execute(array ('text' => $commentText)) )? self::getDbh()->lastInsertId() : 0;

        // сохраняем запись в pivot
        $query = "INSERT INTO pivot SET `comment_id` = :commentId, `messege_id` = :messege_id";
        self::$sth = self::getDbh()->prepare($query);
        return (self::$sth->execute(array ('commentId' => $commentId, 'messege_id' => $mesId)) )? self::getDbh()->lastInsertId() : 0;
    }
	
}






