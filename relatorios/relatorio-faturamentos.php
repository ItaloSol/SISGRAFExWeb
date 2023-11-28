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
        $Cliente = ' nome';
        $Qtd_Cliente++;
    }
    if ($_POST['cliente'] == 'todos') {
        $Cliente = null;
        $Qtd_Cliente++;
    }

    if ($Cliente == 'nome') {
        if ($Tipo_Cliente == '1') {
            $Nome_Clientes = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos WHERE nome LIKE '%$Nome_Cliente%' ");
        }
        if ($Tipo_Cliente == '2') {
            $Nome_Clientes = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos WHERE nome LIKE '%$Nome_Cliente%' ");
        }
        $Nome_Clientes->execute();
        $i = 0;
        if ($linha = $Nome_Clientes->fetch(PDO::FETCH_ASSOC)) {
            $Cod_Cliente_Buscado = $linha['cod'];
        }
        $Cliente = ' tipo_cliente = "' . $Tipo_Cliente . '" AND cod_cliente = "' . $Cod_Cliente_Buscado . '" ';
        $Qtd_Cliente++;
    }
    $Qtd_Ultima = $Qtd_Cliente - 1;
    if ($Cliente != null) {
        if ($Qtd_Cliente > 1) {
            if ($Qtd_Cliente == $Qtd_Ultima) {
                $Query_Cliente = $Cliente;
            } else {
                $Query_Cliente = $Cliente . ' AND ';
            }
        } else {
            $Query_Cliente = $Cliente;
        }
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
        $Query_OpOrc = $OpOrc;
    }
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
        $Query_Periodo = $Periodo;
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
  
    if (isset($Periodo)) {
        $Query_Periodo = $Periodo;
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

if (isset($_POST['campos6'])) {
    if (isset($Campos)) {
        $Campos = $Campos . $_POST['campos6'] . ' , ';
    } else {
        $Campos = $_POST['campos6'];
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
    $Query_Campos = $Campos;
}
if ($Produto != null) {
    $Query_Produto = $Produto;
}
if (isset($Emissor)) {
    $Query_Emissor = $Emissor;
}





$Query_Select = "SELECT ";



if (isset($Inner)) {
    if ($Inner == '1') {
        $Query_Inner =  ' INNER JOIN tabela_produtos_orcamento ON tabela_ordens_producao.cod_produto = tabela_produtos_orcamento.cod ';
    }
}
if (isset($Query_Campos)) {
    $Query_Campos_Completa = $Query_Campos . " , orcamento_base, STS_DESCRICAO FROM tabela_ordens_producao  INNER JOIN sts_op s ON s.CODIGO = tabela_ordens_producao.status ";
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
    isset($Query_OpOrc) || isset($Query_Produto) || isset($Query_Emissor) || isset($Query_Periodo) ||
    isset($Query_Status)
) {
    $Query_Busca_Completa = $Query_Inicio . ' WHERE ';
} else {
    $Query_Busca_Completa = $Query_Inicio;
}
if (isset($Query_Cliente)) {
    $Query_Busca_Completa = $Query_Busca_Completa  . $Query_Cliente;
}
if (isset($Query_Status)) {
    if (isset($Query_Cliente)) {
        $Query_Busca_Completa = $Query_Busca_Completa  .' AND '. $Query_Status;
    }else{
        $Query_Busca_Completa = $Query_Busca_Completa  . $Query_Status;
    }
    
}
if (isset($Query_OpOrc)) {
    if (

        isset($Query_Status)
    ) {
        $Query_Busca_Completa = $Query_Busca_Completa . ' AND ';
    }
    $Query_Busca_Completa = $Query_Busca_Completa  . $Query_OpOrc;
}

if (isset($Query_Produto)) {
    if (
        isset($Query_OpOrc) ||
        isset($Query_Status)
    ) {
        $Query_Busca_Completa = $Query_Busca_Completa . ' AND ';
    }
    $Query_Busca_Completa = $Query_Busca_Completa  . $Query_Produto;
}

if (isset($Query_Emissor)) {
    if (
        isset($Query_OpOrc) || isset($Query_Produto) ||
        isset($Query_Status)
    ) {
        $Query_Busca_Completa = $Query_Busca_Completa . ' AND ';
    }
    $Query_Busca_Completa = $Query_Busca_Completa  . $Query_Emissor;
}

if (isset($Query_Periodo)) {
    if (
        isset($Query_OpOrc) || isset($Query_Produto) || isset($Query_Emissor) ||
        isset($Query_Status)
    ) {
        $Query_Busca_Completa = $Query_Busca_Completa . '  ';
    }
    $Query_Busca_Completa = $Query_Busca_Completa . $Query_Periodo;
}



if (isset($OrderBy)) {
    $Query_Busca_Completa = $Query_Busca_Completa . $OrderBy . ' ';
} else {
    $Query_Busca_Completa = $Query_Busca_Completa . ' ';
}
//
 echo $Query_Busca_Completa . '<br>';
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
    if (isset($_POST['campos3'])) {
        $cod_cliente_  = $linha['cod_cliente'];
        $cod_cliente[$Recebe] = $cod_cliente_;
    }
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


$Fecha_Inicio = " </tr>";
$Exibir = 0;
$Abre_Dados = "";
while ($Exibir < $Recebe) {
   
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


 echo $html;
/// FIM CODIGO VARIAVEL///
/////////////////////////////////////////////
///////////////// CODIGO FIXO ///////////////
/////////////////////////////////////////////
//  require_once __DIR__ . '../../vendor/autoload.php';
// // Create an instance of the class:
// $mpdf = new \mPDF();

// if ($_POST['orientacao']) {
//     if ($_POST['orientacao'] == 'retrato') {
//         // Write some HTML code:
//         $mpdf = new mPDF('C', 'A4');
//     }
// }
// if ($_POST['orientacao']) {
//     if ($_POST['orientacao'] == 'paisagem') {
//         // Write some HTML code:
//         $mpdf = new mPDF('C', 'A4-L');
//     }
// }


// $mpdf->SetDisplayMode('fullpage');

// $mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first 
// //level of a list

// // LOAD a stylesheet

// $mpdf->WriteHTML($html, 2);
// $nome = 'Faturamentos';
// $mpdf->Output($nome, 'I');
// exit;
