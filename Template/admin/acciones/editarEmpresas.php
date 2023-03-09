<?php
session_start();
include '../../../config.php';//BD
$conectado = conectar();
	
if(!isset($_SESSION['id_usuario'])){
	echo '<script>window.location.href = "../../login.php";</script>';
}

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
					<img src="../../../assets/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">InstituZion</h4>
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
					<a href="javascript:;" class="has-arrow" aria-expanded="true">
						<div class="parent-icon"><img src="../../../assetsNuevo/iconos/home2.gif" width="30px" height="">
						</div>
						<div class="menu-title">Panel control</div>
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
				<div class="container">
					<div class="main-body">
						<div class="row">
							<div class="col-lg-8">
								<div class="card">
								<h2><img src="../../../assetsNuevo/iconos/editar2.gif" width="40px" height=""> Editar Empresa</h2>
									<div class="card-body">
										<form action="acciones/crud.php" id="form" method="POST" enctype="multipart/form-data">
											<div class="row mb-3">
												<div class="col-sm-9">
													<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/empresas2.gif" width="40px" height=""> Nombre de la empresa</h6>
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-9">
                                                    <input type="hidden" name="idEmpresa" class="form-control" value="<?php echo $empresa[0]['id']; ?>"/>
													<input type="text" name="nombreEmpresa" class="form-control" value="<?php echo $empresa[0]['nombre_empresa']; ?>"/>
												</div>
											</div>

											<div class="row mb-3">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/editar2.gif" width="40px" height=""> Descripcion de la empresa</h6>
												</div>
												<div class="col-sm-9">
													<textarea name="descripcion" class="form-control" rows="6" maxlength="300"><?php echo $empresa[0]['descripcion'];?></textarea>
													<!--<input type="text" name="viddesc" class="form-control" placeholder="Ingrese una descripcion" />-->
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
											
											<div class="row mb-3" id="argentinaSiNo">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/sino2.gif" width="40px" height=""> Argentina</h6>
												</div>
												<div class="col-sm-3" id="argentinaSiNo">
													<h6 class="mb-0"><input onclick="" type="radio" name="argentina" id="argentina" value="si" checked> Si</h6>
													<h6 class="mb-0"><input onclick="" type="radio" name="argentina" id="argentina" value="no"> No</h6>
												</div>
											</div>
											<div class="row mb-3" id="argentinaSi">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/sino2.gif" width="40px" height=""> Metodo Paypal</h6>
												</div>
												<div class="col-sm-3" id="argentinaSi">
													<h6 class="mb-0"><input onclick="" type="radio" name="paypalArgentinaSi" id="paypalArgentinaSi" value="Y" <?php if( isset($empresa[0]['pais']) and ($empresa[0]['pais'] == 'argentina') and ($empresa[0]['paypal'] == 'Y') ){ echo 'checked'; }?>> Paypal Si</h6>
													<h6 class="mb-0"><input onclick="" type="radio" name="paypalArgentinaSi" id="paypalArgentinaSi" value="N" <?php if( isset($empresa[0]['pais']) and ($empresa[0]['pais'] == 'argentina') and ($empresa[0]['paypal'] == 'N') ){ echo 'checked'; }?>> Paypal No</h6>
												</div>
											</div>
											<div class="row mb-3" id="argentinaSi">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/sino2.gif" width="40px" height=""> Metodo Mercado Pago</h6>
												</div>
												<div class="col-sm-3" id="argentinaSi">
													<h6 class="mb-0"><input onclick="" type="radio" name="mpArgentinaSi" id="mpArgentinaSi" value="Y" <?php if( isset($empresa[0]['pais']) and ($empresa[0]['pais'] == 'argentina') and ($empresa[0]['mercadopago'] == 'Y') ){ echo 'checked'; }?>> Mercado Pago Si</h6>
													<h6 class="mb-0"><input onclick="" type="radio" name="mpArgentinaSi" id="mpArgentinaSi" value="N" <?php if( isset($empresa[0]['pais']) and ($empresa[0]['pais'] == 'argentina') and ($empresa[0]['mercadopago'] == 'N') ){ echo 'checked'; }?>> Mercado Pago No</h6>
												</div>
											</div>
											<div class="row mb-3" id="otroPais">  
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/empresas2.gif" width="40px" height="">Ingrese el pais</h6>
												</div>
												<div class="col-sm-9" id="otroPais">
													<input type="text" name="pais" class="form-control" placeholder="ejemplo: Uruguay" value="<?php if( isset($empresa[0]['pais']) and ($empresa[0]['pais'] != 'argentina') ){ echo $empresa[0]['pais']; }?>" />
												</div>
											</div>
											<div class="row mb-3" id="otroPais">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/sino2.gif" width="40px" height=""> Metodo Paypal</h6>
												</div>
												<div class="col-sm-3" id="otroPais">
													<h6 class="mb-0"><input onclick="" type="radio" name="paypal" id="" value="Y" checked> Paypal</h6>
													<h6 class="mb-0"><input onclick="" type="hidden" name="mercadopago" id="" value="N"></h6>
												</div>
											</div>

											<button type="submit" name="editarEmpresas-btn" style="margin-bottom:5px;" id="upload-btn" class="btn btn-success"><img src="../../../assetsNuevo/iconos/ok2.gif" width="35px" height="">Guardar</button>
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

		<script>
			/* ocultar todo los elementos con id otroPais */
			document.querySelectorAll("#otroPais").forEach(function(element) {
				element.style.display = "none";
			});

			const radioButtons = document.querySelectorAll('input[name="argentina"]');

			for (let i = 0; i < radioButtons.length; i++) {
			radioButtons[i].addEventListener("click", function() {
				const selectedValue = this.value;

				if(selectedValue === 'si'){
					/* ocultar todo los elementos con id otroPais */
					document.querySelectorAll("#otroPais").forEach(function(element) {
						element.style.display = "none";
					});

					document.querySelectorAll("#argentinaSi").forEach(function(element) {
					element.style.display = "block";
					});
				}else{
					/* ocultar todo los elementos con id otroPais */
					document.querySelectorAll("#otroPais").forEach(function(element) {
						element.style.display = "block";
					});

					document.querySelectorAll("#argentinaSi").forEach(function(element) {
					element.style.display = "none";
					});
				}
				
			});
			}
		</script>