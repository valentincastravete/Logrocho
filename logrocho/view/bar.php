<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha bar</title>
    <base href="<?= getHome(); ?>view/">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.css" />
</head>

<body class="d-flex flex-column">
    <?php include "cabecera.php"; ?>
    <section class="container my-5">
        <div class="row d-flex">
            <div class="col">
                <input type="number" id="id" name="id" class="d-none" disabled>
                <div class="row">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" id="nombre" name="nombre" class="campo form-control" placeholder="San Miguel" required readonly>
                            <label for="nombre">Nombre</label>
                        </div>
                    </div>
                    <div class="col-12 mt-3 d-flex align-items-center">
                        <div class="form-floating col-10">
                            <input type="text" id="direccion" name="direccion" class="campo form-control" placeholder="C/ del Sol, 14 5º C" required readonly>
                            <label for="direccion">Dirección</label>
                        </div>
                        <div class="col-2 ms-5 d-flex align-items-center">
                            <label for="terraza">Terraza</label>
                            <input type="checkbox" name="terraza" id="terraza" class="form-check form-check-input d-inline ms-2" disabled>
                        </div>
                    </div>
                    <div class="custom-file-container col-12 mt-3" data-upload-id="upload">
                        <label for="files">Imágenes</label>
                        <div class="custom-file-container__image-preview bg-light border border-secondary" id="galeria"></div>
                    </div>
                    <div class="col-12 mt-3">
                        <h3>Pinchos</h3>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="pinchos" class="table table-hover dt-responsive nowrap w-100">
                                    <thead class="table-dark">
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <h3>Localización</h3>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="number" name="latitud" id="latitud" class="campo form-control" min="-90" max="90" step="0.0000001" placeholder="25.34252" readonly required>
                                    <label for="latitud">Latitud</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="number" name="longitud" id="longitud" class="campo form-control" min="-180" max="180" step="0.0000001" placeholder="25.34252" readonly required>
                                    <label for="longitud">Longitud</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include "footer.php"; ?>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/AjaxSerialization.js"></script>
    <script src="js/bar.js"></script>
</body>

</html>