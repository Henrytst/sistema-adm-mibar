<?php
include_once("../../.././pages/functions/php/functions.php")
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
                    echo "<h3>Cadastrar Coquetel</h3>";
                    $dadosPadrao = json_encode(
                        array(
                            0 => array(
                                "arquivo" => "",
                                "nome" => "",
                                "baseAlcoolica" => "",
                                "origem" => "",
                                "autor" => "",
                                "tipo" => "",
                                "receita" => "",
                                "historia" => "",
                                "created_at" => "",
                                "update_at" => "",
                                "id" => "",
                            )
                        )
                    );
                    $dados = json_decode($dadosPadrao);
                } else {
                    if (isset($_GET["id"]) && !empty($_GET["id"])) {
                        echo "<h3>Editar Coquetel</h3>";
                        require_once("../model/coqueteis.php");
                        $id = filter_input(INPUT_GET, "id", FILTER_DEFAULT);
                        $buscarcoqueteis = new Coqueteis();
                        $resposta = $buscarcoqueteis->carregarCliente($id);
                        $dados = json_decode($resposta);
                    }
                }
                ?>
            </div>
        </div>
        <div class="row">
            <?php
            foreach ($dados as $key => $value)
            ?>
            <form enctype="multipart/form-data" action="../controller/coqueteis.php" method="POST">
                <div class="row">
                    <div class="col-md-0">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="arquivo_gravado" id="arquivo_gravado" value="<?= $value->arquivo ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Imagem</label>
                            <input type="file" class="form-control" name="arquivo" id="arquivo">
                        </div>
                        <?php if (file_exists($value->arquivo)) { ?>
                            <div class="form-group">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#excluir<?= $value->id; ?>">Excluir Imagem</button>
                            </div>
                        <?php } ?>
                        <div class="row justify-content-center">
                            <div class="form-group">
                                <div class="col-sm-13">
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
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <a href="../../arquivos/<?= substr($value->arquivo, 37); ?> " download="<?= $value->arquivo; ?>">
                                <img id="img" class="img container-image img-responsive img-thumbnail img-fluid mx-auto" <?php
                                                                                                                            if (file_exists($value->arquivo)) {
                                                                                                                            ?>src="../../arquivos/<?= substr($value->arquivo, 35);
                                                                                                                                                }  ?>" alt="">
                            </a>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nome Do Coquetel</label>
                            <input type="text" class="form-control" name="nome" id="nome" value="<?= $value->nome; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Base</label>
                            <input type="text" class="form-control" name="baseAlcoolica" id="baseAlcoolica" value="<?= $value->baseAlcoolica; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Origem</label>
                            <input type="text" class="form-control" name="origem" id="origem" value="<?= $value->origem; ?>">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Autor</label>
                            <input type="text" class="form-control" name="autor" id="autor" value="<?= $value->autor; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tipo</label>
                            <input type="text" class="form-control" name="tipo" id="tipo" value="<?= $value->tipo; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Receita</label>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Faça um comentário aqui." name="receita" id="receita" style="height: 200px"><?= $value->receita; ?></textarea>
                            <label for="receita">Faça um comentário aqui.</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>História</label>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Faça um comentário aqui." name="historia" id="historia" style="height: 200px"><?= $value->historia; ?></textarea>
                            <label for="historia">Faça um comentário aqui.</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Data de Cadastro</label>
                            <input type="text" class="form-control" name="created_at" id="created_at" value="<?= $value->created_at; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Última Modificação</label>
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
                        <a href="../../coqueteis.php" class="btn btn-danger">Cancelar</a>

                        <!-- Modal -->
                        <div class="modal fade" id="excluir<?= $value->id; ?>" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="TituloModalCentralizado">Excluir Imagem</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Deseja realmente excluir a Imagem
                                        <b><?= substr($value->arquivo, 35); ?>?</b>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="\mibar\pages\API\controller\coqueteis.php?id=<?= $value->id ?>&deletar=excluir&arquivo=<?= $value->arquivo ?>"><button type="button" class="btn btn-danger btn-sm">Sim</button></a>
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Não</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <footer>

                        </footer>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
    rodapeFormulario();
    ?>
</body>

</html>