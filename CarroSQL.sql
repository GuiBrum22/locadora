-- Gera��o de Modelo f�sico
-- Sql ANSI 2003 - brModelo.



CREATE TABLE Cliente (
CNH Descimal(7,2),
Nome VARCHAR(255),
Identifica��o PRIMARY KEY PRIMARY KEY,
Telefone Descimal(10,2)
)

CREATE TABLE Agencia (
NumeroAgencia PRIMARY KEY PRIMARY KEY,
Endereco VARCHAR(255),
Contato VARCHAR(100)
)

CREATE TABLE Aluga (
Identifica��o PRIMARY KEY,
FOREIGN KEY(Identifica��o) REFERENCES Cliente (Identifica��o)
)

CREATE TABLE Carro (
Placa CHAR(7),
Modelo VARCHAR(50),
Ano Descimal(10,2),
NumeroAgencia N�mero(4)/*falha: chave estrangeira*/
)

CREATE TABLE Pertence (

)

