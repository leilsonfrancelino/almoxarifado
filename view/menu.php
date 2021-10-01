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
	
</ul>