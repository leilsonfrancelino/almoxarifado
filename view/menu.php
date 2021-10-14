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
                            } ?>" href="lista_departamentos.php">
            <i class="fa fa-sitemap"></i>
            <span>Departamentos</span>
        </a>	
	</li>
	<li class="nav-item">
        <a class="nav-link <?php if ($pagina == "painel") {
                                echo "active";
                            } ?>" href="lista_grupos.php">
            <i class="fa fa-users"></i>
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
	
</ul>