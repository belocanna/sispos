<div class="content-header">
    <div class="content-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                    Usuarios
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li><a href="inicio"><i class="breadcrumb-item"></i> Inicio</a></li>
                    <li class="breadcrumb-item active"> / Usuarios</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="content">
    <!-- Small boxes (Stat box) -->
    <div class="card">
        <div class="card-header">
            <div class="row mb-1">
                <div class="col-md-10">

                </div>
                <div class="col-md-2">
                    <button type="button" id="btnAdicionarUsuario" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#modalUsuario"> Adicionar</button>
                </div>
            </div>
        <br>
        </div>
        <div class="card-body">
            <div class="table-responsive sm">
                <table class="table table-striped  nowrap" style="width:100%" id="tblUsuarios">
                    <thead class="bg-primary">
                        <tr>
                            <td></td>
                            <td scope="col">Nombres</td>
                            <td scope="col">Perfil</td>
                            <td scope="col">Ultimo Login</td>
                            <td scope="col">Acciones</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- MODAL CREAR USUARIO -->
<div class="modal fade" id="modalUsuario">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="tituloUsuario"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cerrarUsuario">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <form action="">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                          <input type="hidden" name="" id="idUsuario">
                          <label for="">Nombres</label>
                          <input type="text" name="nombre" id="nombresUsuario" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                          <label for="">Correo Electronico</label>
                          <input type="email" name="correo" id="correoUsuario" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">Perfil</label>
                                    <select class="form-select form-control" name="" id="perfilUsuario">
                                        <option selected>Seleccione</option>
                                        <option value="1">Administrador</option>
                                        <option value="2">Usuario</option>
                                        <option value="2">Empleado</option>
                                    </select>
                                </div>
                            </div>
                </div>
               </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnCancelarUsuario"class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btnGuardarUsuario" class="btn btn-primary"></button>
            </div>
        </div>
    </div>
</div>

<script src="archivos/js/usuarios.js"></script>