<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha valoración</title>
    <base href="<?= getHome(); ?>view/backend/">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body class="d-flex flex-column">
    <?php include "cabecera.php"; ?>
    <section class="container my-5">
        <div class="row d-flex fs-5">
            <div class="col">
                <div class="row mb-4">
                    <div class="col-12 col-md-auto d-flex align-items-center justify-content-center justify-content-md-start">
                        <button class="btn btn-lg btn-outline-primary btn-light me-2 flex-fill">Crear</button>
                        <button class="btn btn-lg btn-outline-success btn-light me-2 flex-fill">Guardar</button>
                        <button class="btn btn-lg btn-outline-danger btn-light flex-fill">Eliminar</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 col-md-4">
                        <div class="form-floating">
                            <select name="pincho" id="pincho" class="form-control form-control-lg">
                                <option value="pincho1">Pincho 1</option>
                                <option value="pincho2">Pincho 2</option>
                                <option value="pincho3" selected>Pincho 3</option>
                                <option value="pincho4">Pincho 4</option>
                            </select>
                            <label for="picho">Pincho</label>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="form-floating">
                            <select name="usuario" id="usuario" class="form-control form-control-lg">
                                <option value="usuario1">Usuario 1</option>
                                <option value="usuario2" selected>Usuario 2</option>
                                <option value="usuario3">Usuario 3</option>
                            </select>
                            <label for="nombre">Usuario</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mt-3 mt-md-0">
                        <div class="form-floating">
                            <select name="puntuacion" id="puntuacion" class="form-control form-control-lg">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4" selected>4</option>
                                <option value="5">5</option>
                            </select>
                            <label for="puntuacion">Puntuación</label>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-floating">
                            <textarea name="descripcion" id="desripcion" class="form-control form-control-lg" style="height: 300px;" maxlength="250">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat libero placeat assumenda nesciunt fuga corrupti suscipit fugiat architecto. Magni minus maxime neque dicta eius possimus rem, error incidunt perferendis sequi. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit rem fuga omnis nulla, hic, voluptatibus debitis ullam quia, mollitia obcaecati odit esse impedit nisi possimus minus doloribus? Similique, in voluptatem.</textarea>
                            <label for="descripcion">Descripción</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include "footer.php"; ?>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/validacion.js"></script>
    <script src="js/AjaxSerialization.js"></script>
    <script src="js/valoracion.js"></script>
</body>

</html>