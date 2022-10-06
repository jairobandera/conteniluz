<?php
include '../../config.php';//BD
session_start();
$id_usuario = $_SESSION['id_usuario'];	

$conectado = conectar();
$resultado = $conectado->query("SELECT * FROM empresa");
$empresas = $resultado->fetch_all(MYSQLI_ASSOC);

include 'Template/head.php';

?>

<body class="bg-theme bg-theme2">
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="../../assets/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Conteniluz</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Panel administrador</div>
					</a>
					<ul>
						<li> <a href="acciones/agregarEmpresas.php"><i class="bx bx-right-arrow-alt"></i>Agregar Empresas</a>
						</li>
						<li> <a href="pagos.php"><i class="bx bx-right-arrow-alt"></i>Pagos</a>
						</li>
                        <li> <a href="acciones/cuentas.php"><i class="bx bx-right-arrow-alt"></i>Crear Cuentas</a>
						</li>
						<li> <a href="usuarios.php"><i class="bx bx-right-arrow-alt"></i>Ver Cuentas</a>
						</li>
						<li><a href="../cerrar.php"><i class="bx bx-right-arrow-alt"></i>Cerrar Sesion</a></li>
					</ul>
				</li>
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<!--<img src="../../assets/assets/images/avatars/avatar-2.png" class="user-img" alt="user avatar">-->	
							<div class="user-info ps-3">
								<p class="user-name mb-0"><?php echo $_SESSION['nombre_admin']; ?></p>
								<p class="designattion mb-0"><?php echo $_SESSION['apellido_admin']; ?></p>
							</div>
						</a>
					</div>
				</nav>
			</div>
		</header>
		<!--end header -->
        <div class="page-wrapper">
            <div class="page-content">
                <h6 class="mb-0 text-uppercase">Empresas</h6>
                    <hr/>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4">
                    <?php
      					foreach ($empresas as $empresa) { ?>

                        <div class="col"><!-- inicio card -->
                            <div class="card">
                                <img src="../../uploads/empresas/<?php echo $empresa["miniatura"] ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $empresa["nombre_empresa"] ?></h5>   
                                    <a href="acciones/editarEmpresas.php?id_empresa=<?php echo $empresa["id"] ?>" style="margin-top:5px;" class="btn btn-info">Editar</a>
									<a href="acciones/eliminarEmpresas.php?id_empresa=<?php echo $empresa["id"] ?>" style="margin-top:5px;" class="btn btn-danger">Eliminar</a>
									<a href="acciones/agregarCursos.php?id_empresa=<?php echo $empresa["id"] ?>" style="margin-top:5px;" class="btn btn-success">Agregar Cursos</a> 
									<a href="acciones/verCursos.php?id_empresa=<?php echo $empresa["id"] ?>" style="margin-top:5px;" class="btn btn-warning">Ver Cursos</a>                            
                                </div>
                            </div>
                        </div><!-- fin card -->
                    <?php } ?>
                    </div>
            </div><!-- fin page-content -->
        </div><!-- fin page-wrapper -->
<?php
include 'Template/footer.php';
?>