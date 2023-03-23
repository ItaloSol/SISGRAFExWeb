<?php
session_start();
include_once('../conexoes/conexao.php');
include_once('../conexoes/conn.php');
require_once '../vendor/phpqrcode-master/qrlib.php';


// ID da opção enviado pelo JavaScript
$opcaoId = $_GET["cod"];

// Gerar a imagem SVG com base no ID da opção e imprimir a saída
echo gerarQRCode($opcaoId);

// Função para gerar a imagem SVG do QR Code
function gerarQRCode($opcaoId) {
  $url = 'http://www.graficadoexercito.eb.mil.br/sisgrafex/producao/tl-controle-op.php?cod='.$opcaoId;
  // Lógica para gerar o QR Code aqui...
  // Retorne a imagem SVG como uma string
  return QRcode::svg($url);
}
?>