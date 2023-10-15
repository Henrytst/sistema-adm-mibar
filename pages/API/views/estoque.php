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
                    echo "<h3>Cadastrar Estoque</h3>";
                    $dadosPadrao = json_encode(
                        array(
                            0 => array(
                                "name" => "",
                                "categoria" => "",
                                "quantidade" => "",
                                "indisponiveis" => "",
                                "texto" => "",
                                "preco" => "",
                                "precoMedio" => "",
                                "status" => "",
                                "fornecedor" => "",
                                "created_at" => "",
                                "update_at" => "",
                                "id" => "",
                            )
                        )
                    );
                    $dados = json_decode($dadosPadrao);
                } else {
                    if (isset($_GET["id"]) && !empty($_GET["id"])) {
                        echo "<h3>Editar Estoque</h3>";
                        require_once("../model/estoque.php");
                        $id = filter_input(INPUT_GET, "id", FILTER_DEFAULT);
                        $buscarCliente = new Estoque();
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
                                <h5 class="modal-title" id="TituloModalCentralizado">Excluir Estoque</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                erro
                            </div>
                            <div class="modal-footer">
                                <a href="./API/controller/estoque.php?id=<?= $value->id; ?>&acao=excluir"><button type="button" class="btn btn-danger btn-sm">Sim</button></a>
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
                <form action="../controller/estoque.php" method="POST">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Nome Do Estoque</label>
                                <input type="text" class="form-control" name="name" id="name" value="<?= $value->name; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Categoria</label>
                                <input type="text" class="form-control" name="categoria" id="categoria" value="<?= $value->categoria; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Quantidade</label>
                                <input type="number" class="form-control" name="quantidade" id="quantidade" value="<?= $value->quantidade; ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Indisponíveis</label>
                                <input type="number" class="form-control" name="indisponiveis" id="indisponiveis" value="<?= $value->indisponiveis; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option name="status" id="status" selected style="display:none"><?= $value->status; ?></option>
                                    <option name="status" id="status" value="<?= $value->status = 'OK'; ?>">OK</option>
                                    <option name="status" id="status" value="<?= $value->status = 'Em Falta'; ?>">Em Falta</option>
                                </select>
                                <!--<input type="text" class="form-control" name="status" id="status" value="">-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <label>Observações</label>
                            <div class="form-floating">
                                <textarea class="form-control" name="texto" id="texto" style="height: 200px"><?= $value->texto; ?></textarea>
                                <label for="texto">Faça um comentário aqui:</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Preço</label>
                                <input type="text" class="form-control money" name="preco" id="preco" value="<?= $value->preco; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Preço Médio</label>
                                <input type="text" class="form-control money" name="precoMedio" id="precoMedio" value="<?= $value->precoMedio; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Último Fornecedor</label>
                                <input type="text" class="form-control" name="fornecedor" id="fornecedor" value="<?= $value->fornecedor; ?>">
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
                            <a href="../../estoque.php" class="btn btn-danger">Cancelar</a>
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