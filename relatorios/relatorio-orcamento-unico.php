<?php
$cod_orcamento = $_GET['cod'];
$parte1 = '<img src="../assets/img/cabecalho_orcamento.png" style=" margin-left: 60px; margin-top: 0px; padding-top: 0px; top: 0px; justify-content: center; align-items: center; text-align: center; height: 150px">';
$parte2 = '<br><div style="text-align: center;"><br><b>PROPOSTA DE ORÇAMENTO Nº 6774 / ORDEM DE PRODUÇÃO Nº [67741]</b></div>
<div>_______________________________________________________________________________________________________</div>
<div style=" padding-top: 10px; padding-bottom: -8px; align-items: center; justify-content: center; text-align: center;">CÓDIGO EMISSOR: ADM DATA EMISSÃO: 06/12/2022 HORA EMISSÃO: 10:49:58</div>
<div>_______________________________________________________________________________________________________</div>
<div style="text-align: center;"><b>INFORMAÇÕES DO CLIENTE</b></div>
<br>
<div style="width: 85%;">
<div>CLIENTE: GABINETE DO COMANDANTE DO EXÉRCITO CÓDIGO CLIENTE: 83</div>
<div>CONTATO: ST ROGER TELEFONE PRINCIPAL: (61) 3415-4366 </div><div>TELEFONE SECUNDÁRIO:</div>
<div>VENDEDOR: SD NQR2C MORAIS</div>
<div>OBSERVAÇÕES: null</div>
</div>
<div>_______________________________________________________________________________________________________</div>
<div  style="text-align: center; padding-top: 4px;"><b>DESCRIÇÃO DO ORÇAMENTO</b></div>
<br>
CÓDIGO PRODUTO: 6844
BANNER - GAB CMT EX - LONA VÍNILICA - 4X0 - SEM ACABAMENTO - 2,20X1,10. QUANTIDADE: 2 TAMANHO: 110.0 X 220.0
PÁGINAS: 1
<div>_______________________________________________________________________________________________________</div>
<div  style="padding-top: 10px;  padding-bottom: -8px; align-items: center; justify-content: center; text-align: center;"><b>SERVIÇOS DO ORÇAMENTO</b></div>
<div>_______________________________________________________________________________________________________</div>
<div  style="text-align: center;  padding-top: 4px;"><b>DESCRIÇÃO DE VALORES</b></div>
<div> <br>
<table style="border-collapse: unset;" border="1">
<tr align="center" >
<th>CÓDIGO PRODUTO</th>
<th>DESCRIÇÃO</th>
<th>VALOR UNITARIO</th>
<th>QUANTIDADE</th>
<th>VALOR TOTAL</th>
</tr>
<tr align="center">
<td align="center">6844</td>
<td align="center">BANNER - GAB
CMT EX - LONA
VÍNILICA - 4X0 -
SEM
ACABAMENTO -
2,20X1,10</td>
<td align="center">138.60</td>
<td align="center">2</td>
<td align="center">277,20</td>
</tr><tr>
<td align="right" colspan="4">TOTAL (R$)</td>
<td align="center">277,20</td>
</tr>
</table>
</div>
<div>_______________________________________________________________________________________________________</div>
OBSERVAÇÕES DO ORÇAMENTO: <BR>
<BR>
<div>
<b>VALIDADE DA PROPOSTA: 06/01/2023 <br>
Método de pagamento: <br>
<div style="font-size: 13px;"><b> TRANSFERÊNCIA ENTRE CONTAS, OPÇÃO PAGAMENTO DE SERVIÇO (POR NOTA DE CRÉDITO
FAVORECIDO – UG 160083 E UG 167083 PARA ND 33 90 00 , ND 33 90 30 OU 33 90 39).</b></div></div><br>
<div  style="text-align: center; background-color: #d4d4d4;"><b>ENTREGA: ______ DIAS ÚTEIS APÓS A APROVAÇÃO DO "MODELO DE PROVA"</b></div><br>
<div  style="text-align: center;  background-color: #d4d4d4;"><div  style="font-size: 14px;"><b>AUTORIZO A INSERÇÃO DO QR CODE DA GRÁFICA DO EXÉRCITO NA 4ª CAPA ( ) SIM ( ) NÃO</b></div></div>
<div style="text-align: center;   display: solid; align-items: center; justify-content: center; "> <br><br><br><br><br><br>
<p style="text-align: center; margin-left: 25%; margin-right: 25%; width: 50%; ">BRASÍLIA-DF, 08/02/2023. <br><br>
________________________________________________
SD NQR2C MORAIS
GRÁFICA DO EXÉRCITO - DIVISÃO COMERCIAL
<br><br>
________________________________________________
GABINETE DO COMANDANTE DO EXÉRCITO <br>
GAB CMT EX <br>
DATA:  &nbsp; &nbsp;   &nbsp;  de &nbsp;&nbsp;  &nbsp;     &nbsp;  &nbsp;   &nbsp;   &nbsp; de  </p>
</div>
';


$html = $parte1 . $parte2;
require_once __DIR__ . '../../vendor/autoload.php';

// Create an instance of the class:
$mpdf = new \mPDF();
$mpdf = new mPDF('C', 'A4');
$mpdf->SetBasePath('../assets/img');
$mpdf->Image('cabecalho_orcamento.png', 'png', '', true, false, 300, '', false, false, 0, false, false);
$mpdf->SetDisplayMode('fullpage');

$mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first 
//level of a list

// LOAD a stylesheet

$mpdf->WriteHTML($html, 2);
$nome = 'Orçamento' . $cod_orcamento;
$mpdf->Output($nome, 'I');
exit;
