<?php
session_start();
include '../../../config.php';//BD
$conectado = conectar();

if(isset($_GET['id_curso']) and isset($_GET['id_empresa']) and isset($_GET['id_profesor'])){
	$id_curso = $_GET['id_curso'];
    $id_profesor = $_GET['id_profesor'];
    $id_empresa = $_GET['id_empresa'];
}

$resultado = $conectado->query("SELECT * FROM videos AS v WHERE EXISTS(
	SELECT * FROM cursos AS c WHERE EXISTS(
	SELECT * FROM profesor AS p WHERE p.id = c.id_profesor
	AND v.id_curso = $id_curso AND p.id = $id_profesor))");

$videos = $resultado->fetch_all(MYSQLI_ASSOC);

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
                <h6 class="mb-0 text-uppercase">Listado de cursos</h6>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4">						
						<?php
							foreach ($videos as $video) { ?>
							<form action="acciones/crud.php" method="POST" enctype="multipart/form-data">
								<div class="col">
									<div class="card">
										<img src="../../../uploads/videos/miniaturas/<?php echo $video["miniatura"] ?>" class="card-img-top" alt="...">
										<div class="card-body">
											<h5 class="card-title"><?php echo $video["titulo_video"] ?></h5>
											<p class="card-title"><?php echo $video["descripcion"] ?></p>
											<input type="hidden" name="id" id="id" value="<?php echo $video["id"] ?>">
                                            <input type="hidden" name="id_profesor" value="<?php echo $id_profesor; ?>">
                                            <input type="hidden" name="id_empresa" value="<?php echo $id_empresa; ?>">
                                            <input type="hidden" name="id_curso" value="<?php echo $id_curso; ?>">
											<button type="submit" name="editVideo-btn" class="btn btn-info"><i class=""></i>Editar</button>
											<button type="submit" name="deleteVideo-btn" class="btn btn-danger"><i class=""></i>Eliminar</button>
										</div>
									</div>
								</div>
							</form>
						<?php } ?>
                    </div>               
            </div>
        </div>

<script src='js.js'></script>   
<?php
include 'Template/footer.php';
?>