<?php
include_once("/xampp/htdocs/mibar/pages/functions/php/functions.php")
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php
    headFormulario();
    ?>
</head>

<body>
<?php
    menu(); 
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?php
                if (!$_GET) {
                    echo "<h3>Cadastrar Fornecedor</h3>";
                    $dadosPadrao = json_encode(
                        array(
                            0 => array(
                                "name" => "",
                                "localizacao" => "",
                                "preco" => "",
                                "produto" => "",
                                "created_at" => "",
                                "update_at" => "",
                                "id" => "",
                            )
                        )
                    );
                    $dados = json_decode($dadosPadrao);
                } else {
                    if (isset($_GET["id"]) && !empty($_GET["id"])) {
                        echo "<h3>Editar Fornecedor</h3>";
                        require_once("../model/fornecedor.php");
                        $id = filter_input(INPUT_GET, "id", FILTER_DEFAULT);
                        $buscarCliente = new Fornecedor();
                        $resposta = $buscarCliente->carregarCliente($id);
                        $dados = json_decode($resposta);
                    }
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <!-- Modal -->
                <div class="modal fade" id="teste" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="TituloModalCentralizado">Excluir Fornecedor</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                erro
                            </div>
                            <div class="modal-footer">
                                <a href="./API/controller/fornecedor.php?id=<?= $value->id; ?>&acao=excluir"><button type="button" class="btn btn-danger btn-sm">Sim</button></a>
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Não</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            foreach ($dados as $key => $value)
            ?>
            <div class="col-sm-12">
                <form action="../controller/fornecedor.php" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="name" id="name" value="<?= $value->name; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Localização</label>
                                <input type="text" class="form-control" name="localizacao" id="localizacao" value="<?= $value->localizacao; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Produto</label>
                                <input type="text" class="form-control" name="produto" id="produto" value="<?= $value->produto; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Último Preço</label>
                                <input type="text" class="form-control money" name="preco" id="preco" value="<?= $value->preco; ?>" required>
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Criado Em</label>
                                    <input type="text" class="form-control" name="created_at" id="created_at" value="<?= $value->created_at; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Alterado Em</label>
                                    <input type="text" class="form-control" name="update_at" id="update_at" value="<?= $value->update_at; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                &nbsp;
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <?php
                                if ($value->id) {
                                ?>
                                    <input type="hidden" class="form-control" name="id" id="id" value="<?= $value->id; ?>">
                                    <button type="submit" class="btn btn-success">Editar</button>
                                <?php
                                } else {
                                ?>
                                    <button type="submit" class="btn btn-success">Cadastrar</button>
                                    <button type="reset" class="btn btn-warning">Limpar</button>
                                <?php
                                }
                                ?>
                                <a href="../../fornecedor.php" class="btn btn-danger">Cancelar</a>
                                <footer>

                        </footer>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    rodapeFormulario();
    ?>
</body>

</html>