<?php
session_start();
include '../../config.php';
$conectado = conectar();

if(!isset($_SESSION['id_usuario'])){
	echo '<script>window.location.href = "../login.php";</script>';
}


$resultado = $conectado->query("SELECT e.nombre_empresa, u.nombre,u.telefono, u.apellido, p.payment_type, p.`status`, p.monto, p.fecha_pago, p.pagoCaducado FROM pagos AS p, usuario AS u, empresa AS e
WHERE u.tipo = 'USUARIO'
GROUP BY u.nombre");
$pagos = $resultado->fetch_all(MYSQLI_ASSOC);


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
					<a href="javascript:;" class="has-arrow" aria-expanded="true">
						<div class="parent-icon"><img src="../../assetsNuevo/iconos/home2.gif" width="30px" height="">
						</div>
						<div class="menu-title">Panel administrador</div>
					</a>
					<ul class="mm-collapse mm-show">
                        <li> <a href="acciones/agregarEmpresas.php"><img src="../../assetsNuevo/iconos/mas2.gif" width="40px" height="">Agregar Empresas</a>
						</li>
						<li> <a href="admin.php"><img src="../../assetsNuevo/iconos/mas2.gif" width="40px" height="">Ver Empresas</a>
						</li>
						</li>
                        <li> <a href="acciones/cuentas.php"><img src="../../assetsNuevo/iconos/cuentas2.gif" width="40px" height=""></i>Crear Cuentas</a>
						</li>
						<li> <a href="usuarios.php"><img src="../../assetsNuevo/iconos/pass2.gif" width="40px" height="">Ver Cuentas</a>
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
                <h6 class="mb-0 text-uppercase"><img src="../../assetsNuevo/iconos/pagos2.gif" width="40px" height=""> Pagos realizados por alumnos</h6>
                        <hr/>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Empresa</th>
                                                <th>Alumno</th>
												<th>Telefono</th>
                                                <th>Metodo</th>
                                                <th>Status</th>
                                                <th>Monto</th>
                                                <th>Fecha</th>
												<th>Caducidad</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php foreach($pagos as $pago){ ?>
												<tr>
                                                    <td><?php echo $pago['nombre_empresa']; ?></td>
													<td><?php echo $pago['nombre'].' '.$pago['apellido']; ?></td>
													<td><?php echo $pago['telefono']; ?></td>
													<td><?php echo $pago['payment_type']; ?></td>
													<td <?php if($pago['status'] == 'approved'){ echo 'style="background-color:#32a840;"';

													}else if($pago['status'] == 'cancelled'){
														echo 'style="background-color:#f2493d;"';
													}else if($pago['status'] == 'pending'){
														echo 'style="background-color:#e3e044;"';
													}
													 ?>><?php echo $pago['status']; ?></td>
													<td><?php echo $pago['monto']; ?></td>
													<td><?php echo $pago['fecha_pago']; ?></td>
													<td><?php echo $pago['pagoCaducado']; ?></td>
												</tr>
											<?php } ?>
                                        <tfoot>
                                            <tr>
                                                <th>Empresa</th>
												<th>Alumno</th>
												<th>Telefono</th>
                                                <th>Metodo</th>
                                                <th>Status</th>
                                                <th>Monto</th>
                                                <th>Fecha</th>
												<th>Caducidad</th>
                                            </tr>
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