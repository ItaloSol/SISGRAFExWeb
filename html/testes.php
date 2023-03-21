<?php
$duracao = 28800 ; 
ini_set('session.cookie_lifetime', $duracao);
ini_set('session.gc_maxlifetime', $duracao);
session_set_cookie_params($duracao);
session_cache_expire(480);
session_start();
//phpinfo();
$tempoDeVidaMinutos = session_cache_expire();

// Converte o tempo de vida em segundos
$tempoDeVidaSegundos = $tempoDeVidaMinutos * 60;
echo ini_get('session.gc_maxlifetime'); // CORRETO[
echo '<br>';
 echo  $tempoDeVidaMinutos ; // ERRADO ESTÁ MOSTRANDO 180 ERA PARA APARECER 480