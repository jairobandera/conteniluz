<?php
session_start();
include '../../config.php';//BD

if(!isset($_SESSION['id_usuario'])){
	echo '<script>window.location.href = "../login.php";</script>';
}


$conectado = conectar();
$resultado = $conectado->query("SELECT e.*, u.nombre AS nombreProfesor, u.apellido AS apellidoProfesor FROM empresa AS e, usuario AS u WHERE e.id_usuario = u.id AND u.tipo != 'admin' AND u.tipo != 'usuario'");
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
            <ul class="metismenu" id="menu" >
                <li>
                    <a href="javascript:;" class="has-arrow" aria-expanded="true">
                        <div class="parent-icon"><img src="../../assetsNuevo/iconos/home2.gif" width="30px" height="">
                        </div>
                        <div class="menu-title">Panel administrador</div>
                    </a>
                    <ul class="mm-collapse mm-show">
                        <li> <a href="admin.php"><img src="../../assetsNuevo/iconos/pass2.gif" width="40px" height="">Ver Empresas</a>
						</li>
						<li> <a href="acciones/agregarEmpresas.php"><img src="../../assetsNuevo/iconos/mas2.gif" width="40px" height="">Agregar Empresas</a>
						</li>
						<li> <a href="pagos.php"><img src="../../assetsNuevo/iconos/pagos2.gif" width="40px" height="">Pagos</a>
						</li>
                        <li> <a href="acciones/cuentas.php"><img src="../../assetsNuevo/iconos/cuentas2.gif" width="40px" height="">Crear Cuentas</a>
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
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <div class="container">
                    <div class="main-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h2><img src="../../assetsNuevo/iconos/mas2.gif" width="40px" height=""> Datos
                                            Paypal</h2>
                                        <form action="agregarMpp.php" method="POST" enctype="">

                                            <div class="input-group mb-3">
												<label class="input-group-text" for="inputGroupSelect01"><h6><img src="../../assetsNuevo/iconos/empresas2.gif" width="40px" height="">Empresa</h6></label>
												<select name="idEmpresaUsuario" class="form-control" id="inputGroupSelect01" style="background-color:rgb(0 0 0 / 15%); !important">
													<?php foreach ($empresas as $empresa) { ?>
														<option style="background-color:grey !important"  value="<?php echo $empresa['id'].'-'. $empresa['id_usuario']; ?>" selected><?php echo $empresa['nombre_empresa']; ?></option>
                                                    <?php } ?>
												</select>
											</div>

                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0"><img src="../../assetsNuevo/iconos/editar2.gif"
                                                            width="40px" height=""> Client Id Paypal</h6>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" name="clientIdPaypal" class="form-control"
                                                        placeholder="Ingrese el client id" required />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-sm-4">
                                                    <h6 class="mb-0"><img src="../../assetsNuevo/iconos/editar2.gif"
                                                            width="40px" height=""> Key Token Paypal</h6>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" name="keyTokenPaypal" class="form-control"
                                                        placeholder="Ingrese el client token" required />
                                                </div>
                                            </div>
                                            <h2 style="margin-top:2em;"><img src="../../assetsNuevo/iconos/mas2.gif"
                                                    width="40px" height=""> Datos MercadoPago</h2>

                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0"><img src="../../assetsNuevo/iconos/editar2.gif"
                                                            width="40px" height=""> Access Token</h6>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" name="accessTokenMp" class="form-control"
                                                        placeholder="Ingrese el access token" required />
                                                </div>
                                            </div>

                                            <button type="submit" name="submit" class="btn btn-success"><img
                                                    src="../../assetsNuevo/iconos/ok2.gif" width="40px" height="">
                                                Agregar</button>
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