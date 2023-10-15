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
                    echo "<h3>Cadastrar Funcionário</h3>";
                    $dadosPadrao = json_encode(
                        array(
                            0 => array(
                                "nome_arquivo" => "",
                                "diretorio" => "",
                                "arquivo" => "",
                                "name" => "",
                                "nascimento" => "",
                                "idade" => "",
                                "sexo" => "",
                                "email" => "",
                                "rg" => "",
                                "cpf" => "",
                                "tatuagem" => "",
                                "cb" => "",
                                "phone" => "",
                                "celular" => "",
                                "camisa" => "",
                                "calca" => "",
                                "terno" => "",
                                "calcado" => "",
                                "peso" => "",
                                "altura" => "",
                                "status" => "",
                                "funcao" => "",
                                "idiomas" => "",
                                "escolaridade" => "",
                                "disponibilidade" => "",
                                "observacoes" => "",
                                "complemento" => "",
                                "created_at" => "",
                                "update_at" => "",
                                "id" => "",
                            )
                        )
                    );
                    $dados = json_decode($dadosPadrao);
                } else {
                    if (isset($_GET["id"]) && !empty($_GET["id"])) {
                        echo "<h3>Editar Funcionário</h3>";
                        require_once("../model/funcionarios.php");
                        $id = filter_input(INPUT_GET, "id", FILTER_DEFAULT);
                        $buscarCliente = new Funcionarios();
                        $resposta = $buscarCliente->carregarCliente($id);
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
            <form enctype="multipart/form-data" action="../controller/funcionarios.php" method="POST">
                <div class="row">
                    <div class="col-md-0">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="arquivo_gravado" id="arquivo_gravado" value="<?= $value->arquivo; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Imagem</label>
                            <input type="file" class="form-control" name="arquivo" id="arquivo">
                        </div>
                        <div class="form-group">
                            <label>Nome do Arquivo</label>
                            <input type="text" class="form-control" name="nome_arquivo" id="nome_arquivo" value="<?= $value->nome_arquivo; ?>">
                        </div>
                        <div class="form-group">
                            <label>Diretório</label>
                            <input type="text" class="form-control" name="diretorio" id="diretorio" value="<?= $value->diretorio; ?>">
                        </div>
                        <?php  if (file_exists($value->arquivo)) { ?>
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
                            <a href="../../arquivos/<?= substr($value->arquivo, 37); ?> " download="<?= $value->nome_arquivo; ?>">
                                <img id="img" class="img container-image img-responsive img-thumbnail img-fluid mx-auto" <?php
                                                                                                                            if (file_exists($value->arquivo)) {
                                                                                                                            ?>src="../../arquivos/<?= substr($value->arquivo, 37);
                                                                                                                                                }  ?>" alt="">
                            </a>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="name" id="name" value="<?= $value->name; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Data de Nascimento</label>
                            <input type="date" class="form-control" name="nascimento" id="nascimento" value="<?= $value->nascimento; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <div class="form-group">
                            <label>Idade</label>
                            <input type="number" class="form-control" name="idade" id="idade" value="<?= $value->idade; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sexo</label>
                            <input type="text" class="form-control" name="sexo" id="sexo" value="<?= $value->sexo; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" id="email" value="<?= $value->email; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>RG</label>
                            <input type="text" class="form-control rg" name="rg" id="rg" value="<?= $value->rg; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>CPF</label>
                            <input type="text" class="form-control cpf" name="cpf" id="cpf" value="<?= $value->cpf; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tatuagem</label>
                            <select class="form-control" name="tatuagem" id="tatuagem">
                                <option name="tatuagem" id="tatuagem" selected style="display:none"><?= $value->tatuagem; ?></option>
                                <option name="tatuagem" id="tatuagem" value="<?= $value->tatuagem = 'Sim'; ?>">Sim</option>
                                <option name="tatuagem" id="tatuagem" value="<?= $value->tatuagem = 'Não'; ?>">Não</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Conta Bancária</label>
                            <input type="text" class="form-control" name="cb" id="cb" value="<?= $value->cb; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Telefone</label>
                            <input type="text" class="form-control phone" name="phone" id="phone" value="<?= $value->phone; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Celular</label>
                            <input type="text" class="form-control phone_with_ddd" name="celular" id="celular" value="<?= $value->celular; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Camisa</label>
                            <input type="text" class="form-control" name="camisa" id="camisa" value="<?= $value->camisa; ?>">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Calça</label>
                            <input type="text" class="form-control" name="calca" id="calca" value="<?= $value->calca; ?>">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Terno</label>
                            <input type="text" class="form-control" name="terno" id="terno" value="<?= $value->terno; ?>">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Calçado</label>
                            <input type="text" class="form-control" name="calcado" id="calcado" value="<?= $value->calcado; ?>">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Peso</label>
                            <input type="text" class="form-control" name="peso" id="peso" value="<?= $value->peso; ?>">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Altura(cm)</label>
                            <input type="text" class="form-control" name="altura" id="altura" value="<?= $value->altura; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Situação</label>
                            <select class="form-control" name="status" id="status">
                                <option name="status" id="status" selected style="display:none"><?= $value->status; ?></option>
                                <option name="status" id="status" value="<?= $value->status = 'Ativo'; ?>">Ativo</option>
                                <option name="status" id="status" value="<?= $value->status = 'Inativo'; ?>">Inativo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Função Predominante</label>
                            <input type="text" class="form-control" name="funcao" id="funcao" value="<?= $value->funcao; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Idiomas</label>
                            <input type="text" class="form-control" name="idiomas" id="idiomas" value="<?= $value->idiomas; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Escolaridade</label>
                            <input type="text" class="form-control" name="escolaridade" id="escolaridade" value="<?= $value->escolaridade; ?>">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Disponibilidade</label>
                            <input type="text" class="form-control" name="disponibilidade" id="disponibilidade" value="<?= $value->disponibilidade; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Observações</label>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Faça um comentário aqui." name="observacoes" id="observacoes" style="height: 200px"><?= $value->observacoes; ?></textarea>
                            <label for="observacoes">Faça um comentário aqui.</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Complemento</label>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Faça um comentário aqui." name="complemento" id="complemento" style="height: 200px"><?= $value->complemento; ?></textarea>
                            <label for="complemento">Faça um comentário aqui.</label>
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
                        <a href="../../funcionarios.php" class="btn btn-danger">Cancelar</a>

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
                                        <b><?= $value->nome_arquivo; ?>?</b>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="\shakers\pages\API\controller\funcionario.php?id=<?= $value->id ?>&deletar=excluir&arquivo=<?= $value->arquivo ?>"><button type="button" class="btn btn-danger btn-sm">Sim</button></a>
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