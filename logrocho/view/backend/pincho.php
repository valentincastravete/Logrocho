<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha pincho</title>
    <base href="<?= getHome(); ?>view/backend/">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.css" />
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
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" id="nombre" name="nombre" class="campo form-control" placeholder="Pincho de tortilla" maxlength="250" required>
                            <div class="valid-feedback">
                                Campo introducido correctamente
                            </div>
                            <div class="invalid-feedback">
                                Campo obligatorio
                            </div>
                            <label for="nombre">Nombre</label>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-floating">
                            <select class="w-100 campo form-control" type="text" name="bar" id="bar" required>
                        </select>
                            <div class="valid-feedback">
                                Campo introducido correctamente
                            </div>
                            <div class="invalid-feedback">
                                Campo obligatorio
                            </div>
                            <label for="bar">Bar</label>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-floating">
                            <input type="text" id="descripcion" name="descripcion" class="campo form-control" placeholder="Descripción del pincho" maxlength="250" required>
                            <div class="valid-feedback">
                                Campo introducido correctamente
                            </div>
                            <div class="invalid-feedback">
                                Campo obligatorio
                            </div>
                            <label for="descripcion">Descripción</label>
                        </div>
                    </div>
                    <div class="custom-file-container col-12 mt-3" data-upload-id="upload">
                        <label for="files">Imágenes</label>
                        <label class="custom-file-container__custom-file">
                            <input type="file" class="custom-file-container__custom-file__custom-file-input" id="files" name="files" accept="image/*" multiple aria-label="Elegir imágenes" />
                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                        </label>
                        <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Eliminar imágenes">Eliminar todas las imágenes</a>
                        <div class="custom-file-container__image-preview bg-light border border-secondary"></div>
                    </div>
                    <div class="col-12 mt-3">
                        <h3>Valoraciones</h3>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="valoraciones" class="table table-hover dt-responsive nowrap w-100">
                                    <thead class="table-dark">
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include "footer.php"; ?>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.js"></script>
    <script>
        var upload = new FileUploadWithPreview("upload", {
            showDeleteButtonOnImages: true,
            text: {
                chooseFile: "Seleccionar imágenes",
                browse: "Abrir explorador",
                selectedCount: "imágenes",
            },
        });
    </script>
    <script src="js/validacion.js"></script>
    <script src="js/AjaxSerialization.js"></script>
    <script src="js/pincho.js"></script>
</body>

</html>