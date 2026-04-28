$(document).ready(function () {
    function fetchFavorites() {
        $.ajax({
            url: "/api/favorites",
            type: "GET",
            dataType: "json",
            success: function (response) {
                const favorites_table = $("#favorites_list");
                favorites_table.empty(); // Vider la liste avant d'ajouter les nouveaux éléments

                if (response.count > 0) {
                    response.favorites.forEach((favorite, index) => {
                        let articleElement = `
                            <tr data-id="${favorite.id}">
                                <th scope="row">${index + 1}</th>
                                <td>${favorite.title}</td>
                                <td>
                                    <button class="btn btn-danger remove-favorite-btn" data-id="${
                                        favorite.id
                                    }">
                                        Retirer des favoris
                                    </button>
                                </td>
                            </tr>
                        `;
                        favorites_table.append(articleElement);
                    });

                    let article_total = `
                        <tr id="total_row">
                            <td style="font-weight:600">Nombre total des articles</td>
                            <td style="font-weight:600">${response.count}</td>
                            <td style="font-weight:600">
                                <button type="button" class="btn btn-outline-danger clear-favorite-btn">
                                    Vider les favoris
                                </button>
                            </td>
                        </tr>
                    `;
                    favorites_table.append(article_total);
                } else {
                    favorites_table.html(
                        "<tr><td colspan='3'>Aucun article trouvé.</td></tr>"
                    );
                }
            },
            error: function (xhr, status, error) {
                console.error(
                    "Erreur lors de la récupération des articles :",
                    error
                );
            },
        });
    }

    // Charger les favoris au chargement de la page
    fetchFavorites();
    $(document).on("click", ".remove-favorite-btn", function () {
        let articleId = $(this).data("id");

        $.ajax({
            url: `/api/favorites/remove/${articleId}`,
            type: "POST",
            data: { id: articleId },
            success: function (response) {
                alert(response.message);

                fetchFavorites();
            },
            error: function (xhr, status, error) {
                console.error(
                    "Erreur lors de la suppression du favori :",
                    error
                );
                removeBtn.prop("disabled", false); // Réactiver en cas d'erreur
            },
        });
    });

    $(document).on("click", ".clear-favorite-btn", function () {
        $.ajax({
            url: `/api/favorites/clear`,
            type: "POST",
            success: function (response) {
                alert(response.message);

                fetchFavorites();
            },
            error: function (xhr, status, error) {
                console.error(
                    "Erreur lors de la suppression du favori :",
                    error
                );
                removeBtn.prop("disabled", false); // Réactiver en cas d'erreur
            },
        });
    });
});
