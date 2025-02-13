<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login Page - Música</title>
        <link rel="stylesheet" href="./views/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <h1 class="text-center mt-4">Música</h1>
            <div class="card border-success mb-3 mx-auto" style="max-width: 30rem;">
                <div class="card-header text-center">Login Usuario</div>
                <div class="card-body">
                    <form id="loginForm" name="loginForm" action="" method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" placeholder="email" class="form-control" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="password">Clave</label>
                            <input type="password" id="password" name="password" placeholder="password" class="form-control" required>
                        </div>              
                        <div class="d-grid mt-4">
                            <input type="submit" name="submit" value="Login" class="btn btn-warning">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>