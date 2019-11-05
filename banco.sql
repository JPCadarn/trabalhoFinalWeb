-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05-Nov-2019 às 19:57
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: gole
--
CREATE DATABASE IF NOT EXISTS gole DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE gole;

-- --------------------------------------------------------

--
-- Estrutura da tabela avaliacoes
--

CREATE TABLE avaliacoes (
  id int(11) NOT NULL,
  usuario_id int(11) NOT NULL,
  produto_id int(11) NOT NULL,
  texto text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela carrinhos
--

CREATE TABLE carrinhos (
  id int(11) NOT NULL,
  usuario_id int(11) NOT NULL,
  produto_id int(11) NOT NULL,
  quantidade int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela cartaos
--

CREATE TABLE cartaos (
  id int(11) NOT NULL,
  usuario_id int(11) NOT NULL,
  codigo_seguranca varchar(60) NOT NULL,
  numero varchar(60) NOT NULL,
  validade varchar(5) NOT NULL,
  debito_credito varchar(1) NOT NULL,
  nome_impresso varchar(100) NOT NULL,
  ultimos_quatro int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela categorias
--

CREATE TABLE categorias (
  id int(11) NOT NULL,
  nome varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela enderecos
--

CREATE TABLE enderecos (
  id int(11) NOT NULL,
  usuario_id int(11) NOT NULL,
  cep varchar(9) NOT NULL,
  destinatario varchar(100) NOT NULL,
  rua varchar(100) NOT NULL,
  numero int(11) NOT NULL,
  complemento varchar(30) DEFAULT NULL,
  cidade varchar(30) NOT NULL,
  estado varchar(30) NOT NULL,
  referencia varchar(50) DEFAULT NULL,
  bairro varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela pedidos
--

CREATE TABLE pedidos (
  id int(11) NOT NULL,
  usuario_id int(11) NOT NULL,
  endereco_id int(11) NOT NULL,
  data date NOT NULL,
  hora time NOT NULL,
  cartao_id int(11) NOT NULL,
  parcelas int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela pedidos_itens
--

CREATE TABLE pedidos_itens (
  id int(11) NOT NULL,
  pedido_id int(11) NOT NULL,
  produto_id int(11) NOT NULL,
  quantidade int(11) NOT NULL,
  valor_total decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela produtos
--

CREATE TABLE produtos (
  id int(11) NOT NULL,
  nome varchar(60) NOT NULL,
  descricao text NOT NULL,
  valor decimal(10,2) NOT NULL,
  categoria_id int(11) NOT NULL,
  imagem varchar(200) NOT NULL,
  teor_alcoolico decimal(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela produtos_acessos
--

CREATE TABLE produtos_acessos (
  id int(11) NOT NULL,
  produto_id int(11) NOT NULL,
  data date NOT NULL,
  hora time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela produtos_destaque
--

CREATE TABLE produtos_destaque (
  id int(11) NOT NULL,
  produto_id int(11) NOT NULL,
  ordem int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela usuarios
--

CREATE TABLE usuarios (
  id int(11) NOT NULL,
  email varchar(60) NOT NULL,
  senha varchar(60) NOT NULL,
  nome varchar(100) NOT NULL,
  cpf varchar(14) NOT NULL,
  data_nascimento date NOT NULL,
  admin tinyint(1) NOT NULL DEFAULT '0',
  criacao datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela usuarios_acessos
--

CREATE TABLE usuarios_acessos (
  id int(11) NOT NULL,
  usuario_id int(11) NOT NULL,
  data date NOT NULL,
  hora time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table avaliacoes
--
ALTER TABLE avaliacoes
  ADD PRIMARY KEY (id);

--
-- Indexes for table carrinhos
--
ALTER TABLE carrinhos
  ADD PRIMARY KEY (id);

--
-- Indexes for table cartaos
--
ALTER TABLE cartaos
  ADD PRIMARY KEY (id);

--
-- Indexes for table categorias
--
ALTER TABLE categorias
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY nome (nome);

--
-- Indexes for table enderecos
--
ALTER TABLE enderecos
  ADD PRIMARY KEY (id);

--
-- Indexes for table pedidos
--
ALTER TABLE pedidos
  ADD PRIMARY KEY (id);

--
-- Indexes for table pedidos_itens
--
ALTER TABLE pedidos_itens
  ADD PRIMARY KEY (id);

--
-- Indexes for table produtos
--
ALTER TABLE produtos
  ADD PRIMARY KEY (id);

--
-- Indexes for table produtos_acessos
--
ALTER TABLE produtos_acessos
  ADD PRIMARY KEY (id);

--
-- Indexes for table produtos_destaque
--
ALTER TABLE produtos_destaque
  ADD PRIMARY KEY (id);

--
-- Indexes for table usuarios
--
ALTER TABLE usuarios
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY email (email),
  ADD UNIQUE KEY cpf (cpf);

--
-- Indexes for table usuarios_acessos
--
ALTER TABLE usuarios_acessos
  ADD PRIMARY KEY (id);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table avaliacoes
--
ALTER TABLE avaliacoes
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table carrinhos
--
ALTER TABLE carrinhos
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table cartaos
--
ALTER TABLE cartaos
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table categorias
--
ALTER TABLE categorias
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table enderecos
--
ALTER TABLE enderecos
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table pedidos
--
ALTER TABLE pedidos
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table pedidos_itens
--
ALTER TABLE pedidos_itens
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table produtos
--
ALTER TABLE produtos
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table produtos_acessos
--
ALTER TABLE produtos_acessos
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table produtos_destaque
--
ALTER TABLE produtos_destaque
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table usuarios
--
ALTER TABLE usuarios
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table usuarios_acessos
--
ALTER TABLE usuarios_acessos
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
