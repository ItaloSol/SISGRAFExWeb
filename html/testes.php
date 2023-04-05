<?php
$duracao = 28800 ; // 1 dia em segundos
ini_set('session.gc_maxlifetime', $duracao);
session_set_cookie_params($duracao);
session_start();
phpinfo();