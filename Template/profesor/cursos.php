<?php
session_start();
include '../../config.php';
$conectado = conectar();

if(!isset($_SESSION['id_usuario'])){
	echo '<script>window.location.href = "../login.php";</script>';
	//header("location: ../login.php");
}

$id_usuario = $_SESSION['id_usuario'];
$id_profesor = $_SESSION['id_profesor'];

$resultado = $conectado->query("SELECT * FROM cursos AS c WHERE EXISTS(
SELECT * FROM profesor AS p WHERE c.id_profesor = '$id_profesor')");

//echo $id_profesor;

$cursos = $resultado->fetch_all(MYSQLI_ASSOC);

if($cursos){
	$id_curso = $cursos[0]['id'];
	$id_empresa = $cursos[0]['id_empresa'];
	$id_usuario = $_SESSION['id_usuario'];
}else{
	$id_empresa = $_SESSION['id_empresa_profesor'];
	$id_usuario = $_SESSION['id_usuario'];
}



include 'Template/head.php';
?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
					<h4 class="logo-text">Dashtrans</h4>
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
						<li> <a href="index.php"><img src="../../assetsNuevo/iconos/mas2.gif" width="30px" height="">Agregar Curso</a>
						</li>
						<li> <a href="pagos.php"><img src="../../assetsNuevo/iconos/pagos2.gif" width="30px" height="">Pagos</a>
						</li>
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
								<p class="user-name mb-0"><?php echo $_SESSION['nombre_profesor']; ?></p>
								<p class="designattion mb-0"><?php echo $_SESSION['apellido_profesor']; ?></p>
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
                <h6 class="mb-0 text-uppercase"><img src="../../assetsNuevo/iconos/cursos2.gif" width="40px" height=""> Listado de cursos</h6>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3">
                        <?php
      				        foreach ($cursos as $curso) { ?>
                            <div class="col">
                                <div class="card">
                                    <img src="../../uploads/cursos/<?php echo $curso["miniatura"] ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $curso["titulo_curso"]; ?></h5>
										<h6>Duración en meses: <?php echo $curso['duracion']; ?></h6>
										<p class="card-text">Precio en dolares USD <?php echo $curso["dolares"] ?></p>
                                        <p class="card-text">Precio en pesos $ <?php echo $curso["pesos"] ?></p><a href="editarCursos.php?id_curso=<?php echo $curso["id"] ?>" style="margin-top:5px;" class="btn btn-info"><img src="../../assetsNuevo/iconos/editar2.gif" width="40px" height=""> Editar</a>
										<a href="../eliminarCursos.php?id_curso=<?php echo $curso["id"] ?>" style="margin-top:5px;" class="btn btn-danger"><img src="../../assetsNuevo/iconos/borrar2.gif" width="40px" height=""> Eliminar</a>
										<a href="verVideos.php?id_curso=<?php echo $curso["id"] ?>" style="margin-top:5px;" class="btn btn-warning"><img src="../../assetsNuevo/iconos/pass2.gif" width="40px" height=""> Ver videos</a>
										<a href="agregarClases.php?id_empresa=<?php echo $id_empresa ?>&id_curso=<?php echo $curso["id"] ?>" style="margin-top:5px;" class="btn btn-success"><img src="../../assetsNuevo/iconos/mas2.gif" width="40px" height=""> Agregar Videos</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
               
            </div>
        </div>

        
<?php
include 'Template/footer.php';
?>