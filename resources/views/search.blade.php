
<section class="form-body">	
	<span class="side-panel-close"><img id="close-panel" src="icons/fermer.png" alt="Vus"/></span>
	<div class="container">
		<div class="col-md-12 col-lg-12 col-sm-12">
			<h4 class="mb-3">Recherche dans les articles</h4>
			<form id="searchForm" class="needs-validation" novalidate="">
				<div class="row g-3">
					<div class="col-md-6 col-sm-6">
						<label for="keyword" class="form-label">Mot-clé dans le titre et/ou le résumé</label>
						<input
							type="text"
							class="form-control"
							id="keyword"
							placeholder=""
							name="keyword"
							value=""
							required />
					</div>
					<div class="col-lg-6">
						<label for="category" class="form-label">Catégorie</label>
						<select class="form-select" name="category_id" id="category" required="">
						</select>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<label for="readmin" class="form-label">Nombre de lécture min</label>
							<input
								type="number"
								class="form-control"
								id="readmin"
								name="readmin"
								placeholder=""
								value=""
								required="" />
						</div>

						<div class="col-lg-6">
							<label for="readmax" class="form-label"
								>Nombre de lecture max</label>
							<input
								type="number"
								class="form-control"
								id="readmax"
								name="readmax" />
						</div>
					</div>
				<button class="btn btn-warning" type="submit">
					Valider
				</button>
			</form>
		</div>
	</div>
</section>
<section class="results">
	<div class="container">
	<div id="results_list" class="row" style="padding-block:2rem"></div>
	</div>
</section>

<script src="js/details.js"></script>
