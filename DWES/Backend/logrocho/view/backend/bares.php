<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de bares</title>
    <base href="<?= getHome(); ?>view/backend/">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body class="d-flex flex-column">
    <?php include "cabecera.php"; ?>
    <section class="container my-5">
        <div class="row mb-3" style="height: 50px;">
            <div class="col-6">
                <h1>Bares</h1>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <button class="btn btn-outline-primary btn-light w-25">Crear</button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 d-flex justify-content-start">
                <div class="dataTables_length" id="basic-datatable_length"><label class="form-label">Mostrar <select name="basic-datatable_length" aria-controls="basic-datatable" class="form-select form-select-sm">
                            <option value="10">10</option>
                            <option value="20" selected>20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select> registros</label></div>
            </div>
            <div class="col-sm-12 col-md-6 d-flex justify-content-lg-end justify-content-sm-start">
                <div id="basic-datatable_filter" class="dataTables_filter"><label>Buscar:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="basic-datatable"></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-5 d-flex justify-content-start">
                <div class="dataTables_info" id="alternative-page-datatable_info" role="status" aria-live="polite">
                    Mostrando registros del 1 al 20 de 78</div>
            </div>
            <div class="col-md-12 col-lg-7 d-flex justify-content-lg-end justify-content-md-start">
                <div class="dataTables_paginate paging_full_numbers" id="alternative-page-datatable_paginate">
                    <ul class="pagination pagination-rounded">
                        <li class="paginate_button page-item first disabled" id="alternative-page-datatable_first"><a href="#" aria-controls="alternative-page-datatable" data-dt-idx="0" tabindex="0" class="page-link">Primera</a></li>
                        <li class="paginate_button page-item previous disabled" id="alternative-page-datatable_previous"><a href="#" aria-controls="alternative-page-datatable" data-dt-idx="1" tabindex="0" class="page-link">Anterior</a></li>
                        <li class="paginate_button page-item active"><a href="#" aria-controls="alternative-page-datatable" data-dt-idx="2" tabindex="0" class="page-link">1</a></li>
                        <li class="paginate_button page-item "><a href="#" aria-controls="alternative-page-datatable" data-dt-idx="3" tabindex="0" class="page-link">2</a></li>
                        <li class="paginate_button page-item "><a href="#" aria-controls="alternative-page-datatable" data-dt-idx="4" tabindex="0" class="page-link">3</a></li>
                        <li class="paginate_button page-item "><a href="#" aria-controls="alternative-page-datatable" data-dt-idx="5" tabindex="0" class="page-link">4</a></li>
                        <li class="paginate_button page-item next" id="alternative-page-datatable_next"><a href="#" aria-controls="alternative-page-datatable" data-dt-idx="8" tabindex="0" class="page-link">Siguiente</a></li>
                        <li class="paginate_button page-item last" id="alternative-page-datatable_last"><a href="#" aria-controls="alternative-page-datatable" data-dt-idx="9" tabindex="0" class="page-link">Última</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table id="basic-datatable" class="table table-hover dt-responsive nowrap w-100">
                    <thead class="table-dark">
                        <tr>
                            <th style="cursor: pointer;" class="w-5">ID ↓</th>
                            <th style="cursor: pointer;">Nombre</th>
                            <th style="cursor: pointer;">Dirección</th>
                            <th style="cursor: pointer;">Terraza</th>
                            <th style="cursor: pointer;">Latitud</th>
                            <th style="cursor: pointer;">Longitud</th>
                            <th class="w-5"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="<?= getIndex() ?>bar" class="text-decoration-none btn btn-light btn-outline-secondary">1</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Edelweiss"></td>
                            <td class="w-50"><input class="w-100 form-control" type="text" name="direccion" id="direccion" value="Avenida de la playa, 3 bajo, 26009, Logroño, La Rioja"></td>
                            <td><input class="mx-auto mt-2 form-check form-check-input" type="checkbox" name="terraza" id="terraza" checked></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="43.2642"></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="25.3243"></td>
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
                            <td><a href="<?= getIndex() ?>bar" class="text-decoration-none btn btn-light btn-outline-secondary">2</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Edelweiss"></td>
                            <td class="w-50"><input class="w-100 form-control" type="text" name="direccion" id="direccion" value="Avenida de la playa, 3 bajo, 26009, Logroño, La Rioja"></td>
                            <td><input class="mx-auto mt-2 form-check form-check-input" type="checkbox" name="terraza" id="terraza" checked></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="43.2642"></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="25.3243"></td>
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
                            <td><a href="<?= getIndex() ?>bar" class="text-decoration-none btn btn-light btn-outline-secondary">3</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Edelweiss"></td>
                            <td class="w-50"><input class="w-100 form-control" type="text" name="direccion" id="direccion" value="Avenida de la playa, 3 bajo, 26009, Logroño, La Rioja"></td>
                            <td><input class="mx-auto mt-2 form-check form-check-input" type="checkbox" name="terraza" id="terraza" checked></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="43.2642"></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="25.3243"></td>
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
                            <td><a href="<?= getIndex() ?>bar" class="text-decoration-none btn btn-light btn-outline-secondary">4</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Edelweiss"></td>
                            <td class="w-50"><input class="w-100 form-control" type="text" name="direccion" id="direccion" value="Avenida de la playa, 3 bajo, 26009, Logroño, La Rioja"></td>
                            <td><input class="mx-auto mt-2 form-check form-check-input" type="checkbox" name="terraza" id="terraza" checked></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="43.2642"></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="25.3243"></td>
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
                            <td><a href="<?= getIndex() ?>bar" class="text-decoration-none btn btn-light btn-outline-secondary">5</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Edelweiss"></td>
                            <td class="w-50"><input class="w-100 form-control" type="text" name="direccion" id="direccion" value="Avenida de la playa, 3 bajo, 26009, Logroño, La Rioja"></td>
                            <td><input class="mx-auto mt-2 form-check form-check-input" type="checkbox" name="terraza" id="terraza" checked></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="43.2642"></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="25.3243"></td>
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
                            <td><a href="<?= getIndex() ?>bar" class="text-decoration-none btn btn-light btn-outline-secondary">6</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Edelweiss"></td>
                            <td class="w-50"><input class="w-100 form-control" type="text" name="direccion" id="direccion" value="Avenida de la playa, 3 bajo, 26009, Logroño, La Rioja"></td>
                            <td><input class="mx-auto mt-2 form-check form-check-input" type="checkbox" name="terraza" id="terraza" checked></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="43.2642"></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="25.3243"></td>
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
                            <td><a href="<?= getIndex() ?>bar" class="text-decoration-none btn btn-light btn-outline-secondary">7</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Edelweiss"></td>
                            <td class="w-50"><input class="w-100 form-control" type="text" name="direccion" id="direccion" value="Avenida de la playa, 3 bajo, 26009, Logroño, La Rioja"></td>
                            <td><input class="mx-auto mt-2 form-check form-check-input" type="checkbox" name="terraza" id="terraza" checked></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="43.2642"></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="25.3243"></td>
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
                            <td><a href="<?= getIndex() ?>bar" class="text-decoration-none btn btn-light btn-outline-secondary">8</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Edelweiss"></td>
                            <td class="w-50"><input class="w-100 form-control" type="text" name="direccion" id="direccion" value="Avenida de la playa, 3 bajo, 26009, Logroño, La Rioja"></td>
                            <td><input class="mx-auto mt-2 form-check form-check-input" type="checkbox" name="terraza" id="terraza" checked></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="43.2642"></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="25.3243"></td>
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
                            <td><a href="<?= getIndex() ?>bar" class="text-decoration-none btn btn-light btn-outline-secondary">9</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Edelweiss"></td>
                            <td class="w-50"><input class="w-100 form-control" type="text" name="direccion" id="direccion" value="Avenida de la playa, 3 bajo, 26009, Logroño, La Rioja"></td>
                            <td><input class="mx-auto mt-2 form-check form-check-input" type="checkbox" name="terraza" id="terraza" checked></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="43.2642"></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="25.3243"></td>
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
                            <td><a href="<?= getIndex() ?>bar" class="text-decoration-none btn btn-light btn-outline-secondary">10</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Edelweiss"></td>
                            <td class="w-50"><input class="w-100 form-control" type="text" name="direccion" id="direccion" value="Avenida de la playa, 3 bajo, 26009, Logroño, La Rioja"></td>
                            <td><input class="mx-auto mt-2 form-check form-check-input" type="checkbox" name="terraza" id="terraza" checked></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="43.2642"></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="25.3243"></td>
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
                            <td><a href="<?= getIndex() ?>bar" class="text-decoration-none btn btn-light btn-outline-secondary">11</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Edelweiss"></td>
                            <td class="w-50"><input class="w-100 form-control" type="text" name="direccion" id="direccion" value="Avenida de la playa, 3 bajo, 26009, Logroño, La Rioja"></td>
                            <td><input class="mx-auto mt-2 form-check form-check-input" type="checkbox" name="terraza" id="terraza" checked></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="43.2642"></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="25.3243"></td>
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
                            <td><a href="<?= getIndex() ?>bar" class="text-decoration-none btn btn-light btn-outline-secondary">12</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Edelweiss"></td>
                            <td class="w-50"><input class="w-100 form-control" type="text" name="direccion" id="direccion" value="Avenida de la playa, 3 bajo, 26009, Logroño, La Rioja"></td>
                            <td><input class="mx-auto mt-2 form-check form-check-input" type="checkbox" name="terraza" id="terraza" checked></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="43.2642"></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="25.3243"></td>
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
                            <td><a href="<?= getIndex() ?>bar" class="text-decoration-none btn btn-light btn-outline-secondary">13</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Edelweiss"></td>
                            <td class="w-50"><input class="w-100 form-control" type="text" name="direccion" id="direccion" value="Avenida de la playa, 3 bajo, 26009, Logroño, La Rioja"></td>
                            <td><input class="mx-auto mt-2 form-check form-check-input" type="checkbox" name="terraza" id="terraza" checked></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="43.2642"></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="25.3243"></td>
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
                            <td><a href="<?= getIndex() ?>bar" class="text-decoration-none btn btn-light btn-outline-secondary">14</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Edelweiss"></td>
                            <td class="w-50"><input class="w-100 form-control" type="text" name="direccion" id="direccion" value="Avenida de la playa, 3 bajo, 26009, Logroño, La Rioja"></td>
                            <td><input class="mx-auto mt-2 form-check form-check-input" type="checkbox" name="terraza" id="terraza" checked></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="43.2642"></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="25.3243"></td>
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
                            <td><a href="<?= getIndex() ?>bar" class="text-decoration-none btn btn-light btn-outline-secondary">15</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Edelweiss"></td>
                            <td class="w-50"><input class="w-100 form-control" type="text" name="direccion" id="direccion" value="Avenida de la playa, 3 bajo, 26009, Logroño, La Rioja"></td>
                            <td><input class="mx-auto mt-2 form-check form-check-input" type="checkbox" name="terraza" id="terraza" checked></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="43.2642"></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="25.3243"></td>
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
                            <td><a href="<?= getIndex() ?>bar" class="text-decoration-none btn btn-light btn-outline-secondary">16</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Edelweiss"></td>
                            <td class="w-50"><input class="w-100 form-control" type="text" name="direccion" id="direccion" value="Avenida de la playa, 3 bajo, 26009, Logroño, La Rioja"></td>
                            <td><input class="mx-auto mt-2 form-check form-check-input" type="checkbox" name="terraza" id="terraza" checked></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="43.2642"></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="25.3243"></td>
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
                            <td><a href="<?= getIndex() ?>bar" class="text-decoration-none btn btn-light btn-outline-secondary">17</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Edelweiss"></td>
                            <td class="w-50"><input class="w-100 form-control" type="text" name="direccion" id="direccion" value="Avenida de la playa, 3 bajo, 26009, Logroño, La Rioja"></td>
                            <td><input class="mx-auto mt-2 form-check form-check-input" type="checkbox" name="terraza" id="terraza" checked></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="43.2642"></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="25.3243"></td>
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
                            <td><a href="<?= getIndex() ?>bar" class="text-decoration-none btn btn-light btn-outline-secondary">18</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Edelweiss"></td>
                            <td class="w-50"><input class="w-100 form-control" type="text" name="direccion" id="direccion" value="Avenida de la playa, 3 bajo, 26009, Logroño, La Rioja"></td>
                            <td><input class="mx-auto mt-2 form-check form-check-input" type="checkbox" name="terraza" id="terraza" checked></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="43.2642"></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="25.3243"></td>
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
                            <td><a href="<?= getIndex() ?>bar" class="text-decoration-none btn btn-light btn-outline-secondary">19</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Edelweiss"></td>
                            <td class="w-50"><input class="w-100 form-control" type="text" name="direccion" id="direccion" value="Avenida de la playa, 3 bajo, 26009, Logroño, La Rioja"></td>
                            <td><input class="mx-auto mt-2 form-check form-check-input" type="checkbox" name="terraza" id="terraza" checked></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="43.2642"></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="25.3243"></td>
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
                            <td><a href="<?= getIndex() ?>bar" class="text-decoration-none btn btn-light btn-outline-secondary">20</a></td>
                            <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Edelweiss"></td>
                            <td class="w-50"><input class="w-100 form-control" type="text" name="direccion" id="direccion" value="Avenida de la playa, 3 bajo, 26009, Logroño, La Rioja"></td>
                            <td><input class="mx-auto mt-2 form-check form-check-input" type="checkbox" name="terraza" id="terraza" checked></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="43.2642"></td>
                            <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="25.3243"></td>
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
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-5 d-flex justify-content-start">
                <div class="dataTables_length" id="basic-datatable_length"><label class="form-label">Mostrar <select name="basic-datatable_length" aria-controls="basic-datatable" class="form-select form-select-sm">
                            <option value="10">10</option>
                            <option value="20" selected>20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select> registros</label></div>
            </div>
            <div class="col-sm-12 col-md-2 d-flex justify-content-center align-items-start">
                <button class="btn btn-outline-primary btn-light">Crear</button>
            </div>
            <div class="col-sm-12 col-md-5 d-flex justify-content-lg-end justify-content-sm-start">
                <div id="basic-datatable_filter" class="dataTables_filter"><label>Buscar:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="basic-datatable"></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-5 d-flex justify-content-start">
                <div class="dataTables_info" id="alternative-page-datatable_info" role="status" aria-live="polite">
                    Mostrando registros del 1 al 20 de 78</div>
            </div>
            <div class="col-md-12 col-lg-7 d-flex justify-content-lg-end justify-content-md-start">
                <div class="dataTables_paginate paging_full_numbers" id="alternative-page-datatable_paginate">
                    <ul class="pagination pagination-rounded">
                        <li class="paginate_button page-item first disabled" id="alternative-page-datatable_first"><a href="#" aria-controls="alternative-page-datatable" data-dt-idx="0" tabindex="0" class="page-link">Primera</a></li>
                        <li class="paginate_button page-item previous disabled" id="alternative-page-datatable_previous"><a href="#" aria-controls="alternative-page-datatable" data-dt-idx="1" tabindex="0" class="page-link">Anterior</a></li>
                        <li class="paginate_button page-item active"><a href="#" aria-controls="alternative-page-datatable" data-dt-idx="2" tabindex="0" class="page-link">1</a></li>
                        <li class="paginate_button page-item "><a href="#" aria-controls="alternative-page-datatable" data-dt-idx="3" tabindex="0" class="page-link">2</a></li>
                        <li class="paginate_button page-item "><a href="#" aria-controls="alternative-page-datatable" data-dt-idx="4" tabindex="0" class="page-link">3</a></li>
                        <li class="paginate_button page-item "><a href="#" aria-controls="alternative-page-datatable" data-dt-idx="5" tabindex="0" class="page-link">4</a></li>
                        <li class="paginate_button page-item next" id="alternative-page-datatable_next"><a href="#" aria-controls="alternative-page-datatable" data-dt-idx="8" tabindex="0" class="page-link">Siguiente</a></li>
                        <li class="paginate_button page-item last" id="alternative-page-datatable_last"><a href="#" aria-controls="alternative-page-datatable" data-dt-idx="9" tabindex="0" class="page-link">Última</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <?php include "footer.php"; ?>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>