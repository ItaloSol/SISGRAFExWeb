<?php
session_start();
include_once('../conexoes/conexao.php');
include_once('../conexoes/conn.php');
if (isset($_POST['cliente'])) {
    // echo $_POST['cliente'];
    $Qtd_Cliente = 0;
    if ($_POST['cliente'] == 'codigo') {
        $Tipo_Cliente = $_POST['clientetipocod'];
        $Cod_Cliente = $_POST['clientecod'];
        $Cliente = " tipo_cliente = '" . $Tipo_Cliente . "' AND cod_cliente = '" . $Cod_Cliente . "' ";
        $Qtd_Cliente++;
    }
    if ($_POST['cliente'] == 'tipopessoa') {
        if ($_POST['clienteselecione'] == '1') {
            //echo 'Por 1';
            $Tipo_Cliente = $_POST['clienteselecione'];
            $Cliente = ' tipo_cliente = "' . $Tipo_Cliente . '" ';
            $Qtd_Cliente++;
        }

        if ($_POST['clienteselecione'] == '2') {
            ////   echo 'Por 2';
            $Tipo_Cliente = $_POST['clienteselecione'];
            $Cliente = ' tipo_cliente = "' . $Tipo_Cliente . '" ';
            $Qtd_Cliente++;
        }
    }
    if ($_POST['cliente'] == 'nome') {
        $Nome_Cliente = $_POST['clientenome'];
        $Tipo_Cliente = $_POST['clientetiponom'];
        $Cliente = 'nome';
        $Qtd_Cliente++;
    }
    if ($_POST['cliente'] == 'todos') {
        $Cliente = null;
        $Qtd_Cliente++;
    }

    if ($Cliente == 'nome') {
    if ($Tipo_Cliente == '1') {
        $query_Nome_Clientes = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos  WHERE  nome LIKE '%$Nome_Cliente%'");
      }
      if ($Tipo_Cliente == '2') {
        $query_Nome_Clientes = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos  WHERE  nome LIKE '%$Nome_Cliente%'");
      }
      $query_Nome_Clientes->execute();
    
      if ($linhaPPP = $query_Nome_Clientes->fetch(PDO::FETCH_ASSOC)) {
        $Cod_Cliente_Buscado = $linhaPPP['cod'];
            $Cliente = ' tipo_cliente = "' . $Tipo_Cliente . '" AND cod_cliente = "' . $Cod_Cliente_Buscado . '" ';
      }
        $Qtd_Cliente++;
    }
    $Qtd_Ultima = $Qtd_Cliente - 1;
    if ($Cliente != null) {
            $Query_Cliente = ' AND '. $Cliente;
    }else{
        $Query_Cliente = ' AND cod_cliente != "0" ';
    }
}
if (isset($_POST['OpOrc'])) {
    // echo $_POST['OpOrc'];
    if ($_POST['OpOrc'] == 'OpCod') {
        $OpOrc = " tabela_ordens_producao.cod = '" . $_POST['OpOrcCod'] . "'";
    }
    if ($_POST['OpOrc'] == 'OrcCod') {
        $OpOrc = " orcamento_base = '" . $_POST['CodOpOrc'] . "'";
    }
    if ($_POST['OpOrc'] == 'todos') {
        $OpOrc = null;
    }
    if ($OpOrc != null) {
        $Query_OpOrc = ' AND '. $OpOrc;
    }else{
        $Query_OpOrc ='';  
    }
}else{
    $Query_OpOrc ='';
}
$ProdutoJoin = '';
if (isset($_POST['produto'])) {
    if ($_POST['produto'] == 'CodPro') {
        $ProdutoJoin = '';
        $Produto = " tabela_ordens_producao.cod_produto = '" . $_POST['produtoCod'] . "'";
    }
    if ($_POST['produto'] == 'nomePP') {
        $ProdutoJoin = " INNER JOIN produtos ON produtos.CODIGO = tabela_ordens_producao.cod_produto ";
        $Produto = "produtos.DESCRICAO LIKE '%" . $_POST['produtoNomePP'] . "%' ";
    }
    if ($_POST['produto'] == 'nomePE') {
        $ProdutoJoin = " INNER JOIN produtos_pr_ent ON produtos_pr_ent.CODIGO = tabela_ordens_producao.cod_produto ";
        $Produto = "produtos_pr_ent.DESCRICAO LIKE '%" . $_POST['produtoNomePE'] . "%' ";
    }
    if ($_POST['produto'] == 'todos') {
        
        $Produto = null;
    }
    // if($_POST['produto'] == 'TipoPro' ){
    //     $Produto = " tabela_ordens_producao.tipo_produto = '".$_POST['produtoTipo']."'";
    // }
}
// echo $_POST['emissorCod'] . '<br>' . $_POST['emissor'];
if (isset($_POST['emissor'])) {
    if ($_POST['emissor'] != 'todos') {
        if (isset($_POST['emissorCod'])) {
            $Emissor = " tabela_ordens_producao.COD_ATENDENTE LIKE '%" . $_POST['emissorCod'] . "%'";
        }
    }
}
if (isset($_POST['periodo'])) {
    if ($_POST['periodo'] == 'EmissPer') {
        if (isset($Periodo)) {
            $Periodo = $Periodo . " AND data_emissao = '" . $_POST['periodoEmiss'] . "' ";
        } else {
            $Periodo = " AND  data_emissao = '" . $_POST['periodoEmiss'] . "' ";
        }
    }
    if ($_POST['periodo'] == 'EntrPer') {
        if (isset($Periodo)) {
        } else {
        }
        $Periodo = " AND data_entrega = '" . $_POST['periodoEntr'] . "' ";
    }
    if ($_POST['periodo'] == 'IncFimEmiss') {
        if (isset($Periodo)) {
            $Periodo = $Periodo . " AND data_emissao >= '" . $_POST['periodoIncEmiss'] . "' AND data_emissao <= '" . $_POST['periodoFimEmiss'] . "'";
        } else {
            $Periodo = " AND data_emissao >= '" . $_POST['periodoIncEmiss'] . "' AND data_emissao <= '" . $_POST['periodoFimEmiss'] . "'";
        }
    }
    if ($_POST['periodo'] == 'IncFimPer') {

        if (isset($Periodo)) {
            $Periodo = $Periodo . " AND data_entrega >= '" . $_POST['periodoIncPer'] . "' AND data_entrega <= '" . $_POST['periodoFimPer'] . "'";
        } else {
            $Periodo = " AND data_entrega >= '" . $_POST['periodoIncPer'] . "' AND data_entrega <= '" . $_POST['periodoFimPer'] . "'";
        }
    }
    if (isset($Periodo)) {
        $Query_Periodo = ' '. $Periodo;
    }else{
        $Query_Periodo = '';
    }
}
if (isset($_POST['periodoPrevisao'])) {
    if ($_POST['periodoPrevisao'] == 'EntrPerPrevisao') {
        if (isset($Periodo)) {
            $Periodo = $Periodo . " AND ( SAIDA_PRE = '" . $_POST['periodoEntrPrevisao'] . "' OR SAIDA_DIGITAL = '" . $_POST['periodoEntrPrevisao'] . "' OR SAIDA_OFFSET = '" . $_POST['periodoEntrPrevisao'] . "'
             OR SAIDA_CTP = '" . $_POST['periodoEntrPrevisao'] . "'
            OR SAIDA_TIPOGRAFIA = '" . $_POST['periodoEntrPrevisao'] . "' OR SAIDA_ACABAMENTO = '" . $_POST['periodoEntrPrevisao'] . "' OR SAIDA_PLOTTER = '" . $_POST['periodoEntrPrevisao'] . "') ";
        } else {
            $Periodo = " ( SAIDA_PRE = '" . $_POST['periodoEntrPrevisao'] . "' OR SAIDA_DIGITAL = '" . $_POST['periodoEntrPrevisao'] . "' OR SAIDA_OFFSET = '" . $_POST['periodoEntrPrevisao'] . "'
             OR SAIDA_CTP = '" . $_POST['periodoEntrPrevisao'] . "'
            OR SAIDA_TIPOGRAFIA = '" . $_POST['periodoEntrPrevisao'] . "' OR SAIDA_ACABAMENTO = '" . $_POST['periodoEntrPrevisao'] . "' OR SAIDA_PLOTTER = '" . $_POST['periodoEntrPrevisao'] . "') ";
        }
    }
    if ($_POST['periodoPrevisao'] == 'EmissPerPrevisao') {
        if (isset($Periodo)) {
            $Periodo = $Periodo . " AND ( DT_ENTRADA_PLOTTER = '" . $_POST['periodoEmissPrevisao'] . "' OR data_ent_tipografia= '" . $_POST['periodoEmissPrevisao'] . "' OR data_ent_acabamento = '" . $_POST['periodoEmissPrevisao'] . "
            ' OR DT_ENT_DIGITAL = '" . $_POST['periodoEmissPrevisao'] . "' OR data_ent_offset = '" . $_POST['periodoEmissPrevisao'] . "' OR DT_ENVIADO_EXPEDICAO = '" . $_POST['periodoEmissPrevisao'] . "
            ' OR DT_ENTRADA_PRE_IMP_PROVA = '" . $_POST['periodoEmissPrevisao'] . "' OR DT_TIPOGRAFIA_PROVA = '" . $_POST['periodoEmissPrevisao'] . "' OR DT_ACABAMENTO_PROVA = '" . $_POST['periodoEmissPrevisao'] . "
            ' OR DT_ENTRADA_PRE_IMP = '" . $_POST['periodoEmissPrevisao'] . "' OR DT_ENTRADA_CTP = '" . $_POST['periodoEmissPrevisao'] . "')";
        } else {
            $Periodo = " ( DT_ENTRADA_PLOTTER = '" . $_POST['periodoEmissPrevisao'] . "' OR data_ent_tipografia= '" . $_POST['periodoEmissPrevisao'] . "' OR data_ent_acabamento = '" . $_POST['periodoEmissPrevisao'] . "
            ' OR DT_ENT_DIGITAL = '" . $_POST['periodoEmissPrevisao'] . "' OR data_ent_offset = '" . $_POST['periodoEmissPrevisao'] . "' OR DT_ENVIADO_EXPEDICAO = '" . $_POST['periodoEmissPrevisao'] . "
            ' OR DT_ENTRADA_PRE_IMP_PROVA = '" . $_POST['periodoEmissPrevisao'] . "' OR DT_TIPOGRAFIA_PROVA = '" . $_POST['periodoEmissPrevisao'] . "' OR DT_ACABAMENTO_PROVA = '" . $_POST['periodoEmissPrevisao'] . "
            ' OR DT_ENTRADA_PRE_IMP = '" . $_POST['periodoEmissPrevisao'] . "' OR DT_ENTRADA_CTP = '" . $_POST['periodoEmissPrevisao'] . "')";
        }
    }
    
    if ($_POST['periodoPrevisao'] == 'IncFimEmissPrevisao') {  
        if (isset($Periodo)) {
            $Periodo = $Periodo . "AND ( DT_ENTRADA_PLOTTER BETWEEN '".$_POST['periodoIncEmissPrevisao']."' AND '".$_POST['periodoFimEmissPrevisao']."' OR 
            data_ent_tipografia BETWEEN '".$_POST['periodoIncEmissPrevisao']."' AND '".$_POST['periodoFimEmissPrevisao']."' OR 
            data_ent_acabamento BETWEEN '".$_POST['periodoIncEmissPrevisao']."' AND '".$_POST['periodoFimEmissPrevisao']."' OR 
            DT_ENT_DIGITAL BETWEEN '".$_POST['periodoIncEmissPrevisao']."' AND '".$_POST['periodoFimEmissPrevisao']."' OR 
            data_ent_offset BETWEEN '".$_POST['periodoIncEmissPrevisao']."' AND '".$_POST['periodoFimEmissPrevisao']."' OR 
            DT_ENVIADO_EXPEDICAO BETWEEN '".$_POST['periodoIncEmissPrevisao']."' AND '".$_POST['periodoFimEmissPrevisao']."' OR 
            DT_ENTRADA_PRE_IMP_PROVA BETWEEN '".$_POST['periodoIncEmissPrevisao']."' AND '".$_POST['periodoFimEmissPrevisao']."' OR 
            DT_TIPOGRAFIA_PROVA BETWEEN '".$_POST['periodoIncEmissPrevisao']."' AND '".$_POST['periodoFimEmissPrevisao']."' OR 
            DT_ACABAMENTO_PROVA BETWEEN '".$_POST['periodoIncEmissPrevisao']."' AND '".$_POST['periodoFimEmissPrevisao']."' OR 
            DT_ENTRADA_PRE_IMP BETWEEN '".$_POST['periodoIncEmissPrevisao']."' AND '".$_POST['periodoFimEmissPrevisao']."' OR 
            DT_ENTRADA_CTP BETWEEN '".$_POST['periodoIncEmissPrevisao']."' AND '".$_POST['periodoFimEmissPrevisao']."')";
        } else {
            $Periodo = " ( DT_ENTRADA_PLOTTER BETWEEN '".$_POST['periodoIncEmissPrevisao']."' AND '".$_POST['periodoFimEmissPrevisao']."' OR 
            data_ent_tipografia BETWEEN '".$_POST['periodoIncEmissPrevisao']."' AND '".$_POST['periodoFimEmissPrevisao']."' OR 
            data_ent_acabamento BETWEEN '".$_POST['periodoIncEmissPrevisao']."' AND '".$_POST['periodoFimEmissPrevisao']."' OR 
            DT_ENT_DIGITAL BETWEEN '".$_POST['periodoIncEmissPrevisao']."' AND '".$_POST['periodoFimEmissPrevisao']."' OR 
            data_ent_offset BETWEEN '".$_POST['periodoIncEmissPrevisao']."' AND '".$_POST['periodoFimEmissPrevisao']."' OR 
            DT_ENVIADO_EXPEDICAO BETWEEN '".$_POST['periodoIncEmissPrevisao']."' AND '".$_POST['periodoFimEmissPrevisao']."' OR 
            DT_ENTRADA_PRE_IMP_PROVA BETWEEN '".$_POST['periodoIncEmissPrevisao']."' AND '".$_POST['periodoFimEmissPrevisao']."' OR 
            DT_TIPOGRAFIA_PROVA BETWEEN '".$_POST['periodoIncEmissPrevisao']."' AND '".$_POST['periodoFimEmissPrevisao']."' OR 
            DT_ACABAMENTO_PROVA BETWEEN '".$_POST['periodoIncEmissPrevisao']."' AND '".$_POST['periodoFimEmissPrevisao']."' OR 
            DT_ENTRADA_PRE_IMP BETWEEN '".$_POST['periodoIncEmissPrevisao']."' AND '".$_POST['periodoFimEmissPrevisao']."' OR 
            DT_ENTRADA_CTP BETWEEN '".$_POST['periodoIncEmissPrevisao']."' AND '".$_POST['periodoFimEmissPrevisao']."' ) ";
        }
    }
    if ($_POST['periodoPrevisao'] == 'IncFimPerPrevisao') {
        // " AND data_entrega >= '" . $_POST['periodoIncPerPrevisao'] . "' AND data_entrega <= '" . $_POST['periodoFimPerPrevisao'] . "'"
        if (isset($Periodo)) {
            $Periodo = $Periodo . " AND ( SAIDA_PRE BETWEEN '" . $_POST['periodoIncPerPrevisao'] . "' AND '" . $_POST['periodoFimPerPrevisao'] . "' OR 
            SAIDA_DIGITAL BETWEEN '" . $_POST['periodoIncPerPrevisao'] . "' AND '" . $_POST['periodoFimPerPrevisao'] . "' OR 
            SAIDA_OFFSET BETWEEN '" . $_POST['periodoIncPerPrevisao'] . "' AND '" . $_POST['periodoFimPerPrevisao'] . "' OR 
            SAIDA_CTP BETWEEN '" . $_POST['periodoIncPerPrevisao'] . "' AND '" . $_POST['periodoFimPerPrevisao'] . "' OR 
            SAIDA_TIPOGRAFIA BETWEEN '" . $_POST['periodoIncPerPrevisao'] . "' AND '" . $_POST['periodoFimPerPrevisao'] . "' OR 
            SAIDA_ACABAMENTO BETWEEN '" . $_POST['periodoIncPerPrevisao'] . "' AND '" . $_POST['periodoFimPerPrevisao'] . "' OR 
            SAIDA_PLOTTER BETWEEN '" . $_POST['periodoIncPerPrevisao'] . "' AND '" . $_POST['periodoFimPerPrevisao'] . "' ) 
             ) ";
        } else {
            $Periodo = " ( SAIDA_PRE BETWEEN '" . $_POST['periodoIncPerPrevisao'] . "' AND '" . $_POST['periodoFimPerPrevisao'] . "' OR 
            SAIDA_DIGITAL BETWEEN '" . $_POST['periodoIncPerPrevisao'] . "' AND '" . $_POST['periodoFimPerPrevisao'] . "' OR 
            SAIDA_OFFSET BETWEEN '" . $_POST['periodoIncPerPrevisao'] . "' AND '" . $_POST['periodoFimPerPrevisao'] . "' OR 
            SAIDA_CTP BETWEEN '" . $_POST['periodoIncPerPrevisao'] . "' AND '" . $_POST['periodoFimPerPrevisao'] . "' OR 
            SAIDA_TIPOGRAFIA BETWEEN '" . $_POST['periodoIncPerPrevisao'] . "' AND '" . $_POST['periodoFimPerPrevisao'] . "' OR 
            SAIDA_ACABAMENTO BETWEEN '" . $_POST['periodoIncPerPrevisao'] . "' AND '" . $_POST['periodoFimPerPrevisao'] . "' OR 
            SAIDA_PLOTTER BETWEEN '" . $_POST['periodoIncPerPrevisao'] . "' AND '" . $_POST['periodoFimPerPrevisao'] . "' ) ";
        }
    }
    if (isset($Periodo)) {
        $Query_Periodo = $Periodo;
    }
}

if (isset($_POST['status'])) {
    if ($_POST['status'] != 'todos') {
        if (isset($_POST['statusS'])) {
            if ($_POST['statusS'] == 'producao') {
                $Status = " status not in ('11','15','13','17','10')";
            } else {
                $Status = " status = '" . $_POST['statusS'] . "'";
            }
        }
    }
    if (isset($Status)) {
        $Query_Status = ' AND '. $Status;
    }else{
        $Query_Status = '';
    }
}

if (isset($_POST['campos1'])) {
    $Campos =  $_POST['campos1'] . ' , ';
}
if (isset($_POST['campos2'])) {
    if (isset($Campos)) {
        $Campos = $Campos . $_POST['campos2'] . ' , ';
    } else {
        $Campos = $_POST['campos2'];
    }
}
if (isset($_POST['campos3'])) {
    if (isset($Campos)) {
        $Campos = $Campos . $_POST['campos3'] . ' , ';
    } else {
        $Campos = $_POST['campos3'];
    }
}
if ($_POST['emissor'] == 'PorEmiss') {
    if (isset($Campos)) {
        $Campos = $Campos .'tabela_ordens_producao.COD_ATENDENTE , ';
    } else {
        $Campos = 'tabela_ordens_producao.COD_ATENDENTE';
    }
}
if (isset($_POST['campos4'])) {
    if (isset($Campos)) {
        $Campos = $Campos . $_POST['campos4'] . ' , ';
    } else {
        $Campos = $_POST['campos4'];
    }
} else {
    if (isset($Campos)) {
        $Campos = $Campos .  ' tabela_ordens_producao.cod_produto , ';
    } else {
        $Campos = ' tabela_ordens_producao.cod_produto ';
    }
}
if (isset($_POST['campos5'])) {
    // if(isset($Campos)){
    //     $Campos = $Campos . $_POST['campos5'] . ' , ' ;
    // }else{
    //     $Campos = $_POST['campos5'];
    // }
}
if (isset($_POST['campos6'])) {
    if (isset($Campos)) {
        $Campos = $Campos . $_POST['campos6'] . ' , ';
    } else {
        $Campos = $_POST['campos6'];
    }
}
if (isset($_POST['campos7'])) {
    // $Inner = true;
    // if(isset($Campos)){
    //     $Campos = $Campos . $_POST['campos7'] . ' , ' ;
    // }else{
    //     $Campos = $_POST['campos7'];
    // }
}
if (isset($_POST['campos8'])) {
    // $Inner = true;
    // if(isset($Campos)){
    //     $Campos = $Campos . $_POST['campos8'] . ' , ' ;
    // }else{
    //     $Campos = $_POST['campos8'];
    // }
}
if (isset($_POST['campos9'])) {
    if (isset($Campos)) {
        $Campos = $Campos . $_POST['campos9'] . ' , ';
    } else {
        $Campos = $_POST['campos9'];
    }
}
if (isset($_POST['campos10'])) {
    if (isset($Campos)) {
        $Campos = $Campos . $_POST['campos10'] . ' , ';
    } else {
        $Campos = $_POST['campos10'];
    }
}
if (isset($_POST['campos11'])) {
    if (isset($Campos)) {
        $Campos = $Campos . $_POST['campos11'] . ' , ';
    } else {
        $Campos = $_POST['campos11'];
    }
}
if (isset($_POST['campos12'])) {
    if (isset($Campos)) {
        $Campos = $Campos . $_POST['campos12'] . ' , ';
    } else {
        $Campos = $_POST['campos12'];
    }
}
if (isset($_POST['campos13'])) {
    if (isset($Campos)) {
        $Campos = $Campos . $_POST['campos13'] . ' , ';
    } else {
        $Campos = $_POST['campos13'];
    }
}
if (isset($_POST['campos14'])) {
    if (isset($Campos)) {
        $Campos = $Campos . $_POST['campos14'] . ' , ';
    } else {
        $Campos = $_POST['campos14'];
    }
}
if (isset($_POST['campos15'])) {
    if (isset($Campos)) {
        $Campos = $Campos . $_POST['campos15'] . ' , ';
    } else {
        $Campos = $_POST['campos15'];
    }
}
if (isset($_POST['campos16'])) {
    if (isset($Campos)) {
        $Campos = $Campos . $_POST['campos16'] . ' , ';
    } else {
        $Campos = $_POST['campos16'];
    }
}
if (isset($_POST['campos17'])) {
    if (isset($Campos)) {
        $Campos = $Campos . $_POST['campos17'] . ' , ';
    } else {
        $Campos = $_POST['campos17'];
    }
}
if (isset($_POST['campos20'])) {
    if (isset($Campos)) {
        $Campos = $Campos . $_POST['campos20'] . ' , ';
    } else {
        $Campos = $_POST['campos20'];
    }
}
if (isset($_POST['campos21'])) {
    if (isset($Campos)) {
        $Campos = $Campos . $_POST['campos21'] . ' , ';
    } else {
        $Campos = $_POST['campos21'];
    }
}
if (isset($_POST['campos25'])) {
    if (isset($Campos)) {
        $Campos = $Campos . ' data_1a_prova, data_2a_prova, data_3a_prova, data_4a_prova, data_5a_prova ' . ' ,  ';
    } else {
        $Campos = 'data_1a_prova, data_2a_prova, data_3a_prova, data_4a_prova, data_5a_prova';
    }
}
if (isset($_POST['campos26'])) {
    if (isset($Campos)) {
        $Campos = $Campos . ' data_1a_prova, data_2a_prova, data_3a_prova, data_4a_prova, data_5a_prova ' . ' ,  ';
    } else {
        $Campos = 'data_1a_prova, data_2a_prova, data_3a_prova, data_4a_prova, data_5a_prova';
    }
}
if (isset($_POST['campos27'])) {
    if (isset($Campos)) {
        $Campos = $Campos . "SAIDA_PRE , SAIDA_DIGITAL , SAIDA_OFFSET , data_ent_acabamento, data_ent_tipografia, SAIDA_CTP, SAIDA_TIPOGRAFIA,SAIDA_ACABAMENTO, SAIDA_PLOTTER "   . ' , ';
    } else {
        $Campos = "SAIDA_PRE , SAIDA_DIGITAL , SAIDA_OFFSET , data_ent_acabamento, data_ent_tipografia, SAIDA_CTP, SAIDA_TIPOGRAFIA,SAIDA_ACABAMENTO, SAIDA_PLOTTER ";
    }
}
if (isset($_POST['campos24'])) {
    if (isset($Campos)) {
        $Campos = $Campos . "DT_ENTRADA_PLOTTER , data_ent_tipografia, data_ent_acabamento, DT_ENT_DIGITAL, data_ent_offset , DT_ENVIADO_EXPEDICAO , DT_ENTRADA_PRE_IMP_PROVA , DT_TIPOGRAFIA_PROVA, DT_ACABAMENTO_PROVA,DT_ENTRADA_PRE_IMP, DT_ENTRADA_CTP "   . ' , ';
    } else {
        $Campos = "DT_ENTRADA_PLOTTER , data_ent_tipografia, DT_ENT_DIGITAL, data_ent_acabamento, data_ent_offset , DT_ENVIADO_EXPEDICAO , DT_ENTRADA_PRE_IMP_PROVA , DT_TIPOGRAFIA_PROVA, DT_ACABAMENTO_PROVA,DT_ENTRADA_PRE_IMP, DT_ENTRADA_CTP ";
    }
}
if (isset($_POST['campos15'])) {
    if (isset($Campos)) {
        $Campos = $Campos . $_POST['campos15'] . ' , ';
    } else {
        $Campos = $_POST['campos15'];
    }
}
if (isset($_POST['campos26'])) {
    if (isset($Campos)) {
        $Campos = $Campos . $_POST['campos26'] . ' , ';
    } else {
        $Campos = $_POST['campos26'];
    }
}
if (isset($_POST['campos18'])) {
    if (!isset($_POST['campos3'])) {
        if (isset($Campos)) {
            $Campos = $Campos . ' cod_cliente , ';
        } else {
            $Campos = ' cod_cliente ';
        }
    }
    if (!isset($_POST['campos6'])) {
        if (isset($Campos)) {
            $Campos = $Campos . ' tipo_cliente , ';
        } else {
            $Campos = ' tipo_cliente ';
        }
    }
}
if (isset($_POST['ordenar'])) {
    if ($_POST['ordenar'] == 'SemOrdem') {
        $OrderBy = ' ORDER BY data_entrega DESC';
    } else {
        $OrderBy = ' ORDER BY ' . $_POST['ordenar'];
    }
}else{
    $OrderBy = ' ORDER BY data_entrega DESC';
}
if (isset($_POST['campos19'])) {

    if (isset($Campos)) {
        $Campos = $Campos . $_POST['campos19'] . ' , tabela_ordens_producao.tipo_produto';
    } else {
        $Campos = $_POST['campos19'] . ' , tabela_ordens_producao.tipo_produto';
    }
    if (isset($Inner)) {
        if ($Inner == '1') {
            if (!isset($_POST['campo8'])) {
                if (isset($Campos)) {
                    if (isset($_POST['campos19'])) {
                        $Campos = $Campos . ' , (quantidade * preco_unitario) AS VLR_PARC ';
                    }
                } else {
                    $Campos = ' (quantidade * preco_unitario) AS VLR_PARC';
                }
            }
        }
    }
}
if (isset($Campos)) {
    $Query_Campos = $Campos . ', cod_cliente ';
}
if ($Produto != null) {
    $Query_Produto = ' AND '. $Produto;
}else{
    $Query_Produto = '';
}
if (isset($Emissor)) {
    $Query_Emissor = ' AND '. $Emissor;
}else{
    $Query_Emissor = '';
}





$Query_Select = "SELECT ";



if (isset($Inner)) {
    if ($Inner == '1') {
        $Query_Inner =  ' INNER JOIN tabela_produtos_orcamento ON tabela_ordens_producao.cod_produto = tabela_produtos_orcamento.cod ';
    }
}
if (isset($Query_Campos)) {
    $Query_Campos_Completa =" * FROM tabela_ordens_producao  INNER JOIN sts_op s ON s.CODIGO = tabela_ordens_producao.status ";
    if (isset($Query_Inner)) {
        $Query_Inicio = $Query_Select . $Query_Campos_Completa . $Query_Inner;
    } else {
        $Query_Inicio = $Query_Select . $Query_Campos_Completa;
    }
}
if (!isset($Query_Campos_Completa)) {
    $Fecha_Inicio = " * FROM tabela_ordens_producao p INNER JOIN sts_op s ON s.CODIGO = p.status ";
    $Query_Inicio =  $Query_Inicio . $Fecha_Inicio;
}

if (
    isset($Query_OpOrc) || isset($Query_Produto) || isset($Query_Cliente) || isset($Query_Emissor) || isset($Query_Periodo) ||
    isset($Query_Status)
) {
    $Query_Busca_Completa = $Query_Inicio . $ProdutoJoin .' WHERE cod != "-1" ' . $Query_OpOrc . $Query_Produto . $Query_Cliente . $Query_Emissor . $Query_Periodo . $Query_Status;
}
    $Query_Busca_Completa = $Query_Busca_Completa . $OrderBy;

//
// echo $Query_Busca_Completa . '<br>';
$Query_Busca_Completa_Executavel = $conexao->prepare("$Query_Busca_Completa");
$Query_Busca_Completa_Executavel->execute();
//   echo '<br><b>'.$Campos.'</b>';
$Recebe = 0;


while ($linha = $Query_Busca_Completa_Executavel->fetch(PDO::FETCH_ASSOC)) {
    $Quantidade_Prova = 0;
    if (isset($_POST['campos1'])) {
        $cod_ = $linha['cod'];

        $cod[$Recebe] = $cod_;
    }
    if (isset($_POST['campos2'])) {
        $orcamento_base_ = $linha['orcamento_base'];
        $orcamento_base[$Recebe] = $orcamento_base_;
    }
  
        $cod_cliente_  = $linha['cod_cliente'];
        $cod_cliente[$Recebe] = $cod_cliente_;
    
    if (isset($_POST['campos4'])) {
        $cod_produto_ = $linha['cod_produto'];
        $cod_produto[$Recebe] = $cod_produto_;
    } else {
        $cod_produto_ = $linha['cod_produto'];
        $cod_produto[$Recebe] = $cod_produto_;
    }

    if (isset($_POST['campos6'])) {
        $tipo_cliente_ = $linha['tipo_cliente'];
        if($tipo_cliente_ == '2'){
            $tipo_cliente[$Recebe] = 'JURÍDICA';
        }else{
            $tipo_cliente[$Recebe] = 'FÍSICA';
        }
    }
    if (isset($_POST['campos18'])) {
        if (!isset($_POST['campos3'])) {
            $cod_cliente_  = $linha['cod_cliente'];
            $cod_cliente[$Recebe] = $cod_cliente_;
        }
        if (!isset($_POST['campos6'])) {
            $tipo_cliente_ = $linha['tipo_cliente'];
            $tipo_cliente[$Recebe] = $tipo_cliente_;
        }
    }
    $tipo_cliente_ = $linha['tipo_cliente'];
    $tipo_cliente[$Recebe] = $tipo_cliente_;
    if (isset($_POST['campos5'])) {
        $tipo_produto_ = $linha['tipo_produto'];
        $tipo_produto[$Recebe] = $tipo_produto_;
        if (!isset($cod_produto[$Recebe])) {
            $cod_produto_ = $linha['cod_produto'];
            $cod_produto[$Recebe] = $cod_produto_;
        }
    }
    if (isset($_POST['campos7'])) {
        $orcamento_base_ = $linha['orcamento_base'];
        $quantiadade = $conexao->prepare("SELECT * FROM tabela_produtos_orcamento  WHERE cod_produto = '$cod_produto_' AND cod_orcamento = '$orcamento_base_'");
        $quantiadade->execute();

        if ($linhaQtd = $quantiadade->fetch(PDO::FETCH_ASSOC)) {
            $quantidade_ = $linhaQtd['quantidade'];
            $quantidade[$Recebe] = $quantidade_;
        }
        if (!isset($quantidade[$Recebe])) {
            $quantidade[$Recebe] = 'N/C';
        }
    }
    if (isset($_POST['campos20'])) {
        $prioridade_ = $linha['prioridade_op'];
        $prioridade[$Recebe] = $prioridade_;
    }

    if (isset($_POST['campos8'])) {
        $orcamento_base_ = $linha['orcamento_base'];
        $quantiadade = $conexao->prepare("SELECT (quantidade * preco_unitario) AS VLR_PARC FROM tabela_produtos_orcamento  WHERE cod_produto = '$cod_produto_' AND cod_orcamento = '$orcamento_base_'");
        $quantiadade->execute();

        if ($valorPes = $quantiadade->fetch(PDO::FETCH_ASSOC)) {
            $VLR_PARC_ = $valorPes['VLR_PARC'];
            $VLR_PARC[$Recebe] = $VLR_PARC_;
        }
        if (!isset($VLR_PARC[$Recebe])) {
            $VLR_PARC[$Recebe] = 'N/C';
        }
    }
    if (isset($_POST['campos9'])) {
        $data_emissao_ = $linha['data_emissao'];
        $data_emissao[$Recebe] =  date('d/m/Y', strtotime($data_emissao_));
    }
    if (isset($_POST['campos10'])) {
        $data_entrega_ = $linha['data_entrega'];
        $data_entrega[$Recebe] = date('d/m/Y', strtotime($data_entrega_));
    }
    if (isset($_POST['campos11'])) {
        $data_1a_prova_ = $linha['data_1a_prova'];
        $data_1a_prova[$Recebe] =  date('d/m/Y', strtotime($data_1a_prova_));
    }
    if (isset($_POST['campos12'])) {
        $data_2a_prova_ = $linha['data_2a_prova'];
        $data_2a_prova[$Recebe] =  date('d/m/Y', strtotime($data_2a_prova_));
    }
    if (isset($_POST['campos13'])) {
        $data_3a_prova_ = $linha['data_3a_prova'];
        $data_3a_prova[$Recebe] =  date('d/m/Y', strtotime($data_3a_prova_));
    }
    if (isset($_POST['campos14'])) {
        $data_4a_prova_ = $linha['data_4a_prova'];
        $data_4a_prova[$Recebe] =  date('d/m/Y', strtotime($data_4a_prova_));
    }
    if (isset($_POST['campos15'])) {
        $data_5a_prova_ = $linha['data_5a_prova'];
        $data_5a_prova[$Recebe] =  date('d/m/Y', strtotime($data_5a_prova_));
    }
    if (isset($_POST['campos21'])) {
        $descricao_Obs_ = $linha['descricao'];
        $descricao_Obs[$Recebe] = $descricao_Obs_;
    }
    if (isset($_POST['campos27'])) {
       
            $data_previsao_inicio_PRE = $linha['SAIDA_PRE'];
            if (isset($data_previsao_inicio_PRE)) {
                $data_previcao_Saida_PRE[$Recebe] =  date('d/m/Y', strtotime($data_previsao_inicio_PRE));
            }else{
                $data_previcao_Saida_PRE[$Recebe] = 'N/C';
            }
       
        
            $data_previsao_inicio_OFF = $linha['SAIDA_OFFSET'];
            if (isset($data_previsao_inicio_OFF)) {
                $data_previcao_Saida_OFF[$Recebe] =  date('d/m/Y', strtotime($data_previsao_inicio_OFF));
            }else{
                $data_previcao_Saida_OFF[$Recebe] = 'N/C';
            } 
        
        
            $data_previsao_inicio_ = $linha['SAIDA_DIGITAL'];
            if (isset($data_previsao_inicio_)) {
                $data_previcao_Saida_DIG[$Recebe] =  date('d/m/Y', strtotime($data_previsao_inicio_));
            }else{
                $data_previcao_Saida_DIG[$Recebe] = 'N/C';
            }
        
       
            $data_previsao_inicio_ = $linha['SAIDA_TIPOGRAFIA'];
            if (isset($data_previsao_inicio_)) {
                $data_previcao_Saida_TIP[$Recebe] =  date('d/m/Y', strtotime($data_previsao_inicio_));
            }else{
                $data_previcao_Saida_TIP[$Recebe] = 'N/C';
            }
        
       
            $data_previsao_inicio_ = $linha['SAIDA_ACABAMENTO'];
            if (isset($data_previsao_inicio_)) {
                $data_previcao_Saida_ACA[$Recebe] =  date('d/m/Y', strtotime($data_previsao_inicio_));
            }else{
                $data_previcao_Saida_ACA[$Recebe] = 'N/C';
            } 
        
       
            $data_previsao_inicio_ = $linha['SAIDA_CTP'];
            if (isset($data_previsao_inicio_)) {
                $data_previcao_Saida_CTP[$Recebe] =  date('d/m/Y', strtotime($data_previsao_inicio_));
            }else{
                $data_previcao_Saida_CTP[$Recebe] = 'N/C';
            }
       
      
            $data_previsao_inicio_ = $linha['SAIDA_PLOTTER'];
            if (isset($data_previsao_inicio_)) {
                $data_previcao_Saida_PLOTTER[$Recebe] =  date('d/m/Y', strtotime($data_previsao_inicio_));
            }else{
                $data_previcao_Saida_PLOTTER[$Recebe] = 'N/C';
            } 
    }
     if (isset($_POST['campos24'])) {
      
            $data_previsao_inicio_ = $linha['DT_ENTRADA_PLOTTER'];
            if (isset($data_previsao_inicio_)) {
                $data_previcao_inicio_PLOT[$Recebe] =  date('d/m/Y', strtotime($data_previsao_inicio_));
            }else{
                $data_previcao_inicio_PLOT[$Recebe] = 'N/C';
            }  
       
            $data_previsao_inicio_ = $linha['data_ent_offset'];
            if (isset($data_previsao_inicio_)) {
                $data_previcao_inicio_OFF[$Recebe] =  date('d/m/Y', strtotime($data_previsao_inicio_));
            }else{
                $data_previcao_inicio_OFF[$Recebe] = 'N/C';
            }  
       
            $data_previsao_inicio_ = $linha['DT_ENT_DIGITAL'];
            if (isset($data_previsao_inicio_)) {
                $data_previcao_inicio_DIG[$Recebe] =  date('d/m/Y', strtotime($data_previsao_inicio_));
            }else{
                $data_previcao_inicio_DIG[$Recebe] = 'N/C';
            }  
       
            $data_previcao_inicio_PRO_ = $linha['data_ent_tipografia'];
            if (isset($data_previcao_inicio_PRO_)) {
                $data_previcao_inicio_PRO[$Recebe] =  date('d/m/Y', strtotime($data_previcao_inicio_PRO_));
            }else{
                $data_previcao_inicio_PRO[$Recebe] = 'N/C';
            }  
       
            $data_previsao_inicio_ = $linha['data_ent_acabamento'];
            if (isset($data_previsao_inicio_)) {
                $data_previcao_inicio_ACA[$Recebe] =  date('d/m/Y', strtotime($data_previsao_inicio_));
            }else{
                $data_previcao_inicio_ACA[$Recebe] = 'N/C';
            }  
      
            $data_previsao_inicio_ = $linha['DT_ENTRADA_PRE_IMP'];
            if (isset($data_previsao_inicio_)) {
                $data_previcao_inicio_PRE[$Recebe] =  date('d/m/Y', strtotime($data_previsao_inicio_));
            }else{
                $data_previcao_inicio_PRE[$Recebe] = 'N/C';
            } 
       
            $data_previsao_inicio_ = $linha['DT_ENTRADA_CTP'];
            if (isset($data_previsao_inicio_)) {
                $data_previcao_inicio_CTP[$Recebe] =  date('d/m/Y', strtotime($data_previsao_inicio_));
            }else{
                $data_previcao_inicio_CTP[$Recebe] = 'N/C';
            } 
    }
    if (isset($_POST['campos16'])) {
        $op_secao_ = $linha['op_secao'];
        $op_secao[$Recebe] = $op_secao_;
    }
    if (isset($_POST['campos25'])) {
        $dP1 = $linha['data_1a_prova'];
        $dP2 = $linha['data_2a_prova'];
        $dP3 = $linha['data_3a_prova'];
        $dP4 = $linha['data_4a_prova'];
        $dP5 = $linha['data_5a_prova'];
        if ($dP1 != '') {
            $Quantidade_Prova++;
        }
        if ($dP2 != '') {
            $Quantidade_Prova++;
        }
        if ($dP3 != '') {
            $Quantidade_Prova++;
        }
        if ($dP4 != '') {
            $Quantidade_Prova++;
        }
        if ($dP5 != '') {
            $Quantidade_Prova++;
        }
        $Total_Quantidade_Prova[$Recebe] = $Quantidade_Prova;
    }
    if (isset($_POST['campos26'])) {
        $dP1 = $linha['data_1a_prova'];
        $dP2 = $linha['data_2a_prova'];
        $dP3 = $linha['data_3a_prova'];
        $dP4 = $linha['data_4a_prova'];
        $dP5 = $linha['data_5a_prova'];
        if ($dP1 != '') {
            $data_expedida = $dP1;
        }
        if ($dP2 != '') {
            $data_expedida = $dP2;
        }
        if ($dP3 != '') {
            $data_expedida = $dP3;
        }
        if ($dP4 != '') {
            $data_expedida = $dP4;
        }
        if ($dP5 != '') {
            $data_expedida = $dP5;
        }
        if (isset($Data_Expedida_Prova[$Recebe])) {
            $Data_Expedida_Prova[$Recebe] =  date('d/m/Y', strtotime($data_expedida));
        } else {
            $Data_Expedida_Prova[$Recebe] =  'N/C';
        }
    }
    if (isset($_POST['campos17'])) {
        $cod_emissor_ = $linha['cod_emissor'];
        $cod_emissor[$Recebe] = $cod_emissor_;
    }
    if (isset($_POST['campos17'])) {
        $cod_emissor_ = $linha['cod_emissor'];
        $cod_emissor[$Recebe] = $cod_emissor_;
    }
    if (isset($_POST['campos5'])) {
        if ($tipo_produto[$Recebe] == '2') {
            $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos_pr_ent  WHERE CODIGO = '$cod_produto[$Recebe]'");
            $query_PRODUTOS->execute();

            while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                $descricao_ = $linha2['DESCRICAO'];
                $descricao[$Recebe] = $descricao_;
            }
        }
        if ($tipo_produto[$Recebe] == '1') {
            $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos  WHERE CODIGO = '$cod_produto[$Recebe]'");
            $query_PRODUTOS->execute();

            while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                $descricao_ = $linha2['DESCRICAO'];
                $descricao[$Recebe] = $descricao_;
            }
        }
        if (!isset($descricao[$Recebe])) {
            $descricao[$Recebe] = 'N/C';
        }
    }
    if (isset($_POST['campos22'])) {
        // FATURAMENTOS
        $FaturamentoQtd = $conexao->prepare("SELECT * FROM faturamentos  WHERE CODIGO_OP = '$cod[$Recebe]'");
        $FaturamentoQtd->execute();

        if ($Qtd = $FaturamentoQtd->fetch(PDO::FETCH_ASSOC)) {
            $Qtd_Entregue_ = $Qtd['QTD_ENTREGUE'];
            $Qtd_Entregue[$Recebe] = $Qtd_Entregue_;
        }
        if (!isset($Qtd_Entregue[$Recebe])) {
            $Qtd_Entregue_ = 0;
            $Qtd_Entregue[$Recebe] = 'N/C';
        }
    }
    if (isset($_POST['campos23'])) {
        // TABELA PRODUTOS ORCAMENTO quantidade - FATURAMENTO QTD_ENTREGUE
        $ProdutoQtd = $conexao->prepare("SELECT * FROM tabela_produtos_orcamento  WHERE cod_produto = '$cod_produto_' AND cod_orcamento = '$orcamento_base_'");
        $ProdutoQtd->execute();

        if ($ProdutoBQtd = $ProdutoQtd->fetch(PDO::FETCH_ASSOC)) {
            $Produto_Qtd_ = $ProdutoBQtd['quantidade'] - $Qtd_Entregue_;
            $Produto_Qtd[$Recebe] = $Produto_Qtd_;
        }
        if (!isset($Produto_Qtd[$Recebe])) {
            $Produto_Qtd[$Recebe] = 'N/C';
        }
    }
    if (isset($_POST['campos18'])) {
        if ($tipo_cliente[$Recebe] == '1') {
            $TP1 = $cod_cliente[$Recebe];
            $query_Nome_Clientes = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos WHERE cod = $TP1");
        }
        if ($tipo_cliente[$Recebe] == '2') {
            $TP2 = $cod_cliente[$Recebe];
            $query_Nome_Clientes = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos WHERE cod = $TP2");
        }
        
        
        $query_Nome_Clientes->execute();
        
        if ($linhaXTP = $query_Nome_Clientes->fetch(PDO::FETCH_ASSOC)) {
            $nome_ = $linhaXTP['nome'];
            $nome[$Recebe] = $nome_;
        }
    }
    if (isset($_POST['campos19'])) {
        $status_ = $linha['STS_DESCRICAO'];
        $status[$Recebe] = $status_;
    }
    $Recebe++;
}

date_default_timezone_set('America/Sao_Paulo');
$data_hora   = date('d/m/Y H:i:s ', time());
$data_horaa = (string) $data_hora;
$titulo = "<h5>RELATÓRIO DE ORDEM DE PRODUÇÃO - DATA E HORA DE EMISSÃO: " . $data_horaa . " - SISGRAFEX</h5><br>";
$Inicio_Tabela = "<table style=' solid black; width: 100%;  border-collapse:collapse; font-size: 10; 
        text-align: center;
        color: black;' border='1' class='table'>
        <tr>";
if (isset($_POST['campos1'])) {
    $Cabesalhos = "<th style=' color:Black'>CÓDIGO OP</th>";
}
if (isset($_POST['campos2'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>CÓDIGO ORÇAMENTO</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>CÓDIGO ORÇAMENTO</th>";
    }
}
if (isset($_POST['campos3'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>CÓDIGO CLIENTE</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>CÓDIGO CLIENTE</th>";
    }
}
if (isset($_POST['campos4'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>CÓDIGO PRODUTO</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>CÓDIGO PRODUTO</th>";
    }
}
if (isset($_POST['campos5'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>DESCRIÇÃO PRODUTO</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>DESCRIÇÃO PRODUTO</th>";
    }
}
if (isset($_POST['campos6'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>TIPO PESSOA</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>TIPO PESSOA</th>";
    }
}
if (isset($_POST['campos7'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>QUANTIDADE</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>QUANTIDADE</th>";
    }
}
if (isset($_POST['campos8'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>VALOR PARCIAL</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>VALOR PARCIAL</th>";
    }
}
if (isset($_POST['campos9'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>DATA EMISSÃO</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>DATA EMISSÃO</th>";
    }
}
if (isset($_POST['campos10'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>PREVISÃO DE ENTREGA</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>PREVISÃO DE ENTREGA</th>";
    }
}
if (isset($_POST['campos11'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>DATA 1ª PROVA</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>DATA 1ª PROVA</th>";
    }
}
if (isset($_POST['campos12'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>DATA 2ª PROVA</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>DATA 2ª PROVA</th>";
    }
}
if (isset($_POST['campos13'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>DATA 3ª PROVA</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>DATA 3ª PROVA</th>";
    }
}
if (isset($_POST['campos14'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>DATA 4ª PROVA</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>DATA 4ª PROVA</th>";
    }
}
if (isset($_POST['campos15'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>DATA 5ª PROVA</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>DATA 5ª PROVA</th>";
    }
}
if (isset($_POST['campos16'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>OPERADOR OR</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>OPERADOR OR</th>";
    }
}
if (isset($_POST['campos17'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>EMISSOR</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>EMISSOR</th>";
    }
}
if (isset($_POST['campos18'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>NOME CLIENTE</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>NOME CLIENTE</th>";
    }
}

if (isset($_POST['campos20'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>PRIORIDADE</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>PRIORIDADE</th>";
    }
}
if (isset($_POST['campos21'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>OBSERVAÇÕES</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>OBSERVAÇÕES</th>";
    }
}
if (isset($_POST['campos22'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>QUANTIDADE ENTREGUES</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>QUANTIDADE ENTREGUES</th>";
    }
}
if (isset($_POST['campos23'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>QUANTIDADE A ENTREGAR</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>QUANTIDADE A ENTREGAR</th>";
    }
}
if (isset($_POST['campos24'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>PREVISÃO INICIO DA PRÉ-IMP</th>
        <th style=' color:Black'>PREVISÃO INICIO DA DIGITAL</th>
        <th style=' color:Black'>PREVISÃO INICIO DA OFFSET</th>
        <th style=' color:Black'>PREVISÃO INICIO DA CTP</th>
        <th style=' color:Black'>PREVISÃO INICIO DA TIPOGRAFIA</th>
        <th style=' color:Black'>PREVISÃO INICIO DO ACABAMENTO</th>
        <th style=' color:Black'>PREVISÃO INICIO DA PLOTTER</th>
        ";
    } else {
        $Cabesalhos = "<th style=' color:Black'>PREVISÃO INICIO DA PRÉ-IMP</th>
        <th style=' color:Black'>PREVISÃO INICIO DA DIGITAL</th>
        <th style=' color:Black'>PREVISÃO INICIO DA OFFSET</th>
        <th style=' color:Black'>PREVISÃO INICIO DA CTP</th>
        <th style=' color:Black'>PREVISÃO INICIO DA TIPOGRAFIA</th>
        <th style=' color:Black'>PREVISÃO INICIO DO ACABAMENTO</th>
        <th style=' color:Black'>PREVISÃO INICIO DA PLOTTER</th>";
    }
}
if (isset($_POST['campos27'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>PREVISÃO TERMINO DA PRÉ-IMP</th>
        <th style=' color:Black'>PREVISÃO TERMINO DA DIGITAL</th>
        <th style=' color:Black'>PREVISÃO TERMINO DA OFFSET</th>
        <th style=' color:Black'>PREVISÃO TERMINO DA CTP</th>
        <th style=' color:Black'>PREVISÃO TERMINO DA TIPOGRAFIA</th>
        <th style=' color:Black'>PREVISÃO TERMINO DO ACABAMENTO</th>
        <th style=' color:Black'>PREVISÃO TERMINO DA PLOTTER</th>
        ";
    } else {
        $Cabesalhos = "<th style=' color:Black'>PREVISÃO TERMINO DA PRÉ-IMP</th>
        <th style=' color:Black'>PREVISÃO TERMINO DA DIGITAL</th>
        <th style=' color:Black'>PREVISÃO TERMINO DA OFFSET</th>
        <th style=' color:Black'>PREVISÃO TERMINO DA CTP</th>
        <th style=' color:Black'>PREVISÃO TERMINO DA TIPOGRAFIA</th>
        <th style=' color:Black'>PREVISÃO TERMINO DO ACABAMENTO</th>
        <th style=' color:Black'>PREVISÃO TERMINO DA PLOTTER</th>";
    }
}
if (isset($_POST['campos25'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>QUANTIDADE DE PROVA</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>QUANTIDADE DE PROVA</th>";
    }
}
if (isset($_POST['campos26'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>DATA EXPEDIÇÃO DE PROVA</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>DATA EXPEDIÇÃO DE PROVA</th>";
    }
}
if (isset($_POST['campos19'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>STATUS</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>STATUS</th>";
    }
}

$Fecha_Inicio = " </tr>";
$Exibir = 0;
$Abre_Dados = "";
while ($Exibir < $Recebe) {
    if (isset($_POST['campos1'])) {
        if (isset($cod[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<tr><td>" . $cod[$Exibir] . "</td>";
            } else {
                $Dados = "<tr><td>" . $cod[$Exibir] . "</td>";
            }
        } else {
            if (isset($Dados)) {
                $Dados = $Dados . "<tr><td>N/C</td>";
            } else {
                $Dados = "<tr><td>N/C</td>";
            }
        }
    }
    if (isset($_POST['campos2'])) {
        if (isset($orcamento_base[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $orcamento_base[$Exibir] . "</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        } else {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>N/C</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        }
    }
    if (isset($_POST['campos3'])) {
        if (isset($cod_cliente[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $cod_cliente[$Exibir] . "</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        } else {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>N/C</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        }
    }
    if (isset($_POST['campos4'])) {
        if (isset($cod_produto[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $cod_produto[$Exibir] . "</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        } else {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>N/C</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        }
    }
    if (isset($_POST['campos5'])) {
        if (isset($descricao[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $descricao[$Exibir] . "</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        } else {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>N/C</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        }
    }
    if (isset($_POST['campos6'])) {
        if (isset($tipo_cliente[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $tipo_cliente[$Exibir] . "</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        } else {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>N/C</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        }
    }
    if (isset($_POST['campos7'])) {
        if (isset($quantidade[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $quantidade[$Exibir] . "</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        } else {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>N/C</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        }
    }
    if (isset($_POST['campos8'])) {
        if (isset($VLR_PARC[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $VLR_PARC[$Exibir] . "</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        } else {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>N/C</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        }
    }
    if (isset($_POST['campos9'])) {
        if (isset($data_emissao[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $data_emissao[$Exibir] . "</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        } else {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>N/C</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        }
    }
    if (isset($_POST['campos10'])) {
        if (isset($data_entrega[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $data_entrega[$Exibir] . "</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        } else {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>N/C</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        }
    }
    if (isset($_POST['campos11'])) {
        if (isset($data_1a_prova[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $data_1a_prova[$Exibir] . "</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        } else {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>N/C</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        }
    }
    if (isset($_POST['campos12'])) {
        if (isset($data_2a_prova[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $data_2a_prova[$Exibir] . "</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        } else {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>N/C</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        }
    }
    if (isset($_POST['campos13'])) {
        if (isset($data_3a_prova[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $data_3a_prova[$Exibir] . "</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        } else {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>N/C</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        }
    }
    if (isset($_POST['campos14'])) {
        if (isset($data_4a_prova[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $data_4a_prova[$Exibir] . "</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        } else {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>N/C</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        }
    }
    if (isset($_POST['campos15'])) {
        if (isset($data_5a_prova[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $data_5a_prova[$Exibir] . "</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        } else {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>N/C</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        }
    }
    if (isset($_POST['campos16'])) {
        if (isset($op_secao[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $op_secao[$Exibir] . "</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        } else {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>N/C</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        }
    }
    if (isset($_POST['campos17'])) {
        if (isset($cod_emissor[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $cod_emissor[$Exibir] . "</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        } else {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>N/C</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        }
    }
    if (isset($_POST['campos18'])) {
        if (isset($nome[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $nome[$Exibir] . "</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        } else {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>N/C</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        }
    }
    if (isset($_POST['campos20'])) {
        if (isset($prioridade[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $prioridade[$Exibir] . "</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        } else {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>N/C</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        }
    }
    if (isset($_POST['campos21'])) {
        if (isset($descricao_Obs[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $descricao_Obs[$Exibir] . "</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        } else {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>N/C</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        }
    }
    if (isset($_POST['campos22'])) {
        if (isset($Qtd_Entregue[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $Qtd_Entregue[$Exibir] . "</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        } else {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>N/C</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        }
    }
    if (isset($_POST['campos23'])) {
        if (isset($Produto_Qtd[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $Produto_Qtd[$Exibir] . "</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        } else {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>N/C</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        }
    }
    if (isset($_POST['campos24'])) {
       
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $data_previcao_inicio_PRE[$Exibir] . "</td>
                        <td>" . $data_previcao_inicio_DIG[$Exibir] . "</td>
                        <td>" . $data_previcao_inicio_OFF[$Exibir] . "</td>
                        <td>" . $data_previcao_inicio_CTP[$Exibir] . "</td>
                        <td>" . $data_previcao_inicio_PRO[$Exibir] . "</td>
                        <td>" . $data_previcao_inicio_ACA[$Exibir] . "</td>
                        <td>" . $data_previcao_inicio_PLOT[$Exibir] . "</td>";
            } else {
                $Dados = "<td>N/C</td><td>N/C</td><td>N/C</td>
                <td>N/C</td><td>N/C</td><td>N/C</td><td>N/C</td>";
            }
        
    }
    if (isset($_POST['campos27'])) {
        
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $data_previcao_Saida_PRE[$Exibir] . "</td>
                        <td>" . $data_previcao_Saida_DIG[$Exibir] . "</td>
                        <td>" . $data_previcao_Saida_OFF[$Exibir] . "</td>
                        <td>" . $data_previcao_Saida_CTP[$Exibir] . "</td>
                        <td>" . $data_previcao_Saida_TIP[$Exibir] . "</td>
                        <td>" . $data_previcao_Saida_ACA[$Exibir] . "</td>
                        <td>" . $data_previcao_Saida_PLOTTER[$Exibir] . "</td>";
            } else {
                $Dados = "<td>N/C</td><td>N/C</td><td>N/C</td>
                <td>N/C</td><td>N/C</td><td>N/C</td><td>N/C</td>";
            }
    }
    
    if (isset($_POST['campos25'])) {
        if (isset($Total_Quantidade_Prova[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $Total_Quantidade_Prova[$Exibir] . "</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        } else {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>N/C</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        }
    }
    if (isset($_POST['campos26'])) {
        if (isset($Data_Expedida_Prova[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $Data_Expedida_Prova[$Exibir] . "</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        } else {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>N/C</td>";
            } else {
                $Dados = "<td>N/C</td>";
            }
        }
    }

    if (isset($_POST['campos19'])) {
        if (isset($status[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $status[$Exibir] . "</td></tr>";
            } else {
                $Dados = "<td>N/C</td></tr>";
            }
        } else {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>N/C</td></tr>";
            } else {
                $Dados = "<td>N/C</td></tr>";
            }
        }
    }

    $Exibir++;
    //  echo $Dados .' <br><br> ';
}
//  echo '<br> completo '. $Dados . '<br>';
$Fecha_Dados = "</tr>";
if (!isset($Dados)) {
    $Dados = '<tr><td colspan="26"><b>NÃO FOI POSSIVEL ENCONTRAR A BUSCA, DADOS INEXISTENTES!</b></td></tr>';
}
$Dados_Completos = $Dados;
$Fim_Tabela = '</table>';
$Tabela_Completa = $Inicio_Tabela . $Cabesalhos .  $Fecha_Inicio . $Dados_Completos . $Fim_Tabela;

$titulo = $titulo . 'Total de Resultados Encontrados: ' . $Exibir;
$html = $titulo . $Tabela_Completa;


// echo $html;
/// FIM CODIGO VARIAVEL///
/////////////////////////////////////////////
///////////////// CODIGO FIXO ///////////////
/////////////////////////////////////////////
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
$nome = 'OrdensDeProdução';
$mpdf->Output($nome, 'I');
exit;
