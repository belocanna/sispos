<section class="content-header">
    <h1>
        Unidades de Medida
    </h1>
    <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Productos</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="card">
        <div class="card-header">
            <div class="row mb-1">
                <div class="col-md-10">

                </div>
                <div class="col-md-2">
                    <button type="button" id="btnAdicionarMedida" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modalMedida"><i class="fa fa-plus"></i> Crear</button>
                </div>
            </div>
            <br>
        </div>
        <div class="card-body">
            <div class="table-responsive sm">
                <table class="table table-bordered  nowrap" style="width:100%" id="tblMedidas">
                    <thead class="bg-primary">
                        <tr>
                            <td></td>
                            <td>Descripcion</td>
                            <td>Acciones</td>
                        </tr>

                    </thead>
                </table>
            </div>
        </div>
    </div>

</section>

<div class="modal fade" id="modalMedida">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary" id="cabeceraMedida">
                <h5 class="modal-title" id="tituloMedida"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cerrarMedidas">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frmMedidas">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" name="" id="idMedida">
                                <label for="">Descripcion</label>
                                <input type="text" name="" id="descripcionMedida" class="form-control" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnCancelarMedida" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btnGuardarMedida" class="btn btn-primary"></button>
            </div>
        </div>
    </div>
</div>

<script src="archivos/js/medidas.js"></script>