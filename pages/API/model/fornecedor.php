<?php

class Fornecedor
{
    private $id, $name, $localizacao, $preco, $produto, $created_at, $update_at;
    public $conectar;

    public function __construct()
    {
        try {
            $this->conectar = new PDO("mysql:host=localhost;dbname=MIBAR", "root", "");
            $this->conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            //echo 'Error: ' . $e->getMessage();
            header('location: /mibar/pages/migrations/index.php');
        }
    }
    public function adicionarCliente(
        $name,
        $localizacao,
        $preco,
        $produto,
        $created_at
    ) {
        $this->dadosCadastrar(
            $name,
            $localizacao,
            $preco,
            $produto,
            $created_at
        );
        try {
            $stmt = $this->conectar->prepare(
                'INSERT INTO fornecedor (name, localizacao, preco, produto, created_at) 
                VALUES (:NOME, :LOCALIZACAO, :PRECO, :PRODUTO, :CRIADO_POR)'
            );
            $stmt->execute(
                array(
                    ":NOME" => $this->getname(),
                    ":LOCALIZACAO" => $this->getlocalizacao(),
                    ":PRECO" => $this->getpreco(),
                    ":PRODUTO" => $this->getproduto(),
                    ":CRIADO_POR" => $this->getcreated_at()
                )
            );
            $stmt->rowCount();
            return 1;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function dadosCadastrar(
        $name,
        $localizacao,
        $preco,
        $produto,
        $created_at
    ) {
        $this->setname($name);
        $this->setlocalizacao($localizacao);
        $this->setpreco($preco);
        $this->setproduto($produto);
        $this->setcreated_at($created_at);
    }

    public function dadosEditar(
        $name,
        $localizacao,
        $preco,
        $produto,
        $update_at
    ) {
        $this->setname($name);
        $this->setlocalizacao($localizacao);
        $this->setpreco($preco);
        $this->setproduto($produto);
        $this->setupdate_at($update_at);
    }

    public function editarCliente(
        $id,
        $name,
        $localizacao,
        $preco,
        $produto,
        $update_at
    ) {
        $this->setid($id);
        $this->dadosEditar(
            $name,
            $localizacao,
            $preco,
            $produto,
            $update_at
        );
        try {
            $stmt = $this->conectar->prepare(
                'UPDATE fornecedor SET name=:NOME, localizacao=:LOCALIZACAO, preco=:PRECO, produto=:PRODUTO, 
                update_at=:ALTERADO_POR WHERE id=:ID'
            );
            $stmt->execute(array(
                ":ID" => $this->id,
                ":NOME" => $this->getname(),
                ":LOCALIZACAO" => $this->getlocalizacao(),
                ":PRECO" => $this->getpreco(),
                ":PRODUTO" => $this->getproduto(),
                ":ALTERADO_POR" => $this->getupdate_at()
            ));
            return 1;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function excluirCliente($id)
    {
        $this->setid($id);
        try {
            $stmt = $this->conectar->prepare('DELETE FROM fornecedor where id = :ID');
            $stmt->execute(array(":ID" => $this->id));
            $retorno = $stmt->rowCount();
            return $retorno;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function listarTodosClientes()
    {
        $stmt = $this->conectar->prepare('SELECT * FROM fornecedor ORDER BY name ASC');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($results);
    }
    public function carregarCliente($id)
    {
        $this->setid($id);
        $stmt = $this->conectar->prepare('SELECT * FROM fornecedor where id = :ID ORDER BY name ASC');
        $stmt->execute(array(":ID" => $this->id));
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($results);
    }

    private function setId($id)
    {
        $this->id = $id;
    }
    private function setname($name)
    {
        $this->name = $name;
    }
    private function setlocalizacao($localizacao)
    {
        $this->localizacao = $localizacao;
    }
    private function setpreco($preco)
    {
        $this->preco = preg_replace("/[^0-9]/", "",$preco)/100;
    }
    private function setproduto($produto)
    {
        $this->produto = $produto;
    }
    private function setcreated_at($created_at)
    {
        $this->created_at = $created_at;
    }
    private function setupdate_at($update_at)
    {
        $this->update_at = $update_at;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getname()
    {
        return $this->name;
    }
    public function getlocalizacao()
    {
        return $this->localizacao;
    }
    public function getpreco()
    {
        return $this->preco;
    }
    public function getproduto()
    {
        return $this->produto;
    }
    public function getcreated_at()
    {
        return $this->created_at;
    }
    public function getupdate_at()
    {
        return $this->update_at;
    }
}
