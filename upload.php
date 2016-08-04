<?php

require_once 'vendor/autoload.php';

try {
    $auditoria = MT4\Singleton\Auditoria::getInstance();
    $file = new MT4\File($_FILES['cFile']);

    if (isset($_GET['id'])) {

        if (!$file->isValid($_GET['id'])) {
            header('Location: index.php?e');
        } else {
            header('Location: index.php?v');
        }
    } else {
        if ($file->upload()) {
            header('Location: index.php');
        }
    }

} catch (Exception $e) {
    $e->errorMessage();
}
