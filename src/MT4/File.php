<?php

/*
----------------------
File
-----------------------
Description:
This class has a goal to instantiate a file (set the fields like hash) and save
on database by the trait on line 18 like also verify if a field is valid from DB.

 */

namespace MT4;

class File
{

    use \MT4\ActiveRecord\AuditoriaDB;

    private $status = false;
    private $file_tmp;
    private $file_name;
    private $size;
    private $type;
    private $hash;

    private $file;

    private static $files;

    public function __construct($FILE)
    {

        $this->file_tmp = $FILE['tmp_name'];
        $this->file_name = $FILE['name'];
        $this->hash = hash_file('md5', $FILE['tmp_name']);
        $this->size = $FILE['size'];
        $this->type = $FILE['type'];
    }

    public function upload()
    {

        $move = move_uploaded_file($this->file_tmp, \MT4\Singleton\Auditoria::getUploadFolder() . $this->file_name);

        if (!$move) {
            return false;
        }

        self::makeData();

        if (!self::insert($this->file)) {
            return false;
        }

        return true;

    }

    private function makeData()
    {
        $this->file['type'] = $this->type;
        $this->file['size'] = $this->size;
        $this->file['name'] = $this->file_name;
        $this->file['name_tmp'] = $this->file_tmp;
        $this->file['hash'] = $this->hash;
        $this->file['status'] = $this->status;
    }

    public function isValid($id_file)
    {
        $hash_id_file = self::getHash($id_file)['HASH'];
        $hash_new_file = hash_file('md5', $this->file_tmp);

        if ($hash_id_file === $hash_new_file) {
            return true;
        }

        return false;
    }
}
