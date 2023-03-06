<?php
$cod_orcamento = $_GET['cod'];
$html = 'nada aqui';




require_once __DIR__ . '../../vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \mPDF();
$mpdf = new mPDF('C', 'A4');

$mpdf->SetDisplayMode('fullpage');

$mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first 
//level of a list

// LOAD a stylesheet

$mpdf->WriteHTML($html, 2);
$nome = 'Orçamento' . $cod_orcamento;
$mpdf->Output($nome, 'I');
exit;
