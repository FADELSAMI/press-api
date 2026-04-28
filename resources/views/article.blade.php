<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Article 1</title>
		<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
		<!-- Bootstrap CSS -->
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
			rel="stylesheet" />
	</head>
	<body>
		<header>
			<section class="slim-header">
				<div class="container">
					<nav class="navbar navbar-expand-lg">
						<div class="container-fluid">
							<button
								class="navbar-toggler"
								type="button"
								data-bs-toggle="collapse"
								data-bs-target="#navbarNavAltMarkup"
								aria-controls="navbarNavAltMarkup"
								aria-expanded="false"
								aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>
							<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
								<div class="navbar-nav">
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
			<section class="main-header">
				<div class="container">
					<nav class="navbar navbar-expand-lg navbar-light bg-light">
						<div class="container-fluid">
							<a class="navbar-brand" href="index.html">Désert Magique</a>
							<button
								class="navbar-toggler"
								type="button"
								data-bs-toggle="collapse"
								data-bs-target="#navbarSupportedContent"
								aria-controls="navbarSupportedContent"
								aria-expanded="false"
								aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>
							<div class="collapse navbar-collapse" id="navbarSupportedContent">
								<ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    @foreach($menuItems as $item)
                                        <li class="nav-item"><a class="nav-link" href="{{ url($item['url']) }}">{{ $item['label'] }}</a></li>
                                    @endforeach
								</ul>
								<div class="d-flex signup-form">
									<button class="btn btn-warning"><a href="/login">Connexion</a></button>
									<a href="/search"
                                    ><img class="search-icon" src="{{asset('icons/search.svg')}}" alt="searche icon"
                                /></a>
								</div>
							</div>
						</div>
					</nav>
				</div>
			</section>
		</header>
		<main class="article-details">
			<div id="article_details" class="container">

	
			</div>
		</main>

		<footer class="text-center text-white py-3">
			<div class="container">
				<div class="row footer-content">
					<div class="col-md-3 col-sm-12 mb-3 mb-md-0">
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
					<div class="col-md-3 col-sm-12 mb-3 mb-md-0">
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
					<div class="col-md-3 col-sm-12">
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
					<div class="col-md-3 col-sm-12">
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
					&copy; 2024 Desert magique. Tous droits réservés.
				</p>
			</div>
		</footer>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
        <script>
			// Récupérer l'ID de l'article à partir de l'URL
            const articleId = window.location.pathname.split('/').pop();

            // Effectuer une requête fetch pour récupérer les détails de l'article
            fetch(`/api/articles/${articleId}`)
                .then(response => response.json())
                .then(data => {
                    const favorites = data.favorites || []; // Récupérer les favoris depuis l'API (depuis le fichier)
                    // Afficher les détails de l'article sur la page
                    const articleDetails = document.getElementById('article_details');
                    // Vérifier si la catégorie existe pour cet article
					const categoryName = data.article.category ? data.article.category.name_cat : 'Sans catégorie';

                    articleDetails.innerHTML = `
                    <div class="article-header">
                        <h1 class="display-4 text-center mb-4">${data.article.title_art}</h1>
                        <span class="article-tag">${categoryName}</span>
					    <span class="article-date">${data.article.date_art}</span>
                        <span class="article-views">${data.article.readtime_art}<img src="{{asset('icons/show.png')}}" alt="Vus"/></span>
                        <button class="btn btn-warning favorite-btn" data-id="${data.article.id_art}">
                                ${data.isFavorite ? 'Retirer des favoris' : 'Ajouter aux favoris'}
                        </button>

                        <img
                                src="/images/articles/${data.article.image_art}"
                                alt="Image de sous-actualité 3"
                        />
                        </div>
                        <div class="art-body">${data.article.content_art}</div>
                    `;

                    // Ajouter un gestionnaire d'événements pour les boutons de favoris
						const favoriteButtons = document.querySelectorAll('.favorite-btn');
						favoriteButtons.forEach(button => {
							button.addEventListener('click', (event) => {
								const articleId = event.target.getAttribute('data-id');
								const action = event.target.textContent.includes('Ajouter') ? 'add' : 'remove';

								fetch(`/api/articles/favorite/${articleId}`, {
									method: action === 'add' ? 'POST' : 'DELETE',
									  // Action POST pour ajouter, DELETE pour retirer
								})
								.then(response => response.json())
								.then(data => {
									alert(data.message);
									// Mettre à jour l'état du bouton
									event.target.textContent = action === 'add' ? 'Retirer des favoris' : 'Ajouter aux favoris';
								})
								.catch(error => {
									console.error('Erreur lors de la modification des favoris :', error);
								});
							});
						});
                })
                .catch(error => {
                    console.error('Erreur lors de la récupération des détails de l\'article:', error);
                });


				function changeTheme() {
					var theme = document.getElementById('theme').value;
					document.body.classList.remove('theme-yellow', 'theme-pink', 'theme-blue'); // Remove all theme classes
					document.body.classList.add('theme-' + theme); // Add the selected theme class
					localStorage.setItem('theme', theme); // Store the selected theme in localStorage
				}

				function changeFontSize() {
					var fontSize = document.getElementById('font-size').value;
					document.body.classList.remove('font-small', 'font-medium', 'font-large'); // Remove all font size classes
					document.body.classList.add('font-' + fontSize); // Add the selected font size class
					localStorage.setItem('font-size', fontSize); // Store the selected font size in localStorage
				}

				// Apply previously selected theme and font size (if any)
				window.onload = function() {
					var storedTheme = localStorage.getItem('theme');
					if (storedTheme) {
						document.body.classList.add('theme-' + storedTheme);
						document.getElementById('theme').value = storedTheme; // Set the select value
					}

					var storedFontSize = localStorage.getItem('font-size');
					if (storedFontSize) {
						document.body.classList.add('font-' + storedFontSize);
						document.getElementById('font-size').value = storedFontSize; // Set the select value
					}
				};
		</script>
	</body>
</html>
