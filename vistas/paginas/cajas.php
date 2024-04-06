<div class="content-header">
    <div class="content-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                    Cajas
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li><a href="inicio"><i class="breadcrumb-item"></i> Inicio</a></li>
                    <li class="breadcrumb-item active"> / Cajas</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div class="row mb-1">
                <div class="col-md-10">

                </div>
                <div class="col-md-2">
                    <button type="button" id="btnAdicionarCaja" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCaja"><i class="fa fa-plus"></i> Crear</button>
                </div>
            </div>
        <br>
        </div>
        <div class="card-body">
            <div class="table-responsive sm">
                <table class="table table-bordered" style="width:100%" id="tblCajas">
                    <thead class="bg-primary">
                        <tr class="table-primary">
                            <th scope="col"></th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    </div>
    <!-- Small boxes (Stat box) -->
  

</div>

<div class="modal fade" id="modalCaja">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary" id="cabeceraCaja">
                <h5 class="modal-title" id="tituloCaja"></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" id="cerrarCajas">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <form action="" id="frmCajas">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                          <input type="hidden" name="" id="idCaja">
                          <label for="">Descripcion</label>
                          <input type="text" name="name" id="descripcionCaja" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ:# ]{3,70}" class="form-control" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                        </div>
                    </div>
                </div>
               </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnCancelarCaja"class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" id="btnGuardarCaja" class="btn btn-primary"><i class="fa fa-check2-square"></i></button>
            </div>
        </div>
    </div>
</div>

<script src="archivos/js/cajas.js"></script>