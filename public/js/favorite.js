$(document).ready(function () {
    function fetchFavorites() {
        return $.ajax({
            url: "/api/favorites?" + new Date().getTime(),
            type: "GET",
            dataType: "json",
        })
            .then(function (response) {
                return response.favorites || [];
            })
            .catch(function (error) {
                console.error(
                    "Erreur lors de la récupération des favoris :",
                    error
                );
                return [];
            });
    }

    function updateFavoriteButton(button, isFav) {
        $(button).text(isFav ? "Retirer des favoris" : "Ajouter aux favoris");
    }

    // 🛠 Gérer l'ajout/suppression des favoris
    $(document).on("click", ".favorite-btn", function () {
        const articleId = $(this).data("id");
        const button = $(this);
        const action =
            button.text().trim() === "Ajouter aux favoris" ? "add" : "remove";

        $.ajax({
            url: `/api/favorites/${action}/${articleId}`,
            type: "POST",
            success: function (response) {
                alert(response.message);
                // ✅ Mettre à jour immédiatement le texte du bouton avant la requête AJAX
                updateFavoriteButton(button, action === "add");
            },
            error: function (xhr, status, error) {
                console.error(
                    "Erreur lors de la mise à jour des favoris :",
                    error
                );
            },
        });
    });
});
