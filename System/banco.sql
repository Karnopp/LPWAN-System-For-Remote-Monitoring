
create database sistemaTCC;
use sistemaTCC;

create table usuario(
	cod serial,
	nome varchar(50) not null,
	login varchar(50) not null,
	senha varchar(18) not null,
	funcao varchar(20) not null,
	chat_id_telegram varchar(20),
	primary key (cod)
);

create table nivel_agua(
	cod serial,
	nivel varchar(20),
	temperatura float,
	dia date,
	horario time,
	primary key (cod)
);

create table caixa_abelha(
	cod serial,
	peso varchar(20),
	umidade varchar(20),
	dia date,
	horario time,
	primary key (cod)
);

create table alerta(
	cod serial,
	mensagem varchar(99),
	dia date,
	horario time,
	cor varchar(12),
	primary key (cod)
);

INSERT INTO usuario (login, senha, nome, funcao) VALUES ('master', 'master', 'master', 'administrador');
