<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />

    <style>
        body {
            height: 100vh
        }
        .login-cont {
            height: 100%;
            display: grid;
            justify-content: center;
            align-items: center;
        }
        .login {
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2), 0 4px 6px rgba(0, 0, 0, 0.15);
            transition: box-shadow 0.3s ease-in-out;
            padding: 4rem;
            border-radius: 8px;
        }
        .input-group {
            flex-direction: column
        }
        .input-group input {
            width: 100% !important;
        }
    </style>
</head>
<body>
   <div class="container login-cont">
    <div class="login">
        <h1>Espace de connexion</h1>
        <div class="login-content">
            <form>
                <div class="input-group mb-3">
                    <label for="keyword" class="form-label">Nom d'utilisateur</label>
                    <input
                        type="text"
                        class="form-control"
                        id="user"
                        placeholder="Alice"
                        name="user"
                        required />
                </div>
                <div class="input-group mb-3">
                    <label for="keyword" class="form-label">Mot de passe</label>
                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        name="password"
                        required />
                </div>
                <button class="btn btn-warning">Se connecter</button>
            </form>
        </div>
        </div>
    </div>
   </div> 

</body>
</html>