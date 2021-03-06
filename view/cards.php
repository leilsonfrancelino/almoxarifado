<?php
require "../dao/conexao.php";

//select Excesso de estoque
$sql_excesso = "SELECT * FROM produtos WHERE quantidade > 10";
$result_excesso = mysqli_query($conexao, $sql_excesso);
$row_excesso = mysqli_num_rows($result_excesso);

//Abaixo do limite de estoque
$sql_abaixo = "SELECT * FROM produtos WHERE quantidade < 5";
$result_abaixo = mysqli_query($conexao, $sql_abaixo);
$row_abaixo = mysqli_num_rows($result_abaixo);

//select estoque total
$sql_total = "SELECT SUM(valor_unidade*quantidade) as total FROM produtos";
$result_total = mysqli_query($conexao, $sql_total);

?>

<style>
    .cor {
        background-color: seagreen;
    }
    .fa-dinh{
        color: darkgreen;
    }
    .fa-alto{
        color:darkorange;
    }
    .fa-baixo{
        color: red;
    }
    .fa-cad{
        color: blue;
    }
</style>

<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-chart-area"></i>
        Alertas e Avisos
    </div>
    <div class="card-body">
        <div class="row">
           
            <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-dark bg-outline-dark o-hidden h-100">
                    <div class="card-body">
                        <div>Estoque Máximo:<strong><?php echo " " . $row_excesso; ?></strong></div>
                        <p style="font-size:70%;">Produtos com quantidade maior a : 10 unidades.</p>
                    </div>
                    <a class="cursor card-footer text-dark clearfix small z-1" data-toggle="collapse" data-target="#collapseExcesso" aria-expanded="false" aria-controls="collapseExcesso">
                        <span class="float-left">Ver detalhes</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-dark bg-outline-dark o-hidden h-100">
                    <div class="card-body">                        
                        <div>Estoque Mínimo:<strong><?php echo " " . $row_abaixo; ?></strong></div>
                        <p style="font-size:70%;">Produtos com quantidade menor a : 5 unidades. </p>
                    </div>
                    <a class="cursor card-footer text-dark clearfix small z-1" data-toggle="collapse" data-target="#collapseAbaixo_estoque" aria-expanded="false" aria-controls="collapseAbaixo_estoque">
                        <span class="float-left">Ver Detalhes</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-dark bg-outline-dark o-hidden h-100">
                    <div class="card-body">                        
                        <div>Valor em estoque atual:</div>

                        <!-- total estoque -->
                        <?php while ($dados_total = mysqli_fetch_array($result_total)) {
                            ?> <strong>R$ <?php
                                                $valor_total_formatado = number_format($dados_total['total'], 2, ',', '.');
                                                echo $valor_total_formatado; ?></strong>
                        <?php
                        }
                        ?>
                        <p style="font-size:70%;">Estoque em tempo real. </p>
                    </div>
                    <a href="lista_estoque.php" class="cursor card-footer text-dark clearfix small z-1" aria-expanded="false">
                        <span class="float-left">Verificar estoque</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>

        </div>

        

        <!-- Colapse excesso -->
        <div class="collapse" id="collapseExcesso">
            <div class="card card-body alert alert-warning" role="alert">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fas fa-archive"></i>
                                Produtos com estoque acima do máximo:</div>
                            <div class="card-body">

                                <?php if ($row_excesso >= 1) { ?>
                                    <!--Tabela excesso -->
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">Descrição</th>
                                                <th scope="col">Quantidade</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                require "modais/modal_saida.php";
                                                while ($dados_excesso = mysqli_fetch_array($result_excesso)) {
                                                    echo "<tr>";
                                                    echo "<th scope='row'>" . $dados_excesso['codigo'] . "</th>";
                                                    echo  "<td>" . $dados_excesso['descricao'] . "</td>";
                                                    echo  "<td>" . $dados_excesso['quantidade'] . "</td>";                                                    
                                                    echo "<tr>";
                                                } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    Nenhum produto com excesso de estoque hoje ! <i class="fas fa-fw fa-check-circle"></i>
                                <?php } ?>

                            </div>
                            <div class="card-footer small text-muted"> Atualizado em :
                                <?php date_default_timezone_set('America/Sao_Paulo');
                                $date = date('d-m-y H:i');
                                echo $date; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Colapse Abaixo estoque-->
        <div class="collapse" id="collapseAbaixo_estoque">
            <div class=" card card-body alert alert-danger" role="alert">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fas fa-archive"></i>
                                Produtos com estoque abaixo do mínimo:</div>
                            <div class="card-body">

                                <?php if ($row_abaixo >= 1) { ?>
                                    <!--Tabela abaixo estoque -->
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">Descrição</th>
                                                <th scope="col">Quantidade</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                require "modais/modal_entrada.php";
                                                while ($dados_abaixo = mysqli_fetch_array($result_abaixo)) {
                                                    echo "<tr>";
                                                    echo "<th scope='row'>" . $dados_abaixo['codigo'] . "</th>";
                                                    echo  "<td>" . $dados_abaixo['descricao'] . "</td>";
                                                    echo  "<td>" . $dados_abaixo['quantidade'] . "</td>";                                                  
                                                    echo "<tr>";
                                                } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    Nenhum produto abaixo do estoque hoje ! <i class="fas fa-fw fa-check-circle"></i>
                                <?php } ?>
                            </div>
                            <div class="card-footer small text-muted"> Atualizado em :
                                <?php date_default_timezone_set('America/Sao_Paulo');
                                $date = date('d-m-y H:i');
                                echo $date; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>