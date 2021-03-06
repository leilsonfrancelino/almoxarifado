<!-- Sidebar -->
<ul class="sidebar navbar-nav">
    <li class="nav-item">
        <a class="nav-link <?php if ($pagina == "painel") {
                                echo "active";
                            } ?>" href="painel.php">
            <i class="fas fa-fw fa-university"></i>
            <span>Painel Principal</span>
        </a>
    </li>
	
	<li class="nav-item">
        <a class="nav-link <?php if ($pagina == "painel") {
                                echo "active";
                            } ?>" href="lista_clientes.php">
            <i class="fa fa-address-book"></i>
            <span>Clientes</span>
        </a>
	</li>	
	<li class="nav-item">
        <a class="nav-link <?php if ($pagina == "painel") {
                                echo "active";
                            } ?>" href="lista_grupos.php">
            <i class="fas fa-object-group"></i>
            <span>Grupo de Produtos</span>
        </a>
	</li>
	<li class="nav-item">
        <a class="nav-link <?php if ($pagina == "painel") {
                                echo "active";
                            } ?>" href="lista_fornecedores.php">
            <i class="fas fa-fw fa-industry"></i>
            <span>Fornecedores</span>
        </a>
    </li>
	<li class="nav-item">
        <a class="nav-link <?php if ($pagina == "painel") {
                                echo "active";
                            } ?>" href="lista_produtos.php">
            <i class="fas fa-fw fa-folder"></i>
            <span>Produtos</span>
        </a>
	</li>
	<li class="nav-item">
        <a class="nav-link <?php if ($pagina == "painel") {
                                echo "active";
                            } ?>" href="lista_estoque.php">
            <i class="fas fa-fw fa-archive"></i>
            <span>Estoque</span>
        </a>
	</li>
	<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-book"></i>
            <span>Relat??rios</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Op????es:</h6>
			<a class="dropdown-item" href="relatorio_movimentacoes.php">Movimenta????es</a> 
            <a class="dropdown-item" href="relatorio_produtos.php">Produtos</a> 			
            <div class="dropdown-divider"></div>
        </div>
    </li>
	
</ul>