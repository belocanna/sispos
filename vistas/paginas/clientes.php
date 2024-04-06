<div class="content-header">
    <div class="content-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                    Clientes
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li><a href="inicio"><i class="breadcrumb-item"></i> Inicio</a></li>
                    <li class="breadcrumb-item active"> / Clientes</li>
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
                    <div class="col-md-10">

                    </div>
                    <div class="col-md-2">
                        <button type="button" id="btnAdicionarCliente" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#modalCliente"><i class="fa fa-plus"></i> Crear</button>
                    </div>
                </div>
                <br>
            </div>
            <div class="card-body">
                <div class="table-responsive sm">
                    <table class="table table-bordered" style="width:100%" id="tblClientes">
                        <thead class="bg-primary">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">N° Documento</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Domicilio</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Ciudad</th>
                                <th scope="col">Correo Electronico</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="modalCliente">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary" id="cabeceraCliente">
                <h5 class="modal-title" id="tituloCliente"></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" id="cerrarCliente">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frmClientes">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="hidden" name="" id="idCliente">
                                <label for="">Numero de Identificacion</label>
                                <input type="text" name="documento" id="documentoCliente" class="form-control" onblur="validarCliente();">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">Nombres Completos o Razon Social</label>
                                <input type="text" name="" id="nombresCliente" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase()">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">Domicilio</label>
                                <input type="text" name="" id="domicilioCliente" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase()">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Telefono</label>
                                <input type="text" name="" id="telefonoCliente" class="form-control" placeholder="" aria-describedby="helpId">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Ciudad</label>
                                <input type="text" name="" id="ciudadCliente" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase()">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">Correo Electronico</label>
                                <input type="text" name="" id="correoCliente" class="form-control" onkeyup="javascript:this.value=this.value.toLowerCase()">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnCancelarCliente" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" id="btnGuardarCliente" class="btn btn-primary"></button>
            </div>
        </div>
    </div>
</div>

<script src="archivos/js/clientes.js"></script>