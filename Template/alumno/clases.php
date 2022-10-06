<?php
session_start();
include '../../config.php';
$conectado = conectar();

if(isset($_GET['id_curso'])){
	$id_curso = $_GET['id_curso'];
	$resultado = $conectado->query("SELECT v.*, a.pago FROM videos AS v, alumno AS a WHERE EXISTS(
		SELECT * FROM cursos AS c WHERE a.id_curso = $id_curso
		AND v.id_curso = $id_curso 
		AND v.id_curso = $id_curso
		AND a.id_usuario = ".$_SESSION['id_usuario'].")");
	$videos = $resultado->fetch_all(MYSQLI_ASSOC);
}

//$cantidad = mysqli_num_rows($cursos);
//echo $cantidad;
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Clases</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- FAVICON -->
		<link rel="icon" type="image/png" href="../../assets/img/favicon.png">
		<!-- FONTS -->
		<link rel="stylesheet" href="../../assets/fonts/fontawesome/font-awesome.min.css">
		<link rel="stylesheet" href="../../assets/fonts/iconsmind/iconsmind.css">
		<!-- STYLESHEETS -->
		<link rel="stylesheet" href="../../assets/css/plugins.min.css">
		<link rel="stylesheet" href="../../assets/css/style.css">
	</head>
	<body>
		<div class="vlt-site-holder animsition vlt-footer-fixed">
			<div class="vlt-content-holder">
				<header class="vlt-header-holder vlt-header-fixed" data-header-fixed="1">
					<div class="container">
						<div class="vlt-header-inner">
							<div class="vlt-header-left">
								<a href="../../index.php" class="vlt-site-logo">
								<img src="../../assets/img/logo.png" alt="Vinero" style="max-height: 13px">
								</a>
							</div>
							<div class="vlt-header-right">
								<div class="vlt-menu-toggle vlt-fullscreen-menu-toggle" data-before-text="Menu">
									<span class="line line-one"><span class="inner"></span></span>
									<span class="line line-two"><span class="inner"></span></span>
									<span class="line line-three"><span class="inner"></span></span>
								</div>
							</div>
						</div>
					</div>
				</header>
				<!-- /.vlt-header-holder vlt-header-fixed -->
				<div class="vlt-navigation-fullscreen-holder">
					<div class="vlt-navigation-fullscreen">
						<ul>
							<li><a href="index.php">Inicio</a></li>
							<li><a href="index.php">Mis Cursos</a></li>
							<li><a href="../cerrar.php">Cerrar Sesion</a></li>
						</ul>
						<div class="vlt-navigation-socials">
							<ul>
								<li><a href="#" class="tooltip" title="Dribbble"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#" class="tooltip" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
								<li><a href="#" class="tooltip" title="Facebook"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#" class="tooltip" title="YouTube"><i class="fa fa-youtube"></i></a></li>
							</ul>
						</div>
						<!-- /.vlt-navigation-socials -->
					</div>
				</div>
				<!-- /.vlt-navigation-fullscreen-holder -->
				<div class="vlt-hero-title-holder jarallax" style="background-image: url('assets/img/index.jpg');">
					<div class="vlt-hero-title-inner">
						<h1 class="vlt-hero-title">Blog Fullwidth</h1>
						<p class="vlt-hero-subtitle">Read the latest news and stories.</p>
					</div>
				</div>
				<!-- /.vlt-hero-title-holder -->
				<main class="vlt-main-holder vlt-main-padding">
					<div class="container">
						<div class="row">
							<div class="col-md-2"></div>
							<div class="col-md-8">
								<div class="vlt-postlist-holder">
									<div class="vlt-postlist vlt-postlist-standard cubeportfolio clearfix">
									<?php
      								foreach ($videos as $video) { ?>
										<article class="vlt-post-standard cbp-item">
											<div class="vlt-post-inner">
												<div class="vlt-post-thumbnail">
													<?php if($video["tipo"] == 'V' AND $video['pago'] == 'Y'){ ?>
														<iframe src="https://player.vimeo.com/video/<?php echo $video["id_video"] ?>" width="900" height="506" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
													<?php }else if($video["tipo"] == 'V' AND $video['pago'] == 'N'){ ?>
														<?php if($video === reset($videos) AND ($video['es_presentacion'] == 'Y')){ ?><!-- cargo solo el primer video-->
															<iframe src="https://player.vimeo.com/video/<?php echo $video["id_video"] ?>" width="900" height="506" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
														<?php }else{ ?>
															<img src="../../assets/img/cursos/<?php echo $video["miniatura"]; ?>" alt="" width="900" height="506">
														<?php } ?>
													<?php }else if($video["tipo"] == 'Y' AND $video['pago'] == 'Y'){ ?>	
														<iframe src="http://www.youtube.com/embed/<?php echo $video["id_video"] ?>" width="900" height="506" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
													<?php }else if($video["tipo"] == 'Y' AND $video['pago'] == 'N'){ ?>
														<?php if($video === reset($videos) AND ($video['es_presentacion'] == 'Y')){ ?><!-- cargo solo el primer video-->
															<iframe src="http://www.youtube.com/embed/<?php echo $video["id_video"] ?>" width="900" height="506" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
														<?php }else{ ?>
															<img src="../../assets/img/cursos/<?php echo $video["miniatura"]; ?>" alt="" width="900" height="506">
														<?php } ?>
													<?php } ?>
												</div>
												<div class="vlt-post-content">
													<!--<div class="vlt-post-meta">
														<span class="vlt-post-author"><i class="fa fa-fw fa-user"></i><a href="#">VLThemes</a></span>
														<span class="vlt-post-date"><i class="fa fa-fw fa-clock-o"></i>July 22, 2017</span>
													</div>-->
													<h3 class="vlt-post-title"><a href="blog-post-single.html"><?php echo $video["titulo_video"] ?></a></h3>
													<div class="vlt-post-excerpt">
														<?php echo $video["descripcion"] ?>
													</div>
												</div>
											</div>
										</article>
										<?php } ?>
										<!-- /.vlt-post-standard -->
									</div>
									<!--/.vlt-postlist .vlt-postlist-standard .cubeportfolio .clearfix-->
									<!--<nav class="vlt-pagination-numeric">
										<span class="page-numbers current">1</span>
										<a class="page-numbers" href="#">2</a>
										<a class="next page-numbers" href="#">Next</a>
									</nav>
									 /.vlt-pagination-numeric -->
								</div>
							</div>
						</div>
					</div>
				</main>
				<!-- /.vlt-main-holder vlt-main-padding -->
			</div>
			<!-- /.vlt-content-holder -->
			<footer class="vlt-footer-holder vlt-footer-minimal" data-footer-fixed="1">
				<div class="vlt-footer-inner">
					<div class="container">
						<div class="text-center">
							<a href="index.html" class="vlt-site-logo">
							<img src="../../assets/img/logo.png" alt="Vinero" style="max-height: 13px">
							</a>
							<div class="vlt-footer-menu">
								<div>
									<ul>
										<li>
											<a href="#">Works</a>
										</li>
										<li>
											<a href="#">About</a>
										</li>
										<li>
											<a href="#">Contact</a>
										</li>
										<li>
											<a href="#">Purchase</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="vlt-footer-copyright">
								<p>Copyright © 2017 Vinero. Powered by <a href="#" class="vlt-link reverse">VLThemes</a></p>
							</div>
						</div>
					</div>
				</div>
			</footer>
			<!-- /.vlt-footer-holder -->
		</div>
		<!-- /.vlt-site-holder -->
		<a href="#" class="vlt-back-to-top hidden"><i class="fa fa-angle-up"></i></a>
		<!-- /.vlt-back-to-top -->
	</body>
	<!-- SCRIPTS -->
	<script src="../../assets/vendors/jquery.min.js"></script>
	<script src="../../assets/scripts/plugins.min.js"></script>
	<script src="../../assets/scripts/script.js"></script>
	<!-- vimeo-->
	<script src="https://player.vimeo.com/api/player.js"></script>
</html>