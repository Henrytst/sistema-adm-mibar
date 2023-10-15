<?php
session_start();

if (!isset($_SESSION["nome"])) {
    header("location: ../index.php");
    exit;
}

function head()
{
?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/mibar/pages/CSS/bootstrap4.min.css">
    <link rel="stylesheet" href="cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="/mibar/pages/CSS/style.css">
    <link rel="stylesheet" href="/mibar/pages/CSS/estilo.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<?php
}

function menu()
{

    include('/Xampp/htdocs/mibar/pages/protect.php');
?>
    <nav class="navbar navbar-expand-md navbar-inverse navbar-default fixed-top">
        <div class="container">
            <h1 class="navbar-brand">Menu</h1>
            <div class="navbar-header" style="padding:10px;">
                <button class="navbar-toggler float-right" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="bi bi-list" style="font-size: 30px; color:aliceblue;"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="navbar">
                <ul id="menu-principal" class="nav navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/mibar/pages/funcionarios.php">Funcionários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/mibar/pages/coqueteis.php">Coquetéis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/mibar/pages/estoque.php">Estoque</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/mibar/pages/fornecedor.php">Fornecedor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/mibar/pages/preparo.php">Preparo</a>
                    </li>
                    <!--erros de conflito com o header do modal a partir de mais de 5 itens na navbar-->
                    <li class="nav-item">
                        <a class="nav-link" href="/mibar/pages/cliente.php">Clientes</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/mibar/pages/logout.php"><span class="bi bi-power"></span> Sair!</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div style="position:relative; top:48px;" class="box">
        <header id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h2><span class="bi bi-gear-fill" aria-hidden="true"></span> painel de controle</h2>
                    </div>
                    <div class="col-md-4">
                        <p class="bi bi-clock"> <span id="data-hora"></span></p>
                    </div>
                </div>
            </div>
        </header>
    <?php
}

function rodape()
{
    ?>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
        </script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
        <script type="text/javascript" src="/mibar/pages/functions/js/jquerymask/dist/jquery.mask.min.js"></script>
        <script type="text/javascript" src="/mibar/pages/functions/js/mascaras.js"></script>
        <script type="text/javascript" src="/mibar/pages/functions/js/functions.js"></script>
        <script type="text/javascript" src="/mibar/pages/functions/js/dataTables-PT-BR.js"></script>
    <?php
}

function headFormulario()
{
    ?>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="/mibar/pages/CSS/style.css">
        <link rel="stylesheet" href="/mibar/pages/CSS/estilo.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <?php
}

function rodapeFormulario()
{
    ?> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">

        </script>
        <!-- Adicionando JQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <!-- Adicionando Javascript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script type="text/javascript" src="/mibar/pages/functions/js/jquerymask/dist/jquery.mask.min.js"></script>
        <script type="text/javascript" src="/mibar/pages/functions/js/mascaras.js"></script>
        <script type="text/javascript" src="/mibar/pages/functions/js/functions.js"></script>
    <?php
}
