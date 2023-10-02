<?php 
require("../conexoes/conexao.php");
$query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO  INNER JOIN controle_tempo c ON c.fk_status = o.status WHERE o.status != '11' AND o.status != '13' AND o.status != '3' AND o.status != '4' AND o.status != '5' AND o.status != '' AND o.status != '12' AND o.status != '15' AND o.status != '17' AND o.status != '18' AND o.status != '19' ORDER BY o.cod DESC");
                          
                            $query_ordens_finalizadas->execute();
                            $i = 0;
                            while ($linha = $query_ordens_finalizadas->fetch(PDO::FETCH_ASSOC)) {
                              $status = $linha['status'];
                              $cod = $linha['cod'];
                              $ss = $linha['secao_op'];
                              if ($status === '1') {
                                $secao = 'SEÇÃO TÉCNICA';
                              } else if ($status === '2') {
                                $secao = 'PRÉ-IMPRESSAO';
                              } else if ($status === '6') {
                                $secao = 'OFFSET';
                              } else if ($status === '7') {
                                $secao = 'IMPRESSAO DIGITAL';
                              } else if ($status === '8') {
                                $secao = 'TIPOGRAFIA';
                              } else if ($status === '9') {
                                $secao = 'ACABAMENTO';
                              } else if ($status === '10') {
                                $secao = 'EXPEDIÇÃO';
                              } else if ($status === '14') {
                                $secao = 'GRAVAÇÃO DE CHAPAS';
                              } else if ($status === '16') {
                                $secao = 'BANNER';
                              }
                              if($ss != $secao){
                                echo $status . ' -> '. $ss . ' -> ' .$secao . '<br>';
                                $atualizar_op = $conexao->prepare("UPDATE tabela_ordens_producao SET secao_op = '$secao' WHERE cod = $cod ");
                             //   $atualizar_op->execute();
                                $i ++;
                              }
                            }
                            echo 'Foram '. $i;