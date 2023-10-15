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
                    echo "<h3>Cadastrar Cliente</h3>";
                    $dadosPadrao = json_encode(
                        array(
                            0 => array(
                                "name" => "",
                                "email" => "",
                                "instagram" => "",
                                "facebook" => "",
                                "redes" => "",
                                "tipo" => "",
                                "texto" => "",
                                "created_at" => "",
                                "update_at" => "",
                                "id" => "",
                            )
                        )
                    );
                    $dados = json_decode($dadosPadrao);
                } else {
                    if (isset($_GET["id"]) && !empty($_GET["id"])) {
                        echo "<h3>Editar cliente</h3>";
                        require_once("../model/cliente.php");
                        $id = filter_input(INPUT_GET, "id", FILTER_DEFAULT);
                        $buscarCliente = new Cliente();
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
                                <h5 class="modal-title" id="TituloModalCentralizado">Excluir Funcionário</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                erro
                            </div>
                            <div class="modal-footer">
                                <a href="./API/controller/cliente.php?id=<?= $value->id; ?>&acao=excluir"><button type="button" class="btn btn-danger btn-sm">Sim</button></a>
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
                <form action="../controller/cliente.php" method="POST">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="name" id="name" value="<?= $value->name; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" id="email" value="<?= $value->email; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Instagram</label>
                                <input type="text" class="form-control" name="instagram" id="instagram" value="<?= $value->instagram; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Facebook</label>
                                <input type="text" class="form-control" name="facebook" id="facebook" value="<?= $value->facebook; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Outras Redes Sociais</label>
                                <input type="text" class="form-control" name="redes" id="redes" value="<?= $value->redes; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Tipo</label>
                                <input type="text" class="form-control" name="tipo" id="tipo" value="<?= $value->tipo; ?>">
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
                            <a href="../../cliente.php" class="btn btn-danger">Cancelar</a>
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