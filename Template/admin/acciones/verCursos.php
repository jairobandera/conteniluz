<?php
session_start();
include '../../../config.php';//BD

if(!isset($_SESSION['id_usuario'])){
	echo '<script>window.location.href = "../../login.php";</script>';
}


isset($_GET['id_empresa']) ? $idEmpresa = $_GET['id_empresa'] : $idEmpresa = '';

$conectado = conectar();
$resultado = $conectado->query("SELECT * FROM cursos WHERE id_empresa = $idEmpresa");
$cursos = $resultado->fetch_all(MYSQLI_ASSOC);

include 'Template/head.php';

?>

<body class="bg-theme bg-theme2">
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="../../../assets/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
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
					<a href="javascript:;" class="has-arrow" aria-expanded="true">
						<div class="parent-icon"><img src="../../../assetsNuevo/iconos/home2.gif" width="30px" height="">
						</div>
						<div class="menu-title">Panel administrador</div>
					</a>
					<ul class="mm-collapse mm-show">
						<li> <a href="agregarEmpresas.php"><img src="../../../assetsNuevo/iconos/mas2.gif" width="40px" height="">Agregar Empresas</a>
						</li>
						<li> <a href="../pagos.php"><img src="../../../assetsNuevo/iconos/pagos2.gif" width="40px" height="">Pagos</a>
						</li>
                        <li> <a href="cuentas.php"><img src="../../../assetsNuevo/iconos/cuentas2.gif" width="40px" height="">Crear Cuentas</a>
						</li>
						<li> <a href="../usuarios.php"><img src="../../../assetsNuevo/iconos/pass2.gif" width="40px" height="">Ver Cuentas</a>
						</li>
						<li><a href="../../cerrar.php"><img src="../../../assetsNuevo/iconos/exit2.gif" width="40px" height="">Cerrar Sesion</a></li>
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
						<img src="../../../assetsNuevo/iconos/usuario2.gif" width="40px" height="">
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
                <h6 class="mb-0 text-uppercase"><img src="../../../assetsNuevo/iconos/cursos2.gif" width="40px" height=""> Cursos</h6>
                    <hr/>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3">
                    <?php
      					foreach ($cursos as $curso) { ?>

                        <div class="col"><!-- inicio card -->
                            <div class="card">
                                <img src="../../../uploads/cursos/<?php echo $curso["miniatura"] ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $curso["titulo_curso"] ?></h5>   
									<a href="editarCursos.php?id_curso=<?php echo $curso["id"] ?>&id_empresa=<?php echo $idEmpresa; ?>&id_profesor=<?php echo $curso["id_profesor"] ?>" style="margin-top:5px;" class="btn btn-warning"><img src="../../../assetsNuevo/iconos/editar2.gif" width="40px" height="">Editar Curso</a>
                                    <a href="agregarVideos.php?id_curso=<?php echo $curso["id"] ?>&id_empresa=<?php echo $idEmpresa; ?>&id_profesor=<?php echo $curso["id_profesor"] ?>" style="margin-top:5px;" class="btn btn-success"><img src="../../../assetsNuevo/iconos/vimeo2.gif" width="40px" height="">Agregar Videos</a>
									<a href="editarVideos.php?id_curso=<?php echo $curso["id"] ?>&id_empresa=<?php echo $idEmpresa; ?>&id_profesor=<?php echo $curso["id_profesor"] ?>" style="margin-top:5px;" class="btn btn-warning"><img src="../../../assetsNuevo/iconos/editar2.gif" width="40px" height="">Editar Videos</a>
									<a href="verVideos.php?id_curso=<?php echo $curso["id"] ?>&id_empresa=<?php echo $idEmpresa; ?>&id_profesor=<?php echo $curso["id_profesor"] ?>" style="margin-top:5px;" class="btn btn-info"><img src="../../../assetsNuevo/iconos/pass2.gif" width="40px" height="">Ver videos</a>
									<a href="eliminarCursos.php?id_curso=<?php echo $curso["id"] ?>&id_empresa=<?php echo $idEmpresa; ?>" style="margin-top:5px;" class="btn btn-danger"><img src="../../../assetsNuevo/iconos/borrar2.gif" width="40px" height="">Eliminar curso</a>
                                </div>
                            </div>
                        </div><!-- fin card -->
                    <?php } ?>
                    </div>
					<?php
						if(isset($_SESSION['success'])){
							echo '<script>alertaEditarCursos(1);</script>'; 
							echo '<script>alertaAgregarVideos(1);</script>'; 
							unset($_SESSION['success']);
						}else{
							if(isset($_SESSION['error'])){
								echo '<script>alertaEditarCursos(2);</script>';      
								echo '<script>alertaAgregarVideos(2);</script>';                                                 
								echo '<div class="alert alert-danger" style="color:red;" role="alert">'.$_SESSION['error'].'</div>';
								unset($_SESSION['error']);
							}
						}
					?>
            </div><!-- fin page-content -->
        </div><!-- fin page-wrapper -->
<?php
include 'Template/footer.php';
?>