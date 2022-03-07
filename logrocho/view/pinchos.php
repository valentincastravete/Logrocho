<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de pinchos</title>
    <base href="<?= getHome(); ?>view/backend/">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body class="d-flex flex-column">
    <?php include "cabecera.php"; ?>
    <section class="container my-5">
        <div class="row mb-3" style="height: 50px;">
            <div class="col-6">
                <h1>Pinchos</h1>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <button class="btn btn-outline-primary btn-light w-25">Crear</button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 d-flex justify-content-start">
                <div class="dataTables_length">
                    <label class="form-label">
                        Mostrar <select id="cantidad" class="form-select form-select-sm">
                            <option value="5" selected>5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                        </select> registros
                    </label>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 d-flex justify-content-lg-end justify-content-sm-start">
                <div class="dataTables_filter">
                    <label>Buscar:<input type="search" class="form-control form-control-sm" placeholder=""></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-5 d-flex justify-content-start">
                <div role="status">
                    Mostrando registros del <span id="desde"></span> al <span id="hasta"></span> de <span id="max"></span></div>
            </div>
            <div class="col-md-12 col-lg-7 d-flex justify-content-lg-end justify-content-md-start">
                <div>
                    <ul class="pagination pagination-rounded">
                        <li class="paginate_button page-item first"><button class="page-link">Primera</button></li>
                        <li class="paginate_button page-item previous"><button class="page-link">Anterior</button></li>
                        <li class="paginate_button page-item"><input id="pagina" type="number" class="page-link" value="1"/></li>
                        <li class="paginate_button page-item next"><button class="page-link">Siguiente</button></li>
                        <li class="paginate_button page-item last"><button class="page-link">Última</button></li>
                    </ul>
                </div>
            </div>
        </div>
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
    </section>
    <?php include "footer.php"; ?>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/AjaxSerialization.js"></script>
    <script src="js/pinchos.js"></script>
</body>

</html>