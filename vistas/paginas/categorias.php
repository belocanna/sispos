<div class="content-header">
    <div class="content-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                    Categorias
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li><a href="inicio"><i class="breadcrumb-item"></i> Inicio</a></li>
                    <li class="breadcrumb-item active"> / Categorias</li>
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
                    <button type="button" id="btnAdicionarCategoria" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#modalCategoria"><i class="fa fa-plus"></i> Crear</button>
                </div>
            </div>
        <br>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped  nowrap" style="width:100%" id="tblCategorias">
                    <thead class="bg-primary">
                        <tr>
                            <th></th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Ubicacion</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    </div>
    <!-- Small boxes (Stat box) -->
    

</div>

<div class="modal fade" id="modalCategoria">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary"id="cabeceraCategoria">
                <h5 class="modal-title" id="tituloCategoria"></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" id="cerrarCategorias">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <form action="" id="frmCategorias">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <input type="hidden" name="" id="idCategoria">
                          <label for="">Descripcion</label>
                          <input type="text" name="name" id="descripcionCategoria" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ:# ]{3,70}" class="form-control" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Ubicacion</label>
                          <input type="text" name="name" id="ubicacionCategoria" class="form-control" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                        </div>
                    </div>
                </div>
               </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnCancelarCategoria"class="btn btn-danger" data-bs-dismiss="modal"> Cerrar</button>
                <button type="button" id="btnGuardarCategoria" class="btn btn-primary"><i class='fa fa-check'></i>  </button>
            </div>
        </div>
    </div>
</div>

<script src="archivos/js/categorias.js"></script>