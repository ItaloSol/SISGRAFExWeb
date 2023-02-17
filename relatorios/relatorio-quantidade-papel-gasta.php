<?php
include_once('../conexoes/conexao.php');
include_once('../conexoes/conn.php');
if (isset($_POST['tipopapel'])) {
    if ($_POST['tipopapel'] == 'codpapel') {
        $cod = $_POST['papelcod'];
        $Where_Tipo = " tabela_papeis.cod = '" . $cod . "' ";
    }
    if ($_POST['tipopapel'] == 'descpapel') {
        $desc = $_POST['papeldesc'];
        $Where_Tipo = " tabela_papeis.descricao LIKE '%" . $desc . "%' ";
    }
    if ($_POST['tipopapel'] == 'todostipo') {
    }
}
if (isset($_POST['orden'])) {
    if ($_POST['orden'] == 'ordcod') {
        $cod_op = $_POST['numerocod'];
        $Where_Op = " tabela_calculos_op.cod_op = '" . $cod_op . "' ";
    }
}
if (isset($_POST['periodo'])) {
    if ($_POST['periodo'] == 'papelemiss') {
        $Data_Emissao = $_POST['dateemiss'];
        $Where_Data = " tabela_ordens_producao.data_emissao = '" . $Data_Emissao . "' ";
    }
    if ($_POST['periodo'] == 'papelentrega') {
        $Data_Entrega = $_POST['dataentrega'];
        $Where_Data = " tabela_ordens_producao.data_entrega = '" . $Data_Entrega . "' ";
    }
    if ($_POST['periodo'] == 'peridoemiss') {
        $Data_Inicio = $_POST['periodoemiss'];
        $Data_Final = $_POST['fimemiss'];
        $Where_Data = " tabela_ordens_producao.data_emissao > '" . $Data_Inicio . "' AND tabela_ordens_producao.data_emissao < '" . $Data_Final . "' ";
    }
    if ($_POST['periodo'] == 'peridioentrega') {
        $Data_Inicio = $_POST['dataentegaper'];
        $Data_Final = $_POST['fimentrega'];
        $Where_Data = " tabela_ordens_producao.data_entrega > '" . $Data_Inicio . "' AND tabela_ordens_producao.data_entrega < '" . $Data_Final . "' ";
    }
}

if (isset($_POST['campos2'])) {
    if (isset($Campos)) {
        $Campos = $Campos . ' , tabela_papeis.descricao ';
    } else {
        $Campos = ' tabela_papeis.descricao ';
    }
}
if (isset($_POST['campos3'])) {
    if (isset($Campos)) {
        $Campos = $Campos . ' , tabela_papeis.cod ';
    } else {
        $Campos = ' tabela_papeis.cod  ';
    }
}
if (isset($_POST['campos4'])) {
    if (isset($Campos)) {
        $Campos = $Campos . ' , unitario ';
    } else {
        $Campos = ' unitario ';
    }
}
if (isset($_POST['campos5'])) {
    if (isset($Campos)) {
        $Campos = $Campos . ' , gramatura ';
    } else {
        $Campos = ' gramatura ';
    }
}
if (isset($_POST['order'])) {
    if ($_POST['order'] != 'semordem') {
        $OrderBy = $_POST['order'];
    }
}
$todos = false;
if (!isset($Campos)) {
    $Campos = ' tabela_papeis.descricao  , tabela_papeis.cod , unitario , gramatura';
    $todos = true;
}

$Query_Slect = "SELECT ";
if (isset($Campos)) {
    $Query_Slect = $Query_Slect . $Campos;
}
$Query_Inner = " FROM tabela_papeis 
    INNER JOIN tabela_calculos_op ON tabela_calculos_op.cod_papel = tabela_papeis.cod 
    INNER JOIN tabela_ordens_producao ON tabela_calculos_op.cod_op = tabela_ordens_producao.cod ";

if (isset($Where_Tipo)) {
    $Query_Where = " WHERE " . $Where_Tipo;
}
if (isset($Where_Op)) {
    if (isset($Query_Where)) {
        $Query_Where = $Query_Where . ' AND ' . $Where_Op;
    } else {
        $Query_Where = " WHERE " . $Where_Op;
    }
}
if (isset($Where_Data)) {
    if (isset($Query_Where)) {
        $Query_Where = $Query_Where . ' AND ' .  $Where_Data;
    } else {
        $Query_Where = " WHERE " . $Where_Data;
    }
}
$Query_Completa = $Query_Slect . $Query_Inner;
if (isset($Query_Where)) {
    $Query_Completa = $Query_Slect . $Query_Inner . $Query_Where;
}
if (isset($OrderBy)) {
    $Query_Completa = $Query_Completa . $OrderBy;
}

//echo $Query_Completa . '<br>';
$Query_Consumo_Papeis = $conexao->prepare("$Query_Completa");
$Query_Consumo_Papeis->execute();
$i = 0;

while ($linha = $Query_Consumo_Papeis->fetch(PDO::FETCH_ASSOC)) {

    if (isset($_POST['campos2'])) {
        $Descricao_ = $linha['descricao'];
        $Descricao[$i] = $Descricao_;
    }
    if (isset($_POST['campos3'])) {
        $cod_ = $linha['cod'];
        $cod[$i] = $cod_;
    }
    if (isset($_POST['campos1'])) {
        $query_PRODUTOS = $conexao->prepare("SELECT qtd_folhas_total FROM tabela_calculos_op 
        WHERE cod_papel = '$cod_'");
        $query_PRODUTOS->execute();

        while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {

            if (isset($total)) {
                $total = $total + $linha2['qtd_folhas_total'];
            } else {
                $total = $linha2['qtd_folhas_total'];
            }
            $Qtd_ = $total;
            $Qtd[$i] = $Qtd_;
        }
    }
    if (isset($_POST['campos4'])) {
        $preco_ = $linha['unitario'];
        $preco[$i] = $preco_;
    }
    if (isset($_POST['campos5'])) {
        $gramatura_ = $linha['gramatura'];
        $gramatura[$i] = $gramatura_;
    }

    if ($todos == true) {
        $Descricao_ = $linha['descricao'];
        $Descricao[$i] = $Descricao_;
        $cod_ = $linha['cod'];
        $cod[$i] = $cod_;
        $query_PRODUTOS = $conexao->prepare("SELECT qtd_folhas_total FROM tabela_calculos_op  WHERE cod_papel = '$cod_'");
        $query_PRODUTOS->execute();

        while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {

            if (isset($total)) {
                $total = $total + $linha2['qtd_folhas_total'];
            } else {
                $total = $linha2['qtd_folhas_total'];
            }
            $Qtd_ = $total;
            $Qtd[$i] = $Qtd_;
        }

        $preco_ = $linha['unitario'];
        $preco[$i] = $preco_;
        $gramatura_ = $linha['gramatura'];
        $gramatura[$i] = $gramatura_;
    }
    $i++;
}

date_default_timezone_set('America/Sao_Paulo');
$data_hora   = date('d/m/Y H:i:s ', time());
$data_horaa = (string) $data_hora;
$titulo = "<h5>RELATÓRIO DE CONSUMO DE PAPÉIS - SISGRAFEX</h5><br>";
$Inicio_Tabela = "<table style=' solid black; width: 100%;  border-collapse:collapse; font-size: 10; 
    text-align: center;
    color: black;' border='1' class='table'>
    <tr>";
if (isset($_POST['campos3'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>CÓDIGO PAPEL</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>CÓDIGO PAPEL</th>";
    }
}
if (isset($_POST['campos2'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>DESCRIÇÃO</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>DESCRIÇÃO</th>";
    }
}
if (isset($_POST['campos5'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>GRAMATURA</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>GRAMATURA</th>";
    }
}
if (isset($_POST['campos1'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>QUANTIDADE GASTA</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>QUANTIDADE GASTA</th>";
    }
}
if (isset($_POST['campos4'])) {
    if (isset($Cabesalhos)) {
        $Cabesalhos = $Cabesalhos . "<th style=' color:Black'>PREÇO UNITÁRIO</th>";
    } else {
        $Cabesalhos = "<th style=' color:Black'>PREÇO UNITÁRIO</th>";
    }
}
if (!isset($Cabesalhos)) {
    $Cabesalhos = "<th style=' color:Black'>CÓDIGO PAPEL</th> <th style=' color:Black'>DESCRIÇÃO</th> 
    <th style=' color:Black'>GRAMATURA</th> <th style=' color:Black'>QUANTIDADE GASTA</th> <th style=' color:Black'>PREÇO UNITÁRIO</th> ";
}
$Fecha_Inicio = "</tr>";
//
$Exibir = $i;
$i = 0;
while ($Exibir > $i) {

    if (isset($_POST['campos3'])) {
        if (isset($Dados)) {
            $Dados = $Dados . "<tr><td>" . $cod[$i] . "</td>";
        } else {
            $Dados = "<tr><td>" . $cod[$i] . "</td>";
        }
    }

    if (isset($_POST['campos2'])) {
        if (isset($Dados)) {
            $Dados = $Dados . "<td>" . $Descricao[$i] . "</td>";
        } else {
            $Dados = "<td>" . $Descricao[$i] . "</td>";
        }
    }
    if (isset($_POST['campos5'])) {
        if (isset($Dados)) {
            $Dados = $Dados . "<td>" . $gramatura[$i] . "</td>";
        } else {
            $Dados = "<td>" . $gramatura[$i] . "</td>";
        }
    }
    if (isset($_POST['campos1'])) {
        if (isset($Dados)) {
            $Dados = $Dados . "<td>" . $Qtd[$i] . "</td>";
        } else {
            $Dados = "<td>" . $Qtd[$i] . "</td>";
        }
    }
    if (isset($_POST['campos4'])) {
        if (isset($Dados)) {
            $Dados = $Dados . "<td>" . $preco[$i] . "</td></tr>";
        } else {
            $Dados = "<td>" . $preco[$i] . "</td></tr>";
        }
    }


    $i++;
}

if (!isset($Dados)) {
    $Dados = '<tr><td colspan="5"><b>NÃO FOI POSSIVEL ENCONTRAR A BUSCA, DADOS INEXISTENTES!</b></td></tr>';
}

$Fim_Tabela = '</table>';
$Tabela_Completa = $Inicio_Tabela . $Cabesalhos .  $Fecha_Inicio . $Dados . $Fim_Tabela;


$html = $titulo . $Tabela_Completa;


//echo $html;
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
} else {
    if ($_POST['orientacao'] == 'retrato') {
        // Write some HTML code:
        $mpdf = new mPDF('C', 'A4');
    }
}

$mpdf->SetDisplayMode('fullpage');

$mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first 
//level of a list

// LOAD a stylesheet

$mpdf->WriteHTML($html, 2);
$nome = 'RELATORIO_DE_CONSUMO_DE_PAPEIS.pdf';
$mpdf->Output($nome, 'I');
exit;
