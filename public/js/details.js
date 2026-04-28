$(document).ready(function () {
    $(document).on("click", "#close-panel", function () {
        $(this).hide();
    });
    //Détection du clic sur un article
    $(document).on("click", ".article-media", function () {
        function checkSideContentPosition() {
            var sideContentRight = $(".side-content").css("right");

            if (sideContentRight === "-531px") {
                $("#close-panel").show();
            } else {
                $("#close-panel").hide();
            }
        }

        // Initial check on page load
        checkSideContentPosition();

        let articleId = $(this).data("id"); // Récupération de l’id de l’article

        if (!articleId) {
            console.error("Error: data-id is missing on the clicked element.");
            return;
        }
// On envoie une requête GET à un endpoint /api/articles/{id} pour récupérer les détails de l’article en JSON
        $.ajax({
            url: "/api/articles/" + articleId, // Requête AJAX vers le serveur
            type: "GET",
            dataType: "json", // Ensure JSON response is expected
            success: function (response) {
                // Vérifier si la catégorie existe pour cet article
                console.log(response);
                const categoryName = response.article.category
                    ? response.article.category.name_cat
                    : "Sans catégorie";
                $("#side-content").html(`<div class="article-header">   
                <h5 class="display-4 text-center mb-4" style="font-size: 2.5rem">${
                    response.article.title_art
                }</h5>
                <span class="article-tag">${categoryName}</span>
                <span class="article-date">${response.article.date_art}</span>
                <span class="article-views">${
                    response.article.readtime_art
                }<img src="icons/show.png" alt="Vus"/></span>
                <button class="btn btn-warning favorite-btn" data-id="${
                    response.article.id_art
                }">
                        ${
                            response.isFavorite
                                ? "Retirer des favoris"
                                : "Ajouter aux favoris"
                        }
                </button>
                <img
                        src="/images/media/${response.article.image_art}"
                        alt="Image de sous-actualité 3"
                />
                </div>
                <div class="art-body">${response.article.content_art}</div>
            `);

                // Animation d’affichage vers la droite
                $(".side-content").animate(
                    {
                        right: "0px",
                    },
                    150
                );
            },
            error: function (xhr, status, error) {
                console.error("Error fetching article:", error);
                console.error("Server Response:", xhr.responseText);
            },
        });
    });

    // Hide .side-content when clicking outside
    $(document).on("click", function (event) {
        if (!$(event.target).closest(".side-content, .article-media").length) {
            $(".side-content").animate(
                {
                    right: "-531px",
                },
                150
            );
        }
    });
});
