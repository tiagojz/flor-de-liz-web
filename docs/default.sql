-- RESET DATABASE
DROP SCHEMA public CASCADE;
CREATE SCHEMA public;
SET datestyle to 'SQL, DMY';

-- CREATEs
CREATE SEQUENCE seq_colecao START 1;
CREATE SEQUENCE seq_calcado START 1;
CREATE SEQUENCE seq_cliente START 1;
CREATE SEQUENCE seq_producao START 1;

CREATE TABLE colecao (
  codigo integer NOT NULL DEFAULT nextval('seq_colecao'),
  nome varchar(50) NOT NULL,
  PRIMARY KEY (codigo)
);

CREATE TABLE calcado (
  codigo integer NOT NULL DEFAULT nextval('seq_calcado'),
  nome varchar(50) NOT NULL,
  colecao integer NOT NULL,
  menor_tamanho integer NOT NULL,
  maior_tamanho integer NOT NULL,
  valor numeric(10, 2) NOT NULL,
  cor int NOT NULL,
  imagem varchar(50),
  PRIMARY KEY (codigo),
  FOREIGN KEY (colecao) REFERENCES colecao (codigo)
);

CREATE TABLE cliente (
  codigo integer NOT NULL DEFAULT nextval('seq_cliente'),
  nome_cliente varchar(50) NOT NULL,
  nome_loja varchar(50) NOT NULL,
  cnpj_cliente varchar(18) NOT NULL,
  cpf_proprietario_loja varchar(14) NOT NULL,
  telefone_contato varchar(20) NOT NULL,
  logradouro varchar(50) NOT NULL,
  numero integer NOT NULL,
  bairro varchar(50) NOT NULL,
  complemento varchar(50),
  cep varchar(9),
  cidade varchar(50) NOT NULL,
  uf varchar(2) NOT NULL,
  PRIMARY KEY (codigo)
);

CREATE TABLE producao (
  codigo integer NOT NULL DEFAULT nextval('seq_producao'),
  calcado integer NOT NULL,
  tamanho integer NOT NULL,
  quantidade integer NOT NULL,
  data_producao timestamp,
  situacao integer NOT NULL,
  PRIMARY KEY (codigo),
  FOREIGN KEY (calcado) REFERENCES calcado (codigo)
);

-- INCLUDEs
INSERT INTO colecao (nome) VALUES
('Primavera'),
('Verão'),
('Outono'),
('Inverno');

INSERT INTO calcado (nome, colecao, menor_tamanho, maior_tamanho, valor, cor, imagem) VALUES
('Bota Fiero Anabela Forrada Em Lã Café', 4, 34, 39, 349.90, 7294519, 'calcado-1.jpg'),
('Tênis Nike Metcon Repper DSX Preto', 2, 35, 43, 399.90, 5466226, 'calcado-2.jpg'),
('Tênis Kolosh Amarração Azul', 1, 34, 41, 139.90, 28927, 'calcado-3.jpg'),
('Sapato Mr. Kitsch Le Mans Preto', 3, 38, 44, 179.90, 1051656, 'calcado-4.jpg'),
('Tênis Mizuno Wave Frontier 10 P Preto/Verde/Prata', 2, 38, 44, 439.99, 11009024, 'calcado-5.jpg');

INSERT INTO cliente
(nome_cliente, nome_loja, cnpj_cliente, cpf_proprietario_loja, telefone_contato, logradouro, numero, bairro, cep, cidade, uf)
VALUES
('João Heitor Joaquim Castro', 'Joaquim Calçados LTDA', '58.270.422/0001-67', '639.299.202-20', '(65) 2877-5657', 'Rua Sorriso', 244, 'Parque Amperco', '78042-030', 'Cuiabá', 'MT'),
('Agatha Ester Campos', 'Calçados D''Agatha INC.', '81.768.471/0001-46', '942.102.529-64', '(82) 2913-7546', 'Rua Sargento Chocolate', 835, 'Guaribas', '57303-731', 'Arapiraca', 'AL'),
('Diego Lorenzo Barbosa', 'Barbosa Calçados S.A.', '02.172.926/0001-90', '350.154.868-04', '(62) 98734-9225', 'Avenida Acary Passos', 903, 'Conjunto Residencial Aruanã III', '74740-350', 'Goiânia', 'GO'),
('Rafaela Antonella Araújo', 'Fashion''s Antonella', '53.549.536/0001-27', '351.796.600-25', '(67) 98709-8060', 'Rua J', 561, 'Conjunto Habitacional Terra Roxa', '79840-540', 'Dourados', 'MS'),
('Pietro André Campos', 'Campos e Calçados', '10.681.281/0001-49', '456.715.441-06', '(83) 99190-7042', 'Rua Silva Barbosa', 486, 'Universitário', '58429-160', 'Campina Grande', 'PB'),
('Ana Antonella Clara Cardoso', 'Claralçados e Cia', '00.746.411/0001-20', '315.594.106-55', '(91) 99290-4590', 'Rua Joaquim Gonçalves', 967, 'Promissão III', '68628-527', 'Paragominas', 'PA'),
('Luiza Bianca Barbosa', 'Sapataria Luiza', '20.319.923/0001-18', '240.001.554-66', '(86) 98197-6023', 'Rua Gislaine Maria Prado', 957, 'São João', '64045-415', 'Teresina', 'PI'),
('Carolina Alícia Helena Costa', 'Helena Dospé', '40.393.784/0001-80', '847.188.859-90', '(68) 98655-5811', 'Travessa Mel', 539, 'Eldorado', '69902-503', 'Rio Branco', 'AC'),
('Raul Ryan Pedro Pereira', 'Rual Ryan & Ryder LDTA', '57.371.386/0001-65', '914.191.053-29', '(92) 98859-8497', 'Vila Dorinha', 632, 'Centro', '69020-278', 'Manaus', 'AM');