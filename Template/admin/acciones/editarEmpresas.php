<?php
session_start();
include '../../../config.php';//BD
$conectado = conectar();
	

if(isset($_GET['id_empresa'])){
    $id_empresa = $_GET['id_empresa'];
}


$resultado = $conectado->query("SELECT * FROM empresa WHERE id = $id_empresa");    
$empresa = $resultado->fetch_all(MYSQLI_ASSOC);

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
					<!--<h4 class="logo-text">Dashtrans</h4>-->
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><img src="../../../assetsNuevo/iconos/home2.gif" width="30px" height="">
						</div>
						<div class="menu-title">Panel control</div>
					</a>
					<ul>
                    <li> <a href="agregarEmpresas.php"><img src="../../../assetsNuevo/iconos/mas2.gif" width="40px" height="">Agregar Empresas</a>
						</li>
						<li> <a href="../pagos.php"><img src="../../../assetsNuevo/iconos/pagos2.gif" width="40px" height="">Pagos</a>
						</li>
                        <li> <a href="cuentas.php"><img src="../../../assetsNuevo/iconos/cuentas2.gif" width="40px" height="">Crear Cuentas</a>
						</li>
						<li> <a href="../usuarios.php"><img src="../../../assetsNuevo/iconos/pass2.gif" width="40px" height="">>Ver Cuentas</a>
						</li>
						<li><a href="../cerrar.php"><img src="../../../assetsNuevo/iconos/exit2.gif" width="40px" height="">Cerrar Sesion</a></li>
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
							<img src="../../../assetsNuevo/iconos/usuario2.gif" width="40px" height="">
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
				<div class="container">
					<div class="main-body">
						<div class="row">
							<div class="col-lg-8">
								<div class="card">
								<h2><img src="../../../assetsNuevo/iconos/editar2.gif" width="40px" height=""> Editar Empresa</h2>
									<div class="card-body">
										<form action="acciones/crud.php" id="form" method="POST" enctype="multipart/form-data">
											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/empresas2.gif" width="40px" height=""> Nombre</h6>
												</div>
												<div class="col-sm-9">
                                                    <input type="hidden" name="idEmpresa" class="form-control" value="<?php echo $empresa[0]['id']; ?>"/>
													<input type="text" name="nombreEmpresa" class="form-control" value="<?php echo $empresa[0]['nombre_empresa']; ?>"/>
												</div>
											</div>
											<div class="mb-3">
												<h6 for="inputProductDescription" class="form-label"><img src="../../../assetsNuevo/iconos/foto2.gif" width="40px" height=""> Miniatura</h6>
												<input class="form-control" type="file" name="file1" accept="jpg" multiple>
											</div>
                                            <div class="row mb-sm-3">
                                                <div class="col-sm-3">
                                                    <img src="../../../uploads/empresas/<?php echo $empresa[0]['miniatura']; ?>" width="100px" style="margin-bottom:5px;" alt="">
                                                </div>
                                            </div>
											<button type="submit" name="editarEmpresas-btn" style="margin-bottom:5px;" id="upload-btn" class="btn btn-success"><img src="../../../assetsNuevo/iconos/ok2.gif" width="35px" height="">Editar</button>
											<?php
												if(isset($_SESSION['success'])){
													echo '<script>alertaEditarEmpresas(1);</script>';                                                            
													echo '<div class="alert alert-success" style="color:green;" role="alert">'.$_SESSION['success'].'</div>';
													unset($_SESSION['success']);
												}else{
													if(isset($_SESSION['error'])){
														echo '<script>alertaEditarEmpresas(2);</script>';                                                            
														echo '<div class="alert alert-danger" style="color:red;" role="alert">'.$_SESSION['error'].'</div>';
														unset($_SESSION['error']);
													}
												}
											?>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

        
<?php
include 'Template/footer.php';
?>