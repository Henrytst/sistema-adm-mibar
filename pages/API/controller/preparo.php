<?php

session_start();

if (!isset($_SESSION["nome"])) {
    header("location: ../../../index.php");
    exit;
}

require_once('../model/preparo.php');

if ($_POST) {
    if (
        isset($_POST["name"])
        && !empty($_POST["name"]))
     {

        date_default_timezone_set('America/Sao_Paulo');
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $categoria = filter_input(INPUT_POST, "categoria", FILTER_SANITIZE_STRING);
        $texto = filter_input(INPUT_POST, "texto", FILTER_DEFAULT);
        $mo = filter_input(INPUT_POST, "mo", FILTER_DEFAULT);
        $preco = filter_input(INPUT_POST, "preco", FILTER_DEFAULT);
        $status = filter_input(INPUT_POST, "status", FILTER_DEFAULT);
        $created_at = date('d/m/Y   |   H:i:s');
        $update_at = date('d/m/Y  |  H:i:s');
       
        if (isset($_POST["id"]) && !empty($_POST["id"])) {
            $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
          
            $editarCliente = new Preparo();
            $resposta = $editarCliente->editarCliente($id, $name, $categoria, $texto, $mo, $preco, $status, $update_at);
            if($resposta = 1) header('location: ../../preparo.php?mensagem=sucesso');
            else header('location: ../views/preparo.php?mensagem=erro');
        } else {
            $adicionarCliente = new Preparo();
            $resposta = $adicionarCliente->adicionarCliente($name, $categoria, $texto, $mo, $preco, $status, $created_at);
            if($resposta = 1) header('location: ../../preparo.php?mensagem=sucesso');
            else header('location: ../views/preparo.php?mensagem=erro');
        }
    }else{
        echo "Campos obrigatórios não preenchidos!!!";
    }
} elseif ($_GET) {
    if (isset($_GET["id"]) && !empty($_GET["id"]) && isset($_GET["acao"]) && !empty($_GET["acao"])) {
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $acao = filter_input(INPUT_GET, "acao", FILTER_SANITIZE_STRING);
        
        if($acao == "excluir"){
            $buscarCliente = new Preparo();
            $resposta = $buscarCliente->excluirCliente($id);
            if($resposta > 0)           
                header('location: ../../preparo.php?mensagem=sucesso');
            else {
                header('location: ../../preparo.php?mensagem=erro');
            }
        }
    }
}
