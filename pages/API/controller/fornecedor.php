<?php

session_start();

if (!isset($_SESSION["nome"])) {
    header("location: ../../../index.php");
    exit;
}

require_once('../model/fornecedor.php');

if ($_POST) {
    if (
        isset($_POST["name"])
        && !empty($_POST["name"])
    ) {

        date_default_timezone_set('America/Sao_Paulo');
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $localizacao = filter_input(INPUT_POST, "localizacao", FILTER_SANITIZE_STRING);
        $preco = filter_input(INPUT_POST, "preco", FILTER_DEFAULT);
        $produto = filter_input(INPUT_POST, "produto", FILTER_DEFAULT);
        $created_at = date('d/m/Y   |   H:i:s');
        $update_at = date('d/m/Y  |  H:i:s');

        if (isset($_POST["id"]) && !empty($_POST["id"])) {
            $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

            $editarCliente = new Fornecedor();
            $resposta = $editarCliente->editarCliente($id, $name, $localizacao, $preco, $produto, $update_at);
            if ($resposta = 1) header('location: ../../fornecedor.php?mensagem=sucesso');
            else header('location: ../views/fornecedor.php?mensagem=erro');
        } else {
            $adicionarCliente = new Fornecedor();
            $resposta = $adicionarCliente->adicionarCliente($name, $localizacao, $preco, $produto, $created_at);
            if ($resposta = 1) header('location: ../../fornecedor.php?mensagem=sucesso');
            else header('location: ../views/fornecedor.php?mensagem=erro');
        }
    } else {
        echo "Campos obrigatórios não preenchidos!!!";
    }
} elseif ($_GET) {
    if (isset($_GET["id"]) && !empty($_GET["id"]) && isset($_GET["acao"]) && !empty($_GET["acao"])) {
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $acao = filter_input(INPUT_GET, "acao", FILTER_SANITIZE_STRING);

        if ($acao == "excluir") {
            $buscarCliente = new Fornecedor();
            $resposta = $buscarCliente->excluirCliente($id);
            if ($resposta > 0)
                header('location: ../../fornecedor.php?mensagem=sucesso');
            else {
                header('location: ../../fornecedor.php?mensagem=erro');
            }
        }
    }
}
