<?php /* |||   */ include_once("../html/navbar.php"); ?>

<?php /* |||   */ include_once("../html/../html/navbar.php");
date_default_timezone_set('America/Sao_Paulo');
$hoje = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$ano = date('Y');
if (isset($_SESSION['msg'])) {
  echo $_SESSION['msg'];
  unset($_SESSION['msg']);
}
?>
<div class=" nota-- "></div>
<?php /* |||   */ if (isset($_GET['tp']) && !isset($_GET['id'])) {

  if ($_GET['tp'] == 1) {
    echo '<small class="text-light fw-semibold d-block">Selecione um Menu:</small><div class=" form-check form-check-inline mt-3">
    <a href="tl-cadastro-notas.php?tp=1">
     <b> <label class="btn btn-outline-primary form-check-label active" for="FISICO">FÍSICO</label></></b>
    </div>
    <div class=" form-check form-check-inline mt-3">
      <a href="tl-cadastro-notas.php?tp=2">
      <label class="btn btn-outline-primary form-check-label" for="JURIDICO">JÚRIDICO</label></a>
    </div><div class=" form-check form-check-inline mt-3">
    <a href="tl-cadastro-notas.php?tp=3">
    <label class="btn btn-outline-primary form-check-label" for="NOTAS">NOTAS</label></a>
  </div><div class=" form-check form-check-inline mt-3">
    <a href="tl-cadastro-notas.php?tp=4&tipo=2">
    <label class="btn btn-outline-primary form-check-label" for="APURACAO">APURAÇÃO</label></a>
  </div>';
    include_once("b-clientes-fisicos.php");
  } elseif ($_GET['tp'] == 2) {
    echo '<small class="text-light fw-semibold d-block">Selecione um Menu:</small><div class=" form-check form-check-inline mt-3">
    <a href="tl-cadastro-notas.php?tp=1">
      <label class="btn btn-outline-primary form-check-label" for="FISICO">FÍSICO</label></></b>
    </div>
    <div class=" form-check form-check-inline mt-3">
      <a href="tl-cadastro-notas.php?tp=2">
      <b><label class="btn btn-outline-primary form-check-label active" for="JURIDICO">JÚRIDICO</label></a></b>
    </div><div class=" form-check form-check-inline mt-3">
    <a href="tl-cadastro-notas.php?tp=3">
   <label class="btn btn-outline-primary form-check-label" for="NOTAS">NOTAS</label></a>
  </div><div class=" form-check form-check-inline mt-3">
    <a href="tl-cadastro-notas.php?tp=4&tipo=2">
    <label class="btn btn-outline-primary form-check-label" for="APURACAO">APURAÇÃO</label></a>
  </div>';
    include_once("b-clientes-juridicos.php");
  } elseif ($_GET['tp'] == 3) {
    echo '<small class="text-light fw-semibold d-block">Selecione um Menu:</small><div class=" form-check form-check-inline mt-3">
    <a href="tl-cadastro-notas.php?tp=1">
      <label class="btn btn-outline-primary form-check-label" for="FISICO">FÍSICO</label></></b>
    </div>
    <div class=" form-check form-check-inline mt-3">
      <a href="tl-cadastro-notas.php?tp=2">
      <label class="btn btn-outline-primary form-check-label" for="JURIDICO">JÚRIDICO</label></a>
    </div><div class=" form-check form-check-inline mt-3">
    <a href="tl-cadastro-notas.php?tp=3">
    <b><label class="btn btn-outline-primary form-check-label active" for="NOTAS">NOTAS</label></a></b>
  </div><div class=" form-check form-check-inline mt-3">
    <a href="tl-cadastro-notas.php?tp=4&tipo=2">
    <label class="btn btn-outline-primary form-check-label" for="APURACAO">APURAÇÃO</label></a>
  </div>';
    include_once("b-notas.php");
  } elseif ($_GET['tp'] == 4) {
    echo '<small class="text-light fw-semibold d-block">Selecione um Menu:</small><div class=" form-check form-check-inline mt-3">
    <a href="tl-cadastro-notas.php?tp=1">
      <label class="btn btn-outline-primary form-check-label" for="FISICO">FÍSICO</label></></b>
    </div>
    <div class=" form-check form-check-inline mt-3">
      <a href="tl-cadastro-notas.php?tp=2">
      <label class="btn btn-outline-primary form-check-label" for="JURIDICO">JÚRIDICO</label></a>
    </div><div class=" form-check form-check-inline mt-3">
    <a href="tl-cadastro-notas.php?tp=3">
    <b><label class="btn btn-outline-primary form-check-label " for="NOTAS">NOTAS</label></a></b>
  </div><div class=" form-check form-check-inline mt-3">
    <a href="tl-cadastro-notas.php?tp=4&tipo=2">
    <label class="btn btn-outline-primary form-check-label active" for="APURACAO">APURAÇÃO</label></a>
  </div>';
    include_once("b-apuracao.php");
  }
} else {
  echo '<small class="text-light fw-semibold d-block">Selecione um Menu:</small><div class=" form-check form-check-inline mt-3">
  <a href="tl-cadastro-notas.php?tp=1">
    <label class="btn btn-outline-primary form-check-label" for="FISICO">FÍSICO</label></a>
  </div>
  <div class=" form-check form-check-inline mt-3">
    <a href="tl-cadastro-notas.php?tp=2">
    <label class="btn btn-outline-primary form-check-label" for="JURIDICO">JÚRIDICO</label></a>
  </div><div class=" form-check form-check-inline mt-3">
  <a href="tl-cadastro-notas.php?tp=3">
  <label class="btn btn-outline-primary form-check-label" for="NOTAS">NOTAS</label></a>
</div>
<div class=" form-check form-check-inline mt-3">
    <a href="tl-cadastro-notas.php?tp=4&tipo=2">
    <label class="btn btn-outline-primary form-check-label" for="APURACAO">APURAÇÃO</label></a>
  </div>';
} ?>

<?php /* |||   */ if (isset($_GET['id']) && isset($_GET['tp'])) { ?>

  <?php
  $cod_Pesquisa = $_GET['id'];
  if ($_GET['tp'] == 2) {
    $tipo_cliente_ = 2;
    $query_sd_posto = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos WHERE cod = $cod_Pesquisa ORDER BY nome ASC ");
    $query_sd_posto->execute();
    $i = 0;
    while ($linha = $query_sd_posto->fetch(PDO::FETCH_ASSOC)) {
      $codigoC = $linha['cod'];
      $nome = $linha['nome'];
      $nome_Fantasia = $linha['nome_fantasia'];
      $cpf = $linha['cnpj'];
      $atividade = $linha['atividade'];
      $filial_coligada = $linha['filial_coligada'];
      $cod_atendente = $linha['cod_atendente'];
      $nome_atendente = $linha['nome_atendente'];
      $observacao = $linha['observacao'];
      $credito = $linha['credito'];
      $senha = $linha['senha'];
      $excluido = $linha['excluido'];
      $tOKEN = $linha['TOKEN'];
      $uLTIMO_ACESSO = $linha['ULTIMO_ACESSO'];
      $qTD_ACESSO = $linha['QTD_ACESSOS'];
    }
  } elseif ($_GET['tp'] == 1) {
    $query_clientes_fisico = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos WHERE cod = $cod_Pesquisa ORDER BY nome ASC ");
    $query_clientes_fisico->execute();
    $i = 0;
    $tipo_cliente_ = 1;
    while ($linha = $query_clientes_fisico->fetch(PDO::FETCH_ASSOC)) {
      $codigoC = $linha['cod'];
      $nome = $linha['nome'];
      $cpf = $linha['cpf'];
      $atividade = $linha['atividade'];
      $cod_atendente = $linha['cod_atendente'];
      $nome_atendente = $linha['nome_atendente'];
      $observacoes = $linha['observacoes'];
      $credito = $linha['credito'];
      $senha = $linha['senha'];
    }
  } elseif ($_GET['tp'] == 3) {
    $Notas = $conexao->prepare("SELECT * FROM tabela_notas WHERE cod = $cod_Pesquisa");
    $Notas->execute();
    while ($linha = $Notas->fetch(PDO::FETCH_ASSOC)) {
      $cod = $linha['cod'];
      $serie = $linha['serie'];
      $tipo = $linha['tipo'];
      $forma_pagamento = $linha['forma_pagamento'];
      $cod_emissor = $linha['cod_emissor'];
      $cod_cliente = $linha['cod_cliente'];
      $cod_endereco = $linha['cod_endereco'];
      $cod_contato = $linha['cod_contato'];
      $tipo_pessoa = $linha['tipo_pessoa'];
      $valor = $linha['valor'];
      $datalanca = $linha['data'];
      $observacoes = $linha['observacoes'];
      $datas = explode('/', $datalanca);

      $data_correta = date('Y-m-d', strtotime($datas[2] . $datas[1] . $datas[0]));
      if ($tipo_pessoa == 1) {
        $clientes = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos WHERE cod = $cod_cliente ORDER BY cod desc ");
      } else {
        $clientes = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos WHERE cod = $cod_cliente ORDER BY cod desc ");
      }
      $clientes->execute();

      while ($linha2 = $clientes->fetch(PDO::FETCH_ASSOC)) {
        $codigoC = $linha2['cod'];
        $nome = $linha2['nome'];
        if ($tipo_pessoa == 1) {
          $cpf = $linha2['cpf'];
        } else {
          $cpf = $linha2['cnpj'];
        }


        $atividade = $linha2['atividade'];
        $cod_atendente = $linha2['cod_atendente'];
        $nome_atendente = $linha2['nome_atendente'];
        $credito = $linha2['credito'];
        $senha = $linha2['senha'];

        $Clientes_Contato_Juridicos = $conexao->prepare("SELECT * FROM tabela_associacao_contatos a INNER JOIN tabela_contatos e ON a.cod_contato = e.cod WHERE a.cod_cliente = '$cod_cliente' AND a.tipo_cliente = '$tipo_pessoa' LIMIT 15");
        $Clientes_Contato_Juridicos->execute();
        $contato = 0;
        while ($linha = $Clientes_Contato_Juridicos->fetch(PDO::FETCH_ASSOC)) {

          $Cliente_Contato_Puxado[$contato] = [
            'cod' => $linha['cod'],
            'nome_contato' => $linha['nome_contato'],
            'email' => $linha['email'],
            'telefone' => $linha['telefone'],
            'ramal' => $linha['ramal'],
            'telefone2' => $linha['telefone2'],
            'ramal2' => $linha['ramal2'],
            'departamento' => $linha['departamento'],
            'excluido' => $linha['excluido'],
          ];
          $contato++;
        }
        $Clientes_Endereco_Juridicos = $conexao->prepare("SELECT * FROM tabela_associacao_enderecos a INNER JOIN tabela_enderecos e ON a.cod_endereco = e.cod WHERE a.cod_cliente = '$cod_cliente' AND a.tipo_cliente = $tipo_pessoa LIMIT 15 ");
        $Clientes_Endereco_Juridicos->execute();
        $i = 0;
        $endereco = 0;
        while ($linha = $Clientes_Endereco_Juridicos->fetch(PDO::FETCH_ASSOC)) {

          $Cliente_Enderecos_Puxado[$endereco] = [
            'cod' => $linha['cod'],
            'cep' => $linha['cep'],
            'tipo_endereco' => $linha['tipo_endereco'],
            'logadouro' => $linha['logadouro'],
            'bairro' => $linha['bairro'],
            'uf' => $linha['uf'],
            'cidade' => $linha['cidade'],
            'complemento' => $linha['complemento'],
            'excluido' => $linha['excluido'],
            'casa' => $linha['casa'],

          ];
          $endereco++;
        }
      }

      if ($forma_pagamento == '1') {
        $tabela_interana = $conexao->prepare("SELECT * FROM nt_credito_lanc_siafi WHERE NT_CREDITO_CODIGO = $cod");
      } else {
        $tabela_interana = $conexao->prepare("SELECT * FROM nt_credito_lanc_gru WHERE NT_CREDITO_CODIGO = $cod");
      }
      $tabela_interana->execute();
      $i = 0;
      while ($linha3 = $tabela_interana->fetch(PDO::FETCH_ASSOC)) {
        $CPF_usr = $linha3['CPF_USR'];
        $nome_usr = $linha3['NOME_USR'];
        if ($forma_pagamento == 4) {
          $gru = $linha3['CODIGO_REC'];
        } elseif ($forma_pagamento == 1) {
          $siafi = $linha3['NT_CREDITO_CODIGO_SIAFI'];
          $ug = $linha3['UG'];
        }

        $data_hora = $linha3['DATA_HORA'];
      }
    }
  }

  if ($_GET['tp'] != 3) {
    include_once("b-tl-prencimento.php");
  } else {
    include_once("b-nota-prencimento.php");
  }


  ?>


<?php /* |||   */ } ?>
<?php /* |||   */ include_once("../html/../html/navbar-dow.php"); ?>


<?php /* |||   */ include_once("../html/../html/../html/navbar-dow.php"); ?>