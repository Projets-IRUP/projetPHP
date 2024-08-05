<!doctype html>
<html lang="en">
	<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Bootstrap css-->
	<link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
	
	<!-- Liens vers le stylesheet global de ce layout -->
	<link rel="stylesheet" href="/views/layout/defaultlog.css">

	<!-- Liens vers le stylesheet spécifique à la page html, css contenu au même endroit que la page html -->
	<link rel="stylesheet" href="/views/<?= get_class($this).'/'.$filename?>.css"  >

	<title>Intranet</title>
		
	<!-- icon d'onglet navigateur -->
	<link rel="shortcut icon" type="images/x-icon" href="/webroot/img/favicon.ico" />
	<script src="https://kit.fontawesome.com/b46122bbbb.js" crossorigin="anonymous"></script>
	
	<!-- > Permet la déconexion après 15 min -->
	<meta http-equiv="refresh" content="900;url=../../connexions/logout" />

	</head>
	<body>
		<header>
		
					<!-- Barre de navigation -->
			<nav class="navbar navbar-expand-lg navbar-light bg-light"  >
				<div class="container-fluid">
				<img src="/webroot/img/favicon.ico" alt="favicon" width="30" height="30" style="margin-right: 1em">
					<a class="navbar-brand" href="/services"> Projet Intranet IRUP</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarText">
						<ul class="navbar-nav me-auto mb-2 mb-lg-0">
							<!-- <li class="nav-item">
								<a class="nav-link active" aria-current="page" href="/services">Accueil</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="/services">Features</a>
							</li> -->
							<li class="nav-item">
								<a class="nav-link" href="/services"></a>
							</li>
						</ul>
						<span class="navbar-text">
							<form class="form-floating" method="POST" action="/connexions/logout">
                    			<div class="form-floating">
                       				<button type="submit" class="btn btn-outline-dark">Se déconnecter</button>
                   				</div>
							</form>
						
						</span>
					</div>
				</div>
			</nav>
			<div class="divRetour">
				<a class="btnRetour" onclick="history.back()" > <img width="50px" height="50px" src="/webroot/img/arrow-left.svg"> </a>
			</div>
		</header>
	
		<?php
		require("flash.php");
		?>
		<div class="container">
			<div class="row">
				<div class="col">
					
					
				<!-- Layout + View  -->
					<?php
					echo $content_for_layout;
					?>
				</div>
			</div>
		</div>

		<!-- Jquery(utilisé par Bootstrap) JS-->
		<script src="<?= '/bootstrap/js/jquery.js'?>"></script>
		<!-- Bootstrap JS-->
		<script src="<?= '/bootstrap/js/bootstrap.js'?>"></script>
		<!-- Script -->
		<script type="text/javascript"src="<?= '/webroot/js/main.js'?>" ></script>
		
	</body>
</html>