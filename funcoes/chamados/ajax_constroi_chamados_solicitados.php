<div class="row">

    <div class="col-md-2">

        Inicio:
        <input type="date" class="form form-control" id="data1">

    </div>

    <div class="col-md-2">

        Fim:
        <input type="date" class="form form-control" id="data2">

    </div>

    <?php 

    include '../../conexao.php';

    //CHAMANDO CONSULTA
    $cons_setor = "SELECT st.CD_SETOR,st.NM_SETOR || ' (COD. ' || st.CD_SETOR || ')' AS NM_SETOR
                   FROM dbamv.SETOR st
                   WHERE st.SN_ATIVO = 'S'
                   ORDER BY st.NM_SETOR";
    $res_setor = oci_parse($conn_ora, $cons_setor);
    oci_execute($res_setor);

    ?>

    <div class="col-md-3">

        Setor:
        <select id="filtro-setor" class="form-control">
            <option value="0">Todos</option>
            <?php
                oci_execute($res_setor); // Executando novamente para garantir que os resultados sejam pegos do início
                while($row_setor = oci_fetch_array($res_setor)){
                    echo '<option value="'.$row_setor['CD_SETOR'].'">'.$row_setor['NM_SETOR'].'</option>';
                }
            ?>
        </select>

    </div>

    <?php 

    include '../../conexao.php';

    //CHAMANDO CONSULTA
    $cons_solicitante = "SELECT DISTINCT sol.NM_SOLICITANTE,
                            usu.NM_USUARIO AS NM_USUARIO_SOLICITANTE
                            FROM dbamv.SOLICITACAO_OS sol
                            INNER JOIN dbasgu.USUARIOS usu
                            ON usu.CD_USUARIO = sol.NM_SOLICITANTE
                            WHERE sol.CD_OFICINA = 9
                            AND sol.CD_MULTI_EMPRESA = 1
                            AND usu.SN_ATIVO = 'S'
                            AND usu.NM_USUARIO IS NOT NULL
                            ORDER BY NM_USUARIO_SOLICITANTE ASC";
                                $res_solicitante = oci_parse($conn_ora, $cons_solicitante);
                                oci_execute($res_solicitante);

    ?>

    <div class="col-md-3">

        Solicitante:
        <select id="filtro-solicitante" class="form-control">
            <option value="0">Todos</option>
            <?php
                oci_execute($res_solicitante); // Executando novamente para garantir que os resultados sejam pegos do início
                while($row_solicitante = oci_fetch_array($res_solicitante)){
                    echo '<option value="'.$row_solicitante['NM_SOLICITANTE'].'">'.$row_solicitante['NM_USUARIO_SOLICITANTE'].'</option>';
                }
            ?>
        </select>

    </div>

    <div class='col-md-2 esconde'>
        <br>
        <button onclick="ajax_exibe_solic('1')" class='btn btn-primary'><i class="fa-solid fa-magnifying-glass"></i></button>
    
    </div>

    <div class='col-12 esconde_btn_desktop' style="background-color: #f9f9f9 !important;">

    </br>
    <button onclick="ajax_exibe_solic('2')" style="width: 50%;" class='btn btn-primary'><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>

</div>

<div class="div_br"> </div>

<div class="div_exibe_solic"> </div>




    
