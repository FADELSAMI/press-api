$(document).ready(function () {
    loadPageContent("index");
    // Load the default page JS (index.js)
    loadJsFile("index"); // Load index.js initially

    // Load favorite.js when the "Load Favorites" button is clicked
    loadJsFile("favorite"); // Load favorite.js dynamically

    // Load details.js when the "Load Details" button is clicked
    loadJsFile("details"); // Load details.js dynamically

    // Chargement dynamique du menu :
    $(".nav-link").on("click", function () {
        const page = $(this).data("page"); // Get the page name from data-page attribute
        const jsFile = page; // Get the JS file name based on the page

        // Load the content of the page :Charge dynamiquement le contenu HTML de la page
        loadPageContent(page);

        // Load the corresponding JS  : Charge dynamiquement le fichier JS de la page
        loadJsFile(jsFile);
    });

    // Function to load the page content
    function loadPageContent(page) {
        // Make an AJAX request to fetch the page content
        $.ajax({
            url: `/${page}`, // Assuming the page URL is the same as the Blade file name
            type: "GET",
            success: function (response) {
                $("#content-container").html(response); // Assuming there's a div to hold the content
            },
            error: function (xhr, status, error) {
                console.error("Erreur lors du chargement de la page:", error);
            },
        });
    }

    // Function to load the corresponding JS file
    function loadJsFile(page) {
        // Check if the script is already loaded
        const existingScript = document.getElementById("page-js");
        if (existingScript) {
            existingScript.remove(); // Remove the previous script if it exists
        }

        // Create a new script element
        const script = document.createElement("script");
        script.id = "page-js"; // Add an id to track the script
        script.src = `js/${page}.js`; // Dynamically set the src path for JS files
        script.type = "text/javascript";

        // Optional: log success/error
        script.onload = function () {
            console.log(`${page}.js loaded successfully.`);
        };
        script.onerror = function () {
            console.error(`Failed to load ${page}.js.`);
        };

        // Append the script to the document body
        document.body.appendChild(script);
    }
});
