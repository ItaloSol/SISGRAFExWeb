<?php
$html = '<table border="1">
<tr>
    <td>Nome</td>
    <td>Idade</td>
    <td>Profissão</td>
</tr>
<tr>
    <td>Ted</td>
    <td>22</td>
    <td>Estudante</td>
</tr>
<tr>
    <td>Ralf</td>
    <td>26</td>
    <td>Designer</td>
</tr>
</table>';
require_once __DIR__ . '../../vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \mPDF();

// Write some HTML code:
$mpdf = new mPDF('C','A4'); 

$mpdf->SetDisplayMode('fullpage');

$mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first 
 //level of a list

// LOAD a stylesheet

$mpdf->WriteHTML($html,2);

$mpdf->Output('mpdf.pdf','I');
exit;