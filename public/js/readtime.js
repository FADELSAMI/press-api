$(document).ready(function () {
    // Utiliser jQuery pour récupérer les articles depuis l'API
    $.ajax({
        url: "/api/readTime",
        type: "GET",
        dataType: "json",
        success: function (data) {
            // Sélectionner le conteneur où les articles seront affichés
            const favoritesTable = $("#readTime_list");
            favoritesTable.empty(); // Vider le tableau avant d'ajouter de nouvelles données

            // Vérifier s'il y a des articles dans la réponse
            if (data.length) {
                let articleLength = data.length;

                // Parcourir les articles et les afficher
                $.each(data, function (index, favorite) {
                    let articleElement = `
                        <tr>
                            <th scope="row">${index + 1}</th>
                            <td>${favorite.ident_art}</td>
                            <td>${favorite.title_art}</td>
                            <td>${favorite.readtime_art}</td>
                        </tr>
                    `;

                    // Ajouter l'article au tableau
                    favoritesTable.append(articleElement);
                });

                // Ajouter la ligne pour le total des articles
                let articleTotal = `
                    <tr>
                        <td style="font-weight:600">Nombre total des articles</td>
                        <td style="font-weight:600">${articleLength}</td>
                    </tr>
                `;

                favoritesTable.append(articleTotal);
            } else {
                // Si aucun article n'est trouvé
                favoritesTable.html(
                    '<tr><td colspan="4">Aucun article trouvé.</td></tr>'
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
});
