<?php

session_start();

if (!isset($_SESSION["nome"])) {
    header("location: ../../../index.php");
    exit;
}

require_once('../model/coqueteis.php');

if ($_POST) {

    if (
        isset($_POST["nome"]) && !empty($_POST["nome"])
    ) {
        //verificação de arquivo existente e upload
        $nome_arquivo = filter_input(INPUT_POST, "nome_arquivo", FILTER_DEFAULT);
        $arquivo = filter_input(INPUT_POST, "arquivo_gravado", FILTER_DEFAULT);
        if ($_FILES['arquivo']['size'] != 0) {
            if (
                ($_FILES['arquivo']['size'] != 0) && !empty($_POST["arquivo_gravado"])
            ) {
                unlink($arquivo);
            }
            $caminho_arquivo = "/xampp/htdocs/mibar/pages/arquivos/";
            $arquivo = $_FILES["arquivo"];
            $nome_arquivo = $arquivo['name'];
            $uniqid_arquivo = uniqid();
            $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
            $path = $caminho_arquivo . $uniqid_arquivo . "." . $extensao;

            move_uploaded_file($arquivo["tmp_name"], $path);
            $arquivo = $path;
        } else {
            $arquivo = filter_input(INPUT_POST, "arquivo_gravado", FILTER_DEFAULT);
        }
        //inserção dos dados nas variaveis
        date_default_timezone_set('America/Sao_Paulo');
        $arquivo;
        $nome = filter_input(INPUT_POST, "nome", FILTER_DEFAULT);
        $baseAlcoolica = filter_input(INPUT_POST, "baseAlcoolica", FILTER_DEFAULT);
        $origem = filter_input(INPUT_POST, "origem", FILTER_DEFAULT);
        $autor = filter_input(INPUT_POST, "autor", FILTER_DEFAULT);
        $tipo = filter_input(INPUT_POST, "tipo", FILTER_DEFAULT);
        $receita = filter_input(INPUT_POST, "receita", FILTER_DEFAULT);
        $historia = filter_input(INPUT_POST, "historia", FILTER_DEFAULT);
        $created_at = date('d/m/Y   |   H:i:s');
        $update_at = date('d/m/Y  |  H:i:s');

        if (isset($_POST["id"]) && !empty($_POST["id"])) {
            $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

            $editarCoqueteis = new Coqueteis();
            $resposta = $editarCoqueteis->editarCliente(
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
            );
            if ($resposta = 1) header('location: ../../coqueteis.php?mensagem=sucesso');
            else header('location: ../views/coqueteis.php?mensagem=erro');
        } else {
            $adicionarCoqueteis = new Coqueteis();
            $resposta = $adicionarCoqueteis->adicionarCliente(
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
            if ($resposta = 1) header('location: ../../coqueteis.php?mensagem=sucesso');
            else header('location: ../views/coqueteis.php?mensagem=erro');
        }
    } else {
        echo "Campos obrigatórios não preenchidos!!!";
    }
} //deletar pelo id 
elseif ($_GET["acao"]) {
    if (isset($_GET["id"]) && !empty($_GET["id"]) && isset($_GET["acao"]) && !empty($_GET["acao"])) {
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $acao = filter_input(INPUT_GET, "acao", FILTER_DEFAULT);

        if ($acao == "excluir") {
            $buscarCoqueteis = new Coqueteis();
            $resposta = $buscarCoqueteis->carregarCliente($id);
            $dados = json_decode($resposta);
            foreach ($dados as $key => $value);
            unlink($value->arquivo);
            $resposta = $buscarCoqueteis->excluirCliente($id);
            if ($resposta > 0)
                header('location: ../../coqueteis.php?mensagem=sucesso');
            else {
                header('location: ../../coqueteis.php?mensagem=erro');
            }
        }
    }
} //deletar arquivo
elseif ($_GET["deletar"]) {
    if (isset($_GET["id"]) && !empty($_GET["id"]) && isset($_GET["arquivo"]) && !empty($_GET["arquivo"])) {
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $deletar = filter_input(INPUT_GET, "deletar", FILTER_DEFAULT);
        $arquivo = filter_input(INPUT_GET, "arquivo", FILTER_DEFAULT);

        if ($deletar == "excluir") {
            $buscarCoqueteis = new Coqueteis();
            $resposta = $buscarCoqueteis->carregarCliente($id);
            $dados = json_decode($resposta);
            foreach ($dados as $key => $value);
            unlink($value->arquivo);
            if (!file_exists($value->arquivo))
                header('location: \mibar\pages\API\views\coqueteis.php?id=' . $value->id . '&mensagem=sucesso');
            else {
                header('location: \mibar\pages\API\views\coqueteis.php?id=' . $value->id . '&mensagem=erro');
            }
        }
    }
}
