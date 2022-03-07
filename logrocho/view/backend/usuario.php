<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha usuario</title>
    <base href="<?= getHome(); ?>view/backend/">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body class="d-flex flex-column">
    <?php include "cabecera.php"; ?>
    <section class="container my-5">
        <div class="row d-flex">
            <div class="col">
                <input type="number" id="id" name="id" class="d-none">
                <div class="row mb-4">
                    <div class="col-12 col-md-auto d-flex align-items-center justify-content-center justify-content-md-start">
                        <button class="btn btn-lg btn-outline-primary btn-light me-2 flex-fill" id="boton__crear">Crear</button>
                        <button class="btn btn-lg btn-outline-success btn-light me-2 flex-fill" id="boton__guardar">Guardar</button>
                        <button class="btn btn-lg btn-outline-danger btn-light flex-fill" id="boton__eliminar">Eliminar</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="form-floating">
                            <input type="text" name="nombre" id="nombre" placeholder="Usuario x" class="form-control campo" required>
                            <div class="valid-feedback">
                                Campo introducido correctamente
                            </div>
                            <div class="invalid-feedback">
                                Campo obligatorio
                            </div>
                            <label for="nombre">Nombre</label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                        <div class="form-floating">
                            <input type="password" name="clave" id="clave" placeholder="P4sswd-" class="form-control campo" required>
                            <div class="valid-feedback">
                                Campo introducido correctamente
                            </div>
                            <div class="invalid-feedback">
                                Campo obligatorio<!-- y/o no cumple los requisitos de contraseña (8 caracteres, 1 mayúscula, 1 minúscula y 1 número) -->
                            </div>
                            <label for="clave">Contraseña</label>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                    <div class="form-floating">
                            <input type="email" name="correo" id="correo" placeholder="correo@usuario.com" class="form-control campo" required>
                            <div class="valid-feedback">
                                Campo introducido correctamente
                            </div>
                            <div class="invalid-feedback">
                                Campo obligatorio
                            </div>
                            <label for="correo">Correo electrónico</label>
                        </div>
                    </div>
                    <div class="col-12 my-3 ms-2">
                        <label for="admin">Administrador</label>
                        <input type="checkbox" name="admin" id="admin" class="form-check form-check-input d-inline ms-2">
                    </div>
                    <div class="col-12 mt-3">
                        <input type="file" id="files" name="files" class="d-none">
                        <label for="files" class="form-control">
                            <div>Foto de perfil</div>
                            <div id='result'></div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include "footer.php"; ?>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/img.js"></script>
    <script src="js/validacion.js"></script>
    <script src="js/AjaxSerialization.js"></script>
    <script src="js/usuario.js"></script>
</body>

</html>