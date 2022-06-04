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
			<a class="navbar-brand" href="#!">Inventario para tienda de instrumentos</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
		</div>
	</nav>
	
	<!-- Header-->
	<div id="header" name="Instrumentos", subtitle='Variedad y calidad'></div>
	
	<label for="touch"><span>Filtrar por categoría</span></label>               
	<input type="checkbox" id="touch"> 
	
	<ul class="slide">
		<a href="http://localhost:8000/instruments/add">Añadir nuevos instrumentos</a>
		<form action="http://localhost:8000/instruments/filter" method="post" id="filterForm">
		<?php
		use App\Models\Category;
		//Get a list of all categories by string
		$categories = Category::all();
		for ($i=0; $i < count($categories); $i++) { 
			echo '
			<div align="left">
				<li><input href="#" type="checkbox" class="form-check-input" name="' . $categories[$i]->Name . '" checked>' . $categories[$i]->Name . '</li>
			</div>
			';
		}
		?>
	</ul>
	<div align="left" style="margin-left: 50px; margin-top: 50px">
		<input type="submit" class="btn btn-outline-dark mt-auto" value="Filtrar"/>
	</div>
	</form>

	<!-- Section-->
	<form action="instruments/buy/" method="post" id="buyForm"></form>
	<form action="instruments/delete/" method="post" id="deleteForm"></form>
	<section class="py-5">
		<div class="container px-4 px-lg-5 mt-5">
			<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
				<?php
				for ($i=0; $i < count($itemsInSale); $i++) { 
					echo "<div name='saleItem', 
					item='" . json_encode($itemsInSale[$i], JSON_HEX_APOS) . "'
					stock='" . json_encode($stocksRef[$i], JSON_HEX_APOS) ."'></div>";
				}
				?>
				
				<div name='saleItem'></div>
			</div>
		</div>
	</section>
	<!-- Footer-->
	<footer class="py-5 bg-dark">
		<div class="container"><p class="m-0 text-center text-white">Copyright &copy; David 2022</p></div>
	</footer>
	<!-- Bootstrap core JS-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<!-- Core theme JS-->
	<script src="js/scripts.js"></script>
	<script>
		//Filtering stuff

	</script>
	</body>
</html>