<?php
session_start();
include_once('../conexoes/conexao.php');
include_once('../conexoes/conn.php');

$faturamentos11 = 0;
$query_faturamento_anteriores = $conexao->prepare("SELECT * FROM faturamentos ");
$query_faturamento_anteriores->execute();
while ($linha = $query_faturamento_anteriores->fetch(PDO::FETCH_ASSOC)) {
    $FATURAMENTOS[$faturamentos11] = [
        'CODIGO' => $linha['CODIGO'],
        'CODIGO_ORC' => $linha['CODIGO_ORC'],
        'codigo_op' => $linha['CODIGO_OP'],
        'EMISSOR' => $linha['EMISSOR'],
        'QTD_ENTREGUE' => $linha['QTD_ENTREGUE'],
        'VLR_FAT' => $linha['VLR_FAT'],
        'DT_FAT' => $linha['DT_FAT'],
        'FRETE_FAT' => $linha['FRETE_FAT'],
        'SERVICOS_FAT' => $linha['SERVICOS_FAT'],
    ];
    $cod = $linha['CODIGO'];
    $codigo_op = $linha['CODIGO_OP'];
    $query_frete = $conexao->prepare("SELECT * FROM tabela_notas_transporte WHERE cod_nota = $cod ");
    $query_frete->execute();
    if ($linhaF = $query_frete->fetch(PDO::FETCH_ASSOC)) {
        $modalidade_frete[$faturamentos11] = $linhaF['modalidade_frete'];
        $nome_transportador[$faturamentos11] = $linhaF['nome_transportador'];
    }
    $query_op = $conexao->prepare("SELECT * FROM tabela_ordens_producao WHERE cod = $codigo_op ");
    $query_op->execute();
    if ($linhaX = $query_op->fetch(PDO::FETCH_ASSOC)) {
        $codigo_orc = $linhaX['orcamento_base'];
        $tipo_produto = $linhaX['tipo_produto'];
        $cod_produto = $linhaX['cod_produto'];
        $tipo_cliente = $linhaX['tipo_cliente'];
        $tipo_cliente1[$faturamentos11] = $linhaX['tipo_cliente'];
        $cod_cliente = $linhaX['cod_cliente'];
        $cod_cliente1[$faturamentos11] = $linhaX['cod_cliente'];
        if ($tipo_produto == '1') {
            $query_produto = $conexao->prepare("SELECT * FROM produtos WHERE CODIGO = $cod_produto ");
        }
        if ($tipo_produto == '2') {
            $query_produto = $conexao->prepare("SELECT * FROM produtos_pr_ent WHERE CODIGO = $cod_produto ");
        }
        $query_produto->execute();
        if ($linha2 = $query_produto->fetch(PDO::FETCH_ASSOC)) {
            $DESCRICAO[$faturamentos11] = $linha2['DESCRICAO'];
        }
        if ($tipo_cliente == '1') {
            $cliente = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos WHERE cod = $cod_cliente ");
            $cliente->execute();
            if ($linha7 = $cliente->fetch(PDO::FETCH_ASSOC)) {
                $nome_cliente[$faturamentos11] = $linha7['nome'];
            }
        }
        if ($tipo_cliente == '2') {
            $cliente = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos WHERE cod = $cod_cliente ");
            $cliente->execute();
            if ($linha7 = $cliente->fetch(PDO::FETCH_ASSOC)) {
                $nome_cliente[$faturamentos11] = $linha7['nome'];
            }
        }
    }
    $faturamentos11++;
}
date_default_timezone_set('America/Sao_Paulo');
$data_hora   = date('d/m/Y H:i:s ', time());
$data_horaa = (string) $data_hora;
$titulo = "<h5>RELATÓRIO DE FATURAMENTOS - DATA E HORA DE EMISSÃO: " . $data_horaa . " - SISGRAFEX</h5><br><h1 style='text-align: center;>RELATÓRIO DE FATURAMENTOS</h1>";
$Inicio_Tabela = "<table style=' solid black; width: 100%;  border-collapse:collapse; font-size: 10; 
        text-align: center;
        color: black;' border='1' class='table'>
        <tr>";
if (isset($_POST['campos1'])) {
    $Cabesalhos = "<th style=' color:Black'>CÓDIGO</th>";
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
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>CÓDIGO ORÇAMENTO</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>CÓDIGO ORÇAMENTO</th>";
    }
}
if (isset($_POST['campos4'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>EMISSOR</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>EMISSOR</th>";
    }
}
if (isset($_POST['campos5'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>CÓDIGO CLIENTE</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>CÓDIGO CLIENTE</th>";
    }
}
if (isset($_POST['campos6'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>NOME CLIENTE</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>NOME CLIENTE</th>";
    }
}
if (isset($_POST['campos7'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>TIPO PESSOA</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>TIPO PESSOA</th>";
    }
}
if (isset($_POST['campos8'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>QUANTIDADE ENTREGUE</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>QUANTIDADE ENTREGUE</th>";
    }
}
if (isset($_POST['campos9'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>VALOR</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>VALOR</th>";
    }
}
if (isset($_POST['campos10'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>DATA</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>DATA</th>";
    }
}
if (isset($_POST['campos11'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>NOME TRANPORTADOR</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>NOME TRANPORTADOR</th>";
    }
}
if (isset($_POST['campos12'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>MODALIDADE DO FRETE</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>MODALIDADE DO FRETE</th>";
    }
}
if (isset($_POST['campos13'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>PRODUTO</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>PRODUTO</th>";
    }
}


$Fecha_Inicio = " </tr>";
$Exibir = 0;
$Abre_Dados = "";
while ($Exibir < $Recebe) {

    if (isset($_POST['campos1'])) {
        if (isset($FATURAMENTOS[$Exibir]['CODIGO'])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $FATURAMENTOS[$Exibir]['CODIGO'] . "</td>";
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
    
    if (isset($_POST['campos2'])) {
        if (isset($FATURAMENTOS[$Exibir]['CODIGO_OP'])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $FATURAMENTOS[$Exibir]['CODIGO_OP'] . "</td>";
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
        if (isset($FATURAMENTOS[$Exibir]['CODIGO_ORC'])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $FATURAMENTOS[$Exibir]['CODIGO_ORC'] . "</td>";
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
        if (isset($FATURAMENTOS[$Exibir]['EMISSOR'])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $FATURAMENTOS[$Exibir]['EMISSOR'] . "</td>";
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
        if (isset($cod_cliente1[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $cod_cliente1[$Exibir] . "</td>";
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
        if (isset($nome_cliente[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $nome_cliente[$Exibir] . "</td>";
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
        if (isset($tipo_cliente1[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $tipo_cliente1[$Exibir] . "</td>";
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
        if (isset($FATURAMENTOS[$Exibir]['QTD_ENTREGUE'])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $FATURAMENTOS[$Exibir]['QTD_ENTREGUE'] . "</td>";
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
        if (isset($FATURAMENTOS[$Exibir]['VLR_FAT'])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $FATURAMENTOS[$Exibir]['VLR_FAT'] . "</td>";
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
        if (isset($FATURAMENTOS[$Exibir]['DT_FAT'])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $FATURAMENTOS[$Exibir]['DT_FAT'] . "</td>";
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
        if (isset($nome_transportador[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $nome_transportador[$Exibir] . "</td>";
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
        if (isset($modalidade_frete[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $modalidade_frete[$Exibir] . "</td>";
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
        if (isset($DESCRICAO[$Exibir])) {
            if (isset($Dados)) {
                $Dados = $Dados . "<td>" . $DESCRICAO[$Exibir] . "</td>";
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
