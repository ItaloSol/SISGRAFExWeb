<?php
//Credenciais de acesso ao BD
// define('HOST', '127.0.0.1');
// define('USER', 'root');
// define('PASS', '');
// define('DBNAME', 'bancosv1');


if(isset($_SESSION['bd'])){
    if($_SESSION['bd'][0] == 'bd1'){
        define('HOST', '10.166.64.212');
        define('USER', 'root');
        define('PASS', 'admin123');
        define('DBNAME', 'bala_dev');
    }
    if($_SESSION['bd'][0] == 'bd2'){
        define('HOST', '10.166.64.212');
    define('USER', 'root');
    define('PASS', 'admin123');
    define('DBNAME', 'bala_dev2');
    }
    if($_SESSION['bd'][0] == 'bd3'){
        $servidor = "127.0.0.1";
        $usuario = "root";
        $senha = "";
        $dbname = "bala_dev";
    }
}else{
    define('HOST', '10.166.64.212');
define('USER', 'root');
define('PASS', 'admin123');
define('DBNAME', 'bala_dev');
}

$conn = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';', USER, PASS);

