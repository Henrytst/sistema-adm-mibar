<?php

class Preparo
{
    private $id, $name, $categoria, $texto, $mo, $preco, $status, $created_at, $update_at;
    public $conectar;

    public function __construct()
    {
        try {
            $this->conectar = new PDO("mysql:host=localhost;dbname=MIBAR", "root", "");
            $this->conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            //echo 'Error: ' . $e->getMessage();
            header('location: ./migrations/index.php');
        }
    }
    public function adicionarCliente(
        $name, $categoria, $texto, $mo, $preco, $status,
        $created_at
    ) {
        $this->dadosCadastrar(
            $name, $categoria, $texto, $mo, $preco, $status,
            $created_at
        );
        try {
            $stmt = $this->conectar->prepare(
                'INSERT INTO preparo (name, categoria, texto, mo, preco, status, created_at) 
                VALUES (:NOME, :CATEGORIA, :TEXTO, :MO, :PRECO, :STATUS, :CRIADO_POR)'
            );
            $stmt->execute(
                array(
                    ":NOME" => $this->getname(),
                    ":CATEGORIA" => $this->getcategoria(),
                    ":TEXTO" => $this->gettexto(),
                    ":MO" => $this->getmo(),
                    ":PRECO" => $this->getpreco(),
                    ":STATUS" => $this->getstatus(),
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
        $name, $categoria, $texto, $mo, $preco, $status,
        $created_at
    ) {
        $this->setname($name);
        $this->setcategoria($categoria);
        $this->settexto($texto);
        $this->setmo($mo);
        $this->setpreco($preco);
        $this->setstatus($status);
        $this->setcreated_at($created_at);
    }

    public function dadosEditar(
        $name, $categoria, $texto, $mo, $preco, $status,
        $update_at
    ) {
        $this->setname($name);
        $this->setcategoria($categoria);
        $this->settexto($texto);
        $this->setmo($mo);
        $this->setpreco($preco);
        $this->setstatus($status);
        $this->setupdate_at($update_at);
    }

    public function editarCliente(
        $id,
        $name, $categoria, $texto, $mo, $preco, $status,
        $update_at
    ) {
        $this->setid($id);
        $this->dadosEditar(
            $name, $categoria, $texto, $mo, $preco, $status,
            $update_at
        );
        try {
            $stmt = $this->conectar->prepare(
                'UPDATE preparo SET name=:NOME, categoria=:CATEGORIA, texto=:TEXTO, mo=:MO, preco=:PRECO, 
                status=:STATUS, update_at=:ALTERADO_POR WHERE id=:ID'
            );
            $stmt->execute(array(
                ":ID" => $this->id,
                ":NOME" => $this->getname(),
                ":CATEGORIA" => $this->getcategoria(),
                ":TEXTO" => $this->gettexto(),
                ":MO" => $this->getmo(),
                ":PRECO" => $this->getpreco(),
                ":STATUS" => $this->getstatus(),
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
            $stmt = $this->conectar->prepare('DELETE FROM preparo where id = :ID');
            $stmt->execute(array(":ID" => $this->id));
            $retorno = $stmt->rowCount();
            return $retorno;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function listarTodosClientes()
    {
        $stmt = $this->conectar->prepare('SELECT * FROM preparo ORDER BY name ASC');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($results);
    }
    public function carregarCliente($id)
    {
        $this->setid($id);
        $stmt = $this->conectar->prepare('SELECT * FROM preparo where id = :ID ORDER BY name ASC');
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
    private function settexto($texto)
    {
        $this->texto = $texto;
    }
    private function setmo($mo)
    {
        $this->mo = preg_replace("/[^0-9]/", "",$mo)/100;;
    }
    private function setpreco($preco)
    {
        $this->preco = preg_replace("/[^0-9]/", "",$preco)/100;;
    }
    private function setstatus($status)
    {
        $this->status = $status;
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
    public function gettexto()
    {
        return $this->texto;
    }
    public function getmo()
    {
        return $this->mo;
    }
    public function getpreco()
    {
        return $this->preco;
    }
    public function getstatus()
    {
        return $this->status;
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
