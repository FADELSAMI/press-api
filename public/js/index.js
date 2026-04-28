$(document).ready(function () {
    // Utiliser jQuery AJAX pour récupérer les articles depuis l'API
    $.ajax({
        url: "/api/articles",
        type: "GET",
        dataType: "json",
        success: function (data) {
            // Sélectionner le conteneur où les articles seront affichés
            const articlesList = $("#articles_list");
            articlesList.empty(); // Vider la liste avant d'ajouter de nouvelles données

            // Vérifier s'il y a des articles dans la réponse
            if (data.length) {
                $.each(data, function (index, article) {
                    // Vérifier si la catégorie existe pour cet article
                    const categoryName = article.category
                        ? article.category.name_cat
                        : "Sans catégorie";

                    // Limiter la longueur du titre et du "hook"
                    const truncatedTitle =
                        article.title_art.length > 60
                            ? article.title_art.slice(0, 60) + "..."
                            : article.title_art;
                    const truncatedHook =
                        article.hook_art.length > 200
                            ? article.hook_art.slice(0, 200) + "..."
                            : article.hook_art;

                    // Créer un élément HTML pour chaque article
                    let articleElement = `
                        <div class="col-12 col-lg-3 col-md-6 mb-20">
                            <article class="card mb-4">
                                <div class="article-media" data-id="${article.id_art}">
                                    <img src="images/media/${article.image_art}" alt="Image" />
                                </div>
                                <div class="card-body">
                                    <h3>${truncatedTitle}</h3>
                                    <p class="card-text">${truncatedHook}…</p>
                                    <div class="article-footer">
                                        <span class="article-tag" style="flex: 1">${categoryName}</span>
                                        <span class="article-date">${article.date_art}</span>
                                        <span class="art-views">${article.readtime_art}<img src="icons/show.png" alt="Vus"/></span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    `;

                    // Ajouter l'article au conteneur
                    articlesList.append(articleElement);
                });
            } else {
                // Si aucun article n'est trouvé
                articlesList.html("<p>Aucun article trouvé.</p>");
            }
        },
        error: function (xhr, status, error) {
            console.error(
                "Erreur lors de la récupération des articles :",
                error
            );
        },
    });
});
