<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Inventory using react and Laravel</title>

	<!-- Site Icons -->
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">

	<!-- Bootstrap icons-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
	<!-- Core theme CSS (includes Bootstrap)-->
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">

	<script src="{{ asset('js/app.js') }}" defer></script>
	<script src="{{ asset('js/manifest.js') }}"></script>
	<script src="{{ asset('js/vendor.js') }}"></script>
</head>
<body>
	<!-- Navigation-->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container px-4 px-lg-5">
			<a class="navbar-brand" href="/">Inventario para tienda de instrumentos</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
		</div>
	</nav>
	
	<!-- Header-->
	<div id="header" name="Crear nuevo instrumento", subtitle='Variedad y calidad'></div>
	<form action="http://localhost:8000/instruments/create" method="post" id="createForm">
		<div style="margin-left: 600px; margin-right: 650px; margin-top: 50px" align="center">
			<div name="inputItemX" id="description" desc="Descripción" type="text"></div>
			<div name="inputItemX" id="price" desc="Precio" type="text"></div>
			<div name="inputItemX" id="picture" desc="Imagen" type="text"></div>
			<div name="inputItemX" id="available" desc="Disponibles" type="number"></div>
			<div class="mb-3 row">
				<label for="category" class="col-sm-2 col-form-label">Categoría</label>
				<div class="col-sm-10">
					<?php
					use App\Models\Category;
					//Get a list of all categories by string
					$categories = Category::all();
					for ($i=0; $i < count($categories); $i++) { 
						echo '
							<input href="#" type="radio" class="form-check-input" name="category" value="' . $categories[$i]->Id . '"/>' . $categories[$i]->Name . '
						';
					}
					?>
				</div>
			</div>
			<div class="col-auto">
    			<button type="submit" class="btn btn-primary mb-3">Mandar</button>
  			</div>
		</div>
	</form>

	<!-- Footer-->
	<footer class="py-5 bg-dark">
		<div class="container"><p class="m-0 text-center text-white">Copyright &copy; David 2022</p></div>
	</footer>
	<!-- Bootstrap core JS-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<!-- Core theme JS-->
	<script src="js/scripts.js"></script>
	</body>
</html>