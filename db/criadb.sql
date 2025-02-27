                                                        -- SCRIPT DE CRIAÇÃO DAS TABELA DO BANCO CASAWEB
    -- CRIANDO DATABASE
    DROP DATABASE IF EXISTS CASAWEB;
    CREATE DATABASE CASAWEB;

    -- CRIANDO A TABELA DE PERFIL DE ACESSO
    DROP TABLE IF EXISTS PERFIL;
    CREATE TABLE PERFIL (
    ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    DESCRICAO VARCHAR(40) DEFAULT NULL
    );

    -- CRIANDO A TABELA DE PERFIL DE ACESSO
    DROP TABLE IF EXISTS USUARIO;
    CREATE TABLE USUARIO (
    ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    NOME VARCHAR(255) DEFAULT NULL,
    USUARIO VARCHAR(60) DEFAULT NULL,
    SENHA VARCHAR(100) DEFAULT NULL,
    PERFIL INT(11) DEFAULT NULL,
    EMAIL VARCHAR(80) DEFAULT NULL,
    IMAGEM VARCHAR(100) DEFAULT NULL,
    DATACADASTRO TIMESTAMP NOT NULL,
    ATIVO ENUM('0','1') DEFAULT '0',
    FOREIGN KEY (PERFIL) REFERENCES PERFIL(ID)
    );

    -- CRIANDO A TABELA DE TIPOIMOVEL
    DROP TABLE IF EXISTS TIPOIMOVEL;
    CREATE TABLE TIPOIMOVEL (
    ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    DESCRICAO VARCHAR(40)  DEFAULT NULL
    );

    -- CRIANDO A TABELA DE FINALIDADE
    DROP TABLE IF EXISTS FINALIDADE;
    CREATE TABLE FINALIDADE (
    ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    DESCRICAO VARCHAR(30) DEFAULT NULL
    );

    -- CRIANDO A TABELA DE PROPRIETARIO
    DROP TABLE IF EXISTS PROPRIETARIO;
    CREATE TABLE PROPRIETARIO (
    ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    NOME VARCHAR(255)  DEFAULT NULL, 
    CONTATO VARCHAR(14) DEFAULT NULL,
    SEXO ENUM('M','F') DEFAULT NULL,
    ATIVO ENUM('0','1') DEFAULT NULL
    );

    -- CRIANDO A TABELA DE IMOVEL
    DROP TABLE IF EXISTS IMOVEL;
    CREATE TABLE IMOVEL (
    ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    CODIGO VARCHAR(6)  DEFAULT NULL, 
    VALOR DECIMAL(10,2) DEFAULT NULL,
    CEP VARCHAR(100) DEFAULT NULL,
    LOGRADOURO VARCHAR(100) DEFAULT NULL,
    BAIRRO VARCHAR(100) DEFAULT NULL,
    CIDADE VARCHAR(100) DEFAULT NULL,
    QUARTOS VARCHAR(2) DEFAULT NULL,
    BANHEIROS VARCHAR(2) DEFAULT NULL,
    GARAGEM VARCHAR(2) DEFAULT NULL,
    IMAGEMCAPA VARCHAR(40) DEFAULT NULL,
    AREATOTAL DECIMAL(10,0) DEFAULT NULL,
    AREACONSTRUIDA DECIMAL(10,0) DEFAULT NULL,
    ESTATUS ENUM('0','1') DEFAULT NULL, 
    DATACADASTRO TIMESTAMP  NOT NULL,
    TIPOIMOVEL INT(11) DEFAULT NULL,
    FINALIDADE INT(11) DEFAULT NULL,
    PROPRIETARIO INT(11) DEFAULT NULL,
    UNIQUE KEY COD_IMOVEL (CODIGO),
    FOREIGN KEY (TIPOIMOVEL) REFERENCES TIPOIMOVEL(ID),
    FOREIGN KEY (FINALIDADE) REFERENCES FINALIDADE(ID),
    FOREIGN KEY (PROPRIETARIO) REFERENCES PROPRIETARIO(ID)
    );

    -- CRIANDO A TABELA DE IMAGEMIMOVEL
    DROP TABLE IF EXISTS IMAGEMIMOVEL;
    CREATE TABLE IMAGEMIMOVEL (
    ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    IMAGEM VARCHAR(255) DEFAULT NULL,
    IMOVEL INT(11) DEFAULT NULL,
    FOREIGN KEY (IMOVEL) REFERENCES IMOVEL(ID)
    );

    -- INSERINDO DADOS NA TABELA DE PERFIL DE ACESSO
    INSERT INTO PERFIL
    VALUES (0, 'ADMINISTRADOR'), (0, 'USUARIO');

    -- INSERINDO DADOS NA TABELA TIPOIMOVEL
    INSERT INTO TIPOIMOVEL 
    VALUES (0,'CASA'), (0,'APARTAMENTO'), (0,'CHACARA'), (0,'EDICULA'), (0,'BARRACAO');

    -- INSERINDO DADOS NA TABELA FINALIDADE
    INSERT INTO FINALIDADE 
    VALUES (0,'VENDA'), (0,'LOCACAO');
