<?php

    include '../../conexao.php';

    $cons_linha = "SELECT MAX(tot.LINHA) AS TOT_LINHA 
                    FROM (SELECT  ROWNUM AS LINHA,
                            res.* 
                    FROM (SELECT sol.CD_OS,
                        TO_CHAR(sol.DT_PEDIDO, 'DD/MM/YYYY HH24:MI:SS') AS DT_PEDIDO,
                        sol.DS_SERVICO,
                        sol.DS_OBSERVACAO,
                        (SELECT usu.NM_USUARIO
                            FROM dbasgu.USUARIOS usu
                            WHERE usu.CD_USUARIO = sol.NM_SOLICITANTE) AS NM_USUARIO_SOLICITANTE,
                        (SELECT loc. DS_LOCALIDADE
                            FROM dbamv.LOCALIDADE loc
                            WHERE loc.CD_LOCALIDADE = sol.CD_LOCALIDADE) AS NM_LOCALIDADE
                    FROM dbamv.SOLICITACAO_OS sol
                    WHERE sol.CD_OFICINA = 9
                    AND sol.DT_PEDIDO >= SYSDATE - 7
                    AND sol.CD_MULTI_EMPRESA = 1
                    AND sol.TP_SITUACAO = 'S') res)tot
                    --WHERE tot.LINHA BETWEEN '1' AND '10'
                    ORDER BY tot.LINHA ASC";
    $res_linha = oci_parse($conn_ora, $cons_linha);
                 oci_execute($res_linha);

    $row_linha = oci_fetch_array($res_linha);
?>

<input type="text" hidden id="linhas_tot" value="<?php echo $row_linha['TOT_LINHA']; ?>">