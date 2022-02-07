<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha bar</title>
    <base href="<?= getHome(); ?>view/backend/">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.css" />
</head>

<body class="d-flex flex-column">
    <?php include "cabecera.php"; ?>
    <section class="container my-5">
        <div class="row d-flex">
            <form action="<?= getIndex() . 'bd/bar/set-img'; ?>" method="POST" enctype="multipart/form-data" class="col">
                <input type="number" id="id" name="id" class="d-none" value="2">
                <div class="row mb-4">
                    <div class="col-12 col-md-auto d-flex align-items-center justify-content-center justify-content-md-start">
                        <button class="btn btn-lg btn-outline-primary btn-light me-2 flex-fill">Crear</button>
                        <button class="btn btn-lg btn-outline-success btn-light me-2 flex-fill" type="submit">Guardar</button>
                        <button class="btn btn-lg btn-outline-danger btn-light flex-fill">Eliminar</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" id="nombre" name="nombre" class="form-control" value="Bar x">
                            <label for="nombre">Nombre</label>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-floating">
                            <textarea id="desripcion" name="descripcion" class="form-control form-control-lg" style="height: 300px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat libero placeat assumenda nesciunt fuga corrupti suscipit fugiat architecto. Magni minus maxime neque dicta eius possimus rem, error incidunt perferendis sequi. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit rem fuga omnis nulla, hic, voluptatibus debitis ullam quia, mollitia obcaecati odit esse impedit nisi possimus minus doloribus? Similique, in voluptatem.</textarea>
                            <label for="descripcion">Descripción</label>
                        </div>
                    </div>
                    <div class="custom-file-container col-12 mt-3" data-upload-id="upload">
                        <label for="files">Imágenes</label>
                        <label class="custom-file-container__custom-file">
                            <input type="file" class="custom-file-container__custom-file__custom-file-input" name="files" accept="image/*" multiple aria-label="Elegir imágenes" />
                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                        </label>
                        <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Eliminar imágenes">Eliminar todas las imágenes</a>
                        <div class="custom-file-container__image-preview bg-light border border-secondary"></div>
                    </div>
                    <div class="col-12 mt-3">
                        <h3>Pinchos</h3>
                        <table id="basic-datatable" class="table table-hover dt-responsive nowrap w-100">
                    <thead class="table-dark">
                        <tr>
                            <th style="cursor: pointer;" class="w-5">ID ↓</th>
                            <th style="cursor: pointer;">Nombre</th>
                            <th style="cursor: pointer;">Bar</th>
                            <th style="cursor: pointer;">Puntuación media</th>
                            <th class="w-5"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="<?= getIndex() ?>pincho" class="text-decoration-none btn btn-light btn-outline-secondary">1</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Pincho de tortilla"></td>
                            <td class="w-50">
                                <select class="w-100 form-control" type="text" name="bar" id="bar">
                                    <option value="bar1">Bar 1</option>
                                    <option value="bar1" selected>Edelweiss</option>
                                    <option value="bar1">Bar 3</option>
                                </select>
                            </td>
                            <td><div class="fs-5 pt-1">4</div></td>
                            <td>
                                <button class="btn btn-danger" title="Eliminar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="<?= getIndex() ?>pincho" class="text-decoration-none btn btn-light btn-outline-secondary">2</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Pincho de tortilla"></td>
                            <td class="w-50">
                                <select class="w-100 form-control" type="text" name="bar" id="bar">
                                    <option value="bar1">Bar 1</option>
                                    <option value="bar1" selected>Edelweiss</option>
                                    <option value="bar1">Bar 3</option>
                                </select>
                            </td>
                            <td><div class="fs-5 pt-1">4</div></td>
                            <td>
                                <button class="btn btn-danger" title="Eliminar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="<?= getIndex() ?>pincho" class="text-decoration-none btn btn-light btn-outline-secondary">3</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Pincho de tortilla"></td>
                            <td class="w-50">
                                <select class="w-100 form-control" type="text" name="bar" id="bar">
                                    <option value="bar1">Bar 1</option>
                                    <option value="bar1" selected>Edelweiss</option>
                                    <option value="bar1">Bar 3</option>
                                </select>
                            </td>
                            <td><div class="fs-5 pt-1">4</div></td>
                            <td>
                                <button class="btn btn-danger" title="Eliminar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="<?= getIndex() ?>pincho" class="text-decoration-none btn btn-light btn-outline-secondary">4</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Pincho de tortilla"></td>
                            <td class="w-50">
                                <select class="w-100 form-control" type="text" name="bar" id="bar">
                                    <option value="bar1">Bar 1</option>
                                    <option value="bar1" selected>Edelweiss</option>
                                    <option value="bar1">Bar 3</option>
                                </select>
                            </td>
                            <td><div class="fs-5 pt-1">4</div></td>
                            <td>
                                <button class="btn btn-danger" title="Eliminar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="<?= getIndex() ?>pincho" class="text-decoration-none btn btn-light btn-outline-secondary">5</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Pincho de tortilla"></td>
                            <td class="w-50">
                                <select class="w-100 form-control" type="text" name="bar" id="bar">
                                    <option value="bar1">Bar 1</option>
                                    <option value="bar1" selected>Edelweiss</option>
                                    <option value="bar1">Bar 3</option>
                                </select>
                            </td>
                            <td><div class="fs-5 pt-1">4</div></td>
                            <td>
                                <button class="btn btn-danger" title="Eliminar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="<?= getIndex() ?>pincho" class="text-decoration-none btn btn-light btn-outline-secondary">6</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Pincho de tortilla"></td>
                            <td class="w-50">
                                <select class="w-100 form-control" type="text" name="bar" id="bar">
                                    <option value="bar1">Bar 1</option>
                                    <option value="bar1" selected>Edelweiss</option>
                                    <option value="bar1">Bar 3</option>
                                </select>
                            </td>
                            <td><div class="fs-5 pt-1">4</div></td>
                            <td>
                                <button class="btn btn-danger" title="Eliminar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                    </div>
                    <div class="col-12 mt-3">
                        <h3>Localización</h3>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="number" name="latitud" id="latitud" class="form-control" value="42.4656256" min="-90" max="90" step="0.0000001">
                                    <label for="latitud">Latitud</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="number" name="longitud" id="longitud" class="form-control" value="-2.4484511" min="-180" max="180" step="0.0000001">
                                    <label for="longitud">Longitud</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
</body>

</html>