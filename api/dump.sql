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
    callback varchar(255),
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
    anotacao varchar(255)
);

CREATE TABLE configuracao (
    id int not null  auto_increment primary key,
    instituicao_id
    flag
    base64
    ativo
    created_at
    updated_at
);


CREATE TABLE split_configs (
    id int not null  auto_increment primary key,
    responsavel varchar(55),
    instituicao_id int,
    recebedor_id int,
    porcetagem int,
    restos_taxas int,
    created_at varchar(55),
    updated_at varchar(55)
);


















































CREDENCIAL (
    nome
    recursos
    criado_em
    atualizado_em
)


USUÁRIO (
    email
    ativo
    nome
    sobrenome
    telefone
    senha
    foto
    credencial
    cpf
    data_nascimento
    criado_em
    atualizado_em
)

MEU PLANO (
    plan_id
    status
    customer_id
    usuario_id
)

TABELA TAXONOMIA PLANOS (
    id_instituicao
    meu_plano_id
)

TABELA TAXONOMIA (
    id_usuario
    id_instituicao
    tipo
)

RECEBEDORES (
    id_recebedor
    endereco
    banco
    agencia
)

MODULOS (
    tipo
    token
    chave
    secret
    criado_em
    atualizado_em
)

INSCRITOS (
    nome
    email
    telefone
    id_instituicao
)

INSTITUIÇÃO (
    ativo
    email
    cnpj
    razao_social
    nome_fantasia
    telefone
    subdominio
    dominio
    qr_code
    recebedor_id
    id_carteira
    criado_em
    atualizado_em
)

SPLIT (
    instituicao_id
    recebedor_id
    resto_taxas
    responsavel
    porcentagem
    criado_em
    atualizado_em
)

EMAILS (
    instituicao_id
    tipo
    titulo
    assunto
    corpo
    cron
)

DOAÇÃO (
    instituicao_id
    doador_id
    transacao_id
    status
    tipo
    plano_id
    valor
    codigo_barras
    url_boleto
    codigo_pix
    url_qrcode
    criado_em
    atualizado_em
)

DOADOR (
    email
    senha
    nome
    telefone
    cpf
    customer_id
    criado_em
    atualizado_em
)

ENDERECOS (
    referencia_id
    cep
    pais
    estado
    cidade
    bairro
    rua
    complemento
    numero
)

SMTP (
    instituicao_id
    host
    protocolo
    porta
    email
    senha
    logo
    cor
    nome
)

PLANOS (
    ativo
    nome
    prazo
    quantia
    instituicao_id
)

ASSINATURA (
    doador_id
    subscription_id
    plan_id
    status
    ativo
    criado_em
)

TRANSAÇÕES (
    instituicao_id
    metodo
    plan_id
    valor
    id_doador
    token
    reference_key
    status
    id_transacao
    url_boleto
    cod_boleto
    cod_pix
    url_pix
    data_criado
    id_cartao
    id_endereco
)

DASHBOARD (
    instituicao_id
    total_doacoes
    doacoes_concluidas
    doacoes_em_aberto
    doacoes_vencidas
    boletos_em_aberto
    boletos_pagos
    creditos_em_aberto
    creditos_pagos
    pix_em_aberto
    pix_pago
    doacoes_previstas
    novos_doadores
    doadores_recorrentes
    doadores_unicos
    doacao_media
    doadores_adimplentes
    doadores_inadimplentes
    metas
    total_cartao
    total_boleto
    total_pix
)

CARTÕES (
    token
    doador_id
    n_cartao
    data_expiracao
)

METAS (
    ano
    instituicao_id
    janeiro
    fevereiro
    marco
    abril
    maio
    junho
    julho
    agosto
    setembro
    outubro
    novembro
    dezembro
)


log_emails (
    
)

log_webhooks (
    
)

log_evendas (
    
)

log_rdstation (
    
)
