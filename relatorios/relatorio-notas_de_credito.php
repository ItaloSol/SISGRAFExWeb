<?php
session_start();
include_once('../conexoes/conexao.php');
include_once('../conexoes/conn.php');
/////////////////////////////////////////////
// CODIGO VARIAVEL // $html => VARIAVEL OBRIGATORIA PARA CRIAÇÃO DO PDF, INTRUÇÕES EM HTML 

if (isset($_POST['submit'])) {
    $WHERE = '';
    if($_POST['tipo_cliente'] == 'por_cliente'){
         $cod = $_POST['numerodocliente'];
         $tipo = $_POST['tipo_cliente_'];
         $WHERE = ' WHERE ';
       $cliente = ' cod_cliente = '. $cod .' AND tipo_cliente = '.$tipo.'';
    }elseif($_POST['tipo_cliente'] == 'tipo_pessoa'){
        $tipo = $_POST['tipo_cliente_cli'];
        $WHERE = ' WHERE ';
        $cliente = ' tipo_pessoa = '. $tipo;
    }else{
        $cliente = '';
    }

    if($_POST['por_emissor'] == 'por_operador'){
        $emissor = $_POST['emissorCod'];
        if($WHERE == ' WHERE '){
            $Emissor = ' AND cod_emissor = "'.  $emissor .'"';
        }else{
            $Emissor = '  cod_emissor = "'.  $emissor .'"';
        }
        $WHERE = ' WHERE ';
    }else{
        $Emissor = '';
    }
   
    if($_POST['periodo'] == 'por_dia'){
        $data_lan = $_POST['data_por_dia'];
        $datas = explode('-', $data_lan);
        $data_correta = date('d/m/Y', strtotime($datas[0] . $datas[1] . $datas[2]));
        if($WHERE == ' WHERE '){
            $Periodo = ' AND data = "' . $data_correta . '"';
        }else{
            $Periodo = '  data = "' . $data_correta . '"';
        }
        $WHERE = ' WHERE ';
    }elseif($_POST['periodo'] == 'por_periodo'){
        $data_lan = $_POST['data_por_inicio'];
        $datas = explode('-', $data_lan);
        $data_correta = date('d/m/Y', strtotime($datas[0] . $datas[1] . $datas[2]));
        $data_lan2 = $_POST['data_por_fim'];
        $datas2 = explode('-', $data_lan2);
        $data_correta2 = date('d/m/Y', strtotime($datas2[0] . $datas2[1] . $datas2[2]));
        if($WHERE == ' WHERE '){
        $Periodo = ' AND  data BETWEEN "'. $data_correta . '" AND "'. $data_correta2 .'"';
            
        }else{
        $Periodo = '  data BETWEEN "'. $data_correta . '" AND "'. $data_correta2 .'"';
            
        }
        $WHERE = ' WHERE ';
    }else{
        $Periodo = '';
    }

    if($_POST['por_forma_pagamento'] == 'forma_pagamento'){
        $forma = $_POST['Forma_pagamento_'];
        if($WHERE == ' WHERE '){
        $Forma_de_Pagamento = ' AND  forma_pagamento = '. $forma;
            
        }else{
        $Forma_de_Pagamento = '  forma_pagamento = '. $forma;
            
        }
        $WHERE = ' WHERE ';
    }else{
        $Forma_de_Pagamento = '';
    }

    $Campos = 'cod, cod_cliente ';
    $Inner = '';
    if(isset($_POST['forma_de_pagamento'])){
        $Inner = 'INNER JOIN configuracoes ON tabela_notas.forma_pagamento = configuracoes.id_configuracao';
        $Campos = $Campos . ' , configuracoes.parametro, forma_pagamento';
    }
    if(isset($_POST['emissor'])){
        $Inner = $Inner . ' INNER JOIN tabela_atendentes ON tabela_atendentes.codigo_atendente = tabela_notas.cod_emissor ';
        $Campos = $Campos . ' , cod_emissor ';
    }
    if(isset($_POST['codigo_do_cliente'])){
        $Campos = $Campos . ' ,cod_cliente  ';
    }
    
    if(isset($_POST['tipo_de_pessoa'])){
        $Inner = $Inner . ' INNER JOIN configuracoes x ON x.configuracao = tabela_notas.tipo_pessoa ';
        $Campos = $Campos . ' ,x.parametro AS ppj ,tipo_pessoa ';
    }
    if(isset($_POST['valor'])){
        $Campos = $Campos . ' ,valor ';
    }
    if(isset($_POST['data'])){
        $Campos = $Campos . ' ,data ';
    }
    $ORDER = '';
    if($_POST['order'] != 'null'){
        $ORDER = ' ORDER BY '. $_POST['order']; 
    }
    
}
    /////////////////////////////////////////////
    /////// BUSCAR NO BANCO DE DADOS ////////////
    /////////////////////////////////////////////
   //echo "SELECT $Campos FROM tabela_notas $Inner $WHERE $cliente $Emissor $Periodo $Forma_de_Pagamento $ORDER ";

        /////////////////////////////////// NOTAS DE CREDITO //////////////////////////////////////////////////////
        $query_Notas = $conexao->prepare("SELECT $Campos FROM tabela_notas $Inner $WHERE $cliente $Emissor $Periodo $Forma_de_Pagamento $ORDER ");
        $query_Notas->execute();
        $nt_total = 0;
        while ($linha = $query_Notas->fetch(PDO::FETCH_ASSOC)) {
            $Tabela_Notas[$nt_total] = [
                'cod' => $linha['cod'],
                'forma_pagamento' => $linha['forma_pagamento'],
                'cod_emissor' => $linha['cod_emissor'],
                'cod_cliente' => $linha['cod_cliente'],
                'parametro' => $linha['parametro'],
                'ppj' => $linha['ppj'],
                'tipo_pessoa' => $linha['tipo_pessoa'],
                'valor' => $linha['valor'],
                'data' => $linha['data'],
            ];
            $tipo_cliente = $linha['tipo_pessoa'];
            $cod_pes = $linha['cod_cliente'];
            if ($tipo_cliente == '1') {


                $query_Clientes = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos WHERE cod = $cod_pes");
                $query_Clientes->execute();
            }
        
            if ($tipo_cliente == '2') {
        
                $query_Clientes = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos  WHERE cod = $cod_pes ");
                $query_Clientes->execute();
            }
            if ($linha = $query_Clientes->fetch(PDO::FETCH_ASSOC)) {
                $tablea_cliente[$nt_total] = [
                    'cod' => $linha['cod'],
                    'nome' => $linha['nome'],
                ];
            }
            $nt_total++;
        }
      
        /////////////////////////////////////// FIM NOTAS ///////////////////////////////////////////////////////////////

       
   
    /// FIM BANCO DE DADOS///
    date_default_timezone_set('America/Sao_Paulo');
    $data_hora   = date('d/m/Y H:i:s ', time());
    $data_horaa = (string) $data_hora;

    $titulo = "<h2>RELATÓRIO DE NOTAS DE CRÉDITO - DATA E HORA DE EMISSÃO: ".$data_horaa." - SISGRAFEX</h2><br>";

?><title><?= $titulo ?></title><?php

                            

                                /////////////////////////////////////////// NOTAS //////////////////////

                                $Relatorio_Financeiro = "<table style=' solid black;  border-collapse:collapse; font-size: 10; 
                                text-align: center;
                                color: black;' border='1' class='table'>
        <tr>
        <th  style=' color:Black'>CÓDIGO</th>
        <th style=' color:Black'>EMISSOR</th>
        <th  style=' color:Black'>CÓDIGO CLIENTE</th>
        <th  style=' color:Black'>NOME CLIENTE</th>
        <th  style=' color:Black'>TIPO PESSOA</th>
        <th  style=' color:Black'>VALOR</th>
        <th style=' color:Black'>DATA</th>
        <th style=' color:Black'>FORMA PAGAMENTO</th>
        </tr>
        <tr>";
                            
                     for($Percorrer_Notas = 0; $Percorrer_Notas < $nt_total; $Percorrer_Notas++){
                                if ($Percorrer_Notas == 0) {
                                    $relatorio =  '<tr>
                                    <td >' . $Tabela_Notas[$Percorrer_Notas]["cod"] . ' </td>' .
                                    '<td >' . $Tabela_Notas[$Percorrer_Notas]["cod_emissor"] . ' </td>' .
                                    '<td >' . $tablea_cliente[$Percorrer_Notas]["cod"] . ' </td>' .
                                        '<td >' . $tablea_cliente[$Percorrer_Notas]["nome"] . ' </td>' .
                                        '<td >' . $Tabela_Notas[$Percorrer_Notas]["ppj"] .
                                        '<td > R$ ' . number_format($Tabela_Notas[$Percorrer_Notas]['valor'], 2, ',', '.') . ' </td>'. 
                                        '<td >' . $Tabela_Notas[$Percorrer_Notas]["data"]. 
                                        '<td >' . $Tabela_Notas[$Percorrer_Notas]["parametro"] .'</tr>' ;
                                } else {
                                    $relatorio = $relatorio .  '<tr><td >' . $Tabela_Notas[$Percorrer_Notas]['cod'] . " </td>" .
                                    '<td >' . $Tabela_Notas[$Percorrer_Notas]['cod_emissor'] . " </td>" .
                                    '<td >' . $tablea_cliente[$Percorrer_Notas]["cod"] . ' </td>' .
                                        '<td >' . $tablea_cliente[$Percorrer_Notas]["nome"] . ' </td>' .
                                        '<td >' . $Tabela_Notas[$Percorrer_Notas]["ppj"] .
                                        '<td > R$ ' . number_format($Tabela_Notas[$Percorrer_Notas]['valor'], 2, ',', '.') . ' </td>'. 
                                        '<td >' . $Tabela_Notas[$Percorrer_Notas]["data"]. 
                                        '<td >' . $Tabela_Notas[$Percorrer_Notas]["parametro"] .'</tr>' ;
                                }
                            }
                            $html =  $titulo . $Relatorio_Financeiro . $relatorio . '</table>';
                        
                            // echo $html;
                            require_once __DIR__ . '../../vendor/autoload.php';
                            // Create an instance of the class:
                            $mpdf = new \mPDF();
                            
                                    $mpdf = new mPDF('C', 'A4');
                            
                            $mpdf->SetDisplayMode('fullpage');
                            
                            $mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first 
                            //level of a list
                            
                            // LOAD a stylesheet
                            
                            $mpdf->WriteHTML($html, 2);
                            $nome = 'Relatorio_Notas_Credito' ;
                            $mpdf->Output($nome, 'I');
                            exit;