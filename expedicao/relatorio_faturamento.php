<?php
session_start();
include_once('../conexoes/conexao.php');
include_once('../conexoes/conn.php');
$cod_emissor_relatorio = $_SESSION['usuario'][2];
$nome_emissor_relatorio = $_SESSION['usuario'][0];
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
if (isset($_GET['cod'])) {
  $cod = $_GET['cod'];
  $papels = 0;
  $servicos = 0;
  $tipo_papel_qtd_loop = 0;
  $qtd_acabamentos = 0;
  $query_faturamento = $conexao->prepare("SELECT * FROM faturamentos WHERE CODIGO = $cod ");
  $query_faturamento->execute();
  if ($linha = $query_faturamento->fetch(PDO::FETCH_ASSOC)) {
    $CODIGO_ORC = $linha['CODIGO_ORC'];
    $codigo_op = $linha['CODIGO_OP'];
    $EMISSOR = $linha['EMISSOR'];
    $QTD_ENTREGUE = $linha['QTD_ENTREGUE'];
    $VLR_FAT = $linha['VLR_FAT'];
    $DT_FAT = $linha['DT_FAT'];
    $FRETE_FAT = $linha['FRETE_FAT'];
    $SERVICOS_FAT = $linha['SERVICOS_FAT'];
    $OBSERVACOES = $linha['OBSERVACOES'];
    if ($OBSERVACOES == '') {
      $OBSERVACOES = 'SEM OBSERVAÇÕES';
    }
  }
  $query_frete = $conexao->prepare("SELECT * FROM tabela_notas_transporte WHERE cod_nota = $cod ");
  $query_frete->execute();
  if ($linhaF = $query_frete->fetch(PDO::FETCH_ASSOC)) {
    $modalidade_frete = $linhaF['modalidade_frete'];
    $nome_transportador = $linhaF['nome_transportador'];
    $espessura_produto = $linhaF['espessura_produto'];
    $peso_produto = $linhaF['peso_produto'];
  }
  $query_op = $conexao->prepare("SELECT * FROM tabela_ordens_producao WHERE cod = $codigo_op ");
  $query_op->execute();
  if ($linha = $query_op->fetch(PDO::FETCH_ASSOC)) {
    $codigo_orc = $linha['orcamento_base'];

    $tipo_produto = $linha['tipo_produto'];
    $cod_produto = $linha['cod_produto'];
    $data_prevista = $linha['data_entrega'];

    $tipo_cliente = $linha['tipo_cliente'];
    $cod_cliente = $linha['cod_cliente'];
    $cod_emissor = $linha['cod_emissor'];
    $obs_prod = $linha['descricao'];

    $data_1a_prova = $linha['data_1a_prova'];
    $data_2a_prova = $linha['data_2a_prova'];
    $data_3a_prova = $linha['data_3a_prova'];
    $data_4a_prova = $linha['data_4a_prova'];
    $data_5a_prova = $linha['data_5a_prova'];

    $data_prova = $linha['DT_ENTG_PROVA'];

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

      $query_orid_orc = $conexao->prepare("SELECT * FROM tabela_produtos_orcamento WHERE tipo_produto = $tipo_produto AND cod_produto = $cod_produtos AND cod_orcamento = $codigo_orc");
      $query_orid_orc->execute();

      if ($linha14 = $query_orid_orc->fetch(PDO::FETCH_ASSOC)) {
        $quantidade = $linha14['quantidade'];

        $preco_unitario = $linha14['preco_unitario'];
        $total = $quantidade * $preco_unitario;
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

        $Do_Papel_cod[$tipo_papel_qtd_loop] = $cod_papels;
        $Do_Papel_descricao_do_papel[$tipo_papel_qtd_loop] = $descricao_do_papel;
        $Do_Papel_midida[$tipo_papel_qtd_loop] = $medida;
        $Do_Papel_gramatura[$tipo_papel_qtd_loop] = $gramatura;
        $Do_Papel_formato[$tipo_papel_qtd_loop] = $formato;
        $Do_Papel_uma_face[$tipo_papel_qtd_loop] = $uma_face;
        $Do_Papel_unitario[$tipo_papel_qtd_loop] = $unitario;
        $tipo_papel_qtd_loop++;
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
    $cliente_info = $conexao->prepare("SELECT * FROM tabela_orcamentos WHERE cod = '$codigo_orc' ");
    $cliente_info->execute();
    if ($linha32 = $cliente_info->fetch(PDO::FETCH_ASSOC)) {
      $cod_contato = $linha32['cod_contato'];
      $cod_endereco = $linha32['cod_endereco'];
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
        $cpf = $linha7['cpf'];
      }
    }
    if ($tipo_cliente == '2') {
      $cliente = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos WHERE cod = $cod_cliente ");
      $cliente->execute();
      if ($linha7 = $cliente->fetch(PDO::FETCH_ASSOC)) {
        $nome_cliente = $linha7['nome'];
        $nome_fantasia = $linha7['nome_fantasia'];
        $cpf = $linha7['cnpj'];
      }
    }

    // $associacao_endereco_cliente = $conexao->prepare("SELECT * FROM tabela_associacao_enderecos WHERE cod_cliente = $cod_cliente AND tipo_cliente = $tipo_cliente ");
    // $associacao_endereco_cliente->execute();
    // if ($linha8 = $associacao_endereco_cliente->fetch(PDO::FETCH_ASSOC)) {
    //   $cod_endereco = $linha8['cod_endereco'];
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
    // }
    // $associacao_contato = $conexao->prepare("SELECT * FROM tabela_associacao_contatos WHERE cod_cliente = $cod_cliente AND tipo_cliente = $tipo_cliente ");
    // $associacao_contato->execute();
    // if ($linha9 = $associacao_contato->fetch(PDO::FETCH_ASSOC)) {
    //   $cod_contato = $linha9['cod_contato'];
    $endereco_cliente = $conexao->prepare("SELECT * FROM tabela_contatos WHERE cod = $cod_contato ");
    $endereco_cliente->execute();
    if ($linha11 = $endereco_cliente->fetch(PDO::FETCH_ASSOC)) {
      $nome_contato = $linha11['nome_contato'];
      $email = $linha11['email'];
      $telefone = $linha11['telefone'];
    }
    // }
  }

  $parte1 = ' 
    <table border="1" style="  border-collapse: collapse;">
      <tr style="width: 100%;" >
        <td style=" width: 100%;  height: 30px";>ORCAMENTO BASE: ' . $CODIGO_ORC . '<br>
          EMISSOR: ' . $cod_emissor_relatorio . '<br>
          EMISSÃO: ' . $data . '<br></td>
        <td style="text-align: center;  width: 100%;  height: 30px;" colspan="2"><b>ORDEM DE PRODUÇÃO nº ' . $codigo_op . '<br>
          RECIBO DE ENTREGA nº ' . $cod . '
          </b></td>
          
          <td style="text-align: center; width: 100%;  height: 30px;"><b>DATA PROVÁVEL DE
            ENTREGA:
            ' . date('d/m/Y', strtotime($data_prevista)) . '<br>
            <hr>
            DATA DE ENTREGA DA
            PROVA: ' . date('d/m/Y', strtotime($data_prova)) . '</b></td>
      </tr>
    </table><br>
    <table border="1" style="width: 100%;   border-collapse: collapse;" >
      <tr style=" background-color: #d4d4d4;">
        <th colspan="4">DESTINATÁRIO</th>
      </tr>
      <tr ><td  >
        NOME/RAZÃO SOCIAL - CÓDIGO <br>
 ' . $nome_cliente . ' (' . $nome_fantasia . ') - ' . $cod_cliente . '
      </td>
    <td colspan="3">
      CNPJ/CPF<br>
  ' . $cpf . '
    </td></tr>
    <tr >
      <td  >
        LOGADOURO <br>
' . $logadouro . '

      </td>
      <td >
        BAIRRO <br>
' . $bairro . '

      </td>
      <td >
        CIDADE <br>
' . $cidade . '

      </td>
      <td >
        CEP<br>
' . $cep . '

      </td>
    </tr>
    <tr>
      <td >
        UF<br>
' . $uf . '

      </td>
      <td >
        FONE/FAX <br>
' . $telefone . '

      </td>
      <td colspan="2">
        CONTATO <br>
' . $nome_contato . '
      </td>
    </tr>
    </table><br>
    VENDEDOR: ' . $nome_atendente . ' - ' . $cod_emissor . '<br>
    
    <table  style="width: 100%;  border-collapse: collapse;">
      <tr>
        <td style="text-align: center;  background-color: #d4d4d4;"><b>' . $DESCRICAO . '</b></td>
      </tr>
    </table>
    QUANTIDADE: ' . $quantidade . ' FORMATO: ' . $largura . ' X ' . $ALTURA . ' <br> &nbsp;
    <table border="1" style="width: 100%;  border-collapse: collapse;">
      <tr>
        <td style="text-align: center;  background-color: #d4d4d4;"><b style="font-size: 12px">TIPO PRODUTO: FOLHA</b></td>
      </tr>
    </table>
   <b>PAPÉIS</b> 
    <table border="1" style="width: 100%;  border-collapse: collapse;">
      <tr>
        <td>
          DESCRIÇÃO DO PAPEL: <br>
' . $Papel_descricao[0] . '

        </td>
        <td>
          GRAMATURA: ' . $Do_Papel_gramatura[0] . ' <br>
        </td>
        <td>
          <b style="font-size: 13px">TIPO PAPEL: ' . $Papel_tipo_papel[0] . '</b>
        </td>
      </tr>
      <tr>
        <td colspan="2">
        <b style="font-size: 13px">GASTO DE FOLHAS: ' . $Calculo_qtd_folhas_total[0] . ' </td>
        <td> 
        <b style="font-size: 13px">CORES FRENTE: ' . $Papel_cor_frente[0] . '

        </td>
      </tr>
      <tr>
        <td colspan="2">
        <b style="font-size: 13px"> FORMATO DE IMPRESSÃO: ' . $Calculo_formato[0] . ' 
        </td>
        <td>
        <b style="font-size: 13px">CORES VERSO: ' . $Papel_cor_verso[0] . ' </b>

        </td>
       
      </tr>
      <tr>
        
          <td colspan="3">
          <b style="font-size: 13px"> PERDA: ' . $Calculo_perca[0] . '%
          </td>
      
      </tr>
    </table><br>
   <b> CHAPAS</b> 
    <table border="1" style="width: 100%;  border-collapse: collapse;">
     ';
  $papeis1 = 0;
  $parte2 = '';
  while ($papeis1 < $papels) {
    $parte2 = $parte2 . "<tr>
             <td>CÓDIGO PAPEL: " . $Do_Papel_cod[$papeis1] . "</td>
             <td style='text-align: center;'>NENHUMA SELECIONADA</td>
         </tr>";
    $papeis1++;
  }
  $parte3 = '</table><BR>
     <b> ACABAMENTO DA LÂMINA</b> 
      <table border="1" style="width: 100%;  border-collapse: collapse;">';
  $percorrer = 0;
  $anterior[0] = 'teste';
  $parte4 = '';
  while ($qtd_acabamentos > $percorrer) {
    if (!in_array($Do_Acabamento_cod[$percorrer], $anterior)) {
      $parte4 = $parte4 . " <tr>
          <td>CÓDIGO: $Do_Acabamento_cod[$percorrer] </td>
          <td>DESCRIÇÃO: $Do_Acabamento_Maquina[$percorrer] </td>
        </tr> ";
      $anterior[$percorrer] = $Do_Acabamento_cod[$percorrer];
    }
    $percorrer++;
  }
  $parte5 = '</table><BR>
       <b style=" background-color: #d4d4d4;" > SERVIÇOS DO ORÇAMENTO</b> 
        <table border="1" style="width: 100%;  border-collapse: collapse;">' .
    $parte10 = '';
  if ($Servico_N != 'NENHUM SELECIONADO') {
    for ($i = 0; $i < $servicos; $i++) {
      $parte10 .=  '<tr><td>CÓDIGO:' . $Do_servico_cod[$i] . '</td> <td> DESCRIÇÃO: ' . $Do_servico_descricao[$i] . '</td></tr>';
    }
  } else {
    $parte10 = '<tr><td style="text-align: center;">NENHUM SELECIONADO</td></tr>';
  }
  $parte9 = '         
        </table><br>
      <b style=" background-color: #d4d4d4;" >  OBSERVAÇÕES DA ORDEM DE PRODUÇÃO</b> 
        
          <table border="1" style="width: 100%;  border-collapse: collapse;">
          <tr>
            <td style="text-align: center;">
              ' . $obs_prod . '
            </td>
          </tr>
          </table><br><br>
        <b style=" background-color: #d4d4d4;">  HISTÓRICO DE RECIBOS DE ENTREGA</b> 
          <table border="1" style="width: 100%;  border-collapse: collapse;">
          <tr>
            <td>CÓDIGO DO
              RECIBO<br>
              ' . $cod . '
              </td>
              <td>
                DATA DE ENTREGA<br>
              ' . date('d/m/Y', strtotime($DT_FAT)) . '
              
              </td>
              <td>
                QUANTIDADE
              ENTREGUE <br>
              ' . $QTD_ENTREGUE . '
             
              </td>
              <td>
                VALOR FRETE <br>
                R$ 0,00
               
              </td>
              <td>
                VALOR SERVIÇOS <br>
                R$ 0,00
                
              </td>
              <td style=" background-color: #d4d4d4;">
                VALOR FATURADO <br>
                R$ ' . $VLR_FAT . '
              </td>
          </tr>
          <tr>
            <td colspan="6">
              OBSERVAÇÕES <br>
              ' . $OBSERVACOES . '
            </td>
          </tr>
          </table>&nbsp;<br><br><br>
         <b style=" background-color: #d4d4d4;"> TOTAL</b>
          <table border="1" style="width: 100%;  border-collapse: collapse;">
          <tr>
            <td>CÓDIGO DO
              RECIBO<br>
              ' . $cod . '
              </td>
              <td>
                DATA DE ENTREGA<br>
              ' . date('d/m/Y', strtotime($DT_FAT)) . '
              
              </td>
              <td>
                QUANTIDADE
              ENTREGUE <br>
              ' . $QTD_ENTREGUE . '
             
              </td>
              <td>
                VALOR FRETE <br>
                R$ 0,00
               
              </td>
              <td>
                VALOR SERVIÇOS <br>
                R$ 0,00
                
              </td>
              <td style=" background-color: #d4d4d4;">
                VALOR FATURADO <br>
                R$ ' . $VLR_FAT . '
              </td>
          </tr>
          </table><br>
         <b style=" background-color: #d4d4d4; "> TRANSPORTADOR/VOLUMES TRANSPORTADOS</b>
          <table border="1" style="width: 100%;  border-collapse: collapse;">
          <tr>
            <td colspan="2">
              RAZÃO SOCIAL<br>
              ' . $nome_transportador . '
              
            </td>
            <td>
              MODALIDADE<br>
              ' . $modalidade_frete . '
             
            </td>
            <td>
              PESO PRODUTO <br>
            ' . $peso_produto . '
             
            </td>
            
          </tr>
          <tr>
            <td colspan="4">
              RELAÇÃO DE VOLUMES
              
            </td>
          </tr>
          <tr>
            <td>
              NÚMERO  </td> <td>ALTURA </td>  <td>LARGURA  </td> <td>PESO </td>
             
           
          </tr>
          <tr>
            <td colspan="4" style="text-align: center;">
              NENHUM REGISTRADO
            </td>
          </tr>
          </table><br>
          <div style="text-align: center;">
          Quartel em Brasília-DF, '.$data.' '.$hora.'<BR><br>
_________________________________________<br>
'.$nome_emissor_relatorio.'<br>
GRÁFICA DO EXÉRCITO - DIVISÃO COMERCIAL<br><br>
_________________________________________<br>
NOME: ______________ DOCUMENTO: ______________ EMISSOR: ________<br>'.$nome_cliente.' - 
'.$nome_fantasia.'<br>
</div>';
}
?> </div>
</body>

</html>
<?php
$html = $parte1 . $parte2 . $parte3 . $parte4 . $parte5 . $parte10 . $parte9;
 echo $html;
// require_once __DIR__ . '../../vendor/autoload.php';
// // Create an instance of the class:
// $mpdf = new \mPDF();

// if ($_POST['orientacao']) {
//   if ($_POST['orientacao'] == 'retrato') {
//     // Write some HTML code:
//     $mpdf = new mPDF('C', 'A4');
//   }
// }
// if ($_POST['orientacao']) {
//   if ($_POST['orientacao'] == 'paisagem') {
//     // Write some HTML code:
//     $mpdf = new mPDF('C', 'A4-L');
//   }
// }


// $mpdf->SetDisplayMode('fullpage');

// $mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first 
// //level of a list

// // LOAD a stylesheet

// $mpdf->WriteHTML($html, 2);
// $nome = 'faturamento' . $cod;
// $mpdf->Output($nome, 'I');
// exit;
