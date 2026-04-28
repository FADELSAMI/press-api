function changeTheme() {
    var theme = document.getElementById("theme").value;
    document.body.classList.remove("theme-yellow", "theme-pink", "theme-blue"); // Remove all theme classes
    document.body.classList.add("theme-" + theme); // Add the selected theme class
    localStorage.setItem("theme", theme); // Store the selected theme in localStorage
}

function changeFontSize() {
    var fontSize = document.getElementById("font-size").value;
    document.body.classList.remove("font-small", "font-medium", "font-large"); // Remove all font size classes
    document.body.classList.add("font-" + fontSize); // Add the selected font size class
    localStorage.setItem("font-size", fontSize); // Store the selected font size in localStorage
}

// Apply previously selected theme and font size (if any)
window.onload = function () {
    var storedTheme = localStorage.getItem("theme");
    if (storedTheme) {
        document.body.classList.add("theme-" + storedTheme);
        document.getElementById("theme").value = storedTheme; // Set the select value
    }

    var storedFontSize = localStorage.getItem("font-size");
    if (storedFontSize) {
        document.body.classList.add("font-" + storedFontSize);
        document.getElementById("font-size").value = storedFontSize; // Set the select value
    }
};
