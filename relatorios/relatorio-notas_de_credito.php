<?php
session_start();
include_once('../conexoes/conexao.php');
include_once('../conexoes/conn.php');
/////////////////////////////////////////////
// CODIGO VARIAVEL // $html => VARIAVEL OBRIGATORIA PARA CRIAÇÃO DO PDF, INTRUÇÕES EM HTML 

if (isset($_POST['submit'])) {
    if($_POST['tipo_cliente'] == 'por_cliente'){
         $cod = $_POST['numero'];
         $tipo = $_POST['tipo_cliente_'];
       $cliente = ' cod_cliente = '. $cod .' AND tipo_cliente = '.$tipo.'';
    }elseif($_POST['tipo_cliente'] == 'tipo_pessoa'){
        $tipo = $_POST['tipo_cliente_cli'];
        $cliente = ' tipo cliente = '. $tipo;
    }else{
        $cliente = '';
    }

    if($_POST['por_emissor'] == 'por_operador'){
        $emissor = $_POST['emissorCod'];
        $Emissor = ' AND cod_emissor = "'.  $emissor .'"';
    }else{
        $Emissor = '';
    }

    if($_POST['periodo'] == 'por_dia'){
        $data_lan = $_POST['data_por_dia'];
        $datas = explode('-', $data_lan);
        $data_correta = date('d/m/Y', strtotime($datas[0] . $datas[1] . $datas[2]));
        $Periodo = ' AND data = "' . $data . '"';
    }elseif($_POST['periodo'] == 'por_periodo'){
        $data_lan = $_POST['data_por_inicio'];
        $datas = explode('-', $data_lan);
        $data_correta = date('d/m/Y', strtotime($datas[0] . $datas[1] . $datas[2]));
        $data_lan2 = $_POST['data_por_fim'];
        $datas2 = explode('-', $data_lan2);
        $data_correta2 = date('d/m/Y', strtotime($datas2[0] . $datas2[1] . $datas2[2]));
        $Periodo = ' AND data BETWEEN "'. $data_correta . '" AND "'. $data_correta2 .'"';
    }else{
        $Periodo = '';
    }

    if($_POST['por_forma_pagamento'] == 'forma_pagamento'){
        $forma = $_POST['Forma_pagamento_'];
        $Forma_de_Pagamento = ' AND forma_pagamento = '. $forma;
    }else{
        $Forma_de_Pagamento = '';
    }

    $Campos = 'cod, ';

    if(isset($_POST['forma_de_pagamento'])){

    }else{
        
    }
    
}
    /////////////////////////////////////////////
    /////// BUSCAR NO BANCO DE DADOS ////////////
    /////////////////////////////////////////////
  /*  $a = 0;
    if ($tipo_cliente == '1') {


        $query_Clientes = $conexao->prepare("SELECT * FROM tabela_clientes ORDER BY cod ASC");
        $query_Clientes->execute();
    }

    if ($tipo_cliente == '2') {

        $query_Clientes = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos  ORDER BY cod ASC ");
        $query_Clientes->execute();
    }
    while ($linha = $query_Clientes->fetch(PDO::FETCH_ASSOC)) {
        $tablea_cliente[$a] = [
            'cod' => $linha['cod'],
            'nome' => $linha['nome'],
            'cnpj' => $linha['cnpj'],
            'atividade' => $linha['atividade'],
            'filial_coligada' => $linha['filial_coligada'],
            'cod_atendente' => $linha['cod_atendente'],
            'nome_atendente' => $linha['nome_atendente'],
            'observacao' => $linha['observacao'],
            'credito' => $linha['credito'],
            'senha' => $linha['senha'],
            'excluido' => $linha['excluido']
        ];
        $a++;
    }

    $Total_de_Clientes = count($tablea_cliente);
    $Principal = 0;
    while ($Total_de_Clientes > $Principal) {
        $Cliente = $tablea_cliente[$Principal]['cod'];
        /////////////////////////////////// NOTAS DE CREDITO //////////////////////////////////////////////////////
        $query_Notas = $conexao->prepare("SELECT * FROM tabela_notas n WHERE $Where AND n.tipo_pessoa = '$tipo_cliente' AND cod_cliente = '$Cliente' AND $Periodo_Total_Notas ORDER BY $Order ");
        $query_Notas->execute();
        $nt_total = 0;
        while ($linha = $query_Notas->fetch(PDO::FETCH_ASSOC)) {
            $Tabela_Notas[$nt_total] = [
                'cod' => $linha['cod'],
                'serie' => $linha['serie'],
                'tipo' => $linha['tipo'],
                'forma_pagamento' => $linha['forma_pagamento'],
                'cod_op' => $linha['cod_op'],
                'cod_orcamento' => $linha['cod_orcamento'],
                'COD_PRODUTO' => $linha['COD_PRODUTO'],
                'cod_emissor' => $linha['cod_emissor'],
                'cod_cliente' => $linha['cod_cliente'],
                'cod_endereco' => $linha['cod_endereco'],
                'cod_contato' => $linha['cod_contato'],
                'tipo_pessoa' => $linha['tipo_pessoa'],
                'quantidade_entregue' => $linha['quantidade_entregue'],
                'valor' => $linha['valor'],
                'data' => $linha['data'],
                'observacoes' => $linha['observacoes'],
                'FAT_FRETE' => $linha['FAT_FRETE'],
                'FAT_SERVICOS' => $linha['FAT_SERVICOS']
            ];
            if (isset($Tabela_Notas[$nt_total]['valor'])) {
                if (isset($Total_Notas_Solo[$Principal])) {
                    $Total_Notas_Solo[$Principal] = $Total_Notas_Solo[$Principal] + $Tabela_Notas[$nt_total]['valor'];
                } else {
                    $Total_Notas_Solo[$Principal] = $Tabela_Notas[$nt_total]['valor'];
                }
            }
            $nt_total++;
        }
        if (!isset($Total_Notas_Solo[$Principal])) {
            $Total_Notas_Solo[$Principal] = 0;
        }
        $Total_Notas_Geral = array_sum($Total_Notas_Solo);
        if (isset($Tabela_Notas)) {
            $Total_Notas = count($Tabela_Notas);
        } else {
            $Total_Notas = 0;
        }
        $Percorrer_Notas = 0;
        $valor_total_Notas = 0;
        //  while($Total_Notas > $Percorrer_Notas){  
        /////////////////////////////////////// FIM NOTAS ///////////////////////////////////////////////////////////////

       
        $Principal++;
    }
    /// FIM BANCO DE DADOS///
    date_default_timezone_set('America/Sao_Paulo');
    $data_hora   = date('d/m/Y H:i:s ', time());
    $data_horaa = (string) $data_hora;

    $titulo = "<h5>RELATÓRIO FINANCEIRO - DATA E HORA DE EMISSÃO: " . $data_horaa . " - SISGRAFEX</h5><br>";

?><title><?= $titulo ?></title><?php

                                $sub_titulo = "<h2>RELATÓRIO FINANCEIRO <br>." . $Mes . "/" . $Ano . " - PESSOAS " . $Tipo_Pessoa_ . "</h2><br>";

                                /////////////////////////////////////////// NOTAS //////////////////////

                                $Relatorio_Financeiro = "<table style=' solid black;  border-collapse:collapse; font-size: 10; 
                    text-align: center;
                    color: black;' border='1' class='table'>
        <tr>
        <th  style=' color:Black'>CÓDIGO</th>
        <th style=' color:Black'>NOME</th>
        <th  style=' color:Black'>SALDO ACUMULADO ANTERIOR</th>
        <th  style=' color:Black'>CRÉDITO</th>
        <th  style=' color:Black'>DÉBITO</th>
        <th  style=' color:Black'>EM ABERTO ABERTO ATÉ " . $Mes . "/" . $Ano . " </th>
        <th style=' color:Black'>SALDO ACUMULADO ATUAL</th>
        </tr>
        <tr>";
                            }
                            while ($Principal > $Percorrer_Notas) {
                                if ($Percorrer_Notas == 0) {
                                    $relatorio =  '<tr><td >' . $tablea_cliente[$Percorrer_Notas]["cod"] . ' </td>' .
                                        '<td >' . $tablea_cliente[$Percorrer_Notas]["nome"] . ' </td>' .
                                        '<td > R$ 0 </td>' .
                                        '<td > R$ ' . number_format($Total_Notas_Solo[$Percorrer_Notas], 2, ',', '.') . ' </td>' .
                                        '<td > R$ ' . number_format($Total_Faturamento_Solo[$Percorrer_Notas], 2, ',', '.') . ' </td>' .
                                        '<td > R$ ' . number_format($Total_Op_Aberta_Solo[$Percorrer_Notas], 2, ',', '.') . ' </td>' .
                                        '<td > R$ ' . number_format($Total_Geral_Solo[$Percorrer_Notas], 2, ',', '.') . ' </td></tr>';
                                } else {
                                    $relatorio = $relatorio .  '<tr><td colspan="1">' . $tablea_cliente[$Percorrer_Notas]["cod"] . ' </td>' .
                                        '<td >' . $tablea_cliente[$Percorrer_Notas]["nome"] . ' </td>' .
                                        '<td > R$ 0 </td>' .
                                        '<td > R$ ' . number_format($Total_Notas_Solo[$Percorrer_Notas], 2, ',', '.') . ' </td>' .
                                        '<td > R$ ' . number_format($Total_Faturamento_Solo[$Percorrer_Notas], 2, ',', '.') . ' </td>' .
                                        '<td > R$ ' . number_format($Total_Op_Aberta_Solo[$Percorrer_Notas], 2, ',', '.') . ' </td>' .
                                        '<td > R$ ' . number_format($Total_Geral_Solo[$Percorrer_Notas], 2, ',', '.') . ' </td></tr>';
                                }
                                $Percorrer_Notas++;
                            }
                            echo $titulo . $sub_titulo . $Relatorio_Financeiro . $relatorio;
                        */ 