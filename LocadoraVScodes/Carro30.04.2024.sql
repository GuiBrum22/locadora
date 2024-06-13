-- Tabela Carro
-- Tabela Carro
CREATE TABLE Carro (
    Id_carro SERIAL PRIMARY KEY,
    Modelo VARCHAR(100) NOT NULL,
    Placa VARCHAR(10) UNIQUE NOT NULL,
    Ano INT NOT NULL,
    Tipo VARCHAR(50) NOT NULL,
    Disponibilidade BOOLEAN DEFAULT TRUE
);

ALTER TABLE Carro ADD COLUMN potencia VARCHAR(50);
ALTER TABLE Carro ADD COLUMN motor VARCHAR(50);
ALTER TABLE Carro ADD COLUMN imagem VARCHAR(255);

-- Tabela Cliente
CREATE TABLE Cliente (
    Id_cliente SERIAL PRIMARY KEY,
    Sobrenome VARCHAR(255),
    Nome VARCHAR(255) NOT NULL,
    Endereco VARCHAR(255) NOT NULL,
    Cidade VARCHAR(100),
    Estado CHAR(2) NOT NULL,
    Celular VARCHAR(20) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Id_pagamento INT,
    FOREIGN KEY(Id_pagamento) REFERENCES Pagamento(Id_pagamento)
);

-- Tabela Funcionario
CREATE TABLE Funcionario (
    Id_funcionario INT PRIMARY KEY,
    Nome VARCHAR(255),
    Sobrenome VARCHAR(255),
    Cargo VARCHAR(100),
    Data_contratacao DATE,
    Salario DECIMAL(10, 2)
);

-- Tabela Agencia
CREATE TABLE Agencia (
    Num_agencia INT PRIMARY KEY,
    Endereco VARCHAR(255),
    Cidade VARCHAR(100),
    Estado CHAR(2),
    Contato VARCHAR(255)
);

-- Tabela Pagamento
CREATE TABLE Pagamento (
    Id_pagamento SERIAL PRIMARY KEY,
    Valor DECIMAL(10, 2) NOT NULL,
    Data_pagamento DATE NOT NULL,
    Forma_pagamento VARCHAR(50) NOT NULL,
    Status_pagamento VARCHAR(50) NOT NULL
);

-- Tabela Manutencao
CREATE TABLE Manutencao (
    Id_manutencao INT PRIMARY KEY,
    Data_manutencao DATE,
    Tipo_manutencao VARCHAR(100),
    Descricao TEXT,
    KM INT,
    Custo DECIMAL(10, 2)
);

-- Tabela Locacao
CREATE TABLE Locacao (
    Id_locacao INT PRIMARY KEY,
    Data_locacao DATE,
    Data_devolucao DATE,
    Valor_total DECIMAL(10, 2),
    Id_cliente INT,
    Id_carro INT,
    FOREIGN KEY(Id_cliente) REFERENCES Cliente(Id_cliente),
    FOREIGN KEY(Id_carro) REFERENCES Carro(Id_carro)
);

-- Tabela Verifica
CREATE TABLE Verifica (
    Num_agencia INT,
    Id_funcionario INT,
    FOREIGN KEY(Num_agencia) REFERENCES Agencia(Num_agencia),
    FOREIGN KEY(Id_funcionario) REFERENCES Funcionario(Id_funcionario)
);

-- Tabela Faz
CREATE TABLE Faz (
    Id_manutencao INT,
    Id_carro INT,
    FOREIGN KEY(Id_manutencao) REFERENCES Manutencao(Id_manutencao),
    FOREIGN KEY(Id_carro) REFERENCES Carro(Id_carro)
);
CREATE TABLE Feedback (
    Id_feedback SERIAL PRIMARY KEY,
    Id_cliente INT,
    Comentario TEXT,
    Avaliacao INT CHECK (Avaliacao >= 1 AND Avaliacao <= 5),
    Data_feedback DATE,
    FOREIGN KEY(Id_cliente) REFERENCES Cliente(Id_cliente)
);
-- Tabela Registra
CREATE TABLE Registra (
    Id_registra INT PRIMARY KEY,
    Id_feedback INT,
    Id_cliente INT,
    FOREIGN KEY(Id_feedback) REFERENCES Feedback(Id_feedback),
    FOREIGN KEY(Id_cliente) REFERENCES Cliente(Id_cliente)
);

CREATE TABLE Reserva (
    id SERIAL PRIMARY KEY,
    id_carro INT NOT NULL,
    data_reserva DATE NOT NULL,
    FOREIGN KEY (id_carro) REFERENCES Carro(id_carro)
);


-- Selecione todos os clientes cadastrados na locadora.
SELECT * FROM Cliente;

-- Liste todos os carros disponíveis para aluguel.
SELECT * FROM Carro WHERE Disponibilidade = true;

-- Mostre todos os registros da tabela de alugueis.
SELECT * FROM Locacao;

-- Exiba todos os funcionários da locadora.
SELECT * FROM Funcionario;
-- Encontre os clientes que alugaram um carro específico.
SELECT Cliente.*
FROM Cliente
JOIN Locacao ON Cliente.Id_cliente = Locacao.Id_cliente
WHERE Locacao.Id_carro = 1;  -- Substituir pelo ID do carro específico

-- Liste os carros alugados por um cliente específico.
SELECT Carro.*
FROM Carro
JOIN Locacao ON Carro.Id_carro = Locacao.Id_carro
WHERE Locacao.Id_cliente = 1;  -- Substituir pelo ID do cliente específico

-- Mostre os alugueis realizados em uma data específica.
SELECT * FROM Locacao
WHERE Data_locacao = '2024-05-21';  -- Substituir pela data específica

-- Encontre os carros alugados por um determinado cliente em um período específico.
SELECT Carro.*
FROM Carro
JOIN Locacao ON Carro.Id_carro = Locacao.Id_carro
WHERE Locacao.Id_cliente = 1  -- Substituir pelo ID do cliente específico
AND Locacao.Data_locacao BETWEEN '2024-01-01' AND '2024-12-31';  -- Substituir pelo período específico
-- Liste os clientes e os carros que eles alugaram.
SELECT Cliente.Nome, Carro.Modelo
FROM Cliente
JOIN Locacao ON Cliente.Id_cliente = Locacao.Id_cliente
JOIN Carro ON Locacao.Id_carro = Carro.Id_carro;

-- Mostre os alugueis, incluindo informações dos carros e clientes.
SELECT Locacao.*, Cliente.Nome, Carro.Modelo
FROM Locacao
JOIN Cliente ON Locacao.Id_cliente = Cliente.Id_cliente
JOIN Carro ON Locacao.Id_carro = Carro.Id_carro;

-- Exiba os carros e suas informações de manutenção.
SELECT Carro.*, Manutencao.Tipo_manutencao, Manutencao.Data_manutencao
FROM Carro
LEFT JOIN Faz ON Carro.Id_carro = Faz.Id_carro
LEFT JOIN Manutencao ON Faz.Id_manutencao = Manutencao.Id_manutencao;
-- Liste todos os clientes e os carros que eles alugaram, incluindo clientes que não realizaram nenhum aluguel.
SELECT Cliente.Nome, Carro.Modelo
FROM Cliente
LEFT JOIN Locacao ON Cliente.Id_cliente = Locacao.Id_cliente
LEFT JOIN Carro ON Locacao.Id_carro = Carro.Id_carro;

-- Mostre todos os alugueis, incluindo aqueles sem informações de carros ou clientes.
SELECT Locacao.*, Cliente.Nome, Carro.Modelo
FROM Locacao
LEFT JOIN Cliente ON Locacao.Id_cliente = Cliente.Id_cliente
LEFT JOIN Carro ON Locacao.Id_carro = Carro.Id_carro;

-- Exiba todas as reservas feitas, incluindo aquelas sem carros reservados.
SELECT Reserva.*, Carro.Modelo
FROM Reserva
LEFT JOIN Carro ON Reserva.Id_carro = Carro.Id_carro;
-- Encontre o cliente que mais alugou veículos.
SELECT Cliente.Nome, COUNT(Locacao.Id_locacao) AS Total_Alugueis
FROM Cliente
JOIN Locacao ON Cliente.Id_cliente = Locacao.Id_cliente
GROUP BY Cliente.Nome
ORDER BY Total_Alugueis DESC
LIMIT 1;

-- Calcule a receita total da locadora em um determinado período.
SELECT SUM(Valor_total) AS Receita_Total
FROM Locacao
WHERE Data_locacao BETWEEN '2024-01-01' AND '2024-12-31';

-- Identifique os carros que nunca foram alugados.
SELECT Carro.*
FROM Carro
LEFT JOIN Locacao ON Carro.Id_carro = Locacao.Id_carro
WHERE Locacao.Id_locacao IS NULL;

-- Liste os carros com a manutenção mais recente.
SELECT Carro.*, MAX(Manutencao.Data_manutencao) AS Ultima_Manutencao
FROM Carro
JOIN Faz ON Carro.Id_carro = Faz.Id_carro
JOIN Manutencao ON Faz.Id_manutencao = Manutencao.Id_manutencao
GROUP BY Carro.Id_carro;

-- Encontre os clientes que alugaram mais de um carro.
SELECT Cliente.*, COUNT(Locacao.Id_carro) AS Total_Alugueis
FROM Cliente
JOIN Locacao ON Cliente.Id_cliente = Locacao.Id_cliente
GROUP BY Cliente.Id_cliente
HAVING COUNT(Locacao.Id_carro) > 1;

-- Calcule a média de dias que os carros ficam alugados.
SELECT AVG(DATE_PART('day', Data_devolucao - Data_locacao)) AS Media_Dias_Alugados
FROM Locacao;
-- Atualize o preço do aluguel de todos os carros da marca "Toyota".
UPDATE Carro SET Preco_aluguel = NovoPreco WHERE Marca = 'Toyota';

-- Modifique a data de retorno de um carro alugado por um cliente.
UPDATE Locacao SET Data_devolucao = '2024-06-01' WHERE Id_cliente = 1 AND Id_carro = 1;  -- Substituir pelos IDs específicos

-- Atualize o status de manutenção de um carro após ter sido consertado.
UPDATE Carro SET Status_manutencao = 'Concluída' WHERE Id_carro = 1;  -- Substituir pelo ID do carro específico
-- Adicione uma nova coluna à tabela de Carro para armazenar o status de disponibilidade.
ALTER TABLE Carro ADD COLUMN Status_disponibilidade BOOLEAN;

-- Modifique o tipo de dados de uma coluna na tabela de Pagamento.
ALTER TABLE Pagamento ALTER COLUMN Valor TYPE NUMERIC(10, 2);

-- Remova uma coluna não utilizada da tabela de Cliente.
ALTER TABLE Cliente DROP COLUMN Coluna_Nao_Utilizada;
-- Liste todos os alugueis de carros, incluindo o nome do cliente, modelo do carro e data de aluguel.
SELECT Cliente.Nome, Carro.Modelo, Locacao.Data_locacao 
FROM Locacao 
JOIN Cliente ON Locacao.Id_cliente = Cliente.Id_cliente 
JOIN Carro ON Locacao.Id_carro = Carro.Id_carro;

-- Mostre os pagamentos feitos por clientes, incluindo o nome do cliente e o valor pago.
SELECT Cliente.Nome, Pagamento.Valor 
FROM Pagamento 
JOIN Cliente ON Pagamento.Id_pagamento = Cliente.Id_pagamento;
