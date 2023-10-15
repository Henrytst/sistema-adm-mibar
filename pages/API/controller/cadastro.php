<?php

session_start();

if (!isset($_SESSION["nome"])) {
    header("location: ../../../index.php");
    exit;
}

require_once('../model/funcionarios.php');

if ($_POST) {
    
    if (
        isset($_POST["name"]) && !empty($_POST["name"])
    ) {
        //Verificação de CPF existente
        $listar = new Funcionarios();
        if ($retorno = $listar->listarTodosClientes())
            $dados = json_decode($retorno);
            foreach ($dados as $key => $value)
            if ($value->cpf === $_POST['cpf']){
                die('CPF já cadastrado!');
            }
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
            if($extensao != 'jpg'&& $extensao != 'jpeg' && $extensao != 'png'){
                die('tipo de arquivo não aceito');
            }
            $path = $caminho_arquivo . $uniqid_arquivo . "." . $extensao;

            move_uploaded_file($arquivo["tmp_name"], $path);
            $arquivo = $path;
        } else {
            $arquivo = filter_input(INPUT_POST, "arquivo_gravado", FILTER_DEFAULT);
        }
        //inserção dos dados nas variaveis
        date_default_timezone_set('America/Sao_Paulo');
        $arquivo;
        $nome_arquivo = filter_input(INPUT_POST, "nome_arquivo", FILTER_DEFAULT);
        $diretorio = filter_input(INPUT_POST, "diretorio", FILTER_DEFAULT);
        $name = filter_input(INPUT_POST, "name", FILTER_DEFAULT);
        $nascimento = filter_input(INPUT_POST, "nascimento", FILTER_DEFAULT);
        $idade = filter_input(INPUT_POST, "idade", FILTER_DEFAULT);
        $sexo = filter_input(INPUT_POST, "sexo", FILTER_DEFAULT);
        $rg = filter_input(INPUT_POST, "rg", FILTER_DEFAULT);
        $cpf = filter_input(INPUT_POST, "cpf", FILTER_DEFAULT);
        $tatuagem = filter_input(INPUT_POST, "tatuagem", FILTER_DEFAULT);
        $email = filter_input(INPUT_POST, "email", FILTER_DEFAULT);
        $cb = filter_input(INPUT_POST, "cb", FILTER_DEFAULT);
        $phone = filter_input(INPUT_POST, "phone", FILTER_DEFAULT);
        $celular = filter_input(INPUT_POST, "celular", FILTER_DEFAULT);
        $camisa = filter_input(INPUT_POST, "camisa", FILTER_DEFAULT);
        $calca = filter_input(INPUT_POST, "calca", FILTER_DEFAULT);
        $terno = filter_input(INPUT_POST, "terno", FILTER_DEFAULT);
        $calcado = filter_input(INPUT_POST, "calcado", FILTER_DEFAULT);
        $peso = filter_input(INPUT_POST, "peso", FILTER_DEFAULT);
        $altura = filter_input(INPUT_POST, "altura", FILTER_DEFAULT);
        $status = filter_input(INPUT_POST, "status", FILTER_DEFAULT);
        $funcao = filter_input(INPUT_POST, "funcao", FILTER_DEFAULT);
        $idiomas = filter_input(INPUT_POST, "idiomas", FILTER_DEFAULT);
        $escolaridade = filter_input(INPUT_POST, "escolaridade", FILTER_DEFAULT);
        $disponibilidade = filter_input(INPUT_POST, "disponibilidade", FILTER_DEFAULT);
        $observacoes = filter_input(INPUT_POST, "observacoes", FILTER_DEFAULT);
        $complemento = filter_input(INPUT_POST, "complemento", FILTER_DEFAULT);
        $created_at = date('d/m/Y   |   H:i:s');
        $update_at = date('d/m/Y  |  H:i:s');

        if (isset($_POST["id"]) && !empty($_POST["id"])) {
            $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

            $editarCliente = new Funcionarios();
            $resposta = $editarCliente->editarCliente(
                $id,
                $arquivo,
                $nome_arquivo,
                $diretorio,
                $name,
                $nascimento,
                $idade,
                $sexo,
                $rg,
                $cpf,
                $tatuagem,
                $email,
                $cb,
                $phone,
                $celular,
                $camisa,
                $calca,
                $terno,
                $calcado,
                $peso,
                $altura,
                $status,
                $funcao,
                $idiomas,
                $escolaridade,
                $disponibilidade,
                $observacoes,
                $complemento,
                $update_at
            );
            if ($resposta = 1) header('location: ../../cadastro.php?mensagem=sucesso');
            else header('location: ../views/cadastro.php?mensagem=erro');
        } else {
            $adicionarCliente = new Funcionarios();
            $resposta = $adicionarCliente->adicionarCliente(
                $arquivo,
                $nome_arquivo,
                $diretorio,
                $name,
                $nascimento,
                $idade,
                $sexo,
                $rg,
                $cpf,
                $tatuagem,
                $email,
                $cb,
                $phone,
                $celular,
                $camisa,
                $calca,
                $terno,
                $calcado,
                $peso,
                $altura,
                $status,
                $funcao,
                $idiomas,
                $escolaridade,
                $disponibilidade,
                $observacoes,
                $complemento,
                $created_at
            );
            if ($resposta = 1) header('location: ../../cadastro.php?mensagem=sucesso');
            else header('location: ../views/cadastro.php?mensagem=erro');
        }
    } else {
        echo "Campos obrigatórios não preenchidos!!!";
    }
} 
