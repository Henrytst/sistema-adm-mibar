<?php
include_once("../pages/functions/php/functions.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<title>Sucesso!</title>

<head>
    <?php
    head();
    ?>
</head>

<body style="background-color:#212529;">
        <div class="row d-flex justify-content-center" style="transform: translate(0%, 100%);">
            <div class="col-sm-8">
                <?php
                if (isset($_GET["mensagem"]) && !empty($_GET["mensagem"])) {
                    $mensagem =  filter_input(INPUT_GET, "mensagem", FILTER_SANITIZE_STRING);
                    if ($mensagem == "sucesso") {
                ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="alert-heading">Agradecemos pelo tempo disponibilizado!!!</h4>
                            <hr>
                            <p>Cadastro realizado com sucesso!!!</p>
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
    rodape();
    ?>
</body>

</html>