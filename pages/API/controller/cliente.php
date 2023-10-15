<?php

session_start();

if (!isset($_SESSION["nome"])) {
    header("location: ../../../index.php");
    exit;
}

require_once('../model/cliente.php');

if ($_POST) {
    if (
        isset($_POST["name"])
        && !empty($_POST["name"])
    ) {

        date_default_timezone_set('America/Sao_Paulo');
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
        $instagram = filter_input(INPUT_POST, "instagram", FILTER_DEFAULT);
        $facebook = filter_input(INPUT_POST, "facebook", FILTER_DEFAULT);
        $redes = filter_input(INPUT_POST, "redes", FILTER_DEFAULT);
        $tipo = filter_input(INPUT_POST, "tipo", FILTER_DEFAULT);
        $texto = filter_input(INPUT_POST, "texto", FILTER_DEFAULT);
        $created_at = date('d/m/Y   |   H:i:s');
        $update_at = date('d/m/Y  |  H:i:s');
       
        if (isset($_POST["id"]) && !empty($_POST["id"])) {
            $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
          
            $editarCliente = new Cliente();
            $resposta = $editarCliente->editarCliente($id, $name, $email, $instagram, $facebook, $redes, $tipo, $texto, $update_at);
            if($resposta = 1) header('location: ../../cliente.php?mensagem=sucesso');
            else header('location: ../views/cliente.php?mensagem=erro');
        } else {
            $adicionarCliente = new Cliente();
            $resposta = $adicionarCliente->adicionarCliente($name, $email, $instagram, $facebook, $redes, $tipo, $texto, $created_at);
            if($resposta = 1) header('location: ../../cliente.php?mensagem=sucesso');
            else header('location: ../views/cliente.php?mensagem=erro');
        }
    }else{
        echo "Campos obrigatórios não preenchidos!!!";
    }
} elseif ($_GET) {
    if (isset($_GET["id"]) && !empty($_GET["id"]) && isset($_GET["acao"]) && !empty($_GET["acao"])) {
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $acao = filter_input(INPUT_GET, "acao", FILTER_SANITIZE_STRING);
        
        if($acao == "excluir"){
            $buscarCliente = new Cliente();
            $resposta = $buscarCliente->excluirCliente($id);
            if($resposta > 0)           
                header('location: ../../cliente.php?mensagem=sucesso');
            else {
                header('location: ../../cliente.php?mensagem=erro');
            }
        }
    }
}
