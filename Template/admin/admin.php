<?php
session_start();
include '../../config.php';//BD

if(!isset($_SESSION['id_usuario'])){
	echo '<script>window.location.href = "../login.php";</script>';
}

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
					<h4 class="logo-text">InstituZion</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="javascript:;" class="has-arrow" aria-expanded="true">
						<div class="parent-icon"><img src="../../assetsNuevo/iconos/home2.gif" width="30px" height="">
						</div>
						<div class="menu-title">Panel administrador</div>
					</a>
					<ul class="mm-collapse mm-show">
						<li> <a href="acciones/agregarEmpresas.php"><img src="../../assetsNuevo/iconos/mas2.gif" width="40px" height="">Agregar Empresas</a>
						</li>
						<li> <a href="pagos.php"><img src="../../assetsNuevo/iconos/pagos2.gif" width="40px" height="">Pagos</a>
						</li>
                        <li> <a href="acciones/cuentas.php"><img src="../../assetsNuevo/iconos/cuentas2.gif" width="40px" height="">Crear Cuentas</a>
						</li>
						<li> <a href="usuarios.php"><img src="../../assetsNuevo/iconos/pass2.gif" width="40px" height="">Ver Cuentas</a>
						<li> <a href="mpp.php"><img src="../../assetsNuevo/iconos/mas2.gif" width="40px" height="">Agregar Payapal/Mp</a>
						</li>
						</li>
						<li><a href="../cerrar.php"><img src="../../assetsNuevo/iconos/exit2.gif" width="40px" height="">Cerrar Sesion</a></li>
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
					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center">
						<img src="../../assetsNuevo/iconos/usuario2.gif" width="40px" height="">
							<li class="nav-item dropdown dropdown-large">
								<p class="user-name mb-0"><?php echo $_SESSION['nombre_admin']; ?></p>
								<p class="designattion mb-0"><?php echo $_SESSION['apellido_admin']; ?></p>
							</li>
							<li class="nav-item dropdown dropdown-large">
								<div class="dropdown-menu dropdown-menu-end">
									<div class="header-notifications-list">
									</div>
								</div>
							</li>
							<li class="nav-item dropdown dropdown-large">
								<div class="dropdown-menu dropdown-menu-end">
									<div class="header-message-list">
									</div>
								</div>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<!--end header -->
        <div class="page-wrapper">
            <div class="page-content">
                <h6 class="mb-0 text-uppercase"><img src="../../assetsNuevo/iconos/empresas2.gif" width="40px" height=""> Empresas</h6>
                    <hr/>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4">
                    <?php
      					foreach ($empresas as $empresa) { ?>

                        <div class="col"><!-- inicio card -->
                            <div class="card">
                                <img src="../../uploads/empresas/<?php echo $empresa["miniatura"] ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $empresa["nombre_empresa"] ?></h5>   
                                    <a href="acciones/editarEmpresas.php?id_empresa=<?php echo $empresa["id"] ?>" class="btn"><img src="../../assetsNuevo/iconos/editar2.gif" width="30px" height="">Editar</a>
									<a onclick="" id="eliminarEmpresas" href="acciones/eliminarEmpresas.php?id_empresa=<?php echo $empresa["id"] ?>" class="btn"><img src="../../assetsNuevo/iconos/borrar2.gif" width="30px" height="">Eliminar</a>
									<a href="acciones/agregarCursos.php?id_empresa=<?php echo $empresa["id"] ?>"  class="btn"><img src="../../assetsNuevo/iconos/mas2.gif" width="30px" height="">Agregar Cursos</a> 
									<a href="acciones/verCursos.php?id_empresa=<?php echo $empresa["id"] ?>" class="btn"><img src="../../assetsNuevo/iconos/pass2.gif" width="30px" height="">Ver Cursos</a>                            
                                </div>
                            </div>
                        </div><!-- fin card -->
                    <?php } ?>
                    </div>
					<?php
						if(isset($_SESSION['success'])){
							echo '<script>alertaCrearCursos(1);</script>'; 
							//echo '<script>alertaCrearEmpresas(1);</script>';  
							//echo '<script>alertaEliminarEmpresas(1);</script>';                                                          
							//echo '<div class="alert alert-success" style="color:green;" role="alert">'.$_SESSION['success'].'</div>';
							unset($_SESSION['success']);
						}else{
							if(isset($_SESSION['error'])){
								echo '<script>alertaCrearCursos(2);</script>'; 
								//echo '<script>alertaCrearEmpresas(2);</script>';  
								//echo '<script>alertaEliminarEmpresas(2);</script>';                                                          
								echo '<div class="alert alert-danger" style="color:red;" role="alert">'.$_SESSION['error'].'</div>';
								unset($_SESSION['error']);
							}
						}
					?>
            </div><!-- fin page-content -->
        </div><!-- fin page-wrapper -->

		<style>
			.btn{
				margin-top:5px;
				padding: 10px 37px 10px 37px;
				background-color: grey;
				color:white;
				border-color:white;
				font-weight: 400;
			}
			.btn:hover{
				background-color: black;
				color:white;
				border-color:white;
			}
		</style>
