<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Bootstrap-->
		<link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
		<!-- Liens vers le stylesheet css contenu les views, $filename provient du render(filename) -->

		<link rel="stylesheet" href="/views/<?= get_class($this).'/'.$filename?>.css" >
		
		<title>Connexion - Intranet</title>
			
		<!-- icon d'onglet navigateur -->
		<link rel="shortcut icon" type="images/x-icon" href="/webroot/img/favicon.ico" />
	</head>

	<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
		<div class="container-fluid">
			<a class="navbar-brand" href="/"><img src="/webroot/img/favicon.ico" class="navbar-logo" /></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link active" href="/identification/connexion">Identification</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	
	<body>

		<!-- Pour envoyer des messages flash -->
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