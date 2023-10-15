<?php
include_once("../pages/functions/php/functions.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<title>Comercial</title>

<head>
    <?php
    head();
    ?>
</head>

<body>
    <?php
    menu();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-10">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <h1 class="display-6">Comercial</h1>
            </div>
            <div class="col-sm-4">
                <h2 class="display-6">Bem vindo, <?php echo $_SESSION['nome']; ?>.</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <?php
                if (isset($_GET["mensagem"]) && !empty($_GET["mensagem"])) {
                    $mensagem =  filter_input(INPUT_GET, "mensagem", FILTER_SANITIZE_STRING);
                    if ($mensagem == "sucesso") {
                ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="alert-heading">Sucesso!!!</h4>
                            <hr>
                            <p>Operacação realizada com sucesso!!!</p>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            Ocorreu um erro em sua operação!!!
                        </div>
                <?php
                    }
                } else {
                    echo " ";
                }
                ?>
            </div>
        </div>
        <?php
        require_once("./API/model/estoque.php");
        $listar = new Estoque();
        if ($retorno = $listar->listarTodosClientes())
            $dados = json_decode($retorno);

        require_once("./API/model/preparo.php");
        $listar2 = new Preparo();
        if ($retorno = $listar2->listarTodosClientes())
            $dados2 = json_decode($retorno);

        if (isset($dados) && !empty($dados) || isset($dados2) && !empty($dados2)) {
        ?>
            <div class="row">
                <div class="col-sm-12 border border-secondary">
                    <div class="row">
                        <div class="col-sm-10">
                            &nbsp;
                        </div>
                    </div>

                    <table class="table table-striped w-100" id="table_id">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Preço</th>
                                <th scope="col">AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($dados as $key => $value) {
                            ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></td>
                                    <td><?= substr_replace($value->name, (strlen($value->name) > 30 ? '...' : ''), 30); ?></td>
                                    <td><?= substr_replace($value->categoria, (strlen($value->categoria) > 30 ? '...' : ''), 30);; ?></td>
                                    <td>R$ <?= number_format($value->preco, '2', ',', '.'); ?></td>
                                    <td><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#adicionar<?= $value->id; ?>">Adicionar ao Carrinho</button>
                                        <a href="./API/views/estoque.php?id=<?= $value->id; ?>&acao=buscar"><button type="button" class="btn btn-warning btn-sm">Visualizar/Editar</button></a>
                                    </td>
                                </tr>
                                <?php
                                foreach ($dados2 as $key => $value) {
                                ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></td>
                                        <td><?= $value->name; ?></td>
                                        <td><?= $value->categoria; ?></td>
                                        <td>R$ <?= number_format($value->preco, '2', ',', '.'); ?></td>
                                        <td><a href="?adicionar?id=<?= $value->id; ?>&acao=buscar"><button type="button" class="btn btn-success btn-sm">Adicionar ao Carrinho</button></a>
                                            <a href="./API/views/preparo.php?id=<?= $value->id; ?>&acao=buscar"><button type="button" class="btn btn-warning btn-sm">Visualizar/Editar</button></a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="row">
                <div class="col-12">
                    <p>Não há registros armazenados na base de dados!!!</p>
                </div>
            </div>

        <?php
        }
        ?>

    </div>
    <?php
    rodape();
    ?>
</body>

</html>