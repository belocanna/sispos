<div class="content-header">
    <div class="content-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                    Administrar Aperturas de Cajas
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li><a href="inicio"><i class="breadcrumb-item"></i> Inicio</a></li>
                    <li class="breadcrumb-item active"> / Administrar Apertura de Cajas</li>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4>Criterios de Busquedad</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Desde</label>
                                            <input id="fechaDesde" class="form-control" type="date" name="">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Hasta</label>
                                            <input id="fechaHasta" class="form-control" type="date" name="">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="" class="btn btn-success" id="btnFiltrar">Filtrar</a>
                                    </div>
                                    <div class="col-md-4">
                                    <button type="button" id="btnAdicionarApertura" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalApertura"><i class="fa fa-plus"></i> Apertura de Caja</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
        <br>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" style="width:100%" id="tblAperturas">
                <thead class="bg-primary">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Caja</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Fecha Apertura</th>
                        <th scope="col">Monto Apertura</th>
                        <th scope="col">Fecha Cierre</th>
                        <th scope="col">Monto Cierre</th>
                        <th scope="col">Monto Ventas</th>
                        <th scope="col">Opciones</th>
                    </tr>

                </thead>
            </table>
        </div>
    </div>
</div>
</div>

</div>

<div class="modal fade" id="modalApertura">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary" id="cabeceraApertura">
                <h5 class="modal-title" id="tituloApertura"></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" id="cerrarApertura">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frmApertura">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Caja</label>
                                <select class="form-control" name="caja" id="cajaApertura">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Monto Apertura</label>
                                <input type="text" name="monto" id="montoApertura" class="form-control" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnCancelarApertura" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" id="btnGuardarApertura" class="btn btn-primary"></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCierre">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary" id="cabeceraCierre">
                <h5 class="modal-title" id="tituloCierre"></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" id="cerrarApertura">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frmCierre">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Monto Apertura</label>
                                <input type="text" name="monto" id="montoAperturaCierre" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">

                                <label for="">Total Ventas</label>
                                <input type="text" name="monto" id="totalVentas" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Monto Cierre</label>
                                <input type="text" name="monto" id="montoCierre" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnCancelarCierre" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" id="btnGuardarCierre" class="btn btn-primary"></button>
            </div>
        </div>
    </div>
</div>

<script src="archivos/js/apertura.js"></script>

<script>

</script>