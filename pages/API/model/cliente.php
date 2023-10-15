<?php

class Cliente
{
    private $id, $name, $email, $instagram, $facebook, $redes, $tipo, $texto, $created_at, $update_at;
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
    public function adicionarCliente($name, $email, $instagram, $facebook, $redes, $tipo, $texto, $created_at)
    {
        $this->dadosCadastrar($name, $email, $instagram, $facebook, $redes, $tipo, $texto, $created_at);
        try {
            $stmt = $this->conectar->prepare(
                'INSERT INTO cliente (name, email, instagram, facebook, redes, tipo, texto, created_at) 
                VALUES (:NOME, :EMAIL, :INSTAGRAM, :FACEBOOK, :REDES, :TIPO, :TEXTO, :CRIADO_POR)'
            );
            $stmt->execute(
                array(
                    ":NOME" => $this->getname(),
                    ":EMAIL" => $this->getemail(),
                    ":INSTAGRAM" => $this->getinstagram(),
                    ":FACEBOOK" => $this->getfacebook(),
                    ":REDES" => $this->getredes(),
                    ":TIPO" => $this->gettipo(),
                    ":TEXTO" => $this->gettexto(),
                    ":CRIADO_POR" => $this->getcreated_at()
                )
            );
            $stmt->rowCount();
            return 1;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function dadosCadastrar($name, $email, $instagram, $facebook, $redes, $tipo, $texto, $created_at)
    {
        $this->setname($name);
        $this->setemail($email);
        $this->setinstagram($instagram);
        $this->setfacebook($facebook);
        $this->setredes($redes);
        $this->settipo($tipo);
        $this->settexto($texto);
        $this->setcreated_at($created_at);
    }

    public function dadosEditar($name, $email, $instagram, $facebook, $redes, $tipo, $texto, $update_at)
    {
        $this->setname($name);
        $this->setemail($email);
        $this->setinstagram($instagram);
        $this->setfacebook($facebook);
        $this->setredes($redes);
        $this->settipo($tipo);
        $this->settexto($texto);
        $this->setupdate_at($update_at);
    }
    public function editarCliente($id, $name, $email, $instagram, $facebook, $redes, $tipo, $texto, $update_at)
    {
        $this->setid($id);
        $this->dadosEditar($name, $email, $instagram, $facebook, $redes, $tipo, $texto, $update_at);
        try {
            $stmt = $this->conectar->prepare(
                'UPDATE cliente SET name=:NOME, email=:EMAIL, instagram=:INSTAGRAM, facebook=:FACEBOOK,
                 redes=:REDES, tipo=:TIPO, texto=:TEXTO, update_at=:ALTERADO_POR WHERE id=:ID'
            );
            $stmt->execute(array(
                ":ID" => $this->id,
                ":NOME" => $this->getname(),
                ":EMAIL" => $this->getemail(),
                ":INSTAGRAM" => $this->getinstagram(),
                ":FACEBOOK" => $this->getfacebook(),
                ":REDES" => $this->getredes(),
                ":TIPO" => $this->gettipo(),
                ":TEXTO" => $this->gettexto(),
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
            $stmt = $this->conectar->prepare('DELETE FROM cliente where id = :ID');
            $stmt->execute(array(":ID" => $this->id));
            $retorno = $stmt->rowCount();
            return $retorno;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function listarTodosClientes()
    {
        $stmt = $this->conectar->prepare('SELECT * FROM cliente ORDER BY name ASC');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($results);
    }
    public function carregarCliente($id)
    {
        $this->setid($id);
        $stmt = $this->conectar->prepare('SELECT * FROM cliente where id = :ID ORDER BY name ASC');
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
    private function setemail($email)
    {
        $this->email = $email;
    }
    private function setinstagram($instagram)
    {
        $this->instagram = $instagram;
    }
    private function setfacebook($facebook)
    {
        $this->facebook = $facebook;
    }
    private function setredes($redes)
    {
        $this->redes = $redes;
    }
    private function settexto($texto)
    {
        $this->texto = $texto;
    }
    private function settipo($tipo)
    {
        $this->tipo = $tipo;
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
    public function getemail()
    {
        return $this->email;
    }
    public function getinstagram()
    {
        return $this->instagram;
    }
    public function getfacebook()
    {
        return $this->facebook;
    }
    public function getredes()
    {
        return $this->redes;
    }
    public function gettexto()
    {
        return $this->texto;
    }
    public function gettipo()
    {
        return $this->tipo;
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
