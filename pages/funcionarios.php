<?php
include_once("../pages/functions/php/functions.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<title>Funcionários</title>

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
                <h1 class="display-6">Funcionários</h1>
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
        <div class="row">
            <div class="col-sm-9">
                <a href="./API/views/funcionarios.php"><button type="button" class="btn btn-success">Cadastrar
                        Funcionário</button></a>
            </div>
            <div class="col-sm-3">
                <button type="button" class="copiar btn btn-dark" onclick="copyLink()" data-toggle="tooltip" data-placement="bottom" data-original-title="Link Copiado!">Link para Cadastro</button>
                <script>
                    function copyLink() {
                        var copyText = window.location.href;
                        navigator.clipboard.writeText('localhost/mibar/pages/API/views/cadastro.php');
                        $(".copiar").tooltip("show");
                    }
                </script>
            </div>
        </div>
        <hr>
        <?php
        require_once("./API/model/funcionarios.php");
        $listar = new Funcionarios();
        if ($retorno = $listar->listarTodosClientes())
            $dados = json_decode($retorno);

        if (isset($dados) && !empty($dados)) {
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
                                <th scope="col" class="ordenacao">#</th>
                                <th scope="col" class="nome">Nome</th>
                                <th scope="col" class="celular">Celular</th>
                                <th scope="col" class="status">Status</th>
                                <th scope="col" class="funcao">Função</th>
                                <th scope="col" class="acoes">AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($dados as $key => $value) {
                            ?>
                                <tr>
                                    <th scope="row" class="ordenacao"><?= $i++; ?></td>
                                    <td class="w-25 nome"><?= substr_replace($value->name, (strlen($value->name) > 30 ? '...' : ''), 30); ?></td>
                                    <td class="phone_with_ddd celular"><?= $value->celular; ?></td>
                                    <td class="status"><?= $value->status; ?></td>
                                    <td class="funcao"><?= substr_replace($value->funcao, (strlen($value->funcao) > 30 ? '...' : ''), 30); ?></td>
                                    <td class="acoes"><a href="./API/views/funcionarios.php?id=<?= $value->id; ?>&acao=buscar"><button type="button" class="apagarTexto btn btn-warning btn-sm acoes"><span class="bi bi-eye-fill"></span> Visualizar/Editar</button></a>
                                        <button type="button" class="apagarTexto btn btn-danger btn-sm acoes" data-toggle="modal" data-target="#excluir<?= $value->id; ?>"><span class="bi bi-trash-fill"></span> Excluir</button>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="excluir<?= $value->id; ?>" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="TituloModalCentralizado">Excluir Funcionário</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Deseja realmente excluir o Funcionário
                                                <b><?= $value->name; ?>?</b>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="./API/controller/funcionarios.php?id=<?= $value->id; ?>&acao=excluir"><button type="button" class="btn btn-danger btn-sm">Sim</button></a>
                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Não</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
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