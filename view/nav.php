<style>
    .cor {
        background-color: #e67e00;
    }
</style>
<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="painel.php"><img style="width:75%; margin-right:-10px;" src="../imagens/logo.png"></a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>
  

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Realmente deseja sair ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecione "Sair" abaixo para terminar sua sessão.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" style="width:20%" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" style="width:20%;" href="../valida/logout.php"><div style="color:white;">Sair</div></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
	<div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
		<ul class="navbar-nav ml-auto ml-md-0">
			<li class="nav-item dropdown no-arrow">
				<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-user-circle fa-fw"></i>
				</a>
				
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">					
					<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Sair</a>
				</div>
			</li>
		</ul>
    </div>
</nav>