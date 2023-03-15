--CREATE TABLES PORTAL CHECK CAR --- 
--TABELAS CRIADAS EM: 15/03/2023 13:00 
--CRIADAS POR: RAFAEL YASSER

--DISATIVANDO TODAS AS FK'S
ALTER TABLE portal_check_car.VEICULO DISABLE CONSTRAINT FK_CD_COR;
ALTER TABLE portal_check_car.ITCHECKLIST DISABLE CONSTRAINT FK_CD_CHECKLIST;
ALTER TABLE portal_check_car.ITCHECKLIST DISABLE CONSTRAINT FK_CD_ITEM_VEICULO;

----------------------------------------------
DROP TABLE portal_check_car.COR;

CREATE TABLE portal_check_car.COR(
       CD_COR INT NOT NULL,
       DS_COR VARCHAR(30) NOT NULL,
       DS_RGB VARCHAR(20) NOT NULL,
       CD_USUARIO_CADASTRO VARCHAR(20) NOT NULL,
       HR_CADASTRO TIMESTAMP(6) NOT NULL,
       CD_USUARIO_ULT_ALT VARCHAR(20),
       HR_ULT_ALT TIMESTAMP(6),

       --PRIMARY_KEY
       CONSTRAINT PK_CD_COR PRIMARY KEY (CD_COR)

);

DROP SEQUENCE portal_check_car.SEQ_CD_COR;
CREATE SEQUENCE portal_check_car.SEQ_CD_COR
START WITH 1    
INCREMENT BY 1
NOCACHE
NOCYCLE;

---------------------------------------------
DROP TABLE portal_check_car.VEICULO;

CREATE TABLE portal_check_car.VEICULO(

       CD_VEICULO INT NOT NULL,
       DS_MODELO VARCHAR(50) NOT NULL,
       DS_ANO VARCHAR(20) NOT NULL,
       DS_PLACA VARCHAR(10) NOT NULL,
       CD_COR INT NOT NULL, --FK TABELA portal_check_car.COR
       KM INT NOT NULL,
       CD_USUARIO_CADASTRO VARCHAR(20) NOT NULL,
       HR_CADASTRO TIMESTAMP(6) NOT NULL,
       CD_USUARIO_ULT_ALT VARCHAR(20),
       HR_ULT_ALT TIMESTAMP(6),

       --PRIMARY_KEY
       CONSTRAINT PK_CD_VEICULO PRIMARY KEY (CD_VEICULO),
       
       --FOREIGN KEY
       CONSTRAINT FK_CD_COR FOREIGN KEY (CD_COR) REFERENCES portal_check_car.COR(CD_COR)
         
);

DROP SEQUENCE portal_check_car.SEQ_CD_VEICULO;
CREATE SEQUENCE portal_check_car.SEQ_CD_VEICULO
START WITH 1    
INCREMENT BY 1
NOCACHE
NOCYCLE;

------------------------------------------
DROP TABLE portal_check_car.USUARIO;

CREATE TABLE portal_check_car.USUARIO(
       CD_USUARIO INT NOT NULL,
       CD_USUARIO_MV VARCHAR(20) NOT NULL,
       TP_PLANTAO VARCHAR(1),
       BLOB_FOTO BLOB,
       CD_USUARIO_CADASTRO VARCHAR(20) NOT NULL,
       HR_CADASTRO TIMESTAMP(6) NOT NULL,
       CD_USUARIO_ULT_ALT VARCHAR(20),
       HR_ULT_ALT TIMESTAMP(6),
       
       --PRIMARY KEY
       CONSTRAINT PK_CD_USUARIO PRIMARY KEY (CD_USUARIO)
);

DROP SEQUENCE portal_check_car.SEQ_CD_USUARIO;
CREATE SEQUENCE portal_check_car.SEQ_CD_USUARIO
START WITH 1    
INCREMENT BY 1
NOCACHE
NOCYCLE;

---------------------------------------------
DROP TABLE portal_check_car.PAPEL

CREATE TABLE portal_check_car.PAPEL(
       CD_PAPEL INT NOT NULL,
       CD_USUARIO INT NOT NULL,
       TP_PERMISSAO VARCHAR(1) NOT NULL,
       DS_CNH VARCHAR(20),
       CD_USUARIO_CADASTRO VARCHAR(20) NOT NULL,
       HR_CADASTRO TIMESTAMP(6) NOT NULL,
       CD_USUARIO_ULT_ALT VARCHAR(20),
       HR_ULT_ALT TIMESTAMP(6),
       
       --PRIMARY KEY
       CONSTRAINT PK_CD_PAPEL PRIMARY KEY (CD_PAPEL)

);

DROP SEQUENCE portal_check_car.SEQ_CD_PAPEL;
CREATE SEQUENCE portal_check_car.SEQ_CD_PAPEL
START WITH 1    
INCREMENT BY 1
NOCACHE
NOCYCLE;

----------------------------------------------
DROP TABLE portal_check_car.CHECKLIST 

CREATE TABLE portal_check_car.CHECKLIST(
       CD_CHECKLIST INT NOT NULL,
       TP_CHECKLIST VARCHAR(1) NOT NULL,
       CD_VEICULO INT NOT NULL,
       TP_PLANTAO VARCHAR(1) NOT NULL,
       OBS_GERAL VARCHAR(200) NOT NULL,
       CD_USUARIO_CADASTRO VARCHAR(20) NOT NULL,
       HR_CADASTRO TIMESTAMP(6) NOT NULL,
       CD_USUARIO_ULT_ALT VARCHAR(20),
       HR_ULT_ALT TIMESTAMP(6),
       
       --PRIMARY KEY
       CONSTRAINT PK_CD_CHECKLIST PRIMARY KEY (CD_CHECKLIST)
);

DROP SEQUENCE portal_check_car.SEQ_CD_CHECKLIST;
CREATE SEQUENCE portal_check_car.SEQ_CD_CHECKLIST
START WITH 1    
INCREMENT BY 1
NOCACHE
NOCYCLE;

-----------------------------------------------
DROP TABLE portal_check_car.ITEM_VEICULO

CREATE TABLE portal_check_car.ITEM_VEICULO(
       CD_ITEM_VEICULO INT NOT NULL,
       SN_PADRAO VARCHAR(1) NOT NULL,
       DS_ITEM_VEICULO VARCHAR(100) NOT NULL,
       CD_USUARIO_CADASTRO VARCHAR(20) NOT NULL,
       HR_CADASTRO TIMESTAMP(6) NOT NULL,
       CD_USUARIO_ULT_ALT VARCHAR(20),
       HR_ULT_ALT TIMESTAMP(6),
       
       --PRIMARY KEY
       CONSTRAINT PK_CD_ITEM_VEICULO PRIMARY KEY (CD_ITEM_VEICULO)
);

DROP SEQUENCE portal_check_car.SEQ_CD_ITEM_VEICULO;
CREATE SEQUENCE portal_check_car.SEQ_CD_ITEM_VEICULO
START WITH 1    
INCREMENT BY 1
NOCACHE
NOCYCLE;

-------------------------------------------------
DROP TABLE portal_check_car.ITCHECKLIST

CREATE TABLE portal_check_car.ITCHECKLIST(
       CD_ITCHECKLIST INT NOT NULL,
       CD_CHECKLIST INT NOT NULL, --FK TABELA portal_check_car.CHECKLIST
       CD_ITEM_VEICULO INT NOT NULL, --FK TABELA portal_check_car.ITEM_VEICULO
       DS_RESPOSTA VARCHAR(20) NOT NULL,
       DS_OBSERVACAO VARCHAR(200) NOT NULL,
       CD_USUARIO_CADASTRO VARCHAR(20) NOT NULL,
       HR_CADASTRO TIMESTAMP(6) NOT NULL,
       CD_USUARIO_ULT_ALT VARCHAR(20),
       HR_ULT_ALT TIMESTAMP(6),
       
       --PRIMARY KEY
       CONSTRAINT PK_CD_ITCHECKLIST PRIMARY KEY (CD_ITCHECKLIST),
       
       --FOREIGN KEY TABELA CHECKLIST
       CONSTRAINT FK_CD_CHECKLIST FOREIGN KEY (CD_CHECKLIST) REFERENCES portal_check_car.CHECKLIST(CD_CHECKLIST),
       
       --FOREIGN KEY TABELA ITEM VEICULO
       CONSTRAINT FK_CD_ITEM_VEICULO FOREIGN KEY (CD_ITEM_VEICULO) REFERENCES portal_check_car.ITEM_VEICULO(CD_ITEM_VEICULO)
);

DROP SEQUENCE portal_check_car.SEQ_CD_ITCHECKLIST;
CREATE SEQUENCE portal_check_car.SEQ_CD_ITCHECKLIST
START WITH 1
INCREMENT BY 1
NOCACHE
NOCYCLE;

portal_check_car.