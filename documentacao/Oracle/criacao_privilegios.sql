CREATE USER portal_check_car IDENTIFIED BY sjc_canguru_09_03_2023;

GRANT CREATE SESSION TO portal_check_car;
GRANT CREATE PROCEDURE TO portal_check_car;
GRANT CREATE TABLE TO portal_check_car;
GRANT CREATE VIEW TO portal_check_car;
GRANT UNLIMITED TABLESPACE TO portal_check_car;
GRANT CREATE SEQUENCE TO portal_check_car;

GRANT SELECT ON portal_projetos.SEQ_CD_ACESSO TO portal_check_car;
GRANT INSERT ON portal_projetos.ACESSO TO portal_check_car;

GRANT EXECUTE ON dbasgu.FNC_MV2000_HMVPEP TO portal_check_car;

GRANT SELECT ON dbasgu.USUARIOS TO portal_check_car;
GRANT SELECT ON dbasgu.PAPEL_USUARIOS TO portal_check_car;

GRANT SELECT ON dbamv.SOLICITACAO_OS TO portal_check_car;
GRANT SELECT ON dbamv.ITSOLICITACAO_OS TO portal_check_car;

GRANT UPDATE ON dbamv.SOLICITACAO_OS TO portal_check_car;
GRANT UPDATE ON dbamv.ITSOLICITACAO_OS TO portal_check_car;

