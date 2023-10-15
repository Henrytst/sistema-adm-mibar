<?php

class CreateTable
{
    public function CreateTable()
    {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=MIBAR", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $slqCreateTable = 'CREATE TABLE funcionarios(
                id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                arquivo varchar(255) NOT NULL,
                nome_arquivo varchar(255) NOT NULL,
                diretorio varchar(255) NOT NULL,
                name varchar(255) NOT NULL,
                nascimento varchar(50) NOT NULL,
                idade varchar(50) NOT NULL,
                sexo varchar(50) NOT NULL,
                rg varchar(50) NOT NULL,
                cpf varchar(50) DEFAULT NULL,
                tatuagem varchar(50) NOT NULL,
                email varchar(255) NOT NULL,
                cb varchar(50) NOT NULL,
                phone varchar(50) DEFAULT NULL,
                celular varchar(50) DEFAULT NULL,
                camisa varchar(50) DEFAULT NULL,
                calca varchar(50) NOT NULL,
                terno varchar(50) NOT NULL,
                calcado varchar(50) NOT NULL,
                peso varchar(50) NOT NULL,
                altura varchar(50) NOT NULL,
                status varchar(50) NOT NULL,
                funcao varchar(50) NOT NULL,
                idiomas varchar(255) DEFAULT NULL,
                escolaridade varchar(255) NOT NULL,
                disponibilidade varchar(255) NOT NULL,
                observacoes mediumtext NOT NULL,
                complemento mediumtext NOT NULL,
                created_at varchar(255) DEFAULT NULL,
                update_at varchar(255) DEFAULT NULL
            )';

            $stmt = $pdo->prepare($slqCreateTable);
            $stmt->execute();

             $pdo = new PDO("mysql:host=localhost;dbname=MIBAR", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $slqCreateTable = 'CREATE TABLE coqueteis(
                id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                arquivo varchar(255) NOT NULL,
                nome varchar(255) NOT NULL,
                baseAlcoolica varchar(255) NOT NULL,
                origem varchar(255) NOT NULL,
                autor varchar(255) NOT NULL,
                tipo varchar(255) NOT NULL,
                receita mediumtext NOT NULL,
                historia mediumtext NOT NULL,
                created_at varchar(255) DEFAULT NULL,
                update_at varchar(255) DEFAULT NULL
            )';

            $stmt = $pdo->prepare($slqCreateTable);
            $stmt->execute();

            $pdo = new PDO("mysql:host=localhost;dbname=MIBAR", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $slqCreateTable = 'CREATE TABLE fornecedor(
                id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name varchar(255) NOT NULL,
                localizacao varchar(255) NOT NULL,
                preco decimal(10,2) NOT NULL,
                produto varchar(255) NOT NULL,
                created_at varchar(255) DEFAULT NULL,
                update_at varchar(255) DEFAULT NULL
            )';

            $stmt = $pdo->prepare($slqCreateTable);
            $stmt->execute();

            $pdo = new PDO("mysql:host=localhost;dbname=MIBAR", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $slqCreateTable = 'CREATE TABLE estoque(
                id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name varchar(255) NOT NULL,
                categoria varchar(255) NOT NULL,
                quantidade varchar(255) NOT NULL,
                indisponiveis varchar(255) NOT NULL,
                status varchar(255) NOT NULL,
                texto mediumtext NOT NULL,
                preco decimal(10,2) NOT NULL,
                precoMedio decimal(10,2) NOT NULL,
                fornecedor varchar(255) NOT NULL,
                created_at varchar(255) DEFAULT NULL,
                update_at varchar(255) DEFAULT NULL
            )';

            $stmt = $pdo->prepare($slqCreateTable);
            $stmt->execute();

            $pdo = new PDO("mysql:host=localhost;dbname=MIBAR", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $slqCreateTable = 'CREATE TABLE preparo(
                id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name varchar(255) NOT NULL,
                categoria varchar(255) NOT NULL,
                texto mediumtext NOT NULL,
                mo decimal(10,2) NOT NULL,
                preco decimal(10,2) NOT NULL,
                status varchar(255) NOT NULL,
                created_at varchar(255) DEFAULT NULL,
                update_at varchar(255) DEFAULT NULL
            )';

            $stmt = $pdo->prepare($slqCreateTable);
            $stmt->execute();

            $pdo = new PDO("mysql:host=localhost;dbname=MIBAR", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $slqCreateTable = 'CREATE TABLE cliente(
                id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name varchar(255) NOT NULL,
                email varchar(255) NOT NULL,
                instagram varchar(255) NOT NULL,
                facebook varchar(255) NOT NULL,
                redes varchar(255) NOT NULL,
                tipo varchar(255) NOT NULL,
                texto mediumtext NOT NULL,
                created_at varchar(255) DEFAULT NULL,
                update_at varchar(255) DEFAULT NULL
            )';

            $stmt = $pdo->prepare($slqCreateTable);
            $stmt->execute();
            
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
