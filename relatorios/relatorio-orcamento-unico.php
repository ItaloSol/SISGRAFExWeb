<?php
session_start();
include_once('../conexoes/conexao.php');
include_once('../conexoes/conn.php');
$cod_emissor_relatorio = $_SESSION['usuario'][2];
$nome_emissor_relatorio = $_SESSION['usuario'][0];
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
$cod_orcamento = $_GET['cod'];
$papels = 0;
$produtos = 0;
$ops = 0;
$servicos = 0;
$qtd_acabamentos = 0;
$query_op = $conexao->prepare("SELECT * FROM tabela_produtos_orcamento WHERE cod_orcamento = $cod_orcamento ");
$query_op->execute();
while ($linha = $query_op->fetch(PDO::FETCH_ASSOC)) {
  
    $quantidade = $linha['quantidade'];
    $QuantidadeT[$produtos] = $quantidade;
    $preco_unitario = $linha['preco_unitario'];
    $total = $quantidade * $preco_unitario;
    $tipo_produto = $linha['tipo_produto'];
    $cod_produto = $linha['cod_produto'];
   
    $query_orid_orc = $conexao->prepare("SELECT * FROM tabela_orcamentos WHERE cod = $cod_orcamento");
        $query_orid_orc->execute();

        if ($linha14 = $query_orid_orc->fetch(PDO::FETCH_ASSOC)) {
          $cod_cliente = $linha14['cod_cliente'];
          $cod_contato = $linha14['cod_contato'];
          $cod_endereco = $linha14['cod_endereco'];
          $data_validade = $linha14['data_validade'];
          $descricao_orc = $linha14['descricao'];
            $cod_emissor = $linha14['cod_emissor'];
            $tipo_cliente = $linha14['tipo_cliente'];
        }

    if ($tipo_produto == '1') {
        $query_produto = $conexao->prepare("SELECT * FROM produtos WHERE CODIGO = $cod_produto ");
    }
    if ($tipo_produto == '2') {
        $query_produto = $conexao->prepare("SELECT * FROM produtos_pr_ent WHERE CODIGO = $cod_produto ");
    }
    $query_produto->execute();
    if ($linha2 = $query_produto->fetch(PDO::FETCH_ASSOC)) {
        $PRODUTOS[$produtos] = [
      'largura' => $linha2['LARGURA'],
      'ALTURA' => $linha2['ALTURA'],
      'CODIGO' => $linha2['CODIGO'],
      'QTD_PAGINAS' => $linha2['QTD_PAGINAS'],
      'TIPO' => $linha2['TIPO'],
      'DESCRICAO' => $linha2['DESCRICAO']
        ];
    }
   
  
      
    
       
      
      
  
    if ($tipo_produto == 2) {
        $query_orid_orc = $conexao->prepare("SELECT * FROM tabela_produtos_orcamento WHERE tipo_produto = $tipo_produto AND cod_produto = $cod_produto AND cod_orcamento = $cod_orcamento");
        $query_orid_orc->execute();

        if ($linha14 = $query_orid_orc->fetch(PDO::FETCH_ASSOC)) {
            $quantidade = $linha14['quantidade'];
            $preco_unitario = $linha14['preco_unitario'];
            $total = $quantidade * $preco_unitario;
        }
    }
    $atendente = $conexao->prepare("SELECT * FROM tabela_atendentes WHERE codigo_atendente = '$cod_emissor' ");
    $atendente->execute();
    if ($linha6 = $atendente->fetch(PDO::FETCH_ASSOC)) {
        $nome_atendente = $linha6['nome_atendente'];
    }
    if ($tipo_cliente == '1') {
        $cliente = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos WHERE cod = $cod_cliente ");
        $cliente->execute();
        if ($linha7 = $cliente->fetch(PDO::FETCH_ASSOC)) {
            $nome_cliente = $linha7['nome'];
            $nome_fantasia = '';
        }
    }
    if ($tipo_cliente == '2') {
        $cliente = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos WHERE cod = $cod_cliente ");
        $cliente->execute();
        if ($linha7 = $cliente->fetch(PDO::FETCH_ASSOC)) {
            $nome_cliente = $linha7['nome'];
            $nome_fantasia = $linha7['nome_fantasia'];
        }
    }

    
        $endereco_cliente = $conexao->prepare("SELECT * FROM tabela_enderecos WHERE cod = $cod_endereco ");
        $endereco_cliente->execute();
        if ($linha10 = $endereco_cliente->fetch(PDO::FETCH_ASSOC)) {
            $cep = $linha10['cep'];
            $tipo_endereco = $linha10['tipo_endereco'];
            $logadouro = $linha10['logadouro'];
            $bairro = $linha10['bairro'];
            $uf = $linha10['uf'];
            $cidade = $linha10['cidade'];
            $complemento = $linha10['complemento'];
        
    }
    
        $endereco_cliente = $conexao->prepare("SELECT * FROM tabela_contatos WHERE cod = $cod_contato ");
        $endereco_cliente->execute();
        if ($linha11 = $endereco_cliente->fetch(PDO::FETCH_ASSOC)) {
            $nome_contato = $linha11['nome_contato'];
            $email = $linha11['email'];
            $telefone2 = $linha11['telefone2'];
            $telefone = $linha11['telefone'];
        
    }
    $produtos++;
}
$query_op_existe = $conexao->prepare("SELECT * FROM tabela_ordens_producao WHERE orcamento_base = $cod_orcamento");
$query_op_existe->execute();
while ($linhaOps = $query_op_existe->fetch(PDO::FETCH_ASSOC)) {
  $codigo_op = $linhaOps['cod'];
  $codio[$ops] = $codigo_op;
  $ops++;
 
$query_calculos_op = $conexao->prepare("SELECT * FROM tabela_calculos_op WHERE cod_op = $codigo_op AND tipo_produto = $tipo_produto ");
$query_calculos_op->execute();
while ($linha5 = $query_calculos_op->fetch(PDO::FETCH_ASSOC)) {
    $cod_papels = $linha5['cod_papel'];
    $cod_produtos = $linha5['cod_produto'];
    $calculo_tipo_papel = $linha5['tipo_papel'];
    $qtd_folhas = $linha5['qtd_folhas'];
    $qtd_folhas_total = $linha5['qtd_folhas_total'];
    $qtd_chapas = $linha5['qtd_chapas'];
    $montagem = $linha5['montagem'];
    $formato = $linha5['formato'];
    $perca = $linha5['perca'];

    $Calculo_calculo_tipo_papel[$papels] = $calculo_tipo_papel;
    $Calculo_qtd_folhas[$papels] = $qtd_folhas;
    $Calculo_qtd_folhas_total[$papels] = $qtd_folhas_total;
    $Calculo_qtd_chapas[$papels] = $qtd_chapas;
    $Calculo_montagem[$papels] = $montagem;
    $Calculo_formato[$papels] = $formato;
    $Calculo_perca[$papels] = $perca;

}
$query_papel = $conexao->prepare("SELECT * FROM tabela_papeis_produto WHERE tipo_produto = $tipo_produto AND cod_produto = $cod_produtos ");
$query_papel->execute();

if ($linha3 = $query_papel->fetch(PDO::FETCH_ASSOC)) {
  $tipo_papel = $linha3['tipo_papel'];
  $cod_papel = $linha3['cod_papel'];
  $cor_frente = $linha3['cor_frente'];
  $cor_verso = $linha3['cor_verso'];
  $descricao = $linha3['descricao'];
  $orelha = $linha3['orelha'];

  $Papel_tipo_papel[$papels] = $tipo_papel;
  $Papel_cod_papel[$papels] = $cod_papel;
  $Papel_cor_frente[$papels] = $cor_frente;
  $Papel_cor_verso[$papels] = $cor_verso;
  $Papel_descricao[$papels] = $descricao;
  $Papel_orelha[$papels] = $orelha;
}
$papels++;
}
$query_componente_orc = $conexao->prepare("SELECT * FROM tabela_componentes_orcamentos WHERE cod_orcamento = $cod_orcamento   ");
$query_componente_orc->execute();
$Servico_N = true;
while ($linha88 = $query_componente_orc->fetch(PDO::FETCH_ASSOC)) {
  $cod_componente_1 = $linha88['cod_componente_1'];
  $query_servicos = $conexao->prepare("SELECT * FROM tabela_servicos_orcamento WHERE cod = $cod_componente_1  ");
  $query_servicos->execute();
  if ($linha89 = $query_servicos->fetch(PDO::FETCH_ASSOC)) {
      $cod_servicoes = $linha89['cod'];
   
      $descricao_servicoes = $linha89['descricao'];
      $Do_servico_cod[$servicos] = $cod_servicoes;
      $Do_servico_descricao[$servicos] = $descricao_servicoes;
     
      $servicos++;
  }
  if (!isset($Do_servico_cod[0])){
      $Servico_N = '0';
  }
  $query_componente = $conexao->prepare("SELECT * FROM tabela_componentes_produto WHERE tipo_produto = $tipo_produto AND cod_produto = $cod_produto  ");
  $query_componente->execute();
  while ($linha12 = $query_componente->fetch(PDO::FETCH_ASSOC)) {
      $cod_acabamento = $linha12['cod_acabamento'];
      $query_acabamento = $conexao->prepare("SELECT * FROM acabamentos WHERE CODIGO = $cod_acabamento  ");
      $query_acabamento->execute();
      if ($linha13 = $query_acabamento->fetch(PDO::FETCH_ASSOC)) {

          $cod_acb = $linha13['CODIGO'];
          $Maquina = $linha13['MAQUINA'];
          $ATIVA = $linha13['ATIVA'];
          $CUSTO_HORA = $linha13['CUSTO_HORA'];

          $Do_Acabamento_cod[$qtd_acabamentos] = $cod_acb;
          $Do_Acabamento_Maquina[$qtd_acabamentos] = $Maquina;
          $Do_Acabamento_midida[$qtd_acabamentos] = $ATIVA;
          $Do_Acabamento_CUSTO_HORA[$qtd_acabamentos] = $CUSTO_HORA;
          $qtd_acabamentos++;
      }
  }
  $papels++;
}
if(!isset($nome_cliente)){
    $nome_cliente = 'NÃO ENCONTRADO';
}
if(!isset($cod_cliente)){
    $cod_cliente = 'NÃO ENCONTRADO';
}
if(!isset($nome_contato)){
    $nome_contato = 'NÃO ENCONTRADO';
}
if(!isset($telefone)){
    $telefone = 'NÃO ENCONTRADO';
}
if(!isset($telefone2)){
    $telefone2 = 'NÃO ENCONTRADO';
}
if(!isset($nome_atendente)){
    $nome_atendente = 'NÃO ENCONTRADO';
}
if(!isset($descricao_orc)){
    $descricao_orc = 'NÃO ENCONTRADO';
}
if(!isset($data_validade)){
    $data_validade = 'NÃO ENCONTRADO';
}
if(!isset($nome_atendente)){
    $nome_atendente = 'NÃO ENCONTRADO';
}
if(!isset($nome_fantasia)){
    $nome_fantasia = 'NÃO ENCONTRADO';
}
if(!isset($nome_cliente)){
    $nome_cliente = 'NÃO ENCONTRADO';
}
$parte1 = '<img src="../assets/img/cabecalho_orcamento.png" style=" margin-left: 60px; margin-top: 0px; padding-top: 0px; top: 0px; justify-content: center; align-items: center; text-align: center; height: 150px">';
$parte2 = '<br><div style="text-align: center;"><br><b>PROPOSTA DE ORÇAMENTO Nº '.$cod_orcamento.'';
if(isset($codigo_op)){
 
  $pp = '[';
  $a = $ops -1;
  for($i = 0; $i < $ops; $i++){
   
    if($i != $a ){
      $pp .= ''.$codio[$i].', ';
    }else{
      $pp .= ''.$codio[$i].'';
    }
  }  $pp .= ']';
  $parte2 .= ' / ORDEM DE PRODUÇÃO Nº '.$pp.' ';
}else{
  $parte2 .= '</b></div>';
}

$parte3 = '<div>_______________________________________________________________________________________________________</div>
<div style=" padding-top: 10px; padding-bottom: -8px; align-items: center; justify-content: center; text-align: center;">CÓDIGO EMISSOR: '.$cod_emissor_relatorio.' DATA EMISSÃO: '.$data.' HORA EMISSÃO: '.$hora.'</div>
<div>_______________________________________________________________________________________________________</div>
<div style="text-align: center;"><b>INFORMAÇÕES DO CLIENTE</b></div>
<br>
<div style="width: 85%;text-align: start;">
<div>CLIENTE: '.$nome_cliente.': '.$cod_cliente.'</div>
<div>CONTATO: '.$nome_contato.' TELEFONE PRINCIPAL: '.$telefone.' </div>';
if($telefone2 != ''){
 $parte3 .= '<div>TELEFONESECUNDÁRIO:'.$telefone2.'</div>';
}
$parte3 .= '
<div>VENDEDOR: '.$nome_atendente.'</div>
</div>
<div>_______________________________________________________________________________________________________</div>
<div  style="text-align: center; padding-top: 4px;"><b>DESCRIÇÃO DO ORÇAMENTO</b></div>
<br><div style="text-align: start;">';
for($a = 0; $a < $produtos; $a++){
    $parte3 .= 'CÓDIGO PRODUTO: '.$PRODUTOS[$a]['CODIGO'].'<br> 
    '.$PRODUTOS[$a]['DESCRICAO'].'<br> QUANTIDADE: '.$QuantidadeT[$a].' TAMANHO: '.$PRODUTOS[$a]['ALTURA'].' X '.$PRODUTOS[$a]['largura'].' PÁGINAS:'.$PRODUTOS[$a]['QTD_PAGINAS'].'<br><br>';
    
}
$parte3 .= '</div><div>_______________________________________________________________________________________________________</div>';
if(isset($Do_servico_cod[0])){
    $parte3 .= '<div  style="padding-top: 10px;  padding-bottom: -8px; align-items: center; justify-content: center; text-align: center;"><b>SERVIÇOS DO ORÇAMENTO</b><br></div>';
   for($a = 0; $a < count($Do_servico_cod); $a++){
    $parte3 .= '<div style="text-align: start;"><br>- CÓDIGO: '.$Do_servico_cod[$a].' | '.$Do_servico_descricao[$a].'</div>';
   }
   $parte3 .= '<div>_______________________________________________________________________________________________________</div>';
}

$parte3 .= '
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
<div style="font-size: 13px; text-align: start; ">OBSERVAÇÕES DO ORÇAMENTO: '.$descricao_orc.' <BR></div>
<BR>
<div style="text-align: start;">
<b >VALIDADE DA PROPOSTA: '.date('d/m/Y', strtotime($data_validade)).' <br>
Método de pagamento: <br>
<div style="font-size: 13px;"><b> TRANSFERÊNCIA ENTRE CONTAS, OPÇÃO PAGAMENTO DE SERVIÇO (POR NOTA DE CRÉDITO
FAVORECIDO – UG 160083 E UG 167083 PARA ND 33 90 00 , ND 33 90 30 OU 33 90 39).</b></div></div><br>
<div  style="text-align: center; background-color: #d4d4d4;"><b>ENTREGA: ______ DIAS ÚTEIS APÓS A APROVAÇÃO DO "MODELO DE PROVA"</b></div><br>
<div  style="text-align: center;  background-color: #d4d4d4;"><div  style="font-size: 14px;"><b>AUTORIZO A INSERÇÃO DO QR CODE DA GRÁFICA DO EXÉRCITO NA 4ª CAPA ( ) SIM ( ) NÃO</b></div></div>
<div style="text-align: center;   display: solid; align-items: center; justify-content: center; "> <br><br><br><br><br><br>
<p style="text-align: center; margin-left: 25%; margin-right: 25%; width: 50%; ">BRASÍLIA-DF, 08/02/2023. <br><br>
________________________________________________
'.$nome_atendente.' <br>
GRÁFICA DO EXÉRCITO - DIVISÃO COMERCIAL
<br><br>
________________________________________________
'.$nome_cliente.' <br>
'.$nome_fantasia.' <br>
DATA:  &nbsp; &nbsp;   &nbsp;  de &nbsp;&nbsp;  &nbsp;     &nbsp;  &nbsp;   &nbsp;   &nbsp; de  </p>
</div>
';


$html = $parte1 . $parte2 . $parte3;
 // echo $html;


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
