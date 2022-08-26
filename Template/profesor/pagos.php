<?php
session_start();
include '../../config.php';
$conectado = conectar();

$id_profesor = $_SESSION['id_profesor'];
$resultado = $conectado->query("SELECT a.nombre,a.telefono, a.apellido, p.payment_type, p.`status`, p.monto, p.fecha_pago, p.fecha_caducidad FROM pagos AS p, alumno AS a WHERE EXISTS(
SELECT * FROM cursos AS c WHERE EXISTS(
SELECT * FROM empresa AS e WHERE e.id = c.id_empresa AND p.id_curso = c.id AND c.id_profesor = $id_profesor))");
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
						<li> <a href="cursos.php"><i class="bx bx-right-arrow-alt"></i>Ver Cursos</a>
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
							<img src="../../assets/assets/images/avatars/avatar-2.png" class="user-img" alt="user avatar">
							<div class="user-info ps-3">
								<p class="user-name mb-0">Pauline Seitz</p>
								<p class="designattion mb-0">Web Designer</p>
							</div>
						</a>
					</div>
				</nav>
			</div>
		</header>
		<!--end header -->
        <div class="page-wrapper">
			<div class="page-content">
                <h6 class="mb-0 text-uppercase">DataTable Example</h6>
                        <hr/>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
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
													<td><?php echo $pago['fecha_caducidad']; ?></td>
												</tr>
											<?php } ?>
                                        <tfoot>
                                            <tr>
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