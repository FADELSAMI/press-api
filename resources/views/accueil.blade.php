
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>Press api</title>
		<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/responsive.css') }}" />
		<!-- Bootstrap CSS -->
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
			rel="stylesheet" />
			<!-- Bootstrap JS and dependencies -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
		<!-- Load jQuery first -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="js/load.js"></script>
		<script src="js/theme.js"></script>
		<style>
			.cover-image {
				width: 100%;
				height: 100vh;
				object-fit: cover;
			}
		</style>
	</head>

	<body>
		<div id="side-content" class="side-content">
			<h3>Hello World!</h3>
		</div>
		<header>
			<section class="main-header">
				<div class="container">
					<nav class="navbar navbar-expand-lg navbar-light bg-light">
						<div class="container-fluid">
							<button
								class="navbar-toggler"
								type="button"
								data-bs-toggle="collapse"
								data-bs-target="#navbarSupportedContentMain"
								aria-controls="navbarSupportedContentMain"
								aria-expanded="false"
								aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>
							<div
								class="collapse navbar-collapse"
								id="navbarSupportedContentMain">
								<ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                @foreach($menuItems as $item)
								<li class="nav-item"><a class="nav-link"  data-page="{{ $item['page blade'] }}">{{ $item['label'] }}</a></li>
                                @endforeach
								</ul>
								<div class="d-flex signup-form">
									<button class="btn btn-warning"><a class="nav-link" data-page="login">Connexion</a></button>
									<a class="nav-link" data-page="search"
                                    ><img class="search-icon" src="{{asset('icons/search.svg')}}" alt="searche icon"
                                /></a>
								<div class="theme-font-selector">
                                        <select id="theme" onchange="changeTheme()">
                                            <option></option>
                                            <option value="yellow">Yellow</option>
                                            <option value="pink">Pink</option>
                                            <option value="blue">Blue</option>
                                        </select>
                                        <select id="font-size" onchange="changeFontSize()">
                                            <option></option>
                                            <option value="small">Small</option>
                                            <option value="medium" selected>Medium</option>
                                            <option value="large">Large</option>
                                        </select>
                                    </div>
								</div>
							</div>
						</div>
					</nav>
				</div>
			</section>
		</header>

				<div id="content-container"></div>


		<footer class="text-center text-white py-3">
			<div class="container">
				<div class="row footer-content">
					<div class="col-12 col-md-3 mb-3 mb-md-0">
						<h5>Thématiques</h5>
						<ul>
							<li><a href="#">Info</a></li>
							<li><a href="#">Sport</a></li>
							<li><a href="#">Actualités locales</a></li>
							<li><a href="#">Culture et musique</a></li>
							<li><a href="#">Envirenement et nature</a></li>
							<li><a href="#">Santé et bien-étre</a></li>
							<li><a href="#">Siences et Téchnologies</a></li>
							<li><a href="#">Vie pratique</a></li>
						</ul>
					</div>
					<div class="col-12 col-md-3 mb-3 mb-md-0">
						<h5>Sérvices</h5>
						<ul>
							<li><a href="#">Actu en continu</a></li>
							<li><a href="#">Grille des progamme</a></li>
							<li><a href="#">Actualités locales</a></li>
							<li><a href="#">Culture et musique</a></li>
							<li><a href="#">Envirenement et nature</a></li>
							<li><a href="#">Santé et bien-étre</a></li>
							<li><a href="#">Siences et Téchnologies</a></li>
							<li><a href="#">Vie pratique</a></li>
						</ul>
					</div>
					<div class="col-12 col-md-3">
						<h5>Radios</h5>
						<ul>
							<li><a href="#">Classic 21</a></li>
							<li><a href="#">La premiére</a></li>
							<li><a href="#">Vivacité</a></li>
							<li><a href="#">Tipik</a></li>
							<li><a href="#">Music3</a></li>
							<li><a href="#">Tarmac</a></li>
							<li><a href="#">Viva+</a></li>
							<li><a href="#">Jam</a></li>
						</ul>
					</div>
					<div class="col-12 col-md-3">
						<h5>Nous contacter</h5>
						<ul>
							<li><a href="#">Contacter la BruTimes</a></li>
							<li><a href="#">Recevoire la BruTimes</a></li>
							<li><a href="#">Travailler à la BruTimes</a></li>
							<li><a href="#">Notre entreprise</a></li>
							<li><a href="#">Presse</a></li>
							<li><a href="#">Education aux médias</a></li>
						</ul>
					</div>
				</div>
				<p class="mt-4 rights">
					&copy; 2025 Desert magique. Tous droits réservés.
				</p>
			</div>
		</footer>
	</body>
</html>
