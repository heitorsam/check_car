SELECT * FROM dbamv.SOLICITACAO_OS WHERE CD_OS = 883780

43550


SELECT * FROM portal_check_car.veiculo vc FOR UPDATE

UPDATE portal_check_car.veiculo vc
SET vc.KM = 212345
WHERE vc.CD_VEICULO = 11
WHERE vc.CD_VEICULO = $var_veiculo

-- AJUSTES --

--P Desenvolver tela de cadastro de ve�culos (nenhuma funcionalidade funciona, apenas layout, � uma copia da tela setor)
    --A Lista veiculos
    --A Inativa e Ativa Veiculos
    --A Exclui Veiculos (apenas os que n�o possuem a��es dentro do portal)

--P Chamados finalizados no mv aparecem como pendentes no portal 
--P (isso far� com que ocorra erro ao concluir o chamado, pois a OS j� est� fechada)
    	 --A TP_SITUACAO da tabela dbamv.SOLICITACAO_OS deve ser igual a S
       
--P Chamados em andamento no mv aparecem como pendentes no portal 
--P (isso far� com que ocorra erro ao concluir o chamado, pois a OS j� est� fechada)
    	 --A TP_SITUACAO da tabela dbamv.SOLICITACAO_OS deve ser igual a S
  
--Detalhes da caixinha home s� funciona na primeira dos chamados pendentes
       --A Trazer detalhes da caixinha home
       --A Incluir OS no detalhes da caixinha home
       --A Mais op��es de click de detalhe caixinhas home

--P Ajuste das funcionalidades de mover chamado - (receber e finalizar chamados)
    --A Ajustes mensagem de erro exibindo kilometragem permitida

--P Exibir KM no cabe�alho
    --A Incluido KM atual no cabe�alho
    --A Incluido KM atual no cabe�alho mobile
    
--P Modal sem bot�o fechar e sem layout em bot�es
    --A Adicionado bot�es fechar
    --A Adicionado layouts nos bot�es

-- ANOTACOES --

--Jurandir
--000001261700
--@123mudar

--http://localhost/check_car/funcoes/home_funcoes/ajax_modal_detalhe_os_home.php?os_mv=754507
-- function ajax_motorista_preenche_s_r_veiculo()
