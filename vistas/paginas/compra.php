<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0">Registrar Compra</h2>
            </div>
            <div class="col sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
                    <li class="active"> / Registrar Compra</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group mb-2">
                            <input id="codigoProductoCompra" class="form-control" type="text" name="codigo" placeholder="Ingrese codigo del Articulo">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <button class="btn btn-primary" id="btnRegistrarCompra">Realizar Compra</button>
                        <button class="btn btn-danger" id="btnVaciarListado">Vaciar Listado</button>
                    </div>
                </div>
                    <div class="row">
                    <div class="col-md-6">
                        <h2 id="totalCompra"></h2>
                    </div>
                    <div class="col-md-6">
                        <h2 id="numeroCompra"></h2>
                    </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <table class="display nowrap table-striped w-100 shadow table-responsive sm" id="tblProductosCompra">
                            <thead class="bg-info text-left fs-6">
                                <tr>
                                    <th>Item</th>
                                    <th>Codigo</th>
                                    <th>Descripcion</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                    <th>Opciones</th>
                                    <!-- <th>Aplica Peso</th> -->
                                </tr>
                            </thead>
                            <tbody class="small text-left fs-6">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card shadow">
                    <h5 class="card-header py-1 bg-primary text-white text-center"> Resumen Compra</h5>
                    <div class="card-body p-2">
                        <div class="form-group mb-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Documento Compra</label>
                                        <input class="form-control" type="text" name="comprobante" id="documentoCompra">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="my-input">Proovedor</label>
                                        <input  class="form-control" type="text" name="" id="proovedorCompra">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <h4 id="nombresProovedor"></h4>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<script src="archivos/js/compras.js"></script>