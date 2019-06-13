<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="icon" type="image/png" href="img/logo.ico"/>
    <link
            rel="stylesheet"
            href="node_modules/bootstrap/dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="src/css/general.css"/>
    <link rel="stylesheet" href="src/css/login.css"/>
    <title>USMP - Reserva de Cubiculos</title>
</head>

<body class="gradient">
<div
        class="container vh-100 d-flex align-items-center justify-content-center "
>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg">
                <div class="card-body ">
                    <img src="src/img/logo_fia.png" class="logo p-3 " alt="logo"/>
                    <form action="src/vaaaaaaaaaaalidar_login.php" method="post">
                        <div class="form-group">
                            <label>Email</label>
                            <input
                                    type="email"
                                    class="inputCustom"
                                    placeholder="ejemplo@usmp.pe"
                                    name="txtCorreo"
                            />
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input
                                    type="password"
                                    class="inputCustom "
                                    placeholder="•••••••"
                                    name="txtClave"
                            />
                        </div>
                        <div class="mt-5 mb-3">
                             <input type="submit" class="btnCustom w-100" name="btnIngresar" value="ingresar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<link rel="stylesheet" href="node_modules/jquery/dist/jquery.min.js"/>
<link rel="stylesheet" href="node_modules/popper.js/dist/popper.min.js"/>
<link
        rel="stylesheet"
        href="node_modules/bootstrap/dist/js/bootstrap.min.js"
/>
</html>
