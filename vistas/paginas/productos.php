<div class="content-header">
    <div class="content-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                    Inventario
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li><a href="inicio"><i class="breadcrumb-item"></i> Inicio</a></li>
                    <li class="breadcrumb-item active"> / Inventario</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="content">
    <!-- Small boxes (Stat box) -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row mb-1">
                    <div class="col-md-2">
                        <button type="button" id="btnAdicionarProducto" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#modalProducto"><i class="fa fa-plus"></i> Crear</button>
                    </div>
                </div>
                <br>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" style="width:100%" id="tblProductos">
                        <thead class="bg-primary">
                            <tr>
                                <th></th>
                                <th scope="col">Codigo de Barra</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col"></th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Stock Actual</th>
                                <th scope="col">Stock Minimo</th>
                                <th scope="col">Precio Costo</th>
                                <th scope="col">Precio Venta</th>
                                <th scope="col">Control Inventario</th>
                                <th scope="col">Acciones</th>
                            </tr>

                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="modalProducto">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary" id="cabeceraProducto">
                <h5 class="modal-title" id="tituloProducto"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cerrarProductos">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frmProductos">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="hidden" name="" id="idProducto">
                                <label for="">Categoria</label>
                                <select class="form-control" name="categoria" id="categoriaProducto">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">Codigo de Barra o Referencia</label>
                                <input type="text" name="codigo" id="codigoProducto" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ:# ]{3,70}" class="form-control" required onkeyup="javascript:this.value=this.value.toUpperCase()" onblur="validarCodigo(this);">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Descripcion</label>
                                <input type="text" name="descripcion" id="descripcionProducto" class="form-control" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Stock Actual</label>
                                <input type="text" name="stock" id="stockProducto" class="form-control" placeholder="" aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Stock Minimo</label>
                                <input type="number" name="minimo" id="minimoProducto" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Precio Costo</label>
                                <input type="text" name="costo" id="costoProducto" class="form-control" placeholder="" aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Precio Venta</label>
                                <input type="text" name="venta" id="ventaProducto" class="form-control" placeholder="" aria-describedby="helpId">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="my-select">Control de Inventario</label>
                            <select id="inventarioProducto" class="form-control" name="inventario">
                                <option value = "0">Seleccione</option>
                                <option value = "1">Si </option>
                                <option value = "2">No </option>
                            </select>
                          </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnCancelarProducto" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" id="btnGuardarProducto" class="btn btn-primary"></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalStock">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary" id="cabeceraStock">
                <h5 class="modal-title" id="tituloStock"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cerrarProductos">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frmStock">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" name="" id= "idProductoStock">
                                <h5 style = "color:blue" id ="codigoStock"></h5>
                                <h5 style = "color:blue" id="descripcionStock"></h5>
                                <h5 style = "color:blue" id="totalStock"></h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Cantidad </label>
                                <input type="number" name="stock" id="cantidadStock" class="form-control" placeholder="" aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <h4 id="totalStockActualizado"></h4>
                              <input type="hidden" name="" id="nuevoStock">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnCancelarStock" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btnGuardarStock" class="btn btn-primary"></button>
            </div>
        </div>
    </div>
</div>
<script src="archivos/js/productos.js"></script>