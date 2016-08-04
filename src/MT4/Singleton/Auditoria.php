<?php

/*
----------------------
Singleton AUDITORIA
-----------------------
Description:
this class in singleton design pattern has the objective get all global information like folder for upload
files, folder where database is, set configuration from INI file, etc.

 */

namespace MT4\Singleton;

use MT4;

class Auditoria
{

    public static $instance;
    private static $database;
    private static $upload_folder;
    private static $root_path;

    private function __construct()
    {}
    private function __clone()
    {}

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Auditoria();
            self::setConfiguration();
        }

        return self::$instance;
    }

    private static function setConfiguration()
    {
        if (!file_exists('auditoria.ini')) {
            throw new \MT4\AuditoriaException("File auditoria.ini not found!");
        } else {
            $ini = parse_ini_file('auditoria.ini');
            self::$database = $ini['database_folder'];
            self::$upload_folder = $ini['upload_folder'];
            self::$root_path = $ini['path'];
        }
    }

    public function getDatabase()
    {
        return self::$database;
    }

    public static function getUploadFolder()
    {
        //if the upload_folder not containt the slash in last position, add!
        if (substr(self::$upload_folder, -1) != "/") {
            self::$upload_folder .= '/';
        }

        if (!file_exists(self::$root_path . '/' . self::$upload_folder)) {
            throw new \MT4\AuditoriaException("This folder [ " . self::$root_path . '/' . self::$upload_folder . " ] not exists!");
        }

        return self::$upload_folder;

    }

    public function check()
    {
        if (isset($_GET['e'])) {
            self::message("Arquivo inválido ou corrompido!", "red");
        }

        if (isset($_GET['v'])) {
            self::message("Este arquivo é válido e não foi corrompido!", "green");
        }
    }

    public function message($string, $type)
    {
        $HTML = '<div style="background:' . $type . '; padding:10px; color:white;">';
        $HTML .= $string;
        $HTML .= '</div>';

        echo $HTML;
    }

}
