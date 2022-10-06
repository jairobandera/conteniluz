<?php
session_start();
include '../../config.php';
$conectado = conectar();

$id_usuario = $_SESSION['id_usuario'];
$id_profesor = $_SESSION['id_profesor'];

$resultado = $conectado->query("SELECT * FROM cursos AS c WHERE EXISTS(
SELECT * FROM profesor AS p WHERE c.id_profesor = '$id_profesor')");

//echo $id_profesor;

$cursos = $resultado->fetch_all(MYSQLI_ASSOC);

$id_curso = $cursos[0]['id'];
$id_empresa = $cursos[0]['id_empresa'];
$id_usuario = $_SESSION['id_usuario'];


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
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
					<ul>
						<li> <a href="index.php"><i class="bx bx-right-arrow-alt"></i>Agregar Curso</a>
						</li>
						<li> <a href="pagos.php"><i class="bx bx-right-arrow-alt"></i>Pagos</a>
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
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<!--<img src="../../assets/assets/images/avatars/avatar-2.png" class="user-img" alt="user avatar">-->
							<div class="user-info ps-3">
								<p class="user-name mb-0"><?php echo $_SESSION['nombre_profesor']; ?></p>
								<p class="designattion mb-0"><?php echo $_SESSION['apellido_profesor']; ?></p>
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
      				        foreach ($cursos as $curso) { ?>
                            <div class="col">
                                <div class="card">
                                    <img src="../../uploads/cursos/<?php echo $curso["miniatura"] ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $curso["titulo_curso"]; ?></h5>
										<h6>Duración en meses: <?php echo $curso['duracion']; ?></h6>
										<p class="card-text">Precio en dolares USD <?php echo $curso["dolares"] ?></p>
                                        <p class="card-text">Precio en pesos $ <?php echo $curso["pesos"] ?></p><a href="editarCursos.php?id_curso=<?php echo $curso["id"] ?>" style="margin-top:5px;" class="btn btn-info">Editar</a>
										<a href="../eliminarCursos.php?id_curso=<?php echo $curso["id"] ?>" style="margin-top:5px;" class="btn btn-danger">Eliminar</a>
										<a href="verVideos.php?id_curso=<?php echo $curso["id"] ?>" style="margin-top:5px;" class="btn btn-warning">Ver videos</a>
										<a href="agregarClases.php?id_empresa=<?php echo $id_empresa ?>&id_curso=<?php echo $curso["id"] ?>" style="margin-top:5px;" class="btn btn-success">Agregar Videos</a>
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