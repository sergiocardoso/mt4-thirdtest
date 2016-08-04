<?php

/*
----------------------
TRAIT AuditoriaDB
-----------------------
Methods:
connect()
first verify on the singleton class the name and url of database and in sequence try connect

getHash(int id)
make a query to get the specific hash from ID save on database

listFiles()
get all files from db

insert()
insert a record on database

 */

namespace MT4\ActiveRecord;

trait AuditoriaDB
{
    protected static $db;
    private $userdb = 'root';
    private $passdb = 'root';

    public static function connect()
    {
        try {
            self::$db = new \PDO('sqlite:' . \MT4\Singleton\Auditoria::getInstance()->getDatabase());
        } catch (PDOException $e) {
            print 'Connection Error --->' . $e->getMessage();
            die;
        }
    }

    public function __desctruct()
    {
        self::$db = null;
    }

    public static function getHash($id)
    {
        self::connect();

        $SQL = "SELECT DISTINCT HASH FROM files WHERE id like :id_file";
        $result = self::$db->prepare($SQL);
        $result->execute(array(':id_file' => $id));

        $data = $result->fetch();

        return $data;
    }

    public static function listFiles()
    {
        self::connect();

        $SQL = "SELECT DISTINCT id, status, name, HASH, type FROM files";
        $result = self::$db->prepare($SQL);
        $result->execute();

        $data = $result->fetchAll();

        return $data;
    }

    public function insert($file)
    {

        self::connect();

        $SQL = "INSERT INTO files(
                status,
				type,
				SIZE,
				name,
				name_tmp,
				HASH) VALUES (
                1,
				:type,
				:size,
				:name,
				:name_tmp,
				:hash)";

        $query = self::$db->prepare($SQL);
        $query->bindParam(':type', $file['type'], \PDO::PARAM_STR);
        $query->bindParam(':size', $file['size'], \PDO::PARAM_STR);
        $query->bindParam(':name', $file['name'], \PDO::PARAM_STR);
        $query->bindParam(':name_tmp', $file['name_tmp'], \PDO::PARAM_STR);
        $query->bindParam(':hash', $file['hash'], \PDO::PARAM_STR);

        if (!$query->execute()) {
            return false;
        }

        return true;
    }
}
