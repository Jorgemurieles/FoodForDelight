<?php

if ($libs = opendir(__DIR__.'/includes')) {
   while (false !== ($chk = readdir($libs))) {
        if ($chk != "." && $chk != "..") {
            include __DIR__.'/includes/'.$chk;
        }
    }
    closedir($libs);
}

if ($libs = opendir(__DIR__.'/phpmailer')) {
   while (false !== ($chk = readdir($libs))) {
        if ($chk != "." && $chk != "..") {
            include __DIR__.'/phpmailer/'.$chk;
        }
    }
    closedir($libs);
}

/* Aqui agregamos las funciones que necesitaremos */
include __DIR__.'/functions.php';

// Para evitar los XSS
$xss = new Core\XSS();
$router = new Core\Router();
$logon = new LogonAuth();

$url = $xss->XSString($_SERVER['QUERY_STRING']);
$logon -> session_process();
$router->URL($url);
