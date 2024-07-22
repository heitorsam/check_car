SELECT * FROM dbamv.SOLICITACAO_OS WHERE CD_OS = 883780

43550


SELECT * FROM portal_check_car.veiculo vc FOR UPDATE

UPDATE portal_check_car.veiculo vc
SET vc.KM = 212345
WHERE vc.CD_VEICULO = 11
WHERE vc.CD_VEICULO = $var_veiculo

-- AJUSTES --

--P Desenvolver tela de cadastro de veículos (nenhuma funcionalidade funciona, apenas layout, é uma copia da tela setor)
    --A Lista veiculos
    --A Inativa e Ativa Veiculos
    --A Exclui Veiculos (apenas os que não possuem ações dentro do portal)

--P Chamados finalizados no mv aparecem como pendentes no portal 
--P (isso fará com que ocorra erro ao concluir o chamado, pois a OS já está fechada)
    	 --A TP_SITUACAO da tabela dbamv.SOLICITACAO_OS deve ser igual a S
       
--P Chamados em andamento no mv aparecem como pendentes no portal 
--P (isso fará com que ocorra erro ao concluir o chamado, pois a OS já está fechada)
    	 --A TP_SITUACAO da tabela dbamv.SOLICITACAO_OS deve ser igual a S
  
--Detalhes da caixinha home só funciona na primeira dos chamados pendentes
       --A Trazer detalhes da caixinha home
       --A Incluir OS no detalhes da caixinha home
       --A Mais opções de click de detalhe caixinhas home

--P Ajuste das funcionalidades de mover chamado - (receber e finalizar chamados)
    --A Ajustes mensagem de erro exibindo kilometragem permitida

--P Exibir KM no cabeçalho
    --A Incluido KM atual no cabeçalho
    --A Incluido KM atual no cabeçalho mobile
    
--P Modal sem botão fechar e sem layout em botões
    --A Adicionado botões fechar
    --A Adicionado layouts nos botões

-- ANOTACOES --

--Jurandir
--000001261700
--@123mudar

--http://localhost/check_car/funcoes/home_funcoes/ajax_modal_detalhe_os_home.php?os_mv=754507
-- function ajax_motorista_preenche_s_r_veiculo()
