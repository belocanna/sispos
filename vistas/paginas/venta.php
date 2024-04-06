<div class="content-header">
    <div class="content-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                    Punto de Venta
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li><a href="inicio"><i class="breadcrumb-item"></i> Inicio</a></li>
                    <li class="breadcrumb-item active"> / Punto de Venta</li>
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
                        <div class="input-group mb-2">
                            <span class="input-group-text"></span>
                            <input id="codigoProductoVenta" class="form-control" type="text" name="codigo" placeholder="Ingrese codigo del producto">
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <button class="btn btn-primary" id="btnListadoProductos"><i class = "fas fa-search"></i></button>
                    </div>
                    <div class="col-md-4 mb-3">
                        <button class="btn btn-danger" id="btnVaciarListado">Vaciar Listado</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h2 id="totalVenta"></h2>
                    </div>
                    <div class="col-md-6">
                        <h2 id="numeroVenta"></h2>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-striped nowrap table-responsive sm" id="tblProductosVenta">
                            <thead class="bg-info text-left">
                                <tr>
                                    <th>Item</th>
                                    <th>Codigo</th>
                                    <th>Descripcion</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody class="small text-left fs-6">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Forma de Pago</label>
                    <select class="form-control" name="pago" id="pagoVenta">
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">N° Comprobante</label>
                    <input class="form-control" type="text" name="comprobante" id="comprobanteVenta">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Cliente</label>
                    <input class="form-control" type="text" name="cliente" id="clienteVenta">
                </div>
            </div>
            <div class="col-md-4">
                <h3 id="nombreCliente"></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="input-group mb2">
                    <label for="">Efectivo Recibido</label>
                    <span class="input-group text">$</span>
                    <input class="form-control" type="number" name="efectivo" id="efectivoVenta">
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="form-group">
                    <label for="">Devolucion</label>
                    <span class="input-group text"> $ </span>
                    <input class="form-control" type="text" name="devolucion" id="devolucionVenta" value="0" disabled>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                <button class="btn btn-primary" id="btnRegistrarVenta">Registrar Venta</button>
                </div>
           
            </div>
        </div>
       
    </div>
</div>

<div class="modal fade" id="modalProductosVenta">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary" id="cabeceraCierre">
                <h5 class="modal-title" id="tituloListadoProductos"></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" id="cerrarListado">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frmListadoProductos">
                <div class="table-responsive-lg">
                    <table class="table table-bordered" style="width:100%" id="tblListadoProductos">
                        <thead class="bg-info">
                            <tr>
                                <th style="width:15px">Codigo</th>
                                <th style="width:50px">Descripcion</th>
                                <th style="width:50px">Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnCancelarListado" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script src="archivos/js/ventas.js"></script>