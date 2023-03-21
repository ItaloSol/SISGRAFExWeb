<?php
   
      // $server = "127.0.0.1";
        // $usuario = "root";
        // $senha = "";
        // $banco = "bancosv1";
        // $server = "10.166.64.212";
        // $usuario = "root";
        // $senha = "admin123";
        // $banco = "bala_dev";
        
            $server = "10.166.64.212";
            $usuario = "root";
            $senha = "admin123";
            $banco = "bala_dev";
        
    try{
        $conexao = new PDO("mysql:host=$server;dbname=$banco", $usuario, $senha, array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8"));
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     //  echo "conexão feita";
    }catch(PDOException $erro){
        echo "Ocorreu um erro de conexao: {$erro->getMessage()}";
        $conexao = null;
    }
?>