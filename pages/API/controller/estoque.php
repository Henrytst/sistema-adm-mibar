<?php

session_start();

if (!isset($_SESSION["nome"])) {
    header("location: ../../../index.php");
    exit;
}

require_once('../model/estoque.php');

if ($_POST) {
    if (
        isset($_POST["name"]) && isset($_POST["categoria"])
        && !empty($_POST["name"]) && !empty($_POST["categoria"]))
     {

        date_default_timezone_set('America/Sao_Paulo');
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $categoria = filter_input(INPUT_POST, "categoria", FILTER_SANITIZE_STRING);
        $quantidade = filter_input(INPUT_POST, "quantidade", FILTER_SANITIZE_STRING);
        $indisponiveis = filter_input(INPUT_POST, "indisponiveis", FILTER_DEFAULT);
        $status = filter_input(INPUT_POST, "status", FILTER_DEFAULT);
        $texto = filter_input(INPUT_POST, "texto", FILTER_DEFAULT);
        $preco = filter_input(INPUT_POST, "preco", FILTER_DEFAULT);
        $precoMedio = filter_input(INPUT_POST, "precoMedio", FILTER_DEFAULT);
        $fornecedor = filter_input(INPUT_POST, "fornecedor", FILTER_DEFAULT);
        $created_at = date('d/m/Y   |   H:i:s');
        $update_at = date('d/m/Y  |  H:i:s');
       
        if (isset($_POST["id"]) && !empty($_POST["id"])) {
            $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
          
            $editarCliente = new Estoque();
            $resposta = $editarCliente->editarCliente($id, $name, $categoria, $quantidade, 
            $indisponiveis, $status, $texto, $preco, $precoMedio, $fornecedor, $update_at);
            if($resposta = 1) header('location: ../../estoque.php?mensagem=sucesso');
            else header('location: ../views/Estoque.php?mensagem=erro');
        } else {
            $adicionarCliente = new Estoque();
            $resposta = $adicionarCliente->adicionarCliente($name, $categoria, $quantidade, 
            $indisponiveis, $status, $texto, $preco, $precoMedio, $fornecedor, $created_at);
            if($resposta = 1) header('location: ../../estoque.php?mensagem=sucesso');
            else header('location: ../views/Estoque.php?mensagem=erro');
        }
    }else{
        echo "Campos obrigatórios não preenchidos!!!";
    }
} elseif ($_GET) {
    if (isset($_GET["id"]) && !empty($_GET["id"]) && isset($_GET["acao"]) && !empty($_GET["acao"])) {
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $acao = filter_input(INPUT_GET, "acao", FILTER_SANITIZE_STRING);
        
        if($acao == "excluir"){
            $buscarCliente = new Estoque();
            $resposta = $buscarCliente->excluirCliente($id);
            if($resposta > 0)           
                header('location: ../../estoque.php?mensagem=sucesso');
            else {
                header('location: ../../estoque.php?mensagem=erro');
            }
        }
    }
}
