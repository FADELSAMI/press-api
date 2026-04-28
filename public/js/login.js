$(document).ready(function () {
    $("form").submit(function (event) {
        event.preventDefault(); // Prevent default form submission

        const user = $("#user").val();
        const password = $("#password").val();

        $.ajax({
            url: "http://playground.burotix.be/login",
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify({ user: user, password: password }),
            success: function (data) {
                console.log(data);

                if (data && data.token) {
                    localStorage.setItem("authToken", data.token);
                    alert("Login successful! Token saved.");
                    // window.location.href = '/dashboard';
                } else if (data && data.error) {
                    alert("Login failed: " + data.error);
                } else {
                    alert("Login failed: unknown error");
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX request failed:", status, error);
                alert("Login failed: " + error);
            },
        });
    });
});
