<?php

class Coqueteis
{
    private $id,
    $arquivo,
    $nome,
    $baseAlcoolica,
    $origem,
    $autor,
    $tipo,
    $receita,
    $historia,
    $created_at,
    $update_at;

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
        $arquivo,
        $nome,
        $baseAlcoolica,
        $origem,
        $autor,
        $tipo,
        $receita,
        $historia,
        $created_at
    ) {
        $this->dadosCadastrar(
            $arquivo,
            $nome,
            $baseAlcoolica,
            $origem,
            $autor,
            $tipo,
            $receita,
            $historia,
            $created_at
        );
        try {
            $stmt = $this->conectar->prepare(
                'INSERT INTO coqueteis (arquivo, nome, baseAlcoolica, origem, autor, tipo, receita, historia, created_at) 
                VALUES (:ARQUIVO, :NOME, :BASEALCOOLICA, :ORIGEM, :AUTOR, :TIPO, :RECEITA, :HISTORIA, :CRIADO_POR)'
            );
            $stmt->execute(
                array(
                    ":ARQUIVO" => $this->getarquivo(),
                    ":NOME" => $this->getnome(),
                    ":BASEALCOOLICA" => $this->getbaseAlcoolica(),
                    ":ORIGEM" => $this->getorigem(),
                    ":AUTOR" => $this->getautor(),
                    ":TIPO" => $this->gettipo(),
                    ":RECEITA" => $this->getreceita(),
                    ":HISTORIA" => $this->gethistoria(),
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
        $arquivo,
        $nome,
        $baseAlcoolica,
        $origem,
        $autor,
        $tipo,
        $receita,
        $historia,
        $created_at
    ) {
        $this->setarquivo($arquivo);
        $this->setnome($nome);
        $this->setbaseAlcoolica($baseAlcoolica);
        $this->setorigem($origem);
        $this->setautor($autor);
        $this->settipo($tipo);
        $this->setreceita($receita);
        $this->sethistoria($historia);
        $this->setcreated_at($created_at);
    }

    public function dadosEditar(
        $arquivo,
        $nome,
        $baseAlcoolica,
        $origem,
        $autor,
        $tipo,
        $receita,
        $historia,
        $update_at
    ) {
        $this->setarquivo($arquivo);
        $this->setnome($nome);
        $this->setbaseAlcoolica($baseAlcoolica);
        $this->setorigem($origem);
        $this->setautor($autor);
        $this->settipo($tipo);
        $this->setreceita($receita);
        $this->sethistoria($historia);
        $this->setupdate_at($update_at);
    }

    public function editarCliente(
        $id,
        $arquivo,
        $nome,
        $baseAlcoolica,
        $origem,
        $autor,
        $tipo,
        $receita,
        $historia,
        $update_at
    ) {
        $this->setid($id);
        $this->dadosEditar(
            $arquivo,
            $nome,
            $baseAlcoolica,
            $origem,
            $autor,
            $tipo,
            $receita,
            $historia,
            $update_at
        );
        try {
            $stmt = $this->conectar->prepare(
                'UPDATE coqueteis SET arquivo=:ARQUIVO, nome=:NOME, baseAlcoolica=:BASEALCOOLICA, 
                origem=:ORIGEM, autor=:AUTOR, tipo=:TIPO, receita=:RECEITA, historia=:HISTORIA,
                update_at=:ALTERADO_POR WHERE id=:ID'
            );
            $stmt->execute(array(
                ":ID" => $this->id,
                ":ARQUIVO" => $this->getarquivo(),
                ":NOME" => $this->getnome(),
                ":BASEALCOOLICA" => $this->getbaseAlcoolica(),
                ":ORIGEM" => $this->getorigem(),
                ":AUTOR" => $this->getautor(),
                ":TIPO" => $this->gettipo(),
                ":RECEITA" => $this->getreceita(),
                ":HISTORIA" => $this->gethistoria(),
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
            $stmt = $this->conectar->prepare('DELETE FROM coqueteis where id = :ID');
            $stmt->execute(array(":ID" => $this->id));
            $retorno = $stmt->rowCount();
            return $retorno;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function listarTodosClientes()
    {
        $stmt = $this->conectar->prepare('SELECT * FROM coqueteis ORDER BY nome ASC');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($results);
    }
    public function carregarCliente($id)
    {
        $this->setid($id);
        $stmt = $this->conectar->prepare('SELECT * FROM coqueteis where id = :ID ORDER BY nome ASC');
        $stmt->execute(array(":ID" => $this->id));
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($results);
    }

    private function setId($id)
    {
        $this->id = $id;
    }
    private function setarquivo($arquivo)
    {
        $this->arquivo = $arquivo;
    }
    private function setnome($nome)
    {
        $this->nome = $nome;
    }
    private function setbaseAlcoolica($baseAlcoolica)
    {
        $this->baseAlcoolica = $baseAlcoolica;
    }
    private function setorigem($origem)
    {
        $this->origem = $origem;
    }
    private function setautor($autor)
    {
        $this->autor = $autor;
    }
    private function settipo($tipo)
    {
        $this->tipo = $tipo;
    }
    private function setreceita($receita)
    {
        $this->receita = $receita;
    }
    private function sethistoria($historia)
    {
        $this->historia = $historia;
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
    public function getarquivo()
    {
        return $this->arquivo;
    }
    public function getnome()
    {
        return $this->nome;
    }
    public function getbaseAlcoolica()
    {
        return $this->baseAlcoolica;
    }
    public function getorigem()
    {
        return $this->origem;
    }
    public function getautor()
    {
        return $this->autor;
    }
    public function gettipo()
    {
        return $this->tipo;
    }
    public function getreceita()
    {
        return $this->receita;
    }
    public function gethistoria()
    {
        return $this->historia;
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
