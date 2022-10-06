<?php
include '../../../config.php';//BD
session_start();

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
						<li> <a href="agregarEmpresas.php"><i class="bx bx-right-arrow-alt"></i>Agregar Empresas</a>
						</li>
						<li> <a href="../pagos.php"><i class="bx bx-right-arrow-alt"></i>Pagos</a>
						</li>
                        <li> <a href="cuentas.php"><i class="bx bx-right-arrow-alt"></i>Crear Cuentas</a>
						</li>
						<li> <a href="../usuarios.php"><i class="bx bx-right-arrow-alt"></i>Ver Cuentas</a>
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
                <h6 class="mb-0 text-uppercase">Cursos</h6>
                    <hr/>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4">
                    <?php
      					foreach ($cursos as $curso) { ?>

                        <div class="col"><!-- inicio card -->
                            <div class="card">
                                <img src="../../../uploads/cursos/<?php echo $curso["miniatura"] ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $curso["titulo_curso"] ?></h5>   
									<a href="editarCursos.php?id_curso=<?php echo $curso["id"] ?>&id_empresa=<?php echo $idEmpresa; ?>&id_profesor=<?php echo $curso["id_profesor"] ?>" style="margin-top:5px;" class="btn btn-warning">Editar Curso</a>
                                    <a href="agregarVideos.php?id_curso=<?php echo $curso["id"] ?>&id_empresa=<?php echo $idEmpresa; ?>&id_profesor=<?php echo $curso["id_profesor"] ?>" style="margin-top:5px;" class="btn btn-success">Agregar Videos</a>
									<a href="editarVideos.php?id_curso=<?php echo $curso["id"] ?>&id_empresa=<?php echo $idEmpresa; ?>&id_profesor=<?php echo $curso["id_profesor"] ?>" style="margin-top:5px;" class="btn btn-warning">Editar Videos</a>
									<a href="verVideos.php?id_curso=<?php echo $curso["id"] ?>&id_empresa=<?php echo $idEmpresa; ?>&id_profesor=<?php echo $curso["id_profesor"] ?>" style="margin-top:5px;" class="btn btn-info">Ver videos</a>
									<a href="eliminarCursos.php?id_curso=<?php echo $curso["id"] ?>&id_empresa=<?php echo $idEmpresa; ?>" style="margin-top:5px;" class="btn btn-danger">Eliminar curso</a>
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