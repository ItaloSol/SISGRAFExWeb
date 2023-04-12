<?php
session_start();
include_once('../conexoes/conexao.php');
include_once('../conexoes/conn.php');

$cod_emissor_relatorio = $_SESSION['usuario'][2];
$nome_emissor_relatorio = $_SESSION['usuario'][0];
$data = date('d/m/Y');
$OpsS = 0;
if (isset($_GET['cod'])) {
    $codigo_op = $_GET['cod'];
    $papels = 0;
    $servicos = 0;
    $tipo_papel_qtd_loop = 0;
    $qtd_acabamentos = 0;
    $query_op = $conexao->prepare("SELECT * FROM tabela_ordens_producao WHERE cod = $codigo_op ");
    $query_op->execute();
    if ($linha = $query_op->fetch(PDO::FETCH_ASSOC)) {
        $codigo_orc = $linha['orcamento_base'];

        $tipo_produto = $linha['tipo_produto'];
        $cod_produto = $linha['cod_produto'];
        $data_prevista = $linha['data_entrega'];
        $status = $linha['status'];
        $tipo_cliente = $linha['tipo_cliente'];
        $cod_cliente = $linha['cod_cliente'];
        $cod_contato = $linha['cod_contato'];
        $cod_endereco = $linha['cod_endereco'];
        $cod_emissor = $linha['cod_emissor'];
        $obs_prod = $linha['descricao'];

        $data_1a_prova = $linha['data_1a_prova'];
        $data_2a_prova = $linha['data_2a_prova'];
        $data_3a_prova = $linha['data_3a_prova'];
        $data_4a_prova = $linha['data_4a_prova'];
        $data_5a_prova = $linha['data_5a_prova'];

        $data_prova = $linha['DT_ENTG_PROVA'];
        $data_CANCELADO = $linha['DT_CANCELAMENTO'];

        $query_orcamentos = $conexao->prepare("SELECT * FROM tabela_ordens_producao WHERE orcamento_base = $codigo_orc ");
        $query_orcamentos->execute();
        while ($linhaOrcC = $query_orcamentos->fetch(PDO::FETCH_ASSOC)) {
            $cod_opSS = $linhaOrcC['cod'];
            $Codigo_Ops[$OpsS] = $cod_opSS;
            $OpsS++;
        }

        if (!isset($data_prova)) {
            $data_prova = '--';
        }

        if ($tipo_produto == '1') {
            $query_produto = $conexao->prepare("SELECT * FROM produtos WHERE CODIGO = $cod_produto ");
        }
        if ($tipo_produto == '2') {
            $query_produto = $conexao->prepare("SELECT * FROM produtos_pr_ent WHERE CODIGO = $cod_produto ");
        }
        $query_produto->execute();
        if ($linha2 = $query_produto->fetch(PDO::FETCH_ASSOC)) {
            $largura = $linha2['LARGURA'];
            $ALTURA = $linha2['ALTURA'];
            $QTD_PAGINAS = $linha2['QTD_PAGINAS'];
            $TIPO = $linha2['TIPO'];
            $DESCRICAO = $linha2['DESCRICAO'];
        }
        $query_componente_orc = $conexao->prepare("SELECT * FROM tabela_componentes_orcamentos WHERE cod_orcamento = $codigo_orc   ");
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
            if (!isset($Do_servico_cod[0])) {
                $Servico_N = 'NENHUM SELECIONADO';
            }
        }
        $query_seexistecalculo = $conexao->prepare("SELECT * FROM tabela_calculos_op WHERE cod_op = $codigo_op AND tipo_produto = $tipo_produto");
        $query_seexistecalculo->execute();
        if ($linhaAA = $query_seexistecalculo->fetch(PDO::FETCH_ASSOC)) {
            $existe_dados = 1;
        }
        if (isset($existe_dados)) {
            $query_calculos_op = $conexao->prepare("SELECT * FROM tabela_calculos_op WHERE cod_op = $codigo_op AND tipo_produto = $tipo_produto");
        } else {
            $query_calculos_op = $conexao->prepare("SELECT * FROM tabela_calculos_op WHERE cod_proposta = $codigo_orc AND tipo_produto = $tipo_produto");
        }


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

            $query_orid_orc = $conexao->prepare("SELECT * FROM tabela_produtos_orcamento WHERE tipo_produto = $tipo_produto AND cod_produto = $cod_produtos AND cod_orcamento = $codigo_orc");
            $query_orid_orc->execute();

            if ($linha14 = $query_orid_orc->fetch(PDO::FETCH_ASSOC)) {
                $quantidade = $linha14['quantidade'];
                $preco_unitario = $linha14['preco_unitario'];
                $total = $quantidade * $preco_unitario;
            }

            $query_papel = $conexao->prepare("SELECT * FROM tabela_papeis_produto WHERE tipo_produto = $tipo_produto AND cod_produto = $cod_produtos AND cod_papel = $cod_papels AND tipo_papel = '$calculo_tipo_papel' ");
            $query_papel->execute();

            if ($linha3 = $query_papel->fetch(PDO::FETCH_ASSOC)) {
                $tipo_papel = $linha3['tipo_papel'];
                $cod_papel = $linha3['cod_papel'];
                $cor_frente = $linha3['cor_frente'];
                $cor_verso = $linha3['cor_verso'];
                $descricao = $linha3['descricao'];
                $orelha = $linha3['orelha'];
                //     echo 'cor_frente '. $cor_frente . ' cor_verso '. $cor_verso . '<br>';

                $Papel_tipo_papel[$papels] = $calculo_tipo_papel;
                $Papel_cod_papel[$papels] = $cod_papel;
                $Papel_cor_frente[$papels] = $cor_frente;
                $Papel_cor_verso[$papels] = $cor_verso;
                $Papel_descricao[$papels] = $descricao;
                $Papel_orelha[$papels] = $orelha;

                $query_do_papel = $conexao->prepare("SELECT * FROM tabela_papeis WHERE cod = $cod_papels  ");
                $query_do_papel->execute();
                if ($linha4 = $query_do_papel->fetch(PDO::FETCH_ASSOC)) {
                    $cod_papels = $linha4['cod'];
                    $descricao_do_papel = $linha4['descricao'];
                    $medida = $linha4['medida'];
                    $gramatura = $linha4['gramatura'];
                    $formato = $linha4['formato'];
                    $uma_face = $linha4['uma_face'];
                    $unitario = $linha4['unitario'];
                    //    echo 'cod_papels '. $cod_papels . ' - '. $calculo_tipo_papel . '<br>';
                    $Do_Papel_cod[$tipo_papel_qtd_loop] = $cod_papels;
                    $Do_Papel_descricao_do_papel[$tipo_papel_qtd_loop] = $descricao_do_papel;
                    $Do_Papel_midida[$tipo_papel_qtd_loop] = $medida;
                    $Do_Papel_gramatura[$tipo_papel_qtd_loop] = $gramatura;
                    $Do_Papel_formato[$tipo_papel_qtd_loop] = $formato;
                    $Do_Papel_uma_face[$tipo_papel_qtd_loop] = $uma_face;
                    $Do_Papel_unitario[$tipo_papel_qtd_loop] = $unitario;
                    $tipo_papel_qtd_loop++;
                }
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
        if ($tipo_produto == 2) {
            $query_orid_orc = $conexao->prepare("SELECT * FROM tabela_produtos_orcamento WHERE tipo_produto = $tipo_produto AND cod_produto = $cod_produto AND cod_orcamento = $codigo_orc");
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
            }
        }
        if ($tipo_cliente == '2') {
            $cliente = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos WHERE cod = $cod_cliente ");
            $cliente->execute();
            if ($linha7 = $cliente->fetch(PDO::FETCH_ASSOC)) {
                $nome_cliente = $linha7['nome'];
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
            $telefone = $linha11['telefone'];
        }

    }
}
if (!isset($tipo_papel)) {
    $tipo_papel = 'PRONTA ENTREGA';
}
if (!isset($quantidade)) {
    $quantidade = 0;
}
if (!isset($preco_unitario)) {
    $preco_unitario = 0;
}
if (!isset($total)) {
    $total = 0;
}
if (!isset($quantidade)) {
    //  $quantidade = 'NÃO ENCONTRADO';
}
$parte1 = " 
<table style='  border-collapse: collapse; border: 1px solid black; border: 1px solid black; width: 100%;'  border=1>

    <tr>
        <td style='text-align: center;'  rowspan='2'>ORCAMENTO BASE: $codigo_orc <br> EMISSOR: $cod_emissor_relatorio <br> EMISSÃO: $data</td>
        <td style='text-align: center;' width: 150%; rowspan='2' colspan='2'><b>ORDEM DE PRODUÇÃO <br> $codigo_op </b></td>";
if ($status != '13') {
    $parte1 .= "<td style='text-align: center;' >DATA PROVÁVEL DE ENTREGA: <br> " . date('d/m/Y', strtotime($data_prevista));
} else {
    $parte1 .= "<td style=' background: #d4d4d4;text-align: center;' >DATA DE CANCELAMENTO: <br> " . date('d/m/Y', strtotime($data_CANCELADO));
}


$parte1 .= "</tr><tr></td><td colspan='1' style='text-align: center;'>DATA DE ENTREGA DA PROVA: <br> " . date('d/m/Y', strtotime($data_prova)) . "
        </td>
    </tr>

</table>
<br>
<table >
    <tr>
        <td style='font-size: 12px;' colspan='2'>CLIENTE: $nome_cliente</td>
      
    </tr>

    <tr>
        <td style='font-size: 12px;'>CONTATO: $nome_contato </td>
        <td style='font-size: 12px;'> TELEFONE: $telefone</td>
      
    </tr>
    <tr>
        <td style='font-size: 12px;'>EMAIL: $email</td>
        <td></td>
    </tr>
    <tr>
        <td style='font-size: 12px;'>VENDEDOR: $nome_atendente - $cod_emissor </td>
        <td style='font-size: 12px;'>COD CLIENTE: $cod_cliente</td>
    </tr>
    <tr>
        <td style='font-size: 12px;'>EMISSOR: $nome_emissor_relatorio - $cod_emissor_relatorio</td>
    </tr>
</table>

<div style=' text-align: center; background: #d4d4d4;'><b style=' ' >$DESCRICAO </b></div>

<table  >
    <tr>
        <td colspan='2'>QUANTIDADE: $quantidade <br>";
if ($tipo_produto == '1') {
    $parte1 .= "PÁGINAS: $QTD_PAGINAS PGS </td>";
}
$parte1 .= "<td> FORMATO: $largura.0 X $ALTURA.0</td>
    </tr>
    <tr>
        <td colspan='2'></td>
        <td style='background: #d4d4d4;'>OBSERVAÇÕES: SEM OBSERVAÇÕES<br>
            ENTREGA: ______ DIAS ÚTEIS APÓS A APROVAÇÃO DO 'MODELO DE PROVA'.</td>
    </tr>
</table>
<br>
<div style='  background: #d4d4d4; position: static; height: max-content; text-align: center;'><b >TIPO PRODUTO: $tipo_papel</b></div>
<br>";
if ($tipo_produto == '1') {

    $parte1 .= "PAPÉIS <div style='   height: max-content; '>
<table style='  border-collapse: collapse; border: 1px solid black; border: 1px solid black;  width: 100%;
 '  border='1'>";
    $parte2 = '';
    $anterior[0] = 'teste';
    $papeis = 0;
    while ($tipo_papel_qtd_loop > $papeis) {
        if (!in_array($Do_Papel_descricao_do_papel[$papeis], $anterior)) {
            $parte2 = $parte2 . "
    <tr>
        <td>DESCRIÇÃO DO PAPEL: <br>
           " . $Do_Papel_descricao_do_papel[$papeis] . "</td>
        <td>GRAMATURA: " . $Do_Papel_gramatura[$papeis] . "</td>
        <td> TIPO PAPEL: " . $Papel_tipo_papel[$papeis] . "</td>
    </tr>
    <tr>
        <td colspan='2'>GASTO DE FOLHAS: " . $Calculo_qtd_folhas_total[$papeis] . "</td>
        <td>CORES FRENTE: " . $Papel_cor_frente[$papeis] . "</td>
    </tr>
    <tr>
        <td colspan='2'>FORMATO DE IMPRESSÃO: " . $Calculo_formato[$papeis] . "</td>
        <td>CORES VERSO: " . $Papel_cor_verso[$papeis] . "</td>
    </tr>
    <tr>
        <td colspan='3'>PERDA: " . $Calculo_perca[$papeis] . "%</td>
    </tr>
   ";
            $anterior[$papeis] = $Do_Papel_descricao_do_papel[$papeis];
        }
        $papeis++;
    }
    $parte3 = "</table>

</div>
<br>
CHAPAS
<table style='  border-collapse: collapse; border: 1px solid black; border: 1px solid black;  width: 100%;
 ' border='1'>";
    $parte4 = '';
    $papeis1 = 0;
    while ($papeis1 < $papels) {
        $parte4 = $parte4 . "<tr>
        <td>CÓDIGO PAPEL: " . $Do_Papel_cod[$papeis1] . "</td>
        <td style='text-align: center;'>NENHUMA SELECIONADA</td>
    </tr>";
        $papeis1++;
    }
    $parte5 = "</table>
<br>
ACABAMENTOS DA LÂMINA
<table style='  border-collapse: collapse; border: 1px solid black; border: 1px solid black;  width: 100%;
 ' border='1'>";
    $parte6 = '';
    $percorrer = 0;
    $anterior[0] = 'teste';
    while ($qtd_acabamentos > $percorrer) {
        if (!in_array($Do_Acabamento_cod[$percorrer], $anterior)) {
            $parte6 = $parte6 . " <tr>
    <td>CÓDIGO: $Do_Acabamento_cod[$percorrer] </td>
    <td>DESCRIÇÃO: $Do_Acabamento_Maquina[$percorrer] </td>
  </tr> ";
            $anterior[$percorrer] = $Do_Acabamento_cod[$percorrer];
        }
        $percorrer++;
    }
} else {
    $parte2 = '';
    $parte3 = '';
    $parte4 = '';
    $parte5 = '';
    $parte6 = '';
}
$parte7 = "</table>
<br>
<div style=' background: #d4d4d4;'><b >SERVIÇOS DO ORÇAMENTO</b></div>

<table style='  border-collapse: collapse; border: 1px solid black; border: 1px solid black;  width: 100%;
 ' border='1'>";
$parte10 = '';
if ($servicos > 0) {
    for ($i = 0; $i < $servicos; $i++) {
        $parte10 = $parte10 . '<tr><td>CÓDIGO:' . $Do_servico_cod[$i] . '</td> <td> DESCRIÇÃO: ' . $Do_servico_descricao[$i] . '</td></tr>';
    }
} else {
    $parte10 = '<tr><td align="center">NENHUM SELECIONADO</td></tr>';
}
$parte9 = "</table>
<br>
<div style='  background: #d4d4d4;'><b>OBSERVAÇÕES DA ORDEM DE PRODUÇÃO</b></div>

<table style='  border-collapse: collapse; border: 1px solid black; border: 1px solid black;  width: 100%;
 ' border='1'>
    <tr>
        <td style='text-align: center;'>$obs_prod</td>
    </tr>
</table>
<br>
<div style=' background: #d4d4d4;'><b>DADOS DE POSTAGEM</b></div>

<table style='  border-collapse: collapse; border: 1px solid black; border: 1px solid black;  width: 100%;
 ' border='1'>
    <tr>
        <td colspan='2'>ENDEREÇO DE ENTREGA</td>
        <td colspan='2'> $logadouro, $bairro, $cidade, $uf - $cep </td>
    </tr>
    <tr>
        <td colspan='2'>OP ASSOCIADAS A PROPOSTA</td>
        <td colspan='2'> [";
for ($a = 0; $a < $OpsS; $a++) {
    if ($a == $OpsS - 1) {
        $parte9 .= $Codigo_Ops[$a];
    } else {
        $parte9 .= $Codigo_Ops[$a] . ', ';
    }

}
$parte9 .= "]</td>
    </tr>
    <tr>
        <td colspan='2'>OBSERVAÇÕES DO FRETE</td>
        <td colspan='2'></td>
    </tr>
    <tr>
        <th>QUANTIDADE</th>
        <th> VALOR UNITÁRIO</th>
        <th colspan='2'> VALOR TOTAL</th>
    </tr>
    <tr>
        <td>$quantidade</td>
        <td> R$ " . number_format($preco_unitario, 2, ',', '.') . "</td>
        <td colspan='2'> R$ " . number_format($total, 2, ',', '.') . "</td>
    </tr>
</table>
";
$html = $parte1 . $parte2 . $parte3 . $parte4 . $parte5 . $parte6 . $parte7 . $parte10 . $parte9;
// echo $html;

require_once __DIR__ . '../../vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \mPDF();

if ($_POST['orientacao']) {
    if ($_POST['orientacao'] == 'retrato') {
        // Write some HTML code:
        $mpdf = new mPDF('C', 'A4');
    }
}
if ($_POST['orientacao']) {
    if ($_POST['orientacao'] == 'paisagem') {
        // Write some HTML code:
        $mpdf = new mPDF('C', 'A4-L');
    }
}


$mpdf->SetDisplayMode('fullpage');

$mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first 
//level of a list

// LOAD a stylesheet

$mpdf->WriteHTML($html, 2);
$nome = 'OrdemProducao' . $codigo_op;
$mpdf->Output($nome, 'I');
exit;