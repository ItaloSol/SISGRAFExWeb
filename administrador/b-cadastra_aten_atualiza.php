<?php /*   */ 
session_start();
include_once('../conexoes/conexao.php');
include_once('../conexoes/conn.php');

if(isset($_POST['submit'])){
    $hoje = date('Y-m-d');
    if($_POST['submit'] == 'Cadastrar'){
        $orc = 0;      $prod = 0;      $exp = 0;      $fin = 0;      $estoque = 0;      $od = 0;      $orc_ad = 0;      $prod_ad = 0;      $exp_ad = 0;      $fin_ad = 0;
        $nome = $_POST['nome'];
        $codigo = $_POST['codigo'];
        $login = $_POST['login'];
       if($_POST['senha'] > "0"){ $senha =  md5($_POST["senha"]); }else{$senha = 0;}
        $tipo = $_POST['tipo'];
        if(isset($_POST['option1'])){
            $orc = $_POST['option1'];
            }
         if(isset($_POST['option2'])){
            $prod = $_POST['option2'];
            }
        if(isset($_POST['option3'])){
            $exp = $_POST['option3'];
            }
        if(isset($_POST['option4'])){
            $fin = $_POST['option4'];
            }
            if(isset($_POST['option5'])){
            $estoque = $_POST['option5'];
            }
       if(isset($_POST['option6'])){
            $od = $_POST['option6'];
            }
           if(isset($_POST['option7'])){
            $orc_ad = $_POST['option7'];
            }
            if(isset($_POST['option8'])){
            $prod_ad = $_POST['option8'];
            }
           if(isset($_POST['option9'])){
            $exp_ad = $_POST['option9'];
            }
           if(isset($_POST['option10'])){
            $fin_ad = $_POST['option10'];
            }
       

        $query_Atendente = $conexao->prepare("INSERT INTO tabela_atendentes (codigo_atendente, nome_atendente, login_atendente, senha_atendente, tipo_atendente, ativo) VALUES ('$codigo', '$nome', '$login', '$senha', '$tipo', '1' )");
	    $query_Atendente->execute();
                echo "INSERT INTO usuario_acessos (CODIGO_USR, ORC, ORC_ADM, PROD, PROD_ADM, EXP, EXP_ADM , FIN, FIN_ADM, EST, ORD) VALUES ('$codigo', '$orc', '$orc_ad', '$prod', '$prod_ad', '$exp', '$exp_ad', '$fin', '$fin_ad', '$estoque', '$od')";
        $query_Atendente = $conexao->prepare("INSERT INTO usuario_acessos (CODIGO_USR, ORC, ORC_ADM, PROD, PROD_ADM, EXP, EXP_ADM , FIN, FIN_ADM, EST, ORD) VALUES ('$codigo', $orc, $orc_ad, $prod, $prod_ad, $exp, $exp_ad, $fin, $fin_ad, $estoque, $od)");
	    $query_Atendente->execute();
    
    }
    if($_POST['submit'] == 'Editar'){
        $orc = 0;      $prod = 0;      $exp = 0;      $fin = 0;      $estoque = 0;      $od = 0;      $orc_ad = 0;      $prod_ad = 0;      $exp_ad = 0;      $fin_ad = 0;
        $nome = $_POST['nome'];
        $codigo = $_POST['codigo'];
        $login = $_POST['login'];
       if($_POST['senha'] > "0"){ $senha =  md5($_POST["senha"]); }else{$senha = 0;}
        $tipo = $_POST['tipo'];
    if(isset($_POST['option1'])){
        $orc = $_POST['option1'];
        }
     if(isset($_POST['option2'])){
        $prod = $_POST['option2'];
        }
    if(isset($_POST['option3'])){
        $exp = $_POST['option3'];
        }
    if(isset($_POST['option4'])){
        $fin = $_POST['option4'];
        }
        if(isset($_POST['option5'])){
        $estoque = $_POST['option5'];
        }
   if(isset($_POST['option6'])){
        $od = $_POST['option6'];
        }
       if(isset($_POST['option7'])){
        $orc_ad = $_POST['option7'];
        }
        if(isset($_POST['option8'])){
        $prod_ad = $_POST['option8'];
        }
       if(isset($_POST['option9'])){
        $exp_ad = $_POST['option9'];
        }
       if(isset($_POST['option10'])){
        $fin_ad = $_POST['option10'];
        }

       
   
        if($senha != 0){

            $query_Atendente = $conexao->prepare("UPDATE usuario_acessos SET ORC= $orc , ORC_ADM= $orc_ad , PROD= $prod , PROD_ADM= $prod_ad , EXP= $exp, EXP_ADM= $exp_ad, FIN= $fin , FIN_ADM= $fin_ad, EST= $estoque, ORD= $od
            WHERE CODIGO_USR = '$codigo' ");
            $query_Atendente->execute();
              
              
            $query_Atendente = $conexao->prepare("UPDATE tabela_atendentes SET nome_atendente= '$nome', senha_atendente= '$senha', tipo_atendente= '$tipo', mudanca_senha= '$hoje'
            WHERE codigo_atendente = '$codigo' ");
            $query_Atendente->execute();
        }else{
            $query_Atendente = $conexao->prepare("UPDATE usuario_acessos SET ORC = $orc , ORC_ADM = $orc_ad , PROD = $prod , PROD_ADM = $prod_ad , EXP = $exp, EXP_ADM = $exp_ad, FIN = $fin , FIN_ADM = $fin_ad, EST = $estoque, ORD = $od
            WHERE CODIGO_USR = '$codigo' ");
            $query_Atendente->execute();
              
              
            $query_Atendente = $conexao->prepare("UPDATE tabela_atendentes SET nome_atendente= '$nome', tipo_atendente= '$tipo'
            WHERE codigo_atendente = '$codigo' ");
            $query_Atendente->execute();
        }
   
    }
    $_SESSION['msg'] = ' <div style=";" id="alerta<?=$a?>"
            role="bs-toast"
            class=" bs-toast toast toast-placement-ex m-3 fade bg-success  top-0 end-0 hide show "
            role="alert"
            aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header">
              <i class="bx bx-bell me-2"></i>
              <div class="me-auto fw-semibold">Aviso!</div>
              <small>
                
                </small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            
            <div class="toast-body">
                Cadastrado com sucesso!     
            </div>
          </div>';
    header("Location: tl-cadastro-atendente.php");
}