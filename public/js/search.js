$(document).ready(function () {
    $("#searchForm").on("submit", function (event) {
        event.preventDefault();

        const searchKeyword = $("#keyword").val();
        const category = $("#category").val();
        const readmin = $("#readmin").val();
        const readmax = $("#readmax").val();
//ce qui suit gère la recherche avec les filtres
        // Vérification si readmin est inférieur à readmax
        if (readmin > readmax) {
            alert(
                "Le nombre de lectures minimum doit être inférieur au nombre de lectures maximum!"
            );
            return;
        }

        // Construire l'URL avec les paramètres
        let url = `/api/search?keyword=${encodeURIComponent(searchKeyword)}`;

        if (category) {
            url += `&category_id=${encodeURIComponent(category)}`;
        }
        if (readmin) {
            url += `&readmin=${encodeURIComponent(readmin)}`;
        }
        if (readmax) {
            url += `&readmax=${encodeURIComponent(readmax)}`;
        }

        // Réinitialise la table ou la section des résultats
        $("#results_list").html(""); // Vider les anciens résultats

        // C’est cette partie qui génère le contenu de façon dynamique (elle vient charger toutes les catégories depuis l’API).
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (data) {
                // Sélectionner le conteneur où les articles seront affichés
                const resultsLit = $("#results_list");

                // Vérifier s'il y a des articles dans la réponse
                if (data.data.length) {
                    // Créer une liste d'articles à afficher
                    data.data.forEach(function (article) {
                        // Vérifier si la catégorie existe pour cet article
                        const categoryName = article.category
                            ? article.category.name_cat
                            : "Sans catégorie";
                        // Limiter à 80 caractères
                        const truncatedTitle =
                            article.title_art.length > 60
                                ? article.title_art.slice(0, 60) + "..."
                                : article.title_art;
                        const truncatedHook =
                            article.hook_art.length > 200
                                ? article.hook_art.slice(0, 200) + "..."
                                : article.hook_art;

                        // Créer un élément pour chaque article
                        const articleElement = `
                            <div class="col-12 col-lg-3 col-md-6 mb-20">
                                <article class="card mb-4">
                                    <div class="article-media" data-id="${article.id_art}">
                                        <a >
                                            <img src="images/media/${article.image_art}" alt="Image" />
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h3>${truncatedTitle}</h3>
                                        <p class="card-text">
                                            ${truncatedHook}…
                                        </p>
                                        <div class="article-footer">
                                            <span class="article-tag" style="flex: 1">${categoryName}</span>
                                            <span class="article-date">${article.date_art}</span>
                                            <span class="art-views">${article.readtime_art}<img src="{{asset('icons/show.png')}}" alt="Vus"/></span>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        `;

                        // Ajouter l'article au conteneur
                        resultsLit.append(articleElement);
                    });
                } else {
                    // Si aucun article n'est trouvé
                    resultsLit.html("<p>Aucun résultat trouvé.</p>");
                }
            },
            error: function (xhr, status, error) {
                console.error(
                    "Erreur lors de la récupération des résultats :",
                    error
                );
            },
        });
    });
});

$(document).ready(function () {
    // Utiliser jQuery pour récupérer les catégories depuis l'API
    $.ajax({
        url: "/api/category",
        type: "GET",
        dataType: "json",
        success: function (data) {
            const categoryLit = $("#category");

            // Créer l'option vide
            const emptyOption = $("<option></option>");
            emptyOption.val(""); // Valeur vide
            emptyOption.text(" "); // Texte de l'option vide
            categoryLit.append(emptyOption); // Ajouter l'option vide en premier

            // Vérifier s'il y a des catégories dans la réponse
            if (data.length) {
                data.forEach(function (category) {
                    // Créer un élément pour chaque catégorie
                    const categoryElement = $("<option></option>");
                    categoryElement.val(category.id_cat);
                    categoryElement.text(category.name_cat);

                    // Ajouter l'élément catégorie au conteneur
                    categoryLit.append(categoryElement);
                });
            } else {
                // Si aucune catégorie n'est trouvée
                $("#results_list").html("<p>Aucune catégorie trouvée.</p>");
            }
        },
        error: function (xhr, status, error) {
            console.error(
                "Erreur lors de la récupération des catégories",
                error
            );
        },
    });
});
