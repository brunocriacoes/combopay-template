CREATE TABLE integracao (
    id int not null auto_increment primary key,
    instituicao_id int not null,
    tipo varchar(75),
    identificacao_id varchar(255),
    chave varchar(255),
    token varchar(255)
);

CREATE TABLE inscrito (
    id int not null auto_increment primary key,
    instituicao_id int not null,
    nome varchar(145),
    telefone varchar(75),
    email varchar(145)
);

CREATE TABLE recuperacao_doacao (
    id int not null auto_increment primary key,
    instituicao_id int not null,
    token int,
    nome varchar(175),
    email varchar(175),
    valor int,
    callback varchar(255),
    data_para_envio varchar(25)
);

CREATE TABLE doacao (
    id int not null auto_increment primary key,
    instituicao_id int not null,
    pano_id int,
    token int,
    nome varchar(175),
    email varchar(175),
    telefone varchar(20),
    valor int,
    codigo varchar(175),
    status varchar(175),
    boleto_url varchar(255),
    boleto_codigo varchar(255),
    pix varchar(255),
    callback varchar(255)
    data_registro varchar(25)
);

CREATE TABLE smtp (
    id int not null auto_increment primary key,
    instituicao_id int not null,
    host varchar(255),
    porta int,
    usuario varchar(255),
    senha varchar(255),
    nome varchar(75)
);



CREATE TABLE template_email (
    id int not null auto_increment primary key,
    instituicao_id int not null,
    titulo varchar(75),
    conteudo text,
    categoria_id int,
    status int,
    minutos int
);

CREATE TABLE categoria (
    id int not null auto_increment primary key,
    titulo varchar(75),
);


CREATE TABLE instituicao (
    id int not null  auto_increment primary key,
    razao_social varchar(175),
    nome_fantasia varchar(175),
    email varchar(175),
    telefone varchar(75),
    rua varchar(175),
    cidade varchar(145),
    estado varchar(55),
    bairro varchar(175),
    complemento varchar(20),
    cnpj varchar(55),
    subdominio varchar(175),
    dominio varchar(175),
    dominio_personalizado varchar(175),
    created_at varchar(55),
    updated_at varchar(55)
    ativo varchar(20),
    cep varchar(55),
    atividade varchar(20),
    recebedor_id int,
    admin_master varchar(75),
    anotacao varchar(255),
);

CREATE TABLE configuracao (
    id
    instituicao_id
    flag
    base64
    ativo
    created_at
    updated_at
);