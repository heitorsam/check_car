<?php

    session_start();	

    //CHAMANDO CONEXÃO
    include '../../conexao.php';    

    //RECEBENDO VARIAVEL OS MV
    $var_os_mv = $_GET['os'];
    $var_sn_rateio = $_GET['sn_rateio'];
    $usuario = $_SESSION['usuarioLogin'];

    //CHAMANDO CONSULTA
    $cons_setor = "SELECT st.CD_SETOR, st.NM_SETOR 
                   FROM dbamv.SETOR st
                   WHERE st.SN_ATIVO = 'S'
                   ORDER BY st.NM_SETOR";
    $res_setor = oci_parse($conn_ora, $cons_setor);
    oci_execute($res_setor);

    echo '<b> OS ' .  $var_os_mv . '</b>';
?>

<?php if($var_sn_rateio == 'S'){ 
    
    //CHAMANDO CONSULTA
    $cons_rateio = "SELECT rt.CD_OS, rt.CD_SETOR, st.NM_SETOR, rt.PORCENTAGEM, 
    (SELECT usu.NM_USUARIO FROM dbasgu.USUARIOS usu
    WHERE usu.CD_USUARIO = 'ARIPEREIRA') AS NM_USUARIO,
    TO_CHAR(rt.HR_CADASTRO, 'DD/MM/YYYY HH24:MI:SS') AS HR_CADASTRO
    FROM portal_check_car.RATEIO rt
    LEFT JOIN dbamv.SETOR st
    ON st.CD_SETOR = rt.CD_SETOR
    WHERE rt.CD_OS = $var_os_mv
    ORDER BY st.NM_SETOR ASC";

    $res_rateio = oci_parse($conn_ora, $cons_rateio);
    oci_execute($res_rateio);
    
    
?>       
    <div class="row mt-4">
        <div class="col-md-10">
            <table id="tabela-setores" class="table table-bordered">
                <thead>
                    <tr style="text-align: center;">
                        <th>Código do Setor</th>
                        <th>Nome do Setor</th>
                        <th style="width: 100px;">%</th>
                        <th>Usuário</th>
                        <th>Data Hora</th>
                        
                    </tr>
                </thead>
                <tbody style="text-align: center;">
                <?php
                    while($row_rateio = oci_fetch_array($res_rateio)){
                        echo '<tr>';
                            echo '<td>' . $row_rateio['CD_OS'] . '</td>';
                            echo '<td>' . $row_rateio['NM_SETOR'] . '</td>';
                            echo '<td>' . $row_rateio['PORCENTAGEM'] . '</td>';
                            echo '<td>' . $row_rateio['NM_USUARIO'] . '</td>';
                            echo '<td>' . $row_rateio['HR_CADASTRO'] . '</td>';
                        echo '</tr>';
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>


<?php }else{ ?>

    <div class="row mt-4">
        <div class="col-md-6">
            <select id="filtro-setor" class="form-control">
                <option value="All">Todos</option>
                <?php
                    oci_execute($res_setor); // Executando novamente para garantir que os resultados sejam pegos do início
                    while($row_setor = oci_fetch_array($res_setor)){
                        echo '<option value="'.$row_setor['CD_SETOR'].'">'.$row_setor['NM_SETOR'].'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="col-md-6">
            <button onclick="adicionarSetor()" class="btn btn-primary"><i class="fas fa-plus"></i></button>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-10">
            <table id="tabela-setores" class="table table-bordered">
                <thead>
                    <tr style="text-align: center;">
                        <th>Código do Setor</th>
                        <th>Nome do Setor</th>
                        <th style="width: 100px;">%</th>
                        <th style="width: 100px;">Opções</th>
                    </tr>
                </thead>
                <tbody style="text-align: center;">
                    <!-- Aqui serão adicionadas as linhas dinamicamente -->
                </tbody>
            </table>
        </div>
    </div>

<?php } ?>

<!-- Adicione os scripts JavaScript do Bootstrap ou qualquer outro framework que esteja usando -->
<script>

    function adicionarSetor() {
        var select = document.getElementById('filtro-setor');
        var selectedOption = select.options[select.selectedIndex];
        var codigoSetor = selectedOption.value;
        var nomeSetor = selectedOption.text;
        var table = document.getElementById('tabela-setores').getElementsByTagName('tbody')[0];
        var exists = false;

        // Verifica se o setor já está na tabela
        var rows = table.getElementsByTagName("tr");
        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName("td");
            if (cells.length > 0 && cells[0].innerText === codigoSetor) {
                exists = true;
                break;
            }
        }

        // Se o setor ainda não estiver na tabela, adiciona
        if (!exists) {
            var newRow = table.insertRow(table.rows.length);
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);

            cell1.innerHTML = '<span style="display: inline-block; vertical-align: middle; margin-top:10px;">' + codigoSetor + '</span>';
            cell2.innerHTML = '<span style="display: inline-block; vertical-align: middle;  margin-top:10px;">' + nomeSetor + '</span>';
            cell3.innerHTML = '<input type="number" class="form-control percent-input" data-setor-id="' + codigoSetor + '" value="0">';
            cell4.innerHTML = '<button onclick="removerSetor(this)" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>';
        } else {
            alert('Setor já adicionado.');
        }
    }

    function removerSetor(button) {
        var row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }

    function ajax_insert_rateio() {
        var data = [];
        var inputs = document.querySelectorAll('.percent-input');
        inputs.forEach(function(input) {
            data.push({
                cd_os: <?php echo $var_os_mv; ?>, 
                cd_setor: input.getAttribute('data-setor-id'),
                porcentagem: parseInt(input.value),
                cd_usuario_cadastro: '<?php echo $usuario; ?>'
            });
        });

        // Fazendo a requisição AJAX
        fetch('funcoes/chamados/inserir_rateio.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ dados: data }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Valores inseridos com sucesso na tabela RATEIO.');
            } else {
                alert(data.message);
            }
        })
        .catch((error) => {
            console.error('Erro:', error);
        });
    }
  
</script>
