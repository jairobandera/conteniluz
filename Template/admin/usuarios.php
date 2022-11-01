<?php
session_start();
include '../../config.php';
$conectado = conectar();

$resultado = $conectado->query("SELECT * FROM usuario");
$usuarios = $resultado->fetch_all(MYSQLI_ASSOC);


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
					<h4 class="logo-text">conteniluz</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><img src="../../assetsNuevo/iconos/home2.gif" width="30px" height="">
						</div>
						<div class="menu-title">Panel administrador</div>
					</a>
					<ul>
                        <li> <a href="acciones/agregarEmpresas.php"><img src="../../assetsNuevo/iconos/mas2.gif" width="40px" height="">Agregar Empresas</a>
						</li>
						</li>
                        <li> <a href="pagos.php"><img src="../../assetsNuevo/iconos/pagos2.gif" width="40px" height="">Pagos</a>
						</li>
                        <li> <a href="acciones/cuentas.php"><img src="../../assetsNuevo/iconos/cuentas2.gif" width="40px" height="">Crear Cuentas</a>
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
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="../../assetsNuevo/iconos/usuario2.gif" width="40px" height="">
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
                <h6 class="mb-0 text-uppercase"><img src="../../assetsNuevo/iconos/cuentas2.gif" width="40px" height=""> Cuentas de usuarios</h6>
                        <hr/>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nombre - Apellido</th>
												<th>Telefono</th>
                                                <th>Usuario</th>
                                                <th>Tipo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php foreach($usuarios as $usuario){ ?>
												<tr>
													<td><?php echo $usuario['nombre'].' '.$usuario['apellido']; ?></td>
													<td><?php echo $usuario['telefono']; ?></td>
													<td><?php echo $usuario['usuario']; ?></td>
                                                    <td><?php echo $usuario['tipo']; ?></td>
												</tr>
											<?php } ?>
                                        <tfoot>
                                            <tr>
                                                <th>Nombre - Apellido</th>
												<th>Telefono</th>
                                                <th>Usuario</th>
                                                <th>Tipo</th>
                                            </tr>
											<?php
											if(isset($_SESSION['success'])){
												echo '<script>alertaCrearCuentas(1);</script>';                                                            
												echo '<div class="alert alert-success" style="color:green;" role="alert">'.$_SESSION['success'].'</div>';
												unset($_SESSION['success']);
											}else{
												if(isset($_SESSION['error'])){
													echo '<script>alertaCrearCuentas(2);</script>';                                                            
													echo '<div class="alert alert-danger" style="color:red;" role="alert">'.$_SESSION['error'].'</div>';
													unset($_SESSION['error']);
												}
											}
											?>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

<?php
include 'Template/footer.php';
?>