-- Localização

CREATE TABLE LOCALIZACAO (
    ID_LOCALIZACAO NUMBER(10,0) NOT NULL,
    NM_LOCALIZACAO VARCHAR2(50) NOT NULL,
    DS_LOCALIZACAO VARCHAR2(50) NOT NULL,
    CONSTRAINT LOCALIZACAO_ID_LOCALIZACAO_PRI PRIMARY KEY ( ID_LOCALIZACAO )
);
ALTER TABLE LOCALIZACAO ADD CONSTRAINT UK_LOCALIZACAO UNIQUE ( NM_LOCALIZACAO );

CREATE SEQUENCE SEQ_ID_LOCALIZACAO START WITH 1;

CREATE TRIGGER TG_ID_LOCALIZACAO
    BEFORE INSERT OR UPDATE ON LOCALIZACAO
    FOR EACH ROW
        BEGIN
    IF INSERTING AND :NEW.ID_LOCALIZACAO IS NULL THEN
        SELECT SEQ_ID_LOCALIZACAO.NEXTVAL INTO :NEW.ID_LOCALIZACAO FROM DUAL;
    END IF;
END;

-- Extração
CREATE TABLE EXTRACAO (
    ID_EXTRACAO NUMBER(10,0) NOT NULL,
    SG_EXTRACAO CHAR(2) NOT NULL,
    NM_EXTRACAO VARCHAR2(8) NOT NULL,
    DS_EXTRACAO VARCHAR2(100) NOT NULL,
    ST_ATIVO CHAR(1) DEFAULT 'A' NOT NULL,
    CONSTRAINT EXTRACAO_ID_EXTRACAO_PRIMARY PRIMARY KEY ( ID_EXTRACAO )
);

ALTER TABLE EXTRACAO ADD CONSTRAINT UK_EXTRACAO_SGEXTRACAO UNIQUE ( SG_EXTRACAO );

CREATE SEQUENCE SEQ_ID_EXTRACAO START WITH 1;

CREATE TRIGGER TG_ID_EXTRACAO
    BEFORE INSERT OR UPDATE ON EXTRACAO
    FOR EACH ROW
        BEGIN
    IF INSERTING AND :NEW.ID_EXTRACAO IS NULL THEN
        SELECT SEQ_ID_EXTRACAO.NEXTVAL INTO :NEW.ID_EXTRACAO FROM DUAL;
    END IF;
END;

-- Tipo de Arquivo

CREATE TABLE TIPO_ARQUIVO (
    ID_TIPO_ARQUIVO NUMBER(10,0) NOT NULL,
    ID_EXTRACAO NUMBER(10,0) NOT NULL,
    ID_LOCALIZACAO NUMBER(10,0) NOT NULL,
    SG_TIPO_ARQUIVO CHAR(5) NOT NULL,
    NM_TIPO_ARQUIVO VARCHAR2(50) NOT NULL,
    DS_EXPRESSAO_REGULAR VARCHAR2(70) NOT NULL,
    ST_ATIVO CHAR(1) DEFAULT 'A' NOT NULL,
    CONSTRAINT TIPO_ARQUIVO_ID_EXTRACAO_FOREI FOREIGN KEY ( ID_EXTRACAO ) REFERENCES EXTRACAO ( ID_EXTRACAO ),
    CONSTRAINT TIPO_ARQUIVO_ID_LOCALIZACAO_FO FOREIGN KEY ( ID_LOCALIZACAO ) REFERENCES LOCALIZACAO ( ID_LOCALIZACAO ),
    CONSTRAINT TIPO_ARQUIVO_ID_TIPO_ARQUIVO_P PRIMARY KEY ( ID_TIPO_ARQUIVO )
);

ALTER TABLE TIPO_ARQUIVO ADD CONSTRAINT UK_TIPO_ARQUIVO_SGTIPOARQUIVO UNIQUE ( SG_TIPO_ARQUIVO );

ALTER TABLE TIPO_ARQUIVO ADD CONSTRAINT UK_TIPO_DSEXPRESSAOREGL UNIQUE ( DS_EXPRESSAO_REGULAR );


CREATE SEQUENCE SEQ_ID_TIPO_ARQUIVO START WITH 1;

CREATE TRIGGER TG_ID_TIPO_ARQUIVO
    BEFORE INSERT OR UPDATE ON TIPO_ARQUIVO
    FOR EACH ROW
        BEGIN
    IF INSERTING AND :NEW.ID_TIPO_ARQUIVO IS NULL THEN
        SELECT SEQ_ID_TIPO_ARQUIVO.NEXTVAL INTO :NEW.ID_TIPO_ARQUIVO FROM DUAL;
    END IF;
END;

 --  Arquivo Recebido

CREATE TABLE ARQUIVO_RECEBIDO (
    ID_ARQUIVO_RECEBIDO NUMBER(10,0) NOT NULL,
    ID_TIPO_ARQUIVO NUMBER(10,0) NOT NULL,
    NM_ARQUIVO VARCHAR2(100) NOT NULL,
    QTD_LINHAS NUMBER(10,0) NULL,
    DT_RECEBIMENTO DATE NOT NULL,
    DT_HORA_CADASTRO TIMESTAMP NOT NULL,
    CONSTRAINT ARQUIVO_RECEBIDO_ID_TIPO_ARQUI FOREIGN KEY ( ID_TIPO_ARQUIVO ) REFERENCES TIPO_ARQUIVO ( ID_TIPO_ARQUIVO ),
    CONSTRAINT ARQUIVO_RECEBIDO_ID_ARQUIVO_RE PRIMARY KEY ( ID_ARQUIVO_RECEBIDO )
);

ALTER TABLE ARQUIVO_RECEBIDO ADD CONSTRAINT UK_NMARQUIVO UNIQUE ( NM_ARQUIVO );

CREATE SEQUENCE SEQ_ID_ARQUIVO_RECEBIDO START WITH 1;

CREATE TRIGGER TG_ID_ARQUIVO_RECEBIDO
    BEFORE INSERT OR UPDATE ON ARQUIVO_RECEBIDO
    FOR EACH ROW
        BEGIN
    IF INSERTING AND :NEW.ID_ARQUIVO_RECEBIDO IS NULL THEN
        SELECT SEQ_ID_ARQUIVO_RECEBIDO.NEXTVAL INTO :NEW.ID_ARQUIVO_RECEBIDO FROM DUAL;
    END IF;
END;

-- Credencial

CREATE TABLE CREDENCIAL (
    ID_CREDENCIAL NUMBER(10,0) NOT NULL,
    NM_USUARIO VARCHAR2(100) NOT NULL,
    DS_NOME VARCHAR2(250) NOT NULL,
    DS_EMAIL VARCHAR2(200) NOT NULL,
    NR_CPF CLOB NOT NULL,
    DS_SENHA CLOB NOT NULL,
    ST_ATIVO CHAR(1) DEFAULT 'I' NOT NULL,
    ST_DELETADO CHAR(1) DEFAULT 'N' NOT NULL,
    DT_CRIADO TIMESTAMP NOT NULL,
    DT_ATUALIZADO TIMESTAMP NULL,
    CONSTRAINT CREDENCIAL_ID_CREDENCIAL_PRIMA PRIMARY KEY ( ID_CREDENCIAL )
);

ALTER TABLE CREDENCIAL ADD CONSTRAINT UK_USUARIO UNIQUE ( NM_USUARIO );

CREATE SEQUENCE SEQ_ID_CREDENCIAL START WITH 1;

CREATE TRIGGER TG_ID_CREDENCIAL
    BEFORE INSERT OR UPDATE ON CREDENCIAL
    FOR EACH ROW
        BEGIN
    IF INSERTING AND :NEW.ID_CREDENCIAL IS NULL THEN
        SELECT SEQ_ID_CREDENCIAL.NEXTVAL INTO :NEW.ID_CREDENCIAL FROM DUAL;
    END IF;
END;

 -- Status Execução

CREATE TABLE EXECUCAO_STATUS (
    ID_EXECUCAO_STATUS NUMBER(10,0) NOT NULL,
    NM_EXECUCAO_STATUS VARCHAR2(50) NOT NULL,
    CONSTRAINT EXECUCAO_STATUS_ID_EXECUCAO_ST PRIMARY KEY ( ID_EXECUCAO_STATUS )
);

CREATE SEQUENCE SEQ_ID_EXECUCAO_STATUS START WITH 1;

CREATE TRIGGER TG_ID_EXECUCAO_STATUS
    BEFORE INSERT OR UPDATE ON EXECUCAO_STATUS
    FOR EACH ROW
        BEGIN
    IF INSERTING AND :NEW.ID_EXECUCAO_STATUS IS NULL THEN
        SELECT SEQ_ID_EXECUCAO_STATUS.NEXTVAL INTO :NEW.ID_EXECUCAO_STATUS FROM DUAL;
    END IF;
END;

--  Auditoria

CREATE TABLE AUDITORIA (
    ID_AUDITORIA NUMBER(10,0) NOT NULL,
    ID_CREDENCIAL NUMBER(10,0) NOT NULL,
    ID_TIPO_ARQUIVO NUMBER(10,0) NOT NULL,
    ID_ARQUIVO_RECEBIDO NUMBER(10,0) NULL,
    ID_EXECUCAO_STATUS NUMBER(10,0) NOT NULL,
    DT_EXECUCAO TIMESTAMP NOT NULL,
    CONSTRAINT AUDITORIA_ID_CREDENCIAL_FOREIG FOREIGN KEY ( ID_CREDENCIAL ) REFERENCES CREDENCIAL ( ID_CREDENCIAL ),
    CONSTRAINT AUDITORIA_ID_TIPO_ARQUIVO_FORE FOREIGN KEY ( ID_TIPO_ARQUIVO ) REFERENCES TIPO_ARQUIVO ( ID_TIPO_ARQUIVO ),
    CONSTRAINT AUDITORIA_ID_ARQUIVO_RECEBIDO_ FOREIGN KEY ( ID_ARQUIVO_RECEBIDO ) REFERENCES ARQUIVO_RECEBIDO ( ID_ARQUIVO_RECEBIDO ),
    CONSTRAINT AUDITORIA_ID_EXECUCAO_STATUS_F FOREIGN KEY ( ID_EXECUCAO_STATUS ) REFERENCES EXECUCAO_STATUS ( ID_EXECUCAO_STATUS ),
    CONSTRAINT AUDITORIA_ID_AUDITORIA_PRIMARY PRIMARY KEY ( ID_AUDITORIA )
);

CREATE SEQUENCE SEQ_ID_AUDITORIA START WITH 1;

CREATE TRIGGER TG_ID_AUDITORIA
    BEFORE INSERT OR UPDATE ON AUDITORIA
    FOR EACH ROW
        BEGIN
    IF INSERTING AND :NEW.ID_AUDITORIA IS NULL THEN
        SELECT SEQ_ID_AUDITORIA.NEXTVAL INTO :NEW.ID_AUDITORIA FROM DUAL;
    END IF;
END;
