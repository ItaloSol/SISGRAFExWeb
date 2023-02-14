<?php
// include_once("../conexoes/conexao.php");
// $cod_user = 'ADM';
$query_ordens_Notificacao = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO INNER JOIN controle_tempo c ON c.fk_status = o.status WHERE o.cod_emissor = '$cod_user' OR o.COD_ATENDENTE = '$cod_user' ");
$query_ordens_Notificacao->execute();
$i = 0;
$Atrasada_Do_OP = 0;
$Total_Notificacao = 0;
$Em_Nome_Op = 0;
$hoje_Notificacao = date('Y-m-d');
$hoje = date('Y-m-d');
$Entregues_Em_Op = 0;
while ($linha = $query_ordens_Notificacao->fetch(PDO::FETCH_ASSOC)) {
    if ($linha['data_entrega'] < $hoje_Notificacao && $linha['status'] >= '6' && $linha['status'] != '13' && $linha['status'] <= '9' && $linha['status'] == '2') {
        $Atrasada_Do_OP++;
    }
    if ($linha['data_entrega'] < $hoje_Notificacao  && $linha['status'] != '11'  && $linha['status'] != '13') {
        $Pesquisa_Produto = $linha['cod_produto'];
        $Tipo_Produto =  $linha['tipo_produto'];
        $Ordens_Notificacao[$Total_Notificacao] = [
            'cod' => $linha['cod'],
            'orcamento_base' => $linha['orcamento_base'],
            'tipo_produto' => $linha['tipo_produto'],
            'cod_produto' => $linha['cod_produto'],
            'cod_cliente' => $linha['cod_cliente'],
            'tipo_cliente' => $linha['tipo_cliente'],
            'status' => $linha['status'],
            'azul_controle' => $linha['azul_controle'],
            'amarelo_controle' => $linha['amarelo_controle'],
            'vermelho_controle' => $linha['vermelho_controle'],
            'STS_DESCRICAO' => $linha['STS_DESCRICAO'],
            'data_entrega' => date($linha['data_entrega']),
            'data_emissao' => date($linha['data_emissao']),
            'data_entrega' => date($linha['data_entrega']),
            'data_emissao' => date($linha['data_emissao']),
            'data_apr_cliente' => date($linha['data_apr_cliente']),
            'data_ent_tipografia' => date($linha['data_ent_tipografia']),
            'data_ent_acabamento' => date($linha['data_ent_acabamento']),
            'DT_ENTRADA_PRE_IMP_PROVA' => date($linha['DT_ENTRADA_PRE_IMP_PROVA']),
            'DT_ENTRADA_PRE_IMP' => date($linha['DT_ENTRADA_PRE_IMP']),
            'DT_ENTRADA_CTP' => date($linha['DT_ENTRADA_CTP']),
            'data_1a_prova' => date($linha['data_1a_prova']),
            'data_2a_prova' => date($linha['data_2a_prova']),
            'data_3a_prova' => date($linha['data_3a_prova']),
            'data_4a_prova' => date($linha['data_4a_prova']),
            'data_5a_prova' => date($linha['data_5a_prova']),
            'data_ent_final' => date($linha['data_ent_final']),
            'data_ent_offset' => date($linha['data_ent_offset']),
            'data_envio_div_cmcl' => date($linha['data_envio_div_cmcl']),
            'DT_ENT_DIGITAL' => date($linha['DT_ENT_DIGITAL']),
            'data_ent_offset' => date($linha['data_ent_offset']),
            'DT_TIPOGRAFIA_PROVA' => date($linha['DT_TIPOGRAFIA_PROVA']),
            'DT_ACABAMENTO_PROVA' => date($linha['DT_ACABAMENTO_PROVA']),
            'DT_SAIDA_EXPEDICAO' => date($linha['DT_SAIDA_EXPEDICAO']),
            'data_imp_dir' => date($linha['data_imp_dir']),
            'tipo_trabalho' => $linha['tipo_trabalho'],
            'DT_ENTRADA_PLOTTER' => date($linha['DT_ENTRADA_PLOTTER']),
            'DT_ENVIADO_EXPEDICAO' => date($linha['DT_ENVIADO_EXPEDICAO']),
            'SAIDA_PRE' => date($linha['SAIDA_PRE']),
            'SAIDA_DIGITAL' => date($linha['SAIDA_DIGITAL']),
            'SAIDA_OFFSET' => date($linha['SAIDA_OFFSET']),
            'SAIDA_CTP' => date($linha['SAIDA_CTP']),
            'SAIDA_TIPOGRAFIA' => date($linha['SAIDA_TIPOGRAFIA']),
            'SAIDA_ACABAMENTO' => date($linha['SAIDA_ACABAMENTO']),
            'SAIDA_PLOTTER' => date($linha['SAIDA_PLOTTER']),
            'DT_ENTG_PROVA' => date($linha['DT_ENTG_PROVA']),

        ];
        if ($Tipo_Produto == '2') {
            $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos_pr_ent  WHERE CODIGO = '$Pesquisa_Produto'");
            $query_PRODUTOS->execute();

            while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                $Tabela_Produtos_Notificacao[$Total_Notificacao] = [
                    'descricao' => $linha2['DESCRICAO']
                ];
            }
        }
        if ($Tipo_Produto == '1') {
            $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos  WHERE CODIGO = '$Pesquisa_Produto'");
            $query_PRODUTOS->execute();

            while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                $Tabela_Produtos_Notificacao[$Total_Notificacao] = [
                    'descricao' => $linha2['DESCRICAO']
                ];
            }
        }
        if ($linha['status'] == 11) {
            $Entregues_Em_Op++;
        }
        $a2_b = $Ordens_Notificacao[$i]['azul_controle'];
        $a2_y = $Ordens_Notificacao[$i]['amarelo_controle'];
        $a2_r = $Ordens_Notificacao[$i]['vermelho_controle'];
        if ($linha['status'] == 1) {
            $s1 = $Ordens_Notificacao[$i]['data_emissao'];
            if ($s1 != '') {
                $sts1_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s1)));
                $sts1_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s1)));
                $sts1_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s1)));
                if ($hoje > $sts1_b) {
                    $Status = 'blue';
                }
                if ($hoje > $sts1_y) {
                    $Status = 'yellow';
                }
                if ($hoje > $sts1_r) {
                    $Status = 'red';
                }
            }else{
              $Status = 'green';
            }
        }
        //
        if ($linha['status'] == 2) {
            $s2 = $Ordens_Notificacao[$i]['DT_ENTRADA_PRE_IMP_PROVA'];
            if ($s2 != '') {
                $sts2_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s2)));
                $sts2_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s2)));
                $sts2_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s2)));
                if ($hoje > $sts2_b) {
                    $Status = 'blue';
                }
                if ($hoje > $sts2_y) {
                    $Status = 'yellow';
                }
                if ($hoje > $sts2_r) {
                    $Status = 'red';
                }
            }else{
              $Status = 'green';
            }
        } //
        if ($linha['status'] == 3) {
            $s3 = $Ordens_Notificacao[$i]['DT_ENTRADA_PRE_IMP_PROVA'];
            if ($s3 != '') {
                $sts3_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s3)));
                $sts3_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s3)));
                $sts3_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s3)));
                if ($hoje > $sts3_b) {
                    $Status = 'blue';
                }
                if ($hoje > $sts3_y) {
                    $Status = 'yellow';
                }
                if ($hoje > $sts3_r) {
                    $Status = 'red';
                }
            }else{
              $Status = 'green';
            }
        } //
        if ($linha['status'] == 4) {
            $s4 = $Ordens_Notificacao[$i]['DT_ENTRADA_PRE_IMP_PROVA'];
            if ($s4 != '') {
                $sts4_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s4)));
                $sts4_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s4)));
                $sts4_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s4)));
                if ($hoje > $sts4_b) {
                    $Status = 'blue';
                }
                if ($hoje > $sts4_y) {
                    $Status = 'yellow';
                }
                if ($hoje > $sts4_r) {
                    $Status = 'red';
                }
            }else{
              $Status = 'green';
            }
        } //
        if ($linha['status'] == 5) {
            $s5 = $Ordens_Notificacao[$i]['DT_ENTG_PROVA'];
            if ($s5 != '') {
                $sts5_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s5)));
                $sts5_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s5)));
                $sts5_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s5)));
                if ($hoje > $sts5_b) {
                    $Status = 'blue';
                }
                if ($hoje > $sts5_y) {
                    $Status = 'yellow';
                }
                if ($hoje > $sts5_r) {
                    $Status = 'red';
                }
            }else{
              $Status = 'green';
            }
        } //
        if ($linha['status'] == 6) {
            $s6 = $Ordens_Notificacao[$i]['data_ent_offset'];
            if ($s6 != '') {
                $sts6_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s6)));
                $sts6_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s6)));
                $sts6_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s6)));
                if ($hoje > $sts6_b) {
                    $Status = 'blue';
                }
                if ($hoje > $sts6_y) {
                    $Status = 'yellow';
                }
                if ($hoje > $sts6_r) {
                    $Status = 'red';
                }
            }else{
              $Status = 'green';
            }
        } //
        if ($linha['status'] == 7) {
            $s7 = $Ordens_Notificacao[$i]['DT_ENT_DIGITAL'];
            if ($s7 != '') {
                $sts7_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s7)));
                $sts7_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s7)));
                $sts7_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s7)));
                if ($hoje > $sts7_b) {
                    $Status = 'blue';
                }
                if ($hoje > $sts7_y) {
                    $Status = 'yellow';
                }
                if ($hoje > $sts7_r) {
                    $Status = 'red';
                }
            }else{
              $Status = 'green';
            }
        } //
        if ($linha['status'] == 8) {
            $s8 = $Ordens_Notificacao[$i]['data_ent_tipografia'];
            if ($s8 != '') {
                $sts8_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s8)));
                $sts8_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s8)));
                $sts8_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s8)));
                if ($hoje > $sts8_b) {
                    $Status = 'blue';
                }
                if ($hoje > $sts8_y) {
                    $Status = 'yellow';
                }
                if ($hoje > $sts8_r) {
                    $Status = 'red';
                }
            }else{
              $Status = 'green';
            }
        } //
        if ($linha['status'] == 9) {
            $s9 = $Ordens_Notificacao[$i]['data_ent_acabamento'];
            if ($s9 != '') {
                $sts9_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s9)));
                $sts9_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s9)));
                $sts9_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s9)));
                if ($hoje > $sts9_b) {
                    $Status = 'blue';
                }
                if ($hoje > $sts9_y) {
                    $Status = 'yellow';
                }
                if ($hoje > $sts9_r) {
                    $Status = 'red';
                }
            }else{
              $Status = 'green';
            }
        } //
        if ($linha['status'] == 10) {
            $s10 = $Ordens_Notificacao[$i]['DT_ENVIADO_EXPEDICAO'];
            if ($s10 != '') {
                $sts10_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s10)));
                $sts10_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s10)));
                $sts10_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s10)));
                if ($hoje > $sts10_b) {
                    $Status = 'blue';
                }
                if ($hoje > $sts10_y) {
                    $Status = 'yellow';
                }
                if ($hoje > $sts10_r) {
                    $Status = 'orange';
                }
            }else{
              $Status = 'green';
            }
        } //

        if ($linha['status'] == 14) {
            $s14 = $Ordens_Notificacao[$i]['DT_ENTRADA_CTP'];
            if ($s14 != '') {
                $sts14_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s14)));
                $sts14_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s14)));
                $sts14_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s14)));
                if ($hoje > $sts14_b) {
                    $Status = 'blue';
                }
                if ($hoje > $sts14_y) {
                    $Status = 'yellow';
                }
                if ($hoje > $sts14_r) {
                    $Status = 'red';
                }
            }else{
              $Status = 'green';
            }
        } //
        if ($linha['status'] == 15) {
            $s15 = $Ordens_Notificacao[$i]['DT_ENTG_PROVA'];
            if ($s15 != '') {
                $sts15_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s15)));
                $sts15_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s15)));
                $sts15_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s15)));
                //  echo $s15 .'<br>'. $sts15_b .'<br>';
                if ($hoje > $sts15_b) {
                    //   echo 'maior';
                    $Status = 'blue';
                }
                if ($hoje > $sts15_y) {
                    $Status = 'yellow';
                }
                if ($hoje > $sts15_r) {
                    $Status = 'red';
                }
            }else{
              $Status = 'green';
            }
        }
        if ($linha['status'] == 12) {
            $Status = 'White';
        }
        if ($linha['status'] == 13) {
            $Status = 'White';
        }
        if ($linha['status'] == 11) {
            $Status = 'White';
        }
        if (isset($Status)) {
            $cor[$i] = [
                'cor' => $Status
            ];
        } else {
            $cor[$i] = [
                'cor' => 'White'
            ];
        }
        //////////
        $a2_b = $Ordens_Notificacao[$Total_Notificacao]['azul_controle'];
        $a2_y = $Ordens_Notificacao[$Total_Notificacao]['amarelo_controle'];
        $a2_r = $Ordens_Notificacao[$Total_Notificacao]['vermelho_controle'];
        if ($linha['status'] == 1) {
            $s1 = $Ordens_Notificacao[$Total_Notificacao]['data_emissao'];
            if ($s1 != '') {
                $sts1_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s1)));
                $sts1_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s1)));
                $sts1_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s1)));
                if ($hoje > $sts1_b) {
                    $Status = 'blue';
                }
                if ($hoje > $sts1_y) {
                    $Status = 'yellow';
                }
                if ($hoje > $sts1_r) {
                    $Status = 'red';
                }
            }
        }
        //
        if ($linha['status'] == 2) {
            $s2 = $Ordens_Notificacao[$Total_Notificacao]['DT_ENTRADA_PRE_IMP_PROVA'];
            if ($s2 != '') {
                $sts2_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s2)));
                $sts2_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s2)));
                $sts2_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s2)));
                if ($hoje > $sts2_b) {
                    $Status = 'blue';
                }
                if ($hoje > $sts2_y) {
                    $Status = 'yellow';
                }
                if ($hoje > $sts2_r) {
                    $Status = 'red';
                }
            }
        } //
        if ($linha['status'] == 3) {
            $s3 = $Ordens_Notificacao[$Total_Notificacao]['DT_ENTRADA_PRE_IMP_PROVA'];
            if ($s3 != '') {
                $sts3_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s3)));
                $sts3_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s3)));
                $sts3_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s3)));
                if ($hoje > $sts3_b) {
                    $Status = 'blue';
                }
                if ($hoje > $sts3_y) {
                    $Status = 'yellow';
                }
                if ($hoje > $sts3_r) {
                    $Status = 'red';
                }
            }
        } //
        if ($linha['status'] == 4) {
            $s4 = $Ordens_Notificacao[$Total_Notificacao]['DT_ENTRADA_PRE_IMP_PROVA'];
            if ($s4 != '') {
                $sts4_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s4)));
                $sts4_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s4)));
                $sts4_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s4)));
                if ($hoje > $sts4_b) {
                    $Status = 'blue';
                }
                if ($hoje > $sts4_y) {
                    $Status = 'yellow';
                }
                if ($hoje > $sts4_r) {
                    $Status = 'red';
                }
            }
        } //
        if ($linha['status'] == 5) {
            $s5 = $Ordens_Notificacao[$Total_Notificacao]['DT_ENTG_PROVA'];
            if ($s5 != '') {
                $sts5_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s5)));
                $sts5_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s5)));
                $sts5_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s5)));
                if ($hoje > $sts5_b) {
                    $Status = 'blue';
                }
                if ($hoje > $sts5_y) {
                    $Status = 'yellow';
                }
                if ($hoje > $sts5_r) {
                    $Status = 'red';
                }
            }
        } //
        if ($linha['status'] == 6) {
            $s6 = $Ordens_Notificacao[$Total_Notificacao]['data_ent_offset'];
            if ($s6 != '') {
                $sts6_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s6)));
                $sts6_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s6)));
                $sts6_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s6)));
                if ($hoje > $sts6_b) {
                    $Status = 'blue';
                }
                if ($hoje > $sts6_y) {
                    $Status = 'yellow';
                }
                if ($hoje > $sts6_r) {
                    $Status = 'red';
                }
            }
        } //
        if ($linha['status'] == 7) {
            $s7 = $Ordens_Notificacao[$Total_Notificacao]['DT_ENT_DIGITAL'];
            if ($s7 != '') {
                $sts7_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s7)));
                $sts7_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s7)));
                $sts7_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s7)));
                if ($hoje > $sts7_b) {
                    $Status = 'blue';
                }
                if ($hoje > $sts7_y) {
                    $Status = 'yellow';
                }
                if ($hoje > $sts7_r) {
                    $Status = 'red';
                }
            }
        } //
        if ($linha['status'] == 8) {
            $s8 = $Ordens_Notificacao[$Total_Notificacao]['data_ent_tipografia'];
            if ($s8 != '') {
                $sts8_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s8)));
                $sts8_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s8)));
                $sts8_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s8)));
                if ($hoje > $sts8_b) {
                    $Status = 'blue';
                }
                if ($hoje > $sts8_y) {
                    $Status = 'yellow';
                }
                if ($hoje > $sts8_r) {
                    $Status = 'red';
                }
            }
        } //
        if ($linha['status'] == 9) {
            $s9 = $Ordens_Notificacao[$Total_Notificacao]['data_ent_acabamento'];
            if ($s9 != '') {
                $sts9_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s9)));
                $sts9_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s9)));
                $sts9_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s9)));
                if ($hoje > $sts9_b) {
                    $Status = 'blue';
                }
                if ($hoje > $sts9_y) {
                    $Status = 'yellow';
                }
                if ($hoje > $sts9_r) {
                    $Status = 'red';
                }
            }
        } //
        if ($linha['status'] == 10 ) {
            $s10 = $Ordens_Notificacao[$Total_Notificacao]['DT_ENVIADO_EXPEDICAO'];
            if ($s10 != '') {
                $sts10_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s10)));
                $sts10_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s10)));
                $sts10_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s10)));
                if ($hoje > $sts10_b) {
                    $Status = 'blue';
                }
                if ($hoje > $sts10_y) {
                    $Status = 'yellow';
                }
                if ($hoje > $sts10_r) {
                    $Status = 'orange';
                }
            }
        } //

        if ($linha['status'] == 14) {
            $s14 = $Ordens_Notificacao[$Total_Notificacao]['DT_ENTRADA_CTP'];
            if ($s14 != '') {
                $sts14_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s14)));
                $sts14_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s14)));
                $sts14_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s14)));
                if ($hoje > $sts14_b) {
                    $Status = 'blue';
                }
                if ($hoje > $sts14_y) {
                    $Status = 'yellow';
                }
                if ($hoje > $sts14_r) {
                    $Status = 'red';
                }
            }
        } //
        if ($linha['status'] == 15) {
            $s15 = $Ordens_Notificacao[$Total_Notificacao]['DT_ENTG_PROVA'];
            if ($s15 != '') {

                $sts15_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s15)));
                $sts15_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s15)));
                $sts15_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s15)));
                //  echo $s15 .'<br>'. $sts15_b .'<br>';
                if ($hoje > $sts15_b) {
                    //   echo 'maior';
                    $Status = 'blue';
                }
                if ($hoje > $sts15_y) {
                    $Status = 'yellow';
                }
                if ($hoje > $sts15_r) {
                    $Status = 'red';
                }
            }
        }
        if ($linha['status'] == 12) {
            $Status = 'White';
        }
        if ($linha['status'] == 13) {
            $Status = 'White';
        }
        if ($linha['status'] == 11) {
            $Status = 'White';
        }
        if (isset($Status)) {
            $cor[$Total_Notificacao] = [
                'cor' => $Status
            ];
        } else {
            $cor[$Total_Notificacao] = [
                'cor' => 'White'
            ];
        }

        $Total_Notificacao++;
    }
    $Em_Nome_Op++;
}
$Metade = $Em_Nome_Op / 2;
