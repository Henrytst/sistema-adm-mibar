<?php

class Estoque
{
    private $id, $name, $categoria, $quantidade, $indisponiveis, $status,
        $texto, $preco, $precoMedio, $fornecedor, $created_at, $update_at;
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
        $categoria,
        $quantidade,
        $indisponiveis,
        $status,
        $texto,
        $preco,
        $precoMedio,
        $fornecedor,
        $created_at
    ) {
        $this->dadosCadastrar(
            $name,
            $categoria,
            $quantidade,
            $indisponiveis,
            $status,
            $texto,
            $preco,
            $precoMedio,
            $fornecedor,
            $created_at
        );
        try {
            $stmt = $this->conectar->prepare(
                'INSERT INTO estoque (name, categoria, quantidade, indisponiveis, status, texto, preco, precoMedio, fornecedor, created_at) 
                VALUES (:NOME, :CATEGORIA, :QUANTIDADE, :INDISPONIVEL, :STATUS, :TEXTO, :PRECO, :PRECOMEDIO, :FORNECEDOR, :CRIADO_POR)'
            );
            $stmt->execute(
                array(
                    ":NOME" => $this->getname(),
                    ":CATEGORIA" => $this->getcategoria(),
                    ":QUANTIDADE" => $this->getquantidade(),
                    ":INDISPONIVEL" => $this->getindisponiveis(),
                    ":STATUS" => $this->getstatus(),
                    ":TEXTO" => $this->gettexto(),
                    ":PRECO" => $this->getpreco(),
                    ":PRECOMEDIO" => $this->getprecoMedio(),
                    ":FORNECEDOR" => $this->getfornecedor(),
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
        $categoria,
        $quantidade,
        $indisponiveis,
        $status,
        $texto,
        $preco,
        $precoMedio,
        $fornecedor,
        $created_at
    ) {
        $this->setname($name);
        $this->setcategoria($categoria);
        $this->setquantidade($quantidade);
        $this->setindisponiveis($indisponiveis);
        $this->setstatus($status);
        $this->settexto($texto);
        $this->setpreco($preco);
        $this->setprecoMedio($precoMedio);
        $this->setfornecedor($fornecedor);
        $this->setcreated_at($created_at);
    }

    public function dadosEditar(
        $name,
        $categoria,
        $quantidade,
        $indisponiveis,
        $status,
        $texto,
        $preco,
        $precoMedio,
        $fornecedor,
        $update_at
    ) {
        $this->setname($name);
        $this->setcategoria($categoria);
        $this->setquantidade($quantidade);
        $this->setindisponiveis($indisponiveis);
        $this->setstatus($status);
        $this->settexto($texto);
        $this->setpreco($preco);
        $this->setprecoMedio($precoMedio);
        $this->setfornecedor($fornecedor);
        $this->setupdate_at($update_at);
    }

    public function editarCliente(
        $id,
        $name,
        $categoria,
        $quantidade,
        $indisponiveis,
        $status,
        $texto,
        $preco,
        $precoMedio,
        $fornecedor,
        $update_at
    ) {
        $this->setid($id);
        $this->dadosEditar(
            $name,
            $categoria,
            $quantidade,
            $indisponiveis,
            $status,
            $texto,
            $preco,
            $precoMedio,
            $fornecedor,
            $update_at
        );
        try {
            $stmt = $this->conectar->prepare(
                'UPDATE estoque SET name=:NOME, categoria=:CATEGORIA, quantidade=:QUANTIDADE, indisponiveis=:INDISPONIVEL, 
                status=:STATUS, texto=:TEXTO, preco=:PRECO, precoMedio=:PRECOMEDIO, fornecedor=:FORNECEDOR, update_at=:ALTERADO_POR WHERE id=:ID'
            );
            $stmt->execute(array(
                ":ID" => $this->id,
                ":NOME" => $this->getname(),
                ":CATEGORIA" => $this->getcategoria(),
                ":QUANTIDADE" => $this->getquantidade(),
                ":INDISPONIVEL" => $this->getindisponiveis(),
                ":STATUS" => $this->getstatus(),
                ":TEXTO" => $this->gettexto(),
                ":PRECO" => $this->getpreco(),
                ":PRECOMEDIO" => $this->getprecoMedio(),
                ":FORNECEDOR" => $this->getfornecedor(),
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
            $stmt = $this->conectar->prepare('DELETE FROM estoque where id = :ID');
            $stmt->execute(array(":ID" => $this->id));
            $retorno = $stmt->rowCount();
            return $retorno;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function listarTodosClientes()
    {
        $stmt = $this->conectar->prepare('SELECT * FROM estoque ORDER BY name ASC');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($results);
    }
    public function carregarCliente($id)
    {
        $this->setid($id);
        $stmt = $this->conectar->prepare('SELECT * FROM estoque where id = :ID ORDER BY name ASC');
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
    private function setcategoria($categoria)
    {
        $this->categoria = $categoria;
    }
    private function setquantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }
    private function setindisponiveis($indisponiveis)
    {
        $this->indisponiveis = $indisponiveis;
    }
    private function setstatus($status)
    {
        $this->status = $status;
    }
    private function settexto($texto)
    {
        $this->texto = $texto;
    }
    private function setpreco($preco)
    {
        $this->preco = preg_replace("/[^0-9]/", "",$preco)/100;
    }
    private function setprecoMedio($precoMedio)
    {
        $this->precoMedio = preg_replace("/[^0-9]/", "",$precoMedio)/100;
    }
    private function setfornecedor($fornecedor)
    {
        $this->fornecedor = $fornecedor;
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
    public function getcategoria()
    {
        return $this->categoria;
    }
    public function getquantidade()
    {
        return $this->quantidade;
    }
    public function getindisponiveis()
    {
        return $this->indisponiveis;
    }
    public function getstatus()
    {
        return $this->status;
    }
    public function gettexto()
    {
        return $this->texto;
    }
    public function getpreco()
    {
        return $this->preco;
    }
    public function getprecoMedio()
    {
        return $this->precoMedio;
    }
    public function getfornecedor()
    {
        return $this->fornecedor;
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
