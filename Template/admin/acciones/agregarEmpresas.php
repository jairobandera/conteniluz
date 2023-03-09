<?php
session_start();
include '../../../config.php';//BD

if(!isset($_SESSION['id_usuario'])){
	echo '<script>window.location.href = "../../login.php";</script>';
}

$id_usuario = $_SESSION['id_usuario'];	

$conectado = conectar();
$resultado = $conectado->query("SELECT u.id, u.usuario, u.nombre, u.tipo FROM usuario AS u WHERE tipo = 'PROFESOR' ");
$usuarios = $resultado->fetch_all(MYSQLI_ASSOC);


include 'Template/head.php';

?>

<body class="bg-theme bg-theme2" onload="">
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
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="javascript:;" class="has-arrow" aria-expanded="true">
						<div class="parent-icon"><img src="../../../assetsNuevo/iconos/home2.gif" width="30px" height="">
						</div>
						<div class="menu-title">Panel administrador</div>
					</a>
					<ul class="mm-collapse mm-show">
                        <li> <a href="../admin.php"><img src="../../../assetsNuevo/iconos/pass2.gif" width="40px" height="">Ver Empresas</a>
						</li>
						<li> <a href="../pagos.php"><img src="../../../assetsNuevo/iconos/pagos2.gif" width="40px" height="">Pagos</a>
						</li>
                        <li> <a href="cuentas.php"><img src="../../../assetsNuevo/iconos/cuentas2.gif" width="40px" height="">Crear Cuentas</a>
						</li>
						<li> <a href="../usuarios.php"><img src="../../../assetsNuevo/iconos/usuario2.gif" width="40px" height="">Ver Cuentas</a>
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
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<div class="container">
					<div class="main-body">
						<div class="row">
							<div class="col-lg-8">
								<div class="card">
								<h2><img src="../../../assetsNuevo/iconos/mas2.gif" width="40px" height=""> Nueva empresa</h2>
									<div class="card-body">
										<form action="acciones/crud.php" method="POST" enctype="multipart/form-data" id="formAgregarEmpresas">
										<div class="input-group mb-3">
											<label class="input-group-text" for="inputGroupSelect01"><img src="../../../assetsNuevo/iconos/usuario2.gif" width="40px" height="">Usuarios</label>
											<select name="idUsuario" class="form-control" id="inputGroupSelect01" style="background-color:rgb(0 0 0 / 15%); !important">
												<?php foreach ($usuarios as $usuario) { ?>
													<?php if($usuario === 1){ ?>
														<option style="background-color:grey !important"  value="<?php echo $usuario['id']; ?>" selected><?php echo $usuario['usuario']; ?></option>
														<?php }else{ ?>
															<option style="background-color:grey !important" value="<?php echo $usuario['id']; ?>"><?php echo $usuario['usuario']; ?></option>
														<?php } ?>
													<?php } ?>	
												</select>
										</div>
											<div class="row mb-3">  
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/empresas2.gif" width="40px" height="">Nombre empresa</h6>
												</div>
												<div class="col-sm-9">
													<input type="text" name="nombreEmpresa" class="form-control" placeholder="Ingrese un nombre" required/>
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-sm-9">
													<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/editar2.gif" width="40px" height=""> Descripcion de la empresa</h6>
												</div>
												<div class="col-sm-9">
													<textarea name="descripcion" class="form-control" rows="6" maxlength="300"></textarea>
													<!--<input type="text" name="viddesc" class="form-control" placeholder="Ingrese una descripcion" />-->
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
													<h6 class="mb-0"><input onclick="" type="radio" name="paypalArgentinaSi" id="paypalArgentinaSi#" value="Y" checked> Paypal Si</h6>
													<h6 class="mb-0"><input onclick="" type="radio" name="paypalArgentinaSi" id="paypalArgentinaSi#" value="N"> Paypal No</h6>
												</div>
											</div>
											<div class="row mb-3" id="argentinaSi">
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/sino2.gif" width="40px" height=""> Metodo Mercado Pago</h6>
												</div>
												<div class="col-sm-3" id="argentinaSi">
													<h6 class="mb-0"><input onclick="" type="radio" name="mpArgentinaSi" id="mpArgentinaSi" value="Y" checked> Mercado Pago Si</h6>
													<h6 class="mb-0"><input onclick="" type="radio" name="mpArgentinaSi" id="mpArgentinaSi" value="N"> Mercado Pago No</h6>
												</div>
											</div>
											<div class="row mb-3" id="otroPais">  
												<div class="col-sm-3">
													<h6 class="mb-0"><img src="../../../assetsNuevo/iconos/empresas2.gif" width="40px" height="">Ingrese el pais</h6>
												</div>
												<div class="col-sm-9" id="otroPais">
													<input type="text" name="pais" class="form-control" placeholder="ejemplo: Uruguay"/>
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
											<div class="mb-3">
												<h6 for="inputProductDescription" class="form-label"><img src="../../../assetsNuevo/iconos/foto2.gif" width="40px" height="">Miniatura</h6>
												<input class="form-control" type="file" name="file1" accept="jpg" multiple>
											</div>
											<button type="submit" name="agregarEmpresas-btn" class="btn btn-success"><img src="../../../assetsNuevo/iconos/ok2.gif" width="35px" height="">Agregar</button>
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
		<script>
			/* Comprobar si el valor de paypalArgentinaSi y mpArgentinaSi son igual a 'N' no dejas mandar el formulario */
			/*document.querySelector("#formAgregarEmpresas").addEventListener("submit", function(event) {
				const radioButtons = document.querySelectorAll('input[name="paypalArgentinaSi"]');
				const radioButtons2 = document.querySelectorAll('input[name="mpArgentinaSi"]');

				for (let i = 0; i < radioButtons.length; i++) {
					if(radioButtons[i].value === 'N' && radioButtons2[i].value === 'N'){
						event.preventDefault();
						alert("No se puede agregar la empresa, no se puede tener los dos metodos de pago en No");
					}
				}
			});*/
		</script>
