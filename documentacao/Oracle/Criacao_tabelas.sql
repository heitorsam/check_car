--FKS
--ALTER TABLE portal_custos.SOLICITACAO_MV DROP CONSTRAINT FK_CD_SOLICITACAO;

--DURABILIDADE

-- CREATE TABLE 

DROP TABLE portal_custos.DURABILIDADE;

CREATE TABLE portal_custos.DURABILIDADE(
CD_DURABILIDADE     INT NOT NULL,
CD_PRODUTO_MV       INT NOT NULL,
SN_ATIVO            VARCHAR(1),
DIAS                INT NOT NULL,
CD_USUARIO_CADASTRO VARCHAR(20) not null,
HR_CADASTRO         TIMESTAMP(6) not null,
CD_USUARIO_ULT_ALT  VARCHAR2(20),
HR_ULT_ALT          TIMESTAMP(6),

--PRIMARY_KEY
CONSTRAINT PK_CD_DURABILIDADE PRIMARY KEY (CD_DURABILIDADE),

--UNIQUE_KEY
CONSTRAINT UK_CD_PRODUTO_MV UNIQUE (CD_PRODUTO_MV)

);

--SEQUENCE  

DROP SEQUENCE portal_custos.SEQ_CD_DURABILIDADE;
CREATE SEQUENCE portal_custos.SEQ_CD_DURABILIDADE  
START WITH 1    
INCREMENT BY 1
NOCACHE
NOCYCLE;
